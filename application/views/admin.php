<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Admin panel</h1>
	</div>
</div>

<?php if(is_admin() == true) : ?>

<form class="form-horizontal" method="post" action="/admin/add_challenge">
<fieldset>

<!-- Text input-->
<div class="form-group">
	<label class="col-md-4 control-label" for="name">name</label>	
	<div class="col-md-5">
	<input id="name" name="name" type="text" placeholder="name" class="form-control input-md" required="">
		
	</div>
</div>

<!-- Text input-->
<div class="form-group">
	<label class="col-md-4 control-label" for="description">description</label>	
	<div class="col-md-5">
	<textarea class="form-control" style="min-height:80px;" id="description" name="description"></textarea>
		
	</div>
</div>

<!-- Text input-->
<div class="form-group">
	<label class="col-md-4 control-label" for="url">url</label>	
	<div class="col-md-5">
	<input id="url" name="url" type="text" placeholder="http://wargame.kr:8080/prob" class="form-control input-md" required="">
		
	</div>
</div>

<!-- Text input-->
<div class="form-group">
	<label class="col-md-4 control-label" for="author">author</label>	
	<div class="col-md-5">
	<input id="author" name="author" type="text" placeholder="author" class="form-control input-md" required="">
		
	</div>
</div>

<!-- Text input-->
<div class="form-group">
	<label class="col-md-4 control-label" for="point">point</label>	
	<div class="col-md-5">
	<input id="point" name="point" type="text" placeholder="100" class="form-control input-md" required="">
		
	</div>
</div>

<!-- Button -->
<div class="form-group">
	<label class="col-md-4 control-label" for=""></label>
	<div class="col-md-4">
		<button type="submit" id="" name="" class="btn btn-success">add</button>
	</div>
</div>

</fieldset>
</form>

<?php else: ?>

<div class="row">
	<div class="col-lg-12">
		<code>Administrator only..</code>
	</div>
</div>

<?php endif;
