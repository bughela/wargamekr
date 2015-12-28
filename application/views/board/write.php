<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Board</h1>
	</div>
	<div class="col-lg-10">

<!-- // BEGIN JOIN FORM -->
<form class="form-horizontal" method="post" id="join_form" action="/board/write_action" onsubmit="return write_action(this);">
<fieldset>

<!-- Text input-->
<div class="form-group">
	<label class="col-md-4 control-label" for="title">title</label>	
	<div class="col-md-6">
		<input id="title" name="title" type="text" maxlength="100" placeholder="E-mail is not visible to the others." class="form-control input-md" required="">
	</div>
</div>

<!-- Multiple Radios (inline) -->
<div class="form-group">
	<label class="col-md-4 control-label" for="secret">Secret</label>
	<div class="col-md-4"> 
		<label class="radio-inline" for="secret-0">
			<input type="radio" name="secret" id="secret-0" value="0" checked="checked">
			public
		</label> 
		<label class="radio-inline" for="secret-1">
			<input type="radio" name="secret" id="secret-1" value="1">
			secret
		</label>
	</div>
</div>

<div class="form-group">
	<div class="col-md-6 col-md-offset-4">
		<textarea class="form-control" id="contents" name="contents" style="height:300px;" required=""></textarea>
	</div>
</div>

<div class="form-group">
	<div class="col-md-6 col-md-offset-4 text-center">
		<button type="button" class="btn btn-default" onclick="write_action(this.form);">Write</button>
	</div>
</div>

</fieldset>
</form>


	</div>
</div>
<script src="/static/js/custom/board.js"></script>
