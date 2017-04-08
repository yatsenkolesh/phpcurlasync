# php-curlasync
##### Make curl asynchronous queries with php.

#### Require php version >= 5, but with php 5 async request will be executed 1s vs php 7 - 50ms 

#### Code example
```php
  Talk::instance('http://example.com') -> async() -> setPost(['id' => 228]) -> request('/services/getPost'); // async php request
```
 
