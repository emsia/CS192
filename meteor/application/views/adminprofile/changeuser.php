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
							<td>
							<?php echo form_open('adminsettings/change')?>
							MAILING ADDRESS:
								STREET:<input class="textf" type="text" size="35" name ="street"  value="<?php echo set_value('street');?>" /><br/>
								NEIGHBORHOOD:<input class="textf" type="text" size="35" name ="hood"  value="<?php echo set_value('hood');?>" /><br/>
								CITY:<input class="textf" type="text" size="35" name ="city"  value="<?php echo set_value('city');?>" /><br/>
							MOBILE NUMBER:<input class="textf" type="text" size="35" name ="mobile"  value="<?php echo set_value('mobile');?>" /><br/>
							<input class="button_login" type="submit" value="SAVE">
							<?php echo form_close(); ?>
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
