<h1 class="heading1">
  <span class="maintext"><i class="fa fa-book"></i> <?php echo $heading_title; ?></span>
  <span class="subtext"></span>
</h1>

<?php if ($success) { ?>
<div class="alert alert-success">
<button type="button" class="close" data-dismiss="alert">&times;</button>
<?php echo $success; ?>
</div>
<?php } ?>

<?php if ($error_warning) { ?>
<div class="alert alert-error alert-danger">
<button type="button" class="close" data-dismiss="alert">&times;</button>
<?php echo $error_warning; ?>
</div>
<?php } ?>

<div class="contentpanel addresses">
	<div class="col-md-6 col-xs-12">
	<section class="old_address">
	<h4 class="heading4"><?php echo $text_entries; ?></h4>
	<?php if ($addresses) {
	  echo  $form0['form_open'];
	?>
		<div class="registerbox form-horizontal">
			<table class="table table-striped">
			<?php foreach ($addresses as $address) { ?>		
				<tr>
					<td class="align_left"><?php echo $address['radio'];?></td>
					<td class="align_left"><label class="control-label inline" for="address_1_address_id<?php echo $address['address_id']; ?>" style="cursor: pointer;"><?php echo $address['address']; ?></label></td>
				</tr>
			<?php } ?>
			</table>
	
			<div class="form-group">
			    <div class="col-md-12">
			    	<button class="btn btn-orange pull-right" title="<?php echo $form0['continue']->name ?>" type="submit">
			    	    <i class="fa fa-arrow-right"></i>
			    	    <?php echo $form0['continue']->name ?>
			    	</button>
			    </div>
			</div>						
		</div>		
	</form>
	</section>
	</div>
	
	<div class="col-md-6 col-xs-12">
	<section class="new_address">
	<h4 class="heading4"><?php echo $text_new_address; ?></h4>
	<?php }
	   echo $form['form_open'];
	?>
	<div class="registerbox">
		<fieldset>
		<?php
			$field_list = array('firstname' => 'firstname',
								'lastname' => 'lastname',
								'company' => 'company', 
								'address_1' => 'address_1', 
								'address_2' => 'address_2', 
								'city' => 'city',
								'zone' => 'zone',
								'postcode' => 'postcode',
								'country' => 'country_id', 
								);
			
			foreach ($field_list as $field_name => $field_id) {
		?>
			<div class="form-group <?php if (${'error_'.$field_name}) echo 'has-error'; ?>">
				<label class="control-label col-md-5"><?php echo ${'entry_'.$field_name}; ?></label>
				<div class="input-group col-md-7">
				    <?php echo $form[$field_id]; ?>
				</div>
				<span class="help-block"><?php echo ${'error_'.$field_name}; ?></span>
			</div>		
		<?php
			}
		?>	
			<?php echo $this->getHookVar('new_address_sections'); ?>
			<div class="form-group">
				<div class="col-md-12">
					<button class="btn btn-orange pull-right lock-on-click" title="<?php echo $form['continue']->name ?>" type="submit">
					    <i class="fa fa-arrow-right"></i>
					    <?php echo $form['continue']->name ?>
					</button>
				</div>
			</div>				
		</fieldset>	
	</div>	
	</form>
	</section>
	</div>

</div>

<script type="text/javascript">
<?php $cz_url = $this->html->getURL('common/zone', '&zone_id='. $zone_id); ?>
$('#Address2Frm_country_id').change(function() {
    $('select[name=\'zone_id\']').load('<?php echo $cz_url;?>&country_id=' + $(this).val());
});
$('select[name=\'zone_id\']').load('<?php echo $cz_url;?>&country_id='+$('#Address2Frm_country_id').val());
</script>