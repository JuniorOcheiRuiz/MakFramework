<?php
namespace Makframework\Http;

use Makframework\Core\ArrayCollection;

class Params extends ArrayCollection
{
    /**
   *Post
   *@var \Makframework\Core\ArrayCollection
   */
  protected $post;

  /**
   *Query
   *@var \Makframework\Core\ArrayCollection
   */
  protected $query;

  /**
   *Files
   *@var \Makframework\Core\ArrayCollection
   */
  protected $files;

  /**
   *Server
   *@var \Makframework\Core\ArrayCollection
   */
  protected $server;


    public function __construct(array $params)
    {
        parent::__construct($params);

        $this->post = new ArrayCollection($this->get('post', []));
        $this->query = new ArrayCollection($this->get('query', []));
        $this->files = new ArrayCollection($this->get('files', []));
        $this->server = new ArrayCollection($this->get('server', []));
    }

    public static function createFromGlobals() : Params
    {
      return new static([
        'post' => $_POST,
        'query' => $_GET,
        'files' => $_FILES,
        'server' => $_SERVER
      ]);
    }

    public function getPost() : ArrayCollection
    {
        return $this->post;
    }


    public function getQuery() : ArrayCollection
    {
        return $this->query;
    }


    public function getFiles() : ArrayCollection
    {
        return $this->files;
    }

    public function getServer() : ArrayCollection
    {
        return $this->server;
    }
}
