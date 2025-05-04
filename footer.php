
<footer class="footer set-bg" data-setbg="img/footer-bg.jpg">
	<div class="container">
		<div class="row">
			<div class="col-lg-4 col-md-6 col-sm-6">
				<div class="footer__widget">
					<h6>WORKING HOURS</h6>
					<ul>
						<li>Monday - Friday: 08:00 am – 08:30 pm</li>
						<li>Saturday: 10:00 am – 16:30 pm</li>
						<li>Sunday: 10:00 am – 16:30 pm</li>
					</ul>
				</div>
			</div>
			<div class="col-lg-4 col-md-6 col-sm-6">
				<div class="footer__about">
					<div class="footer__logo">
						<a href="#"><img src="img/footer-logo.png" alt=""></a>
					</div>
					<p class="footer_address">Deliciously crafted for every occasion. <br>
							📍 321 Cupcake Crescent, Sugar City, FL <br>
							📞 (321) 654-9870 <br>
							✉️ info@thecakestudio.com</p>
					<div class="footer__social">
						<a href="#"><i class="fa fa-facebook"></i></a>
						<a href="#"><i class="fa fa-twitter"></i></a>
						<a href="#"><i class="fa fa-instagram"></i></a>
						<a href="#"><i class="fa fa-youtube-play"></i></a>
					</div>
				</div>
			</div>
			<div class="col-lg-4 col-md-6 col-sm-6">
				<div class="footer__newslatter">
					<h6>Subscribe</h6>
					<p>Get latest updates and offers.</p>
					<?php 

					if(isset($_POST['subscribe']))
					{
						$email = $_POST['email'];

						$_SESSION['email'] = $email;
						header('location:subscribe.php');
					}

					 ?>
					<form method="post">
						<input type="text" name="email" id="email" placeholder="Email">
						<button type="submit" name="subscribe"><i class="fa fa-send-o"></i></button>
					</form>
				</div>
			</div>
		</div>
	</div>

</footer>


<div class="search-model">
	<div class="h-100 d-flex align-items-center justify-content-center">
		<div class="search-close-switch">+</div>
		<form class="search-model-form">
			<input type="text" id="search-input" placeholder="Search here.....">
		</form>
	</div>
</div>


<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.nice-select.min.js"></script>
<script src="js/jquery.barfiller.js"></script>
<script src="js/jquery.magnific-popup.min.js"></script>
<script src="js/jquery.slicknav.js"></script>
<script src="js/owl.carousel.min.js"></script>
<script src="js/jquery.nicescroll.min.js"></script>
<script src="js/main.js"></script>

<script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>
<script>
	window.dataLayer = window.dataLayer || [];
	function gtag(){dataLayer.push(arguments);}
	gtag('js', new Date());

	gtag('config', 'UA-23581568-13');
</script>
</body>

<!-- Mirrored from preview.colorlib.com/theme/cake/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 06 Feb 2021 21:26:49 GMT -->
</html>

