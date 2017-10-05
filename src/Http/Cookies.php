<?php
namespace Makframework\Http;
use Makframework\Core\ArrayCollection;

/**
 * Cookies
 */
class Cookies extends ArrayCollection
{

  public function __construct(array $cookies)
  {
    parent::__construct($cookies);
  }

  public static function createFromGlobals() : Cookies
  {
    return new static($_COOKIE);
  }
}
