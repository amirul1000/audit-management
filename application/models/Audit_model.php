<?php

/**
 * Author: Amirul Momenin
 * Desc:Audit Model
 */
class Audit_model extends CI_Model
{
	protected $audit = 'audit';
	
    function __construct(){
        parent::__construct();
    }
	
    /** Get audit by id
	 *@param $id - primary key to get record
	 *
     */
    function get_audit($id){
        $result = $this->db->get_where('audit',array('id'=>$id))->row_array();
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $result;
    } 
	
    /** Get all audit
	 *
     */
    function get_all_audit(){
        $this->db->order_by('id', 'desc');
        $result = $this->db->get('audit')->result_array();
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $result;
    }
	
	/** Get limit audit
	 *@param $limit - limit of query , $start - start of db table index to get query
	 *
     */
    function get_limit_audit($limit, $start){
		$this->db->order_by('id', 'desc');
        $this->db->limit($limit, $start);
        $result = $this->db->get('audit')->result_array();
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $result;
    }
	
    /** Count audit rows
	 *
     */
	function get_count_audit(){
       $result = $this->db->from("audit")->count_all_results();
	   $db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $result;
    }
	
    /** function to add new audit
	 *@param $params - data set to add record
	 *
     */
    function add_audit($params){
        $this->db->insert('audit',$params);
        $id = $this->db->insert_id();
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $id;
    }
	
    /** function to update audit
	 *@param $id - primary key to update record,$params - data set to add record
	 *
     */
    function update_audit($id,$params){
        $this->db->where('id',$id);
        $status = $this->db->update('audit',$params);
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $status;
    }
	
    /** function to delete audit
	 *@param $id - primary key to delete record
	 *
     */
    function delete_audit($id){
        $status = $this->db->delete('audit',array('id'=>$id));
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $status;
    }
}
