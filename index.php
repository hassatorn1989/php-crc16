<?php
require __DIR__ . '/vendor/autoload.php';
$faccode = '56327'; 
$cardid = '46703';

// faccode length 16 , cardid length 19
$pad_faccode = str_pad(decbin($faccode), 16, "0", STR_PAD_LEFT);
$pad_cardid = str_pad(decbin($cardid), 19, "0", STR_PAD_LEFT);

// concat faccode and cardid
$fc_concat = $pad_faccode. $pad_cardid;

$fc_left = substr($fc_concat,0,18);
$fc_right = substr($fc_concat,-18);

// Sum number
$fc_left_sum = strlen(str_replace('0', '', $fc_left));
$fc_right_sum = strlen(str_replace('0', '', $fc_right));

$event_parity = (($fc_left_sum % 2) == 0) ? '0' : '1';
$odd_parity = (($fc_right_sum % 2) == 0) ? '1' : '0';

$concat_all =  $event_parity . $fc_concat. $odd_parity;
$data =  '5,0,'.base_convert($concat_all, 2, 16);

$crc16ccitt = new mermshaus\CRC\CRC16XModem();
$crc16ccitt->update($data);
$checksum = $crc16ccitt->finish();
echo $senddata = $data.'0x'. strtoupper(bin2hex($checksum))
?> 