# PHPCurlAsync
#### Make curl asynchronous queries with php.

#### Require php version >= 5, but with php 5 async request will be executed 1s vs php 7 - 50ms 

#### Code example
```php
  CurlAsync\Talk::instance('http://example.com') -> async() -> setPost(['id' => 228]) -> request('/services/updatePost'); // async php request
```
 
#### To install with composer
```
  composer require yatsenkolesh/php-curlasync
```
