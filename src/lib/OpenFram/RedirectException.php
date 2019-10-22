<?php


namespace OpenFram;


use GuzzleHttp\Psr7\Response;
use function Http\Response\send;

class RedirectException extends \Exception
{
    const PERMANENT = 301;
    const FOUND = 302;
    const SEE_OTHER = 303;
    const PROXY = 305;
    const TEMPORARY = 307;

    private static $messages = array(
        301 => 'Moved Permanently',
        302 => 'Found',
        303 => 'See Other',
        305 => 'Use Proxy',
        307 => 'Temporary Redirect',
    );

    protected $url;

    public function __construct($url, $code = 301, $message = null)
    {
        parent::__construct($message
            ? (string)$message
            : static::$messages[$code], (int)$code
        );

        $this->url = (string)$url;
    }

    public function getURL()
    {
        return $this->url;
    }

    public function run()
    {
        $response = ( new Response())
            ->withStatus($this->getCode(), static::$messages[$this->getCode()])
            ->withHeader('Location', $this->url);
        send($response);
    }
}