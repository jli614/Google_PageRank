<?php

/*********************************************************
*   Desc    :   Get PageRank of a Website, for PHP
*   Author  :   iSayme
*   E-Mail  :   isaymeorg@gmail.com
*   Website :   http://www.isayme.org
*   Date    :   2012-08-04
*********************************************************/

function GetPageRank($q = 'www.isayme.org',$host = 'toolbarqueries.google.com',$context=NULL) {
	$seed = "Mining PageRank is AGAINST GOOGLE'S TERMS OF SERVICE. Yes, I'm talking to you, scammer.";
	$result = 0x01020345;
	$len = strlen($q);
	for ($i=0; $i < $len; $i++) {
		$result ^= ord($seed{$i%strlen($seed)}) ^ ord($q{$i});
		$result = (($result >> 23) & 0x1ff) | $result << 9;
	}
	$ch=sprintf('8%08x', $result);
	$url='http://%s/tbr?client=navclient-auto&ch=%s&features=Rank&q=info:%s';
	$url=sprintf($url,$host,$ch,$q);
	
	/*$pr = '';
    $handler = fopen($url,'r');
    while(!feof($handler)){
       $pr.=fread($handler,128);
    }
    fclose($handler);*/
	
	@$pr=file_get_contents($url,false,$context);
	return $pr?substr(strrchr($pr, ':'), 1):false;
}

if (isset($_GET['q'])) { echo "Page Rank: ".GetPageRank($_GET['q']); }
else { echo "Page Rank: ".GetPageRank(); }

?>