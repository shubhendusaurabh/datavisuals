<section>
	<h2>Order Pages</h2>
	<p class="alert alert-info">Drag to order pages and then click Save</p>
	<div id="orderResult">
		
	</div>
	<input type="button" id="save" value="Save" class="btn btn-primary">
</section>
<link href="<?= site_url('assests/css/nestedSortable.css'); ?>" rel="stylesheet" />
<script src="<?= site_url('assests/js/jquery-2.0.0.min.js'); ?>"></script>
<script src="<?= site_url('assests/js/jquery-ui-1.9.1.custom.min.js'); ?>"></script>
<script src="<?= site_url('assests/js/jquery.mjs.nestedSortable.js') ?>"></script>
<script>
	$(function(){
		$.post('<?php echo site_url("admin/page/order_ajax"); ?>', {}, function(data){
			$('#orderResult').html(data);
		});

		$('#save').click(function(){
			oSortable = $('.sortable').nestedSortable('toArray');

			$('#orderResult').slideUp(function(){
				$.post('<?php echo site_url('admin/page/order_ajax') ?>', {sortable: oSortable}, function(data){
					$('#orderResult').html(data);
					$('#orderResult').slideDown();
				});
			})

			
		});
	});
</script>
