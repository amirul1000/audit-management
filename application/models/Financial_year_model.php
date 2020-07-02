<?php

/**
 * Author: Amirul Momenin
 * Desc:Financial_year Model
 */
class Financial_year_model extends CI_Model
{
	protected $financial_year = 'financial_year';
	
    function __construct(){
        parent::__construct();
    }
	
    /** Get financial_year by id
	 *@param $id - primary key to get record
	 *
     */
    function get_financial_year($id){
        $result = $this->db->get_where('financial_year',array('id'=>$id))->row_array();
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $result;
    } 
	
    /** Get all financial_year
	 *
     */
    function get_all_financial_year(){
        $this->db->order_by('id', 'desc');
        $result = $this->db->get('financial_year')->result_array();
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $result;
    }
	
	/** Get limit financial_year
	 *@param $limit - limit of query , $start - start of db table index to get query
	 *
     */
    function get_limit_financial_year($limit, $start){
		$this->db->order_by('id', 'desc');
        $this->db->limit($limit, $start);
        $result = $this->db->get('financial_year')->result_array();
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $result;
    }
	
    /** Count financial_year rows
	 *
     */
	function get_count_financial_year(){
       $result = $this->db->from("financial_year")->count_all_results();
	   $db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $result;
    }
	
    /** function to add new financial_year
	 *@param $params - data set to add record
	 *
     */
    function add_financial_year($params){
        $this->db->insert('financial_year',$params);
        $id = $this->db->insert_id();
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $id;
    }
	
    /** function to update financial_year
	 *@param $id - primary key to update record,$params - data set to add record
	 *
     */
    function update_financial_year($id,$params){
        $this->db->where('id',$id);
        $status = $this->db->update('financial_year',$params);
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $status;
    }
	
    /** function to delete financial_year
	 *@param $id - primary key to delete record
	 *
     */
    function delete_financial_year($id){
        $status = $this->db->delete('financial_year',array('id'=>$id));
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $status;
    }
}
