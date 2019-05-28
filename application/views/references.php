<div class="box">
	<form action="" method="POST">
		<div class="box-header with-border">
			<h3 class="box-title">References uploaded: <?php echo $uploaded; ?></h3>
			<div class="box-tools pull-right">
			<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
					title="Collapse">
				<i class="fa fa-minus"></i></button>
			<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
				<i class="fa fa-times"></i></button>
			</div>
		</div>
		<div class="box-body">
			<table class="table table-striped">
				<thead>
					<th>Name</th>
					<th>Email</th>
					<th>Filename</th>
					<th>File Upload Status</th>
					<th>Sending Schedule</th>
				</thead>
				<tbody>
				<?php if(count($csv)>0): foreach($csv as $row):?>
				<?php
					$file_status		=	'<span class="badge bg-red">Not found</span>';
					$check_status		=	$this->db->query("SELECT * FROM payslips WHERE old_name='".$row['attachment'].".pdf' ORDER BY created_on DESC LIMIT 1");
					$check_status		=	(array)$check_status->row();
					//~ debug($row['attachment']);
					//~ debug($check_status);
					if(file_exists(FCPATH.'assets/payslip/'.$row['attachment']) && empty($check_status)) {
						$file_status	=	'<span class="badge bg-yellow">Re-upload</span>';
					}
					elseif(file_exists(FCPATH.'assets/payslip/'.$row['attachment'].'.pdf') && !empty($check_status)) {
						if($check_status['is_sent']==0) {
							$file_status	=	'<span class="badge bg-blue">Pending Schedule</span>';
						}
						else {
							$file_status	=	'<span class="badge bg-gray">Sending complete</span>';
						}
					}
				?>
					<tr>
						<td><?php echo $row['full_name']; ?></td>
						<td><?php echo $row['recipient']; ?></td>
						<td><?php echo $row['attachment']; ?></td>
						<td><?php echo $file_status; ?></td>
						<td><?php echo date('h:i a j F Y', strtotime($row['send_on'])); ?></td>
					</tr>
				<?php endforeach; endif; ?>
				</tbody>
			</table>
		</div>
		<div class="box-footer">
			<a href='<?php echo SITEURL; ?>upload/payslips' class='btn btn-primary'>Upload Payslips</a>
		</div>
	</form>
</div>
