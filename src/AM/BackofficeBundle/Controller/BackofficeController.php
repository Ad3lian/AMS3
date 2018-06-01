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
    public function usersAction($id)
    {
        $users = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('AMBackofficeBundle:Users')
            ->findBy(
                array('id' => $id),
                null,
                null,
                null
            )
        ;

        return $this->render('AMBackofficeBundle:Backoffice:mesInformations.html.twig', array(
            'users' => $users
        ));
    }
    public function changeusersAction($id)
    {
        $users = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('AMBackofficeBundle:Users')
            ->findBy(
                array('id' => $id),
                null,
                null,
                null
            )
        ;

        return $this->render('AMBackofficeBundle:Backoffice:mesInformations.html.twig', array(
            'users' => $users
        ));
    }
    public function addpostAction()
    {
        return $this->render('AMBackofficeBundle:Backoffice:ajoutArticle.html.twig');
    }
    public function aboutmeAction()
    {
        $myabouts = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('AMBackofficeBundle:AboutMe')
            ->findAll()
        ;

        return $this->render('AMBackofficeBundle:Backoffice:manager_AboutMe.html.twig', array(
            'myabouts' => $myabouts
        ));
    }
    public function mypostsAction()
    {
        $myposts = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('AMBackofficeBundle:Posts')
            ->findAll()
        ;

        return $this->render('AMBackofficeBundle:Backoffice:mesPublications.html.twig', array(
            'myposts' => $myposts
        ));
    }
    public function changemypostAction()
    {
        $myposts = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('AMBackofficeBundle:Posts')
            ->findAll()
        ;

        return $this->render('AMBackofficeBundle:Backoffice:mesPublications.html.twig', array(
            'myposts' => $myposts
        ));
    }
    public function usertempAction()
    {
        $userstemp = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('AMBackofficeBundle:Usertemp')
            ->findAll()
        ;

        return $this->render('AMBackofficeBundle:Backoffice:usersTemp.html.twig', array(
            'userstemp' => $userstemp
        ));
    }
    public function removeusertempAction($id)
    {
        $userstemp = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('AMBackofficeBundle:Usertemp')
            ->findAll()
        ;

        return $this->render('AMBackofficeBundle:Backoffice:usersTemp.html.twig', array(
            'userstemp' => $userstemp
        ));
    }
    public function mailAction()
    {
        $emails = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('AMBackofficeBundle:Email')
            ->findAll()
        ;

        return $this->render('AMBackofficeBundle:Backoffice:messagerie.html.twig', array(
            'emails' => $emails
        ));
    }
}