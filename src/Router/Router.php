<?php
namespace Makframework\Router;

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
     *Run router
     *@return void
     */
    public function run() : void
    {
      ControllerResolver::get($request->getPath());
    }
}
