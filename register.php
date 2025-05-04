<?php 

ob_start();
include('header.php');

if(isset($_POST['submit']))
{
	$name = $_POST['name'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$contact_no = $_POST['contact_no'];

	if($name=="")
	{
		$nameERR = "Name must be required";
	}
	elseif($email=="")
	{ 
		$emailERR  = "Email must be required";
	}
	elseif($contact_no=="")
	{
		$contactERR = "contact must be required";
	}
	elseif($password=="")
	{
		$passwordERR = "Password must be required";
	}
	else
	{
		$insert = "insert into user (`name`,`email`,`password`,`contact_no`) values ('$name','$email','$password','$contact_no')";
		$qu = mysqli_query($con,$insert);

		if($qu)
		{
			header('location:login.php');
		}
	}
}

?>


<section class="hero">
	<div class="hero__slider owl-carousel">
		<div class="hero__item set-bg" data-setbg="img/hero/2.jpg">
			<div class="container">
				<div class="row d-flex justify-content-center">
					<div class="col-lg-8">
						<div class="hero__text">
							<h2>Register</h2>
						</div>
					</div>
				</div>
			</div>
		</div>
		
	</div>
</section>







<section class="class spad">
	<div class="container">
		<div class="row" >
			<div class="col-lg-6" style="margin: 0 300px;">
				<div class="class__form">
					<div class="section-title">
						<span>Register</span>
						<h2>Made from your <br />account</h2>
					</div>
				<?php if(isset($msg)) { ?>
					<div class="alert alert-success"><?php echo $msg; ?></div>
				<?php } ?>
					<form method="post">
					<?php if(isset($nameERR)) { ?>
						<small style="color:red;"><?php echo $nameERR; ?></small>
					<?php } ?>
						<input require type="text" name="name" placeholder="Name">
							<?php if(isset($emailERR)) { ?>
						<small style="color:red;"><?php echo $emailERR; ?></small>
					<?php } ?>
						<input require type="email" name="email" placeholder="Enter Email">
							<?php if(isset($contactERR)) { ?>
						<small style="color:red;"><?php echo $contactERR; ?></small>
					<?php } ?>
						<input require type="text" name="contact_no" placeholder="Phone">
						<!-- <select>
							<option value="">Studying Class</option>
							<option value="">Writting Class</option>
							<option value="">Reading Class</option>
						</select> -->
							<?php if(isset($passwordERR)) { ?>
						<small style="color:red;"><?php echo $passwordERR; ?></small>
					<?php } ?>
						<input type="password" name="password" placeholder="Enter the password">
						<button type="submit" name="submit" class="site-btn">registration</button>
					</form>
				</div>
			</div>
		</div>
		
	</div>
</section>



<?php include('footer.php'); ?>