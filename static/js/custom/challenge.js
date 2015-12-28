$(function(){
	init_isotope();
	$('.isotope .element-item').click(function(){
		challenge_info($(this).attr('cidx'));
	});
});

function challenge_info(idx){
	$.ajax({
		type: 'GET',
		url: '/challenge/detail_info/'+idx,
		dataType: 'json'
	}).done(function(data){
		modal(data['name'], modal_contents(data), modal_buttons(data['idx'], data['url']), modal_setting);
	});
}

function modal_setting(url){
	if (!is_logged_in) {
		$('div.modal.custom-modal #flag').prop('disabled', true).attr('placeholder', 'Login please..');
		$('div.modal.custom-modal #bt_auth').prop('disabled', true);
		//$('div.modal.custom-modal #bt_chall_start').prop('value', true).html("Login please");
	}
	$('div.modal.custom-modal #bt_chall_start').click(function(){
		window.open($('div.modal.custom-modal #curl').val(), '_blank');
	});
	$('div.modal.custom-modal #bt_auth').click(function(){
		var flag = $('div.modal.custom-modal #flag').val();
		var chall_name = $('div.modal.custom-modal #cidx').val();
		auth(flag, chall_name);
	});
}

function modal_contents(data){
	var html = "";
	html += "<div class='text-right'>";
	html += 	data['point'] + "point / " + data['author'];;
	html += "</div>";
	html += "<div class=''>";
	html += 	"<pre>" + data['description'] + "</pre>";
	html += "</div>";
	return html;
}

function modal_buttons(idx, url){
	var html = "";
	html += '<div class="text-left challenge_auth">';
	html += '	<input type="hidden" id="curl" value="' + url + '" />';
	html += '	<input type="hidden" id="cidx" value="' + idx + '" />';
	html += '	<input id="flag" name="flag" type="text" placeholder="FLAG" class="form-control col-lg-3" required="">';
	html += '	<button type="button" class="btn btn-success" id="bt_auth">Auth</button>';
	html += '</div>';
	html += '<button type="button" class="btn btn-primary" data-dismiss="modal" id="bt_chall_start">Start</button>';
	return html;
}

function auth(flag, chall_idx){
	flag = flag.trim();
	if (flag == "") return;
	$.ajax({
		type: 'POST',
		url: '/challenge/auth/' + chall_idx,
		data: {flag: flag},
		dataType: 'json'
	}).done(function(result){
		if (result == true){
			window.location.reload();
		}else {
			myalert({
				type : "danger",
				position : "div.challenge_auth",
				direction : "append",
				contents : result,
				margin : "10px"
			});
		}
	});
}

function init_isotope(){
  // init Isotope
  var $container = $('.isotope').isotope({
	itemSelector: '.element-item',
	layoutMode: 'fitRows',
	getSortData: {
	  name: '.name',
	  point: '.point parseInt',
	  author: '.author'
	}
  });

  // filter functions
  var filterFns = {
  };

  // bind filter button click
  $('#filters').on( 'click', 'button', function() {
	var filterValue = $( this ).attr('data-filter');
	// use filterFn if matches value
	filterValue = filterFns[ filterValue ] || filterValue;
	$container.isotope({ filter: filterValue });
  });

  // bind sort button click
  $('#sorts').on( 'click', 'button', function() {
	var sortByValue = $(this).attr('data-sort-by');
	$container.isotope({ sortBy: sortByValue });
  });
  
  // change is-checked class on buttons
  $('.isotope .btn-group').each( function( i, buttonGroup ) {
	var $buttonGroup = $( buttonGroup );
	$buttonGroup.on( 'click', 'button', function() {
	  $buttonGroup.find('.is-checked').removeClass('is-checked');
	  $( this ).addClass('is-checked');
	});
  });
}
