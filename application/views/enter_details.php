
<!-- header -->
<?php $this->load->view('header.php'); ?>
<!-- end header -->

<!-- checkout page -->
	<div class="privacy">
		<div class="container">
			<!-- tittle heading -->
			<h3 class="tittle-w3l">Please Enter Details
				<span class="heading-style">
					<i></i>
					<i></i>
					<i></i>
				</span>
			</h3>
		</div>
	</div>






<div class="checkout-left" style="margin-top: -60px;">
	<div class="address_form_agile">
					

<div class="col-md-7" style="float: center; ">
<form action="<?php echo base_url('order_checkout/pay') ?>" method="post">
	<div class="form-group">
	<input class="form-control billing-address-name" type="text" name="name" placeholder="Full Name">
	</div>
	<div class="form-group">
	<input type="text" placeholder="Mobile Number" name="contact" class="form-control">
	</div>
	<div class="form-group">
	<input type="text" placeholder="Address" name="address" class="form-control">
	</div>
	<div class="form-group">
	<input type="text" placeholder="PIN Code" class="form-control" name="pincode">
	</div>

	<a href="<?php echo base_url('order_checkout/pay') ?>">Make a Payment</a>
</form>
</div>

<div class="col-md-5">
<table border="1px solid black" width="100%;">
	<tr class="" style="text-align: center;">
		<td style="padding: 4px;"><h5 style="font-size: 17px; color: #1accfd; margin-bottom: 18px;"><b>Product: </b></h5></td>
		<td><h5><?php echo $this->session->product_name; ?></h5></td>
	</tr>
	<tr style="text-align: center;">
		<td style="padding: 4px;"><h5 style="font-size: 17px; color: #1accfd; margin-bottom: 18px;"><b>Price: </b></h5></td>
		<td><h5><?php echo $this->session->product_price; ?></h5></td>
	</tr>
	<tr style="text-align: center;">
		<td style="padding: 4px;"><h5 style="font-size: 17px; color: #1accfd; margin-bottom: 18px;"><b>Quantity: </b></h5></td>
		<td><h5><?php echo $this->session->product_quantity; ?></h5></td>
	</tr>
	<tr style="text-align: center;">
		<td style="padding: 4px;"><h5 style="font-size: 17px; color: #1accfd; margin-bottom: 18px;"><b>Total Amount: </b></h5></td>
		<td><h5><?php echo $this->session->userdata('total_amount'); ?></h5></td>
	</tr>
</table>

<br><br>
<!-- <table>
	<tr>
		<form>
			<div class="form-group">
				<a href="<?php //echo base_url('product/purchase/'.$this->session->product_id); ?>">Make a Payment<input type="submit" value="Make a Payment" name="submit" class="form-control btn btn-success" style="max-width: 150px; float: right;"></a>
			</div>
		</form>
	</tr>
</table>--> 
</table>
</div>

</div></div>

<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<!-- Footer -->
<?php $this->load->view('footer.php'); ?>
<!-- end footer -->