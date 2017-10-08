<?php
namespace Makframework\Routing;
use Makframework\Routing\Interfaces\RouteInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * Route
 */
class Route extends Routable implements RouteInterface
{
  /**
   * @var string[]
   */
  protected $methods;


  /**
   * @var string
   */
  protected $name;


  /**
   * class constructor
   * @param string[] $methods
   * @param string $pattern
   * @param callable|\Closure $callback
   * @return RouteInterface
   */
  public function __construct(array $methods, string $pattern, callable $callback)
  {
    $this->setMethods($methods);
    $this->setPattern($pattern);
    $this->setCallback($callback);
  }

  /**
   * setMethods
   *
   * @param string[] $methods
   *
   * @return RouteInterface
   */
  public function setMethods(array $methods) : RouteInterface
  {
    $this->methods = array_map('strtoupper', $methods);

    return $this;
  }

  /**
   * getMethods
   *
   * @return array
   */
  public function getMethods() : array
  {
    return $this->methods;
  }

  /**
   * setName
   * @param string $name
   * @return RouteInterface
   */
  public function setName(string $name) : RouteInterface
  {
    $this->name = $name;
    return $this;
  }

  /**
   * getName
   * @return string
   */
  public function getName() : string
  {
    return $this->name;
  }

  /**
   * __invoke
   * @param RequestInterface $request
   * @param ResponseInterface $response
   * @return mixed
   */
  public function __invoke(RequestInterface $request, ResponseInterface $response)
  {
      return call_user_func($this->callback, $request, $response, $this->arguments);
  }

  public function __toString()
  {
    return 'Methods['.implode('|',$this->methods).'] - Pattern['.$this->pattern.'] - Name['.$this->name.']';
  }
}
