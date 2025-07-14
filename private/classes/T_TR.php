<?php

namespace classes;

use PaymentModel;
use BaseController as BC;
use UserModel;

class T_TR
{


    const PHRASES = [
        'Click to expand the image' => 'Resmi büyütmek için tıklayın',
        'Report sent' => 'Rapor gönderildi',
        'Report declined! Please choose a player from the list' => 'Rapor reddedildi! Lütfen listeden bir oyuncu seçin',
        'Your report accepted and will be processed by moderator' => 'Raporunuz kabul edildi ve moderatör tarafından işleme alınacak',
        'If confirmed, the player will be banned' => 'Onaylanırsa, oyuncu yasaklanacaktır',
        'Report declined!' => 'Rapor reddedildi!',
        'Only one complaint per each player per day can be sent. Total 24 hours complaints limit is' => 'Her oyuncu için günde sadece bir şikayet gönderilebilir. Toplam 24 saatlik şikayet limiti',
        'From player' => 'Bir oyuncudan',
        'To Player' => '>> oyuncu',
        'Awaiting invited players' => 'Davet edilen oyuncular bekleniyor',
        'Searching for players' => 'Oyuncuları bekliyoruz',
        'Searching for players with selected rank' => 'Belirtilen derecelendirmeye sahip bir oyuncu arayın',
        'Message NOT sent - BAN until ' => 'Mesaj gönderilmedi - yasaklanana kadar',
        'Message NOT sent - BAN from Player' => 'Mesaj Gönderilmedi - BAN Bir Oyuncudan',
        'Message sent' => 'Mesaj gönderildi',
        'Exit' => 'Çıkış',
        'Appeal' => 'İtiraz',
        'There are no events yet' => 'Henüz etkinlik yok',
        'Playing to' => 'Oynamak için:',
        'Just two players' => 'Sadece iki oyuncu',
        'Up to four players' => 'Dört oyuncuya kadar',
        'Game selection - please wait' => 'Oyun seçimi - lütfen bekleyin',
        'Your turn!' => 'Bu senin hamlen!',
        'Looking for a new game...' => 'Yeni bir oyun arıyorum...',
        'Get ready - your turn is next!' => 'Hazır olun - sıra sizde!',
        'Take a break - your move in one' => 'Mola verin - tek hamlede hareketiniz',
        'Refuse' => 'Çöp',
        'Offer a game' => 'Bir oyun önerin',
        'Players ready:' => 'Oyuncular hazır:',
        'Players' => 'Oyuncular',
        'Try sending again' => 'Yeniden göndermeyi deneyin',
        'Error connecting to server!' => 'Sunucuya bağlanırken hata oluştu!',
        'You haven`t composed a single word!' => 'Tek bir kelime bile yazmadınız!',
        'You will lose if you quit the game! CONTINUE?' => 'Oyunu bırakırsanız kaybedersiniz! DEVAM MI?',
        'Cancel' => 'İptal',
        'Confirm' => 'Onaylayın',
        'Revenge!' => 'Rövanş!',
        'Time elapsed:' => 'Geçen zaman:',
        'Time limit:' => 'Zaman sınırı:',
        'You can start a new game if you wait for a long time' => 'Uzun süre beklerseniz yeni bir oyun başlatabilirsiniz',
        'Close in 5 seconds' => '5 saniye içinde kapat',
        'Close immediately' => 'Hemen kapatın',
        'Will close automatically' => 'Otomatik olarak kapanacak',
        's' => ' saniye',
        'Average waiting time:' => 'Ortalama bekleme süresi:',
        'Waiting for other players' => 'Diğer oyuncuları beklemek',
        'Game goal' => 'Oyun sayısı',
        'Rating of opponents' => 'Rakip Sıralamaları',
        'new player' => 'yeni̇ oyuncu',
        'CHOOSE GAME OPTIONS' => 'OYUN SEÇENEKLERINI SEÇIN',
        'Profile' => 'Profil',
        'Error' => 'Hata',
        'Your profile' => 'Profiliniz',
        'Start' => 'Başlangıç',
        'Stats' => 'İstatistikler',
        'Play on' => 'Oynat',
        // Чат
        'Error sending complaint<br><br>Choose opponent' => 'Şikayet gönderme hatası<br><br>Rakip seçin',
        'You' => 'Sen',
        'to all: ' => 'Herkese: ',
        ' (to all):' => ' (Herkese):',
        'For everyone' => 'Herkes için',
        'Word matching' => 'Kelime eşleştirme',
        'Player support and chat at' => 'Oyuncu desteği ve sohbet için',
        'Join group' => 'Gruba katılın',
        'Send an in-game message' => 'Oyun içi mesaj gönder',
        // Чат
        'News' => 'Haberler:',
        // Окно статистика
        'Past Awards' => 'Geçmiş onurlar',
        'Parties_Games' => 'Oyunları',
        'Player`s achievements' => 'Oyuncu Başarıları',
        'Player Awards' => 'Oyuncu Ödülleri',
        'Player' => 'Oyuncu',
        'VS' => 'Karşı',
        'Rating' => 'Puanlama',
        'Opponent' => 'Rakip',
        'Active Awards' => 'Ödüller',
        'Remove filter' => 'Filtreyi kaldır',
        // Окно статистика конец

        "Opponent's rating" => 'Rakibin reytingi',
        'Choose your MAX bet' => 'Maksimum hızı seçin',
        'Searching for players with corresponding bet' => 'İlgili bahse sahip oyuncuları arama',
        'Coins written off the balance sheet' => 'Bilanço dışı bırakılan madeni paralar',
        'Number of coins on the line' => 'Hattaki madeni para sayısı',
        'gets a win' => 'kazanmak için alır',
        'The bank of' => '',
        'goes to you' => 'bankası size gidiyor',
        'is taken by the opponent' => 'bankası rakip tarafından alınmıştır',
        'Bid' => 'Teklif\'',
        'No coins' => 'Sikke yok',
        'Any' => 'Kimse',
        'online' => 'çevrimiçi',
        'Above' => 'Yukarıda',
        'minutes' => 'dakika',
        'minute' => 'dakika',
        'Select the minimum opponent rating' => 'Rakiplerin minimum derecesini seçin',
        'Not enough 1900+ rated players online' => 'Çevrimiçi 1900+ reytinge sahip yeterli oyuncu yok',
        'Only for players rated 1800+' => 'Sadece 1800+ reytinge sahip oyuncular için',
        'in game' => 'oyun içinde',
        'score' => 'puan',
        'Your current rank' => 'Mevcut derecelendirmeniz',
        'Server syncing..' => 'Sunucu ile senkronize ediliyor.',
        ' is making a turn.' => ' bir dönüş yapıyor.',
        'Your turn is next - get ready!' => 'Sırada sizin hamleniz var - hazır olun!',
        'switches pieces and skips turn' => 'çipleri değiştirir ve bir dönüşü atlar',
        "Game still hasn't started!" => 'Oyun daha başlamadı!',
        "Word wasn't found" => 'Kelime bulunamadı',
        'Correct' => 'Doğru şekilde',
        'One-letter word' => 'Tek harfli kelime',
        'Repeat' => 'Tekrarla',
        'costs' => 'değer',
        '+15 for all pieces used' => 'Tüm çipler için +15',
        'TOTAL' => 'TOPLAM',
        'You did not make any word' => 'Tek bir kelime bile uydurmadın.',
        'is attempting to make a turn out of his turn (turn #' => 'kendi dönüşü dışında bir dönüş yapmaya çalışıyor (dönüş #',
        'Data processing error!' => 'Veri işleme hatası!',
        ' - turn processing error (turn #' => ' - dönüş işleme hatası (dönüş #',
        "didn't make any word (turn #" => 'herhangi bir kelime yapmadı (dönüş #',
        'set word lenght record for' => 'için en uzun kelime rekorunu kırdı',
        'set word cost record for' => 'başına kelime değeri için bir kayıt ayarlayın',
        'set record for turn cost for' => 'bir taşınma maliyeti için rekor kırdı',
        'gets' => 'alır',
        'for turn #' => 'dönüş için #',
        'For all pieces' => 'Tüm cipsler için',
        'Wins with score ' => 'Bir puan farkla kazanarak',
        'set record for gotten points in the game for' => 'bir maçta en çok sayı atan oyuncu rekorunu kırdı',
        'out of chips - end of game!' => 'fişler bitti, oyun bitti!',
        'set record for number of games played for' => 'bir sezonda oynanan en fazla oyun rekorunu kırdı.',
        'is the only one left in the game - Victory!' => 'Oyunda bir kişi kaldı - Zafer!',
        'left game' => 'oyunu terk etti',
        'has left the game' => 'oyunu terk etti',
        'is the only one left in the game! Start a new game' =>'oyunda yalnız kaldı! Yeni bir oyun başlatın',
        'Time for the turn ran out' => 'Çalışma süresi sona erdi',
        "is left without any pieces! Winner - " => 'cipsi bitmiş! Kazanan: ',
        ' with score ' => 'skor ile',
        "is left without any pieces! You won with score " => 'fişler bitti! Şu skorla kazandın:',
        "gave up! Winner - " => 'teslim oldu. Kazanan: ',
        'skipped 3 turns! Winner - ' => 'üç hamle kaçırdı! Kazanan: ',
        'New game has started!' => 'Yeni oyun başladı!',
        'New game' => 'Yeni oyun',
        'Accept invitation' => 'Daveti kabul et',
        'Get' => '',
        'score points' => 'puan kazan',

        "Asking for adversaries' approval." => 'Rakiplerin onaylanması isteniyor.',
        'Remaining in the game:' => 'Oyun içi artıklar:',
        "You got invited for a rematch! - Accept?" => 'Rövanş maçına davet edildiniz - Kabul mü?',
        'All players have left the game' => 'Tüm oyuncular oyunu terk etti',
        "Your score" => 'Sizin puanınız',
        'Turn time' => 'Dönüş süresi',
        'Date' => 'Tarih',
        'Price' => 'Miktar',
        'Status' => 'Durum',
        'Type' => 'Tip',
        'Period' => 'Dönem',
        'Word' => 'Kelime','Puanlar/harfler',
        'Result' => 'Sonuç',
        'Opponents' => 'Muhalifler',
        'Games<br>total' => 'Oyunlar<br>toplam',
        'Wins<br>total' => 'Kazanır<br>toplam',
        'Gain/loss<br>in ranking' => 'Sıralamada<br>kazanç/kayıp',
        '% Wins' => '% Kazanma',
        'Games in total' => 'Toplam oyun sayısı',
        'Winnings count' => 'Kazançlar sayılır',
        'Increase/loss in rating' => 'Reyting artışı/kaybı',
        '% of wins' => 'Kazanma yüzdesi',
        "GAME points - Year Record!" => 'OYUN puanları - Yıl Rekoru!',
        "GAME points - Month Record!" => 'OYUN puanları - Ay Rekoru!',
        "GAME points - Week Record!" => 'OYUN puanları - Hafta Rekoru!',
        "GAME points - Day Record!" => 'OYUN puanları - Gün Rekoru!',
        "TURN points - Year Record!" => 'TURN puanları - Yıl Rekoru!',
        "TURN points - Month Record!" => 'TURN puanları - Ay Rekoru!',
        "TURN points - Week Record!" => 'TURN puanları - Hafta Rekoru!',
        "TURN points - Day Record!" => 'TURN noktaları - Gün Rekoru!',
        "WORD points - Year Record!" => 'KELİME puanları - Yıl Rekoru!',
        "WORD points - Month Record!" => 'KELİME puanları - Ay Rekoru!',
        "WORD points - Week Record!" => 'KELİME puanları - Hafta Rekoru!',
        "WORD points - Day Record!" => 'KELİME puanları - Gün Rekoru!',
        "Longest WORD - Year Record!" => 'En Uzun KELİME - Yıl Rekoru!',
        "Longest WORD - Month Record!" => 'En Uzun KELİME - Ay Rekoru!',
        "Longest WORD - Week Record!" => 'En Uzun Sözcük - Hafta Rekoru!',
        "Longest WORD - Day Record!" => 'En Uzun Sözcük - Gün Rekoru!',
        "GAMES played - Year Record!" => 'Çalınan Parçalar - Yıl Rekoru!',
        "GAMES played - Month Record!" => 'Çalınan Parçalar - Ayın Kaydı!',
        "GAMES played - Week Record!" => 'Çalınan Parçalar - Haftanın Kaydı!',
        "GAMES played - Day Record!" => 'Çalınan Parçalar - Günün Kaydı!',
        "Victory" => 'Zafer',
        'Losing' => 'Kaybetmek',
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