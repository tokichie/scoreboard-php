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
}
