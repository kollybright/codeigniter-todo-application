<?php

class Login_model extends CI_Model {
    function  __construct(){
        parent:: __construct();
    }
    //checking if user already exist in the database
    public  function user_exists(){
        $this->db->where('username',$this->input->post('username'));
        $query=$this->db->get('reg_users');
        if ($query->num_rows()!=0){
            return true;
        }
        else{
            return false ;
        }
    }
    //inserting registered users into the database
     public  function  insert_user(){
         $form=array(
             'username' =>$this->input->post ('username'),
             'email'    =>$this->input->post('email'),
             'password' =>md5($this->input->post('password'))
         );
         $this->db->insert('reg_users', $form);
     }
    //validating login from database
    public function log_in_correctly() {

        $this->db->where('username', $this->input->post('username'));
        $this->db->where('password', md5($this->input->post('password')));
        $query = $this->db->get('reg_users');

        if ($query->num_rows()==1)
        {
            return true;
        } else {
            return false;
        }

    }
    // get id of the the user whose session has started
     public function get_id(){
         $this->db->where('username',  $this->session->userdata('username'));
         $query=$this->db->get('reg_users');
           return $query->result()[0]->user_id;


     }
// fetching all the events uploaded for the user whose session is active
     public  function  fetch_event()
     {
         $this->db->where('user_id',$this->get_id());
         $query=$this->db->get('todo');
         return $query->result();

     }
    //inserting events for the user whose session has started
     public  function  insert_event(){
         $data=array(
             'event'=>$this->input->post('event'),
             'the_time'=>$this->input->post('time'),
             'user_id'=>$this->get_id());
         $query=$this->db->insert('todo',$data);
         if($query){
             return true;
         }
         else{
             return false;
         }

     }
    //deleting events for the user whose session has started
     public  function  delete_event(){
         $event_id=$this->input->post('event_id');
         $this->db->delete('todo','event_id='.$event_id);

     }
    //updating events for the user whose session has started
    public  function  update_event(){
           $id=$this->input->post('id');
        $event=$this->input->post('event');
        $time= $this->input->post('time');
        $data = array(
            'event'=>"$event",
            'the_time'=>"$time"
        );
        $this->db->set($data);
        $this->db->where("event_id", $id);
        $this->db->update("todo", $data);
    }

}
?>  