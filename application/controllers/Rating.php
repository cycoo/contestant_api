<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rating extends CI_Controller {

	
	public function __Construct()
    {
        parent::__Construct();
        $this->load->model('Rating_model','rating');
    }
	
	public function index()
	{	
		$this->load->library('form_validation');

		$data['active']='rating';
		$data['title']='Rating';
		$this->load->library('form_validation');
		
		$start='';
		$end='';
		$rate[]=array();

		if($this->input->post()){
			$this->form_validation->set_rules('start_date', 'Start Date');
			$this->form_validation->set_rules('end_date', 'End Date');

			$start=$this->input->post('start_date');
			$end=$this->input->post('end_date');
		}

		$data['contestants']=$this->rating->get_all_contestant($start,$end);

		foreach ($data['contestants'] as $detail) {
			$sum=0;		
			$ratings[1]=$this->rating->get_ratings($detail['contestant_id'],'1',$start,$end);
			$ratings[2]=$this->rating->get_ratings($detail['contestant_id'],'2',$start,$end);
			$ratings[3]=$this->rating->get_ratings($detail['contestant_id'],'3',$start,$end);
			$ratings[4]=$this->rating->get_ratings($detail['contestant_id'],'4',$start,$end);
			$ratings[5]=$this->rating->get_ratings($detail['contestant_id'],'5',$start,$end);

			if(!empty($ratings)){
				foreach ($ratings as $key=>$rating) {
					$total[$key]=count($rating)*$key;
					$sum=$sum+$total[$key];					
				}
				$count=count($ratings[1])+count($ratings[2])+count($ratings[3])+count($ratings[4])+count($ratings[5]);
				$rate[$detail['contestant_id']]=($count>0)?($sum)/$count:0;
			}		
		}

		$data['rating']=$rate;
		$this->load->view('header',$data);
		$this->load->view('rating/index');
		$this->load->view('footer');
	}

	public function rate($id){
		$this->load->library('form_validation');
		 if($this->input->post()){
		 	$this->form_validation->set_rules('rating', 'Rating', 'required');
		 	if ($this->form_validation->run())
                {	
                	$insert['contestant_id']=$id;
                	$insert['rating']=$this->input->post('rating');
                	$insert['rated_date']=date('Y-m-d');
                	$result=$this->rating->rate($insert);
                	if($result){
                	  $this->session->set_flashdata('success','You have succefully rate for '.$this->input->post('contestant'));
                	}else{

                	}
                }
		 }

		 redirect('Rating');
	}	

	public function ajax_ratings(){
		$start='';
		$end='';
		$rate=array();
		$contestants=$this->rating->get_all_contestant($start,$end);

		$data['contestants']=$this->rating->get_all_contestant($start,$end);

		foreach ($contestants as $detail) {
			$sum=0;		
			$ratings[1]=$this->rating->get_ratings($detail['contestant_id'],'1',$start,$end);
			$ratings[2]=$this->rating->get_ratings($detail['contestant_id'],'2',$start,$end);
			$ratings[3]=$this->rating->get_ratings($detail['contestant_id'],'3',$start,$end);
			$ratings[4]=$this->rating->get_ratings($detail['contestant_id'],'4',$start,$end);
			$ratings[5]=$this->rating->get_ratings($detail['contestant_id'],'5',$start,$end);

			if(!empty($ratings)){
				foreach ($ratings as $key=>$rating) {
					if($key==0){
						continue;
					}
					$total[$key]=count($rating)*$key;
					$sum=$sum+$total[$key];					
				}
				$count=count($ratings[1])+count($ratings[2])+count($ratings[3])+count($ratings[4])+count($ratings[5]);
				$rate[$detail['contestant_id']]=($count>0)?round(($sum)/$count,1):0;
			}		
		}
		$data['rating']=$rate;
				echo json_encode($data);
	}

	public function graph(){
		$data['title']='Graph';
		$data['active']='graph';
		$this->load->view('header',$data);
		$this->load->view('rating/graph');
		$this->load->view('footer');
	}
}