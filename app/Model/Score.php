<?php
App::uses('AppModel', 'Model');

class Score extends AppModel {
  public $name = 'Score';
  public $useTable = 'scores';

  public $belongsTo = array(
    'Game' => array(
      'className' => 'Game',
      'foreignKey' => 'game_id'
    )
  );

  public $validate = array(
    'score' => array(
      'rule' => array('naturalNumber', true),
      'message' => '0以上の整数を入力してください',
      'allowEmpty' => false
    )
  );
}
