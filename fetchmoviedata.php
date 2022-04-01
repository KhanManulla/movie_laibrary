<?php
function getImdbRecord($mname){
	$ApiKey='0000000';//replace your api key '0000000 here
    $path = "http://www.omdbapi.com/?t=$mname&apikey=$ApiKey";
    $json = file_get_contents($path);
    return json_decode($json, TRUE);
}

function getImdbRecordId($ImdbId){
	$ApiKey='0000000';//replace your api key '0000000' here
    $path = "http://www.omdbapi.com/?i=$ImdbId&apikey=$ApiKey";
    $json = file_get_contents($path);
    return json_decode($json, TRUE);
}

function getImdbRecordIdpubshare($ImdbId){
    $ApiKey='0000000';//replace your api key '0000000' here
    $path = "http://www.omdbapi.com/?i=$ImdbId&apikey=$ApiKey";
    $json = file_get_contents($path);
    return json_decode($json, TRUE);
}
?>