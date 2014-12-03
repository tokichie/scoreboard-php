<?php 
echo $this->Html->css('scoreboard/edit');
echo $this->Html->script('scoreboard/edit');

if (!array_key_exists('t', $scores)) {
  $scores = array('t' => array(), 'b' => array());
  $next_inning = 1;
  $next_inning_side = 't';
} else if (!array_key_exists('b', $scores)) {
  $scores += array('b' => array());
  $next_inning = 1;
  $next_inning_side = 'b';
} else {
  $next_inning = max(array_keys($scores['t']));
  if (max(array_keys($scores['t'])) > max(array_keys($scores['b']))) {
    $next_inning_side = 'b';
  } else {
    $next_inning_side = 't';
    $next_inning++;
  }
}
$t_sum = array_sum($scores['t']);
$b_sum = array_sum($scores['b']);
?>

<table width="100%">
    <td></td>
    <?php for ($i = 1; $i <= 4; $i++): ?>
    <td><?php ($i < 4) ? print($i) : print('R')  ?></td>
    <?php endfor; ?>
    <tr>
    <td class="team_name"><?php echo $game['team1']?></td>
    <?php for ($i = 1; $i <= 4; $i++): ?>
    <td name="<?php ($i == 4) ? print('tR') : print('t' . $i)?>">
    <?php if ($user and $game['status'] == 'playing'): ?>
      <?php if (array_key_exists($i, $scores['t'])): ?>
        <?php /*echo $this->Html->link(
          $scores['t'][$i],
          '#',
          array(
            'class' => 'add_score',
            'value' => 't' . $i,
          )
        ); */
          echo $scores['t'][$i];
        ?>
      <?php elseif ($i < 4) : ?>
        <?php if ($next_inning == $i and $next_inning_side == 't'): ?>
          <?php /*echo $this->Html->link(
            '+',
            '#',
            array('class' => 'ui-btn add_score')
          );*/ ?>
        <?php endif; ?>
      <?php else: ?>
        <?php if ($t_sum > $b_sum and $game['status'] == 'finished'): ?>
          <b><?php echo $t_sum ?></b>
        <?php else: ?>
          <?php echo $t_sum ?>
        <?php endif ?>
      <?php endif ?>
    <?php else: ?>
      <?php if ($i < 4): ?>
        <?php if (array_key_exists($i, $scores['t'])): ?>
          <?php echo $scores['t'][$i] ?>
        <?php endif ?>
      <?php else: ?>
        <?php if ($t_sum > $b_sum and $game['status'] == 'finished'): ?>
          <b><?php echo $t_sum ?></b>
        <?php else: ?>
          <?php echo $t_sum ?>
        <?php endif ?>
      <?php endif ?>
    <?php endif ?>
    </td>
    <?php endfor ?>
    <tr>
    <td class="team_name"><?php echo $game['team2']?></td>
    <?php for ($i = 1; $i <= 4; $i++): ?>
    <td name="<?php ($i == 4) ? print('bR') : print('b' . $i)?>">
    <?php if ($user and $game['status'] == 'playing'): ?>
      <?php if (array_key_exists($i, $scores['b'])): ?>
        <?php /*echo $this->Html->link(
          $scores['b'][$i],
          '#',
          array(
            'class' => 'add_score',
            'value' => 'b' . $i,
          )
        );*/
          echo $scores['b'][$i];
        ?>
      <?php elseif ($i < 4): ?>
        <?php if ($next_inning == $i and $next_inning_side == 'b'): ?>
          <?php /*echo $this->Html->link(
            '+',
            '#',
            array(
              'class' => 'ui-btn ui-corner-all add_score',
            )
          );*/ ?>
        <?php endif; ?>
      <?php else: ?>
        <?php if ($b_sum > $t_sum and $game['status'] == 'finished'): ?>
          <b><?php echo $b_sum ?></b>
        <?php else: ?>
          <?php echo $b_sum ?>
        <?php endif ?>
      <?php endif ?>
    <?php else: ?>
      <?php if ($i < 4): ?>
        <?php if (array_key_exists($i, $scores['b'])): ?>
          <?php echo $scores['b'][$i] ?>
        <?php endif ?>
      <?php else: ?>
        <?php if ($b_sum > $t_sum and $game['status'] == 'finished'): ?>
          <b><?php echo $b_sum ?></b>
        <?php else: ?>
          <?php echo $b_sum ?>
        <?php endif ?>
      <?php endif ?>
    <?php endif ?>
    </td>
    <?php endfor ?>
</table>
<div class="game_info">
<?php if ($game['status'] == 'standby'): ?>
この試合は<?php echo date('G:i', strtotime($game['start_time']))?>に開始されます
<?php endif ?>
<?php if ($game['status'] == 'finished'): ?>
この試合は<?php echo date('G:i', strtotime($game['modified']))?>に終了しました
<?php endif ?>
</div>


<?php if ($user): ?> 
  <?php if ($next_inning < 4): ?>
    <?php if ($game['status'] == 'playing'): ?>
    <div id="edit_score">
      <?php 
        echo $this->Form->create('Score',
          array(
            'type' => 'post',
            'action' => 'add'
          ));
        echo $this->Form->input('game_id',
          array(
            'type' => 'hidden',
            'value' => $game_id
          ));
        echo $this->Form->input('inning',
          array(
            'type' => 'hidden',
            'value' => $next_inning
          ));
        echo $this->Form->input('side',
          array(
            'type' => 'hidden',
            'value' => $next_inning_side
          ));
        echo $this->Form->input('score',
          array(
            'type' => 'text',
            'label' => $next_inning . '回' . (($next_inning_side == 't') ? '表: ' : '裏: '),
            'class' => 'score'
          ));
        echo $this->Form->end('＋');
            
      ?>      
    </div>
    <div>
    <?php
        echo $this->Form->create('Game',
          array(
            'type' => 'post',
            'action' => 'end',
          ));
        echo $this->Form->input('id',
          array(
            'type' => 'hidden',
            'value' => $game_id
          ));
        echo $this->Form->button('試合終了',
          array(
            'class' => 'end_game'
          ));
        echo $this->Form->end();
    ?>
    </div>
    <?php endif ?>
  <?php endif ?>
  <?php if ($game['status'] != 'standby'): ?>
  <div>
  <?php
      echo $this->Form->create('Game',
        array(
          'type' => 'post',
          'action' => 'delete',
        ));
      echo $this->Form->input('id',
        array(
          'type' => 'hidden',
          'value' => $game_id
        ));
      echo $this->Form->button('試合削除',
        array(
          'class' => 'delete_game'
        ));
      echo $this->Form->end();
  ?>
  </div>
  <?php endif ?>
  <?php if ($game['status'] == 'standby'): ?>
  <div>
  <?php
      echo $this->Form->create('Game',
        array(
          'type' => 'post',
          'action' => 'start',
        ));
      echo $this->Form->input('id',
        array(
          'type' => 'hidden',
          'value' => $game_id
        ));
      echo $this->Form->button('試合開始',
        array(
          'class' => 'start_game'
        ));
      echo $this->Form->end();
  ?>
  </div>
  <?php endif ?>
<?php endif ?>
