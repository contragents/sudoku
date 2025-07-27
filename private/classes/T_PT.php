<?php

namespace classes;


use PaymentModel;
use UserModel;

class T_PT
{
    const PHRASES = [
        'Invalid URL format! <br />It must begin with <strong>http(s)://</strong>' => 'Formato de URL inválido! <br>Deve começar por <strong></strong>http(s)://</strong>',
        '</strong> or <strong>' => '</strong> ou <strong>',
        'MB</strong>)</li><li>extension -<strong>' => 'MB</strong>)</li><li>extensão -<strong>',
        '<strong>File upload error!</strong><br /> Please review:<br /> <ul><li>file size (no more than <strong>'
        => '<strong>Erro de carregamento do ficheiro!</strong><br /> Por favor, reveja:<br /> <ul><li> tamanho do ficheiro (não mais de<strong>',
        'Error creating new payment' => 'Erro ao criar novo pagamento',
        'FAQ' => 'FAQ',
        'Agreement' => 'Acordo',
        'Empty value is forbidden' => 'O valor vazio é proibido',
        'Forbidden' => 'Proibido',
        'game_title' => [
            SudokuGame::GAME_NAME => 'Sudoku online com amigos',
        ],
        'secret_prompt' => [
            SudokuGame::GAME_NAME => '&#42;Guardar esta chave para posterior restauro da conta em <a href="https://t.me/sudoku_app_bot">Telegram</a>',
        ],
        'COIN Balance' => 'Saldo da MOED',
        PaymentModel::INIT_STATUS => 'Iniciado',
        PaymentModel::BAD_CONFIRM_STATUS => 'Má confirmação',
        PaymentModel::COMPLETE_STATUS => 'Concluído',
        PaymentModel::FAIL_STATUS => 'Falhado',
        'Last transactions' => 'Últimas transacções',
        'Support in Telegram' => 'Suporte no Telegram',
        'Check_price' => 'Verificar preço',
        'Replenish' => 'Recarregar',
        'SUDOKU_amount' => 'Número de moedas',
        'enter_amount' => 'montante',
        'Buy_SUDOKU' => 'Comprar moedas SUDOKU',
        'The_price' => 'Oferta de preço',
        'calc_price' => 'preço',
        'Pay' => 'Pagar',
        'Congratulations to Player' => 'Parabéns ao Jogador',
        'Server sync lost' => 'Perda de sincronização do servidor',
        'Server connecting error. Please try again' => 'Erro de ligação do servidor. Por favor, tente novamente',
        'Error changing settings. Try again later' => 'Erro ao alterar as definições. Tentar novamente mais tarde',
        'invite_friend_prompt' => [
            SudokuGame::GAME_NAME => 'Junta-te ao jogo online SUDOKU no Telegram! Obtém a classificação máxima, ganha moedas e retira tokens para a tua carteira',
        ],
        'game_bot_url' => [
            SudokuGame::GAME_NAME => 'https://t.me/sudoku_app_bot',
        ],
        'loading_text' => [SudokuGame::GAME_NAME => 'SUDOKU está a carregar...'],
        'switch_tg_button' => 'Mudar para o Telegram',
        'Invite a friend' => 'Convidar um amigo',
        'you_lost' => 'Perdeste!',
        'you_won' => 'Ganhou!',
        '[[Player]] won!' => '[[Player]] ganhou!',
        'start_new_game' => 'Iniciar um novo jogo',
        'rating_changed' => 'Alteração de classificação: ',
        'Authorization error' => 'Erro de autorização',
        'Error sending message' => 'Erro no envio da mensagem',
        // Рекорды
        'Got reward' => 'Recebeu prémio',
        'Your passive income' => 'O seu rendimento passivo',
        'will go to the winner' => 'irá para o vencedor',
        'Effect lasts until beaten' => 'O efeito dura até ser batido',
        'per_hour' => 'hora',
        'rank position' => 'posição na hierarquia',
        'record of the year' => 'registo do ano',
        'record of the month' => 'registo do mês',
        'record of the week' => 'registo da semana',
        'record of the day' => 'registo do dia',
        'game_price' => 'pontos do jogo',
        'games_played' => 'jogos realizados',
        'Games Played' => 'Jogos Jogados',
        'top' => 'topo',
        'turn_price' => 'pontos de rotação',
        'word_len' => 'tamanho da palavra',
        'word_price' => 'pontos de palavras',
        UserModel::BALANCE_HIDDEN_FIELD => 'Utilizador oculto',
        'top_year' => 'TOPO 1',
        'top_month' => 'TOPO 2',
        'top_week' => 'TOPO 3',
        'top_day' => 'MELHOR 10',
        // Рекорды конец
        'Return to fullscreen mode?' => 'Regressar ao modo de ecrã inteiro?',
        // Профиль игрока
        'Choose file' => 'Escolher ficheiro',
        'Back' => 'Para trás',
        'Wallet' => 'Carteira',
        'Referrals' => 'Referências',
        'Player ID' => 'ID do Jogador',
        // complaints
        'Player is unbanned' => 'O jogador não é banido',
        'Player`s ban not found' => 'Banimento do jogador não encontrado',
        'Player not found' => 'Jogador não encontrado',
        // end complaints
        'Save' => 'Guardar',
        'new nickname' => 'novo apelido',
        'Input new nickname' => 'Introduzir novo apelido',
        'Your rank' => 'Sua classificação',
        'Ranking number' => 'Posição no ranking',
        'Balance' => 'Saldo',
        'Rating by coins' => 'Classificação por moedas',
        'Secret key' => 'Chave secreta',
        'Link' => 'Ligar',
        'Bonuses accrued' => 'Bónus acumulados',
        'SUDOKU Balance' => 'Saldo SUDOKU',
        'Claim' => 'Reclamação',
        'Name' => 'Nome',
        // Профиль игрока конец
        'Nickname updated' => 'Apelido atualizado',
        'Stats getting error' => 'Estatísticas a receber erro',
        'Error saving Nick change' => 'Erro ao guardar a alteração do Nick',
        'Play at least one game to view statistics' => 'Jogar pelo menos um jogo para ver as estatísticas',
        'Lost server synchronization' => 'Perda de sincronização do servidor',
        'Closed game window' => 'Janela de jogo fechada',
        'You closed the game window and became inactive!' => 'Fechou a janela do jogo e ficou inativo!',
        'Request denied. Game is still ongoing' => 'Pedido recusado. O jogo ainda está a decorrer',
        'Request rejected' => 'Pedido rejeitado',
        'No messages yet' => 'Ainda não há mensagens',
        'New game request sent' => 'Pedido de novo jogo enviado',
        'Your new game request awaits players response' => 'O seu novo pedido de jogo aguarda a resposta dos jogadores',
        'Request was aproved! Starting new game' => 'O pedido foi aprovado! Começar um novo jogo',
        'Default avatar is used' => 'É utilizado o avatar predefinido',
        'Avatar by provided link' => 'Avatar através da ligação fornecida',
        'Set' => 'Perguntar',
        'Avatar loading' => 'Carregamento do avatar',
        'Send' => 'Enviar',
        'Avatar URL' => 'URL do avatar',
        'Apply' => 'Aplicar',
        'Account key' => 'Chave da conta',
        'Main account key' => 'Chave da conta principal',
        'old account saved key' => 'chave de conta antiga guardada',
        'Key transcription error' => 'Erro de transcrição de chaves',
        "Player's ID NOT found by key" => 'ID do jogador NÃO encontrado pela chave',
        'Accounts linked' => 'Contas ligadas',
        'Accounts are already linked' => 'As contas já estão ligadas',
        'Game is not started' => 'O jogo não foi iniciado',
        'OK' => 'OK',
        'Click to expand the image' => 'Clique para ampliar a imagem',
        'Report sent' => 'Relatório enviado',
        'Report declined! Please choose a player from the list' => 'Relatório recusado! Por favor, escolhe um jogador da lista',
        'Your report accepted and will be processed by moderator' => 'O seu relatório foi aceite e será processado pelo moderador',
        'If confirmed, the player will be banned' => 'Se confirmado, o jogador será banido',
        'Report declined!' => 'Relatório recusado!',
        'Only one complaint per each player per day can be sent. Total 24 hours complaints limit is'
        => 'Só pode ser enviada uma reclamação por cada jogador e por dia. O limite total de reclamações em 24 horas é',
        'From player' => 'Do Jogador',
        'To Player' => 'Para o Jogador',
        'Awaiting invited players' => 'À espera de jogadores convidados',
        'Searching for players' => 'Procura de jogadores',
        'Searching for players with selected rank' => 'Procurar jogadores com a classificação selecionada',
        'Message NOT sent - BAN until ' => 'Mensagem NÃO enviada - BAN até ',
        'Message NOT sent - BAN from Player' => 'Mensagem NÃO enviada - BAN do Jogador',
        'Message sent' => 'Mensagem enviada',
        'Exit' => 'Sair',
        'Appeal' => 'Recurso',
        'There are no events yet' => 'Ainda não há eventos',
        'Playing to' => 'Jogar até',
        'Just two players' => 'Só dois jogadores',
        'Up to four players' => 'Até quatro jogadores',
        'Game selection - please wait' => 'Seleção de jogo - por favor aguarde',
        'Your turn!' => 'É a tua vez!',
        'Looking for a new game...' => 'À procura de um novo jogo...',
        'Get ready - your turn is next!' => 'Prepara-te - a tua vez é a seguir!',
        'Take a break - your move in one' => 'Faça uma pausa - a sua mudança num só',
        'Refuse' => 'Recusar',
        'Offer a game' => 'Oferecer um jogo',
        'Players ready:' => 'Jogadores prontos:',
        'Players' => 'Jogadores',
        'Try sending again' => 'Tentar enviar novamente',
        'Error connecting to server!' => 'Erro ao ligar ao servidor!',
        'You haven`t composed a single word!' => 'Não compuseste uma única palavra!',
        'You will lose if you quit the game! CONTINUE?' => 'Perderás se abandonares o jogo! CONTINUAR?',
        'Cancel' => 'Cancelar',
        'Confirm' => 'Confirmar',
        'Revenge!' => 'Vingança!',
        'Time elapsed:' => 'Tempo decorrido:',
        'Time limit:' => 'Limite de tempo:',
        'You can start a new game if you wait for a long time' => 'Pode iniciar um novo jogo se esperar muito tempo',
        'Close in 5 seconds' => 'Fechar em 5 segundos',
        'Close immediately' => 'Fechar imediatamente',
        'Will close automatically' => 'Fecha-se automaticamente',
        's' => ' segundos',
        'Average waiting time:' => 'Tempo médio de espera:',
        'Waiting for other players' => 'À espera de outros jogadores',
        'Game goal' => 'Objetivo do jogo',
        'Rating of opponents' => 'Classificação dos adversários',
        'new player' => 'novo jogador',
        'CHOOSE GAME OPTIONS' => 'ESCOLHER OPÇÕES DE JOGO',
        'Profile' => 'Perfil',
        'Error' => 'Erro',
        'Your profile' => 'O seu perfil',
        'Start' => 'Início',
        'Stats' => 'Estatísticas',
        'Play on' => 'Jogar em',
        // Чат
        'Error sending complaint<br><br>Choose opponent' => 'Erro no envio da queixa<br><br>Escolher o adversário',
        'You' => 'Tu',
        'to all: ' => 'a todos: ',
        ' (to all):' => ' (a todos):',
        'For everyone' => 'Para todos',
        'Word matching' => 'Jogo de palavras',
        'Player support and chat at' => 'Suporte ao jogador e chat no',
        'Join group' => 'Juntar-se ao grupo',
        'Send an in-game message' => 'Enviar uma mensagem no jogo',
        // Чат
        'News' => 'Notícias',
        // Окно статистика
        'Past Awards' => 'Prémios antigos',
        'Parties_Games' => 'Jogos jogados',
        'Player`s achievements' => 'Conquistas do jogador',
        'Player Awards' => 'Prémios para jogadores',
        'Player' => 'Jogador',
        'VS' => 'VS',
        'Rating' => 'Classificação',
        'Opponent' => 'Oponente',
        'Active Awards' => 'Prémios Activos',
        'Remove filter' => 'Remover filtro',
        // Окно статистика конец

        "Opponent's rating" => 'Classificação do oponente',
        'Choose your MAX bet' => 'Escolha a sua aposta MÁXIMA',
        'Searching for players with corresponding bet' => 'Procura de jogadores com a aposta correspondente',
        'Coins written off the balance sheet' => 'Moedas abatidas no balanço',
        'Number of coins on the line' => 'Número de moedas na linha',
        'gets a win' => 'ganha',
        'The bank of' => 'O banco de',
        'goes to you' => 'vai para si',
        'is taken by the opponent' => 'é tomado pelo adversário',
        'Bid' => 'Proposta',
        'No coins' => 'Sem moedas',
        'Any' => 'Qualquer',
        'online' => 'online',
        'Above' => 'Acima',
        'minutes' => 'minutos',
        'minute' => 'minuto',
        'Select the minimum opponent rating' => 'Selecionar a classificação mínima do adversário',
        'Not enough 1900+ rated players online' => 'Não há suficientes jogadores com classificação 1900+ online',
        'Only for players rated 1800+' => 'Apenas para jogadores com classificação 1800+',
        'in game' => 'no jogo',
        'score' => 'pontuação',
        'Your current rank' => 'A sua posição atual',
        'Server syncing..' => 'Sincronização do servidor...',
        ' is making a turn.' => ' está a fazer uma jogada.',
        'Your turn is next - get ready!' => 'A tua vez é a seguir - prepara-te!',
        'switches pieces and skips turn' => 'troca de peças e salta a vez',
        "Game still hasn't started!" => 'O jogo ainda não começou!',
        "Word wasn't found" => 'A palavra não foi encontrada',
        'Correct' => 'Correto',
        'One-letter word' => 'Palavra de uma letra',
        'Repeat' => 'Repetir',
        'costs' => 'custa',
        '+15 for all pieces used' => '+15 para todas as peças utilizadas',
        'TOTAL' => 'TOTAIS',
        'You did not make any word' => 'Não fez nenhuma palavra',
        'is attempting to make a turn out of his turn (turn #' => 'está a tentar fazer um turno fora do seu turno (turno #',
        'Data processing error!' => 'Erro de processamento de dados!',
        ' - turn processing error (turn #' => ' - erro de processamento da volta (volta #',
        "didn't make any word (turn #" => 'não fez nenhuma palavra (volta #)',
        'set word lenght record for' => 'bateu o recorde de comprimento de palavra para',
        'set word cost record for' => 'estabelece recorde de custo de palavras para',
        'set record for turn cost for' => 'bateu o recorde de custo por turno para',
        'gets' => 'recebe',
        'for turn #' => 'para a vez #',
        'For all pieces' => 'Para todas as peças',
        'Wins with score ' => 'Ganha com pontuação ',
        'set record for gotten points in the game for' => 'estabeleceu o recorde de pontos obtidos no jogo para',
        'out of chips - end of game!' => 'sem fichas - fim do jogo!',
        'set record for number of games played for' => 'bateu o recorde de número de jogos disputados por',
        'is the only one left in the game - Victory!' => 'é o único que resta no jogo - Vitória!',
        'left game' => 'saiu do jogo',
        'has left the game' => 'saiu do jogo',
        'is the only one left in the game! Start a new game' => 'é o único que resta no jogo! Iniciar um novo jogo',
        'Time for the turn ran out' => 'O tempo para uma volta acabou',
        "is left without any pieces! Winner - " => 'fica sem nenhuma peça! Vencedor - ',
        ' with score ' => ' com uma pontuação de ',
        "is left without any pieces! You won with score " => 'fica sem nenhuma peça! Ganhou com uma pontuação de ',
        "gave up! Winner - " => 'desistiu! Vencedor - ',
        'skipped 3 turns! Winner - ' => 'saltou 3 turnos! Vencedor - ',
        'New game has started!' => 'Começou um novo jogo!',
        'New game' => 'Novo jogo',
        'Accept invitation' => 'Aceitar o convite',
        'Get' => 'Obter',
        'score points' => 'marcar pontos',
        "Asking for adversaries' approval." => 'Pedir a aprovação dos adversários.',
        'Remaining in the game:' => 'Ainda no jogo:',
        "You got invited for a rematch! - Accept?" => 'Foste convidado para uma desforra! - Aceitas?',
        'All players have left the game' => 'Todos os jogadores abandonaram o jogo',
        "Your score" => 'A sua pontuação',
        'Turn time' => 'Tempo de rotação',
        'Date' => 'Data',
        'Price' => 'Preço',
        'Status' => 'Estatuto',
        'Type' => 'Tipo',
        'Period' => 'Período',
        'Word' => 'Palavra',
        'Points/letters' => 'Pontos/letras',
        'Result' => 'Resultado',
        'Opponents' => 'Oponentes',
        'Games<br>total' => 'Juegos<br>total',
        'Wins<br>total' => 'Victorias<br>total',
        'Gain/loss<br>in ranking' => 'Ganancia/pérdida<br>en el ranking',
        '% Wins' => '% Ganancias',
        'Games in total' => 'Juegos en total',
        'Winnings count' => 'Recuento de premios',
        'Increase/loss in rating' => 'Aumento/pérdida de rating',
        '% of wins' => '% de victorias',
        "GAME points - Year Record!" => 'Puntos de JUEGO - ¡Récord del Año!',
        "GAME points - Month Record!" => 'Puntos de JUEGO - ¡Récord del Mes!',
        "GAME points - Week Record!" => 'Puntos de JUEGO - ¡Récord de la Semana!',
        "GAME points - Day Record!" => 'Puntos de JUEGO - ¡Récord del Día!',
        "TURN points - Year Record!" => 'Puntos TURN - ¡Récord del Año!',
        "TURN points - Month Record!" => 'Puntos TURN - ¡Récord del Mes!',
        "TURN points - Week Record!" => 'Puntos TURN - ¡Récord de la Semana!',
        "TURN points - Day Record!" => 'Puntos TURN - ¡Récord del Día!',
        "WORD points - Year Record!" => 'Puntos de PALABRA - ¡Récord del Año!',
        "WORD points - Month Record!" => 'Puntos de PALABRA - ¡Récord del Mes!',
        "WORD points - Week Record!" => 'Puntos de PALABRA - ¡Récord de la Semana',
        "WORD points - Day Record!" => 'Puntos de PALABRA - ¡Récord del Día!',
        "Longest WORD - Year Record!" => 'PALABRA más larga - ¡Récord del Año!',
        "Longest WORD - Month Record!" => 'PALABRA más larga - ¡Récord del Mes!',
        "Longest WORD - Week Record!" => 'PALABRA más larga - ¡Récord de la Semana',
        "Longest WORD - Day Record!" => 'PALABRA más larga - ¡Récord del Día!',
        "GAMES played - Year Record!" => 'PARTIDOS jugados - ¡Récord del Año!',
        "GAMES played - Month Record!" => 'PARTIDOS jugados - ¡Récord del Mes!',
        "GAMES played - Week Record!" => 'PARTIDOS jugados - ¡Récord de la Semana',
        "GAMES played - Day Record!" => 'PARTIDOS jugados - ¡Récord del Día!',
        "Victory" => 'Victoria',
        'Losing' => 'Perder',
        "Go to player's stats" => 'Ir a las estadísticas del jugador',
        'Filter by player' => 'Filtrar por jugador',
        'Apply filter' => 'Aplicar filtro',
        'against' => 'contra',
        "File loading error!" => 'Error de carga del archivo',
        "Check:" => 'Revisa:',
        "file size (less than " => 'tamaño del archivo (menos de ',
        "Incorrect URL format!" => 'Formato de URL incorrecto!',
        "Must begin with " => 'Debe empezar por ',
        'Error! Choose image file with the size not more than' => 'Error Elija un archivo de imagen cuyo tamaño no supere los',
        'Avatar updated' => 'Avatar actualizado',
        "Error saving new URL" => 'Error al guardar la nueva URL',
        'A player may open more than one cell and more than one KEY in one turn. Use the CASCADES rule'
        => 'Un jugador puede abrir más de una casilla y más de una LLAVE en un turno. Utilizar la regla de las CASCADAS',
        'If after the automatic opening of a number, new blocks of EIGHT open cells are formed on the field, such blocks are also opened by CASCADE'
        => 'Si tras la apertura automática de un número se forman nuevos bloques de OCHO celdas abiertas en el campo, dichos bloques también se abren por CASCADA',
        'If a player has opened a cell (solved a number in it) and there is only ONE closed digit left in the block, this digit is opened automatically'
        => 'Si un jugador ha abierto una casilla (ha resuelto un número en ella) y sólo queda UN dígito cerrado en el bloque, este dígito se abre automáticamente',
        'is awarded for solved empty cell' => 'premiado por celda vacía resuelta',
        'by calculating all of other 8 digits in a block - vertically OR horizontally OR in a 3x3 square'
        => 'calculando todos los otros 8 dígitos de un bloque - vertical u horizontalmente o en un cuadrado de 3x3.',
        "The players' task is to take turns making moves and accumulating points to open black squares"
        => 'La tarea de los jugadores es hacer movimientos por turnos y acumular puntos para abrir casillas negras',
        'The classic SUDOKU rules apply - in a block of nine cells (vertically, horizontally and in a 3x3 square) the numbers must not be repeated'
        => 'Se aplican las reglas clásicas del SUDOKU - en un bloque de nueve casillas (vertical, horizontal y en un cuadrado de 3x3) los números no deben repetirse',
        'faq_rules' => [
            SudokuGame::GAME_NAME => <<<ES
<h2 id="nav1">Sobre el juego</h2>
Se aplican las reglas clásicas de SUDOKU - en un bloque de nueve casillas (vertical, horizontal y en un cuadrado de 3x3) los números no deben repetirse
<br><br>
La tarea de los jugadores es hacer movimientos por turnos y acumular puntos para abrir casillas negras (<span style="color:#0f0">+10 puntos</span>) calculando todos los otros 8 dígitos en un bloque - vertical u horizontal o en un cuadrado de 3x3.
<br><br>
Se concede un <span style="color:#0f0">+1 punto</span> por celda vacía resuelta
<br><br>
La victoria es para el jugador que consiga el 50% de todos los puntos posibles +1 punto
<br><br>
Si un jugador ha abierto una casilla (ha resuelto un número en ella) y sólo queda UNA cifra cerrada en el bloque, esta cifra se abre automáticamente
<br><br>
Si tras la apertura automática de un número se forman en el campo nuevos bloques de OCHO casillas abiertas, dichos bloques también se abren por CASCADA
<br><br>
Un jugador puede abrir más de una casilla y más de una LLAVE en un turno. Utilice la regla de las CASCADAS
<br><br>
En caso de un movimiento erróneo - el dígito en la casilla es incorrecto - un pequeño dígito rojo de error aparece en esta casilla, que es visible para ambos jugadores. Este dígito no puede volver a colocarse en esta casilla.
<br><br>
Con el botón Comprobar, el jugador puede hacer una marca: poner un pequeño número verde en la celda. Puede ser una cifra calculada de la que el jugador esté seguro, o simplemente una suposición. Utilice las notas como en un SUDOKU normal: el otro jugador no puede verlas.
ES
            ,
        ],
        'faq_rating' => <<<ES
Clasificación Elo
<br><br>
Sistema de clasificación Elo, coeficiente Elo: método para calcular la fuerza relativa de los jugadores en las partidas, 
en juegos en los que participan dos jugadores (por ejemplo, ajedrez, damas o shogi, go). 
<br>
Este sistema de clasificación fue desarrollado por el profesor de física estadounidense de origen húngaro Arpad Elo (húngaro: Élő Árpád; 1903-1992).
<br><br>
Cuanto mayor sea la diferencia de puntuación entre los jugadores, menos puntos para la puntuación obtendrá el jugador más fuerte al ganar.
<br> 
Por el contrario, un jugador más débil obtendrá más puntos para la clasificación si derrota a un jugador más fuerte.
<br><br>
Por lo tanto, para un jugador fuerte es más ventajoso jugar con iguales: si ganas, consigues más puntos, y si pierdes, no pierdes muchos puntos.
<br><br>
Es seguro para un principiante luchar contra un maestro experimentado.
<br>
La pérdida de rango si pierdes será pequeña.
<br>
Pero, en caso de victoria, el maestro compartirá generosamente los puntos de rango...
ES
        ,
        'faq_rewards' => [
            SudokuGame::GAME_NAME => <<<ES
Los jugadores son recompensados por determinados logros (récords).
<br><br>
Las recompensas del jugador se reflejan en la sección «STATS» en las siguientes nominaciones: oro/plata/bronce/piedra.
<br><br>
Al recibir una carta de recompensa, el jugador recibe una bonificación de monedas SUDOKU {{sudoku_icon}}.
<br> 
Las monedas se pueden usar en un modo de juego especial « CON Monedas», puedes reponer tu monedero del juego, 
así como retirar monedas del juego - lee más en la pestaña «Modo Monedas»
<br><br>
Mientras el récord de un jugador no haya sido batido por otro jugador, la tarjeta de recompensa se refleja para ese jugador en la pestaña «PREMIOS ACTIVOS» de la sección «ESTADÍSTICAS».
<br><br>
Cada «Recompensa ACTIVA» cada hora genera «ganancias» adicionales en monedas.
<br><br>
Si un récord ha sido batido por otro jugador, la tarjeta de premio del anterior propietario del récord se mueve a la pestaña «PREMIOS PASADOS» y deja de aportar ingresos pasivos. 
<br><br>
El número total de monedas recibidas (bonificaciones únicas y ganancias adicionales) puede consultarse en la sección «PERFIL», en la pestaña “Monedero”, en los campos «Saldo SUDOKU» y «Bonificaciones acumuladas», respectivamente.
<br><br>
Cuando se supera el propio récord para los logros «PARTIDAS JUGADAS», el jugador no vuelve a recibir una nueva tarjeta de recompensa o monedas. 
El valor del récord propio (número de partidas / número de amigos) se actualiza en la tarjeta de recompensa.
<br><br>
Por ejemplo, si un jugador ha obtenido previamente el logro - «PARTIDAS JUGADAS»
(oro) por 10.000 partidas, cuando el número de partidas de este jugador se cambie a 10.001, no se emitirán más tarjetas de recompensa para el poseedor del récord.
ES
            ,
        ],
        'Reward' => 'Recompensa',
        'faq_coins' => [
            SudokuGame::GAME_NAME => <<<ES
Moneda <strong>SUDOKU</strong> {{sudoku_icon}} es una moneda dentro del juego{{yandex_exclude}}{{para una red de juegos - <strong>Scrabble, Sudoku</strong>
<br><br>
Una cuenta para todos los juegos, una moneda, un monedero}}.
<br><br>
{{yandex_exclude}}{{En el mundo de las criptomonedas, la moneda también se llama SUDOKU. Pronto será posible retirar cualquier número de monedas SUDOKU de tu monedero del juego a un monedero externo en la red TON (Telegram)
<br><br>}}
Mientras tanto, intentamos ganar tantas monedas como sea posible en el juego seleccionando el modo «Monedas»
<br><br>

Este modo también tiene en cuenta y acumula las clasificaciones de los jugadores.
<br>
Sin embargo, las monedas ganadas por los resultados del juego ahora se acreditan a su cartera (o se deducen si pierde)
<br><br>
Dependiendo del saldo actual de monedas en su cartera, se le ofrece jugar por 1, 5, 10, etc. monedas - elija la cantidad deseada de la lista
<br><br>
Después de pulsar el botón «Empezar», comenzará la búsqueda de un oponente que también esté dispuesto a apostar la cantidad especificada
<br><br> 
Por ejemplo, usted ha especificado que el tamaño de su apuesta es de 5 monedas, y entre los que empiezan una nueva partida sólo hay quien está dispuesto a apostar 1 moneda.
<br>
Entonces la apuesta tanto para usted como para dicho jugador será de 1 moneda - la menor de ambas opciones.
<br><br>
En caso de que haya alguien dispuesto a luchar por 10 monedas, su apuesta - 5 será seleccionada y la partida comenzará con un banco de 10 monedas - 5+5
<br><br>
En una partida de dos personas, el ganador se lleva todo el bote - su apuesta y la de su oponente
<br><br>
En una partida de tres jugadores, el ganador se lleva su apuesta y la del último jugador (el jugador con menos puntos). 
El jugador del medio (el segundo clasificado) recupera su apuesta, quedándose con sus monedas
<br><br>
En una partida de cuatro jugadores, el bote se divide entre los jugadores que ocupan los puestos 1º y 4º (el primer jugador se lleva ambas apuestas), 
y los jugadores que ocupan los puestos 2º y 3º (el segundo se lleva ambas apuestas).
<br><br>
Por lo tanto, jugar a tres y a cuatro resulta menos arriesgado en términos de ahorro de monedas
<br><br>
Si todos los jugadores perdedores tienen el mismo número de puntos, entonces el jugador ganador se lleva todas las apuestas
<br><br>
En una partida a cuatro, si el 2º y el 3º jugador consiguen el mismo número de puntos, recuperan su apuesta, quedándose con sus apuestas
<br><br>
La nueva clasificación en todos los casos se calcula como de costumbre - ver la pestaña «Clasificación»
<br><br>
<h2>Cómo puedes reponer tu cartera</h2>
<ol>
<li>
Cada nuevo jugador recibe {{stone_reward}} de bienvenida. {{yandex_exclude}}{{SUDOKU}} monedas a su saldo y puede participar inmediatamente en la carrera por las grandes ganancias
</li>
<li>
Recibirás monedas {{stone_reward}} por cada amigo que entre en el juego utilizando tu enlace de recomendación. 
Además, si establece un récord (para el día, la semana, el mes o el año) en el número de invitados, será recompensado. Para invitar a un usuario, tienes que iniciar sesión en el juego a través de Telegram.
</li> <li>
<li>
Las monedas se otorgan por logros en el juego (puntos por partida, puntos por movimiento, puntos por palabra, número de partidas, número de invitados, puesto en el ranking del #1 al #10).
</li>
<li>
Por cada 100 partidas, se otorgan {{stone_reward}} de {{yandex_exclude}}{{SUDOKU }} monedas
</li>
{{yandex_exclude}}{{<li>
Compra monedas por rublos mediante transferencia
</li>
<li>Compra monedas por criptodivisas (próximamente)
</li>}}.
</ol>

<br>
El número de monedas otorgadas por cada logro puede cambiar con el tiempo, ya sea hacia arriba o hacia abajo. La recompensa real se refleja en la tarjeta del logro.
<br><br>
<h2>Qué puedes hacer con las monedas que ganes</h2>
<ol>
<li>
Juega a nuestros juegos, aumentando las apuestas, añadiendo emoción e interés a tu pasatiempo favorito
</li>
{{yandex_exclude}}{{<li>
Vende monedas por rublos o por criptodivisas (próximamente) y obtén tu recompensa en términos de dinero real
</li><}}
{{yandex_exclude}}{{<li>
Haz un regalo a otro jugador enviándole cualquier cantidad de monedas de tu monedero (próximamente)
</li>}}   
</ol>
<br>
Puedes conocer los detalles del saldo de tu monedero en la pestaña «Monedero» del menú «PERFIL».
<br><br>
<strong>Bonificaciones acumuladas</strong> - el resultado de las ganancias pasivas acumuladas cada hora dependiendo de los logros del jugador (menú «ESTADÍSTICAS», sección «Premios»).
<br>Las bonificaciones pueden transferirse al saldo pulsando el botón «RECLAMAR»
<br><br>
<strong>{{yandex_exclude}}{{SUDOKU}} Saldo</strong> - saldo actual de monedas sin bonificaciones. Las monedas se deducen / acreditan en función de los resultados del juego
<br><br>
Las tarjetas de logros, similares a las medallas, son un indicador de tu éxito. 
<br>Incluyen el nombre del logro, el periodo (año, día, semana, mes), el número de puntos (puntuación, longitud de palabra, número de amigos) y el número de monedas 
<br><br>
La obtención pasiva de monedas se detiene cuando otro jugador bate tu récord.
ES
            ,
        ],
        '[[Player]] opened [[number]] [[cell]]' => '[[Player]] abierto [[number]] [[cell]]',
        ' (including [[number]] [[key]])' => ' (incluyendo [[number]] [[key]])',
        '[[Player]] made a mistake' => '[[Player]] cometió un error',
        'You made a mistake!' => '¡Cometiste un error!',
        'Your opponent made a mistake' => 'Su oponente cometió un error',
        '[[Player]] gets [[number]] [[point]]' => '[[Player]] consigue [[number]] [[point]].',
        '[[number]] [[point]]' => '[[number]] [[point]]',
        'You got [[number]] [[point]]' => 'Tienes [[number]] [[point]].',
        'Your opponent got [[number]] [[point]]' => 'Su oponente obtuvo [[number]] [[point]].',
    ];
}