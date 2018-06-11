<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Product
 *
 * @ORM\Table(name="product")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProductRepository")
 */
class Product {

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
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="descript", type="text")
     */
    private $descript;

    /**
     * Get id
     *
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Product
     */
    public function setTitle($title) {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle() {
        return $this->title;
    }

    /**
     * Set descript
     *
     * @param string $descript
     *
     * @return Product
     */
    public function setDescript($descript) {
        $this->descript = $descript;

        return $this;
    }

    /**
     * Get descript
     *
     * @return string
     */
    public function getDescript() {
        return $this->descript;
    }

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank(message="Uwaga, wrzucany plik musi być w formacie PDF!")
     * @Assert\File(mimeTypes={ "application/pdf" })
     */
    private $brochure;

    public function getBrochure() {
        return $this->brochure;
    }

    public function setBrochure($brochure) {
        $this->brochure = $brochure;

        return $this;
    }

    /**
     * @var string     
     * @Assert\Image()
     * @ORM\Column(name="image", type="string", length=255)  
     */
    private $image;

    public function getImage() {
        return $this->image;
    }

    public function setImage($image) {
        $this->image = $image;

        return $this;
    }
}
