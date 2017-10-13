<?php
namespace Makframework\Http;


/**
 * Body
 */
class Body extends Stream
{

  public function __construct(string $string = '')
  {
    $resource = fopen('php://temp', 'w+');

    parent::__construct($resource);

    $this->write($string);
  }
}
