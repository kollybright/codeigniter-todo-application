What is this repository for?

    This repository is majorly for web services, it's a MVC todo web based application written in codeigniter, whereby a user can create (events and time of the events),update and delete. There is a registration and user authentication page before a user can have access to their page.
    version 2.14.2.windows.3

How do I get set up?

    Registration page->Login page->user page
    bootstrap, JQuery
    Database configuration
        Host->"localhost" or "127.0.0.1"
        Username->"root"
        Password->""
        Database->Todo
        TABLES
            reg_users-> holds user details
            todo->holds events
            column todo.user_id=reg_users.user_id is the matching order
						SQL:
 CREATE DATABASE todo;						
 CREATE TABLE reg_users(
  user_id INT NOT NULL  AUTO_INCREMENT PRIMARY KEY ,
  email VARCHAR(50),
  username VARCHAR(50) NOT NULL,
  password VARCHAR(50) NOT NULL
);

CREATE  TABLE  todo (
  event_id INT  NOT  NULL AUTO_INCREMENT PRIMARY KEY ,
  event VARCHAR (100) NOT  NULL ,
  the_time VARCHAR(10) NOT  NULL ,
  user_id INT NOT NULL,
  CONSTRAINT fk_todo_user_id FOREIGN KEY (user_id) REFERENCES reg_users(user_id) ON DELETE CASCADE
);

						
		config : base_url=>http://localhost/CodeIgniter/todo
		registration page=>http://localhost/CodeIgniter/todo/register
		signin page  =>http://localhost/CodeIgniter/too/sigin
		user page =>http://localhost/CodeIgniter/todo/homepage
ROUTES
$route['todo'] = "Example";
$route['todo/login']='Example/login';
$route['todo/logout']='Example/logout';
$route['todo/homepage']='Example/homepage';
$route['todo/register']='Example/validate_insert_users';
$route['todo/signin']='Example/signin';
$route['todo/signin_error']='Example/signin_error';
Who do I talk to?

    kolaoyafajo@gmail.com
