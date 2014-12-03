<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
$cakeVersion = __d('cake_dev', 'CakePHP %s', Configure::version())
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
	<title>Scoreboard</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('cake.generic');
    echo $this->html->css('jquery.mobile-1.4.5.min');
    echo $this->html->script('jquery-1.11.1.min');
    echo $this->html->script('jquery.mobile-1.4.5.min');

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body>
	<div id="container" data-role="page">
        <div id="header" data-role="header" style="text-align: center">
            Scoreboard
        </div>
		<div id="content" role="main" class="ui-content">

			<?php echo $this->Session->flash(); ?>

			<?php echo $this->fetch('content'); ?>
		</div>
		<div id="footer" data-role="footer">
            <h3>Copyright 2014, tokichie@github</h3>
            <div data-role="navbar">
                <ul>
                    <?php if ($user): ?>
                    <li><a style="color: #000" href="<?php echo $this->Html->url('/', true)?>" class="ui-btn-active">ホーム</a></li>
                    <li><a style="color: #000" href="<?php echo $this->Html->url(array('controller' => 'scoreboard', 'action' => 'add'), true) ?>">試合を追加</a></li>
                    <li><a style="color: #000" href="<?php echo $this->Html->url(array('controller' => 'scoreboard', 'action' => 'logout'), true) ?>">ログアウト</a></li>
                    <?php else: ?>
                    <li><a style="color: #000" href="<?php echo $this->Html->url('/')?>" class="ui-btn-active">ホーム</a></li>
                    <li><a style="color: #000" href="<?php echo $this->Html->url(array('controller' => 'scoreboard', 'action' => 'login')) ?>">ログイン</a></li>
                    <?php endif ?>
                </ul>
            </div>
		</div>
	</div>
	<?php echo $this->element('sql_dump'); ?>
</body>
</html>
