<?php

namespace app\models\entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use app\config\Settings;
use app\core\Auth;
use \DateTime;

/**
 * @ORM\Entity
 * @ORM\Table(name="package")
 */
class Package {

    /** 
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    public $id;
     /** 
     * @ORM\Column(type="string") 
     */
    public $name;

    /**
     * @ORM\ManyToMany(targetEntity="Multimedia")
     * @ORM\JoinTable(name="multimedia_allocation",
     *       joinColumns={@ORM\JoinColumn(name="multimedia_id", referencedColumnName="id")},
     *       inverseJoinColumns={@ORM\JoinColumn(name="package_id", referencedColumnName="id")})                         
     */
    private $multimedia = [];

    /**
     * @ORM\ManyToMany(targetEntity="Rss")
     * @ORM\JoinTable(name="rss_allocation",
     *       joinColumns={@ORM\JoinColumn(name="package_id", referencedColumnName="id")},
     *       inverseJoinColumns={@ORM\JoinColumn(name="rss_id", referencedColumnName="id")})                         
     */
    public $rss = [];

    /**
     * @ORM\ManyToMany(targetEntity="Author")
     * @ORM\JoinTable(name="author_allocation",
     *       joinColumns={@ORM\JoinColumn(name="author_id", referencedColumnName="id")},
     *       inverseJoinColumns={@ORM\JoinColumn(name="package_id", referencedColumnName="id")})                         
     */
    public $author = [];

    const MAX_PICTURE_COUNT = 0;
    const MAX_VIDEO_COUNT = 0;
    const MAX_AUTHOR_COUNT = 0;

    function __construct(string $name)
    {
        $this->multimedia = new ArrayCollection();
        $this->name = $name;
        $this->rss = new ArrayCollection();
        $this->author = new ArrayCollection();
    }

    function getId() {
        return $this->id;
    }

    function getName() {
        return $this->name;
    }

    function setName($name) {
        $this->name = $name;
    }

    function getAuthors() {
        return $this->author;
    }

    function getMultimedia() {
        return $this->multimedia;
    }

    function getVideos() {
        return $this->video;
    }

    function getRss() {
        return $this->rss;
    }

    function addMultimedia(string $id, Multimedia $multimedia) {
        $this->multimedia[$id] = $multimedia;
    }

    function addRss(string $id,Rss $rss) {
        $this->rss[$id] = $rss;
    }

    function addAuthor(string $id,Author $author) {
        $this->author[$id] = $author;
    }

    function removeAuthor(Author $object) {
        $this->author->removeElement($object);
    }

    function removeRss(Rss $object) {
        $this->rss->removeElement($object);
    }

    function removeMultimedia(Multimedia $object) {
        $this->multimedia->removeElement($object);
    }

    function getStartDate() {
        return $this->start_date;
    }

    function setStartDate(string $start_date) {
        $this->start_date = $start_date;
    }

    function getEndDate() {
        return $this->end_date;
    }

    function setEndDate(string $end_date) {
        $this->end_date = $end_date;
    }

    // function setAuthors(array $authors) {
    //     foreach($authors as $author) {
    //         $thi
    //     }
    // }

    function getMultimediaIds() {
        $multimedia_ids = [];
        if(!empty($this->multimedia)) {
            foreach($this->multimedia as $object) {
                $multimedia_ids[] = $object->getId();
            }
            return $multimedia_ids;
        }
    }

    function getAuthorIds() {
        $author_ids = [];
        if(!empty($this->author)) {
            foreach($this->author as $object) {
                $author_ids[] = $object->getId();
            }
            return $author_ids;
        }
    }

    function getRssIds() {
        $rss_ids = [];
        if(!empty($this->rss)) {
            foreach($this->rss as $object) {
                $rss_ids[] = $object->getId();
            }
            return $rss_ids;
        }
    }

}