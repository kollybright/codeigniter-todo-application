<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Example extends CI_Controller
{


    function __construct()
    {
        parent:: __construct();
        $this->load->model('login_model');
    }
//register page
    public function index()
    {
        $this->load->view('register_view');
    }
//signin page
    function signin()
    {
        $this->load->view('signin');
    }
    // invalid login, users whose session is not set trying to visit homepage
    function signin_error()
    {
        $this->load->view('invalid');
    }

//homepage
    function  page_view()
    {
        $this->load->view('homepage');
    }
//validate registration and inserting to database upon validation
    function validate_insert_users()
    {
        $username = $this->input->post('username');
        $email =    $this->input->post('email');
        $password = $this->input->post('password');
        $cpassword= $this->input->post('cpassword');
        if ($username && $email && $password && $cpassword) {
            if ($cpassword == $password) {
                if ($this->login_model->user_exists()==false){
                    $this->login_model->insert_user();
                    redirect('todo/signin');

                }
                else{
                    $data['error']='username already exist';
                    $this->load->view('register_view',$data);
                }

            } else {
                $data['error'] = 'your passwords doesn\'t match';
                $this->load->view('register_view', $data);
            }
        } else {
            $data['error'] = 'please enter all fields';
            $this->load->view('register_view', $data);
        }
    }
//validate login, upon entry: session starts( and cookie if enabled)
    public function  login()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $rem = $this->input->post('rem');
        if ($username && $password) {
            if ($this->login_model->log_in_correctly()) {
                $this->session->set_userdata(array('username' => $this->input->post('username')));
                if ($rem) {
                    set_cookie('username', $this->input->post('username'), '3600');
                    set_cookie('password', $this->input->post('password'), '3600');

                } else {
                    if (isset($_COOKIE['username'])) {
                        delete_cookie('username');
                    }
                    if (isset($_COOKIE['password'])) {
                        delete_cookie('password');
                    }
                }
                redirect('todo/homepage');
            } else {
                $data['error'] = 'username and/or password incorrect';
                $this->load->view('signin', $data);
            }

        } else {
            $data['error'] = 'please enter both fields';
            $this->load->view('signin', $data);
        }
    }
// user logout, session ended
    public function  logout()
    {
        $this->session->unset_userdata('username');
        $this->session->sess_destroy();
        redirect('todo/signin');
    }
    //homepage loaded with data
    public function homepage(){
        if ($this->session->userdata('username')){
            $data['records']=$this->login_model->fetch_event();
            $data['user']=$this->login_model->get_id();
            $this->load->view('homepage',$data);

        }
        else{
            redirect('todo/signin_error');
        }


    }
    // executing events insertion
    public  function  insert_event(){
        if($this->login_model->insert_event()) {
            redirect('todo/homepage');
        }
    }
    //executing events deletion
    public  function  delete_event(){
        $this->login_model->delete_event();
        redirect('todo/homepage');

    }
    //executing event update
    public  function  update_event(){
        $this->login_model->update_event();
        redirect('todo/homepage');

    }

}



?>