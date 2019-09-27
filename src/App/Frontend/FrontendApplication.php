<?php

namespace App\Frontend;

use OpenFram\Application;
use function GuzzleHttp\Psr7\stream_for;
use function Http\Response\send;

class FrontendApplication extends Application
{

    /**
     * @return void
     */
    public function run(): void
    {
        echo $this->request->getUri()->getPath();
        send($this->response->withBody(stream_for("<h1> Hello from FrontendApplication</h1>")));
        var_dump($this->request);
    }
}
