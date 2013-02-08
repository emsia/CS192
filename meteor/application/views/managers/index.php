<head>
<link rel="stylesheet" href="<?php echo base_url(); ?>css/styleGeneral.css" type="text/css">
<link rel="stylesheet" href="<?php echo base_url(); ?>css/view.css" type="text/css">
</head>

<div id="body_box">
<table id="body_table" border="0">

	<tr>
	
		<td id="navigation"> 
			<a href="http://meteor.upitdc.edu.ph/index.php/managers" style="color: #7b1113;">VIEW</a> <br/>		
			<a href="http://meteor.upitdc.edu.ph/index.php/managers/create">ADD</a> <br/>		
		</td>
		
		<td id="ruler"></td>
		

		<td id="pagefield">
<!---------------PAGE CONTENT-------------------------->	

		
			<!----SEARCH BUTTON | SUBJECT TO CHANGE TO FIT CI FRAMEWORK------->
<form action="http://meteor.upitdc.edu.ph/index.php/managers/search_results" method="post">
	<input class ="textf" type="text" name="search" f/>
	<input class="button_login" type="submit" name="submit" value="Search" />
</form>
			<!----SEARCH BUTTON END------->
			
			
			<!----PAGE CONTENT BODY------->
				
			<table border="0">

			<tr class="abclink">
				<td colspan="6"> <center>A B C</center> </td>
			</tr>
			
			<tr>
				<td>	
					<table class="viewtable" border="0">
					
						<tr>
							<th style="width: 10%"><div> ID</div></th>
							<th style="width: 40%"><div> Name</div></th>
							<th style="width: 30%"><div> Email</div></th>
							<th style="width: 15%"><div> Status</div></th>
						</tr>
			
							<?php foreach ($managers as $manager_item): ?>
							<a href="#"><div class="divf">					
							<tr class="linka">
							<td class="dataf"> <a href="#"><div><?php echo $manager_item['id'] ?></div></a> </td>
							<td class="dataf"><a href="#"><div><?php echo $manager_item['lastname'] ?>,<?php echo $manager_item['firstname'] ?> </div></a></td>
							<td class="dataf"> <a href="#"><div><?php echo $manager_item['username'] ?> </div></a></td>
								
							<td class="dataf">				
								<?php							
									$query = $this->db->get_where('managers', array('user_id' => $manager_item['id']));
									$array = $query->row_array();
									
									if($array['status'] == 0)
										echo "Disabled" ;
									else
										echo "Able" ;
								?>
							</td>
							<td class="dataf" style="vartical-align: bottom">
							
								<?php	
								
								$query = $this->db->get_where('managers', array('user_id' => $manager_item['id']));
										$array = $query->row_array();
										
								if($array['status'] == 0){
									$this->load->helper('form');									
									echo validation_errors(); 
									echo form_open('managers/status' );
							
										echo "<input type='hidden' name='user_id' value='".$manager_item['id']."' />";			
										echo "<input type='hidden' name='status' value='".$array['status']."' />";
										echo "<input class='button_smallb' type='submit' name='submit' value='D' /> ";
															
									echo"</form>";
								
								}	
								else{
									$this->load->helper('form');
									echo validation_errors(); 
									echo form_open('managers/status' );

										echo "<input type='hidden' name='user_id' value='".$manager_item['id']."' />";			
										echo "<input type='hidden' name='status' value='".$array['status']."' />";
										echo "<input class='button_smalla' type='submit' name='submit' value='D' /> ";
													
									echo"</form>";
								
								}
								?>
							</td>
							
							
						</tr></div></a>
							<?php endforeach ?>
							
					</table>			
				</td>
				
			
			</tr>
			</table>
				
				
		
			
			<!----PAGE CONTENT BODY END------->
			

<!---------------PAGE CONTENT-------------------------->						
		</td>
	</tr>


</table>

</div>
