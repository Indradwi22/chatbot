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
$template = array (
  'type' => 'template',
  'altText' => 'Product Beras Bulog',
  'template' => 
  array (
    'type' => 'carousel',
    'columns' => 
    array (
      0 => 
      array (
        'thumbnailImageUrl' => 'https://ecs7.tokopedia.net/img/cache/200-square/product-1/2018/9/4/36214999/36214999_202f8b56-f969-46d7-a3cb-be56a4622468_2048_2048.jpg',
        'imageBackgroundColor' => '#FFFFFF',
        'title' => 'Beras Renceng',
        'text' => 'Beras jenis premium produksi dalam negeri jenis IR 64 bertekstur nasi pulen',
        'defaultAction' => 
        array (
          'type' => 'uri',
          'label' => 'View detail',
          'uri' => 'https://www.tokopedia.com/perumbulog/beras-kita?m_id=14345918',
        ),
        'actions' => 
        array (
          0 => 
          array (
            'type' => 'postback',
            'label' => 'Buy',
            'data' => 'action=buy&itemid=111',
          ),
          1 => 
          array (
            'type' => 'postback',
            'label' => 'Add to cart',
            'data' => 'action=add&itemid=111',
          ),
          2 => 
          array (
            'type' => 'uri',
            'label' => 'View detail',
            'uri' => 'https://www.tokopedia.com/perumbulog/beras-kita?m_id=14345918',
          ),
        ),
      ),
      1 => 
      array (
        'thumbnailImageUrl' => 'https://ecs7.tokopedia.net/img/cache/200-square/product-1/2019/1/24/36214999/36214999_1402ec49-21f3-458c-a32b-a2d1d297b996_1200_1200.jpg',
        'imageBackgroundColor' => '#000000',
        'title' => 'BerasKita Premium - Kemasan 1kg',
        'text' => 'Produksi petani Indonesia yang bebas pemutih, bebas pengawet, dan bebas pewangi yang diolah dengan teknologi modern.',
        'defaultAction' => 
        array (
          'type' => 'uri',
          'label' => 'View detail',
          'uri' => 'https://www.tokopedia.com/perumbulog/beraskita-premium-kemasan-1kg?m_id=14345918',
        ),
        'actions' => 
        array (
          0 => 
          array (
            'type' => 'postback',
            'label' => 'Buy',
            'data' => 'action=buy&itemid=222',
          ),
          1 => 
          array (
            'type' => 'postback',
            'label' => 'Add to cart',
            'data' => 'action=add&itemid=222',
          ),
          2 => 
          array (
            'type' => 'uri',
            'label' => 'View detail',
            'uri' => 'https://www.tokopedia.com/perumbulog/beraskita-premium-kemasan-1kg?m_id=14345918',
          ),
        ),
      ),
    ),
    'imageAspectRatio' => 'rectangle',
    'imageSize' => 'cover',
  ),
);
//echo shalat1($_GET['kota']);
print_r($template);
?>
