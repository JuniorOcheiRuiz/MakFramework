<?php
namespace Makframework\Http;

use InvalidArgumentException;
use Makframework\Core\Object;

/**
 * Message Http
 */
abstract class Message extends Object
{
    /**
   *Protocol versions allowed
   *@var string[]
   */
  protected static $protocolVersionsAllowed = ['1.0','1.1','2.0'];

  /**
   *Protocol version
   *@var string
   */
  protected $protocolVersion = '1.1';

  /**
   *Headers
   *@var \Makframework\Http\Headers
   */
  protected $headers;

  /**
   *Body
   *@var \Makframework\Http\Body
   */
  protected $body;


  /**
   *Get Headers
   *@return \Makframework\Http\Headers
   */
  public function getHeaders() : Headers
  {
      return $this->headers;
  }


  /**
   *Set Headers
   *@param string[] $headers
   *@return void
   */
  public function setHeaders(array $headers) : Message
  {
      $clone = $this->clone();
      $clone->headers->replace($headers);
  }

  /**
   *Get protocol version
   *@return string
   */
  public function getProtocolVersion() : string
  {
      return $this->protocolVersion;
  }

  /**
   *Set protocol version
   *@param string $version
   *@return void
   */
  public function setProtocolVersion(string $version) : Message
  {
      if (in_array($version, $this->protocolVersionsAllowed)) {
          $this->protocolVersion = $version;
          return $this;
      } else {
          throw new InvalidArgumentException("Invalid protocol version.");
          return $this;
      }
  }

    public function getBody() : Body
    {
        return $this->body;
    }

    public function setBody(string $body) : Message
    {
      $this->body->clear();
      $this->body->write($body);
      return $this;
    }
}
