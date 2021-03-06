<?php
function hexview($data,$wrap = 16, $baseaddress = 0, $charset = null) {
	$output = '        ';
	for ($i = 0; $i < $wrap; $i++)
		$output .= sprintf('%02X ', ($baseaddress+$i)%$wrap);
	$output .= sprintf('<hr>%06X: ', $baseaddress);
	$ascii = '';
	$stringlen = 0;
	for ($i = 0; isset($data[$i]); $i++) {
		$output .= sprintf('%02X ', ord($data[$i]));
		$stringlen++;
		$ascii .= replacechar($data[$i], $charset);
		if ($i%$wrap == $wrap-1) {
			$output .= sprintf("%s\r\n",$ascii);
			if ($i < strlen($data))
				$output .= sprintf('%06X: ', $baseaddress+$i+1);
			$ascii = '';
			$stringlen = 0;
		}
	}
	if ($ascii != null)
		$output .= str_repeat(' ', ($wrap-$stringlen)*3).$ascii;
	return $output;
}

function replacechar($char, $charset) {
	if ($charset == null) {
		if (ord($char) < 0x20)
			return '.';
		else if (ord($char) >= 0x7F)
			return '.';
		return htmlentities($char);
	}
	if (isset($charset[ord($char)]))
		$c = trim(mb_substr($charset[ord($char)],0,1), "\t\n\r");
	if (isset($c) && ($c != ''))
		return htmlentities($c);
	return '█';
}
?>