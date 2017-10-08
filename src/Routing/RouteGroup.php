<?php
namespace Makframework\Routing;
use Makframework\Routing\Interfaces\RouteGroupInterface;

/**
 * RouteGroup
 */
class RouteGroup extends Routable implements RouteGroupInterface
{

  /**
   * Class constructor
   * @param string $pattern
   * @param callable $callback
   */
  public function __construct(string $pattern, $callback)
  {
    $this->setPattern($pattern);
    $this->setCallback($callback);
  }

  /**
   * __invoke
   * @param RequestInterface $request
   * @param ResponseInterface $response
   * @return mixed
   */
  public function __invoke(RequestInterface $request, ResponseInterface $response)
  {
    return call_user_func($this->callback);
  }
}
