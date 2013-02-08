<head>
<link rel="stylesheet" href="<?php echo base_url(); ?>css/styleGeneral.css" type="text/css">
<link rel="stylesheet" href="<?php echo base_url(); ?>css/view.css" type="text/css">
<script src="<?php echo base_url(); ?>js/datetimepicker_css.js"> </script>
</head>

<!---onclick="javascript:NewCssCal ('demo7','ddMMyyyy','arrow',true,'12',true,'future')"--->

<div id="body_box">
<table id="body_table" border="0">

	<tr>
		<td id="navigation">
			<a href="<?php echo base_url().'index.php/course';?>">VIEW</a> <br/>
			<a href="<?php echo base_url().'index.php/course/add';?>" style="color: #7b1113;">ADD</a> <br/>
			<a href="<?php echo base_url().'index.php/course/cancelled';?>">CANCEL</a> <br/>
		</td>	
		
		<td id="ruler"></td>
		
		<td id="pagefield">
		<!--------------------- Big CONTENTS --------------------->
			
			<!--------------------- Contents --------------------->	
			<table border="0">				
					
				<tr class="abclink">
					<td style="list-style: none;"><center></center></td>
				</tr>
					
				<tr>
					<td>
						<table class="viewtable" border="0">						
							<tr>				
								<th style="width: 17%" class=""><div>Name</div></th>
								<th style="width: 17%" class=""><div>Description</div></th>
								<th style="width: 19%" class=""><div>Start Date</div></th>
								<th style="width: 19%" class=""><div>End Date</div></th>
								<th style="width: 15%" class=""><div>Venue</div></th>
								<th style="width: 11%" class=""><div>Cost</div></th>
								<th style="width: 7%" class=""><div>Slot</div></th>
							</tr>
							
							<?php echo validation_errors(); ?>
							<?php echo form_open('course/add') ?>
							<?php for( $i=0; $i<5; $i++ ){ ?>
							<tr>
								<td>
								<input type="text" class="addf" name="name[<?php $i?>]" value="<?php echo set_value('name[]'); ?>" size="50" /><br/>
								</td>
								<td>
								<input type="text" class="addf" name="description[<?php $i?>]" value="<?php echo set_value('description[]'); ?>" size="50" /><br/>
								</td>
								<td>
								<input type="text" class="addf" id="<?php echo $i?>" name="start[<?php $i?>]" onfocus="javascript:NewCssCal ('<?php echo $i?>','yyyyMMdd','arrow',true,'24',false,'future')" value="<?php echo set_value('start[]'); ?>" size="50" readonly="readonly"/><br/>
								</td>
								<td>
								<input type="text" class="addf" id="<?php echo 'last'.$i?>" name="end[<?php $i?>]" onfocus="javascript:NewCssCal ('<?php echo 'last'.$i?>','yyyyMMdd','arrow',true,'24',false,'future')" value="<?php echo set_value('end[]'); ?>" size="50" readonly="readonly"/><br/>
								</td>	
								<td>
								<input type="text" class="addf" name="venue[<?php $i?>]" value="<?php echo set_value('venue[]'); ?>" size="50" /><br/>
								</td>
								<td>
								<input type="text" class="addf" name="cost[<?php $i?>]" value="<?php echo set_value('cost[]'); ?>" size="50" /><br/>
								</td>	
								<td>
								<input type="text" class="addf" name="available[<?php $i?>]" value="<?php echo set_value('available[]'); ?>" size="50" /><br/>
								</td>
							</tr>
							<?php } ?>
							
							<tr>
								<td colspan="6"></td>
								<td><center>
								<input class="button_login" type="submit" name="Submit" value="Add Course" />
								</center>
								</td>
							</tr>
							</form>
						</table>
					</td>
					<td>
						<table class="buttontable" border="0">
							<tr><th style="padding: 5px"><div>&nbsp;</div></th></tr>
							<?php for( $i=0; $i<5; $i++ ): ?>
								<tr><td class="dataf"></td></tr>
							<?php endfor ?>
						</table>
					</td>
				</tr>
			</table>
			<!--------------------- Content End --------------------->
		</td>
		
	<!--------------------- Big Content End --------------------->
	</tr>
	
</table>	
</div>