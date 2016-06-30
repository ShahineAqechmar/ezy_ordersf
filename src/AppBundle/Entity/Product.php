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
class Product
{
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
     * @ORM\Column(name="Product_Name", type="string", length=255, unique=true)
     */
    private $productName;

    /**
     * @var string
     *
     * @ORM\Column(name="Product_Description", type="string", length=255, nullable=true)
     */
    private $productDescription;

    /**
     * @var bool
     *
     * @ORM\Column(name="Disponibility", type="boolean")
     */
    private $disponibility;

    /**
     * @var string
     *
     * @ORM\Column(name="Unitary_Price", type="decimal", precision=10, scale=2)
     */
    private $unitaryPrice;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Product_Sheet_Creation", type="datetime")
     */
    private $productSheetCreation;

    /**
     * @var picture
     *
     * @ORM\Column(name="picture", type="string", length=255)
     *
     * @Assert\NotBlank(message="Veuillez Uploader une image")
     */
    private $picture;



    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }


    /**
     * @var Category
     *
     * -- Contraintes de validation
     * @Assert\Valid()
     * @Assert\Type(type="AppBundle\Entity\Category")
     *
     * -- Liaison bidirectionelle entre Product et Category
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Category",inversedBy="product")
     *
     */
    private $Category;

    public function __construct()
    {
        $this->productSheetCreation = new \DateTime('Now');

    }
    
    /**
     * Set productName
     *
     * @param string $productName
     *
     * @return Product
     */
    public function setProductName($productName)
    {
        $this->productName = $productName;

        return $this;
    }

    /**
     * Get productName
     *
     * @return string
     */
    public function getProductName()
    {
        return $this->productName;
    }

    /**
     * Set productDescription
     *
     * @param string $productDescription
     *
     * @return Product
     */
    public function setProductDescription($productDescription)
    {
        $this->productDescription = $productDescription;

        return $this;
    }

    /**
     * Get productDescription
     *
     * @return string
     */
    public function getProductDescription()
    {
        return $this->productDescription;
    }

    /**
     * Set disponibility
     *
     * @param boolean $disponibility
     *
     * @return Product
     */
    public function setDisponibility($disponibility)
    {
        $this->disponibility = $disponibility;

        return $this;
    }

    /**
     * Get disponibility
     *
     * @return bool
     */
    public function getDisponibility()
    {
        return $this->disponibility;
    }

    /**
     * Set unitaryPrice
     *
     * @param string $unitaryPrice
     *
     * @return Product
     */
    public function setUnitaryPrice($unitaryPrice)
    {
        $this->unitaryPrice = $unitaryPrice;

        return $this;
    }

    /**
     * Get unitaryPrice
     *
     * @return string
     */
    public function getUnitaryPrice()
    {
        return $this->unitaryPrice;
    }

    /**
     * Set productSheetCreation
     *
     * @param \DateTime $productSheetCreation
     *
     * @return Product
     */
    public function setProductSheetCreation($productSheetCreation)
    {
        $this->productSheetCreation = $productSheetCreation;

        return $this;
    }

    /**
     * Get productSheetCreation
     *
     * @return \DateTime
     */
    public function getProductSheetCreation()
    {
        return $this->productSheetCreation;
    }

    /**
     * Set category
     *
     * @param \AppBundle\Entity\Category $category
     *
     * @return Product
     */
    public function setCategory(\AppBundle\Entity\Category $category = null)
    {
        $this->Category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \AppBundle\Entity\Category
     */
    public function getCategory()
    {
        return $this->Category;
    }

    /**
     * Add commandLine
     *
     * @param \AppBundle\Entity\Command_Line $commandLine
     *
     * @return Product
     */
    public function addCommandLine(\AppBundle\Entity\Command_Line $commandLine)
    {
        $this->Command_line[] = $commandLine;

        return $this;
    }


    /**
     * Set picture
     *
     * @param string $picture
     *
     * @return Product
     */
    public function setPicture($picture)
    {
        $this->picture = $picture;

        return $this;
    }

    /**
     * Get picture
     *
     * @return string
     */
    public function getPicture()
    {
        return $this->picture;
    }
}
