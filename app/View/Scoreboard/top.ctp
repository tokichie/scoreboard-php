<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>jQuery Mobile</title>
<?php 
$this->html->css('jquery.mobile-1.4.5.min');
$this->html->script('jquery-1.11.1.min');
$this->html->script('jquery.mobile-1.4.5.min');
?>
</head>
<body>

<!--ページ領域-->
<div data-role="page" data-title="jQuery Mobile TIPS">

  <!--ヘッダー領域-->
  <div data-role="header">
    <h1>jQuery Mobile TIPS</h1>
  </div>

  <div role="main" class="ui-content">
  ここが本文です。
  </div>

  <div data-role="footer">
    <h3>Copyright 1998-2014, YAMADA.Yoshihiro</h3>
  </div>

</div>

</body>
</html>
