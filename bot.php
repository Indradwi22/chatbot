<?php
/*
copyright @ medantechno.com
Modified @ Farzain - zFz
2017

*/

require_once('./line_class.php');
require_once('./unirest-php-master/src/Unirest.php');

$channelAccessToken = 'uG/vBN5LpDUrAHMNWMbxypVHFrS4OdkeMfZ9OPBLlrHO2u53kDdyQFtxnQcSaOgUTe9WuEJ9wpqTlw61evaNBBfnL2fhs4YlT1WgKFc3to+BEfTB44MiwGnJFCxY7FoYI215VMVi4fMuxTxxjNgyLAdB04t89/1O/w1cDnyilFU='; //sesuaikan 
$channelSecret = '31402e47a1b8d51c0e731cdbf51fb279';//sesuaikan

$client = new LINEBotTiny($channelAccessToken, $channelSecret);

$userId 	= $client->parseEvents()[0]['source']['userId'];
$groupId 	= $client->parseEvents()[0]['source']['groupId'];
$replyToken = $client->parseEvents()[0]['replyToken'];
$timestamp	= $client->parseEvents()[0]['timestamp'];
$type 		= $client->parseEvents()[0]['type'];

$message 	= $client->parseEvents()[0]['message'];
$messageid 	= $client->parseEvents()[0]['message']['id'];

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

$profil = $client->profil($userId);

$pesan_datang = explode(" ", $message['text']);

$command = $pesan_datang[0];
$options = $pesan_datang[1];
if (count($pesan_datang) > 2) {
    for ($i = 2; $i < count($pesan_datang); $i++) {
        $options .= '+';
        $options .= $pesan_datang[$i];
    }
}

#-------------------------[Function]-------------------------#
function shalat($keyword) {
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
#-------------------------[Function]-------------------------#

# require_once('./src/function/search-1.php');
# require_once('./src/function/download.php');
# require_once('./src/function/random.php');
# require_once('./src/function/search-2.php');
# require_once('./src/function/hard.php');

//show menu, saat join dan command /menu
if ($type == 'join' || $command == '/menu') {
    $text = "Assalamualaikum Kakak, aku adalah bot jadwal shalat, silahkan ketik\n\n/shalat <nama tempat>\n\nnanti aku bakalan kasih tahu jam berapa waktunya shalat ^_^";
    $balas = array(
        'replyToken' => $replyToken,
        'messages' => array(
            array(
                'type' => 'text',
                'text' => $text
            )
        )
    );
}

//pesan bergambar
if($message['type']=='text') {
	    if ($command == '/shalat') {

        $result = shalat($options);
        $balas = array(
            'replyToken' => $replyToken,
            'messages' => array(
                array(
                    'type' => 'text',
                    'text' => $result
                )
            )
        );
    }else if ($command == '/template'){
        $balas = array(
            'replyToken' => $replyToken,
            'messages' => $template
        ); 
    }

}else if($message['type']=='sticker')
{	
	$balas = array(
							'replyToken' => $replyToken,														
							'messages' => array(
								array(
										'type' => 'text',									
										'text' => 'Makasih Kak Stikernya ^_^'										
									
									)
							)
						);
						
}
if (isset($balas)) {
    $result = json_encode($balas);
//$result = ob_get_clean();

    file_put_contents('./balasan.json', $result);


    $client->replyMessage($balas);
}
?>
