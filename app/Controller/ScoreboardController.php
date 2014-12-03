<?php

App::uses('AppController', 'Controller');

class ScoreboardController extends AppController {
  public $uses = array('Game', 'User');

  public function beforeFilter() {
    parent::beforeFilter();
    $this->Auth->allow('login', 'logout', 'edit');
  }

  public function index() {
    $games = $this->Game->find('all');
    $games_by_status = array(
      'standby' => array(),
      'playing' => array(),
      'finished' => array()
    );
    $timestamps = array(
      'standby' => array(),
      'playing' => array(),
      'finished' => array()
    );
    foreach ($games as $game) {
      $status = $game['Game']['status'];
      $games_by_status[$status][] = $game;
      if ($status == 'standby') {
        $timestamps[$status][] = $game['Game']['start_time'];
      } else {
        $timestamps[$status][] = $game['Game']['modified'];
      }
    }

    array_multisort($timestamps['standby'], SORT_ASC, $games_by_status['standby']);
    array_multisort($timestamps['playing'], SORT_DESC, $games_by_status['playing']);
    array_multisort($timestamps['finished'], SORT_DESC, $games_by_status['finished']);

    $games = array_merge(
      array(0 => array('divider' => 'standby')),
      $games_by_status['standby'],
      array(1 => array('divider' => 'playing')),
      $games_by_status['playing'],
      array(2 => array('divider' => 'finished')),
      $games_by_status['finished']
    );
    $this->set('games', $games);
    $this->set('locations', $this->Game->locations);
    $this->set('user', $this->Auth->user());
  }

  public function add() {
    $this->set('locations', $this->Game->locations);
    $this->set('user', $this->Auth->user());
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
    $this->set('game', Hash::get($game, '0.Game'));
    $this->set('scores', $scores);
    $this->set('game_id', $id);
    $this->set('user', $this->Auth->user());
  }

  public function login() {
    if ($this->Auth->user()) {
      $this->Session->setFlash(__('既にログイン中です'));
      return $this->redirect($this->Auth->redirect());
    }

    if ($this->request->is('post')) {
      if ($this->Auth->login()) {
        $this->redirect($this->Auth->redirect());
      } else {
        $this->Session->setFlash(__('ユーザー名またはパスワードが間違っています'));
      }
    }
    $this->set('user', $this->Auth->user());
  }

  public function logout() {
    $this->Auth->logout();
    $this->Session->destroy();
    $this->Session->setFlash(__('ログアウトしました'));
    $this->redirect(array('action' => 'index'));
  }

}
