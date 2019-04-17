<?php



use Doctrine\ORM\Mapping as ORM;

require_once(APPPATH . "models/Entities/Users.php");
/**
 * BookingDoctor
 *
 * @ORM\Table(name="booking_doctor")
 * @ORM\Entity
 */
class BookingDoctor
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
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date", nullable=false)
     */
    private $date;

    /**
     * @var integer
     *
     * @ORM\Column(name="booking_number", type="integer", nullable=false)
     */
    private $bookingNumber;

    /**
     * @var \Users
     *
     * @ORM\ManyToOne(targetEntity="Users")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="customer_id", referencedColumnName="id")
     * })
     */
    private $customer;

    /**
     * @var \Users
     *
     * @ORM\ManyToOne(targetEntity="Users")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="doctor_id", referencedColumnName="id")
     * })
     */
    private $doctor;


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
     * Set date
     *
     * @param \DateTime $date
     * @return BookingDoctor
     */
    public function setDate($date)
    {
        $this->date = $date;
    
        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set bookingNumber
     *
     * @param integer $bookingNumber
     * @return BookingDoctor
     */
    public function setBookingNumber($bookingNumber)
    {
        $this->bookingNumber = $bookingNumber;
    
        return $this;
    }

    /**
     * Get bookingNumber
     *
     * @return integer 
     */
    public function getBookingNumber()
    {
        return $this->bookingNumber;
    }

    /**
     * Set customer
     *
     * @param \Users $customer
     * @return BookingDoctor
     */
    public function setCustomer(\Users $customer = null)
    {
        $this->customer = $customer;
    
        return $this;
    }

    /**
     * Get customer
     *
     * @return \Users 
     */
    public function getCustomer()
    {
        return $this->customer;
    }

    /**
     * Set doctor
     *
     * @param \Users $doctor
     * @return BookingDoctor
     */
    public function setDoctor(\Users $doctor = null)
    {
        $this->doctor = $doctor;
    
        return $this;
    }

    /**
     * Get doctor
     *
     * @return \Users 
     */
    public function getDoctor()
    {
        return $this->doctor;
    }
}