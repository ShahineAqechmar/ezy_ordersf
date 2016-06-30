<?php

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Product;
use Symfony\Component\HttpFoundation\Session;


class PanierController extends Controller
{
//ajouter fonctions : addProduit,getProduit,supprimerProduit   La gestion des sessions se fait ici

//on recupere le panier dans la session via le constructeur et l'objet est stocké en session
// (ou appel à la Bdd via utilisation d'id)


   // public function menuAction()
   // {
   //     $session = $this->container->get('session');
   //     if (!$session->has('panier'))
   //         $articles = 0;
   //     else
   //         $articles = count($session->get('panier'));
   //
   //     return $this->render('Core/Panier/Panier.html.twig', array('articles' => $articles));
   // }

    public function menuAction(Request $request)
    {
        //$session = $this->container->get('session');
        $session = $request->getSession();
        if (!$session->has('panier'))
            $articles = 0;
        else
            $articles = count($session->get('panier'));

        return $this->render('Core/Panier/panier.html.twig', array('articles' => $articles));
    }

    public function supprimerAction($id,Request $request)
    {
        //$session = $this->container->get('session');
        $session = $request->getSession();
        $panier = $session->get('panier');

        if (array_key_exists($id, $panier))
        {
            unset($panier[$id]);
            $session->set('panier',$panier);
            $this->get('session')->getFlashBag()->add('success','Article supprimé avec succès');
        }

        return $this->redirect($this->generateUrl('panier'));
    }

    
    public function ajouterAction($id,Request $request)
    {

        //$session = $this->container->get('session');
        $session = $request->getSession();

        if (!$session->has('panier')) $session->set('panier',array());
        $panier = $session->get('panier');


        if (array_key_exists($id, $panier)) {
            if ($request->query->get('qte') != null) $panier[$id] = $request->query->get('qte');
            $this->get('session')->getFlashBag()->add('success','Quantité modifié avec succès');
        } else {
            if ($request->query->get('qte') != null)
                $panier[$id] = $request->query->get('qte');
            else
                $panier[$id] = 1;

            $this->get('session')->getFlashBag()->add('success','Article ajouté avec succès');
        }

        $session->set('panier',$panier);


        return $this->redirect($this->generateUrl('panier'));
    }

    public function panierAction(Request $request)
    {
        //$session = $this->container->get('session');
        $session = $request->getSession();
        if (!$session->has('panier')) $session->set('panier', array());

        $em = $this->getDoctrine()->getManager();
        $produits = $em->getRepository('AppBundle:Product')->findArray(array_keys($session->get('panier')));

        return $this->render('Core/Panier/Panier.html.twig', array('produits' => $produits,
            'panier' => $session->get('panier')));
    }
}
