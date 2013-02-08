<head>
<link rel="stylesheet" href="<?php echo base_url(); ?>css/styleGeneral.css" type="text/css">
<link rel="stylesheet" href="<?php echo base_url(); ?>css/view.css" type="text/css">
</head>

<div id="body_box">
<table id="body_table" border="0">

	<tr>
	
		<td id="navigation"> 
			<a href="http://meteor.upitdc.edu.ph/index.php/participantcourse/" style="color:#7b1113;">RESERVATION</a> <br/>		
			<a href="http://meteor.upitdc.edu.ph/index.php/participantcourse/upcoming">UPCOMING</a> <br/>	
			<a href="http://meteor.upitdc.edu.ph/index.php/participantcourse/completed">COMPLETED</a> <br/>	
			<a href="http://meteor.upitdc.edu.ph/index.php/participantcourse/view">VIEW</a> <br/>	
		</td>
		
		<td id="ruler"></td>		

		<td id="pagefield">
<!---------------PAGE CONTENT-------------------------->	


			<!----SEARCH BUTTON | SUBJECT TO CHANGE TO FIT CI FRAMEWORK------->
			<form action="<?php echo base_url().'index.php/participantcourse/search_reserved';?>" method="post">
				<input class ="textf" type="text" name="search" required/>
				<input class="button_login" type="submit" name="submit" value="Search" />
			</form>
			<!----SEARCH BUTTON END------->
			
			
			<!----PAGE CONTENT------->

			<table border="0">
			<tr class="abclink">
				<td style="list-style: none;"><center></center></td>
			</tr>	
			
			<tr>
				<td>	
					<table class="viewtable" border="0">
					
						<tr>
							<th style="width: 13%" class=""><div>Name</div></th>
							<th style="width: 25%" class=""><div>Description</div></th>
							<th style="width: 25%" class=""><div>Start | End</div></th>
							<th style="width: 15%" class=""><div>Venue</div></th>
							<th style="width: 10%" class=""><div>Cost</div></th>
							<th style="width: 12%" ><div>R|A|P</div></th>						
						</tr>
			
							<?php foreach( $courses as $course_item ): ?>
							
							<?php 
								$query1 = $this->db->get_where( 'courses', array('id' => $course_item['id']) );
								$array1 = $query1->row_array();
								
								$query2 = $this->db->get_where('reserved', array('course_id' => $array1['id'], 'user_id' => $userid  ) );
								$array2 = $query2->row_array();	
									
								if( !empty( $array2['id'] ) ){
							?>
							
							<a href="#"><div class="divf">
								<?php
									$temp = strtotime($course_item['start']);
									$var1 = date('Y-m-d', $temp).PHP_EOL;
													
									$temp = strtotime($course_item['end']);
									$var2 = date('Y-m-d', $temp).PHP_EOL;
								?>
								<tr class="linka">
								<td class="dataf"> <a href="#"><div><center><?php echo $course_item['name']?></center></div></a> </td>
								<td class="dataf"><a href="#"><div><center><?php echo $course_item['description']?></center></div></a></td>
								<td class="dataf"><a href="#"><div><center><?php echo $var1?> | <?php echo $var2?><center></div></a></td>
								<td class="dataf"> <a href="#"><div><center><?php echo $course_item['venue']?></center></div></a></td>
								<td class="dataf"><a href="#"><center><div><?php echo $course_item['cost']?></div></center></a></td>
								<td class="dataf"><a href="#"><center><div><?php echo $course_item['reserved']?> | <?php echo $course_item['available']?> | <?php echo $course_item['paid']?></div></center></a></td>
								<td class="buttontable">
								
								<?php
								
								$this->load->helper('date');
								$this->load->helper('form');
								
								date_default_timezone_set("Asia/Manila");											
								$date = date('Y-m-d G:i:s');
								
								$querya = $this->db->get_where('reserved', array('course_id' => $course_item['id'], 'user_id' => $userid ) );
								$arraya= $querya->row_array();
									
									if( empty( $arraya['id'] ) ){			
										$this->load->helper('form');									
										echo validation_errors(); 
										echo form_open('participantcourse/reserved' );
								
											echo "<input type='hidden' name='user_id' value='".$userid."' />";			
											echo "<input type='hidden' name='course_id' value='".$course_item['id']."' />";
											echo "<input type='hidden' name='date' value='".$date."' />";
											echo "<input class='button_smalla' type='submit' name='submit' value='R' /> ";
																
										echo"</form>";	
									}
									else{
										$this->load->helper('form');									
										echo validation_errors(); 
										echo form_open('participantcourse/unreserved' );
								
											echo "<input type='hidden' name='user_id' value='".$userid."' />";			
											echo "<input type='hidden' name='course_id' value='".$course_item['id']."' />";
											echo "<input type='hidden' name='date' value='".$date."' />";
											echo "<input class='button_smallb' type='submit' name='submit' value='R' /> ";
																
										echo"</form>";	
									
									}
									
									?>
								
								</td>
							</tr></div></a>
							
							<?php } endforeach ?>
							
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
