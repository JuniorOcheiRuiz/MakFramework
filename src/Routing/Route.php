<?php
namespace Makframework\Routing;
use Makframework\Routing\Interfaces\RouteInterface;
use Psr\Http\Message\RequestInterface;
use Makframework\Http\Interfaces\ResponseInterface;
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
    $this->setMethods($methods);
    $this->setPattern($pattern);
    $this->setCallback($callback);
    $this->setArguments([]);
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
   * hasMethod
   * @param string $method
   *
   * @return bool
   */
  public function hasMethod(string $method) : bool
  {
    return (empty($this->methods) || array_search($method, $this->methods) !== false);
  }

  /**
   * getArgument
   * @param string $name [description]
   * @return mixed
   */
  public function getArgument(string $name)
  {
    return $this->arguments[$name];
  }

  /**
   * getArguments
   * @return array
   */
  public function getArguments() : array
  {
    return $this->arguments;
  }

  /**
   * setArguments
   * @param array $arguments
   * @return RouteInterface
   */
  public function setArguments(array $arguments) : RouteInterface
  {
    $this->arguments = $arguments;
    return $this;
  }

  /**
   * setArgument
   * @param string $name
   * @param mixed $value
   * @return RouteInterface
   */
  public function setArgument(string $name, $value) : RouteInterface
  {
    $this->arguments[$name] = $value;
  }

  /**
   * addArgument
   *
   * Add a value to the arguments stack. If the key of a value is already present in the stack,
   * the method throw a exception reporting the duplicate value.
   *
   * @param string $name
   * @param mixed $value
   *
   * @return RouteInterface
   *
   * @throws RouteException
   */
  public function addArgument(string $name, $value) : RouteInterface
  {
    if (isset($this->arguments[$name]))
      throw new RouteException(sprintf('The argument %s is already exists in the arguments stack.', $name));

    $this->arguments[$name] = $value;

    return $this;
  }

  /**
   * addArguments
   *
   * Add values to the arguments stack. If the key of a value is already present in the stack,
   * the method throw a exception reporting the duplicate value.
   *
   * @param array $arguments
   *
   * @return RouteInterface
   *
   * @throws RouteException
   */
  public function addArguments(array $arguments) : RouteInterface
  {
    foreach ($arguments as $name => $value) {
      $this->addArgument($name, $value);
    }

    return $this;
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
   * Execute
   *
   * Execute the route and its assigned middlewares
   *
   */
  public function execute(RequestInterface $request, ResponseInterface $response)
  {
    return $this->stack($request, $response);
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
