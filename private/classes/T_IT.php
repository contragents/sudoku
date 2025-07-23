<?php

namespace classes;


use PaymentModel;
use UserModel;

class T_IT
{
    const PHRASES = [
        'Invalid URL format! <br />It must begin with <strong>http(s)://</strong>' => 'Formato URL non valido! <br />Deve iniziare con <strong>http(s)://</strong>',
        '</strong> or <strong>' => '</strong> o <strong>',
        'MB</strong>)</li><li>extension -<strong>' => 'Megabyte</strong>)</li><li>Estensione -<strong>',
        '<strong>File upload error!</strong><br /> Please review:<br /> <ul><li>file size (no more than <strong>'
        => '<strong>Errore durante il caricamento del file!</strong><br /> Si prega di rivedere:<br /> <ul><li>dimensione del file (non superiore a <strong>',
        'Error creating new payment' => 'Errore durante la creazione di un nuovo pagamento',
        'FAQ' => 'FAQ',
        'Agreement' => 'Accordo',
        'Empty value is forbidden' => 'Il valore vuoto è vietato',
        'Forbidden' => 'Proibito',
        'game_title' => [
            SudokuGame::GAME_NAME => 'Sudoku online con gli amici',
        ],
        'secret_prompt' => [
            SudokuGame::GAME_NAME => 'Salva questa chiave per il ripristino dell&#39;account in <a href="https://t.me/sudoku_app_bot">Telegram</a>',
        ],
        'COIN Balance' => 'Saldo COIN',
        PaymentModel::INIT_STATUS => 'Iniziato',
        PaymentModel::BAD_CONFIRM_STATUS => 'Conferma errata',
        PaymentModel::COMPLETE_STATUS => 'Completato',
        PaymentModel::FAIL_STATUS => 'Fallito',
        'Last transactions' => 'Ultime transazioni',
        'Support in Telegram' => 'Assistenza su Telegram',
        'Check_price' => 'Scopri <br>il prezzo',
        'Replenish' => 'Rifornire',
        'SUDOKU_amount' => 'Quantità di monete',
        'enter_amount' => 'importo',
        'Buy_SUDOKU' => 'Acquista monete SUDOKU',
        'The_price' => 'Offerta di prezzo',
        'calc_price' => 'prezzo',
        'Pay' => 'Pagare',
        'Congratulations to Player' => 'Congratulazioni al Giocatore',
        'Server sync lost' => 'Sincronizzazione server persa',
        'Server connecting error. Please try again' => 'Errore di connessione al server. Riprova.',
        'Error changing settings. Try again later' => 'Errore durante la modifica delle impostazioni. Riprova più tardi.',
        'invite_friend_prompt' => [
            SudokuGame::GAME_NAME => 'Partecipa al gioco online SUDOKU su Telegram! Ottieni il punteggio massimo, guadagna monete e preleva i gettoni sul tuo portafoglio.',
        ],
        'game_bot_url' => [
            SudokuGame::GAME_NAME => 'https://t.me/sudoku_app_bot',
        ],
        'loading_text' => 'SUDOKU in fase di caricamento...',
        'switch_tg_button' => 'Passa a Telegram',
        'Invite a friend' => 'Invita un amico',
        'you_lost' => 'Hai perso!',
        'you_won' => 'Hai vinto!',
        '[[Player]] won!' => '[[Player]] ha vinto!',
        'start_new_game' => 'Inizia una nuova partita',
        'rating_changed' => 'Modifica della valutazione: ',
        'Authorization error' => 'Errore di autorizzazione',
        'Error sending message' => 'Errore durante l&#39;invio del messaggio',
        // Рекорды
        'Got reward' => 'Ho ricevuto un premio',
        'Your passive income' => 'Il tuo reddito passivo',
        'will go to the winner' => 'andrà al vincitore',
        'Effect lasts until beaten' => 'L&#39;effetto dura fino a quando non viene sconfitto.',
        'per_hour' => 'ora',
        'rank position' => 'posizione di rango',
        'record of the year' => 'disco dell&#39;anno',
        'record of the month' => 'disco del mese',
        'record of the week' => 'disco della settimana',
        'record of the day' => 'disco del giorno',
        'game_price' => 'punti di gioco',
        'games_played' => 'partite giocate',
        'Games Played' => 'Partite giocate',
        'top' => 'top',
        'turn_price' => 'punti di svolta',
        'word_len' => 'lunghezza della parola',
        'word_price' => 'punti parola',
        UserModel::BALANCE_HIDDEN_FIELD => 'Utente nascosto',
        'top_year' => 'TOP 1',
        'top_month' => 'TOP 2',
        'top_week' => 'TOP 3',
        'top_day' => 'I 10 MIGLIORI',
        // Рекорды конец
        'Return to fullscreen mode?' => 'Torna alla modalità a schermo intero?',
        // Профиль игрока
        'Choose file' => 'Scegli file',
        'Back' => 'Indietro',
        'Wallet' => 'Portafoglio',
        'Referrals' => 'Segnalazioni',
        'Player ID' => 'ID giocatore',
        // complaints
        'Player is unbanned' => 'Il giocatore non è più bannato.',
        'Player`s ban not found' => 'Divieto di gioco non trovato',
        'Player not found' => 'Giocatore non trovato',
        // end complaints
        'Save' => 'Salva',
        'new nickname' => 'nuovo nome',
        'Input new nickname' => 'Inserisci nuovo nome',
        'Your rank' => 'Il tuo grado',
        'Ranking number' => 'Numero di classifica',
        'Balance' => 'Saldo',
        'Rating by coins' => 'Voto in monete',
        'Secret key' => 'Chiave segreta',
        'Link' => 'Legare',
        'Bonuses accrued' => 'Bonus maturati',
        'SUDOKU Balance' => 'Saldo SUDOKU',
        'Claim' => 'Reclamo',
        'Name' => 'Nome',
        // Профиль игрока конец
        'Nickname updated' => 'Nickname aggiornato',
        'Stats getting error' => 'Statistiche che generano errori',
        'Error saving Nick change' => 'Errore durante il salvataggio della modifica del nome utente',
        'Play at least one game to view statistics' => 'Gioca almeno una partita per visualizzare le statistiche',
        'Lost server synchronization' => 'Sincronizzazione server persa',
        'Closed game window' => 'Finestra di gioco chiusa',
        'You closed the game window and became inactive!' => 'Hai chiuso la finestra del gioco e sei diventato inattivo!',
        'Request denied. Game is still ongoing' => 'Richiesta respinta. Il gioco è ancora in corso.',
        'Request rejected' => 'Richiesta respinta',
        'No messages yet' => 'Nessun messaggio ancora',
        'New game request sent' => 'Richiesta di nuovo gioco inviata',
        'Your new game request awaits players response' => 'La tua nuova richiesta di gioco attende la risposta dei giocatori.',
        'Request was aproved! Starting new game' => 'La richiesta è stata approvata! Avvio di una nuova partita',
        'Default avatar is used' => 'Viene utilizzato l&#39;avatar predefinito.',
        'Avatar by provided link' => 'Avatar tramite link fornito',
        'Set' => 'IMPOSTA',
        'Avatar loading' => 'Caricamento avatar',
        'Send' => 'Invia',
        'Avatar URL' => 'URL dell&#39;avatar',
        'Apply' => 'Applicare',
        'Account key' => 'Chiave dell&#39;account',
        'Main account key' => 'Chiave dell&#39;account principale',
        'old account saved key' => 'chiave salvata dal vecchio account',
        'Key transcription error' => 'Errore di trascrizione chiave',
        "Player's ID NOT found by key" => 'ID giocatore NON trovato dalla chiave',
        'Accounts linked' => 'Account collegati',
        'Accounts are already linked' => 'Gli account sono già collegati',
        'Game is not started' => 'Il gioco non è iniziato',
        'OK' => 'OK',
        'Click to expand the image' => 'Clicca per ingrandire l&#39;immagine',
        'Report sent' => 'Rapporto inviato',
        'Report declined! Please choose a player from the list' => 'Segnalazione rifiutata! Scegli un giocatore dall&#39;elenco.',
        'Your report accepted and will be processed by moderator' => 'Il tuo rapporto è stato accettato e sarà elaborato dal moderatore.',
        'If confirmed, the player will be banned' => 'Se confermato, il giocatore verrà bandito.',
        'Report declined!' => 'Segnalazione rifiutata!',
        'Only one complaint per each player per day can be sent. Total 24 hours complaints limit is'
        => 'È possibile inviare un solo reclamo al giorno per ciascun giocatore. Il limite totale di reclami nelle 24 ore è di',
        'From player' => 'Dal giocatore',
        'To Player' => 'Al giocatore',
        'Awaiting invited players' => 'In attesa dei giocatori invitati',
        'Searching for players' => 'Ricerca di giocatori',
        'Searching for players with selected rank' => 'Ricerca di giocatori con grado selezionato',
        'Message NOT sent - BAN until ' => 'Messaggio NON inviato - BAN fino al ',
        'Message NOT sent - BAN from Player' => 'Messaggio NON inviato - BAN dal Giocatore',
        'Message sent' => 'Messaggio inviato',
        'Exit' => 'Uscita',
        'Appeal' => 'Appello',
        'There are no events yet' => 'Non ci sono ancora eventi',
        'Playing to' => 'Giocare fino a',
        'Just two players' => 'Solo due giocatori',
        'Up to four players' => 'Fino a quattro giocatori',
        'Game selection - please wait' => 'Selezione dei giochi - attendere prego',
        'Your turn!' => 'Tocca a te!',
        'Looking for a new game...' => 'Alla ricerca di un nuovo gioco...',
        'Get ready - your turn is next!' => 'Preparati, tocca a te!',
        'Take a break - your move in one' => 'Fai una pausa - tocca a te muovere',
        'Refuse' => 'Rifiutare',
        'Offer a game' => 'Offri un gioco',
        'Players ready:' => 'Giocatori pronti:',
        'Players' => 'Giocatori',
        'Try sending again' => 'Prova a inviare nuovamente',
        'Error connecting to server!' => 'Errore durante la connessione al server!',
        'You haven`t composed a single word!' => 'Non hai scritto nemmeno una parola!',
        'You will lose if you quit the game! CONTINUE?' => 'Se abbandoni il gioco, perderai! CONTINUARE?',
        'Cancel' => 'Annulla',
        'Confirm' => 'Conferma',
        'Revenge!' => 'Vendetta!',
        'Time elapsed:' => 'Tempo trascorso:',
        'Time limit:' => 'Limite di tempo:',
        'You can start a new game if you wait for a long time' => 'Puoi iniziare una nuova partita se aspetti a lungo.',
        'Close in 5 seconds' => 'Chiudi tra 5 secondi',
        'Close immediately' => 'Chiudi immediatamente',
        'Will close automatically' => 'Si chiuderà automaticamente',
        's' => ' secondi',
        'Average waiting time:' => 'Tempo medio di attesa:',
        'Waiting for other players' => 'In attesa di altri giocatori',
        'Game goal' => 'Obiettivo del gioco',
        'Rating of opponents' => 'Valutazione degli avversari',
        'new player' => 'nuovo giocatore',
        'CHOOSE GAME OPTIONS' => 'SCEGLI LE OPZIONI DI GIOCO',
        'Profile' => 'Profilo',
        'Error' => 'Errore',
        'Your profile' => 'Il tuo profilo',
        'Start' => 'Inizio',
        'Stats' => 'Statistiche',
        'Play on' => 'Gioca su',
        // Чат
        'Error sending complaint<br><br>Choose opponent' => 'Errore durante l&#39;invio del reclamo<br><br>Scegli l&#39;avversario',
        'You' => 'Tu',
        'to all: ' => 'A tutti: ',
        ' (to all):' => ' (a tutti):',
        'For everyone' => 'Per tutti',
        'Word matching' => 'Corrispondenza delle parole',
        'Player support and chat at' => 'Assistenza giocatori e chat su',
        'Join group' => 'Unisciti al gruppo',
        'Send an in-game message' => 'Invia un messaggio nel gioco',
        // Чат
        'News' => 'Notizie',
        // Окно статистика
        'Past Awards' => 'Premi precedenti',
        'Parties_Games' => 'Giochi',
        'Player`s achievements' => 'Risultati del giocatore',
        'Player Awards' => 'Premi ai giocatori',
        'Player' => 'Giocatore',
        'VS' => 'VS',
        'Rating' => 'Grado',
        'Opponent' => 'Avversario',
        'Active Awards' => 'Premi attivi',
        'Remove filter' => 'Rimuovi filtro',
        // Окно статистика конец

        "Opponent's rating" => 'Rating dell&#39;avversario',
        'Choose your MAX bet' => 'Scegli la tua puntata MAX',
        'Searching for players with corresponding bet' => 'Ricerca di giocatori con scommessa corrispondente',
        'Coins written off the balance sheet' => 'Monete cancellate dal bilancio',
        'Number of coins on the line' => 'Numero di monete sulla linea',
        'gets a win' => 'ottiene una vittoria',
        'The bank of' => 'La banca di',
        'goes to you' => 'va a te',
        'is taken by the opponent' => 'viene preso dall&#39;avversario',
        'Bid' => 'Offerta',
        'No coins' => 'Nessuna moneta',
        'Any' => 'Qualsiasi',
        'online' => 'online',
        'Above' => 'Sopra',
        'minutes' => 'minuti',
        'minute' => 'minuto',
        'Select the minimum opponent rating' => 'Seleziona il grado minimo dell&#39;avversario',
        'Not enough 1900+ rated players online' => 'Non ci sono abbastanza giocatori con rating superiore a 1900 online.',
        'Only for players rated 1800+' => 'Solo per giocatori con punteggio superiore a 1800',
        'in game' => 'nel gioco',
        'score' => 'punteggio',
        'Your current rank' => 'Il tuo grado attuale',
        'Server syncing..' => 'Sincronizzazione server...',
        ' is making a turn.' => ' sta effettuando una mossa.',
        'Your turn is next - get ready!' => 'È il tuo turno, preparati!',
        'switches pieces and skips turn' => 'cambia i pezzi e salta il turno.',
        "Game still hasn't started!" => 'Il gioco non è ancora iniziato!',
        "Word wasn't found" => 'La parola non è stata trovata',
        'Correct' => 'Corretto',
        'One-letter word' => 'Parola di una sola lettera',
        'Repeat' => 'Ripeti',
        'costs' => 'costi',
        '+15 for all pieces used' => '+15 per tutti i pezzi utilizzati',
        'TOTAL' => 'TOTALE',
        'You did not make any word' => 'Non hai detto nulla.',
        'is attempting to make a turn out of his turn (turn #' => 'sta cercando di fare una svolta dalla sua svolta (svolta n.',
        'Data processing error!' => 'Errore di elaborazione dei dati!',
        ' - turn processing error (turn #' => ' - Errore di elaborazione della svolta (svolta n.',
        "didn't make any word (turn #" => 'non ha detto nulla (turno n.',
        'set word lenght record for' => 'Imposta il record di lunghezza della parola per',
        'set word cost record for' => 'impostare il record di costo delle parole per',
        'set record for turn cost for' => 'stabilito il record per il costo di svolta per',
        'gets' => 'ottiene',
        'for turn #' => 'per la curva n.',
        'For all pieces' => 'Per tutti i pezzi',
        'Wins with score ' => 'Vittorie con punteggio ',
        'set record for gotten points in the game for' => 'ha stabilito il record di punti ottenuti nella partita per',
        'out of chips - end of game!' => 'senza fiches - fine del gioco!',
        'set record for number of games played for' => 'ha stabilito il record per il numero di partite giocate per',
        'is the only one left in the game - Victory!' => 'è l&#39;unico rimasto in gioco - Vittoria!',
        'left game' => 'partita lasciata',
        'has left the game' => 'ha lasciato il gioco',
        'is the only one left in the game! Start a new game' => 'È l&#39;unico rimasto in gioco! Inizia una nuova partita.',
        'Time for the turn ran out' => 'Il tempo a disposizione per il turno è scaduto.',
        "is left without any pieces! Winner - " => 'rimane senza pezzi! Vincitore -',
        ' with score ' => ' con punteggio di ',
        "is left without any pieces! You won with score " => 'è rimasto senza pezzi! Hai vinto con un punteggio di ',
        "gave up! Winner - " => 'Ha rinunciato! Vincitore - ',
        'skipped 3 turns! Winner - ' => 'Ha saltato 3 turni! Vincitore - ',
        'New game has started!' => 'Il nuovo gioco è iniziato!',
        'New game' => 'Nuovo gioco',
        'Accept invitation' => 'Accetta l&#39;invito',
        'Get' => 'Prendi',
        'score points' => 'guadagnare punti',
        "Asking for adversaries' approval." => 'Chiedere l&#39;approvazione degli avversari.',
        'Remaining in the game:' => 'Rimanere in gioco:',
        "You got invited for a rematch! - Accept?" => 'Sei stato invitato a una rivincita! - Accetti?',
        'All players have left the game' => 'Tutti i giocatori hanno abbandonato la partita.',
        "Your score" => 'Il tuo punteggio',
        'Turn time' => 'Tempo di rotazione',
        'Date' => 'Data',
        'Price' => 'Prezzo',
        'Status' => 'Stato',
        'Type' => 'Tipo',
        'Period' => 'Periodo',
        'Word' => 'Parola',
        'Points/letters' => 'Punti/lettere',
        'Result' => 'Risultato',
        'Opponents' => 'Adversaires',
        'Games<br>total' => 'Jeux<br>total',
        'Wins<br>total' => 'Victoires<br>total',
        'Gain/loss<br>in ranking' => 'Gain/perte<br>dans le classement',
        '% Wins' => '% de victoires',
        'Games in total' => 'Total des jeux',
        'Winnings count' => 'Les gains comptent',
        'Increase/loss in rating' => 'Augmentation/perte de notation',
        '% of wins' => '% de victoires',
        "GAME points - Year Record!" => 'Points DE JEU - Record annuel !',
        "GAME points - Month Record!" => 'Points DE JEU - Record du mois !',
        "GAME points - Week Record!" => 'Points DE JEU - Record semaine !',
        "GAME points - Day Record!" => 'Points DE JEU - Record du jour !',
        "TURN points - Year Record!" => 'Points TURN - Record annuel !',
        "TURN points - Month Record!" => 'Points TURN - Record du mois !',
        "TURN points - Week Record!" => 'Points TURN - Record semaine !',
        "TURN points - Day Record!" => 'Points TURN - Record du jour !',
        "WORD points - Year Record!" => 'Points WORD - Record annuel !',
        "WORD points - Month Record!" => 'Points WORD - Record du mois !',
        "WORD points - Week Record!" => 'Points WORD - Record semaine !',
        "WORD points - Day Record!" => 'Points WORD - Record du jour !',
        "Longest WORD - Year Record!" => 'Le mot le plus long - Record annuel !',
        "Longest WORD - Month Record!" => 'Le mot le plus long - Record du mois !',
        "Longest WORD - Week Record!" => 'Le mot le plus long - Record de la semana !',
        "Longest WORD - Day Record!" => 'Le mot le plus long - Record du jour !',
        "GAMES played - Year Record!" => 'JEUX joués - Record annuel !',
        "GAMES played - Month Record!" => 'JEUX joués - Record du mois !',
        "GAMES played - Week Record!" => 'MATCHS joués - Record de la semaine !',
        "GAMES played - Day Record!" => 'JEUX joués - Record de la journée !',
        "Victory" => 'Victoire',
        'Losing' => 'Perdre',
        "Go to player's stats" => 'Accéder aux statistiques du joueur',
        'Filter by player' => 'Filtrer par joueur',
        'Apply filter' => 'Appliquer le filtre',
        'against' => 'contre',
        "File loading error!" => 'Erreur de chargement du fichier !',
        "Check:" => 'Vérifier :',
        "file size (less than " => 'taille du fichier (moins de',
        "Incorrect URL format!" => 'Format d&#39;URL incorrect !',
        "Must begin with " => 'Doit commencer par ',
        'Error! Choose image file with the size not more than' => 'Erreur ! Choisissez un fichier image dont la taille ne dépasse pas',
        'Avatar updated' => 'Avatar mis à jour',
        "Error saving new URL" => 'Erreur lors de l&#39;enregistrement de la nouvelle URL',
        'A player may open more than one cell and more than one KEY in one turn. Use the CASCADES rule'
        => 'Un joueur peut ouvrir plusieurs cases et plusieurs CLÉS en un seul tour. Utilisez la règle CASCADES.',
        'If after the automatic opening of a number, new blocks of EIGHT open cells are formed on the field, such blocks are also opened by CASCADE'
        => 'Si, après l&#39;ouverture automatique d&#39;un numéro, de nouveaux blocs de HUIT cases ouvertes se forment sur le champ, ces blocs sont également ouverts par CASCADE.',
        'If a player has opened a cell (solved a number in it) and there is only ONE closed digit left in the block, this digit is opened automatically'
        => 'Si un joueur a ouvert une case (résolu un nombre qui s&#39;y trouvait) et qu&#39;il ne reste qu&#39;UN SEUL chiffre fermé dans le bloc, ce chiffre est automatiquement ouvert.',
        'is awarded for solved empty cell' => 'est attribué pour une cellule vide résolue',
        'by calculating all of other 8 digits in a block - vertically OR horizontally OR in a 3x3 square'
        => 'en calculant tous les autres 8 chiffres d&#39;un bloc - verticalement OU horizontalement OU dans un carré 3x3',
        "The players' task is to take turns making moves and accumulating points to open black squares"
        => 'La tâche des joueurs consiste à jouer à tour de rôle et à accumuler des points pour ouvrir les cases noires.',
        'The classic SUDOKU rules apply - in a block of nine cells (vertically, horizontally and in a 3x3 square) the numbers must not be repeated'
        => 'Les règles classiques du SUDOKU s&#39;appliquent : dans un bloc de neuf cases (verticalement, horizontalement et dans un carré 3x3), les chiffres ne doivent pas se répéter.',
        'faq_rules' => [
            SudokuGame::GAME_NAME => <<<FR
<h2 id="nav1">À propos du jeu</h2>
Les règles classiques du SUDOKU s'appliquent : dans un bloc de neuf cases (verticalement, horizontalement et dans un carré 3x3), les chiffres ne doivent pas se répéter.
<br><br>
La tâche des joueurs consiste à jouer à tour de rôle et à accumuler des points pour ouvrir les cases noires (<span style="color:#0f0">+10 points</span>) en calculant les 8 autres chiffres d'un bloc - verticalement OU horizontalement OU dans un carré 3x3.
<br><br>
Un <span style="color:#0f0">point +1</span> est attribué pour chaque cellule vide résolue.
<br><br>
La victoire revient au joueur qui marque 50 % de tous les points possibles + 1 point.
<br><br>
Si un joueur a ouvert une case (résolu un nombre qui s'y trouvait) et qu'il ne reste qu'UN SEUL chiffre fermé dans le bloc, ce chiffre est automatiquement ouvert.
<br><br>
Si, après l'ouverture automatique d'un numéro, de nouveaux blocs de HUIT cases ouvertes se forment sur le champ, ces blocs sont également ouverts par CASCADE.
<br><br>
Un joueur peut ouvrir plusieurs cases et plusieurs CLÉS en un seul tour. Utilisez la règle CASCADES.
<br><br>
En cas de déplacement erroné (le chiffre dans la case est incorrect), un petit chiffre rouge apparaît sur cette case, visible par les deux joueurs. Ce chiffre ne peut plus être placé sur cette case.
<br><br>
En utilisant le bouton « Vérifier », le joueur peut faire une marque, c'est-à-dire inscrire un petit chiffre vert dans la case. Il peut s'agir d'un chiffre calculé dont le joueur est sûr, ou simplement d'une supposition. Utilisez des notes comme dans un SUDOKU normal : l'autre joueur ne peut pas les voir.
FR
            ,
        ],
        'faq_rating' => <<<FR
Classement Elo
<br><br>
Système de classement Elo, coefficient Elo - méthode de calcul de la force relative des joueurs dans les jeux impliquant deux joueurs (par exemple, les échecs, les dames ou le shogi, le go).
<br>
Ce système de classement a été développé par le professeur de physique américain d'origine hongroise Arpad Elo (en hongrois : Élő Árpád ; 1903-1992).
<br><br>
Plus la différence de classement entre les joueurs est grande, moins le joueur le plus fort obtiendra de points lorsqu'il gagnera.
<br> 
À l'inverse, un joueur plus faible obtiendra plus de points pour son classement s'il bat un joueur plus fort.
<br><br>
Ainsi, il est plus avantageux pour un joueur fort de jouer avec des adversaires de même niveau : si vous gagnez, vous obtenez plus de points, et si vous perdez, vous ne perdez pas beaucoup de points.
<br><br>
Un débutant peut sans danger affronter un maître expérimenté.
<br>La perte de classement en cas de défaite sera minime.
<br>Mais, en cas de victoire, le maître partagera généreusement les points de classement.
FR
        ,
        'faq_rewards' => [
            SudokuGame::GAME_NAME => <<<FR
Les joueurs sont récompensés pour certaines réalisations (records).
<br><br>
Les récompenses du joueur sont indiquées dans la section « STATS » dans les catégories suivantes : or/argent/bronze/pierre.
<br><br>
Lorsqu'il reçoit une carte de récompense, le joueur reçoit un bonus de pièces SUDOKU {{sudoku_icon}}<br> 
Les pièces peuvent être utilisées dans un mode de jeu spécial dédié "AUX PIÈCES". Vous pouvez recharger votre portefeuille dans le jeu 
et retirer des pièces du jeu. Pour en savoir plus, consultez l'onglet « Mode de jeu avec pièces ».
<br><br>
Tant que le record d'un joueur n'a pas été battu par un autre joueur, la carte de récompense est affichée pour ce joueur dans l'onglet « RÉCOMPENSES ACTIVES » de la section « STATISTIQUES ».
<br><br>
Chaque « Récompense Active » toutes les heures génère un « profit » supplémentaire en pièces.
<br><br>
Si un record a été battu par un autre joueur, la carte de récompense de l'ancien détenteur du record est déplacée vers l'onglet « RÉCOMPENSES PASSÉES » et cesse de générer des revenus passifs. 
<br><br>
Le nombre total de pièces reçues (bonus uniques et bénéfices supplémentaires) peut être consulté dans la section « PROFIL » de l'onglet « Portefeuille », respectivement dans les champs « Solde SUDOKU » et « Bonus accumulés ».
<br><br>
Lorsque le joueur dépasse son propre record pour les réalisations « PARTIES JOUÉES », il ne reçoit pas de nouvelle carte de récompense ni de nouvelles pièces.
La valeur du record (nombre de parties / nombre d'amis) est mise à jour sur la carte de récompense.
<br><br>
Par exemple, si un joueur a déjà obtenu le succès « JEUX JOUÉS »
(or) pour 10 000 jeux, alors lorsque le nombre de jeux de ce joueur passe à 10 001, aucune carte de récompense ne sera délivrée au détenteur du record.
FR
            ,
        ],
        'Reward' => 'Ödül',
        'faq_coins' => [
            SudokuGame::GAME_NAME => <<<FR
La pièce <strong>SUDOKU</strong> {{sudoku_icon}} est une monnaie utilisée dans le jeu {{yandex_exclude}}{{ pour un réseau de jeux - <strong>Scrabble, Sudoku</strong><br><br>
Un seul compte pour tous les jeux, une seule monnaie, un seul portefeuille}}
<br><br>
{{yandex_exclude}}{{Dans le monde des cryptomonnaies, cette monnaie est également appelée SUDOKU. Bientôt, il sera possible de retirer n'importe quel nombre de SUDOKU de votre portefeuille dans le jeu vers un portefeuille externe sur le réseau TON (Telegram).
<br><br>}}
En attendant, nous essayons de gagner autant de pièces que possible dans le jeu en sélectionnant le mode « Pièces ».
<br><br>
This mode also takes into account and accrues player rankings.
<br>
However, coins won by the results of the game are now credited to your wallet (or deducted if you lose)
<br><br>
Depending on the current balance of coins in your wallet, you are offered to play for 1, 5, 10, etc. coins - choose the desired amount from the list
<br><br>
Après avoir appuyé sur le bouton « Démarrer », la recherche d'un adversaire également prêt à miser le montant spécifié commencera.
<br><br> 
Par exemple, vous avez spécifié que votre mise était de 5 pièces, et parmi ceux qui commencent une nouvelle partie, seuls certains sont prêts à miser 1 pièce.
<br>
Dans ce cas, la mise pour vous et pour ce joueur sera de 1 pièce, soit la plus petite des deux options.
<br><br>
Si quelqu'un est prêt à miser 10 pièces, votre mise de 5 pièces sera sélectionnée et le jeu commencera avec une banque de 10 pièces (5 + 5).
<br><br>
Dans un jeu à deux joueurs, le gagnant remporte l'intégralité du pot, c'est-à-dire sa mise et celle de son adversaire.
<br><br>
Dans une partie à trois joueurs, le gagnant remporte sa mise et celle du dernier joueur (celui qui a le moins de points). 
Le joueur du milieu (le deuxième) récupère sa mise et conserve ses pièces.
<br><br>
Dans une partie à quatre joueurs, le pot est partagé entre les joueurs en 1ère et 4ème position (le premier joueur remporte les deux mises), 
et les joueurs en 2ème et 3ème position (le deuxième remporte les deux mises).
<br><br>
Ainsi, jouer trois et quatre devient moins risqué en termes d'économies de pièces.
<br><br>
Si tous les joueurs perdants ont le même nombre de points, le joueur gagnant remporte toutes les mises.
<br><br>
Dans une partie à quatre joueurs, si les joueurs classés 2e et 3e obtiennent le même nombre de points, ils récupèrent leur mise et conservent leurs paris.
<br><br>
Le nouveau classement est calculé comme d'habitude dans tous les cas - voir l'onglet « Classement ».
<br><br>
<h2>Comment recharger votre portefeuille</h2>
<ol>
<li>
Chaque nouveau joueur reçoit {{stone_reward}} {{yandex_exclude}}{{SUDOKU}} pièces de monnaie sur son solde et peut immédiatement participer à la course aux gros gains.
</li>
<li>
Vous recevrez {{stone_reward}} pièces pour chaque ami qui rejoint le jeu en utilisant votre lien de parrainage.
De plus, si vous établissez un record (quotidien, hebdomadaire, mensuel ou annuel) du nombre d'invités, vous serez récompensé. Pour inviter un utilisateur, vous devez vous connecter au jeu via Telegram.
</li>
<li>
Des pièces sont attribuées pour les performances réalisées dans le jeu (points par partie, points par coup, points par mot, nombre de parties, nombre d'invités, classement de la 1re à la 10e place).
</li>
<li>
Pour chaque série de 100 parties, {{stone_reward}} pièces {{yandex_exclude}}{{SUDOKU }} sont attribuées.
</li>
{{yandex_exclude}}{{<li>
Achetez des pièces contre des roubles par virement bancaire
</li>
<li>Acheter des pièces pour la cryptomonnaie (bientôt disponible)
</li>}}
</ol>

<br>
Le nombre de pièces attribuées pour chaque succès peut varier au fil du temps, à la hausse ou à la baisse. La récompense réelle est indiquée sur la carte de succès.
<br><br>
<h2>Ce que vous pouvez faire avec les pièces que vous gagnez</h2>
<ol>
<li>
Jouez à nos jeux, augmentez les enjeux, ajoutez du piquant et de l'intérêt à votre passe-temps favori.
</li>
{{yandex_exclude}}{{<li>
Vendez des pièces contre des roubles ou contre des cryptomonnaies (bientôt) et recevez votre récompense en argent réel.
</li>}}
{{yandex_exclude}}{{<li>
Offrez un cadeau à un autre joueur en lui envoyant le nombre de pièces de votre choix depuis votre portefeuille (bientôt disponible).
</li>}}   
</ol>
<br>
Vous pouvez consulter le détail du solde de votre portefeuille dans l'onglet « Portefeuille » du menu « PROFIL ».
<br><br>
<strong>Bonus accumulés</strong> - résultat des gains passifs accumulés toutes les heures en fonction des performances du joueur (menu « STATS », section « Récompenses »).
<br>Les bonus peuvent être transférés vers le solde en appuyant sur le bouton « RÉCLAMER ».
<br><br>
<strong>{{yandex_exclude}}{{SUDOKU}} Solde</strong> - solde actuel des pièces sans bonus. Les pièces sont déduites/créditées en fonction des résultats du jeu.
<br><br>
Les cartes de réussite, semblables à des médailles, sont un indicateur de votre succès. 
<br>
Elles comprennent le nom de la réussite, la période (année, jour, semaine, mois), le nombre de points (note, longueur du texte, nombre d'amis) et le nombre de pièces. 
<br><br>
Le gain passif de pièces s'arrête lorsque votre record est battu par un autre joueur.
FR,
        ],
        '[[Player]] opened [[number]] [[cell]]' => '[[Player]] a ouvert [[number]] [[cell]]',
        ' (including [[number]] [[key]])' => ' (dont [[number]] [[key]])',
        '[[Player]] made a mistake' => '[[Player]] a commis une erreur.',
        'You made a mistake!' => 'Vous avez fait une erreur !',
        'Your opponent made a mistake' => 'Votre adversaire a commis une erreur.',
        '[[Player]] gets [[number]] [[point]]' => '[[Player]] obtient [[number]] [[point]].',
        '[[number]] [[point]]' => '[[number]] [[point]]',
        'You got [[number]] [[point]]' => 'Vous avez obtenu [[number]] [[point]].',
        'Your opponent got [[number]] [[point]]' => 'Votre adversaire a obtenu [[number]] [[point]].',
    ];
}