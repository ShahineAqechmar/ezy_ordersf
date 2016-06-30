<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Category;
use AppBundle\Form\CategoryType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CategoryController extends Controller
{
    /**
     * @param Request $request
     *
     * @return Response
     *
     * @Route("/CategoryAdd", name="categoryadd")
     */

    public function addCategoryAction(Request $request)
    {
    // Creation d'une category
    $category = new Category();
        //on récupère le formulaire
        $form = $this->createForm(CategoryType::class,$category);

        //lien entre le contenu du formulaire et la requête passé lors de la soumission du formulaire
        $form->handleRequest($request);

        //verification de la soumission du formulaire et de sa validation
        if ($form->isSubmitted() && $form->isValid()) {

            //recuperation de l'entity manager de doctrine
            $em = $this->getDoctrine()->getManager();
            $em->persist($category);
            $em->flush();

            //on retourne une réponse simple
            return new response ('Category Added');

        }

        //generation du Html
        $formView = $form->createView();

        //on rend la vue
        return $this->render('Core/Management/categoryAdd.html.twig',array('form'=>$formView));
    }
}