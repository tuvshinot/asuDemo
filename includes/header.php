
<?php
	include("classes/Constants.php");


	function removeDots($dir)
	{
    	return array_values(array_diff(scandir($dir), array('..', '.')));
	}

	function sanitizeFile($arr) {
		$ar = array();

		foreach($arr as $arrElement) {
			array_push($ar, str_replace(".zip", "", $arrElement));
		}

		return $ar;
	}

	$subNames = array(
		Constants::$aparat,
		Constants::$architect,
		Constants::$db,
		Constants::$dismath,
		Constants::$secureInfo,
		Constants::$imiModSys,
		Constants::$integInfo,
		Constants::$comGraph,
		Constants::$comInfoTech,
		Constants::$crypto,
		Constants::$mathModel,
		Constants::$methodComInfo,
		Constants::$oop,
		Constants::$os,
		Constants::$fundAlgor,
		Constants::$fundSecInfo,
		Constants::$proAutoSys,
		Constants::$netTele,
		Constants::$ssw,
		Constants::$sysAnaly,
		Constants::$sysAnaOpe,
		Constants::$moderSys,
		Constants::$FaciHumTech,
		Constants::$theoryInfo,
		Constants::$expSys
	);

	$diplomas = array(
		Constants::$oop,
		Constants::$os,
		Constants::$fundAlgor,
		Constants::$fundSecInfo,
		Constants::$proAutoSys,
		Constants::$netTele,
		Constants::$ssw,
		Constants::$sysAnaly,
		Constants::$sysAnaOpe,
		Constants::$moderSys,
		Constants::$FaciHumTech,
		Constants::$theoryInfo,
		Constants::$expSys
	);

	$otherSub = array(
		Constants::$ssw,
		Constants::$sysAnaly,
		Constants::$sysAnaOpe,
		Constants::$moderSys,
		Constants::$FaciHumTech,
		Constants::$theoryInfo,
		Constants::$expSys
	);

?>




<!DOCTYPE html>
<html lang="en">
<head>
<title>Кафедра АСУ</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="Course Project">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="../styles/bootstrap4/bootstrap.min.css">
<link href="../plugins/fontawesome-free-5.0.1/css/fontawesome-all.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="../styles/courses_styles.css">
<link rel="stylesheet" type="text/css" href="../styles/courses_responsive.css">
<link rel="stylesheet" type="text/css" href="../styles/style.css">
<link rel="stylesheet" type="text/css" href="../styles/card.css">
<link rel="stylesheet" type="text/css" href="../styles/elements_styles.css">
<!-- favicon -->
    <link rel="apple-touch-icon" sizes="57x57" href="../images/favi/apple-touch-icon-57x57.png" />
    <link rel="apple-touch-icon" sizes="114x114" href="../images/favi/apple-touch-icon-114x114.png" />
    <link rel="apple-touch-icon" sizes="72x72" href="../images/favi/apple-touch-icon-72x72.png" />
    <link rel="apple-touch-icon" sizes="144x144" href="../images/favi/apple-touch-icon-144x144.png" />
    <link rel="apple-touch-icon" sizes="60x60" href="../images/favi/apple-touch-icon-60x60.png" />
    <link rel="apple-touch-icon" sizes="120x120" href="../images/favi/apple-touch-icon-120x120.png" />
    <link rel="apple-touch-icon" sizes="76x76" href="../images/favi/apple-touch-icon-76x76.png" />
    <link rel="apple-touch-icon" sizes="152x152" href="../images/favi/apple-touch-icon-152x152.png" />
    <link rel="icon" type="image/png" href="../images/favi/favicon-196x196.png" sizes="196x196" />
    <link rel="icon" type="image/png" href="../images/favi/favicon-160x160.png" sizes="160x160" />
    <link rel="icon" type="image/png" href="../images/favi/favicon-96x96.png" sizes="96x96" />
    <link rel="icon" type="image/png" href="../images/favi/favicon-16x16.png" sizes="16x16" />
    <link rel="icon" type="image/png" href="../images/favi/favicon-32x32.png" sizes="32x32" />

</head>
<body>

<div class="super_container">

	<!-- Header -->

	<header class="header d-flex flex-row">
		<div class="header_content d-flex flex-row align-items-center">
			<!-- Logo -->
			<div class="logo_container">
				<a href="../">
					<div class="logo">
						<img src="../images/logotrans.png" alt="">
					</div>
				</a>
			</div>

			<!-- Main Navigation -->
			<nav class="main_nav_container">
				<div class="main_nav">
					<ul class="main_nav_list">
						<li class="main_nav_item"><a href="../">Главная</a></li>
						<li class="main_nav_item"><a href="about">О кафедре</a></li>
						<li class="main_nav_item"><a href="#">Научная работа </a></li>
						<li class="main_nav_item"><a href="#">ПУБЛИКАЦИИ</a></li>
						<li class="main_nav_item"><a href="#" onclick="openNav()">Разработки студентов</a></li>
					</ul>
				</div>
			</nav>
		</div>
		<div class="header_side d-flex flex-row justify-content-center align-items-center">
			<img src="../images/phone-call.svg" alt="">
			<span>+375 (22) 2252447</span>
		</div>


		<!-- Hamburger -->
		<div class="hamburger_container">
			<i class="fas fa-bars trans_200"></i>
		</div>

	</header>
	
	<!-- Menu -->
	<div class="menu_container menu_mm">

		<!-- Menu Close Button -->
		<div class="menu_close_container">
			<div class="menu_close"></div>
		</div>

		<!-- Menu Items -->
		<div class="menu_inner menu_mm">
			<div class="menu menu_mm">
				<ul class="menu_list menu_mm">
					<li class="menu_item menu_mm"><a href="index.php">Главная</a></li>
					<li class="menu_item menu_mm"><a href="teacher.php">О кафедре</a></li>
					<li class="menu_item menu_mm"><a href="#">Программы</a></li>
					<li class="menu_item menu_mm"><a href="courses.php">Научная работа</a></li>
					<li class="menu_item menu_mm"><a href="#">Новости</a></li>
					<li class="menu_item menu_mm"><a href="#" onclick="openNav()">Разработки студентов</a></li>
				</ul>

				<!-- Menu Social -->
				
				<div class="menu_social_container menu_mm">
					<ul class="menu_social menu_mm">
						<li class="menu_social_item menu_mm"><a href="#"><i class="fab fa-pinterest"></i></a></li>
						<li class="menu_social_item menu_mm"><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
						<li class="menu_social_item menu_mm"><a href="#"><i class="fab fa-instagram"></i></a></li>
						<li class="menu_social_item menu_mm"><a href="#"><i class="fab fa-facebook-f"></i></a></li>
						<li class="menu_social_item menu_mm"><a href="#"><i class="fab fa-twitter"></i></a></li>
					</ul>
				</div>

	
			</div>

		</div>

	</div>

	<?php include('components/others/dropother.php'); ?>