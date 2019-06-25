<div class="box">
	<form action="<?php echo HTTP_PATH; ?>upload/reference" method="POST" enctype="multipart/form-data">
		<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
		<div class="box-header with-border">
			<h3 class="box-title">Reference Upload</h3>
			<div class="box-tools pull-right">
			<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
				<i class="fa fa-minus"></i></button>
			<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
				<i class="fa fa-times"></i></button>
			</div>
		</div>
		<div class="box-body">
			<div class="row">
				<div class="col-xs-12">
					<label for="subject">Email subject:</label>
					<input type="text" class="form-control" placeholder="Payslip for 1-15 <?php echo date('F Y'); ?>" name="subject" id="subject" />
				</div>
				<div class="col-xs-12">
					<label for="reference">Reference CSV: </label>
					<input type="file" name="reference" id="reference" class="form-control" />
				</div>
			</div>
		</div>
		<div class="box-footer">
			<input type="submit" class="btn btn-success" value="Upload" />
		</div>
	</form>
</div>
