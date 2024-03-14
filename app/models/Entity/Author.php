<?php

namespace app\models\entity;

use app\core\Module;
use app\config\Settings;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity
 * @ORM\Table(name="author")
 */
class Author {

    /** 
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    protected $id;
     /** 
     * @ORM\Column(type="string") 
     */
    protected $name;
     /** 
     * @ORM\Column(type="string") 
     */
    protected $lastname;
     /** 
     * @ORM\Column(type="string") 
     */
    protected $ressort;
     /** 
     * @ORM\Column(type="string") 
     */
    protected $email;
    /** 
     * @ORM\Column(type="string") 
     */
    protected $newspaper;
     /** 
     * @ORM\Column(type="string") 
     */
    protected $picture_path;

    function __construct(string $name, string $lastname, string $ressort, string $email, string $newspaper, string $picture) {
        $this->name = $name;
        $this->lastname = $lastname;
        $this->ressort = $ressort;
        $this->email = $email;
        $this->newspaper = $newspaper;
        $this->picture_path = $picture;
    }

    /* SETTER */
    function setName(string $name) { $this->name = $name; }
    function setLastname(string $lastname) { $this->lastname = $lastname; }
    function setRessort(string $ressort) {  $this->ressort = $ressort; }
    function setEmail(string $email) { $this->email = $email; }
    function setNewspaper(string $newspaper) { $this->newspaper = $newspaper; }
    function setPicPath($picture_path) { $this->picture_path = $picture_path; }
    function getPicPath() { return $this->picture_path; }

    /* GETTER */
    function getId() { return $this->id; }
    function getName() { return $this->name; }
    function getLastname() { return $this->lastname; }
    function getRessort() { return $this->ressort; }
    function getEmail() { return $this->email; }
    function getNewspaper() { return $this->newspaper; }
}