<?php


use classes\ORM;

class EmitentController extends BaseController
{
    const MANAGER_WILL_CALL = 'Менеджер свяжется с Вами в ближайшее время';
    const ERROR_SAVING_REQUEST_TITLE = 'Ошибка сохранения заявки';
    const ERROR_SAVING_REQUEST_MESSAGE = 'Попробуйте отправить запрос еще раз';

    public function user_agreementAction()
    {
        include __DIR__ . '/../View/users_agreement.tpl';
    }

    public function policyAction()
    {
        include __DIR__ . '/../View/policy.tpl';
    }

    public function mainAction()
    {
        $emitents = EmitentModel::getCustom(EmitentModel::ID_FIELD, '>', 0, true);

        $links = '<ul>';
        foreach ($emitents as $emitent) {
            $links .= "<li></li><a href=\"/{$emitent[EmitentModel::SHORT_NAME_FIELD]}\">{$emitent[EmitentModel::FULL_NAME_FIELD]}</a></li>";
        }
        $links .='</ul>';

        $emitentFN = 'различных эмитентов РФ: ' . $links;
        $priceLow = 0;
        $priceHigh = 0;
        $priceLowStr = 'Выберите эмитента';
        $priceHighStr = $links;// '<a href="/polus" style="color:#fff;">ПАО "Полюс"</a>';

        include __DIR__ . '/../View/index.tpl';
    }


    public function emitentAction()
    {
        [EmitentModel::FULL_NAME_FIELD => $emitentFN, EmitentModel::ID_FIELD => $emitentId] = BaseModel::getFields(
            EmitentModel::getOneCustom(
                EmitentModel::SHORT_NAME_FIELD,
                self::$Request['emitent_short_name']
            ),
            [EmitentModel::FULL_NAME_FIELD => '', EmitentModel::ID_FIELD => 0]
        );

        [
            PriceModel::PRICE_LOW_FIELD => $priceLow,
            PriceModel::PRICE_HI_FIELD => $priceHigh,
            PriceModel::CREATED_FIELD => $RefreshDate
        ] = PriceModel::getCustom(
            PriceModel::ID_FIELD,
            '=',
            '('
            . ORM::select(['max(id) as id'], PriceModel::TABLE_NAME)
            . ORM::where(PriceModel::EMITENT_ID_FIELD, '=', $emitentId, true)
            . ORM::limit(1)
            . ')',
            true,
            false,
            [
                PriceModel::PRICE_LOW_FIELD,
                PriceModel::PRICE_HI_FIELD,
                PriceModel::CREATED_FIELD
            ]
        )[0] ?: [
            PriceModel::PRICE_LOW_FIELD => 0,
            PriceModel::PRICE_HI_FIELD => 0,
            PriceModel::CREATED_FIELD => '2023-01-01 00:00:00'
        ];

        $priceLowStr = number_format($priceLow, 2, ',', ' ');
        $priceHighStr = number_format($priceHigh, 2, ',', ' ');

        include __DIR__ . '/../View/index.tpl';
    }

    public function requestAction()
    {
        $totalCost = preg_replace('/[^0-9,.]/', '', self::$Request['form_data']['total_cost']);
        $totalCost = str_replace(',', '.', $totalCost);

        if (self::$Request['form_data']['shares_count'] > 0 && $totalCost > 0) {
            self::$Request['form_data']['offered_share_price'] = $totalCost / self::$Request['form_data']['shares_count'];
        }

        return $this->requestCallAction();
    }

    public function requestCallAction()
    {
        if ($orderId = OrderModel::add(
            [
                OrderModel::EMITENT_ID_FIELD => EmitentModel::getOneCustom(
                        EmitentModel::SHORT_NAME_FIELD,
                        self::$Request['emitent_short_name']
                    )[EmitentModel::ID_FIELD] ?? 0,
                (
                self::$Request['form_data']['action'] == 'requestCall'
                    ? OrderModel::CALLBACK_FIELD
                    : OrderModel::ORDER_FIELD
                ) => json_encode(self::$Request['form_data'], JSON_UNESCAPED_UNICODE)
            ]
        )) {
            return [
                'title' => "Ваша заявка №$orderId принята",
                'message' => self::MANAGER_WILL_CALL,
            ];
        } else {
            return [
                'title' => self::ERROR_SAVING_REQUEST_TITLE,
                'message' => self::ERROR_SAVING_REQUEST_MESSAGE
            ];
        }
    }
}