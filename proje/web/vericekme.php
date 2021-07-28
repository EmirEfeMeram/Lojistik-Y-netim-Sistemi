<?php


function getir($baslangic, $son, $cekilmek_istenen)
{
    @preg_match_all('/' . preg_quote($baslangic, '/') .
    '(.*?)'. preg_quote($son, '/').'/i', $cekilmek_istenen, $m);
    return @$m[1];
}

$url = "https://www.opet.com.tr/izmir";
$icerik = file_get_contents($url);

$VeriDizi = getir('<span>','</span>',$icerik);
$MotorinFiyat= $VeriDizi[8];
echo $MotorinFiyat;
$FiyatAr=explode("/",$MotorinFiyat);
echo $FiyatAr[0];
$fiyat=$FiyatAr[0];
$fiyat=(float)$fiyat;
echo $fiyat;



?>
