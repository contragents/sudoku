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
        'Result' => '결과',
        'Opponents' => '반대자들',
        'Games<br>total' => '총 경기 수',
        'Wins<br>total' => '승리 총계',
        'Gain/loss<br>in ranking' => '순위 상승/하락',
        '% Wins' => '승률 (%)',
        'Games in total' => '총 경기 수',
        'Winnings count' => '당첨금 집계',
        'Increase/loss in rating' => '등급 상승/하락',
        '% of wins' => '승리 비율',
        "GAME points - Year Record!" => '게임 포인트 - 연간 기록!',
        "GAME points - Month Record!" => '게임 포인트 - 월별 기록!',
        "GAME points - Week Record!" => '게임 포인트 - 주간 기록!',
        "GAME points - Day Record!" => '게임 포인트 - 일일 기록!',
        "TURN points - Year Record!" => '게임 라운드 포인트 - 연간 기록!',
        "TURN points - Month Record!" => '게임 라운드 포인트 - 월별 기록!',
        "TURN points - Week Record!" => '게임 라운드 포인트 - 주간 기록!',
        "TURN points - Day Record!" => '게임 라운드 포인트 - 일일 기록!',
        "WORD points - Year Record!" => '워드 포인트 - 연간 기록!',
        "WORD points - Month Record!" => '워드 포인트 - 월별 기록!',
        "WORD points - Week Record!" => '워드 포인트 - 주간 기록!',
        "WORD points - Day Record!" => '워드 포인트 - 일일 기록!',
        "Longest WORD - Year Record!" => '가장 긴 단어 - 연간 기록!',
        "Longest WORD - Month Record!" => '가장 긴 단어 - 월별 기록!',
        "Longest WORD - Week Record!" => '가장 긴 단어 - 주간 기록!',
        "Longest WORD - Day Record!" => '가장 긴 단어 - 일일 기록!',
        "GAMES played - Year Record!" => '게임 플레이 횟수 - 연간 기록!',
        "GAMES played - Month Record!" => '게임 플레이 횟수 - 월별 기록!',
        "GAMES played - Week Record!" => '게임 플레이 횟수 - 주간 기록!',
        "GAMES played - Day Record!" => '게임 플레이 횟수 - 일일 기록!',
        "Victory" => '승리',
        'Losing' => '패배',
        "Go to player's stats" => '플레이어의 통계로 이동',
        'Filter by player' => '플레이어로 필터링',
        'Apply filter' => '필터 적용',
        'against' => '반대',
        "File loading error!" => '파일 로딩 오류!',
        "Check:" => '확인:',
        "file size (less than " => '파일 크기 ( 미만 ',
        "Incorrect URL format!" => '잘못된 URL 형식!',
        "Must begin with " => '다음으로 시작해야 합니다',
        'Error! Choose image file with the size not more than' => '오류! 크기가 보다 작은 이미지 파일을 선택하십시오',
        'Avatar updated' => '아바타 업데이트',
        "Error saving new URL" => '새 URL 저장 중 오류 발생',
        'A player may open more than one cell and more than one KEY in one turn. Use the CASCADES rule'
        => '플레이어는 한 번의 턴에 한 개 이상의 셀과 한 개 이상의 키를 열 수 있습니다. 캐스케이드 규칙을 적용합니다.',
        'If after the automatic opening of a number, new blocks of EIGHT open cells are formed on the field, such blocks are also opened by CASCADE'
        => '번호가 자동으로 열리면 필드에 새로운 8개의 열린 셀 블록이 형성되는 경우, 이러한 블록도 연쇄적으로 열립니다.',
        'If a player has opened a cell (solved a number in it) and there is only ONE closed digit left in the block, this digit is opened automatically'
        => '플레이어가 셀을 열었다(그 안에 있는 숫자를 해결했다)고 가정할 때, 해당 블록에 남은 닫힌 숫자가 하나뿐이라면 이 숫자는 자동으로 열립니다.',
        'is awarded for solved empty cell' => '는 해결된 빈 셀에 대해 상을 받습니다.',
        '블록 내의 다른 8개의 숫자를 모두 계산하는 것입니다 - 수직으로 또는 수평으로 또는 3x3 사각형 내에서.'
        => '计算一个数块中的所有其他 8 个数字 - 纵向或横向或 3x3 正方形中的所有数字',
        "The players' task is to take turns making moves and accumulating points to open black squares"
        => '플레이어들의 임무는 차례로 움직임을 수행하고 점수를 쌓아 검은색 사각형을 열기 위해',
        'The classic SUDOKU rules apply - in a block of nine cells (vertically, horizontally and in a 3x3 square) the numbers must not be repeated'
        => '클래식 수독 규칙이 적용됩니다 - 9개의 셀로 구성된 블록(수직, 수평 및 3x3 정사각형) 내에서 숫자가 중복되어서는 안 됩니다.',
        'faq_rules' => [
            SudokuGame::GAME_NAME => <<<KO
<h2 id="nav1">게임에 대해</h2>
클래식 수독 규칙이 적용됩니다 - 9개의 셀로 구성된 블록(수직, 수평 및 3x3 정사각형) 내에서 숫자가 중복되어서는 안 됩니다
<br><br>
플레이어들의 임무는 차례로 움직임을 수행하고 점수를 쌓아 검은색 칸을 열기 위해(<span style="color:#0f0">+10점</span>) 블록 내의 다른 8개의 숫자를 수직으로 또는 수평으로 또는 3x3 정사각형 내에서 계산하는 것입니다.
<br><br>
해결된 빈 셀에 대해 <span style="color:#0f0">+1 점</span>이 부여됩니다.
<br><br>
승리는 모든 가능한 점수의 50% + 1점을 획득한 플레이어에게 돌아갑니다.
<br><br>
플레이어가 셀을 열었으며(해당 셀의 숫자를 해결했음) 블록 내에 남은 닫힌 숫자가 단 하나뿐인 경우, 이 숫자는 자동으로 열립니다.
<br><br>
번호가 자동으로 열리면 필드에 새로운 8개의 열린 셀 블록이 형성되는 경우, 이러한 블록도 연쇄적으로 열립니다.
<br><br>
플레이어는 한 번의 턴에 한 개 이상의 셀과 한 개 이상의 키를 열 수 있습니다. 캐스케이드 규칙을 적용합니다.
<br><br>
오류가 발생한 경우 - 셀의 숫자가 잘못되었을 때 - 해당 셀에 작은 빨간색 오류 숫자가 표시되며, 이 숫자는 양쪽 플레이어 모두에게 표시됩니다. 이 숫자는 해당 셀에 다시 배치될 수 없습니다.
<br><br>
체크 버튼을 사용하면 플레이어는 셀에 작은 녹색 숫자를 표시할 수 있습니다. 이 숫자는 플레이어가 확신하는 계산된 값일 수도 있고, 단순히 추측일 수도 있습니다. 일반적인 수독과 마찬가지로 메모를 사용할 수 있으며, 다른 플레이어는 이를 볼 수 없습니다.
KO
            ,
        ],
        'faq_rating' => <<<KO
Elo 등급
<br><br>
Elo 등급 시스템, Elo 계수 - 게임에서 플레이어의 상대적 강도를 계산하는 방법, 
두 명의 플레이어가 참여하는 게임(예: 체스, 체커, 쇼기, 고)에서 사용됩니다.
<br>
이 등급 시스템은 헝가리 출신 미국 물리학 교수 아르파드 엘로(헝가리어: Élő Árpád; 1903-1992)에 의해 개발되었습니다.
<br><br>
선수들 간의 등급 차이가 클수록, 강한 선수가 승리할 때 받는 등급 점수는 더 적어집니다.
<br> 
반대로, 약한 플레이어가 강한 플레이어를 이기면 랭킹 포인트를 더 많이 얻게 됩니다.
<br><br>
따라서 강한 플레이어에게는 동등한 상대와 경기하는 것이 더 유리합니다. 이기면 더 많은 포인트를 얻고, 지더라도 많은 포인트를 잃지 않기 때문입니다.
<br><br>
초보자도 경험이 풍부한 마스터와 싸우는 것이 안전합니다.
<br>
패배 시 랭킹 하락은 작을 것입니다.
<br>
하지만 승리 시 마스터는 랭킹 포인트를 너그럽게 나누어 줄 것입니다.
KO
        ,
        'faq_rewards' => [
            SudokuGame::GAME_NAME => <<<KO
플레이어는 특정 성과(기록)에 대해 보상을 받습니다.
<br><br>
플레이어의 보상은 “통계” 섹션의 다음과 같은 부문에서 반영됩니다: 금/은/동/석.
<br><br>
보상 카드를 받을 때 플레이어는 SUDOKU 코인 {{sudoku_icon}} 보너스를 받습니다.
<br>
코인은 특수한 코인 게임 모드에서 사용할 수 있으며, 게임 내 지갑을 충전하거나
게임에서 코인을 인출할 수 있습니다 - 자세한 내용은 “코인 게임 모드” 탭을 참조하세요.
<br><br>
다른 플레이어가 해당 플레이어의 기록을 깨지 않는 한, 해당 플레이어의 보상 카드는 “통계” 섹션의 “액티브 어워드” 탭에 반영됩니다.
<br><br>
각 “활성 보상”은 매 시간마다 추가 코인 수익을 생성합니다.
<br><br>
다른 플레이어가 기록을 경신한 경우, 해당 기록의 이전 소유자의 보상 카드는 “과거 보상” 탭으로 이동되며 수동 소득을 더 이상 발생시키지 않습니다. 
<br><br>
수신한 코인의 총 수량(일회성 보너스 및 추가 수익)은 “프로필” 섹션의 “지갑” 탭에서 각각 “SUDOKU 코인 잔고” 및 “적립된 보너스” 필드에서 확인할 수 있습니다.
<br><br>
“PLAYED PARTIES” 성취도에서 자신의 기록을 초과할 경우, 플레이어는 새로운 보상 카드나 코인을 다시 받지 않습니다.
기록 값 자체(게임 수 / 친구 수)는 보상 카드에 업데이트됩니다.
<br><br>
예를 들어, 플레이어가 이전에 “플레이한 게임 수”
(금) 성취도를 10,000 게임으로 획득했다면, 해당 플레이어의 게임 수가 10,001로 변경되더라도 기록 보유자에게 추가로 보상 카드가 발급되지 않습니다.
KO
            ,
        ],
        'Reward' => '보상',
        'faq_coins' => [
            SudokuGame::GAME_NAME => <<<KO
코인 [[SUDOKU {{sudoku_icon}}은 게임 내 통화 {{yandex_exclude}}{{로, <strong>스크래블, 수독</strong> 등 게임 네트워크에서 사용됩니다.
<br><br>
모든 게임에 하나의 계정, 하나의 통화, 하나의 지갑}}
<br><br>
{{yandex_exclude}}{{암호화폐 세계에서 이 코인은 SUDOKU라고도 불립니다. 곧 게임 내 지갑에서 TON(텔레그램) 네트워크의 외부 지갑으로 SUDOKU 코인을 원하는 만큼 인출할 수 있게 될 것입니다.
<br><br>}}
한편, 우리는 게임에서 “코인” 모드를 선택하여 가능한 한 많은 코인을 획득하려고 노력합니다.
<br><br>

이 모드에서는 플레이어의 랭킹도 고려하고 누적됩니다.
<br>
그러나 게임 결과로 획득한 코인은 이제 지갑에 적립됩니다(패배 시 차감됩니다)
<br><br>
지갑에 현재 보유한 코인 잔액에 따라 1, 5, 10 등 코인으로 플레이할 수 있는 옵션이 제공됩니다 - 목록에서 원하는 금액을 선택하세요
<br><br> 
“시작” 버튼을 클릭하면, 지정된 금액을 베팅할 준비가 된 상대방을 찾는 과정이 시작됩니다.
<br><br>
예를 들어, 베팅 금액을 5 코인으로 지정했는데, 새로운 게임을 시작하는 사람들 중에서는 1 코인을 베팅하려는 사람만 있습니다.
<br>
그러면 당신과 그런 플레이어의 베팅은 1 코인이 됩니다 - 두 옵션 중 더 작은 금액입니다.
<br><br>
만약 10 코인을 걸고 싸우려는 사람이 있다면, 당신의 베팅 5가 선택되며 게임은 10 코인(5+5)의 은행으로 시작됩니다.
<br><br>
2인 게임에서 승자는 전체 팟을 차지합니다 - 자신의 베팅과 상대방의 베팅을 모두 얻습니다.
<br><br>
3인 게임에서 승자는 자신의 베팅과 마지막 플레이어(가장 적은 점수를 가진 플레이어)의 베팅을 차지합니다.
중간 플레이어(준우승자)는 자신의 베팅을 돌려받으며, 자신의 코인을 유지합니다.
<br><br>
4인 게임에서 팟은 1위와 4위 플레이어(첫 번째 플레이어가 두 개의 베팅을 모두 가져감)와 
2위와 3위 플레이어(두 번째 플레이어가 두 개의 베팅을 모두 가져감) 사이에 분배됩니다.
<br><br>
따라서 3과 4를 플레이하는 것은 코인을 절약하는 측면에서 덜 위험해집니다.
<br><br>
모든 패배한 플레이어가 동일한 점수를 가진 경우, 승리 플레이어가 모든 베팅을 가져갑니다
<br><br>
4인 게임에서 2위와 3위 플레이어가 동일한 점수를 기록한 경우, 그들은 베팅을 돌려받으며 베팅을 유지합니다
<br><br>
모든 경우에 새로운 순위는 평소와 같이 계산됩니다 - “순위” 탭을 참조하세요
<br><br>
<h2>지갑을 충전하는 방법</h2>
<ol>
<li>
모든 신규 플레이어는 환영 {{stone_reward}} {{yandex_exclude}}{{SUDOKU}} 코인을 계정에 지급받으며, 즉시 큰 상금을 위한 경쟁에 참여할 수 있습니다.
</li>
<li>
친구가 귀하의 추천 링크를 통해 게임에 참여할 때마다 {{stone_reward}} 코인을 받으실 수 있습니다.
또한, 초대된 사용자 수에서 일일, 주간, 월간, 연간 기록을 세우시면 보상을 받으실 수 있습니다. 사용자를 초대하려면 Telegram을 통해 게임에 로그인해야 합니다.
</li>
<li>
게임 내 성과에 따라 코인이 지급됩니다 (게임당 포인트, 이동당 포인트, 단어당 포인트, 게임 수, 초대된 사람 수, 랭킹 순위 #1부터 #10까지)
</li>
<li>
100게임마다 {{stone_reward}} 개의 {{yandex_exclude}}{{SUDOKU }} 코인이 지급됩니다.
</li>
{{yandex_exclude}}{{<li>
루블로 코인을 구매하세요 (이체로)
</li>
<li>암호화폐로 코인을 구매하세요 (곧 출시 예정)
</li>}}
</ol>

<br>
각 성취도에 부여되는 코인의 수는 시간이 지나면서 증가하거나 감소할 수 있습니다. 실제 보상은 성취도 카드에 반영됩니다.
<br><br>
<h2>획득한 코인으로 할 수 있는 것</h2>
<ol>
<li>
우리 게임을 플레이하세요. 베팅을 높이고, 좋아하는 취미에 흥미와 재미를 더하세요.
</li>
{{yandex_exclude}}{{<li>
루블이나 암호화폐(곧 지원 예정)로 코인을 판매하고 실제 현금으로 보상을 받으세요.
</li>}}
{{yandex_exclude}}{{<li>
다른 플레이어에게 선물을 보내려면 자신의 지갑에서 원하는 수량의 코인을 해당 플레이어에게 전송하세요 (곧 출시 예정)
</li>}}   
</ol>
<br>
지갑 잔액의 세부 정보를 확인하려면 “프로필” 메뉴의 “지갑” 탭으로 이동하세요.
<br><br>
<strong>적립된 보너스</strong> - 플레이어의 성취도에 따라 매 시간마다 자동으로 적립되는 수동 수익의 결과 (메뉴 “통계”, 섹션 “상금”).
<br>
보너스는 "청구" 버튼을 눌러 잔고로 이체할 수 있습니다.
<br><br>
<strong>{{yandex_exclude}}{{SUDOKU}} 잔액</strong> - 보너스를 제외한 현재 코인 잔액. 게임 결과에 따라 이 잔액에서 코인이 차감되거나 적립됩니다.
<br><br>
메달과 유사한 성취 카드는 당신의 성공을 상징하는 표시입니다. 
<br>
이 카드는 성취의 이름, 기간(연도, 날짜, 주, 월), 포인트 수(등급, 단어 수, 친구 수), 그리고 코인 수를 포함합니다. 
<br><br>
다른 플레이어가 당신의 기록을 깨면 수동 코인 획득이 중단됩니다.
KO
            ,
        ],
        '[[Player]] opened [[number]] [[cell]]' => '[[Player]]가 [[number]] [[cell]]을 열었습니다',
        ' (including [[number]] [[key]])' => ' (번호 [[number]] [[key]])',
        '[[Player]] made a mistake' => '[[Player]]가 실수를 저질렀습니다.',
        'You made a mistake!' => '당신은 실수를 저질렀습니다!',
        'Your opponent made a mistake' => '상대가 실수를 저질렀습니다.',
        '[[Player]] gets [[number]] [[point]]' => '[[Player]]가 [[number]] [[point]]를 얻습니다.',
        '[[number]] [[point]]' => '[[number]] [[point]]',
        'You got [[number]] [[point]]' => '당신은 [[number]] [[point]]를 얻었습니다',
        'Your opponent got [[number]] [[point]]' => '상대방이 [[number]] [[point]]를 얻었습니다.',
    ];
}