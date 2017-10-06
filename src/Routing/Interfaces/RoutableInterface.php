<?php
namespace Makframework\Routing\Interfaces;

/**
 *
 */
interface RoutableInterface
{
  public function setPattern(string $pattern) : RoutableInterface;

  public function getPattern(string $pattern) : string;

  public function setCallback(string $pattern) : RoutableInterface;

  public function getCallback(string $pattern) : string;

  public function addMiddleware() : RoutableInterface;

  public function getMiddlewares() : array;
}
