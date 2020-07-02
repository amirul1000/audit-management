<a  href="<?php echo site_url('admin/audit/index'); ?>" class="btn btn-info"><i class="arrow_left"></i> List</a>
<h5 class="font-20 mt-15 mb-1"><?php if($id<0){echo "Save";}else { echo "Update";} echo " "; echo str_replace('_',' ','Audit'); ?></h5>
<!--Form to save data-->
<?php echo form_open_multipart('admin/audit/save/'.$audit['id'],array("class"=>"form-horizontal")); ?>
<div class="card">
   <div class="card-body">    
        <div class="form-group"> 
                                    <label for="Auditor" class="col-md-4 control-label">Auditor</label> 
         <div class="col-md-8"> 
          <?php 
             $this->CI =& get_instance(); 
             $this->CI->load->database();  
             $this->CI->load->model('Auditor_model'); 
             $dataArr = $this->CI->Auditor_model->get_all_auditor(); 
          ?> 
          <select name="auditor_id"  id="auditor_id"  class="form-control"/> 
            <option value="">--Select--</option> 
            <?php 
             for($i=0;$i<count($dataArr);$i++) 
             {  
            ?> 
            <option value="<?=$dataArr[$i]['id']?>" <?php if($audit['auditor_id']==$dataArr[$i]['id']){ echo "selected";} ?>><?=$dataArr[$i]['email']?></option> 
            <?php 
             } 
            ?> 
          </select> 
         </div> 
           </div>
<div class="form-group"> 
                                        <label for="Account Type" class="col-md-4 control-label">Account Type</label> 
          <div class="col-md-8"> 
           <?php 
             $enumArr = $this->customlib->getEnumFieldValues('audit','account_type'); 
           ?> 
           <select name="account_type"  id="account_type"  class="form-control"/> 
             <option value="">--Select--</option> 
             <?php 
              for($i=0;$i<count($enumArr);$i++) 
              { 
             ?> 
             <option value="<?=$enumArr[$i]?>" <?php if($audit['account_type']==$enumArr[$i]){ echo "selected";} ?>><?=ucwords($enumArr[$i])?></option> 
             <?php 
              } 
             ?> 
           </select> 
          </div> 
            </div>
<div class="form-group"> 
          <label for="Purpose" class="col-md-4 control-label">Purpose</label> 
          <div class="col-md-8"> 
           <input type="text" name="purpose" value="<?php echo ($this->input->post('purpose') ? $this->input->post('purpose') : $audit['purpose']); ?>" class="form-control" id="purpose" /> 
          </div> 
           </div>
<div class="form-group"> 
          <label for="Amount" class="col-md-4 control-label">Amount</label> 
          <div class="col-md-8"> 
           <input type="text" name="amount" value="<?php echo ($this->input->post('amount') ? $this->input->post('amount') : $audit['amount']); ?>" class="form-control" id="amount" /> 
          </div> 
           </div>
<div class="form-group"> 
                                        <label for="Description" class="col-md-4 control-label">Description</label> 
          <div class="col-md-8"> 
           <textarea  name="description"  id="description"  class="form-control" rows="4"/><?php echo ($this->input->post('description') ? $this->input->post('description') : $audit['description']); ?></textarea> 
          </div> 
           </div>
<div class="form-group"> 
                                    <label for="Financial Year" class="col-md-4 control-label">Financial Year</label> 
         <div class="col-md-8"> 
          <?php 
             $this->CI =& get_instance(); 
             $this->CI->load->database();  
             $this->CI->load->model('Financial_year_model'); 
             $dataArr = $this->CI->Financial_year_model->get_all_financial_year(); 
          ?> 
          <select name="financial_year_id"  id="financial_year_id"  class="form-control"/> 
            <option value="">--Select--</option> 
            <?php 
             for($i=0;$i<count($dataArr);$i++) 
             {  
            ?> 
            <option value="<?=$dataArr[$i]['id']?>" <?php if($audit['financial_year_id']==$dataArr[$i]['id']){ echo "selected";} ?>><?=$dataArr[$i]['name']?></option> 
            <?php 
             } 
            ?> 
          </select> 
         </div> 
           </div>
<div class="form-group"> 
                                       <label for="Audit Date" class="col-md-4 control-label">Audit Date</label> 
            <div class="col-md-8"> 
           <input type="text" name="audit_date"  id="audit_date"  value="<?php echo ($this->input->post('audit_date') ? $this->input->post('audit_date') : $audit['audit_date']); ?>" class="form-control-static datepicker"/> 
            </div> 
           </div>

   </div>
</div>
<div class="form-group">
    <div class="col-sm-offset-4 col-sm-8">
        <button type="submit" class="btn btn-success"><?php if(empty($audit['id'])){?>Save<?php }else{?>Update<?php } ?></button>
    </div>
</div>
<?php echo form_close(); ?>
<!--End of Form to save data//-->	
<!--JQuery-->
<script>
	$( ".datepicker" ).datepicker({
		dateFormat: "yy-mm-dd", 
		changeYear: true,
		changeMonth: true,
		showOn: 'button',
		buttonText: 'Show Date',
		buttonImageOnly: true,
		buttonImage: '<?php echo base_url(); ?>public/datepicker/images/calendar.gif',
	});
</script>  			