  		<div class="row">
  			<!-- Main Column -->
  			<div class="span9">
          
  				<div class="row">
            <?php if(count($visuals)): foreach($visuals as $visual): ?>
  					 <article class="span9">
  					 	<?php echo get_excerpt($visual); ?>
  					 	<hr />
  					 </article>
            <?php endforeach; endif; ?>
  				</div>
  			<?php if ($pagination): ?>
            <section class="pagination"><?php echo $pagination; ?></section>
          	<?php endif; ?>
  			</div>
  			
			<!-- Sidebar -->
  			<div class="span3 sidebar">
  				<h2>Recent Visuals</h2>
  				<?php
  				
            $this->load->view('sidebar');
  				?>
  			</div>
  		</div>