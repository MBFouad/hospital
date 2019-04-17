<?php

defined('BASEPATH') OR exit('No direct script access allowed');
if (!class_exists('MX_Controller', false)) {
    require APPPATH . 'third_party/MX/Controller.php';
}
require_once(APPPATH . "models/Entities/Users.php");
require_once(APPPATH . "models/Entities/Products.php");
require_once (APPPATH . "models/Entities/DoctorSchedule.php");
require_once (APPPATH . "models/Entities/Specialty.php");
require_once (APPPATH . "models/Entities/BookingDoctor.php");
require_once (APPPATH . "models/Entities/UsersType.php");

class Welcome extends MX_Controller
{

    public function __construct()
    {
//        die('ppiuio');
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
    public function index()
    {
//
//        $em = $this->doctrine->em;
//
//        $article = $em->find('Products', 1);
//        print_r($article);die("ali");
        $this->layout->view('welcome_message');
    }

    public function login()
    {

        $username = $this->clearInputData($this->input->post("username"));
        $password = $this->clearInputData($this->input->post("password"));
        if (!empty($password) && !empty($username)) {
//            $password = $this->input->post("password");
//            $username = $this->input->post("username");
            $em = $this->doctrine->em;
            $user = $em->getRepository('Users')->findOneBy(array('username' => $username, 'password' => sha1($password), 'active' => 1));

            if (is_object($user)) {
                $userSession['userType'] = $user->getUserType()->getUserType();
                $userSession['userId'] = $user->getId();
                $userSession['userName'] = $user->getUsername();
                $userSession['email'] = $user->getEmail();
                $userSession['firstName'] = $user->getFirstName();
                $userSession['lastName'] = $user->getLastName();
                $userSession['middleName'] = $user->getMiddleName();
                $this->session->set_userdata($userSession);
                exit(json_encode(array("status" => TRUE, "userType" => $userSession['userType'])));
            } else {
                exit(json_encode(array("status" => FALSE)));
            }
        } else {
            $this->layout->view('login');
        }
    }

    public function signUP()
    {
        $this->layout->view('sign_up');
    }

    public function adminstration()
    {
        $getUserSession = $this->session->get_userdata();
        if (isset($getUserSession['userType']) && $getUserSession['userType'] != NULL && $getUserSession['userType'] != "") {
            $this->layout->view('welcome');
        } else {
            exit("false");
        }
    }

    public function clearInputData($data)
    {
        if (is_array($data)) {
            //todo
        } else {
            $data = trim(strip_tags($data));
        }
        return $data;
    }

    public function createUser()
    {
        $data = $this->input->post();
        $data = $this->clearInputData($data);
        $this->load->model('Mod_users');

        $checkUser = $this->Mod_users->CheckUserIsExists($data['username'], $data['email']);
        if ($checkUser["status"] == FALSE)
            exit(json_encode($checkUser));
        $repo = $this->Mod_users->saveUsers($data);
        if ($repo)
            exit(json_encode(array("status" => TRUE)));
        exit(json_encode(array("status" => FALSE)));
    }

    public function logOut()
    {
        $getUserSession = $this->session->get_userdata();
        if (isset($getUserSession['userName']) && $getUserSession['userName'] != NULL) {
            $this->session->sess_destroy();
        }
        exit(json_encode(array("status" => TRUE)));
    }

    public function checkLogin()
    {
        $getUserSession = $this->session->get_userdata();
        if (isset($getUserSession['userType']) && $getUserSession['userType'] != NULL && $getUserSession['userType'] != "") {
            exit(json_encode(array("status" => TRUE, "userType" => $getUserSession['userType'])));
        } else {
            exit(json_encode(array("status" => FALSE)));
        }
    }

}