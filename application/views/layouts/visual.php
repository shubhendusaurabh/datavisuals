<!DOCTYPE HTML>
<html lang="en">
<head>
	<meta charset="UTF-8" />
	<title><?= $title ?></title>
	<link rel="stylesheet" href="<?= base_url('assests/css/bootstrap.min.css') ?>" />
</head>
<body>
	<div class="container">
		<header>
			<h1>Admin Visuals</h1>
		</header>
		
			<?= $yield ?>	
		
		<footer>
			<p>&copy; <?= date('Y'); ?></p>
		</footer>
	</div>
</body>
</html>