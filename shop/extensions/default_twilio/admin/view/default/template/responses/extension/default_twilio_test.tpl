<div class="col-xs-12">
	<div class="row col-xs-4 mt5">
<?php
echo $this->language->get('default_twilio_send_to'); ?>
	</div><div class="row col-xs-7 input-group afield">
	<?php
	echo $this->html->buildElement( array(
		'type' => 'input',
		'name' => 'to',
		'value' => '+15005550006',
		'style' => 'col-xs-5 no-save'
	));
?><span class="input-group-btn">
<?php
	echo $this->html->buildElement( array(
		'type' => 'button',
		'name' => 'test_connection',
		'title' => $text_test,
		'text' => $text_test,
		'style' => 'btn btn-info'
	)); ?>
		</span>
	</div>
</div>
<script type="text/javascript">

	<?php if ( $this->config->get('default_twilio_test')){ ?>
		$('.panel-body.panel-body-nopadding.tab-content').addClass('status_test');
	<?php }else{ ?>
		$('.panel-body.panel-body-nopadding.tab-content').removeClass('status_test');
	<?php }?>
	$('#test_connection').click(function() {
		if($('#editSettings_default_twilio_status').attr('data-orgvalue')!='1'){
			error_alert(<?php js_echo($this->language->get('error_turn_extension_on')); ?>);
			return false;
		}
		$.ajax({
			url: '<?php echo $this->html->getSecureUrl('r/extension/default_twilio/test'); ?>',
			type: 'GET',
			dataType: 'json',
			data: {'to': $('#to').val()},
			beforeSend: function() {
				$('#test_connection').button('loading');
			},
			success: function( response ) {
				if ( response.error ) {
					error_alert( response['message'] );
					return false;
				}
				info_alert( response['message'] );
				$('#test_connection').button('reset');
			},
			complete: function(){
				$('#test_connection').button('reset');
			}
		});
		return false;
	});

</script>
