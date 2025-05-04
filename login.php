<?php 

ob_start();
include('header.php');

if(isset($_POST['submit']))
{
	$email = $_POST['email'];
	$password = $_POST['password'];


	if($email=="")
	{ 
		$emailERR  = "Email must be required";
	}

	elseif($password=="")
	{
		$passwordERR = "Password must be required";
	}
	else
	{
		$sel ="select * from user where `email` = '$email' AND `password` = '$password'";
		$qu  = mysqli_query($con,$sel);
		$num = mysqli_num_rows($qu);

		if($num)
		{
			$record = mysqli_fetch_array($qu);
			$_SESSION['user'] = $record;
			header('location:index.php');
		}
		else
		{
			$msg = "Invalid email or password";
		}
	}
}

?>


<section class="hero">
	<div class="hero__slider owl-carousel">
		<div class="hero__item set-bg" data-setbg="img/hero/3.jpg">
			<div class="container">
				<div class="row d-flex justify-content-center">
					<div class="col-lg-8">
						<div class="hero__text">
							<h2>Login</h2>
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
						<span>Login</span>
						<h2>Made from your <br />Own account</h2>
					</div>
				<?php if(isset($msg)) { ?>
					<div class="alert alert-danger"><?php echo $msg; ?></div>
				<?php } ?>
					<form method="post">
					
							<?php if(isset($emailERR)) { ?>
						<small style="color:red;"><?php echo $emailERR; ?></small>
					<?php } ?>
						<input require type="email" name="email" placeholder="Enter Email">
							<?php if(isset($contactERR)) { ?>
						<small style="color:red;"><?php echo $contactERR; ?></small>
					<?php } ?>
					
					<?php if(isset($passwordERR)) { ?>
						<small style="color:red;"><?php echo $passwordERR; ?></small>
					<?php } ?>
						<input require type="password" name="password" placeholder="Enter the password">
						<div>
						<a href="forgot_password.php" style="color:brown;">Forgot Password ?</a>
						</div>
						<button type="submit" name="submit" class="site-btn">Login</button>
					</form>
				</div>
			</div>
		</div>
		
	</div>
</section>



<?php include('footer.php'); ?>