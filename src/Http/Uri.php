<?php
namespace Makframework\Http;
use InvalidArgumentException;
use Makframework\Core\ArrayCollection;

/**
 * Uri
 */
class Uri extends ArrayCollection
{

  public function __construct(string $uri = '')
  {
    $uri = parse_url($uri);
    parent::__construct($uri);
  }

  public static function createFromGlobals()
  {
    $url = (empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] === 'off') ? 'http' : 'https';
    $url .= '://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

    return new static($url);
  }

  public function getScheme() : string
  {
    return $this->get('scheme', '');
  }

  public function setScheme(string $scheme) : void
  {
    $this->set('scheme', $scheme);
  }

  public function getAuthority() : string
  {
    $userInfo = $this->getUserInfo();
    $port = $this->getPort();

    return ($userInfo != '' ? $userInfo.'@' : '').$this->get('host', '').($port ? ':'.$port : '');
  }

  public function getUserInfo() : string
  {
    $user = $this->get('user', '');
    $password = $this->get('password');

    return $user . ($password ? ':'.$password : '');
  }

  public function setUserInfo(string $user, string $password = null) : void
  {
    $this->set('user', $user);
    if($password != null) $this->set('password', $password);
  }

  public function getHost() : string
  {
    return $this->get('host', '');
  }

  public function setHost(string $host) : void
  {
    $this->set('host', $host);
  }

  public function getPort() : ?int
  {
    return $this->get('port');
  }

  public function setPort(?int $port) : void
  {
    if(is_null($port) || $port >= 1 && $port <= 65535)
    {
      $this->set('port', $port);
    }
    else
    {
      throw new InvalidArgumentException("Invalid port: Uri port must be null or an interger between 1 and 65535 inclusive.");

    }
  }

  public function getPath() : string
  {
    return $this->get('path', '');
  }

  public function setPath(string $path) : void
  {
    $this->set('path', $path);
  }

  public function getQuery() : string
  {
    return $this->get('query', '');
  }

  public function setQuery(string $query) : void
  {
    $this->set('query', $query);
  }

  public function getFragment() : string
  {
    return $this->get('fragment', '');
  }

  public function setFragment(string $fragment) : void
  {
    $this->set('fragment', $fragment);
  }

  public function toString() : string
  {
    $scheme = $this->getScheme();
    $authority = $this->getAuthority();
    $path = $this->getPath();
    $query = $this->getQuery();
    $fragment = $this->getFragment();

    return ($scheme ? $scheme.':' : '')
          .($authority ? '//'.$authority : '')
          .$path
          .($query ? '?'.$query : '')
          .($fragment ? '#'.$fragment : '');
  }
}
