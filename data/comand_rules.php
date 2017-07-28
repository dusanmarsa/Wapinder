<?php

return [

  /**
  * > REQUESTS FOR MANIPULATE WITH DOMAINS
  */

  'ping' => [ /*  */ ],
  'domain-create' => [
    'name' => true,
    'period' => true,
    'nsset' => true,
    'dns' => true,
    'owner_c' => true,
    'rules' => true
  ],
  'domain-check' => [
    'name' => true
  ],
  'domain-tld-period-check' => [
    'tld' => true,
    'period' => true
  ],
  'domain-send-auth-info' => [
    'name' => true
  ],
  'příkaz domain-update-ns' => [
    'name' => true,
    'nsset' => true,
    'dns' => true
  ],
  'domain-transfer' => [
    'name' => true,
    'auth_info' => true,
    'rules' => true
  ],
  'domain-transfer-check' => [
    'name' => true
  ],
  'domains-list' => [ /* */ ],
  'domain-renew' => [
    'name' => true,
    'period' => true
  ]

  /**
  * > REQUESTS FOR MANIPULATE WITH CONTACTS WITHIN DOMAIN REGISTRY
  */

  /**
  * > REQUESTS FOR MANIPULATE WITH NSSET'S WITHIN DOMAIN REGISTRY
  */

];
