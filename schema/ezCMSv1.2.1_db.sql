/** 
Creating Database for ezcms1.2.1
*/
create database if not exists ezcms121  DEFAULT CHARACTER SET=utf8;
use ezcms121;

/*drop database powercmsdb112;*/

SET default_storage_engine = INNODB;

/*
create table if not exists Template(Id int unsigned auto_increment primary key,
Templatename varchar(50) not null, Status enum('active','inactive'),
Baseurl tinytext, foreign key(Sitename) references Sites(Sitename)
)engine = innodb;
*/
create table if not exists Menunav(
Id int(11) unsigned not null auto_increment,
Navname varchar(20) not null,
Navtype enum('horizontal','vertical','dropdown','popup') default 'horizontal',
Navlevel int(5) default '1',
Position int(10) not null,
Visible   enum('Y','N') default 'Y',
Featured  enum('Y','N') default 'Y',
Primary key (Id),
constraint  uniq_navname unique key(Navname)
);

create table if not exists Subnav(
Id int(11) unsigned not null auto_increment,
primary key(Id),
Navid int(11),
SubNavname varchar(20) not null,
SubNavlevel int(5) default '2',
Position int(10) not null,
constraint  uniq_navname unique key(SubNavname)
) engine =innodb;

create table if not exists Users(
Id int(11) unsigned auto_increment ,
Firstname varchar(50) not null, 
Lastname varchar(40) not null,
Gender enum('M','F') not null,
Username varchar(45) not null,
Password varchar(100) not null ,
Email varchar(255) default 'admin@example.com',
AuthLevel int(2),
Lastmodified timestamp default current_timestamp on update current_timestamp,
constraint pk_uid primary key(Id), 
constraint unique_username unique key(Username)
)engine =innodb;

create table if not exists User_options(
Id int(11) unsigned auto_increment,
Username varchar(45) not null,
Question varchar(255),
Answer varchar(255),
Status enum('active','inactive','blocked') default "active",
Website varchar(255),
TempPassword varchar(255),
primary key(Id)
)engine =innodb;

create table if not exists Roles(
Id int unsigned auto_increment,
Role varchar(50) not null, 
AuthLevel int(5),
primary key(Id), 
Lastmodified timestamp default current_timestamp on update current_timestamp
)engine =innodb;

/*insert roles information
insert into roles values(1,"Administrator",1,now()),
(2,"Moderator",2,now()),
(3,"Editor",3,now()),
(4,"User",4,now()); */



create table if not exists Guest_users(
Ip varchar(50) primary key, unique index(Ip),
Guest_time varchar(10)
);

create table if not exists Active_users(
Username varchar(45), 
constraint unique index(Username),
Time_loggedin date,
primary key(Username)
)engine =innodb;

create table if not exists Blocked_users(
Username varchar(45), unique index(Username),
Time_blocked date,
primary key(Username)
)engine=innodb;

create table if not exists Pages(
Id int(11) unsigned auto_increment,primary key(Id),
Title varchar(255) not null,
Body text not null,
fulltext idx_body (Body),
Authorid int(10), /*refrence userid*/
Dateposted timestamp not null default current_timestamp on update current_timestamp,
Position int(30),
Publish  enum('Y','N') default 'N',
Feature  enum('Y','N') default 'N',
Views int(30) default 0,
Comments int(30) default 0
) engine = innodb;


create table if not exists Page_Comments(
Id int unsigned auto_increment primary key,
Author varchar(100),
Message tinytext,
Pageid int,
Dateposted timestamp not null default current_timestamp on update current_timestamp,
)engine=innodb;

create table if not exists Page_category(
Id int unsigned auto_increment,
Name varchar(50),
Description varchar(255),
Visible enum('Y','N') default 'N',
Position int(30),
primary key(Id)
)engine = innodb;


create table if not exists Page_images(
Id int auto_increment,primary key(Id),
Name varchar(50),
Width int(5),
Height int(5),
Description tinytext,
Mimetype varchar(50),
Extention varchar(10),
Pageid int
) engine=Innodb;

create table if not exists Mailing_list(
Id int unsigned not null auto_increment,
Email varchar(255),
DateSubscribed timestamp not null default current_timestamp on update current_timestamp,
primary key(Id)
) engine=Innodb;

/* Forum Tables*/

create table if not exists Forum_Category(
Id int(11) unsigned not null auto_increment,primary key(Id),
CatName varchar(255),
CatDescription varchar(255),
constraint uniq_catname unique index(CatName)
)engine=Innodb;

create table if not exists Forum_Topics(
Id int(11) unsigned not null auto_increment,primary key(Id),
TopicSubject varchar(255),
TopicDate date,
CatId int(11),
TopicBy int(11),
Views int(30) default 0
)engine=Innodb;


create table if not exists Forum_Post(
Id int(11) unsigned not null auto_increment,primary key(Id),
PostContent text,fulltext idx_cont(PostContent),
Postdate date,
TopicId int(11),
PostedBy int(11)
)engine=Innodb;

create table if not exists Forum_Replies(
Id int(11) unsigned not null auto_increment,primary key(Id),
ReplyContent text,fulltext idx_cont(ReplyContent),
Replydate date,
RepliedBy int(11),
TopicId int(11)
)engine=Innodb;

/*
alter table Forum_Topics add foreign key(Catid) references Forum_Category(Id)
on delete cascade on update cascade;

alter table Forum_Topics add foreign key(Topicby) references Users(Id)
on delete restrict on update cascade; 

alter table Forum_Post add foreign key(Topicid) references Forum_Topics(Id)
on delete cascade on update cascade;

alter table Forum_Post add foreign key(Postedby) references Users(Id)
on delete restrict on update cascade;

alter table Pages add foreign key(Authorid) references Users(Id)
on delete cascade on update cascade; 
*/

/*insert admin information into users */
insert into users set Firstname='A-Rahman', Lastname='Sarpong',
 Gender ='Male', Username="Admin",Password = md5('admin123'), 
 Email='fadanash@gmail.com', Authlevel=1 
 on duplicate key update Id=1 and Username="Admin";
 /* Insert dummy data into pages */
 
insert into pages values
(1,"Page Title","Story goes here...",1,now(),1,"Y","Y",0,0),
(2,"Blog ","Bloggers point...",1,now(),1,"Y","Y",0,0),
(3,"Tech News","Techincal information more, more text here..",1,now(),1,"Y","Y",0,0) 
on duplicate key update Id=1;

/*
create table if not exists Districts(
Id int(10) unsigned auto_increment,
District varchar(30) not null,
Primary key(Id),
Regionid int(10)
) engine = Innodb;

create table if not exists Regions(
    Id int(10) unsigned,
	Region  varchar(30) not null,
	Capital varchar(30) not null,
    Primary key(Id)
) engine = Innodb;

insert into regions values(1,"Upper East","Bolegatanga"),
(2,"Upper West","Wa"),(3,"Northern","Tamale"),
(4,"Brong Ahafo","Sunyani"),(5,"Ashanti","Kumasi"),
(6,"Eastern","Koforidua"),(7,"Western","Takoradi"),
(8,"Central","Cape Coast"),(9,"Greater Accra","Accra"),
(10,"Volta","Ho");

create table if not exists Jobs(
Id int unsigned auto_increment,
Company varchar(255),
Title varchar(255),
Empstatus varchar(20),
Category varchar(50), 
Description text,
Education varchar(50),
Experience varchar(50),
Location varchar(50),
Region varchar(50),
Contactaddr tinytext,
Phone varchar(15), 
Email varchar(255),
Website varchar(200),
Deadline Date,
Lastupdated timestamp default current_timestamp on update current_timestamp,
Listedby int, 
Position int(5),
constraint pk_job primary key(Id)
) engine = innodb;

create table if not exists Jobcategory(
Id int unsigned auto_increment,
Category varchar(50),
primary key(Id)
)engine = innodb;

create table if not exists Businessdir(
Id int unsigned auto_increment, 
Company varchar(80) unique key,
Category varchar(50),
Address varchar(60),
Emailaddr varchar(60),
Website varchar(255),
Location varchar(50),
Region varchar(50),
Phone varchar(20),
Fax varchar(20),
Description text,
Lastupdated timestamp default current_timestamp on update current_timestamp,
Position int(5),
constraint pkcomp primary key(Id)
)engine = innodb;

create table if not exists Bizcategory(
Id int unsigned auto_increment,
Category varchar(50),
primary key(Id)
)engine = innodb;

insert into  Bizcategory values
(1,'Agency'),
(2,'Consultancy'),
(3,'Trading Company'),
(4,'Education'),
(5,'Financial Institution'),
(6,'IT Firm'),
(7,'Non-Governmental Organisation (NGO)'),
(8,'Health Care'),
(9,'Transport'),
(10,'Oil and Gas'),
(11,'Mining'),
(12,'Manufacturing'),
(13,'Telecommunication Network'),
(14,'Real Estate Developers');


*/
