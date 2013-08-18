<!DOCTYPE HTML>
<html lang="en">
<head>
	<meta charset="UTF-8" />
	<title><?= $title ?></title>
	<link rel="stylesheet" href="<?= base_url('assests/css/bootstrap.min.css') ?>" />
	<link rel="stylesheet" href="<?= base_url('assests/css/styles.css') ?>" />
	<script src="<?= base_url('assests/js/jquery-2.0.0.min.js'); ?>"></script>
	<script src="<?= base_url('assests/js/bootstrap.min.js'); ?>"></script>
</head>
<body>
	<div class="container">
	  	<section>
	  		<h1><?php echo anchor('', strtoupper(config_item('site_name')));; ?></h1>
	  	</section>
	  	<div class="navbar">
	  		<div class="navbar-inner">
	  			<div class="container">
	  				<?= $menu ?>
	  			</div>
	  		</div>
	  	</div>
  	</div>
	<div class="container">
		<header>
			<h2><?= $header ?></h2>
		</header>
		
			<?= $yield ?>	
		
		<footer>
			<p>&copy; <?= date('Y'); ?> <a href="http://pumpndump.in">pumpndump.in</a></p>
		</footer>
	</div>
	<?php if($public): ?>
		<!-- Google Analytics: -->
		<script async="async">
			(function(i, s, o, g, r, a, m) {
				i['GoogleAnalyticsObject'] = r;
				i[r] = i[r] ||
				function() {
					(i[r].q = i[r].q || []).push(arguments)
				}, i[r].l = 1 * new Date();
				a = s.createElement(o), m = s.getElementsByTagName(o)[0];
				a.async = 1;
				a.src = g;
				m.parentNode.insertBefore(a, m)
			})(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

			ga('create', 'UA-39574724-1', 'pumpndump.in');
			ga('send', 'pageview');

		</script>
		<!-- Piwik -->
		<script async="async" type="text/javascript">
			var _paq = _paq || [];
			_paq.push(["trackPageView"]);
			_paq.push(["enableLinkTracking"]);

			(function() {
				var u = (("https:" == document.location.protocol) ? "https" : "http") + "://pumpndump.in/piwik/";
				_paq.push(["setTrackerUrl", u + "piwik.php"]);
				_paq.push(["setSiteId", "1"]);
				var d = document, g = d.createElement("script"), s = d.getElementsByTagName("script")[0];
				g.type = "text/javascript";
				g.defer = true;
				g.async = true;
				g.src = u + "piwik.js";
				s.parentNode.insertBefore(g, s);
			})();
		</script>
		<!-- End Piwik Code -->
	<?php endif ?>
</body>
</html>