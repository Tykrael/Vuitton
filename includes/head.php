<!DOCTYPE html>
<!--[if IE 7]>    <html class="no-js ie7" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8" lang="en"> <![endif]-->
<!--[if IE 9]>    <html class="no-js ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">
 	<meta property="og:title" content="Louis Vuitton - Odyssee" />
	<meta property="og:description" content="Louis Vuitton - Odyssee de l'espace" />

	<title> -- LOUIS VUITTON -- </title>

	<!--[if lt IE 9]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	 
	<script src="js/libs/modernizr-2.6.2.min.js"></script>
	
	<link rel="stylesheet" href="styles/reset.css" />
	<link rel="stylesheet" href="styles/layout.css" />

</head>

<?php 
function checkExternalFile($url){
    
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_NOBODY, true);
    curl_exec($ch);
    $retCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    return $retCode;
}

if(isset($_GET['id'])) {
	$fileExists = checkExternalFile("http://nag-lvpp-01.ig-1.net/flux_minisite/clients/".$_GET['id'].".json");
	
	if($fileExists == 200) {
		$id = $_GET['id'];
		$lang = "_fr_FR";
		// en_GB;
	} else {
		$id="";
		unset($_GET['id']);
		$lang="_fr_FR";
	}
} else {
	$id = "";  
}

if(isset($_GET['lang'])) {
	$lang = $_GET['lang'];
} elseif (!isset($lang)) {
	$lang = "_fr_FR";
}

?> 

