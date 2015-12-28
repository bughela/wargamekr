<style>
	.achievement_row table tbody td {vertical-align:middle; cursor:pointer;}
</style>
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Achievement</h1>
	</div>
	<div class="col-lg-12">
		<img class="img-recursive center-block img-rounded" style="width:400px; padding:10px; border: 1px solid gray; margin-bottom:20px;" src='/static/img/achievement_main.jpg' />
	</div>
</div>
<div class="row-fluid achievement_row">
	<?php foreach($list as $list_): ?>
	<div class="col-lg-4">
		<table class="table text-center table-hover">
			<tbody>
			<?php foreach($list_ as $data): ?>
				<tr class="<?=$data->taked?>" aname="<?=$data->name?>">
					<td><strong><?=$data->name?></strong></td>
					<td><?=$data->description?></td>
				</tr>
			<?php endforeach; ?>
			</tbody>
		</table>
	</div>
	<?php endforeach; ?>
</div>
<script src="/static/js/custom/achievement.js"></script>
