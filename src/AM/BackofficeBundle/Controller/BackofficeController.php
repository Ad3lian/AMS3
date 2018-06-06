<?php

namespace AM\BackofficeBundle\Controller;

use AM\BackofficeBundle\Entity\Users;
use AM\BackofficeBundle\Entity\Posts;
use AM\BackofficeBundle\Entity\Email;
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
    public function changeusersAction($id, REQUEST $request)
    {
        $nom = $request->get('nom');
        $prenom = $request->get('prenom');
        $email = $request->get('email');

        $em = $this->getDoctrine()->getManager();

        $advert = $em->getRepository('AMBackofficeBundle:Users')->find($id);

        $advert->setName($nom);
        $advert->setFirstname($prenom);
        $advert->setEmail($email);

        $em->flush();

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
    public function addaddpostAction(REQUEST $request)
    {
        $title = $request->get('title');
        $content = $request->get('content');

        $advert = new Posts();
        $advert->setTitle($title);
        $advert->setContent($content);

        $em = $this->getDoctrine()->getManager();

        $em->persist($advert);

        $em->flush();

        return $this->redirectToRoute('am_backoffice_myposts');
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
            ->findBy(
                array('author' => 'Adrien'),
                array('creationDate' => 'desc'),
                null,
                null
            );

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
            ->findBy(
                array(),
                array('registerDate' => 'desc'),
                null,
                null
            )
        ;

        return $this->render('AMBackofficeBundle:Backoffice:usersTemp.html.twig', array(
            'userstemp' => $userstemp
        ));
    }
    public function removeusertempAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $advert = $em->getRepository('AMBackofficeBundle:Usertemp')->find($id);

        $em->remove($advert);
        $em->flush();

        $userstemp = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('AMBackofficeBundle:Usertemp')
            ->findBy(
                array(),
                array('registerDate' => 'desc'),
                null,
                null
            )
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
            ->findBy(
                array(),
                array('emailDate' => 'desc'),
                null,
                null
            )
        ;

        return $this->render('AMBackofficeBundle:Backoffice:messagerie.html.twig', array(
            'emails' => $emails
        ));
    }
    public function removemailAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $advert = $em->getRepository('AMBackofficeBundle:Email')->find($id);

        $em->remove($advert);
        $em->flush();

        $emails = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('AMBackofficeBundle:Email')
            ->findBy(
                array(),
                array('emailDate' => 'desc'),
                null,
                null
            )
        ;

        return $this->render('AMBackofficeBundle:Backoffice:messagerie.html.twig', array(
            'emails' => $emails
        ));
    }
}