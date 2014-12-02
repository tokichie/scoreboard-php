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
?>

<table width="100%">
    <td></td>
    <?php for ($i = 1; $i <= 10; $i++): ?>
    <td><?php ($i < 10) ? print($i) : print('R')  ?></td>
    <?php endfor; ?>
    <tr>
    <td class="team_name"><?php echo $game['team1']?></td>
    <?php for ($i = 1; $i <= 9; $i++): ?>
    <td>
    <?php if (array_key_exists($i, $scores['t'])): ?>
      <?php echo $this->Html->link(
        $scores['t'][$i],
        '#',
        array(
          'class' => 'add_score',
          'value' => 't' . $i,
        )
      );
      ?>
    <?php else: ?>
        <?php if ($next_inning == $i and $next_inning_side == 't'): ?>
<?php echo $this->Html->link(
  '+',
  '#',
  array('class' => 'ui-btn add_score')
); ?>
        <?php endif; ?>
    <?php endif; ?>
    </td>
    <?php endfor; ?>
    <tr>
    <td class="team_name"><?php echo $game['team2']?></td>
    <?php for ($i = 1; $i <= 9; $i++): ?>
    <td>
    <?php if (array_key_exists($i, $scores['b'])): ?>
      <?php echo $this->Html->link(
        $scores['b'][$i],
        '#',
        array(
          'class' => 'add_score',
          'value' => 'b' . $i,
        )
      );
      ?>
    <?php else: ?>
      <?php if ($next_inning == $i and $next_inning_side == 'b'): ?>
        <?php echo $this->Html->link(
          '+',
          '#',
          array(
            'class' => 'ui-btn ui-corner-all add_score',
          )
        ); ?>
      <?php endif; ?>
    <?php endif; ?>
    </td>
    <?php endfor; ?>
</table>

<div id="edit_score">
  <?php 
  if ($next_inning < 10) {
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
    echo $this->Form->end('add');
    //echo $this->Form->button('add', 
    //  array(
    //    'class' => 'add_btn'
    //  ));
  }
  ?>
</div>

