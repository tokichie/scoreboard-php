<?php
echo $this->Html->css('jqm-datebox-1.4.5.min', array('inline' => false));
echo $this->Html->script('jqm-datebox.core', array('inline' => false));
echo $this->Html->script('jqm-datebox.mode.flipbox', array('inline' => false));

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
    'data-options' => '{"mode":"timeflipbox"}',
  ));

echo $this->Form->input('end_time',
  array(
    'type' => 'text',
    'label' => '終了予定時刻',
    'data-role' => 'datebox',
    'data-options' => '{"mode":"timeflipbox"}',
  ));
?>


<?php echo $this->Form->end('追加'); ?>
