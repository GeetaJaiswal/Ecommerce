
<!-- header -->
<?php $this->load->view('header.php'); ?>
<!-- end header -->

	<!-- page -->
	<div class="services-breadcrumb">
		<div class="agile_inner_breadcrumb">
			<div class="container">
				<ul class="w3_short">
					<li>
						<a href="index.html">Home</a>
						<i>|</i>
					</li>
					<li>Cart</li>
				</ul>
			</div>
		</div>
	</div>
	<!-- //page -->
	<!-- cart page -->
	<div class="privacy">
		<div class="container" style="width:90%;">
			<!-- tittle heading -->
			<!-- <h3 class="tittle-w3l">Cart
				<span class="heading-style">
					<i></i>
					<i></i>
					<i></i>
				</span>
			</h3> -->
			<!-- //tittle heading -->
			<div class="checkout-right">
				<!-- <h4>Your shopping cart contains:
					<span>3 Products</span>
				</h4> -->

				<div class="table-responsive">
					<?php if(count($this->cart->contents())!=0){ ?>
					<table class="timetable_sub">
						<thead>
							<tr>
								<th>SL No.</th>
								<th>Product</th>
								<th>Quality</th>
								<th>Product Name</th>
								<th>Product Price</th>
								<th>Total Price</th>
								<th>Remove</th>
							</tr>
						</thead>
						<?php echo form_open('product/update_cart'); ?>
						<tbody>
							<?php $i=1; 
							$cart = $this->cart->contents();
							 foreach ($product as $items): 
								# code...
							 ?>
							<tr class="rem1">
								<td class="invert"><?php echo $i ?></td>
								<input type="hidden" name="<?php echo $i.$items['rowid']; ?>" value="<?php echo $items['rowid']; ?>" id="rowid">
								<td class="invert-image">
								<?php
								//$product_image = ['src'=>'uploads/' . $items['product_img']];
							// 	$product_image = ['src'=>'uploads/' . $items['product_img'],
							// 	'width'=>'160',
							// 	'height'=>'160'];
							// echo img($product_image);
									?>
							
								<img src="<?php echo base_url('uploads/'.$items['image']) ?>" class="img-responsive">
									<?php //print_r($this->cart->contents()); ?>
								</td>
								<td class="invert">
									<div class="quantity">
										<div class="quantity-select">
<!-- 											<div class="entry value-minus">&nbsp;</div>
 -->										
 											<input type="number" value="<?php echo $items['qty']; ?>" name="qty" id="qty " class="item_qty" style="width:50px;">
											
<!-- 											<div class="entry value-plus active">&nbsp;</div>
 -->										</div>
 									<?php $this->session->set_userdata('product_quantity',$items['qty']); 
 									$this->session->set_userdata('product_id',$items['id']); 
 									?>
									</div>
								</td>
								<td class="invert"><?php echo $items['name']; ?></td>
								<?php $this->session->set_userdata('product_name',$items['name']); ?>
								<td class="invert"><?php echo number_format($items['price']); ?></td>
								<?php $this->session->set_userdata('product_price',$items['price']); ?>
								<td class="invert"><?php echo number_format($items['subtotal']); ?></td>
								<td class="invert">
									<div class="rem">
									<a href="<?php echo base_url('product/delete_cart_item/'.$items['rowid']) ?>">	<div class="close1"> </div></a>
									</div>
								</td>
							</tr>
							<?php $i++; ?>
						<?php endforeach; ?>
						</tbody>
					<?php echo form_close(); ?>
					</table>
					<br>
					<div style="text-align: end;">Grand Total:<?php echo $this->cart->total(); ?></div>

					<?php 
					$total_amount = $items['subtotal'];
					$this->session->set_userdata('total_amount',$total_amount); ?>
				<?php } ?>
				</div>
			</div>
			<!--<div class="checkout-left">
				<div class="address_form_agile">
					<h4>Add a new Details</h4>
					<form action="payment.html" method="post" class="creditly-card-form agileinfo_form">
						<div class="creditly-wrapper wthree, w3_agileits_wrapper">
							<div class="information-wrapper">
								<div class="first-row">
									<div class="controls">
										<input class="billing-address-name" type="text" name="name" placeholder="Full Name" required="">
									</div>
									<div class="w3_agileits_card_number_grids">
										<div class="w3_agileits_card_number_grid_left">
											<div class="controls">
												<input type="text" placeholder="Mobile Number" name="number" required="">
											</div>
										</div>
										<div class="w3_agileits_card_number_grid_right">
											<div class="controls">
												<input type="text" placeholder="Landmark" name="landmark" required="">
											</div>
										</div>
										<div class="clear"> </div>
									</div>
									<div class="controls">
										<input type="text" placeholder="Town/City" name="city" required="">
									</div>
									<div class="controls">
										<select class="option-w3ls">
											<option>Select Address type</option>
											<option>Office</option>
											<option>Home</option>
											<option>Commercial</option>

										</select>
									</div>
								</div>
								<button class="submit check_out">Delivery to this Address</button>
							</div>
						</div>
					</form>
					<div class="checkout-right-basket">
						<a href="payment.html">Make a Payment
							<span class="fa fa-hand-o-right" aria-hidden="true"></span>
						</a>
					</div>
				</div>-->

				<div class="checkout-right-basket">
						<a href="<?php echo base_url('product/enter_details') ?>">Place order
							<span class="fa fa-hand-o-right" aria-hidden="true"></span>
						</a>
					</div>
				<div class="clearfix"> </div>
			</div>
		</div>
	</div>
	<!-- //cart page -->



<!-- Footer -->
<?php $this->load->view('footer.php'); ?>
<!-- end footer -->

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

<script type="text/javascript">
	$(document).ready(function(){
	$(".item_qty").on('change',function(){
		var el = $(this).closest('tr');
		var id = $(el).find('#rowid').val();
		var qty = $(this).val();
		 //alert(qty);
		$.ajax({
			'url' : 'update_cart',
			'type' : 'POST',
			'data' : {'id':id,'qty':qty},
			success : function(result){
			window.location.href='';
			//console.log(result);
			}
		});
	});
});
</script>