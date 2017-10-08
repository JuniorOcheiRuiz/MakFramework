<?php
namespace Makframework\Routing;

use Makframework\Routing\Exceptions\RouterException;
use Makframework\Routing\Interfaces\RouteInterface;
use Makframework\Routing\Interfaces\RouterInterface;

/**
 *
 */
class Router implements RouterInterface
{
  /**
   *  @var RouteInterface[]
   */
  protected $routes = [];


  protected $container;

  public function __construct()
  {

  }

  public function map(string $method, string $requestPath, $callable)
  {

  }

  protected function builtSegments(string $pattern) : array
  { //search of segments: \{([a-zA-Z]+)\}|\{([a-zA-Z]+:.+)\}
    $segments = [];
    preg_match_all('#\{(\w+|\w+:.+)\}#', $pattern, $matches, PREG_SET_ORDER);

    foreach ($matches as $match) {
      // segments: {example} or {example:[0-9]+}
      $match[1] = explode(':', $match[1]);

      if (isset($match[1][1])) {
        // {example:[0-9]+}
        $segments[] = $match[1][0];

        // {example:[0-9]+} -> ([0-9]+)
        $pattern = str_replace($match[0], '('.$match[1][1].')', $pattern);
      } else {
        // {example}
        $segments[] = $match[1][0];

        // {example} -> (.*)
        $pattern = str_replace($match[0], '(.*)', $pattern);
      }
    }//end foreach

    // return array with the pattern changed and the segments found
    return [$pattern, $segments];
  }

  /**
   * match
   *
   * @param string $requestPath /example/page/1
   *
   * @return RouteInterface|null
   */
  protected function match(string $requestPath) : ?RouteInterface
  {
    foreach ($this->routes as $pattern => $route) {
      [$pattern, $segments] = $this->builtSegments($pattern);

      if (preg_match('#^'.$pattern.'$#', $requestPath, $arguments)) {
        // remove full match of the array
        array_shift($arguments);

        // if segments and arguments do not match in number
        if (count($segments) != count($arguments))
          throw new RouterException(sprintf('Segments and arguments do not match in number.'));

        // Assign segments to arguments
        foreach ($segments as $index => $segment) {
          $arguments[$segment] = $arguments[$index];
          unset($arguments[$index]);
        }

        // set arguments in the route
        $route->setArguments($arguments);

        //return the route object
        return $route;
      }
    }

    // if not found match, return null
    return null;
  }

  public function run() : void;

}
