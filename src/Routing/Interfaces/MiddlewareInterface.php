<?php
namespace Makframework\Routing\Interfaces;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * MiddlewareInterface
 */
interface MiddlewareInterface
{
  public function __invoke(RequestInterface $request, ResponseInterface $response, callable $next);
}
