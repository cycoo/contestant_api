<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Rating_Model extends CI_Model
{
	public function get_all_contestant($start,$end)
    {	
        $start_date=date('Y-m-d',strtotime($start));
        $end_date=date('Y-m-d',strtotime($end));

        $query="SELECT c.id as contestant_id,c.firstname,c.lastname,c.dob,c.is_active,c.gender,c.photo_url,c.address,d.name as district, d.id as district_id
            FROM contestant c 
            join district d on c.district_id=d.id
            where c.is_active=1
            order by c.id desc";   	

        $result = $this->db->query($query)->result_array();
        return $result;
    }   

    public function get_ratings($id,$value,$start,$end){
        $start_date=date('Y-m-d',strtotime($start));
        $end_date=date('Y-m-d',strtotime($end));

        $this->db->where('contestant_id',$id);
        $this->db->where('rating',$value); 

        if(!empty($start) && !empty($end)){
            $this->db->where('rated_date >=',$start_date);
            $this->db->where('rated_date <=',$end_date);
        }
        $this->db->order_by('contestant_id');
  
        $result = $this->db->get('contestant_rating')->result_array();
        return $result;
    }

    public function rate($insert)
    {
        $result = $this->db->insert('contestant_rating', $insert);
        if ($result) {
            return $result;
        } else {
            return false;
        }
    }

}