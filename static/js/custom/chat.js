var last_idx = -1;
var chat_lock = false;
var logged_in_users = [];

$(function(){
	chat_init();
	if (!is_logged_in) {
		$('#btn-input').attr('placeholder', "Login please..");
		$('#btn-input').attr('disabled', true);
		$('#btn-chat').attr('disabled', true);
	} else {
		$('#btn-input').focus();
	}
	$('.dropdown-menu.dropdown-chat').parent('li.dropdown').click(function(){
		$('div.chat-panel>div.panel-body').scrollTop($('div.chat-panel>div.panel-body')[0].scrollHeight);
	});
	$('.dropdown-menu.dropdown-chat').click(function(e) {
		e.stopPropagation();
	});
});

function chat_init(){
	get_last_idx();
	load_chat();
	setInterval(load_chat, 700);

	$('#btn-input').keyup(function(e){
		if (e.keyCode == 13) $('#btn-chat').click();
	});
	$('#btn-chat').click(function(){
		var text = $('#btn-input').val();
		$('#btn-input').val('');
		$.ajax({
			type: 'POST',
			url: '/main/chat',
			data: {chat: text}
		});
	});
}

function get_last_idx(){
	$.ajax({
		type: 'GET',
		url: '/main/chat_last_idx',
		dataType: 'json',
		async: false
	}).done(function(data){
		try {
			var treasure = '/main/get_treasure';
			move_to_page(tresure);
		}catch(e){}
		last_idx = (data - 95);
		if (last_idx < 0) {
			last_idx = 0;
		}
	});
}

function load_chat(){
	if (chat_lock) return;
	chat_lock = true;
	$.ajax({
		type: 'GET',
		url: '/main/load_chat/' + last_idx,
		async: false,
		dataType: 'json'
	}).done(function(data){
		$(data[0]).each(function(idx, data){
			set_chat(data);
			last_idx = data['idx'];
		});

		if ($('div.online-panel').length == 0) return;

		$(data[1]).each(function(i, name){
			if ($.inArray(name, logged_in_users) != -1) return;

			logged_in_users.push(name);
			add_logged_in_user(name);
		});
		logged_in_users.sort();

		$(logged_in_users).each(function(i, name){
			if ($.inArray(name, data[1]) != -1) return;
			logged_in_users.remove(i);
			del_logged_in_user(name);
		});
		
	});
	chat_lock = false;
}

function set_chat(chat){
	var html="";
        html += '<li class="left clearfix">';
        html += '    <div class="chat-body clearfix">';
        html += '        <div class="header">';
		if (chat['achievement'] != 'default')
	        html += '            <span class="text-primary">['+chat['achievement']+']</span>';
		else if (chat['name'] == 'bughela')
	        html += '            <span class="text-primary">[Administrator]</span>';
		html += '            <strong class="primary-font">' + chat['name'] + '</strong> ';
        html += '            <small class="pull-right text-muted">';
        html += '                <i class="fa fa-clock-o fa-fw"></i> ' + chat['reg_date'];
        html += '            </small>';
        html += '        </div>';
		if (chat['name'] == "<i>[SYSTEM]</i>")
        	html += '        <p><b>' + chat['chat'] + '</b></p>';
		else
	        html += '        <p>' + chat['chat'] + '</p>';
        html += '    </div>';
        html += '</li>';
	$('ul.chat').append(html);
	$('div.chat-panel>div.panel-body').scrollTop($('div.chat-panel>div.panel-body')[0].scrollHeight);
}

function add_logged_in_user(name){
	var html = "";
	html += '<a href="#" class="list-group-item">';
	html += '    <i class="fa fa-user fa-fw"></i> ' + name;
	html += '    <span class="pull-right text-muted small"><em>Ranked No. '+get_rank(name)+'</em>';
	html += '    </span>';
	html += '</a>';
	$('#users-list').append(html);
}

function get_rank(name){
	var rank = 9999;
	$.ajax({
		type: "POST",
		url: "/rank/get_rank",
		dataType: "json",
		async: false,
		data: {user: name}
	}).done(function(data){
		rank = data;
	});
	return rank;
}

function del_logged_in_user(name){
	$("a:contains('"+name+"')").remove();
}

Array.prototype.remove = function(from, to) {
	var rest = this.slice((to || from) + 1 || this.length);
	this.length = from < 0 ? this.length + from : from;
	return this.push.apply(this, rest);
};
