<?php 

require_once('./csv-import.php');
require_once 'classes/Modules/Adulation/config.php';
require_once 'classes/Modules/Crawler/config.php';




require_once './init.php';


/*


*/
function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}





?>
<!DOCTYPE html>


    <html>

    <head>
        <title>Adulation </title>
        <!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->
	    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

		<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
		<link rel="stylesheet" href="./style.css" >
    </head>
  