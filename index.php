<?php 

require_once('./unirest-php-master/src/Unirest.php');
function shalat($keyword) {
    $uri = "https://api.banghasan.com/sholat/format/json/kota/nama/" . $keyword;
	Unirest\Request::verifyPeer(false);
	$response = Unirest\Request::get("$uri");
	
	$result = "tidak ada";
	
    $json = json_decode($response->raw_body, true);
	//print_r($json);
	//exit;
	
	if($json['status'] == 'ok' && !empty($json['kota'])){
		$uri1 = "https://api.banghasan.com/sholat/format/json/jadwal/kota/".$json['kota'][0]['id']."/tanggal/".date('Y-m-d');
		//$result = $uri1;
		//Unirest\Request::verifyPeer(false);
		$response1 = Unirest\Request::get("$uri1");

		$json1 = json_decode($response1->raw_body, true);
		//print_r($json1);
		//exit;
		if($json1['status'] == 'ok' && is_array($json1['jadwal']['data'])){
			$result = "Jadwal Shalat Sekitar ";
			$result .= $json['kota'][0]['nama'];
			$result .= "\nTanggal : ";
			$result .= $json1['jadwal']['data']['tanggal'];
			$result .= "\n\nImsyak : ";
			$result .= $json1['jadwal']['data']['imsak'];
			$result .= "\nShubuh : ";
			$result .= $json1['jadwal']['data']['subuh'];
			$result .= "\nDhuha : ";
			$result .= $json1['jadwal']['data']['dhuha'];
			$result .= "\nDzuhur : ";
			$result .= $json1['jadwal']['data']['dzuhur'];
			$result .= "\nAshar : ";
			$result .= $json1['jadwal']['data']['ashar'];
			$result .= "\nMaghrib : ";
			$result .= $json1['jadwal']['data']['maghrib'];
			$result .= "\nIsya : ";
			$result .= $json1['jadwal']['data']['isya'];
		}else{
		}
	}else{
	
	}
	
    return $result;
}

function shalat1($keyword) {
    $uri = "https://muslimsalat.com/".$keyword.".json?key=96358558ca5ce2ef0d4662e9afc15c18";
	Unirest\Request::verifyPeer(false);
	$response = Unirest\Request::get("$uri");
	
	$result = "tidak ada";
	
    $json = json_decode($response->raw_body, true);
	//print_r($json);
	//exit;
	
	if($json['status_code']){
			$result = "Jadwal Shalat Sekitar ";
			$result .= $json['address'];
			$result .= "\nTanggal : ";
			$result .= $json['items'][0]['date_for'];
			$result .= "\n\nShubuh : ";
			$result .= $json['items'][0]['fajr'];
			$result .= "\nDhuha : ";
			$result .= $json['items'][0]['shurooq'];
			$result .= "\nDzuhur : ";
			$result .= $json['items'][0]['dhuhr'];
			$result .= "\nAshar : ";
			$result .= $json['items'][0]['asr'];
			$result .= "\nMaghrib : ";
			$result .= $json['items'][0]['maghrib'];
			$result .= "\nIsya : ";
			$result .= $json['items'][0]['isha'];
			
	}else{
	
	}
	
    return $result;
}

echo shalat1($_GET['kota']);
?>