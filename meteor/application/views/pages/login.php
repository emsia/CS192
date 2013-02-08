

<head>
<link rel="stylesheet" href="<?php echo base_url(); ?>css/styleLogin.css" type="text/css">
</head>



<div id="body_box">
<table id="body_table" border="0">
	<tr>
		
		<?php echo validation_errors();?>
		<?php echo $error; ?>
		<td id="signup_box" >
		SIGNUP&nbsp;
			<?php echo form_open('pages/submit');?>
				<span class="label_field">EMAIL</span><input class="textf" type="text" size="35" name ="mail"  value="<?php echo set_value('mail');?>" /><br/>
				<span class="label_field">RETYPE EMAIL</span><input class="textf" type="text" size="35" name ="mailconf" autocomplete="off" value="<?php echo set_value('mailconf');?>" /><br/>
				<span class="label_field">PASSWORD</span><input class="textf" type="password" size="35" name ="pass" autocomplete="off" value="<?php echo set_value('pass');?>" /><br/>
				<span class="label_field">RETYPE PASSWORD</span><input class="textf" type="password" size="35" name ="passconf" autocomplete="off" value="<?php echo set_value('passconf');?>" /><br/>
				<span class="label_field">FIRST NAME</span><input class="textf" type="text" size="35" name ="fname"  value="<?php echo set_value('fname');?>" /><br/>
				<span class="label_field">LAST NAME</span><input class="textf" type="text" size="35" name ="lname"  value="<?php echo set_value('lname');?>" /><br/>
				<input class="button_login" type="submit" value="SIGNUP"/>
			
			<?php echo form_close();?>
		</td>
		
		<td id="ruler"> </td>
		
		<td id="login_box">
		 
		 
		 <!--JAVA SCRIPT -->
		 <script src="<?php echo base_url(); ?>js/script.js"> </script>
		
		&nbsp;LOGIN
			<?php echo form_open('pages/login'); ?>
				<table id="login" border="0" style="vertical-align: top;">
			
					<tr  id="one2"><td class="field">
						<input class="textf" type="text" value="EMAIL" size="28" onfocus="changeBox2()" name="user2"/></td></tr>
					<tr  id="two2" style="display:none"><td class="field">
						<input class="textf" id="email" type="text" value=""  name="user" value="<?php echo set_value('user'); ?>" size="28" onBlur="restoreBox2()"/></td></tr>
				
					<tr id="one"><td class="field">
						<input class="textf" value="PASSWORD" type="text" size="28" onfocus="changeBox()" name="password" /></td></tr>
					<tr id="two" style="display:none"><td class="field">
						<input class="textf" id="password" value="" type="password" name="pword" autocomplete="off" value="<?php echo set_value('pword'); ?>" size="28" onBlur="restoreBox()"/></td></tr>

					<tr><td><input class="button_login" type="submit" value="LOGIN" />
					
					<?php echo form_close(); ?>
					<a href="http://meteor.upitdc.edu.ph/index.php/temp/forgotpw" style="font: 12px calibri" value="Forgot Password">Forgot Password</a>
					
					
					</td></tr>
			
		 </table>
		</td>
	</tr>
		
</table>

</div>
