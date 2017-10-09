<?php
namespace Makframework\Routing;
use Psr\Http\Message\RequestInterface;
use Makframework\Http\Interfaces\ResponseInterface;


/**
 *
 */
trait MiddlewareTrait
{
  public function __invoke(RequestInterface $request, ResponseInterface $response)
  {
    
  }
}
