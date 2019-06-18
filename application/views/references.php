<div class="box">
	<?php if(isset($csv)): ?>
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
			<table class="table table-hover">
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
						if(file_exists(FCPATH.'assets/payslip/'.$row['attachment'].'')) {
							if(date('Y-m-d H:i:s', strtotime($row['send_on'])) > date('Y-m-d H:i:s')) $file_status	=	'<span><a class="badge bg-blue" href="'.SITEURL.'/assets/payslip/'.$row['attachment'].'" target="_new">Pending Schedule</a></span>';
							else $file_status	=	'<span class="badge bg-red">Sending Failed</span>';
						}
						else {
							if(date('Y-m-d H:i:s', strtotime($row['send_on'])) < date('Y-m-d H:i:s')) $file_status	=	'<span class="badge bg-red">Sending Failed - Not Found</span>';
							else $file_status	=	'<span class="badge bg-orange">Not found</span>';
						}
						if($row['is_sent']==1) {
							$file_status	=	'<span class="badge bg-green">Sending complete</span>';
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
	<?php endif; ?>
</div>
