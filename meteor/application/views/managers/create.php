<head>
<link rel="stylesheet" href="<?php echo base_url(); ?>css/styleGeneral.css" type="text/css">
<link rel="stylesheet" href="<?php echo base_url(); ?>css/view.css" type="text/css">
</head>

<div id="body_box">
<table id="body_table" border="0">

	<tr>
	
		<td id="navigation"> 
			<a href="http://meteor.upitdc.edu.ph/index.php/managers">VIEW</a> <br/>		
			<a href="http://meteor.upitdc.edu.ph/index.php/managers/create" style="color:#7b1113;">ADD</a> <br/>	
		</td>
		
		<td id="ruler"></td>
		

		<td id="pagefield">
<!---------------PAGE CONTENT-------------------------->	

		
			
			
			<!----PAGE CONTENT------->
				
				<table class="viewtable" border="0">
			
				<tr class="abclink">
					<td colspan="6"> <center>A B C</center> </td>
				</tr>
			
				<tr>
					<th style="width: 25%" class=""><div> Firstname </div></th>
					<th style="width: 25%" class=""><div> Lastname </div></th>
					<th style="width: 30%" class=""> <div>Email </div></th>
					<th class="width: 20%"><div> Password </div></th>
				</tr>
				
				
				<?php echo validation_errors(); ?>
				<?php echo form_open('managers/create') ?>
				<?php for($i=0; $i<5; $i++){ ?>
				<tr>
					<td>
					<input class="addf" type="input" name="firstname[<?php $i ?>]" /><br />
					</td>					
					<td>
					<input class="addf" type="input" name="lastname[<?php $i ?>]" /><br />
					</td>					
					<td>
					<input class="addf" type="input" name="email[<?php $i ?>]" /><br />
					</td>	
					<td>
					<input class="addf" type="password" name="password[<?php $i ?>]" /><br />
					</td>
					
				</tr>
				<?php } ?>

				<tr>
					<td colspan="3"> </td>
					<td ><center>
					<input class="button_login" type="submit" name="submit" value="Add Manager" /> 
					</center>
					</td>
				</tr>
				</form>
				
				
				
				</tr>	
				
				</table>

			<!----PAGE CONTENT END------->
			

<!---------------PAGE CONTENT-------------------------->						
		</td>
	</tr>


</table>

</div>

