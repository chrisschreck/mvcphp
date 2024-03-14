<?php

namespace app\models\entity;

use app\core\Module;
use app\config\Settings;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="multimedia")
 */
class Multimedia {

    /** 
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    protected $id;
     /** 
     * @ORM\Column(type="string") 
     */
    public $name;

    /** 
     * @ORM\Column(type="date", nullable=true) 
     */
    public $start_date;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    public $end_date;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    public $type;

    function __construct(string $name, string $path, $start_date = NULL, $end_date = NULL, string $type)
    {
        $this->name = $name;
        $this->path = $path;
        $this->start_date = $start_date;
        $this->end_date = $end_date;
        $this->type = $type;
    }

    function getId() {
        return $this->id;
    }

    function getName() {
        return $this->name;
    }

    function setName(string $name) {
        $this->name = $name;
    }

    function getType() {
        return $this->type;
    }

    function setType(string $type) {
        $this->type = $type;
    }

    function getStartDate() {
        if(!is_null($this->start_date)) {
            return $this->start_date->format("Y-m-d");
        }
    }

    function setStartDate($start_date) {
        $this->start_date = $start_date;
    }

    function getEndDate() {
        if(!is_null($this->end_date)) {
            return $this->end_date->format("Y-m-d");
        }
    }

    function setEndDate($end_date) {
        $this->end_date = $end_date;
    } 
}