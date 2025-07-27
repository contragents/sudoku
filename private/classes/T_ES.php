<?php

namespace classes;


use PaymentModel;
use UserModel;

class T_ES
{
    const PHRASES = [
        'Invalid URL format! <br />It must begin with <strong>http(s)://</strong>' => 'Formato de URL no válido! <br />Debe empezar por <strong>http(s)://</strong>',
        '</strong> or <strong>' => '</strong> o <strong>',
        'MB</strong>)</li><li>extension -<strong>' => 'MB</strong>)</li><li>extensión -<strong>',
        '<strong>File upload error!</strong><br /> Please review:<br /> <ul><li>file size (no more than <strong>'
        => '<strong>Error al cargar el archivo.</strong><br /> Por favor, revisa:<br /> <ul><li>tamaño del archivo (no más de <strong>',
        'Error creating new payment' => 'Error al crear un nuevo pago',
        'FAQ' => 'FAQ',
        'Agreement' => 'Acuerdo',
        'Empty value is forbidden' => 'El valor vacío está prohibido',
        'Forbidden' => 'Prohibido',
        'game_title' => [
            SudokuGame::GAME_NAME => 'Sudoku en línea con amigos',
        ],
        'secret_prompt' => [
            SudokuGame::GAME_NAME => '&#42;Guarda esta clave para restablecer la cuenta en <a href="https://t.me/sudoku_app_bot">Telegrama</a>.',
        ],
        'COIN Balance' => 'Saldo de monedas',
        PaymentModel::INIT_STATUS => 'Comenzó',
        PaymentModel::BAD_CONFIRM_STATUS => 'Mala confirmación',
        PaymentModel::COMPLETE_STATUS => 'Completado',
        PaymentModel::FAIL_STATUS => 'Fallido',
        'Last transactions' => 'Últimas transacciones',
        'Support in Telegram' => 'Soporte en Telegram',
        'Check_price' => 'Consultar precio',
        'Replenish' => 'Reponga',
        'SUDOKU_amount' => 'Cantidad de monedas',
        'enter_amount' => 'importe',
        'Buy_SUDOKU' => 'Comprar monedas SUDOKU',
        'The_price' => 'Oferta de precio',
        'calc_price' => 'precio',
        'Pay' => 'Pagar',
        'Congratulations to Player' => 'Enhorabuena al Jugador',
        'Server sync lost' => 'Pérdida de sincronización con el servidor',
        'Server connecting error. Please try again' => 'Error de conexión del servidor. Por favor, inténtelo de nuevo',
        'Error changing settings. Try again later' => 'Error al cambiar la configuración. Vuelva a intentarlo más tarde',
        'invite_friend_prompt' => [
            SudokuGame::GAME_NAME => '¡Únete al juego online SUDOKU en Telegram! Consigue la máxima puntuación, gana monedas y retira tokens a tu monedero.',
        ],
        'game_bot_url' => [
            SudokuGame::GAME_NAME => 'https://t.me/sudoku_app_bot',
        ],
        'loading_text' => [SudokuGame::GAME_NAME => 'SUDOKU está cargando...'],
        'switch_tg_button' => 'Cambiar a Telegram',
        'Invite a friend' => 'Invitar a un amigo',
        'you_lost' => '¡Has perdido!',
        'you_won' => '¡Has ganado!',
        '[[Player]] won!' => '[[Player]] ¡ganó!',
        'start_new_game' => 'Empezar una nueva partida',
        'rating_changed' => 'Cambio de calificación: ',
        'Authorization error' => 'Error de autorización',
        'Error sending message' => 'Error al enviar el mensaje',
        // Рекорды
        'Got reward' => 'Tengo recompensa',
        'Your passive income' => 'Sus ingresos pasivos',
        'will go to the winner' => 'será para el ganador',
        'Effect lasts until beaten' => 'El efecto dura hasta que se vence',
        'per_hour' => 'hora',
        'rank position' => 'rango posición',
        'record of the year' => 'disco del año',
        'record of the month' => 'disco del mes',
        'record of the week' => 'disco de la semana',
        'record of the day' => 'disco del día',
        'game_price' => 'puntos de juego',
        'games_played' => 'partidos jugados',
        'Games Played' => 'Juegos jugados',
        'top' => 'top',
        'turn_price' => 'puntos de giro',
        'word_len' => 'longitud de palabra',
        'word_price' => 'puntos por palabra',
        UserModel::BALANCE_HIDDEN_FIELD => 'Usuario oculto',
        'top_year' => 'TOP 1',
        'top_month' => 'TOP 2',
        'top_week' => 'TOP 3',
        'top_day' => 'MEJOR 10',
        // Рекорды конец
        'Return to fullscreen mode?' => '¿Volver al modo de pantalla completa?',
        // Профиль игрока
        'Choose file' => 'Elegir archivo',
        'Back' => 'Volver',
        'Wallet' => 'Cartera',
        'Referrals' => 'Remisiones',
        'Player ID' => 'ID de jugador',
        // complaints
        'Player is unbanned' => 'Jugador desbaneado',
        'Player`s ban not found' => 'Prohibición de jugador no encontrada',
        'Player not found' => 'Jugador no encontrado',
        // end complaints
        'Save' => 'Guardar',
        'new nickname' => 'nuevo apodo',
        'Input new nickname' => 'Introducir nuevo apodo',
        'Your rank' => 'Su rango',
        'Ranking number' => 'Número de clasificación',
        'Balance' => 'Saldo',
        'Rating by coins' => 'Clasificación por monedas',
        'Secret key' => 'Clave secreta',
        'Link' => 'Enlace',
        'Bonuses accrued' => 'Bonificaciones devengadas',
        'SUDOKU Balance' => 'Saldo SUDOKU',
        'Claim' => 'Reclamación',
        'Name' => 'Nombre',
        // Профиль игрока конец
        'Nickname updated' => 'Apodo actualizado',
        'Stats getting error' => 'Error en las estadísticas',
        'Error saving Nick change' => 'Error al guardar el cambio de Nick',
        'Play at least one game to view statistics' => 'Juega al menos una partida para ver las estadísticas',
        'Lost server synchronization' => 'Pérdida de sincronización del servidor',
        'Closed game window' => 'Ventana de juego cerrada',
        'You closed the game window and became inactive!' => 'Has cerrado la ventana de juego y te has vuelto inactivo.',
        'Request denied. Game is still ongoing' => 'Solicitud denegada. El juego sigue en curso',
        'Request rejected' => 'Solicitud rechazada',
        'No messages yet' => 'Aún no hay mensajes',
        'New game request sent' => 'Solicitud de nuevo juego enviada',
        'Your new game request awaits players response' => 'Su nueva solicitud de juego espera la respuesta de los jugadores',
        'Request was aproved! Starting new game' => 'Solicitud aprobada Empezar una nueva partida',
        'Default avatar is used' => 'Se utiliza el avatar por defecto',
        'Avatar by provided link' => 'Avatar por enlace proporcionado',
        'Set' => 'Pregunta a',
        'Avatar loading' => 'Carga del avatar',
        'Send' => 'Enviar',
        'Avatar URL' => 'URL del avatar',
        'Apply' => 'Solicitar',
        'Account key' => 'Clave de la cuenta',
        'Main account key' => 'Clave de la cuenta principal',
        'old account saved key' => 'cuenta antigua clave guardada',
        'Key transcription error' => 'Error de transcripción de teclas',
        "Player's ID NOT found by key" => 'ID de jugador NO encontrado por clave',
        'Accounts linked' => 'Cuentas vinculadas',
        'Accounts are already linked' => 'Las cuentas ya están vinculadas',
        'Game is not started' => 'El juego no se inicia',
        'OK' => 'OK',
        'Click to expand the image' => 'Haga clic para ampliar la imagen',
        'Report sent' => 'Informe enviado',
        'Report declined! Please choose a player from the list' => 'Denuncia rechazada Por favor, elija un jugador de la lista',
        'Your report accepted and will be processed by moderator' => 'Su informe aceptado y será procesado por el moderador',
        'If confirmed, the player will be banned' => 'Si se confirma, el jugador será expulsado',
        'Report declined!' => '¡Informe rechazado!',
        'Only one complaint per each player per day can be sent. Total 24 hours complaints limit is'
        => 'Sólo se puede enviar una queja por jugador y día. El límite total de reclamaciones en 24 horas es de',
        'From player' => 'De Jugador',
        'To Player' => 'Al jugador',
        'Awaiting invited players' => 'En espera de los jugadores invitados',
        'Searching for players' => 'Búsqueda de jugadores',
        'Searching for players with selected rank' => 'Búsqueda de jugadores con el rango seleccionado',
        'Message NOT sent - BAN until ' => 'Mensaje NO enviado - BAN hasta ',
        'Message NOT sent - BAN from Player' => 'Mensaje NO enviado - BAN del Jugador',
        'Message sent' => 'Mensaje enviado',
        'Exit' => 'Salida',
        'Appeal' => 'Recurso',
        'There are no events yet' => 'Aún no hay eventos',
        'Playing to' => 'Jugar a',
        'Just two players' => 'Sólo dos jugadores',
        'Up to four players' => 'Hasta cuatro jugadores',
        'Game selection - please wait' => 'Selección de juego - espere',
        'Your turn!' => '¡Tu turno!',
        'Looking for a new game...' => 'Buscando un nuevo juego...',
        'Get ready - your turn is next!' => 'Prepárese: ¡su turno es el siguiente!',
        'Take a break - your move in one' => 'Tómese un descanso: su mudanza en uno',
        'Refuse' => 'Desechos',
        'Offer a game' => 'Ofrecer un juego',
        'Players ready:' => 'Jugadores listos:',
        'Players' => 'Jugadores',
        'Try sending again' => 'Intente enviar de nuevo',
        'Error connecting to server!' => 'Error al conectar con el servidor.',
        'You haven`t composed a single word!' => '¡No has compuesto ni una sola palabra!',
        'You will lose if you quit the game! CONTINUE?' => '¡Perderás si abandonas el juego! ¿CONTINUAR?',
        'Cancel' => 'Cancelar',
        'Confirm' => 'Confirme',
        'Revenge!' => '¡Venganza!',
        'Time elapsed:' => 'Tiempo transcurrido:',
        'Time limit:' => 'Límite de tiempo:',
        'You can start a new game if you wait for a long time' => 'Puedes empezar una nueva partida si esperas mucho tiempo',
        'Close in 5 seconds' => 'Cerrar en 5 segundos',
        'Close immediately' => 'Cerrar inmediatamente',
        'Will close automatically' => 'Se cerrará automáticamente',
        's' => ' segundos',
        'Average waiting time:' => 'Tiempo medio de espera:',
        'Waiting for other players' => 'A la espera de otros jugadores',
        'Game goal' => 'Objetivo del juego',
        'Rating of opponents' => 'Calificación de los adversarios',
        'new player' => 'nuevo jugador',
        'CHOOSE GAME OPTIONS' => 'ELEGIR OPCIONES DE JUEGO',
        'Profile' => 'Perfil',
        'Error' => 'Error',
        'Your profile' => 'Tu perfil',
        'Start' => 'Inicio',
        'Stats' => 'Stats',
        'Play on' => 'Jugar en',
        // Чат
        'Error sending complaint<br><br>Choose opponent' => 'Error al enviar la reclamación<br><br>Elegir oponente',
        'You' => 'Tú',
        'to all: ' => 'a todos: ',
        ' (to all):' => ' (a todos):',
        'For everyone' => 'Para todos',
        'Word matching' => 'Combinación de palabras',
        'Player support and chat at' => 'Asistencia al jugador y chat en',
        'Join group' => 'Unirse al grupo',
        'Send an in-game message' => 'Enviar un mensaje en el juego',
        // Чат
        'News' => 'Noticias',
        // Окно статистика
        'Past Awards' => 'Premios pasados',
        'Parties_Games' => 'Partidos',
        'Player`s achievements' => 'Logros del jugador',
        'Player Awards' => 'Premios para jugadores',
        'Player' => 'Jugador',
        'VS' => 'VS',
        'Rating' => 'Clasificación',
        'Opponent' => 'Oponente',
        'Active Awards' => 'Premios activos',
        'Remove filter' => 'Quitar filtro',
        // Окно статистика конец

        "Opponent's rating" => 'Calificación del oponente',
        'Choose your MAX bet' => 'Elija su apuesta MÁXIMA',
        'Searching for players with corresponding bet' => 'Búsqueda de jugadores con apuesta correspondiente',
        'Coins written off the balance sheet' => 'Monedas dadas de baja',
        'Number of coins on the line' => 'Número de monedas en la línea',
        'gets a win' => 'consigue una victoria',
        'The bank of' => 'El banco de',
        'goes to you' => 'va para ti',
        'is taken by the opponent' => 'es tomado por el oponente',
        'Bid' => 'Oferta',
        'No coins' => 'Sin monedas',
        'Any' => 'Cualquier',
        'online' => 'en línea',
        'Above' => 'Sobre',
        'minutes' => 'minutos',
        'minute' => 'minuto',
        'Select the minimum opponent rating' => 'Seleccione la clasificación mínima del oponente',
        'Not enough 1900+ rated players online' => 'No hay suficientes jugadores de más de 1900 en línea',
        'Only for players rated 1800+' => 'Sólo para jugadores clasificados como 1800+',
        'in game' => 'en juego',
        'score' => 'puntaje',
        'Your current rank' => 'Su rango actual',
        'Server syncing..' => 'Sincronización del servidor..',
        ' is making a turn.' => ' hace una jugada.',
        'Your turn is next - get ready!' => 'Ahora te toca a ti, ¡prepárate!',
        'switches pieces and skips turn' => 'cambia de pieza y se salta el turno',
        "Game still hasn't started!" => '¡El partido aún no ha empezado!',
        "Word wasn't found" => 'No se encontró la palabra',
        'Correct' => 'Correcto',
        'One-letter word' => 'Palabra de una letra',
        'Repeat' => 'Repita',
        'costs' => 'cuesta',
        '+15 for all pieces used' => '+15 para todas las piezas utilizadas',
        'TOTAL' => 'TOTAL',
        'You did not make any word' => 'Usted no hizo ninguna palabra',
        'is attempting to make a turn out of his turn (turn #' => 'intenta hacer un giro fuera de su turno (turno #',
        'Data processing error!' => 'Fehler in der Datenverarbeitung!',
        ' - turn processing error (turn #' => ' - error de procesamiento de turno (turno #',
        "didn't make any word (turn #" => 'no hizo ninguna palabra (giro #',
        'set word lenght record for' => 'récord de longitud de palabra del',
        'set word cost record for' => 'récord de coste de palabras del',
        'set record for turn cost for' => 'récord de coste de giro del',
        'gets' => 'consigue',
        'for turn #' => 'por turno #',
        'For all pieces' => 'Para todas las piezas',
        'Wins with score ' => 'Gana con puntuación ',
        'set record for gotten points in the game for' => 'récord de puntos conseguidos en el partido del',
        'out of chips - end of game!' => 'sin fichas - ¡fin del juego!',
        'set record for number of games played for' => 'récord de partidos jugados en el',
        'is the only one left in the game - Victory!' => 'es el único que queda en el juego - ¡Victoria!',
        'left game' => 'que abandona la partida',
        'has left the game' => 'ha abandonado el juego',
        'is the only one left in the game! Start a new game' => 'es el único que queda en el juego! Empezar una nueva partida',
        'Time for the turn ran out' => 'Se acabó el tiempo para la vuelta',
        "is left without any pieces! Winner - " => '¡se queda sin piezas! Ganador -',
        ' with score ' => ' con una puntuación de ',
        "is left without any pieces! You won with score " => 'se queda sin piezas! Has ganado con una puntuación de ',
        "gave up! Winner - " => 'se rindió Ganador - ',
        'skipped 3 turns! Winner - ' => 'se saltó 3 turnos! Ganador - ',
        'New game has started!' => '¡El nuevo juego ha comenzado!',
        'New game' => 'Nuevo juego',
        'Accept invitation' => 'Aceptar invitación',
        'Get' => 'Consigue',
        'score points' => 'puntos de puntuación',
        "Asking for adversaries' approval." => 'Pedir la aprobación de los adversarios.',
        'Remaining in the game:' => 'Permanecer en el juego:',
        "You got invited for a rematch! - Accept?" => '¡Te han invitado a la revancha! - ¿Aceptas?',
        'All players have left the game' => 'Todos los jugadores han abandonado el juego',
        "Your score" => 'Su puntuación',
        'Turn time' => 'Duración de un turno',
        'Date' => 'Fecha',
        'Price' => 'Precio',
        'Status' => 'Estado',
        'Type' => 'Tipo',
        'Period' => 'Periodo',
        'Word' => 'Palabra',
        'Points/letters' => 'Puntos/letras',
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