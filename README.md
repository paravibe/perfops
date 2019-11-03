### PerfOps API PHP wrapper

Provides simple wrapper for [PerfOps.net](https://perfops.net) API.

[![Total Downloads](https://img.shields.io/packagist/dt/paravibe/perfops.svg?style=flat-square)](https://packagist.org/packages/paravibe/perfops)

### Examples

1. Resolve a DNS record.
```php
$client = new Client();
$client->setToken('YOUR_TOKEN');

$request = new Request($client);
$request->attachBody([
    "target" => "google.com",
    "param" => "A",
    "dnsServer" => "8.8.8.8",
    "nodes" => "",
    "location" => "Germany",
    "limit" => "1"
]);

$response = $request->request('/run/dns-resolve');
$id = json_decode($response->getBody());
```

2. Return full DNS performance results under a test ID.
```php
$request = new Request($client);
$response = $request->request('/run/dns-resolve/' . $id->id);
```

Please note. This wrapper doesn't provide any custom exception handlers. 
