<head>
<link rel="stylesheet" href="<?php echo base_url(); ?>css/styleGeneral.css" type="text/css">
<link rel="stylesheet" href="<?php echo base_url(); ?>css/view.css" type="text/css">
</head>

<div id="body_box">
<table id="body_table" border="0">

	<tr>	
		<td id="navigation">
			<a href="<?php echo base_url().'index.php/course';?>">VIEW</a> <br/>
			<a href="<?php echo base_url().'index.php/course/add';?>">ADD</a> <br/>
			<a href="<?php echo base_url().'index.php/course/cancelled';?>" style="color: #7b1113;">CANCEL</a> <br/>
		</td>	
		
		<td id="ruler"></td>
		
		
		<td id="pagefield">
		<!--------------------- CONTENTS --------------------->
		
			<!--- SEARCH BUTTON --->
			
			<form action="<?php echo base_url().'index.php/course/search_cancelled';?>" method="post">
				<input class ="textf" type="text" name="search" required/>
				<input class="button_login" type="submit" name="submit" value="Search" />
			</form>
			<!--- End of Search Button --->		
			
			<!--------------------- Contents --------------------->			
			<table border="0">
				<tr class="abclink">
					<td style="list-style: none;"><center></center></td>
				</tr>
				
				<tr>
					<td>
						<table class="viewtable" border="0">
							<tr>
								<th style="width: 6%" class=""><div>Id</div></th>
								<th style="width: 12%" class=""><div>Name</div></th>
								<th style="width: 20%" class=""><div>Description</div></th>
								<th style="width: 21%" class=""><div>Cancelled On</div></th>
								<th style="width: 15%" class=""><div>Venue</div></th>
								<th style="width: 10%" class=""><div>Cost</div></th>
								<th style="width: 15%" ><div>For Refund</div></th>
							</tr>
							
							<!---php foreach( $cancelled as $cancelled_item ):?--->
							<?php foreach( $courses as $cancelled_item ): ?>
									<?php 
										$query = $this->db->get_where('cancelled', array('course_id' => $cancelled_item['id']) );
										$array1 = $query->row_array();
										
										if( !empty( $array1['id'] ) ){
										$query1 = $this->db->get_where('courses', array('id' => $array1['course_id']));
										$array = $query1->row_array();
										$var = strtotime($array1['date']);
									?>		
									<a href="#"><div class="divf">
									<tr class="linka">	
										<td class="dataf"><a href="<?php echo base_url().'index.php/course/cancelled/'.$cancelled_item['id'];?>"><center><div><?php echo $array['id'];?></div></center></a></td>														
										<td class="dataf"><a href="<?php echo base_url().'index.php/course/cancelled/'.$cancelled_item['id'];?>"><center><div><?php echo $array['name']?></div></center></a></td>
										<td class="dataf"><a href="<?php echo base_url().'index.php/course/cancelled/'.$cancelled_item['id'];?>"><center><div><?php echo $array['description']?></div></center></a></td>
										<td class="dataf"><a href="<?php echo base_url().'index.php/course/cancelled/'.$cancelled_item['id'];?>"><center><div><?php echo date('M d, Y H:i:s A', $var).PHP_EOL; ?></div></center></a></td>
										<td class="dataf"><a href="<?php echo base_url().'index.php/course/cancelled/'.$cancelled_item['id'];?>"><center><div><?php echo $array['venue']?></div></center></a></td>
										<td class="dataf"><a href="<?php echo base_url().'index.php/course/cancelled/'.$cancelled_item['id'];?>"><center><div><?php echo $array['cost']?></div></center></a></td>
										<td class="dataf"><a href="<?php echo base_url().'index.php/course/cancelled/'.$cancelled_item['id'];?>"><center><div><?php echo $array['paid']?></div></center></a></td>							
										
									</tr></div></a>	
									<?php } ?>
							<?php endforeach ?>
						</table>
					</td>
					
				</tr>
			</table>
		</td>	
	</tr>
</table>	
</div>
			
