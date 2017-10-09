<?php
namespace Makframework\Http\Interfaces;

use Psr\Http\Message\ResponseInterface as PsrResponseInterface

/**
 * ResponseInterface
 */
interface ResponseInterface extends PsrResponseInterface
{
  const NOT_FOUND = 404;
}
