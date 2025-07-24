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
            SudokuGame::GAME_NAME => '&#42;Conservez cette clé pour pouvoir restaurer votre compte dans <a href="https://t.me/sudoku_app_bot">Telegram</a> ultérieurement',
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
        'Save' => 'charge',
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
        'OK' => 'OK',
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
        'Any' => 'N&#39;importe quel<br>',
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
        'You did not make any word' => 'Vous n&#39;avez pas prononcé un mot.',
        'is attempting to make a turn out of his turn (turn #' => 'tente d&#39;effectuer un tour en dehors de son tour (tour n°',
        'Data processing error!' => 'Erreur de traitement des données !',
        ' - turn processing error (turn #' => ' - erreur de traitement du tour (tour n°',
        "didn't make any word (turn #" => 'n&#39;a pas prononcé un mot (tour n°',
        'set word lenght record for' => 'définir la longueur maximale des mots pour',
        'set word cost record for' => 'définir le coût par mot pour',
        'set record for turn cost for' => 'établir un record pour le coût du tour pour',
        'gets' => 'reçu',
        'for turn #' => 'pour le tour n°',
        'For all pieces' => 'Pour toutes les pièces',
        'Wins with score ' => 'Victoires avec un score de ',
        'set record for gotten points in the game for' => 'a établi un record du nombre de points marqués dans le jeu pour',
        'out of chips - end of game!' => 'plus de jetons - fin de la partie !',
        'set record for number of games played for' => 'a établi un record du nombre de matchs disputés pour',
        'is the only one left in the game - Victory!' => 'est le seul qui reste dans le jeu - Victoire !',
        'left game' => 'a quitté la partie',
        'has left the game' => 'a quitté la partie',
        'is the only one left in the game! Start a new game' => 'est le seul à rester dans le jeu ! Commencez une nouvelle partie.',
        'Time for the turn ran out' => 'Le temps imparti pour le tour est écoulé.',
        "is left without any pieces! Winner - " => 'se retrouve sans aucune pièce ! Vainqueur - ',
        ' with score ' => ' avec score ',
        "is left without any pieces! You won with score " => 'n&#39;a plus aucune pièce ! Vous avez gagné avec un score de ',
        "gave up! Winner - " => 'a abandonné ! Vainqueur - ',
        'skipped 3 turns! Winner - ' => 'a sauté 3 tours ! Vainqueur - ',
        'New game has started!' => 'Une nouvelle partie a commencé !',
        'New game' => 'Nouveau jeu',
        'Accept invitation' => 'Accepter l&#39;invitation',
        'Get' => 'Obtenez',
        'score points' => 'marquer des points',
        "Asking for adversaries' approval." => 'Demander l&#39;approbation des adversaires.',
        'Remaining in the game:' => 'Rester dans la course :',
        "You got invited for a rematch! - Accept?" => 'Tu as été invité à une revanche ! - Tu acceptes ?',
        'All players have left the game' => 'Tous les joueurs ont quitté la partie.',
        "Your score" => 'Votre score',
        'Turn time' => 'Temps de rotation',
        'Date' => 'Date',
        'Price' => 'Prix',
        'Status' => 'Statut',
        'Type' => 'Type',
        'Period' => 'Période',
        'Word' => 'Mot',
        'Points/letters' => 'Points/lettres',
        'Result' => 'Résultat',
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
        "file size (less than " => 'taille du fichier (moins de ',
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
        'Reward' => 'Récompense',
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