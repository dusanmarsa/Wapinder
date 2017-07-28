<?php

class WAPINDER {

  //> Initialize variables
  protected $user;
  protected $pass;
  protected $auth;
  protected $errors = array();

  protected $comand_rules;

  //> Wedos endpoints types
  protected $endpoint = 'https://api.wedos.com/wapi/json';

  //> WAPINDER constructor
  public function __construct($user, $pass)
  {
    $this->user = $user;
    $this->pass = $pass;
    $this->auth = sha1($user.sha1($pass).date('H', time()));

    $this->comand_rules = include('./data/comand_rules.php');
  }

  //> Make new API request
  public function request($command = 'ping', $data = array())
  {
    if(!$this->isReachable())
    {
      return array_push($this->errors, 'Wedos API is unreachable, try it later.');
    }

    if(!$this->_checkRules($data, $command))
    {
      return array_push($this->errors, 'Some data missing, try it again!');
    }

    return $this->_sendRequest([
      'request' => [
        'user' => $this->user,
        'auth' => $this->auth,
        'command' => $command,
        'data' => $data
      ]
    ]);
  }

  //> Check if API is reachible to comands
  public function isReachable()
  {
    $sess = curl_init($this->endpoint);
    curl_setopt($sess, CURLOPT_RETURNTRANSFER, true);
    $res = curl_exec($sess);
    $httpCode = curl_getinfo($sess, CURLINFO_HTTP_CODE);

    if($httpCode == 404) {
        return false;
    }

    return true;
  }

  public function getErrors()
  {
    return $this->errors;
  }

  function _checkRules($arr, $command)
  {
    //> Missing
    $a = array_diff_key($this->comand_rules[$command], $arr);

    //> Error
    if(count($a) > 0)
    {
      return false;
    }

    //> Pass
    return true;
  }

  //> Send request to WEDOS API
  function _sendRequest($request)
  {
      $post = 'request='.urlencode(json_encode($request));
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $this->endpoint);
      curl_setopt($ch, CURLOPT_POST, true);
      curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_TIMEOUT, 100);
      curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
      $res = curl_exec($ch);
      return $this->_returnRespond($res);
  }

  //> Work with response
  function _returnRespond($res)
  {
    return json_decode($res)->response;
  }

}
