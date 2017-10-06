<?php
namespace Makframework\Routing\Interfaces;

/**
 * MiddlewareInterface
 */
interface MiddlewareInterface
{
  public function __invoke($request, $response, $next);
}
