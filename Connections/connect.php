<?PHP
//This file will act as the connection interface for the MySQL database.

$dsn = "mysql:host=localhost;dbname=SharePoint";
$username = "SharePointReader";
$password = "zwmgYiwRDhQRico6";

try{
	$db = new PDO($dsn, $username, $password);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOExcepton $e){
	echo 'Connection failed: ' . $e->getMessage();
}
?>