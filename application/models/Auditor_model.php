<?php

/**
 * Author: Amirul Momenin
 * Desc:Auditor Model
 */
class Auditor_model extends CI_Model
{
	protected $auditor = 'auditor';
	
    function __construct(){
        parent::__construct();
    }
	
    /** Get auditor by id
	 *@param $id - primary key to get record
	 *
     */
    function get_auditor($id){
        $result = $this->db->get_where('auditor',array('id'=>$id))->row_array();
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $result;
    } 
	
    /** Get all auditor
	 *
     */
    function get_all_auditor(){
        $this->db->order_by('id', 'desc');
        $result = $this->db->get('auditor')->result_array();
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $result;
    }
	
	/** Get limit auditor
	 *@param $limit - limit of query , $start - start of db table index to get query
	 *
     */
    function get_limit_auditor($limit, $start){
		$this->db->order_by('id', 'desc');
        $this->db->limit($limit, $start);
        $result = $this->db->get('auditor')->result_array();
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $result;
    }
	
    /** Count auditor rows
	 *
     */
	function get_count_auditor(){
       $result = $this->db->from("auditor")->count_all_results();
	   $db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $result;
    }
	
    /** function to add new auditor
	 *@param $params - data set to add record
	 *
     */
    function add_auditor($params){
        $this->db->insert('auditor',$params);
        $id = $this->db->insert_id();
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $id;
    }
	
    /** function to update auditor
	 *@param $id - primary key to update record,$params - data set to add record
	 *
     */
    function update_auditor($id,$params){
        $this->db->where('id',$id);
        $status = $this->db->update('auditor',$params);
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $status;
    }
	
    /** function to delete auditor
	 *@param $id - primary key to delete record
	 *
     */
    function delete_auditor($id){
        $status = $this->db->delete('auditor',array('id'=>$id));
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $status;
    }
}
