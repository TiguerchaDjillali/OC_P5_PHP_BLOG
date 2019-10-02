<?php
namespace App\Frontend\Modules\Home;

use Entity\Contact;
use FormBuilder\ContactFormBuilder;
use GuzzleHttp\Psr7\Request;
use OpenFram\BackController;
use OpenFram\Managers;

class HomeController extends BackController
{
    public function executeShow(Request $request){
        $this->page->addVar('title', $this->getModule());
        $manager = $this->managers->getManagerOf('post');
        $postsList = $manager->getList(['limit'=> 4, 'visible'=> 1]);
        $this->page->addVar('postsList', $postsList);
        $this->page->addVar('pageType', 'profile-page');

        $this->executeContact($request);

    }

    public function executeContact(Request $request)
    {
        $this->managers = new Managers('','');
        $manager = $this->managers->getManagerOf('contact');

        if($request->getMethod()=='POST'){

            echo 'Il faut traiter le formaulaire + redirection';

        }else{
            $contact = new Contact();
        }

        $formBuilder = new ContactFormBuilder($contact);
        $formBuilder->build();

        $form = $formBuilder->getFrom();
        $this->page->addVar('form', $form->createView());
    }

}