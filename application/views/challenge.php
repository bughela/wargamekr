<link rel="canonical" href="http://codepen.io/desandro/pen/nFrte" />
<link href="/static/css/custom/isotope.css" rel="stylesheet">
<link href="/static/css/custom/challenge.css" rel="stylesheet">
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Challenge list</h1>
	</div>
</div>
<div class="row isotope_layout">
	<div class="col-lg-12">
		<div class="btn-toolbar" role="toolbar">
			<div id="filters" class="btn-group">
				<button class="btn btn-default" data-filter="*">show all</button>
				<button class="btn btn-default" data-filter=".solved">solved</button>
				<button class="btn btn-default" data-filter=":not(.solved)">not solved</button>
			</div>
			<div id="sorts" class="btn-group">
				<button class="btn btn-default" data-sort-by="name">name</button>
				<button class="btn btn-default" data-sort-by="point">point</button>
				<button class="btn btn-default" data-sort-by="author">author</button>
			</div>
		</div>
	</div>

	<div class="col-lg-12 isotope">

<?php
	foreach($list as $challenge) :
	if (in_array($challenge->name, $break_list))
		$solved = "bg-success solved";
	else
		$solved = "bg-info";
?>

		<div class="element-item img-rounded drop-shadow <?=$solved?>" cidx="<?=$challenge->idx?>">
			<p class="name"><?=$challenge->name?></p>
			<p class="point"><?=$challenge->point?>p</p>
			<p class="author"><?=$challenge->author?></p>
		</div>

<?php endforeach; ?>

	</div>

</div>

<!--script src='http://isotope.metafizzy.co/beta/isotope.pkgd.js'></script-->
<script src='/static/js/isotope.pkgd.min.js'></script>
<script src='/static/js/custom/challenge.js'></script>
