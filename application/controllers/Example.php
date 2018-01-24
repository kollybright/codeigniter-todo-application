<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Example extends CI_Controller
{


    function __construct()
    {
        parent:: __construct();
        $this->load->model('login_model');
        $this->load->helper(array('form'));
        $this->load->library('form_validation');
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
//    function validate_insert_users()
//    {
//        $username = $this->input->post('username');
//        $email =    $this->input->post('email');
//        $password = $this->input->post('password');
//        $cpassword= $this->input->post('cpassword');
//        if ($username && $email && $password && $cpassword) {
//            if ($cpassword == $password) {
//                if ($this->login_model->user_exists()==false){
//                    $this->login_model->insert_user();
//                    redirect('todo/signin');
//
//                }
//                else{
//                    $data['error']='username already exist';
//                    $this->load->view('register_view',$data);
//                }
//
//            } else {
//                $data['error'] = 'your passwords doesn\'t match';
//                $this->load->view('register_view', $data);
//            }
//        } else {
//            $data['error'] = 'please enter all fields';
//            $this->load->view('register_view', $data);
//        }
//    }

    function validate_insert_users(){
      $this->form_validation->set_rules('username','Username','required|trim|xss_clean|min_length[5]|is_unique[reg_users.username]|regex_match[/^[a-zA-Z0-9_]+$/]',array(
          'required'=>'Please supply your %s',
          'min_length'=>'Please enter a %s not less than five characters',
          'is_unique'=>'Username already exists',
          'regex_match'=>'Only Alphanumeric  and underscore(_) is allowed for %s'
        ));
   $this->form_validation->set_rules('email','Email','required|valid_email|xss_clean|is_unique[reg_users.email]', array(
            'required'=>'Please supply your %s',
           'valid_email'=>'Please enter a valid %s address',
           'is_unique'=>' Email already in use'
       ));
      $this->form_validation->set_rules('password','Password','required|min_length[5]|regex_match[/^[a-zA-Z0-9]+$/]',array(

          'required'=>'You have to enter a %s',
          'min_length'=>'Your %s  has be at least five characters',
          'regex_match'=>'Only Alphanumeric  and underscore(_)allowed is allowed for %s'
      ));
      $this->form_validation->set_rules('cpassword',' Confirm Password','required|matches[password]',array(

          'required'=>'You have to enter %s',
          'matches'=>'Your passwords doesn\'t match '
      ));

        if ($this->form_validation->run() == FALSE  && !($this->input->post('g-recaptcha-response')))

      {
          $data['error']='please enter reCAPTCHA';
          $this->load->view('register_view',$data);
      }
        else if ($this->form_validation->run() == TRUE  && !($this->input->post('g-recaptcha-response'))){
            $data['error']='please enter reCAPTCHA';
            $this->load->view('register_view',$data);
        }
        else if ($this->form_validation->run() == FALSE && $this->input->post('g-recaptcha-response')){
            $this->load->view('register_view');
        }
      else
      {
          $this->login_model->insert_user();
          redirect('todo/signin');
      }

  }

//validate login, upon entry: session starts( and cookie if enabled)
 /*   public function  login()
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
    }*/
    public  function  login(){
        if ($this->session->userdata('currently_logged_in')){
            redirect('todo/homepage');
        }

        $this->form_validation->set_rules('username', 'Username:', 'required|trim|xss_clean|callback_validation');
        $this->form_validation->set_rules('password', 'Password:', 'required|xss_clean|trim');
        if ($this->form_validation->run())
        {
            $data = array(
                'username' => $this->input->post('username'),
                'currently_logged_in' => 1
            );
            $this->session->set_userdata($data);
            if ($this->input->post('rem')) {
                set_cookie('username', $this->input->post('username',TRUE), '3600');
                set_cookie('password', $this->input->post('password',TRUE), '3600');

            } else {
                if (isset($_COOKIE['username'])) {
                    delete_cookie('username');
                }
                if (isset($_COOKIE['password'])) {
                    delete_cookie('password');
                }
            }
            redirect('todo/homepage');
        }
        else {
            $this->load->view('signin');
        }
    }


    public function validation()
    {
        if ($this->login_model->log_in_correctly() && $this->input->post('g-recaptcha-response'))
        {

            return true;
        } else {
            if ($this->login_model->log_in_correctly() && !($this->input->post('g-recaptcha-response'))){
                $this->form_validation->set_message('validation', 'Please enter the reCAPTCHA.');
                return false;
            }
            else if($this->login_model->log_in_correctly()==false && $this->input->post('g-recaptcha-response')){
            $this->form_validation->set_message('validation', 'Incorrect username/password.');
                return false;
            }
            else if ($this->login_model->log_in_correctly()==false && !($this->input->post('g-recaptcha-response'))){
                $this->form_validation->set_message('validation', 'Incorrect username/password, please enter the ReCAPTCHA');
            }
            return false;
        }
    }
// user logout, session ended
    public function  logout()
    {
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('currently_logged_in');
        $this->session->sess_destroy();
        redirect('todo/signin');
    }
    //homepage loaded with data
    public function homepage(){
        if ($this->session->userdata('currently_logged_in')){
            $data['records']=$this->login_model->fetch_event();
              $data['user']= $this->login_model->get_id();
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