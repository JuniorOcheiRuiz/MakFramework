<?php
namespace Makframework\Routing\Interfaces;
use Closure;

/**
 * RouteInterface
 */
interface RouteInterface extends RoutableInterface
{
  /**
   * @var string[]
   */
  protected $methods = [];

  /**
   * @var string
   */
  protected $pattern;

  /**
   * @var callable|Closure
   */
  protected $callback;

  /**
   * @var string
   */
  protected $name;

  /**
   * @var MiddlewareInterface[]
   */
  protected $middleware = [];


  /**
   * class constructor
   * @param string[] $methods
   * @param string $pattern
   * @param callable|\Closure $callback
   * @return RouteInterface
   */
  public function __construct(array $methods, string $pattern, $callback);

  public function setPattern(string $pattern) : RouteInterface;

  public function getPattern() : string;

  public function setName(string $name) : RouteInterface;

  public function getName() : string;

  public function setCallback(string $pattern) : RouteInterface;

  public function getCallback() : string;

  public function addMiddleware
}
