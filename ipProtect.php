<?php
	/*
         * Coded by Evrim Altay KOLUAÇIK
	 * All rights are reserved
	 */

   $ip_adresleri = [
     '127.0.0.1',
     '5.26.217.134',
   ];


   function getIPprotect() {
   	if (! empty ( $_SERVER ['HTTP_CLIENT_IP'] )) {
   		$ip = $_SERVER ['HTTP_CLIENT_IP'];
   	} elseif (! empty ( $_SERVER ['HTTP_X_FORWARDED_FOR'] )) {
   		$ip = $_SERVER ['HTTP_X_FORWARDED_FOR'];
   	} else {
   		$ip = $_SERVER ['REMOTE_ADDR'];
   	}
   	return $ip;
   }


   if(in_array(getIPprotect(),$ip_adresleri) == false){
     sleep(3);
     ipProtectLog();
     $adres = "https://destek.rimtay.com/kb/faq.php?id=6";
     echo '<h1>403 Erişim Engellendi</h1>';
     echo '<p>Bu sayfaya girişler IP bazında kısıtlanmıştır. Detaylı bilgi için bağlantıya göz atın.</p>';
     echo '<p><a href="'.$adres.'">'.$adres.'</a></p>';
     exit;
   }

   function ipProtectLog(){
    $webpage = $_SERVER['SCRIPT_NAME'];
    $browser = $_SERVER['HTTP_USER_AGENT'];
   	$str = '['.date("Y-m-d H:i").'] [webpage '.$webpage.'] [browser '.$browser.'] [client '.getIPprotect().']'."\n";
   	file_put_contents('ipProtect.log', $str, FILE_APPEND);
   }
?>
