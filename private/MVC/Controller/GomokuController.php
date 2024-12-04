<?php

use classes\FrontResource;
use classes\FrontResourceGomoku;
use classes\StateMachine;
use classes\GomokuGame;

class GomokuController extends BaseController
{
    const TITLE = "Gomoku online | X-0";
    const URL = "https://xn--d1aiwkc2d.club/gomoku/";
    const SITE_NAME = "5-5.su/gomoku";
    const DESCRIPTION ='Gomoku, also called Five in a Row, is an abstract strategy board game. It is traditionally played with Go pieces (black and white stones) on a 15×15 Go board. Because pieces are typically not moved or removed from the board, gomoku may also be played as a paper-and-pencil game.';
    const FB_IMG_URL = "https://xn--d1aiwkc2d.club/img/share/hor_640_360.png";

    const VIEW_PATH = parent::VIEW_PATH . 'Gomoku/';

    const COOKIE_KEY = 'gomoku_player_id';

    public function __construct($action, array $request)
    {
        BaseController::$SM = new StateMachine(self::COOKIE_KEY, GomokuGame::GAME_NAME);
        BaseController::$FR = new FrontResourceGomoku();

        parent::__construct($action, $request);

        $this->Game = new GomokuGame();
    }

    public function Run(): string
    {
        return parent::Run();
    }
}