<!-- // BEGIN JOIN FORM -->
<form class="form-horizontal" method="post" id="join_form" onsubmit="return join_action();">
<fieldset>

<!-- Text input-->
<div class="form-group">
	<label class="col-md-4 control-label" for="email">E-mail</label>	
	<div class="col-md-6">
	<input id="email" name="email" type="text" maxlength="100" placeholder="E-mail is not visible to the others." class="form-control input-md" required="">
		
	</div>
</div>

<!-- Text input-->
<div class="form-group">
	<label class="col-md-4 control-label" for="email2">Verify E-mail</label>	
	<div class="col-md-6">
	<input id="email2" name="email2" type="text" maxlength="100" placeholder="E-mail again" class="form-control input-md" required="">
		
	</div>
</div>

<!-- Text input-->
<div class="form-group">
	<label class="col-md-4 control-label" for="name">Name</label>	
	<div class="col-md-6">
	<input id="name" name="name" type="text" maxlength="50" placeholder="Nickname wil be used Rank, the others." class="form-control input-md" required="">
		
	</div>
</div>

<!-- Password input-->
<div class="form-group">
	<label class="col-md-4 control-label" for="password">Password</label>
	<div class="col-md-6">
		<input id="password" name="password" type="password" placeholder="password" class="form-control input-md" required="">
		
	</div>
</div>

<!-- Password input-->
<div class="form-group">
	<label class="col-md-4 control-label" for="password2">Verify Password</label>
	<div class="col-md-6">
		<input id="password2" name="password2" type="password" placeholder="password again" class="form-control input-md" required="">
		
	</div>
</div>

<!-- Multiple Radios (inline) -->
<div class="form-group">
	<label class="col-md-4 control-label" for="lang">Language</label>
	<div class="col-md-4"> 
		<label class="radio-inline" for="lang-0">
			<input type="radio" name="lang" id="lang-0" value="eng" checked="checked">
			English
		</label> 
		<label class="radio-inline" for="lang-1">
			<input type="radio" name="lang" id="lang-1" value="kor">
			한국어
		</label>
	</div>
</div>

<div class="hidden">
	<input type='submit' value='' />
</div>
</fieldset>
</form>
