<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use AppBundle\Entity\Product;

class DefaultController extends Controller {

    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request) {
        // replace this example code with whatever you need
        return $this->render('karcher/index.html.twig');
    }

    /**
     * @Route("/cms", name="cms_login")
     */
    public function indexCMSAction(Request $request) {

        return $this->render('cms/login.html.twig');
    }

    /**
     * @Route("/cms/panel", name="cms_panel")
     */
    public function panelCMSAction(Request $request) {
       
        $produkty = $this->getDoctrine()->getRepository('AppBundle:Product')->findAll();        

        return $this->render('cms/panel.html.twig', [
                    'produkty' => $produkty
        ]);
    }

}
