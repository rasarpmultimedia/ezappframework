<!DOCTYPE html>
<html lang="en">
<head >
<meta charset="utf-8">
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta name="author" content="Rasarp Multimedia Systems - Ghana" />
<meta name="viewport" content="width=device-width; initial-scale=1.0" />
<link rel="stylesheet" media="screen,projection" href="../../../app/_template/blue_ice/_css/main.css" />
<!--[if IE]>
<link href="../templates/stylesheets/default/ie5+.css" rel="stylesheet" type="text/css">
<![endif]-->
<!--<script src="../templates/_scripts/jquery.js"> </script>-->
<title><?php echo $template->getPage("Title")?></title>
</head>
<body>
<div id="wrapper">
<!--// CONTENT HEADER //-->
<header id="header">
<div id="logo"><!--logo-->
<img src="../../../app/_template/blue_ice/_images/logo.png" alt="Logo" />
</div>
<?php echo $template->getPage("PageHeader") ?>
</header>
<!--//MENU OR NAV AREA//-->
<nav id="admin_menu_wrap">
<?php  echo  $template->getPage("MainNav") ?>
</nav>
<!--//MENU OR NAV AREA//-->
<!--//SIDE BAR AREA //-->
<section id="aside_left"><?php  echo $template->getPage("AsideLeft") ?></section>
<section id="aside_right"><?php echo $template->getPage("AsideRight")?></section>
<!--//SIDE BAR AREA //-->
<!--// CONTENT AREA STARTS//-->
<section id="content">
	<article>
	 <?php echo $template->getPage("Content") ?>
	</article>
</section>
<!--// CONTENT AREA ENDS//-->
<!--//FOOTER AREA //-->
<footer id="footer">
	<?php echo $template->getPage("Footer") ?>
</footer>
</div>
<?php echo $template->getPage("Script"); ?>
</body>
</html>