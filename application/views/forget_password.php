<!-- header -->
<?php $this->load->view('header.php'); ?>
<!-- end header -->


<br><br>

<div class="form-gap"></div>
<div class="container">
	<div class="row">
		<div class="col-md-4 col-md-offset-4">
            <div class="panel panel-default">
              <div class="panel-body">
                <div class="text-center">
                  <h3><i class="fa fa-lock fa-4x"></i></h3>
                  <h2 class="text-center">Forgot Password?</h2>
                  <p>You can reset your password here.</p>
                  <div class="panel-body">
    
    				<?php echo form_open('forget_password/forget_password_email'); ?>
                      <div class="form-group">
                      
                        <?php if($msg = $this->session->flashdata('email_found')): ?>
        <div class="row mx-50">
          <div class="alert alert-success">
            <?php echo $msg; ?>
            </div>
        </div>
      <?php endif;
              ?>
                        <div class="input-group">
                          <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>

						  <div class="form-group">
						    <?php echo form_input(['class'=>'form-control','placeholder'=>'Email address','name'=>'email_address', 'id'=>'email_address']); ?> 
						  </div>
              </div>
              <?php echo form_error('email_address'); ?>

              <?php if($msg = $this->session->flashdata('email_not_found')): ?>
        <div class="row mx-50">
          <p style="color: red;"><?php echo $msg; ?></p>
        </div>
      <?php endif; ?> 
            
                      </div>
                      <div class="form-group">
                        <input name="recover-submit" class="btn btn-lg btn-primary btn-block" value="Reset Password" type="submit">
                      </div>
                      
                      <input type="hidden" class="hide" name="token" id="token" value=""> 
                    <?php echo form_close(); ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
	</div>
</div>

<br><br><br><br>





<!-- Footer -->
<?php $this->load->view('footer.php'); ?>
<!-- end footer -->
