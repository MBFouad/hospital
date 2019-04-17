<?php

defined('BASEPATH') OR exit('No direct script access allowed');
if (!class_exists('MX_Controller', false)) {
    require APPPATH . 'third_party/MX/Controller.php';
}

//use \Products;
class Product extends MX_Controller {

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
    public function listProducts() {
        $jqGrid = new jqGridClass();
        $jqGrid->setUrl(base_url("/product/search"))
                ->setColumnNames(array('productId', 'product Name', 'product Price', 'product Description'))
                ->setColumnModel(
                       array(
                            "name:'productId',index:'productId',align: 'center', sortable: true, search: false, sorttype: 'int',key:true,hidden:true",
                            "name:'productName',index:'productName',align: 'center', sortable: true, search: true",
                            "name:'productPrice',index: 'productPrice', align: 'center', sortable: true,searchoptions: {sopt: ['eq', 'ne']}",
                            "name:'productDescription',index: 'productDescription', align: 'center', sortable: true,search: false",
                ))
                ->setGridTitle("Products List")
                ->setOrderByAsc("productName")
                ->setNavGrid()
                ->setRowList(array(10, 20, 50, 100))
                ->setRightClickMenu()
                ->setShrinkToFit("true")
                ->setCustomSearchNavBar(array("productName"));
         $getUserSession = $this->session->get_userdata();
          if (isset($getUserSession['userType']) && $getUserSession['userType'] == "ADMIN") {
             $jqGrid->setAddLogo("addNewProductFun()")
                ->setDeleteLogo("deleteProductFun(rowid)")
                ->setEditLogo("addNewProductFun(rowid)")
                ->setOnDblClickRow("addNewProductFun(rowid)");
        }
        $buildJqGrid = $jqGrid->build();
        $this->layout->title("Welcome to Products List");
        $this->layout->view('list_products', array('productsListGridId' => $jqGrid->getGridId(), 'productsListPagerId' => $jqGrid->getPagerId(), 'productsListGrid' => $buildJqGrid));
    }

    public function search() {
        $data = $this->input->post();
        $this->load->model('mod_Products');
        $repo = $this->mod_Products->search($data);
        exit(json_encode($repo));
    }

    public function addProducts() {
        $this->load->view('add_products');
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

}