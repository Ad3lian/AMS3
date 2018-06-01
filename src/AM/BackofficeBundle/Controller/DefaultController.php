<?php

namespace AM\BackofficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('AMBackofficeBundle:Default:index.html.twig');
    }
}
