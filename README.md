# > Wapinder

Pomocná třída pro Wedos API, která umožňuje jednoduché napojení a volání requestů přímo na API endpointy.

# > Návod

##### 1)  Importujeme wapinder do souboru
```php
// ./index.php

include_once("./wapinder.php");

```
##### 2)  Nastavíme config file
```php
// ./data/config.php

user -> přihlašovací jméno na wedos
pass -> heslo nastavené při spouštění WAPI v administraci
api -> na jaký DNS server se budou registrovat domény (libovolné, pokud se nebude používat tak nechat prázdné)

```
##### 3)  Inicializujeme
```php
// ./index.php

$worker = new WAPINDER();

```

##### 4)  Použijeme a čekáme na odpověď
```php
// ./index.php

$res = $worker->request();
// prázdný request je roven příkazu "ping"

```

##### 5)  Pracujeme s vrácenou hodnotou

```php
// ./index.php

var_dumb($res);
// $res je pole vrácených hodnost (response)
// můžeme si například vypsat hodnotu code

$code = $res->code;
echo $code;
// Hodnota $code by měla vrátit hodnotu 1000 pokud vše proběhlo v pořádku.
// Více o návratových hodnotách v sekci "materiály"

```

# > Další úpravy
Je možnost si upravit povolené příkazy v souboru "./data/comand_rules.php" kde stačí nepoužívané zakomentovat.


# > Materiály
* ##### [Návratové hodnoty](https://kb.wedos.com/cs/wapi/navratove-kody.html)
