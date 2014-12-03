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
            $data = Hash::insert($data, 'Game.status', 'standby');
            $this->Game->create();
            if ($this->Game->save($data)) {
                $this->Session->setFlash('ゲームが追加されました');
                return $this->redirect(array('controller' => 'scoreboard'));
            }
        }
    }

    public function switch_side() {
      $this->autoRender = false;

      if ($this->request->is('post')) {
        if ($this->Game->save($this->request->data)) {
          $this->Session->setFlash(__('先攻後攻を入れ替えました'));
        } else {
          $this->Session->setFlash(__('先攻後攻の入れ替えができませんでした'));
        }
        $this->redirect(array('controller' => 'scoreboard', 'action' => 'edit', $this->request->data['Game']['id']));
      }
    }

    public function end() {
      $this->autoRender = false;

      if ($this->request->is('post')) {
        $data = $this->request->data;
        $data = Hash::insert($data, 'Game.status', 'finished');
        if ($this->Game->save($data)) {
          $this->Session->setFlash(__('試合を終了しました'));
        } else {
          $this->Session->setFlash(__('試合を終了できませんでした'));
        }
        $this->redirect(array('controller' => 'scoreboard', 'action' => 'edit', $this->request->data['Game']['id']));
      }
    }

    public function delete() {
      $this->autoRender = false;

      if ($this->request->is('post')) {
        if ($this->Game->delete($this->request->data['Game']['id'])) {
          $this->Session->setFlash(__('試合を削除しました'));
        } else {
          $this->Session->setFlash(__('試合を削除できませんでした'));
        }
        $this->redirect(array('controller' => 'scoreboard', 'action' => 'index'));
      }
    }

    public function start() {
      $this->autoRender = false;

      if ($this->request->is('post')) {
        $data = $this->request->data;
        $data = Hash::insert($data, 'Game.status', 'playing');
        if ($this->Game->save($data)) {
          $this->Session->setFlash(__('試合を開始しました'));
        } else {
          $this->Session->setFlash(__('試合を開始できませんでした'));
        }
        $this->redirect(array('controller' => 'scoreboard', 'action' => 'edit', $this->request->data['Game']['id']));
      }
    }
}
