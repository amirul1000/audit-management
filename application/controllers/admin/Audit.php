<?php

 /**
 * Author: Amirul Momenin
 * Desc:Audit Controller
 *
 */
class Audit extends CI_Controller{
    function __construct(){
        parent::__construct();
        $this->load->helper('url'); 
		$this->load->helper('form');
		$this->load->library('session');
		$this->load->library('pagination');
		$this->load->library('Customlib');
		$this->load->helper(array('cookie', 'url')); 
		$this->load->database();  
		$this->load->model('Audit_model');
		if(! $this->session->userdata('validated')){
				redirect('admin/login/index');
		}  
    } 
	
    /**
	 * Index Page for this controller.
	 *@param $start - Starting of audit table's index to get query
	 *
	 */
    function index($start=0){
		$limit = 10;
        $data['audit'] = $this->Audit_model->get_limit_audit($limit,$start);
		//pagination
		$config['base_url'] = site_url('admin/audit/index');
		$config['total_rows'] = $this->Audit_model->get_count_audit();
		$config['per_page'] = 10;
		//Bootstrap 4 Pagination fix
		$config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination">';
		$config['full_tag_close']   = '</ul></nav></div>';
		$config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
		$config['num_tag_close']    = '</span></li>';
		$config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
		$config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
		$config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['next_tag_close']   = '<span aria-hidden="true"></span></span></li>';
		$config['next_tag_close']   = '<span aria-hidden="true">&raquo;</span></span></li>';
		$config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['prev_tag_close']   = '</span></li>';
		$config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
		$config['first_tag_close']  = '</span></li>';
		$config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['last_tag_close']   = '</span></li>';		
		$this->pagination->initialize($config);
        $data['link'] =$this->pagination->create_links();
		
        $data['_view'] = 'admin/audit/index';
        $this->load->view('layouts/admin/body',$data);
    }
	
	 /**
     * Save audit
	 *@param $id - primary key to update
	 *
     */
    function save($id=-1){   
		 
		
		
		$params = array(
					 'auditor_id' => html_escape($this->input->post('auditor_id')),
'account_type' => html_escape($this->input->post('account_type')),
'purpose' => html_escape($this->input->post('purpose')),
'amount' => html_escape($this->input->post('amount')),
'description' => html_escape($this->input->post('description')),
'financial_year_id' => html_escape($this->input->post('financial_year_id')),
'audit_date' => html_escape($this->input->post('audit_date')),

				);
		 
		 
		$data['id'] = $id;
		//update		
        if(isset($id) && $id>0){
			$data['audit'] = $this->Audit_model->get_audit($id);
            if(isset($_POST) && count($_POST) > 0){   
                $this->Audit_model->update_audit($id,$params);
				$this->session->set_flashdata('msg','Audit has been updated successfully');
                redirect('admin/audit/index');
            }else{
                $data['_view'] = 'admin/audit/form';
                $this->load->view('layouts/admin/body',$data);
            }
        } //save
		else{
			if(isset($_POST) && count($_POST) > 0){   
                $audit_id = $this->Audit_model->add_audit($params);
				$this->session->set_flashdata('msg','Audit has been saved successfully');
                redirect('admin/audit/index');
            }else{  
			    $data['audit'] = $this->Audit_model->get_audit(0);
                $data['_view'] = 'admin/audit/form';
                $this->load->view('layouts/admin/body',$data);
            }
		}
        
    } 
	
	/**
     * Details audit
	 * @param $id - primary key to get record
	 *
     */
	function details($id){
        $data['audit'] = $this->Audit_model->get_audit($id);
		$data['id'] = $id;
        $data['_view'] = 'admin/audit/details';
        $this->load->view('layouts/admin/body',$data);
	}
	
    /**
     * Deleting audit
	 * @param $id - primary key to delete record
	 *
     */
    function remove($id){
        $audit = $this->Audit_model->get_audit($id);

        // check if the audit exists before trying to delete it
        if(isset($audit['id'])){
            $this->Audit_model->delete_audit($id);
			$this->session->set_flashdata('msg','Audit has been deleted successfully');
            redirect('admin/audit/index');
        }
        else
            show_error('The audit you are trying to delete does not exist.');
    }
	
	/**
     * Search audit
	 * @param $start - Starting of audit table's index to get query
     */
	function search($start=0){
		if(!empty($this->input->post('key'))){
			$key =$this->input->post('key');
			$_SESSION['key'] = $key;
		}else{
			$key = $_SESSION['key'];
		}
		
		$limit = 10;		
		$this->db->like('id', $key, 'both');
$this->db->or_like('auditor_id', $key, 'both');
$this->db->or_like('account_type', $key, 'both');
$this->db->or_like('purpose', $key, 'both');
$this->db->or_like('amount', $key, 'both');
$this->db->or_like('description', $key, 'both');
$this->db->or_like('financial_year_id', $key, 'both');
$this->db->or_like('audit_date', $key, 'both');


		$this->db->order_by('id', 'desc');
		
        $this->db->limit($limit,$start);
        $data['audit'] = $this->db->get('audit')->result_array();
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		
		//pagination
		$config['base_url'] = site_url('admin/audit/search');
		$this->db->reset_query();		
		$this->db->like('id', $key, 'both');
$this->db->or_like('auditor_id', $key, 'both');
$this->db->or_like('account_type', $key, 'both');
$this->db->or_like('purpose', $key, 'both');
$this->db->or_like('amount', $key, 'both');
$this->db->or_like('description', $key, 'both');
$this->db->or_like('financial_year_id', $key, 'both');
$this->db->or_like('audit_date', $key, 'both');

		$config['total_rows'] = $this->db->from("audit")->count_all_results();
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		$config['per_page'] = 10;
		// Bootstrap 4 Pagination fix
		$config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination">';
		$config['full_tag_close']   = '</ul></nav></div>';
		$config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
		$config['num_tag_close']    = '</span></li>';
		$config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
		$config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
		$config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['next_tag_close']   = '<span aria-hidden="true"></span></span></li>';
		$config['next_tag_close']   = '<span aria-hidden="true">&raquo;</span></span></li>';
		$config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['prev_tag_close']   = '</span></li>';
		$config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
		$config['first_tag_close']  = '</span></li>';
		$config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['last_tag_close']   = '</span></li>';
		$this->pagination->initialize($config);
        $data['link'] =$this->pagination->create_links();
		
		$data['key'] = $key;
		$data['_view'] = 'admin/audit/index';
        $this->load->view('layouts/admin/body',$data);
	}
	
    /**
     * Export audit
	 * @param $export_type - CSV or PDF type 
     */
	function export($export_type='CSV'){
	  if($export_type=='CSV'){	
		   // file name 
		   $filename = 'audit_'.date('Ymd').'.csv'; 
		   header("Content-Description: File Transfer"); 
		   header("Content-Disposition: attachment; filename=$filename"); 
		   header("Content-Type: application/csv; ");
		   // get data 
		   $this->db->order_by('id', 'desc');
		   $auditData = $this->Audit_model->get_all_audit();
		   // file creation 
		   $file = fopen('php://output', 'w');
		   $header = array("Id","Auditor Id","Account Type","Purpose","Amount","Description","Financial Year Id","Audit Date"); 
		   fputcsv($file, $header);
		   foreach ($auditData as $key=>$line){ 
			 fputcsv($file,$line); 
		   }
		   fclose($file); 
		   exit; 
	  }else if($export_type=='Pdf'){
		    $this->db->order_by('id', 'desc');
		    $audit = $this->db->get('audit')->result_array();
		   // get the HTML
			ob_start();
			include(APPPATH.'views/admin/audit/print_template.php');
			$html = ob_get_clean();
			include(APPPATH."third_party/mpdf60/mpdf.php");					
			$mpdf=new mPDF('','A4'); 
			//$mpdf=new mPDF('c','A4','','',32,25,27,25,16,13); 
			//$mpdf->mirrorMargins = true;
		    $mpdf->SetDisplayMode('fullpage');
			//==============================================================
			$mpdf->autoScriptToLang = true;
			$mpdf->baseScript = 1;	// Use values in classes/ucdn.php  1 = LATIN
			$mpdf->autoVietnamese = true;
			$mpdf->autoArabic = true;
			$mpdf->autoLangToFont = true;
			$mpdf->setAutoBottomMargin = 'stretch';
			$stylesheet = file_get_contents(APPPATH."third_party/mpdf60/lang2fonts.css");
			$mpdf->WriteHTML($stylesheet,1);
			$mpdf->WriteHTML($html);
			//$mpdf->AddPage();
			$mpdf->Output($filePath);
			$mpdf->Output();
			//$mpdf->Output( $filePath,'S');
			exit;	
	  }
	   
	}
}
//End of Audit controller