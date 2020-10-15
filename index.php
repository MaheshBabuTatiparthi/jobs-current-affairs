<?php
/**
 * @author Mahesh Babu <app@godigitally.co.in>
 * @copyright Go Digitally 2020
 * @package go-current-affairs
 * 
 * 
 * Created using IMA BuildeRz v3
 */


/** site **/
$config["app-name"]			= "Go Current Affairs" ; //Write the name of your website
$config["app-desc"]			= "Current Affairs and Job News" ; //Write a brief description of your website
$config["utf8"]				= true; 
$config["background"]		= "https://cdn.jsdelivr.net/wp/themes/twentyseventeen/1.1/assets/images/coffee.jpg"; 
$config["logo"]		= "https://placehold.it/200x200"; 
$config["timezone"]		= "Asia/Kolkata" ; // check this site: http://php.net/manual/en/timezones.php
$config["color"]			= "green"; 
$config["debug"]			= false; 
$config["gzip"]			= false; //compressed page 

/** mysql **/
$config["db_host"]				= "us-cdbr-east-02.cleardb.com" ; //host
$config["db_user"]				= "b5e6463ddd0ec9" ; //Username SQL
$config["db_pwd"]				= "21497123" ; //Password SQL
$config["db_name"]			= "heroku_6c9b400be692e1e" ; //Database

/** onesignal **/
$config["onesignal_app_id"]				= "42a9e335-5d88-4092-b4d8-f3a24e064107" ; //Your OneSignal AppId, available in OneSignal https://documentation.onesignal.com/docs/generate-a-google-server-api-key
$config["onesignal_api_key"]			= "ZjYzY2EyOTItM2RlOS00MjNjLTg5MWUtZGI2ZmJhYWNkNWZm" ; //Your OneSignal ApiKey, required for push notification sender


/** DON'T EDIT THE CODE BELLOW **/
session_start();
if($config["gzip"]==true){
	ob_start("ob_gzhandler");
}
ini_set("internal_encoding", "utf-8");
date_default_timezone_set($config["timezone"]);
if(!isset($_SESSION["IS_LOGIN"])){
	$_SESSION["IS_LOGIN"] = false;
}
$app_name = $config["app-name"];
$app_desc = $config["app-desc"];
$page_title = "Welcome";
$content = $body_class = "";

if(!isset($_GET["page"])){
	$_GET["page"] = "home";
}
if($_GET["page"]==""){
	$_GET["page"] = "home";
}
if(!isset($_GET["action"])){
	$_GET["action"] = "list";
}
if($config["debug"]==true){
	error_reporting(E_ALL);
}else{
	error_reporting(0);
}

/** connect to mysql **/
$mysql = new mysqli($config["db_host"], $config["db_user"], $config["db_pwd"], $config["db_name"]);
if (mysqli_connect_errno()){
	die(mysqli_connect_error());
}

if($config["utf8"]==true){
	$mysql->set_charset("utf8");
}

switch($_GET["page"]){
	// TODO: PAGE - HOME
	case "home":
		if($_SESSION["IS_LOGIN"]==false){
			header("Location: ?page=login");
		}
		$page_title = "Dashboard";
		$body_class = "hold-transition skin-".$config["color"]." sidebar-mini";
		$current_user = $_SESSION["CURRENT_USER"];
		$content = null;
		$content .= '<div class="wrapper">';
		$content .= '<header class="main-header">';
		$content .= '<a href="?" class="logo">';
		$content .= '<span class="logo-mini"><b>PN</b>L</span>';
		$content .= '<span class="logo-lg"><b>'.$app_name.'</b> Panel</span>';
		$content .= '</a>';
		$content .= '<nav class="navbar navbar-static-top">';
		$content .= '<a href="?" class="sidebar-toggle" data-toggle="push-menu" role="button">';
		$content .= '<span class="sr-only">Toggle navigation</span>';
		$content .= '<span class="icon-bar"></span>';
		$content .= '<span class="icon-bar"></span>';
		$content .= '<span class="icon-bar"></span>';
		$content .= '</a>';
		$content .= '<div class="navbar-custom-menu">';
		$content .= '<ul class="nav navbar-nav">';
		$content .= '<li class="dropdown user user-menu">';
		$content .= '<a href="?" class="dropdown-toggle" data-toggle="dropdown">';
		$content .= '<img src="https://www.gravatar.com/avatar/' . md5(strtolower(trim($current_user['user_email']))).'" class="user-image" alt="User Image">';
		$content .= '<span class="hidden-xs">' . htmlentities(stripslashes($current_user['user_name'])).'</span>';
		$content .= '</a>';
		$content .= '<ul class="dropdown-menu">';
		$content .= '<li class="user-header">';
		$content .= '<img src="https://www.gravatar.com/avatar/' . md5(strtolower(trim($current_user['user_email']))).'" class="img-circle" alt="User Image">';
		$content .= '<p>';
		$content .= '' . htmlentities(stripslashes($current_user['user_name'])).'';
		$content .= '<small>' . htmlentities(stripslashes($current_user['user_level'])).'</small>';
		$content .= '</p>';
		$content .= '</li>';
		$content .= '<li class="user-footer">';
		$content .= '<div class="pull-left">';
		$content .= '<a href="?page=profile" class="btn btn-default btn-flat">Profile</a>';
		$content .= '</div>';
		$content .= '<div class="pull-right">';
		$content .= '<a href="?page=logout" class="btn btn-default btn-flat">Sign out</a>';
		$content .= '</div>';
		$content .= '</li>';
		$content .= '</ul>';
		$content .= '</li>';
		$content .= '</ul>';
		$content .= '</div>';
		$content .= '</nav>';
		$content .= '</header>';
		$content .= '<aside class="main-sidebar">';
		$content .= '<section class="sidebar">';
		$content .= '<div class="user-panel">';
		$content .= '<div class="pull-left image">';
		$content .= '<img src="https://www.gravatar.com/avatar/' . md5(strtolower(trim($current_user['user_email']))).'" class="img-circle" alt="'.htmlentities(stripslashes($current_user['user_name'])).'">';
		$content .= '</div>';
		$content .= '<div class="pull-left info">';
		$content .= '<p>'.htmlentities(stripslashes($current_user['user_name'])).'</p>';
		$content .= '<a href="?"><i class="fa fa-circle text-success"></i> '.htmlentities(stripslashes($current_user['user_level'])).'</a>';
		$content .= '</div>';
		$content .= '</div>';
		$content .= '<ul class="sidebar-menu" data-widget="tree">';
		$content .= '<li class="header">DATA MANAGER</li>';
		$content .= '<li class="treeview active">';
		$content .= '<a href="?">';
		$content .= '<i class="fa fa-sitemap"></i> <span>Categories</span>';
		$content .= '<span class="pull-right-container">';
		$content .= '<i class="fa fa-angle-left pull-right"></i>';
		$content .= '</span>';
		$content .= '</a>';
		$content .= '<ul class="treeview-menu">';
		$content .= '<li><a href="?page=categories&amp;action=add"><i class="fa fa-plus"></i> Add New</a></li>';
		$content .= '<li><a href="?page=categories&amp;action=list"><i class="fa fa-list-ul"></i> All Categories</a></li>';
		$content .= '</ul>';
		$content .= '</li>';
		$content .= '<li class="treeview ">';
		$content .= '<a href="?">';
		$content .= '<i class="fa fa-newspaper-o"></i> <span>Chapters</span>';
		$content .= '<span class="pull-right-container">';
		$content .= '<i class="fa fa-angle-left pull-right"></i>';
		$content .= '</span>';
		$content .= '</a>';
		$content .= '<ul class="treeview-menu">';
		$content .= '<li><a href="?page=chapters&amp;action=add"><i class="fa fa-plus"></i> Add New</a></li>';
		$content .= '<li><a href="?page=chapters&amp;action=list"><i class="fa fa-list-ul"></i> All Chapters</a></li>';
		$content .= '</ul>';
		$content .= '</li>';
		$content .= '<li class="treeview ">';
		$content .= '<a href="?">';
		$content .= '<i class="fa fa-briefcase"></i> <span>Jobs</span>';
		$content .= '<span class="pull-right-container">';
		$content .= '<i class="fa fa-angle-left pull-right"></i>';
		$content .= '</span>';
		$content .= '</a>';
		$content .= '<ul class="treeview-menu">';
		$content .= '<li><a href="?page=jobs&amp;action=add"><i class="fa fa-plus"></i> Add New</a></li>';
		$content .= '<li><a href="?page=jobs&amp;action=list"><i class="fa fa-list-ul"></i> All Jobs</a></li>';
		$content .= '</ul>';
		$content .= '</li>';
		$content .= '<li class="header">TOOLS</li>';
		$content .= '<li><a href="?page=onesignal-sender"><i class="fa fa-send"></i> <span>OneSignal Sender</span></a></li>';
		$content .= '<li class="header">USERS</li>';
		$content .= '<li class="treeview">';
		$content .= '<a href="?">';
		$content .= '<i class="fa fa-users"></i> <span>Users</span>';
		$content .= '<span class="pull-right-container">';
		$content .= '<i class="fa fa-angle-left pull-right"></i>';
		$content .= '</span>';
		$content .= '</a>';
		$content .= '<ul class="treeview-menu">';
		$content .= '<li><a href="?page=users&amp;action=add"><i class="fa fa-plus"></i> Add New</a></li>';
		$content .= '<li><a href="?page=users"><i class="fa fa-users"></i> <span>All Users</span></a></li>';
		$content .= '</ul>';
		$content .= '</li>';
		$content .= '<li><a href="?page=profile"><i class="fa fa-user"></i> <span>Your Profile</span></a></li>';
		$content .= '</ul>';
		$content .= '</section>';
		$content .= '</aside>';
		$content .= '<div class="content-wrapper">';
		/** breadcrumb **/
		$content .= '<section class="content-header">';
		$content .= '<h1>Dashboard</h1>';
		$content .= '<ol class="breadcrumb">';
		$content .= '<li><a href="?"><i class="fa fa-dashboard"></i> Home</a></li>';
		$content .= '<li class="active">Dashboard</li>';
		$content .= '</ol>';
		$content .= '</section>';
		/** content **/
		$content .= '<section class="content">';
		$content .= '<div class="box">';
		$content .= '<div class="box-header with-border">';
		$content .= '<h3 class="box-title">Welcome</h3>';
		$content .= '<div class="box-tools pull-right">';
		$content .= '<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>';
		$content .= '<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>';
		$content .= '</div>';
		$content .= '</div>';
		$content .= '<div class="box-body">';
		$content .= '<div class="well">';
		$content .= '<h2>Welcome to</h2><h1>'.$app_name.'!</h1>';
		$content .= '<p class="lead">'.$app_desc.'</p>';
		$content .= '</div>';
		$content .= '<div class="row">';
		
		/** count categories data **/
		$sql_query = "SELECT COUNT(*) AS `total` FROM `categories` LIMIT 0,1" ;
		$result = $mysql->query($sql_query);
		$count = $result->fetch_array();
		$content .= '<div class="col-lg-3 col-xs-6">';
		$content .= '<div class="small-box bg-blue">';
		$content .= '<div class="inner">';
		$content .= '<h3>'.$count["total"].'<sup style="font-size: 20px">items</sup></h3>';
		$content .= '<p>Categories</p>';
		$content .= '</div>';
		$content .= '<div class="icon">';
		$content .= '<i class="fa fa-sitemap"></i>';
		$content .= '</div>';
		$content .= '<a href="?page=categories&amp;action=list" class="small-box-footer">';
		$content .= 'More <i class="fa fa-arrow-circle-right"></i>';
		$content .= '</a>';
		$content .= '</div>';
		$content .= '</div>';
		
		/** count chapters data **/
		$sql_query = "SELECT COUNT(*) AS `total` FROM `chapters` LIMIT 0,1" ;
		$result = $mysql->query($sql_query);
		$count = $result->fetch_array();
		$content .= '<div class="col-lg-3 col-xs-6">';
		$content .= '<div class="small-box bg-yellow">';
		$content .= '<div class="inner">';
		$content .= '<h3>'.$count["total"].'<sup style="font-size: 20px">items</sup></h3>';
		$content .= '<p>Chapters</p>';
		$content .= '</div>';
		$content .= '<div class="icon">';
		$content .= '<i class="fa fa-newspaper-o"></i>';
		$content .= '</div>';
		$content .= '<a href="?page=chapters&amp;action=list" class="small-box-footer">';
		$content .= 'More <i class="fa fa-arrow-circle-right"></i>';
		$content .= '</a>';
		$content .= '</div>';
		$content .= '</div>';
		
		/** count jobs data **/
		$sql_query = "SELECT COUNT(*) AS `total` FROM `jobs` LIMIT 0,1" ;
		$result = $mysql->query($sql_query);
		$count = $result->fetch_array();
		$content .= '<div class="col-lg-3 col-xs-6">';
		$content .= '<div class="small-box bg-green">';
		$content .= '<div class="inner">';
		$content .= '<h3>'.$count["total"].'<sup style="font-size: 20px">items</sup></h3>';
		$content .= '<p>Jobs</p>';
		$content .= '</div>';
		$content .= '<div class="icon">';
		$content .= '<i class="fa fa-briefcase"></i>';
		$content .= '</div>';
		$content .= '<a href="?page=jobs&amp;action=list" class="small-box-footer">';
		$content .= 'More <i class="fa fa-arrow-circle-right"></i>';
		$content .= '</a>';
		$content .= '</div>';
		$content .= '</div>';
		$content .= '</div>';
		$content .= '</div>';
		$content .= '</div>';
		$content .= '</section>';
		$content .= '</div>';
		$content .= '<footer class="main-footer">';
		$content .= '<div class="pull-right hidden-xs">';
		$content .= '<b>Version</b> 01.01.01';
		$content .= '</div>';
		$content .= '<strong>Copyright &copy; '.date("Y").' <a href="https://godigitally.co.in">Go Digitally</a>.</strong> All rights reserved.';
		$content .= '</footer>';
		$content .= '</div>';
		break;
	// TODO: PAGE - LOGIN
	case "login":
		$page_title = "Login";
		$body_class = "hold-transition login-page";
		$notification = '<p class="login-box-msg text-success">Sign in to start your session</p>';
		if(isset($_POST["submit"])){
			if(filter_var($_POST["user"]["email"], FILTER_VALIDATE_EMAIL)) {
				$user_email = addslashes($_POST["user"]["email"]);
				$user_password = sha1("imabuilder" . $_POST["user"]["password"]);
				$sql_query = "SELECT * FROM `users` WHERE `user_email` = '{$user_email}' AND `user_password` = '{$user_password}' AND `user_level` = 'admin' AND `user_status` = 'active'" ;
				$result = $mysql->query($sql_query);
				$current_user = $result->fetch_array();
				if(isset($current_user["user_email"])){
					$_SESSION["IS_LOGIN"] = true;
					$_SESSION["CURRENT_USER"]["user_id"] = $current_user["user_id"];
					$_SESSION["CURRENT_USER"]["user_name"] = $current_user["user_name"];
					$_SESSION["CURRENT_USER"]["user_first_name"] = $current_user["user_first_name"];
					$_SESSION["CURRENT_USER"]["user_last_name"] = $current_user["user_last_name"];
					$_SESSION["CURRENT_USER"]["user_email"] = $current_user["user_email"];
					$_SESSION["CURRENT_USER"]["user_level"] = $current_user["user_level"];
					header("Location: ?page=home");
				}else{
					$notification =  '<p class="login-box-msg text-danger">Incorrect email or password, please try again</p>';
				}
			}else{
				$notification =  '<p class="login-box-msg text-danger">Incorrect email or password, please try again!</p>';
			}
		}
		$content = null;
		$content .= '<div class="login-box">';
		$content .= '<div class="login-logo">';
		$content .= '<img src="'.$config["logo"].'?1602743856" />';
		$content .= '<br/><a href="?"><b>'. $app_name .'</b> Panel</a>';
		$content .= '</div>';
		$content .= '<div class="login-box-body">';
		$content .= '<h4 class="text-center">Admin</h4>';
		$content .= $notification;
		$content .= '<form action="" method="post" autocomplete="off">';
		$content .= '<div class="form-group has-feedback">';
		$content .= '<input type="email" name="user[email]" class="form-control" placeholder="Email" autocomplete="off">';
		$content .= '<span class="glyphicon glyphicon-envelope form-control-feedback"></span>';
		$content .= '</div>';
		$content .= '<div class="form-group has-feedback">';
		$content .= '<input type="password" name="user[password]" class="form-control" placeholder="Password" autocomplete="off">';
		$content .= '<span class="glyphicon glyphicon-lock form-control-feedback"></span>';
		$content .= '</div>';
		$content .= '<div class="row">';
		$content .= '<div class="col-xs-8">';
		$content .= '</div>';
		$content .= '<div class="col-xs-4">';
		$content .= '<button type="submit" name="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>';
		$content .= '</div>';
		$content .= '</div>';
		$content .= '</form>';
		$content .= '</div>';
		$content .= '</div>';
		break;
	// TODO: PAGE - LOGOUT
	case "logout":
		unset($_SESSION["IS_LOGIN"]);
		unset($_SESSION["CURRENT_USER"]);
		//session_destroy();
		header("Location: ?page=login");
		break;
	// TODO: PAGE - CATEGORIES
	case "categories":
		$notification = null;
		if(isset($_GET["notice"])){
			switch($_GET["notice"]){
				case "success-delete":
					$notification .= '<div id="notification" class="alert alert-success">';
					$notification .= '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
					$notification .= 'You have successfully deleted the item of the <strong>Categories data</strong>';
					$notification .= '</div>';
					break;
				case "success-edit":
					$notification .= '<div id="notification" class="alert alert-success">';
					$notification .= '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
					$notification .= 'You have successfully update the item of the <strong>Categories data</strong>';
					$notification .= '</div>';
					break;
				case "success-add":
					$notification .= '<div id="notification" class="alert alert-success">';
					$notification .= '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
					$notification .= 'You have successfully add new item to the <strong>Categories data</strong>';
					$notification .= '</div>';
					break;
				case "wrong-id":
					$notification .= '<div id="notification" class="alert alert-danger">';
					$notification .= '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
					$notification .= 'You did not find ID of this item in <strong>Categories</strong>';
					$notification .= '</div>';
					break;
			}
		}
		if($_SESSION["IS_LOGIN"]==false){
			header("Location: ?page=login");
		}
		$page_title = "Categories";
		$body_class = "hold-transition skin-".$config["color"]." sidebar-mini";
		$current_user = $_SESSION["CURRENT_USER"];
		$content = null;
		$content .= '<div class="wrapper">';
		$content .= '<header class="main-header">';
		$content .= '<a href="?" class="logo">';
		$content .= '<span class="logo-mini"><b>PN</b>L</span>';
		$content .= '<span class="logo-lg"><b>'.$app_name.'</b> Panel</span>';
		$content .= '</a>';
		$content .= '<nav class="navbar navbar-static-top">';
		$content .= '<a href="?" class="sidebar-toggle" data-toggle="push-menu" role="button">';
		$content .= '<span class="sr-only">Toggle navigation</span>';
		$content .= '<span class="icon-bar"></span>';
		$content .= '<span class="icon-bar"></span>';
		$content .= '<span class="icon-bar"></span>';
		$content .= '</a>';
		$content .= '<div class="navbar-custom-menu">';
		$content .= '<ul class="nav navbar-nav">';
		$content .= '<li class="dropdown user user-menu">';
		$content .= '<a href="?" class="dropdown-toggle" data-toggle="dropdown">';
		$content .= '<img src="https://www.gravatar.com/avatar/' . md5(strtolower(trim($current_user['user_email']))).'" class="user-image" alt="User Image">';
		$content .= '<span class="hidden-xs">' . htmlentities(stripslashes($current_user['user_name'])).'</span>';
		$content .= '</a>';
		$content .= '<ul class="dropdown-menu">';
		$content .= '<li class="user-header">';
		$content .= '<img src="https://www.gravatar.com/avatar/' . md5(strtolower(trim($current_user['user_email']))).'" class="img-circle" alt="User Image">';
		$content .= '<p>';
		$content .= '' . htmlentities(stripslashes($current_user['user_name'])).'';
		$content .= '<small>' . htmlentities(stripslashes($current_user['user_level'])).'</small>';
		$content .= '</p>';
		$content .= '</li>';
		$content .= '<li class="user-footer">';
		$content .= '<div class="pull-left">';
		$content .= '<a href="?page=profile" class="btn btn-default btn-flat">Profile</a>';
		$content .= '</div>';
		$content .= '<div class="pull-right">';
		$content .= '<a href="?page=logout" class="btn btn-default btn-flat">Sign out</a>';
		$content .= '</div>';
		$content .= '</li>';
		$content .= '</ul>';
		$content .= '<li>';
		$content .= '</ul>';
		$content .= '</div>';
		$content .= '</nav>';
		$content .= '</header>';
		$content .= '<aside class="main-sidebar">';
		$content .= '<section class="sidebar">';
		$content .= '<div class="user-panel">';
		$content .= '<div class="pull-left image">';
		$content .= '<img src="https://www.gravatar.com/avatar/' . md5(strtolower(trim($current_user['user_email']))).'" class="img-circle" alt="'.htmlentities(stripslashes($current_user['user_name'])).'">';
		$content .= '</div>';
		$content .= '<div class="pull-left info">';
		$content .= '<p>'.htmlentities(stripslashes($current_user['user_name'])).'</p>';
		$content .= '<a href="?"><i class="fa fa-circle text-success"></i> '.htmlentities(stripslashes($current_user['user_level'])).'</a>';
		$content .= '</div>';
		$content .= '</div>';
		$content .= '<ul class="sidebar-menu" data-widget="tree">';
		$content .= '<li class="header">DATA MANAGER</li>';
		$content .= '<li class="treeview active">';
		$content .= '<a href="?">';
		$content .= '<i class="fa fa-sitemap"></i> <span>Categories</span>';
		$content .= '<span class="pull-right-container">';
		$content .= '<i class="fa fa-angle-left pull-right"></i>';
		$content .= '</span>';
		$content .= '</a>';
		$content .= '<ul class="treeview-menu">';
		$content .= '<li><a href="?page=categories&amp;action=add"><i class="fa fa-plus"></i> Add New</a></li>';
		$content .= '<li><a href="?page=categories&amp;action=list"><i class="fa fa-list-ul"></i> All Categories</a></li>';
		$content .= '</ul>';
		$content .= '</li>';
		$content .= '<li class="treeview ">';
		$content .= '<a href="?">';
		$content .= '<i class="fa fa-newspaper-o"></i> <span>Chapters</span>';
		$content .= '<span class="pull-right-container">';
		$content .= '<i class="fa fa-angle-left pull-right"></i>';
		$content .= '</span>';
		$content .= '</a>';
		$content .= '<ul class="treeview-menu">';
		$content .= '<li><a href="?page=chapters&amp;action=add"><i class="fa fa-plus"></i> Add New</a></li>';
		$content .= '<li><a href="?page=chapters&amp;action=list"><i class="fa fa-list-ul"></i> All Chapters</a></li>';
		$content .= '</ul>';
		$content .= '</li>';
		$content .= '<li class="treeview ">';
		$content .= '<a href="?">';
		$content .= '<i class="fa fa-briefcase"></i> <span>Jobs</span>';
		$content .= '<span class="pull-right-container">';
		$content .= '<i class="fa fa-angle-left pull-right"></i>';
		$content .= '</span>';
		$content .= '</a>';
		$content .= '<ul class="treeview-menu">';
		$content .= '<li><a href="?page=jobs&amp;action=add"><i class="fa fa-plus"></i> Add New</a></li>';
		$content .= '<li><a href="?page=jobs&amp;action=list"><i class="fa fa-list-ul"></i> All Jobs</a></li>';
		$content .= '</ul>';
		$content .= '</li>';
		$content .= '<li class="header">TOOLS</li>';
		$content .= '<li><a href="?page=onesignal-sender"><i class="fa fa-send"></i> <span>OneSignal Sender</span></a></li>';
		$content .= '<li class="header">USERS</li>';
		$content .= '<li class="treeview">';
		$content .= '<a href="?">';
		$content .= '<i class="fa fa-users"></i> <span>Users</span>';
		$content .= '<span class="pull-right-container">';
		$content .= '<i class="fa fa-angle-left pull-right"></i>';
		$content .= '</span>';
		$content .= '</a>';
		$content .= '<ul class="treeview-menu">';
		$content .= '<li><a href="?page=users&amp;action=add"><i class="fa fa-plus"></i> Add New</a></li>';
		$content .= '<li><a href="?page=users"><i class="fa fa-users"></i> <span>All Users</span></a></li>';
		$content .= '</ul>';
		$content .= '</li>';
		$content .= '<li><a href="?page=profile"><i class="fa fa-user"></i> <span>Your Profile</span></a></li>';
		$content .= '</ul>';
		$content .= '</section>';
		$content .= '</aside>';
		$content .= '<div class="content-wrapper">';
		switch($_GET["action"]){
			case "list":
				// TODO: PAGE - CATEGORIES - LIST
				/** breadcrumb **/
				$content .= '<section class="content-header">';
				$content .= '<h1>Categories<small></small></h1>';
				$content .= '<ol class="breadcrumb">';
				$content .= '<li><a href="?"><i class="fa fa-dashboard"></i> Home</a></li>';
				$content .= '<li><a href="?page=jobs&amp;action=list">Categories</a></li>';
				$content .= '<li class="active">List</li>';
				$content .= '</ol>';
				$content .= '</section>';
				/** content **/
				$content .= '<section class="content">';
				$content .= $notification;
				$content .= '<div class="box box-danger">';
				$content .= '<div class="box-header with-border">';
				$content .= '<h3 class="box-title">All Categories</h3>';
				$content .= '<div class="box-tools pull-right">';
				$content .= '<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>';
				$content .= '<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>';
				$content .= '</div>';
				$content .= '</div>';
				$content .= '<div class="box-body">';
				$content .= '<div class="table-responsive">';
				$content .= '<table class="datatable table table-striped table-hover">';
				$content .= '<thead>';
				$content .= '<tr>';
				$content .= '<th>Category Name</th>';
				$content .= '<th>Category Image</th>';
				$content .= '<th style="width:100px;">#</th>';
				$content .= '</tr>';
				$content .= '</thead>';
				$content .= '<tbody>';
				/** fetch data from mysql **/
				$sql_query = "SELECT * FROM `categories` ORDER BY `id` DESC" ;
				if($result = $mysql->query($sql_query)){
					while ($data = $result->fetch_array()){
						$content .= '<tr>';
						
						/** id **/
						
						/** category_name **/
						$content .= '<td>' . htmlentities(stripslashes(substr(strip_tags($data["category_name"]),0,64))) . '</td>';
						
						/** category_image **/
						if($data["category_image"] ==""){
							$data["category_image"] ="https://placehold.it/80x80";
						}
						$content .= '<td><img class="img-thumbnail" width="80" height="80" src="' . htmlentities(stripslashes(strip_tags($data["category_image"]))) . '" class="img-thumbnail" alt="..."/></td>';
						$content .= '<td>';
						$content .= '<a href="?page=categories&amp;action=edit&amp;id='.$data["id"].'" class="btn btn-success btn-flat btn-sm"><i class="fa fa-edit"></i></a>';
						$content .= '<a class="btn btn-danger btn-flat btn-sm" href="#" onClick="doModal(\'Delete Category\',\'<div class=\\\'row\\\'><div class=\\\'col-md-3 text-center text-primary\\\'><i class=\\\'fa fa-5x fa-sitemap\\\'></i></div><div class=\\\'col-md-9\\\'>You are about to permanently delete these items from your site. <br/>This action cannot be undo, `Cancel` to stop, `OK` to delete.</div></div>\',\'Ok\',\'danger\',\'window.location=\\\'?page=categories&amp;action=delete&amp;id='.$data["id"].'\\\'\');"><i class="fa fa-trash"></i></a>';
						$content .= '</td>';
						$content .= '</tr>';
					}
				}
				$content .= '</tbody>';
				$content .= '</table>';
				$content .= '</div>';
				$content .= '</div>';
				$content .= '</div>';
				$content .= '</section>';
				break;
			case "edit":
				// TODO: PAGE - CATEGORIES - EDIT
				if(isset($_GET["id"])){
					$entry_id= (int)$_GET["id"];
					/** fetch current data **/
					$sql_query = "SELECT * FROM `categories` WHERE `id`=$entry_id LIMIT 0,1" ;
					$result = $mysql->query($sql_query);
					$rowdata = $result->fetch_array();
					if(isset($rowdata["id"])){
						/** default value **/
						$postdata["category-name"] = "" ;
						$postdata["category-image"] = "" ;
						/** response postdata **/
						if(isset($_POST["submit"])){
							if(isset($_POST["postdata"]["category-name"])){
								$postdata["category-name"] = addslashes($_POST["postdata"]["category-name"]);
							}
							if(isset($_POST["postdata"]["category-image"])){
								$postdata["category-image"] = addslashes($_POST["postdata"]["category-image"]);
							}
							$sql_query = "UPDATE `categories` SET `category_name` = '{$postdata["category-name"]}' ,`category_image` = '{$postdata["category-image"]}'  WHERE `id`=$entry_id" ;
							$stmt = $mysql->prepare($sql_query);
							$stmt->execute();
							$stmt->close();
							header("Location: ?page=categories&action=edit&id=".$entry_id."&notice=success-edit");
						}
						/** init variable field **/
						$postdata["category-name"] = '';
						if(isset($rowdata["category_name"])){
							$postdata["category-name"] = stripslashes($rowdata["category_name"]);
						}
						$postdata["category-image"] = '';
						if(isset($rowdata["category_image"])){
							$postdata["category-image"] = stripslashes($rowdata["category_image"]);
						}
						/** breadcrumb **/
						$content .= '<section class="content-header">';
						$content .= '<h1>Categories <small></small></h1>';
						$content .= '<ol class="breadcrumb">';
						$content .= '<li><a href="?"><i class="fa fa-dashboard"></i> Home</a></li>';
						$content .= '<li><a href="?">Categories</a></li>';
						$content .= '<li class="active">Edit</li>';
						$content .= '</ol>';
						$content .= '</section>';
						/** content **/
						$content .= '<section class="content">';
						$content .= $notification;
						$content .= '<form action="" method="post">';
						$content .= '<div class="box box-primary">';
						$content .= '<div class="box-header with-border">';
						$content .= '<h3 class="box-title">Edit Category</h3>';
						$content .= '<div class="box-tools pull-right">';
						$content .= '<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>';
						$content .= '<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>';
						$content .= '</div>';
						$content .= '</div>';
						$content .= '<div class="box-body">';
						$content .= '<div class="row">';
						/** field id:id **/
						/** field category_name:varchar **/
						$content .= '<div class="col-md-6">';
						$content .= '<div class="form-group">';
						$content .= '<label>Category Name</label>';
						$content .= '<input maxlength="128" name="postdata[category-name]" id="postdata-category-name" type="text" class="form-control" placeholder="Category Name" value="'.htmlentities(stripslashes($postdata['category-name'])).'" />';
						$content .= '<p class="help-block"></p>';
						$content .= '</div>';
						$content .= '</div>';
						/** field category_image:thumbnail **/
						$content .= '<div class="col-md-6">';
						$content .= '<div class="form-group">';
						$content .= '<label>Category Image</label>';
						$content .= '<div class="input-group">';
						$content .= '<input name="postdata[category-image]" id="postdata-category-image" type="text" class="form-control" placeholder="image.jpg" value="'.htmlentities(stripslashes($postdata['category-image'])).'" />';
						$content .= '<span class="input-group-btn">';
						$content .= '<button type="button" data-type="file-picker" class="btn btn-default btn-flat" data-target="#postdata-category-image">';
						$content .= '<i class="fa fa-folder-open"></i>';
						$content .= '</button>';
						$content .= '<a class="btn btn-default btn-flat" target="_blank" href="'.htmlentities(stripslashes($postdata['category-image'])).'" ><i class="fa fa-eye"></i></a>';
						$content .= '</span>';
						$content .= '</div>';
						$content .= '<p class="help-block"></p>';
						$content .= '</div>';
						$content .= '</div>';
						$content .= '</div>';
						$content .= '</div>';
						$content .= '<div class="box-footer">';
						$content .= '<button type="submit" class="btn btn-flat btn-primary" name="submit"><i class="fa fa-floppy-o"></i> Update</button>';
						$content .= '</div>';
						$content .= '</div>';
						$content .= '</form>';
						$content .= '</section>';
					}else{
						header("Location: ?page=categories&notice=wrong-id");
					}
				}else{
					header("Location: ?page=categories&notice=wrong-id");
				}
				break;
			case "add":
				// TODO: PAGE - CATEGORIES - ADD
				/** default value **/
				$postdata["category-name"] = "" ;
				$postdata["category-image"] = "" ;
				/** response postdata **/
				if(isset($_POST["submit"])){
					if(isset($_POST["postdata"]["category-name"])){
						$postdata["category-name"] = addslashes($_POST["postdata"]["category-name"]);
					}
					if(isset($_POST["postdata"]["category-image"])){
						$postdata["category-image"] = addslashes($_POST["postdata"]["category-image"]);
					}
					$sql_query = "INSERT INTO `categories` (`category_name`,`category_image`) VALUES ('{$postdata['category-name']}','{$postdata['category-image']}')" ;
					$mysql->query($sql_query);
					$last_id = $mysql->insert_id;
					header("Location: ?page=categories&notice=success-add&action=edit&id=".$last_id);
				}
				/** breadcrumb **/
				$content .= '<section class="content-header">';
				$content .= '<h1>Categories <small></small></h1>';
				$content .= '<ol class="breadcrumb">';
				$content .= '<li><a href="?"><i class="fa fa-dashboard"></i> Home</a></li>';
				$content .= '<li><a href="?">Categories</a></li>';
				$content .= '<li class="active">Add</li>';
				$content .= '</ol>';
				$content .= '</section>';
				/** content **/
				$content .= '<section class="content">';
				$content .= $notification;
				$content .= '<form action="" method="post">';
				$content .= '<div class="box box-success">';
				$content .= '<div class="box-header with-border">';
				$content .= '<h3 class="box-title">Add new Category</h3>';
				$content .= '<div class="box-tools pull-right">';
				$content .= '<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>';
				$content .= '<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>';
				$content .= '</div>';
				$content .= '</div>';
				$content .= '<div class="box-body">';
				$content .= '<div class="row">';
				/** field id:id **/
				/** field category_name:varchar **/
				$content .= '<div class="col-md-6">';
				$content .= '<div class="form-group">';
				$content .= '<label>Category Name</label>';
				$content .= '<input maxlength="128" name="postdata[category-name]" id="postdata-category-name" type="text" class="form-control" placeholder="Category Name" value="'.htmlentities(stripslashes($postdata['category-name'])).'" />';
				$content .= '<p class="help-block"></p>';
				$content .= '</div>';
				$content .= '</div>';
				/** field category_image:thumbnail **/
				$content .= '<div class="col-md-6">';
				$content .= '<div class="form-group">';
				$content .= '<label>Category Image</label>';
				$content .= '<div class="input-group">';
				$content .= '<input name="postdata[category-image]" id="postdata-category-image" type="text" class="form-control" placeholder="image.jpg" value="'.htmlentities(stripslashes($postdata['category-image'])).'" />';
				$content .= '<span class="input-group-btn">';
				$content .= '<button type="button" data-type="file-picker" class="btn btn-primary btn-flat" data-target="#postdata-category-image">';
				$content .= '<i class="fa fa-folder-open"></i>';
				$content .= '</button>';
				$content .= '</span>';
				$content .= '</div>';
				$content .= '<p class="help-block"></p>';
				$content .= '</div>';
				$content .= '</div>';
				$content .= '</div>';
				$content .= '</div>';
				$content .= '<div class="box-footer">';
				$content .= '<button type="submit" class="btn btn-flat btn-success" name="submit"><i class="fa fa-plus"></i> Add new Category</button>';
				$content .= '</div>';
				$content .= '</div>';
				$content .= '</form>';
				$content .= '</section>';
				break;
			case "delete":
				// TODO: PAGE - CATEGORIES - DELETE
				if(isset($_GET["id"])){
					$entry_id= (int)$_GET["id"];
					/** fetch current data **/
					$sql_query = "SELECT * FROM `categories` WHERE `id`=$entry_id LIMIT 0,1" ;
					$result = $mysql->query($sql_query);
					$rowdata = $result->fetch_array();
					if(isset($rowdata["id"])){
						$sql_query = "DELETE FROM `categories` WHERE `id`=$entry_id";
						$stmt = $mysql->prepare($sql_query);
						$stmt->execute();
						$stmt->close();
						header("Location: ?page=categories&notice=success-delete");
					}else{
						header("Location: ?page=categories&notice=wrong-id");
					}
				}
				break;
			}
			$content .= '</div>';
			$content .= '<footer class="main-footer">';
			$content .= '<div class="pull-right hidden-xs">';
			$content .= '<b>Version</b> 01.01.01';
			$content .= '</div>';
			$content .= '<strong>Copyright &copy; '.date("Y").' <a href="https://godigitally.co.in">Go Digitally</a>.</strong> All rights reserved.';
			$content .= '</footer>';
			$content .= '</div>';
			break;
	// TODO: PAGE - CHAPTERS
	case "chapters":
		$notification = null;
		if(isset($_GET["notice"])){
			switch($_GET["notice"]){
				case "success-delete":
					$notification .= '<div id="notification" class="alert alert-success">';
					$notification .= '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
					$notification .= 'You have successfully deleted the item of the <strong>Chapters data</strong>';
					$notification .= '</div>';
					break;
				case "success-edit":
					$notification .= '<div id="notification" class="alert alert-success">';
					$notification .= '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
					$notification .= 'You have successfully update the item of the <strong>Chapters data</strong>';
					$notification .= '</div>';
					break;
				case "success-add":
					$notification .= '<div id="notification" class="alert alert-success">';
					$notification .= '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
					$notification .= 'You have successfully add new item to the <strong>Chapters data</strong>';
					$notification .= '</div>';
					break;
				case "wrong-id":
					$notification .= '<div id="notification" class="alert alert-danger">';
					$notification .= '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
					$notification .= 'You did not find ID of this item in <strong>Chapters</strong>';
					$notification .= '</div>';
					break;
			}
		}
		if($_SESSION["IS_LOGIN"]==false){
			header("Location: ?page=login");
		}
		$page_title = "Chapters";
		$body_class = "hold-transition skin-".$config["color"]." sidebar-mini";
		$current_user = $_SESSION["CURRENT_USER"];
		$content = null;
		$content .= '<div class="wrapper">';
		$content .= '<header class="main-header">';
		$content .= '<a href="?" class="logo">';
		$content .= '<span class="logo-mini"><b>PN</b>L</span>';
		$content .= '<span class="logo-lg"><b>'.$app_name.'</b> Panel</span>';
		$content .= '</a>';
		$content .= '<nav class="navbar navbar-static-top">';
		$content .= '<a href="?" class="sidebar-toggle" data-toggle="push-menu" role="button">';
		$content .= '<span class="sr-only">Toggle navigation</span>';
		$content .= '<span class="icon-bar"></span>';
		$content .= '<span class="icon-bar"></span>';
		$content .= '<span class="icon-bar"></span>';
		$content .= '</a>';
		$content .= '<div class="navbar-custom-menu">';
		$content .= '<ul class="nav navbar-nav">';
		$content .= '<li class="dropdown user user-menu">';
		$content .= '<a href="?" class="dropdown-toggle" data-toggle="dropdown">';
		$content .= '<img src="https://www.gravatar.com/avatar/' . md5(strtolower(trim($current_user['user_email']))).'" class="user-image" alt="User Image">';
		$content .= '<span class="hidden-xs">' . htmlentities(stripslashes($current_user['user_name'])).'</span>';
		$content .= '</a>';
		$content .= '<ul class="dropdown-menu">';
		$content .= '<li class="user-header">';
		$content .= '<img src="https://www.gravatar.com/avatar/' . md5(strtolower(trim($current_user['user_email']))).'" class="img-circle" alt="User Image">';
		$content .= '<p>';
		$content .= '' . htmlentities(stripslashes($current_user['user_name'])).'';
		$content .= '<small>' . htmlentities(stripslashes($current_user['user_level'])).'</small>';
		$content .= '</p>';
		$content .= '</li>';
		$content .= '<li class="user-footer">';
		$content .= '<div class="pull-left">';
		$content .= '<a href="?page=profile" class="btn btn-default btn-flat">Profile</a>';
		$content .= '</div>';
		$content .= '<div class="pull-right">';
		$content .= '<a href="?page=logout" class="btn btn-default btn-flat">Sign out</a>';
		$content .= '</div>';
		$content .= '</li>';
		$content .= '</ul>';
		$content .= '<li>';
		$content .= '</ul>';
		$content .= '</div>';
		$content .= '</nav>';
		$content .= '</header>';
		$content .= '<aside class="main-sidebar">';
		$content .= '<section class="sidebar">';
		$content .= '<div class="user-panel">';
		$content .= '<div class="pull-left image">';
		$content .= '<img src="https://www.gravatar.com/avatar/' . md5(strtolower(trim($current_user['user_email']))).'" class="img-circle" alt="'.htmlentities(stripslashes($current_user['user_name'])).'">';
		$content .= '</div>';
		$content .= '<div class="pull-left info">';
		$content .= '<p>'.htmlentities(stripslashes($current_user['user_name'])).'</p>';
		$content .= '<a href="?"><i class="fa fa-circle text-success"></i> '.htmlentities(stripslashes($current_user['user_level'])).'</a>';
		$content .= '</div>';
		$content .= '</div>';
		$content .= '<ul class="sidebar-menu" data-widget="tree">';
		$content .= '<li class="header">DATA MANAGER</li>';
		$content .= '<li class="treeview ">';
		$content .= '<a href="?">';
		$content .= '<i class="fa fa-sitemap"></i> <span>Categories</span>';
		$content .= '<span class="pull-right-container">';
		$content .= '<i class="fa fa-angle-left pull-right"></i>';
		$content .= '</span>';
		$content .= '</a>';
		$content .= '<ul class="treeview-menu">';
		$content .= '<li><a href="?page=categories&amp;action=add"><i class="fa fa-plus"></i> Add New</a></li>';
		$content .= '<li><a href="?page=categories&amp;action=list"><i class="fa fa-list-ul"></i> All Categories</a></li>';
		$content .= '</ul>';
		$content .= '</li>';
		$content .= '<li class="treeview active">';
		$content .= '<a href="?">';
		$content .= '<i class="fa fa-newspaper-o"></i> <span>Chapters</span>';
		$content .= '<span class="pull-right-container">';
		$content .= '<i class="fa fa-angle-left pull-right"></i>';
		$content .= '</span>';
		$content .= '</a>';
		$content .= '<ul class="treeview-menu">';
		$content .= '<li><a href="?page=chapters&amp;action=add"><i class="fa fa-plus"></i> Add New</a></li>';
		$content .= '<li><a href="?page=chapters&amp;action=list"><i class="fa fa-list-ul"></i> All Chapters</a></li>';
		$content .= '</ul>';
		$content .= '</li>';
		$content .= '<li class="treeview ">';
		$content .= '<a href="?">';
		$content .= '<i class="fa fa-briefcase"></i> <span>Jobs</span>';
		$content .= '<span class="pull-right-container">';
		$content .= '<i class="fa fa-angle-left pull-right"></i>';
		$content .= '</span>';
		$content .= '</a>';
		$content .= '<ul class="treeview-menu">';
		$content .= '<li><a href="?page=jobs&amp;action=add"><i class="fa fa-plus"></i> Add New</a></li>';
		$content .= '<li><a href="?page=jobs&amp;action=list"><i class="fa fa-list-ul"></i> All Jobs</a></li>';
		$content .= '</ul>';
		$content .= '</li>';
		$content .= '<li class="header">TOOLS</li>';
		$content .= '<li><a href="?page=onesignal-sender"><i class="fa fa-send"></i> <span>OneSignal Sender</span></a></li>';
		$content .= '<li class="header">USERS</li>';
		$content .= '<li class="treeview">';
		$content .= '<a href="?">';
		$content .= '<i class="fa fa-users"></i> <span>Users</span>';
		$content .= '<span class="pull-right-container">';
		$content .= '<i class="fa fa-angle-left pull-right"></i>';
		$content .= '</span>';
		$content .= '</a>';
		$content .= '<ul class="treeview-menu">';
		$content .= '<li><a href="?page=users&amp;action=add"><i class="fa fa-plus"></i> Add New</a></li>';
		$content .= '<li><a href="?page=users"><i class="fa fa-users"></i> <span>All Users</span></a></li>';
		$content .= '</ul>';
		$content .= '</li>';
		$content .= '<li><a href="?page=profile"><i class="fa fa-user"></i> <span>Your Profile</span></a></li>';
		$content .= '</ul>';
		$content .= '</section>';
		$content .= '</aside>';
		$content .= '<div class="content-wrapper">';
		switch($_GET["action"]){
			case "list":
				// TODO: PAGE - CHAPTERS - LIST
				/** breadcrumb **/
				$content .= '<section class="content-header">';
				$content .= '<h1>Chapters<small></small></h1>';
				$content .= '<ol class="breadcrumb">';
				$content .= '<li><a href="?"><i class="fa fa-dashboard"></i> Home</a></li>';
				$content .= '<li><a href="?page=jobs&amp;action=list">Chapters</a></li>';
				$content .= '<li class="active">List</li>';
				$content .= '</ol>';
				$content .= '</section>';
				/** content **/
				$content .= '<section class="content">';
				$content .= $notification;
				$content .= '<div class="box box-danger">';
				$content .= '<div class="box-header with-border">';
				$content .= '<h3 class="box-title">All Chapters</h3>';
				$content .= '<div class="box-tools pull-right">';
				$content .= '<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>';
				$content .= '<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>';
				$content .= '</div>';
				$content .= '</div>';
				$content .= '<div class="box-body">';
				$content .= '<div class="table-responsive">';
				$content .= '<table class="datatable table table-striped table-hover">';
				$content .= '<thead>';
				$content .= '<tr>';
				$content .= '<th>Chapter Image</th>';
				$content .= '<th>Chapter Category</th>';
				$content .= '<th style="width:100px;">#</th>';
				$content .= '</tr>';
				$content .= '</thead>';
				$content .= '<tbody>';
				/** fetch data from mysql **/
				$sql_query = "SELECT * FROM `chapters` ORDER BY `id` DESC" ;
				if($result = $mysql->query($sql_query)){
					while ($data = $result->fetch_array()){
						$content .= '<tr>';
						
						/** id **/
						
						/** chapter_title **/
						
						/** chapter_image **/
						if($data["chapter_image"] ==""){
							$data["chapter_image"] ="https://placehold.it/80x80";
						}
						$content .= '<td><img class="img-thumbnail" width="80" height="80" src="' . htmlentities(stripslashes(strip_tags($data["chapter_image"]))) . '" class="img-thumbnail" alt="..."/></td>';
						
						/** chapter_category **/
						$categories_text = htmlentities(stripslashes($data["chapter_category"]));
						$sql_categories_query = "SELECT * FROM `categories` WHERE `id`='{$categories_text}'" ;
						$categories_result = $mysql->query($sql_categories_query);
						if($categories_result){
							$categories_result_data = $categories_result->fetch_array();
							if(isset($categories_result_data["category_name"])){
								$content .= '<td><span class="label label-success">' . htmlentities(stripslashes($categories_result_data["category_name"])) . '</span></td>';
							}else{
							$content .= '<td><span class="label label-danger">deleted</span></td>';
							}
						}else{
							$content .= '<td><span class="label label-danger">Not existing table</span></td>';
						}
						
						/** chapter_content **/
						$content .= '<td>';
						$content .= '<a href="?page=chapters&amp;action=edit&amp;id='.$data["id"].'" class="btn btn-success btn-flat btn-sm"><i class="fa fa-edit"></i></a>';
						$content .= '<a class="btn btn-danger btn-flat btn-sm" href="#" onClick="doModal(\'Delete Chapter\',\'<div class=\\\'row\\\'><div class=\\\'col-md-3 text-center text-primary\\\'><i class=\\\'fa fa-5x fa-newspaper-o\\\'></i></div><div class=\\\'col-md-9\\\'>You are about to permanently delete these items from your site. <br/>This action cannot be undo, `Cancel` to stop, `OK` to delete.</div></div>\',\'Ok\',\'danger\',\'window.location=\\\'?page=chapters&amp;action=delete&amp;id='.$data["id"].'\\\'\');"><i class="fa fa-trash"></i></a>';
						$content .= '</td>';
						$content .= '</tr>';
					}
				}
				$content .= '</tbody>';
				$content .= '</table>';
				$content .= '</div>';
				$content .= '</div>';
				$content .= '</div>';
				$content .= '</section>';
				break;
			case "edit":
				// TODO: PAGE - CHAPTERS - EDIT
				if(isset($_GET["id"])){
					$entry_id= (int)$_GET["id"];
					/** fetch current data **/
					$sql_query = "SELECT * FROM `chapters` WHERE `id`=$entry_id LIMIT 0,1" ;
					$result = $mysql->query($sql_query);
					$rowdata = $result->fetch_array();
					if(isset($rowdata["id"])){
						/** default value **/
						$postdata["chapter-title"] = "" ;
						$postdata["chapter-image"] = "" ;
						$postdata["chapter-category"] = "" ;
						$postdata["chapter-content"] = "" ;
						/** response postdata **/
						if(isset($_POST["submit"])){
							if(isset($_POST["postdata"]["chapter-title"])){
								$postdata["chapter-title"] = addslashes($_POST["postdata"]["chapter-title"]);
							}
							if(isset($_POST["postdata"]["chapter-image"])){
								$postdata["chapter-image"] = addslashes($_POST["postdata"]["chapter-image"]);
							}
							if(isset($_POST["postdata"]["chapter-category"])){
								$postdata["chapter-category"] = addslashes($_POST["postdata"]["chapter-category"]);
							}
							if(isset($_POST["postdata"]["chapter-content"])){
								$postdata["chapter-content"] = addslashes($_POST["postdata"]["chapter-content"]);
							}
							$sql_query = "UPDATE `chapters` SET `chapter_title` = '{$postdata["chapter-title"]}' ,`chapter_image` = '{$postdata["chapter-image"]}' ,`chapter_category` = '{$postdata["chapter-category"]}' ,`chapter_content` = '{$postdata["chapter-content"]}'  WHERE `id`=$entry_id" ;
							$stmt = $mysql->prepare($sql_query);
							$stmt->execute();
							$stmt->close();
							header("Location: ?page=chapters&action=edit&id=".$entry_id."&notice=success-edit");
						}
						/** init variable field **/
						$postdata["chapter-title"] = '';
						if(isset($rowdata["chapter_title"])){
							$postdata["chapter-title"] = stripslashes($rowdata["chapter_title"]);
						}
						$postdata["chapter-image"] = '';
						if(isset($rowdata["chapter_image"])){
							$postdata["chapter-image"] = stripslashes($rowdata["chapter_image"]);
						}
						$postdata["chapter-category"] = '';
						if(isset($rowdata["chapter_category"])){
							$postdata["chapter-category"] = stripslashes($rowdata["chapter_category"]);
						}
						$postdata["chapter-content"] = '';
						if(isset($rowdata["chapter_content"])){
							$postdata["chapter-content"] = stripslashes($rowdata["chapter_content"]);
						}
						/** breadcrumb **/
						$content .= '<section class="content-header">';
						$content .= '<h1>Chapters <small></small></h1>';
						$content .= '<ol class="breadcrumb">';
						$content .= '<li><a href="?"><i class="fa fa-dashboard"></i> Home</a></li>';
						$content .= '<li><a href="?">Chapters</a></li>';
						$content .= '<li class="active">Edit</li>';
						$content .= '</ol>';
						$content .= '</section>';
						/** content **/
						$content .= '<section class="content">';
						$content .= $notification;
						$content .= '<form action="" method="post">';
						$content .= '<div class="box box-primary">';
						$content .= '<div class="box-header with-border">';
						$content .= '<h3 class="box-title">Edit Chapter</h3>';
						$content .= '<div class="box-tools pull-right">';
						$content .= '<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>';
						$content .= '<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>';
						$content .= '</div>';
						$content .= '</div>';
						$content .= '<div class="box-body">';
						$content .= '<div class="row">';
						/** field id:id **/
						/** field chapter_title:varchar **/
						$content .= '<div class="col-md-6">';
						$content .= '<div class="form-group">';
						$content .= '<label>Chapter Title</label>';
						$content .= '<input maxlength="128" name="postdata[chapter-title]" id="postdata-chapter-title" type="text" class="form-control" placeholder="Chapter Title" value="'.htmlentities(stripslashes($postdata['chapter-title'])).'" />';
						$content .= '<p class="help-block"></p>';
						$content .= '</div>';
						$content .= '</div>';
						/** field chapter_image:thumbnail **/
						$content .= '<div class="col-md-6">';
						$content .= '<div class="form-group">';
						$content .= '<label>Chapter Image</label>';
						$content .= '<div class="input-group">';
						$content .= '<input name="postdata[chapter-image]" id="postdata-chapter-image" type="text" class="form-control" placeholder="image.jpg" value="'.htmlentities(stripslashes($postdata['chapter-image'])).'" />';
						$content .= '<span class="input-group-btn">';
						$content .= '<button type="button" data-type="file-picker" class="btn btn-default btn-flat" data-target="#postdata-chapter-image">';
						$content .= '<i class="fa fa-folder-open"></i>';
						$content .= '</button>';
						$content .= '<a class="btn btn-default btn-flat" target="_blank" href="'.htmlentities(stripslashes($postdata['chapter-image'])).'" ><i class="fa fa-eye"></i></a>';
						$content .= '</span>';
						$content .= '</div>';
						$content .= '<p class="help-block"></p>';
						$content .= '</div>';
						$content .= '</div>';
						/** field chapter_category:select-table **/
						$options["chapter_category"] = array();
						$sql_option_query = "SELECT * FROM `categories`" ;
						$option_result = $mysql->query($sql_option_query);
						if($option_result){
							while ($option_data = $option_result->fetch_array()){
								$options["chapter_category"][] = array("val"=> $option_data["id"],"label"=>$option_data["category_name"]);
							}
						}else{
							$options["chapter_category"][] = array("val"=> "","label"=>"Not existing table");
						}
						$content .= '<div class="col-md-6">';
						$content .= '<div class="form-group">';
						$content .= '<label>Chapter Category</label>';
						$content .= '<select class="form-control" name="postdata[chapter-category]" id="postdata-chapter-category">';
						foreach($options["chapter_category"] as $option) {
							$selected ="";
							if($option["val"] == $postdata['chapter-category'] ){
								$selected ="selected";
							}
							$content .= '<option value="'.htmlentities($option["val"]).'" '.$selected.'>'.htmlentities($option["label"]).'</option>';
						}
						$content .= '</select>';
						$content .= '<p class="help-block">please select a value</p>';
						$content .= '</div>';
						$content .= '</div>';
						/** field chapter_content:longtext **/
						$content .= '<div class="col-md-12">';
						$content .= '<div class="form-group">';
						$content .= '<label>Chapter Content</label>';
						$content .= '<textarea name="postdata[chapter-content]" id="postdata-chapter-content" class="form-control" data-type="html5" >'.htmlentities(stripslashes($postdata['chapter-content'])).'</textarea>';
						$content .= '<p class="help-block"></p>';
						$content .= '</div>';
						$content .= '</div>';
						$content .= '</div>';
						$content .= '</div>';
						$content .= '<div class="box-footer">';
						$content .= '<button type="submit" class="btn btn-flat btn-primary" name="submit"><i class="fa fa-floppy-o"></i> Update</button>';
						$content .= '</div>';
						$content .= '</div>';
						$content .= '</form>';
						$content .= '</section>';
					}else{
						header("Location: ?page=chapters&notice=wrong-id");
					}
				}else{
					header("Location: ?page=chapters&notice=wrong-id");
				}
				break;
			case "add":
				// TODO: PAGE - CHAPTERS - ADD
				/** default value **/
				$postdata["chapter-title"] = "" ;
				$postdata["chapter-image"] = "" ;
				$postdata["chapter-category"] = "" ;
				$postdata["chapter-content"] = "" ;
				/** response postdata **/
				if(isset($_POST["submit"])){
					if(isset($_POST["postdata"]["chapter-title"])){
						$postdata["chapter-title"] = addslashes($_POST["postdata"]["chapter-title"]);
					}
					if(isset($_POST["postdata"]["chapter-image"])){
						$postdata["chapter-image"] = addslashes($_POST["postdata"]["chapter-image"]);
					}
					if(isset($_POST["postdata"]["chapter-category"])){
						$postdata["chapter-category"] = addslashes($_POST["postdata"]["chapter-category"]);
					}
					if(isset($_POST["postdata"]["chapter-content"])){
						$postdata["chapter-content"] = addslashes($_POST["postdata"]["chapter-content"]);
					}
					$sql_query = "INSERT INTO `chapters` (`chapter_title`,`chapter_image`,`chapter_category`,`chapter_content`) VALUES ('{$postdata['chapter-title']}','{$postdata['chapter-image']}','{$postdata['chapter-category']}','{$postdata['chapter-content']}')" ;
					$mysql->query($sql_query);
					$last_id = $mysql->insert_id;
					header("Location: ?page=chapters&notice=success-add&action=edit&id=".$last_id);
				}
				/** breadcrumb **/
				$content .= '<section class="content-header">';
				$content .= '<h1>Chapters <small></small></h1>';
				$content .= '<ol class="breadcrumb">';
				$content .= '<li><a href="?"><i class="fa fa-dashboard"></i> Home</a></li>';
				$content .= '<li><a href="?">Chapters</a></li>';
				$content .= '<li class="active">Add</li>';
				$content .= '</ol>';
				$content .= '</section>';
				/** content **/
				$content .= '<section class="content">';
				$content .= $notification;
				$content .= '<form action="" method="post">';
				$content .= '<div class="box box-success">';
				$content .= '<div class="box-header with-border">';
				$content .= '<h3 class="box-title">Add new Chapter</h3>';
				$content .= '<div class="box-tools pull-right">';
				$content .= '<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>';
				$content .= '<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>';
				$content .= '</div>';
				$content .= '</div>';
				$content .= '<div class="box-body">';
				$content .= '<div class="row">';
				/** field id:id **/
				/** field chapter_title:varchar **/
				$content .= '<div class="col-md-6">';
				$content .= '<div class="form-group">';
				$content .= '<label>Chapter Title</label>';
				$content .= '<input maxlength="128" name="postdata[chapter-title]" id="postdata-chapter-title" type="text" class="form-control" placeholder="Chapter Title" value="'.htmlentities(stripslashes($postdata['chapter-title'])).'" />';
				$content .= '<p class="help-block"></p>';
				$content .= '</div>';
				$content .= '</div>';
				/** field chapter_image:thumbnail **/
				$content .= '<div class="col-md-6">';
				$content .= '<div class="form-group">';
				$content .= '<label>Chapter Image</label>';
				$content .= '<div class="input-group">';
				$content .= '<input name="postdata[chapter-image]" id="postdata-chapter-image" type="text" class="form-control" placeholder="image.jpg" value="'.htmlentities(stripslashes($postdata['chapter-image'])).'" />';
				$content .= '<span class="input-group-btn">';
				$content .= '<button type="button" data-type="file-picker" class="btn btn-primary btn-flat" data-target="#postdata-chapter-image">';
				$content .= '<i class="fa fa-folder-open"></i>';
				$content .= '</button>';
				$content .= '</span>';
				$content .= '</div>';
				$content .= '<p class="help-block"></p>';
				$content .= '</div>';
				$content .= '</div>';
				/** field chapter_category:select-table **/
				$options["chapter_category"] = array();
				$sql_option_query = "SELECT * FROM `categories`" ;
				$option_result = $mysql->query($sql_option_query);
				if($option_result){
					while ($option_data = $option_result->fetch_array()){
						$options["chapter_category"][] = array("val"=> $option_data["id"],"label"=>$option_data["category_name"]);
					}
				}else{
					$options["chapter_category"][] = array("val"=> "","label"=>"Not existing table");
				}
				$content .= '<div class="col-md-6">';
				$content .= '<div class="form-group">';
				$content .= '<label>Chapter Category</label>';
				$content .= '<select class="form-control" name="postdata[chapter-category]" id="postdata-chapter-category">';
				foreach($options["chapter_category"] as $option) {
					$selected ="";
					if($option["val"] == $postdata['chapter-category'] ){
						$selected ="selected";
					}
					$content .= '<option value="'.htmlentities($option["val"]).'" '.$selected.'>'.htmlentities($option["label"]).'</option>';
				}
				$content .= '</select>';
				$content .= '<p class="help-block">please select a value</p>';
				$content .= '</div>';
				$content .= '</div>';
				/** field chapter_content:longtext **/
				$content .= '<div class="col-md-12">';
				$content .= '<div class="form-group">';
				$content .= '<label>Chapter Content</label>';
				$content .= '<textarea name="postdata[chapter-content]" id="postdata-chapter-content" class="form-control" data-type="html5" >'.htmlentities(stripslashes($postdata['chapter-content'])).'</textarea>';
				$content .= '<p class="help-block"></p>';
				$content .= '</div>';
				$content .= '</div>';
				$content .= '</div>';
				$content .= '</div>';
				$content .= '<div class="box-footer">';
				$content .= '<button type="submit" class="btn btn-flat btn-success" name="submit"><i class="fa fa-plus"></i> Add new Chapter</button>';
				$content .= '</div>';
				$content .= '</div>';
				$content .= '</form>';
				$content .= '</section>';
				break;
			case "delete":
				// TODO: PAGE - CHAPTERS - DELETE
				if(isset($_GET["id"])){
					$entry_id= (int)$_GET["id"];
					/** fetch current data **/
					$sql_query = "SELECT * FROM `chapters` WHERE `id`=$entry_id LIMIT 0,1" ;
					$result = $mysql->query($sql_query);
					$rowdata = $result->fetch_array();
					if(isset($rowdata["id"])){
						$sql_query = "DELETE FROM `chapters` WHERE `id`=$entry_id";
						$stmt = $mysql->prepare($sql_query);
						$stmt->execute();
						$stmt->close();
						header("Location: ?page=chapters&notice=success-delete");
					}else{
						header("Location: ?page=chapters&notice=wrong-id");
					}
				}
				break;
			}
			$content .= '</div>';
			$content .= '<footer class="main-footer">';
			$content .= '<div class="pull-right hidden-xs">';
			$content .= '<b>Version</b> 01.01.01';
			$content .= '</div>';
			$content .= '<strong>Copyright &copy; '.date("Y").' <a href="https://godigitally.co.in">Go Digitally</a>.</strong> All rights reserved.';
			$content .= '</footer>';
			$content .= '</div>';
			break;
	// TODO: PAGE - JOBS
	case "jobs":
		$notification = null;
		if(isset($_GET["notice"])){
			switch($_GET["notice"]){
				case "success-delete":
					$notification .= '<div id="notification" class="alert alert-success">';
					$notification .= '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
					$notification .= 'You have successfully deleted the item of the <strong>Jobs data</strong>';
					$notification .= '</div>';
					break;
				case "success-edit":
					$notification .= '<div id="notification" class="alert alert-success">';
					$notification .= '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
					$notification .= 'You have successfully update the item of the <strong>Jobs data</strong>';
					$notification .= '</div>';
					break;
				case "success-add":
					$notification .= '<div id="notification" class="alert alert-success">';
					$notification .= '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
					$notification .= 'You have successfully add new item to the <strong>Jobs data</strong>';
					$notification .= '</div>';
					break;
				case "wrong-id":
					$notification .= '<div id="notification" class="alert alert-danger">';
					$notification .= '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
					$notification .= 'You did not find ID of this item in <strong>Jobs</strong>';
					$notification .= '</div>';
					break;
			}
		}
		if($_SESSION["IS_LOGIN"]==false){
			header("Location: ?page=login");
		}
		$page_title = "Jobs";
		$body_class = "hold-transition skin-".$config["color"]." sidebar-mini";
		$current_user = $_SESSION["CURRENT_USER"];
		$content = null;
		$content .= '<div class="wrapper">';
		$content .= '<header class="main-header">';
		$content .= '<a href="?" class="logo">';
		$content .= '<span class="logo-mini"><b>PN</b>L</span>';
		$content .= '<span class="logo-lg"><b>'.$app_name.'</b> Panel</span>';
		$content .= '</a>';
		$content .= '<nav class="navbar navbar-static-top">';
		$content .= '<a href="?" class="sidebar-toggle" data-toggle="push-menu" role="button">';
		$content .= '<span class="sr-only">Toggle navigation</span>';
		$content .= '<span class="icon-bar"></span>';
		$content .= '<span class="icon-bar"></span>';
		$content .= '<span class="icon-bar"></span>';
		$content .= '</a>';
		$content .= '<div class="navbar-custom-menu">';
		$content .= '<ul class="nav navbar-nav">';
		$content .= '<li class="dropdown user user-menu">';
		$content .= '<a href="?" class="dropdown-toggle" data-toggle="dropdown">';
		$content .= '<img src="https://www.gravatar.com/avatar/' . md5(strtolower(trim($current_user['user_email']))).'" class="user-image" alt="User Image">';
		$content .= '<span class="hidden-xs">' . htmlentities(stripslashes($current_user['user_name'])).'</span>';
		$content .= '</a>';
		$content .= '<ul class="dropdown-menu">';
		$content .= '<li class="user-header">';
		$content .= '<img src="https://www.gravatar.com/avatar/' . md5(strtolower(trim($current_user['user_email']))).'" class="img-circle" alt="User Image">';
		$content .= '<p>';
		$content .= '' . htmlentities(stripslashes($current_user['user_name'])).'';
		$content .= '<small>' . htmlentities(stripslashes($current_user['user_level'])).'</small>';
		$content .= '</p>';
		$content .= '</li>';
		$content .= '<li class="user-footer">';
		$content .= '<div class="pull-left">';
		$content .= '<a href="?page=profile" class="btn btn-default btn-flat">Profile</a>';
		$content .= '</div>';
		$content .= '<div class="pull-right">';
		$content .= '<a href="?page=logout" class="btn btn-default btn-flat">Sign out</a>';
		$content .= '</div>';
		$content .= '</li>';
		$content .= '</ul>';
		$content .= '<li>';
		$content .= '</ul>';
		$content .= '</div>';
		$content .= '</nav>';
		$content .= '</header>';
		$content .= '<aside class="main-sidebar">';
		$content .= '<section class="sidebar">';
		$content .= '<div class="user-panel">';
		$content .= '<div class="pull-left image">';
		$content .= '<img src="https://www.gravatar.com/avatar/' . md5(strtolower(trim($current_user['user_email']))).'" class="img-circle" alt="'.htmlentities(stripslashes($current_user['user_name'])).'">';
		$content .= '</div>';
		$content .= '<div class="pull-left info">';
		$content .= '<p>'.htmlentities(stripslashes($current_user['user_name'])).'</p>';
		$content .= '<a href="?"><i class="fa fa-circle text-success"></i> '.htmlentities(stripslashes($current_user['user_level'])).'</a>';
		$content .= '</div>';
		$content .= '</div>';
		$content .= '<ul class="sidebar-menu" data-widget="tree">';
		$content .= '<li class="header">DATA MANAGER</li>';
		$content .= '<li class="treeview ">';
		$content .= '<a href="?">';
		$content .= '<i class="fa fa-sitemap"></i> <span>Categories</span>';
		$content .= '<span class="pull-right-container">';
		$content .= '<i class="fa fa-angle-left pull-right"></i>';
		$content .= '</span>';
		$content .= '</a>';
		$content .= '<ul class="treeview-menu">';
		$content .= '<li><a href="?page=categories&amp;action=add"><i class="fa fa-plus"></i> Add New</a></li>';
		$content .= '<li><a href="?page=categories&amp;action=list"><i class="fa fa-list-ul"></i> All Categories</a></li>';
		$content .= '</ul>';
		$content .= '</li>';
		$content .= '<li class="treeview ">';
		$content .= '<a href="?">';
		$content .= '<i class="fa fa-newspaper-o"></i> <span>Chapters</span>';
		$content .= '<span class="pull-right-container">';
		$content .= '<i class="fa fa-angle-left pull-right"></i>';
		$content .= '</span>';
		$content .= '</a>';
		$content .= '<ul class="treeview-menu">';
		$content .= '<li><a href="?page=chapters&amp;action=add"><i class="fa fa-plus"></i> Add New</a></li>';
		$content .= '<li><a href="?page=chapters&amp;action=list"><i class="fa fa-list-ul"></i> All Chapters</a></li>';
		$content .= '</ul>';
		$content .= '</li>';
		$content .= '<li class="treeview active">';
		$content .= '<a href="?">';
		$content .= '<i class="fa fa-briefcase"></i> <span>Jobs</span>';
		$content .= '<span class="pull-right-container">';
		$content .= '<i class="fa fa-angle-left pull-right"></i>';
		$content .= '</span>';
		$content .= '</a>';
		$content .= '<ul class="treeview-menu">';
		$content .= '<li><a href="?page=jobs&amp;action=add"><i class="fa fa-plus"></i> Add New</a></li>';
		$content .= '<li><a href="?page=jobs&amp;action=list"><i class="fa fa-list-ul"></i> All Jobs</a></li>';
		$content .= '</ul>';
		$content .= '</li>';
		$content .= '<li class="header">TOOLS</li>';
		$content .= '<li><a href="?page=onesignal-sender"><i class="fa fa-send"></i> <span>OneSignal Sender</span></a></li>';
		$content .= '<li class="header">USERS</li>';
		$content .= '<li class="treeview">';
		$content .= '<a href="?">';
		$content .= '<i class="fa fa-users"></i> <span>Users</span>';
		$content .= '<span class="pull-right-container">';
		$content .= '<i class="fa fa-angle-left pull-right"></i>';
		$content .= '</span>';
		$content .= '</a>';
		$content .= '<ul class="treeview-menu">';
		$content .= '<li><a href="?page=users&amp;action=add"><i class="fa fa-plus"></i> Add New</a></li>';
		$content .= '<li><a href="?page=users"><i class="fa fa-users"></i> <span>All Users</span></a></li>';
		$content .= '</ul>';
		$content .= '</li>';
		$content .= '<li><a href="?page=profile"><i class="fa fa-user"></i> <span>Your Profile</span></a></li>';
		$content .= '</ul>';
		$content .= '</section>';
		$content .= '</aside>';
		$content .= '<div class="content-wrapper">';
		switch($_GET["action"]){
			case "list":
				// TODO: PAGE - JOBS - LIST
				/** breadcrumb **/
				$content .= '<section class="content-header">';
				$content .= '<h1>Jobs<small></small></h1>';
				$content .= '<ol class="breadcrumb">';
				$content .= '<li><a href="?"><i class="fa fa-dashboard"></i> Home</a></li>';
				$content .= '<li><a href="?page=jobs&amp;action=list">Jobs</a></li>';
				$content .= '<li class="active">List</li>';
				$content .= '</ol>';
				$content .= '</section>';
				/** content **/
				$content .= '<section class="content">';
				$content .= $notification;
				$content .= '<div class="box box-danger">';
				$content .= '<div class="box-header with-border">';
				$content .= '<h3 class="box-title">All Jobs</h3>';
				$content .= '<div class="box-tools pull-right">';
				$content .= '<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>';
				$content .= '<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>';
				$content .= '</div>';
				$content .= '</div>';
				$content .= '<div class="box-body">';
				$content .= '<div class="table-responsive">';
				$content .= '<table class="datatable table table-striped table-hover">';
				$content .= '<thead>';
				$content .= '<tr>';
				$content .= '<th>Job Title</th>';
				$content .= '<th>Last Date</th>';
				$content .= '<th style="width:100px;">#</th>';
				$content .= '</tr>';
				$content .= '</thead>';
				$content .= '<tbody>';
				/** fetch data from mysql **/
				$sql_query = "SELECT * FROM `jobs` ORDER BY `id` DESC" ;
				if($result = $mysql->query($sql_query)){
					while ($data = $result->fetch_array()){
						$content .= '<tr>';
						
						/** id **/
						
						/** job_title **/
						$content .= '<td>' . htmlentities(stripslashes(substr(strip_tags($data["job_title"]),0,64))) . '</td>';
						
						/** last_date **/
						$content .= '<td>' . htmlentities(stripslashes($data["last_date"])) . '</td>';
						
						/** job_content **/
						
						/** notification **/
						$content .= '<td>';
						$content .= '<a href="?page=jobs&amp;action=edit&amp;id='.$data["id"].'" class="btn btn-success btn-flat btn-sm"><i class="fa fa-edit"></i></a>';
						$content .= '<a class="btn btn-danger btn-flat btn-sm" href="#" onClick="doModal(\'Delete Job\',\'<div class=\\\'row\\\'><div class=\\\'col-md-3 text-center text-primary\\\'><i class=\\\'fa fa-5x fa-briefcase\\\'></i></div><div class=\\\'col-md-9\\\'>You are about to permanently delete these items from your site. <br/>This action cannot be undo, `Cancel` to stop, `OK` to delete.</div></div>\',\'Ok\',\'danger\',\'window.location=\\\'?page=jobs&amp;action=delete&amp;id='.$data["id"].'\\\'\');"><i class="fa fa-trash"></i></a>';
						$content .= '</td>';
						$content .= '</tr>';
					}
				}
				$content .= '</tbody>';
				$content .= '</table>';
				$content .= '</div>';
				$content .= '</div>';
				$content .= '</div>';
				$content .= '</section>';
				break;
			case "edit":
				// TODO: PAGE - JOBS - EDIT
				if(isset($_GET["id"])){
					$entry_id= (int)$_GET["id"];
					/** fetch current data **/
					$sql_query = "SELECT * FROM `jobs` WHERE `id`=$entry_id LIMIT 0,1" ;
					$result = $mysql->query($sql_query);
					$rowdata = $result->fetch_array();
					if(isset($rowdata["id"])){
						/** default value **/
						$postdata["job-title"] = "" ;
						$postdata["last-date"] = "" ;
						$postdata["job-content"] = "" ;
						$postdata["notification"] = "" ;
						/** response postdata **/
						if(isset($_POST["submit"])){
							if(isset($_POST["postdata"]["job-title"])){
								$postdata["job-title"] = addslashes($_POST["postdata"]["job-title"]);
							}
							if(isset($_POST["postdata"]["last-date"])){
								$postdata["last-date"] = addslashes($_POST["postdata"]["last-date"]);
							}
							if(isset($_POST["postdata"]["job-content"])){
								$postdata["job-content"] = addslashes($_POST["postdata"]["job-content"]);
							}
							if(isset($_POST["postdata"]["notification"])){
								$postdata["notification"] = addslashes($_POST["postdata"]["notification"]);
							}
							$sql_query = "UPDATE `jobs` SET `job_title` = '{$postdata["job-title"]}' ,`last_date` = '{$postdata["last-date"]}' ,`job_content` = '{$postdata["job-content"]}' ,`notification` = '{$postdata["notification"]}'  WHERE `id`=$entry_id" ;
							$stmt = $mysql->prepare($sql_query);
							$stmt->execute();
							$stmt->close();
							header("Location: ?page=jobs&action=edit&id=".$entry_id."&notice=success-edit");
						}
						/** init variable field **/
						$postdata["job-title"] = '';
						if(isset($rowdata["job_title"])){
							$postdata["job-title"] = stripslashes($rowdata["job_title"]);
						}
						$postdata["last-date"] = '';
						if(isset($rowdata["last_date"])){
							$postdata["last-date"] = stripslashes($rowdata["last_date"]);
						}
						$postdata["job-content"] = '';
						if(isset($rowdata["job_content"])){
							$postdata["job-content"] = stripslashes($rowdata["job_content"]);
						}
						$postdata["notification"] = '';
						if(isset($rowdata["notification"])){
							$postdata["notification"] = stripslashes($rowdata["notification"]);
						}
						/** breadcrumb **/
						$content .= '<section class="content-header">';
						$content .= '<h1>Jobs <small></small></h1>';
						$content .= '<ol class="breadcrumb">';
						$content .= '<li><a href="?"><i class="fa fa-dashboard"></i> Home</a></li>';
						$content .= '<li><a href="?">Jobs</a></li>';
						$content .= '<li class="active">Edit</li>';
						$content .= '</ol>';
						$content .= '</section>';
						/** content **/
						$content .= '<section class="content">';
						$content .= $notification;
						$content .= '<form action="" method="post">';
						$content .= '<div class="box box-primary">';
						$content .= '<div class="box-header with-border">';
						$content .= '<h3 class="box-title">Edit Job</h3>';
						$content .= '<div class="box-tools pull-right">';
						$content .= '<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>';
						$content .= '<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>';
						$content .= '</div>';
						$content .= '</div>';
						$content .= '<div class="box-body">';
						$content .= '<div class="row">';
						/** field id:id **/
						/** field job_title:varchar **/
						$content .= '<div class="col-md-6">';
						$content .= '<div class="form-group">';
						$content .= '<label>Job Title</label>';
						$content .= '<input maxlength="128" name="postdata[job-title]" id="postdata-job-title" type="text" class="form-control" placeholder="Job Title" value="'.htmlentities(stripslashes($postdata['job-title'])).'" />';
						$content .= '<p class="help-block"></p>';
						$content .= '</div>';
						$content .= '</div>';
						/** field last_date:date **/
						$content .= '<div class="col-md-6">';
						$content .= '<div class="form-group">';
						$content .= '<label>Last Date</label>';
						$content .= '<div class="input-group date">';
						$content .= '<div class="input-group-addon"><i class="fa fa-calendar"></i></div>';
						$content .= '<input name="postdata[last-date]" id="postdata-last-date" type="text" class="form-control" placeholder="'.date("Y-m-d").'" value="'.htmlentities(stripslashes($postdata['last-date'])).'" data-type="date" />';
						$content .= '</div>';
						$content .= '<p class="help-block">Filled with date</p>';
						$content .= '</div>';
						$content .= '</div>';
						/** field job_content:longtext **/
						$content .= '<div class="col-md-12">';
						$content .= '<div class="form-group">';
						$content .= '<label>Job Content</label>';
						$content .= '<textarea name="postdata[job-content]" id="postdata-job-content" class="form-control" data-type="html5" >'.htmlentities(stripslashes($postdata['job-content'])).'</textarea>';
						$content .= '<p class="help-block"></p>';
						$content .= '</div>';
						$content .= '</div>';
						/** field notification:varchar **/
						$content .= '<div class="col-md-6">';
						$content .= '<div class="form-group">';
						$content .= '<label>Notification</label>';
						$content .= '<input maxlength="128" name="postdata[notification]" id="postdata-notification" type="text" class="form-control" placeholder="Notification" value="'.htmlentities(stripslashes($postdata['notification'])).'" />';
						$content .= '<p class="help-block"></p>';
						$content .= '</div>';
						$content .= '</div>';
						$content .= '</div>';
						$content .= '</div>';
						$content .= '<div class="box-footer">';
						$content .= '<button type="submit" class="btn btn-flat btn-primary" name="submit"><i class="fa fa-floppy-o"></i> Update</button>';
						$content .= '</div>';
						$content .= '</div>';
						$content .= '</form>';
						$content .= '</section>';
					}else{
						header("Location: ?page=jobs&notice=wrong-id");
					}
				}else{
					header("Location: ?page=jobs&notice=wrong-id");
				}
				break;
			case "add":
				// TODO: PAGE - JOBS - ADD
				/** default value **/
				$postdata["job-title"] = "" ;
				$postdata["last-date"] = "" ;
				$postdata["job-content"] = "" ;
				$postdata["notification"] = "" ;
				/** response postdata **/
				if(isset($_POST["submit"])){
					if(isset($_POST["postdata"]["job-title"])){
						$postdata["job-title"] = addslashes($_POST["postdata"]["job-title"]);
					}
					if(isset($_POST["postdata"]["last-date"])){
						$postdata["last-date"] = addslashes($_POST["postdata"]["last-date"]);
					}
					if(isset($_POST["postdata"]["job-content"])){
						$postdata["job-content"] = addslashes($_POST["postdata"]["job-content"]);
					}
					if(isset($_POST["postdata"]["notification"])){
						$postdata["notification"] = addslashes($_POST["postdata"]["notification"]);
					}
					$sql_query = "INSERT INTO `jobs` (`job_title`,`last_date`,`job_content`,`notification`) VALUES ('{$postdata['job-title']}','{$postdata['last-date']}','{$postdata['job-content']}','{$postdata['notification']}')" ;
					$mysql->query($sql_query);
					$last_id = $mysql->insert_id;
					header("Location: ?page=jobs&notice=success-add&action=edit&id=".$last_id);
				}
				/** breadcrumb **/
				$content .= '<section class="content-header">';
				$content .= '<h1>Jobs <small></small></h1>';
				$content .= '<ol class="breadcrumb">';
				$content .= '<li><a href="?"><i class="fa fa-dashboard"></i> Home</a></li>';
				$content .= '<li><a href="?">Jobs</a></li>';
				$content .= '<li class="active">Add</li>';
				$content .= '</ol>';
				$content .= '</section>';
				/** content **/
				$content .= '<section class="content">';
				$content .= $notification;
				$content .= '<form action="" method="post">';
				$content .= '<div class="box box-success">';
				$content .= '<div class="box-header with-border">';
				$content .= '<h3 class="box-title">Add new Job</h3>';
				$content .= '<div class="box-tools pull-right">';
				$content .= '<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>';
				$content .= '<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>';
				$content .= '</div>';
				$content .= '</div>';
				$content .= '<div class="box-body">';
				$content .= '<div class="row">';
				/** field id:id **/
				/** field job_title:varchar **/
				$content .= '<div class="col-md-6">';
				$content .= '<div class="form-group">';
				$content .= '<label>Job Title</label>';
				$content .= '<input maxlength="128" name="postdata[job-title]" id="postdata-job-title" type="text" class="form-control" placeholder="Job Title" value="'.htmlentities(stripslashes($postdata['job-title'])).'" />';
				$content .= '<p class="help-block"></p>';
				$content .= '</div>';
				$content .= '</div>';
				/** field last_date:date **/
				$content .= '<div class="col-md-6">';
				$content .= '<div class="form-group">';
				$content .= '<label>Last Date</label>';
				$content .= '<div class="input-group date">';
				$content .= '<div class="input-group-addon"><i class="fa fa-calendar"></i></div>';
				$content .= '<input name="postdata[last-date]" id="postdata-last-date" type="text" class="form-control" placeholder="'.date("Y-m-d").'" value="'.htmlentities(stripslashes($postdata['last-date'])).'" data-type="date" />';
				$content .= '</div>';
				$content .= '<p class="help-block">Filled with date</p>';
				$content .= '</div>';
				$content .= '</div>';
				/** field job_content:longtext **/
				$content .= '<div class="col-md-12">';
				$content .= '<div class="form-group">';
				$content .= '<label>Job Content</label>';
				$content .= '<textarea name="postdata[job-content]" id="postdata-job-content" class="form-control" data-type="html5" >'.htmlentities(stripslashes($postdata['job-content'])).'</textarea>';
				$content .= '<p class="help-block"></p>';
				$content .= '</div>';
				$content .= '</div>';
				/** field notification:varchar **/
				$content .= '<div class="col-md-6">';
				$content .= '<div class="form-group">';
				$content .= '<label>Notification</label>';
				$content .= '<input maxlength="128" name="postdata[notification]" id="postdata-notification" type="text" class="form-control" placeholder="Notification" value="'.htmlentities(stripslashes($postdata['notification'])).'" />';
				$content .= '<p class="help-block"></p>';
				$content .= '</div>';
				$content .= '</div>';
				$content .= '</div>';
				$content .= '</div>';
				$content .= '<div class="box-footer">';
				$content .= '<button type="submit" class="btn btn-flat btn-success" name="submit"><i class="fa fa-plus"></i> Add new Job</button>';
				$content .= '</div>';
				$content .= '</div>';
				$content .= '</form>';
				$content .= '</section>';
				break;
			case "delete":
				// TODO: PAGE - JOBS - DELETE
				if(isset($_GET["id"])){
					$entry_id= (int)$_GET["id"];
					/** fetch current data **/
					$sql_query = "SELECT * FROM `jobs` WHERE `id`=$entry_id LIMIT 0,1" ;
					$result = $mysql->query($sql_query);
					$rowdata = $result->fetch_array();
					if(isset($rowdata["id"])){
						$sql_query = "DELETE FROM `jobs` WHERE `id`=$entry_id";
						$stmt = $mysql->prepare($sql_query);
						$stmt->execute();
						$stmt->close();
						header("Location: ?page=jobs&notice=success-delete");
					}else{
						header("Location: ?page=jobs&notice=wrong-id");
					}
				}
				break;
			}
			$content .= '</div>';
			$content .= '<footer class="main-footer">';
			$content .= '<div class="pull-right hidden-xs">';
			$content .= '<b>Version</b> 01.01.01';
			$content .= '</div>';
			$content .= '<strong>Copyright &copy; '.date("Y").' <a href="https://godigitally.co.in">Go Digitally</a>.</strong> All rights reserved.';
			$content .= '</footer>';
			$content .= '</div>';
			break;
	// TODO: PAGE - PROFILE
	case "profile":
		if($_SESSION["IS_LOGIN"]==false){
			header("Location: ?page=login");
		}
		$page_title = "Profile";
		$body_class = "hold-transition skin-".$config["color"]." sidebar-mini";
		$notification = null;
		if(isset($_GET["notice"])){
			switch($_GET["notice"]){
				case "success-profile-update":
					$notification .= '<div id="notification" class="alert alert-success">';
					$notification .= '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
					$notification .= 'You have successfully update your profile.';
					$notification .= '</div>';
					break;
				case "error-password-too-short":
					$notification .= '<div id="notification" class="alert alert-danger">';
					$notification .= '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
					$notification .= 'The new password you wrote is too short, at least 6 characters or more';
					$notification .= '</div>';
					break;
				case "error-password-not-same":
					$notification .= '<div id="notification" class="alert alert-danger">';
					$notification .= '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
					$notification .= 'The new password and new password again are not the same, please try again!';
					$notification .= '</div>';
					break;
				case "error-old-password":
					$notification .= '<div id="notification" class="alert alert-danger">';
					$notification .= '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
					$notification .= 'Your old password is wrong, please try again!';
					$notification .= '</div>';
					break;
				case "success-password-update":
					$notification .= '<div id="notification" class="alert alert-success">';
					$notification .= '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
					$notification .= 'Your password has been changed, please logout!';
					$notification .= '</div>';
					break;
			}
		}
		$sql_query = "SELECT * FROM `users` WHERE `user_id` = '{$_SESSION["CURRENT_USER"]["user_id"]}' AND `user_email` = '{$_SESSION["CURRENT_USER"]["user_email"]}'" ;
		$result = $mysql->query($sql_query);
		$current_user = $result->fetch_array();
		if(!isset($current_user["user_email"])){
			header("Location: ?page=login");
		}
		
		/** resp update profile **/
		if(isset($_POST["user-data"])){
			$user_first_name = addslashes($_POST["postdata"]["user-first-name"]) ;
			$user_last_name = addslashes($_POST["postdata"]["user-last-name"]) ;
			$user_website = addslashes($_POST["postdata"]["user-website"]) ;
			$sql_query = "UPDATE `users` SET `user_first_name` = '{$user_first_name}', `user_last_name` = '{$user_last_name}',`user_website` = '{$user_website}' WHERE `user_id` ={$current_user["user_id"]};";
			$stmt = $mysql->prepare($sql_query);
			$stmt->execute();
			$stmt->close();
			$_SESSION["CURRENT_USER"]["user_first_name"] = $user_first_name;
			header("Location: ?page=profile&notice=success-profile-update");
		}
		
		/** resp update password **/
		if(isset($_POST["user-password"])){
			if(strlen($_POST["postdata"]["user-new-password"]) >= 6){
				if($_POST["postdata"]["user-new-password"] == $_POST["postdata"]["user-new-password-again"]){
					$old_password_hash = sha1("imabuilder".$_POST["postdata"]["user-old-password"]);
					if($old_password_hash == $current_user["user_password"]){
						$user_password = sha1("imabuilder".$_POST["postdata"]["user-new-password"]);
						$sql_query = "UPDATE `users` SET `user_password` = '{$user_password}' WHERE `user_id` ={$current_user["user_id"]};";
						$stmt = $mysql->prepare($sql_query);
						$stmt->execute();
						$stmt->close();
						header("Location: ?page=profile&notice=success-password-update");
					}else{
						header("Location: ?page=profile&notice=error-old-password");
					}
				}else{
					header("Location: ?page=profile&notice=error-password-not-same");
				}
			}else{
				header("Location: ?page=profile&notice=error-password-too-short");
			}
		}
		
		$content = null;
		$content .= '<div class="wrapper">';
		$content .= '<header class="main-header">';
		$content .= '<a href="?" class="logo">';
		$content .= '<span class="logo-mini"><b>PN</b>L</span>';
		$content .= '<span class="logo-lg"><b>'.$app_name.'</b> Panel</span>';
		$content .= '</a>';
		$content .= '<nav class="navbar navbar-static-top">';
		$content .= '<a href="?" class="sidebar-toggle" data-toggle="push-menu" role="button">';
		$content .= '<span class="sr-only">Toggle navigation</span>';
		$content .= '<span class="icon-bar"></span>';
		$content .= '<span class="icon-bar"></span>';
		$content .= '<span class="icon-bar"></span>';
		$content .= '</a>';
		$content .= '<div class="navbar-custom-menu">';
		$content .= '<ul class="nav navbar-nav">';
		$content .= '<li class="dropdown user user-menu">';
		$content .= '<a href="?" class="dropdown-toggle" data-toggle="dropdown">';
		$content .= '<img src="https://www.gravatar.com/avatar/' . md5(strtolower(trim($current_user['user_email']))).'" class="user-image" alt="User Image">';
		$content .= '<span class="hidden-xs">' . htmlentities(stripslashes($current_user['user_name'])).'</span>';
		$content .= '</a>';
		$content .= '<ul class="dropdown-menu">';
		$content .= '<li class="user-header">';
		$content .= '<img src="https://www.gravatar.com/avatar/' . md5(strtolower(trim($current_user['user_email']))).'" class="img-circle" alt="User Image">';
		$content .= '<p>';
		$content .= '' . htmlentities(stripslashes($current_user['user_name'])).'';
		$content .= '<small>' . htmlentities(stripslashes($current_user['user_level'])).'</small>';
		$content .= '</p>';
		$content .= '</li>';
		$content .= '<li class="user-footer">';
		$content .= '<div class="pull-left">';
		$content .= '<a href="?page=profile" class="btn btn-default btn-flat">Profile</a>';
		$content .= '</div>';
		$content .= '<div class="pull-right">';
		$content .= '<a href="?page=logout" class="btn btn-default btn-flat">Sign out</a>';
		$content .= '</div>';
		$content .= '</li>';
		$content .= '</ul>';
		$content .= '</li>';
		$content .= '</ul>';
		$content .= '</div>';
		$content .= '</nav>';
		$content .= '</header>';
		$content .= '<aside class="main-sidebar">';
		$content .= '<section class="sidebar">';
		$content .= '<div class="user-panel">';
		$content .= '<div class="pull-left image">';
		$content .= '<img src="https://www.gravatar.com/avatar/' . md5(strtolower(trim($current_user['user_email']))).'" class="img-circle" alt="'.htmlentities(stripslashes($current_user['user_name'])).'">';
		$content .= '</div>';
		$content .= '<div class="pull-left info">';
		$content .= '<p>'.htmlentities(stripslashes($current_user['user_name'])).'</p>';
		$content .= '<a href="?"><i class="fa fa-circle text-success"></i> '.htmlentities(stripslashes($current_user['user_level'])).'</a>';
		$content .= '</div>';
		$content .= '</div>';
		$content .= '<ul class="sidebar-menu" data-widget="tree">';
		$content .= '<li class="header">DATA MANAGER</li>';
		$content .= '<li class="treeview">';
		$content .= '<a href="?">';
		$content .= '<i class="fa fa-sitemap"></i> <span>Categories</span>';
		$content .= '<span class="pull-right-container">';
		$content .= '<i class="fa fa-angle-left pull-right"></i>';
		$content .= '</span>';
		$content .= '</a>';
		$content .= '<ul class="treeview-menu">';
		$content .= '<li><a href="?page=categories&amp;action=add"><i class="fa fa-plus"></i> Add New</a></li>';
		$content .= '<li><a href="?page=categories&amp;action=list"><i class="fa fa-list-ul"></i> All Categories</a></li>';
		$content .= '</ul>';
		$content .= '</li>';
		$content .= '<li class="treeview">';
		$content .= '<a href="?">';
		$content .= '<i class="fa fa-newspaper-o"></i> <span>Chapters</span>';
		$content .= '<span class="pull-right-container">';
		$content .= '<i class="fa fa-angle-left pull-right"></i>';
		$content .= '</span>';
		$content .= '</a>';
		$content .= '<ul class="treeview-menu">';
		$content .= '<li><a href="?page=chapters&amp;action=add"><i class="fa fa-plus"></i> Add New</a></li>';
		$content .= '<li><a href="?page=chapters&amp;action=list"><i class="fa fa-list-ul"></i> All Chapters</a></li>';
		$content .= '</ul>';
		$content .= '</li>';
		$content .= '<li class="treeview">';
		$content .= '<a href="?">';
		$content .= '<i class="fa fa-briefcase"></i> <span>Jobs</span>';
		$content .= '<span class="pull-right-container">';
		$content .= '<i class="fa fa-angle-left pull-right"></i>';
		$content .= '</span>';
		$content .= '</a>';
		$content .= '<ul class="treeview-menu">';
		$content .= '<li><a href="?page=jobs&amp;action=add"><i class="fa fa-plus"></i> Add New</a></li>';
		$content .= '<li><a href="?page=jobs&amp;action=list"><i class="fa fa-list-ul"></i> All Jobs</a></li>';
		$content .= '</ul>';
		$content .= '</li>';
		$content .= '<li class="header">TOOLS</li>';
		$content .= '<li><a href="?page=onesignal-sender"><i class="fa fa-send"></i> <span>OneSignal Sender</span></a></li>';
		$content .= '<li class="header">USERS</li>';
		$content .= '<li class="treeview">';
		$content .= '<a href="?">';
		$content .= '<i class="fa fa-users"></i> <span>Users</span>';
		$content .= '<span class="pull-right-container">';
		$content .= '<i class="fa fa-angle-left pull-right"></i>';
		$content .= '</span>';
		$content .= '</a>';
		$content .= '<ul class="treeview-menu">';
		$content .= '<li><a href="?page=users&amp;action=add"><i class="fa fa-plus"></i> Add New</a></li>';
		$content .= '<li><a href="?page=users"><i class="fa fa-users"></i> <span>All Users</span></a></li>';
		$content .= '</ul>';
		$content .= '</li>';
		$content .= '<li class="active"><a href="?page=profile"><i class="fa fa-user"></i> <span>Your Profile</span></a></li>';
		$content .= '</ul>';
		$content .= '</section>';
		$content .= '</aside>';
		$content .= '<div class="content-wrapper">';
		/** breadcrumb **/
		$content .= '<section class="content-header">';
		$content .= '<h1>Profile <small>Your personal data</small></h1>';
		$content .= '<ol class="breadcrumb">';
		$content .= '<li><a href="?"><i class="fa fa-dashboard"></i> Home</a></li>';
		$content .= '<li class="active">Profile</li>';
		$content .= '</ol>';
		$content .= '</section>';
		/** content **/
		$content .= '<section class="content">';
		$content .= $notification;
		$content .= '<div class="row">';
		$content .= '<div class="col-md-3">';
		$content .= '<div class="box box-primary">';
		$content .= '<div class="box-body box-profile">';
		$content .= '<img class="profile-user-img img-responsive img-circle" src="https://www.gravatar.com/avatar/' . md5(strtolower(trim($current_user['user_email']))).'?s=128" alt="User profile picture">';
		$content .= '<h3 class="profile-username text-center">' . htmlentities(stripslashes($current_user['user_name'])).'</h3>';
		$content .= '<p class="text-muted text-center">' . htmlentities(stripslashes($current_user['user_level'])).'</p>';
		$content .= '<ul class="list-group list-group-unbordered">';
		
		/** count categories data **/
		$sql_query = "SELECT COUNT(*) AS `total` FROM `categories` LIMIT 0,1" ;
		$result = $mysql->query($sql_query);
		$count = $result->fetch_array();
		$content .= '<li class="list-group-item">';
		$content .= '<b>Categories</b> <a class="pull-right">'.$count["total"].'</a>';
		$content .= '</li>';
		
		/** count chapters data **/
		$sql_query = "SELECT COUNT(*) AS `total` FROM `chapters` LIMIT 0,1" ;
		$result = $mysql->query($sql_query);
		$count = $result->fetch_array();
		$content .= '<li class="list-group-item">';
		$content .= '<b>Chapters</b> <a class="pull-right">'.$count["total"].'</a>';
		$content .= '</li>';
		
		/** count jobs data **/
		$sql_query = "SELECT COUNT(*) AS `total` FROM `jobs` LIMIT 0,1" ;
		$result = $mysql->query($sql_query);
		$count = $result->fetch_array();
		$content .= '<li class="list-group-item">';
		$content .= '<b>Jobs</b> <a class="pull-right">'.$count["total"].'</a>';
		$content .= '</li>';
		$content .= '</ul>';
		$content .= '<a href="https://en.gravatar.com/" target="_blank" class="btn btn-flat btn-primary btn-block"><b>Change Gravatar</b></a>';
		$content .= '</div>';
		$content .= '</div>';
		$content .= '</div>';
		$content .= '<div class="col-md-5">';
		$content .= '<form action="" method="post">';
		$content .= '<div class="box box-success">';
		$content .= '<div class="box-header with-border">';
		$content .= '<h3 class="box-title">About Yourself</h3>';
		$content .= '<div class="box-tools pull-right">';
		$content .= '<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>';
		$content .= '<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>';
		$content .= '</div>';
		$content .= '</div>';
		$content .= '<div class="box-body">';
		$content .= '<div class="form-group">';
		$content .= '<label>First Name</label>';
		$content .= '<input name="postdata[user-first-name]" id="postdata-user-first-name" type="text" class="form-control" placeholder="Regel" value="'.htmlentities(stripslashes($current_user['user_first_name'])).'" />';
		$content .= '<p class="help-block">What is your first name?</p>';
		$content .= '</div>';
		$content .= '<div class="form-group">';
		$content .= '<label>Last Name</label>';
		$content .= '<input name="postdata[user-last-name]" id="postdata-user-last-name" type="text" class="form-control" placeholder="Jambak" value="'.htmlentities(stripslashes($current_user['user_last_name'])).'" />';
		$content .= '<p class="help-block">What is your last name?</p>';
		$content .= '</div>';
		$content .= '<div class="form-group">';
		$content .= '<label>Email Address</label>';
		$content .= '<input name="postdata[user-email]" id="postdata-user-email" type="text" class="form-control" placeholder="regel@ihsana.com" value="'.htmlentities(stripslashes($current_user['user_email'])).'" readonly/>';
		$content .= '<p class="help-block">What is the email address used to log in?</p>';
		$content .= '</div>';
		$content .= '<div class="form-group">';
		$content .= '<label>Website</label>';
		$content .= '<input name="postdata[user-website]" id="postdata-user-website" type="text" class="form-control" placeholder="http://ihsana.com" value="'.htmlentities(stripslashes($current_user['user_website'])).'" />';
		$content .= '<p class="help-block">What is the your website?</p>';
		$content .= '</div>';
		$content .= '</div>';
		$content .= '<div class="box-footer">';
		$content .= '<button type="submit" class="btn btn-flat btn-success" name="user-data"><i class="fa fa-floppy-o"></i> Update Profile</button>';
		$content .= '</div>';
		$content .= '</div>';
		$content .= '</form>';
		$content .= '</div>';
		$content .= '<div class="col-md-4">';
		$content .= '<form action="" method="post">';
		$content .= '<div class="box box-danger">';
		$content .= '<div class="box-header with-border">';
		$content .= '<h3 class="box-title">Account Management</h3>';
		$content .= '<div class="box-tools pull-right">';
		$content .= '<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>';
		$content .= '<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>';
		$content .= '</div>';
		$content .= '</div>';
		$content .= '<div class="box-body">';
		$content .= '<div class="form-group">';
		$content .= '<label>Old Password</label>';
		$content .= '<input name="postdata[user-old-password]" id="postdata-user-old-password" type="password" class="form-control" autocomplete="off"/>';
		$content .= '<p class="help-block">What is old password have you used?</p>';
		$content .= '</div>';
		$content .= '<div class="form-group">';
		$content .= '<label>New Password</label>';
		$content .= '<input name="postdata[user-new-password]" id="postdata-user-new-password" type="password" class="form-control" autocomplete="off"/>';
		$content .= '<p class="help-block">What is your new password?</p>';
		$content .= '</div>';
		$content .= '<div class="form-group">';
		$content .= '<label>New Password Again</label>';
		$content .= '<input name="postdata[user-new-password-again]" id="postdata-user-new-password-again" type="password" class="form-control" autocomplete="off"/>';
		$content .= '<p class="help-block">Type again new password</p>';
		$content .= '</div>';
		$content .= '</div>';
		$content .= '<div class="box-footer">';
		$content .= '<button type="submit" class="btn btn-flat btn-danger" name="user-password"><i class="fa fa-floppy-o"></i> Update</button>';
		$content .= '</div>';
		$content .= '</div>';
		$content .= '</div>';
		$content .= '</form>';
		$content .= '</div>';
		$content .= '</section>';
		$content .= '</div>';
		$content .= '<footer class="main-footer">';
		$content .= '<div class="pull-right hidden-xs">';
		$content .= '<b>Version</b> 01.01.01';
		$content .= '</div>';
		$content .= '<strong>Copyright &copy; '.date("Y").' <a href="https://godigitally.co.in">Go Digitally</a>.</strong> All rights reserved.';
		$content .= '</footer>';
		$content .= '</div>';
		break;
	// TODO: PAGE - FILE-BROWSER
	case "file-browser":
		if($_SESSION["IS_LOGIN"]==false){
			header("Location: ?page=login");
		}
		if(!file_exists("./filebrowser/php/autoload.php")){
			die("elfinder not installed, please download <a target=\"blank\" href=\"https://studio-42.github.io/elFinder/\">elfinder</a> and extracted into `filebrowser` directory");
		}
		$site_url="";
		if(isset($_SERVER["HTTP_REFERER"])){
			$parse_url = parse_url($_SERVER["HTTP_REFERER"]);
			$site_url = $parse_url["scheme"] . "://" . $parse_url["host"] . "/" . dirname($parse_url["path"]) . "/";
		}
		$content .= '<!DOCTYPE HTML>';
		$content .= '<html>';
		$content .= '<head>';
		$content .= '<meta charset="utf-8" />';
		$content .= '<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />';
		$content .= '<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=2" />';
		$content .= '<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css" />';
		$content .= '<link rel="stylesheet" href="./filebrowser/css/elfinder.min.css"/>';
		$content .= '<link rel="stylesheet" href="./filebrowser/css/theme.css"/>';
		$content .= '<title>elFinder</title>';
		$content .= '<style type="text/css">';
		$content .= 'body {padding: 0 !important;margin: 0 !important;}';
		$content .= '#elfinder{z-index:999999999;height: 100%; width: 100%;}';
		$content .= 'div{border-radius: 0 !important;}';
		$content .= '</style>';
		$content .= '</head>';
		$content .= '<body>';
		$content .= '<div id="elfinder"></div>';
		$content .= '<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>';
		$content .= '<script src="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>';
		$content .= '<script src="./filebrowser/js/elfinder.min.js"></script>';
		$content .= '<script type="text/javascript">';
		if(isset($_GET["CKEditor"])){
			$content .= 'function getUrlParam(n){var a=new RegExp("(?:[?&]|&)"+n+"=([^&]+)","i"),e=window.location.search.match(a);return e&&1<e.length?e[1]:null}';
			$content .= 'var userfiles="";$(document).ready(function(){$("#elfinder").elfinder({cssAutoLoad:!1,baseUrl:"./",url:"?page=file-connector",width:"100%",height:"100%",resizable:!1,getFileCallback:function(n,e){var i=n.path;i=i.replace(/\\\\/gi,"/");var t="'.$site_url.'"+i.replace(/src\//gi,"");window.opener.CKEDITOR.tools.callFunction(getUrlParam("CKEditorFuncNum"),t),window.close()}},function(i,n){i.bind("init",function(){"ja"===i.lang&&i.loadScript(["//cdn.rawgit.com/polygonplanet/encoding.js/1.0.26/encoding.min.js"],function(){window.Encoding&&Encoding.convert&&i.registRawStringDecoder(function(n){return Encoding.convert(n,{to:"UNICODE",type:"string"})})},{loadType:"tag"})});var t=document.title;i.bind("open",function(){var n="",e=i.cwd();e&&(n=i.path(e.hash)||null),document.title=n?n+":"+t:t}).bind("destroy",function(){document.title=t})})});';
		}else{
			$content .= 'var userfiles="";$(document).ready(function(){$("#elfinder").elfinder({cssAutoLoad:!1,baseUrl:"./",url:"?page=file-connector",width:"100%",height:"100%",resizable:!1,getFileCallback:function(n,e){var i=n.path;i=i.replace(/\\\\/gi,"/");var t="'.$site_url.'"+i.replace(/src\//gi,"");window.opener.fileBrowser.callBack(t),window.close()}},function(i,n){i.bind("init",function(){"ja"===i.lang&&i.loadScript(["//cdn.rawgit.com/polygonplanet/encoding.js/1.0.26/encoding.min.js"],function(){window.Encoding&&Encoding.convert&&i.registRawStringDecoder(function(n){return Encoding.convert(n,{to:"UNICODE",type:"string"})})},{loadType:"tag"})});var t=document.title;i.bind("open",function(){var n="",e=i.cwd();e&&(n=i.path(e.hash)||null),document.title=n?n+":"+t:t}).bind("destroy",function(){document.title=t})})});';
		}
		$content .= '</script>';
		$content .= '</body>';
		$content .= '</html>';
		die($content);
		break;
	// TODO: PAGE - FILE-CONNECTOR
	case "file-connector":
		if($_SESSION["IS_LOGIN"]==false){
			header("Location: ?page=login");
		}
		if(file_exists("./filebrowser/php/autoload.php")){
			require "./filebrowser/php/autoload.php";
			elFinder::$netDrivers["ftp"] = "FTP";
			function access($attr, $path, $data, $volume, $isDir, $relpath){
				$basename = basename($path);
				return $basename[0] === "."
				&& strlen($relpath) !== 1
					? !($attr == "read" || $attr == "write")
					: null;
			}
			$opts = array( // "debug" => true,
				"roots" => array( // Items volume
					array(
					"driver" => "LocalFileSystem", // driver for accessing file system (REQUIRED)
					"path" => "./userfiles/", // path to files (REQUIRED)
					"URL" => dirname($_SERVER["PHP_SELF"]) . "/userfiles/", // URL to files (REQUIRED)
					"trashHash" => "t1_Lw", // elFinder"s hash of trash folder
					"winHashFix" => DIRECTORY_SEPARATOR !== "/", // to make hash same to Linux one on windows too
					"uploadDeny" => array("all"), // All Mimetypes not allowed to upload
					"uploadAllow" => array(
						"image/x-ms-bmp",
						"image/gif",
						"image/jpeg",
						"image/png",
						"image/x-icon",
						"text/plain"), // Mimetype `image` and `text/plain` allowed to upload
					"uploadOrder" => array("deny", "allow"), // allowed Mimetype `image` and `text/plain` only
					"accessControl" => "access" // disable and hide dot starting files (OPTIONAL)
				), // Trash volume
				array(
					"id" => "1",
					"driver" => "Trash",
					"path" => "./userfiles/.trash/",
					"tmbURL" => dirname($_SERVER["PHP_SELF"]) . "/userfiles/.trash/.tmb/",
					"winHashFix" => DIRECTORY_SEPARATOR !== "/", // to make hash same to Linux one on windows too
					"uploadDeny" => array("all"), // Recomend the same settings as the original volume that uses the trash
					"uploadAllow" => array(
						"image/x-ms-bmp",
						"image/gif",
						"image/jpeg",
						"image/png",
						"image/x-icon",
						"text/plain"), // Same as above
					"uploadOrder" => array("deny", "allow"), // Same as above
					"accessControl" => "access", // Same as above
				)));
			$connector = new elFinderConnector(new elFinder($opts));
			$connector->run();
		}else{
			die("elfinder not installed");
		}
		die($content);
		break;
	// TODO: PAGE - USERS
	case "users":
		if($_SESSION["IS_LOGIN"]==false){
			header("Location: ?page=login");
		}
		$notification = null;
		if(isset($_GET["notice"])){
			switch($_GET["notice"]){
				case "success-delete":
					$notification .= '<div id="notification" class="alert alert-success">';
					$notification .= '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
					$notification .= 'You have successfully deleted the account of the <strong>users data</strong>';
					$notification .= '</div>';
					break;
				case "success-edit":
					$notification .= '<div id="notification" class="alert alert-success">';
					$notification .= '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
					$notification .= 'You have successfully update the account of the <strong>users data</strong>';
					$notification .= '</div>';
					break;
				case "success-add":
					$notification .= '<div id="notification" class="alert alert-success">';
					$notification .= '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
					$notification .= 'You have successfully add new account to the <strong>users data</strong>';
					$notification .= '</div>';
					break;
				case "wrong-id":
					$notification .= '<div id="notification" class="alert alert-danger">';
					$notification .= '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
					$notification .= 'You did not find ID of this account in <strong>users data</strong>';
					$notification .= '</div>';
					break;
			}
		}
		$page_title = "Users";
		$body_class = "hold-transition skin-".$config["color"]." sidebar-mini";
		$current_user = $_SESSION["CURRENT_USER"];
		$content = null;
		$content .= '<div class="wrapper">';
		$content .= '<header class="main-header">';
		$content .= '<a href="?" class="logo">';
		$content .= '<span class="logo-mini"><b>PN</b>L</span>';
		$content .= '<span class="logo-lg"><b>'.$app_name.'</b> Panel</span>';
		$content .= '</a>';
		$content .= '<nav class="navbar navbar-static-top">';
		$content .= '<a href="?" class="sidebar-toggle" data-toggle="push-menu" role="button">';
		$content .= '<span class="sr-only">Toggle navigation</span>';
		$content .= '<span class="icon-bar"></span>';
		$content .= '<span class="icon-bar"></span>';
		$content .= '<span class="icon-bar"></span>';
		$content .= '</a>';
		$content .= '<div class="navbar-custom-menu">';
		$content .= '<ul class="nav navbar-nav">';
		$content .= '<li class="dropdown user user-menu">';
		$content .= '<a href="?" class="dropdown-toggle" data-toggle="dropdown">';
		$content .= '<img src="https://www.gravatar.com/avatar/' . md5(strtolower(trim($current_user['user_email']))).'" class="user-image" alt="User Image">';
		$content .= '<span class="hidden-xs">' . htmlentities(stripslashes($current_user['user_name'])).'</span>';
		$content .= '</a>';
		$content .= '<ul class="dropdown-menu">';
		$content .= '<li class="user-header">';
		$content .= '<img src="https://www.gravatar.com/avatar/' . md5(strtolower(trim($current_user['user_email']))).'" class="img-circle" alt="User Image">';
		$content .= '<p>';
		$content .= '' . htmlentities(stripslashes($current_user['user_name'])).'';
		$content .= '<small>' . htmlentities(stripslashes($current_user['user_level'])).'</small>';
		$content .= '</p>';
		$content .= '</li>';
		$content .= '<li class="user-footer">';
		$content .= '<div class="pull-left">';
		$content .= '<a href="?page=profile" class="btn btn-default btn-flat">Profile</a>';
		$content .= '</div>';
		$content .= '<div class="pull-right">';
		$content .= '<a href="?page=logout" class="btn btn-default btn-flat">Sign out</a>';
		$content .= '</div>';
		$content .= '</li>';
		$content .= '</ul>';
		$content .= '</li>';
		$content .= '</ul>';
		$content .= '</div>';
		$content .= '</nav>';
		$content .= '</header>';
		$content .= '<aside class="main-sidebar">';
		$content .= '<section class="sidebar">';
		$content .= '<div class="user-panel">';
		$content .= '<div class="pull-left image">';
		$content .= '<img src="https://www.gravatar.com/avatar/' . md5(strtolower(trim($current_user['user_email']))).'" class="img-circle" alt="'.htmlentities(stripslashes($current_user['user_name'])).'">';
		$content .= '</div>';
		$content .= '<div class="pull-left info">';
		$content .= '<p>'.htmlentities(stripslashes($current_user['user_name'])).'</p>';
		$content .= '<a href="?"><i class="fa fa-circle text-success"></i> '.htmlentities(stripslashes($current_user['user_level'])).'</a>';
		$content .= '</div>';
		$content .= '</div>';
		$content .= '<ul class="sidebar-menu" data-widget="tree">';
		$content .= '<li class="header">DATA MANAGER</li>';
		$content .= '<li class="treeview">';
		$content .= '<a href="?">';
		$content .= '<i class="fa fa-sitemap"></i> <span>Categories</span>';
		$content .= '<span class="pull-right-container">';
		$content .= '<i class="fa fa-angle-left pull-right"></i>';
		$content .= '</span>';
		$content .= '</a>';
		$content .= '<ul class="treeview-menu">';
		$content .= '<li><a href="?page=categories&amp;action=add"><i class="fa fa-plus"></i> Add New</a></li>';
		$content .= '<li><a href="?page=categories&amp;action=list"><i class="fa fa-list-ul"></i> All Categories</a></li>';
		$content .= '</ul>';
		$content .= '</li>';
		$content .= '<li class="treeview">';
		$content .= '<a href="?">';
		$content .= '<i class="fa fa-newspaper-o"></i> <span>Chapters</span>';
		$content .= '<span class="pull-right-container">';
		$content .= '<i class="fa fa-angle-left pull-right"></i>';
		$content .= '</span>';
		$content .= '</a>';
		$content .= '<ul class="treeview-menu">';
		$content .= '<li><a href="?page=chapters&amp;action=add"><i class="fa fa-plus"></i> Add New</a></li>';
		$content .= '<li><a href="?page=chapters&amp;action=list"><i class="fa fa-list-ul"></i> All Chapters</a></li>';
		$content .= '</ul>';
		$content .= '</li>';
		$content .= '<li class="treeview">';
		$content .= '<a href="?">';
		$content .= '<i class="fa fa-briefcase"></i> <span>Jobs</span>';
		$content .= '<span class="pull-right-container">';
		$content .= '<i class="fa fa-angle-left pull-right"></i>';
		$content .= '</span>';
		$content .= '</a>';
		$content .= '<ul class="treeview-menu">';
		$content .= '<li><a href="?page=jobs&amp;action=add"><i class="fa fa-plus"></i> Add New</a></li>';
		$content .= '<li><a href="?page=jobs&amp;action=list"><i class="fa fa-list-ul"></i> All Jobs</a></li>';
		$content .= '</ul>';
		$content .= '</li>';
		$content .= '<li class="header">TOOLS</li>';
		$content .= '<li class=""><a href="?page=onesignal-sender"><i class="fa fa-send"></i> <span>OneSignal Sender</span></a></li>';
		$content .= '<li class="header">USERS</li>';
		$content .= '<li class="treeview active">';
		$content .= '<a href="?">';
		$content .= '<i class="fa fa-users"></i> <span>Users</span>';
		$content .= '<span class="pull-right-container">';
		$content .= '<i class="fa fa-angle-left pull-right"></i>';
		$content .= '</span>';
		$content .= '</a>';
		$content .= '<ul class="treeview-menu">';
		$content .= '<li><a href="?page=users&amp;action=add"><i class="fa fa-plus"></i> Add New</a></li>';
		$content .= '<li><a href="?page=users"><i class="fa fa-users"></i> <span>All Users</span></a></li>';
		$content .= '</ul>';
		$content .= '</li>';
		$content .= '<li><a href="?page=profile"><i class="fa fa-user"></i> <span>Your Profile</span></a></li>';
		$content .= '</ul>';
		$content .= '</section>';
		$content .= '</aside>';
		$content .= '<div class="content-wrapper">';
		switch($_GET["action"]){
			case "list":
				$page_title = "Users - List";
				/** breadcrumb **/
				$content .= '<section class="content-header">';
				$content .= '<h1>Users <small>Add, edit and delete your users</small></h1>';
				$content .= '<ol class="breadcrumb">';
				$content .= '<li><a href="?"><i class="fa fa-dashboard"></i> Home</a></li>';
				$content .= '<li class="active">Users</li>';
				$content .= '<li>List</li>';
				$content .= '</ol>';
				$content .= '</section>';
				/** content **/
				$content .= '<section class="content">';
				$content .= $notification;
				$content .= '<div class="box box-danger">';
				$content .= '<div class="box-header with-border">';
				$content .= '<h3 class="box-title">Users</h3>';
				$content .= '<div class="box-tools pull-right">';
				$content .= '<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>';
				$content .= '<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>';
				$content .= '</div>';
				$content .= '</div>';
				$content .= '<div class="box-body">';
				$content .= '<div class="table-responsive">';
				$content .= '<table class="datatable table table-striped table-hover">';
				$content .= '<thead>';
				$content .= '<tr>';
				$content .= '<th>User Name</th>';
				$content .= '<th>Full Name</th>';
				$content .= '<th>Email Address</th>';
				$content .= '<th>Birthday</th>';
				$content .= '<th>Phone</th>';
				$content .= '<th>Website</th>';
				$content .= '<th>Expired</th>';
				$content .= '<th>Level</th>';
				$content .= '<th>Status</th>';
				$content .= '<th>#</th>';
				$content .= '</tr>';
				$content .= '</thead>';
				$content .= '<tbody>';
				/** fetch data from mysql **/
				$sql_query = "SELECT * FROM `users`" ;
				if($result = $mysql->query($sql_query)){
					while ($data = $result->fetch_array()){
						$content .= '<tr>';
						$content .= '<td><code>' . htmlentities($data["user_name"]) . '</code></td>';
						$content .= '<td>' . htmlentities(ucwords($data["user_first_name"])) . ' ' . htmlentities(ucwords($data["user_last_name"])) . '</td>';
						$content .= '<td><a href="mailto:' . htmlentities($data["user_email"]) . '">' . htmlentities($data["user_email"]) . '</a></td>';
						$content .= '<td>' . htmlentities($data["user_birthday"]) . '</td>';
						if($data["user_phone"] !== ""){
						$content .= '<td><a href="tel:' . htmlentities($data["user_phone"]) . '">' . htmlentities($data["user_phone"]) . '</a></td>';
						}else{
							$content .= '<td>-</td>';
						}
						if($data["user_website"] !== ""){
							$content .= '<td><a target="_blank" href="' . htmlentities($data["user_website"]) . '">' . htmlentities($data["user_website"]) . '</a></td>';
						}else{
							$content .= '<td></td>';
						}
						if($data["user_expired"] !== "0000-00-00 00:00:00"){
							$content .= '<td>' . htmlentities($data["user_expired"]) . '</td>';
						}else{
							$content .= '<td></td>';
						}
						switch($data["user_level"]){
							case "admin":
								$content .= '<td><span class="label label-warning"><i class="fa fa-fort-awesome"></i> ' . ucwords($data["user_level"]) . '</span></td>';
								break;
							case "user":
								$content .= '<td><span class="label label-default"><i class="fa fa-user"></i> ' . ucwords($data["user_level"]) . '</span></td>';
								break;
						}
						switch($data["user_status"]){
							case "active":
								$content .= '<td><span class="label label-success">' . ucwords($data["user_status"]) . '</span></td>';
								break;
							case "pending":
								$content .= '<td><span class="label label-default">' . ucwords($data["user_status"]) . '</span></td>';
								break;
							case "banned":
								$content .= '<td><span class="label label-danger">' . ucwords($data["user_status"]) . '</span></td>';
								break;
						}
						$content .= '<td>';
						$content .= '<a href="?page=users&amp;action=edit&amp;id='.$data["user_id"].'" class="btn btn-success btn-flat btn-sm"><i class="fa fa-edit"></i></a>';
						switch($data["user_level"]){
							case "user":
								$content .= '<a class="btn btn-danger btn-flat btn-sm" href="#" onClick="doModal(\'Delete user\',\'<div class=\\\'row\\\'><div class=\\\'col-md-3 text-center text-primary\\\'><i class=\\\'fa fa-5x fa-users\\\'></i></div><div class=\\\'col-md-9\\\'>You are about to permanently delete this user from your site. <br/>This action cannot be undo, `Cancel` to stop, `OK` to delete.</div></div>\',\'Ok\',\'danger\',\'window.location=\\\'?page=users&amp;action=delete&amp;id='.$data["user_id"].'\\\'\');"><i class="fa fa-trash"></i></a>';
								break;
							case "admin":
								//$content .= '<a class="btn btn-danger btn-flat btn-sm" href="#" onClick="doModal(\'Delete user\',\'<div class=\\\'row\\\'><div class=\\\'col-md-3 text-center text-primary\\\'><i class=\\\'fa fa-5x fa-users\\\'></i></div><div class=\\\'col-md-9\\\'>You are about to permanently delete this user from your site. <br/>This action cannot be undo, `Cancel` to stop, `OK` to delete.</div></div>\',\'Ok\',\'danger\',\'window.location=\\\'?page=users&amp;action=delete&amp;id='.$data["user_id"].'\\\'\');"><i class="fa fa-trash"></i></a>';
								break;
						}
						$content .= '</td>';
						$content .= '</tr>';
					}
				}
				$content .= '</tbody>';
				$content .= '</table>';
				$content .= '</div>';
				$content .= '</div><!-- ./box-body -->';
				$content .= '</div><!-- ./box -->';
				$content .= '</section>';
				break;
			case "edit":
				// TODO: PAGE - USERS - EDIT
				if(isset($_GET["id"])){
					$entry_id = (int)$_GET["id"];
					/** fetch current data **/
					$sql_query = "SELECT * FROM `users` WHERE `user_id`=$entry_id LIMIT 0,1" ;
					$result = $mysql->query($sql_query);
					$rowdata = $result->fetch_array();
						
					if(isset($rowdata["user_id"])){
						/** response postdata **/
						if(isset($_POST["submit"])){
							$postdata["user_name"] = $rowdata["user_name"];
							$postdata["user_first_name"] = $rowdata["user_first_name"];
							$postdata["user_last_name"] = $rowdata["user_last_name"];
							$postdata["user_birthday"] = $rowdata["user_birthday"];
							$postdata["user_email"] = $rowdata["user_email"];
							$postdata["user_website"] = $rowdata["user_website"];
							$postdata["user_company"] = $rowdata["user_company"];
							$postdata["user_level"] = $rowdata["user_level"];
							$postdata["user_token"] = $rowdata["user_token"];
							$postdata["user_address_1"] = $rowdata["user_address_1"];
							$postdata["user_address_2"] = $rowdata["user_address_2"];
							$postdata["user_city"] = $rowdata["user_city"];
							$postdata["user_state"] = $rowdata["user_state"];
							$postdata["user_postcode"] = $rowdata["user_postcode"];
							$postdata["user_country"] = $rowdata["user_country"];
							$postdata["user_phone"] = $rowdata["user_phone"];
							$postdata["user_note"] = $rowdata["user_note"];
							$postdata["user_expired"] = $rowdata["user_expired"];
							$postdata["user_status"] = $rowdata["user_status"];
							if(isset($_POST["postdata"]["user-name"])){
								$postdata["user_name"] = addslashes($_POST["postdata"]["user-name"]);
							}
							if(isset($_POST["postdata"]["user-first-name"])){
								$postdata["user_first_name"] = addslashes($_POST["postdata"]["user-first-name"]);
							}
							if(isset($_POST["postdata"]["user-last-name"])){
								$postdata["user_last_name"] = addslashes($_POST["postdata"]["user-last-name"]);
							}
							if(isset($_POST["postdata"]["user-birthday"])){
								$postdata["user_birthday"] = addslashes($_POST["postdata"]["user-birthday"]);
							}
							if(isset($_POST["postdata"]["user-email"])){
								$postdata["user_email"] = addslashes($_POST["postdata"]["user-email"]);
							}
							if(isset($_POST["postdata"]["user-website"])){
								$postdata["user_website"] = addslashes($_POST["postdata"]["user-website"]);
							}
							if(isset($_POST["postdata"]["user-company"])){
								$postdata["user_company"] = addslashes($_POST["postdata"]["user-company"]);
							}
							if(isset($_POST["postdata"]["user-address-1"])){
								$postdata["user_address_1"] = addslashes($_POST["postdata"]["user-address-1"]);
							}
							if(isset($_POST["postdata"]["user-address-2"])){
								$postdata["user_address_2"] = addslashes($_POST["postdata"]["user-address-2"]);
							}
							if(isset($_POST["postdata"]["user-city"])){
								$postdata["user_city"] = addslashes($_POST["postdata"]["user-city"]);
							}
							if(isset($_POST["postdata"]["user-state"])){
								$postdata["user_state"] = addslashes($_POST["postdata"]["user-state"]);
							}
							if(isset($_POST["postdata"]["user-postcode"])){
								$postdata["user_postcode"] = addslashes($_POST["postdata"]["user-postcode"]);
							}
							if(isset($_POST["postdata"]["user-country"])){
								$postdata["user_country"] = addslashes($_POST["postdata"]["user-country"]);
							}
							if(isset($_POST["postdata"]["user-phone"])){
								$postdata["user_phone"] = addslashes($_POST["postdata"]["user-phone"]);
							}
							if(isset($_POST["postdata"]["user-note"])){
								$postdata["user_note"] = addslashes($_POST["postdata"]["user-note"]);
							}
							if(isset($_POST["postdata"]["user-expired"])){
								$postdata["user_expired"] = addslashes($_POST["postdata"]["user-expired"]);
							}
							if(isset($_POST["postdata"]["user-status"])){
								$postdata["user_status"] = addslashes($_POST["postdata"]["user-status"]);
							}
							if(isset($_POST["postdata"]["user-password"])){
								$postdata["user_password"] = sha1("imabuilder" . $_POST["postdata"]["user-password"]);
							}else{
								$_POST["postdata"]["user-password"]="";
							}
							$sql_query = "SELECT COUNT(*) AS exist FROM `users` WHERE `user_name` LIKE '{$postdata["user_name"]}' AND `user_id` !={$entry_id}";
							if($result = $mysql->query($sql_query)){
								$data = $result->fetch_array();
								if($data["exist"] == 0){
									$sql_query = "SELECT COUNT(*) AS exist FROM `users` WHERE `user_email` LIKE '{$postdata["user_email"]}' AND `user_id` !={$entry_id}";
									if($result = $mysql->query($sql_query)){
										$data = $result->fetch_array();
										if($data["exist"] == 0){
												$sql_query = null ;
												$sql_query .= "UPDATE `users` SET ";
												if(strlen($_POST["postdata"]["user-password"]) > 5 ){
													$sql_query .= "`user_password` = '{$postdata["user_password"]}', " ;
												}
												$sql_query .= "`user_name` = '{$postdata["user_name"]}', " ;
												$sql_query .= "`user_first_name` = '{$postdata["user_first_name"]}', " ;
												$sql_query .= "`user_last_name` = '{$postdata["user_last_name"]}', " ;
												$sql_query .= "`user_birthday` = '{$postdata["user_birthday"]}', " ;
												$sql_query .= "`user_email` = '{$postdata["user_email"]}', " ;
												$sql_query .= "`user_phone` = '{$postdata["user_phone"]}', " ;
												$sql_query .= "`user_website` = '{$postdata["user_website"]}', " ;
												$sql_query .= "`user_company` = '{$postdata["user_company"]}', " ;
												$sql_query .= "`user_address_1` = '{$postdata["user_address_1"]}', " ;
												$sql_query .= "`user_address_2` = '{$postdata["user_address_2"]}', " ;
												$sql_query .= "`user_city` = '{$postdata["user_city"]}', " ;
												$sql_query .= "`user_state` = '{$postdata["user_state"]}', " ;
												$sql_query .= "`user_postcode` = '{$postdata["user_postcode"]}', " ;
												$sql_query .= "`user_country` = '{$postdata["user_country"]}', " ;
												$sql_query .= "`user_note` = '{$postdata["user_note"]}', " ;
												$sql_query .= "`user_expired` = '{$postdata["user_expired"]}', " ;
												$sql_query .= "`user_status` = '{$postdata["user_status"]}' " ;
												$sql_query .= "WHERE `user_id`=$entry_id";
												$stmt = $mysql->prepare($sql_query);
												$stmt->execute();
												$stmt->close();
												header("Location: ?page=users&action=edit&id=".$entry_id."&notice=success-edit");
										}else{
											$notification .= '<div id="notification" class="alert alert-danger">';
											$notification .= '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
											$notification .= 'This <strong>email</strong> has already been used!';
											$notification .= '</div>';
										}
									}
								}else{
									$notification .= '<div id="notification" class="alert alert-danger">';
									$notification .= '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
									$notification .= 'This <strong>username</strong> has already been used!';
									$notification .= '</div>';
								}
							}
						}
						$page_title = "Users - Edit " . htmlentities($rowdata["user_first_name"]);
						/** breadcrumb **/
						$content .= '<section class="content-header">';
						$content .= '<h1>Users <small>Add, edit and delete your users</small></h1>';
						$content .= '<ol class="breadcrumb">';
						$content .= '<li><a href="?"><i class="fa fa-dashboard"></i> Home</a></li>';
						$content .= '<li class="active">Users</li>';
						$content .= '<li>Edit</li>';
						$content .= '</ol>';
						$content .= '</section>';
						
						/** content **/
						$content .= '<section class="content">';
						$content .= $notification;
						$content .= '<form role="form" action="" method="post">';
						$content .= '<div class="box box-success">';
						$content .= '<div class="box-header with-border">';
						$content .= '<h3 class="box-title">Users <strong>' . htmlentities($rowdata["user_first_name"]).'</strong></h3>';
						$content .= '<div class="box-tools pull-right">';
						$content .= '<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>';
						$content .= '<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>';
						$content .= '</div>';
						$content .= '</div>';
						$content .= '<div class="box-body">';
						
						$content .= '<div class="row">';
						$content .= '<div class="col-md-6">';
						
						$content .= '<div class="row">';
						$content .= '<div class="col-md-6">';
						$content .= '<div class="form-group">';
						$content .= '<label>Username</label>';
						$content .= '<input type="text" class="form-control" name="postdata[user-name]" placeholder="ahmad-dahlan" value="' . htmlentities($rowdata["user_name"]).'" required/>';
						$content .= '<p class="help-block">Write the username</p>';
						$content .= '</div>';
						$content .= '</div>';
						$content .= '<div class="col-md-6">';
						$content .= '<div class="form-group">';
						$content .= '<label>Birthday</label>';
						$content .= '<div class="input-group date">';
						$content .= '<div class="input-group-addon"><i class="fa fa-clock-o"></i></div>';
						$content .= '<input type="text" data-type="date" class="form-control" name="postdata[user-birthday]" placeholder="" value="' . htmlentities($rowdata["user_birthday"]).'" required/>';
						$content .= '</div>';
						$content .= '<p class="help-block">Write the birthday</p>';
						$content .= '</div>';
						$content .= '</div>';
						$content .= '</div>';
						
						$content .= '<div class="row">';
						$content .= '<div class="col-md-6">';
						$content .= '<div class="form-group">';
						$content .= '<label>First Name</label>';
						$content .= '<input type="text" class="form-control" name="postdata[user-first-name]" placeholder="Ahmad Dahlan" value="' . htmlentities($rowdata["user_first_name"]).'" required/>';
						$content .= '<p class="help-block">Write the user\'s first name</p>';
						$content .= '</div>';
						$content .= '</div>';
						$content .= '<div class="col-md-6">';
						$content .= '<div class="form-group">';
						$content .= '<label>Last Name</label>';
						$content .= '<input type="text" class="form-control" name="postdata[user-last-name]" placeholder="Ahmad Dahlan" value="' . htmlentities($rowdata["user_last_name"]).'" required/>';
						$content .= '<p class="help-block">Write the user\'s last name</p>';
						$content .= '</div>';
						$content .= '</div>';
						$content .= '</div>';
						
						$content .= '<div class="row">';
						$content .= '<div class="col-md-6">';
						$content .= '<div class="form-group">';
						$content .= '<label>Phone</label>';
						$content .= '<div class="input-group">';
						$content .= '<div class="input-group-addon"><i class="fa fa-phone"></i></div>';
						$content .= '<input type="text" class="form-control" name="postdata[user-phone]" placeholder="6281234568" value="' . htmlentities($rowdata["user_phone"]).'" />';
						$content .= '</div>';
						$content .= '<p class="help-block">Write the user\'s phone</p>';
						$content .= '</div>';
						$content .= '</div>';
						$content .= '</div>';
						
						$content .= '<div class="row">';
						$content .= '<div class="col-md-6">';
						$content .= '<div class="form-group">';
						$content .= '<label>Company</label>';
						$content .= '<input type="text" class="form-control" name="postdata[user-company]" placeholder="" value="' . htmlentities($rowdata["user_company"]).'" />';
						$content .= '<p class="help-block">Write the user\'s company</p>';
						$content .= '</div>';
						$content .= '</div>';
						$content .= '<div class="col-md-6">';
						$content .= '<div class="form-group">';
						$content .= '<label>Website</label>';
						$content .= '<input type="url" class="form-control" name="postdata[user-website]" placeholder="https://domain.com" value="' . htmlentities($rowdata["user_website"]).'" />';
						$content .= '<p class="help-block">Write the user\'s website</p>';
						$content .= '</div>';
						$content .= '</div>';
						$content .= '</div>';
						
						$content .= '<div class="form-group">';
						$content .= '<label>Address 1</label>';
						$content .= '<input type="text" class="form-control" name="postdata[user-address-1]" placeholder="" value="' . htmlentities($rowdata["user_address_1"]).'" />';
						$content .= '<p class="help-block">Write the user\'s address 1</p>';
						$content .= '</div>';
						
						$content .= '<div class="form-group">';
						$content .= '<label>Address 2</label>';
						$content .= '<input type="text" class="form-control" name="postdata[user-address-2]" placeholder="" value="' . htmlentities($rowdata["user_address_2"]).'" />';
						$content .= '<p class="help-block">Write the user\'s address 2</p>';
						$content .= '</div>';
						
						$content .= '<div class="row">';
						$content .= '<div class="col-md-6">';
						$content .= '<div class="form-group">';
						$content .= '<label>City</label>';
						$content .= '<input type="text" class="form-control" name="postdata[user-city]" placeholder="Pasaman Barat" value="' . htmlentities($rowdata["user_city"]).'" />';
						$content .= '<p class="help-block">Write the user\'s city</p>';
						$content .= '</div>';
						$content .= '</div>';
						$content .= '<div class="col-md-6">';
						$content .= '<div class="form-group">';
						$content .= '<label>State</label>';
						$content .= '<input type="text" class="form-control" name="postdata[user-state]" placeholder="Sumatera Barat" value="' . htmlentities($rowdata["user_state"]).'" />';
						$content .= '<p class="help-block">Write the user\'s state</p>';
						$content .= '</div>';
						$content .= '</div>';
						$content .= '</div>';
						
						$content .= '<div class="row">';
						$content .= '<div class="col-md-6">';
						$content .= '<div class="form-group">';
						$content .= '<label>Postcode</label>';
						$content .= '<input type="text" class="form-control" name="postdata[user-postcode]" placeholder="26567" value="' . htmlentities($rowdata["user_postcode"]).'" />';
						$content .= '<p class="help-block">Write the user\'s postcode</p>';
						$content .= '</div>';
						$content .= '</div>';
						$content .= '<div class="col-md-6">';
						$content .= '<div class="form-group">';
						$content .= '<label>Country</label>';
						$content .= '<input type="text" class="form-control" name="postdata[user-country]" placeholder="Indonesia" value="' . htmlentities($rowdata["user_country"]).'" />';
						$content .= '<p class="help-block">Write the user\'s country</p>';
						$content .= '</div>';
						$content .= '</div>';
						$content .= '</div>';
						
						$content .= '</div><!-- ./col-md-6 -->';
						
						$content .= '<div class="col-md-6">';
						
						$content .= '<div class="form-group">';
						$content .= '<label>Note</label>';
						$content .= '<textarea name="postdata[user-note]" class="form-control">' . htmlentities($rowdata["user_note"]).'</textarea>';
						$content .= '<p class="help-block">Write notes if needed</p>';
						$content .= '</div>';
						$content .= '<div class="row">';
						$content .= '<div class="col-md-6">';
						$content .= '<div class="form-group">';
						$content .= '<label>Expired</label>';
						$content .= '<div class="input-group date">';
						$content .= '<div class="input-group-addon"><i class="fa fa-clock-o"></i></div>';
						$content .= '<input type="text" data-type="datetime" class="form-control" name="postdata[user-expired]" placeholder="2019-11-08 14:00:09" value="' . htmlentities($rowdata["user_expired"]).'" />';
						$content .= '</div>';
						$content .= '<p class="help-block">Write the expiration time if it is needed</p>';
						$content .= '</div>';
						$content .= '</div>';
						$content .= '<div class="col-md-6">';
						
						$status_options[] = "pending" ;
						$status_options[] = "active" ;
						$status_options[] = "banned" ;
						$content .= '<div class="form-group">';
						$content .= '<label>Status</label>';
						$content .= '<select class="form-control" name="postdata[user-status]">';
						foreach($status_options as $status_option){
							$selected = "";
							if($status_option==$rowdata["user_status"]){
								$selected = "selected";
							}
							$content .= '<option value="'.$status_option.'" '.$selected.'>'.ucwords($status_option).'</option>';
						}
						$content .= '</select>';
						$content .= '<p class="help-block">&nbsp;</p>';
						$content .= '</div>';
						$content .= '</div>';
						$content .= '</div>';
						$content .= '<hr/>';
						$content .= '<div class="row">';
						$content .= '<div class="col-md-6">';
						$content .= '<div class="form-group">';
						$content .= '<label>Email</label>';
						$content .= '<div class="input-group">';
						$content .= '<div class="input-group-addon"><i class="fa fa-envelope-o"></i></div>';
						$content .= '<input type="email" class="form-control" name="postdata[user-email]" placeholder="email@domain.com"  value="' . htmlentities($rowdata["user_email"]).'" required/>';
						$content .= '</div>';
						$content .= '<p class="help-block">Write the email used to log in</p>';
						$content .= '</div>';
						$content .= '</div>';
						$content .= '<div class="col-md-6">';
						$content .= '<div class="form-group">';
						$content .= '<label>Password</label>';
						$content .= '<div class="input-group">';
						$content .= '<div class="input-group-addon"><i class="fa fa-lock"></i></div>';
						$content .= '<input type="text" minlength="6" class="form-control" name="postdata[user-password]" value="" />';
						$content .= '</div>';
						$content .= '<p class="help-block">Leave this blank if you do not want to change the user\'s password</p>';
						$content .= '</div>';
						$content .= '</div>';
						$content .= '</div>';
						
						$content .= '</div><!-- ./col-md-6 -->';
						
						$content .= '</div><!-- ./row -->';
						$content .= '</div><!-- ./box-body -->';
						$content .= '<div class="box-footer">';
						$content .= '<button type="submit" class="btn btn-flat btn-primary" name="submit"><i class="fa fa-floppy-o"></i> Update</button>';
						$content .= '</div>';
						$content .= '</div><!-- ./box -->';
						$content .= '</form><!-- ./form -->';
						$content .= '</section>';
					}else{
						header("Location: ?page=users&notice=wrong-id");
					}
				}else{
					header("Location: ?page=users&notice=wrong-id");
				}
				break;
			case "add":
				// TODO: PAGE - USERS - ADD
				$postdata["user_name"] = null;
				$postdata["user_birthday"] = "1990-01-01";
				$postdata["user_first_name"] = null;
				$postdata["user_last_name"] = null;
				$postdata["user_email"] = null;
				$postdata["user_company"] = null;
				$postdata["user_website"] = null;
				$postdata["user_level"] = "user";
				$postdata["user_token"] = null;
				$postdata["user_address_1"] = null;
				$postdata["user_address_2"] = null;
				$postdata["user_phone"] = null;
				$postdata["user_note"] = null;
				$postdata["user_expired"] = "0000-00-00 00:00:00";
				$postdata["user_status"] = null;
				$postdata["user_password"] = null;
				$postdata["user_city"] = "";
				$postdata["user_state"] = "";
				$postdata["user_postcode"] = "";
				$postdata["user_country"] = "";
				/** response postdata **/
				if(isset($_POST["submit"])){
					if(isset($_POST["postdata"]["user-name"])){
						$postdata["user_name"] = addslashes($_POST["postdata"]["user-name"]);
					}
					if(isset($_POST["postdata"]["user-birthday"])){
						$postdata["user_birthday"] = addslashes($_POST["postdata"]["user-birthday"]);
					}
					if(isset($_POST["postdata"]["user-first-name"])){
						$postdata["user_first_name"] = addslashes($_POST["postdata"]["user-first-name"]);
					}
					if(isset($_POST["postdata"]["user-last-name"])){
						$postdata["user_last_name"] = addslashes($_POST["postdata"]["user-last-name"]);
					}
					if(isset($_POST["postdata"]["user-email"])){
						$postdata["user_email"] = addslashes($_POST["postdata"]["user-email"]);
					}
					if(isset($_POST["postdata"]["user-website"])){
						$postdata["user_website"] = addslashes($_POST["postdata"]["user-website"]);
					}
					if(isset($_POST["postdata"]["user-company"])){
						$postdata["user_company"] = addslashes($_POST["postdata"]["user-company"]);
					}
					if(isset($_POST["postdata"]["user-address-1"])){
						$postdata["user_address_1"] = addslashes($_POST["postdata"]["user-address-1"]);
					}
					if(isset($_POST["postdata"]["user-address-2"])){
						$postdata["user_address_2"] = addslashes($_POST["postdata"]["user-address-2"]);
					}
					if(isset($_POST["postdata"]["user-city"])){
						$postdata["user_city"] = addslashes($_POST["postdata"]["user-city"]);
					}
					if(isset($_POST["postdata"]["user-state"])){
						$postdata["user_state"] = addslashes($_POST["postdata"]["user-state"]);
					}
					if(isset($_POST["postdata"]["user-postcode"])){
						$postdata["user_postcode"] = addslashes($_POST["postdata"]["user-postcode"]);
					}
					if(isset($_POST["postdata"]["user-country"])){
						$postdata["user_country"] = addslashes($_POST["postdata"]["user-country"]);
					}
					if(isset($_POST["postdata"]["user-phone"])){
						$postdata["user_phone"] = addslashes($_POST["postdata"]["user-phone"]);
					}
					if(isset($_POST["postdata"]["user-note"])){
						$postdata["user_note"] = addslashes($_POST["postdata"]["user-note"]);
					}
					if(isset($_POST["postdata"]["user-expired"])){
						$postdata["user_expired"] = addslashes($_POST["postdata"]["user-expired"]);
					}
					if(isset($_POST["postdata"]["user-status"])){
						$postdata["user_status"] = addslashes($_POST["postdata"]["user-status"]);
					}
					if(isset($_POST["postdata"]["user-password"])){
						$postdata["user_password"] = sha1("imabuilder" . $_POST["postdata"]["user-password"]);
					}
					
					$sql_query = "SELECT COUNT(*) AS exist FROM `users` WHERE `user_name` LIKE '{$postdata["user_name"]}' ";
					if($result = $mysql->query($sql_query)){
						$data = $result->fetch_array();
						if($data["exist"] == 0){
							$sql_query = "SELECT COUNT(*) AS exist FROM `users` WHERE `user_email` LIKE '{$postdata["user_email"]}' ";
							if($result = $mysql->query($sql_query)){
								$data = $result->fetch_array();
								if($data["exist"] == 0){
									$sql_query = null ;
									$sql_query .= "INSERT INTO `users` (`user_name`,`user_birthday`,`user_first_name`,`user_last_name`,`user_email`,`user_company`,`user_website`,`user_level`,`user_password`,`user_token`,`user_address_1`,`user_address_2`,`user_city`,`user_state`,`user_postcode`,`user_country`,`user_phone`,`user_note`,`user_expired`,`user_status`) VALUES " ;
									$sql_query .= "('{$postdata["user_name"]}','{$postdata["user_birthday"]}','{$postdata["user_first_name"]}','{$postdata["user_last_name"]}', '{$postdata["user_email"]}','{$postdata["user_company"]}', '{$postdata["user_website"]}', '{$postdata["user_level"]}', '{$postdata["user_password"]}', '{$postdata["user_token"]}', '{$postdata["user_address_1"]}','{$postdata["user_address_2"]}', '{$postdata["user_city"]}','{$postdata["user_state"]}','{$postdata["user_postcode"]}','{$postdata["user_country"]}', '{$postdata["user_phone"]}','{$postdata["user_note"]}', '{$postdata["user_expired"]}', '{$postdata["user_status"]}');" ;
									$stmt = $mysql->prepare($sql_query);
									$stmt->execute();
									$stmt->close();
									header("Location: ?page=users&notice=success-add");
								}else{
									$notification .= '<div id="notification" class="alert alert-danger">';
									$notification .= '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
									$notification .= 'This <strong>email</strong> has already been used!';
									$notification .= '</div>';
								}
							}
						}else{
							$notification .= '<div id="notification" class="alert alert-danger">';
							$notification .= '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
							$notification .= 'This <strong>username</strong> has already been used!';
							$notification .= '</div>';
						}
					}
				}
				$page_title = "Users - Add new User"; 
				/** breadcrumb **/
				$content .= '<section class="content-header">';
				$content .= '<h1>Users <small>Add, edit and delete your users</small></h1>';
				$content .= '<ol class="breadcrumb">';
				$content .= '<li><a href="?"><i class="fa fa-dashboard"></i> Home</a></li>';
				$content .= '<li class="active">Users</li>';
				$content .= '<li>Edit</li>';
				$content .= '</ol>';
				$content .= '</section>';
				
				/** content **/
				$content .= '<section class="content">';
				$content .= $notification;
				$content .= '<form action="" method="post">';
				$content .= '<div class="box box-success">';
				$content .= '<div class="box-header with-border">';
				$content .= '<h3 class="box-title">New user</h3>';
				$content .= '<div class="box-tools pull-right">';
				$content .= '<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>';
				$content .= '<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>';
				$content .= '</div>';
				$content .= '</div>';
				$content .= '<div class="box-body">';
						
						$content .= '<div class="row">';
						$content .= '<div class="col-md-6">';
						
						$content .= '<div class="row">';
						$content .= '<div class="col-md-6">';
						$content .= '<div class="form-group">';
						$content .= '<label>Username</label>';
						$content .= '<input type="text" class="form-control" name="postdata[user-name]" placeholder="ahmad-dahlan" value="' . htmlentities($postdata["user_name"]).'" required/>';
						$content .= '<p class="help-block">Write the username</p>';
						$content .= '</div>';
						$content .= '</div>';
						$content .= '<div class="col-md-6">';
						$content .= '<div class="form-group">';
						$content .= '<label>Birthday</label>';
						$content .= '<div class="input-group date">';
						$content .= '<div class="input-group-addon"><i class="fa fa-clock-o"></i></div>';
						$content .= '<input type="text" data-type="date" class="form-control" name="postdata[user-birthday]" placeholder="" value="' . htmlentities($postdata["user_birthday"]).'" required/>';
						$content .= '</div>';
						$content .= '<p class="help-block">Write the birthday</p>';
						$content .= '</div>';
						$content .= '</div>';
						$content .= '</div>';
						
						$content .= '<div class="row">';
						$content .= '<div class="col-md-6">';
						$content .= '<div class="form-group">';
						$content .= '<label>First Name</label>';
						$content .= '<input type="text" class="form-control" name="postdata[user-first-name]" placeholder="Ahmad Dahlan" value="' . htmlentities($postdata["user_first_name"]).'" required/>';
						$content .= '<p class="help-block">Write the user\'s first name</p>';
						$content .= '</div>';
						$content .= '</div>';
						$content .= '<div class="col-md-6">';
						$content .= '<div class="form-group">';
						$content .= '<label>Last Name</label>';
						$content .= '<input type="text" class="form-control" name="postdata[user-last-name]" placeholder="Ahmad Dahlan" value="' . htmlentities($postdata["user_last_name"]).'" required/>';
						$content .= '<p class="help-block">Write the user\'s last name</p>';
						$content .= '</div>';
						$content .= '</div>';
						$content .= '</div>';
						
						$content .= '<div class="row">';
						$content .= '<div class="col-md-6">';
						$content .= '<div class="form-group">';
						$content .= '<label>Phone</label>';
						$content .= '<div class="input-group">';
						$content .= '<div class="input-group-addon"><i class="fa fa-phone"></i></div>';
						$content .= '<input type="text" class="form-control" name="postdata[user-phone]" placeholder="6281234568" value="' . htmlentities($postdata["user_phone"]).'" />';
						$content .= '</div>';
						$content .= '<p class="help-block">Write the user\'s phone</p>';
						$content .= '</div>';
						$content .= '</div>';
						$content .= '</div>';
						
						$content .= '<div class="row">';
						$content .= '<div class="col-md-6">';
						$content .= '<div class="form-group">';
						$content .= '<label>Company</label>';
						$content .= '<input type="text" class="form-control" name="postdata[user-company]" placeholder="" value="' . htmlentities($postdata["user_company"]).'" />';
						$content .= '<p class="help-block">Write the user\'s company</p>';
						$content .= '</div>';
						$content .= '</div>';
						$content .= '<div class="col-md-6">';
						$content .= '<div class="form-group">';
						$content .= '<label>Website</label>';
						$content .= '<input type="url" class="form-control" name="postdata[user-website]" placeholder="https://domain.com" value="' . htmlentities($postdata["user_website"]).'" />';
						$content .= '<p class="help-block">Write the user\'s website</p>';
						$content .= '</div>';
						$content .= '</div>';
						$content .= '</div>';
						
						$content .= '<div class="form-group">';
						$content .= '<label>Address 1</label>';
						$content .= '<input type="text" class="form-control" name="postdata[user-address-1]" placeholder="" value="' . htmlentities($postdata["user_address_1"]).'" />';
						$content .= '<p class="help-block">Write the user\'s address 1</p>';
						$content .= '</div>';
						
						$content .= '<div class="form-group">';
						$content .= '<label>Address 2</label>';
						$content .= '<input type="text" class="form-control" name="postdata[user-address-2]" placeholder="" value="' . htmlentities($postdata["user_address_2"]).'" />';
						$content .= '<p class="help-block">Write the user\'s address 2</p>';
						$content .= '</div>';
						
						$content .= '<div class="row">';
						$content .= '<div class="col-md-6">';
						$content .= '<div class="form-group">';
						$content .= '<label>City</label>';
						$content .= '<input type="text" class="form-control" name="postdata[user-city]" placeholder="Pasaman Barat" value="' . htmlentities($postdata["user_city"]).'" />';
						$content .= '<p class="help-block">Write the user\'s city</p>';
						$content .= '</div>';
						$content .= '</div>';
						$content .= '<div class="col-md-6">';
						$content .= '<div class="form-group">';
						$content .= '<label>State</label>';
						$content .= '<input type="text" class="form-control" name="postdata[user-state]" placeholder="Sumatera Barat" value="' . htmlentities($postdata["user_state"]).'" />';
						$content .= '<p class="help-block">Write the user\'s state</p>';
						$content .= '</div>';
						$content .= '</div>';
						$content .= '</div>';
						
						$content .= '<div class="row">';
						$content .= '<div class="col-md-6">';
						$content .= '<div class="form-group">';
						$content .= '<label>Postcode</label>';
						$content .= '<input type="text" class="form-control" name="postdata[user-postcode]" placeholder="26567" value="' . htmlentities($postdata["user_postcode"]).'" />';
						$content .= '<p class="help-block">Write the user\'s postcode</p>';
						$content .= '</div>';
						$content .= '</div>';
						$content .= '<div class="col-md-6">';
						$content .= '<div class="form-group">';
						$content .= '<label>Country</label>';
						$content .= '<input type="text" class="form-control" name="postdata[user-country]" placeholder="Indonesia" value="' . htmlentities($postdata["user_country"]).'" />';
						$content .= '<p class="help-block">Write the user\'s country</p>';
						$content .= '</div>';
						$content .= '</div>';
						$content .= '</div>';
						
						$content .= '</div><!-- ./col-md-6 -->';
						
						$content .= '<div class="col-md-6">';
						
						$content .= '<div class="form-group">';
						$content .= '<label>Note</label>';
						$content .= '<textarea name="postdata[user-note]" class="form-control">' . htmlentities($postdata["user_note"]).'</textarea>';
						$content .= '<p class="help-block">Write notes if needed</p>';
						$content .= '</div>';
						$content .= '<div class="row">';
						$content .= '<div class="col-md-6">';
						$content .= '<div class="form-group">';
						$content .= '<label>Expired</label>';
						$content .= '<div class="input-group date">';
						$content .= '<div class="input-group-addon"><i class="fa fa-clock-o"></i></div>';
						$content .= '<input type="text" data-type="datetime" class="form-control" name="postdata[user-expired]" placeholder="2019-11-08 14:00:09" value="' . htmlentities($postdata["user_expired"]).'" />';
						$content .= '</div>';
						$content .= '<p class="help-block">Write the expiration time if it is needed</p>';
						$content .= '</div>';
						$content .= '</div>';
						$content .= '<div class="col-md-6">';
						
						$status_options[] = "pending" ;
						$status_options[] = "active" ;
						$status_options[] = "banned" ;
						$content .= '<div class="form-group">';
						$content .= '<label>Status</label>';
						$content .= '<select class="form-control" name="postdata[user-status]">';
						foreach($status_options as $status_option){
							$selected = "";
							if($status_option==$postdata["user_status"]){
								$selected = "selected";
							}
							$content .= '<option value="'.$status_option.'" '.$selected.'>'.ucwords($status_option).'</option>';
						}
						$content .= '</select>';
						$content .= '<p class="help-block">&nbsp;</p>';
						$content .= '</div>';
						$content .= '</div>';
						$content .= '</div>';
						$content .= '<hr/>';
						$content .= '<div class="row">';
						$content .= '<div class="col-md-6">';
						$content .= '<div class="form-group">';
						$content .= '<label>Email</label>';
						$content .= '<div class="input-group">';
						$content .= '<div class="input-group-addon"><i class="fa fa-envelope-o"></i></div>';
						$content .= '<input type="email" class="form-control" name="postdata[user-email]" placeholder="email@domain.com"  value="' . htmlentities($postdata["user_email"]).'" required/>';
						$content .= '</div>';
						$content .= '<p class="help-block">Write the email used to log in</p>';
						$content .= '</div>';
						$content .= '</div>';
						$content .= '<div class="col-md-6">';
						$content .= '<div class="form-group">';
						$content .= '<label>Password</label>';
						$content .= '<div class="input-group">';
						$content .= '<div class="input-group-addon"><i class="fa fa-lock"></i></div>';
						$content .= '<input type="text" minlength="6" class="form-control" name="postdata[user-password]" value="" />';
						$content .= '</div>';
						$content .= '<p class="help-block">Leave this blank if you do not want to change the user\'s password</p>';
						$content .= '</div>';
						$content .= '</div>';
						$content .= '</div>';
						
						$content .= '</div><!-- ./col-md-6 -->';
						
						$content .= '</div><!-- ./row -->';
				$content .= '</div><!-- ./box-body -->';
				$content .= '<div class="box-footer">';
				$content .= '<button type="submit" class="btn btn-flat btn-primary" name="submit"><i class="fa fa-user-plus"></i> Add User</button>';
				$content .= '</div>';
				$content .= '</div><!-- ./box -->';
				$content .= '</form><!-- ./form -->';
				$content .= '</section>';
				break;
			case "delete":
				// TODO: PAGE - USERS - DELETE
				if(isset($_GET["id"])){
					$entry_id= (int)$_GET["id"];
					/** fetch current data **/
					$sql_query = "SELECT * FROM `users` WHERE `user_id`=$entry_id AND `user_level` LIKE '%user%' LIMIT 0,1" ;
					$result = $mysql->query($sql_query);
					$rowdata = $result->fetch_array();
					if(isset($rowdata["user_id"])){
						$sql_query = "DELETE FROM `users` WHERE `user_id`=$entry_id";
						$stmt = $mysql->prepare($sql_query);
						$stmt->execute();
						$stmt->close();
						header("Location: ?page=users&notice=success-delete");
					}else{
						header("Location: ?page=users&notice=wrong-id");
					}
				}else{
					header("Location: ?page=users&notice=wrong-id");
				}
				break;
		}
		$content .= '</div><!-- ./content-wrapper -->';
		$content .= '<footer class="main-footer">';
		$content .= '<div class="pull-right hidden-xs">';
		$content .= '<b>Version</b> 01.01.01';
		$content .= '</div>';
		$content .= '<strong>Copyright &copy; '.date("Y").' <a href="https://godigitally.co.in">Go Digitally</a>.</strong> All rights reserved.';
		$content .= '</footer>';
		$content .= '</div><!-- ./wrapper -->';
		break;
	// TODO: PAGE - ONESIGNAL-SENDER
	case "onesignal-sender":
		if($_SESSION["IS_LOGIN"]==false){
			header("Location: ?page=login");
		}
		$page_title = "Profile";
		$body_class = "hold-transition skin-".$config["color"]." sidebar-mini";
		$current_user = $_SESSION["CURRENT_USER"];
		$notification = null;
		if(isset($_POST["send-push"])){
			$push_content = array("en" => $_POST["push-message"]);
		
			$fields = array(
				"app_id" => $config["onesignal_app_id"],
				"included_segments" => array("All"),
				"data" => array("page" => ""),
				"contents" => $push_content
			);
		
			$fields = json_encode($fields);
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
			curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json; charset=utf-8", "Authorization: Basic " . $config["onesignal_api_key"]));
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_HEADER, false);
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			$response = json_decode(curl_exec($ch), true);
			curl_close($ch);
		
			if (isset($response["errors"][0])){
				$notification .= '<div id="notification" class="alert alert-danger">';
				$notification .= '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
				$notification .=  $response["errors"][0];
				$notification .= '</div>';
			} else{
				$notification .= '<div id="notification" class="alert alert-success">';
				$notification .= '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
				$notification .= 'ID #' . $response["id"] . ' with ' . $response["recipients"] . ' recipients';
				$notification .= '</div>';
			}
		
		}
		$content = null;
		$content .= '<div class="wrapper">';
		$content .= '<header class="main-header">';
		$content .= '<a href="?" class="logo">';
		$content .= '<span class="logo-mini"><b>PN</b>L</span>';
		$content .= '<span class="logo-lg"><b>'.$app_name.'</b> Panel</span>';
		$content .= '</a>';
		$content .= '<nav class="navbar navbar-static-top">';
		$content .= '<a href="?" class="sidebar-toggle" data-toggle="push-menu" role="button">';
		$content .= '<span class="sr-only">Toggle navigation</span>';
		$content .= '<span class="icon-bar"></span>';
		$content .= '<span class="icon-bar"></span>';
		$content .= '<span class="icon-bar"></span>';
		$content .= '</a>';
		$content .= '<div class="navbar-custom-menu">';
		$content .= '<ul class="nav navbar-nav">';
		$content .= '<li class="dropdown user user-menu">';
		$content .= '<a href="?" class="dropdown-toggle" data-toggle="dropdown">';
		$content .= '<img src="https://www.gravatar.com/avatar/' . md5(strtolower(trim($current_user['user_email']))).'" class="user-image" alt="User Image">';
		$content .= '<span class="hidden-xs">' . htmlentities(stripslashes($current_user['user_name'])).'</span>';
		$content .= '</a>';
		$content .= '<ul class="dropdown-menu">';
		$content .= '<li class="user-header">';
		$content .= '<img src="https://www.gravatar.com/avatar/' . md5(strtolower(trim($current_user['user_email']))).'" class="img-circle" alt="User Image">';
		$content .= '<p>';
		$content .= '' . htmlentities(stripslashes($current_user['user_name'])).'';
		$content .= '<small>' . htmlentities(stripslashes($current_user['user_level'])).'</small>';
		$content .= '</p>';
		$content .= '</li>';
		$content .= '<li class="user-footer">';
		$content .= '<div class="pull-left">';
		$content .= '<a href="?page=profile" class="btn btn-default btn-flat">Profile</a>';
		$content .= '</div>';
		$content .= '<div class="pull-right">';
		$content .= '<a href="?page=logout" class="btn btn-default btn-flat">Sign out</a>';
		$content .= '</div>';
		$content .= '</li>';
		$content .= '</ul>';
		$content .= '</li>';
		$content .= '</ul>';
		$content .= '</div>';
		$content .= '</nav>';
		$content .= '</header>';
		$content .= '<aside class="main-sidebar">';
		$content .= '<section class="sidebar">';
		$content .= '<div class="user-panel">';
		$content .= '<div class="pull-left image">';
		$content .= '<img src="https://www.gravatar.com/avatar/' . md5(strtolower(trim($current_user['user_email']))).'" class="img-circle" alt="'.htmlentities(stripslashes($current_user['user_name'])).'">';
		$content .= '</div>';
		$content .= '<div class="pull-left info">';
		$content .= '<p>'.htmlentities(stripslashes($current_user['user_name'])).'</p>';
		$content .= '<a href="?"><i class="fa fa-circle text-success"></i> '.htmlentities(stripslashes($current_user['user_level'])).'</a>';
		$content .= '</div>';
		$content .= '</div>';
		$content .= '<ul class="sidebar-menu" data-widget="tree">';
		$content .= '<li class="header">DATA MANAGER</li>';
		$content .= '<li class="treeview">';
		$content .= '<a href="?">';
		$content .= '<i class="fa fa-sitemap"></i> <span>Categories</span>';
		$content .= '<span class="pull-right-container">';
		$content .= '<i class="fa fa-angle-left pull-right"></i>';
		$content .= '</span>';
		$content .= '</a>';
		$content .= '<ul class="treeview-menu">';
		$content .= '<li><a href="?page=categories&amp;action=add"><i class="fa fa-plus"></i> Add New</a></li>';
		$content .= '<li><a href="?page=categories&amp;action=list"><i class="fa fa-list-ul"></i> All Categories</a></li>';
		$content .= '</ul>';
		$content .= '</li>';
		$content .= '<li class="treeview">';
		$content .= '<a href="?">';
		$content .= '<i class="fa fa-newspaper-o"></i> <span>Chapters</span>';
		$content .= '<span class="pull-right-container">';
		$content .= '<i class="fa fa-angle-left pull-right"></i>';
		$content .= '</span>';
		$content .= '</a>';
		$content .= '<ul class="treeview-menu">';
		$content .= '<li><a href="?page=chapters&amp;action=add"><i class="fa fa-plus"></i> Add New</a></li>';
		$content .= '<li><a href="?page=chapters&amp;action=list"><i class="fa fa-list-ul"></i> All Chapters</a></li>';
		$content .= '</ul>';
		$content .= '</li>';
		$content .= '<li class="treeview">';
		$content .= '<a href="?">';
		$content .= '<i class="fa fa-briefcase"></i> <span>Jobs</span>';
		$content .= '<span class="pull-right-container">';
		$content .= '<i class="fa fa-angle-left pull-right"></i>';
		$content .= '</span>';
		$content .= '</a>';
		$content .= '<ul class="treeview-menu">';
		$content .= '<li><a href="?page=jobs&amp;action=add"><i class="fa fa-plus"></i> Add New</a></li>';
		$content .= '<li><a href="?page=jobs&amp;action=list"><i class="fa fa-list-ul"></i> All Jobs</a></li>';
		$content .= '</ul>';
		$content .= '</li>';
		$content .= '<li class="header">TOOLS</li>';
		$content .= '<li class="active"><a href="?page=onesignal-sender"><i class="fa fa-send"></i> <span>OneSignal Sender</span></a></li>';
		$content .= '<li class="header">USERS</li>';
		$content .= '<li><a href="?page=users"><i class="fa fa-users"></i> <span>Users</span></a></li>';
		$content .= '<li><a href="?page=profile"><i class="fa fa-user"></i> <span>Your Profile</span></a></li>';
		$content .= '</ul>';
		$content .= '</section>';
		$content .= '</aside>';
		$content .= '<div class="content-wrapper">';
		/** breadcrumb **/
		$content .= '<section class="content-header">';
		$content .= '<h1>OneSignal Sender <small>Send push notifications for your app</small></h1>';
		$content .= '<ol class="breadcrumb">';
		$content .= '<li><a href="?"><i class="fa fa-dashboard"></i> Home</a></li>';
		$content .= '<li class="active">OneSignal Sender</li>';
		$content .= '</ol>';
		$content .= '</section>';
		/** content **/
		$content .= '<section class="content">';
		$content .= $notification;
		$content .= '<form action="" method="post">';
		$content .= '<div class="box box-danger">';
		$content .= '<div class="box-header with-border">';
		$content .= '<h3 class="box-title">Push Notification</h3>';
		$content .= '<div class="box-tools pull-right">';
		$content .= '<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>';
		$content .= '<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>';
		$content .= '</div>';
		$content .= '</div>';
		$content .= '<div class="box-body">';
		$content .= '<div class="form-group">';
		$content .= '<label class="">Message</label>';
		$content .= '<textarea class="form-control" name="push-message"></textarea>';
		$content .= '</div>';
		$content .= '</div>';
		$content .= '<div class="box-footer">';
		$content .= '<button type="submit" class="btn btn-flat btn-danger" name="send-push"><i class="fa fa-plane"></i> Send notification!</button>';
		$content .= '</div>';
		$content .= '</div>';
		$content .= '</form>';
		$content .= '</section>';
		$content .= '</div><!-- ./content-wrapper -->';
		$content .= '<footer class="main-footer">';
		$content .= '<div class="pull-right hidden-xs">';
		$content .= '<b>Version</b> 01.01.01';
		$content .= '</div>';
		$content .= '<strong>Copyright &copy; '.date("Y").' <a href="https://godigitally.co.in">Go Digitally</a>.</strong> All rights reserved.';
		$content .= '</footer>';
		$content .= '</div><!-- ./wrapper -->';
		break;
}

$mysql->close();
$html_tags = null;
$html_tags .= '<!DOCTYPE html>';
$html_tags .= '<html>';
$html_tags .= '<head>';
$html_tags .= '<meta charset="utf-8">';
$html_tags .= '<meta http-equiv="X-UA-Compatible" content="IE=edge">';
$html_tags .= '<meta name="generator" content="IMA-BuildeRz vrev20.10.11" />';
$html_tags .= '<title>'. htmlentities($app_name .' | '. $page_title) .'</title>';
$html_tags .= '<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">';
$html_tags .= '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3/dist/css/bootstrap.min.css">';
$html_tags .= '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4/css/font-awesome.min.css">';
$html_tags .= '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@2/dist/css/AdminLTE.min.css">';
$html_tags .= '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@2/dist/css/skins/_all-skins.min.css">';
$html_tags .= '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-tagsinput@0.7.1/dist/bootstrap-tagsinput.min.css">';
$html_tags .= '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/datatables.net-bs@1/css/dataTables.bootstrap.min.css">';
$html_tags .= '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/eonasdan-bootstrap-datetimepicker@4/build/css/bootstrap-datetimepicker.min.css">';
$html_tags .= '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/icheck@1/skins/all.css">';
$html_tags .= '<!--[if lt IE 9]>';
$html_tags .= '<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>';
$html_tags .= '<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>';
$html_tags .= '<![endif]-->';
$html_tags .= '<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Anton|Staatliches|Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">';
$html_tags .= '<style type="text/css">';
$html_tags .= 'body{background: url(\''.$config["background"].'\') no-repeat center center fixed !important; -webkit-background-size: cover !important;-moz-background-size: cover !important;-o-background-size: cover !important; background-size: cover !important; }';
$html_tags .= '.well h1 {font-weight:600;font-family:Anton;font-size:48px;}';
$html_tags .= '.content-header h1 {font-size:32px;font-family:Anton;}';
$html_tags .= '.login-logo img {width: 100px;height: 100px;}';
$html_tags .= '.login-logo a, .register-logo a {color: #fff;text-shadow: 1px 1px 1px #333;-webkit-text-shadow: 1px 1px 1px #333;-moz-text-shadow: 1px 1px 1px #333;-o-text-shadow: 1px 1px 1px #333;}';
$html_tags .= 'hr {border-top: 1px solid #ddd;}';
$html_tags .= '.bootstrap-tagsinput{display: block !important;border-radius: 0 !important;}';
$html_tags .= '</style>';
$html_tags .= '</head>';
$html_tags .= '<body class="'.$body_class.'">';
$html_tags .= $content ;
$html_tags .= '<script src="https://cdn.jsdelivr.net/npm/jquery@3/dist/jquery.min.js"></script>';
$html_tags .= '<script src="https://cdn.jsdelivr.net/npm/bootstrap@3/dist/js/bootstrap.min.js"></script>';
$html_tags .= '<script src="https://cdn.jsdelivr.net/npm/bootstrap-tagsinput@0.7.1/dist/bootstrap-tagsinput.min.js"></script>';
$html_tags .= '<script src="https://cdn.jsdelivr.net/npm/datatables.net@1/js/jquery.dataTables.min.js"></script>';
$html_tags .= '<script src="https://cdn.jsdelivr.net/npm/datatables.net-bs@1/js/dataTables.bootstrap.min.js"></script>';
$html_tags .= '<script src="https://cdn.jsdelivr.net/npm/ckeditor@4/ckeditor.js"></script>';
$html_tags .= '<script src="https://cdn.jsdelivr.net/npm/ckeditor@4/adapters/jquery.js"></script>';
$html_tags .= '<script src="https://cdn.jsdelivr.net/npm/moment@2/moment.min.js"></script>';
$html_tags .= '<script src="https://cdn.jsdelivr.net/npm/eonasdan-bootstrap-datetimepicker@4/build/js/bootstrap-datetimepicker.min.js"></script>';
$html_tags .= '<script src="https://cdn.jsdelivr.net/npm/icheck@1/icheck.min.js"></script>';
$html_tags .= '<script src="https://cdn.jsdelivr.net/npm/admin-lte@2/dist/js/adminlte.min.js"></script>';
$html_tags .= '<script>';
$html_tags .= '$(document).ready(function(){';
$html_tags .= '$(".delete").on("click",function(){ var target = $(this).attr("data-target") ;$(target).replaceWith(""); });';
$html_tags .= '$(".sidebar-menu").tree();';
$html_tags .= '$(".datatable").length && $(".datatable").dataTable({"order":[[0,"desc"]]});';
$html_tags .= '$("textarea[data-type=\'html5\']").length && $("textarea[data-type=\'html5\']").ckeditor({filebrowserBrowseUrl:"?page=file-browser"});';
$html_tags .= '$("input[data-type=\'tags\']").length && $("input[data-type=\'tags\']").tagsinput();';
$html_tags .= '$("input[data-type=\'date\']").length && $("input[data-type=\'date\']").datetimepicker({format:\'YYYY-MM-DD\'});';
$html_tags .= '$("input[data-type=\'datetime\']").length && $("input[data-type=\'datetime\']").datetimepicker({format:"YYYY-MM-DD HH:mm:ss"});';
$html_tags .= '$("input[data-type=\'time\']").length && $("input[data-type=\'time\']").datetimepicker({format:"HH:mm:ss"});';
$html_tags .= '$("input[type=\'radio\'].flat-red").length && $("input[type=\'radio\'].flat-red").iCheck({checkboxClass:"icheckbox_flat-red",radioClass:"iradio_flat-red"});';
$html_tags .= 'var fileBrowserTarget="undefined";window.fileBrowser={callBack:function(a){$(fileBrowserTarget).val(a)},open:function(a){var b=window.open("?page=file-browser","File Browser","scrollbars=no, width=1028, height=480, top="+((window.innerHeight?window.innerHeight:document.documentElement.clientHeight?document.documentElement.clientHeight:screen.height)/2-240+(void 0!=window.screenTop?window.screenTop:window.screenY))+", left="+((window.innerWidth?window.innerWidth:document.documentElement.clientWidth?document.documentElement.clientWidth:screen.width)/2-514+(void 0!=window.screenLeft?window.screenLeft:window.screenX)));fileBrowserTarget=a;window.focus&&b.focus()}};if($(\'*[data-type="file-picker"]\').length)$(\'*[data-type="file-picker"]\').on("click",function(){var a=$(this).attr("data-target");fileBrowser.open(a);return!1});';
$html_tags .= '});';
$html_tags .= 'function doModal(a,l,d,m,t){html=\'<div id="dynamicModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="confirm-modal" aria-hidden="true">\',html+=\'<div class="modal-dialog">\',html+=\'<div class="modal-content">\',html+=\'<div class="modal-header">\',html+=\'<a class="close" data-dismiss="modal">&times;</a>\',html+="<h4 class=\"modal-title\">"+a+"</h4>",html+="</div>",html+=\'<div class="modal-body">\',html+=l,html+="</div>",html+=\'<div class="modal-footer">\',""!=d&&(html+=\'<span class="btn btn-flat btn-\'+m+\'" onClick="\'+t+\'">\'+d+"</span>"),html+=\'<span class="btn btn-default btn-flat pull-left" data-dismiss="modal">Cancel</span>\',html+="</div>",html+="</div>",html+="</div>",html+="</div>",$("body").append(html),$("#dynamicModal").modal(),$("#dynamicModal").modal("show"),$("#dynamicModal").on("hidden.bs.modal",function(a){$(this).remove()})}';
$html_tags .= 'setTimeout(function(){$("#notification").fadeOut()},5e3);';
$html_tags .= '</script>';
$html_tags .= '</body>';
$html_tags .= '</html>';
echo $html_tags;
