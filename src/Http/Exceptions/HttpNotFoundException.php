<?php
namespace Makframework\Http\Exceptions;

use Makframework\Http\Interfaces\ResponseInterface;

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
