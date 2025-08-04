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
        'Result' => '結果',
        'Opponents' => '反對者',
        'Games<br>total' => '遊戲總計',
        'Wins<br>total' => '勝場總計',
        'Gain/loss<br>in ranking' => '排名增減',
        '% Wins' => '勝率百分比',
        'Games in total' => '遊戲總計',
        'Winnings count' => '贏錢計算',
        'Increase/loss in rating' => '評等增加/減少',
        '% of wins' => '胜率百分比',
        "GAME points - Year Record!" => '遊戲得分點 - 年份 記錄！',
        "GAME points - Month Record!" => '遊戲得分點 - 月記錄！',
        "GAME points - Week Record!" => '遊戲得分點 - 週記錄！',
        "GAME points - Day Record!" => '遊戲得分點 - 日記！',
        "TURN points - Year Record!" => '遊戲回合點數 - 年份 記錄！',
        "TURN points - Month Record!" => '遊戲回合點數 - 月記錄！',
        "TURN points - Week Record!" => '遊戲回合點數 - 週記錄！',
        "TURN points - Day Record!" => '遊戲回合點數 - 日記！',
        "WORD points - Year Record!" => '字元點數 - 年份 記錄！',
        "WORD points - Month Record!" => '字元點數 - 月記錄！',
        "WORD points - Week Record!" => '字元點數 - 週記錄！',
        "WORD points - Day Record!" => '字元點數 - 日記！',
        "Longest WORD - Year Record!" => '最長的字 - 年份 記錄！',
        "Longest WORD - Month Record!" => '最長的字 - 月記錄！',
        "Longest WORD - Week Record!" => '最長的字 - 週記錄！',
        "Longest WORD - Day Record!" => '最長的字 - 日記！',
        "GAMES played - Year Record!" => '玩過的遊戲方塊 - 年份 記錄！',
        "GAMES played - Month Record!" => '玩過的遊戲方塊 - 月記錄！',
        "GAMES played - Week Record!" => '玩過的遊戲方塊 - 週記錄！',
        "GAMES played - Day Record!" => '玩過的遊戲方塊 - 日記！',
        "Victory" => '勝利',
        'Losing' => '喪失',
        "Go to player's stats" => '前往玩家統計',
        'Filter by player' => '依玩家篩選',
        'Apply filter' => '套用篩選條件',
        'against' => '反',
        "File loading error!" => '檔案載入錯誤！',
        "Check:" => '檢查：',
        "file size (less than " => '檔案大小（小於 ',
        "Incorrect URL format!" => '網址格式不正確！',
        "Must begin with " => '必須從：',
        'Error! Choose image file with the size not more than' => '錯誤！選擇大小不超過的影像檔案：',
        'Avatar updated' => '頭像已更新',
        "Error saving new URL" => '儲存新 URL 出錯',
        'A player may open more than one cell and more than one KEY in one turn. Use the CASCADES rule'
        => '玩家可以在一回合內打開超過一個格子和超過一把<strong>鑰匙</strong>。使用<strong>層疊</strong>規則',
        'If after the automatic opening of a number, new blocks of EIGHT open cells are formed on the field, such blocks are also opened by CASCADE'
        => '如果在自動開完一個號碼後，欄位上形成了新的 8 個開放單元區塊，這些區塊也會以 <strong> 層疊方式</strong> 開啟',
        'If a player has opened a cell (solved a number in it) and there is only ONE closed digit left in the block, this digit is opened automatically'
        => '如果玩家打開了一個單元格（解出了其中的數字），而區塊中只剩下一個封閉的數字，則會自動打開這個數字。',
        'is awarded for solved empty cell' => '因解開空格而獲獎',
        'by calculating all of other 8 digits in a block - vertically OR horizontally OR in a 3x3 square'
        => '计算一个数块中的所有其他 8 个数字 - 纵向或横向或 3x3 正方形中的所有数字',
        "The players' task is to take turns making moves and accumulating points to open black squares"
        => '玩家的任務是輪流走棋並累積點數，以開啟黑色方塊，',
        'The classic SUDOKU rules apply - in a block of nine cells (vertically, horizontally and in a 3x3 square) the numbers must not be repeated'
        => '經典的數獨規則適用 - 在一組 9 個單元格（垂直、水平和 3x3 正方形）中，數字不得重複。',
        'faq_rules' => [
            SudokuGame::GAME_NAME => <<<ZHTW
<h2 id="nav1">關於遊戲</h2>
適用經典的 數獨 規則 - 在一個由 9 個小格組成的區塊中（縱向、橫向和 3x3 方塊中），數字不能重複出現
<br><br>
玩家的任務是輪流走棋，並累積分數開啟黑色方塊（<span style="color:#0f0">+10 分</span>），方法是計算方塊中所有其他 8 位數字 - 縱向或橫向或在 3x3 方塊中
<br><br>
解開空格會獲得 <span style"color:#0f0">+1 分</span>。
<br><br>
勝利歸於獲得所有可能分數50%的玩家 +1分
<br><br>
如果玩家打開了一個格子 (解出了其中的數字)，而區塊中只剩下一個封閉的數字、 這個數字會被自動打開
<br><br>
如果在一個數字被自動打開之後，場上又形成了新的八個打開格子的區塊，這些區塊也會被小瀑布打開 (CASCADE)
<br><br>
玩家可以在一個回合內打開超過一個格子和超過一個KEY。使用瀑布規則 (CASCADE 規則)
<br><br>
如果有錯誤的移動 - 格中的數字是錯誤的 - 一個小的紅色錯誤數字會出現在這個格上，這對雙方玩家都是可見的。這個數字不能再被放置在這個單元格上
<br><br>
使用檢查按鈕，玩家可以做一個記號 - 在單元格中放置一個小的綠色數字。這可以是玩家確定的計算數字，也可以只是猜測。與一般 SUDOKU 遊戲一樣使用筆記 - 其他玩家無法看到筆記。
ZHTW
            ,
        ],
        'faq_rating' => <<<ZHTW
Elo 評分
<br><br>
Elo 評分系統，Elo 系數 - 是一種計算棋手在對局中相對實力的方法，
，在涉及兩名棋手的對局中 (例如國際象棋、跳棋或將軍棋、圍棋)。
<br>
這個評分系統是由匈牙利出生的美國物理學教授 Arpad Elo (匈牙利語：Élő Árpád; 1903-1992) 發明的
<br><br>
棋手之間的評分差距越大，較強的棋手在勝出時得到的評分就越少。
<br>
相反地，較弱的棋手如果擊敗較強的棋手，會得到較多的評分。
<br><br>
因此，對於強手來說，與同等級的玩家對戰是比較有利的 - 如果您贏了，您會得到更多的分數，如果您輸了，您也不會失去非常多的分數。
<br><br>
初學者與經驗豐富的高手對戰是安全的。
<br>
如果您輸了，排名的損失會很小。
<br>
但是，在勝利的情況下，大師會慷慨地分享等級分數。
ZHTW
        ,
        'faq_rewards' => [
            SudokuGame::GAME_NAME => <<<ZHTW
玩家會因為某些成就（記錄）而獲得獎勵。
<br><br>
玩家的獎勵會以下列提名反映在「統計」部分：金/銀/銅/石。
<br><br>
收到獎勵卡時，玩家會獲得 SUDOKU 硬幣的獎勵 {{sudoku_icon}} 。
<br>
硬幣可以在特殊的硬幣遊戲模式中使用，您可以補充遊戲中的錢包，
以及從遊戲中提取硬幣 - 請在 「硬幣遊戲模式 」標籤中閱讀更多資訊
<br><br>
只要某位玩家的記錄未被其他玩家打破，該玩家的獎勵卡就會反映在「統計」部分的「活躍獎勵」標籤中。
<br><br>
每「活躍獎勵」每小時會產生額外的硬幣利潤。
<br><br>
如果某項記錄已被其他玩家打破，則該記錄之前擁有者的獎勵卡會被移至「過去的獎勵」標籤，並停止帶來被動收入。
<br><br>
獲得的硬幣總數（一次性獎金和額外利潤）可分別在錢包標籤的個人資料部分的 SUDOKU 硬幣餘額和累計獎金欄位中查看。
<br><br>
當超過自己的成就遊戲紀錄時，玩家不會再獲得新的獎勵卡或金幣。
記錄值本身（遊戲數量/好友數量）會在獎勵卡上更新。
<br><br>
舉例來說，如果某玩家先前以 10,000 場遊戲獲得成就 - 遊戲數
(金幣)，那麼當此玩家的遊戲數變為 10,001 場時，將不會再發行任何獎勵卡給該記錄保持者。
ZHTW
            ,
        ],
        'Reward' => '獎勵',
        'faq_coins' => [
            SudokuGame::GAME_NAME => <<<ZHTW
硬幣 <strong>SUDOKU</strong>{{sudoku_icon}}是一種遊戲中的貨幣{{yandex_exclude}}{{用於遊戲網路 - <strong>拼字遊戲、數獨遊戲</strong>
<br><br>
一個帳戶適用於所有遊戲，一種貨幣，一個錢包}}。
<br><br>
{{yandex_exclude}}{{在加密世界中，該錢幣也被稱為 SUDOKU。很快就可以從遊戲內的錢包中提取任意數量的 SUDOKU 硬幣到 TON (Telegram) 網絡中的外部錢包
<br><br>}}
與此同時，我們嘗試在遊戲中通過選擇 「硬幣 」模式贏取盡可能多的硬幣
<br><br>
此模式也會考慮並累加玩家排名。
<br>
然而，由遊戲結果贏得的硬幣現在會存入您的錢包中（如果您輸了，則會扣除）
<br><br>
根據您錢包中的硬幣當前餘額，您可以獲得 1、5、10 等硬幣的遊戲機會 - 從列表中選擇所需的金額
<br><br>
在按下 「開始 」按鈕後，搜尋同樣準備投注指定金額的對手將開始
<br><br>
例如，您指定您的投注額為 5 個硬幣，而在開始新遊戲的玩家中，只有那些願意投注 1 個硬幣的玩家。
<br>
那麼您和這位玩家的投注額都是 1 個硬幣 - 兩個選擇中較少的一個。
<br><br>
如果有人願意為 10 個硬幣而戰，您的賭注 - 5 將被選中，遊戲開始時將有 10 個硬幣的銀行 - 5+5
<br><br>
在二人遊戲中，贏家得到整個彩池 - 他的賭注和對手的賭注
<br><br>
在三人遊戲中，贏家拿回他的賭注和最後一個玩家（點數最少的玩家）的賭注。
中間的玩家（亞軍）拿回他的賭注，保留他的硬幣
<br><br>
在四人遊戲中，彩池由第一名和第四名的玩家瓜分（第一名的玩家拿回兩個賭注），
，第二名和第三名的玩家瓜分（第二名的玩家拿回兩個賭注）。
<br><br>
因此，在節省金幣方面，玩三人和四人遊戲變得風險較小
<br><br>
如果所有輸的玩家點數相同，則贏的玩家拿走所有賭注
<br><br>
在四人遊戲中，如果第二和第三名玩家點數相同，他們會拿回賭注，保留他們的賭注
<br><br>
在所有情況下，新排名的計算方法與往常一樣 - 請參閱 「排名 」標籤
<br><br>
<h2>如何補充您的錢包</h2>
<ol>
<li>
每位新玩家都會收到歡迎的 {{stone_reward}} 硬幣。{{yandex_exclude}}{{SUDOKU}} 硬幣到他的餘額中，並可以馬上參與爭奪大獎的比賽
</li>
<li>
每當有朋友使用您的推薦連結來玩遊戲，您就會收到 {{stone_reward}} 硬幣。
此外，只要創下（當天、當周、當月、當年）的邀請人數紀錄，您就能獲得獎勵。若要邀請使用者，您需要透過 Telegram 登入遊戲。
</li>
<li>
遊戲中的成就（每局得分、每步得分、每字得分、遊戲數量、受邀人數、排名第 1 至第 10 位）可獲得硬幣獎勵
</li>
<li>
每 100 局遊戲，{{stone_reward}} {{yandex_exclude}}{{SUDOKU }} 會獲得硬幣
</li>
{{yandex_exclude}}{{<li>
透過轉帳購買硬幣換取盧布
</li>
<li>購買硬幣換取加密貨幣 (即將推出)
</li>}}
</ol>
<br>
每項成就所獲得的硬幣數量可能會隨著時間的推移而改變，可能會增加，也可能會減少。實際獎勵會反映在成就卡上。
<br><br>
<h2>您可以用贏得的硬幣做什麼</h2>
<ol>
<li>
玩我們的遊戲，增加賭注，為您最喜愛的消遣增加刺激和興趣
</li>
{{yandex_exclude}}{{<li>
將硬幣兌成盧布或兌成加密貨幣（即將推出），以真錢獲得獎勵
</li>}}
{{yandex_exclude}}{{<li>
從您的錢包中發送任意數量的硬幣給其他玩家，作為禮物（即將推出）
</li>}}   
</ol>
<br>
您可以在「個人資料」功能表的「錢包」標籤中查看錢包餘額的詳細資訊。
<br><br>
<strong>累積獎金</strong> - 根據玩家的成就，每小時累積的被動收入的結果（菜單統計，獎勵部分）。
<br>紅利可以通過按領取按鈕轉移到餘額中
<br><br>
<strong>{{yandex_exclude}}{{SUDOKU}} 帳戶餘額</strong> - 不含獎金的當前硬幣餘額。硬幣會根據遊戲結果從中扣除/存入
<br><br>
類似獎牌的成就卡是您成功的標記。
<br>它們包括成就名稱、時間（年、日、週、月）、點數（評分、字長度、朋友數量）以及硬幣數量
<br><br>
當您的記錄被其他玩家打破時，被動硬幣賺取將會停止。
ZHTW
            ,
        ],
        '[[Player]] opened [[number]] [[cell]]' => '[[Player]] 開啟 [[number]] [[cell]]',
        ' (including [[number]] [[key]])' => ' (包括 [[number]] [[key]])',
        '[[Player]] made a mistake' => '[[Player]] 犯了一個錯誤',
        'You made a mistake!' => '你犯了一個錯誤',
        'Your opponent made a mistake' => '您的對手犯了一個錯誤',
        '[[Player]] gets [[number]] [[point]]' => '[[Player]] 獲得 [[number]]。[[point]]',
        '[[number]] [[point]]' => '[[number]] [[point]]',
        'You got [[number]] [[point]]' => '您有 [[number]] [[point]]',
        'Your opponent got [[number]] [[point]]' => '您的對手獲得 [[number]] [[point]]',
    ];
}