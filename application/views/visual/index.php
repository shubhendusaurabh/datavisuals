<div class="row-fluid">
	<!-- Main Content -->
	<div class="span9">
		
			<article>
				<h2><?php echo e($visual->title); ?></h2>
				<p class="pubdate"><?php echo e($visual->pubdate); ?></p>
				<?php $this->load->view("charts/{$visual->filename}"); ?>
				<?php echo $visual->body;?>
			</article>
			<hr />
	</div>
	<!-- Sidebar -->
	<div class="span3 sidebar">
		<h2>Recent Visuals</h2>
		<?php $this->load->view('sidebar'); ?>
	</div>
</div>