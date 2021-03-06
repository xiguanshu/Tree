<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use \QCloud_WeApp_SDK\Auth\LoginService as LoginService;
use QCloud_WeApp_SDK\Constants as Constants;

class Knl extends CI_Controller {
	// public function __construct(){
	// 		parent::__construct();
	// 		$this->load->model('Vocabulary_model');
	// 	}
   /* public function index() {
        $result = LoginService::check();

        if ($result['loginState'] === Constants::S_AUTH) {
            $this->json([
                'code' => 0,
                'data' => $result['userinfo']
            ]);
        } else {
            $this->json([
                'code' => -1,
                'data' => []
            ]);
        }
    }*/
    
        public function get_user_list()
  {
    $ouserid = $this->input->get('ouserid');
    $this->load->model('knl_model');
    $result=$this->knl_model->get_user_list($ouserid);
    echo json_encode($result);
  }
public function user_list_words()
  {
    $words= $this->input->get('words');
   
    $ouserid = $this->input->get('ouserid');
    $this->load->model('knl_model');
    $result=$this->knl_model->user_list_words($words,$ouserid);
  }
  public function user_list_omoney()
  {
    $omoney= $this->input->get('omoney');
    $ouserid = $this->input->get('ouserid');
    $this->load->model('knl_model');
    $result=$this->knl_model->user_list_omoney($omoney,$ouserid);
  }
  public function user_list_rights()
  {
   
   $rights= $this->input->get('rights');
    $ouserid = $this->input->get('ouserid');
    $this->load->model('knl_model');
    $result=$this->knl_model->user_list_rights($rights,$ouserid);
  }

    // 	$query=$this->Vocabulary_model->get_vocabulary();
    //   $result=json_encode($query);
    //   echo $result;
    // }

      public function get_knl() {
      $start = $this -> input -> get('start');
       $limit = $this -> input -> get('limit');

      $this->load->model('knl_model');
      // 查询题目
      $knl=$this->knl_model->get_lisfind_by_describe_answert($start, $limit);

      foreach($knl as $v){
       
        $v -> knl_answer = $this->knl_model->get_answer_by_knl($v->knl_id);
      };
      echo json_encode($knl);
    }




   

}
