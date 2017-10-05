<?php
namespace Makframework\Core;

use ArrayIterator;
use IteratorAggregate;
use InvalidArgumentException;

/**
 *ArrayCollection
 */
class ArrayCollection extends Object implements IteratorAggregate
{
    /**
   *Array
   *@var array
   */
  protected $collection;

  /**
   *Construct class
   *@param array $array By default is empty []
   *@return void
   */
  public function __construct(array $array = [])
  {
      $this->collection = $array;
  }

  /**
   *Add
   *@param array $add
   *@return void
   */
  public function add(array $add) : void
  {
      $this->collection += $add;
  }

  /**
   *Set
   *@param int|string $key
   *@param mixed $value
   */
  public function set($key, $value) : void
  {
      $this->verifyTypeKey($key);
      $this->collection[$key] = $value;
  }

  /**
   *Get
   *@param int|string $key
   *@param mixed $default By default is null
   *@return mixed
   */
  public function get($key, $default = null)
  {
      if ($this->has($key)) {
          return $this->collection[$key];
      }

      return $default;
  }

  /**
   *All
   *Returns array
   *@return array
   */
  public function all() : array
  {
      return $this->collection;
  }

  /**
   *Replace
   *@param array $replace
   *@return void
   */
  public function replace(array $replace) : void
  {
      $this->collection = $replace;
  }

  /**
   *Remove
   *@param int|string $key
   *@return void
   */
  public function remove($key) : void
  {
      $this->verifyTypeKey($key);
      unset($this->collection[$key]);
  }

  /**
   *Has
   *Verify if exists the key
   *@param int|string $key
   *@return bool
   */
  public function has($key) : bool
  {
      $this->verifyTypeKey($key);

      return isset($this->collection[$key]);
  }

  /**
   *GetIterator
   *@return \ArrayIterator Object
   */
  public function getIterator() : ArrayIterator
  {
      return new ArrayIterator($this->collection);
  }

  /**
   *Is empty
   *Verify if is empty
   *@param int|string $key
   *@return bool
   */
  public function isEmpty($key) : bool
  {
      return empty($this->collection[$key]);
  }

  /**
   *@param string $type Format: "int" or also "int|string"
   *@param int|string $key
   */
  public function isType(string $type, $key) : bool
  {
      $type = explode('|', $type);

      return in_array(gettype($this->get($key)), $type);
  }

  /**
   *@param int|string $key
   *@return bool
   *@throws \InvalidArgumentException
   */
  protected function verifyTypeKey($key) : bool
  {
      if (is_int($key) || is_string($key)) {
          return true;
      }

      throw new InvalidArgumentException('$key can only be string or int');

      return false;
  }

  public function size() : int
  {
    return count($this->collection);
  }
}
