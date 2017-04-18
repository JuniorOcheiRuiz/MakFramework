<?php
namespace Makframework\Http;

/**
 * Http codes
 */
interface CodesResponseInterface
{
  //1×× Informational
const CONTINUE = 100;
const SWITCHING_PROTOCOLS = 101;
CONST PROCESSING = 102;
  //2×× Success
CONST OK = 200;
CONST CREATED = 201;
CONST ACCEPTED = 202;
CONST NON_AUTHORITATIVE_INFORMATION = 203;
CONST NO_CONTENT = 204;
CONST RESET_CONTENT = 205;
CONST PARTIAL_CONTENT = 206;
CONST MULTI_STATUS = 207;
CONST ALREADY_REPORTED = 208;
CONST IM_USED = 226;

  //3×× Redirection
CONST MULTIPLE_CHOICES = 300;
CONST MOVED_PERMANENTLY =  301;
CONST FOUND = 302;
CONST SEE_OTHER = 303;
CONST NOT_MODIFIED = 304;
CONST USE_PROXY = 305;
CONST TEMPORARY_REDIRECT =  307;
CONST PERMANENT_REDIRECT = 308;
  //4×× Client Error
CONST BAD_REQUEST = 400;
CONST UNAUTHORIZED = 401;
CONST PAYMENT_REQUIRED = 402;
CONST FORBIDDEN =  403;
CONST NOT_FOUND = 404;
CONST METHOD_NOT_ALLOWED = 405;
CONST NOT_ACCEPTABLE = 406;
CONST PROXY_AUTHENTICATION_REQUIRED = 407;
CONST REQUEST_TIMEOUT = 408;
CONST CONFLICT = 409;
CONST GONE = 410;
CONST LENGTH_REQUIRED = 411;
CONST PRECONDITION_FAILED = 412;
CONST PAYLOAD_TOO_LARGE = 413;
CONST REQUEST_URI_TOO_LONG = 414;
CONST UNSUPPORTED_MEDIA_TYPE = 415;
CONST REQUESTED_RANGE_NOT_SATISFIABLE = 416;
CONST EXPECTATION_FAILED = 417;
CONST I_AM_A_TEAPOT = 418;
CONST MISDIRECTED_REQUEST = 421;
CONST UNPROCESSABLE_ENTITY = 422;
CONST LOCKED = 423;
CONST FAILED_DEPENDENCY = 424;
CONST UPGRADE_REQUIRED = 426;
CONST PRECONDITION_REQUIRED = 428;
CONST TOO_MANY_REQUESTS = 429;
CONST REQUEST_HEADER_FIELDS_TOO_LARGE = 431;
CONST CONNECTION_CLOSED_WITHOUT_RESPONSE = 444;
CONST UNAVAILABLE_FOR_LEGAL_REASONS = 451;
CONST CLIENT_CLOSED_REQUEST = 499;
//5×× Server Error
CONST INTERNAL_SERVER_ERROR = 500;
CONST NOT_IMPLEMENTED = 501;
CONST BAD_GATEWAY = 502;
CONST SERVICE_UNAVAILABLE = 503;
CONST GATEWAY_TIMEOUT = 504;
CONST HTTP_VERSION_NOT_SUPPORTED = 505;
CONST VARIANT_ALSO_NEGOTIATES = 506;
CONST INSUFFICIENT_STORAGE = 507;
CONST LOOP_DETECTED = 508;
CONST NOT_EXTENDED = 510;
CONST NETWORK_AUTHENTICATION_REQUIRED = 511;
CONST NETWORK_CONNECT_TIMEOUT_ERROR = 599;
}


/**
 * Response Http
 */
class Response extends Message implements CodesResponseInterface
{
  /**
   *Code response
   *@var int
   */
  protected $statusCode;

  /**
   *Reason Phrase
   *@var string
   */
  protected $reasonPhrase;


  public function __construct(string $body, int $statusCode = Response::OK, array $headers = [])
  {
    $this->body = new Body($body);
    $this->statusCode = $statusCode;
    $this->headers = new Headers($headers);
  }

  public function getStatusCode() : int
  {
    return $this->statusCode;
  }

  public function withStatusCode(int $statusCode) : Message
  {
    //Falta comprobrar si es el estado introducido esta dentro del rango valido
    $this->statusCode = $statusCode;
    return $this;
  }

  public function getReasonPhrase() : int
  {
    return $this->reasonPhrase;
  }

  public function withReasonPhrase(string $reasonPhrase) : Message
  {
    $this->reasonPhrase = $reasonPhrase;
    return $this;
  }

  public function withCookie(string $name, string $value = '', int $expire = 0, string $path = '', string $domain = '', bool $secure = false, bool $httponly = false) : Message
  {
    setcookie($name, $value, $expire, $path, $domain, $secure, $httponly);
  }

  public function withRedirect(string $url, int $status = null) : Message
  {
    $this->headers->set('Location', $url);

    if(is_null($status) && $this->getStatusCode() === 200)
    {
      $status = 302;
    }

    return $this->withStatusCode($status);
  }

  public function __clone()
  {
    $this->headers = clone $this->headers;
  }

  public function sendHeaders() : void
  {
    foreach ($this->headers->all() as $name => $value) {
      header(sprintf('%s: %s', $name, $value));
    }
  }

  public function sendBody() : void
  {
    echo $this->body->toString();
  }

  /**
   *Send
   *Sends the response
   *@return void
   */
  public function send() : void
  {
    $this->sendHeaders();
    $this->sendBody();
  }
}
