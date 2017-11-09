<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="keywords" content="News, Blogs, Businesses, Jobs, Sports, Events,Lifesyle and more" />
<meta name="description" content="Sirenghana.com is a multipurpose website portal that provide online contents and services in Ghana." />
<meta name="author" content="Rasarp Multimedia Systems - Ghana" />
<?php echo $template->getPage("Meta")?>
<?php echo $template->getPage("Stylesheet")?>
<link rel="stylesheet" media="screen,projection" href="templates/blue_ice/_css/main.css" />
<!--[if IE]>
<link href="templates/stylesheets/default/ie5+.css" rel="stylesheet" type="text/css">
<![endif]-->
<title><?php echo $template->getPage("Title") ?></title>
</head>
<body>
<div id="wrapper">
<!--// CONTENT HEADER //-->
<header id="header">
<div id="logo"><!--logo-->
<img src="templates/blue_ice/_images/logo.png" alt="Sirenghana Logo" />
</div>
<?php echo $template->getPage("PageHeader") ?>
</header>
<!--//MENU OR NAV AREA//-->
<nav id="wrap_menu">
<?php  echo  $template->getPage("MainNav") ?>
</nav>
<!--//MENU OR NAV AREA//-->
<!--//BANNER AREA //-->
<section id="banner_rotator">&nbsp; Banner</section>
<!--//BANNER AREA //-->
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