<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

  public function __construct(){
      parent::__construct();
      $this->load->model("Welcome_model");
  } 

  // by 袁庆龙 start

  //默认载入
	public function index()
	{
		$this->load->view('welcome_message');
  }
  

  // 正则过滤功能特殊符号
  public function reg_test($str){
    $reg = /^[A-Za-z0-9\u4e00-\u9fa5]+$/g //全局匹配所有的大小写字母，十进制证书，汉字
    if(preg_match($reg,$str,$res)){
      return true;
    }else{
      return false;
    }
  }

  //搜索功能，
  public function search(){
    $search_words = $this->input->get('search_words');
    $tf = $this->reg_test($search_words);
    if($tf==true){ //如果正则的匹配结果返回的是true
      $result = $this->Welcome_model->search_all($search_words);
      if(count($result)>0){  //如果查询结果大于0，则返回查询结果
        echo json_encode($result);
      }else{
        echo "not exist";//不存在结果
      }
    }else{
      echo "input error ";//输入非法
    }
  }


  // by 袁庆龙 end
  
}