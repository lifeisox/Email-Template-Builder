CREATE DATABASE IF NOT EXISTS cst8334;

USE cst8334;

DROP TABLE IF EXISTS template_body;
DROP TABLE IF EXISTS template;
DROP TABLE IF EXISTS template_base;

CREATE TABLE IF NOT EXISTS template_base (
	base_id int not null primary key,
    base_name varchar(30) not null default '' -- Important, it decides the file name of base template
);

CREATE TABLE IF NOT EXISTS template ( 
	template_id int not null auto_increment primary key,
    base_id int not null,
    template_name varchar(30) not null default '',
    width int not null default 600, -- Template Width: minimum 400px maximum 800px
    email_subject varchar(100) null default 'This is for Email header.',
    company_name varchar(40) null default 'ServiceSoft',
    company_phone varchar(20) null default '613.227.8801',
    company_email varchar(50) null default 'chris@servicesoft.ca',
    company_address varchar(100) null default '110 Laurier Ave W, Ottawa, ON K1P 1J1',
    company_facebook varchar(100) null default '#',
    company_twitter varchar(100) null default '#',
    company_googleplus varchar(100) null default '#',
    company_instagram varchar(100) null default '#',
    constraint template_fk1 foreign key (base_id) references template_base (base_id)
);

CREATE TABLE IF NOT EXISTS template_body (
	template_id int not null,
    sequential_id int not null,
    body_id int not null, -- (0) Bold text only, (1) Text only, (2) Image only, (3) Image+Text, (4) Text+Image (5) Button (6) Spacer
    control_path varchar(100) null, -- If image, it's image path, but if buton, it's button link path
    body_text varchar(3000) null,
    primary key (template_id, sequential_id),
    constraint template_body_fk1 foreign key (template_id) references template (template_id)
);    

CREATE USER 'acdeveloper'@'localhost' IDENTIFIED BY 'acdeveloper';  
GRANT ALL PRIVILEGES ON cst8334.* TO 'acdeveloper'@'localhost';      