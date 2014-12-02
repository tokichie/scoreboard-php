<?php

App::uses('AppController', 'Controller');

class ScoreboardController extends AppController {
    public $uses = array('Game');

    public function index() {
        $games = $this->Game->find('all');
        $this->log($games, 'debug');
        $this->set('games', $games);
    }

    public function add() {
    }

    public function add_game() {
        $this->autoRender = false;

        if ($this->request->is('post')) {
            if ($this->Game->save($this->request->data)) {
                $this->Session->setFlash('ゲームが追加されました');
                return $this->redirect(array('controller' => 'scoreboard'));
            }
        }
    }

    public function edit($id = null) {
        if ($id === null) return;

        $game = $this->Game->find(
            'all',
            array(
                'conditions' => array('id' => $id)
            )
        );
        $scores = Hash::combine($game, '{n}.Score.{n}.inning', '{n}.Score.{n}.score', '{n}.Score.{n}.side');
        $this->log($scores, 'debug');
        $this->set('game', Hash::get($game, '0.Game'));
        $this->set('scores', $scores);
    }
}
