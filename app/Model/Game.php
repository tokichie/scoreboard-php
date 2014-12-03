<?php
App::uses('AppModel', 'Model');

class Game extends AppModel {
    public $name = 'Game';
    public $useTable = 'games';

    public $hasMany = array(
        'Score' => array(
            'className' => 'Score',
        )
    );

    public $locations = array(
      0 => 'Ground A',
      1 => 'Ground B',
      2 => 'Ground C',
      3 => 'Ground D',
      4 => 'Ground E',
    );
}
