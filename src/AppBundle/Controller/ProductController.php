<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use AppBundle\Entity\Product;

/**
 * Description of ProductController
 *
 * @author Rafał
 */
class ProductController extends Controller {

    /**
     * @Route("/cms/panel/product/create", name="product_create") 
     */
    public function createProductAction(Request $request) {

        $product = new Product();

        $form = $this->createFormBuilder($product)
                ->add('title', TextType::class, array(
                    'attr' => array('class' => 'form-control'),
                ))
                ->add('descript', TextareaType::class, array(
                    'attr' => array('class' => 'form-control'),
                ))
                ->add('Dodaj Produkt', SubmitType::class, array(
                    'attr' => array('class' => 'btn btn-info btn-block'),
                ))
                ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $product = $form->getData();

            //dump($product); die();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($product);
            $entityManager->flush();

            return $this->redirectToRoute('cms_panel');
        }

        return $this->render('cms/create.html.twig', [
                    'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/", name="homepage") 
     */
    public function allProductAction() {

        $produkty = $this->getDoctrine()->getRepository('AppBundle:Product')->findAll();

        // dump($produkty); die();

        return $this->render('karcher/index.html.twig', [
                    'produkty' => $produkty
        ]);
    }

}
