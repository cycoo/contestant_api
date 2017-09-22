<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Contestant_Model extends CI_Model
{
	public function get_all_contestant()
    {	
    	$query="SELECT c.id as contestant_id,c.firstname,c.lastname,c.dob,c.is_active,c.gender,c.photo_url,c.address,d.name as district, d.id as district_id FROM contestant c join district d on c.district_id=d.id order by c.id desc";

        $result = $this->db->query($query)->result_array();
        return $result;
    }

    public function get_contestant($id)
    {   
        $query="SELECT c.id as contestant_id,c.firstname,c.lastname,c.dob,c.is_active,c.gender,c.photo_url,c.address,d.name as district, d.id as district_id FROM contestant c join district d on c.district_id=d.id where c.id=$id";

        $result = $this->db->query($query)->row_array();
        return $result;
    }

    public function get_all_photos()
    {	
    	$query="SELECT id as contestant_id, photo_url FROM contestant order by id desc";

        $result = $this->db->query($query)->result_array();
        return $result;
    }

    public function get_districts()
    {
        $result = $this->db->get('district')->result_array();
        return $result;
    }

    public function insert_contestant($insert)
    {
        $result = $this->db->insert('contestant', $insert);
        if ($result) {
            return $result;
        } else {
            return false;

        }
    }

    public function update_contestant($update,$id)
    {	
    	$this->db->where('id',$id);
        $result = $this->db->update('contestant', $update);
        if ($result) {
            return $result;
        } else {
            return false;

        }
    }

    public function delete_contestant($id)
    {
        $this->db->where('id', $id);
        $result = $this->db->delete('contestant');
        if ($result) {
            return $result;
        } else {
            return false;
        }

    }
}