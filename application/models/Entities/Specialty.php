<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * Specialty
 *
 * @ORM\Table(name="specialty")
 * @ORM\Entity
 */
class Specialty
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="specialty_type", type="string", length=200, nullable=false)
     */
    private $specialtyType;


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
     * Set specialtyType
     *
     * @param string $specialtyType
     * @return Specialty
     */
    public function setSpecialtyType($specialtyType)
    {
        $this->specialtyType = $specialtyType;
    
        return $this;
    }

    /**
     * Get specialtyType
     *
     * @return string 
     */
    public function getSpecialtyType()
    {
        return $this->specialtyType;
    }
}