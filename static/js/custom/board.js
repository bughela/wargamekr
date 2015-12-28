function write_action(f){
	f.submit();
	return false;
}

function write_reply(f, idx){
	f.action="/board/write_reply/" + idx;
	f.submit();
}

$(function(){
	$('table#board-table tbody tr').click(function(){
		var idx = $(this).find('td:first').text();
		window.location.href="/board/read/" + idx;
	});

	if ($('#login_text p').text() == "{not logged on}") {
		$('#reply_write_text').attr("readonly", true).val("login plz..")
	}
});
