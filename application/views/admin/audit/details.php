<a  href="<?php echo site_url('admin/audit/index'); ?>" class="btn btn-info"><i class="arrow_left"></i> List</a>
<h5 class="font-20 mt-15 mb-1"><?php echo str_replace('_',' ','Audit'); ?></h5>
<!--Data display of audit with id--> 
<?php
	$c = $audit;
?> 
<table class="table table-striped table-bordered">         
		<tr><td>Auditor</td><td><?php
									   $this->CI =& get_instance();
									   $this->CI->load->database();	
									   $this->CI->load->model('Auditor_model');
									   $dataArr = $this->CI->Auditor_model->get_auditor($c['auditor_id']);
									   echo $dataArr['email'];?>
									</td></tr>

<tr><td>Account Type</td><td><?php echo $c['account_type']; ?></td></tr>

<tr><td>Purpose</td><td><?php echo $c['purpose']; ?></td></tr>

<tr><td>Amount</td><td><?php echo $c['amount']; ?></td></tr>

<tr><td>Description</td><td><?php echo $c['description']; ?></td></tr>

<tr><td>Financial Year</td><td><?php
									   $this->CI =& get_instance();
									   $this->CI->load->database();	
									   $this->CI->load->model('Financial_year_model');
									   $dataArr = $this->CI->Financial_year_model->get_financial_year($c['financial_year_id']);
									   echo $dataArr['name'];?>
									</td></tr>

<tr><td>Audit Date</td><td><?php echo $c['audit_date']; ?></td></tr>


</table>
<!--End of Data display of audit with id//--> 