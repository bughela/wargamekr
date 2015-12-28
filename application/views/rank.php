<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Rank</h1>
	</div>
</div>

<link href="/static/css/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet">
<style>
	.rank_row thead th {text-align:center;}
</style>
<div class="row rank_row">
	<div class="col-lg-1"></div>
	<?php $i=0; foreach($list as $list_): ?>
	<div class="col-lg-5">
		<table class="table table-striped table-hover text-center">
			<thead>
				<tr>
					<th>Rank</th>
					<th>Name</th>
					<th>Point</th>
					<th>update</th>
				</tr>
			</thead>
			<tbody>
			<?php foreach($list_ as $data): $i++; ?>
				<tr>
					<td><?=$i?></td>
					<td><?=$data->user_name?></td>
					<td><?=$data->point?></td>
					<td><?=$data->update_date?></td>
				</tr>
			<?php endforeach; ?>
			</tbody>
		</table>
	</div>
	<?php endforeach; ?>
</div>
