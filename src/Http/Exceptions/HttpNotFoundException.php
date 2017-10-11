<?php
namespace Makframework\Http\Exceptions;

use Psr\Http\Message\ResponseInterface;

/**
 * HttpException
 */
class HttpNotFoundException extends HttpException
{
  public function __construct($message = '')
  {
    parent::__construct('', ResponseInterface::NOT_FOUND);
    $this->message = 'Page not found';
  }
}
