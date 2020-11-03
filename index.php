<?php
require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/function/function.php';
$faccode = '56327';
$cardid = '46703';
$data = cv_raw_data($faccode, $cardid);
$crc16ccitt = new mermshaus\CRC\CRC16XModem();
$crc16ccitt->update($data);
$checksum = $crc16ccitt->finish();
echo $senddata = $data.'0x'. strtoupper(bin2hex($checksum));
