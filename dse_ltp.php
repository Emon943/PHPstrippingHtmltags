<?php
try{
	
$url = "https://www.dsebd.org/latest_share_price_all.php";
$ch = curl_init();
$timeout = 50;
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
$html = curl_exec($ch);
curl_close($ch);
$dom = new DOMDocument();
$html = str_replace('', '', $html);
 //echo $html;
 
@$dom->loadHTML($html);
//print_r($dom);

$tr = $dom->getElementsByTagName('tr');
//print_r($tr);
//die();
//$data=array();
//$CAPMBDBLMF_Row=(int) 0;
//echo $CAPMBDBLMF_Row;
$trarray=array();

foreach ($tr as $k=>$content):
    $trarray[] = $content;
	//print_r($k);
    $td=$trarray[$k]->getElementsByTagName('td');
 
		$tdArrayL=array();
		 //print_r($tdArrayL);	
        foreach ($td as $s=>$tdContent){
			//print_r($tdContent);
			$tdArrayL[]=$tdContent;
			//print_r($tdContent->nodeValue);
            if (stripos($tdContent->nodeValue, "CAPMBDBLMF") !== false) {
                $CAPMBDBLMF_Row=(int)($tdArrayL[0]->nodeValue);
				//echo  $CAPMBDBLMF_Row;
            }
        }
		//die();
endforeach;
$td_a=array();
$td=$trarray[$CAPMBDBLMF_Row]->getElementsByTagName('td');
//print_r($td);
foreach($td as $td_content_):
$td_a[]=($td_content_->nodeValue);
//print_r($td_a);
endforeach;
echo (float) $td_a[2];

}catch(Exception $exception){
echo "Please Wait....";
}
?>