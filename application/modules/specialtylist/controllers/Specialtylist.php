<?php

defined('BASEPATH') OR exit('No direct script access allowed');
if (!class_exists('MX_Controller', false)) {
    require APPPATH . 'third_party/MX/Controller.php';
}

class Specialtylist extends MX_Controller {

    public function __construct() {
        parent::__construct();
    }

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     * 	- or -
     * 		http://example.com/index.php/welcome/index
     * 	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     */
    public function listSpecialty() {
        $jqGrid = new jqGridClass();
        $jqGrid->setUrl(base_url("/specialtylist/search"))
                ->setColumnNames(array('specialty Id', 'Specialty Name'))
                ->setColumnModel(
                        array(
                            "name:'specialtyId',index: 'specialtyId', align: 'center', sortable: true,hidden:true",
                            "name:'specialtyType',index:'specialtyType',align: 'center', sortable: true, search: true"))
                ->setGridTitle("Specialty List")
                ->setOrderByAsc("specialtyType")
                ->setNavGrid()
                ->setRowList(array(10, 20, 50, 100))
                ->setRightClickMenu()
                ->setShrinkToFit("true")
                ->setCustomSearchNavBar(array("specialtyType"));
        $getUserSession = $this->session->get_userdata();
        if (isset($getUserSession['userType']) && $getUserSession['userType'] == "ADMIN") {
            $jqGrid->setAddLogo("addNewSpecialtyFun()")
                    ->setEditLogo("addNewSpecialtyFun(rowid)")
                    ->setOnDblClickRow("addNewSpecialtyFun(rowid)");
        }
        $buildJqGrid = $jqGrid->build();
        $this->layout->title("Specialty List!");
        $this->layout->view('list_specialty', array('specialtyListGridId' => $jqGrid->getGridId(), 'specialtyListPagerId' => $jqGrid->getPagerId(), 'specialtyListGrid' => $buildJqGrid));
    }

    public function search() {
//        die('oooooo');
        $data = $this->input->post();
        $this->load->model('mod_specialty');
        $repo = $this->mod_specialty->search($data);
        exit(json_encode($repo));
    }

    public function editSpecialty() {
        $this->load->view('add_specialty');
    }

    public function saveSpecialty() {

        $data = $this->input->post();
        foreach ($data as &$value) {
            $value = strip_tags($value);
        }
        $this->load->model('mod_specialty');
        $repo = $this->mod_specialty->saveSpecialty($data);
        exit(json_encode(array('status' => $repo)));
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

}