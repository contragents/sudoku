<?php

namespace classes;


use PaymentModel;
use UserModel;

class T_FR
{
    const PHRASES = [
        'Invalid URL format! <br />It must begin with <strong>http(s)://</strong>' => 'Format d&#39;URL invalide !<br />Il doit commencer par <strong>http(s)://</strong>',
        '</strong> or <strong>' => '</strong> ou <strong>',
        'MB</strong>)</li><li>extension -<strong>' => 'mégaoctet</strong>)</li><li>extension -<strong>',
        '<strong>File upload error!</strong><br /> Please review:<br /> <ul><li>file size (no more than <strong>' => '<strong>Erreur lors du téléchargement du fichier !</strong><br /> Veuillez vérifier :<br /> <ul><li>taille du fichier (pas plus de <strong>',
        'Error creating new payment' => 'Erreur lors de la création d&#39;un nouveau paiement',
        'FAQ' => 'FAQ',
        'Agreement' => 'Accord',
        'Empty value is forbidden' => 'Les valeurs vides sont interdites',
        'Forbidden' => 'Interdit',
        'game_title' => [
            SudokuGame::GAME_NAME => 'Sudoku en ligne avec des amis',
        ],
        'secret_prompt' => [
            SudokuGame::GAME_NAME => 'Conservez cette clé pour pouvoir restaurer votre compte dans <a href="https://t.me/sudoku_app_bot">Telegram</a> ultérieurement',
        ],
        'COIN Balance' => 'Solde COIN',
        PaymentModel::INIT_STATUS => 'Débuté',
        PaymentModel::BAD_CONFIRM_STATUS => 'Erreur de confirmation',
        PaymentModel::COMPLETE_STATUS => 'Terminé',
        PaymentModel::FAIL_STATUS => 'Échec',
        'Last transactions' => 'Dernières transactions',
        'Support in Telegram' => 'Assistance sur Telegram',
        'Check_price' => 'Vérifier<br>le prix',
        'Replenish' => 'Faire le plein',
        'SUDOKU_amount' => 'Quantité de pièces',
        'enter_amount' => 'montant',
        'Buy_SUDOKU' => 'Acheter des pièces SUDOKU',
        'The_price' => 'Offre de prix',
        'calc_price' => 'prix',
        'Pay' => 'Payer',
        'Congratulations to Player' => 'Félicitations au Joueur',
        'Server sync lost' => 'Synchronisation du serveur perdue',
        'Server connecting error. Please try again' => 'Erreur de connexion au serveur. Veuillez réessayer.',
        'Error changing settings. Try again later' => 'Erreur lors de la modification des paramètres. Veuillez réessayer plus tard.',
        'invite_friend_prompt' => [
            SudokuGame::GAME_NAME => 'Rejoignez le jeu en ligne SUDOKU sur Telegram ! Obtenez le meilleur score, gagnez des pièces et retirez des jetons dans votre portefeuille.',
        ],
        'game_bot_url' => [
            SudokuGame::GAME_NAME => 'https://t.me/sudoku_app_bot',
        ],
        'loading_text' => 'SUDOKU est en cours de chargement...',
        'switch_tg_button' => 'Passer à Telegram',
        'Invite a friend' => 'Inviter un ami',
        'you_lost' => 'Tu as perdu !',
        'you_won' => 'Vous avez gagné !',
        '[[Player]] won!' => '[[Player]] a gagné !',
        'start_new_game' => 'Commencer une nouvelle partie',
        'rating_changed' => 'Modification de la notation : ',
        'Authorization error' => 'Erreur d&#39;autorisation',
        'Error sending message' => 'Erreur lors de l&#39;envoi du message',
        // Рекорды
        'Got reward' => 'Récompense obtenue',
        'Your passive income' => 'Votre revenu passif',
        'will go to the winner' => 'sera remis au gagnant.',
        'Effect lasts until beaten' => 'L&#39;effet dure jusqu&#39;à ce qu&#39;il soit battu',
        'per_hour' => 'heure',
        'rank position' => 'position de classement',
        'record of the year' => 'album de l&#39;année',
        'record of the month' => 'disque du mois',
        'record of the week' => 'disque de la semaine',
        'record of the day' => 'enregistrement du jour',
        'game_price' => 'points de jeu',
        'games_played' => 'matchs joués',
        'Games Played' => 'Matchs joués',
        'top' => 'haut',
        'turn_price' => 'points par tour',
        'word_len' => 'longueur des mots',
        'word_price' => 'points par mot',
        UserModel::BALANCE_HIDDEN_FIELD => 'Utilisateur masqué',
        'top_year' => 'TOP 1',
        'top_month' => 'TOP 2',
        'top_week' => 'TOP 3',
        'top_day' => 'Dans le top 10',
        // Рекорды конец
        'Return to fullscreen mode?' => 'Revenir au mode plein écran ?',
        // Профиль игрока
        'Choose file' => 'Choisir le fichier',
        'Back' => 'Retour',
        'Wallet' => 'Portefeuille',
        'Referrals' => 'Recommandations',
        'Player ID' => 'ID du joueur',
        // complaints
        'Player is unbanned' => 'Le joueur n&#39;est plus banni.',
        'Player`s ban not found' => 'Interdiction du joueur introuvable',
        'Player not found' => 'Joueur introuvable',
        // end complaints
        'Save' => 'Enregistrer',
        'new nickname' => 'nouveau surnom',
        'Input new nickname' => 'Entrer un nouveau pseudonyme',
        'Your rank' => 'Votre rang',
        'Ranking number' => 'Numéro de classement',
        'Balance' => 'Balance',
        'Rating by coins' => 'Évaluation par pièces',
        'Secret key' => 'Clé secrète',
        'Link' => 'Lier',
        'Bonuses accrued' => 'Bonus accumulés',
        'SUDOKU Balance' => 'SUDOKU Balance',
        'Claim' => 'Prendre',
        'Name' => 'Nom',
        // Профиль игрока конец
        'Nickname updated' => 'Pseudonyme mis à jour',
        'Stats getting error' => 'Les statistiques renvoient une erreur.',
        'Error saving Nick change' => 'Erreur lors de l&#39;enregistrement du changement de pseudonyme',
        'Play at least one game to view statistics' => 'Jouez au moins une partie pour consulter les statistiques.',
        'Lost server synchronization' => 'Perte de synchronisation du serveur',
        'Closed game window' => 'Fenêtre du jeu fermée',
        'You closed the game window and became inactive!' => 'Vous avez fermé la fenêtre du jeu et êtes devenu inactif !',
        'Request denied. Game is still ongoing' => 'Demande refusée. Le jeu est toujours en cours.',
        'Request rejected' => 'Demande rejetée',
        'No messages yet' => 'Aucun message pour le moment',
        'New game request sent' => 'Nouvelle demande de jeu envoyée',
        'Your new game request awaits players response' => 'Votre nouvelle demande de jeu attend la réponse des joueurs.',
        'Request was aproved! Starting new game' => 'La demande a été approuvée ! Démarrage d&#39;une nouvelle partie',
        'Default avatar is used' => 'L&#39;avatar par défaut est utilisé.',
        'Avatar by provided link' => 'Avatar via le lien fourni',
        'Set' => 'Définir',
        'Avatar loading' => 'Chargement de l&#39;avatar',
        'Send' => 'Envoyer',
        'Avatar URL' => 'URL de l&#39;avatar',
        'Apply' => 'Appliquer',
        'Account key' => 'Clé de compte',
        'Main account key' => 'Clé du compte principal',
        'old account saved key' => 'ancienne clé enregistrée',
        'Key transcription error' => 'Erreur de transcription importante',
        "Player's ID NOT found by key" => 'Identifiant du joueur introuvable par clé',
        'Accounts linked' => 'Comptes liés',
        'Accounts are already linked' => 'Les comptes sont déjà liés.',
        'Game is not started' => 'Le jeu n&#39;a pas commencé.',
        'OK' => 'Tamam',
        'Click to expand the image' => 'Cliquez pour agrandir l&#39;image',
        'Report sent' => 'Rapport envoyé',
        'Report declined! Please choose a player from the list' => 'Rapport refusé ! Veuillez choisir un joueur dans la liste.',
        'Your report accepted and will be processed by moderator' => 'Votre rapport a été accepté et sera traité par le modérateur.',
        'If confirmed, the player will be banned' => 'Si cela est confirmé, le joueur sera banni.',
        'Report declined!' => 'Rapport refusé !',
        'Only one complaint per each player per day can be sent. Total 24 hours complaints limit is' => 'Chaque joueur ne peut envoyer qu&#39;une seule plainte par jour. Le nombre total de plaintes autorisées en 24 heures est de',
        'From player' => 'Du joueur',
        'To Player' => 'Au joueur',
        'Awaiting invited players' => 'En attente des joueurs invités',
        'Searching for players' => 'Recherche de joueurs',
        'Searching for players with selected rank' => 'Recherche de joueurs avec un rang sélectionné',
        'Message NOT sent - BAN until ' => 'Message NON envoyé - BAN jusqu&#39;à ',
        'Message NOT sent - BAN from Player' => 'Message NON envoyé - BAN du joueur',
        'Message sent' => 'Message envoyé',
        'Exit' => 'Sortie',
        'Appeal' => 'Appel',
        'There are no events yet' => 'Il n&#39;y a pas encore d&#39;événements.',
        'Playing to' => 'Nous jouons jusqu&#39;à',
        'Just two players' => 'Seulement deux joueurs',
        'Up to four players' => 'Jusqu&#39;à quatre joueurs',
        'Game selection - please wait' => 'Sélection de jeux - veuillez patienter',
        'Your turn!' => 'À vous de jouer !',
        'Looking for a new game...' => 'À la recherche d&#39;un nouveau jeu...',
        'Get ready - your turn is next!' => 'Préparez-vous, c&#39;est bientôt votre tour !',
        'Take a break - your move in one' => 'Faites une pause - à vous de jouer',
        'Refuse' => 'Refuser',
        'Offer a game' => 'Proposer un jeu',
        'Players ready:' => 'Joueurs prêts :',
        'Players' => 'Joueurs',
        'Try sending again' => 'Essayez de renvoyer le message.',
        'Error connecting to server!' => 'Erreur de connexion au serveur !',
        'You haven`t composed a single word!' => 'Vous n&#39;avez pas écrit un seul mot !',
        'You will lose if you quit the game! CONTINUE?' => 'Vous perdrez si vous quittez le jeu ! CONTINUER ??',
        'Cancel' => 'Annuler',
        'Confirm' => 'Confirmer',
        'Revenge!' => 'Vengeance !',
        'Time elapsed:' => 'Temps écoulé :',
        'Time limit:' => 'Délai :',
        'You can start a new game if you wait for a long time' => 'Vous pouvez commencer une nouvelle partie si vous attendez longtemps.',
        'Close in 5 seconds' => 'Fermer dans 5 secondes',
        'Close immediately' => 'Fermer immédiatement',
        'Will close automatically' => 'Se fermera automatiquement',
        's' => ' secondes',
        'Average waiting time:' => 'Temps d&#39;attente moyen :',
        'Waiting for other players' => 'En attente d&#39;autres joueurs',
        'Game goal' => 'Objectif du jeu',
        'Rating of opponents' => 'Évaluation des adversaires',
        'new player' => 'nouveau joueur',
        'CHOOSE GAME OPTIONS' => 'CHOISIR LES OPTIONS DU JEU',
        'Profile' => 'Profil',
        'Error' => 'Erreur',
        'Your profile' => 'Votre profil',
        'Start' => 'Démarrer',
        'Stats' => 'Statistiques',
        'Play on' => 'Jouer sur',
        // Чат
        'Error sending complaint<br><br>Choose opponent' => 'Erreur lors de l&#39;envoi de la plainte<br><br>Choisissez votre adversaire',
        'You' => 'Vous',
        'to all: ' => 'À tous : ',
        ' (to all):' => ' (à tous) :',
        'For everyone' => 'Pour tout le monde',
        'Word matching' => 'Correspondance de mots',
        'Player support and chat at' => 'Assistance aux joueurs et chat sur',
        'Join group' => 'Rejoindre le groupe',
        'Send an in-game message' => 'Envoyer un message dans le jeu',
        // Чат
        'News' => 'Actualités',
        // Окно статистика
        'Past Awards' => 'Récompenses passées',
        'Parties_Games' => 'Jeux',
        'Player`s achievements' => 'Réalisations du joueur',
        'Player Awards' => 'Récompenses des joueurs',
        'Player' => 'Joueur',
        'VS' => 'contre',
        'Rating' => 'Évaluation',
        'Opponent' => 'Adversaire',
        'Active Awards' => 'Récompenses actives',
        'Remove filter' => 'Supprimer le filtre',
        // Окно статистика конец

        "Opponent's rating" => 'Classement de l&#39;adversaire',
        'Choose your MAX bet' => 'Choisissez votre mise MAXIMALE',
        'Searching for players with corresponding bet' => 'Recherche de joueurs ayant placé un pari correspondant',
        'Coins written off the balance sheet' => 'Pièces dépréciées hors bilan',
        'Number of coins on the line' => 'Nombre de pièces en jeu',
        'gets a win' => 'remporte une victoire',
        'The bank of' => 'La banque de',
        'goes to you' => 'vous revient',
        'is taken by the opponent' => 'est pris par l&#39;adversaire',
        'Bid' => 'Offre',
        'No coins' => 'Pas de pièces',
        'Any' => 'N&#39;importe quel',
        'online' => 'en ligne',
        'Above' => 'Au-dessus',
        'minutes' => 'minutes',
        'minute' => 'minute',
        'Select the minimum opponent rating' => 'Sélectionnez la note minimale de l&#39;adversaire',
        'Not enough 1900+ rated players online' => 'Pas assez de joueurs classés 1900+ en ligne',
        'Only for players rated 1800+' => 'Uniquement pour les joueurs classés 1800+',
        'in game' => 'dans le jeu',
        'score' => 'score',
        'Your current rank' => 'Votre rang actuel',
        'Server syncing..' => 'Synchronisation du serveur...',
        ' is making a turn.' => ' joue son tour.',
        'Your turn is next - get ready!' => 'C&#39;est bientôt ton tour, prépare-toi !',
        'switches pieces and skips turn' => 'change de place et passe son tour',
        "Game still hasn't started!" => 'Le match n&#39;a toujours pas commencé !',
        "Word wasn't found" => 'Le mot n&#39;a pas été trouvé.',
        'Correct' => 'Correct',
        'One-letter word' => 'Mot d&#39;une seule lettre',
        'Repeat' => 'Répéter',
        'costs' => 'frais',
        '+15 for all pieces used' => '+15 pour toutes les pièces utilisées',
        'TOTAL' => 'TOTAL',
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