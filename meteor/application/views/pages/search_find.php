<head>
<link rel="stylesheet" href="<?php echo base_url(); ?>css/styleGeneral.css" type="text/css">
<link rel="stylesheet" href="<?php echo base_url(); ?>css/view.css" type="text/css">
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
			
			<!----PAGE CONTENT------->
			<table class="viewtable" border="0">
			<tr class="abclink"></tr>
			
			<!--tr class="abclink">
				<php 
					$LetterList = ( range('A', 'Z') );
					$output = "";
					foreach( $LetterList as $value ) $output .= "|<a href='http://meteor.upitdc.edu.ph/index.php/pages/link/$value'>$value</a>";	
					echo "<td><center>$output</center></td>";						
				?>
			</tr-->
				
			<tr>
				<td>
				<div id="profileInfo">
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
	
			<?php for($i=0; $i<$counter; $i++) {?>
				<?php
					$temp = strtotime($start[$i]);
					$var1 = date('Y-m-d', $temp).PHP_EOL;
									
					$temp = strtotime($end[$i]);
					$var2 = date('Y-m-d', $temp).PHP_EOL;
				?>				
				<a href = ''><div class="divf"><tr class='linka'> 
				<td class="dataf"><a href="#"><center><div><?php echo $id[$i]; ?></div></center></a></td>
				<td class="dataf"><a href="#"><center><div><?php echo $name[$i]; ?></div></center></a></td>
				<td class="dataf"><a href="#"><center><div><?php echo $description[$i]; ?></center></div></a></td>
				<td class="dataf"><a href="#"><center><div><?php echo $var1; ?> | <?php echo $var2; ?></div></center></a></td>
				<td class="dataf"><a href="#"><center><div><?php echo $venue[$i] ?></div></center></a></td>
				<td class="dataf"><a href="#"><center><div><?php echo $cost[$i]; ?></div></center></a></td>
				<td class="dataf"><a href="#"><center><div><?php echo $reserved[$i]?> | <?php echo $available[$i]; ?> | <?php echo $paid[$i]; ?></div></center></a></td>
				<td class="buttontable">
					<?php 																						
						$session_name = $this->session->userdata('user');
						$query3 = $this->db->get_where( 'users', array('username' => $session_name) );
						$array3 = $query3->row_array();	
														
						$this->load->helper('date');
						$this->load->helper('form');
											
						date_default_timezone_set("Asia/Manila");
											
						$var1 = date('Y-m-d G:i:s');
											
						echo validation_errors();
						echo form_open('pages/enroll');
						echo "<input type='hidden' name='course_id' value='".$id[$i]."' />";
						echo "<input type='hidden' name='user_id' value='".$array3['id']."'/>";
						echo "<input type='hidden' name='date' value='".$var1."'/>";
						echo "<input type='hidden' name='refunded' value='".$paid[$i]."'/>";
						echo "<input style='padding: 0px'; class='button_smalla' type='submit' name='submit' value='E'/>";
						echo "</form>";							
					?>
				</td>
				</tr> </div> </a>
					<?php }?>
					</table>
				</div>
				</td>
				
				
			</tr>
			
			</table>		
			<!----PAGE CONTENT END------->
			
<!---------------PAGE CONTENT-------------------------->						
		</td>
		
	</tr>

</table>

</div>