<?php
namespace Makframework\Http;


/**
 * Body
 */
class Body extends Stream
{

  /**
   * Constructor class
   * @param string $string
   */
  public function __construct(string $string = '')
  {
    $resource = fopen('php://temp', 'w+');

    parent::__construct($resource);

    $this->write($string);
  }
}
