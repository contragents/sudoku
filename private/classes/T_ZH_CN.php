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
            SudokuGame::GAME_NAME => '&#42;保存此密钥，以便在 <a href="https://t.me/sudoku_app_bot">Telegram</a> 中进一步恢复帐户',
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
        'Accounts are already linked' => '游戏未开始',
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
        'Result' => '结果',
        'Opponents' => '反对者',
        'Games<br>total' => '游戏/总计',
        'Wins<br>total' => '胜场/总胜场',
        'Gain/loss<br>in ranking' => '排名上升/下降',
        '% Wins' => '胜率百分比',
        'Games in total' => '游戏总数',
        'Winnings count' => '赢钱计数',
        'Increase/loss in rating' => '排名上升/下降',
        '% of wins' => '胜率百分比',
        "GAME points - Year Record!" => '游戏积分 - 年记录！',
        "GAME points - Month Record!" => '游戏积分 - 月份记录！',
        "GAME points - Week Record!" => '游戏积分 - 周记录！',
        "GAME points - Day Record!" => '游戏积分 - 日记录！',
        "TURN points - Year Record!" => '比赛回合积分 - 年记录！',
        "TURN points - Month Record!" => '比赛回合积分 - 月份记录！',
        "TURN points - Week Record!" => '比赛回合积分 - 周记录！',
        "TURN points - Day Record!" => '比赛回合积分 - 日记录！',
        "WORD points - Year Record!" => '字点 - 年记录！',
        "WORD points - Month Record!" => '字点 - 月份记录！',
        "WORD points - Week Record!" => '字点 - 周记录！',
        "WORD points - Day Record!" => '字点 - 日记录！',
        "Longest WORD - Year Record!" => '最长单词 - 周记录！',
        "Longest WORD - Month Record!" => '最长单词 - 月份记录！',
        "Longest WORD - Week Record!" => '最长单词 - 周记录！',
        "Longest WORD - Day Record!" => '最长单词 - 日记录！',
        "GAMES played - Year Record!" => '游戏次数 - 年记录！',
        "GAMES played - Month Record!" => '游戏次数 - 月份记录！',
        "GAMES played - Week Record!" => '游戏次数 - 周记录！',
        "GAMES played - Day Record!" => '游戏次数 - 日记录！',
        "Victory" => '胜利',
        'Losing' => '损失',
        "Go to player's stats" => '查看球员数据',
        'Filter by player' => '按玩家筛选',
        'Apply filter' => '应用过滤器',
        'against' => '反对',
        "File loading error!" => '文件加载错误！',
        "Check:" => '检查：',
        "file size (less than " => '文件大小（小于 ',
        "Incorrect URL format!" => 'URL 格式不正确！',
        "Must begin with " => '必须从 ',
        'Error! Choose image file with the size not more than' => '错误！选择大小不超过',
        'Avatar updated' => '头像已更新',
        "Error saving new URL" => '保存新 URL 时出错',
        'A player may open more than one cell and more than one KEY in one turn. Use the CASCADES rule'
        => '玩家可在一个回合内打开多个格子和多个钥匙。使用<strong>级联</strong>规则',
        'If after the automatic opening of a number, new blocks of EIGHT open cells are formed on the field, such blocks are also opened by CASCADE'
        => '如果在自动打开一个号码后，场上形成了新的八开小格组块，这些组块也将通过<strong>级联</strong>打开',
        'If a player has opened a cell (solved a number in it) and there is only ONE closed digit left in the block, this digit is opened automatically'
        => '如果玩家打开了一个单元格（在其中解出了一个数字），而区块中只剩下<strong>一个</strong>封闭数字，则该数字将自动打开',
        'is awarded for solved empty cell' => '因解决了空格而获奖',
        'by calculating all of other 8 digits in a block - vertically OR horizontally OR in a 3x3 square'
        => '计算一个数块中的所有其他 8 个数字 - 纵向或横向或 3x3 正方形中的所有数字',
        "The players' task is to take turns making moves and accumulating points to open black squares"
        => '玩家的任务是轮流走棋，积累点数，打开黑色方格',
        'The classic SUDOKU rules apply - in a block of nine cells (vertically, horizontally and in a 3x3 square) the numbers must not be repeated'
        => '<strong>适用经典数独规则</strong> - 在九个单元格（纵向、横向和 3x3 正方形）中，数字不得重复',
        'faq_rules' => [
            SudokuGame::GAME_NAME => <<<ZHCN
<h2 id="nav1">关于游戏</h2>

经典数独规则适用 - 在九个单元格（垂直、水平和 3x3 正方形）中，数字不得重复
<br><br>
玩家的任务是轮流走棋，通过计算一个方格中所有其他 8 位数字--纵向或横向或 3x3 方格中的所有其他 8 位数字--累积分数，打开黑色方格（<span style="color:#0f0">+10 分</span>）。
<br><br>
解决空格可得 <span style="color:#0f0">+1 分</span>
<br><br>
获得所有可能得分的 50%的玩家获胜 +1 分
<br><br>
如果玩家打开了一个单元格（在其中解出了一个数字），而该区块中只剩下一个封闭的数字，则该数字会自动打开
<br><br>
如果在自动打开一个数字后，场上又形成了新的 8 个开放单元格的区块，则这些区块也会通过 <strong>级联</strong>打开
<br><br>
玩家可以在一个回合中打开多个单元格和多个 <strong>钥匙</strong>。使用 <strong>级联</strong>规则
<br><br>
如果走错一步棋--单元格中的数字是错误的--这个单元格上会出现一个红色的小错误数字，双方都能看到。这个数字不能再出现在这个单元格中
<br><br>
玩家可以使用 “校验 ”按钮做标记--在单元格中填入一个绿色的小数字。这个数字可以是玩家确定的计算结果，也可以只是猜测。使用注释就像使用普通的 <strong>数独</strong>一样 - 其他玩家看不到它们
ZHCN
            ,
        ],
        'faq_rating' => <<<ZHCN
埃洛等级分
<br><br>
埃洛等级分制度，埃洛系数--一种计算棋手在比赛中相对实力的方法，
，在涉及两名棋手的比赛中（如国际象棋、国际跳棋或将棋、围棋）。
<br>
这个等级分系统是由出生于匈牙利的美国物理学教授阿帕德-埃洛（匈牙利语：Élő Árpád；1903-1992）
<br><br>
棋手之间的等级分差距越大，实力较强的棋手获胜时获得的等级分就越少。
<br>
相反，实力较弱的棋手如果击败实力较强的棋手，则会获得更多的等级分。
<br><br>
因此，与实力相当的棋手对弈更有利--如果你赢了，你会得到更多分数，如果你输了，你也不会失去很多分数。
<br><br>
新手与经验丰富的高手对战是安全的。
<br>
如果你输了，排名的损失会很小。
<br>
但是，如果赢了，大师会慷慨地分享等级分。
ZHCN
        ,
        'faq_rewards' => [
            SudokuGame::GAME_NAME => <<<ZHCN
球员的某些成就（记录）会得到奖励。
<br><br>
玩家获得的奖励会在 “STATS（统计）”部分以下列提名方式体现：金/银/铜/石。
<br><br>
收到奖励卡时，玩家将获得 SUDOKU 硬币奖励 {{sudoku_icon}} 。
<br>
硬币可以在特殊游戏模式 “ON 硬币 ”中使用，您可以补充游戏中的钱包，
，也可以从游戏中提取硬币--更多信息请参阅 “硬币游戏模式 ”选项卡
<br><br>
只要一个玩家的记录没有被其他玩家打破，奖励卡就会在 “统计 ”部分的 “活动奖励 ”选项卡中反映出该玩家的记录。
<br><br>
每个 “活动奖励 ”每小时都会产生额外的金币 “利润”。
<br><br>
如果某项记录已被其他玩家打破，则该记录前所有者的奖励卡将被移至 “PAST AWARDS（过去的奖励）”选项卡，并停止带来被动收入。
<br>
获得的金币总数（一次性奖励和额外利润）可分别在 “个人资料 ”部分的 “钱包 ”选项卡中的 “SUDOKU 硬币余额 ”和 “累积奖励 ”字段中查看。
<br><br>
当超过自己的 “已玩游戏 ”成就记录时，玩家不会再获得新的奖励卡或金币。
记录值本身（游戏次数/好友人数）会在奖励卡上更新。
<br><br>
例如，如果一名玩家之前因 10,000 场游戏而获得了成就--“玩过的派对”
 （金币），那么当该玩家的游戏场数变为 10,001 场时，将不会再向记录保持者发放奖励卡。
ZHCN
            ,
        ],
        'Reward' => '奖励',
        'faq_coins' => [
            SudokuGame::GAME_NAME => <<<ZHCN
硬币 <strong>SUDOKU</strong>{{sudoku_icon}}是一种游戏内货币{{yandex_exclude}}{{用于网络游戏 - <strong>拼字游戏、数独</strong>
<br><br>
一个账户对应所有游戏，一种货币，一个钱包}}。
<br><br>
{{yandex_exclude}}{{在加密世界中，该币也被称为 SUDOKU。不久之后，您就可以将任意数量的 SUDOKU 硬币从游戏内钱包提取到 TON（Telegram）网络的外部钱包
<br><br>}}
在此期间，我们可以通过选择 “硬币 ”模式在游戏中赢得尽可能多的硬币
<br><br>
该模式也会考虑并累积玩家排名。
<br>
不过，游戏结果赢得的金币现在会存入您的钱包（如果您输了，则会被扣除）
<br><br>
根据您钱包中的当前金币余额，您可以选择 1、5、10 等不同金额的游戏。硬币 - 从列表中选择所需的金额
<br><br>
按 “开始 ”按钮后，将开始搜索同样准备投注指定金额的对手
<br><br>
例如，您指定的投注额为 5 个硬币，而在开始新游戏的玩家中，只有人愿意投注 1 个硬币。
<br>
那么您和这样的玩家的赌注都将是 1 个金币--两个选项中较小的一个。
因此，玩三人和四人游戏在节省金币方面风险较小
<br><br>
如果所有输的玩家积分相同，那么赢的玩家会拿走所有赌注
<br><br>
在四人游戏中，如果第二和第三名玩家积分相同，他们会拿回赌注，保留他们的赌注
<br><br>
在所有情况下，新排名的计算方法与往常一样 - 参见 “排名 ”选项卡
<br><br>
该模式也会考虑并累积玩家排名。
<br>
不过，游戏结果赢得的金币现在会存入您的钱包（如果您输了，则会被扣除）
<br><br>
根据您钱包中的当前金币余额，您可以选择 1、5、10 等不同金额的游戏。硬币 - 从列表中选择所需的金额
<br><br>
按 “开始 ”按钮后，将开始搜索同样准备投注指定金额的对手
<br><br>
例如，您指定的投注额为 5 个硬币，而在开始新游戏的玩家中，只有人愿意投注 1 个硬币。
<br>
那么您和这样的玩家的赌注都将是 1 个金币--两个选项中较小的一个。
<br><br>
如果有人愿意为 10 个金币而战，您的赌注 - 5 将被选中，游戏将以 10 个金币的银行 - 5+5 开始
<br><br>
在二人游戏中，获胜者获得整个彩池 - 他的赌注和对手的赌注
<br><br>
在三人游戏中，获胜者获得他的赌注和最后一名玩家（积分最少的玩家）的赌注。
中间的玩家（亚军）拿回他的赌注，保留他的硬币
<br><br>
在四人游戏中，彩池由第一名和第四名的玩家（第一名玩家拿回两个赌注）、
、第二名和第三名的玩家（第二名玩家拿回两个赌注）平分。
<br><br>
因此，从节省金币的角度来看，玩三人和四人游戏的风险更小。
<br><br>
如果所有输钱的玩家积分相同，那么赢钱的玩家将收回所有赌注
<br><br>
在四人游戏中，如果第二和第三名玩家积分相同，那么他们将收回赌注，并保留他们的赌注
<br><br>
在所有情况下，新排名的计算方法与往常一样 - 请参见 “排名 ”选项卡
<br><br>
<h2>如何补充您的钱包</h2>
<ol>
<li>
每个新玩家都会收到欢迎{{stone_reward}}。{{yandex_exclude}}{{SUDOKU}}币到他的余额中，并可以立即参与到大赢家的角逐中
</li>
<li>
每一位使用您的推荐链接进入游戏的朋友都会收到{{stone_reward}}币。
此外，如果您创下（当日、当周、当月、当年）邀请人数的记录，您也将获得奖励。要邀请用户，您需要通过 Telegram 登录游戏。
</li>
<li>
在游戏中取得的成绩（每局得分、每步得分、每字得分、游戏次数、邀请人数、排名第 1 到第 10 位）可获得金币奖励。
</li>
<li>
每玩游戏 100 局，{{stone_reward}} {{yandex_exclude}}{{SUDOKU }} 会获得金币
</li>
{{yandex_exclude}}{{<li>
通过转账将金币换成卢布
</li>
<li>将金币换成加密货币（即将推出）
</li>}}
</ol> </p
<br>
每项成就所奖励的金币数量可能会随着时间的推移而发生变化，或增或减。实际奖励反映在成就卡中。
<br><br>
<h2>您可以用赢得的金币做什么</h2>
<ol>
<li>
玩我们的游戏，增加赌注，为您喜爱的消遣活动增添刺激和趣味
</li>
{{yandex_exclude}}{{<li>
将金币出售为卢布或加密货币（即将推出），并以真钱形式获得奖励
</li>}}
{{yandex_exclude}}{{<li>
向其他玩家赠送礼物，从您的钱包中向后者发送任意数量的金币（即将推出）
</li>}}   
</ol>
<br>
您可以在 “个人资料 ”菜单的 “钱包 ”选项卡中查看钱包余额详情。
<br><br>
<strong>累积奖金</strong>--根据玩家的成就（菜单 “统计”，“奖励 ”部分），每小时累积的被动收入的结果。
<br>奖金可通过按 “领取 ”按钮转入余额
<br><br>
<strong>{{yandex_exclude}}{{SUDOKU}} coin balance</strong> - current balance of coins without bonuses. 金币将根据游戏结果从中扣除或存入
<br><br>
类似奖牌的成就卡是您成功的标志。
<br>它们包括成就名称、时间（年、日、周、月）、点数（等级、单词长度、好友数量）和金币数量
<br><br>
当您的记录被其他玩家打破时，被动金币收入将停止。
ZHCN
            ,
        ],
        '[[Player]] opened [[number]] [[cell]]' => '[[Player]] 打开 [[number]] [[cell]]',
        ' (including [[number]] [[key]])' => ' (包括 [[number]] [[key]])',
        '[[Player]] made a mistake' => '[[Player]] 犯了一个错误',
        'You made a mistake!' => '你犯了一个错误！',
        'Your opponent made a mistake' => '你的对手犯了一个错误',
        '[[Player]] gets [[number]] [[point]]' => '[[Player]] 获得 [[number]] [[point]]',
        '[[number]] [[point]]' => '[[number]] [[point]]',
        'You got [[number]] [[point]]' => '你有 [[number]] [[point]]',
        'Your opponent got [[number]] [[point]]' => '你的对手得到 [[number]] [[point]]',
    ];
}