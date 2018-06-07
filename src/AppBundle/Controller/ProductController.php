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
     * @Route("/cms/product/create", name="product_create") 
     */
    public function createProductAction(Request $request) {

        $product = new Product();

        $form = $this->createFormBuilder($product)
                ->add('title', TextType::class, array(
                    'attr' => array('class' => 'form-control'),
                ))
                ->add('descript', TextareaType::class, array(
                    'attr' => array('class' => 'form-control')
                ))
                ->add('Dodaj Produkt', SubmitType::class, array(
                    'attr' => array('class' => 'btn btn-info btn-block', 'style' => 'margin-top: 20px;'),
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

    /**
     * @Route("cms/product/update/{id}", name="update_product")
     */
    public function updateProductAction(Request $request, $id) {

        $product = new Product();


        $product = $this->getDoctrine()->getRepository('AppBundle:Product')->find($id);

        if (!$product) {
            throw $this->createNotFoundException(
                    'Nie ma takie produktu numerze: ' . $id
            );
        }

        $form = $this->createFormBuilder($product)
                ->add('title', TextType::class, array(
                    'attr' => array('class' => 'form-control'),
                ))
                ->add('descript', TextareaType::class, array(
                    'attr' => array('class' => 'form-control')
                ))
                ->add('Edytuj Produkt', SubmitType::class, array(
                    'attr' => array('class' => 'btn btn-warning btn-block', 'style' => 'margin-top: 20px;'),
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


        return $this->render('cms/update.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/cms/produkt/delete/{id}", name="delete_product") 
     */
    public function deleteProductAction($id, Request $request) {

        $em = $this->getDoctrine()->getManager();

        $product = $em->getRepository('AppBundle:Product')->findOneBy(array('id' => $id));

        $em->remove($product);
        $em->flush();

        return $this->redirectToRoute('cms_panel');
    }

}
