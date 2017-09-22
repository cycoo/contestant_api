<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gallery extends CI_Controller {

	
	public function __Construct()
    {
        parent::__Construct();
        $this->load->model('Contestant_model','contestant');
    }
	
	public function index()
	{		
		$data['title']='Gallery';
		$data['active']='gallery';
		$this->load->library('form_validation');
		$data['photos']=$this->contestant->get_all_photos();
		$this->load->view('header',$data);
		$this->load->view('gallery/index');
		$this->load->view('footer');
	}
}