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
    'score' => 'numeric'
  );
}
