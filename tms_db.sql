/* Create database */
CREATE DATABASE tms_db;


/*user table code*/

CREATE TABLE tbuser(
    user_id int (10)AUTO_INCREMENT NOT null primary key,
    user_name varchar (200) NOT null,
    email varchar (200) NOT null,
    pwd varchar (200) not null,
    user_role tinyint(2),
    created_at datetime not null DEFAULT CURRENT_TIMESTAMP,
    updated_at datetime NOT null DEFAULT CURRENT_TIMESTAMP,
    created_by int not null,
    updated_by int not null);
    
/* insert value into user table */

INSERT INTO `tbuser`(`user_id`, `user_name`, `email`, `pwd`, `user_role`,`created_by`, `updated_by`) VALUES ('1','admin','admin@gmail.com','123','1','1','1');        
    
/*project list code*/
    
    CREATE TABLE tbproject_list(
    project_id int PRIMARY key AUTO_INCREMENT not null,
    vendor_id int not null,
    project_name text not null,
    description text not null,
    end_date date not null,
    created_at datetime not null DEFAULT CURRENT_TIMESTAMP,
    updated_at datetime NOT null DEFAULT CURRENT_TIMESTAMP,
    created_by int not null,
    updated_by int not null);
    
/* task title_tables code */
    
    CREATE TABLE tbtask_title(
    task_id int PRIMARY key AUTO_INCREMENT not null,
    project_id int not null,
    task_title text not null,
    description text not null,
    t_status tinyint(3) not null,
    priority tinyint(4) not null,
    created_at datetime not null DEFAULT CURRENT_TIMESTAMP,
    updated_at datetime NOT null DEFAULT CURRENT_TIMESTAMP,
    created_by int not null,
    updated_by int not null);
    
/* task comment table */

 CREATE TABLE tbtask_comment(
    id int PRIMARY key AUTO_INCREMENT not null,
    task_id int not null,
    user_id int not null,
    comments text,
    created_at datetime not null DEFAULT CURRENT_TIMESTAMP,
    updated_at datetime NOT null DEFAULT CURRENT_TIMESTAMP,
    created_by int not null,
    updated_by int not null);
  
/* vendor list table */

CREATE TABLE tbvendor_list(
    vendor_id int PRIMARY key AUTO_INCREMENT not null,
    vendor_name varchar(200) not null,
    user_id int not null,
    created_at datetime not null DEFAULT CURRENT_TIMESTAMP,
    updated_at datetime NOT null DEFAULT CURRENT_TIMESTAMP,
    created_by int not null,
    updated_by int not null);  
    
/* user role table */
 CREATE TABLE tb_userid(
    user_id int(10) PRIMARY KEY AUTO_INCREMENT not null,
    user_role varchar(200) not null);
    
/* insert values into tb user role */    
    
    insert into tb_userid (user_role) values('Admin'),('User');
 
    
/* tb status table*/ 
CREATE TABLE tbstatus(
    status_id int(10) PRIMARY KEY AUTO_INCREMENT not null,
    status_value varchar(200) not null);
    
/*insert values into tb status table*/
 insert into tbstatus (status_value) values('Started'),('On-progress'),('Done');
 
 
/*tb priority table */
CREATE TABLE tbpriority(
    priority_id int(10) PRIMARY KEY AUTO_INCREMENT not null,
    priority_value varchar(200) not null);
    
/*insert values into tb priority table*/
INSERT into tbpriority (priority_value) VALUES ('Critical'),('Important'),('Normal'),('Low');
