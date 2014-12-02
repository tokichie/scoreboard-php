<ul data-role="listview">
    <?php foreach ($games as $game): ?>
    <li>
        <?php echo $this->Html->link(
            $game['Game']['team1'] . ' - ' . $game['Game']['team2'],
            array('controller' => 'scoreboard', 'action' => 'edit', $game['Game']['id'])
        );
        ?>
        </a>
    </li> 
    <?php endforeach ?>
</ul>
