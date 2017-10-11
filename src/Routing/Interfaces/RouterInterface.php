<?php
namespace Makframework\Routing\Interfaces;

/**
 * RouterInterface
 */
interface RouterInterface extends RouterMethodsInterface
{


  /**
   * getRoute
   *
   * @param string $pattern
   * @return RouteInterface
   */
  public function getRoute(string $pattern) : RouteInterface;

  /**
   * getRoutes
   *
   * @return RouteInterface[]
   */
  public function getRoutes() : array;

  /**
   * setRoute
   *
   * @param array $methods
   * @param string $pattern
   *
   * @return RouterInterface
   */
  public function setRoute() : RouterInterface;

  /**
   * setRoutes
   *
   * @param RouteInterface[]
   * @return RouterInterface
   */
  public function setRoutes(array $routes) : RouterInterface;


  /**
   * run
   *
   * @param bool $debugMode
   *
   * @throws HttpException
   *
   * @return void
   */
  public function run(bool $debugMode = false) : void;

}
