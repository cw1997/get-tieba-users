<?php
//code by 昌维
$kw=$_GET['kw'];
$spn=$_GET['spn'];
$epn=$_GET['epn'];
//$kw='bug';$spn=1;$epn=10;
$p='/<a href="\/home\/main\/\?un=(.+?)&fr=furank" target="_blank"/i';
//$str=iconv('GB2312', 'UTF-8', $str);
preg_match_all($p, getdata($kw,$spn,$epn), $r, PREG_SET_ORDER);
foreach ($r as $key => $value) {
	echo urldecode($value[1]).'<br>';
}
//print_r($r);
function getdata($kw,$spn,$epn) {
	for ($i=$spn; $i < $epn; $i++) { 
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, 'http://tieba.baidu.com/f/like/furank?kw='.$kw.'&pn='.$i);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		$str .= curl_exec($ch);
		curl_close($ch);
	}
	return $str;
}
?>
