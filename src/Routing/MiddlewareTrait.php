<?php
namespace Makframework\Routing;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;


/**
 *
 */
trait MiddlewareTrait
{
  public function __invoke(RequestInterface $request, ResponseInterface $response)
  {
    
  }
}
