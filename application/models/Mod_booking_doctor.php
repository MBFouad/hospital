<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once (APPPATH . "models/Entities/DoctorSchedule.php");
require_once (APPPATH . "models/Entities/Specialty.php");
require_once (APPPATH . "models/Entities/BookingDoctor.php");
require_once (APPPATH . "models/Entities/Users.php");

class Mod_booking_doctor extends CI_Model {

    private $_em;

    public function __construct() {
        parent::__construct();
        $this->_em = $this->doctrine->em;
    }

    public function getBookingDoctor($doctorId) {
        $result = array();
        for ($i = 0; $i < 7; $i++) {
            $dateToDay = new DateTime('NOW');
            $dateToDay = $dateToDay->add(new DateInterval("P{$i}D"));
            $date = $dateToDay->format('Y-m-d');
            $dateName = $dateToDay->format('l');
            $res = $this->_em->createQueryBuilder()
                            ->select("count(BD.id) as customerCount")
                            ->from('BookingDoctor', 'BD')
                            ->where("BD.date = '$date'")
                            ->andWhere("BD.doctor = $doctorId")
                            ->getQuery()->getResult();
            $result[$date]['customerCount'] = $res[0]['customerCount'];
            $result[$date]['dateName'] = $dateName;
        }

        return $result;
    }

    public function makeBooking($doctorId, $date) {
        $res = $this->_em->createQueryBuilder()
                        ->select("count(BD.id) as customerCount")
                        ->from('BookingDoctor', 'BD')
                        ->where("BD.date = '$date'")
                        ->andWhere("BD.doctor = $doctorId")
                        ->getQuery()->getResult();
        $getUserSession = $this->session->get_userdata();
        if (isset($getUserSession['userType']) && $getUserSession['userType'] == "USER") {
            $user = $this->_em->find('Users', $getUserSession['userId']);
            $doctor = $this->_em->find('Users', $doctorId);
            $BookingDoctor = new BookingDoctor();
            $BookingDoctor->setDate((dateTime::createFromFormat('Y-m-d', $date)));
            $BookingDoctor->setCustomer($user);
            $BookingDoctor->setDoctor($doctor);
            $BookingDoctor->setBookingNumber($res[0]['customerCount'] + 1);
            $this->_em->persist($BookingDoctor);
            $this->_em->flush();
            $dateName = (dateTime::createFromFormat('Y-m-d', $date));
            $dateName = $dateName->format('l');
            $doctorSchedule = $this->_em->getRepository('DoctorSchedule')->findOneBy(array('user' => $doctorId));
            $getDay = "get" . ucfirst(strtolower($dateName));
            $time = $doctorSchedule->$getDay();
            $time = explode(":", $time);
            if (is_numeric(substr($time[0], 0, 2)))
                $time[0] = substr($time[0], 0, 2);
            else if (is_numeric(substr($time[0], 0, 1)))
                $time[0] = substr($time[0], 0, 1);
            else
                $time[0] = 0;
            $expectedTime = $res[0]['customerCount'] * 10;
            $expectedTime2 = $expectedTime % 60;
            $expectedTime = (int) ($expectedTime / 60);
            return array("status" => TRUE, "customerName" => $getUserSession['firstName'] . " " . $getUserSession['middleName'] . " " . $getUserSession['lastName'],
                "DoctorName" => $doctor->getFirstName() . " " . $doctor->getMiddleName() . " " . $doctor->getLastName(), "Date" => $date, "bookingNumber" => $BookingDoctor->getBookingNumber(),
                "expectedTime" => $time[0] + $expectedTime . ":" . $expectedTime2, "DateName" => $dateName);
        }
        return array("status" => FALSE);
    }

    public function getBookingReport($doctorId, $date) {
        $res = $this->_em->createQueryBuilder()
                        ->select("BD.bookingNumber ,CONCAT(U.firstName,CONCAT(' ',CONCAT(U.middleName,CONCAT(' ',U.lastName)))) as customerName")
                        ->from('BookingDoctor', 'BD')
                        ->leftJoin('Users', 'U', \Doctrine\ORM\Query\Expr\Join::WITH, 'BD.customer = U.id')
                        ->where("BD.date = '$date'")
                        ->andWhere("BD.doctor = $doctorId")
                        ->orderBy("BD.bookingNumber", "asc")
                        ->getQuery()->getResult();
        return $res;
    }

}
