<?php

App::uses('AppController', 'Controller');

class GamesController extends AppController {
    var $uses = array('Game');

    public function add() {
    }

    public function add_game() {
        $this->autoRender = false;

        if ($this->request->is('post')) {
            $data = $this->request->data;
            $data = Hash::insert($data, 'Game.status', 'playing');
            $this->Game->create();
            if ($this->Game->save($data)) {
                $this->Session->setFlash('ゲームが追加されました');
                return $this->redirect(array('controller' => 'scoreboard'));
            }
        }
    }
}
