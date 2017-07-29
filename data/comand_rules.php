<?php

return [

  /**
  * > REQUESTS FOR MANIPULATE WITH DOMAINS
  */

  'ping' => [ /*  */ ],
    // Create domain
  'domain-create' => [
    'name' => true,
    'period' => true,
    'dns' => true,
    'owner_c' => true,
    'rules' => true
  ],
    // Check if domain can be registered
  'domain-check' => [
    'name' => true
  ],
    // Check if domain can be registered for give amout of years
  'domain-tld-period-check' => [
    'tld' => true,
    'period' => true
  ],
    // Send auth info to email of domain owner
  'domain-send-auth-info' => [
    'name' => true
  ],
    // Change DNS of domain
  'příkaz domain-update-ns' => [
    'name' => true,
    'nsset' => true,
    'dns' => true
  ],
    // Transfer domain from another register to wedos
  'domain-transfer' => [
    'name' => true,
    'auth_info' => true,
    'rules' => true
  ],
    // Check if domain can be transfered
  'domain-transfer-check' => [
    'name' => true
  ],
    // Renew domain for a given amout of years
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
