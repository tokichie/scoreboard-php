<?php

App::uses('AppController', 'Controller');

class ScoreboardController extends AppController {

    public function index() {
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
}
