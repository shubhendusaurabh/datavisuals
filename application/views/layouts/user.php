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
			<h1><?= $header ?></h1>
		</header>
		
			<?= $yield ?>	
		
		<footer>
			<p>&copy; <?= date('Y'); ?></p>
		</footer>
	</div>
</body>
</html>