<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Category
 *
 * @ORM\Table(name="category")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CategoryRepository")
 */
class Category
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
     * @ORM\Column(name="Category_Name", type="string", length=255, unique=true)
     *
     * @Assert\NotBlank(message="Merci de remplir le nom de catégorie")
     */
    private $categoryName;

    /**
     * @var string
     *
     * @ORM\Column(name="Category_Description", type="string", length=255)
     */
    private $categoryDescription;

    /**
     * @var Product
     *
     * -- Liaison bidirectionelle entre Category et Product
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Category", mappedBy="category")
     *
     *
     */
    private $Product;


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
     * Set categoryName
     *
     * @param string $categoryName
     *
     * @return Category
     */
    public function setCategoryName($categoryName)
    {
        $this->categoryName = $categoryName;

        return $this;
    }

    /**
     * Get categoryName
     *
     * @return string
     */
    public function getCategoryName()
    {
        return $this->categoryName;
    }

    /**
     * Set categoryDescription
     *
     * @param string $categoryDescription
     *
     * @return Category
     */
    public function setCategoryDescription($categoryDescription)
    {
        $this->categoryDescription = $categoryDescription;

        return $this;
    }

    /**
     * Get categoryDescription
     *
     * @return string
     */
    public function getCategoryDescription()
    {
        return $this->categoryDescription;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->Product = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add product
     *
     * @param \AppBundle\Entity\Category $product
     *
     * @return Category
     */
    public function addProduct(\AppBundle\Entity\Category $product)
    {
        $this->Product[] = $product;

        return $this;
    }

    /**
     * Remove product
     *
     * @param \AppBundle\Entity\Category $product
     */
    public function removeProduct(\AppBundle\Entity\Category $product)
    {
        $this->Product->removeElement($product);
    }

    /**
     * Get product
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProduct()
    {
        return $this->Product;
    }
}
