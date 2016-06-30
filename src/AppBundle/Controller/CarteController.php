<?php
/**
 * Created by PhpStorm.
 * User: Administrateur
 * Date: 13/06/2016
 * Time: 13:53
 */

namespace AppBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Product;
use Symfony\Component\HttpFoundation\Request;


class CarteController extends Controller
{
    /**
     *@Route("/Carte", name="carte")
     */
    public function afficheAction(Request $request)
    {
        $session = $request->getSession();
        $em = $this->getDoctrine()->getManager();
        $product = $em->getRepository('AppBundle:Product')->findAll();

        if (!$product) throw $this->createNotFoundException('La page n\'existe pas.');

        if ($session->has('panier'))
            $panier = $session->get('panier');
        else
            $panier = false;

        return $this->render('core/Carte.html.twig', array('product' => $product,
            'panier' => $panier));
    }
    }

//public function afficheAction(){
//$em=$this->getDoctrine()->getManager();
//$product=$em->getRepository('AppBundle:Product')->findAll();
//return $this->render('core/Carte.html.twig',array(
//    'product'=>$product,
//));
//}
