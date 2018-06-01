<?php

namespace AM\BackofficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class BackofficeController extends Controller
{
    public function indexAction()
    {
        return $this->render('AMBackofficeBundle:Backoffice:backoffice.html.twig');
    }
}