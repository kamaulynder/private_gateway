<table style="width: 630px;" class="my_table">
	<tr>
		<td>
			<div class="row">
				<p class="sync_key">
				<?php echo Kohana::lang('private_gateway.private_gateway_key');?>: <span><?php echo $private_gateway_key;?> </span><br/> <br/>
				<?php echo Kohana::lang('private_gateway.private_gateway_link');?>: <br /><span><?php echo $private_gateway_link; ?></span>
				</p>
			</div>
		</td>
	</tr>
	<tr>
		<td>
			<h4 class="fix"><?php echo Kohana::lang('private_gateway.text1');?>. </h4>
			<div class="row">
				<h4><?php echo Kohana::lang('private_gateway.phonenumber_variable');?>:</h4>
				<?php print form::input('phonenumber_variable', $form['phonenumber_variable'], ' class="text title_2"'); ?>
			</div>
			<div class="row">
				<h4><?php echo Kohana::lang('private_gateway.message_variable');?>:</h4>
				<?php print form::input('message_variable', $form['message_variable'], ' class="text title_2"'); ?>
			</div>
		</td>
	</tr>
</table>
