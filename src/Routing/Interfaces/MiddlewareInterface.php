<?php
namespace Makframework\Routing\Interfaces;
use Psr\Http\Message\RequestInterface;
use Makframework\Http\Interfaces\ResponseInterface;

/**
 * MiddlewareInterface
 */
interface MiddlewareInterface
{
  public function __invoke(RequestInterface $request, ResponseInterface $response, $next);
}
