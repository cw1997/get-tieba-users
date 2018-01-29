<?php
header("Content-type: text/html; charset=utf-8");

$kw=$_GET['kw'];//这是贴吧
$spn=$_GET['spn'];//这是起始页数，一般写1
$epn=$_GET['epn'];//这是结束页数，你自己随便写，一般不要写太长，否则会卡死
//$kw='bug';$spn=1;$epn=10;

if (!isset($kw) || empty($kw)) {
	$kw = '昌维';
	$exit = 1;
}
?>
<form>
	贴吧名字（不要带“吧”字）：<input name="kw" value="<?php echo $kw; ?>" placeholder="贴吧名字"><hr>
	起始页数（一般为1）：<input name="spn" value="1" placeholder="起始页数"><hr>
	结束页数（一页20个ID，请自行估算数量）：<input name="epn" value="2" placeholder="结束页数"><hr>
	<input type="hidden" name="r" value="<?php echo rand().rand().rand(); ?>">
	<input type="submit">
</form>
<?php
//code by 昌维
if ($exit) {
	exit;
}
set_time_limit(0); // 不限制最长执行时间（但是受服务器环境限制）

$p='/<a href="\/home\/main\/\?un=(.+?)&fr=furank" target="_blank"/i';
//$str=iconv('GB2312', 'UTF-8', $str);
preg_match_all($p, getdata($kw,$spn,$epn), $r, PREG_SET_ORDER);
foreach ($r as $key => $value) {
	$str = urldecode($value[1]);
	$str = iconv('GB2312', 'UTF-8', $str);
	echo $str.'<br>';
}
//print_r($r);
function getdata($kw,$spn,$epn) {
	for ($i=$spn; $i < $epn; $i++) {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, 'http://tieba.baidu.com/f/like/furank?ie=utf8&kw='.$kw.'&pn='.$i);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		$str .= curl_exec($ch);
		curl_close($ch);
	}
	return $str;
}
