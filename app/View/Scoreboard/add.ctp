<?php
echo $this->Html->css('jqm-datebox-1.4.5.min');
echo $this->Html->script('jqm-datebox.core');
echo $this->Html->script('jqm-datebox.mode.flipbox');

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

echo $this->Form->input('location',
  array(
    'type' => 'select',
    'label' => '場所',
    'options' => $locations
  ));

echo $this->Form->input('start_time',
  array(
    'type' => 'text',
    'label' => '開始予定時刻',
    'data-role' => 'datebox',
    'data-options' => '{"mode":"timeflipbox", "minHour":7, "maxHour":17, "minuteStep":10}',
  ));

echo $this->Form->end('追加'); ?>
