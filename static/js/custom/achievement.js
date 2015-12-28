$(function(){
	init_achievement();
});

function init_achievement(){
	$('div.achievement_row tbody>tr.info').click(function(){
		$.ajax({
			type: 'GET',
			url: '/achievement/set/' + $(this).attr('aname'),
		}).done(function(data){
			window.location.reload();
		});
	});
}
