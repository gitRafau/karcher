<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Product;

class CmsController extends Controller {

    /**
     * @Route("/cms", name="cms_panel")
     */
    public function panelCMSAction(Request $request) {

        $produkty = $this->getDoctrine()->getRepository('AppBundle:Product')->findAll();

        
        
        return $this->render('cms/panel.html.twig', [
                    'produkty' => $produkty
        ]);

        
    }

}
