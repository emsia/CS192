<head>
<link rel="stylesheet" href="<?php echo base_url(); ?>css/styleLogin.css" type="text/css">
<link rel="stylesheet" href="<?php echo base_url(); ?>css/view.css" type="text/css">
<link rel="stylesheet" href="<?php echo base_url(); ?>css/styleGeneral.css" type="text/css">
</head>

<div id="body_box">
<table id="body_table" border="0">

	<tr>
		
		<td id="navigation2">
		</td>	
		
	
		<td id="pagefield">
<!---------------PAGE CONTENT-------------------------->	

		
			<!----SEARCH BUTTON | SUBJECT TO CHANGE TO FIT CI FRAMEWORK------->
			<form action="<?php echo base_url().'index.php/pages/search_find';?>" method="post">
				<input class ="textf" type="text" name="search" required/>
				<input class="button_login" type="submit" name="submit" value="Search" />
			</form>
			<!----SEARCH BUTTON END------->
			
		
			
			<!----PAGE CONTENT BODY NYA------->
			<table border="0">	
			<tr class="abclink"></tr>	
			
			<!--tr class="abclink">
				<?php 
					$LetterList = ( range('A', 'Z') );
					$output = "";
					foreach( $LetterList as $value ) $output .= "|<a href='http://meteor.upitdc.edu.ph/index.php/pages/link/$value'>$value</a>";	
					echo "<td><center>$output</center></td>";
				?>
			</tr-->
			
			<tr>
			
				<td>
					<table class="viewtable" border="0">
						
						<tr>
							<th style="width: 7%" class=""><div>Id</div></th>
							<th style="width: 13%" class=""><div>Name</div></th>
							<th style="width: 18%" class=""><div>Description</div></th>
							<th style="width: 21%" class=""><div>Start | End</div></th>
							<th style="width: 16%" class=""><div>Venue</div></th>
							<th style="width: 10%" class=""><div>Cost</div></th>
							<th style="width: 13%" ><div>R | A | P</div></th>
						</tr>
						
						<?php foreach( $courses as $course_item ): ?>
					
						<div><a href="http://meteor.upitdc.edu.ph/index.php/course/accept/<?php echo $course_item['id'];?>/">
						<tr class="linka" >	
							<?php
								$query1 = $this->db->get_where( 'courses', array('id' => $course_item['id']) );
								$array1 = $query1->row_array();
											
								$query2 = $this->db->get_where( 'cancelled', array('course_id' => $array1['id']) );
								$array2 = $query2->row_array();	
								
								if( empty( $array2['id'] ) ){
								$temp = strtotime($course_item['start']);
								$var1 = date('Y-m-d', $temp).PHP_EOL;
								$temp = strtotime($course_item['end']);
								$var2 = date('Y-m-d', $temp).PHP_EOL;								
							?>
							<td class="dataf"><a href="#"><center><div><?php echo $course_item['id']?></div></center></a></td>														
							<td class="dataf"><a href="#"><center><div><?php echo $course_item['name']?></div></center></a></td>
							<td class="dataf"><a href="#"><center><div><?php echo $course_item['description']?></div></center></a></td>
							<td class="dataf"><a href="#"><center><div><?php echo $var1 ?> | <?php echo $var2?></div></center></a></td>
							<td class="dataf"><a href="#"><center><div><?php echo $course_item['venue']?></div></center></a></td>
							<td class="dataf"><a href="#"><center><div><?php echo $course_item['cost']?></div></center></a></td>
							<td class="dataf"><a href="#"><center><div><?php echo $course_item['reserved']?> | <?php echo $course_item['available']?> | <?php echo $course_item['paid']?></div></center></a></td>							
							<td class="buttontable">
								<?php 		
													
										$this->load->helper('date');
										$this->load->helper('form');
										
										date_default_timezone_set("Asia/Manila");
										
										$var1 = date('Y-m-d G:i:s A');
										
										echo validation_errors();
										echo form_open('pages/enroll');
											echo "<input type='hidden' name='course_id' value='".$course_item['id']."' />";
											echo "<input type='hidden' name='user_id' value='1'/>";
											echo "<input type='hidden' name='date' value='".$var1."'/>";
											echo "<input type='hidden' name='refunded' value='".$array1['paid']."'/>";
											echo "<input style='padding: 0px'; class='button_smalla' type='submit' name='submit' value='E'/>";
										echo "</form>";													
									}							
								?>
							</td>
						</tr></a></div>
						
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