<?php

defined('BASEPATH') OR exit('No direct script access allowed');
if (!class_exists('MX_Controller', false)) {
    require APPPATH . 'third_party/MX/Controller.php';
}
require_once(APPPATH . "models/Entities/Users.php");
require_once(APPPATH . "models/Entities/Products.php");

class Doctor extends MX_Controller {

    public function __construct() {
//        die('ppiuio');
        parent::__construct();
    }

    public function listDoctorSchedule() {
        $jqGrid = new jqGridClass();
        $jqGrid->setUrl(base_url("/doctor/search"))
                ->setColumnNames(array('doctor Id', 'Doctor Name', 'Specialty', 'Saturday', 'Sunday',
                    'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'))
                ->setColumnModel(
                       array(
                            "name:'doctorId',index:'doctorId',align: 'center', sortable: true, search: false, sorttype: 'int',frozen:true,key:true,hidden:true",
                            "name:'doctorName',index:'doctorName',align: 'center', sortable: true, search: true",
                            "name:'specialty',index:'specialty',align: 'center', sortable: true, search: true",
                            "name:'saturday',index: 'saturday', align: 'center',  search: false",
                            "name:'sunday',index: 'sunday', align: 'center',  search: false",
                            "name:'monday',index: 'monday', align: 'center',  search: false",
                            "name:'tuesday',index: 'tuesday', align: 'center',  search: false",
                            "name:'wednesday',index: 'wednesday', align: 'center',  search: false",
                            "name:'thursday',index: 'tursday', align: 'center',  search: false",
                            "name:'friday',index: 'friday', align: 'center',  search: false",
                ))
                ->setGridTitle("Doctors Schedule List")
                ->setOrderByAsc("doctorName")
                ->setNavGrid()
                ->setColunmWidth(array(1, 2, 2, 1, 1, 1, 1, 1, 1, 1))
                ->setRowList(array(10, 20, 50, 100))
                ->setShrinkToFit("true")
                ->setCustomSearchNavBar(array("doctorName", "specialty"));
        $getUserSession = $this->session->get_userdata();
        if (isset($getUserSession['userType']) && $getUserSession['userType'] == "ADMIN") {
            $jqGrid->setEditLogo("editDoctorScheduleFun(rowid)")
                    ->setOnDblClickRow("editDoctorScheduleFun(rowid)");
        } else if (isset($getUserSession['userType']) && ($getUserSession['userType'] == "DOCTOR" || $getUserSession['userType'] == "USER")) {
            $jqGrid->setEditLogo("bookingDoctorScheduleFun(rowid)")
                    ->setOnDblClickRow("bookingDoctorScheduleFun(rowid)");
        }
        $buildJqGrid = $jqGrid->build();
        $this->layout->title("Doctors Schedule List");
        $this->layout->view('list_doctor_schedule', array('doctorScheduleListGridId' => $jqGrid->getGridId(), 'doctorScheduleListPagerId' => $jqGrid->getPagerId(), 'doctorScheduleListGrid' => $buildJqGrid));
    }

    public function search() {
        $data = $this->input->post();
        $this->load->model('mod_doctors');
        $repo = $this->mod_doctors->search($data);
        exit(json_encode($repo));
    }

    public function editDoctorSchedule() {
        $doctorId = $this->input->post('doctorId');
        if ($doctorId && $doctorId != NULL && $doctorId != "") {
            $data = $this->input->post();
            $this->load->model('mod_doctor_schedule');
            $repo = $this->mod_doctor_schedule->saveDoctorSchedule($data);
            if ($repo)
                exit(json_encode(array('status' => true)));
            else
                exit(json_encode(array('status' => false)));
        }
        $this->load->model('mod_specialty');
        $repo = $this->mod_specialty->getAllSpecialty();
        $Data['specialtyTypes'] = $repo;
        $this->load->view('edit_doctor_schedule', $Data);
    }

    public function getDoctorInfo() {
        $doctortId = $this->input->post('doctorId');
        $this->load->model('mod_doctors');
        $repo = $this->mod_doctors->getDoctorInfo($doctortId);
        exit(json_encode($repo));
    }

    public function saveProducts() {

        $data = $this->input->post();
        foreach ($data as &$value) {
            $value = strip_tags($value);
        }
        $this->load->model('mod_Products');
        $repo = $this->mod_Products->saveProducts($data);
        if ($repo)
            exit(json_encode(array('status' => true)));
    }

    public function deleteProducts() {
        $productId = $this->input->post('productId');
        if (is_numeric($productId)) {
            $this->load->model('mod_Products');
            $repo = $this->mod_Products->deleteProducts($productId);
            if ($repo)
                exit(json_encode(array('succeed' => true)));
        }

        exit(json_encode(array('failed' => true)));
    }

    public function bookingDoctorSchedule() {
        $doctorId = $this->input->post('doctorId');
        $this->load->model('mod_booking_doctor');
        $repo = $this->mod_booking_doctor->getBookingDoctor($doctorId);
        $data['bookingDoctorSchedule'] = $repo;
        $data['doctorId'] = $doctorId;
        $this->load->view('booking_doctor_schedule', $data);
    }

    public function makeBooking() {
        $this->load->model('mod_booking_doctor');
        $repo = $this->mod_booking_doctor->makeBooking($this->input->post('doctorId'), $this->input->post('bookingDate'));
        exit(json_encode($repo));
    }

    public function getBookingData() {
        $this->load->view('get_booking_data');
    }

    public function bookingDoctorReport() {
        $formData = $this->input->post();
        if (isset($formData['date_of_booking']) && $formData['date_of_booking'] != NULL && $formData['date_of_booking'] != "" && isset($formData['doctorId']) && $formData['doctorId'] != NULL && $formData['doctorId'] != 0 && $formData['doctorId'] != "") {

            $this->load->model('mod_booking_doctor');
            $repo = $this->mod_booking_doctor->getBookingReport($formData['doctorId'], $formData['date_of_booking']);
            $data['report'] = $repo;
        } else {
            $data['report'] = array();
        }
        $this->load->model('mod_doctors');
        $doctors = $this->mod_doctors->getAllDoctor();
        $data['doctors'] = $doctors;
        $this->load->view('booking_doctor_report', $data);
    }

    public function getBookingDoctorReport() {
        $formData = $this->input->post();
        if (isset($formData['date_of_booking']) && $formData['date_of_booking'] != NULL && $formData['date_of_booking'] != "" && isset($formData['doctorId']) && $formData['doctorId'] != NULL && $formData['doctorId'] != 0 && $formData['doctorId'] != "") {

            $this->load->model('mod_booking_doctor');
            $repo = $this->mod_booking_doctor->getBookingReport($formData['doctorId'], $formData['date_of_booking']);
            $data['report'] = $repo;
        } else {
            $data['report'] = array();
        }
        $this->load->view('get_booking_doctor_report', $data);
    }

}