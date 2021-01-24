<?php
require __DIR__ . '/../Tripay.php';

use Reactmore\Method as MTripay;

$privatekey = 'pkey';
$apikey = 'apikey';

/* false is sandbox   */
/* true is production */

$tripay = new MTripay($privatekey, $apikey, false);

$aksi = $_GET['action'];

if ($aksi == "all") {

  $result = $tripay->MerchantChannelAll();

  var_dump(json_decode($result, true));

} else if ($aksi == "filter") {

  $data = [
    'code' => $_GET['code'],
  ];

  $result = $tripay->MerchantChannelAll($data);

  var_dump(json_decode($result, true));

} elseif ($aksi == "calculator") {

  $data = [
    'amount' => $_GET['amount'],
    'code' => $_GET['code']?:null,
  ];

  $result = $tripay->CalcPay($data);

  var_dump(json_decode($result, true));

} elseif ($aksi == "createtrans") {

  $merchantCode = 'T2037';
  $merchantRef = date('ymd') . rand(100, 400);
  $amount = 1000000;

  $signature = hash_hmac('sha256', $merchantCode.$merchantRef.$amount, $privatekey);

  $data = [
    'method' => 'BCAVA',
    'merchant_ref' => $merchantRef,
    'amount' => $amount,
    'customer_name' => 'Reactmore',
    'customer_email' => 'reactmorecom@gmail.com',
    'customer_phone' => '085155092922',
    'order_items' => [
      [
        'sku' => 'SKU 01',
        'name' => 'Items 100',
        'price' => $amount,
        'quantity' => 1
      ]
    ],
    'callback_url' => 'https://domain.com/callback',
    'return_url' => 'https://domain.com/',
    'expired_time' => (time()+(24*60*60)),
    'signature' => $signature
  ];

  $result = $tripay->CreateCloseTrans($data);

  var_dump(json_decode($result, true));
  // DEV-T203700000048353QQZI

} elseif ($aksi == "detailtrans") {
  $data['reference'] = $_GET['reference']?: null;

  if (empty($data)) {
    echo 'reference need!';
    die;
  }

  $result = $tripay->DetailCloseTrans($data);

  var_dump(json_decode($result, true));

} elseif ($aksi == "opentrans") {

  //$merchantCode = 'T2099';
  $merchantCode = 'T2037';
  $merchantRef = date('ymd') . rand(100, 400);
  $method = 'BCAVA';

  $signature = hash_hmac('sha256', $merchantCode.$method.$merchantRef, $privatekey);

  $data = [
    'method' => $method,
    'merchant_ref' => $merchantRef,
    'customer_name' => 'Reactmore',
    'signature' => $signature
  ];

  $result = $tripay->CreateOpenTrans($data);

  var_dump(json_decode($result, true));
  // DEV-T203700000048353QQZI

} elseif ($aksi == "dtest") {

  $result = $tripay->DetailOpenTrans(1727272727);

  var_dump($result);

}