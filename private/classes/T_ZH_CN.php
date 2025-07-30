<?php

namespace classes;


use PaymentModel;
use UserModel;

class T_ZH_CN
{
    const PHRASES = [
        'Invalid URL format! <br />It must begin with <strong>http(s)://</strong>' => 'URL 格式无效！<br>必须以 <strong>http(s)://</strong> 开头',
        '</strong> or <strong>' => '</strong> 或 <strong>',
        'MB</strong>)</li><li>extension -<strong>' => 'MB</strong>)</li><li>延长 -<strong>',
        '<strong>File upload error!</strong><br /> Please review:<br /> <ul><li>file size (no more than <strong>'
        => '<strong>文件上传错误！</strong><br /> 请审查：<br /> <ul><li> 文件大小不超过 <strong>',
        'Error creating new payment' => '创建新付款出错',
        'FAQ' => '常见问题',
        'Agreement' => '协议',
        'Empty value is forbidden' => '禁止使用空值',
        'Forbidden' => '禁止',
        'game_title' => [
            SudokuGame::GAME_NAME => '与朋友一起在线玩数独',
        ],
        'secret_prompt' => [
            SudokuGame::GAME_NAME => '&#42;保存此密钥，以便在 Telegram 中进一步恢复账户</a>',
        ],
        'COIN Balance' => '硬币余额',
        PaymentModel::INIT_STATUS => '已开始',
        PaymentModel::BAD_CONFIRM_STATUS => '糟糕的确认',
        PaymentModel::COMPLETE_STATUS => '已完成',
        PaymentModel::FAIL_STATUS => '失败',
        'Last transactions' => '最后交易',
        'Support in Telegram' => 'Telegram 支持',
        'Check_price' => '查看价格',
        'Replenish' => '补充',
        'SUDOKU_amount' => '硬币数量',
        'enter_amount' => '数量',
        'Buy_SUDOKU' => '购买 SUDOKU 硬币',
        'The_price' => '报价',
        'calc_price' => '价格',
        'Pay' => '薪酬',
        'Congratulations to Player' => '祝贺玩家',
        'Server sync lost' => '服务器同步丢失',
        'Server connecting error. Please try again' => '服务器连接错误。请重试',
        'Error changing settings. Try again later' => '更改设置出错。稍后再试',
        'invite_friend_prompt' => [
            SudokuGame::GAME_NAME => '加入 Telegram 上的在线数独游戏！获得最高评分，赚取金币并将代币存入钱包',
        ],
        'game_bot_url' => [
            SudokuGame::GAME_NAME => 'https://t.me/sudoku_app_bot',
        ],
        'loading_text' => [SudokuGame::GAME_NAME => '数独正在加载...'],
        'switch_tg_button' => '转至 Telegram',
        'Invite a friend' => '邀请朋友',
        'you_lost' => '你输了',
        'you_won' => '你赢了',
        '[[Player]] won!' => '[[Player]] 获胜',
        'start_new_game' => '开始新游戏',
        'rating_changed' => '评级变化：',
        'Authorization error' => '授权错误',
        'Error sending message' => '发送信息出错',
        // Рекорды
        'Got reward' => '获得奖励',
        'Your passive income' => '您的被动收入',
        'will go to the winner' => '- 获奖者将获得',
        'Effect lasts until beaten' => '效果持续到打完为止',
        'per_hour' => '小时',
        'rank position' => '官职',
        'record of the year' => '年度最佳纪录',
        'record of the month' => '月度记录',
        'record of the week' => '本周记录',
        'record of the day' => '当天记录',
        'game_price' => '游戏积分',
        'games_played' => '玩过的游戏',
        'Games Played' => '玩过的游戏',
        'top' => '顶级',
        'turn_price' => '游戏回合积分',
        'word_len' => '字长',
        'word_price' => '字数',
        UserModel::BALANCE_HIDDEN_FIELD => '用户隐藏',
        'top_year' => '前 1 名',
        'top_month' => '前 2 名',
        'top_week' => '前 3 名',
        'top_day' => '最佳 10',
        // Рекорды конец
        'Return to fullscreen mode?' => '返回全屏模式？',
        // Профиль игрока
        'Choose file' => '选择文件',
        'Back' => '返回',
        'Wallet' => '钱包',
        'Referrals' => '转介',
        'Player ID' => '球员编号',
        // complaints
        'Player is unbanned' => '玩家被解禁',
        'Player`s ban not found' => '未找到禁赛球员',
        'Player not found' => '未找到播放器',
        // end complaints
        'Save' => '节省',
        'new nickname' => '新昵称',
        'Input new nickname' => '输入新昵称',
        'Your rank' => '您的等级',
        'Ranking number' => '排名编号',
        'Balance' => '账户余额',
        'Rating by coins' => '按硬币评级',
        'Secret key' => '密匙',
        'Link' => '链接',
        'Bonuses accrued' => '应计奖金',
        'SUDOKU Balance' => 'SUDOKU 账户余额',
        'Claim' => '索赔',
        'Name' => '名称',
        // Профиль игрока конец
        'Nickname updated' => '昵称已更新',
        'Stats getting error' => '统计数据出错',
        'Error saving Nick change' => '保存尼克更改错误',
        'Play at least one game to view statistics' => '至少玩一场游戏才能查看统计数据',
        'Lost server synchronization' => '服务器同步丢失',
        'Closed game window' => '关闭游戏窗口',
        'You closed the game window and became inactive!' => '您关闭了游戏窗口，不再活动！',
        'Request denied. Game is still ongoing' => '请求被拒绝。游戏仍在进行中',
        'Request rejected' => '请求被拒绝',
        'No messages yet' => '尚无留言',
        'New game request sent' => '已发送新游戏请求',
        'Your new game request awaits players response' => '您的新游戏请求等待玩家回复',
        'Request was aproved! Starting new game' => '请求已获批准！开始新游戏',
        'Default avatar is used' => '使用默认头像',
        'Avatar by provided link' => '通过提供的链接获取头像',
        'Set' => '建立',
        'Avatar loading' => '头像加载',
        'Send' => '发送',
        'Avatar URL' => '头像网址',
        'Apply' => '申请',
        'Account key' => '账户密钥',
        'Main account key' => '主账户密钥',
        'old account saved key' => '旧账户保存密钥',
        'Key transcription error' => '关键誊写错误',
        "Player's ID NOT found by key" => '键未找到球员 ID',
        'Accounts linked' => '关联账户',
        'Accounts are already linked' => '账户已连接',
        'Game is not started' => 'Game is not started',
        'OK' => '好了',
        'Click to expand the image' => '点击展开图片',
        'Report sent' => '发送报告',
        'Report declined! Please choose a player from the list' => '报告被拒绝！请从列表中选择一名球员',
        'Your report accepted and will be processed by moderator' => '您的报告已被接受，将由版主处理',
        'If confirmed, the player will be banned' => '如果确认，该玩家将被禁言',
        'Report declined!' => '拒绝报告！',
        'Only one complaint per each player per day can be sent. Total 24 hours complaints limit is'
        => 'Only one complaint per each player per day can be sent. Total 24 hours complaints limit is',
        'From player' => '来自玩家',
        'To Player' => '致玩家',
        'Awaiting invited players' => '等待受邀选手',
        'Searching for players' => '寻找球员',
        'Searching for players with selected rank' => '搜索所选等级的球员',
        'Message NOT sent - BAN until ' => '未发送信息 - 禁用至 ',
        'Message NOT sent - BAN from Player' => '未发送信息 - 封禁玩家',
        'Message sent' => '已发送信息',
        'Exit' => '退出游戏',
        'Appeal' => '上诉',
        'There are no events yet' => '尚无活动',
        'Playing to' => '播放到',
        'Just two players' => '只有两名球员',
        'Up to four players' => '最多四名玩家',
        'Game selection - please wait' => '游戏选择 - 请稍候',
        'Your turn!' => '轮到你玩游戏了',
        'Looking for a new game...' => '寻找新游戏',
        'Get ready - your turn is next!' => '准备好，下一个就轮到你了！',
        'Take a break - your move in one' => '休息一下 - 您的一举一动',
        'Refuse' => '垃圾',
        'Offer a game' => '提供游戏',
        'Players ready:' => '准备就绪的球员：',
        'Players' => '球员',
        'Try sending again' => '尝试再次发送',
        'Error connecting to server!' => '连接服务器出错！',
        'You haven`t composed a single word!' => '你一个字也没写！',
        'You will lose if you quit the game! CONTINUE?' => '如果退出游戏，您将输掉比赛！继续？',
        'Cancel' => '取消',
        'Confirm' => '确认',
        'Revenge!' => '复仇',
        'Time elapsed:' => '所用时间：',
        'Time limit:' => '时间限制：',
        'You can start a new game if you wait for a long time' => '如果等待时间过长，可以重新开始游戏',
        'Close in 5 seconds' => '5 秒后关闭',
        'Close immediately' => '立即关闭',
        'Will close automatically' => '将自动关闭',
        's' => ' 秒钟',
        'Average waiting time:' => '平均等待时间',
        'Waiting for other players' => '等待其他玩家',
        'Game goal' => '游戏目标',
        'Rating of opponents' => '对手评级',
        'new player' => '新玩家',
        'CHOOSE GAME OPTIONS' => '<strong>选择游戏选项</strong>',
        'Profile' => '简介',
        'Error' => '错误',
        'Your profile' => '您的个人资料',
        'Start' => '开始游戏',
        'Stats' => '统计数据',
        'Play on' => '播放',
        // Чат
        'Error sending complaint<br><br>Choose opponent' => '发送投诉出错<br><br>选择对手',
        'You' => '你',
        'to all: ' => '给所有人： ',
        ' (to all):' => ' (对所有人）：',
        'For everyone' => '为每个人',
        'Word matching' => '词语匹配',
        'Player support and chat at' => '玩家支持和聊天',
        'Join group' => '加入小组',
        'Send an in-game message' => '发送游戏内消息',
        // Чат
        'News' => '新闻',
        // Окно статистика
        'Past Awards' => '过往奖项',
        'Parties_Games' => '玩过的游戏',
        'Player`s achievements' => '球员的成就',
        'Player Awards' => '球员奖项',
        'Player' => '玩家',
        'VS' => '虚拟现实',
        'Rating' => '评级',
        'Opponent' => '对手',
        'Active Awards' => '活跃奖项',
        'Remove filter' => '移除过滤器',
        // Окно статистика конец

        "Opponent's rating" => '对手评级',
        'Choose your MAX bet' => '选择您的最大投注额',
        'Searching for players with corresponding bet' => '搜索有相应投注的球员',
        'Coins written off the balance sheet' => '从资产负债表中注销的硬币',
        'Number of coins on the line' => '线上硬币数量',
        'gets a win' => '获胜',
        'The bank of' => '银行',
        'goes to you' => '去你那儿',
        'is taken by the opponent' => '被对手',
        'Bid' => '投标',
        'No coins' => '无硬币',
        'Any' => '任何',
        'online' => '在线',
        'Above' => '以上',
        'minutes' => '分钟',
        'minute' => '分钟',
        'Select the minimum opponent rating' => '选择最低对手等级',
        'Not enough 1900+ rated players online' => '没有足够的 1900+ 级玩家在线',
        'Only for players rated 1800+' => '仅适用于 1800 分以上的玩家',
        'in game' => '在游戏中',
        'score' => '总谱',
        'Your current rank' => '您目前的等级',
        'Server syncing..' => '服务器同步',
        ' is making a turn.' => ' 正在转弯',
        'Your turn is next - get ready!' => '下一个轮到你了--准备好！',
        'switches pieces and skips turn' => '交换棋子并跳过回合',
        "Game still hasn't started!" => '比赛还没开始',
        "Word wasn't found" => '未找到单词',
        'Correct' => '正确',
        'One-letter word' => '单字母词',
        'Repeat' => '复',
        'costs' => '费用',
        '+15 for all pieces used' => '所有已使用的部件 +15',
        'TOTAL' => '总计',
        'You did not make any word' => '你没有说任何话',
        'is attempting to make a turn out of his turn (turn #' => '正试图在自己的回合（回合编号',
        'Data processing error!' => '数据处理错误！',
        ' - turn processing error (turn #' => ' - 转弯处理错误（转弯 #',
        "didn't make any word (turn #" => '(一言不发',
        'set word lenght record for' => '设置字长记录为',
        'set word cost record for' => '创造了',
        'set record for turn cost for' => '创历史新高',
        'gets' => '获得',
        'for turn #' => '轮到',
        'For all pieces' => '所有作品',
        'Wins with score ' => '赢得分数 : ',
        'set record for gotten points in the game for' => '创造了本场比赛的得分纪录',
        'out of chips - end of game!' => '筹码用完 - 游戏结束！',
        'set record for number of games played for' => '创个人出场次数纪录',
        'is the only one left in the game - Victory!' => '- 是游戏中唯一剩下的玩家 - 胜利！',
        'left game' => '离开游戏',
        'has left the game' => '已离开游戏',
        'is the only one left in the game! Start a new game' => '- 是游戏中唯一剩下的玩家！开始新游戏',
        'Time for the turn ran out' => '转身的时间到了',
        "is left without any pieces! Winner - " => '没有任何棋子！获胜者 ',
        ' with score ' => ' 带谱 ',
        "is left without any pieces! You won with score " => '没有任何棋子！您以得分获胜: ',
        "gave up! Winner - " => '放弃！优胜者 ',
        'skipped 3 turns! Winner - ' => '跳过 3 个回合！优胜者 ',
        'New game has started!' => '新游戏开始了！',
        'New game' => '新游戏',
        'Accept invitation' => '接受邀请',
        'Get' => '获取',
        'score points' => '得分',
        "Asking for adversaries' approval." => '请求对手批准',
        'Remaining in the game:' => '比赛剩余时间',
        "You got invited for a rematch! - Accept?" => '有人邀请你重赛 - 接受吗？',
        'All players have left the game' => '所有玩家均已离开游戏',
        "Your score" => '您的游戏得分',
        'Turn time' => '游戏回合时间',
        'Date' => '日期',
        'Price' => '价格',
        'Status' => '现状',
        'Type' => '类型',
        'Period' => '期间',
        'Word' => '字词',
        'Points/letters' => '分数/字母',
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
Aplicam-se as regras clássicas do SUDOKU - num bloco de nove células (verticalmente, horizontalmente e num quadrado 3x3), os números não podem ser repetidos
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
            SudokuGame::GAME_NAME => <<<PT
Moeda <strong>SUDOKU</strong> {{sudoku_icon}} é uma moeda do jogo{{yandex_exclude}}{{para uma rede de jogos - <strong>Scrabble, Sudoku</strong>
<br><br>
Uma conta para todos os jogos, uma moeda, uma carteira}}
<br><br>
{{yandex_exclude}}{{No mundo das criptomoedas, a moeda também se chama SUDOKU. Em breve será possível retirar qualquer número de moedas SUDOKU da tua carteira do jogo para uma carteira externa na rede TON (Telegram)
<br><br>}}
Entretanto, tentamos ganhar o máximo de moedas possível no jogo selecionando o modo "Moedas
<br><br>

Este modo também tem em conta e acumula as classificações dos jogadores.
<br>
No entanto, as moedas ganhas pelos resultados do jogo são agora creditadas na tua carteira (ou deduzidas se perderes)
<br><br>
Dependendo do saldo atual de moedas na sua carteira, é-lhe proposto jogar por 1, 5, 10, etc. moedas - escolha o montante desejado na lista
<br><br>
Depois de premir o botão “Iniciar”, começará a procura de um adversário que também esteja pronto para apostar o montante especificado
<br><br> 
Por exemplo, especificou o tamanho da sua aposta como 5 moedas e, entre os que iniciam um novo jogo, só há quem esteja disposto a apostar 1 moeda.
<br>
Então a aposta para si e para esse jogador será de 1 moeda - a menor das duas opções.
<br><br>
No caso de haver alguém disposto a lutar por 10 moedas, a sua aposta - 5 será selecionada e o jogo começará com uma banca de 10 moedas - 5+5
<br><br>
Num jogo a duas pessoas, o vencedor recebe o pote inteiro - a sua aposta e a aposta do adversário
<br><br>
Num jogo a três, o vencedor recebe a sua aposta e a aposta do último jogador (o jogador com menos pontos). 
O jogador do meio (o segundo classificado) recebe a sua aposta de volta, ficando com as suas moedas
<br><br>
Num jogo a quatro jogadores, o pote é dividido entre os jogadores em 1º e 4º lugar (o primeiro jogador fica com as duas apostas), 
e os jogadores em 2º e 3º lugares (o segundo fica com as duas apostas).
<br><br>
Assim, jogar três e quatro torna-se menos arriscado em termos de poupança de moedas
<br><br>
Se todos os jogadores perdedores tiverem o mesmo número de pontos, então o jogador vencedor recebe todas as apostas
<br><br>
Num jogo a quatro, se o 2º e o 3º jogadores marcarem um número igual de pontos, recebem a sua aposta de volta, mantendo as suas apostas
<br><br>
A Nova Classificação em todos os casos é calculada como habitualmente - ver o separador “Classificação”
<br><br>
<h2>Como pode reabastecer a sua carteira</h2>
<ol>
<li>
Todos os novos jogadores recebem moedas de boas-vindas {{stone_reward}} {{yandex_exclude}}{{SUDOKU}} moedas no seu saldo e pode envolver-se imediatamente na corrida para grandes prémios
</li>
<li>
Receberás moedas {{stone_reward}} por cada amigo que entrar no jogo usando o teu link de referência. 
Além disso, ao estabeleceres um recorde (para o dia, semana, mês, ano) no número de convidados, serás recompensado. Para convidar um utilizador, é necessário iniciar sessão no jogo através do Telegram.
</li>
<li>
As moedas são atribuídas por conquistas no jogo (pontos por jogo, pontos por movimento, pontos por palavra, número de jogos, número de convidados, lugar no ranking de #1 a #10)
</li>
<li>
Por cada 100 jogos, são atribuídas {{stone_reward}} de moedas {{yandex_exclude}}{{{SUDOKU }}
</li>
{{yandex_exclude}}{{<li>
Comprar moedas por rublos por transferência
</li>
<li>Comprar moedas por criptomoeda (brevemente)
</li>}}
</ol>

<br>
O número de moedas atribuídas a cada conquista pode mudar ao longo do tempo, para cima ou para baixo. A recompensa real é reflectida no cartão de conquista.
<br><br>
<h2>O que podes fazer com as moedas que ganhas</h2>
<ol>
<li>
Jogue nossos jogos, aumentando as apostas, adicionando emoção e interesse ao seu passatempo favorito
</li>
{{yandex_exclude}}{{<li>
Venda moedas por rublos ou por criptomoeda (em breve) e receba sua recompensa em termos de dinheiro real
</li>}}
{{yandex_exclude}}{{<li>
Oferece um presente a outro jogador enviando-lhe qualquer número de moedas da tua carteira (em breve)
</li>}}   
</ol>
<br>
Pode saber os detalhes do saldo da sua carteira no separador “Carteira” do menu “PERFIL”.
<br><br>
<strong>Bónus acumulados</strong> - resultado dos ganhos passivos acumulados a cada hora em função das conquistas do jogador (menu “ESTATÍSTICAS”, secção “Prémios”).
<br>Os bónus podem ser transferidos para o saldo premindo o botão “RECLAMAR”
<br><br>
<strong>{{yandex_exclude}}{{SUDOKU}} Saldo</strong> - saldo atual de moedas sem bónus. As moedas são deduzidas / creditadas de acordo com os resultados do jogo
<br><br>
Os cartões de conquistas, semelhantes a medalhas, são um indicador do seu sucesso. 
<br>Incluem o nome da conquista, o período (ano, dia, semana, mês), o número de pontos (classificação, comprimento da palavra, número de amigos) e o número de moedas 
<br><br>
O ganho passivo de moedas pára quando o teu recorde é batido por outro jogador
PT
            ,
        ],
        '[[Player]] opened [[number]] [[cell]]' => '[[Player]] abriu [[number]] [[cell]]',
        ' (including [[number]] [[key]])' => ' (incluindo [[number]] [[key]])',
        '[[Player]] made a mistake' => '[[Player]] cometeu um erro',
        'You made a mistake!' => 'Cometeste um erro!',
        'Your opponent made a mistake' => 'O seu adversário cometeu um erro',
        '[[Player]] gets [[number]] [[point]]' => '[[Player]] recebe [[number]] [[point]].',
        '[[number]] [[point]]' => '[[number]] [[point]]',
        'You got [[number]] [[point]]' => 'Tem [[number]] [[point]].',
        'Your opponent got [[number]] [[point]]' => 'O seu adversário obteve [[number]] [[point]].',
    ];
}