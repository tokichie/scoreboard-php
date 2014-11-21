<?php
echo $this->Form->create('Game',
    array(
        'type' => 'post',
        'action' => 'add_game'
    ));

echo $this->Form->input('team1',
    array(
        'type' => 'text',
        'label' => '先攻チーム名',
    ));

echo $this->Form->input('team2',
    array(
        'type' => 'text',
        'label' => '後攻チーム名',
    ));

echo $this->Form->end('追加');
?>
