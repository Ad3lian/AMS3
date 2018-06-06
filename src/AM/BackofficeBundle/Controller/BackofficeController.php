<?php

namespace AM\BackofficeBundle\Controller;

use AM\BackofficeBundle\AMBackofficeBundle;
use AM\BackofficeBundle\Entity\Users;
use AM\BackofficeBundle\Entity\Usertemp;
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
    public function changemyaboutAction($id, REQUEST $request)
    {
        $title = $request->get('titre');
        $content = $request->get('message');

        $em = $this->getDoctrine()->getManager();

        $advert = $em->getRepository('AMBackofficeBundle:AboutMe')->find($id);

        $advert->setTitle($title);
        $advert->setContent($content);


        $em->flush();

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
    public function changemypostAction($id, REQUEST $request)
    {
        $title = $request->get('titre');
        $content = $request->get('message');

        $em = $this->getDoctrine()->getManager();

        $advert = $em->getRepository('AMBackofficeBundle:Posts')->find($id);

        $advert->setTitle($title);
        $advert->setContent($content);


        $em->flush();

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
    public function deletemypostAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $advert = $em->getRepository('AMBackofficeBundle:Posts')->find($id);

        $em->remove($advert);
        $em->flush();

        $myposts = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('AMBackofficeBundle:Posts')
            ->findBy(
                array('author' => 'Adrien'),
                array('creationDate' => 'desc'),
                null,
                null
            )
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
    public function validateusertempAction($id)
    {
        //Connexion à la base temporaire
        $em = $this->getDoctrine()->getManager();

        $advert = $em->getRepository('AMBackofficeBundle:Usertemp')->find($id);

        //récupération des données du compte temporaire
        $name = $advert->getName();
        $firstname = $advert->getFirstname();
        $email = $advert->getEmail();
        $password = $advert->getPassword();
        $registerdate = $advert->getRegisterDate();


        //création du compte permanent
        $advert1 = new Users();
        $advert1->setName($name);
        $advert1->setFirstname($firstname);
        $advert1->setEmail($email);
        $advert1->setPassword($password);
        $advert1->setRegisterDate($registerdate);

        $em1 = $this->getDoctrine()->getManager();

        $em1->persist($advert1);

        $em1->flush();

        //suppression du l'inscription temporaire
        $em->remove($advert);

        $em->flush();
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
    public function sendmailAction($firstname)
    {
        $message = (new \Swift_Message('Hello Email'))
            ->setFrom('adrien-martin@hotmail.fr')
            ->setTo('adrien-martin@hotmail.fr')
            ->setBody(
                $this->renderView(
                    'AMBackofficeBundle:Emails:registration.html.twig',
                    array('firstname' => $firstname)
                ),
                'text/html'
            )
            ;
        $this->get('mailer')->send($message);

        return $this->redirectToRoute('am_backoffice_mymails');
    }
}