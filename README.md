ethOS Client for PHP
============================
This client makes it easy to connect to the panel of your [ethOS](http://ethosdistro.com) cryptocurrency miners.

Initiate the client:
```php
$client = new \RutgerKirkels\Ethos_Api_Client\Client(<id_of_your_ethos_panel>);

```

Get all miners the current hashrate for all miners:
```php
$miners = $client->getAllMiners();

foreach ($miners as $miner) {
    echo 'Hashrate for miner ' . $miner->getId() . ': ' . $miner->getHashrate() . ' MH/s<br/>';
}
```

