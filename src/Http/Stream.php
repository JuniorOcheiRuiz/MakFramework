<?php
namespace Makframework\Http;

use http\Exception\RuntimeException;
use http\Exception\InvalidArgumentException;
use Psr\Http\Message\StreamInterface;

/**
 * Stream
 */
class Stream extends StreamInterface
{
  protected $resource = null;

  protected $size = 0;

  protected $meta_data;

  protected static $modes = [
    'read' => ['r' => true, 'r+' => true, 'w+' => true, 'a+' => true, 'x+' => true, 'c+' => true],
    'write' => ['r+' => true, 'w' => true, 'a' => true, 'a+' => true, 'x' => true, 'x+' => true, 'c' => true, 'c+' => true]
  ];


  public function __construct($resource)
  {
    $this->setResource($resource);
  }

  /**
   * setResource
   * @param resource
   * @return Stream
   */
  public function setResource($resource) : Stream
  {
    if (!is_resource($resource)) {
        throw new InvalidArgumentException('Invalid resource.');

    }

    $this->resource = $resource;

    return $this;
  }

  /**
   * Reads all data from the stream into a string, from the beginning to end.
   *
   * This method MUST attempt to seek to the beginning of the stream before
   * reading data and read the stream until the end is reached.
   *
   * Warning: This could attempt to load a large amount of data into memory.
   *
   * This method MUST NOT raise an exception in order to conform with PHP's
   * string casting operations.
   *
   * @see http://php.net/manual/en/language.oop5.magic.php#object.tostring
   * @return string
   */
  public function __toString()
  {
    if ($this->resource == null) '';

    try {
      $this->rewind();
      return $this->getContents();
    } catch(\Exception $e) {
      return '';
    }
  }

  /**
   * Closes the stream and any underlying resources.
   *
   * @return void
   */
  public function close()
  {
    fclose($this->resource);
  }

  /**
   * Separates any underlying resources from the stream.
   *
   * After the stream has been detached, the stream is in an unusable state.
   *
   * @return resource|null Underlying PHP stream, if any
   */
  public function detach()
  {
    $resource = $this->resource;
    $this->resource = null;

    return $resource;
  }

  /**
   * Get the size of the stream if known.
   *
   * @return int|null Returns the size in bytes if known, or null if unknown.
   */
  public function getSize()
  {
    if (!$this->size && $this->resource != null) {
      $stats = fstat();
    }

    return $this->size;
  }

  /**
   * Returns the current position of the file read/write pointer
   *
   * @return int Position of the file pointer
   * @throws \RuntimeException on error.
   */
  public function tell()
  {
    $position = 0;

    if ($this->resource === null || ($position = ftell($this->resource)) === false) {
      throw new RuntimeException('Could not get the position of the pointer in stream.');
    }

    return $position;
  }

  /**
   * Returns true if the stream is at the end of the stream.
   *
   * @return bool
   */
  public function eof()
  {
    return $this->resource !== null ? feof($this->resource) : true;
  }

  /**
   * Returns whether or not the stream is seekable.
   *
   * @return bool
   */
  public function isSeekable()
  {
    if ($this->meta_data === null) {
      $seekable = $this->getMetadata('seekable');
    } else {
      $mseekable = $this->meta_data['seekable'];
    }

    return $seekable;
  }

  /**
   * Seek to a position in the stream.
   *
   * @link http://www.php.net/manual/en/function.fseek.php
   * @param int $offset Stream offset
   * @param int $whence Specifies how the cursor position will be calculated
   *     based on the seek offset. Valid values are identical to the built-in
   *     PHP $whence values for `fseek()`.  SEEK_SET: Set position equal to
   *     offset bytes SEEK_CUR: Set position to current location plus offset
   *     SEEK_END: Set position to end-of-stream plus offset.
   * @throws \RuntimeException on failure.
   */
  public function seek($offset, $whence = SEEK_SET)
  {
    if (!$this->isSeekable() || fseek($this->resource, $offset, $whence) !== 0)
      throw new RuntimeException('Could not seek in stream.');
  }

  /**
   * Seek to the beginning of the stream.
   *
   * If the stream is not seekable, this method will raise an exception;
   * otherwise, it will perform a seek(0).
   *
   * @see seek()
   * @link http://www.php.net/manual/en/function.fseek.php
   * @throws \RuntimeException on failure.
   */
  public function rewind()
  {
    $this->seek(0);
  }

  /**
   * Returns whether or not the stream is writable.
   *
   * @return bool
   */
  public function isWritable()
  {
    if ($this->meta_data === null) {
      $mode = $this->getMetadata('mode');
    } else {
      $mode = $this->meta_data['mode'];
    }

    return isset(self::$modes['write'][$mode]);
  }

  /**
   * Write data to the stream.
   *
   * @param string $string The string that is to be written.
   * @return int Returns the number of bytes written to the stream.
   * @throws \RuntimeException on failure.
   */
  public function write($string)
  {
    $bytes = 0;

    if (!$this->isWritable() || ($bytes = fwrite($this->resource, $string)) === false) {
      throw new RuntimeException('Could not write to stream');
    }

    return $bytes;
  }

  /**
   * Returns whether or not the stream is readable.
   *
   * @return bool
   */
  public function isReadable()
  {
    if ($this->meta_data === null) {
      $mode = $this->getMetadata('mode');
    } else {
      $mode = $this->meta_data['mode'];
    }

    return isset(self::$modes['read'][$mode]);
  }

  /**
   * Read data from the stream.
   *
   * @param int $length Read up to $length bytes from the object and return
   *     them. Fewer than $length bytes may be returned if underlying stream
   *     call returns fewer bytes.
   * @return string Returns the data read from the stream, or an empty string
   *     if no bytes are available.
   * @throws \RuntimeException if an error occurs.
   */
  public function read($length)
  {
    if (!$this->isReadable() || ($data = fread($length)) === false) {
      throw new RuntimeException('Error reading the stream.');
    }

    return $data;
  }

  /**
   * Returns the remaining contents in a string
   *
   * @return string
   * @throws \RuntimeException if unable to read or an error occurs while
   *     reading.
   */
  public function getContents()
  {
    if (!$this->isReadable() || ($contents = stream_get_contents()) === false) {
      throw new RuntimeException("Can't read the current stream.");

    }

    return $contents;
  }


  /**
   * Get stream metadata as an associative array or retrieve a specific key.
   *
   * The keys returned are identical to the keys returned from PHP's
   * stream_get_meta_data() function.
   *
   * @link http://php.net/manual/en/function.stream-get-meta-data.php
   * @param string $key Specific metadata to retrieve.
   * @return array|mixed|null Returns an associative array if no key is
   *     provided. Returns a specific key value if a key is provided and the
   *     value is found, or null if the key is not found.
   */
  public function getMetadata($key = null)
  {
    $this->meta_data = stream_get_meta_data($this->resource);

    if ($key === null) {
      return $this->meta_data;
    }

    return isset($this->meta_data[$key]) ? $this->meta_data[$key] : null;
  }
}
