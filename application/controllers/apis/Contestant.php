<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contestant extends CI_Controller {

	
	public function __Construct()
    {
        parent::__Construct();
        $this->load->model('Contestant_model','contestant');
    }
	
	public function index()
	{	
		$data['title']='Contestant';
		$this->load->library('');
		$data['districts']=$this->contestant->get_districts();
		$data['contestants']=$this->contestant->get_all_contestant();
		$data['active']='contestant';
		foreach ($data['contestants'] as $key => $value) {
			$data['contestants'][$key]['dob']=date('d/m/Y',strtotime($value['dob']));
		}

		$trial['Contestant']=isset($data['contestants'])?$data['contestants']:array();
		$trial['Districts']=isset($data['districts'])?$data['districts']:array();
		$this->httpresponse->addData('Contestant',$trial);
        $this->httpresponse->deliver(); exit; 
	}

	public function contestant($id=0){
		$data['title']='Contestant';
		 $this->load->library('form_validation');
		 if($this->input->post()){

		 	$this->form_validation->set_rules('firstname', 'First Name', 'trim|required');
			$this->form_validation->set_rules('lastname', 'Last Name', 'trim|required');
			$this->form_validation->set_rules('dob', 'Date of Birth', 'required');
			$this->form_validation->set_rules('district', 'District', 'required');
			$this->form_validation->set_rules('gender', 'Gender', 'required');
			$this->form_validation->set_rules('address', 'Address', 'trim|required');

                if ($this->form_validation->run())
                {	
                	$isActive=$this->input->post('isActive');
                	$insert['firstname']=$this->input->post('firstname');
                	$insert['lastname']=$this->input->post('lastname');
                	$insert['is_active']=($isActive=='on' || isset($isActive))?1:0;
                	$insert['district_id']=(int)$this->input->post('district');
                	$insert['dob']=date('Y-m-d',strtotime($this->input->post('dob')));
                	$insert['gender']=$this->input->post('gender');
                	$insert['address']=$this->input->post('address');

		            	$success=($id > 0)?'New Contestant update successfully':'New Contestant added successfully';
		            	$error=($id > 0)?'Unable to add New Contestant':'Unable to update New Contestant';
                	
                	if($_FILES['photo']['name'] !="")
		            {	
		            	$rand =rand();

		            	
		            	$extension=substr($_FILES['photo']['name'], strpos($_FILES['photo']['name'], "."));
		            	$imagetmp=$_FILES['photo']['tmp_name'];
		            	$imagename="contestant-".$rand.$extension;
		            	$path ='uploads/contestant/';
		                if(move_uploaded_file($imagetmp,$path.$imagename)){
		                	$insert['photo_url']=$imagename;
		                	$previous=($id > 0)?$this->contestant->get_contestant($id):'';

		                	$result=($id > 0)?$this->contestant->update_contestant($insert,$id):$this->contestant->insert_contestant($insert);
		                	if($result){
		                		if(!empty($previous)){
		                			unlink($path.$previous['photo_url']);
		                		}
		                		$this->session->set_flashdata('success',$success);
		                		$this->session->set_flashdata('error',null);
		                	}else{
		                		$this->session->set_flashdata('error',$error);		                		
		                		$this->session->set_flashdata('success',null);
		                	}
		                }
		            }else{
		            	$result=($id > 0)?$this->contestant->update_contestant($insert,$id):$this->contestant->insert_contestant($insert);
		                	if($result){
		                		$this->session->set_flashdata('success',$success);
		                		$this->session->set_flashdata('error',null);
		                	}else{
		                		$this->session->set_flashdata('error',$error);
		                		$this->session->set_flashdata('success',null);
		                	}
		            }                    
                }else{
                	$data['error']='Some information were provided incorrectly';
                }
			
			$data['districts']=$this->contestant->get_districts();
			$data['contestants']=$this->contestant->get_all_contestant();
			$data['active']='contestant';			
			$this->load->view('header',$data);
			$this->load->view('index');
			$this->load->view('footer');          
        }
	}

	public function delete($id){
		$result=$this->contestant->delete_contestant($id);
		if($result){
			$this->session->set_flashdata('success','The requested contestant deleted successfully');
		}else{
			$this->session->set_flashdata('error','Unable to delete the requested Contestant');
		}
		redirect('Contestant');
	}

}
