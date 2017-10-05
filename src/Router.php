<?php
namespace Makframework;
use AltoRouter;

/**
 *
 */
class Router
{
  /**
   * @var \AltoRouter
   */
  protected $altoRouter;

  public function __construct()
  {
    $this->altoRouter = new AltoRouter;
  }

  public function map(string $method, string $requestPath, $target)
  {
    $this->altoRouter->map($method, $requestPath, $target);
  }

  public function group(string $requestPath, $callback)
  {
    //$this->setBasePath();
    $callback = $callback->bindTo($this);
    $callback();
  }

  public function get(string $requestPath, $target)
  {
    $this->map('GET', $requestPath, $target);
  }
  
}
