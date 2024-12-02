<?php
 if ($languages) {
 	$cur_lang = array();
 	foreach ($languages as $language) {
		if ($language['code'] == $language_code) {
			$cur_lang = $language;
			break;
		} 
	} 
?>
	<div class="btn-group tooltips content_language" data-original-title="<?php echo $cur_lang['name']; ?>">
	    <button class="btn btn-default btn-xs dropdown-toggle tp-icon" data-toggle="dropdown">
			  <?php if($cur_lang['image']){  ?>
			  <img style="width: 16px; height: 11px;" src="<?php echo $cur_lang['image']; ?>" title="<?php echo $cur_lang['name']; ?>" />
			  <?php } else { ?>
			  <i class="fa fa-language"></i>
			  <?php } ?>
	      <span class="caret"></span>
	    </button>
	  	<div class="dropdown-menu dropdown-menu-sm pull-right switcher">
	  		<h5 class="title"><?php echo $cur_lang['name']; ?></h5>
			<form method="get" class="content_language_form">
	    		<ul class="dropdown-list dropdown-list-sm">
	    			<?php foreach ($languages as $language) { ?>
	    				<li>
	    					<a onClick="selectLanguage(event, '<?php echo $language['code']; ?>');">
	    						<?php if ($language['image']) { ?>
	    							<img style="width: 16px; height: 11px;" src="<?php echo $language['image']; ?>"
	    								 title="<?php echo $language['name']; ?>"/>
	    						<?php
	    						} else {
	    							echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
	    						} ?>
	    						&nbsp;&nbsp;<span><?php echo $language['name']; ?></span>
	    					</a>
	    				</li>
	    			<?php } ?>
	    		</ul>
	    		<input type="hidden" name="content_language_code" value=""/>
	      		<?php foreach($hiddens as $name => $value){   ?>
	            	<input type="hidden" name="<?php echo $name; ?>" value="<?php echo $value; ?>"/>
				<?php }?>
	    	</form>
	    </div>
	</div>
<?php } ?>
<script type="text/javascript">
if(typeof selectLanguage != 'function'){
    function selectLanguage(event, lang_code) {
    	var $form = $(event.target).closest('form');
    	$form.find("input[name='content_language_code']").attr('value', lang_code);
    	$form.submit();
    	$form.closest('.content_language').removeClass('open');
    	return false;	
    }
}		
</script>