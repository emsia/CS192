<head>
<link rel="stylesheet" href="<?php echo base_url(); ?>css/styleGeneral.css" type="text/css">
<link rel="stylesheet" href="<?php echo base_url(); ?>css/view.css" type="text/css">
</head>

<div id="body_box">
<table id="body_table" border="0">

	<tr>
	
		<td id="navigation"> 
			<a href="http://meteor.upitdc.edu.ph/index.php/participantcourse/">RESERVATION</a> <br/>		
			<a href="http://meteor.upitdc.edu.ph/index.php/participantcourse/upcoming">UPCOMING</a> <br/>	
			<a href="http://meteor.upitdc.edu.ph/index.php/participantcourse/completed" style="color:#7b1113;">COMPLETED</a> <br/>	
			<a href="http://meteor.upitdc.edu.ph/index.php/participantcourse/view">VIEW</a> <br/>	
		</td>
		
		<td id="ruler"></td>		

		<td id="pagefield">
<!---------------PAGE CONTENT-------------------------->	


			<!----SEARCH BUTTON | SUBJECT TO CHANGE TO FIT CI FRAMEWORK------->
			<form action="<?php echo base_url().'index.php/participantcourse/search_completed';?>" method="post">
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
							<th style="width: 15%" class=""><div>Name</div></th>
							<th style="width: 30%" class=""><div>Description</div></th>
							<th style="width: 20%" class=""><div>Start | End</div></th>
							<th style="width: 15%" class=""><div>Venue</div></th>
							<th style="width: 15%" class=""><div>Cost</div></th>
						</tr>
			
							<?php foreach( $courses as $course_item ): ?>
							<?php
								$temp = strtotime($course_item['start']);
								$var1 = date('Y-m-d', $temp).PHP_EOL;
													
								$temp = strtotime($course_item['end']);
								$var2 = date('Y-m-d', $temp).PHP_EOL;
							?>
							<?php 
								
							$this->load->helper('date');
							$this->load->helper('form');
							date_default_timezone_set("Asia/Manila");											
							$date = date('Y-m-d G:i:s');		
							
								$query1 = $this->db->get_where( 'courses', array('id' => $course_item['id']) );
								$array1 = $query1->row_array();
								
								$query2 = $this->db->get_where( 'reserved', array('course_id' => $array1['id']) );
								$array2 = $query2->row_array();								
								
								if( empty( $array2['id']) && $course_item['end'] < $date  ){
							?>						
							 			
							<tr class="linkb">
							<td class="dataf"><div><center><?php echo $course_item['name'];?></center></div></td>
							<td class="dataf"><div><center><?php echo $course_item['description'];?><center></div> </td>
							<td class="dataf"><div><center><?php echo $var1;?> | <?php echo $var2;?><center></div> </td>
							<td class="dataf"><div><center><?php echo $course_item['venue'];?></center></div> </td>
							<td class="dataf"><center><div><?php echo $course_item['cost'];?></div></center> </td>
							
							</tr> 
							
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
