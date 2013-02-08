<head>
<link rel="stylesheet" href="<?php echo base_url(); ?>css/styleGeneral.css" type="text/css">
<link rel="stylesheet" href="<?php echo base_url(); ?>css/view.css" type="text/css">
<link rel="stylesheet" href="<?php echo base_url(); ?>css/view2.css" type="text/css">

</head>

<div id="body_box">
<table id="body_table" border="0">

	<tr>
	
		<td id="navigation"> 
			<a href="<?php echo base_url().'index.php/course';?>">BACK</a> <br/>		
		</td>
		
		<td id="ruler"></td>

		<td id="pagefield">
<!---------------PAGE CONTENT-------------------------->	

		
			<!----SEARCH BUTTON | SUBJECT TO CHANGE TO FIT CI FRAMEWORK------->
			<form action="<?php echo base_url().'index.php/course/search_find';?>" method="post">
				<input class ="textf" type="text" name="search" required/>
				<input class="button_login" type="submit" name="submit" value="Search" />
			</form>
			<!----SEARCH BUTTON END------->
			
		
			
			<!----PAGE CONTENT BODY NYA------->
			<table border="0">	
				<?php 
					if( !empty($users) ) {
				?>	
				
				<tr class="abclink">
					<td style="list-style: none;"><center><?//echo $links;?></center></td>
				</tr>
				
				<tr class="abclink">
					<?php 
						$LetterList = ( range('A', 'Z') );
						$output = "";
						foreach( $LetterList as $value ) $output .= "|<a href='?letter=$value';?>$value";	
						echo "<td><center>$output</center></td>";
					?>
				</tr>
				
				<tr>
			
				<td>
					<div id="profileInfo">
						<table class="viewtable" border="0">
							
						<tr>
							<th style="width: 10%" class=""><div> ID</div></th>
							<th style="width: 35%" class=""><div> Name</div></th>
							<th style="width: 30%" class=""><div> Email</div></th>
							<th style="width: 20%" ><div> Status</div></th>
							<th> </th>
						</tr>
						<?php foreach( $users as $participant_item ): ?>
							<?php if( isset( $participant_item ) ){ 
								$ask = $participant_item['user_id'];
								$ask2 = $participant_item['course_id'];
								
								$cancelledOrNot = 0;
								
								$query = $this->db->get_where('reserved', array('course_id' => $ask2) );
								$array = $query->row_array();
								if( !empty($array['id']) ){
									$select = "U.username, U.firstname, U.lastname, U.id";
									$from = "reserved R, courses C, users U";
									$where = "U.id = $ask AND R.user_id = $ask AND R.course_id = $ask2";
									
									$this->db->select( $select );
									$this->db->from( $from );
									$this->db->where( $where );
									$cancelledOrNot = 1; // 1 = meaning not cancelled
								}
								else{
									$select = "U.username, U.firstname, U.lastname, U.id";
									$from = "cancelled Ca, courses C, users U";
									$where = "U.id = $ask AND Ca.user_id = $ask AND Ca.course_id = $ask2";
									
									$this->db->select( $select );
									$this->db->from( $from );
									$this->db->where( $where );
								}
								$query = $this->db->get();
								$array = $query->row_array();	
							?>
							<a href="#"><div class="divf">					
							<tr class="linka">
							<td class="dataf"><a href="#"><div><center><?php echo $array['id']?></center></div></a> </td>
							<td class="dataf"><a href="#"><div><center><?php echo $array['lastname']?>,&nbsp;<?php echo $array['firstname']?></center></div></a></td>
							<td class="dataf"><a href="#"><div><center><?php echo $array['username']?> <center></div></a></td>
							<td class="dataf">
								<?php 
									$var = 0;
									$query = $this->db->get_where('users', array('role' => 2));
									$array2 = $query->row_array();
									if( !empty($array2['id']) ){
										$query1 = $this->db->get_where('cancelled', array('user_id' => $participant_item['user_id']));
										$array1 = $query1->row_array();
										if( !empty($array1['id']) && $array1['refunded'] == 1 ){
											echo "<center class='refund'>FOR REFUND</center>";	
											$var = -1;
										}	
										else{
											$query = $this->db->get_where('bankpayment', array('user_id' => $participant_item['user_id']));
											$array3 = $query->row_array();
											
											$query1 = $this->db->get_where('cashpayment', array('user_id' => $participant_item['user_id']));
											$array1 = $query1->row_array();
											
											if( !empty($array3['id']) || !empty($array1['id'])){
												echo "<center>VALIDATED</center>";
												$var = 1;
											}	
											else if( $cancelledOrNot ){
												echo "<center>RESERVED</center>";
												$var = 0;
											}	
											else{
												echo "<center>FREE RESERVATIONS</center>";
											}
										}	
									}
								?>
							</td>
							<?php if( $cancelledOrNot ){?>
							<td class="buttontable">
								<form action="../validation/validate" method="post">
									<?php										
										$this->load->helper('form');									
										echo validation_errors(); 
										echo form_open('validation/validate');
										
										echo "<input type='hidden' name='temp' value='".$array['id']." />";			
										echo "<input type='hidden' name='cbn' value='0' />";
										if($var == 1) echo "<input style='padding: 0px'; class='button_smallb' type='submit' name='submit' value='V' disabled/>";
											else echo "<input style='padding: 0px'; class='button_smalla' type='submit' name='submit' value='V'/>";
																	
										echo"</form>";
										}
									?>
								</form>
							</td>
							<?php }?>
							</tr></div></a>
							
							<?php endforeach ?>			
						</table>
					</div>
					
					
					
				</td>
				
				
			</tr>
				
			<!----PAGE CONTENT END------->
			<?php } ?>
			</table>
<!---------------PAGE CONTENT-------------------------->						
		</td>
	</tr>

</table>

</div>