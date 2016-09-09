<?php
//header('Content-type: text/json; charset=utf-8');
$sid = $_GET['sid'];

$url = "http://songtaste.com/song/".$sid;

$contents = file_get_contents($url);

$strURL = getStrURL($contents);

//print_r($strURL);

getSongUrl($strURL,$sid);

function getStrURL($data)
{
    $detailContents = $data;
	
	//正则匹配strURL
    $patternStrURL= '/flashplay\("(.*?)"/';
    $flagStrURL = preg_match($patternStrURL, $detailContents, $matchesStrURL); 
    $strURL = $matchesStrURL[1];
	
	return $strURL;
}

function postData($strURL,$sid)
{
	$post_data = array();
	$post_data['str'] = $strURL;
	$post_data['sid'] = $sid;
	$post_data['t'] = '0';
	$o="";  
	foreach ($post_data as $k=>$v)  
	{  
		$o.= "$k=".urlencode($v)."&";  
	}	  
	$post_data=substr($o,0,-1); 
	//print_r($post_data);

	//$ch = curl_init();
	//curl_setopt($ch, CURLOPT_URL, 'http://songtaste.com/time.php'); 
	//curl_setopt($ch, CURLOPT_TIMEOUT, 1); 
	//curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	//curl_setopt($ch, CURLOPT_HEADER, 0);  
	//curl_setopt($ch, CURLOPT_POST, 1);
	//curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
	
	//$output = curl_exec($ch);
	//curl_close($ch);
	
	//print_r($output);
	//echo $output;
	$tUrl = "http://songtaste.com/time.php?".$post_data;
        print_r(file_get_contents($tUrl));
}

function getSongUrl($strURL,$sid)
{
	return postData($strURL,$sid);
}


?>
