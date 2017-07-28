# > Wapinder

Pomocná třída pro Wedos API, která umožňuje jednoduché napojení a volání requestů přímo na API endpointy.

# > Návod

##### 1)  Importujeme wapinder do souboru
```php

include_once("./wapinder.php");

```
##### 2)  Inicializujeme
```php

$worker = new WAPINDER($name, $pass);
// $name je uživatelské jméno u wedosu
// $pass je heslo nastavené na účtu v sekci WAPI

```

##### 3)  Použijeme a čekáme na odpověď
```php

$res = $worker->request();
// prázdný request je roven příkazu "ping"

```

##### 4)  Pracujeme s vrácenou hodnotou

```php

var_dumb($res);
// $res je pole vrácených hodnost (response)
// můžeme si například vypsat hodnotu code

$code = $res->code;
echo $code;
// Hodnota $code by měla vrátit hodnotu 1000 pokud vše proběhlo v pořádku.
// Více o návratových hodnotách v sekci "materiály"

```


# Materiály
* ##### [Návratové hodnoty]("https://kb.wedos.com/cs/wapi/navratove-kody.html")
