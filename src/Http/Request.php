<?php
namespace Makframework\Http;

/**
 * Request
 */
class Request extends Message
{
  /**
   *Method
   *@var string
   */
  protected $method;

  /**
   *Http Uri Object
   *@var \Makframework\Http\Uri
   */
  protected $uri;

  /**
   *Cookies
   *@var \Makframework\Http\Cookies
   */
  protected $cookies;

  /**
   *Params
   *@var \Makframework\Http\Params
   */
  protected $params;

  public function __construct(string $method, string $uri, array $headers, array $cookies, array $params, string $body) {
    $this->method = $method;
    $this->uri = new Uri($uri);
    $this->headers = new Headers($headers);
    $this->cookies = new Cookies($cookies);
    $this->params = new Params($params);
    $this->body = new Body($body);
  }

  public static function capture() : Request
  {
    $method = isset($_SERVER['REQUEST_METHOD']) ? $_SERVER['REQUEST_METHOD'] : '';
    $uri = Uri::createFromGlobals()->toString();
    $headers = Headers::createFromGlobals()->all();
    $cookies = Cookies::createFromGlobals()->all();
    $params = Params::createFromGlobals()->all();
    $body = '';
    return new static($method, $uri, $headers, $cookies, $params, $body);
  }

  public function getMethod() : string
  {
    return $this->method;
  }

  public function setMethod(string $method) : Message
  {
    $this->method = $method;
    return $this;
  }

  public function getParams() : Params
  {
    return $this->params;
  }

  public function setParams(array $params) : Message
  {
    $this->params->replace($params);
    return $this;
  }

  public function getUri() : Uri
  {
    return $this->uri;
  }

  public function setUri(string $uri) : Message
  {
    $this->uri = new Uri($uri);
    return $this;
  }

  public function getCookies() : Cookies
  {
    return $this->cookies;
  }

  public function setCookies(array $cookies) : Message
  {
    $this->cookies->replace($cookies);
    return $this;
  }

  public function __clone()
  {
    $this->headers = clone $this->headers;
    $this->uri = clone $this->uri;
    $this->params = clone $this->params;
    $this->cookies = clone $this->cookies;

  }
}
