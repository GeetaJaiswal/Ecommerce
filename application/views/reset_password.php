<!-- header -->
<?php $this->load->view('header.php'); ?>
<!-- end header -->

<br><br>
<
<?php if($msg = $this->session->flashdata('password_update')): ?>
        <div class="row mx-50">
          <div class="alert alert-success text-center">
            <?php echo $msg; ?>
            </div>
        </div>
      <?php endif;
              ?>


  <?php if($msg = $this->session->flashdata('password_not_update')): ?>
        <div class="row mx-50">
          <div class="alert alert-danger text-center">
            <?php echo $msg; ?>
            </div>
        </div>
      <?php endif;
              ?>

<br>

<div class="container">
	<div class="row">
		<div class="col-md-4"></div>
		<div class="col-md-4" style="border:1px solid black; padding: 20px;">
			<?php echo form_open('forget_password/user_reset_password'); ?>
		       <label>New Password</label>
            <div class="form-group pass_show"> 
                <?php echo form_password(['class'=>'form-control','placeholder'=>'New Password','name'=>'new_password', 'id'=>'new_password']); ?> 
            </div> 
            <?php echo form_error('new_password'); ?>

		       <label>Confirm Password</label>
            <div class="form-group pass_show"> 
                 <?php echo form_password(['class'=>'form-control','placeholder'=>'Confirm Password','name'=>'confirm_password', 'id'=>'confirm_password']); ?> 
            </div> 
            <?php echo form_error('confirm_password'); ?>

            <div class="form-group"> 
                <input type="submit" class="form-control" value="Reset Password" style="color:white; background-color: #1accfd;"> 
                <?php echo form_open('forget_password/forget_password_email'); ?>
            </div> 
            <?php echo form_close(); ?>
		</div>  
		<div class="col-md-4"></div>
	</div>
</div>


<br><br><br><br>

<!-- Footer -->
<?php $this->load->view('footer.php'); ?>
<!-- end footer -->