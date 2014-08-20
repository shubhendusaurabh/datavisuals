<h3><?php echo empty($page->id) ? 'Add a new page' : 'Edit page ' . $page->title ?></h3>


<?php echo validation_errors(); ?>
<?php echo form_open(); ?>
<table class="table">
	<tr>
		<td>Parent:</td>
		<td><?php echo form_dropdown('parent_id', $pages_no_parent, $this->input->post('parent_id') ? $this->input->post('parent_id') : $page->parent_id ); ?></td>
	</tr>
	<tr>
		<td>Template:</td>
		<td><?php echo form_dropdown('template', array('page' => 'Page', 'news_archive' => 'News Archive', 'homepage' => 'HomePage', 'image_gallery' => 'Image Gallery'), $this->input->post('template') ? $this->input->post('template') : $page->template); ?></td>
	</tr>
	<tr>
		<td>Order:</td>
		<td><?php echo form_input('order', set_value('order', $page->order)); ?></td>
	</tr>
	<tr>
		<td>Title:</td>
		<td><?php echo form_input('title', set_value('title', $page->title)); ?></td>
	</tr>
	<tr>
		<td>Slug:</td>
		<td><?php echo form_input('slug', set_value('slug', $page->slug)); ?></td>
	</tr>
	<tr>
		<td>Body:</td>
		<td><?php echo form_textarea('body', set_value('body', $page->body), 'class="tinymce"'); ?></td>
	</tr>
	<tr>
		<td></td>
		<td><?php echo form_submit('submit', 'Save', 'class="btn btn-primary"'); ?></td>
	</tr>
</table>
<?php echo form_close(); ?>
<!-- TinyMCE -->
<script type="text/javascript" src="<?php echo site_url('assests/js/tiny_mce/tiny_mce.js'); ?>"></script>
<script type="text/javascript">
	tinyMCE.init({
		// General options
		mode : "textareas",
		theme : "advanced",
		plugins : "autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave,visualblocks",

		// Theme options
		theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
		theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
		theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
		theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak,restoredraft,visualblocks",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : true,
	});
</script>
<!-- /TinyMCE -->
