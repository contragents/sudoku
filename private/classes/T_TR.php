<?php

namespace classes;


use PaymentModel;
use UserModel;

class T_TR
{
    const PHRASES = [
        'FAQ' => 'SSS',
        'Agreement' => 'Anlaşma',
        'Empty value is forbidden' => 'Boş değer yasaktır',
        'Forbidden' => 'Yasak',
        'game_title' => [
            SudokuGame::GAME_NAME => 'Arkadaşlarla Online Sudoku',
        ],
        'secret_prompt' => [
            SudokuGame::GAME_NAME => '<a href="https://t.me/sudoku_app_bot">Telegram&#39;da</a> daha fazla hesap geri yüklemesi için bu anahtarı kaydedin',
        ],
        'COIN Balance' => 'Para bakiyesi',
        PaymentModel::INIT_STATUS => 'Başladı',
        PaymentModel::BAD_CONFIRM_STATUS => 'Kötü onay',
        PaymentModel::COMPLETE_STATUS => 'Tamamlandı',
        PaymentModel::FAIL_STATUS => 'Başarısız',
        'Last transactions' => 'Son işlemler',
        'Support in Telegram' => 'Telegram&#39;da Destek',
        'Check_price' => 'Fiyat<br>kontrolü',
        'Replenish' => 'Yenilemek',
        'SUDOKU_amount' => 'Sikke miktarı',
        'enter_amount' => 'fischgte',
        'Buy_SUDOKU' => 'Madeni Para Satın Alın' . '{{sudoku_icon_15}}',
        'The_price' => 'Fiyat teklifi',
        'calc_price' => 'fiyat',
        'Pay' => 'Ödeme',
        'Congratulations to Player' => 'Tebrik Ederiz Oyuncumuzu ',
        'Server sync lost' => 'Sunucu ile senkronizasyon kaybı',
        'Server connecting error. Please try again' => 'Sunucu bağlanma hatası. Lütfen tekrar deneyin',
        'Error changing settings. Try again later' => 'Ayarları değiştirirken hata oluştu. Daha sonra tekrar deneyin',
        'invite_friend_prompt' => [
            SudokuGame::GAME_NAME => 'Telegram&#39;da çevrimiçi oyun SUDOKU&#39;ya katılın! Maksimum puanı alın, jeton kazanın ve jetonları cüzdanınıza çekin',
        ],
        'game_bot_url' => [
            SudokuGame::GAME_NAME => 'https://t.me/sudoku_app_bot',
        ],
        'loading_text' => 'SUDOKU yükleniyor...',
        'switch_tg_button' => 'Telegram&#39;a geç',
        'Invite a friend' => 'Arkadaş davet et',
        'you_lost' => 'Kaybettiniz!',
        'you_won' => 'Sen kazandın!',
        '[[Player]] won!' => '[[Player]] kazandı',
        'start_new_game' => 'Yeni bir oyun başlatın',
        'rating_changed' => 'Reyting değişikliği:',
        'Authorization error' => 'Yetkilendirme Hatası',
        'Error sending message' => 'Mesaj gönderilirken hata oluştu',
        // Рекорды
        'Got reward' => 'Bir ödül alındı',
        'Your passive income' => 'Pasif geliriniz',
        'will go to the winner' => 'kazanana gidecek',
        'Effect lasts until beaten' => 'Etki dövülene kadar sürer',
        'per_hour' => 'saat',
        'rank position' => 'rütbe konum',
        'record of the year' => 'yılın rekoru',
        'record of the month' => 'ayın rekoru',
        'record of the week' => 'haftanin rekoru',
        'record of the day' => 'günün rekoru',
        'game_price' => 'oyun puanları',
        'games_played' => 'oynanan oyunlar',
        'Games Played' => 'Oyunlar',
        'top' => 'üst',
        'turn_price' => 'ciro puanları',
        'word_len' => 'uzun kelime',
        'word_price' => 'kelime puanları',
        UserModel::BALANCE_HIDDEN_FIELD => 'Kullanıcı gizli',
        'top_year' => 'İLK 1',
        'top_month' => 'İLK 2',
        'top_week' => 'İLK 3',
        'top_day' => 'İlk onda',
        // Рекорды конец
        'Return to fullscreen mode?' => 'Tam ekran moduna dönmek mi?',
        // Профиль игрока
        'Choose file' => 'Dosya seçin',
        'Back' => 'Geri dön',
        'Wallet' => 'Çanta',
        'Referrals' => 'Sevkler',
        'Player ID' => 'Oyuncu Kimliği',
        // complaints
        'Player is unbanned' => 'Oyuncu engelsiz',
        'Player`s ban not found' => 'Kullanıcı yasağı bulunamadı',
        'Player not found' => 'Kullanıcı bulunamadı',
        // end complaints
        'Save' => 'Kaydet',
        'new nickname' => 'yeni takma ad',
        'Input new nickname' => 'Yeni takma ad girin',
        'Your rank' => 'Rütbeniz',
        'Ranking number' => 'ÜST pozisyon',
        'Balance' => 'Denge',
        'Rating by coins' => 'Sikke sıralaması',
        'Secret key' => 'Gizli anahtar&#42;',
        'Link' => 'Bağlama',
        'Bonuses accrued' => 'Tahakkuk eden primler',
        'SUDOKU Balance' => 'SUDOKU bilançosu',
        'Claim' => 'İddia',
        'Name' => 'İsim',
        // Профиль игрока конец
        'Nickname updated' => 'Takma ad güncellendi',
        'Stats getting error' => 'İstatistikler yüklenirken hata oluştu',
        'Error saving Nick change' => 'Nick&#39;in kurtarma hatası',
        'Play at least one game to view statistics' => 'İstatistikleri görüntülemek için en az bir oyun oynayın',
        'Lost server synchronization' => 'Kayıp sunucu senkronizasyonu',
        'Closed game window' => 'Kapalı oyun penceresi',
        'You closed the game window and became inactive!' => 'Oyun penceresini kapattınız ve devre dışı kaldınız!',
        'Request denied. Game is still ongoing' => 'Talep reddedildi. Oyun hala devam ediyor',
        'Request rejected' => 'Talep reddedildi',
        'No messages yet' => 'Henüz mesaj yok',
        'New game request sent' => 'Yeni bir oyun için talep gönderildi',
        'Your new game request awaits players response' => 'Yeni oyun talebiniz oyuncuların yanıtını bekliyor',
        'Request was aproved! Starting new game' => 'İstek onaylandı! Yeni oyuna başlıyorum',
        'Default avatar is used' => 'Varsayılan avatar kullanılır',
        'Avatar by provided link' => 'Verilen bağlantıya göre avatar',
        'Set' => 'Ayarla',
        'Avatar loading' => 'Avatar yükleniyor',
        'Send' => 'Gönder',
        'Avatar URL' => 'Avatar URL&#39;si',
        'Apply' => 'Başvurmak',
        'Account key' => 'Hesap anahtarı',
        'Main account key' => 'Birincil hesap anahtarı',
        'old account saved key' => 'eski hesaptan kaydedilmiş anahtar',
        'Key transcription error' => 'Anahtar şifre çözme hatası',
        "Player's ID NOT found by key" => 'Anahtara göre oyuncu kimliği bulunamadı',
        'Accounts linked' => 'Hesaplar birbirine bağlıdır',
        'Accounts are already linked' => 'Hesaplar zaten bağlı',
        'Game is not started' => 'Oyun başlatılmadı',
        'OK' => 'Tamam',
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
        'Bid' => 'Teklif&#39;',
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
        'is the only one left in the game! Start a new game' => 'oyunda yalnız kaldı! Yeni bir oyun başlatın',
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
        'Word' => 'Kelime',
        'Puanlar/harfler',
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
        "Go to player's stats" => 'Oyuncu istatistiklerine git',
        'Filter by player' => 'Oyuncuya göre filtrele',
        'Apply filter' => 'Filtre uygula',
        'against' => 'bir oyuncuya karşı',
        "File loading error!" => 'Dosya yükleme hatası!',
        "Check:" => 'Şuna bir bak:',
        "file size (less than " => 'dosya boyutu (maks ',
        "resolution - " => 'çözünürlük - ',
        "Incorrect URL format!" => 'Yanlış URL biçimi!',
        "Must begin with " => 'Şununla başlamalıdır: ',
        'Error! Choose image file with the size not more than' => 'Hata! Boyutundan daha büyük olmayan bir resim dosyası seçin:',
        'Avatar updated' => 'Avatar güncellendi',
        "Error saving new URL" => 'Yeni URL kaydedilirken hata oluştu',
        'A player may open more than one cell and more than one KEY in one turn. Use the CASCADES rule' => 'Bir oyuncu bir turda birden fazla hücre ve birden fazla ANAHTAR açabilir. CASCADES kuralını kullanın',
        'If after the automatic opening of a number, new blocks of EIGHT open cells are formed on the field, such blocks are also opened by CASCADE' => 'Bir sayının otomatik olarak açılmasından sonra, alanda SEKİZ açık hücreden oluşan yeni bloklar oluşursa, bu bloklar da CASCADE ile açılır',
        'If a player has opened a cell (solved a number in it) and there is only ONE closed digit left in the block, this digit is opened automatically' => 'Bir oyuncu bir hücreyi açmışsa (içindeki bir sayıyı çözmüşse) ve blokta sadece BİR kapalı rakam kalmışsa, bu rakam otomatik olarak açılır',
        'is awarded for solved empty cell' => '- açık bir rakam için verilir',
        'by calculating all of other 8 digits in a block - vertically OR horizontally OR in a 3x3 square' => 'açmak için puan toplamaktır - dikey VEYA yatay VEYA 3x3 karede',
        "The players' task is to take turns making moves and accumulating points to open black squares" => 'Oyuncuların görevi sırayla hamle yapmak ve bir bloktaki diğer 8 rakamın tümünü hesaplayarak siyah kareleri',
        'The classic SUDOKU rules apply - in a block of nine cells (vertically, horizontally and in a 3x3 square) the numbers must not be repeated' => 'Klasik SUDOKU kuralları geçerlidir - dokuz hücreli bir blokta (dikey, yatay ve 3x3&#39;lük bir karede) sayılar tekrarlanmamalıdır',
        'faq_rules' => [
            SudokuGame::GAME_NAME => <<<TR

<h2 id="nav1">Oyun hakkında</h2>
Klasik SUDOKU kuralları geçerlidir - dokuz hücreli bir blokta (dikey, yatay ve 3x3 karede) sayılar tekrarlanmamalıdır
<br><br>
Oyuncuların görevi sırayla hamle yapmak ve siyah kareleri açmak için puan toplamaktır (<span style="color: #0f0">+10 puan</span>) bir bloktaki diğer 8 rakamın tümünü hesaplayarak - dikey VEYA yatay VEYA 3x3 kare içinde
<br><br>
A <span style="color: #0f0">+1 puan</span> verilir
<br><br>
Zafer, tüm olası puanların %50'sini alan oyuncuya gider +1 puan
<br><br>
Bir oyuncu bir hücreyi açmışsa (içindeki bir sayıyı çözmüşse) ve blokta sadece BİR kapalı rakam kalmışsa, bu rakam otomatik olarak açılır
<br><br>
Bir rakamın otomatik olarak açılmasından sonra, sahada SEKİZ açık hücreden oluşan yeni bloklar oluşursa, bu bloklar da KASA ile açılır
<br><br>
Bir oyuncu bir turda birden fazla hücre ve birden fazla ANAHTAR açabilir. CASCADES kuralını kullanın
<br><br>
Hatalı bir hamle durumunda - hücredeki rakam yanlıştır - bu hücrede her iki oyuncu tarafından görülebilen küçük kırmızı bir hata rakamı belirir. Bu rakam bir daha bu hücreye yerleştirilemez
<br><br>
Kontrol düğmesini kullanarak oyuncu bir işaret yapabilir - hücreye küçük yeşil bir sayı koyabilir. Bu, oyuncunun emin olduğu hesaplanmış bir rakam veya sadece bir tahmin olabilir. Notları normal bir SUDOKU'da olduğu gibi kullanın - diğer oyuncu bunları göremez
TR
            ,
        ],
        'faq_rating' => <<<TR
Elo reytingi
<br><br>
Elo reyting sistemi, Elo katsayısı - oyunlarda oyuncuların göreceli gücünü hesaplama yöntemi, 
iki oyunculu oyunlarda (örneğin satranç, dama veya shogi, go). 
<br>
Bu derecelendirme sistemi Macar asıllı Amerikalı fizik profesörü Arpad Elo (Macarca: Élő Árpád; 1903-1992) tarafından geliştirilmiştir
<br><br>
Oyuncular arasındaki derecelendirme farkı ne kadar büyükse, güçlü oyuncu kazanırken derecesine o kadar az puan eklenecektir.
<br> 
Tersine, daha zayıf bir oyuncu daha güçlü bir oyuncuyu yenerse reytingine daha fazla puan eklenecektir.
<br><br>
Bu nedenle, güçlü bir oyuncu için eşit oyuncularla oynamak daha avantajlıdır - kazanırsanız daha fazla puan alırsınız ve kaybederseniz çok fazla puan kaybetmezsiniz.
<br><br>
Yeni başlayan birinin deneyimli bir ustayla dövüşmesi güvenlidir.
<br>Eğer kaybederseniz sıralama kaybı küçük olacaktır.
<br>Ancak, zafer durumunda, usta rütbe puanlarını cömertçe paylaşacaktır.
TR
        ,
        'faq_rewards' => [
            SudokuGame::GAME_NAME => <<<TR
Oyuncular belirli başarılar (rekorlar) için ödüllendirilir.
<br><br>
Oyuncunun ödülleri, “STATS” bölümünde şu adaylıklar altında gösterilir: altın/gümüş/bronz/taş.
<br><br>
Ödül kartı aldığında, oyuncu SUDOKU coinleri {{sudoku_icon}}<br> bonus olarak alır.
Coinler özel oyun modu “ON Coins”da kullanılabilir, oyun içi cüzdanınızı doldurabilir,
oyundan coin çekebilirsiniz - daha fazla bilgi için “Coin Oyun Modu” sekmesine bakın.
<br><br>
Bir oyuncunun rekoru başka bir oyuncu tarafından kırılmadığı sürece, ödül kartı o oyuncu için “İSTATİSTİKLER” bölümünün “AKTİF ÖDÜLLER” sekmesinde gösterilir.
<br><br>
Her saat başı verilen her bir “ACTIVE Reward” ek “kar” olarak coin kazandırır.
<br><br>
Bir rekor başka bir oyuncu tarafından kırılırsa, rekorun önceki sahibinin ödül kartı “GEÇMİŞ ÖDÜLLER” sekmesine taşınır ve pasif gelir getirmeyi durdurur. 
<br><br>
Alınan toplam coin sayısı (tek seferlik bonuslar ve ek kar), “PROFİL” bölümündeki ‘Cüzdan’ sekmesinde sırasıyla “SUDOKU bakiyesi” ve “Biriken bonuslar” alanlarında görüntülenebilir.
<br><br>
“OYNANAN PARTİLER” başarılarında kendi rekorunu aşan oyuncuya yeni bir ödül kartı veya para verilmez.
Rekor değeri (oyun sayısı / arkadaş sayısı) ödül kartında güncellenir.
<br><br>
Örneğin, bir oyuncu daha önce 10.000 oyun için “OYNANAN OYUNLAR”
(altın) başarısını elde etmişse, bu oyuncunun oyun sayısı 10.001'e değiştiğinde, rekor sahibine artık ödül kartı verilmeyecektir.<br>
TR
            ,
        ],
        'Reward' => 'Ödül',
        'faq_coins' => [
            SudokuGame::GAME_NAME => <<<TR
Coin <strong>SUDOKU</strong> {{sudoku_icon}}{{yandex_exclude}}{{ , <strong>Scrabble, Sudoku</strong> gibi oyunlardan oluşan bir oyun ağında kullanılan oyun içi para birimidir<br><br>
Tüm oyunlar için tek bir hesap, tek bir para birimi, tek bir cüzdan}}
<br><br>
{{yandex_exclude}}{{Kripto dünyasında, bu coin SUDOKU olarak da adlandırılır. Yakında, oyun içi cüzdanınızdan TON (Telegram) ağındaki harici bir cüzdana istediğiniz sayıda SUDOKU coinini çekebilmeniz mümkün olacak.
<br><br>}}
Bu arada, “Madeni paralar” modunu seçerek oyunda mümkün olduğunca çok para kazanmaya çalışıyoruz.<br><br>

Bu modda oyuncu sıralamaları da dikkate alınır ve puanlanır.<br>
Ancak, oyunun sonuçlarına göre kazanılan jetonlar artık cüzdanınıza yatırılır (kaybederseniz ise cüzdanınızdan düşülür).
<br><br>
Cüzdanınızdaki mevcut jeton bakiyesine bağlı olarak, 1, 5, 10 vb. jetonlarla oynamak için teklif edilir - listeden istediğiniz miktarı seçin.
<br><br>
“Başlat” (Start) düğmesine bastıktan sonra, belirtilen miktarı bahis yapmaya hazır olan bir rakip aranmaya başlanacaktır.
<br><br> 
Örneğin, bahis miktarınızı 5 jeton olarak belirlediniz ve yeni bir oyuna başlayanlar arasında sadece 1 jeton bahis yapmak isteyenler var.
<br>
O zaman hem sizin hem de bu tür bir oyuncunun bahsi 1 jeton olacaktır - iki seçenekten daha düşük olanı.
<br><br>
10 jeton için mücadele etmeye istekli biri varsa, sizin bahsiniz olan 5 jeton seçilecek ve oyun 10 jetonluk bir banka ile başlayacaktır - 5+5.
<br><br>
İki kişilik bir oyunda, kazanan tüm potu alır - kendi bahsi ve rakibinin bahsi.
<br><br>
Üçlü oyunda, kazanan kendi bahsini ve son oyuncunun (en az puana sahip oyuncu) bahsini alır.
Ortadaki oyuncu (ikinci olan) kendi bahsini geri alır ve paralarını elinde tutar.
<br><br>
Dört oyunculu bir oyunda, pot 1. ve 4. sıradaki oyuncular arasında bölünür (ilk oyuncu her iki bahsi de alır) 
ve 2. ve 3. sıradaki oyuncular arasında bölünür (ikinci oyuncu her iki bahsi de alır).
<br><br>
Böylece, üç ve dört oynamak, jeton biriktirme açısından daha az riskli hale gelir.
<br><br>
Tüm kaybeden oyuncuların puanları aynı ise, kazanan oyuncu tüm bahisleri alır.
<br><br>
Dörtlü oyunda, 2. ve 3. oyuncular eşit sayıda puan alırlarsa, bahislerini geri alırlar ve bahislerini korurlar.
<br><br>
Yeni Sıralama her durumda her zamanki gibi hesaplanır - “Sıralama” sekmesine bakın.
<br><br>
<h2>Cüzdanınızı nasıl doldurabilirsiniz</h2>
<ol>
<li>
Her yeni oyuncu, bakiyesine {{stone_reward}} {{yandex_exclude}}{{SUDOKU }}hoş geldin jetonu alır ve hemen büyük kazançlar için yarışa katılabilir.
</li>
<li>
Referans bağlantınızı kullanarak oyuna gelen her arkadaşınız için {{stone_reward}} jeton kazanacaksınız.
Ayrıca, davet edilen kişi sayısında (günlük, haftalık, aylık, yıllık) rekor kırarak ödül kazanacaksınız. Bir kullanıcıyı davet etmek için Telegram üzerinden oyuna giriş yapmanız gerekir.
</li>
<li>
Oyundaki başarılar için madeni paralar verilir (oyun başına puan, hamle başına puan, kelime başına puan, oyun sayısı, davet edilen kişi sayısı, sıralamadaki yer #1'den #10'a kadar).
</li>
<li>
Her 100 oyun için {{stone_reward}} jeton verilir
</li>
</ol>

<br>
Her başarı için verilen jeton sayısı zaman içinde aşağı veya yukarı doğru değişebilir. Gerçek ödül, başarı kartına yansıtılır.
<br><br>
<h2>Kazandığınız paralarla neler yapabilirsiniz</h2>
<ol>
<li>
Oyunlarımızı oynayın, bahisleri artırın, en sevdiğiniz eğlenceye heyecan ve ilgi katın
</li>
<li>
Başka bir oyuncuya cüzdanınızdan istediğiniz sayıda jeton göndererek hediye verin (çok yakında)
</li>  
</ol>
<br>
Cüzdan bakiyenizin ayrıntılarını “PROFİL” menüsünün “Cüzdan” sekmesinden öğrenebilirsiniz.
<br><br>
<strong>Tahakkuk eden bonuslar</strong> - oyuncunun başarılarına bağlı olarak her saat tahakkuk eden pasif kazançların sonucu (“İSTATİSTİKLER” menüsü, “Ödüller” bölümü).
<br>Bonuslar “Olsun” düğmesine basılarak bakiyeye aktarılabilir
<br><br>
<strong>SUDOKU Bakiyesi</strong> - bonuslar olmadan mevcut jeton bakiyesi. Jetonlar oyunun sonuçlarına göre düşülür / yatırılır
<br><br>
Madalyalara benzeyen başarı kartları, başarınızın bir göstergesidir. 
<br>Bunlar başarının adını, dönemi (yıl, gün, hafta, ay), puan sayısını (derecelendirme, kelime uzunluğu, arkadaş sayısı) ve jeton sayısını içerir 
<br><br>
Rekorunuz başka bir oyuncu tarafından kırıldığında pasif para kazanımı durur
TR,
        ],
        '[[Player]] opened [[number]] [[cell]]' => '[[Player]] [[number]] kare açtı',
        ' (including [[number]] [[key]])' => ' ([[number]] anahtar dahil)',
        '[[Player]] made a mistake' => '[[Player]] bir hata yaptı',
        'You made a mistake!' => 'Bir hata yaptın!',
        'Your opponent made a mistake' => 'Rakibiniz bir hata yaptı',
        '[[Player]] gets [[number]] [[point]]' => '[[Player]] [[number]] puan alır',
        '[[number]] [[point]]' => '[[number]] puan topla',
        'You got [[number]] [[point]]' => '[[number]] puan alırsın',
        'Your opponent got [[number]] [[point]]' => 'Rakibin [[number]] puan aldı',
    ];
}