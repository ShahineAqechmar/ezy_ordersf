<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Product;
use AppBundle\Form\ProductType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ProductController extends Controller
{
    /**
     * @param Request $request
     *
     * @return Response
     *
     * @Route("/P", name="productadd")
     */

    public function addProductAction(Request $request)
    {
    // Creation d'un product
    $product = new Product();
        //on récupère le formulaire
        $form = $this->createForm(ProductType::class,$product);

        //lien entre le contenu du formulaire et la requête passé lors de la soumission du formulaire
        $form->handleRequest($request);

        //verification de la soumission du formulaire et de sa validation
        if ($form->isSubmitted() && $form->isValid()) {

            // $file stores the uploaded picture file
            /** @var UploadedFile $file */
            $file = $product->getPicture();

            // Generate a unique name for the file before saving it
            $fileName = md5(uniqid()).'.'.$file->guessExtension();

            // Move the file to the directory where brochures are stored
            $file->move(
                $this->container->getParameter('pictures_directory'),
                $fileName
            );

            // Update the 'brochure' property to store the PDF file name
            // instead of its contents
            $product->setPicture($fileName);


            //recuperation de l'entity manager de doctrine
            $em = $this->getDoctrine()->getManager();
            $em->persist($product);
            $em->flush();

            //on retourne une réponse simple
            return new response ('Product Added');

        }

        //generation du Html
        $formView = $form->createView();

        //on rend la vue
        return $this->render('core/management/productADD.html.twig',array('form'=>$formView));
    }
}