<?php

App::uses('AppController', 'Controller');

class ScoresController extends AppController {
  public $uses = array('Score');

  public function add() {
    $this->autoRender = false;
    if ($this->request->is('post')) {
      $data = $this->request->data;
      if ($data['Score']['inning'] == '1' and $data['Score']['side'] == 't') {
        $data += array(
          'Game' => array(
            'id' => $data['Score']['game_id'],
            'status' => 'playing',
          )
        );
      }
      if ($data['Score']['inning'] == '3' and $data['Score']['side'] == 'b') {
        $data += array(
          'Game' => array(
            'id' => $data['Score']['game_id'],
            'status' => 'finished',
          )
        );
      }
      if ($this->Score->saveAssociated($data)) {
        return $this->redirect(array(
          'controller' => 'scoreboard',
          'action' => 'edit',
          $this->request->data['Score']['game_id']
        ));
      }
    }
  }

  public function deleteAll() {
    $this->autoRender = false;
    if ($this->Score->deleteAll(array('Score.id >=' => '1'))) {
      $this->Session->setFlash(__('スコアを全て削除しました'));
    }
    $this->Score->Game->updateAll(
      array('Game.status' => 'standby'),
      array()
    );
    $this->redirect(array('controller' => 'scoreboard', 'action' => 'index'));
  }
}
