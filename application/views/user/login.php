<!-- // BEGIN LOGIN FORM -->
<form class="form-horizontal" method="post" id="login_form" onsubmit="return login_action();">
<fieldset>

<!-- Text input-->
<div class="form-group">
	<label class="col-md-4 control-label" for="email">E-mail</label>	
	<div class="col-md-6">
	<input id="email" name="email" type="text" placeholder="E-mail is not visible to the others." class="form-control input-md" required="">
		
	</div>
</div>

<!-- Password input-->
<div class="form-group">
	<label class="col-md-4 control-label" for="password">Password</label>
	<div class="col-md-6">
		<input id="password" name="password" type="password" placeholder="password" class="form-control input-md" required="">
		
	</div>
</div>

<!-- Multiple Checkboxes -->
<div class="form-group hidden">
	<label class="col-md-4 control-label" for="checkboxes"></label>
	<div class="col-md-4">
		<div class="checkbox">
			<label for="checkboxes-0">
				<input disabled type="checkbox" name="checkboxes" id="checkboxes-0" value="1">
				remember (not yet) 
			</label>
		</div>
	</div>
</div>
<div class="form-group">
	<div class="col-md-4"></div>
	<div class="col-md-6">
		<p>if you forgot the password, send email to me.</p>
		<p>bughela [at] gmail [dot] com</p>
	</div>
</div>

<div class="hidden">
	<input type='submit' value='' />
</div>

</fieldset>
</form>
