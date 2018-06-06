<?php

namespace AppBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use AppBundle\Entity\Product;


/**
 * Description of ProductController
 *
 * @author Rafał
 */
class ProductController extends Controller {   
    
    /**
     *@Route("/cms/panel/product/create", name="product_create") 
     */
    public function createProductAction(){
        
        $em = $this->getDoctrine()->getManager();
        
        $title = 'Myjka Ciśnieniowa';
        $descript = 'Najlepsza na rynku!';
        
        
        $product = new Product();
        $product ->setTitle($title);
        $product->setDescript($descript);
        
        $em->persist($product);
        $em->flush();
        
        
        return $this->render('cms/create.html.twig');
    }
    
    /**
     *@Route("/", name="homepage") 
     */
    public function allProductAction(){
        
        $produkty = $this->getDoctrine()->getRepository('AppBundle:Product')->findAll();
        
       // dump($produkty); die();
        
        return $this->render('karcher/index.html.twig', [
            'produkty' => $produkty
        ]);
    }
}
