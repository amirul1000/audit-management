<a  href="<?php echo site_url('admin/financial_year/index'); ?>" class="btn btn-info"><i class="arrow_left"></i> List</a>
<h5 class="font-20 mt-15 mb-1"><?php echo str_replace('_',' ','Financial_year'); ?></h5>
<!--Data display of financial_year with id--> 
<?php
	$c = $financial_year;
?> 
<table class="table table-striped table-bordered">         
		<tr><td>Name</td><td><?php echo $c['name']; ?></td></tr>


</table>
<!--End of Data display of financial_year with id//--> 