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
				
					<table class="viewtable" border="0">
						
							<tr>
								<td style="width: 16%; font-size: 18px; color:#012e03;" class=""><div>E-Mail Address</div></td>
								<td>:&nbsp;&nbsp;&nbsp;
									<?php echo $user['username']; ?> 
								</td>
							</tr>
							<tr>
								<td style="width: 16%; font-size: 18px; color:#012e03;" class=""><div>Mailing Address</div></td>
								<td>:&nbsp;&nbsp;&nbsp;
									<?php if(empty($addr['street'])) echo '&nbsp';
									else {  ?>
									<?php echo $addr['street']; ?>&nbsp;<?php echo $addr['neighborhood']; ?> , <?php echo $addr['city']; }?>  																					
								</td>
							</tr>
							<tr>
								<td style="width: 16%; font-size: 18px; color:#012e03;" class=""><div>Mobile Number</div></td>
								<td>:&nbsp;&nbsp;&nbsp; </td>
							</tr>
							
						</table>	
			
		</div>
			
		
		</div>
			

<!---------------PAGE CONTENT-------------------------->						
		</td>
	</tr>


</table>

</div>
