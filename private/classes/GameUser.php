<?php


namespace classes;


use classes\ViewHelper as VH;

/** @property string $ID */
class GameUser
{
    public string $ID;
    public string $status;
    public bool $isActive = true; // Ставится в false только при полном выходе из игры
    public int $score = 0;
    public array $usernameLangArray = [];
    public string $avatarUrl;
    public int $wishTurnTime = 0;
    public int $lastRequestNum = 0;
    public ?int $lastActiveTime = null;
    public int $inactiveTurn = 1000;
    public int $lostTurns = 0;
    public int $rating = 0;
    public int $common_id;
    public array $logStack = [];
    protected array $comments = [];
    protected array $lastComment = []; // Комментарий на текущем языке юзера отдаем, если comments пуст
    public array $result_ratings = [];
    public array $chatStack = []; // Сообщения чата

    protected array $data = [];

    /**
     * @var mixed|null
     */


    public function __construct(array $params)
    {
        foreach ($params as $attribute => $value) {
            $this->$attribute = $value;
        }
    }

    public function __get($attribute)
    {
        return $this->data[$attribute] ?? null;
    }

    public function __set($attribute, $value)
    {
        return $this->data[$attribute] = $value;
    }

    public function getLastComment(): ?string
    {
        // Готовим последний коммент для каждого языка, а потом отдаем на текущем языке пользователя
        foreach (T::SUPPORTED_LANGS as $lang) {
            $res[$lang] = implode(VH::br(), $this->comments[$lang] ?? []);

            if (!$res[$lang]) {
                $res[$lang] = $this->lastComment[$lang] ?? '';
            } else {
                $this->lastComment[$lang] = $res[$lang];
            }
        }

        $this->comments = [];

        return $res[T::$lang] ?: '&nbsp;';
    }

    public function addComment(string $comment, string $lang)
    {
        if (!isset($this->comments[$lang])) {
            $this->comments[$lang] = [];
        }

        $this->comments[$lang][] = $comment;
    }
}