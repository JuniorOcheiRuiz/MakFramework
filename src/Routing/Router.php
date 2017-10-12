<?php
namespace Makframework\Routing;

use Makframework\Http\Exceptions\HttpException;
use Makframework\Http\Exceptions\HttpNotFoundException;
use Makframework\Http\Exceptions\HttpMethodNotAllowedException;
use Makframework\Routing\Exceptions\RouterException;
use Makframework\Routing\Interfaces\RouteInterface;
use Makframework\Routing\Interfaces\RouterInterface;
use Makframework\Routing\Interfaces\RoutableInterface;
use Makframework\Routing\Interfaces\MiddlewareInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 *
 */
class Router extends RouteCollection implements RouterInterface
{
  /**
   * @var string
   */
  protected $basePath = '';
  /**
   *  @var RouteInterface[]
   */
  protected $routes = [];

  /**
   * @var RequestInterface
   */
  protected $request;

  /**
   * @var ResponseInterface
   */
  protected $response;


  public function __construct(RequestInterface $request = null, ResponseInterface $response = null)
  {
    $this->request = $request;
    $this->response = $response;
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
   * @return RoutableInterface|null
   */
  protected function match(string $requestPath) : ?RoutableInterface
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
    } // end foreach

    // if not found match, return null
    return null;
  }


  /**
   * run
   *
   * @param bool $debugMode
   *
   * @throws HttpException
   *
   * @return void
   */
  public function run(bool $debugMode = false) : void
  {
    // get uri
    $uri = $this->request->getUri();

    // get path
    $path = $uri->getPath();

    // request path match with some route?
    $route = $this->match($path);

    if (!$route) {
      throw new HttpNotFoundException();
    }

    // get method
    $method = $this->request->getMethod();

    if ($route instanceof RouteInterface && !$route->hasMethod($method)) {
      throw new HttpMethodNotAllowedException();
    }

    $this->executeRoute($route);
  }

  protected function executeRoute(Routable $route)
  {
    $route->callStack();
  }

}
