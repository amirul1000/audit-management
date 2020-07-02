<link rel="stylesheet"
	href="<?php echo base_url(); ?>public/css/custom.css"> 
<h3 class="font-20 mt-15 mb-1"><?php echo str_replace('_',' ','Audit'); ?></h3>
Date: <?php echo date("Y-m-d");?>
<hr>
<!--*************************************************
*********mpdf header footer page no******************
****************************************************-->
<htmlpageheader name="firstpage" class="hide">
</htmlpageheader>

<htmlpageheader name="otherpages" class="hide">
    <span class="float_left"></span>
    <span  class="padding_5"> &nbsp; &nbsp; &nbsp;
     &nbsp; &nbsp; &nbsp;</span>
    <span class="float_right"></span>         
</htmlpageheader>      
<sethtmlpageheader name="firstpage" value="on" show-this-page="1" />
<sethtmlpageheader name="otherpages" value="on" /> 
   
<htmlpagefooter name="myfooter"  class="hide">                          
     <div align="center">
               <br><span class="padding_10">Page {PAGENO} of {nbpg}</span> 
     </div>
</htmlpagefooter>    

<sethtmlpagefooter name="myfooter" value="on" />
<!--*************************************************
*********#////mpdf header footer page no******************
****************************************************-->
<!--Data display of audit-->    
<table   cellspacing="3" cellpadding="3" class="table" align="center">
    <tr>
		<th>Auditor</th>
<th>Account Type</th>
<th>Purpose</th>
<th>Amount</th>
<th>Description</th>
<th>Financial Year</th>
<th>Audit Date</th>

    </tr>
	<?php foreach($audit as $c){ ?>
    <tr>
		<td><?php
									   $this->CI =& get_instance();
									   $this->CI->load->database();	
									   $this->CI->load->model('Auditor_model');
									   $dataArr = $this->CI->Auditor_model->get_auditor($c['auditor_id']);
									   echo $dataArr['email'];?>
									</td>
<td><?php echo $c['account_type']; ?></td>
<td><?php echo $c['purpose']; ?></td>
<td><?php echo $c['amount']; ?></td>
<td><?php echo $c['description']; ?></td>
<td><?php
									   $this->CI =& get_instance();
									   $this->CI->load->database();	
									   $this->CI->load->model('Financial_year_model');
									   $dataArr = $this->CI->Financial_year_model->get_financial_year($c['financial_year_id']);
									   echo $dataArr['name'];?>
									</td>
<td><?php echo $c['audit_date']; ?></td>

    </tr>
	<?php } ?>
</table>
<!--End of Data display of audit//--> 