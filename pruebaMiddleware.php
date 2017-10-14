<?php
use Makframework\Routing\Interfaces\MiddlewareInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 *
 */
class PruebaMiddleware implements MiddlewareInterface
{

  public function __invoke(RequestInterface $request, ResponseInterface $response, callable $next)
  {
    $response->getBody()->write('Antes de ejecutar el callback de la ruta.');

    $response = $next($request,$response);

    $response->getBody()->write('Despues de ejecutar el callback de la ruta.');

    return $response;
  }
}
