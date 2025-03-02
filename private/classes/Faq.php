<?php


namespace classes;


class Faq
{
    const RULES = [
        T::EN_LANG =>
        <<<EN
<h2 id="nav1">About the game</h2>
The classic SUDOKU rules apply - in a block of nine cells (vertically, horizontally and in a 3x3 square) the numbers must not be repeated
<br><br>
The players' task is to take turns making moves and accumulating points to open black squares (+10 points) by calculating all of other 8 digits in a block - vertically OR horizontally OR in a 3x3 square
<br><br>
A +1 point is awarded for solved empty cell
<br><br>
Victory goes to the player who scores 50% of all possible points +1 point
<br><br>
If a player has opened a cell (solved a number in it) and there is only ONE closed digit left in the block, this digit is opened automatically
<br><br>
If after the automatic opening of a number, new blocks of EIGHT open cells are formed on the field, such blocks are also opened by CASCADE
<br><br>
A player may open more than one cell and more than one KEY in one turn. Use the CASCADES rule
<br><br>
In case of an erroneous move - the digit in the cell is wrong - a small red error digit appears on this cell, which is visible to both players. This digit may not be placed on this cell again
<br><br>
Using the Check button, the player can make a mark - put a small green number in the cell. This can be a calculated figure that the player is sure of, or just a guess. Use notes as in a normal SUDOKU - the other player cannot see them
EN,

        T::RU_LANG =>
    <<<RU
<h2 id="nav1">Об игре</h2>
Действуют классические правила СУДОКУ - в блоке из девяти ячеек (по вертикали, по горизонтали и в квадрате 3х3) цифры не должны повторяться
<br><br>
Задача игроков - делая ходы по очереди и накапливая очки, открывать черные квадраты (+10 очков), вычислив все остальные 8 цифр в блоке - по вертикали ИЛИ по горизонтали ИЛИ в квадрате 3х3
<br><br>
Также нужно открывать пустые клетки (+1 очко)
<br><br>
Победа достается игроку, который набрал 50% от всех возможных очков +1 очко
<br><br>
Если игрок открыл ячейку (разгадал число в ней) и в блоке осталась только ОДНА закрытая цифра, то такая цифра открывается автоматически
<br><br>
Если после автоматического открытия числа на поле образуются новые блоки из ВОСЬМИ открытых ячеек, то такие блоки также открываются КАСКАДОМ
<br><br>
За один ход игрок может открыть несколько ячеек и несколько КЛЮЧЕЙ. Пользуйтесь правилом КАСКАДОВ
<br><br>
В случае ошибочного хода - цифра в ячейке не верна - на данной клетке появляется маленькая красная цифра-ошибка, которая видна обоим игрокам. На данную клетку больше нельзя ставить эту цифру
<br><br>
С помощью кнопки Проверить, игрок может сделать пометку - поставить в клетку маленькую цифру зеленого цвета. Это может быть вычисленная цифра, в которой игрок уверен, или просто предположение. Используйте заметки как в обычном СУДОКУ - другой игрок их не видит.
RU
    ];
    const RATING = [
        T::EN_LANG => <<<EN
Elo rating
<br><br>
Elo rating system, Elo coefficient - a method of calculating the relative strength of players in games, 
in games involving two players (e.g., chess, checkers or shogi, go). 
<br>
This rating system was developed by Hungarian-born American physics professor Arpad Elo (Hungarian: Élő Árpád; 1903-1992)
<br><br>
The greater the difference in rating among the players, the fewer points to the rating the stronger player will get when winning.
<br> 
Conversely, a weaker player will get more points towards the rating if he defeats a stronger player.
<br><br>
Thus, it is more advantageous for a strong player to play with equals - if you win, you get more points, and if you lose, you don't lose very many points.
<br><br>
It is safe for a beginner to fight an experienced master.
<br>The loss of ranking if you lose will be small.
<br>But, in case of victory, the master will generously share the rank points
EN
        ,
        T::RU_LANG => <<<RU
Рейтинг Эло
<br><br>
Система рейтингов Эло, коэффициент Эло — метод расчёта относительной силы игроков в играх, 
в которых участвуют двое игроков (например, шахматы, шашки или сёги, го). 
<br>
Эту систему рейтингов разработал американский профессор физики венгерского происхождения Арпад Эло (венг. Élő Árpád; 1903—1992)
<br><br>
Чем больше разница в рейтинге среди игроков, тем меньшее количество очков к рейтингу получит более сильный игрок при выигрыше.
<br> 
И наоборот, слабый игрок получит большее количество очков к рейтингу в случае победы над более сильным
<br><br>
Таким образом, сильному игроку выгоднее играть с равными - при выигрыше получаешь больше очков, а при проигрыше теряешь не очень много
<br><br>
Новичку безопасно сразиться с опытным мастером.
<br>Потеря рейтинга в случае проигрыша будет небольшой.
<br>Зато, в случае победы, мастер щедро поделится баллами  
RU
        ,
    ];
    const REWARDS = [
        T::EN_LANG => <<<EN
Players are rewarded for certain achievements (records).
<br><br>
The player's awards are reflected in the “STATS” section in the following nominations: gold/silver/bronze/stone.
<br><br>
When receiving a reward card, the player receives a bonus of SUDOKU coins {{sudoku_icon}}<br> 
Coins can be used in a special game mode “ON Coins”, you can replenish your in-game wallet, 
as well as withdraw coins from the game - read more in the “Coin Game mode” tab
<br><br>
<h2>List of achievements and their coin values</h2>

<table class="table table-dark table-transp">
<thead>
RANKING POSITION
</thead>
<tr>
<td>
Type
</td>
<td>
Name
</td>
<td>
Reward
</td>
<td>
Income<br> per hour
</td>
</tr>
<tr>
<td>
gold
</td>
<td>
TOP 1
</td>
<td>
{{sudoku_icon}} {{gold_reward}}
</td>
<td>
{{sudoku_icon}} {{gold_income}}
</td>
</tr>
<tr>
<td>
silver
</td>
<td>
TOP 2
</td>
<td>
{{sudoku_icon}} {{silver_reward}}
</td>
<td>
{{sudoku_icon}} {{silver_income}}
</td>
</tr>
<tr>
<td>
bronze
</td>
<td>
TOP 3
</td>
<td>
{{sudoku_icon}} {{bronze_reward}}
</td>
<td>
{{sudoku_icon}} {{bronze_income}}
</td>
</tr>
<tr>
<td>
stone
</td>
<td>
Best 10
</td>
<td>
{{sudoku_icon}} {{stone_reward}}
</td>
<td>
{{sudoku_icon}} {{stone_income}}
</td>
</tr>
</table>

<table class="table table-dark table-transp">
<thead>
GAME POINTS
</thead>
<tr>
<td>
Type
</td>
<td>
Name
</td>
<td>
Reward
</td>
<td>
Income<br> per hour
</td>
</tr>
<tr>
<td>
gold
</td>
<td>
RECORD OF THE YEAR
</td>
<td>
{{sudoku_icon}} {{gold_reward}}
</td>
<td>
{{sudoku_icon}} {{gold_income}}
</td>
</tr>
<tr>
<td>
silver
</td>
<td>
RECORD OF THE MONTH
</td>
<td>
{{sudoku_icon}} {{silver_reward}}
</td>
<td>
{{sudoku_icon}} {{silver_income}}
</td>
</tr>
<tr>
<td>
bronze
</td>
<td>
RECORD OF THE WEEK
</td>
<td>
{{sudoku_icon}} {{bronze_reward}}
</td>
<td>
{{sudoku_icon}} {{bronze_income}}
</td>
</tr>
<tr>
<td>
stone
</td>
<td>
RECORD OF THE DAY
</td>
<td>
{{sudoku_icon}} {{stone_reward}}
</td>
<td>
{{sudoku_icon}} {{stone_income}}
</td>
</tr>
</table>

<table class="table table-dark table-transp">
<thead>
TURN POINTS
</thead>
<tr>
<td>
Type
</td>
<td>
Name
</td>
<td>
Reward
</td>
<td>
Income<br> per hour
</td>
</tr>
<tr>
<td>
gold
</td>
<td>
RECORD OF THE YEAR
</td>
<td>
{{sudoku_icon}} {{gold_reward}}
</td>
<td>
{{sudoku_icon}} {{gold_income}}
</td>
</tr>
<tr>
<td>
silver
</td>
<td>
RECORD OF THE MONTH
</td>
<td>
{{sudoku_icon}} {{silver_reward}}
</td>
<td>
{{sudoku_icon}} {{silver_income}}
</td>
</tr>
<tr>
<td>
bronze
</td>
<td>
RECORD OF THE WEEK
</td>
<td>
{{sudoku_icon}} {{bronze_reward}}
</td>
<td>
{{sudoku_icon}} {{bronze_income}}
</td>
</tr>
<tr>
<td>
stone
</td>
<td>
RECORD OF THE DAY
</td>
<td>
{{sudoku_icon}} {{stone_reward}}
</td>
<td>
{{sudoku_icon}} {{stone_income}}
</td>
</tr>
</table>

<table class="table table-dark table-transp">
<thead>
WORD POINTS
</thead>
<tr>
<td>
Type
</td>
<td>
Name
</td>
<td>
Reward
</td>
<td>
Income<br> per hour
</td>
</tr>
<tr>
<td>
gold
</td>
<td>
RECORD OF THE YEAR
</td>
<td>
{{sudoku_icon}} {{gold_reward}}
</td>
<td>
{{sudoku_icon}} {{gold_income}}
</td>
</tr>
<tr>
<td>
silver
</td>
<td>
RECORD OF THE MONTH
</td>
<td>
{{sudoku_icon}} {{silver_reward}}
</td>
<td>
{{sudoku_icon}} {{silver_income}}
</td>
</tr>
<tr>
<td>
bronze
</td>
<td>
RECORD OF THE WEEK
</td>
<td>
{{sudoku_icon}} {{bronze_reward}}
</td>
<td>
{{sudoku_icon}} {{bronze_income}}
</td>
</tr>
<tr>
<td>
stone
</td>
<td>
RECORD OF THE DAY
</td>
<td>
{{sudoku_icon}} {{stone_reward}}
</td>
<td>
{{sudoku_icon}} {{stone_income}}
</td>
</tr>
</table>

<table class="table table-dark table-transp">
<thead>
LONGEST WORD
</thead>
<tr>
<td>
Type
</td>
<td>
Name
</td>
<td>
Reward
</td>
<td>
Income<br> per hour
</td>
</tr>
<tr>
<td>
gold
</td>
<td>
RECORD OF THE YEAR
</td>
<td>
{{sudoku_icon}} {{gold_reward}}
</td>
<td>
{{sudoku_icon}} {{gold_income}}
</td>
</tr>
<tr>
<td>
silver
</td>
<td>
RECORD OF THE MONTH
</td>
<td>
{{sudoku_icon}} {{silver_reward}}
</td>
<td>
{{sudoku_icon}} {{silver_income}}
</td>
</tr>
<tr>
<td>
bronze
</td>
<td>
RECORD OF THE WEEK
</td>
<td>
{{sudoku_icon}} {{bronze_reward}}
</td>
<td>
{{sudoku_icon}} {{bronze_income}}
</td>
</tr>
<tr>
<td>
stone
</td>
<td>
RECORD OF THE DAY
</td>
<td>
{{sudoku_icon}} {{stone_reward}}
</td>
<td>
{{sudoku_icon}} {{stone_income}}
</td>
</tr>
</table>

<table class="table table-dark table-transp">
<thead>
GAMES PLAYED
</thead>
<tr>
<td>
Type
</td>
<td>
Name
</td>
<td>
Reward
</td>
<td>
Income<br> per hour
</td>
</tr>
<tr>
<td>
gold
</td>
<td>
RECORD OF THE YEAR
</td>
<td>
{{sudoku_icon}} {{gold_reward}}
</td>
<td>
{{sudoku_icon}} {{gold_income}}
</td>
</tr>
<tr>
<td>
silver
</td>
<td>
RECORD OF THE MONTH
</td>
<td>
{{sudoku_icon}} {{silver_reward}}
</td>
<td>
{{sudoku_icon}} {{silver_income}}
</td>
</tr>
<tr>
<td>
bronze
</td>
<td>
RECORD OF THE WEEK
</td>
<td>
{{sudoku_icon}} {{bronze_reward}}
</td>
<td>
{{sudoku_icon}} {{bronze_income}}
</td>
</tr>
<tr>
<td>
stone
</td>
<td>
RECORD OF THE DAY
</td>
<td>
{{sudoku_icon}} {{stone_reward}}
</td>
<td>
{{sudoku_icon}} {{stone_income}}
</td>
</tr>
</table>

<table class="table table-dark table-transp">
<thead>
INVITED FRIENDS (REFERRALS)
</thead>
<tr>
<td>
Type
</td>
<td>
Name
</td>
<td>
Reward
</td>
<td>
Income<br> per hour
</td>
</tr>
<tr>
<td>
gold
</td>
<td>
RECORD OF THE YEAR
</td>
<td>
{{sudoku_icon}} {{gold_reward}}
</td>
<td>
{{sudoku_icon}} {{gold_income}}
</td>
</tr>
<tr>
<td>
silver
</td>
<td>
RECORD OF THE MONTH
</td>
<td>
{{sudoku_icon}} {{silver_reward}}
</td>
<td>
{{sudoku_icon}} {{silver_income}}
</td>
</tr>
<tr>
<td>
bronze
</td>
<td>
RECORD OF THE WEEK
</td>
<td>
{{sudoku_icon}} {{bronze_reward}}
</td>
<td>
{{sudoku_icon}} {{bronze_income}}
</td>
</tr>
<tr>
<td>
stone
</td>
<td>
RECORD OF THE DAY
</td>
<td>
{{sudoku_icon}} {{stone_reward}}
</td>
<td>
{{sudoku_icon}} {{stone_income}}
</td>
</tr>
</table>

As long as one player's record has not been broken by another player, the reward card is reflected for that player in the “ACTIVE AWARDS” tab of the “STATS” section.<br><br>
Each “ACTIVE Reward” every hour generates additional
“profit” in coins.<br><br>
If a record has been broken by another player, the award card of the
the previous owner of the record is moved to the “PAST AWARDS” tab and stops bringing passive income.
Rewards” tab and ceases to bring passive income.<br><br>
The total number of coins received (one-time bonuses and
additional profit) can be viewed in the “PROFILE” section in the “Wallet” tab in the “SUDOKU balance” and “Bonuses accrued” fields, respectively.
tab “Wallet” in the field “SUDOKU balance” and “Bonuses accrued” respectively.<br><br>
When exceeding the own record for the achievements “PLAYED PARTIES” and “APPLIED FRIENDS
games” and ‘invited friends’ achievements, the player is not given a new reward card or coins again.
reward card and coins are not awarded again. The record value itself
(number of games / number of friends) is updated on the reward card.<br><br>
For example, if a player has previously earned the achievement - “GAMES PLAYED”
(gold) for 10,000 games, then when the number of games of this player is changed to 10,001 another award card will not be given to the record holder.
10,001, no more reward cards will be issued to the record holder.<br>
EN,
        T::RU_LANG => <<<RU
За определенные достижения (рекорды) игроки получают награды.
<br><br>
Награды игрока отражаются в разделе "СТАТИСТИКА" в следующих
номинациях: золото/серебро/бронза/камень.
<br><br>
При полученнии карточки-награды игроку также начисляется бонус монетами {{yandex_exclude}}{{SUDOKU}} {{sudoku_icon}}<br> 
Использовать монеты можно в специальном режиме игры "НА МОНЕТЫ", можно пополнять внутриигровой кошелек, 
а также выводить монеты из игры - подробнее читайте во вкладке "ИГРА НА МОНЕТЫ"
<br><br>
<h2>Список достижений и их стоимость в монетах</h2>

<table class="table table-dark table-transp">
<thead>
МЕСТО В РЕЙТИНГЕ
</thead>
<tr>
<td>
Тип
</td>
<td>
Название
</td>
<td>
Награда
</td>
<td>
Прибыль<br> в час
</td>
</tr>
<tr>
<td>
золото
</td>
<td>
ТОП 1
</td>
<td>
{{sudoku_icon}} {{gold_reward}}
</td>
<td>
{{sudoku_icon}} {{gold_income}}
</td>
</tr>
<tr>
<td>
серебро
</td>
<td>
ТОП 2
</td>
<td>
{{sudoku_icon}} {{silver_reward}}
</td>
<td>
{{sudoku_icon}} {{silver_income}}
</td>
</tr>
<tr>
<td>
бронза
</td>
<td>
ТОП 3
</td>
<td>
{{sudoku_icon}} {{bronze_reward}}
</td>
<td>
{{sudoku_icon}} {{bronze_income}}
</td>
</tr>
<tr>
<td>
камень
</td>
<td>
10 лучших
</td>
<td>
{{sudoku_icon}} {{stone_reward}}
</td>
<td>
{{sudoku_icon}} {{stone_income}}
</td>
</tr>
</table>

<table class="table table-dark table-transp">
<thead>
ОЧКИ ЗА ХОД
</thead>
<tr>
<td>
Тип
</td>
<td>
Название
</td>
<td>
Награда
</td>
<td>
Прибыль<br> в час
</td>
</tr>
<tr>
<td>
золото
</td>
<td>
РЕКОРД ГОДА
</td>
<td>
{{sudoku_icon}} {{gold_reward}}
</td>
<td>
{{sudoku_icon}} {{gold_income}}
</td>
</tr>
<tr>
<td>
серебро
</td>
<td>
РЕКОРД МЕСЯЦА
</td>
<td>
{{sudoku_icon}} {{silver_reward}}
</td>
<td>
{{sudoku_icon}} {{silver_income}}
</td>
</tr>
<tr>
<td>
бронза
</td>
<td>
РЕКОРД НЕДЕЛИ
</td>
<td>
{{sudoku_icon}} {{bronze_reward}}
</td>
<td>
{{sudoku_icon}} {{bronze_income}}
</td>
</tr>
<tr>
<td>
камень
</td>
<td>
РЕКОРД ДНЯ
</td>
<td>
{{sudoku_icon}} {{stone_reward}}
</td>
<td>
{{sudoku_icon}} {{stone_income}}
</td>
</tr>
</table>

<table class="table table-dark table-transp">
<thead>
СЫГРАНО ПАРТИЙ
</thead>
<tr>
<td>
Тип
</td>
<td>
Название
</td>
<td>
Награда
</td>
<td>
Прибыль<br> в час
</td>
</tr>
<tr>
<td>
золото
</td>
<td>
РЕКОРД ГОДА
</td>
<td>
{{sudoku_icon}} {{gold_reward}}
</td>
<td>
{{sudoku_icon}} {{gold_income}}
</td>
</tr>
<tr>
<td>
серебро
</td>
<td>
РЕКОРД МЕСЯЦА
</td>
<td>
{{sudoku_icon}} {{silver_reward}}
</td>
<td>
{{sudoku_icon}} {{silver_income}}
</td>
</tr>
<tr>
<td>
бронза
</td>
<td>
РЕКОРД НЕДЕЛИ
</td>
<td>
{{sudoku_icon}} {{bronze_reward}}
</td>
<td>
{{sudoku_icon}} {{bronze_income}}
</td>
</tr>
<tr>
<td>
камень
</td>
<td>
РЕКОРД ДНЯ
</td>
<td>
{{sudoku_icon}} {{stone_reward}}
</td>
<td>
{{sudoku_icon}} {{stone_income}}
</td>
</tr>
</table>

<table class="table table-dark table-transp">
<thead>
ПРИГЛАШЕННЫЕ ДРУЗЬЯ (РЕФЕРАЛЫ)
</thead>
<tr>
<td>
Тип
</td>
<td>
Название
</td>
<td>
Награда
</td>
<td>
Прибыль<br> в час
</td>
</tr>
<tr>
<td>
золото
</td>
<td>
РЕКОРД ГОДА
</td>
<td>
{{sudoku_icon}} {{gold_reward}}
</td>
<td>
{{sudoku_icon}} {{gold_income}}
</td>
</tr>
<tr>
<td>
серебро
</td>
<td>
РЕКОРД МЕСЯЦА
</td>
<td>
{{sudoku_icon}} {{silver_reward}}
</td>
<td>
{{sudoku_icon}} {{silver_income}}
</td>
</tr>
<tr>
<td>
бронза
</td>
<td>
РЕКОРД НЕДЕЛИ
</td>
<td>
{{sudoku_icon}} {{bronze_reward}}
</td>
<td>
{{sudoku_icon}} {{bronze_income}}
</td>
</tr>
<tr>
<td>
камень
</td>
<td>
РЕКОРД ДНЯ
</td>
<td>
{{sudoku_icon}} {{stone_reward}}
</td>
<td>
{{sudoku_icon}} {{stone_income}}
</td>
</tr>
</table>

Пока рекорд одного игрока не был перебит другим игроком, карточка-награда отражается у такого игрока во вкладке "АКТИВНЫЕ НАГРАДЫ"
раздела "СТАТИСТИКА".<br><br>
"АКТИВНАЯ НАГРАДА" каждый час генерирует дополнительную
"прибыль" в монетах.<br><br>
Если рекорд был перебит другим игроком, то карточка-награда у
предыдущего владельца рекорда перемещается во вкладку "ПРОШЛЫЕ
НАГРАДЫ" и перестает приносить пассивный доход.<br><br>
Общее количество полученных монет (единовременные бонусы и
дополнительная прибыль) можно посмотреть в разделе "ПРОФИЛЬ" во
вкладке "КОШЕЛЕК" в поле "Баланс {{yandex_exclude}}{{ SUDOKU}}" и "Начислено бонусов" соответственно.<br><br>
При превышении собственного рекорда для достижений "СЫГРАНО
ПАРТИЙ" и "ПРИГЛАШЕННЫЕ ДРУЗЬЯ" игроку повторно не выдается новая
карточка-награда и не начисляются монеты повторно. Само значение рекорда
(число игр / количество друзей) обновляется на карточке-награде.<br><br>
Например, если игрок ранее получил достижение - "СЫГРАНО ПАРТИЙ"
(золото) за 10 000 игр, то при изменении количества игр у этого игрока на
значение 10 001 еще одна карточка-награда обладателю рекорда не выдается.<br>
RU
    ];
    const COINS = [
        T::EN_LANG => <<<EN
Coin <strong>SUDOKU</strong> {{sudoku_icon}} is an in-game currency for a network of games - <strong>Erudite, Scrabble, Sudoku</strong> (coming soon)<br><br>
One account for all games, one currency, one wallet<br><br>
{{yandex_exclude}}{{In the crypto world, the coin is also called SUDOKU. Soon it will be possible to withdraw any number of SUDOKU coins from your in-game wallet to an external wallet in the TON (Telegram) network
<br><br>}}
In the meantime, we try to win as many coins as possible in the game by selecting the “Coins” mode<br><br>

This mode also takes into account and accrues player rankings.<br>
However, coins won by the results of the game are now credited to your wallet (or deducted if you lose)
<br><br>
Depending on the current balance of coins in your wallet, you are offered to play for 1, 5, 10, etc. coins - choose the desired amount from the list
<br><br>
After pressing the “Start” button, the search for an opponent who is also ready to bet the specified amount will begin
<br><br> 
For example, you have specified your bet size as 5 coins, and among those starting a new game there are only those willing to bet 1 coin.
<br>
Then the bet for both you and such a player will be 1 coin - the lesser of both options.
<br><br>
In case there is someone willing to fight for 10 coins, your bet - 5 will be selected and the game will start with a bank of 10 coins - 5+5
<br><br>
In a two-person game, the winner gets the entire pot - his bet and his opponent's bet
<br><br>
In a three-way game, the winner takes his bet and the bet of the last player (the player with the fewest points). 
The middle player (the runner-up) gets his bet back, keeping his coins
<br><br>
In a four-player game, the pot is split between players in 1st and 4th place (the first player takes both bets), 
and players in 2nd and 3rd places (the second takes both bets).
<br><br>
Thus, playing three and four becomes less risky in terms of saving coins
<br><br>
If all losing players have the same number of points, then the winning player takes all bets
<br><br>
In a foursome game, if the 2nd and 3rd players score an equal number of points, they get their bet back, keeping their bets
<br><br>
New Rank in all cases is calculated as usual - see the “Ranking” tab
<br><br>
<h2>How you can replenish your wallet</h2>
<ol>
<li>
Every new player receives welcome {{stone_reward}} SUDOKU coins to his balance and can immediately get involved in the race for big wins
</li>
<li>
You will receive {{stone_reward}} coins for each friend who comes to the game using your referral link. 
Also, by setting a record (for the day, week, month, year) on the number of invitees, you will be rewarded. To invite a user, you need to log in to the game via Telegram.
</li>
<li>
Coins are awarded for achievements in the game (points per game, points per move, points per word, number of games, number of invitees, place in the ranking from #1 to #10)
</li>
<li>
For every 100 games, {{stone_reward}} of SUDOKU coins are awarded
</li>
<li>
Buy coins for rubles by transfer
</li>
<li>Buy Coins for Cryptocurrency (coming soon)
</li>
</ol>

<br>
The number of coins awarded for each achievement may change over time, either up or down. The actual reward is reflected in the achievement card.
<br><br>
<h2>What you can do with the coins you win</h2>
<ol>
<li>
Play our games, increasing the stakes, adding excitement and interest to your favorite pastime
</li>
<li>
Sell coins for rubles or for cryptocurrency (soon) and get your reward in real money terms
</li>
<li>
Make a gift to another player by sending the latter any number of coins from your wallet (coming soon)
</li>     
</ol>
<br>
You can find out the details of your wallet balance in the “Wallet” tab of the “PROFILE” menu.
<br><br>
<strong>Bonuses accrued</strong> - the result of passive earnings accrued every hour depending on the player's achievements (menu “STATS”, section “Awards”).
<br>Bonuses can be transferred to the balance by pressing the “REMOVE” button (soon)
<br><br>
<strong>SUDOKU balance</strong> - current balance of coins without bonuses. Coins are deducted / credited from it according to the results of the game
<br><br>
Achievement cards akin to medals are a marker of your success. 
<br>They include the name of the achievement, the period (year, day, week, month), the number of points (rating, word length, number of friends), and the number of coins 
<br><br>
Passive coin earning stops when your record is broken by another player
EN
        ,
        T::RU_LANG => <<<RU
Монета {{yandex_exclude}}{{<strong>SUDOKU</strong>}} {{sudoku_icon}} - это внутриигровая валюта{{yandex_exclude}}{{ для сети игр - <strong>Эрудит, Scrabble, Sudoku</strong> (скоро)<br><br>
Один аккаунт на все игры, одна валюта, один кошелек}}<br><br>
{{yandex_exclude}}{{В крипто-мире монета также называется SUDOKU. Скоро станет возможным вывести любое количество монет SUDOKU со своего игрового кошелька на внешний кошелек сети TON (Телеграм)
<br><br>}}
А пока мы стараемся выиграть как можно больше монет в игре, выбирая режим "На монеты"<br><br>

Данный режим также учитывает и начисляет рейтинг игроков.<br>
Однако, теперь на ваш кошелек начисляются выигранные по результатам партии монеты (или списываются в случае проигрыша)
<br><br>
В зависимости от текущего баланса монет в кошельке, вам предлагается сыграть на 1, 5, 10 и т.д. монет - выберите желаемое количество из списка
<br><br>
После нажатия кнопки "Начать" начнется поиск соперника, также готового поставить указанную сумму
<br><br> 
Например, вы указали размер своей ставки 5 монет, а среди начинающих новую игру есть только желающие поставить 1 монету.
<br>
Тогда ставка и для вас и для такого игрока составит 1 монету - меньшее из обоих вариантов.
<br><br>
В случае, если есть желающий сразиться на 10 монет, будет выбрана ваша ставка - 5, и начнется игра с банком в 10 монет - 5+5
<br><br>
При игре на двоих выигравший получает весь банк - свою ставку и ставку противника
<br><br>
При игре втроем, выигравший забирает свою ставку и ставку последнего игрока (игрока с наименьшим количеством очков). 
Средний игрок (занявший второе место) получает обратно свою ставку, оставшись при своих монетах
<br><br>
При игре вчетвером, банк делят игроки на 1-м и 4-м местах (первый забирает обе ставки), 
и игроки на 2-м и 3-м местах (второй забирает обе ставки)
<br><br>
Таким образом, игра на троих и на четверых становится менее рискованной с точки зрения сохранения монет
<br><br>
Если все проигравшие игроки набрали одинаковое количество очков, тогда выигравший забирает все ставки
<br><br>
При игре вчетвером, если 2-й и 3-й игроки набирают равное количество очков, они получают обратно свою ставку, оставаясь при своих
<br><br>
Рейтинг во всех случаях рассчитывается как обычно - смотри вкладку "Рейтинг"
<br><br>
<h2>Каким образом можно пополнить кошелек</h2>
<ol>
<li>
Каждый новый игрок получает приветственные {{stone_reward}} монет {{yandex_exclude}}{{SUDOKU}} на свой баланс и сразу может включиться в гонку за большими выигрышами
</li>
{{yandex_exclude}}{{<li>
За каждого друга, пришедшего в игру по вашей реферальной ссылке, вы получите {{stone_reward}} монет. 
Также, установив рекорд (за день, неделю, месяц, год) по числу приглашенных, вам будет начисляться награда. Чтобы пригласить пользователя, вам нужно зайти в игру через Телеграм.
</li>}}
<li>
За достижения в игре (очки за игру, очки за ход, очки за слово, количество партий, количество приглашенных, место в рейтинге от №1 до №10) начисляются монеты
</li>
<li>
За каждые 100 игр начисляется {{stone_reward}} монет {{yandex_exclude}}{{SUDOKU}}
</li>
{{yandex_exclude}}{{<li>
Купить монеты за рубли переводом
</li>
<li>Купить монеты за криптовалюту (скоро)
</li>}}
</ol>

<br>
Количество монет, начисляемых за каждое достижение может меняться со временем как в большую, так и в меньшую сторону. Фактическая награда отражается в карточке достижения.
<br><br>
<h2>Что можно делать с выигранными монетами</h2>
<ol>
<li>
Играть в наши игры, увеличивая ставки, добавляя азарт и интерес в любимое времяпрепровождение
</li>
{{yandex_exclude}}{{<li>
Продать монеты за рубли или за криптовалюту (скоро) и получить свою награду в реальном денежном выражении
</li>}}
{{yandex_exclude}}{{<li>
Сделать подарок другому игроку, отправив последнему любое количество монет со своего кошелька (скоро)
</li>}}    
</ol>
<br>
Узнать детали баланса своего кошелька вы можете во вкладке "КОШЕЛЕК" меню "ПРОФИЛЬ".
<br><br>
<strong>Начислено бонусов</strong> - результат пассивного заработка, начисляемого каждый час в зависимости от достижений игрока (меню "СТАТИСТИКА", раздел "ДОСТИЖЕНИЯ").
<br>Бонусы можно перенести в баланс по кнопке "ЗАБРАТЬ" (скоро)
<br><br>
<strong>Баланс {{yandex_exclude}}{{SUDOKU}}</strong> - текущий баланс монет без учета бонусов. Из него списываются / начисляются монеты по результатам игры
<br><br>
Карточки достижений сродни медалям являются отметкой о ваших успехах. 
<br>В них указывается название достижения, период (год, день, неделя, месяц), количество очков (рейтинг, длина слова, число друзей), количество монет 
<br><br>
Пассивный заработок монет прекращается, когда ваш рекорд перебит другим игроком
RU
        ,
    ];
}