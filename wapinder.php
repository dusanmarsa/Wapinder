<?php

class WAPINDER {

  /**
  * -> Initialize variables
  */
  protected $_user;
  protected $_pass;
  protected $_auth;
  protected $_errors = array();
  protected $_comand_rules;
  protected $_dns;

  /**
  * -> Endpoint
  */
  protected $_endpoint = 'https://api.wedos.com/wapi/json';

  /**
  * -> Constructor
  */
  public function __construct()
  {
    $config = include('./data/config.php');

    $this->_user = $config->user;
    $this->_pass = $config->pass;
    $this->_dns = $config->dns;

    $this->_auth = sha1($this->_user.sha1($this->_pass).date('H', time()));

    $this->_comand_rules = include('./data/comand_rules.php');
  }

  /**
  * -> Make a new API request
  */
  public function request($command = 'ping', $data = array())
  {
    if(!$this->canBeUsed())
      return array_push($this->_errors, 'Wedos API is unreachable, try it later.');

    if(!$this->_checkRules($data, $command))
      return array_push($this->_errors, 'Some data missing, try it again!');

    if(array_key_exists('dns', $data))
      if(!empty($this->_dns))
        $data->dns = $this->_dns;

    return $this->_sendRequest([
      'request' => [
        'user' => $this->_user,
        'auth' => $this->_auth,
        'command' => $command,
        'data' => $data
      ]
    ]);
  }

  /**
  * -> Chech if API is reachable
  */
  public function canBeUsed()
  {
    $sess = curl_init($this->_endpoint);
    curl_setopt($sess, CURLOPT_RETURNTRANSFER, true);
    $res = curl_exec($sess);
    $httpCode = curl_getinfo($sess, CURLINFO_HTTP_CODE);

    if($httpCode != 200)
        return false;

    return true;
  }

  /**
  * -> Return errors array
  */
  public function getErrors()
  {
    return $this->_errors;
  }

  function _checkRules($arr, $command)
  {
    //> Missing
    $a = array_diff_key($this->_comand_rules[$command], $arr);

    //> Error
    if(count($a) > 0)
      return false;

    //> Pass
    return true;
  }

  /**
  * -> send request to API server
  */
  function _sendRequest($request)
  {
      $post = 'request='.urlencode(json_encode($request));
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $this->_endpoint);
      curl_setopt($ch, CURLOPT_POST, true);
      curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_TIMEOUT, 100);
      curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
      $res = curl_exec($ch);
      return $this->_returnRespond($res);
  }

  /**
  * -> Work with response from server
  */
  function _returnRespond($res)
  {
    return json_decode($res);
  }

}
