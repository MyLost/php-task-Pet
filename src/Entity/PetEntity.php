<?php

namespace App\Entity;

use DateTime;

/**
 * Class Pet
 * @package App\Entity
 * @ORM\Table(name="pets")
 * @ORM\Entity
 */
class PetEntity
{
    /**
     * @var int/null
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string/null
     *
     * @ORM\Column(name="name", type="string", length="25")
     */
    private $name;

    /**
     * @var string/null
     *
     * @ORM\Column(name="description", type="string", length="255")
     */
    private $description;

    /**
     *
     * @ORM\Column(name="$record_date", type="datetime" ,  options={"default": "CURRENT_TIMESTAMP"})
     */
    private $recordDate;

    /**
     * @var string/null
     *
     * @ORM\Column(name="breed", type="string")
     */
    private $breed;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return DateTime
     */
    public function getRecordDate(): DateTime
    {
        return $this->recordDate;
    }

    /**
     * @param string $recordDate
     */
    public function setRecordDate(DateTime $recordDate): void
    {
        $this->recordDate = $recordDate;
    }

    /**
     * @return string
     */
    public function getBreed(): string
    {
        return $this->breed;
    }

    /**
     * @param string $breed
     */
    public function setBreed(string $breed): void
    {
        $this->breed = $breed;
    }

}