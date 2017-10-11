<?php
namespace Makframework\Http\Exceptions;

use Psr\Http\Message\ResponseInterface;

/**
 * HttpException
 */
class HttpMethodNotAllowedException extends HttpException
{
  public function __construct($message = '')
  {
    parent::__construct('', ResponseInterface::METHOD_NOT_ALLOWED);
    $this->message = 'Method not allowed';
  }
}
