<?php

namespace classes;

class DeskSudoku extends Desk
{
    const NUM_COLS = 9;
    const NUM_ROWS = 9;
    //private SudokuPuzzle $sudoku;
    private array $solution = []; // Решение судоку
    public array $mistakes = []; // ошибки игроков

    const TURN_MISTAKE_RESPONSE = 'mistake';
    const TURN_CORRECT_RESPONSE = 'correct';
    const KEY_SOLVED_RESPONSE = 'key';
    const CELL_VALUES = [1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5, 6 => 6, 7 => 7, 8 => 8, 9 => 9];

    const DEFAULT_CELL_COUNT = 25;

    public function __construct(int $cellCount = self::DEFAULT_CELL_COUNT)
    {
        parent::__construct();

        $sudoku = new SudokuPuzzle();
        $sudoku->generatePuzzle($cellCount);
        $puzzle = $sudoku->getPuzzle();
        $this->desk = self::zero2False($puzzle);
        $this->genKeys();

        $sudoku->solve();
        $this->solution = $sudoku->getSolution();

        // Проверяем валидность решения судоку и перегенерим
        while (!$this->isSolutionValid()) {
            $sudoku = new SudokuPuzzle();
            $sudoku->generatePuzzle($cellCount);
            $puzzle = $sudoku->getPuzzle();
            $this->desk = self::zero2False($puzzle);
            $this->genKeys();

            $sudoku->solve();
            $this->solution = $sudoku->getSolution();
        }
    }

    public static function getVertCellValues(int $i, array $desk): array
    {
        $res = [];
        foreach ($desk[$i] as $value) {
            if ($value > 0) {
                $res[$value % 10] = $value % 10;
            }
        }

        return $res;
    }

    public static function getHorCellValues(int $j, array $desk): array
    {
        $res = [];
        foreach ($desk as $i => $column) {
            if ($column[$j] > 0) {
                $res[$column[$j] % 10] = $column[$j] % 10;
            }
        }

        return $res;
    }

    public static function getSquareCellValues(int $i, int $j, array $desk): array
    {
        $res = [];

        $cells = self::getSquareCells($i, $j);

        foreach ($cells as $cell) {
            if ($desk[$cell['i']][$cell['j']] > 0) {
                $res[$desk[$cell['i']][$cell['j']] % 10] = $desk[$cell['i']][$cell['j']] % 10;
            }
        }

        return $res;
    }

    public function getKeyCount(): int
    {
        $keyNum = 0;

        foreach ($this->desk as $i => $column) {
            foreach ($column as $cellValue) {
                if ($cellValue === 0 || $cellValue > 10) {
                    $keyNum++;
                }
            }
        }

        return $keyNum;
    }

    private static function zero2False(array $puzzle): array
    {
        foreach ($puzzle as $rowNum => $row) {
            foreach ($row as $num => $cellValue) {
                if ($cellValue === 0) {
                    $puzzle[$rowNum][$num] = false;
                }
            }
        }

        return $puzzle;
    }

    /**
     * Открывает ячейки, которые очевидны - 8 из 9 в ряд или в квадрате 3х3
     */
    private function openCellsCascades(int &$numCellsSolved)
    {
        $cellsRowCount = count($this->desk);

        // Прогоняем каскадную проверку по всей доске не более 81 раза (9**2)
        for ($cycle = 0; $cycle <= $cellsRowCount ** 2; $cycle++) {
            $cells = [];

            // Получаем все неоткрытые клетки
            foreach ($this->desk as $i => $column) {
                foreach ($column as $j => $cellValue) {
                    if ($cellValue === false) {
                        $cells[] = ['i' => $i, 'j' => $j];
                    }
                }
            }

            $cellOpen = false;

            foreach ($cells as $cell) {
                // Проверяем по вертикали
                $vertOpen = 0;
                for ($i = 0; $i < $cellsRowCount; $i++) {
                    if ($this->desk[$i][$cell['j']] > 0) {
                        $vertOpen++;
                    }
                }

                if ($vertOpen === $cellsRowCount - 1) {
                    $this->desk[$cell['i']][$cell['j']] = $this->solution[$cell['i']][$cell['j']];
                    $cellOpen = true;
                    $numCellsSolved++;

                    continue;
                }

                // Проверяем по горизонтали
                $horOpen = 0;
                foreach ($this->desk[$cell['i']] as $j => $value) {
                    if ($value > 0) {
                        $horOpen++;
                    }
                }

                if ($horOpen === $cellsRowCount - 1) {
                    $this->desk[$cell['i']][$cell['j']] = $this->solution[$cell['i']][$cell['j']];
                    $cellOpen = true;
                    $numCellsSolved++;

                    continue;
                }

                // Проверяем в квадрате
                $squareOpen = 0;
                $squareCells = self::getSquareCells($cell['i'], $cell['j']);
                foreach ($squareCells as $squareCell) {
                    if ($this->desk[$squareCell['i']][$squareCell['j']] > 0) {
                        $squareOpen++;
                    }
                }

                if ($squareOpen === $cellsRowCount - 1) {
                    $this->desk[$cell['i']][$cell['j']] = $this->solution[$cell['i']][$cell['j']];
                    $cellOpen = true;
                    $numCellsSolved++;

                    continue;
                }
            }

            // Если на предыдущем цикле не было открыто ни одного квадрата, то прерываем цикл
            if (!$cellOpen) {
                break;
            }
        }
    }

    /**
     * Определяет, можно ли открыть ключ на присланной изменненной доске
     * @return bool
     */
    public function newSolvedKey(int &$numCellsSolved): bool
    {
        $this->openCellsCascades($numCellsSolved);

        // может быть открыто несколько ключей - вызываем несколько раз из Game
        $keyCells = [];

        foreach ($this->desk as $i => $column) {
            foreach ($column as $j => $cellValue) {
                if ($cellValue === 0) {
                    $keyCells[] = ['i' => $i, 'j' => $j];
                }
            }
        }

        foreach ($keyCells as $keyCell) {
            // Проверяем по вертикали
            $numCellsVertOpen = 0;
            for ($i = 0; $i < count($this->desk); $i++) {
                if ($this->desk[$i][$keyCell['j']] > 0) {
                    $numCellsVertOpen++;
                }
            }

            if ($numCellsVertOpen === (count($this->desk) - 1)) {
                $this->desk[$keyCell['i']][$keyCell['j']] = $this->solution[$keyCell['i']][$keyCell['j']] + 10;

                return true;
            }

            // Проверяем по горизонтали
            $numCellsHorOpen = 0;
            foreach ($this->desk[$keyCell['i']] as $j => $value) {
                if ($value > 0) {
                    $numCellsHorOpen++;
                }
            }

            if ($numCellsHorOpen === (count($this->desk) - 1)) {
                $this->desk[$keyCell['i']][$keyCell['j']] = $this->solution[$keyCell['i']][$keyCell['j']] + 10;

                return true;
            }

            // Проверяем в квадрате
            $numCellsSquareOpen = 0;
            $squareCells = self::getSquareCells($keyCell['i'], $keyCell['j']);
            foreach ($squareCells as $cell) {
                if ($this->desk[$cell['i']][$cell['j']] > 0) {
                    $numCellsSquareOpen++;
                }
            }

            if ($numCellsSquareOpen === (count($this->desk) - 1)) {
                $this->desk[$keyCell['i']][$keyCell['j']] = $this->solution[$keyCell['i']][$keyCell['j']] + 10;

                return true;
            }
        }

        return false;
    }

    /**
     * Определяет, валидно ли решение правилам судоку
     * @return bool
     */
    private function isSolutionValid(): bool
    {
        $cells = [];

        foreach ($this->desk as $i => $column) {
            foreach ($column as $j => $cellValue) {
                $cells[] = ['i' => $i, 'j' => $j];
            }
        }

        foreach ($cells as $cell) {
            // Проверяем по вертикали
            $cellValues = self::CELL_VALUES;
            for ($i = 0; $i < count($this->desk); $i++) {
                unset($cellValues[$this->solution[$i][$cell['j']]]);
            }

            if (count($cellValues) !== 0) {
                return false;
            }

            // Проверяем по горизонтали
            $cellValues = self::CELL_VALUES;
            foreach ($this->solution[$cell['i']] as $j => $value) {
                unset($cellValues[$this->solution[$cell['j']][$j]]);
            }

            if (count($cellValues) !== 0) {
                return false;
            }

            // Проверяем в квадрате
            $cellValues = self::CELL_VALUES;
            $squareCells = self::getSquareCells($cell['i'], $cell['j']);
            foreach ($squareCells as $squareCell) {
                unset($cellValues[$this->solution[$squareCell['i']][$squareCell['j']]]);
            }

            if (count($cellValues) !== 0) {
                return false;
            }
        }

        return true;
    }

    public function unopenedCellsCount(): int
    {
        $res = 0;

        foreach ($this->desk as $row) {
            foreach ($row as $cell) {
                if ($cell === false) {
                    $res++;
                }
            }
        }

        return $res;
    }

    public function hasUnopenedCells(): bool
    {
        foreach ($this->desk as $row) {
            foreach ($row as $cell) {
                if ($cell === false) {
                    return true;
                }
            }
        }

        return false;
    }

    /**
     * Сравнивает новую доску с текущей и сохраняет присланную цифру, если проверка верная
     * @param array $newDesk
     * @return bool
     */
    public function checkNewDesc(array $newDesk): bool
    {
        foreach ($newDesk as $i => $column) {
            foreach ($column as $j => $cell) {
                if ($this->desk[$i][$j] === 0 && $cell[1] !== 0) {
                    // Прислали измененную ячейку ключа
                    return false;
                }

                if (!$this->equivalentCells($cell, $this->desk[$i][$j])) {
                    if (isset($this->newEntity)) {
                        return false;
                    }

                    $this->newEntity = $cell[1];
                    $this->newEntityI = $i;
                    $this->newEntityJ = $j;
                }
            }
        }

        return isset($this->newEntity);
    }

    /**
     * Проверяет, что прислданная цифра соответствует задаче судоку и вставляет ее в доску
     * @return bool
     */
    public function checkNewDigit(int &$numCellsSolved): string
    {
        $res = self::TURN_MISTAKE_RESPONSE;

        if ($this->checkij($this->newEntityI, $this->newEntityJ, $this->newEntity)) {
            $this->desk[$this->newEntityI][$this->newEntityJ] = $this->newEntity;
            $res = self::TURN_CORRECT_RESPONSE;
            $numCellsSolved++;

            if ($this->newSolvedKey($numCellsSolved)) {
                $res = self::KEY_SOLVED_RESPONSE;
            }
        } else {
            $this->mistakes[$this->newEntityI][$this->newEntityJ][$this->newEntity] = $this->newEntity;
        }

        // Стираем данные новой присланной сущности
        unset($this->newEntity);
        unset($this->newEntityI);
        unset($this->newEntityJ);

        return $res;
    }

    public function checkij(int $i, int $j, int $value): bool
    {
        return ((int)$this->solution[$i][$j]) === $value;
    }

    private function genKeys()
    {
        $numOpen = 0;
        foreach ($this->desk as $column) {
            foreach ($column as $cellValue) {
                if ($cellValue) {
                    $numOpen++;
                }
            }
        }

        // Рассчитаем число клеток-ключей
        $numKeys = round($numOpen / 5);
        if (($numKeys % 2) === 0) {
            $numKeys += 1;
        }

        // Расставим ключи
        $numCellsKeys = 0;
        while ($numCellsKeys < $numKeys) {
            foreach ($this->desk as $i => $column) {
                foreach ($column as $j => $cellValue) {
                    if ($cellValue && (mt_rand(1, 1000) < 200)) { // С вероятностью 1/5 ставим ключ
                        $this->desk[$i][$j] = 0; // Поставили ключ
                        $numCellsKeys += 1;

                        if ($numCellsKeys == $numKeys) {
                            break 3;
                        }
                    }
                }
            }
        }
    }

    /**
     * Определяет координаты квадрата, к которому принадлежит ячейка i,j
     * @param $i
     * @param $j
     * @return array
     */
    public static function getSquareCells($i, $j): array
    {
        $iSquare = floor($i / 3);
        $jSquare = floor($j / 3);

        $res = [];

        for ($k = 0; $k < 3; $k++) {
            for ($l = 0; $l < 3; $l++) {
                $res[] = ['i' => $k + $iSquare * 3, 'j' => $l + $jSquare * 3];
            }
        }

        return $res;
    }
}
