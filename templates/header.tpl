<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<!-- Templating system by ZhivCo Software (c) 2011-2015 -->
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title>{@pgtitle}</title>
		<link rel="stylesheet" type="text/css" href="{@cssdir}style.css" />
		
		<script src="js/jquery-1.11.1.min.js" type="text/javascript"></script>
		<script src="js/functions.js" type="text/javascript"></script>
		
	</head>
	<body>
		<header class="header">
			<div class="container">
				<div class="navbar-header">
					<div class="left">LCDPS CAD {@version}</div>
					<div class="right">{@userstuff}</div>
					<div id="clock" class="center">text</div>
				</div>
			</div>
		</header>
		<nav class="header-nav" role="navigation">
			<div class="container-nav">
				<button id="addcall" class="tooltips" type="button" onClick="addCall()"><span>Enter a call into system</span>Add Call</button>
				<button type="button">NCDB</button>
				<button type="button">Map</button>
				<button type="button">Code Book</button>
				{@adminButton}
			</div>
		</nav>
		<div class="wrapper">
			<div class="calls"></div>
			<div class="info"></div>
			<div class="nPane"></div>
		</div>
