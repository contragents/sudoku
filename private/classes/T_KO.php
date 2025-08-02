<?php

namespace classes;


use PaymentModel;
use UserModel;

class T_KO
{
    const PHRASES = [
        'Invalid URL format! <br />It must begin with <strong>http(s)://</strong>' => '잘못된 URL 형식입니다!<br><strong>http(s)://</strong>로 시작해야 합니다.',
        '</strong> or <strong>' => '</strong> 또는 <strong>',
        'MB</strong>)</li><li>extension -<strong>' => 'MB</strong>)</li><li>파일 확장자 -<strong>',
        '<strong>File upload error!</strong><br /> Please review:<br /> <ul><li>file size (no more than <strong>'
        => '<strong>파일 업로드 오류가 발생했습니다!</strong><br /> 검토해 주세요:<br /> <ul><li> 파일 크기가 미만 <strong>',
        'Error creating new payment' => '새 결제 생성 오류',
        'FAQ' => '자주 묻는 질문',
        'Agreement' => '동의',
        'Empty value is forbidden' => '빈 값은 금지됩니다.',
        'Forbidden' => '금지됨',
        'game_title' => [
            SudokuGame::GAME_NAME => '친구와 함께하는 온라인 스도쿠',
        ],
        'secret_prompt' => [
            SudokuGame::GAME_NAME => '&#42;<a href="https://t.me/sudoku_app_bot">텔레그램</a>에서 추가 계정 복원을 위해 이 키를 저장하세요.',
        ],
        'COIN Balance' => '코인 계정 잔액',
        PaymentModel::INIT_STATUS => '시작됨',
        PaymentModel::BAD_CONFIRM_STATUS => '잘못된 확인',
        PaymentModel::COMPLETE_STATUS => '완료',
        PaymentModel::FAIL_STATUS => '실패',
        'Last transactions' => '마지막 거래',
        'Support in Telegram' => '텔레그램 내 지원',
        'Check_price' => '가격 확인',
        'Replenish' => '보충',
        'SUDOKU_amount' => '코인 수량',
        'enter_amount' => '금액',
        'Buy_SUDOKU' => 'SUDOKU 코인 구매',
        'The_price' => '가격 제안',
        'calc_price' => '가격',
        'Pay' => '지불',
        'Congratulations to Player' => '님, 축하드립니다플레이어',
        'Server sync lost' => '서버 동기화 실패',
        'Server connecting error. Please try again' => '서버 연결 오류가 발생했습니다. 다시 시도해 주시기 바랍니다.',
        'Error changing settings. Try again later' => '설정 변경 중 오류가 발생했습니다. 나중에 다시 시도해 주세요.',
        'invite_friend_prompt' => [
            SudokuGame::GAME_NAME => '텔레그램에서 온라인 게임 수독에 참여하세요! 최고 점수를 획득하고 코인을 획득한 후 토큰을 지갑으로 인출하세요.',
        ],
        'game_bot_url' => [
            SudokuGame::GAME_NAME => 'https://t.me/sudoku_app_bot',
        ],
        'loading_text' => [SudokuGame::GAME_NAME => '수독이 로딩 중입니다...'],
        'switch_tg_button' => '텔레그램으로 전환하세요',
        'Invite a friend' => '친구 초대하기',
        'you_lost' => '당신은 졌습니다!',
        'you_won' => '당첨되셨습니다!',
        '[[Player]] won!' => '[[Player]]이 승리했습니다!',
        'start_new_game' => '새 게임을 시작하세요',
        'rating_changed' => '등급 변경: ',
        'Authorization error' => '권한 오류',
        'Error sending message' => '메시지 전송 오류',
        // Рекорды
        'Got reward' => '보상을 받았습니다.',
        'Your passive income' => '귀하의 수동 소득',
        'will go to the winner' => '은 우승자에게 돌아갈 것입니다.',
        'Effect lasts until beaten' => '효과가 지속되는 동안',
        'per_hour' => '시간',
        'rank position' => '순위 위치',
        'record of the year' => '올해의 기록',
        'record of the month' => '월간 기록',
        'record of the week' => '이번 주의 기록',
        'record of the day' => '오늘의 기록',
        'game_price' => '게임 점수',
        'games_played' => '경기 수',
        'Games Played' => '경기 수',
        'top' => '상단',
        'turn_price' => '게임 라운드 포인트',
        'word_len' => '단어 길이',
        'word_price' => '단어 점수',
        UserModel::BALANCE_HIDDEN_FIELD => '사용자 숨김',
        'top_year' => '상위 1위',
        'top_month' => '상위 2위',
        'top_week' => '상위 3위',
        'top_day' => '상위 10위권',
        // Рекорды конец
        'Return to fullscreen mode?' => '전체 화면 모드로 돌아가시겠습니까?',
        // Профиль игрока
        'Choose file' => '파일 선택',
        'Back' => '뒤로',
        'Wallet' => '지갑',
        'Referrals' => '추천',
        'Player ID' => '플레이어 ID',
        // complaints
        'Player is unbanned' => '플레이어가 차단 해제되었습니다.',
        'Player`s ban not found' => '플레이어의 차단 기록이 발견되지 않았습니다.',
        'Player not found' => '플레이어가 발견되지 않았습니다.',
        // end complaints
        'Save' => '저장',
        'new nickname' => '새로운 별명',
        'Input new nickname' => '새 별명을 입력하세요.',
        'Your rank' => '귀하의 등급',
        'Ranking number' => '순위 번호',
        'Balance' => '계좌 잔고',
        'Rating by coins' => '코인으로 평가하기',
        'Secret key' => '비밀 키',
        'Link' => '묶다',
        'Bonuses accrued' => '적립된 보너스',
        'SUDOKU Balance' => 'SUDOKU 코인 잔액',
        'Claim' => '청구',
        'Name' => '이름',
        // Профиль игрока конец
        'Nickname updated' => '별명 업데이트되었습니다',
        'Stats getting error' => '통계에서 오류가 발생했습니다.',
        'Error saving Nick change' => '닉네임 변경 저장 오류',
        'Play at least one game to view statistics' => '최소 한 번의 게임을 플레이해야 통계 정보를 확인할 수 있습니다.',
        'Lost server synchronization' => '서버 동기화 실패',
        'Closed game window' => '게임 창 닫기',
        'You closed the game window and became inactive!' => '게임 창을 닫고 활동이 중단되었습니다!',
        'Request denied. Game is still ongoing' => '요청이 거부되었습니다. 게임은 여전히 진행 중입니다.',
        'Request rejected' => '요청이 거부되었습니다.',
        'No messages yet' => '아직 메시지가 없습니다.',
        'New game request sent' => '새로운 게임 요청이 전송되었습니다.',
        'Your new game request awaits players response' => '새로운 게임 요청이 플레이어들의 응답을 기다리고 있습니다.',
        'Request was aproved! Starting new game' => '요청이 승인되었습니다! 새로운 게임을 시작합니다.',
        'Default avatar is used' => '기본 아바타가 사용됩니다.',
        'Avatar by provided link' => '제공된 링크를 통해 아바타',
        'Set' => '설정하다',
        'Avatar loading' => '아바타 로딩 중',
        'Send' => '보내기',
        'Avatar URL' => '아바타 URL',
        'Apply' => '신청하세요',
        'Account key' => '계정 키',
        'Main account key' => '주 계정 키',
        'old account saved key' => '기존 계정에 저장된 키',
        'Key transcription error' => '핵심 전사 오류',
        "Player's ID NOT found by key" => '플레이어의 ID가 키로 검색되지 않았습니다.',
        'Accounts linked' => '연결된 계정',
        'Accounts are already linked' => '계정이 이미 연결되었습니다.',
        'Game is not started' => '게임이 시작되지 않았습니다.',
        'OK' => '좋아요',
        'Click to expand the image' => '이미지를 클릭하여 확대하세요.',
        'Report sent' => '보고서 발송됨',
        'Report declined! Please choose a player from the list' => '보고서가 거부되었습니다! 목록에서 플레이어를 선택해 주세요.',
        'Your report accepted and will be processed by moderator' => '귀하의 보고서가 승인되었으며, 모더레이터에 의해 처리될 것입니다.',
        'If confirmed, the player will be banned' => '확인이 되면 해당 선수는 출전 금지 조치를 받게 됩니다.',
        'Report declined!' => '보고서가 거부되었습니다!',
        'Only one complaint per each player per day can be sent. Total 24 hours complaints limit is'
        => '각 플레이어당 하루에 한 건의 불만만 제출할 수 있습니다. 총 24시간 불만 제출 한도: ',
        'From player' => '발신자 플레이어',
        'To Player' => '수신자 플레이어',
        'Awaiting invited players' => '초청된 플레이어를 기다리고 있습니다.',
        'Searching for players' => '플레이어 검색',
        'Searching for players with selected rank' => '선택한 등급의 플레이어를 검색 중입니다.',
        'Message NOT sent - BAN until ' => '메시지 전송 실패 - 차단 기간: ',
        'Message NOT sent - BAN from Player' => '메시지 전송 실패 - 차단됨: 플레이어',
        'Message sent' => '메시지가 전송되었습니다.',
        'Exit' => '그만두다',
        'Appeal' => '항소',
        'There are no events yet' => '현재까지 이벤트가 없습니다.',
        'Playing to' => '~에 맞춰 연주하다',
        'Just two players' => '단 두 명의 선수',
        'Up to four players' => '최대 4명의 플레이어',
        'Game selection - please wait' => '게임 선택 - 잠시만 기다려 주세요',
        'Your turn!' => '이제 당신의 차례입니다!',
        'Looking for a new game...' => '새로운 게임을 찾고 있어요',
        'Get ready - your turn is next!' => '준비하세요 - 다음은 당신의 차례입니다!',
        'Take a break - your move in one' => '잠시 쉬어보세요 - 당신의 차례입니다.',
        'Refuse' => '거부하다',
        'Offer a game' => '게임을 제공하세요',
        'Players ready:' => '선수들 준비 완료:',
        'Players' => '선수들',
        'Try sending again' => '다시 한 번 보내보시기 바랍니다.',
        'Error connecting to server!' => '서버에 연결하는 데 오류가 발생했습니다!',
        'You haven`t composed a single word!' => '당신은 단 한 글자도 쓰지 않았습니다!',
        'You will lose if you quit the game! CONTINUE?' => '게임을 그만두면 패배합니다! 계속하시겠습니까?',
        'Cancel' => '취소',
        'Confirm' => '확인',
        'Revenge!' => '복수!',
        'Time elapsed:' => '경과 시간:',
        'Time limit:' => '시간 제한:',
        'You can start a new game if you wait for a long time' => '오랫동안 기다리면 새로운 게임을 시작할 수 있습니다.',
        'Close in 5 seconds' => '5초 후 닫힙니다.',
        'Close immediately' => '즉시 닫기',
        'Will close automatically' => '자동으로 닫힐 것입니다.',
        's' => '초',
        'Average waiting time:' => '평균 대기 시간:',
        'Waiting for other players' => '다른 플레이어를 기다리고 있습니다.',
        'Game goal' => '게임 목표',
        'Rating of opponents' => '상대방 평가',
        'new player' => '신규 플레이어',
        'CHOOSE GAME OPTIONS' => '<strong>게임 옵션 선택</strong>',
        'Profile' => '프로필',
        'Error' => '오류',
        'Your profile' => '귀하의 프로필',
        'Start' => '시작',
        'Stats' => '통계',
        'Play on' => '에서 플레이하세요',
        // Чат
        'Error sending complaint<br><br>Choose opponent' => '불만 제출 오류<br><br>상대방을 선택하세요',
        'You' => '너',
        'to all: ' => '모든 분들께: ',
        ' (to all):' => ' (모든 분들께):',
        'For everyone' => '모두를 위해',
        'Word matching' => '단어 일치',
        'Player support and chat at' => '플레이어 지원 및 채팅',
        'Join group' => '그룹에 가입하세요',
        'Send an in-game message' => '게임 내 메시지를 보내세요.',
        // Чат
        'News' => '뉴스',
        // Окно статистика
        'Past Awards' => '과거 수상 내역',
        'Parties_Games' => '게임 경기 수',
        'Player`s achievements' => '플레이어의 성과',
        'Player Awards' => '선수들의 상',
        'Player' => '플레이어',
        'VS' => '대항',
        'Rating' => '등급',
        'Opponent' => '상대방',
        'Active Awards' => '액티브 어워드',
        'Remove filter' => '필터 제거',
        // Окно статистика конец

        "Opponent's rating" => '상대방의 등급',
        'Choose your MAX bet' => '최대 베팅 금액을 선택하세요.',
        'Searching for players with corresponding bet' => '해당 베팅과 일치하는 플레이어를 검색 중입니다.',
        'Coins written off the balance sheet' => '재무제표에서 제외된 동전',
        'Number of coins on the line' => '라인에 있는 코인의 수',
        'gets a win' => '승리를 거두다',
        'The bank of' => '은행',
        'goes to you' => '당신에게 갑니다',
        'is taken by the opponent' => '상대방에게 빼앗기다',
        'Bid' => '입찰',
        'No coins' => '동전 없음',
        'Any' => '어떤',
        'online' => '온라인',
        'Above' => '위',
        'minutes' => '분',
        'minute' => '분',
        'Select the minimum opponent rating' => '최소 상대 등급을 선택하세요.',
        'Not enough 1900+ rated players online' => '온라인에 1900점 이상 등급의 플레이어가 충분하지 않습니다.',
        'Only for players rated 1800+' => '1800점 이상 등급의 플레이어 전용',
        'in game' => '게임 내',
        'score' => '점수',
        'Your current rank' => '현재 등급',
        'Server syncing..' => '서버 동기화 중',
        ' is making a turn.' => '가 턴을 진행 중입니다.',
        'Your turn is next - get ready!' => '다음은 당신의 게임 차례입니다 - 준비하세요!',
        'switches pieces and skips turn' => '은 조각을 교환하고 차례를 건너뜁니다.',
        "Game still hasn't started!" => '게임이 아직 시작되지 않았습니다!',
        "Word wasn't found" => '단어가 발견되지 않았습니다.',
        'Correct' => '정확합니다.',
        'One-letter word' => '한 글자 단어',
        'Repeat' => '반복',
        'costs' => '비용이 듭니다',
        '+15 for all pieces used' => '사용된 모든 부품에 대해 +15',
        'TOTAL' => '총계',
        'You did not make any word' => '당신은 어떤 말도 하지 않았습니다.',
        'is attempting to make a turn out of his turn (turn #' => '은 자신의 턴이 아닌 턴에서 턴을 시도하고 있습니다 (턴 #',
        'Data processing error!' => '데이터 처리 오류!',
        ' - turn processing error (turn #' => '턴 처리 오류 (턴 #',
        "didn't make any word (turn #" => '은 어떤 단어라도 만들지 않았습니다 (턴 #',
        'set word lenght record for' => '이 단어 길이 기록을 세웠습니다',
        'set word cost record for' => '이 단어 비용 기록을 세웠습니다',
        'set record for turn cost for' => '이 턴 비용 기록을 세웠습니다',
        'gets' => '이 받습니다',
        'for turn #' => '회전 #',
        'For all pieces' => '모든 부품에 대해',
        'Wins with score ' => '이 점수로 승리합니다 ',
        'set record for gotten points in the game for' => '이 게임에서 획득한 점수 기록을 세웠습니다',
        'out of chips - end of game!' => '이 칩을 모두 잃었습니다 - 게임 종료!',
        'set record for number of games played for' => '이 플레이한 게임 수에서 기록을 세웠습니다',
        'is the only one left in the game - Victory!' => '플레이어1이 게임에 남은 유일한 플레이어입니다 - 승리',
        'left game' => '이 게임을 떠났습니다',
        'has left the game' => '이 게임을 떠났습니다',
        'is the only one left in the game! Start a new game' => '이 게임에 남은 유일한 플레이어입니다! 새로운 게임을 시작하세요',
        'Time for the turn ran out' => '게임 라운드 시간이 다 되었습니다.',
        "is left without any pieces! Winner - " => '은 모든 조각을 잃었습니다! 승자 - ',
        ' with score ' => ' 점수와 함께 ',
        "is left without any pieces! You won with score " => '은 모든 피스를 잃었습니다! 점수로 승리했습니다: ',
        "gave up! Winner - " => '이 포기했습니다! 승자 - ',
        'skipped 3 turns! Winner - ' => '이 3턴을 건너뛰었습니다! 승자 - ',
        'New game has started!' => '새로운 게임이 시작되었습니다!',
        'New game' => '신규 게임',
        'Accept invitation' => '초대 수락',
        'Get' => '나코피',
        'score points' => '점수를 획득하다',
        "Asking for adversaries' approval." => '적들의 승인을 요청하는 것',
        'Remaining in the game:' => '게임에 남아 있는 것:',
        "You got invited for a rematch! - Accept?" => '재대결에 초대받았어요! - 수락할까요?',
        'All players have left the game' => '모든 플레이어가 게임을 떠났습니다.',
        "Your score" => '귀하의 점수',
        'Turn time' => '게임 라운드 시간',
        'Date' => '날짜',
        'Price' => '가격',
        'Status' => '상태',
        'Type' => '종류',
        'Period' => '기간',
        'Word' => '단어',
        'Points/letters' => '점수/문자',
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
如果在一個數字被自動打開之後，場上又形成了新的八個打開格子的區塊，這些區塊也會被CASCADE打開
<br><br>
玩家可以在一個回合內打開超過一個格子和超過一個KEY。使用CASCADES規則
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