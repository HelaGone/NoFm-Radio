<?php 
 $url = 'http://s2.voscast.com:8162/7.html';
 $curl = curl_init();
 curl_setopt_array($curl, array(
  CURLOPT_RETURNTRANSFER => 1,
  CURLOPT_URL => $url
 ));
 $result = curl_exec($curl);
 curl_close($curl);

 $thearr = explode(',', $result);

 print_r($thearr[6]);
 ?>