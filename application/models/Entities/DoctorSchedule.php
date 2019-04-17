<?php



use Doctrine\ORM\Mapping as ORM;

require_once(APPPATH . "models/Entities/Users.php");
require_once(APPPATH . "models/Entities/Specialty.php");
/**
 * DoctorSchedule
 *
 * @ORM\Table(name="doctor_schedule")
 * @ORM\Entity
 */
class DoctorSchedule
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
     * @ORM\Column(name="saturday", type="string", length=20, nullable=false)
     */
    private $saturday;

    /**
     * @var string
     *
     * @ORM\Column(name="sunday", type="string", length=20, nullable=false)
     */
    private $sunday;

    /**
     * @var string
     *
     * @ORM\Column(name="monday", type="string", length=20, nullable=false)
     */
    private $monday;

    /**
     * @var string
     *
     * @ORM\Column(name="tuesday", type="string", length=20, nullable=false)
     */
    private $tuesday;

    /**
     * @var string
     *
     * @ORM\Column(name="wednesday", type="string", length=20, nullable=false)
     */
    private $wednesday;

    /**
     * @var string
     *
     * @ORM\Column(name="thursday", type="string", length=20, nullable=false)
     */
    private $thursday;

    /**
     * @var string
     *
     * @ORM\Column(name="friday", type="string", length=20, nullable=false)
     */
    private $friday;

    /**
     * @var \Specialty
     *
     * @ORM\ManyToOne(targetEntity="Specialty")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="specialty_id", referencedColumnName="id")
     * })
     */
    private $specialty;

    /**
     * @var \Users
     *
     * @ORM\ManyToOne(targetEntity="Users")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * })
     */
    private $user;


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
     * Set saturday
     *
     * @param string $saturday
     * @return DoctorSchedule
     */
    public function setSaturday($saturday)
    {
        $this->saturday = $saturday;
    
        return $this;
    }

    /**
     * Get saturday
     *
     * @return string 
     */
    public function getSaturday()
    {
        return $this->saturday;
    }

    /**
     * Set sunday
     *
     * @param string $sunday
     * @return DoctorSchedule
     */
    public function setSunday($sunday)
    {
        $this->sunday = $sunday;
    
        return $this;
    }

    /**
     * Get sunday
     *
     * @return string 
     */
    public function getSunday()
    {
        return $this->sunday;
    }

    /**
     * Set monday
     *
     * @param string $monday
     * @return DoctorSchedule
     */
    public function setMonday($monday)
    {
        $this->monday = $monday;
    
        return $this;
    }

    /**
     * Get monday
     *
     * @return string 
     */
    public function getMonday()
    {
        return $this->monday;
    }

    /**
     * Set tuesday
     *
     * @param string $tuesday
     * @return DoctorSchedule
     */
    public function setTuesday($tuesday)
    {
        $this->tuesday = $tuesday;
    
        return $this;
    }

    /**
     * Get tuesday
     *
     * @return string 
     */
    public function getTuesday()
    {
        return $this->tuesday;
    }

    /**
     * Set wednesday
     *
     * @param string $wednesday
     * @return DoctorSchedule
     */
    public function setWednesday($wednesday)
    {
        $this->wednesday = $wednesday;
    
        return $this;
    }

    /**
     * Get wednesday
     *
     * @return string 
     */
    public function getWednesday()
    {
        return $this->wednesday;
    }

    /**
     * Set thursday
     *
     * @param string $thursday
     * @return DoctorSchedule
     */
    public function setThursday($thursday)
    {
        $this->thursday = $thursday;
    
        return $this;
    }

    /**
     * Get thursday
     *
     * @return string 
     */
    public function getThursday()
    {
        return $this->thursday;
    }

    /**
     * Set friday
     *
     * @param string $friday
     * @return DoctorSchedule
     */
    public function setFriday($friday)
    {
        $this->friday = $friday;
    
        return $this;
    }

    /**
     * Get friday
     *
     * @return string 
     */
    public function getFriday()
    {
        return $this->friday;
    }

    /**
     * Set specialty
     *
     * @param \Specialty $specialty
     * @return DoctorSchedule
     */
    public function setSpecialty(\Specialty $specialty = null)
    {
        $this->specialty = $specialty;
    
        return $this;
    }

    /**
     * Get specialty
     *
     * @return \Specialty 
     */
    public function getSpecialty()
    {
        return $this->specialty;
    }

    /**
     * Set user
     *
     * @param \Users $user
     * @return DoctorSchedule
     */
    public function setUser(\Users $user = null)
    {
        $this->user = $user;
    
        return $this;
    }

    /**
     * Get user
     *
     * @return \Users 
     */
    public function getUser()
    {
        return $this->user;
    }
}