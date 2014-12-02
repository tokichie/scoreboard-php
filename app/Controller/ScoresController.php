<?php

App::uses('AppController', 'Controller');

class ScoresController extends AppController {
  public $uses = array('Score');

  public function add() {
    $this->autoRender = false;
    $this->log($this->data, 'debug');
    if ($this->request->is('post')) {
      if ($this->Score->save($this->request->data)) {
        return $this->redirect(array(
          'controller' => 'scoreboard',
          'action' => 'edit',
          $this->request->data['Score']['game_id']
        ));
      }
    }
  }
}
