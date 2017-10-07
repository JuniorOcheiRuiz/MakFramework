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
   * @var array
   */
  protected $arguments;

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
    $this->methods = $methods;
    $this->pattern = $pattern;
    $this->callback = $callback;
    $this->arguments = [];
    $this->name = '';
    $this->middlewares = [];
  }

  /**
   * setArgument
   * @param string $key
   * @param string $value
   * @return RouteInterface
   */
  public function setArgument(string $key, $value) : RouteInterface
  {
    $this->arguments[$key] = $value;
    return $this;
  }

  /**
   * setArgument
   * @param string $key
   * @param string $value
   * @return RouteInterface
   */
  public function setArguments(array $arguments) : RouteInterface
  {
    $this->arguments = $arguments;

    return $this;
  }

  /**
   * getArgument
   * @param string $key
   * @param string $value
   * @return RouteInterface
   */
  public function getArgument(string $key)
  {
    return $this->arguments[$key];
  }

  /**
   * getArguments
   * @param string $key
   * @param string $value
   * @return RouteInterface
   */
  public function getArguments() : array
  {
    return $this->arguments;
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
    $result = call_user_func($this->callback, $request, $response, $this->arguments);

    return $result;
  }
}
