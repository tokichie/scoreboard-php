<?php $this->Html->css('scoreboard/index', array('inline' => false)); ?>
<ul data-role="listview">
  <?php foreach ($games as $game): ?>
  <li>
    <?php if ($game['Game']['status'] == 'standby'): ?>
      <a class="standby" href="scoreboard/edit/<?php echo $game['Game']['id'] ?>">
      <div class="row">
        <div class="column team_name"><?php echo $game['Game']['team1']?></div>
        <div class="column">-</div>
        <div class="column team_name"><?php echo $game['Game']['team2']?></div>
      </div>
      </a>
    <?php else: ?>
      <a class="playing" href="scoreboard/edit/<?php echo $game['Game']['id'] ?>">
      <div class="row">
        <div class="column score_">3</div>
        <div class="column score_">5</div>
      </div>
      <div class="row">
        <div class="column team_name"><?php echo $game['Game']['team1']?></div>
        <div class="column team_name"><?php echo $game['Game']['team2']?></div>
      </div>
      </a>
    <?php endif; ?>
  </li> 
  <?php endforeach ?>
</ul>
