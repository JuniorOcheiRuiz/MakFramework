<?php
namespace Makframework\Router;

use Makframework\Http\Request;
use Makframework\Http\Response;

/**
 *Router
 */
class Router extends RouteCollection
{
    /**
   *Request object
   *@var \Makframework\Http\Request
   */
  protected $request;

  /**
   *Request Resource
   *@var string|callable
   */
  protected $resource;

  /**
   *Request Parameters
   *@var array
   */
  protected $parameters;


    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function getParameters() : array
    {
        return $this->parameters;
    }

  /**
   *Run router
   *@return void
   */
  public function run() : Response
  {
      $response = ControllerResolver::get($this->request->getPath());

      return $response;
  }
}
