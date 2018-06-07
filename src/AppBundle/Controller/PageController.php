<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use AppBundle\Entity\Product;

class PageController extends Controller {

    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request) {
        
        return $this->render('karcher/index.html.twig');
    }
    
    /**
     * @Route("/product/{id}", name="show_product")
     */
    public function showProductAction(Request $request, $id) {
        
        $product = $this->getDoctrine()->getRepository('AppBundle:Product')->findBy(array('id' => $id));
        
        return $this->render('karcher/show.html.twig', [
            'product' => $product
        ]);
    }

     
}
