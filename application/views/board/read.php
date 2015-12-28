<style>
	table#board-read-table td {text-align:center}
	table#board-read-table td.bco {height:400px; padding:30px; text-align:left; font-size:110%;}
	table#board-read-table tr.bc td {width:33%;}
	pre {overflow:auto; max-width:1300px; min-height:350px;}
</style>
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Board</h1>
	</div>
	<div class="col-lg-10 col-lg-offset-1">
		<table id="board-read-table" class="table table-stripped">
			<tbody>
				<tr><td colspan="3"><strong><?=$main->title?></strong></td></tr>
				<tr class="bc">
					<td>No.<?=$main->idx?></td>
					<td><?=$main->writer?></td>
					<td><?=$main->reg_date?></td>
				</tr>
				<tr>
					<td colspan="3" class="bco"><?=$main->contents?></td>
				</tr>
			</tbody>
			<tfoot>
				<tr>
					<td colspan="3">
						<form onsubmit="return write_reply(this, <?=$main->idx?>);" method="post">

								<?php foreach ($reply_list as $reply) : ?>

							<div class="col-md-12">
								<hr style="margin:5px;" />
								<div class="col-md-2"><?=$reply->writer?></div>
								<div class="col-md-8"><?=$reply->contents?></div>
								<div class="col-md-2"><?=$reply->reg_date?></div>
							</div>

								<?php endforeach; ?>

							<div class="col-md-12" style="margin-top:10px;">
								<div class="col-md-10">
									<input type="text" id="reply_write_text" name="contents" class="form-control" />
								</div>
								<div class="col-md-2">
									<button type="submit" class="btn btn-default">Reply</button>
								</div>
							</div>

						</form>
					</td>
				</tr>
				<tr>
					<td colspan="3"><button type="button" class="btn btn-default" onclick="window.location.href='/board';">List</button></td>
				</tr>
			</tfoot>
		</table>
	</div>
</div>
<script src="/static/js/custom/board.js"></script>
