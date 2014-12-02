<?php 
echo $this->Html->css('Scoreboard/edit');

$next_inning = max(array_keys($scores['t']));
if (max(array_keys($scores['t'])) > max(array_keys($scores['b']))) {
    $next_inning_side = 'b';
} else {
    $next_inning_side = 't';
    $next_inning++;
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
    <?php //array_key_exists($i, $scores['t']) ? print($scores['t'][$i]) : null ?>
    <?php if (array_key_exists($i, $scores['t'])): ?>
        <?php echo $scores['t'][$i]; ?>
    <?php else: ?>
        <?php if ($next_inning == $i and $next_inning_side == 't'): ?>
            <?php echo $this->Html->link(
                '+',
                'aa',
                array('class' => 'ui-btn')
            ); ?>
        <?php endif; ?>
    <?php endif; ?>
    </td>
    <?php endfor; ?>
    <tr>
    <td class="team_name"><?php echo $game['team2']?></td>
    <?php for ($i = 1; $i <= 9; $i++): ?>
    <td><?php //array_key_exists($i, $scores['b']) ? print($scores['b'][$i]) : null ?>
    <?php if (array_key_exists($i, $scores['b'])): ?>
        <?php //echo $scores['b'][$i]; ?>
        <?php echo $this->Html->link(
            $scores['b'][$i],
            '#'
            );
        ?>
    <?php else: ?>
        <?php if ($next_inning == $i and $next_inning_side == 'b'): ?>
            <?php echo $this->Html->link(
                '+',
                '#dialog',
                array(
                    'class' => 'ui-btn ui-corner-all ui-btn-a',
                    'data-rel' => 'dialog',
                    'data-transition' => 'pop'
                )
            ); ?>
        <?php endif; ?>
    <?php endif; ?>
    </td>
    <?php endfor; ?>
</table>

<div data-role="page" id="dialog">
    <div data-role="header">
        <h1>点数追加・変更</h1>
    </div>
    <div data-role="content">
    <?php 
    if ($next_inning < 10) {
        echo $this->Form->create('Score', array(
            'method' => 'post',
            'action' => 'add'
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
        echo $this->Form->end('イニング追加');
    }
    ?>
    </div>
</div>

