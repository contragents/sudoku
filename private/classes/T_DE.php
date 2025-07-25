<?php

namespace classes;


use PaymentModel;
use UserModel;

class T_DE
{
    const PHRASES = [
        'Invalid URL format! <br />It must begin with <strong>http(s)://</strong>' => 'Ungültiges URL-Format! <br />Es muss mit <strong>http(s)://</strong> beginnen.',
        '</strong> or <strong>' => '</strong> oder <strong>',
        'MB</strong>)</li><li>extension -<strong>' => 'MB</strong>)</li><li>Erweiterung -<strong>',
        '<strong>File upload error!</strong><br /> Please review:<br /> <ul><li>file size (no more than <strong>'
        => '<strong>Datei-Upload-Fehler!</strong><br /> Bitte überprüfen Sie:<br /> <ul><li>Dateigröße (nicht mehr als <strong>',
        'Error creating new payment' => 'Fehler beim Erstellen einer neuen Zahlung',
        'FAQ' => 'FAQ',
        'Agreement' => 'Vereinbarung',
        'Empty value is forbidden' => 'Leerer Wert ist verboten',
        'Forbidden' => 'Verboten',
        'game_title' => [
            SudokuGame::GAME_NAME => 'Sudoku online mit Freunden',
        ],
        'secret_prompt' => [
            SudokuGame::GAME_NAME => '&#42;Speichern Sie diesen Schlüssel für die weitere Wiederherstellung Ihres Kontos in <a href="https://t.me/sudoku_app_bot">Telegram</a>.',
        ],
        'COIN Balance' => 'Münzbestand',
        PaymentModel::INIT_STATUS => 'Gestartet',
        PaymentModel::BAD_CONFIRM_STATUS => ' Bestätigungsfehler',
        PaymentModel::COMPLETE_STATUS => 'Abgeschlossen',
        PaymentModel::FAIL_STATUS => 'Fehlgeschlagen',
        'Last transactions' => 'Letzte Transaktionen',
        'Support in Telegram' => 'Unterstützung in Telegram',
        'Check_price' => 'Preis prüfen',
        'Replenish' => 'Auffüllen',
        'SUDOKU_amount' => 'Münzmenge',
        'enter_amount' => 'Betrag',
        'Buy_SUDOKU' => 'SUDOKU-Münzen kaufen',
        'The_price' => 'Preisangebot',
        'calc_price' => 'Preis',
        'Pay' => 'Bezahlen',
        'Congratulations to Player' => 'Herzlichen Glückwunsch an Spieler',
        'Server sync lost' => 'Server-Synchronisierung verloren',
        'Server connecting error. Please try again' => 'Fehler beim Herstellen der Verbindung zum Server. Bitte versuchen Sie es erneut.',
        'Error changing settings. Try again later' => 'Fehler beim Ändern der Einstellungen. Versuchen Sie es später erneut.',
        'invite_friend_prompt' => [
            SudokuGame::GAME_NAME => 'Nimm am Online-Spiel SUDOKU auf Telegram teil! Erreiche die maximale Bewertung, verdiene Münzen und ziehe Token auf dein Wallet ab.',
        ],
        'game_bot_url' => [
            SudokuGame::GAME_NAME => 'https://t.me/sudoku_app_bot',
        ],
        'loading_text' => 'SUDOKU wird geladen...',
        'switch_tg_button' => 'Wechseln Sie zu Telegram',
        'Invite a friend' => 'Einen Freund einladen',
        'you_lost' => 'Sie haben verloren.',
        'you_won' => 'Sie haben gewonnen!',
        '[[Player]] won!' => '[[Player]] hat gewonnen!',
        'start_new_game' => 'Ein neues Spiel starten',
        'rating_changed' => 'Bewertungsänderung: ',
        'Authorization error' => 'Autorisierungsfehler',
        'Error sending message' => 'Fehler beim Senden der Nachricht',
        // Рекорды
        'Got reward' => 'Belohnung erhalten',
        'Your passive income' => 'Ihr passives Einkommen',
        'will go to the winner' => 'gehen an den Gewinner.',
        'Effect lasts until beaten' => 'Die Wirkung hält bis zum Ende an.',
        'per_hour' => 'Stunde',
        'rank position' => 'Rangposition',
        'record of the year' => 'Album des Jahres',
        'record of the month' => 'Aufnahme des Monats',
        'record of the week' => 'Platte der Woche',
        'record of the day' => 'Tagesrekord',
        'game_price' => 'Spielpunkte',
        'games_played' => 'gespielte Spiele',
        'Games Played' => 'Gespielte Spiele',
        'top' => 'Top',
        'turn_price' => 'Wendepunkte',
        'word_len' => 'Wortlänge',
        'word_price' => 'Wortpunkte',
        UserModel::BALANCE_HIDDEN_FIELD => 'Benutzer versteckt',
        'top_year' => 'TOP 1',
        'top_month' => 'TOP 2',
        'top_week' => 'TOP 3',
        'top_day' => 'In den Top Ten',
        // Рекорды конец
        'Return to fullscreen mode?' => 'Zurück zum Vollbildmodus?',
        // Профиль игрока
        'Choose file' => 'Datei auswählen',
        'Back' => 'Zurück',
        'Wallet' => 'Geldbörse',
        'Referrals' => 'Empfehlungen',
        'Player ID' => 'Spieler-ID',
        // complaints
        'Player is unbanned' => 'Der Spieler ist nicht mehr gesperrt.',
        'Player`s ban not found' => 'Spieler-Sperre nicht gefunden',
        'Player not found' => 'Spieler nicht gefunden',
        // end complaints
        'Save' => 'Speichern',
        'new nickname' => 'neuer Spitzname',
        'Input new nickname' => 'Neuen Spitznamen eingeben',
        'Your rank' => 'Ihr Rang',
        'Ranking number' => 'Rangnummer',
        'Balance' => 'Kontostand',
        'Rating by coins' => 'Rang nach Münzen',
        'Secret key' => 'Geheimer Schlüssel',
        'Link' => 'Verbinden',
        'Bonuses accrued' => 'Aufgelaufene Boni',
        'SUDOKU Balance' => 'SUDOKU Kontostand',
        'Claim' => 'Anspruch',
        'Name' => 'Name',
        // Профиль игрока конец
        'Nickname updated' => 'Spitzname aktualisiert',
        'Stats getting error' => 'Statistiken erhalten Fehler',
        'Error saving Nick change' => 'Fehler beim Speichern der Änderung des Nicknamens',
        'Play at least one game to view statistics' => 'Spielen Sie mindestens ein Spiel, um Statistiken anzuzeigen.',
        'Lost server synchronization' => 'Verlorene Server-Synchronisierung',
        'Closed game window' => 'Geschlossenes Spielfenster',
        'You closed the game window and became inactive!' => 'Sie haben das Spielfenster geschlossen und sind inaktiv geworden!',
        'Request denied. Game is still ongoing' => 'Antrag abgelehnt. Das Spiel läuft noch.',
        'Request rejected' => 'Antrag abgelehnt',
        'No messages yet' => 'Noch keine Nachrichten',
        'New game request sent' => 'Neue Spielanfrage gesendet',
        'Your new game request awaits players response' => 'Ihre neue Spielanfrage wartet auf die Antwort der Spieler.',
        'Request was aproved! Starting new game' => 'Antrag wurde genehmigt! Neues Spiel starten',
        'Default avatar is used' => 'Standard-Avatar wird verwendet',
        'Avatar by provided link' => 'Avatar über den bereitgestellten Link',
        'Set' => 'Setzen',
        'Avatar loading' => 'Avatar wird geladen',
        'Send' => 'Senden',
        'Avatar URL' => 'Avatar-URL',
        'Apply' => 'Bewerben',
        'Account key' => 'Kontoschlüssel',
        'Main account key' => 'Hauptkontoschlüssel',
        'old account saved key' => 'Alter Account gespeicherter Schlüssel',
        'Key transcription error' => 'Wichtiger Transkriptionsfehler',
        "Player's ID NOT found by key" => 'Spieler-ID wurde anhand des Schlüssels nicht gefunden.',
        'Accounts linked' => 'Verknüpfte Konten',
        'Accounts are already linked' => 'Die Konten sind bereits verknüpft.',
        'Game is not started' => 'Das Spiel wurde nicht gestartet.',
        'OK' => 'OK',
        'Click to expand the image' => 'Klicken Sie hier, um das Bild zu vergrößern.',
        'Report sent' => 'Bericht gesendet',
        'Report declined! Please choose a player from the list' => 'Bericht abgelehnt! Bitte wählen Sie einen Spieler aus der Liste aus.',
        'Your report accepted and will be processed by moderator' => 'Ihr Bericht wurde angenommen und wird vom Moderator bearbeitet.',
        'If confirmed, the player will be banned' => 'Wenn dies bestätigt wird, wird der Spieler gesperrt.',
        'Report declined!' => 'Bericht abgelehnt!',
        'Only one complaint per each player per day can be sent. Total 24 hours complaints limit is'
        => 'Pro Spieler kann pro Tag nur eine Beschwerde eingereicht werden. Die Gesamtzahl der Beschwerden innerhalb von 24 Stunden beträgt',
        'From player' => 'Vom Spieler',
        'To Player' => 'An Spieler',
        'Awaiting invited players' => 'Warten auf eingeladene Spieler',
        'Searching for players' => 'Spieler suchen',
        'Searching for players with selected rank' => 'Suche nach Spielern mit ausgewähltem Rang',
        'Message NOT sent - BAN until ' => 'Nachricht NICHT gesendet – BAN bis ',
        'Message NOT sent - BAN from Player' => 'Nachricht NICHT gesendet – BAN vom Spieler',
        'Message sent' => 'Nachricht gesendet',
        'Exit' => 'Ausgang',
        'Appeal' => 'Berufung',
        'There are no events yet' => 'Es gibt noch keine Veranstaltungen.',
        'Playing to' => 'Spielen bis',
        'Just two players' => 'Nur zwei Spieler',
        'Up to four players' => 'Bis zu vier Spieler',
        'Game selection - please wait' => 'Spielauswahl – bitte warten Sie',
        'Your turn!' => 'Sie sind dran!',
        'Looking for a new game...' => 'Auf der Suche nach einem neuen Spiel...',
        'Get ready - your turn is next!' => 'Mach dich bereit – du bist als Nächstes dran!',
        'Take a break - your move in one' => 'Machen Sie eine Pause – Sie sind am Zug.',
        'Refuse' => 'Abfall',
        'Offer a game' => 'Ein Spiel anbieten',
        'Players ready:' => 'Spieler bereit:',
        'Players' => 'Spieler',
        'Try sending again' => 'Versuchen Sie es erneut zu senden.',
        'Error connecting to server!' => 'Fehler beim Herstellen der Verbindung zum Server!',
        'You haven`t composed a single word!' => 'Du hast kein einziges Wort geschrieben!',
        'You will lose if you quit the game! CONTINUE?' => 'Sie verlieren, wenn Sie das Spiel beenden! WEITER?',
        'Cancel' => 'Abbrechen',
        'Confirm' => 'Bestätigen',
        'Revenge!' => 'Rache!',
        'Time elapsed:' => 'Verstrichene Zeit:',
        'Time limit:' => 'Frist:',
        'You can start a new game if you wait for a long time' => 'Sie können ein neues Spiel starten, wenn Sie lange warten.',
        'Close in 5 seconds' => 'In 5 Sekunden schließen',
        'Close immediately' => 'Sofort schließen',
        'Will close automatically' => 'Wird automatisch geschlossen',
        's' => ' Sekunden',
        'Average waiting time:' => 'Durchschnittliche Wartezeit:',
        'Waiting for other players' => 'Warten auf andere Spieler',
        'Game goal' => 'Spielziel',
        'Rating of opponents' => 'Bewertung der Gegner',
        'new player' => 'neuer Spieler',
        'CHOOSE GAME OPTIONS' => 'SPIELOPTIONEN AUSWÄHLEN',
        'Profile' => 'Profil',
        'Error' => 'Fehler',
        'Your profile' => 'Ihr Profil',
        'Start' => 'Beginnen',
        'Stats' => 'Statistiken',
        'Play on' => 'Spielen Sie auf',
        // Чат
        'Error sending complaint<br><br>Choose opponent' => 'Fehler beim Senden der Beschwerde<br><br>Gegner auswählen',
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