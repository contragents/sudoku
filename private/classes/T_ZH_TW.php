<?php

namespace classes;


use PaymentModel;
use UserModel;

class T_ZH_TW
{
    const PHRASES = [
        'Invalid URL format! <br />It must begin with <strong>http(s)://</strong>' => 'URL 格式無效！<br>它必須以 <strong>http(s)://</strong> 開頭。',
        '</strong> or <strong>' => '</strong> 或 <strong>',
        'MB</strong>)</li><li>extension -<strong>' => 'MB</strong>)</li><li>延伸 -<strong>',
        '<strong>File upload error!</strong><br /> Please review:<br /> <ul><li>file size (no more than <strong>'
        => '<strong>檔案上傳錯誤！</strong><br /> 請重新檢閱：<br /> <ul><li> 檔案大小 (不超過 <strong>',
        'Error creating new payment' => '建立新付款出錯',
        'FAQ' => '常見問題',
        'Agreement' => '協議',
        'Empty value is forbidden' => '禁止使用空值',
        'Forbidden' => '禁止',
        'game_title' => [
            SudokuGame::GAME_NAME => '與朋友線上數獨',
        ],
        'secret_prompt' => [
            SudokuGame::GAME_NAME => '&#42;保存此密鑰，以便在 <a href="https://t.me/sudoku_app_bot">Telegram</a> 中進一步還原帳戶',
        ],
        'COIN Balance' => '硬幣帳戶餘額',
        PaymentModel::INIT_STATUS => '開始',
        PaymentModel::BAD_CONFIRM_STATUS => '不良確認',
        PaymentModel::COMPLETE_STATUS => '已完成',
        PaymentModel::FAIL_STATUS => '失敗',
        'Last transactions' => '最後交易',
        'Support in Telegram' => '在 Telegram 中提供支援',
        'Check_price' => '檢查價格',
        'Replenish' => '補充',
        'SUDOKU_amount' => '硬幣數量',
        'enter_amount' => '數量',
        'Buy_SUDOKU' => '購買 SUDOKU 硬幣',
        'The_price' => '價格優惠',
        'calc_price' => '價格',
        'Pay' => '薪資',
        'Congratulations to Player' => '恭喜玩家',
        'Server sync lost' => '伺服器同步遺失',
        'Server connecting error. Please try again' => '伺服器連線錯誤。請重試',
        'Error changing settings. Try again later' => '變更設定出錯。稍後再試',
        'invite_friend_prompt' => [
            SudokuGame::GAME_NAME => '加入 Telegram 上的線上遊戲 SUDOKU！獲得最高評分、賺取硬幣並將代幣存入您的錢包',
        ],
        'game_bot_url' => [
            SudokuGame::GAME_NAME => 'https://t.me/sudoku_app_bot',
        ],
        'loading_text' => [SudokuGame::GAME_NAME => '數獨正在載入中...'],
        'switch_tg_button' => '切換至 Telegram',
        'Invite a friend' => '邀請朋友',
        'you_lost' => '你輸了',
        'you_won' => '你贏了',
        '[[Player]] won!' => '[[Player]] 贏了',
        'start_new_game' => '開始新遊戲',
        'rating_changed' => '評等變更：',
        'Authorization error' => '授權錯誤',
        'Error sending message' => '錯誤傳送訊息',
        // Рекорды
        'Got reward' => '獲得獎勵',
        'Your passive income' => '您的被動收入',
        'will go to the winner' => '- 優勝者將獲得',
        'Effect lasts until beaten' => '效果持續到打敗為止',
        'per_hour' => '小時',
        'rank position' => '職級',
        'record of the year' => '年度最佳記錄',
        'record of the month' => '本月記錄',
        'record of the week' => '本週紀錄',
        'record of the day' => '當日記錄',
        'game_price' => '遊戲得分',
        'games_played' => '玩過的遊戲',
        'Games Played' => '玩過的遊戲',
        'top' => '最頂層',
        'turn_price' => '遊戲回合點數',
        'word_len' => '單詞長度',
        'word_price' => '字點',
        UserModel::BALANCE_HIDDEN_FIELD => '隱藏使用者',
        'top_year' => '第一等級位置',
        'top_month' => '第二級別位置',
        'top_week' => '第三級別位置',
        'top_day' => '前十名中',
        // Рекорды конец
        'Return to fullscreen mode?' => '返回全螢幕模式？',
        // Профиль игрока
        'Choose file' => '選擇檔案',
        'Back' => '返回',
        'Wallet' => '錢包',
        'Referrals' => '推薦',
        'Player ID' => '玩家編號',
        // complaints
        'Player is unbanned' => '玩家已解除封禁',
        'Player`s ban not found' => '找不到玩家的禁令',
        'Player not found' => '未找到播放器',
        // end complaints
        'Save' => '節省',
        'new nickname' => '新暱稱',
        'Input new nickname' => '輸入新暱稱',
        'Your rank' => '您的等級',
        'Ranking number' => '排名編號',
        'Balance' => '帳戶結餘',
        'Rating by coins' => '硬幣評分',
        'Secret key' => '秘密鑰匙',
        'Link' => '連結帳戶',
        'Bonuses accrued' => '累計獎金',
        'SUDOKU Balance' => 'SUDOKU 硬幣金額',
        'Claim' => '索賠',
        'Name' => '名稱',
        // Профиль игрока конец
        'Nickname updated' => '暱稱更新',
        'Stats getting error' => '統計資料產生錯誤',
        'Error saving Nick change' => '儲存暱稱變更時發生錯誤',
        'Play at least one game to view statistics' => '至少玩一場遊戲才能檢視統計資料',
        'Lost server synchronization' => '伺服器同步遺失',
        'Closed game window' => '關閉遊戲視窗',
        'You closed the game window and became inactive!' => '您關閉了遊戲視窗，變得不活躍！',
        'Request denied. Game is still ongoing' => '請求被拒絕。遊戲仍在進行中',
        'Request rejected' => '拒絕請求',
        'No messages yet' => '尚無訊息',
        'New game request sent' => '發送新遊戲請求',
        'Your new game request awaits players response' => '您的新遊戲請求等待玩家回應',
        'Request was aproved! Starting new game' => '請求已被批准！開始新遊戲',
        'Default avatar is used' => '使用預設頭像',
        'Avatar by provided link' => '提供連結的頭像',
        'Set' => '設定新值',
        'Avatar loading' => '頭像載入',
        'Send' => '發送',
        'Avatar URL' => '頭像網址',
        'Apply' => '申請',
        'Account key' => '帳戶鑰匙',
        'Main account key' => '主帳戶密碼',
        'old account saved key' => '舊帳號儲存金鑰',
        'Key transcription error' => '按鍵轉錄錯誤',
        "Player's ID NOT found by key" => '按鍵未找到玩家的 ID',
        'Accounts linked' => '連結的帳戶',
        'Accounts are already linked' => '帳戶已連結',
        'Game is not started' => '遊戲未開始',
        'OK' => '確定',
        'Click to expand the image' => '按一下以展開圖片',
        'Report sent' => '發送報告',
        'Report declined! Please choose a player from the list' => '報告被拒絕！請從清單中選擇一位玩家',
        'Your report accepted and will be processed by moderator' => '您的報告已被接受，並將由版主處理',
        'If confirmed, the player will be banned' => '如果證實，該玩家將被封禁',
        'Report declined!' => '拒絕報告！',
        'Only one complaint per each player per day can be sent. Total 24 hours complaints limit is'
        => '每位玩家每天只能發送一次投訴。24 小時總投訴限額為 ',
        'From player' => '來自玩家',
        'To Player' => '給玩家',
        'Awaiting invited players' => '等待受邀玩家',
        'Searching for players' => '搜尋玩家',
        'Searching for players with selected rank' => '搜尋選定等級的玩家',
        'Message NOT sent - BAN until ' => '未傳送訊息 - 封鎖直到 ',
        'Message NOT sent - BAN from Player' => '未傳送訊息 - 封鎖玩家',
        'Message sent' => '已傳送訊息',
        'Exit' => '辭職',
        'Appeal' => '上訴',
        'There are no events yet' => '目前尚未有任何活動',
        'Playing to' => '播放至',
        'Just two players' => '只有兩位球員',
        'Up to four players' => '最多四位玩家',
        'Game selection - please wait' => '游戏选择 - 请稍候',
        'Your turn!' => '該你上場了',
        'Looking for a new game...' => '尋找新遊戲',
        'Get ready - your turn is next!' => '準備好 - 下一個輪到您玩遊戲！',
        'Take a break - your move in one' => '休息一下 - 您的一舉一動',
        'Refuse' => '廢棄物',
        'Offer a game' => '提供遊戲',
        'Players ready:' => '玩家準備好了',
        'Players' => '球員',
        'Try sending again' => '嘗試再次傳送',
        'Error connecting to server!' => '連接伺服器出錯',
        'You haven`t composed a single word!' => '你一個字也沒寫',
        'You will lose if you quit the game! CONTINUE?' => '如果您退出遊戲，您將輸掉！繼續？',
        'Cancel' => '取消',
        'Confirm' => '確認',
        'Revenge!' => '復仇',
        'Time elapsed:' => '時間經過',
        'Time limit:' => '時間限制',
        'You can start a new game if you wait for a long time' => '如果等待很長時間，您可以開始新遊戲',
        'Close in 5 seconds' => '5 秒內關閉',
        'Close immediately' => '立即關閉',
        'Will close automatically' => '會自動關閉',
        's' => ' 秒',
        'Average waiting time:' => '平均等候時間',
        'Waiting for other players' => '等待其他玩家',
        'Game goal' => '遊戲目標',
        'Rating of opponents' => '對手評分',
        'new player' => '新玩家',
        'CHOOSE GAME OPTIONS' => '<strong>選擇遊戲選項</strong>',
        'Profile' => '簡介',
        'Error' => '錯誤',
        'Your profile' => '您的個人資料',
        'Start' => '開始',
        'Stats' => '統計資料',
        'Play on' => '上播放',
        // Чат
        'Error sending complaint<br><br>Choose opponent' => '傳送投訴出錯<br><br>選擇對手',
        'You' => '你',
        'to all: ' => '給所有人 ',
        ' (to all):' => ' (對所有人)：',
        'For everyone' => '为每个人',
        'Word matching' => '詞彙匹配',
        'Player support and chat at' => '玩家支援與',
        'Join group' => '加入群組',
        'Send an in-game message' => '傳送遊戲內的訊息',
        // Чат
        'News' => '新聞',
        // Окно статистика
        'Past Awards' => '過往獎項',
        'Parties_Games' => '玩過的遊戲比賽',
        'Player`s achievements' => '玩家的成就',
        'Player Awards' => '玩家獎項',
        'Player' => '玩家',
        'VS' => '反',
        'Rating' => '評價',
        'Opponent' => '對手',
        'Active Awards' => '活躍獎項',
        'Remove filter' => '移除篩選器',
        // Окно статистика конец

        "Opponent's rating" => '對手評分',
        'Choose your MAX bet' => '選擇您的最大投注額',
        'Searching for players with corresponding bet' => '搜尋有對應投注的玩家',
        'Coins written off the balance sheet' => '從資產負債表中撇銷的硬幣',
        'Number of coins on the line' => '線上硬幣數量',
        'gets a win' => '取得勝利',
        'The bank of' => '銀行',
        'goes to you' => '銀行',
        'is taken by the opponent' => '被對手拿下',
        'Bid' => '出價',
        'No coins' => '無硬幣',
        'Any' => '任何',
        'online' => '線上',
        'Above' => '以上',
        'minutes' => '分鐘',
        'minute' => '分',
        'Select the minimum opponent rating' => '選擇最低對手等級',
        'Not enough 1900+ rated players online' => '沒有足夠的 1900+ 評等線上玩家',
        'Only for players rated 1800+' => '僅適用於評等 1800+ 的玩家',
        'in game' => '在遊戲中',
        'score' => '得分',
        'Your current rank' => '您目前的等級',
        'Server syncing..' => '伺服器同步',
        ' is making a turn.' => ' 正在轉彎',
        'Your turn is next - get ready!' => '接下來輪到您上場 - 做好準備！',
        'switches pieces and skips turn' => '切換棋子並跳過對局回合',
        "Game still hasn't started!" => '遊戲還沒開始',
        "Word wasn't found" => '找不到字',
        'Correct' => '正確',
        'One-letter word' => '單字詞',
        'Repeat' => '重複',
        'costs' => '成本',
        '+15 for all pieces used' => '所有使用的碎片 +15',
        'TOTAL' => '總計',
        'You did not make any word' => '您沒有說任何話',
        'is attempting to make a turn out of his turn (turn #' => '嘗試在他的回合（回合 #',
        'Data processing error!' => '資料處理錯誤',
        ' - turn processing error (turn #' => '轉彎處理錯誤（轉彎 #',
        "didn't make any word (turn #" => '沒有說任何話 (轉#',
        'set word lenght record for' => '創造的單字長度記錄為',
        'set word cost record for' => '創造的單字成本記錄為',
        'set record for turn cost for' => '創造的回合成本紀錄為',
        'gets' => '獲得',
        'for turn #' => '為轉彎 #',
        'For all pieces' => '適用於所有作品',
        'Wins with score ' => '贏得得分 ',
        'set record for gotten points in the game for' => '創下全場得分紀錄，為',
        'out of chips - end of game!' => '籌碼用完 - 遊戲結束！',
        'set record for number of games played for' => '創下了在一場比賽中打球次數最多的紀錄。',
        'is the only one left in the game - Victory!' => '是遊戲中唯一剩下的人 - 勝利！',
        'left game' => '離開遊戲',
        'has left the game' => '已離開遊戲',
        'is the only one left in the game! Start a new game' => '是遊戲中唯一剩下的人！開始新遊戲',
        'Time for the turn ran out' => '遊戲回合時間已過',
        "is left without any pieces! Winner - " => '沒有任何棋子！贏家 ',
        ' with score ' => ' 帶分數 ',
        "is left without any pieces! You won with score " => '沒有任何棋子！您以得分獲勝 ',
        "gave up! Winner - " => '放棄！贏家 ',
        'skipped 3 turns! Winner - ' => '跳過 3 個回合！贏家 ',
        'New game has started!' => '新遊戲已開始！',
        'New game' => '新遊戲',
        'Accept invitation' => '接受邀請',
        'Get' => '獲得',
        'score points' => '得分',
        "Asking for adversaries' approval." => '徵求對手的同意',
        'Remaining in the game:' => '餘下的遊戲：',
        "You got invited for a rematch! - Accept?" => '你被邀請重賽 - 接受嗎？',
        'All players have left the game' => '所有玩家都已離開遊戲',
        "Your score" => '您的遊戲得分',
        'Turn time' => '遊戲輪數時間',
        'Date' => '日期',
        'Price' => '價格',
        'Status' => '狀態',
        'Type' => '類型',
        'Period' => '期間',
        'Word' => '字詞',
        'Points/letters' => '分數/字母',
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
        'Reward' => 'Recompensa',
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