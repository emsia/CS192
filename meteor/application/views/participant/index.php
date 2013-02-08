<head>
<link rel="stylesheet" href="<?php echo base_url(); ?>css/styleGeneral.css" type="text/css">
<link rel="stylesheet" href="<?php echo base_url(); ?>css/view.css" type="text/css">
</head>

<div id="body_box">
<table id="body_table" border="0">

	<tr>
	
		<td id="navigation"> 
			<a href="http://meteor.upitdc.edu.ph/index.php/participant" style="color:#7b1113;">VIEW</a> <br/>		
		</td>
		
		<td id="ruler"></td>
		

		<td id="pagefield">
<!---------------PAGE CONTENT-------------------------->	

		
			<!----SEARCH BUTTON | SUBJECT TO CHANGE TO FIT CI FRAMEWORK------->
			<form>
					
				<input class ="textf" type="input" name="Search Course" />				
				<input class="button_login" type="submit" name="submit" value="Search" /> 
			</form>
			<!----SEARCH BUTTON END------->
			
			
			<!---- PAGE CONTENT ------->
			
			<table border="0">
				<tr class="abclink">
					<td colspan="6"><center># A B C</center> </td>
				</tr>
				
				<tr>
					<td>
						<table class="viewtable" border="0">
							<tr>
								<th style="width: 10%" class=""><div> ID</div></th>
								<th style="width: 35%" class=""><div> Name</div></th>
								<th style="width: 30%" class=""><div> Email</div></th>
								<th style="width: 20%" ><div> Status</div></th>
								<th> </th>
							</tr>
							
							<?php foreach($participant as $participant_item): ?>
								<?php if( isset( $participant_item ) ){ ?>
								<a href="#"><div class="divf">					
							<tr class="linka">
							<td class="dataf"> <a href="#"><div><?php echo $participant_item['id']?></div></a> </td>
							<td class="dataf"><a href="#"><div><?php echo $participant_item['lastname']?>,&nbsp;<?php echo $participant_item['firstname']?></div></a></td>
							<td class="dataf"><a href="#"><div><center><?php echo $participant_item['username']?> <center></div></a></td>
							<td class="dataf"> <a href="#"><div><center> </center></div></a></td>
							<td>
							<?php
								$this->load->helper('form');									
									echo validation_errors(); 
									echo form_open('participant/viewprofile' );
							
										echo "<input type='hidden' name='user_id' value='".$participant_item['id'] ."' />";			
									
										echo "<input class='button_smalla' type='submit' name='submit' value='>' /> ";
															
									echo"</form>";	
							?>
							</td>
							
							</tr></div></a>
							
								<?php }?>
							<?php endforeach ?>
						</table>
					</td>
				</tr>
			</table>
			<!----PAGE CONTENT END------->
			

<!---------------PAGE CONTENT-------------------------->						
		</td>
	</tr>


</table>

</div>