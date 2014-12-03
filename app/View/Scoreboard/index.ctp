<?php $this->Html->css('scoreboard/index', array('inline' => false)); ?>
<ul data-role="listview">
  <?php foreach ($games as $game): ?>
  <li>
    <?php if ($game['Game']['status'] == 'standby'): ?>
      <a class="standby" href="/cakephp/scoreboard/edit/<?php echo $game['Game']['id'] ?>">
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
      <a class="playing" href="/cakephp/scoreboard/edit/<?php echo $game['Game']['id'] ?>">
      <div class="info_container">
        <div class="team_info">
          <div class="row score"><p class="score">3</p></div>
          <div class="row team_name"><p class="team_name"><?php echo $game['Game']['team1']?></p></div>
        </div>
        <div class="team_info status"><p class="hyphen"><?php ($game['Game']['status'] == 'finished') ? print('試合終了') : print('試合中') ?><br>会場<?php echo substr($locations[$game['Game']['location']], 7)?></p>
        </div>
        <div class="team_info">
          <div class="row score"><p class="score">5</p></div>
          <div class="row team_name"><p class="team_name"><?php echo $game['Game']['team2']?></div>
        </div>
      </div>
      </a>
    <?php endif; ?>
  </li> 
  <?php endforeach ?>
</ul>
