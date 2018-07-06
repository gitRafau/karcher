<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * ProductImages
 *
 * @ORM\Table(name="product_images")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProductImagesRepository")
 */
class ProductImages {

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="productSku", type="string", length=15, unique=true)
     */
    private $productSku;

    /**
     * @var string
     *
     * @ORM\Column(name="files", type="string", length=255)
     */
    private $files;

    /**
     * @var int
     *
     * @ORM\Column(name="dateCreated", type="integer", nullable=true)
     */
    private $dateCreated;

    /**
     * Class Contructor
     * 
     * @param array $options
     * @return void 
     */
    public function __construct() {
        
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set productSku
     *
     * @param string $productSku
     *
     * @return ProductImages
     */
    public function setProductSku($productSku) {
        $this->productSku = $productSku;

        return $this;
    }

    /**
     * Get productSku
     *
     * @return string
     */
    public function getProductSku() {
        return $this->productSku;
    }

    /**
     * Set files
     *
     * @param string $files
     *
     * @return ProductImages
     */
    public function setFiles($files) {
        $this->files = $files;

        return $this;
    }

    /**
     * Get files
     *
     * @return string
     */
    public function getFiles() {
        return $this->files;
    }

    /**
     * Set dateCreated
     *
     * @param integer $dateCreated
     *
     * @return ProductImages
     */
    public function setDateCreated($dateCreated) {
        $this->dateCreated = $dateCreated;

        return $this;
    }

    /**
     * Get dateCreated
     *
     * @return int
     */
    public function getDateCreated() {
        return $this->dateCreated;
    }

}
