<?php 

ob_start();
include('header.php'); 

$sel = "select * from category";
$qu = mysqli_query($con,$sel);

$sel1 = "select * from cake_master JOIN category ON category.c_id = cake_master.c_id JOIN subcategory ON subcategory.s_id = cake_master.s_id ORDER BY cake_id DESC LIMIT 12";
$que1 = mysqli_query($con,$sel1);


?>

<section class="hero">
	<div class="hero__slider owl-carousel">
		<div class="hero__item set-bg" data-setbg="img/hero/hero-1.jpg">
			<div class="container">
				<div class="row d-flex justify-content-center">
					<div class="col-lg-8">
						<div class="hero__text">
							<h2>Making your life sweeter one bite at a time!</h2>
							<a href="shop.php" class="primary-btn">Our cakes</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="hero__item set-bg" data-setbg="img/hero/hero-1.jpg">
			<div class="container">
				<div class="row d-flex justify-content-center">
					<div class="col-lg-8">
						<div class="hero__text">
							<h2>Making your life sweeter one bite at a time!</h2>
							<a href="shop.php" class="primary-btn">Our cakes</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>


<section class="about spad">
	<div class="container">
		<div class="row">
			<div class="col-lg-6 col-md-6">
				<div class="about__text">
					<div class="section-title">
						<span>About Cake shop</span>
						<h2>Cakes and bakes from the house of Queens!</h2>
					</div>
					<p>The "Cake Shop" is a Jordanian Brand that started as a small family business. The owners are
					Dr. Iyad Sultan and Dr. Sereen Sharabati, supported by a staff of 80 employees.</p>
				</div>
			</div>
			<div class="col-lg-6 col-md-6">
				<div class="about__bar">
					<div class="about__bar__item">
						<p>Cake design</p>
						<div id="bar1" class="barfiller">
							<div class="tipWrap"><span class="tip"></span></div>
							<span class="fill" data-percentage="95"></span>
						</div>
					</div>
					<div class="about__bar__item">
						<p>Cake Class</p>
						<div id="bar2" class="barfiller">
							<div class="tipWrap"><span class="tip"></span></div>
							<span class="fill" data-percentage="80"></span>
						</div>
					</div>
					<div class="about__bar__item">
						<p>Cake Recipes</p>
						<div id="bar3" class="barfiller">
							<div class="tipWrap"><span class="tip"></span></div>
							<span class="fill" data-percentage="90"></span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>


<div class="categories">
	<div class="container">
		<div class="row">
			<div class="categories__slider owl-carousel">
				<?php while($que = mysqli_fetch_array($qu)) { ?>
				<div class="categories__item">
					<div class="categories__item__icon">
						<span class="<?php echo $que['class']; ?>"></span>
						<h5><?php echo $que['category_name']; ?></h5>
					</div>
				</div>
			<?php } ?>
				
			</div>
		</div>
	</div>
</div>


<section class="product spad">
	<div class="container">
		<div class="row">
		
			<?php while($latest = mysqli_fetch_array($que1)) { ?>
			<div class="col-lg-3 col-md-6 col-sm-6">
				<div class="product__item">
					<div class="product__item__pic set-bg" data-setbg="admin/image/<?php echo $latest['image']; ?>">
						<div class="product__label">
							<span><?php echo $latest['subcategory_name']; ?></span>
						</div>
					</div>
					<div class="product__item__text">
						<h6><a href="product.php?cake_id=<?php echo $latest['cake_id']; ?>"><?php echo $latest['name'] ?></a></h6>
						<div class="product__item__price"><i class="fa fa-rupee"></i> <?php echo $latest['price']; ?></div>
						<div class="cart_add">
							<a href="product.php?cake_id=<?php echo $latest['cake_id']; ?>">View Prodoct</a>
						</div>
					</div>
				</div>
			</div>
		<?php } ?>
			
		</div>
	</div>
</section>


<section class="class spad">
	<div class="container">
		<div class="row">
			<div class="col-lg-6">
				<div class="class__form">
					<div class="section-title">
						<span>Class cakes</span>
						<h2>Made from your <br />own hands</h2>
					</div>

					<?php 

					if(isset($_POST['submit']))
					{
						$name = $_POST['name'];
						$contact_no = $_POST['contact_no'];
						$class = $_POST['class'];
						$requirement = $_POST['requirement'];

						if($name=="")
						{
							echo "<script>alert('Name required');</script>";
						}
						else if($contact_no=="")
						{
							echo "<script>alert('Contact required');</script>";
						}
						else if($requirement=="")
						{
							echo "<script>alert('Requirement required');</script>";
						}
						else
						{
							$insert = "insert into class (`name`,`contact_no`,`class`,`requirement`) values ('$name','$contact_no','$class','$requirement')";
							$que1 = mysqli_query($con,$insert);
							if($insert)
							{
								echo "<script>alert('Your requirement accepted');</script>";
							}
						}

					}

					 ?>

					<form method="post">
						<input require type="text" name="name" value="<?php if(isset($_SESSION['user']['name'])) { echo $_SESSION['user']['name']; } ?>" placeholder="Name">
						<input require type="text" name="contact_no" value="<?php if(isset($_SESSION['user']['contact_no'])) { echo $_SESSION['user']['contact_no']; } ?>" placeholder="Phone">
						<select name="class">
							<option>Studying Class</option>
							<option>Writting Class</option>
							<option>Reading Class</option>
						</select>
						<input require type="text" name="requirement" placeholder="Type your requirements">
						<button type="submit" name="submit" class="site-btn">registration</button>
					</form>
				</div>
			</div>
		</div>
		<div class="class__video set-bg" data-setbg="img/class-video.jpg">
			<a href="https://www.youtube.com/watch?v=8PJ3_p7VqHw&amp;list=RD8PJ3_p7VqHw&amp;start_radio=1" class="play-btn video-popup"><i class="fa fa-play"></i></a>
		</div>
	</div>
</section>


<section class="team spad">
	<div class="container">
		<div class="row">
			<div class="col-lg-7 col-md-7 col-sm-7">
				<div class="section-title">
					<span>Our team</span>
					<h2>Sweet Baker </h2>
				</div>
			</div>
			
		</div>
		<div class="row">
			<?php $sel_chef = "select * from chef";
				$qu_chef = mysqli_query($con,$sel_chef);
				while($rec_chef = mysqli_fetch_array($qu_chef)) { ?>
			<div class="col-lg-3 col-md-6 col-sm-6">
				<div class="team__item set-bg" data-setbg="admin/chef/<?php echo $rec_chef['image']; ?>">
					<div class="team__item__text">
						<h6><?php echo $rec_chef['chef_name']; ?></h6>
						<span><?php echo $rec_chef['designation']; ?></span>
						
					</div>
				</div>
			</div>
			<?php } ?>
		</div>
	</div>
</section>


<section class="testimonial spad">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 text-center">
				<div class="section-title">
					<span>Testimonial</span>
					<h2>Our client say</h2>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="testimonial__slider owl-carousel">
				<?php $sel = "select * from review_by";
				$que2 = mysqli_query($con,$sel);
				while($query = mysqli_fetch_array($que2)) { ?>
				<div class="col-lg-6">
					<div class="testimonial__item">
						<div class="testimonial__author">
							
							<div class="testimonial__author__text">
								<h5><?php echo $query['name']; ?></h5>
								<span><?php echo $query['review']; ?></span>
							</div>
						</div>
						<div class="rating">
							<?php for($i=0;$i<$query['rating'];$i++) { ?>
							<span class="icon_star"></span>
							<?php } ?>
						</div>
						
					</div>
				</div>
				<?php } ?>
			</div>
		</div>
	</div>
</section>


<section class="class spad">
	<div class="container">
		<div class="row">
			<div class="col-lg-6" style="margin: 0 300px;">
				<div class="class__form">
					<div class="section-title">
						<span>Review on your experience</span>
						<h2>Give Review</h2>
					</div>

					<?php 

					if(isset($_POST['review_by']))
					{
						if(isset($_SESSION['user']['user_id']))
						{
							$name = $_POST['name'];
							$user_id = $_POST['user_id'];
							$contact_no = $_POST['contact_no'];
							$review = $_POST['review'];
							$rating = $_POST['rating'];

							$sel = "select * from review_by where `user_id` = '$user_id'";
							$que = mysqli_query($con,$sel);
							$num = mysqli_num_rows($que);

							if($num>=1)
							{
								echo "<script>alert('You have already done review');</script>";
							}
							else if($name=="")
							{
								echo "<script>alert('Name required');</script>";
							}
							else if($contact_no=="")
							{
								echo "<script>alert('Contact required');</script>";
							}
							else if($rating=="")
							{
								echo "<script>alert('Rating must give us');</script>";
							}
							else if($review=="")
							{
								echo "<script>alert('Review must be required');</script>";
							}
							
							else
							{
								$insert = "insert into review_by (`name`,`contact_no`,`review`,`user_id`,`rating`) values ('$name','$contact_no','$review','$user_id','$rating')";
								$que1 = mysqli_query($con,$insert);
								if($insert)
								{
									echo "<script>alert('Your review accepted');</script>";
								}
							}

						}
						else
						{
							header('location:login.php');
						}

					}
				

					 ?>

					<form method="post">
						<input require type="hidden" name="user_id" value="<?php echo @$_SESSION['user']['user_id']; ?>">
						<input require type="text" name="name" value="<?php if(isset($_SESSION['user']['name'])) { echo $_SESSION['user']['name']; } ?>" placeholder="Name">
						<input require type="text" name="contact_no" value="<?php if(isset($_SESSION['user']['contact_no'])) { echo $_SESSION['user']['contact_no']; } ?>" placeholder="Phone">
						<select name="rating">
							<option value="">Give Rating</option>
							<option value="1">1 Star</option>
							<option value="2">2 Star</option>
							<option value="3">3 Star</option>
							<option value="4">4 Star</option>
							<option value="5">5 Star</option>
						</select>
						
						<input require type="text" name="review" placeholder="Type your review">
						<button type="submit" name="review_by" class="site-btn">Give Review</button>
					</form>
				</div>
			</div>
		</div>
		
	</div>
</section>





<?php include('footer.php'); ?>