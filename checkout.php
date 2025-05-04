<?php
ob_start();
include('header.php');

$user_id = $_SESSION['user']['user_id'];

if (isset($_SESSION['user']['user_id']) != "") {
	$sel = "select * from cart JOIN cake_master ON cake_master.cake_id = cart.cake_id where user_id = '$user_id' AND status = 'Pending'";
	$que = mysqli_query($con, $sel);
	$num = mysqli_num_rows($que);

	if ($num >= 1) {
		$cake_id = array();
		$cart_id = array();

		while ($que1 = mysqli_fetch_array($que)) {
			$cake_id[] = $que1['cake_id'];
			$cart_id[] = $que1['cart_id'];
		}

		$cake_ids = implode(',', $cake_id);
		$cart_ids = implode(',', $cart_id);
	}
} else {
	header("location:javascript://history.go(-1)");
}

if (isset($_POST['submit'])) {
	$fname = $_POST['fname'];
	$lname = $_POST['lname'];
	$name = $fname . " " . $lname;
	$user_id = $_SESSION['user']['user_id'];
	$cake_id = $_POST['cake_id'];
	$cart_id = $_POST['cart_id'];
	$add1 = $_POST['add1'];
	$add2 = $_POST['add2'];
	$address = $add1 . " " . $add2;
	$city = $_POST['city'];
	$country = $_POST['country'];
	$state = $_POST['state'];
	$zip = $_POST['zip'];
	$contact_no = $_POST['contact_no'];
	$email = $_POST['email'];
	$payment = $_POST['payment'];
	$payment_method = $_POST['payment_method'];
	$delivery_datetime = $_POST['delivery_datetime'];

	if ($fname == "") {
		$fnameErr = "First Name must be required!";
	} else if ($lname == "") {
		$lnameErr = "Last Name must be required!";
	} else if ($country == "") {
		$counErr = "Country must be required!";
	} else if ($add1 == "") {
		$add1Err = "Address1 must be required!";
	} else if ($city == "") {
		$cityErr = "City must be required!";
	} else if ($state == "") {
		$stateErr = "States must be required!";
	} else if ($zip == "") {
		$zipErr = "Zip Code must be required!";
	} else if ($contact_no == "") {
		$conErr = "Mobile No. must be required!";
	} else if ($email == "") {
		$emailErr = "Email must be required!";
	} else if ($payment_method == "") {
		$mtdERR = "Payment method must be selected!";
	} else if ($delivery_datetime == "") {
		$datetimeErr = "Delivery Date and Time must be required!";
	} else {
		$checkout = "insert into checkout (cake_id,cart_id,user_id,name,country,address,city,state,zip,contact_no,email,payment,payment_method,status,delivery_datetime) 
		values ('$cake_id','$cart_id','$user_id','$name','$country','$address','$city','$state','$zip','$contact_no','$email','$payment','$payment_method','Pending','$delivery_datetime')";
		$query = mysqli_query($con, $checkout);

		$last_id = mysqli_insert_id($con);

		$last_id_select = "select * from checkout where order_id = '$last_id'";
		$last_id_fire = mysqli_query($con, $last_id_select);
		$get_order_id = mysqli_fetch_array($last_id_fire);

		$_SESSION['order_id'] = $get_order_id['order_id'];
		$_SESSION['user_id'] = $get_order_id['user_id'];
		$_SESSION['cake_id'] = $get_order_id['cake_id'];
		$_SESSION['payment'] = $payment;

		if ($payment_method == "cod") {
			header('location:invoice.php');
		} else {
			header('location:payment/index.php');
		}
	}
}
?>

<div class="breadcrumb-option">
	<div class="container">
		<div class="row">
			<div class="col-lg-6 col-md-6 col-sm-6">
				<div class="breadcrumb__text">
					<h2>Checkout</h2>
				</div>
			</div>
			<div class="col-lg-6 col-md-6 col-sm-6">
				<div class="breadcrumb__links">
					<a href="index.php">Home</a>
					<span>Checkout</span>
				</div>
			</div>
		</div>
	</div>
</div>

<section class="checkout spad">
	<div class="container">
		<div class="checkout__form">
			<form method="post">
				<div class="row">
					<div class="col-lg-8 col-md-6">

						<input type="hidden" name="cart_id" value="<?php echo $cart_ids; ?>">
						<input type="hidden" name="cake_id" value="<?php echo $cake_ids; ?>">

						<h6 class="checkout__title">Billing Details</h6>
						<div class="row">
							<div class="col-lg-6">
								<div class="checkout__input">
									<p>First Name<span>*</span></p>
									<input type="text" name="fname">
									<?php if (isset($fnameErr)) { ?>
										<small style="color: red;"><?php echo $fnameErr; ?></small>
									<?php } ?>
								</div>
							</div>
							<div class="col-lg-6">
								<div class="checkout__input">
									<p>Last Name<span>*</span></p>
									<input type="text" name="lname">
									<?php if (isset($lnameErr)) { ?>
										<small style="color: red;"><?php echo $lnameErr; ?></small>
									<?php } ?>
								</div>
							</div>
						</div>
						<div class="checkout__input">
							<p>Country<span>*</span></p>
							<input type="text" name="country">
							<?php if (isset($counErr)) { ?>
								<small style="color: red;"><?php echo $counErr; ?></small>
							<?php } ?>
						</div>
						<div class="checkout__input">
							<p>Address<span>*</span></p>
							<input type="text" name="add1" placeholder="Street Address" class="checkout_input_add">
							<?php if (isset($add1Err)) { ?>
								<small style="color: red;"><?php echo $add1Err; ?></small>
							<?php } ?>
							<input type="text" name="add2" placeholder="Apartment, suite, unite etc(optional)">
						</div>
						<div class="checkout__input">
							<p>Town/City<span>*</span></p>
							<input type="text" name="city">
							<?php if (isset($cityErr)) { ?>
								<small style="color: red;"><?php echo $cityErr; ?></small>
							<?php } ?>
						</div>
						<div class="checkout__input">
							<p>Country/State<span>*</span></p>
							<input type="text" name="state">
							<?php if (isset($stateErr)) { ?>
								<small style="color: red;"><?php echo $stateErr; ?></small>
							<?php } ?>
						</div>
						<div class="checkout__input">
							<p>Postcode / ZIP<span>*</span></p>
							<input type="text" name="zip">
							<?php if (isset($zipErr)) { ?>
								<small style="color: red;"><?php echo $zipErr; ?></small>
							<?php } ?>
						</div>
						<div class="row">
							<div class="col-lg-6">
								<div class="checkout__input">
									<p>Phone<span>*</span></p>
									<input type="text" name="contact_no">
									<?php if (isset($conErr)) { ?>
										<small style="color: red;"><?php echo $conErr; ?></small>
									<?php } ?>
								</div>
							</div>
							<div class="col-lg-6">
								<div class="checkout__input">
									<p>Email<span>*</span></p>
									<input type="text" name="email">
									<?php if (isset($emailErr)) { ?>
										<small style="color: red;"><?php echo $emailErr; ?></small>
									<?php } ?>
								</div>
							</div>
						</div>

						<!-- New Date and Time Field -->
						<div class="checkout__input">
							<p>Delivery Date and Time<span>*</span></p>
							<input type="datetime-local" name="delivery_datetime" required>
							<?php if (isset($datetimeErr)) { ?>
								<small style="color: red;"><?php echo $datetimeErr; ?></small>
							<?php } ?>
						</div>

					</div>
					<div class="col-lg-4 col-md-6">
						<div class="checkout__order">
							<h6 class="order__title">Your order</h6>
							<div class="checkout_order_products">Product <span>Total</span></div>
							<ul class="checkout_total_products">
								<?php $i = 1;
								$total_price = 0;
								$sel1 = "select * from cart JOIN cake_master ON cake_master.cake_id = cart.cake_id where user_id = '$user_id' AND status = 'Pending'";
								$que1 = mysqli_query($con, $sel1);
								while ($record = mysqli_fetch_array($que1)) { ?>
									<li><samp><?php echo '0' . $i; ?></samp> <?php echo $record['name']; ?> * <?php echo $record['qty']; ?><span><i class="fa fa-rupee"></i> <?php echo $record['total_price']; ?></span></li>
								<?php $i++;
									$total_price = $total_price + $record['total_price'];
								} ?>
							</ul>
							<ul class="checkout_total_all">
								<li>Subtotal <span><i class="fa fa-rupee"></i> <?php echo $total_price; ?></span></li>

								<?php if ($total_price >= 2000) { ?>
									<li>Free delivery <span><?php echo $dc = 0; ?></span></li>
								<?php } else { ?>
									<li>Delivery Charge <span><i class="fa fa-rupee"></i> <?php echo $dc = 50; ?></span></li>
								<?php } ?>

								<li>Total <span><i class="fa fa-rupee"></i> <?php echo $tp = $total_price + $dc; ?></span></li>
							</ul>
							<?php $_SESSION['tp'] = $tp; ?>

							<div class="checkout_input_checkbox">
								<?php if (isset($mtdERR)) { ?>
									<small style="color: red;"><?php echo $mtdERR; ?></small>
								<?php } ?>
								<label for="cod">
									Cash On Delivery
									<input type="radio" id="cod" name="payment_method" value="cod">
									<span class="checkmark"></span>
								</label>
							</div>

							<div class="checkout_input_checkbox">
								<label for="card">
									Credit card / Debit card
									<input type="radio" id="card" name="payment_method" value="card">
									<span class="checkmark"></span>
								</label>
							</div>

							<input type="hidden" name="payment" value="<?php echo $total_price; ?>">
							<button type="submit" name="submit" class="site-btn">PLACE ORDER</button>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</section>

<?php include('footer.php'); ?>
