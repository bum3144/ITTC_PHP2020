<!DOCTYPE html>
<html>
<head>
	<title>CSS Layout sample</title>
	<!--link href="https://fonts.googleapis.com/css?family=Buenard" rel="stylesheet"-->
	<script src="example_site.js"></script>
	<link rel="stylesheet" type="text/css" href="example_site.css" />
	<!-- basic setting -->
	<style>
		* { margin: 0; padding: 0; }
		body { font-family: 'Times New Roman', serif; }
		li { list-style: none; }
		a { text-decoration: none; }
		img { border: 0; }
	</style>

</head>

<body>

	<header id="main_header">
		<hgroup id="title">
			<h1>ITTC Development</h1>
			<h2>HTML5 + CSS3 Basic</h2>
		</hgroup>
		<nav id="main_gnb">
			<ul>
				<li><a href="#">Web</a></li>
				<li><a href="#">Mobile</a></li>
				<li><a href="#">Game</a></li>
				<li><a href="#">Simulation</a></li>
				<li><a href="#">Data</a></li>
			</ul>
		</nav>
		<nav id="main_lnb">
			<ul>
				<li><a href="#">HTML5</a></li>
				<li><a href="#">CSS3</a></li>
				<li><a href="#">JavaScript</a></li>
				<li><a href="#">jQuery</a></li>
				<li><a href="#">Node.js</a></li>
			</ul>
		</nav>
	</header>
