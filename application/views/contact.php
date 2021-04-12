<!-- header -->
<?php $this->load->view('header.php'); ?>
<!-- end header -->


	<!-- banner-2 -->
	<div class="page-head_agile_info_w3l">

	</div>
	<!-- //banner-2 -->
	<!-- page -->
	<div class="services-breadcrumb">
		<div class="agile_inner_breadcrumb">
			<div class="container">
				<ul class="w3_short">
					<li>
						<a href="index.html">Home</a>
						<i>|</i>
					</li>
					<li>contact Us</li>
				</ul>
			</div>
		</div>
	</div>
	<!-- //page -->
	<!-- contact page -->
	<div class="contact-w3l">
		<div class="container">
			<!-- tittle heading -->
			<h3 class="tittle-w3l">Contact Us
				<span class="heading-style">
					<i></i>
					<i></i>
					<i></i>
				</span>
			</h3>
			<!-- //tittle heading -->
			<!-- contact -->
			<div class="contact agileits">
				<div class="contact-agileinfo">
					<div class="contact-form wthree">
						<?php if($msg = $this->session->flashdata('msg_sent')): ?>
        <div class="row mx-50">
          <div class="alert alert-success text-center">
            <?php echo $msg; ?>
            </div>
        </div>
      <?php endif;
              ?>
              <?php if($msg = $this->session->flashdata('msg_not_sent')): ?>
        <div class="row mx-50">
          <div class="alert alert-danger text-center">
            <?php echo $msg; ?>
            </div>
        </div>
      <?php endif;
              ?>
						<?php echo form_open('contact/contact_validation'); ?>
							<div class="">
								<?php echo form_input(['placeholder'=>'Name','name'=>'contact_name', 'id'=>'contact_name']); ?> 
							</div>
							<?php echo form_error('contact_name') ?>
							<div class="">
								<?php echo form_input(['placeholder'=>'Subject','name'=>'contact_subject', 'id'=>'contact_subject']); ?>
							</div>
							<?php echo form_error('contact_subject') ?>
							<div class="">
								<?php echo form_input(['placeholder'=>'Email','name'=>'contact_email', 'id'=>'contact_email']); ?>
							</div>
							<?php echo form_error('contact_email') ?>
							<div class="">
								<?php echo form_textarea(['placeholder'=>'Message','name'=>'contact_msg', 'id'=>'contact_msg']); ?>
							</div>
							<?php echo form_error('contact_msg') ?>
							<input type="submit" value="Submit">
						</form>
					</div>
					<br><br>
			</div>
			<!-- //contact -->
		</div>
	</div>

	<!-- Footer -->
<?php $this->load->view('footer.php'); ?>
<!-- end footer -->
