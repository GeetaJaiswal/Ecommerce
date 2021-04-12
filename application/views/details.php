<!DOCTYPE html>
<html lang="en-US">
<head>
<title>Purchase - Stripe Payment Gateway Integration</title>
<meta charset="utf-8">

<!-- header -->
<?php //$this->load->view('header.php'); ?>
<!-- end header -->

<!-- Stylesheet file -->
<link rel="stylesheet" href="<?php echo base_url('assets/css/style.css'); ?>">

<!-- Stripe JavaScript library -->
<script src="https://js.stripe.com/v2/"></script>
	
<!-- jQuery is used only for this example; it isn't required to use Stripe -->
<script src="<?php echo base_url('assets/js/jquery.min.js'); ?>"></script>
	
<script>
// Set your publishable key
Stripe.setPublishableKey('<?php echo $this->config->item('stripe_publishable_key'); ?>');

// Callback to handle the response from stripe
function stripeResponseHandler(status, response) {
	if (response.error) {
		// Enable the submit button
		$('#payBtn').removeAttr("disabled");
		// Display the errors on the form
		$(".card-errors").html('<p>'+response.error.message+'</p>');
	} else {
		var form$ = $("#paymentFrm");
		// Get token id
		var token = response.id;
		// Insert the token into the form
		form$.append("<input type='hidden' name='stripeToken' value='" + token + "' />");
		// Submit form to the server
		form$.get(0).submit();
	}
}

$(document).ready(function() {
	// On form submit
	$("#paymentFrm").submit(function() {
		// Disable the submit button to prevent repeated clicks
		$('#payBtn').attr("disabled", "disabled");
		
		// Create single-use token to charge the user
		Stripe.createToken({
			number: $('#card_number').val(),
			exp_month: $('#card_exp_month').val(),
			exp_year: $('#card_exp_year').val(),
			cvc: $('#card_cvc').val()
		}, stripeResponseHandler);
		
		// Submit from callback
		return false;
	});
});
</script>
</head>
<body>
<div class="container">
	<h1>Purchase - Stripe Payment Gateway Integration</h1>
	<div class="panel">
		<div class="panel-heading">
			<h3 class="panel-title">Charge <?php //echo '$'.$product['price']; ?> with Stripe</h3>
			
			<!-- Product Info -->
			<p><b>Item Name:</b> <?php //echo $product['name']; ?></p>
			<p><b>Price:</b> <?php // echo '$'.$product['price']//.' './/$product['currency']; ?></p>
		</div>
		<div class="panel-body">
			<!-- Display errors returned by createToken -->
			<div class="card-errors"></div>
			
			<!-- Payment form -->
			<form action="" method="POST" id="paymentFrm">
				<div class="form-group">
					<label>NAME</label>
					<input type="text" name="name" id="name" placeholder="Enter name" required="" autofocus="">
				</div>
				<div class="form-group">
					<label>EMAIL</label>
					<input type="email" name="email" id="email" placeholder="Enter email" required="">
				</div>
				<div class="form-group">
					<label>CARD NUMBER</label>
					<input type="text" name="card_number" id="card_number" placeholder="1234 1234 1234 1234" autocomplete="off" required="">
				</div>
				<div class="row">
					<div class="left">
						<div class="form-group">
							<label>EXPIRY DATE</label>
							<div class="col-1">
								<input type="text" name="card_exp_month" id="card_exp_month" placeholder="MM" required="">
							</div>
							<div class="col-2">
								<input type="text" name="card_exp_year" id="card_exp_year" placeholder="YYYY" required="">
							</div>
						</div>
					</div>
					<div class="right">
						<div class="form-group">
							<label>CVC CODE</label>
							<input type="text" name="card_cvc" id="card_cvc" placeholder="CVC" autocomplete="off" required="">
						</div>
					</div>
				</div>
				<button type="submit" class="btn btn-success" id="payBtn">Submit Payment</button>
			</form>
		</div>
	</div>
</div>
</body>
</html>

<!-- Footer -->
<?php //$this->load->view('footer.php'); ?>
<!-- end footer -->


<style type="text/css">
	.container{
	padding: 20px;
}
h1{
	color: #7a7a7a;
	font-size: 28px;
	text-transform: uppercase;
	text-align: center;
}
.pro-box {
	width: 25%;
    position: relative;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-orient: vertical;
    -webkit-box-direction: normal;
    -ms-flex-direction: column;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border: 1px solid rgba(0,0,0,.125);
    border-radius: .25rem;
	float: left;
    margin-right: 10px;
    margin-bottom: 10px;
}
.pro-box .info {
    -webkit-box-flex: 1;
    -ms-flex: 1 1 auto;
    flex: 1 1 auto;
    padding: 1.25rem;
}
.pro-box h4 {
	font-size: 1.25rem;
	font-weight: 500;
    margin-bottom: .75rem;
	color: #333;
	margin-top: 0;
}
.pro-box h5 {
	font-size: 1rem;
	font-weight: 500;
    margin-bottom: .75rem;
	color: #666;
}
.action{
	padding: 10px;
}
.action a {
    display: inline-block;
    font-weight: 400;
    text-align: center;
    white-space: nowrap;
    vertical-align: middle;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    border: 1px solid transparent;
    padding: .375rem .75rem;
    font-size: 1rem;
    line-height: 1.5;
    border-radius: .25rem;
    transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;
	color: #fff;
    background-color: #007bff;
    border-color: #007bff;
	text-decoration: none;
}
.action a:hover, .action a:active {
    color: #fff;
    background-color: #0069d9;
    border-color: #0062cc;
}
.action a:hover {
    color: #fff;
    background-color: #0069d9;
    border-color: #0062cc;
}
.action a:focus {
    box-shadow: 0 0 0 0.2rem rgba(0,123,255,.5);
}
.panel {
	width: 350px;
    margin: 0 auto;
    background-color: #fff;
    border: 1px solid transparent;
    border-radius: 4px;
    -webkit-box-shadow: 0 1px 1px rgba(0, 0, 0, .05);
    box-shadow: 0 2px 5px 0 rgba(0,0,0,0.16), 0 2px 10px 0 rgba(0,0,0,0.12);
	border-color: #ddd;
}
.panel-heading {
    padding: 10px 15px;
    border-bottom: 1px solid transparent;
    border-top-left-radius: 3px;
    border-top-right-radius: 3px;
}
.panel > .panel-heading {
    color: #333;
    background-color: #f5f5f5;
    border-color: #ddd;
}
.panel-title {
    margin-top: 0;
    margin-bottom: 0;
    font-size: 20px;
    color: #333;
	font-weight: 600;
}
.panel-body {
    padding: 15px;
}
.form-group {
    margin-bottom: 15px;
}
label {
    display: inline-block;
    margin-bottom: 5px;
    font-weight: bold;
}
.form-group input {
    display: block;
    width: 90%;
    height: 30px;
    padding: 6px 12px;
    font-size: 15px;
    line-height: 1.42857143;
    color: #555;
    background-color: #fff;
    background-image: none;
    border: 1px solid #ccc;
    border-radius: 4px;
    -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
    box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
    -webkit-transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
    transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
}
.form-group input:focus {
    border-color: #66afe9;
    outline: 0;
    -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075), 0 0 8px rgba(102, 175, 233, .6);
    box-shadow: inset 0 1px 1px rgba(0,0,0,.075), 0 0 8px rgba(102, 175, 233, .6);
}
.row .left {
    width: 52%;
    float: left;
}
.row .right {
    width: 40%;
    float: right;
}
.form-group .col-1{
	width: 25%;
    float: left;
    position: relative;
    margin-right: 20px;
}
.form-group .col-2{
	width: 38%;
    float: left;
    position: relative;
    margin-left: 18px;
}
.right .form-group input{
	width: 75%;
}
.btn {
	width: 100%;
    padding: 10px 16px;
    font-size: 18px;
    line-height: 1.33;
    border-radius: 6px;
	border: none;
	cursor: pointer;
}
.btn-success {
    color: #fff;
    background-color: #5cb85c;
    border-color: #4cae4c;
}
.btn-success:hover, .btn-success:focus, .btn-success:active, .btn-success.active {
    color: #fff;
    background-color: #47a447;
    border-color: #398439;
}
.card-errors p{
	font-size: 17px;
    border: 1px dashed;
    padding: 10px;
	color: #EA4335;
}

.status{
	padding: 15px;
	color: #000;
    background-color: #f1f1f1;
	box-shadow: 0 2px 5px 0 rgba(0,0,0,0.16), 0 2px 10px 0 rgba(0,0,0,0.12);
	margin-bottom: 20px;
}
.status h1{
	font-size: 1.8em;
}
.status h4{
	font-size: 1.3em;
	margin-bottom: 0;
}
.status p{
	font-size: 1em;
	margin-bottom: 0;
    margin-top: 8px;
}
.btn-link{
	display: inline-block;
    font-weight: 400;
    text-align: center;
    white-space: nowrap;
    vertical-align: middle;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    border: 1px solid transparent;
    padding: .375rem .75rem;
    font-size: 1rem;
    line-height: 1.5;
    border-radius: .25rem;
    transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;
	text-decoration: none;
}
.btn-link {
    color: #007bff;
    background-color: transparent;
    border-color: #007bff;
}
.btn-link:hover, .btn-link:active, .btn-link:focus {
    color: #fff;
    background-color: #007bff;
    border-color: #007bff;
	text-decoration: none;
}
.success{
	color: #34A853;
}
.error{
	color: #EA4335;
}
</style>