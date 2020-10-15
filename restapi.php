<?php
/**
 * @author Mahesh Babu <app@godigitally.co.in>
 * @copyright Go Digitally 2020
 * @package go-current-affairs
 * 
 * 
 * Created using IMA Builder v2
 */


/** site **/
$config["app-name"]			= "Go Current Affairs" ; //Write the name of your website
$config["app-desc"]			= "Current Affairs and Job News" ; //Write a brief description of your website
$config["utf8"]				= true; 
$config["debug"]			= false; 
$config["protect"]			= false; 
$config["url"]			= "https://cajobs.herokuapp.com/restapi.php"; 
$config["timezone"]			= "Asia/Kolkata" ; // check this site: http://php.net/manual/en/timezones.php
$config["gzip"]			= false; //compressed page 

/** mysql **/
$config["db_host"]				= "us-cdbr-east-02.cleardb.com" ; //host
$config["db_user"]				= "b5e6463ddd0ec9" ; //Username SQL
$config["db_pwd"]				= "21497123" ; //Password SQL
$config["db_name"]			= "heroku_6c9b400be692e1e" ; //Database


/** DON'T EDIT THE CODE BELLOW **/
session_start();
if($config["gzip"]==true){
	ob_start("ob_gzhandler");
}
ini_set("internal_encoding", "utf-8");
date_default_timezone_set($config["timezone"]);
if($config["debug"]==true){
	error_reporting(E_ALL);
}else{
	error_reporting(0);
}

if($config["protect"]==true){
	if(isset($_SERVER["HTTP_USER_AGENT"])){
		if(!preg_match("/go\-current\-affairs/i",$_SERVER["HTTP_USER_AGENT"])){
			die("Not allowed");
		}
	}else{
		die("Not allowed");
	}
}

if(isset($_SERVER["HTTP_X_AUTHORIZATION"])){
	$_SERVER["HTTP_AUTHORIZATION"] = $_SERVER["HTTP_X_AUTHORIZATION"];
}
/** CONNECT TO MYSQL **/
$mysql = new mysqli($config["db_host"], $config["db_user"], $config["db_pwd"], $config["db_name"]);
if (mysqli_connect_errno()){
	die(mysqli_connect_error());
}

if($config["utf8"]==true){
	$mysql->set_charset("utf8");
}
if(!isset($_GET["api"])){
	$_GET["api"]= "route";
}
$root_url = $config["url"];
$rest_api=array("data"=>array("status"=>404,"title"=>"Not found"),"title"=>"Error","message"=>"Routes not found");
switch($_GET["api"]){
	case "route":
		// TODO: JSON --+-- ROUTES
		$rest_api=array();
		$rest_api["name"] = "Go Current Affairs" ;
		$rest_api["description"] = "Current Affairs and Job News" ;
		$rest_api["generator"] = "IMA-BuildeRz vrev20.10.11" ;

		$rest_api["namespaces"][0] = "jwt-auth/";
		$rest_api["namespaces"][1] = "categories/";
		$rest_api["namespaces"][2] = "chapters/";
		$rest_api["namespaces"][3] = "jobs/";
		$rest_api["routes"]["/jwt-auth/"]["namespace"] = "jwt-auth/";
		$rest_api["routes"]["/jwt-auth/"]["methods"][0] = "POST";
		$rest_api["routes"]["/jwt-auth/"]["endpoints"]["methods"][0] = "POST";
		$rest_api["routes"]["/jwt-auth/"]["endpoints"]["args"] = array();
		$rest_api["routes"]["/jwt-auth/"]["endpoints"]["links"]["self"] = $root_url . "?api=jwt-auth";
		$rest_api["routes"]["/jwt-auth/token"]["namespace"] = "jwt-auth/";
		$rest_api["routes"]["/jwt-auth/token"]["methods"][0] = "POST";
		$rest_api["routes"]["/jwt-auth/token"]["endpoints"]["methods"][0] = "POST";
		$rest_api["routes"]["/jwt-auth/token"]["endpoints"]["args"] = array();
		$rest_api["routes"]["/jwt-auth/token"]["endpoints"]["links"]["self"] = $root_url . "?api=jwt-auth&action=token";
		$rest_api["routes"]["/jwt-auth/token/validate"]["namespace"] = "jwt-auth/";
		$rest_api["routes"]["/jwt-auth/token/validate"]["methods"][0] = "POST";
		$rest_api["routes"]["/jwt-auth/token/validate"]["endpoints"]["methods"][0] = "POST";
		$rest_api["routes"]["/jwt-auth/token/validate"]["endpoints"]["args"] = array();
		$rest_api["routes"]["/jwt-auth/token/validate"]["endpoints"]["links"]["self"] = $root_url . "?api=jwt-auth&action=token-validate";

		$rest_api["routes"]["/categories/"]["namespace"] = "categories/";
		$rest_api["routes"]["/categories/"]["methods"][0] = "GET";
		$rest_api["routes"]["/categories/"]["endpoints"][0]["methods"][0] = "GET";
		$rest_api["routes"]["/categories/"]["endpoints"][0]["args"]["category-name"]["required"] = false;
		$rest_api["routes"]["/categories/"]["endpoints"][0]["args"]["category-name"]["default"] = "";
		$rest_api["routes"]["/categories/"]["endpoints"][0]["args"]["category-name"]["type"] = "string";
		$rest_api["routes"]["/categories/"]["endpoints"][0]["args"]["category-name"]["description"] = "Limit result set to items with more specific by `category_name`.";

		$rest_api["routes"]["/categories/"]["endpoints"][0]["args"]["orderby"]["required"] = false;
		$rest_api["routes"]["/categories/"]["endpoints"][0]["args"]["orderby"]["default"] = "id";
		$rest_api["routes"]["/categories/"]["endpoints"][0]["args"]["orderby"]["type"] = "string";
		$rest_api["routes"]["/categories/"]["endpoints"][0]["args"]["orderby"]["enum"][0] = "id";
		$rest_api["routes"]["/categories/"]["endpoints"][0]["args"]["orderby"]["enum"][1] = "category-name";
		$rest_api["routes"]["/categories/"]["endpoints"][0]["args"]["orderby"]["enum"][2] = "category-image";
		$rest_api["routes"]["/categories/"]["endpoints"][0]["args"]["orderby"]["description"] = "Sort collection by object attribute";
		$rest_api["routes"]["/categories/"]["endpoints"][0]["args"]["sort"]["required"] = false;
		$rest_api["routes"]["/categories/"]["endpoints"][0]["args"]["sort"]["default"] = "asc";
		$rest_api["routes"]["/categories/"]["endpoints"][0]["args"]["sort"]["type"] = "string";
		$rest_api["routes"]["/categories/"]["endpoints"][0]["args"]["sort"]["enum"][0] = "asc";
		$rest_api["routes"]["/categories/"]["endpoints"][0]["args"]["sort"]["enum"][1] = "desc";
		$rest_api["routes"]["/categories/"]["endpoints"][0]["args"]["sort"]["description"] = "Order sort attribute ascending or descending";
		$rest_api["routes"]["/categories/"]["endpoints"][0]["_links"][0] = $root_url . "?api=categories";

		$rest_api["routes"]["/categories/(?P<id>[\d]+)"]["namespace"] = "categories/";
		$rest_api["routes"]["/categories/(?P<id>[\d]+)"]["method"][0] = "GET";
		$rest_api["routes"]["/categories/(?P<id>[\d]+)"]["endpoints"]["args"]["id"]["required"] = "true";
		$rest_api["routes"]["/categories/(?P<id>[\d]+)"]["endpoints"]["args"]["id"]["type"] = "integer";
		$rest_api["routes"]["/categories/(?P<id>[\d]+)"]["endpoints"]["args"]["id"]["description"] = "Unique identifier for the object";
		$rest_api["routes"]["/categories/(?P<id>[\d]+)"]["endpoints"]["_links"][0] = $root_url . "?api=categories&id=<id>";

		$rest_api["routes"]["/chapters/"]["namespace"] = "chapters/";
		$rest_api["routes"]["/chapters/"]["methods"][0] = "GET";
		$rest_api["routes"]["/chapters/"]["endpoints"][0]["methods"][0] = "GET";
		$rest_api["routes"]["/chapters/"]["endpoints"][0]["args"]["chapter-title"]["required"] = false;
		$rest_api["routes"]["/chapters/"]["endpoints"][0]["args"]["chapter-title"]["default"] = "";
		$rest_api["routes"]["/chapters/"]["endpoints"][0]["args"]["chapter-title"]["type"] = "string";
		$rest_api["routes"]["/chapters/"]["endpoints"][0]["args"]["chapter-title"]["description"] = "Limit result set to items with more specific by `chapter_title`.";
		$rest_api["routes"]["/chapters/"]["endpoints"][0]["args"]["chapter-category"]["required"] = false;
		$rest_api["routes"]["/chapters/"]["endpoints"][0]["args"]["chapter-category"]["default"] = "";
		$rest_api["routes"]["/chapters/"]["endpoints"][0]["args"]["chapter-category"]["type"] = "string";
		$rest_api["routes"]["/chapters/"]["endpoints"][0]["args"]["chapter-category"]["description"] = "Limit result set to items with more specific by `chapter_category`.";
		$rest_api["routes"]["/chapters/"]["endpoints"][0]["args"]["chapter-content"]["required"] = false;
		$rest_api["routes"]["/chapters/"]["endpoints"][0]["args"]["chapter-content"]["default"] = "";
		$rest_api["routes"]["/chapters/"]["endpoints"][0]["args"]["chapter-content"]["type"] = "string";
		$rest_api["routes"]["/chapters/"]["endpoints"][0]["args"]["chapter-content"]["description"] = "Limit result set to items with more specific by `chapter_content`.";

		$rest_api["routes"]["/chapters/"]["endpoints"][0]["args"]["orderby"]["required"] = false;
		$rest_api["routes"]["/chapters/"]["endpoints"][0]["args"]["orderby"]["default"] = "id";
		$rest_api["routes"]["/chapters/"]["endpoints"][0]["args"]["orderby"]["type"] = "string";
		$rest_api["routes"]["/chapters/"]["endpoints"][0]["args"]["orderby"]["enum"][0] = "id";
		$rest_api["routes"]["/chapters/"]["endpoints"][0]["args"]["orderby"]["enum"][1] = "chapter-title";
		$rest_api["routes"]["/chapters/"]["endpoints"][0]["args"]["orderby"]["enum"][2] = "chapter-image";
		$rest_api["routes"]["/chapters/"]["endpoints"][0]["args"]["orderby"]["enum"][3] = "chapter-category";
		$rest_api["routes"]["/chapters/"]["endpoints"][0]["args"]["orderby"]["enum"][4] = "chapter-content";
		$rest_api["routes"]["/chapters/"]["endpoints"][0]["args"]["orderby"]["description"] = "Sort collection by object attribute";
		$rest_api["routes"]["/chapters/"]["endpoints"][0]["args"]["sort"]["required"] = false;
		$rest_api["routes"]["/chapters/"]["endpoints"][0]["args"]["sort"]["default"] = "asc";
		$rest_api["routes"]["/chapters/"]["endpoints"][0]["args"]["sort"]["type"] = "string";
		$rest_api["routes"]["/chapters/"]["endpoints"][0]["args"]["sort"]["enum"][0] = "asc";
		$rest_api["routes"]["/chapters/"]["endpoints"][0]["args"]["sort"]["enum"][1] = "desc";
		$rest_api["routes"]["/chapters/"]["endpoints"][0]["args"]["sort"]["description"] = "Order sort attribute ascending or descending";
		$rest_api["routes"]["/chapters/"]["endpoints"][0]["_links"][0] = $root_url . "?api=chapters";

		$rest_api["routes"]["/chapters/(?P<id>[\d]+)"]["namespace"] = "chapters/";
		$rest_api["routes"]["/chapters/(?P<id>[\d]+)"]["method"][0] = "GET";
		$rest_api["routes"]["/chapters/(?P<id>[\d]+)"]["endpoints"]["args"]["id"]["required"] = "true";
		$rest_api["routes"]["/chapters/(?P<id>[\d]+)"]["endpoints"]["args"]["id"]["type"] = "integer";
		$rest_api["routes"]["/chapters/(?P<id>[\d]+)"]["endpoints"]["args"]["id"]["description"] = "Unique identifier for the object";
		$rest_api["routes"]["/chapters/(?P<id>[\d]+)"]["endpoints"]["_links"][0] = $root_url . "?api=chapters&id=<id>";

		$rest_api["routes"]["/jobs/"]["namespace"] = "jobs/";
		$rest_api["routes"]["/jobs/"]["methods"][0] = "GET";
		$rest_api["routes"]["/jobs/"]["endpoints"][0]["methods"][0] = "GET";
		$rest_api["routes"]["/jobs/"]["endpoints"][0]["args"]["job-title"]["required"] = false;
		$rest_api["routes"]["/jobs/"]["endpoints"][0]["args"]["job-title"]["default"] = "";
		$rest_api["routes"]["/jobs/"]["endpoints"][0]["args"]["job-title"]["type"] = "string";
		$rest_api["routes"]["/jobs/"]["endpoints"][0]["args"]["job-title"]["description"] = "Limit result set to items with more specific by `job_title`.";
		$rest_api["routes"]["/jobs/"]["endpoints"][0]["args"]["last-date"]["required"] = false;
		$rest_api["routes"]["/jobs/"]["endpoints"][0]["args"]["last-date"]["default"] = "";
		$rest_api["routes"]["/jobs/"]["endpoints"][0]["args"]["last-date"]["type"] = "string";
		$rest_api["routes"]["/jobs/"]["endpoints"][0]["args"]["last-date"]["description"] = "Limit result set to items with more specific by `last_date`.";
		$rest_api["routes"]["/jobs/"]["endpoints"][0]["args"]["job-content"]["required"] = false;
		$rest_api["routes"]["/jobs/"]["endpoints"][0]["args"]["job-content"]["default"] = "";
		$rest_api["routes"]["/jobs/"]["endpoints"][0]["args"]["job-content"]["type"] = "string";
		$rest_api["routes"]["/jobs/"]["endpoints"][0]["args"]["job-content"]["description"] = "Limit result set to items with more specific by `job_content`.";
		$rest_api["routes"]["/jobs/"]["endpoints"][0]["args"]["notification"]["required"] = false;
		$rest_api["routes"]["/jobs/"]["endpoints"][0]["args"]["notification"]["default"] = "";
		$rest_api["routes"]["/jobs/"]["endpoints"][0]["args"]["notification"]["type"] = "string";
		$rest_api["routes"]["/jobs/"]["endpoints"][0]["args"]["notification"]["description"] = "Limit result set to items with more specific by `notification`.";

		$rest_api["routes"]["/jobs/"]["endpoints"][0]["args"]["orderby"]["required"] = false;
		$rest_api["routes"]["/jobs/"]["endpoints"][0]["args"]["orderby"]["default"] = "id";
		$rest_api["routes"]["/jobs/"]["endpoints"][0]["args"]["orderby"]["type"] = "string";
		$rest_api["routes"]["/jobs/"]["endpoints"][0]["args"]["orderby"]["enum"][0] = "id";
		$rest_api["routes"]["/jobs/"]["endpoints"][0]["args"]["orderby"]["enum"][1] = "job-title";
		$rest_api["routes"]["/jobs/"]["endpoints"][0]["args"]["orderby"]["enum"][2] = "last-date";
		$rest_api["routes"]["/jobs/"]["endpoints"][0]["args"]["orderby"]["enum"][3] = "job-content";
		$rest_api["routes"]["/jobs/"]["endpoints"][0]["args"]["orderby"]["enum"][4] = "notification";
		$rest_api["routes"]["/jobs/"]["endpoints"][0]["args"]["orderby"]["description"] = "Sort collection by object attribute";
		$rest_api["routes"]["/jobs/"]["endpoints"][0]["args"]["sort"]["required"] = false;
		$rest_api["routes"]["/jobs/"]["endpoints"][0]["args"]["sort"]["default"] = "asc";
		$rest_api["routes"]["/jobs/"]["endpoints"][0]["args"]["sort"]["type"] = "string";
		$rest_api["routes"]["/jobs/"]["endpoints"][0]["args"]["sort"]["enum"][0] = "asc";
		$rest_api["routes"]["/jobs/"]["endpoints"][0]["args"]["sort"]["enum"][1] = "desc";
		$rest_api["routes"]["/jobs/"]["endpoints"][0]["args"]["sort"]["description"] = "Order sort attribute ascending or descending";
		$rest_api["routes"]["/jobs/"]["endpoints"][0]["_links"][0] = $root_url . "?api=jobs";

		$rest_api["routes"]["/jobs/(?P<id>[\d]+)"]["namespace"] = "jobs/";
		$rest_api["routes"]["/jobs/(?P<id>[\d]+)"]["method"][0] = "GET";
		$rest_api["routes"]["/jobs/(?P<id>[\d]+)"]["endpoints"]["args"]["id"]["required"] = "true";
		$rest_api["routes"]["/jobs/(?P<id>[\d]+)"]["endpoints"]["args"]["id"]["type"] = "integer";
		$rest_api["routes"]["/jobs/(?P<id>[\d]+)"]["endpoints"]["args"]["id"]["description"] = "Unique identifier for the object";
		$rest_api["routes"]["/jobs/(?P<id>[\d]+)"]["endpoints"]["_links"][0] = $root_url . "?api=jobs&id=<id>";		break;
	
	
	// TODO: JSON --+-- JWT-AUTH
	case "jwt-auth":
		$rest_api = array();
		if(!isset($_GET["action"])){
			$_GET["action"]="default";
		}
	
		switch( filter_var($_GET["action"], FILTER_DEFAULT)){
			case "default":
				$rest_api["routes"]["/jwt-auth/token"]["namespace"] = "jwt-auth/";
				$rest_api["routes"]["/jwt-auth/token"]["methods"][0] = "POST";
				$rest_api["routes"]["/jwt-auth/token"]["endpoints"]["methods"][0] = "POST";
				$rest_api["routes"]["/jwt-auth/token"]["endpoints"]["args"] = array();
				$rest_api["routes"]["/jwt-auth/token"]["endpoints"]["links"]["self"] = $root_url . "?api=jwt-auth&action=token";
				$rest_api["routes"]["/jwt-auth/token/validate"]["namespace"] = "jwt-auth/";
				$rest_api["routes"]["/jwt-auth/token/validate"]["methods"][0] = "POST";
				$rest_api["routes"]["/jwt-auth/token/validate"]["endpoints"]["methods"][0] = "POST";
				$rest_api["routes"]["/jwt-auth/token/validate"]["endpoints"]["args"] = array();
				$rest_api["routes"]["/jwt-auth/token/validate"]["endpoints"]["links"]["self"] = $root_url . "?api=jwt-auth&action=token-validate";
				break;
	
			// TODO: JSON --+-- JWT-AUTH --+-- TOKEN
			case "token":
				if(isset($_POST["username"]) && isset($_POST["password"])){
					$user_email = filter_var($_POST["username"],FILTER_VALIDATE_EMAIL);
					$user_password = sha1("imabuilder" . $_POST["password"] );
					$sql_query = "SELECT * FROM `users` WHERE `user_email` = '{$user_email}' AND `user_password` = '{$user_password}'";
					$result = $mysql->query($sql_query);
					$current_user = $result->fetch_array();
					if(isset($current_user["user_email"])){
						switch($current_user["user_status"]){
							case "pending":
								$rest_api["message"] = "<strong>ERROR</strong>: This account is currently being suspended/pending";
								$rest_api["name"] = "HttpErrorResponse";
								$rest_api["status"] = 403;
								$rest_api["statusText"] = "Forbidden";
								$rest_api["data"]["status"] = 403;
								break;
							case "banned":
								$rest_api["message"] = "<strong>ERROR</strong>: This account has been banned";
								$rest_api["name"] = "HttpErrorResponse";
								$rest_api["status"] = 403;
								$rest_api["statusText"] = "Forbidden";
								$rest_api["data"]["status"] = 403;
								break;
							case "active":
								$user_token = sha1(session_id().$_SERVER["HTTP_USER_AGENT"].$_SERVER["REMOTE_ADDR"]);
								$sql_query = "UPDATE `users` SET `user_token` = '{$user_token}' WHERE `user_email` = '{$user_email}'";
								$stmt = $mysql->prepare($sql_query);
								$stmt->execute();
								$stmt->close();
								header("HTTP/1.1 200 OK");
								$rest_api["token"] = $user_token;
								$rest_api["user_id"] = $current_user["user_id"];
								$rest_api["user_name"] = $current_user["user_name"];
								$rest_api["user_birthday"] = $current_user["user_birthday"];
								$rest_api["user_email"] = $current_user["user_email"];
								$rest_api["user_first_name"] = $current_user["user_first_name"];
								$rest_api["user_last_name"] = $current_user["user_last_name"];
								$rest_api["user_company"] = $current_user["user_company"];
								$rest_api["user_level"] = $current_user["user_level"];
								$rest_api["user_website"] = $current_user["user_website"];
								$rest_api["user_address_1"] = $current_user["user_address_1"];
								$rest_api["user_address_2"] = $current_user["user_address_2"];
								$rest_api["user_city"] = $current_user["user_city"];
								$rest_api["user_state"] = $current_user["user_state"];
								$rest_api["user_postcode"] = $current_user["user_postcode"];
								$rest_api["user_country"] = $current_user["user_country"];
								$rest_api["user_phone"] = $current_user["user_phone"];
								$rest_api["user_note"] = $current_user["user_note"];
								$rest_api["user_expired"] = $current_user["user_expired"];
								$rest_api["data"]["status"] = 200;
							break;
						}
					}else{
						$rest_api["message"] = "<strong>ERROR</strong>: Username or password is incorrect!";
						$rest_api["name"] = "HttpErrorResponse";
						$rest_api["status"] = 403;
						$rest_api["statusText"] = "Forbidden";
						$rest_api["data"]["status"] = 403;
					}
				}else{
					$rest_api["message"] = "400 Bad Request";
					$rest_api["name"] = "HttpErrorResponse";
					$rest_api["status"] = 404;
					$rest_api["statusText"] = "Bad Request";
					$rest_api["data"]["status"] = 400;
				}
				break;
	
			// TODO: JSON --+-- JWT-AUTH --+-- TOKEN-VALIDATE
			case "token-validate":
				if(isset($_SERVER["HTTP_AUTHORIZATION"])){
					$user_token = trim(substr($_SERVER["HTTP_AUTHORIZATION"],6)) ;
					if(strlen($user_token) > 6 ){
						$sql_query = "SELECT * FROM `users` WHERE `user_token` = '{$user_token}' AND `user_status` = 'active'";
						$result = $mysql->query($sql_query);
						$current_user = $result->fetch_array();
						if(isset($current_user["user_email"])){
							header("HTTP/1.1 200 OK");
							$rest_api["data"]["status"] = 200;
							$rest_api["token"] = $user_token;
							$rest_api["user_email"] = $current_user["user_email"];
							$rest_api["user_first_name"] = $current_user["user_first_name"];
							$rest_api["user_website"] = $current_user["user_website"];
							$rest_api["user_address"] = $current_user["user_address"];
							$rest_api["user_phone"] = $current_user["user_phone"];
							$rest_api["user_note"] = $current_user["user_note"];
							$rest_api["user_expired"] = $current_user["user_expired"];
						}else{
							//header("HTTP/1.1 401 Unauthorized");
							$rest_api["message"] = "<strong>ERROR</strong>: Data Token invalid!";
							$rest_api["name"] = "HttpErrorResponse";
							$rest_api["status"] = 401;
							$rest_api["statusText"] = "Forbidden";
							$rest_api["data"]["status"] = 401;
						}
					}else{
						//header("HTTP/1.1 401 Unauthorized");
						$rest_api["message"] = "<strong>ERROR</strong>: Data Token not found!";
						$rest_api["name"] = "HttpErrorResponse";
						$rest_api["status"] = 401;
						$rest_api["statusText"] = "Forbidden";
						$rest_api["data"]["status"] = 401;
					}
				}else{
					//header("HTTP/1.1 401 Unauthorized");
					$rest_api["message"] = "<strong>ERROR</strong>: Data Token not found!";
					$rest_api["name"] = "HttpErrorResponse";
					$rest_api["status"] = 401;
					$rest_api["statusText"] = "Forbidden";
					$rest_api["data"]["status"] = 401;
				}
				break;
				
			// TODO: JSON --+-- JWT-AUTH --+-- REGISTER
			case "register":
				$_POST = json_decode(file_get_contents("php://input"),true);
				if(isset($_POST["username"])){
					$postdata["user_name"] = null;
					$postdata["user_email"] = null;
					$postdata["user_password"] = null;
					$postdata["user_birthday"] = "1990-01-01";
					$postdata["user_website"] = null;
					$postdata["user_first_name"] = null;
					$postdata["user_last_name"] = null;
					$postdata["user_company"] = null;
					$postdata["user_address_1"] = null;
					$postdata["user_address_2"] = null;
					$postdata["user_city"] = "";
					$postdata["user_state"] = "";
					$postdata["user_postcode"] = "";
					$postdata["user_country"] = "";
					$postdata["user_level"] = "user";
					$postdata["user_token"] = null;
					$postdata["user_phone"] = null;
					$postdata["user_note"] = null;
					$postdata["user_expired"] = "0000-00-00 00:00:00";
					$postdata["user_status"] = null;
					
					if(isset($_POST["username"])){
						$postdata["user_name"] = $mysql->real_escape_string($_POST["username"]) ;
					}
					if(isset($_POST["email"])){
						$postdata["user_email"] = $mysql->real_escape_string($_POST["email"]) ;
					}
					if(isset($_POST["password"])){
						$postdata["user_password"] = $mysql->real_escape_string($_POST["password"]) ;
					}
					if(isset($_POST["birthday"])){
						$postdata["user_birthday"] = $mysql->real_escape_string($_POST["birthday"]) ;
					}
					if(isset($_POST["url"])){
						$postdata["user_website"] = $mysql->real_escape_string($_POST["url"]) ;
					}
					if(isset($_POST["first_name"])){
						$postdata["user_first_name"] = $mysql->real_escape_string($_POST["first_name"]) ;
					}
					if(isset($_POST["last_name"])){
						$postdata["user_last_name"] = $mysql->real_escape_string($_POST["last_name"]) ;
					}
					if(isset($_POST["last_name"])){
						$postdata["user_company"] = $mysql->real_escape_string($_POST["last_name"]) ;
					}
					if(isset($_POST["address_1"])){
						$postdata["user_address_1"] = $mysql->real_escape_string($_POST["address_1"]) ;
					}
					if(isset($_POST["address_2"])){
						$postdata["user_address_2"] = $mysql->real_escape_string($_POST["address_2"]) ;
					}
					if(isset($_POST["city"])){
						$postdata["user_city"] = $mysql->real_escape_string($_POST["city"]) ;
					}
					if(isset($_POST["state"])){
						$postdata["user_state"] = $mysql->real_escape_string($_POST["state"]) ;
					}
					if(isset($_POST["postcode"])){
						$postdata["user_postcode"] = $mysql->real_escape_string($_POST["postcode"]) ;
					}
					if(isset($_POST["country"])){
						$postdata["user_country"] = $mysql->real_escape_string($_POST["country"]) ;
					}
					if(isset($_POST["phone"])){
						$postdata["user_phone"] = $mysql->real_escape_string($_POST["phone"]) ;
					}
					if(($postdata["user_name"] != "") && ($postdata["user_email"] != "") && ($postdata["user_password"] != "")){
						$sql_query = "SELECT * FROM `users` WHERE `user_email` LIKE '{$postdata["user_email"]}'";
						$result = $mysql->query($sql_query);
						$current_user = $result->fetch_array();
						if(isset($current_user["user_email"])){
							header("HTTP/1.1 400 Bad Request");
							$rest_api["message"] = "Email `{$postdata["user_email"]}` has been exist, please login!";
							$rest_api["title"] = "Ops, error!";
							$rest_api["code"] = 406;
							$rest_api["data"]["status"] = 400;
						}else{
							$sql_query = "SELECT * FROM `users` WHERE `user_name` LIKE '{$postdata["user_name"]}'";
							$result = $mysql->query($sql_query);
							$current_user = $result->fetch_array();
							if(isset($current_user["user_name"])){
								header("HTTP/1.1 400 Bad Request");
								$rest_api["message"] = "Username: `{$postdata["user_name"]}` has been exist, please login!";
								$rest_api["title"] = "Ops, error!";
								$rest_api["code"] = 406;
								$rest_api["data"]["status"] = 400;
							}else{
								$sql_query = "INSERT INTO `users` (`user_name`,`user_email`,`user_password`,`user_birthday`,`user_website`,`user_first_name`,`user_last_name`,`user_company`,`user_address_1`,`user_address_2`,`user_city`,`user_state`,`user_postcode`,`user_country`,`user_phone`) VALUES ('{\$postdata[\'user_name\']}','{\$postdata[\'user_email\']}','{\$postdata[\'user_password\']}','{\$postdata[\'user_birthday\']}','{\$postdata[\'user_website\']}','{\$postdata[\'user_first_name\']}','{\$postdata[\'user_last_name\']}','{\$postdata[\'user_company\']}','{\$postdata[\'user_address_1\']}','{\$postdata[\'user_address_2\']}','{\$postdata[\'user_city\']}','{\$postdata[\'user_state\']}','{\$postdata[\'user_postcode\']}','{\$postdata[\'user_country\']}','{\$postdata[\'user_phone\']}')" ;
								$stmt = $mysql->prepare($sql_query);
								$stmt->execute();
								$stmt->close();
								header("HTTP/1.1 200 OK");
								$rest_api["message"] = "User '{$postdata["user_name"]}' Registration was Successful";
								$rest_api["title"] = "Successfully!";
								$rest_api["code"] = 200;
								$rest_api["data"]["status"] = 200;
							}
						}
					}else{
						header("HTTP/1.1 400 Bad Request");
						$rest_api["message"] = "Username, Email and Password field are required!";
						$rest_api["title"] = "Ops, error!";
						$rest_api["code"] = 406;
						$rest_api["data"]["status"] = 400;
					}
				}else{
					header("HTTP/1.1 400 Bad Request");
					$rest_api["message"] = "<strong>ERROR</strong>: Invalid method!";
					$rest_api["name"] = "HttpErrorResponse";
					$rest_api["status"] = 400;
					$rest_api["statusText"] = "Bad Request";
					$rest_api["code"] = 406;
					$rest_api["data"]["status"] = 400;
				}
				break;
		}
		break;
	case "categories":
		$rest_api = array();
		// TODO: JSON --+-- CATEGORIES
		/** statement `where` **/

		if(isset($_GET["id"])){
			if($_GET["id"] != "-1"){
				if($_GET["id"]=="random"){
					$_GET["orderby"] = "random";
				}else{
					$id = (int)$_GET["id"] ; 
					$statement[] = "`id` =$id"; 
				}
			}
		}

		if(isset($_GET["category-name"])){
			if($_GET["category-name"] != "-1"){
				$value = $mysql->escape_string($_GET["category-name"]); 
				$statement[] = "`category_name` LIKE '%$value%'"; 
			}
		}

		if(isset($_GET["category-image"])){
			if($_GET["category-image"] != "-1"){
				$value = $mysql->escape_string($_GET["category-image"]); 
				$statement[] = "`category_image` LIKE '%$value%'"; 
			}
		}

		$where ="" ;
		if(isset($statement)){
			$where ="WHERE " . implode(" AND ",$statement);
		}
		/** order by **/
		$order_by = "`id`";
		if(isset($_GET["orderby"])){
			switch($_GET["orderby"]){
			case "id":
				$order_by = "`id`";
				break;
			case "category-name":
				$order_by = "`category_name`";
				break;
			case "category-image":
				$order_by = "`category_image`";
				break;
			case "random":
				$order_by = "RAND()";
				break;
			}
		}

		/** sort **/
		$sort = "ASC";
		if(isset($_GET["sort"])){
			if($_GET["sort"]=="asc"){
				$sort = "ASC";
			}else{
				$sort = "DESC";
			}
		}

		$sql_query = "SELECT * FROM `categories` ".$where." ORDER BY ".$order_by." ".$sort.";"; 
		$z=0;
		if($result = $mysql->query($sql_query)){
			while ($data = $result->fetch_array()){
				if(isset($data["id"])){
					$data_rest_api[$z] = $data;
					$rest_api[$z]["id"] = (int) $data["id"];
				}
				if(isset($data["category_name"])){
					$data_rest_api[$z] = $data;
					$rest_api[$z]["category_name"] = $data["category_name"];
				}
				if(isset($data["category_image"])){
					$data_rest_api[$z] = $data;
					$rest_api[$z]["category_image"] = $data["category_image"];
				}
				$rest_api[$z]["_links"]["self"][0] = $root_url . "?api=categories&id=". $data["id"];
				$z++;
			}
			$result->close();
		}
		if(isset($_GET["id"])){
			if(isset($data_rest_api[0])){
				$rest_api = array();
				$rest_api["id"] = $data_rest_api[0]["id"];
				$rest_api["category_name"] = $data_rest_api[0]["category_name"];
				$rest_api["category_image"] = $data_rest_api[0]["category_image"];
			}else{
				$rest_api=array("data"=>array("status"=>404,"title"=>"Not found"),"title"=>"Error","message"=>"Invalid ID");
			}
		}
		break;
	case "chapters":
		$rest_api = array();
		// TODO: JSON --+-- CHAPTERS
		/** statement `where` **/

		if(isset($_GET["id"])){
			if($_GET["id"] != "-1"){
				if($_GET["id"]=="random"){
					$_GET["orderby"] = "random";
				}else{
					$id = (int)$_GET["id"] ; 
					$statement[] = "`id` =$id"; 
				}
			}
		}

		if(isset($_GET["chapter-title"])){
			if($_GET["chapter-title"] != "-1"){
				$value = $mysql->escape_string($_GET["chapter-title"]); 
				$statement[] = "`chapter_title` LIKE '%$value%'"; 
			}
		}

		if(isset($_GET["chapter-image"])){
			if($_GET["chapter-image"] != "-1"){
				$value = $mysql->escape_string($_GET["chapter-image"]); 
				$statement[] = "`chapter_image` LIKE '%$value%'"; 
			}
		}

		if(isset($_GET["chapter-category"])){
			if($_GET["chapter-category"] != "-1"){
				$value = $mysql->escape_string($_GET["chapter-category"]); 
				$statement[] = "`chapter_category` LIKE '$value'"; 
			}
		}

		if(isset($_GET["chapter-content"])){
			if($_GET["chapter-content"] != "-1"){
				$value = $mysql->escape_string($_GET["chapter-content"]); 
				$statement[] = "`chapter_content` LIKE '%$value%'"; 
			}
		}

		$where ="" ;
		if(isset($statement)){
			$where ="WHERE " . implode(" AND ",$statement);
		}
		/** order by **/
		$order_by = "`id`";
		if(isset($_GET["orderby"])){
			switch($_GET["orderby"]){
			case "id":
				$order_by = "`id`";
				break;
			case "chapter-title":
				$order_by = "`chapter_title`";
				break;
			case "chapter-image":
				$order_by = "`chapter_image`";
				break;
			case "chapter-category":
				$order_by = "`chapter_category`";
				break;
			case "chapter-content":
				$order_by = "`chapter_content`";
				break;
			case "random":
				$order_by = "RAND()";
				break;
			}
		}

		/** sort **/
		$sort = "ASC";
		if(isset($_GET["sort"])){
			if($_GET["sort"]=="asc"){
				$sort = "ASC";
			}else{
				$sort = "DESC";
			}
		}

		$sql_query = "SELECT * FROM `chapters` ".$where." ORDER BY ".$order_by." ".$sort.";"; 
		$z=0;
		if($result = $mysql->query($sql_query)){
			while ($data = $result->fetch_array()){
				if(isset($data["id"])){
					$data_rest_api[$z] = $data;
					$rest_api[$z]["id"] = (int) $data["id"];
				}
				if(isset($data["chapter_title"])){
					$data_rest_api[$z] = $data;
					$rest_api[$z]["chapter_title"] = $data["chapter_title"];
				}
				if(isset($data["chapter_image"])){
					$data_rest_api[$z] = $data;
					$rest_api[$z]["chapter_image"] = $data["chapter_image"];
				}
				if(isset($data["chapter_category"])){
					$data_rest_api[$z] = $data;
					$rest_api[$z]["chapter_category"]["id"] = $data["chapter_category"];
					$categories_id = htmlentities(stripslashes($data["chapter_category"]));
					$sql_categories_query = "SELECT * FROM `categories` WHERE `id`='{$categories_id}'" ;
					$categories_result = $mysql->query($sql_categories_query);
					if($categories_result){
						$categories_result_data = $categories_result->fetch_array();
						if(isset($categories_result_data["category_name"])){
							$rest_api[$z]["chapter_category"]["rendered"] = stripslashes($categories_result_data["category_name"]);
						}else{
							$rest_api[$z]["chapter_category"]["rendered"] = "";
						}
					}else{
						$rest_api[$z]["chapter_category"]["rendered"] = "";
					}
				}
				if(isset($data["chapter_content"])){
					$data_rest_api[$z] = $data;
					$rest_api[$z]["chapter_content"] = $data["chapter_content"];
				}
				$rest_api[$z]["_links"]["self"][0] = $root_url . "?api=chapters&id=". $data["id"];
				$z++;
			}
			$result->close();
		}
		if(isset($_GET["id"])){
			if(isset($data_rest_api[0])){
				$rest_api = array();
				$rest_api["id"] = $data_rest_api[0]["id"];
				$rest_api["chapter_title"] = $data_rest_api[0]["chapter_title"];
				$rest_api["chapter_image"] = $data_rest_api[0]["chapter_image"];
				$rest_api["chapter_category"]["rendered"] = "Invalid ID";
				$rest_api["chapter_category"]["id"] = $data_rest_api[0]["chapter_category"];
				$categories_id = htmlentities(stripslashes($data_rest_api[0]["chapter_category"]));
				$sql_categories_query = "SELECT * FROM `categories` WHERE `id`='{$categories_id}'" ;
				$categories_result = $mysql->query($sql_categories_query);
				if($categories_result){
					$categories_result_data = $categories_result->fetch_array();
					if(isset($categories_result_data["category_name"])){
						$rest_api["chapter_category"]["rendered"] = stripslashes($categories_result_data["category_name"]);
					}else{
						$rest_api["chapter_category"]["rendered"] = "Invalid ID";
					}
				}else{
					$rest_api["chapter_category"]["rendered"] = "Invalid ID";
				}
				$rest_api["chapter_content"] = $data_rest_api[0]["chapter_content"];
			}else{
				$rest_api=array("data"=>array("status"=>404,"title"=>"Not found"),"title"=>"Error","message"=>"Invalid ID");
			}
		}
		break;
	case "jobs":
		$rest_api = array();
		// TODO: JSON --+-- JOBS
		/** statement `where` **/

		if(isset($_GET["id"])){
			if($_GET["id"] != "-1"){
				if($_GET["id"]=="random"){
					$_GET["orderby"] = "random";
				}else{
					$id = (int)$_GET["id"] ; 
					$statement[] = "`id` =$id"; 
				}
			}
		}

		if(isset($_GET["job-title"])){
			if($_GET["job-title"] != "-1"){
				$value = $mysql->escape_string($_GET["job-title"]); 
				$statement[] = "`job_title` LIKE '%$value%'"; 
			}
		}

		if(isset($_GET["last-date"])){
			if($_GET["last-date"] != "-1"){
				$value = $mysql->escape_string($_GET["last-date"]); 
				$statement[] = "`last_date` LIKE '%$value%'"; 
			}
		}

		if(isset($_GET["job-content"])){
			if($_GET["job-content"] != "-1"){
				$value = $mysql->escape_string($_GET["job-content"]); 
				$statement[] = "`job_content` LIKE '%$value%'"; 
			}
		}

		if(isset($_GET["notification"])){
			if($_GET["notification"] != "-1"){
				$value = $mysql->escape_string($_GET["notification"]); 
				$statement[] = "`notification` LIKE '%$value%'"; 
			}
		}

		$where ="" ;
		if(isset($statement)){
			$where ="WHERE " . implode(" AND ",$statement);
		}
		/** order by **/
		$order_by = "`id`";
		if(isset($_GET["orderby"])){
			switch($_GET["orderby"]){
			case "id":
				$order_by = "`id`";
				break;
			case "job-title":
				$order_by = "`job_title`";
				break;
			case "last-date":
				$order_by = "`last_date`";
				break;
			case "job-content":
				$order_by = "`job_content`";
				break;
			case "notification":
				$order_by = "`notification`";
				break;
			case "random":
				$order_by = "RAND()";
				break;
			}
		}

		/** sort **/
		$sort = "ASC";
		if(isset($_GET["sort"])){
			if($_GET["sort"]=="asc"){
				$sort = "ASC";
			}else{
				$sort = "DESC";
			}
		}

		$sql_query = "SELECT * FROM `jobs` ".$where." ORDER BY ".$order_by." ".$sort.";"; 
		$z=0;
		if($result = $mysql->query($sql_query)){
			while ($data = $result->fetch_array()){
				if(isset($data["id"])){
					$data_rest_api[$z] = $data;
					$rest_api[$z]["id"] = (int) $data["id"];
				}
				if(isset($data["job_title"])){
					$data_rest_api[$z] = $data;
					$rest_api[$z]["job_title"] = $data["job_title"];
				}
				if(isset($data["last_date"])){
					$data_rest_api[$z] = $data;
					$rest_api[$z]["last_date"] = $data["last_date"];
				}
				if(isset($data["job_content"])){
					$data_rest_api[$z] = $data;
					$rest_api[$z]["job_content"] = $data["job_content"];
				}
				if(isset($data["notification"])){
					$data_rest_api[$z] = $data;
					$rest_api[$z]["notification"] = $data["notification"];
				}
				$rest_api[$z]["_links"]["self"][0] = $root_url . "?api=jobs&id=". $data["id"];
				$z++;
			}
			$result->close();
		}
		if(isset($_GET["id"])){
			if(isset($data_rest_api[0])){
				$rest_api = array();
				$rest_api["id"] = $data_rest_api[0]["id"];
				$rest_api["job_title"] = $data_rest_api[0]["job_title"];
				$rest_api["last_date"] = $data_rest_api[0]["last_date"];
				$rest_api["job_content"] = $data_rest_api[0]["job_content"];
				$rest_api["notification"] = $data_rest_api[0]["notification"];
			}else{
				$rest_api=array("data"=>array("status"=>404,"title"=>"Not found"),"title"=>"Error","message"=>"Invalid ID");
			}
		}
		break;
}

$mysql->close();

// TODO: JSON --+-- CROSSDOMAIN
header('Content-Type: application/json; charset=UTF-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Methods: GET, POST, PUT, OPTIONS');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization, X-Authorization');
header('Access-Control-Max-Age: 86400');
header('Connection: close');

if (!isset($_GET["callback"])){
	// TODO: OUTPUT --+-- JSON
	if(defined("JSON_UNESCAPED_UNICODE")){
		echo json_encode($rest_api,JSON_UNESCAPED_UNICODE);
	}else{
		echo json_encode($rest_api);
	}
}else{
	// TODO: OUTPUT --+-- JSONP
	if(defined("JSON_UNESCAPED_UNICODE")){
		echo strip_tags($_GET["callback"]) ."(". json_encode($rest_api,JSON_UNESCAPED_UNICODE). ");" ;
	}else{
		echo strip_tags($_GET["callback"]) ."(". json_encode($rest_api) . ");" ;
	}
}

