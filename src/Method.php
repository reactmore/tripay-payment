<?php

namespace Reactmore;

use Reactmore\lib\Tripay;
use Reactmore\driver\Driver;

class Method
{

  protected $production = false;

  public function __construct($privatekey = null, $apikey = null, $production = false)
  {
    $this->production = $production;
    $this->tripay = new Tripay($privatekey, $apikey);
  }

  /* Get Merchant Channel
  /* If Parameter NULL Get All Data
  /* 'code' => @string
  */

  public function MerchantChannelAll($param = null, $group = null)
  {
    $data = $this->tripay->curlAPI(
      $this->production ? $this->tripay->URL_channelMp : $this->tripay->URL_channelMs,
      $param ?: $param,
      'get'
    );
    if (!empty($group)) {
      $result = json_decode($data);
      $result = json_decode($result, true);

      $data = Driver::filterGroup($result['data'], $group);
      return $data;
    }

    return json_decode($data);
  }

  /* Get Payment Channel
  /* If Parameter NULL Get All Data
  /* 'code' => @string
  */

  public function PaymentChannelAll($param = null)
  {
    $result = $this->tripay->curlAPI(
      $this->production ? $this->tripay->URL_channelPp : $this->tripay->URL_channelPs,
      $param ?: $param,
      'get'
    );

    return json_decode($result);
  }



  /* Fee Calculator
  /* If Parameter NULL Get All Data
  /* 'amount' => @integer (require)
  /* 'code' => @string (opsional)
  */

  public function CalcPay(array $param)
  {
    $result = $this->tripay->curlAPI(
      $this->production ? $this->tripay->URL_calcMp : $this->tripay->URL_calcMs,
      $param,
      'get'
    );

    return json_decode($result);
  }


  /* Closed Payment Create
  /* Info Parameter Get on Website or see example
  /* https://payment.tripay.co.id/developer
  */

  public function CreateCloseTrans(array $param)
  {
    $result = $this->tripay->curlAPI(
      $this->production ? $this->tripay->URL_transMp : $this->tripay->URL_transMs,
      $param,
      'post'
    );

    return json_decode($result);
  }

  /* Closed Payment Create
  /* 'reference' => @string (require)
  */

  public function DetailCloseTrans($reference)
  {
    $result = $this->tripay->curlAPI(
      $this->production ? $this->tripay->URL_transDetailMp : $this->tripay->URL_transDetailMs,
      $reference,
      'get'
    );

    return json_decode($result);
  }

  /* Open Payment Create , read and detail by id
  /* Info Parameter Get on Website or see example
  /* https://payment.tripay.co.id/developer
  /* This Method only On Production cause url sandbox not found
  */

  public function CreateOpenTrans(array $param)
  {
    $result = $this->tripay->curlAPI(
      $this->production ? $this->tripay->URL_transOpenMp : $this->tripay->URL_transOpenMs,
      $param,
      'post'
    );

    return json_decode($result);
  }

  public function DetailOpenTrans($id)
  {

    $searchTerms = array('{uuid}');
    $replacements = array($id);

    $url = $this->production ? $this->tripay->URL_transDetailOpenMp : $this->tripay->URL_transDetailOpenMs;

    $out_url = str_replace($searchTerms, $replacements, $url);

    $result = $this->tripay->curlAPI(
      $out_url,
      null,
      'get'
    );


    return json_decode($result);
  }

  public function PayOpenTrans($id)
  {

    $searchTerms = array('{uuid}');
    $replacements = array($id);

    $url = $this->production ? $this->tripay->URL_transPembOpenMp : $this->tripay->URL_transPembOpenMs;

    $out_url = str_replace($searchTerms, $replacements, $url);

    $result = $this->tripay->curlAPI(
      $out_url,
      null,
      'get'
    );

    return json_decode($result);
  }
}
