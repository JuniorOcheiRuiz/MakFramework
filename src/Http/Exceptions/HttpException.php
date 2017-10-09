<?php
namespace Makframework\Http\Exceptions;


/**
 * HttpException
 */
class HttpException extends \RuntimeException
{
  public function __construct($httpStatus)
  {
    parent::__construct('', $httpStatus);
  }
}
