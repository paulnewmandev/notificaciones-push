<?php
/*
 * Simple Script Firebase Cloud Messaging
 *
 * (c) Paul Newman <paul.newman.dev@gmail.com>
 *
 * @param string $strKey     -> Token FCM
 * @param string $strTopic   -> Topico Del Mensaje "/topico"
 * @param string $strTitle   -> Titulo Del Mensaje
 * @param string $strContent -> Contenido Del Mensaje
 *
 * @return object $strResult -> 
 *
 */
$strKey = 'AAAAtgV6BJA:APA91.....';

$strTopic    = $_GET['topico'];
$strTitle    = $_GET['titulo'];
$strContent  = $_GET['contenido'];

$strMessage = array(
					'body'     => $strContent, 
					'title'    => $strTitle,
					'priority' => 'high',
					'sound'    => 'default'
					);		

$strFields = array(
					'to' 		   => $strTopic,
					'notification' => $strMessage
					);

$strHeaders = array(
					'Content-Type:application/json',
					'Authorization:key='.$strKey
					);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
curl_setopt($ch, CURLOPT_POST, true );
curl_setopt($ch, CURLOPT_HTTPHEADER, $strHeaders);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($strFields));
$srtCurl = curl_exec($ch);
 
if($srtCurl === FALSE){
	 
		$strResult["response"]["status"] = "error";
		$strResult["response"]["message"] = curl_error($ch);
		
		echo json_encode($strResult,JSON_UNESCAPED_UNICODE);
 
 }else{
	 
		$strResult["push"]  = $strFields;
		$strResult["response"]["status"]  = "success";
		$strResult["response"]["message"] = "Push Enviado";
		
		echo json_encode($strResult,JSON_UNESCAPED_UNICODE);	 
	
 }
 curl_close($ch);
?>