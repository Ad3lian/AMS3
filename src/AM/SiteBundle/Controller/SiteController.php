<?php

namespace AM\SiteBundle\Controller;

use AM\SiteBundle\Entity\AboutMe;
use AM\SiteBundle\Entity\Posts;
use AM\SiteBundle\Entity\Register;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class SiteController extends Controller
{
    public function indexAction()
    {
        $listAboutMe = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('AMSiteBundle:AboutMe')
            ->findAll()
        ;
        $noPano = true;
        return $this->render('AMSiteBundle:Site:index.html.twig', array(
            'aboutMe' => $listAboutMe,
            'noPano' => $noPano
        ));
    }
    public function menuAction()
    {
        return $this->render('AMSiteBundle:Site:menu.html.twig');
    }
    public function listPostsViewAction()
    {
        $listPosts = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('AMSiteBundle:Posts')
            ->findBy(
                array('author' => 'Adrien'),
                array('creationDate' => 'desc'),
                null,
                null
            )
        ;

        $noPano = true;
        return $this->render('AMSiteBundle:Site:listPostsView.html.twig', array(
            'posts' => $listPosts,
            'noPano' => $noPano
        ));
    }
    public function postViewAction($id)
    {
        $post = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('AMSiteBundle:Posts')
            ->find($id)
        ;

        $listComments = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('AMSiteBundle:Comments')
            ->findBy(
                array('postId' => $id),
                null,
                null,
                null
            )
        ;

        $noPano = false;
        return $this->render('AMSiteBundle:Site:postView.html.twig', array(
            'post' => $post,
            'listComments' => $listComments,
            'noPano' => $noPano
        ));
    }
    public function cvAction()
    {
        $noPano = false;

        return $this->render('AMSiteBundle:Site:cv.html.twig', array(
            'noPano' => $noPano
        ));
    }
    public function contactAction()
    {
        $noPano = false;
        return $this->render('AMSiteBundle:Site:contact.html.twig', array(
            'noPano' => $noPano
        ));
    }
    public function connexionAction()
    {

    }
    public function inscriptionAction(Request $request)
    {
        //Création de l'objet
        $inscription = new Register();

        //On crée le FormBuilder
        $formBuilder = $this->get('form.factory')->createBuilder(FormType::class, $inscription);

        //On ajoute les champs
        $formBuilder
            ->Add('name',      TextType::class)
            ->Add('firstname', TextType::class)
            ->Add('email',     TextType::class)
            ->Add('password',  TextType::class)
            ->Add('save',      SubmitType::class)
        ;

        //génération du formulaire
        $form = $formBuilder->getForm();

        //si la requête est en POST
        if($request->isMethod('POST')) {
            $form->handleRequest($request);

            if($form->isValid()) {
                //On récupère l'EntityManager
                $em = $this->getDoctrine()->getManager();

                //On présiste l'entité
                $em->persist($inscription);

                //On flush tout ce qui est persisté
                $em->flush();

                $request->getSession()->getFlashBag()->add('notice', 'Inscription bien enregistrée.');

                return $this->render('AMSiteBundle:Site:attenteValidation.html.twig');
            }
        }

        return $this->render('AMSiteBundle:Site:inscription.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}
