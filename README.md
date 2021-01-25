# TriPay-Library-PHP
Library untuk TriPay (Payment Gateway Lokal Indonesia)

# Registration
- Registrasi di Website [payment.tripay.co.id](https://payment.tripay.co.id/?ref=TP3091)
- Lakukan KYC setelah di di verifikasi AM tripay akan menghubungi lewat whatsapp
- Untuk group api membutuhkan kerja sama khusus.

# Method
- Reguler API
```php
/* if parameter null get all data */
/* $data[code] = @string */
Method::MerchantChannelAll($data);
Method::PaymentChannelAll($data);

/* $data[code] = @string */
/* $data[amount] = @int */
Method::CalcPay();

/* see example */
Method::CreateCloseTrans();
Method::DetailCloseTrans();

/* sanbox cant use */
Method::CreateOpenTrans();
Method::DetailOpenTrans();
Method::PayOpenTrans();
```
- Group API (On Progress)

# Usage
```php
require __DIR__ . '/../Tripay.php' or Autoload;

use Reactmore\Method as MTripay;

/* false is sandbox   */
/* true is production */

$tripay = new MTripay($privatekey, $apikey, false);

$data = [
'amount' => 100000,
'code' => QRIS, // delete to get all
];

$result = $tripay->CalcPay($data);

var_dump(json_decode($result, true));


```

# CREDIT
- Author Lib [hexageek1337](https://github.com/hexageek1337/TriPay-Library/).