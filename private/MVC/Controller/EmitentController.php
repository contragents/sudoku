<?php


use classes\Config;
use classes\ORM;
use classes\TG;
use Longman\TelegramBot\Request;

class EmitentController extends BaseController
{
    const MANAGER_WILL_CALL = 'Менеджер свяжется с Вами в ближайшее время';
    const ERROR_SAVING_REQUEST_TITLE = 'Ошибка сохранения заявки';
    const ERROR_SAVING_REQUEST_MESSAGE = 'Попробуйте отправить запрос еще раз';

    const PHONES = [
        'gorod' => ['href' => 'tel:+74954790170', 'full' => '+7 495 479-01-70'],
        'mobile' => ['href' => 'tel:+79958860530', 'full' => '+7 995 886-05-30'],
    ];

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
        $calcLinks = '<ul>';
        foreach ($emitents as $emitent) {
            $links .= "<li><a href=\"/{$emitent[EmitentModel::SHORT_NAME_FIELD]}\">{$emitent[EmitentModel::FULL_NAME_FIELD]}</a></li>";
            $calcLinks .= "<li><a href=\"/{$emitent[EmitentModel::SHORT_NAME_FIELD]}\" style=\"color:#fff;\">{$emitent[EmitentModel::FULL_NAME_FIELD]}</a></li>";
        }
        $links .= '</ul>';
        $calcLinks .= '</ul>';

        $emitentFN = 'различных эмитентов РФ: ' . $links;
        $priceLow = 0;
        $priceHigh = 0;
        $priceLowStr = 'Выберите эмитента';
        $priceHighStr = $calcLinks; // '<a href="/polus" style="color:#fff;">ПАО "Полюс"</a>';

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

        $priceLowStr = number_format(
            $priceLow,
            $priceLow > 0.1 ? 2 : ($priceLow > 0.01 ? 3 : ($priceLow > 0.001 ? 4 : ($priceLow > 0.0001 ? 5 : 6))),
            ',',
            ' '
        );
        $priceHighStr = number_format(
            $priceHigh,
            $priceHigh > 0.1 ? 2 : ($priceHigh > 0.01 ? 3 : ($priceHigh > 0.001 ? 4 : ($priceHigh > 0.0001 ? 5 : 6))),
            ',',
            ' '
        );

        $phone = self::PHONES['mobile'];
        $oferta = self::getOfertaOvk();

        $emitentViewFileName = __DIR__ . '/../View/' . self::$Request['emitent_short_name'] . '.tpl';
        include file_exists($emitentViewFileName) ? $emitentViewFileName : __DIR__ . '/../View/index.tpl';
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
            $telegram = new TG(Config::$envConfig[BotController::BOT_TOKEN_CONFIG_KEY], BotController::BOT_USERNAME);
            foreach(BotController::TG_ADMINS as $admin) {
                Request::sendMessage(
                    [
                        'chat_id' => $admin,
                        'text' => var_export(
                            self::$Request['form_data']
                            + ['emitent_short_name' => self::$Request['emitent_short_name']],
                            true
                        ),
                    ]
                );
            }

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

    private static function getOfertaOvk(): string {
        return <<<OFERTA
<h6>ДОГОВОР - ОФЕРТА НА ОКАЗАНИЕ КОНСУЛЬТАЦИОННЫХ УСЛУГ</h6>
<ol>
<li><h6>1. ОБЩИЕ ПОЛОЖЕНИЯ</h6></li>
<li>
1.1. Настоящий публичный договор (далее – «Оферта» или «Договор») представляет
собой официальное предложение Черкасова Ильи Сергеевича ИНН 772003421438, далее именуемого «Исполнитель», по
оказанию консультаций по оформлению заявки (оферта + комплект документов) на выкуп акций дополнительного размещения НПК ОВК ПАО,
 консультации и сопровождение сделки (далее - «Услуга») физическим лицам, далее именуемым «Пользователь, Заказчик», а
совместно именуемые «Стороны», согласно перечисленных ниже условий в форме
консультации по телефону, в мессенджере Telegram, WhatsApp или с использованием электронной почты, указанных на сайте https://invest.legal/ovk
</li>
<li>1.2. В соответствии с пунктом 2 статьи 437 Гражданского кодекса Российской
Федерации (далее – ГК РФ) данный документ является публичной Офертой и в случае
принятия изложенных ниже условий лицо, осуществившее Акцепт настоящей Оферты,
становится Заказчиком. В соответствии с ч. 1 ст. 438 ГК РФ Акцепт должен быть полным
и безоговорочным.</li>
<li>1.3. Исполнитель и Заказчик предоставляют взаимные гарантии своей право- и
дееспособности необходимые для заключения и исполнения настоящего Договора на
оказание консультационных услуг.</li><br>
<li><h6>2. ПРЕДМЕТ ОФЕРТЫ</h6></li>
<li>2.1. Предметом настоящей Оферты является платное оказание Заказчику
консультационных услуг силами Исполнителя в соответствии с условиями настоящей
Оферты путем проведения консультаций по телефону или с использованием мессенджеров, либо электронной
почты с целью оформления заявки (оферта + комплект документов) на выкуп акций дополнительного размещения НПК ОВК ПАО.
</li><br>
<li><h6>3. УСЛОВИЯ ОКАЗАНИЯ ИНФОРМАЦИОННОЙ УСЛУГИ</h6></li>
<li>3.1. Заказчик осуществляет Акцепт настоящей Оферты путем отправки своих
контактных данных с использованием форм обратной связи, размещенной на сайте, 
а также оплаты стоимости Услуги в размере 30 000 (тридцать тысяч) рублей 00 коп. 
путем перечисления денежных средств с помощью Системы Быстрых Платежей на 
номер телефона Исполнителя - +7 965 325-18-23
</li>
<li>3.2. Акцептом настоящей Оферты Заказчик дает свое согласие в том числе на
обработку своих персональных данных в составе имя, email и/или номер телефона, 
паспортных данных, номеров счетов с целью
исполнения условий настоящего Договора.
</li>
<li>3.3. Исполнитель связывается с Заказчиком с использованием предоставленных
контактных данных и проводит для него консультацию по всем вопросам, озвученным
Заказчиком в запросе или непосредственно при звонке.
</li>
<li>3.4. Исполнитель оставляет за собой право отказать Заказчику в оказании Услуги:
в случае невозможности связаться с ним по указанным контактным данным,
в случае, если заданный вопрос не относится к сути Услуги, в случае некорректного поведения Заказчика во время консультации, а именно:
разжигание межнациональных конфликтов, оскорбление консультанта и Владельца сайта,
неоднократное (более двух раз) отклонение от консультации, реклама любого вида,
нецензурные высказывания, распространение сведений, носящих заведомо ложный характер.
В этом случае Исполнитель удерживает из суммы оплаты за Услугу стоимость 
фактически понесенных им расходов во время оказания Услуги, но не менее 10 000 (десяти тысяч) рублей 00 коп.
и осуществляет возврат остатка денежных средст по реквизитам Заказчика.
</li><br>
<li><h6>4. СРОК ДЕЙСТВИЯ ОФЕРТЫ. ЗАКЛЮЧИТЕЛЬНЫЕ ПОЛОЖЕНИЯ</h6></li>
<li>4.1. Настоящая Оферта вступает в силу с момента опубликования на Сайте в сети
Интернет и действует до момента отзыва/изменения Оферты Исполнителем.
</li>
</ol>
OFERTA;
;
    }
}