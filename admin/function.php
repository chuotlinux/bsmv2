<?php

require_once('config.php');
error_reporting(E_ALL);

$dsn = 'mysql:dbname=mgmuser;host=localhost';

function connectdb()
{
	global $conms;
    $conms = @mysql_connect(dbhost,dbuser,dbpass);
    if(!$conms) return false;
	$condb = @mysql_select_db(dbname);
    if(!$condb) return false;
    return true;
}

function connectdbbus()
{
	global $conmsbus;
    $conmsbus = @mysql_connect(dbhost,dbuser,dbpass);
    if(!$conmsbus) return false;
	$condbbus = @mysql_select_db(dbbus);
    if(!$condbbus) return false;
    return true;
}

function connectdbuser()
{
	global $conmsuser;
    $conmsuser = @mysql_connect(dbhost,dbuser,dbpass); //connect mysql
    if(!$conmsuser) return false;
	$condbuser = @mysql_select_db(dbusername);
    if(!$condbuser) return false;
    return true;
}

function dbconnect()
{
	global $pdo, $dsn;
	try {
		$pdo = new PDO($dsn, dbuser, dbpass);
	} catch (PDOException $e) {
		die('Lỗi kết nối với cơ sở dữ liệu: ' . $e->getMessage());
	}
}

function insert_new_user($username, $password)
{
	# checking username is already taken
	if (username_exists($username))
		return false;

	# insert new user info
	global $pdo;
	$stmt = $pdo->prepare('
		INSERT INTO users
		(username, password)
		values (:username, :password)');

	$stmt->execute( array(':username' => $username, ':password' => md5($password)) );

	if ($pdo->lastInsertId())
		return true;
	else
		return false;
}

function username_exists($username)
{
	global $pdo;
	
	$stmt = $pdo->prepare('
		SELECT id
		FROM users
		WHERE username = :username
		LIMIT 1');

	$stmt->execute( array('username' => $username) );
	return $stmt->fetchColumn();
}

function attempt($username, $password)
{
	global $pdo;
	
	$sql = 'SELECT m.id, m.username, m.isactive, c.token FROM mst_user as m INNER JOIN mst_credential as c ON m.username= :username AND m.id = c.userid AND c.token= :password';
	
	$stmt = $pdo->prepare($sql);
	$stmt->execute(array(':username' => $username, 'password' => md5($password)));

	if ($data = $stmt->fetch( PDO::FETCH_OBJ )) {
		# set session
		$_SESSION['username'] = $data->username;
		return true;
	} else {
		return false;
	}
}

function is_user()
{
	if (isset($_SESSION['username']))
		return true;
}

function redirect($url)
{
	header('Location: ' .$url);
	exit;
}

function valid_username($str){
	return preg_match('/^[a-z0-9_-]{3,16}$/', $str);
}

function valid_password($str){
	return preg_match('/^[a-z0-9_-]{6,18}$/', $str);
}

?>