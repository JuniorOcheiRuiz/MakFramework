<?php
namespace Makframework\Http;

use Makframework\Core\Object;

/**
 * Body Http
 */
class Body extends Object
{
  /**
   *File contents the content of body
   *@var resource
   */
  protected $file;

  /**
   *Filename
   *@var string
   */
  protected $filename;

  /**
   *Max memory
   *Is the maximum amount of data to keep in memory before using a temporary file, in bytes.
   *@var int
   */
  protected const MAX_MEMORY = 500000;

  /**
   *Contructor class
   *
   */
  public function __construct(string $body)
  {
    $this->filename = 'php://temp';
    $this->file = fopen($this->filename.'/maxmemory:'.self::MAX_MEMORY, 'r+');
    $this->write($body);
  }

  /**
   *Write
   *@param string $string
   *@return int
   */
  public function write(string $string) : int
  {
    if(($bytes = fwrite($this->file, $string)) === false)
    {
      throw new HttpException("Error of writing");
      return 0;
    }

    return $bytes;
  }

  /**
   *Read
   *@param int $bytes
   *@return string
   */
  public function read(int $bytes) : string
  {
    $this->seek(0);
    if(($string = fread($this->file, $bytes)) === false)
    {
      throw new HttpException("Error Processing Request");
      return '';
    }

    return $string;
  }

  public function clear() : bool
  {
    return ftruncate($this->file, 0);
  }

  /**
   *Seek
   *@param int $offset
   */
  public function seek(int $offset, int $whence = SEEK_SET) : int
  {
    return fseek($this->file, $offset, $whence);
  }

  public function getContents() : string
  {
    $this->seek(0);
    if(($contents = stream_get_contents($this->file)) === false)
    {
      throw new HttpException("Error getting contents");
      return '';
    }

    return $contents;
  }

  /**
   *Get Size
   *@return int
   */
  public function getSize() : int
  {
    $stat = fstat($this->file);
    return isset($stat['size']) ? $stat['size'] : 0;
  }

  /**
   *Get Meta data
   *@return array
   */
  protected function getMetaData() : array
  {
    return stream_get_meta_data($this->file);
  }

  public function toString() : string
  {
    try {
      $contents = $this->getContents();
    } catch (HttpException $e) {
      $contents = '';
    }

    return $contents;
  }


  public function __destruct()
  {
    fclose($this->file);
  }
}
