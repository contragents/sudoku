<?php

namespace classes;

use PaymentModel;
use BaseController as BC;
use UserModel;

class T
{
    const RU_LANG = 'RU';
    const EN_LANG = 'EN';
    const TR_LANG = 'TR';
    const SUPPORTED_LANGS = [self::EN_LANG, self::RU_LANG, self::TR_LANG];

    const PLURAL_PATTERN = '[[';

    public static string $lang = self::EN_LANG;

    public static function S($keyPhrase, ?array $params = null, ?string $forceLang = null): string
    {
        if (BC::$instance->gameName && isset(self::PHRASES[$keyPhrase][BC::$instance->gameName])) {
            $res = self::PHRASES[$keyPhrase][BC::$instance->gameName][$forceLang ?? self::$lang]
                ?? (self::PHRASES[$keyPhrase][$forceLang ?? self::$lang] ?? $keyPhrase);
        } else {
            $res = self::PHRASES[$keyPhrase][$forceLang ?? self::$lang] ?? $keyPhrase;
        }

        if (strpos($res, Macros::PATTERN) !== false) {
            return Macros::applyMacros($res);
        }

        if (strpos($res, self::PLURAL_PATTERN) !== false && $params) {
            return self::applyPlurals($res, $params, $forceLang ?? self::$lang);
        }

        return $res;
    }

    public static function SA(array $keyPhraseArr): array
    {
        foreach ($keyPhraseArr as $key => $keyPhrase) {
            // исключаем зарезервированные ключи
            if (in_array($key, ['result'])) {
                continue;
            }

            $keyPhraseArr[$key] = is_array($keyPhrase)
                ? self::SA($keyPhrase)
                : self::S($keyPhrase);
        }

        return $keyPhraseArr;
    }

    const PHRASES = [
        'Agreement' => [
            self::RU_LANG => 'Оферта',
            self::TR_LANG => 'Anlaşma',
        ],
        'Empty value is forbidden' => [
            self::RU_LANG => 'Задано пустое значение',
            self::TR_LANG => 'Boş değer yasaktır',
        ],
        'Forbidden' => [
            self::RU_LANG => 'Доступ запрещен',
            self::TR_LANG => 'Yasak',
        ],
        'game_title' => [
            SudokuGame::GAME_NAME => [
                self::EN_LANG => 'Sudoku Online with friends',
                self::RU_LANG => 'Судоку онлайн с друзьями',
                self::TR_LANG => 'Arkadaşlarla Online Sudoku',
            ],
            GomokuGame::GAME_NAME => [
                self::EN_LANG => 'Gomoku online | X-0',
                self::RU_LANG => 'Крестики-нолики онлайн с друзьями',
                self::TR_LANG => '',
            ],
        ],
        'secret_prompt' => [
            self::EN_LANG => '&#42;Save this key for further account restoration in Telegram</a>',
            self::RU_LANG => '&#42;Сохраните ключ для восстановления аккаунта в Telegram</a>',
            self::TR_LANG => 'Telegram\'da daha fazla hesap geri yüklemesi için bu anahtarı kaydedin',

            SudokuGame::GAME_NAME => [
                self::EN_LANG => '&#42;Save this key for further account restoration in <a href="https://t.me/sudoku_app_bot">Telegram</a>',
                self::RU_LANG => '&#42;Сохраните ключ для восстановления аккаунта в <a href="https://t.me/sudoku_app_bot">Telegram</a>',
                self::TR_LANG => '<a href="https://t.me/sudoku_app_bot">Telegram\'da</a> daha fazla hesap geri yüklemesi için bu anahtarı kaydedin',
            ]
        ],
        'COIN Balance' => [
            self::RU_LANG => 'Баланс монет',
            self::TR_LANG => 'Para bakiyesi',
        ],
        PaymentModel::INIT_STATUS => [
            self::EN_LANG => 'Started',
            self::RU_LANG => 'Начата',
            self::TR_LANG => 'Başladı',
        ],
        PaymentModel::BAD_CONFIRM_STATUS => [
            self::EN_LANG => 'Bad confirmation',
            self::RU_LANG => 'Ошибка подтверждения',
            self::TR_LANG => 'Kötü onay',
        ],
        PaymentModel::COMPLETE_STATUS => [
            self::EN_LANG => 'Completed',
            self::RU_LANG => 'Исполнена',
            self::TR_LANG => 'Tamamlandı',
        ],
        PaymentModel::FAIL_STATUS => [
            self::EN_LANG => 'Failed',
            self::RU_LANG => 'Ошибка',
            self::TR_LANG => 'Başarısız',
        ],
        'Last transactions' => [
            self::RU_LANG => 'Последние операции',
            self::TR_LANG => 'Son işlemler',
        ],
        'Support in Telegram' => [
            self::RU_LANG => 'Техподдержка в Telegram',
            self::TR_LANG => 'Telegram\'da Destek',
        ],
        'Check_price' => [
            self::EN_LANG => 'Check price',
            self::RU_LANG => 'Узнать<br>цену',
            self::TR_LANG => 'Fiyat<br>kontrolü',
        ],
        'Replenish' => [
            self::RU_LANG => 'Пополнить',
            self::TR_LANG => 'Yenilemek',
        ],
        'SUDOKU_amount' => [
            self::EN_LANG => 'Coin quantity',
            self::RU_LANG => 'Количество монет',
            self::TR_LANG => 'Sikke miktarı',
        ],
        'enter_amount' => [
            self::EN_LANG => 'amount',
            self::RU_LANG => '',
            self::TR_LANG => 'fischgte',
        ],
        'Buy_SUDOKU' => [
            self::EN_LANG => 'Buy SUDOKU coins',
            self::RU_LANG => 'Купить монеты' . '{{sudoku_icon_15}}',
            self::TR_LANG => 'Madeni Para Satın Alın' . '{{sudoku_icon_15}}',
        ],
        'The_price' => [
            self::EN_LANG => 'Price offer',
            self::RU_LANG => 'Стоимость монет',
            self::TR_LANG => 'Fiyat teklifi',
        ],
        'calc_price' => [
            self::EN_LANG => 'price',
            self::RU_LANG => 'стоимость',
            self::TR_LANG => 'fiyat',
        ],
        'Pay' => [
            self::EN_LANG => 'Pay',
            self::RU_LANG => 'Оплатить',
            self::TR_LANG => 'Ödeme',
        ],
        'Congratulations to Player' => [
            self::RU_LANG => 'Поздравляем игрока',
            self::TR_LANG => 'Tebrik Ederiz Oyuncumuzu ',
        ],
        'Server sync lost' => [
            self::RU_LANG => 'Потеря синхронизации с сервером',
            self::TR_LANG => 'Sunucu ile senkronizasyon kaybı',
        ],
        'Server connecting error. Please try again' => [
            self::RU_LANG => 'Ошибка связи с сервером. Пожалуйста, повторите',
            self::TR_LANG => 'Sunucu bağlanma hatası. Lütfen tekrar deneyin',
        ],
        'Error changing settings. Try again later' => [
            self::RU_LANG => 'Ошибка. Пожалуйста попробуйте позднее',
            self::TR_LANG => 'Ayarları değiştirirken hata oluştu. Daha sonra tekrar deneyin',
        ],
        'invite_friend_prompt' => [
            SudokuGame::GAME_NAME => [
                self::EN_LANG => 'Join the online game SUDOKU on Telegram! Get the maximum rating, earn coins and withdraw tokens to your wallet',
                self::RU_LANG => 'Присоединяйся к онлайн игре SUDOKU в Telegram! Набери максимальный рейтинг, зарабатывай монеты и выводи токены на кошелек',
                self::TR_LANG => 'Telegram\'da çevrimiçi oyun SUDOKU\'ya katılın! Maksimum puanı alın, jeton kazanın ve jetonları cüzdanınıza çekin',
            ],

            self::EN_LANG => 'Join the online game on Telegram! Get the maximum rating, earn coins and withdraw tokens to your wallet',
            self::RU_LANG => 'Присоединяйся к нашей онлайн игре в Telegram! Набери максимальный рейтинг, зарабатывай монеты и выводи токены на кошелек',
            self::TR_LANG => 'Telegram\'daki çevrimiçi oyuna katılın! Maksimum puanı alın, jeton kazanın ve jetonları cüzdanınıza çekin',
        ],
        'game_bot_url' => [
            SudokuGame::GAME_NAME => [
                self::EN_LANG => 'https://t.me/sudoku_app_bot',
                self::RU_LANG => 'https://t.me/sudoku_app_bot',
                self::TR_LANG => 'https://t.me/sudoku_app_bot',
            ],
            self::EN_LANG => 'https://t.me/sudoku_app_bot',
            self::RU_LANG => 'https://t.me/sudoku_app_bot',
            self::TR_LANG => 'https://t.me/sudoku_app_bot',
        ],
        'loading_text' => [
            self::EN_LANG => 'SUDOKU is loading...',
            self::RU_LANG => 'Загружаем СУДОКУ...',
            self::TR_LANG => 'SUDOKU yükleniyor...',
        ],
        'switch_tg_button' => [
            self::EN_LANG => 'Switch to Telegram',
            self::RU_LANG => 'Перейти на Telegram',
            self::TR_LANG => 'Telegram\'a geç',
        ],
        'Invite a friend' => [
            self::RU_LANG => 'Пригласить друга',
            self::TR_LANG => 'Arkadaş davet et',
        ],
        'you_lost' => [
            self::EN_LANG => 'You lost!',
            self::RU_LANG => 'Вы проиграли!',
            self::TR_LANG => 'Kaybettiniz!',
        ],
        'you_won' => [
            self::EN_LANG => 'You won!',
            self::RU_LANG => 'Вы выиграли!',
            self::TR_LANG => 'Sen kazandın!',
        ],
        '[[Player]] won!' => [
            self::RU_LANG => '[[Player]] выиграл!',
            self::TR_LANG => '[[Player]] kazandı',
        ],
        'start_new_game' => [
            self::EN_LANG => 'Start a new game',
            self::RU_LANG => 'Начните новую игру',
            self::TR_LANG => 'Yeni bir oyun başlatın',
        ],
        'rating_changed' => [
            self::EN_LANG => 'Rating change: ',
            self::RU_LANG => 'Изменение рейтинга: ',
            self::TR_LANG => 'Reyting değişikliği:',
        ],
        'Authorization error' => [
            self::RU_LANG => 'Ошибка авторизации',
            self::TR_LANG => 'Yetkilendirme Hatası',
        ],
        'Error sending message' => [
            self::RU_LANG => 'Ошибка отправки сообщения',
            self::TR_LANG => 'Mesaj gönderilirken hata oluştu',
        ],
        // Рекорды
        'Got reward' => [
            self::RU_LANG => 'Получена награда',
            self::TR_LANG => 'Bir ödül alındı',
        ],
        'Your passive income' => [
            self::RU_LANG => 'Пассивный заработок',
            self::TR_LANG => 'Pasif geliriniz',
        ],
        'will go to the winner' => [
            self::RU_LANG => 'достанется победителю',
            self::TR_LANG => 'kazanana gidecek',
        ],
        'Effect lasts until beaten' => [
            self::RU_LANG => 'Начисляется, пока не перебито',
            self::TR_LANG => 'Etki dövülene kadar sürer',
        ],
        'per_hour' => [
            self::EN_LANG => 'hour',
            self::RU_LANG => 'час',
            self::TR_LANG => 'saat',
        ],
        'rank position' => [
            self::RU_LANG => 'место в рейтинге',
            self::TR_LANG => 'rütbe konum',
        ],
        'record of the year' => [
            self::RU_LANG => 'рекорд года',
            self::TR_LANG => 'yılın rekoru',
        ],
        'record of the month' => [
            self::RU_LANG => 'рекорд месяца',
            self::TR_LANG => 'ayın rekoru',
        ],
        'record of the week' => [
            self::RU_LANG => 'рекорд недели',
            self::TR_LANG => 'haftanin rekoru',
        ],
        'record of the day' => [
            self::RU_LANG => 'рекорд дня',
            self::TR_LANG => 'günün rekoru',
        ],
        'game_price' => [
            self::EN_LANG => 'game points',
            self::RU_LANG => 'очки за игру',
            self::TR_LANG => 'oyun puanları',
        ],
        'games_played' => [
            self::EN_LANG => 'games played',
            self::RU_LANG => 'сыграно партий',
            self::TR_LANG => 'oynanan oyunlar',
        ],
        'Games Played' => [
            self::RU_LANG => 'Партии',
            self::TR_LANG => 'Partiler',
        ],
        'top' => [
            self::RU_LANG => 'топ',
            self::TR_LANG => 'üst',
        ],
        'turn_price' => [
            self::EN_LANG => 'turn points',
            self::RU_LANG => 'очки за ход',
            self::TR_LANG => 'ciro puanları',
        ],
        'word_len' => [
            self::EN_LANG => 'word length',
            self::RU_LANG => 'длинное слово',
            self::TR_LANG => 'uzun kelime',
        ],
        'word_price' => [
            self::EN_LANG => 'word points',
            self::RU_LANG => 'очки за слово',
            self::TR_LANG => 'kelime puanları',
        ],
        UserModel::BALANCE_HIDDEN_FIELD => [
            self::EN_LANG => 'User hidden',
            self::RU_LANG => 'Пользователь скрыт',
            self::TR_LANG => 'Kullanıcı gizli',
        ],
        'top_year' => [
            self::EN_LANG => 'TOP 1',
            self::RU_LANG => 'ТОП 1',
            self::TR_LANG => 'İLK 1',
        ],
        'top_month' => [
            self::EN_LANG => 'TOP 2',
            self::RU_LANG => 'ТОП 2',
            self::TR_LANG => 'İLK 2',
        ],
        'top_week' => [
            self::EN_LANG => 'TOP 3',
            self::RU_LANG => 'ТОП 3',
            self::TR_LANG => 'İLK 3',
        ],
        'top_day' => [
            self::EN_LANG => 'BEST 10',
            self::RU_LANG => 'В десятке лучших',
            self::TR_LANG => 'İlk onda',
        ],
        // Рекорды конец
        'Return to fullscreen mode?' => [
            self::RU_LANG => 'Вернуться в полноэкранный режим?',
            self::TR_LANG => 'Tam ekran moduna dönmek mi?',
        ],
        // Профиль игрока
        'Choose file' => [
            self::RU_LANG => 'Выберите файл',
            self::TR_LANG => 'Dosya seçin',
        ],
        'Back' => [
            self::RU_LANG => 'Назад',
            self::TR_LANG => 'Geri dön',
        ],
        'Wallet' => [
            self::RU_LANG => 'Кошелек',
            self::TR_LANG => 'Çanta',
        ],
        'Referrals' => [
            self::RU_LANG => 'Рефералы',
            self::TR_LANG => 'Sevkler',
        ],
        'Player ID' => [
            self::RU_LANG => 'Номер игрока',
            self::TR_LANG => 'Oyuncu Kimliği',
        ],
        // complaints
        'Player is unbanned' => [
            self::RU_LANG => 'Игрок разблокирован',
            self::TR_LANG => 'Oyuncu engelsiz',
        ],
        'Player`s ban not found' => [
            self::RU_LANG => 'Бан пользователя не найден',
            self::TR_LANG => 'Kullanıcı yasağı bulunamadı',
        ],
        'Player not found' => [
            self::RU_LANG => 'Пользователь не найден',
            self::TR_LANG => 'Kullanıcı bulunamadı',
        ],
        // end complaints
        'Save' => [
            self::RU_LANG => 'Сохранить',
            self::TR_LANG => 'Kaydet',
        ],
        'new nickname' => [
            self::RU_LANG => 'новый Ник',
            self::TR_LANG => 'yeni takma ad',
        ],
        'Input new nickname' => [
            self::RU_LANG => 'Задайте новый ник',
            self::TR_LANG => 'Yeni takma ad girin',
        ],
        'Your rank' => [
            self::RU_LANG => 'Ваш Рейтинг',
            self::TR_LANG => 'Rütbeniz',
        ],
        'Ranking number' => [
            self::RU_LANG => 'Позиция в ТОП',
            self::TR_LANG => 'ÜST pozisyon',
        ],
        'Balance' => [
            self::RU_LANG => 'Баланс',
            self::TR_LANG => 'Denge',
        ],
        'Rating by coins' => [
            self::RU_LANG => 'Рейтинг по монетам',
            self::TR_LANG => 'Sikke sıralaması',
        ],
        'Secret key' => [
            self::EN_LANG => 'Secret key&#42;',
            self::RU_LANG => 'Ключ&#42; восстановления',
            self::TR_LANG => 'Gizli anahtar&#42;',
        ],
        'Link' => [
            self::RU_LANG => 'Привязать',
            self::TR_LANG => 'Bağlama',
        ],
        'Bonuses accrued' => [
            self::RU_LANG => 'Начислено бонусов',
            self::TR_LANG => 'Tahakkuk eden primler',
        ],
        'SUDOKU Balance' => [
            self::RU_LANG => 'Баланс SUDOKU',
            self::TR_LANG => 'SUDOKU bilançosu',
        ],
        'Claim' => [
            self::RU_LANG => 'Забрать',
            self::TR_LANG => 'İddia',
        ],
        'Name' => [
            self::RU_LANG => 'Имя',
            self::TR_LANG => 'İsim',
        ],
        // Профиль игрока конец

        'Nickname updated' => [
            self::RU_LANG => 'Ник пользователя сохранен',
            self::TR_LANG => 'Takma ad güncellendi',
        ],
        'Stats getting error' => [
            self::RU_LANG => 'Ошибка загрузки статистики',
            self::TR_LANG => 'İstatistikler yüklenirken hata oluştu',
        ],
        'Error saving Nick change' => [
            self::RU_LANG => 'Ошибка сохранения Ника!',
            self::TR_LANG => 'Nick\'in kurtarma hatası',
        ],
        'Play at least one game to view statistics' => [
            self::RU_LANG => 'Для просмотра статистики сыграйте хотя бы одну партию',
            self::TR_LANG => 'İstatistikleri görüntülemek için en az bir oyun oynayın',
        ],
        'Lost server synchronization' => [
            'Потеря синхронизации с сервером',
            self::TR_LANG => 'Kayıp sunucu senkronizasyonu',
        ],
        'Closed game window' => [
            self::RU_LANG => 'Закрыл вкладку с игрой',
            self::TR_LANG => 'Kapalı oyun penceresi',
        ],
        'You closed the game window and became inactive!' => [
            self::RU_LANG => 'Вы закрыли вкладку с игрой и стали Неактивным!',
            self::TR_LANG => 'Oyun penceresini kapattınız ve devre dışı kaldınız!',
        ],
        'Request denied. Game is still ongoing' => [
            self::RU_LANG => 'Запрос отклонен. Игра еще продолжается',
            self::TR_LANG => 'Talep reddedildi. Oyun hala devam ediyor',
        ],
        'Request rejected' => [
            self::RU_LANG => 'Запрос отклонен',
            self::TR_LANG => 'Talep reddedildi',
        ],
        'No messages yet' => [
            self::RU_LANG => 'Сообщений пока нет',
            self::TR_LANG => 'Henüz mesaj yok',
        ],
        'New game request sent' => [
            self::RU_LANG => 'Запрос на новую игру отправлен',
            self::TR_LANG => 'Yeni bir oyun için talep gönderildi',
        ],
        'Your new game request awaits players response' => [
            self::RU_LANG => 'Ваш запрос на новую игру ожидает ответа игроков',
            self::TR_LANG => 'Yeni oyun talebiniz oyuncuların yanıtını bekliyor',
        ],
        'Request was aproved! Starting new game' => [
            self::RU_LANG => 'Запрос принят! Начинаем новую игру',
            self::TR_LANG => 'İstek onaylandı! Yeni oyuna başlıyorum',
        ],
        'Default avatar is used' => [
            self::RU_LANG => 'Используется аватар по умолчанию',
            self::TR_LANG => 'Varsayılan avatar kullanılır',
        ],
        'Avatar by provided link' => [
            self::RU_LANG => "Аватар по предоставленной ссылке",
            self::TR_LANG => 'Verilen bağlantıya göre avatar',
        ],
        'Set' => [
            self::RU_LANG => 'Задать',
            self::TR_LANG => 'Ayarla',
        ],
        'Avatar loading' => [
            self::RU_LANG => 'Загрузка Аватара',
            self::TR_LANG => 'Avatar yükleniyor',
        ],
        'Send' => [
            self::RU_LANG => 'Отправить',
            self::TR_LANG => 'Gönder',
        ],
        'Avatar URL' => [
            self::RU_LANG => 'URL аватара',
            self::TR_LANG => 'Avatar URL\'si',
        ],
        'Apply' => [
            self::RU_LANG => 'Применить',
            self::TR_LANG => 'Başvurmak',
        ],
        'Account key' => [
            self::RU_LANG => 'Ключ учетной записи',
            self::TR_LANG => 'Hesap anahtarı',
        ],
        'Main account key' => [
            self::RU_LANG => 'Ключ основного аккаунта',
            self::TR_LANG => 'Birincil hesap anahtarı',
        ],
        'old account saved key' => [
            self::RU_LANG => 'сохраненный ключ от старого аккаунта',
            self::TR_LANG => 'eski hesaptan kaydedilmiş anahtar',
        ],
        'Key transcription error' => [
            self::RU_LANG => 'Ошибка расшифровки ключа',
            self::TR_LANG => 'Anahtar şifre çözme hatası',
        ],
        "Player's ID NOT found by key" => [
            self::RU_LANG => 'ID игрока по ключу НЕ найден',
            self::TR_LANG => 'Anahtara göre oyuncu kimliği bulunamadı',
        ],
        'Accounts linked' => [
            self::RU_LANG => 'Учетные записи связаны',
            self::TR_LANG => 'Hesaplar birbirine bağlıdır',
        ],
        'Accounts are already linked' => [
            self::RU_LANG => 'Аккаунты уже связаны',
            self::TR_LANG => 'Hesaplar zaten bağlı',
        ],
        'Game is not started' => [
            self::RU_LANG => 'Игра не начата',
            self::TR_LANG => 'Oyun başlatılmadı',
        ],
        'Click to expand the image' => [
            self::RU_LANG => 'Кликните для увеличения изображения'
        ],
        'Report sent' => [
            self::RU_LANG => 'Отправлена жалоба'
        ],
        'Report declined! Please choose a player from the list' => [
            self::RU_LANG => 'Жалоба не принята! Пожалуйста, выберите игрока из списка'
        ],
        'Your report accepted and will be processed by moderator' => [
            self::RU_LANG => 'Ваше обращение принято и будет рассмотрено модератором'
        ],
        'If confirmed, the player will be banned' => [
            self::RU_LANG => 'В случае подтверждения к игроку будут применены санкции'
        ],
        'Report declined!' => [
            self::RU_LANG => 'Ваше обращение НЕ принято!'
        ],
        'Only one complaint per each player per day can be sent. Total 24 hours complaints limit is' => [
            self::RU_LANG => 'В течение суток можно отправлять только одну жалобу на одного и того же игрока. Всего за сутки не более'
        ],
        'From player' => [
            self::RU_LANG => 'От Игрока'
        ],
        'To Player' => [
            self::RU_LANG => 'Игроку'
        ],
        'Awaiting invited players' => [
            self::RU_LANG => 'Ожидаем приглашенных игроков'
        ],
        'Searching for players' => [
            self::RU_LANG => 'Ожидаем игроков'
        ],
        'Searching for players with selected rank' => [
            self::RU_LANG => 'Поиск игрока с указанным рейтингом'
        ],
        'Message NOT sent - BAN until ' => [
            self::RU_LANG => 'Сообщение НЕ отправлено - БАН до '
        ],
        'Message NOT sent - BAN from Player' => [
            self::RU_LANG => 'Сообщение НЕ отправлено - БАН от Игрока'
        ],
        'Message sent' => [
            self::RU_LANG => 'Сообщение отправлено'
        ],
        'Exit' => [
            self::RU_LANG => 'Выход'
        ],
        'Appeal' => [
            self::RU_LANG => 'Пожаловаться'
        ],
        'There are no events yet' => [
            self::RU_LANG => 'Событий пока нет'
        ],
        'Playing to' => [
            self::RU_LANG => 'Играем до'
        ],
        'Just two players' => [
            self::RU_LANG => 'Только два игрока'
        ],
        'Up to four players' => [
            self::RU_LANG => 'До четырех игроков'
        ],
        'Game selection - please wait' => [
            self::RU_LANG => 'Подбор игры - ожидайте'
        ],
        'Your turn!' => [
            self::RU_LANG => 'Ваш ход!'
        ],
        'Looking for a new game...' => [
            self::RU_LANG => 'Подбор игры!'
        ],
        'Get ready - your turn is next!' => [
            self::RU_LANG => 'Приготовьтесь - Ваш ход следующий!'
        ],
        'Take a break - your move in one' => [
            self::RU_LANG => 'Отдохните - Ваш ход через один'
        ],
        'Refuse' => [
            self::RU_LANG => 'Отказаться'
        ],
        'Offer a game' => [
            self::RU_LANG => 'Предложить игру'
        ],
        'Players ready:' => [
            self::RU_LANG => 'Готово играть:'
        ],
        'Players' => [
            self::RU_LANG => 'Игроки'
        ],
        'Try sending again' => [
            self::RU_LANG => 'Попробуйте отправить заново'
        ],
        'Error connecting to server!' => [
            self::RU_LANG => 'Ошибка связи с сервером!'
        ],
        'You haven`t composed a single word!' => [
            self::RU_LANG => 'Вы не составили ни одного слова!'
        ],
        'You will lose if you quit the game! CONTINUE?' => [
            self::RU_LANG => 'Вы проиграете, если выйдете из игры! ПРОДОЛЖИТЬ?'
        ],
        'Cancel' => [
            self::RU_LANG => 'Отмена'
        ],
        'Confirm' => [
            self::RU_LANG => 'Подтвердить'
        ],
        'Revenge!' => [
            self::RU_LANG => 'Реванш!'
        ],
        'Time elapsed:' => [
            self::RU_LANG => 'Время подбора:'
        ],
        'Time limit:' => [
            self::RU_LANG => 'Лимит по времени:'
        ],
        'You can start a new game if you wait for a long time' => [
            self::RU_LANG => 'Вы можете начать новую игру, если долго ждать..'
        ],
        'Close in 5 seconds' => [
            self::RU_LANG => 'Закрывать через 5 секунд'
        ],
        'Close immediately' => [
            self::RU_LANG => 'Закрывать сразу'
        ],
        'Will close automatically' => [
            self::RU_LANG => 'Закроется автоматически'
        ],
        's' => [
            self::RU_LANG => 'с'
        ],
        'Average waiting time:' => [
            self::RU_LANG => 'Среднее время ожидания:'
        ],
        'Waiting for other players' => [
            self::RU_LANG => 'Поиск других игроков'
        ],
        'Game goal' => [
            self::RU_LANG => 'Игра до'
        ],
        'Rating of opponents' => [
            self::RU_LANG => 'Рейтинг соперников'
        ],
        'new player' => [
            self::RU_LANG => 'новый игрок'
        ],
        'CHOOSE GAME OPTIONS' => [
            self::RU_LANG => 'ПОДБОР ИГРЫ ПО ПАРАМЕТРАМ'
        ],
        'Profile' => [
            self::RU_LANG => 'Профиль'
        ],
        'Error' => [
            self::RU_LANG => 'Ошибка'
        ],
        'Your profile' => [
            self::RU_LANG => 'Ваш профиль'
        ],
        'Start' => [
            self::RU_LANG => 'Начать'
        ],
        'Stats' => [
            self::RU_LANG => 'Статистика'
        ],
        'Play on' => [
            self::RU_LANG => 'Играть в'
        ],
        // Чат
        'Error sending complaint<br><br>Choose opponent' => [
            self::RU_LANG => 'Ошибка отправки жалобы<br><br>Выберите игрока'
        ],
        'You' => [
            self::RU_LANG => 'Вы'
        ],
        'to all: ' => [
            self::RU_LANG => 'всем: '
        ],
        ' (to all):' => [
            self::RU_LANG => ' (всем):'
        ],
        'For everyone' => [
            self::RU_LANG => 'Для всех'
        ],
        'Word matching' => [
            self::RU_LANG => 'Подбор слов'
        ],
        'Player support and chat at' => [
            self::RU_LANG => 'Поддержка и чат игроков в'
        ],
        'Join group' => [
            self::RU_LANG => 'Вступить в группу'
        ],
        'Send an in-game message' => [
            self::RU_LANG => 'Отправьте сообщение в игре'
        ],
        // Чат
        'News' => [
            self::RU_LANG => 'Новости:'
        ],
        // Окно статистика
        'Past Awards' => [
            self::RU_LANG => 'Прошлые награды'
        ],
        'Parties_Games' => [
            self::EN_LANG => 'Games',
            self::RU_LANG => 'Партии'
        ],
        'Player`s achievements' => [
            self::RU_LANG => 'Достижения игрока'
        ],
        'Player Awards' => [
            self::RU_LANG => 'Награды игрока'
        ],
        'Player' => [
            self::RU_LANG => 'Игрок'
        ],
        'VS' => [
            self::RU_LANG => 'Против'
        ],
        'Rating' => [
            self::RU_LANG => 'Рейтинг'
        ],
        'Opponent' => [
            self::RU_LANG => 'Соперник'
        ],
        'Active Awards' => [
            self::RU_LANG => 'Награды'
        ],
        'Remove filter' => [
            self::RU_LANG => 'Снять фильтр'
        ],
        // Окно статистика конец

        "Opponent's rating" => [
            self::RU_LANG => 'Рейтинг соперника'
        ],
        'Choose your MAX bet' => [
            self::RU_LANG => 'Выберите максимальную ставку'
        ],
        'Searching for players with corresponding bet' => [
            self::RU_LANG => 'Подбор игроков с соответствующей ставкой'
        ],
        'Coins written off the balance sheet' => [
            self::RU_LANG => 'Списано монет с баланса'
        ],
        'Number of coins on the line' => [
            self::RU_LANG => 'Количество монет на кону'
        ],
        'gets a win' => [
            self::RU_LANG => 'получает за победу'
        ],
        'The bank of' => [
            self::RU_LANG => 'Банк в размере'
        ],
        'goes to you' => [
            self::RU_LANG => 'достается вам'
        ],
        'is taken by the opponent' => [
            self::RU_LANG => 'забирает противник'
        ],
        'Bid' => [
            self::RU_LANG => 'Ставка'
        ],
        'No coins' => [
            self::RU_LANG => 'Без монет'
        ],
        'Any' => [
            self::RU_LANG => 'Любой'
        ],
        'online' => [
            self::RU_LANG => 'онлайн'
        ],
        'Above' => [
            self::RU_LANG => 'OT'
        ],
        'minutes' => [
            self::RU_LANG => 'минуты'
        ],
        'minute' => [
            self::RU_LANG => 'минута'
        ],
        'Select the minimum opponent rating' => [
            self::RU_LANG => 'Выберите минимальный рейтинг соперников'
        ],
        'Not enough 1900+ rated players online' => [
            self::RU_LANG => 'Недостаточно игроков с рейтингом 1900+ онлайн'
        ],
        'Only for players rated 1800+' => [
            self::RU_LANG => 'Только для игроков с рейтингом 1800+'
        ],
        'in game' => [
            self::RU_LANG => 'в игре'
        ],
        "score" => [
            self::RU_LANG => 'очков'
        ],
        'Your current rank' => [
            self::RU_LANG => 'Ваш текущий рейтинг'
        ],
        'Server syncing..' => [
            self::RU_LANG => 'Синхронизируемся с сервером..'
        ],
        ' is making a turn.' => [
            self::RU_LANG => ' ходит.'
        ],
        'Your turn is next - get ready!' => [
            self::RU_LANG => 'Ваш ход следующий - приготовьтесь!'
        ],
        'switches pieces and skips turn' => [
            self::RU_LANG => 'меняет фишки и пропускает ход'
        ],
        "Game still hasn't started!" => [
            self::RU_LANG => 'Игра еще не начата!'
        ],
        "Word wasn't found" => [
            self::RU_LANG => 'Слово не найдено'
        ],
        'Correct' => [
            self::RU_LANG => 'Корректно'
        ],
        'One-letter word' => [
            self::RU_LANG => 'Слово из одной буквы'
        ],
        'Repeat' => [
            self::RU_LANG => 'Повтор'
        ],
        'costs' => [
            self::RU_LANG => 'стоимость'
        ],
        '+15 for all pieces used' => [
            self::RU_LANG => '+15 за все фишки'
        ],
        'TOTAL' => [
            self::RU_LANG => 'ИТОГО'
        ],
        'You did not make any word' => [
            self::RU_LANG => 'Вы не составили ни одного слова'
        ],
        'is attempting to make a turn out of his turn (turn #' => [
            self::RU_LANG => 'пытается сделать ход не в свою очередь (ход #'
        ],
        'Data processing error!' => [
            self::RU_LANG => 'Ошибка обработки данных!'
        ],
        ' - turn processing error (turn #' => [
            self::RU_LANG => ' - ошибка обработки хода (ход #'
        ],
        "didn't make any word (turn #" => [
            self::RU_LANG => 'не составил ни одного слова (ход #'
        ],
        'set word lenght record for' => [
            self::RU_LANG => 'устанавливает рекорд по длине слова за'
        ],
        'set word cost record for' => [
            self::RU_LANG => 'устанавливает рекорд по стоимости слова за'
        ],
        'set record for turn cost for' => [
            self::RU_LANG => 'устанавливает рекорд по стоимости хода за'
        ],
        'gets' => [
            self::RU_LANG => 'зарабатывает'
        ],
        'for turn #' => [
            self::RU_LANG => 'за ход #'
        ],
        'For all pieces' => [
            self::RU_LANG => 'За все фишки'
        ],
        'Wins with score ' => [
            self::RU_LANG => 'Побеждает со счетом '
        ],
        'set record for gotten points in the game for' => [
            self::RU_LANG => "устанавливает рекорд набранных очков в игре за"
        ],
        'out of chips - end of game!' => [
            self::RU_LANG => 'закончились фишки - конец игры!'
        ],
        'set record for number of games played for' => [
            self::RU_LANG => 'устанавливает рекорд по числу сыгранных партий за'
        ],
        'is the only one left in the game - Victory!' => [
            self::RU_LANG => 'остался в игре один - Победа!'
        ],
        'left game' => [
            self::RU_LANG => 'покинул игру'
        ],
        'has left the game' => [
            self::RU_LANG => 'покинул игру'
        ],
        'is the only one left in the game! Start a new game' => [
            self::RU_LANG => 'остался в игре один! Начните новую игру'
        ],
        'Time for the turn ran out' => [
            self::RU_LANG => 'Время хода истекло'
        ],
        "is left without any pieces! Winner - " => [
            self::RU_LANG => 'остался без фишек! Победитель - '
        ],
        ' with score ' => [
            self::RU_LANG => ' со счетом '
        ],
        "is left without any pieces! You won with score " => [
            self::RU_LANG => 'остался без фишек! Вы победили со счетом '
        ],
        "gave up! Winner - " => [
            self::RU_LANG => 'сдался. Победитель - '
        ],
        'skipped 3 turns! Winner - ' => [
            self::RU_LANG => 'пропустил 3 хода! Победитель - '
        ],
        'New game has started!' => [
            self::RU_LANG => 'Новая игра начата!'
        ],
        'New game' => [
            self::RU_LANG => 'Новая игра'
        ],
        'Accept invitation' => [
            self::RU_LANG => 'Принять приглашение'
        ],
        'Get' => [
            self::RU_LANG => 'Набери'
        ],
        'score points' => [
            self::RU_LANG => 'очков'
        ],

        "Asking for adversaries' approval." => [
            self::RU_LANG => "Запрашиваем подтверждение соперников."
        ],
        'Remaining in the game:' => [
            self::RU_LANG => 'В игре осталось:'
        ],
        "You got invited for a rematch! - Accept?" => [
            self::RU_LANG => 'Вас пригласили на Реванш - Согласны?'
        ],
        'All players have left the game' => [
            self::RU_LANG => 'Все игроки покинули игру'
        ],
        "Your score" => [
            self::RU_LANG => 'Ваши очки:'
        ],
        "Turn time" => [
            self::RU_LANG => "Время на ход"
        ],
        'Date' => [
            self::RU_LANG => 'Дата'
        ],
        'Price' => [
            self::RU_LANG => 'Сумма'
        ],
        'Status' => [
            self::RU_LANG => 'Статус'
        ],
        'Type' => [
            self::RU_LANG => 'Тип'
        ],
        'Period' => [
            self::RU_LANG => 'Период'
        ],
        'Word' => [
            self::RU_LANG => 'Слово'
        ],
        'Points/letters' => [
            self::RU_LANG => 'Очков/букв'
        ],
        'Result' => [
            self::RU_LANG => 'Результат'
        ],
        'Opponents' => [
            self::RU_LANG => 'Оппоненты'
        ],
        'Games<br>total' => [
            self::RU_LANG => 'Всего<br>партий',
        ],
        'Wins<br>total' => [
            self::RU_LANG => 'Всего<br>побед',
        ],
        'Gain/loss<br>in ranking' => [
            self::RU_LANG => 'Прибавка/потеря<br>в рейтинге',
        ],
        '% Wins' => [
            self::RU_LANG => '% Побед',
        ],
        'Games in total' => [
            self::RU_LANG => 'Всего партий'
        ],
        'Winnings count' => [
            self::RU_LANG => 'Всего побед'
        ],
        'Increase/loss in rating' => [
            self::RU_LANG => 'Прибавка/потеря в рейтинге'
        ],
        '% of wins' => [
            self::RU_LANG => '% побед'
        ],
        "GAME points - Year Record!" => [
            self::RU_LANG => 'Очки за ИГРУ - Рекорд Года!'
        ],
        "GAME points - Month Record!" => [
            self::RU_LANG => 'Очки за ИГРУ - Рекорд Месяца!'
        ],
        "GAME points - Week Record!" => [
            self::RU_LANG => 'Очки за ИГРУ - Рекорд Недели!'
        ],
        "GAME points - Day Record!" => [
            self::RU_LANG => 'Очки за ИГРУ - Рекорд Дня!'
        ],
        "TURN points - Year Record!" => [
            self::RU_LANG => 'Очки за ХОД - Рекорд Года!'
        ],
        "TURN points - Month Record!" => [
            self::RU_LANG => 'Очки за ХОД - Рекорд Месяца!'
        ],
        "TURN points - Week Record!" => [
            self::RU_LANG => 'Очки за ХОД - Рекорд Недели!'
        ],
        "TURN points - Day Record!" => [
            self::RU_LANG => 'Очки за ХОД - Рекорд Дня!'
        ],
        "WORD points - Year Record!" => [
            self::RU_LANG => 'Очки за СЛОВО - Рекорд Года!'
        ],
        "WORD points - Month Record!" => [
            self::RU_LANG => 'Очки за СЛОВО - Рекорд Месяца!'
        ],
        "WORD points - Week Record!" => [
            self::RU_LANG => 'Очки за СЛОВО - Рекорд Недели!'
        ],
        "WORD points - Day Record!" => [
            self::RU_LANG => 'Очки за СЛОВО - Рекорд Дня!'
        ],
        "Longest WORD - Year Record!" => [
            self::RU_LANG => 'Самое длинное СЛОВО - Рекорд Года!'
        ],
        "Longest WORD - Month Record!" => [
            self::RU_LANG => 'Самое длинное СЛОВО - Рекорд Месяца!'
        ],
        "Longest WORD - Week Record!" => [
            self::RU_LANG => 'Самое длинное СЛОВО - Рекорд Недели!'
        ],
        "Longest WORD - Day Record!" => [
            self::RU_LANG => 'Самое длинное СЛОВО - Рекорд Дня!'
        ],
        "GAMES played - Year Record!" => [
            self::RU_LANG => 'Сыграно ПАРТИЙ - Рекорд Года!'
        ],
        "GAMES played - Month Record!" => [
            self::RU_LANG => 'Сыграно ПАРТИЙ - Рекорд Месяца!'
        ],
        "GAMES played - Week Record!" => [
            self::RU_LANG => 'Сыграно ПАРТИЙ - Рекорд Недели!'
        ],
        "GAMES played - Day Record!" => [
            self::RU_LANG => 'Сыграно ПАРТИЙ - Рекорд Дня!'
        ],
        "Victory" => [
            self::RU_LANG => 'Победа'
        ],
        'Losing' => [
            self::RU_LANG => 'Проигрыш'
        ],
        "Go to player's stats" => [
            self::RU_LANG => 'Перейти к статистике игрока'
        ],
        'Filter by player' => [
            self::RU_LANG => 'Фильтровать по игроку'
        ],
        'Apply filter' => [
            self::RU_LANG => 'Фильтровать'
        ],
        'against' => [
            self::RU_LANG => 'против игрока'
        ],
        "File loading error!" => [
            self::RU_LANG => 'Ошибка загрузки файла!'
        ],
        "Check:" => [
            self::RU_LANG => 'Проверьте:'
        ],
        "file size (less than " => [
            self::RU_LANG => 'размер файла (не более '
        ],
        "resolution - " => [
            self::RU_LANG => 'разрешение - '
        ],
        "Incorrect URL format!" => [
            self::RU_LANG => 'Неверный формат URL!'
        ],
        "Must begin with " => [
            self::RU_LANG => 'Должно начинаться с '
        ],
        'Error! Choose image file with the size not more than' => [
            self::RU_LANG => 'Ошибка! Выберите файл-картинку размером не более'
        ],
        'Avatar updated' => [
            self::RU_LANG => 'Аватар обновлен'
        ],
        "Error saving new URL" => [
            self::RU_LANG => 'Ошибка сохранения нового URL'
        ],
        'A player may open more than one cell and more than one KEY in one turn. Use the CASCADES rule' => [
            self::RU_LANG => 'За один ход игрок может открыть несколько ячеек и несколько КЛЮЧЕЙ. Пользуйтесь правилом КАСКАДОВ'
        ],
        'If after the automatic opening of a number, new blocks of EIGHT open cells are formed on the field, such blocks are also opened by CASCADE' => [
            self::RU_LANG => 'Если после автоматического открытия числа на поле образуются новые блоки из ВОСЬМИ открытых ячеек, то такие блоки также открываются КАСКАДОМ'
        ],
        'If a player has opened a cell (solved a number in it) and there is only ONE closed digit left in the block, this digit is opened automatically' => [
            self::RU_LANG => 'Если игрок открыл ячейку (разгадал число в ней) и в блоке осталась только ОДНА закрытая цифра, то такая цифра открывается автоматически'
        ],
        'is awarded for solved empty cell' => [
            self::RU_LANG => 'начисляется за открытую цифру'
        ],
        'by calculating all of other 8 digits in a block - vertically OR horizontally OR in a 3x3 square' => [
            self::RU_LANG => ', вычислив все остальные 8 цифр в блоке - по вертикали ИЛИ по горизонтали ИЛИ в квадрате 3х3'
        ],
        "The players' task is to take turns making moves and accumulating points to open black squares" => [
            self::RU_LANG => 'Задача игроков - делая ходы по очереди и накапливая очки, открывать черные квадраты'
        ],
        'The classic SUDOKU rules apply - in a block of nine cells (vertically, horizontally and in a 3x3 square) the numbers must not be repeated' => [
            self::RU_LANG => 'Действуют классические правила СУДОКУ - в блоке из девяти ячеек (по вертикали, по горизонтали и в квадрате 3х3) цифры не должны повторяться'
        ],
        'faq_rules' => [
            SudokuGame::GAME_NAME => [
                self::EN_LANG => Faq::RULES[self::EN_LANG],
                self::RU_LANG => Faq::RULES[self::RU_LANG],
            ],
        ],
        'faq_rating' => [
            self::EN_LANG => Faq::RATING[self::EN_LANG],
            self::RU_LANG => Faq::RATING[self::RU_LANG],
        ],
        'faq_rewards' => [
            self::EN_LANG => Faq::REWARDS[self::EN_LANG],
            self::RU_LANG => Faq::REWARDS[self::RU_LANG],
        ],
        'Reward' => [
            self::RU_LANG => 'Награда'
        ],
        'faq_coins' => [
            self::EN_LANG => Faq::COINS[self::EN_LANG],
            self::RU_LANG => Faq::COINS[self::RU_LANG],
        ],
        '[[Player]] opened [[number]] [[cell]]' => [
            self::RU_LANG => '[[Player]] открыл [[number]] [[cell]]'
        ],
        ' (including [[number]] [[key]])' => [
            self::RU_LANG => ' (включая [[number]] [[key]])'
        ],
        '[[Player]] made a mistake' => [
            self::RU_LANG => '[[Player]] ошибся'
        ],
        'You made a mistake!' => [
            self::RU_LANG => 'Вы допустили ошибку!'
        ],
        'Your opponent made a mistake' => [
            self::RU_LANG => 'Ваш оппонент допустил ошибку'
        ],
        '[[Player]] gets [[number]] [[point]]' => [
            self::RU_LANG => '[[Player]] получает [[number]] [[point]]'
        ],
        'You got [[number]] [[point]]' => [
            self::RU_LANG => 'Вы заработали [[number]] [[point]]!'
        ],
        'Your opponent got [[number]] [[point]]' => [
            self::RU_LANG => 'Ваш противник заработал [[number]] [[point]]'
        ],
    ];

    public static function translit(string $text, bool $fromRU = true)
    {
        $cyr = [
            'а',
            'б',
            'в',
            'г',
            'д',
            'е',
            'ё',
            'ж',
            'з',
            'и',
            'й',
            'к',
            'л',
            'м',
            'н',
            'о',
            'п',
            'р',
            'с',
            'т',
            'у',
            'ф',
            'х',
            'ц',
            'ч',
            'ш',
            'щ',
            'ъ',
            'ы',
            'ь',
            'э',
            'ю',
            'я',
            'А',
            'Б',
            'В',
            'Г',
            'Д',
            'Е',
            'Ё',
            'Ж',
            'З',
            'И',
            'Й',
            'К',
            'Л',
            'М',
            'Н',
            'О',
            'П',
            'Р',
            'С',
            'Т',
            'У',
            'Ф',
            'Х',
            'Ц',
            'Ч',
            'Ш',
            'Щ',
            'Ъ',
            'Ы',
            'Ь',
            'Э',
            'Ю',
            'Я'
        ];
        $lat = [
            'a',
            'b',
            'v',
            'g',
            'd',
            'e',
            'io',
            'zh',
            'z',
            'i',
            'y',
            'k',
            'l',
            'm',
            'n',
            'o',
            'p',
            'r',
            's',
            't',
            'u',
            'f',
            'h',
            'ts',
            'ch',
            'sh',
            'sht',
            'a',
            'i',
            'y',
            'e',
            'yu',
            'ya',
            'A',
            'B',
            'V',
            'G',
            'D',
            'E',
            'Io',
            'Zh',
            'Z',
            'I',
            'Y',
            'K',
            'L',
            'M',
            'N',
            'O',
            'P',
            'R',
            'S',
            'T',
            'U',
            'F',
            'H',
            'Ts',
            'Ch',
            'Sh',
            'Sht',
            'A',
            'I',
            'Y',
            'e',
            'Yu',
            'Ya'
        ];
        if ($fromRU) {
            $text = str_replace($cyr, $lat, $text);
        }

        return $text;
    }

    const PLURALS = [
        'point' => [
            self::EN_LANG => [0 => 'points', 1 => 'point', 2 => 'points'],
            self::RU_LANG => [0 => 'очков', 1 => 'очко', 2 => 'очка', 5 => 'очков']
        ],
        'cell' => [
            self::EN_LANG => [0 => 'cells', 1 => 'cell', 2 => 'cells'],
            self::RU_LANG => [0 => 'клеток', 1 => 'клетку', 2 => 'клетки', 5 => 'клеток']
        ],
        'key' => [
            self::EN_LANG => [0 => 'keys', 1 => 'key', 2 => 'keys'],
            self::RU_LANG => [0 => 'ключей', 1 => 'ключ', 2 => 'ключа', 5 => 'ключей']
        ],
        'Player' => [
            self::EN_LANG => [1 => 'Player1', 2 => 'Player2', 3 => 'Player3', 4 => 'Player4'],
            self::RU_LANG => [1 => 'Игрок1', 2 => 'Игрок2', 3 => 'Игрок3', 4 => 'Игрок4'],
            self::TR_LANG => [1 => 'Oyuncu1', 2 => 'Oyuncu2', 3 => 'Oyuncu3', 4 => 'Oyuncu1'],
        ],
    ];

    /**
     * @param string $res
     * @param array $params
     * @param string $lang Язык указываем явно для комментов пользователям на разных языках
     * @return string
     */
    private static function applyPlurals(string $res, array $params, string $lang): string
    {
        preg_match_all('/\[\[([a-zA-Z]+)]]/', $res, $matches);

        try {
            foreach ($matches[1] as $num => $value) {
                if (is_callable([self::class, $value . 'Plural'])) {
                    $wordReplace = call_user_func([self::class, $value . 'Plural'], $params[$num]);
                } else {
                    // Для разных языков и количества делаем отдельную поправку на расчетное количество
                    $numPlural = $lang === self::EN_LANG
                        ? $params[$num]
                        : (
                        ($params[$num] % 100) < 20
                            ? ($params[$num] % 20)
                            : ($params[$num] % 10)
                        );
                    for ($i = $numPlural; $i >= 0; $i--) {
                        if (isset(self::PLURALS[$value][$lang][$i])) {
                            $wordReplace = self::PLURALS[$value][$lang][$i];

                            break;
                        }
                    }
                }

                $res = str_replace("[[$value]]", $wordReplace ?? $value, $res);
            }
        } catch (\Throwable $e) {
            $res = $e->__toString();
        }

        return $res;
    }

    protected static function numberPlural(int $number): string
    {
        return (string)$number;
    }
}