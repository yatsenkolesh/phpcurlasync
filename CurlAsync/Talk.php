<?php
/**
  * Helper for calls remote components/local services
  * @author Alex Yatsenko
  * @link https://github.com/yatsenkolesh/php-curlasync
  * @license BSD-3-Clause 
*/

namespace CurlAsync;

class Talk
{
  /**
    * @var string $response
  */
  public $response = null;

  /**
    * @var string $requestUrl
  */
  private $requestUrl = null;

  /**
    * @var array $postFields
  */
  private $postFields = [];

  /**
    * @var resource $curl
  */
  private $curl = null;

  /**
    * @var string $url
  */
  private $url;

  /**
    * @var boolean $async
  */
  private $async = false;

  /**
    * @param string $url
    * @return object Talk
  */
  public static

  function instance($host = null)
  {
    return new self($host);
  }

  /**
    * @param string $url
    * @return
  */
  public

  function __construct($host = null)
  {
    $this->host = $host;
    return ;
  }

  /**
    * @param array $post
    * @return object Talk
  */
  public

  function setPost($post = [])
  {
    $this->postFields = $post;
    return $this;
  }

  /**
    * Don't return result if you will be use request aync method
    * Make a current request is async
    * @return object Talk
  */
  public

  function async()
  {
    $this->async = true;
    return $this;
  }

  /**
    * Make a current request is not async
    * @return object Talk
  */
  public

  function await()
  {
    $this->async = false;
    return $this;
  }

  /**
    * @param string $url
    * @return object Talk
  */
  public

  function request($url = null)
  {
    $this->curl = curl_init();

    curl_setopt($this->curl, CURLOPT_URL, $this->host. $url);

    if(sizeof($this->postFields))
    {
      curl_setopt($this->curl, CURLOPT_POST, 1);
      curl_setopt($this->curl, CURLOPT_POSTFIELDS, $this->postFields);
    }
    else
      curl_setopt($this->curl, CURLOPT_HTTPGET, 1);


    curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, true);

    if($this->async)
    {
      curl_setopt($this->curl, CURLOPT_FRESH_CONNECT, true);

      //fucking curl
      if(explode('.', php_version())[0] == 7)
        curl_setopt($this->curl, CURLOPT_TIMEOUT_MS, 50);
      else
        curl_setopt($this->curl, CURLOPT_TIMEOUT, 1);

    }

    $this->response = curl_exec($this->curl);

    curl_close ($this->curl);

    return $this;
  }

  /**
    * @param string $url
    * @return string
  */
  public static

  function simple($url = null)
  {
    $curl = curl_init($url);

    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_VERBOSE, 1);
    curl_setopt($curl, CURLOPT_HEADER, 1);

    $response = curl_exec($curl);

    $headerSize = curl_getinfo($curl, CURLINFO_HEADER_SIZE);

    return
    [
      'body' => substr($response, $headerSize),
      'header' => substr($response, 0, $headerSize),
    ];
  }
}
?>
