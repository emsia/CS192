<head>
<link rel="stylesheet" href="<?php echo base_url(); ?>css/styleGeneral.css" type="text/css">
<link rel="stylesheet" href="<?php echo base_url(); ?>css/view.css" type="text/css">
</head>

<div id="body_box">
<table id="body_table" border="0">

	<tr>	
		<td id="navigation">
			<a href="http://meteor.upitdc.edu.ph/index.php/course">VIEW</a> <br/>
			<a href="http://meteor.upitdc.edu.ph/index.php/course/add">ADD</a> <br/>
			<a href="http://meteor.upitdc.edu.ph/index.php/course/cancelled" style="color: #7b1113;">CANCEL</a> <br/>
		</td>	
		
		<td id="ruler"></td>

		<td id="pagefield">
<!---------------PAGE CONTENT-------------------------->	

		
			<!----SEARCH BUTTON | SUBJECT TO CHANGE TO FIT CI FRAMEWORK------->
			<form action="<?php echo base_url().'index.php/course/search_cancelled';?>" method="post">
				<input class ="textf" type="text" name="search" required/>
				<input class="button_login" type="submit" name="submit" value="Search" />
			</form>
			<!----SEARCH BUTTON END------->
			
			<!----PAGE CONTENT------->
			<table class="viewtable" border="0">
				<?php 
					if( $counter > 0 ) {
				?>	
				<tr class="abclink">
					<td style="list-style: none;"><center></center></td>
				</tr>
				
			<tr>
				<td>
				<div id="profileInfo">
			<table class="viewtable" border="0">
				<tr>
					<th style="width: 13%" class=""><div>Name</div></th>
					<th style="width: 25%" class=""><div>Description</div></th>
					<th style="width: 25%" class=""><div>Start | End</div></th>
					<th style="width: 15%" class=""><div>Venue</div></th>
					<th style="width: 10%" class=""><div>Cost</div></th>
					<th style="width: 12%" ><div>R|A|P</div></th>	
				</tr>
	
			<?php for($i=0; $i<$counter; $i++) {?>
				<?php					
					$query = $this->db->get_where('cancelled', array('course_id' => $id[$i]) );
					$array1 = $query->row_array();
					
					$var = strtotime($array1['date']);
				?>				
				<a href = "#"><div class="divf"><tr class='linka'> 
				<td class="dataf"><a href="<?php echo base_url().'index.php/course/cancelled/'.$id[$i];?>"><center><div><?php echo $name[$i]; ?></div></center></a></td>
				<td class="dataf"><a href="<?php echo base_url().'index.php/course/cancelled/'.$id[$i];?>"><center><div><?php echo $description[$i]; ?></center></div></a></td>
				<td class="dataf"><a href="<?php echo base_url().'index.php/course/cancelled/'.$id[$i];?>"><center><div><?php echo date('M d, Y H:i:s A', $var).PHP_EOL; ?></div></center></a></td>
				<td class="dataf"><a href="<?php echo base_url().'index.php/course/cancelled/'.$id[$i];?>"><center><div><?php echo $venue[$i] ?></div></center></a></td>
				<td class="dataf"><a href="<?php echo base_url().'index.php/course/cancelled/'.$id[$i];?>"><center><div><?php echo $cost[$i]; ?></div></center></a></td>
				<td class="dataf"><a href="<?php echo base_url().'index.php/course/cancelled/'.$id[$i];?>"><center><div><?php echo $reserved[$i]?> | <?php echo $available[$i]; ?> | <?php echo $paid[$i]; ?></div></center></a></td>
				
				</tr> </div> </a>
			</table>
				</div>
				</td>
				
				
			</tr>
			<?php }}?>
			
			</table>		
			<!----PAGE CONTENT END------->
			
<!---------------PAGE CONTENT-------------------------->						
		</td>
		
	</tr>

</table>

</div>
