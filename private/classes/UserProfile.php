<?php


namespace classes;


use AchievesModel;
use AvatarModel;
use BalanceModel;
use BaseController;
use CommonIdRatingModel;
use IncomeModel;
use PaymentModel;
use PlayerModel;
use RefModel;
use classes\ViewHelper as VH;
use UserModel;

class UserProfile
{
    const SUDOKU_BALANCE = 'SUDOKU_BALANCE';

    public static function playerCabinetInfo(Game $game)
    {
        $message = [];

        $message['info'] = [];
        $message['info']['rating'] = CommonIdRatingModel::getRating(BaseController::$commonId, $game::GAME_NAME);
        $message['info']['top'] = CommonIdRatingModel::getTopByRating($message['info']['rating'], $game::GAME_NAME);
        $message['info'][self::SUDOKU_BALANCE] = BalanceModel::getBalance(BaseController::$commonId);
        $message['info']['SUDOKU_TOP'] = BalanceModel::getTopByBalance($message['info'][self::SUDOKU_BALANCE]);
        $message['info']['rewards'] = IncomeModel::getIncome(BaseController::$commonId);

        $refs = RefModel::getCustomO(RefModel::COMMON_ID_FIELD, '=', BaseController::$commonId, true);
        try {
        $message['refs'] = [];
        if ($refs) {
            foreach ($refs as $ref) {
                $message['refs'][] = [
                    $ref->_name,
                    MonetizationService::REWARD[AchievesModel::DAY_PERIOD] . '&nbsp;' . T::S('{{sudoku_icon_20}}')
                ];
            }
        }
            } catch(\Throwable $e) {
        }

        $transactions = PaymentModel::selectO(
            ['*'],
            ORM::where(PaymentModel::COMMON_ID_FIELD, '=', BaseController::$commonId, true)
            //. ORM::andWhere(PaymentModel::STATUS_FIELD, '!=', PaymentModel::INIT_STATUS)
            ,
            ORM::orderBy(PaymentModel::UPDATED_AT_FIELD, false)
            . ORM::limit(10)
        );

        $message['transactions'] = VH::tagOpen(
            'table',
            '',
            ['class' => 'table']
        );

        $message['transactions'] .= VH::thead(
            VH::tr(
                VH::th(T::S('Date'), ['scope' => 'col'])
                . VH::th(T::S('Price'), ['scope' => 'col'])
                . VH::th(T::S('Status'), ['scope' => 'col']),
                ['class' => 'text-light']
            )
        );

        foreach ($transactions as $transaction) {
            $message['transactions'] .= VH::tr(
                VH::td($transaction->_updated_at)
                . VH::td($transaction->_summ)
                . VH::td(T::S($transaction->_status)),
                ['class' => 'text-light']
            );
        }
        $message['transactions'] .= VH::tagClose('table');

        $message['common_id'] = BaseController::$commonId;

        $userData = UserModel::getOneO(BaseController::$commonId);

        $message['url'] = ($userData->_avatar_url ?? null) ?: false;
        if (!$message['url']) {
            $message['url'] = AvatarModel::getDefaultAvatar(BaseController::$commonId);
            $message['img_title'] = T::S('Default avatar is used');
        } else {
            $message['img_title'] = T::S('Avatar by provided link');
        }

        $message['name'] = ($userData->_name ?? null)
            ?: PlayerModel::getPlayerName(
                new GameUser(['ID' => BaseController::$User, 'common_id' => BaseController::$commonId])
            );

        $message['text'] = '';
        $message['form'][] = [
            'prompt' => "Никнейм (id: {$message['common_id']})",
            'inputName' => 'name',
            'inputId' => 'player_name',
            'onclick' => 'savePlayerName',
            'buttonCaption' => T::S('Set'),
            'placeholder' => T::S('new nickname')
        ];
        $message['form'][] = [
            'prompt' => '',
            'type' => 'hidden',
            'inputName' => 'cookie',
            'value' => $game->User,
        ];
        $message['form'][] = [
            'prompt' => '',
            'type' => 'hidden',
            'inputName' => 'MAX_FILE_SIZE',
            'value' => Players::MAX_UPLOAD_SIZE,
        ];
        $message['form'][] = Hints::IsNotAndroidApp()
            ? [
                'prompt' => T::S('Avatar loading'),
                'type' => 'file',
                'inputName' => 'url',
                'inputId' => 'player_avatar_file',
                'onclick' => 'savePlayerAvatar',
                'buttonCaption' => T::S('Send'),
                'required' => true,
            ]
            : [
                'prompt' => T::S('Avatar URL'),
                'inputName' => 'url',
                'inputId' => 'player_avatar_url',
                'onclick' => 'savePlayerAvatarUrl',
                'buttonCaption' => T::S('Apply'),
                'placeholder' => 'https://'
            ];

        $message['secret'] = $game->genKeyForCommonID(BaseController::$commonId);

        /*
        $message['form'][] = [
            'prompt' => 'Ключ учетной записи',
            'inputName' => 'keyForID',
            'inputId' => 'key_for_id',
            'onclick' => 'copyKeyForID',
            'buttonCaption' => 'В буфер',
            'value' => $this->genKeyForCommonID($message['common_id']),
            'readonly' => 'true'
        ];

        $message['form'][] = [
            'prompt' => 'Ключ основного аккаунта',
            'inputName' => 'key',
            'inputId' => 'old_account_key',
            'onclick' => 'mergeTheIDs',
            'buttonCaption' => 'Связать',
            'placeholder' => 'сохраненный ключ от старого аккаунта'
        ];
        */

        return (['message' => json_encode($message, JSON_UNESCAPED_UNICODE)]);
    }
}