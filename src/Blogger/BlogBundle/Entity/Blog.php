<?php
/**
 * Created by PhpStorm.
 * User: YZub
 * Date: 08.06.2017
 * Time: 9:33
 */


namespace Blogger\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="blog")
 */

class Blog
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column
     * @ORM\Column(type="integer")
     */
    protected $category_id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $name;

    /**
     * @ORM\Column(type="text")
     */
    protected $content;

    /**
     * @ORM\Column(type="blob")
     */
    protected $file;



    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Blog
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set content
     *
     * @param string $content
     * @return Blog
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string 
     */
    public function getContent($length = null)
    {
        if (false === is_null($length) && $length > 0)
            return substr($this->content, 0, $length);
        else
            return $this->content;
    }

    /**
     * Set file
     *
     * @param string $file
     * @return Blog
     */
    public function setFile($file)
    {
        $this->file = $file;

        return $this;
    }

    /**
     * Get file
     *
     * @return string 
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * Set category_id
     *
     * @param string $categoryId
     * @return Blog
     */
    public function setCategoryId($categoryId)
    {
        $this->category_id = $categoryId;

        return $this;
    }

    /**
     * Get category_id
     *
     * @return string 
     */
    public function getCategoryId()
    {
        return $this->category_id;
    }
}
