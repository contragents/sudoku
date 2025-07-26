<?php

namespace classes;


use PaymentModel;
use UserModel;

class T_DE
{
    const PHRASES = [
        'Invalid URL format! <br />It must begin with <strong>http(s)://</strong>' => 'Formato de URL no válido! <br />Debe empezar por <strong>http(s)://</strong>',
        '</strong> or <strong>' => '</strong> o <strong>',
        'MB</strong>)</li><li>extension -<strong>' => 'MB</strong>)</li><li>extensión -<strong>',
        '<strong>File upload error!</strong><br /> Please review:<br /> <ul><li>file size (no more than <strong>'
        => '<strong>Error al cargar el archivo.</strong><br /> Por favor, revisa:<br /> <ul><li>tamaño del archivo (no más de <strong>',
        'Error creating new payment' => 'Error al crear un nuevo pago',
        'FAQ' => 'FAQ',
        'Agreement' => 'Acuerdo',
        'Empty value is forbidden' => 'El valor vacío está prohibido',
        'Forbidden' => 'Prohibido',
        'game_title' => [
            SudokuGame::GAME_NAME => 'Sudoku en línea con amigos',
        ],
        'secret_prompt' => [
            SudokuGame::GAME_NAME => '&#42;Guarda esta clave para restablecer la cuenta en <a href="https://t.me/sudoku_app_bot">Telegrama</a>.',
        ],
        'COIN Balance' => 'Saldo de monedas',
        PaymentModel::INIT_STATUS => 'Comenzó',
        PaymentModel::BAD_CONFIRM_STATUS => 'Mala confirmación',
        PaymentModel::COMPLETE_STATUS => 'Completado',
        PaymentModel::FAIL_STATUS => 'Fallido',
        'Last transactions' => 'Últimas transacciones',
        'Support in Telegram' => 'Soporte en Telegram',
        'Check_price' => 'Consultar precio',
        'Replenish' => 'Reponga',
        'SUDOKU_amount' => 'Cantidad de monedas',
        'enter_amount' => 'importe',
        'Buy_SUDOKU' => 'Comprar monedas SUDOKU',
        'The_price' => 'Oferta de precio',
        'calc_price' => 'precio',
        'Pay' => 'Pagar',
        'Congratulations to Player' => 'Enhorabuena al Jugador',
        'Server sync lost' => 'Pérdida de sincronización con el servidor',
        'Server connecting error. Please try again' => 'Error de conexión del servidor. Por favor, inténtelo de nuevo',
        'Error changing settings. Try again later' => 'Error al cambiar la configuración. Vuelva a intentarlo más tarde',
        'invite_friend_prompt' => [
            SudokuGame::GAME_NAME => '¡Únete al juego online SUDOKU en Telegram! Consigue la máxima puntuación, gana monedas y retira tokens a tu monedero.',
        ],
        'game_bot_url' => [
            SudokuGame::GAME_NAME => 'https://t.me/sudoku_app_bot',
        ],
        'loading_text' => [SudokuGame::GAME_NAME => 'SUDOKU está cargando...'],
        'switch_tg_button' => 'Cambiar a Telegram',
        'Invite a friend' => 'Invitar a un amigo',
        'you_lost' => '¡Has perdido!',
        'you_won' => '¡Has ganado!',
        '[[Player]] won!' => '[[Player]] ¡ganó!',
        'start_new_game' => 'Empezar una nueva partida',
        'rating_changed' => 'Cambio de calificación: ',
        'Authorization error' => 'Error de autorización',
        'Error sending message' => 'Error al enviar el mensaje',
        // Рекорды
        'Got reward' => 'Tengo recompensa',
        'Your passive income' => 'Sus ingresos pasivos',
        'will go to the winner' => 'será para el ganador',
        'Effect lasts until beaten' => 'El efecto dura hasta que se vence',
        'per_hour' => 'hora',
        'rank position' => 'rango posición',
        'record of the year' => 'disco del año',
        'record of the month' => 'disco del mes',
        'record of the week' => 'disco de la semana',
        'record of the day' => 'disco del día',
        'game_price' => 'puntos de juego',
        'games_played' => 'partidos jugados',
        'Games Played' => 'Juegos jugados',
        'top' => 'top',
        'turn_price' => 'puntos de giro',
        'word_len' => 'longitud de palabra',
        'word_price' => 'puntos por palabra',
        UserModel::BALANCE_HIDDEN_FIELD => 'Usuario oculto',
        'top_year' => 'TOP 1',
        'top_month' => 'TOP 2',
        'top_week' => 'TOP 3',
        'top_day' => 'MEJOR 10',
        // Рекорды конец
        'Return to fullscreen mode?' => '¿Volver al modo de pantalla completa?',
        // Профиль игрока
        'Choose file' => 'Elegir archivo',
        'Back' => 'Volver',
        'Wallet' => 'Cartera',
        'Referrals' => 'Remisiones',
        'Player ID' => 'ID de jugador',
        // complaints
        'Player is unbanned' => 'Jugador desbaneado',
        'Player`s ban not found' => 'Prohibición de jugador no encontrada',
        'Player not found' => 'Jugador no encontrado',
        // end complaints
        'Save' => 'Guardar',
        'new nickname' => 'nuevo apodo',
        'Input new nickname' => 'Introducir nuevo apodo',
        'Your rank' => 'Su rango',
        'Ranking number' => 'Número de clasificación',
        'Balance' => 'Saldo',
        'Rating by coins' => 'Clasificación por monedas',
        'Secret key' => 'Clave secreta',
        'Link' => 'Enlace',
        'Bonuses accrued' => 'Bonificaciones devengadas',
        'SUDOKU Balance' => 'Saldo SUDOKU',
        'Claim' => 'Reclamación',
        'Name' => 'Nombre',
        // Профиль игрока конец
        'Nickname updated' => 'Apodo actualizado',
        'Stats getting error' => 'Error en las estadísticas',
        'Error saving Nick change' => 'Error al guardar el cambio de Nick',
        'Play at least one game to view statistics' => 'Juega al menos una partida para ver las estadísticas',
        'Lost server synchronization' => 'Pérdida de sincronización del servidor',
        'Closed game window' => 'Ventana de juego cerrada',
        'You closed the game window and became inactive!' => 'Has cerrado la ventana de juego y te has vuelto inactivo.',
        'Request denied. Game is still ongoing' => 'Solicitud denegada. El juego sigue en curso',
        'Request rejected' => 'Solicitud rechazada',
        'No messages yet' => 'Aún no hay mensajes',
        'New game request sent' => 'Solicitud de nuevo juego enviada',
        'Your new game request awaits players response' => 'Su nueva solicitud de juego espera la respuesta de los jugadores',
        'Request was aproved! Starting new game' => 'Solicitud aprobada Empezar una nueva partida',
        'Default avatar is used' => 'Se utiliza el avatar por defecto',
        'Avatar by provided link' => 'Avatar por enlace proporcionado',
        'Set' => 'Pregunta a',
        'Avatar loading' => 'Carga del avatar',
        'Send' => 'Enviar',
        'Avatar URL' => 'URL del avatar',
        'Apply' => 'Solicitar',
        'Account key' => 'Clave de la cuenta',
        'Main account key' => 'Clave de la cuenta principal',
        'old account saved key' => 'cuenta antigua clave guardada',
        'Key transcription error' => 'Error de transcripción de teclas',
        "Player's ID NOT found by key" => 'ID de jugador NO encontrado por clave',
        'Accounts linked' => 'Cuentas vinculadas',
        'Accounts are already linked' => 'Las cuentas ya están vinculadas',
        'Game is not started' => 'El juego no se inicia',
        'OK' => 'OK',
        'Click to expand the image' => 'Haga clic para ampliar la imagen',
        'Report sent' => 'Informe enviado',
        'Report declined! Please choose a player from the list' => 'Denuncia rechazada Por favor, elija un jugador de la lista',
        'Your report accepted and will be processed by moderator' => 'Su informe aceptado y será procesado por el moderador',
        'If confirmed, the player will be banned' => 'Si se confirma, el jugador será expulsado',
        'Report declined!' => '¡Informe rechazado!',
        'Only one complaint per each player per day can be sent. Total 24 hours complaints limit is'
        => 'Sólo se puede enviar una queja por jugador y día. El límite total de reclamaciones en 24 horas es de',
        'From player' => 'De Jugador',
        'To Player' => 'Al jugador',
        'Awaiting invited players' => 'En espera de los jugadores invitados',
        'Searching for players' => 'Búsqueda de jugadores',
        'Searching for players with selected rank' => 'Búsqueda de jugadores con el rango seleccionado',
        'Message NOT sent - BAN until ' => 'Mensaje NO enviado - BAN hasta ',
        'Message NOT sent - BAN from Player' => 'Mensaje NO enviado - BAN del Jugador',
        'Message sent' => 'Mensaje enviado',
        'Exit' => 'Salida',
        'Appeal' => 'Recurso',
        'There are no events yet' => 'Aún no hay eventos',
        'Playing to' => 'Jugar a',
        'Just two players' => 'Sólo dos jugadores',
        'Up to four players' => 'Hasta cuatro jugadores',
        'Game selection - please wait' => 'Selección de juego - espere',
        'Your turn!' => '¡Tu turno!',
        'Looking for a new game...' => 'Buscando un nuevo juego...',
        'Get ready - your turn is next!' => 'Prepárese: ¡su turno es el siguiente!',
        'Take a break - your move in one' => 'Tómese un descanso: su mudanza en uno',
        'Refuse' => 'Desechos',
        'Offer a game' => 'Ofrecer un juego',
        'Players ready:' => 'Jugadores listos:',
        'Players' => 'Jugadores',
        'Try sending again' => 'Intente enviar de nuevo',
        'Error connecting to server!' => 'Error al conectar con el servidor.',
        'You haven`t composed a single word!' => '¡No has compuesto ni una sola palabra!',
        'You will lose if you quit the game! CONTINUE?' => '¡Perderás si abandonas el juego! ¿CONTINUAR?',
        'Cancel' => 'Cancelar',
        'Confirm' => 'Confirme',
        'Revenge!' => '¡Venganza!',
        'Time elapsed:' => 'Tiempo transcurrido:',
        'Time limit:' => 'Límite de tiempo:',
        'You can start a new game if you wait for a long time' => 'Puedes empezar una nueva partida si esperas mucho tiempo',
        'Close in 5 seconds' => 'Cerrar en 5 segundos',
        'Close immediately' => 'Cerrar inmediatamente',
        'Will close automatically' => 'Se cerrará automáticamente',
        's' => ' segundos',
        'Average waiting time:' => 'Tiempo medio de espera:',
        'Waiting for other players' => 'A la espera de otros jugadores',
        'Game goal' => 'Objetivo del juego',
        'Rating of opponents' => 'Calificación de los adversarios',
        'new player' => 'nuevo jugador',
        'CHOOSE GAME OPTIONS' => 'ELEGIR OPCIONES DE JUEGO',
        'Profile' => 'Perfil',
        'Error' => 'Error',
        'Your profile' => 'Tu perfil',
        'Start' => 'Inicio',
        'Stats' => 'Stats',
        'Play on' => 'Jugar en',
        // Чат
        'Error sending complaint<br><br>Choose opponent' => 'Error al enviar la reclamación<br><br>Elegir oponente',
        'You' => 'Sie',
        'to all: ' => 'An alle: ',
        ' (to all):' => ' (an alle):',
        'For everyone' => 'Für alle',
        'Word matching' => 'Wortabgleich',
        'Player support and chat at' => 'Spieler-Support und Chat bei',
        'Join group' => 'Gruppe beitreten',
        'Send an in-game message' => 'Sende eine Nachricht im Spiel',
        // Чат
        'News' => 'Nachrichten',
        // Окно статистика
        'Past Awards' => 'Frühere Auszeichnungen',
        'Parties_Games' => 'Spiele',
        'Player`s achievements' => 'Erfolge des Spielers',
        'Player Awards' => 'Spieler-Auszeichnungen',
        'Player' => 'Spieler',
        'VS' => 'VS',
        'Rating' => 'Rang',
        'Opponent' => 'Gegner',
        'Active Awards' => 'Aktive Auszeichnungen',
        'Remove filter' => 'Filter entfernen',
        // Окно статистика конец

        "Opponent's rating" => 'Bewertung des Gegners',
        'Choose your MAX bet' => ' Ihr MAX-Einsatz',
        'Searching for players with corresponding bet' => 'Suche nach Spielern mit entsprechender Wette',
        'Coins written off the balance sheet' => 'Aus der Bilanz ausgebuchte Münzen',
        'Number of coins on the line' => 'Anzahl der Münzen auf der Linie',
        'gets a win' => 'erhält für den Sieg',
        'The bank of' => 'Die Bank mit',
        'goes to you' => 'geht an Sie.',
        'is taken by the opponent' => 'wird vom Gegner gewonnen.',
        'Bid' => 'Gebot',
        'No coins' => 'Keine Münzen',
        'Any' => 'Jeder',
        'online' => 'online',
        'Above' => 'Oben',
        'minutes' => 'Minuten',
        'minute' => 'Minute',
        'Select the minimum opponent rating' => 'Wählen Sie den Mindestwert für den Gegner',
        'Not enough 1900+ rated players online' => 'Nicht genügend Spieler mit einer Bewertung von 1900+ online',
        'Only for players rated 1800+' => 'Nur für Spieler mit einer Bewertung von 1800+',
        'in game' => 'im Spiel',
        'score' => 'Ergebnis',
        'Your current rank' => 'Ihr aktueller Rang',
        'Server syncing..' => 'Server-Synchronisierung..',
        ' is making a turn.' => ' macht einen Zug.',
        'Your turn is next - get ready!' => 'Jetzt bist du dran - mach dich bereit!',
        'switches pieces and skips turn' => 'tauscht Figuren und überspringt Zug',
        "Game still hasn't started!" => 'Das Spiel hat noch immer nicht begonnen!',
        "Word wasn't found" => 'Wort wurde nicht gefunden',
        'Correct' => 'Korrekt',
        'One-letter word' => 'Wort mit einem Buchstaben',
        'Repeat' => 'Wiederholen Sie',
        'costs' => 'kostet',
        '+15 for all pieces used' => '+15 für alle verwendeten Teile',
        'TOTAL' => 'GESAMT',
        'You did not make any word' => 'Sie haben kein einziges Wort gesagt.',
        'is attempting to make a turn out of his turn (turn #' => 'versucht, einen Zug aus seinem Zug zu machen (Zug #',
        'Data processing error!' => 'Fehler in der Datenverarbeitung!',
        ' - turn processing error (turn #' => ' - Abbiegeverarbeitungsfehler (Abbiegung #',
        "didn't make any word (turn #" => 'hat kein Wort gesagt (Zug #',
        'set word lenght record for' => 'stellt Wortlängenrekord für das',
        'set word cost record for' => 'stellen Wortkostenrekord für das',
        'set record for turn cost for' => 'stellen Rekord bei den Turnkosten für das',
        'gets' => 'erhält',
        'for turn #' => 'für Runde #',
        'For all pieces' => 'Für alle Stücke',
        'Wins with score ' => 'Gewinnt mit Punktzahl ',
        'set record for gotten points in the game for' => 'stellt Rekord für erhaltene Punkte im Spiel für',
        'out of chips - end of game!' => 'keine Chips mehr - Ende des Spiels!',
        'set record for number of games played for' => 'stellt Rekord für Anzahl der Spiele des',
        'is the only one left in the game - Victory!' => 'ist der Einzige, der noch im Spiel ist - Sieg!',
        'left game' => 'hat das Spiel verlassen',
        'has left the game' => 'hat das Spiel verlassen',
        'is the only one left in the game! Start a new game' => 'ist der Einzige, der noch im Spiel ist! Ein neues Spiel beginnen',
        'Time for the turn ran out' => 'Die Zeit für die Wende lief ab',
        "is left without any pieces! Winner - " => 'hat keine Figuren mehr! Sieger -',
        ' with score ' => '. Punktzahl: ',
        "is left without any pieces! You won with score " => 'hat keine Figuren mehr! Du hast mit Punkten gewonnen ',
        "gave up! Winner - " => 'hat aufgegeben! Sieger - ',
        'skipped 3 turns! Winner - ' => 'hat 3 Züge übersprungen! Sieger - ',
        'New game has started!' => 'Das neue Spiel hat begonnen!',
        'New game' => 'Neues Spiel',
        'Accept invitation' => 'Einladung annehmen',
        'Get' => 'Erhalte',
        'score points' => 'Punkte',
        "Asking for adversaries' approval." => 'Die Zustimmung des Gegners einholen.',
        'Remaining in the game:' => 'Bleibt im Spiel:',
        "You got invited for a rematch! - Accept?" => 'Du wurdest zu einem Rückkampf eingeladen! - Annehmen?',
        'All players have left the game' => 'Alle Spieler haben das Spiel verlassen',
        "Your score" => 'Ihr Ergebnis',
        'Turn time' => 'Wendezeit',
        'Date' => 'Datum',
        'Price' => 'Preis',
        'Status' => 'Status',
        'Type' => 'Typ',
        'Period' => 'Zeitraum',
        'Word' => 'Wort',
        'Points/letters' => 'Punkte/Briefe',
        'Result' => 'Ergebnis',
        'Opponents' => 'Gegner',
        'Games<br>total' => 'Partien<br>insgesamt',
        'Wins<br>total' => 'Siege<br>insgesamt',
        'Gain/loss<br>in ranking' => 'Zugewinn/Verlust<br>an Rang',
        '% Wins' => '% Siege',
        'Games in total' => 'Spiele insgesamt',
        'Winnings count' => 'Gewinne zählen',
        'Increase/loss in rating' => 'Erhöhung/Verlust des Ratings',
        '% of wins' => '% der Siege',
        "GAME points - Year Record!" => 'GAME-Punkte - Jahresrekord!',
        "GAME points - Month Record!" => 'GAME-Punkte - Monatsrekord!',
        "GAME points - Week Record!" => 'GAME points - Wochenrekord!',
        "GAME points - Day Record!" => 'GAME-Punkte - Tagesrekord!',
        "TURN points - Year Record!" => 'TURN Punkte - Jahresrekord!',
        "TURN points - Month Record!" => 'TURN-Punkte - Monatsrekord!',
        "TURN points - Week Record!" => 'TURN-Punkte - Wochenrekord!',
        "TURN points - Day Record!" => 'TURN-Punkte - Tagesrekord!',
        "WORD points - Year Record!" => 'WORD-Punkte - Jahresrekord!',
        "WORD points - Month Record!" => 'WORD-Punkte - Monatsrekord!',
        "WORD points - Week Record!" => 'WORD-Punkte - Wochenrekord!',
        "WORD points - Day Record!" => 'WORD-Punkte - Tagesrekord!',
        "Longest WORD - Year Record!" => 'Längstes WORT - Jahresrekord!',
        "Longest WORD - Month Record!" => 'Längstes WORT - Monatsrekord!',
        "Longest WORD - Week Record!" => 'Längstes WORT - Wochenrekord!',
        "Longest WORD - Day Record!" => 'Längstes WORT - Tagesrekord!',
        "GAMES played - Year Record!" => 'GAMES gespielt - Jahresrekord!',
        "GAMES played - Month Record!" => 'GAMES gespielt - Monatsrekord!',
        "GAMES played - Week Record!" => 'GAMES played - Wochenrekord!',
        "GAMES played - Day Record!" => 'GAMES gespielt - Tagesrekord!',
        "Victory" => 'Sieg',
        'Losing' => 'Verlieren',
        "Go to player's stats" => 'Zu den Spielerstatistiken gehen',
        'Filter by player' => 'Nach Spieler filtern',
        'Apply filter' => 'Filter anwenden',
        'against' => 'gegen',
        "File loading error!" => 'Fehler beim Laden der Datei!',
        "Check:" => 'Prüfen:',
        "file size (less than " => 'Dateigröße (weniger als ',
        "Incorrect URL format!" => 'Falsches URL-Format!',
        "Must begin with " => 'Muss beginnen mit ',
        'Error! Choose image file with the size not more than' => 'Fehler! Wählen Sie eine Bilddatei mit einer Größe von nicht mehr als',
        'Avatar updated' => 'Avatar aktualisiert',
        "Error saving new URL" => 'Fehler beim Speichern der neuen URL',
        'A player may open more than one cell and more than one KEY in one turn. Use the CASCADES rule'
        => 'Ein Spieler darf in einem Zug mehr als ein Feld und mehr als einen SCHLÜSSEL öffnen. Verwenden Sie die CASCADES-Regel',
        'If after the automatic opening of a number, new blocks of EIGHT open cells are formed on the field, such blocks are also opened by CASCADE'
        => 'Wenn nach dem automatischen Öffnen einer Nummer neue Blöcke von ACHT offenen Zellen auf dem Feld gebildet werden, werden diese Blöcke ebenfalls durch CASCADE geöffnet',
        'If a player has opened a cell (solved a number in it) and there is only ONE closed digit left in the block, this digit is opened automatically'
        => 'Wenn ein Spieler ein Feld geöffnet hat (eine Zahl darin gelöst hat) und nur noch EINE geschlossene Ziffer in dem Block vorhanden ist, wird diese Ziffer automatisch geöffnet',
        'is awarded for solved empty cell' => 'wird für gelöste leere Zellen ausgezeichnet',
        'by calculating all of other 8 digits in a block - vertically OR horizontally OR in a 3x3 square'
        => ' durch Berechnung aller anderen 8 Ziffern in einem Block - senkrecht ODER waagerecht ODER in einem 3x3-Quadrat',
        "The players' task is to take turns making moves and accumulating points to open black squares"
        => 'Die Aufgabe der Spieler besteht darin, abwechselnd Züge zu machen und Punkte zu sammeln, um schwarze Felder zu öffnen',
        'The classic SUDOKU rules apply - in a block of nine cells (vertically, horizontally and in a 3x3 square) the numbers must not be repeated'
        => 'Es gelten die klassischen SUDOKU-Regeln - in einem Block von neun Zellen (vertikal, horizontal und in einem 3x3-Quadrat) dürfen sich die Zahlen nicht wiederholen',
        'faq_rules' => [
            SudokuGame::GAME_NAME => <<<DE
<h2 id="nav1">Über das Spiel</h2>
Es gelten die klassischen SUDOKU-Regeln - in einem Block von neun Zellen (vertikal, horizontal und in einem 3x3-Quadrat) dürfen sich die Zahlen nicht wiederholen
<br><br>
Die Aufgabe der Spieler ist es, abwechselnd Züge zu machen und Punkte zu sammeln, um schwarze Quadrate zu öffnen (<span style="color:#0f0">+10 Punkte</span>), indem sie alle anderen 8 Ziffern in einem Block berechnen - vertikal ODER horizontal ODER in einem 3x3-Quadrat
<br><br>
Ein <span style="color:#0f0">+1 Punkt</span> wird für gelöste leere Zellen vergeben
<br><br>
Sieger ist der Spieler, der 50% aller möglichen Punkte erreicht hat +1 Punkt
<br><br>
Wenn ein Spieler ein Feld geöffnet hat (eine Zahl darin gelöst hat) und es nur noch EINE geschlossene Ziffer im Block gibt, wird diese Ziffer automatisch geöffnet
<br><br>
Wenn nach dem automatischen Öffnen einer Zahl neue Blöcke von ACHT offenen Feldern auf dem Feld gebildet werden, werden diese Blöcke auch durch CASCADE
<br><br>
Ein Spieler kann mehr als ein Feld und mehr als einen SCHLÜSSEL in einer Runde öffnen. Verwenden Sie die CASCADES-Regel
<br><br>
Im Falle eines fehlerhaften Zuges - die Ziffer im Feld ist falsch - erscheint eine kleine rote Fehlerziffer auf diesem Feld, die für beide Spieler sichtbar ist. Diese Ziffer darf nicht mehr auf dieses Feld gesetzt werden
<br><br>
Mit der Schaltfläche „Ankreuzen“ kann der Spieler eine Markierung vornehmen - eine kleine grüne Zahl in das Feld setzen. Dabei kann es sich um eine berechnete Zahl handeln, die der Spieler sicher weiß, oder um eine Schätzung. Verwenden Sie Notizen wie in einem normalen SUDOKU - der andere Spieler kann sie nicht sehen
DE
            ,
        ],
        'faq_rating' => <<<DE
Elo-Bewertung
<br><br>
Elo-Bewertungssystem, Elo-Koeffizient - eine Methode zur Berechnung der relativen Stärke von Spielern in Spielen, 
in Spielen mit zwei Spielern (z. B. Schach, Dame oder Shogi, Go).
<br>
Dieses Bewertungssystem wurde von dem in Ungarn geborenen amerikanischen Physikprofessor Arpad Elo (ungarisch: Élő Árpád; 1903-1992) entwickelt
<br><br>
Je größer der Unterschied in der Bewertung zwischen den Spielern ist, desto weniger Punkte erhält der stärkere Spieler, wenn er gewinnt.
<br> 
Umgekehrt erhält ein schwächerer Spieler mehr Punkte für die Wertung, wenn er einen stärkeren Spieler besiegt.
<br><br>
Daher ist es für einen starken Spieler vorteilhafter, mit Gleichen zu spielen - wenn man gewinnt, bekommt man mehr Punkte, und wenn man verliert, verliert man nicht sehr viele Punkte.
<br><br>
Es ist sicher für einen Anfänger, gegen einen erfahrenen Meister zu kämpfen.
<br>
Wenn Sie verlieren, ist der Verlust an Rangpunkten gering.
<br>
Aber im Falle eines Sieges, wird der Meister großzügig die Rangpunkte teilen
DE
        ,
        'faq_rewards' => [
            SudokuGame::GAME_NAME => <<<DE
Spieler werden für bestimmte Leistungen (Rekorde) belohnt.
<br><br>
Die Auszeichnungen des Spielers werden in der Rubrik „STATS“ in den folgenden Nominierungen angezeigt: Gold/Silber/Bronze/Stein.
<br><br>
Wenn der Spieler eine Belohnungskarte erhält, bekommt er einen Bonus von SUDOKU-Münzen {{sudoku_icon}}
<br> 
Münzen können in einem speziellen Spielmodus „ON Coins“ verwendet werden, Sie können Ihre Geldbörse im Spiel auffüllen, 
sowie Münzen aus dem Spiel abheben - lesen Sie mehr im Reiter „Münzspielmodus“
<br><br>
Solange der Rekord eines Spielers nicht von einem anderen Spieler gebrochen wurde, wird die Belohnungskarte für diesen Spieler auf der Registerkarte „AKTIVE BELOHNUNGEN“ im Abschnitt „STATISTIK“ angezeigt.
<br><br>
Jede „AKTIVE BELOHNUNG“ generiert jede Stunde zusätzlichen „Gewinn“ in Münzen.
<br><br>
Wenn ein Rekord von einem anderen Spieler gebrochen wurde, wird die Prämienkarte des vorherigen Besitzers des Rekords in die Registerkarte „PAST AWARDS“ verschoben und bringt kein passives Einkommen mehr. 
<br><br>
Die Gesamtzahl der erhaltenen Münzen (einmalige Boni und zusätzlicher Gewinn) kann im Abschnitt „PROFIL“ auf der Registerkarte ‚Brieftasche‘ in den Feldern „SUDOKU-Guthaben“ bzw. „Aufgelaufene Boni“ eingesehen werden.
<br><br>
Beim Überschreiten des eigenen Rekords für die Errungenschaft „GESPIELTE PARTIES“ erhält der Spieler keine neue Belohnungskarte oder Münzen mehr. 
Der Rekordwert selbst (Anzahl der Spiele/Anzahl der Freunde) wird auf der Belohnungskarte aktualisiert.
<br><br>
Wenn ein Spieler zum Beispiel die Errungenschaft - „GAMES PLAYED“
(Gold) für 10.000 Spiele erworben hat, dann werden, wenn die Anzahl der Spiele dieses Spielers auf 10.001 geändert wird, keine weiteren Belohnungskarten an den Rekordhalter ausgegeben.
DE
            ,
        ],
        'Reward' => 'Belohnung',
        'faq_coins' => [
            SudokuGame::GAME_NAME => <<<DE
Die Münze <strong>SUDOKU</strong> {{sudoku_icon}} ist eine In-Game Währung{{yandex_exclude}}{{ für ein Netzwerk von Spielen - <strong>Scrabble, Sudoku</strong>
<br><br>
Ein Konto für alle Spiele, eine Währung, eine Geldbörse}}
<br><br>
{{yandex_exclude}}{{In der Kryptowelt wird die Münze auch SUDOKU genannt. In Kürze wird es möglich sein, eine beliebige Anzahl von SUDOKU-Münzen aus der Geldbörse im Spiel in eine externe Geldbörse im TON (Telegram)-Netzwerk abzuheben
<br><br>}}
In der Zwischenzeit versuchen wir, so viele Münzen wie möglich im Spiel zu gewinnen, indem wir den Modus „Münzen“ auswählen
<br><br>

Auch in diesem Modus wird die Rangliste der Spieler berücksichtigt und erhöht.
<br>
Allerdings werden Münzen, die durch die Ergebnisse des Spiels gewonnen werden, nun Ihrem Geldbeutel gutgeschrieben (oder abgezogen, wenn Sie verlieren).
<br><br>
Je nach aktuellem Guthaben in Ihrem Geldbeutel wird Ihnen angeboten, um 1, 5, 10, etc. Coins zu spielen - wählen Sie den gewünschten Betrag aus der Liste
<br><br>
Nach dem Drücken des „Start“-Buttons beginnt die Suche nach einem Gegner, der ebenfalls bereit ist, den angegebenen Betrag zu setzen
<br><br> 
Sie haben zum Beispiel einen Einsatz von 5 Münzen festgelegt, und unter den Spielern, die ein neues Spiel beginnen, gibt es nur solche, die bereit sind, 1 Münze zu setzen.
<br>
Dann beträgt der Einsatz sowohl für Sie als auch für einen solchen Spieler 1 Münze - die geringere der beiden Optionen.
<br><br>
Falls jemand bereit ist, um 10 Münzen zu kämpfen, wird Ihr Einsatz - 5 - ausgewählt und das Spiel beginnt mit einer Bank von 10 Münzen - 5+5
<br><br>
In einem Spiel mit zwei Personen erhält der Gewinner den gesamten Pott - seinen Einsatz und den Einsatz seines Gegners
<br><br>
Bei einem Drei-Wege-Spiel nimmt der Gewinner seinen Einsatz und den Einsatz des letzten Spielers (der Spieler mit den wenigsten Punkten). 
Der mittlere Spieler (der Zweitplatzierte) erhält seinen Einsatz zurück und behält seine Münzen
<br><br>
Bei einem Spiel mit vier Spielern wird der Pott zwischen den Spielern auf Platz 1 und 4 (der erste Spieler nimmt beide Einsätze), 
und den Spielern auf Platz 2 und 3 (der zweite Spieler nimmt beide Einsätze) aufgeteilt.
<br><br>
So wird das Spiel zu dritt und zu viert weniger riskant, wenn es darum geht, Münzen zu sparen
<br><br>
Wenn alle Verlierer die gleiche Anzahl von Punkten haben, nimmt der Gewinner alle Einsätze.
<br><br>
Wenn in einem Viererspiel der 2. und 3. Spieler die gleiche Punktzahl erreichen, erhalten sie ihren Einsatz zurück und behalten ihre Einsätze
<br><br>
Der neue Rang wird in allen Fällen wie üblich berechnet - siehe Registerkarte „Rangliste“.
<br><br>
<h2>Wie Sie Ihr Portemonnaie wieder auffüllen können</h2>
<ol>
<li>
Jeder neue Spieler erhält zur Begrüßung {{stone_reward}} {{yandex_exclude}}{{SUDOKU}} Münzen auf sein Guthaben und kann sofort in das Rennen um große Gewinne einsteigen
</li>
<li>
Sie erhalten {{stone_reward}} Münzen für jeden Freund, der über Ihren Empfehlungslink zum Spiel kommt. 
Außerdem werden Sie belohnt, wenn Sie einen Rekord (für den Tag, die Woche, den Monat oder das Jahr) bei der Anzahl der Eingeladenen aufstellen. Um einen Benutzer einzuladen, müssen Sie sich über Telegram in das Spiel einloggen.
</li>
<li>
Münzen werden für Leistungen im Spiel vergeben (Punkte pro Spiel, Punkte pro Zug, Punkte pro Wort, Anzahl der Spiele, Anzahl der Eingeladenen, Platz in der Rangliste von #1 bis #10)
</li>
<li>
Für alle 100 Spiele werden {{stone_reward}} von {{yandex_exclude}}{{SUDOKU }} Münzen vergeben
</li>
{{yandex_exclude}}{{<li>
Münzen für Rubel per Überweisung kaufen
</li>
<li>Münzen für Kryptowährung kaufen (in Kürze)
</li>}}
</ol>

<br>
Die Anzahl der Münzen, die für jede Leistung vergeben werden, kann sich im Laufe der Zeit ändern, entweder nach oben oder nach unten. Die tatsächliche Belohnung ist auf der Erfolgskarte angegeben.
<br><br>
<h2>Was Sie mit den gewonnenen Münzen machen können</h2>
<ol>
<li>
Spielen Sie unsere Spiele, erhöhen Sie die Einsätze und machen Sie Ihre Lieblingsbeschäftigung spannender und interessanter.
</li>
{{yandex_exclude}}{{<li>
Verkaufen Sie Münzen für Rubel oder für Kryptowährung (bald) und erhalten Sie Ihre Belohnung in Form von echtem Geld
</li>}}
{{yandex_exclude}}{{<li>
Machen Sie einem anderen Spieler ein Geschenk, indem Sie ihm eine beliebige Anzahl von Münzen aus Ihrer Brieftasche schicken (in Kürze)
</li>}}   
</ol>
<br>
Sie können die Details Ihres Guthabens in der Registerkarte „Brieftasche“ des Menüs „PROFIL“ einsehen.
<br><br>
<strong>Aufgelaufene Boni</strong> - das Ergebnis des passiven Verdienstes, der stündlich in Abhängigkeit von den Erfolgen des Spielers aufgelaufen ist (Menü „STATS“, Abschnitt „Auszeichnungen“).
<br>Bonusse können durch Drücken der Taste „CLAIM“ auf das Guthaben übertragen werden.
<br><br>
<strong>{{yandex_exclude}}{{SUDOKU}} Saldo</strong> - aktueller Saldo der Münzen ohne Boni. Münzen werden davon abgezogen / gutgeschrieben, je nach den Ergebnissen des Spiels
<br><br>
Erfolgskarten, die Medaillen ähneln, sind ein Zeichen für Ihren Erfolg.
<br>Sie enthalten den Namen der Leistung, den Zeitraum (Jahr, Tag, Woche, Monat), die Anzahl der Punkte (Bewertung, Wortlänge, Anzahl der Freunde) und die Anzahl der Münzen 
<br><br>
Das passive Sammeln von Münzen hört auf, wenn dein Rekord von einem anderen Spieler gebrochen wird.
DE,
        ],
        '[[Player]] opened [[number]] [[cell]]' => '[[Player]] öffnete [[number]] [[cell]]',
        ' (including [[number]] [[key]])' => ' (einschließlich [[number]] [[key]])',
        '[[Player]] made a mistake' => '[[Player]] hat einen Fehler gemacht',
        'You made a mistake!' => 'Sie haben einen Fehler gemacht!',
        'Your opponent made a mistake' => 'Ihr Gegner hat einen Fehler gemacht',
        '[[Player]] gets [[number]] [[point]]' => '[[Player]] erhält [[number]] [[point]].',
        '[[number]] [[point]]' => '[[number]] [[point]]',
        'You got [[number]] [[point]]' => 'Hai ottenuto [[number]] [[point]].',
        'Your opponent got [[number]] [[point]]' => 'Il tuo avversario ha ottenuto [[number]] [[point]].',
    ];
}