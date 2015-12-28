<style>
	table#board-table tbody tr {cursor:pointer;}
	table#board-table tbody td small.reply {color:#22d;}
	table#board-table tbody td small.secret {color:#d22;}
</style>
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Board</h1>
	</div>
	<div class="col-lg-8 col-lg-offset-2">
		<table id="board-table" class="table table-striped table-hover">
			<thead>
				<th>Num</th>
				<th>Title</th>
				<th>Writer</th>
				<th>Date</th>
			</thead>
			<tbody>

			<?php
				foreach($list as $item) :
					if ($item->reply_count > 0)
						$item->title .= " <small class='reply'>[".$item->reply_count."]</small>";
					if ($item->secret == 1)
						$item->title .= " <small class='secret'>(s)</small>";
			?>
			
				<tr>
					<td><?=$item->idx?></td>

					<?php if($item->writer == "bughela") :?>

					<td><b><?=$item->title?></b></td>

					<?php else: ?>

					<td><?=$item->title?></td>

					<?php endif; ?>

					<td><?=$item->writer?></td>
					<td><?=$item->reg_date?></td>
				</tr>

			<?php endforeach; ?>

			</tbody>
			<tfoot>
				<tr>
					<td colspan="4" class="text-center">
						<div class="row">
							<div class="col-md-9">
								<ul class="pagination">
									<li><a href="/board/get_list/1">&laquo;</a></li>
								
									<?php for($i=$basepage-4;$i<=$pagination && $i < ($basepage+10); $i++) :?>
	
									<li class="<?php if($realpage == $i) echo "active";?>"><a href="/board/get_list/<?=$i?>"><?=$i?></a></li>
	
									<?php endfor; ?>
	
									<li><a href="#">&raquo;</a></li>
								</ul>
							</div>
							<div class="col-md-3">
								<?php if (is_logged_in()) : ?>
								<a href="/board/write" class="btn btn-default">Write</a>
								<?php endif; ?>
							</div>
						</div>
					</td>
				</tr>
			</tfoot>
		</table>
	</div>
</div>
<script src="/static/js/custom/board.js"></script>
