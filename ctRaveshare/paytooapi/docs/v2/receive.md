Receive Documentation
=====================

The simplest way to receive Bitcoin payments. Blockchain forwards all incoming Bitcoin to the address you specify.

Be sure to check out the [official documentation](https://blockchain.info/api/api_receive) for information on callback URLs.

Usage
-----

Call `ReceiveV2->generate` on a `Blockchain` object. Pass a v2 API key, xpub and callback URL. Returns a `ReceiveResponse` object.

```php
$blockchain = new \Blockchain\Blockchain($apiKey);

$v2ApiKey = 'myApiKey';
$xpub = 'xpubYourXPub';
$callbackUrl = 'http://example.com/transaction?secret=mySecret';

$response = $blockchain->ReceiveV2->generate($v2ApiKey, $xPub, $callbackUrl);

// Show receive address to user:
echo "Send coins to " . $response->getReceiveAddress();
```

To view the callback logs call `ReceiveV2->callbackLogs` on a `Blockchain` object. Pass an API key and callback URL. Returns an array of `CallbackLogEntry` objects.

```php
$blockchain = new \Blockchain\Blockchain($apiKey);

$v2ApiKey = 'myApiKey';
$callbackUrl = 'http://example.com/transaction?secret=mySecret';

$logs = $blockchain->ReceiveV2->callback($apiKey, $callbackUrl);

foreach ($logs as $log) {
    $log->getCallback();
    $log->getCalledAt(); // DateTime instance
    $log->getResponseCode();
    $log->getResponse();
}
```