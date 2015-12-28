create table users(
	idx int auto_increment primary key,
	name varchar(64) unique not null,
	email varchar(128) unique not null,
	password char(40) not null,
	reg_date datetime not null,
	reg_ip varchaR(16) not null,
	verified enum('y','n') not null default 'n',
	lang enum('eng','kor') not null default 'eng',
	achievement varchar(32) not null default 'default'
);

/*********************************************************/

create table logged_in(
	name varchar(64) not null,
	last_ping int not null
);

/*********************************************************/

create table achievement_list(
	idx int auto_increment primary key,
	name varchar(32) unique not null,
	description varchar(64) default null,
	ordering int not null default 999
);

insert into achievement_list (name, description) values
	('default', 'S3rvic3 Achi3v3men7'),
	('over 10','10% of total point'),
	('over 20','20% of total point'),
	('over 30','30% of total point'),
	('over 40','40% of total point'),
	('over 50','50% of total point'),
	('over 60','60% of total point'),
	('over 70','70% of total point'),
	('over 80','80% of total point'),
	('over 90','90% of total point'),
	('master','all clear!'),
	('BBS mania','write on the board 10 and over'),
	('chatterbox','write on the chat 100 and over'),
	('idia bank','[NOT YET]'),
	('prizewinner','[NOT YET]'),
	('web newbie','[NOT YET]'),
	('system newbie','[NOT YET]'),
	('addict', 'over the 365 logins'),
	('indiana jones','treasure hunt in the site'),
	('sewer brew','???'),
	('super hacker','report the vulnerability of the site');

/*********************************************************/

create table achievement_acquired(
	idx int auto_increment primary key,
	user_name varchar(128) not null,
	achievement_name varchar(32),
	unique key (user_name, achievement_name)
);

/*********************************************************/

create table challenge_list(
	idx int auto_increment primary key,
	name varchar(64) unique not null,
	description text null,
	url varchar(128) unique not null,
	author varchar(32) null,
	reg_date datetime not null,
	point int not null default 0
);

/*********************************************************/

create table challenge_solved(
	idx int auto_increment primary key,
	user_name varchar(64) not null,
	chall_name varchar(32) not null,
	reg_date datetime not null,
	reg_ip varchar(16) not null,
	unique key (user_name, chall_name)
);

/*********************************************************/

create view score_v as
 select a.user_name, sum(b.point) AS point,max(a.reg_date) AS update_date
 from (challenge_solved a join challenge_list b on(a.chall_name = b.name)) group by a.user_name;

/*********************************************************/

create table chat_log(
	idx int auto_increment primary key,
	name varchar(64) not null,
	chat varchar(128) not null,
	reg_date datetime not null,
	reg_ip varchar(16) not null
);

/*********************************************************/

create table login_log(
	idx int auto_increment primary key,
	name varchar(64) not null,
	reg_date datetime not null,
	reg_ip varchar(16)
);

/*********************************************************/

create table board(
	idx int auto_increment primary key,
	title varchar(64) not null,
	writer varchar(64) not null,
	contents text not null,
	secret tinyint not null default 0,
	reg_date datetime not null,
	reg_ip varchar(16) not null
);

/*********************************************************/

create table board_reply(
	idx int auto_increment primary key,
	pidx int not null,
	writer varchar(64) not null,
	contents varchar(256) not null,
	reg_date datetime not null,
	reg_ip varchar(16) not null
);

/*********************************************************/


