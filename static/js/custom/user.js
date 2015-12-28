$(function(){
	set_logged_info_buttons();	
});

function set_logged_info_buttons(){
	var buttons = $('ul#side-menu>li.sidebar-logged-info div.btn-group');
	$(buttons).find('a[href=#login]').click(function(event){
		event.preventDefault();
		login_pop_up();
	});
	$(buttons).find('a[href=#join]').click(function(event){
		event.preventDefault();
		join_pop_up();
	});
}

function login_action(){
	var $f = $('form#login_form');
	var result = false;
	if (!validateEmail($f.find('#email').val())) {
		myalert("email validate error", 'warning');
		return false;
	}
	$.ajax({
		type: 'POST',
		url: '/user/login_action',
		data: $f.serialize(),
		async: false,
		dataType: 'json'
	}).done(function(data){
		result = data;
	});
	if (result == true) {
		window.location.href = "/main";
	} else {
		myalert("login failed..", "danger");
	}
	return false;
}

function join_action(){
	var $f = $('form#join_form');
	var result = false;
	if ($f.find('#email').val() != $f.find('#email2').val()) {
		myalert("email check please", 'warning');
		return false;
	}
	
	if (!validateEmail($f.find('#email').val())) {
		myalert("email validate error", 'warning');
		return false;
	}

	if ($f.find('#name').val().trim() == "") {
		myalert("name check please", 'warning');
		return false;
	}

	if ($f.find('#password').val().trim() == "") {
		myalert("password check please", 'warning');
		return false;
	}

	if ($f.find('#password').val() != $f.find('#password2').val()) {
		myalert("password check please", 'warning');
		return false;
	}

	$.ajax({
		type: 'POST',
		url: '/user/join_action',
		data: $f.serialize(),
		async: false,
		dataType: 'json'
	}).done(function(data){
		result = data;
	});

	if (result[0] == true) {
		myalert('join success');
		$('div.modal.custom-modal').modal('hide');
	} else {
		myalert(result[1], 'danger');
	}
	return false;
}

function login_pop_up(){
	var button = "";
	button += '<button type="button" onclick="login_action();" class="btn btn-success">Login</button>';
	$.ajax({
		type: 'GET',
		url: '/user/login',
		dataType: 'html'
	}).done(function(html){
		var a = modal("Login form", html, button, function(){
			$('#login_form input#email').focus();
		});
	});
}

function join_pop_up(){
	var button = "";
	button += '<button type="button" onclick="join_action();" class="btn btn-success">Join</button>';
	$.ajax({
		type: 'GET',
		url: '/user/join',
		dataType: 'html'
	}).done(function(html){
		var a = modal("Join form", html, button, function(){
			$('#join_form input#email').focus();
		});
	});
}

function modal(title, contents, buttons, callback){
	var html = "";
	$('body>div.modal.custom-modal').remove();
	if (typeof(buttons) == 'undefined') buttons = '';
	if (typeof(callback) == 'undefined') callback = function(){};

	html +='<div class="modal fade custom-modal">';
	html +='  <div class="modal-dialog modal-lg">';
	html +='	<div class="modal-content">';
	html +='	  <div class="modal-header">';
	html +='		<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>';
	html +='		<h3 class="modal-title">' + title + '</h3>';
	html +='	  </div>';
	html +='	  <div class="modal-body">';
	html +=		 	contents;
	html +='	  </div>';
	html +='	  <div class="modal-footer">';
	html +=		 	buttons;
	html +='		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>';
	html +='	  </div>';
	html +='	</div>';
	html +='  </div>';
	html +='</div>';
	$('body').append(html);
	$('div.modal.custom-modal').on('shown.bs.modal', function(e){
		callback(e);
	});
	return $('div.modal.custom-modal').modal('show');
}

function validateEmail(email) { 
	var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	return re.test(email);
}

function myalert(param, param2){
	var init = {
		type : "success",
		position : "#page-wrapper",
		direction : "prepend",
		title : "Info",
		contents : "",
		margin : "20px 0 0 450px"
	}
	if (typeof(param) == "string"){
		init.contents = param;
		if (typeof(param2) == "string")
			init.type = param2;
	}
	var o = $.extend(init, param);
	// success info warning danger
	console.debug(o);

	$('div.custom-alert').remove();
	var html = "";
	html += '<div class="alert alert-' + o.type + ' custom-alert" style="display:none;">';
	html += '<button type="button" class="close" data-dismiss="alert">&times;</button>';
	html += '<strong>' + o.title + '!</strong> ' + o.contents + '&nbsp;';
	html += '</div>';

	if (o.direction == "prepend") {
		$(o.position).prepend(html);
	}else{
		$(o.position).append(html);
	}
	$(o.position).find('div.custom-alert').css({margin:o.margin}).fadeIn(1000).delay(3000).fadeOut(1000);
}
