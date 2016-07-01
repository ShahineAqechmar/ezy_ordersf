<?php
namespace AppBundle\Controller;

use AppBundle\Entity\Adress;
use AppBundle\Form\AdressType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class AdressController extends Controller
{
    /**
     * @Route("/adress", name="adress")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function adressAction(Request $request)
    {
        // Creation d'une adresse
        $adress = new Adress();
        //on récupère le formulaire
        $form = $this->createForm(AdressType::class,$adress);

        //lien entre le contenu du formulaire et la requête passé lors de la soumission du formulaire
        $form->handleRequest($request);

        //verification de la soumission du formulaire et de sa validation
        if ($form->isSubmitted() && $form->isValid()) {

            //gestion user
            //$userid = $this->getUser()->getId();
            $adress->setUser($this->getUser());

            //recuperation de l'entity manager de doctrine
            $em = $this->getDoctrine()->getManager();
            $em->persist($adress);
            $em->flush();

            //on retourne une réponse simple
            return new response ('Adress Added');

        }

        //generation du Html
        $formView = $form->createView();

        //on rend la vue
        return $this->render('Core/Compte/adressAdd.html.twig',array('form'=>$formView));
    }
}