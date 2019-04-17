<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once (APPPATH . "models/Entities/DoctorSchedule.php");
require_once (APPPATH . "models/Entities/Specialty.php");

class Mod_doctor_schedule extends CI_Model {

    private $_em;

    public function __construct() {
        parent::__construct();
        $this->_em = $this->doctrine->em;
    }

    public function saveDoctorSchedule($data) {
        $user = $this->_em->find('Users', $data['doctorId']);
        $doctorSchedule = $this->_em->getRepository('DoctorSchedule')->findOneBy(array('user' => $data['doctorId']));
        if (!is_object($doctorSchedule)) {
            $doctorSchedule = new DoctorSchedule();
            $doctorSchedule->setUser($user);
        }
        $specialty = $this->_em->find('Specialty', $data['specialtyType']);
//        if ($data['from'][0] != "" && $data['to'][0] != "")
        $doctorSchedule->setSaturday($data['from'][0] . ":" . $data['to'][0]);
//        if ($data['from'][1] != "" && $data['to'][1] != "")
        $doctorSchedule->setSunday($data['from'][1] . ":" . $data['to'][1]);
//        if ($data['from'][2] != "" && $data['to'][2] != "")
        $doctorSchedule->setMonday($data['from'][2] . ":" . $data['to'][2]);
//        if ($data['from'][3] != "" && $data['to'][3] != "")
        $doctorSchedule->setTuesday($data['from'][3] . ":" . $data['to'][3]);
//        if ($data['from'][4] != "" && $data['to'][4] != "")
        $doctorSchedule->setWednesday($data['from'][4] . ":" . $data['to'][4]);
//        if ($data['from'][5] != "" && $data['to'][5] != "")
        $doctorSchedule->setThursday($data['from'][5] . ":" . $data['to'][5]);
//        if ($data['from'][6] != "" && $data['to'][6] != "")
        $doctorSchedule->setFriday($data['from'][6] . ":" . $data['to'][6]);
        if (is_object($specialty) && $data['specialtyType'] != 0)
            $doctorSchedule->setSpecialty($specialty);
        $this->_em->persist($doctorSchedule);
        $this->_em->flush();
        $user->setFirstName($data['firstName']);
        $user->setMiddleName($data['middleName']);
        $user->setLastName($data['lastName']);

        $this->_em->persist($user);
        $this->_em->flush();
        return TRUE;
    }

}
