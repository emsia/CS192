<head>
<link rel="stylesheet" href="<?php echo base_url(); ?>css/styleGeneral.css" type="text/css">
<link rel="stylesheet" href="<?php echo base_url(); ?>css/view.css" type="text/css">
</head>

<div id="body_box">
<table id="body_table" border="0">

	<tr>
	
		<td id="navigation"> 
			
		</td>
		
		<td id="ruler"></td>
		

		<td id="pagefield">
<!---------------PAGE CONTENT-------------------------->	

		<div id="profileCont">
		
		
		<div id="profileName"><?php echo $user['firstname']; ?>  <?php echo $user['lastname']; ?> </div>
				
		<div id="profileInfo">	
					<?php echo validation_errors();?>
					<table class="viewtable" border="0">
					
						
						<tr>
							<th style="width: 20%" class=""><div>EMAIL ADDRESS</div></th>
							<td>&nbsp;<?php echo $user['username']; ?> </td>
						</tr>
						<tr>
							<th style="width: 20%" class=""><div>MAILING ADDRESS</div></th>
							<td>&nbsp;
							<?php if(empty($addr['street'])) echo '&nbsp';
							else {  ?>
							<?php echo $addr['street']; ?>&nbsp;<?php echo $addr['neighborhood']; ?> , <?php echo $addr['city']; }?>  																					
							</td>
						</tr>
						<tr>
							<th style="width: 20%" class=""><div>MOBILE NUMBER</div></th>
							<td> </td>
						</tr>
						
						<tr>
						<!--JAVA SCRIPT -->
						<script src="<?php echo base_url(); ?>js/script.js"> </script>
							<td>
							<?php echo form_open('adminsettings/forgot'); ?>
							<table id="login" border="0" style="vertical-align: top;">
							<tr  id="one2"><td class="field">
							<input class="textf" type="text" value="New Password" size="28" onfocus="changeBox2()" name="user2"/></td></tr>
							<tr  id="two2" style="display:none"><td class="field">
							<input class="textf" id="email" type="password" value=""  name="newpass" value="<?php echo set_value('newpass'); ?>" size="28" onBlur="restoreBox2()"/></td></tr>
							<tr id="one"><td class="field">
							<input class="textf" value="Confirm Password" type="text" size="28" onfocus="changeBox()" name="password" /></td></tr>
							<tr id="two" style="display:none"><td class="field">
							<input class="textf" id="password" value="" type="password" name="pconf" autocomplete="off" value="<?php echo set_value('pconf'); ?>" size="28" onBlur="restoreBox()"/></td></tr>
							<tr><td><input class="button_login" type="submit" value="SAVE" /></td></tr>
							<?php echo form_close(); ?>
							</table>
							</td>
						</tr>
						
					</table>	
			
		</div>
			
		
		</div>
			

<!---------------PAGE CONTENT-------------------------->						
		</td>
	</tr>


</table>

</div>
