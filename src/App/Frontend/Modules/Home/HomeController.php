<?php
namespace App\Frontend\Modules\Home;

use GuzzleHttp\Psr7\Request;
use OpenFram\BackController;

class HomeController extends BackController
{
    public function executeShow(Request $request){
        $this->page->addVar('title', $this->getModule());
        $manager = $this->managers->getManagerOf('post');
        $postsList = $manager->getList(['limit'=> 4, 'visible'=> 1]);
        $this->page->addVar('postsList', $postsList);
        $this->page->addVar('pageType', 'profile-page');

    }

}