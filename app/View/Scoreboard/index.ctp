<?php $this->Html->css('scoreboard/index', array('inline' => false)); ?>
<ul data-role="listview">
  <?php foreach ($games as $game): ?>
  <?php if (array_key_exists('divider', $game)): ?>
  <li data-role="list-divider">
    <?php if ($game['divider'] == 'standby'): ?>
      開始待ち
    <?php elseif ($game['divider'] == 'playing'): ?>
      試合中
    <?php else: ?>
      試合終了
    <?php endif ?>
  </li>
  <?php else: ?>
  <li>
    <?php if ($game['Game']['status'] == 'standby'): ?>
      <a class="standby" href="<?php echo $this->Html->url(array('controller' => 'scoreboard', 'action' => 'edit', $game['Game']['id'])) ?>">
      <div class="info_container">
        <div class="team_info">
          <div class="row team_name"><p class="team_name"><?php echo $game['Game']['team1']?></p></div>
        </div>
        <div class="team_info status">
          <p class="hyphen">
            <?php echo date('G:i', strtotime($game['Game']['start_time']))?><br>会場<?php echo substr($locations[$game['Game']['location']], 7)?>
          </p>
        </div>
        <div class="team_info">
          <div class="row team_name"><p class="team_name"><?php echo $game['Game']['team2']?></p></div>
        </div>
      </div>
      </a>
    <?php else: ?>
    <?php
    $scores = Hash::combine($game, 'Score.{n}.inning', 'Score.{n}.score', 'Score.{n}.side');
    if (!array_key_exists('t', $scores)) {
      $scores = array('t' => array(), 'b' => array());
    } else if (!array_key_exists('b', $scores)) {
      $scores += array('b' => array());
    }
    $t_sum = array_sum($scores['t']);
    $b_sum = array_sum($scores['b']);
    ?>
      <a class="playing" href="<?php echo $this->Html->url(array('controller' => 'scoreboard', 'action' => 'edit', $game['Game']['id'])) ?>">
      <div class="info_container">
        <div class="team_info">
          <div class="row score"><p class="score"><?php echo $t_sum ?></p></div>
          <div class="row team_name"><p class="team_name"><?php echo $game['Game']['team1']?></p></div>
        </div>
        <div class="team_info status"><p class="hyphen"><?php ($game['Game']['status'] == 'finished') ? print('試合終了') : print('試合中') ?><br>会場<?php echo substr($locations[$game['Game']['location']], 7)?></p>
        </div>
        <div class="team_info">
          <div class="row score"><p class="score"><?php echo $b_sum ?></p></div>
          <div class="row team_name"><p class="team_name"><?php echo $game['Game']['team2']?></div>
        </div>
      </div>
      </a>
    <?php endif; ?>
  </li> 
  <?php endif ?>
  <?php endforeach ?>
</ul>
