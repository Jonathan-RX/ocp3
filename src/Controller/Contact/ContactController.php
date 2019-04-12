<?php

namespace App\Controller\Contact;

use App\Services\PHPSession;

class ContactController 
{
    /**
     * Load the contact page
     */
    public function contact(){
        require('src/View/contact/contact.php');
    }
}