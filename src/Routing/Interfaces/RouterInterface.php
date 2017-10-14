<?php
namespace Makframework\Routing\Interfaces;

/**
 * RouterInterface
 */
interface RouterInterface extends RouteCollectionInterface
{
  /**
   * run
   *
   * @param bool $debugMode
   *
   * @throws HttpException
   *
   * @return void
   */
  public function run(bool $debugMode = false) : void;

}
