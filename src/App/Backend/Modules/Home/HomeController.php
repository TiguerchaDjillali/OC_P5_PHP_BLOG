<?php

namespace App\Backend\Modules\Home;


use GuzzleHttp\Psr7\Request;

class HomeController extends \OpenFram\BackController
{
    public function executeIndex(Request $request)
    {

        $this->page->addVar('title', 'Dashobord');


        $manager = $this->managers->getManagerOf('Post');

        $this->page->addVar('postsList', $manager->getList());
        $this->page->addVar('postsNumber', $manager->count());
        $this->page->addVar('request', $request);

    }

}
