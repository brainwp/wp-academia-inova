<!DOCTYPE html>
<html dir="ltr" lang="en-US">
<head>
	<meta charset="utf-8">
	<title>Academia Inova</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0" />
	<link href='http://fonts.googleapis.com/css?family=Lobster+Two:700' rel='stylesheet' type='text/css'>
	<link type="text/css" rel="stylesheet" href="assets/css/visual.css" media="screen" />
	<link type="text/css" rel="stylesheet" href="assets/css/media-queries.css" media="screen" />
	<!--[if lt IE 9]>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
		<script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
		<script src="assets/js/selectivizr-min.js"></script>
	<![endif]-->
</head>
<body>

<!-- Progress bar -->
<div id="progressbar" data-perc="25">
	<div class="bar"></div>
	<div class="label"><span></span></div>
</div>

<!-- Wrap this content into a container that sets a default width. Progress is outside of this because it's width is 100%. -->
<div id="container">

	<!-- Logo text -->
	<section id="logo">
		<h1>Academia Inova</h1>
	</section>

	<!-- Description text -->
	<section id="tagline">
		<p>Em breve a sua nova opção de saúde e fitness</p>
        <p><font size = 3>entre em contato - (11) 4057-8787</font></p>
	</section>

	<!-- Subscription form 
	<form id="subscribe">
		<input type="text" id="email" name="email" placeholder="Cadastre seu email para novidades" />		
		 <button>Enviar</button>
	</form> --> 
	
	<!-- Countdown -->	  
	<section id="countdown"></section>

	<!-- Twitter feed -->
	<section id="twitter" class="tweet" style="display:none"></section>
	
	<!-- Social media icons -->
	<section id="social" style="display:none">
		<ul>
			<li class="facebook"><a href="#" title="Be a facebook fan">Fan</a></li>
			<li class="twitter"><a href="#" title="Follow us on twitter">Follow</a></li>
			<li class="google"><a href="#" title="Befriend us on Google">Circle</a></li>
			<li class="skype"><a href="#" title="Talk to us on Skype">Talk</a></li>
			<li class="vimeo"><a href="#" title="Watch us on Vimeo">Watch</a></li>
		</ul>
	</section>
	
	<!-- Copyright message -->
	<footer id="footer">© <?=date('Y')?> <a href="http://www.esystem.com.br">eSystem Ready for Web</a>.</footer>

</div>

<script src='http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js'></script>
<script src="assets/js/core.js"></script>
<script src="assets/js/tweet.js"></script>
<script src="assets/js/countdown.min.js"></script>

</body>
</html>
