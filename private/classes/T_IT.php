<?php

namespace classes;


use PaymentModel;
use UserModel;

class T_IT
{
    const PHRASES = [
        'demo_expire_in_[[number]]_[[day]]'
        => 'Questa è una versione demo di SUDOKU. Il periodo di prova terminerà tra [[number]] [[day]].',
        'demo_expired_message'
        => 'Questa è una versione DEMO di SUDOKU. Il periodo di prova è terminato. Acquista la versione completa o visita il sito web del gioco.',
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
            SudokuGame::GAME_NAME => '&#42;Salva questa chiave per il ripristino dell&#39;account in <a href="https://t.me/sudoku_app_bot">Telegram</a>',
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
        'Opponents' => 'Avversari',
        'Games<br>total' => 'Giochi<br>totale',
        'Wins<br>total' => 'Vittorie<br>totali',
        'Gain/loss<br>in ranking' => 'Guadagno/perdita<br>in classifica',
        '% Wins' => '% Vittorie',
        'Games in total' => 'Giochi in totale',
        'Winnings count' => 'Le vincite contano',
        'Increase/loss in rating' => 'Aumento/perdita di rating',
        '% of wins' => '% di vittorie',
        "GAME points - Year Record!" => 'Punti GAME - Record annuale!',
        "GAME points - Month Record!" => 'Punti GAME - Record mensile!',
        "GAME points - Week Record!" => 'Punti GAME - Record settimanale!',
        "GAME points - Day Record!" => 'Punti GAME - Record giornaliero!',
        "TURN points - Year Record!" => 'Punti di SVOLTA - Record annuale!',
        "TURN points - Month Record!" => 'Punti di SVOLTA - Record mensile!',
        "TURN points - Week Record!" => 'Punti di SVOLTA - Record settimanale!',
        "TURN points - Day Record!" => 'Punti di SVOLTA - Record giornaliero!',
        "WORD points - Year Record!" => 'Punti PAROLA - Record annuale!',
        "WORD points - Month Record!" => 'Punti PAROLA - Record mensile!',
        "WORD points - Week Record!" => 'Punti PAROLA - Record settimanale!',
        "WORD points - Day Record!" => 'Punti PAROLA - Record giornaliero!',
        "Longest WORD - Year Record!" => 'Parola più lunga - Record annuale!',
        "Longest WORD - Month Record!" => 'Parola più lunga - Record mensile!',
        "Longest WORD - Week Record!" => 'Parola più lunga - Record settimanale!',
        "Longest WORD - Day Record!" => 'Parola più lunga - Record giornaliero!',
        "GAMES played - Year Record!" => 'PARTITE giocate - Record annuale!',
        "GAMES played - Month Record!" => 'PARTITE giocate - Record mensile!',
        "GAMES played - Week Record!" => 'PARTITE giocate - Record settimanale!',
        "GAMES played - Day Record!" => 'PARTITE giocate - Record giornaliero!',
        "Victory" => 'Vittoria',
        'Losing' => 'Perdere',
        "Go to player's stats" => 'Vai alle statistiche del giocatore',
        'Filter by player' => 'Filtra per giocatore',
        'Apply filter' => 'Applica filtro',
        'against' => 'contro',
        "File loading error!" => 'Errore durante il caricamento del file!',
        "Check:" => 'Controllare:',
        "file size (less than " => 'dimensione del file (inferiore a ',
        "Incorrect URL format!" => 'Formato URL errato!',
        "Must begin with " => 'Deve iniziare con ',
        'Error! Choose image file with the size not more than' => 'Errore! Scegli un file immagine con dimensioni non superiori a',
        'Avatar updated' => 'Avatar aggiornato',
        "Error saving new URL" => 'Errore durante il salvataggio del nuovo URL',
        'A player may open more than one cell and more than one KEY in one turn. Use the CASCADES rule'
        => 'Un giocatore può aprire più di una casella e più di una CHIAVE in un turno. Utilizza la regola CASCADES.',
        'If after the automatic opening of a number, new blocks of EIGHT open cells are formed on the field, such blocks are also opened by CASCADE'
        => 'Se dopo l&#39;apertura automatica di un numero, sul campo si formano nuovi blocchi di OTTO caselle aperte, anche tali blocchi vengono aperti da CASCADE.',
        'If a player has opened a cell (solved a number in it) and there is only ONE closed digit left in the block, this digit is opened automatically'
        => 'Se un giocatore ha aperto una casella (risolvendo un numero al suo interno) e nel blocco rimane solo UNA cifra chiusa, questa cifra viene aperta automaticamente.',
        'is awarded for solved empty cell' => 'viene assegnato per una cella vuota risolta',
        'by calculating all of other 8 digits in a block - vertically OR horizontally OR in a 3x3 square'
        => 'calcolando tutte le altre 8 cifre in un blocco - verticalmente O orizzontalmente O in un quadrato 3x3',
        "The players' task is to take turns making moves and accumulating points to open black squares"
        => 'Il compito dei giocatori è quello di effettuare mosse a turno e accumulare punti per aprire le caselle nere.',
        'The classic SUDOKU rules apply - in a block of nine cells (vertically, horizontally and in a 3x3 square) the numbers must not be repeated'
        => 'Si applicano le regole classiche del SUDOKU: in un blocco di nove caselle (in verticale, in orizzontale e in un quadrato 3x3) i numeri non devono ripetersi.',
        'faq_rules' => [
            SudokuGame::GAME_NAME => <<<IT
<h2 id="nav1">Informazioni sul gioco</h2>
Si applicano le regole classiche del SUDOKU: in un blocco di nove caselle (in verticale, in orizzontale e in un quadrato 3x3) i numeri non devono ripetersi.
<br><br>
Il compito dei giocatori è quello di effettuare mosse a turno e accumulare punti per aprire le caselle nere (<span style="color:#0f0">+10 punti</span>) calcolando tutte le altre 8 cifre in un blocco - verticalmente O orizzontalmente O in un quadrato 3x3.
<br><br>
Viene assegnato un <span style="color:#0f0">+1 punto</span> per ogni casella vuota risolta.
<br><br>
La vittoria va al giocatore che ottiene il 50% di tutti i punti possibili +1 punto.
<br><br>
Se un giocatore ha aperto una casella (risolvendo un numero al suo interno) e nel blocco rimane solo UNA cifra chiusa, questa cifra viene aperta automaticamente.
<br><br>
Se dopo l'apertura automatica di un numero, sul campo si formano nuovi blocchi di OTTO caselle aperte, anche tali blocchi vengono aperti da CASCADE
<br><br>
Un giocatore può aprire più di una casella e più di una CHIAVE in un turno. Utilizza la regola CASCADES
<br><br>
In caso di mossa errata (il numero nella casella è sbagliato), su questa casella compare un piccolo numero rosso di errore, visibile a entrambi i giocatori. Questo numero non può essere inserito nuovamente in questa casella.
<br><br>
Utilizzando il pulsante Controlla, il giocatore può inserire un segno, ovvero un piccolo numero verde nella casella. Può trattarsi di un numero calcolato di cui il giocatore è sicuro o semplicemente di un'ipotesi. Utilizza le note come in un normale SUDOKU: l'altro giocatore non può vederle.
IT
            ,
        ],
        'faq_rating' => <<<IT
Classifica Elo
<br><br>
Sistema di classificazione Elo, coefficiente Elo: metodo di calcolo della forza relativa dei giocatori nei giochi 
che coinvolgono due giocatori (ad esempio scacchi, dama o shogi, go).
<br>
Questo sistema di classificazione è stato sviluppato dal professore di fisica americano di origine ungherese Arpad Elo (in ungherese: Élő Árpád; 1903-1992)
<br><br>
Maggiore è la differenza di punteggio tra i giocatori, minore sarà il numero di punti che il giocatore più forte otterrà in caso di vittoria.
<br> 
Al contrario, un giocatore più debole otterrà più punti per la classifica se sconfigge un giocatore più forte.
<br><br>
Pertanto, è più vantaggioso per un giocatore forte giocare con avversari di pari livello: se vince, ottiene più punti, e se perde, non perde molti punti.
<br><br>
È sicuro per un principiante combattere contro un maestro esperto.
<br>
La perdita di ranking in caso di sconfitta sarà minima.
<br>
Ma, in caso di vittoria, il maestro condividerà generosamente i punti di ranking.
IT
        ,
        'faq_rewards' => [
            SudokuGame::GAME_NAME => <<<IT
I giocatori vengono premiati per determinati risultati (record).
<br><br>
I premi dei giocatori sono riportati nella sezione “STATISTICHE” nelle seguenti categorie: oro/argento/bronzo/pietra.
<br><br>
Quando riceve una carta premio, il giocatore riceve un bonus di monete SUDOKU {{sudoku_icon}}
<br>
Le monete possono essere utilizzate in una modalità di gioco speciale dedicata alle monete, è possibile ricaricare il proprio portafoglio di gioco
e prelevare monete dal gioco - per ulteriori informazioni, consultare la scheda “Modalità di gioco con monete”.
<br><br>
Finché il record di un giocatore non viene superato da un altro giocatore, la carta premio viene visualizzata per quel giocatore nella scheda “PREMI ATTIVI” della sezione “STATISTICHE”.
<br><br>
Ogni “Premio ATTIVO” ogni ora genera un “profitto” aggiuntivo in monete.
<br><br>
Se un record è stato battuto da un altro giocatore, la carta premio del precedente detentore del record viene spostata nella scheda “PREMI PASSATI” e smette di generare reddito passivo. 
<br><br>
Il numero totale di monete ricevute (bonus una tantum e profitti aggiuntivi) può essere visualizzato nella sezione “PROFILO” nella scheda ‘Portafoglio’ nei campi “Saldo SUDOKU” e “Bonus accumulati”, rispettivamente.
<br><br>
Quando si supera il proprio record per i risultati “PARTITE GIOCATE”, il giocatore non riceve nuovamente una nuova carta ricompensa o monete. 
Il valore del record stesso (numero di partite / numero di amici) viene aggiornato sulla carta ricompensa.
<br><br>
Ad esempio, se un giocatore ha già ottenuto l'obiettivo “GAMES PLAYED”
(oro) per 10.000 partite, quando il numero di partite di questo giocatore passa a 10.001, non verranno più emesse carte premio al detentore del record.
IT
            ,
        ],
        'Reward' => 'Ricompensa',
        'faq_coins' => [
            SudokuGame::GAME_NAME => <<<IT
La moneta <strong>SUDOKU</strong> {{sudoku_icon}} è una valuta{{yandex_exclude}}{{ utilizzabile all'interno di una rete di giochi, tra cui <strong>Scrabble, Sudoku</strong><br><br>
Un unico account per tutti i giochi, un'unica valuta, un unico portafoglio.}}
<br><br>
{{yandex_exclude}}{{Nel mondo delle criptovalute, la moneta è chiamata anche SUDOKU. Presto sarà possibile prelevare qualsiasi quantità di monete SUDOKU dal proprio portafoglio di gioco e trasferirle su un portafoglio esterno nella rete TON (Telegram).
<br><br>}}
Nel frattempo, cerchiamo di vincere il maggior numero possibile di monete nel gioco selezionando la modalità “Monete”.
<br><br>

Questa modalità tiene conto anche delle classifiche dei giocatori e le accumula.
<br>
Tuttavia, le monete vinte in base ai risultati della partita vengono ora accreditate sul tuo portafoglio (o detratte in caso di sconfitta).
<br><br>
A seconda del saldo attuale delle monete nel tuo portafoglio, ti viene offerto di giocare per 1, 5, 10, ecc. monete: scegli l'importo desiderato dall'elenco.
<br><br>
Dopo aver premuto il pulsante “Avvia”, inizierà la ricerca di un avversario che sia anch'esso pronto a scommettere l'importo specificato.
<br><br> 
Ad esempio, hai specificato che la tua puntata è di 5 gettoni, ma tra i giocatori che iniziano una nuova partita ci sono solo quelli disposti a puntare 1 gettone.
<br>
In tal caso, la puntata sia per te che per quel giocatore sarà di 1 gettone, ovvero il valore minore tra le due opzioni.
<br><br>
Nel caso in cui ci sia qualcuno disposto a giocare per 10 monete, verrà selezionata la tua puntata di 5 e il gioco inizierà con un banco di 10 monete - 5+5.
<br><br>
In una partita a due, il vincitore ottiene l'intero piatto, ovvero la sua puntata e quella del suo avversario.
<br><br>
In una partita a tre, il vincitore prende la sua puntata e quella dell'ultimo giocatore (il giocatore con il punteggio più basso). 
Il giocatore al secondo posto (il secondo classificato) recupera la sua puntata, conservando le sue monete.
<br><br>
In una partita a quattro giocatori, il piatto viene diviso tra i giocatori al 1° e al 4° posto (il primo giocatore prende entrambe le puntate) 
e i giocatori al 2° e al 3° posto (il secondo prende entrambe le puntate).
<br><br>
Pertanto, giocare tre e quattro diventa meno rischioso in termini di risparmio di monete.
<br><br>
Se tutti i giocatori perdenti hanno lo stesso numero di punti, il giocatore vincente si aggiudica tutte le puntate.
<br><br>
In una partita a quattro, se il secondo e il terzo giocatore ottengono lo stesso numero di punti, recuperano la loro puntata, mantenendo le loro scommesse.
<br><br>
Il nuovo punteggio in tutti i casi viene calcolato come di consueto - vedi la scheda “Classifica”.
<br><br>
<h2>Come ricaricare il tuo portafoglio</h2>
<ol>
<li>
Ogni nuovo giocatore riceve {{stone_reward}} {{yandex_exclude}}{{SUDOKU}} monete di benvenuto sul proprio saldo e può partecipare immediatamente alla corsa per grandi vincite.
</li>
<li>
Riceverai {{stone_reward}} monete per ogni amico che accede al gioco utilizzando il tuo link di riferimento.
Inoltre, stabilendo un record (giornaliero, settimanale, mensile o annuale) nel numero di invitati, riceverai un premio. Per invitare un utente, devi accedere al gioco tramite Telegram.
</li>
<li>
Le monete vengono assegnate per i risultati ottenuti nel gioco (punti per partita, punti per mossa, punti per parola, numero di partite, numero di invitati, posizione in classifica da #1 a #10).
</li>
<li>
Per ogni 100 partite, vengono assegnati {{stone_reward}} di {{yandex_exclude}}{{SUDOKU }} monete.
</li>
{{yandex_exclude}}{{<li>
Acquista monete con rubli tramite bonifico bancario
</li>
<li>Acquista monete per criptovaluta (presto disponibile)
</li>}}
</ol>

<br>
Il numero di monete assegnate per ogni risultato può variare nel tempo, aumentando o diminuendo. Il premio effettivo è indicato nella scheda dei risultati.
<br><br>
<h2>Cosa puoi fare con le monete che vinci</h2>
<ol>
<li>
Gioca ai nostri giochi, aumentando la posta in gioco, aggiungendo emozioni e interesse al tuo passatempo preferito.
</li>
{{yandex_exclude}}{{<li>
Vendi monete in cambio di rubli o criptovalute (presto disponibili) e ricevi il tuo compenso in denaro reale.
</li>}}
{{yandex_exclude}}{{<li>
Fai un regalo a un altro giocatore inviandogli un numero qualsiasi di monete dal tuo portafoglio (in arrivo)
</li>}}   
</ol>
<br>
Puoi trovare i dettagli del saldo del tuo portafoglio nella scheda “Portafoglio” del menu “PROFILO”.
<br><br>
<strong>Bonus accumulati</strong> - il risultato dei guadagni passivi accumulati ogni ora in base ai risultati ottenuti dal giocatore (menu “STATISTICHE”, sezione “Premi”).
<br>
I bonus possono essere trasferiti al saldo premendo il pulsante “RICHIEDI”.
<br><br>
<strong>{{yandex_exclude}}{{SUDOKU}} Saldo</strong> - saldo attuale delle monete senza bonus. Le monete vengono detratte/accreditate in base ai risultati del gioco.
<br><br>
Le carte dei risultati, simili alle medaglie, sono un indicatore del tuo successo. 
<br>Includono il nome del risultato, il periodo (anno, giorno, settimana, mese), il numero di punti (valutazione, lunghezza delle parole, numero di amici) e il numero di monete. 
<br><br>
Il guadagno passivo di monete si interrompe quando il tuo record viene battuto da un altro giocatore.
IT,
        ],
        '[[Player]] opened [[number]] [[cell]]' => '[[Player]] ha aperto [[number]] [[cell]]',
        ' (including [[number]] [[key]])' => ' (inclusa [[number]] [[key]])',
        '[[Player]] made a mistake' => '[[Player]] ha commesso un errore',
        'You made a mistake!' => 'Hai commesso un errore!',
        'Your opponent made a mistake' => 'Il tuo avversario ha commesso un errore.',
        '[[Player]] gets [[number]] [[point]]' => '[[Player]] ottiene [[number]] [[point]].',
        '[[number]] [[point]]' => '[[number]] [[point]]',
        'You got [[number]] [[point]]' => 'Hai ottenuto [[number]] [[point]].',
        'Your opponent got [[number]] [[point]]' => 'Il tuo avversario ha ottenuto [[number]] [[point]].',
    ];
}