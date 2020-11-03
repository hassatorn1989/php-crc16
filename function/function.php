<?php 
function cv_raw_data($faccode, $cardid)
{
  // faccode length 16 , cardid length 19
  $pad_faccode = str_pad(decbin($faccode), 16, "0", STR_PAD_LEFT);
  $pad_cardid = str_pad(decbin($cardid), 19, "0", STR_PAD_LEFT);

  // concat faccode and cardid
  $fc_concat = $pad_faccode . $pad_cardid;

  $fc_left = substr($fc_concat, 0, 18);
  $fc_right = substr($fc_concat, -18);

  $event_parity = ((strlen(str_replace('0', '', $fc_left)) % 2) == 0) ? '0' : '1';
  $odd_parity = ((strlen(str_replace('0', '', $fc_right)) % 2) == 0) ? '1' : '0';
  $concat_all =  $event_parity . $fc_concat . $odd_parity;
  return '5,0,' . base_convert($concat_all, 2, 16);
}
?>