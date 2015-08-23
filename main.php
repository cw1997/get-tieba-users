<?php
//code by 昌维
$kw=$_GET['kw'];//这是贴吧
$spn=$_GET['spn'];//这是起始页数，一般写1
$epn=$_GET['epn'];//这是结束页数，你自己随便写，一般不要写太长，否则会卡死
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
