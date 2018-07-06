<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ProductImageController extends Controller {

    /**
     * Upload Product Image(s)
     *
     * @Route("cms/product/create", name="gallery")
     *
     * @access public
     * @param Request $request
     * @return Object
     * */
    public function uploadInitAction(Request $request) {

        $files = $request->files->get('files');
        $sku = $request->request->get('productSku');

        $uploaded = false;
        $message = null;
        $count = $countValid = 0;

        $mimeTypes = array('jpeg', 'jpg', 'png', 'gif', 'bmp');

        if (!empty($files)) {
            for ($count; $count < count($files); $count++) {
                if (in_array($files[$count]->guessClientExtension(), $mimeTypes))
                    $countValid++;
            }
            if ($countValid == count($files))
                $uploaded = $this->uploadExec($sku, $files);
        }

        if ($uploaded)
            $message = "Wszystkie zdjęcia zostały wrzucone!";
        else
            $message = "Wybrane zdjęcie(a) nie zostały wrzucone!";


        return $this->json(
                [
                 'uploaded' => $uploaded,
                            'message' => $message
                ]
        );
    }

    /**
     * Performs Actual File Upload
     * 
     * @param string $sku
     * @param array $args
     * @return Boolean
     * 
     */
    private function uploadExec($sku, $args = array()) {
        /**
         * Make sure this is a new product without images saved yet
         */
        if ($this->hasImages($sku))
            return FALSE;

        $count = 0;
        $image_files = [];
        $doctrine = $this->getDoctrine()->getManager();

        $uploadDir = $this->getParameter('images_directory') . DIRECTORY_SEPARATOR . $sku . DIRECTORY_SEPARATOR;

        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0775, TRUE);
        }

        if (!empty($args) && count($args) > 0) {
            for ($count; $count < count($args); $count++) {
                $filename[$count] = $sku . '_' . $count . '.' . $args[$count]->guessClientExtension();

                if (!file_exists($uploadDir . $filename[$count])) {
                    if ($args[$count]->move($uploadDir, $filename[$count])) {
                        $image_files[$count]['file'] = $filename[$count];
                        $image_files[$count]['file_size'] = $args[$count]->getClientSize();
                        //$image_files[$count]['file_location'] = $uploadDir;
                    }
                }
            }

            $jsonEncodeFiles = json_encode($image_files);
            /*
             * Persist Uploaded Image(s) to the Database
             */
            $productImages = new ProductImages();
            $productImages->setProductSku($sku);
            $productImages->setFiles($jsonEncodeFiles);
            $productImages->setDateCreated(strtotime(date('y-m-d h:i:s a')));

            $doctrine->persist($productImages);
            $doctrine->flush();

            if (NULL != $productImages->getId())
                return TRUE;
        }

        return FALSE;
    }

}
