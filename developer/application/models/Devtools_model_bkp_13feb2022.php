<?php if (!defined('BASEPATH')) exit ('No direct script access allowed'); 

class Devtools_model extends CI_Model
{
	
	function _construct(){
 	    parent::_construct();
    }


    public function gps_datacheck($pull_items,$table,$where="",$dom="",$orderby="",$limit="",$where_status="",$limit1="",$groupby=""){
		 
		$this->db->select($pull_items);
		$this->db->from($table);
		if($where!="")
          $this->db->where($where);
		if($orderby!="")
		 $this->db->order_by($orderby);
		if($limit!="" && $limit1!="")
		  $this->db->limit($limit1,$limit);
		else
		 $this->db->limit($limit);
		 
		if($groupby!="")
		  $this->db->group_by($groupby); 
		  
 		$query = $this->db->get();
		  //print  $this->db->last_query();
		if($dom=="1")
	      return $result=$query->result_array();
	   else
		  return $result=$query->row_array();
 	}


 	public function user_group_join()
 	{
  	    $this->db->select("u.name,u.user_name,u.Password,ug.name as usergroup,u.status");
  	    $this->db->from("user u");
		$this->db->join("user_groups ug","u.user_group=ug.id");
	    $this->db->order_by("usergroup asc");
		$query = $this->db->get();
		  // print  $this->db->last_query(); 
 	    return $result=$query->result_array();
    }

    public function userChk($username)
 	{

           $this->db->select("*");
  	       $this->db->from("user");
  	       //$this->db->where('status',1);
	       $this->db->like('user_name', $username);
	       $query = $this->db->get();
	       return $result=$query->result_array();
    }
 
}

?>