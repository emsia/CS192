<head>
<link rel="stylesheet" href="<?php echo base_url(); ?>css/styleGeneral.css" type="text/css">
<link rel="stylesheet" href="<?php echo base_url(); ?>css/view.css" type="text/css">
</head>

<div id="body_box">
<table id="body_table" border="0">

	<tr>
	
		<td id="navigation"> 
			<a href="http://meteor.upitdc.edu.ph/index.php/participant">BACK</a> <br/>		
		</td>
		
		<td id="ruler"></td>
		

		<td id="pagefield">
<!---------------PAGE CONTENT-------------------------->	

	<!---------------HEADER INFO-------------------------->
	
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
	
	<!---------------HEADER INFO-------------------------->
	
	
	<!---------------RESERVATIONS-------------------------->
			
			<div id="profileInfo">
			
				<table class="viewtable" border="0">
					
						<tr>
							<th style="width: 100%" colspan="5" class=""><div style="border:none;background-color: #cccc99; color: black">RESERVATIONS</div></th>
						</tr>
					
						<tr>
							<th style="width: 15%" class=""><div class="small">Name</div></th>
							<th style="width: 30%" class=""><div class="small">Description</div></th>
							<th style="width: 20%" class=""><div class="small">Start | End</div></th>
							<th style="width: 15%" class=""><div class="small">Venue</div></th>
							<th style="width: 15%" class=""><div class="small">Cost</div></th>
						</tr>
			
							<?php foreach( $courses as $course_item ): ?>
							
							<?php 
													
								$query1 = $this->db->get_where( 'courses', array('id' => $course_item['id']) );
								$array1 = $query1->row_array();
								
								$query2 = $this->db->get_where('reserved', array('course_id' => $array1['id'], 'user_id' => $user['id']) );
								$array2 = $query2->row_array();	
								
								if( !empty( $array2['id'] ) ){
							?>
							
							<a href="#"><div class="divf">					
							<tr class="linka">
							<td class="dataf"> <a href="#"><div><?php echo $course_item['name']?></div></a> </td>
							<td class="dataf"><a href="#"><div><?php echo $course_item['description']?></div></a></td>
							<td class="dataf"><a href="#"><div><center><?php echo $course_item['start']?> | <?php echo $course_item['end']?><center></div></a></td>
							<td class="dataf"> <a href="#"><div><center><?php echo $course_item['venue']?></center></div></a></td>
							<td class="dataf"><a href="#"><center><div><?php echo $course_item['cost']?></div></center></a></td>
							
							</tr></div></a>
							
							<?php } endforeach ?>
							
					</table>
		
			</div>
			
	<!---------------RESERVATIONS-------------------------->


	<!---------------COMPLETED-------------------------->
			
			<div id="profileInfo">
			
				<table class="viewtable" border="0">
					
						<tr>
							<th style="width: 100%" colspan="5" class=""><div style="border:none;background-color: #cccc99; color: black">COMPLETED COURSE</div></th>
						</tr>
					
						<tr>
							<th style="width: 15%" class=""><div class="small">Name</div></th>
							<th style="width: 30%" class=""><div class="small">Description</div></th>
							<th style="width: 20%" class=""><div class="small">Start | End</div></th>
							<th style="width: 15%" class=""><div class="small">Venue</div></th>
							<th style="width: 15%" class=""><div class="small">Cost</div></th>
						</tr>
			
							<?php foreach( $courses as $course_item ): ?>
							
							<?php 
								
							$this->load->helper('date');
							$this->load->helper('form');
							$now = time();
							$date = unix_to_human($now, TRUE, 'us');
							
								$query1 = $this->db->get_where( 'courses', array('id' => $course_item['id']) );
								$array1 = $query1->row_array();
								
								$query2 = $this->db->get_where('reserved', array('course_id' => $array1['id'], 'user_id' => $user['id'] ) );
								$array2 = $query2->row_array();	
								
								
								if( empty( $array2['id']) && $course_item['end'] < $date  ){
							?>
							
							<a href="#"><div class="divf">					
							<tr class="linka">
							<td class="dataf"> <a href="#"><div><?php echo $course_item['name']?></div></a> </td>
							<td class="dataf"><a href="#"><div><?php echo $course_item['description']?></div></a></td>
							<td class="dataf"><a href="#"><div><center><?php echo $course_item['start']?> | <?php echo $course_item['end']?><center></div></a></td>
							<td class="dataf"> <a href="#"><div><center><?php echo $course_item['venue']?></center></div></a></td>
							<td class="dataf"><a href="#"><center><div><?php echo $course_item['cost']?></div></center></a></td>
							
							</tr></div></a>
							
							<?php } endforeach ?>
							
					</table>
		
			</div>
			
		<!---------------COMPLETED-------------------------->
			
		
		<!---------------CANCELLED-------------------------->
			
			<div id="profileInfo">
			
				<table class="viewtable" border="0">
					
						<tr>
							<th style="width: 100%" colspan="5" class=""><div style="border:none;background-color: #cccc99; color: black">CANCELLED COURSE</div></th>
						</tr>
					
						<tr>
							<th style="width: 15%" class=""><div class="small">Name</div></th>
							<th style="width: 30%" class=""><div class="small">Description</div></th>
							<th style="width: 20%" class=""><div class="small">Start | End</div></th>
							<th style="width: 15%" class=""><div class="small">Venue</div></th>
							<th style="width: 15%" class=""><div class="small">Cost</div></th>
						</tr>
			
							<?php foreach( $courses as $course_item ): ?>
							
							<?php 
								
							$this->load->helper('date');
							$this->load->helper('form');
							$now = time();
							$date = unix_to_human($now, TRUE, 'us');
							
								$query1 = $this->db->get_where( 'courses', array('id' => $course_item['id']) );
								$array1 = $query1->row_array();
								
								$query2 = $this->db->get_where('reserved', array('course_id' => $array1['id'], 'user_id' => $user['id'] ) );
								$array2 = $query2->row_array();	
								
								
								if( empty( $array2['id']) && $course_item['end'] < $date  ){
							?>
							
							<a href="#"><div class="divf">					
							<tr class="linka">
							<td class="dataf"> <a href="#"><div><?php echo $course_item['name']?></div></a> </td>
							<td class="dataf"><a href="#"><div><?php echo $course_item['description']?></div></a></td>
							<td class="dataf"><a href="#"><div><center><?php echo $course_item['start']?> | <?php echo $course_item['end']?><center></div></a></td>
							<td class="dataf"> <a href="#"><div><center><?php echo $course_item['venue']?></center></div></a></td>
							<td class="dataf"><a href="#"><center><div><?php echo $course_item['cost']?></div></center></a></td>
							
							</tr></div></a>
							
							<?php } endforeach ?>
							
					</table>
		
			</div>
			
		<!---------------CANCELLED-------------------------->
			
		
		</div>

			


<!---------------PAGE CONTENT-------------------------->						
		</td>
	</tr>


</table>

</div>