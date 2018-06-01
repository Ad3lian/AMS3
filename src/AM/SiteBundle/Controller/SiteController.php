<?php

namespace AM\SiteBundle\Controller;

use AM\SiteBundle\Entity\AboutMe;
use AM\SiteBundle\Entity\Posts;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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
    public function inscriptionAction()
    {
        return $this->render('AMSiteBundle:Site:inscription.html.twig');
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
}
