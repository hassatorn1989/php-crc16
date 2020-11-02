<?php
require __DIR__ . '/vendor/autoload.php';
$faccode = '56327'; 
$cardid = '46703';

// faccode length 16 , cardid length 19
$pad_faccode = str_pad(decbin($faccode), 16, "0", STR_PAD_LEFT);
$pad_cardid = str_pad(decbin($cardid), 19, "0", STR_PAD_LEFT);

// concat faccode and cardid
$number_concat = $pad_faccode. $pad_cardid;

$number_left = substr($number_concat,0,18);
$number_right = substr($number_concat,-18);

// Sum number
$number_left_sum = strlen(str_replace('0', '', $number_left));
$number_right_sum = strlen(str_replace('0', '', $number_right));

$event_parity = (($number_left_sum % 2) == 0) ? '0' : '1';
$odd_parity = (($number_right_sum % 2) == 0) ? '1' : '0';

$concat_all =  $event_parity . $number_concat. $odd_parity;
// echo substr("abcdefghijklmnopqrstuvwxyz0123456789*", 0, 1);
$num9 = substr($concat_all, -4);
$num8 = substr($concat_all, 29, -4);
$num7 = substr($concat_all, 25, -8);
$num6 = substr($concat_all, 21, -12);
$num5 = substr($concat_all, 17, -16);
$num4 = substr($concat_all, 13, -20);
$num3 = substr($concat_all, 5, -28);
$num2 = substr($concat_all, 1, -32);
$num1 = substr($concat_all, 0, 1);

$cv_hex = $num1. dechex(bindec($num2)). dechex(bindec($num3)). dechex(bindec($num4)). dechex(bindec($num5)). dechex(bindec($num6)). dechex(bindec($num7)). dechex(bindec($num8)). dechex(bindec($num9));

 $data = '5,0,'. $cv_hex;

$crc16ccitt = new mermshaus\CRC\CRC16XModem();
$crc16ccitt->update($data);
$checksum = $crc16ccitt->finish();
echo $senddata = $data.'0x'. strtoupper(bin2hex($checksum))
?> 