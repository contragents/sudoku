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
        'Opponents' => 'Opositores',
        'Games<br>total' => 'Jogos<br>total',
        'Wins<br>total' => 'Vitórias<br>total',
        'Gain/loss<br>in ranking' => 'Ganho/perda<br>na posição',
        '% Wins' => '% de Vitórias',
        'Games in total' => 'Jogos no total',
        'Winnings count' => 'Os ganhos contam',
        'Increase/loss in rating' => 'Aumento/perda da notação',
        '% of wins' => '% de vitórias',
        "GAME points - Year Record!" => 'Pontos do jogo - Recorde do Ano!',
        "GAME points - Month Record!" => 'Pontos de jogo - Recorde do Mês!',
        "GAME points - Week Record!" => 'Pontos do jogo - Recorde da Semana!',
        "GAME points - Day Record!" => 'Pontos do jogo - Recorde do Dia!',
        "TURN points - Year Record!" => 'Pontos de rotação - Recorde do Ano!',
        "TURN points - Month Record!" => 'Pontos de rotação - Recorde do Mês!',
        "TURN points - Week Record!" => 'Pontos de rotação - ecorde da Semana!',
        "TURN points - Day Record!" => 'Pontos de rotação - Recorde do Dia!',
        "WORD points - Year Record!" => 'Pontos de PALAVRAS - Recorde do Ano!',
        "WORD points - Month Record!" => 'Pontos de PALAVRAS - Recorde do Mês!',
        "WORD points - Week Record!" => 'Pontos de PALAVRAS - ecorde da Semana!',
        "WORD points - Day Record!" => 'Pontos de PALAVRAS - Recorde do Dia!',
        "Longest WORD - Year Record!" => 'A PALAVRA mais longa - Recorde do Ano!',
        "Longest WORD - Month Record!" => 'A PALAVRA mais longa - Recorde do Mês!',
        "Longest WORD - Week Record!" => 'A PALAVRA mais longa - ecorde da Semana!',
        "Longest WORD - Day Record!" => 'A PALAVRA mais longa - Recorde do Dia!',
        "GAMES played - Year Record!" => 'JOGOS jogados - Recorde do Ano!',
        "GAMES played - Month Record!" => 'JOGOS jogados - Recorde do Mês!',
        "GAMES played - Week Record!" => 'JOGOS jogados - ecorde da Semana!',
        "GAMES played - Day Record!" => 'JOGOS jogados - Recorde do Dia!',
        "Victory" => 'Vitória',
        'Losing' => 'Perder',
        "Go to player's stats" => 'Ir para as estatísticas do jogador',
        'Filter by player' => 'Filtrar por jogador',
        'Apply filter' => 'Aplicar filtro',
        'against' => 'contra',
        "File loading error!" => 'Erro de carregamento do ficheiro!',
        "Check:" => 'Verificar:',
        "file size (less than " => 'tamanho do ficheiro (inferior a ',
        "Incorrect URL format!" => 'Formato de URL incorreto!',
        "Must begin with " => 'Deve começar por ',
        'Error! Choose image file with the size not more than' => 'Erro! Selecionar ficheiro de imagem com tamanho não superior a',
        'Avatar updated' => 'Avatar atualizado',
        "Error saving new URL" => 'Erro ao guardar o novo URL',
        'A player may open more than one cell and more than one KEY in one turn. Use the CASCADES rule'
        => 'Um jogador pode abrir mais do que uma célula e mais do que uma CHAVE numa jogada. Utilizar a regra dos CASCAIS',
        'Se, após a abertura automática de um número, se formarem no campo novos blocos de OITO células abertas, esses blocos são também abertos por CASCATA'
        => 'Se, após a abertura automática de um número, se formarem no campo novos blocos de OITO células abertas, esses blocos são também abertos por CASCATA',
        'If a player has opened a cell (solved a number in it) and there is only ONE closed digit left in the block, this digit is opened automatically'
        => 'Se um jogador tiver aberto uma célula (resolvido um número nela) e só restar UM dígito fechado no bloco, este dígito é aberto automaticamente',
        'is awarded for solved empty cell' => 'é atribuído a uma célula vazia resolvida',
        'by calculating all of other 8 digits in a block - vertically OR horizontally OR in a 3x3 square'
        => 'calculando todos os outros 8 dígitos num bloco - verticalmente OU horizontalmente OU num quadrado 3x3',
        "The players' task is to take turns making moves and accumulating points to open black squares"
        => 'A tarefa dos jogadores é fazer jogadas à vez e acumular pontos para abrir quadrados pretos,',
        'The classic SUDOKU rules apply - in a block of nine cells (vertically, horizontally and in a 3x3 square) the numbers must not be repeated'
        => 'Aplicam-se as regras clássicas do SUDOKU - num bloco de nove células (verticalmente, horizontalmente e num quadrado 3x3), os números não podem ser repetidos',
        'faq_rules' => [
            SudokuGame::GAME_NAME => <<<PT
<h2 id="nav1">Sobre o jogo</h2>
The classic SUDOKU rules apply - in a block of nine cells (vertically, horizontally and in a 3x3 square) the numbers must not be repeated
<br><br>
A tarefa dos jogadores é fazer jogadas à vez e acumular pontos para abrir quadrados pretos (<span style="color:#0f0">+10 pontos</span>) calculando todos os outros 8 dígitos num bloco - verticalmente OU horizontalmente OU num quadrado 3x3
<br><br>
É atribuído um <span style="color:#0f0">+1 ponto</span> por cada célula vazia resolvida
<br><br>
A vitória vai para o jogador que marcar 50% de todos os pontos possíveis +1 ponto
<br><br>
Se um jogador tiver aberto uma célula (resolvido um número nela) e restar apenas UM dígito fechado no bloco, este dígito é aberto automaticamente
<br><br>
Se, após a abertura automática de um número, se formarem novos blocos de OITO células abertas no campo, esses blocos também são abertos por CASCATA
<br><br>
Um jogador pode abrir mais do que uma célula e mais do que uma CHAVE na mesma jogada. Utilizar a regra dos CASCAIS
<br><br>
Em caso de jogada errada - o algarismo da célula está errado - aparece um pequeno algarismo de erro vermelho nesta célula, que é visível para ambos os jogadores. Este algarismo não pode voltar a ser colocado nesta célula
<br><br>
Utilizando o botão Verificar, o jogador pode fazer uma marca - colocar um pequeno número verde na célula. Pode ser um valor calculado de que o jogador tem a certeza, ou apenas um palpite. Utiliza notas como num SUDOKU normal - o outro jogador não as pode ver
PT
            ,
        ],
        'faq_rating' => <<<PT
Classificação Elo
<br><br>
Sistema de classificação Elo, coeficiente Elo - um método de cálculo da força relativa dos jogadores em jogos, 
em jogos que envolvem dois jogadores (por exemplo, xadrez, damas ou shogi, go).
<br>
Este sistema de classificação foi desenvolvido pelo professor de física americano de origem húngara Arpad Elo (húngaro: Élő Árpád; 1903-1992)
<br><br>
Quanto maior for a diferença de classificação entre os jogadores, menos pontos para a classificação o jogador mais forte obterá ao ganhar.
<br> 
Por outro lado, um jogador mais fraco obterá mais pontos para a classificação se derrotar um jogador mais forte.
<br><br>
Assim, é mais vantajoso para um jogador forte jogar com iguais - se ganhar, ganha mais pontos, e se perder, não perde muitos pontos.
<br><br>
É seguro para um principiante lutar contra um mestre experiente.
<br>
A perda de classificação se perderes será pequena.
<br>
Mas, em caso de vitória, o mestre partilhará generosamente os pontos da classificação
PT
        ,
        'faq_rewards' => [
            SudokuGame::GAME_NAME => <<<PT
Os jogadores são recompensados por determinados feitos (recordes).
<br><br>
Os prémios do jogador são reflectidos na secção “ESTATÍSTICAS” nas seguintes nomeações: ouro/prata/bronze/pedra.
<br><br>
Ao receber um cartão de recompensa, o jogador recebe um bónus de moedas SUDOKU {{sudoku_icon}}
<br> 
As moedas podem ser usadas num modo de jogo especial “Moedas ON”, podes reabastecer a tua carteira no jogo, 
bem como retirar moedas do jogo - lê mais no separador "Modo de Jogo Moedas"
<br><br>
Enquanto o recorde de um jogador não tiver sido batido por outro jogador, o cartão de recompensa é refletido para esse jogador no separador “PRÉMIOS ACTIVOS” da secção “ESTATÍSTICAS”.
<br><br>
Cada “Recompensa ACTIVA” a cada hora gera um “lucro” adicional em moedas.
<br><br>
Se um recorde for batido por outro jogador, o cartão de prémio do anterior detentor do recorde é movido para o separador “PRÉMIOS ANTERIORES” e deixa de gerar rendimentos passivos. 
<br><br>
O número total de moedas recebidas (bónus único e lucro adicional) pode ser consultado na secção “PERFIL”, no separador ‘Carteira’, nos campos “Saldo SUDOKU” e “Bónus acumulados”, respetivamente.
<br><br>
Quando se ultrapassa o próprio recorde da conquista “FESTAS JOGADAS”, o jogador não volta a receber um novo cartão de recompensa ou moedas. 
O próprio valor do recorde (número de jogos / número de amigos) é atualizado no cartão de recompensa.
<br><br>
Por exemplo, se um jogador já ganhou a conquista - “JOGOS JOGADOS”
(ouro) por 10.000 jogos, então quando o número de jogos deste jogador for alterado para 10.001, não serão emitidos mais cartões de recompensa para o detentor do recorde.
PT
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