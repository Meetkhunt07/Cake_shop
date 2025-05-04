<?php 

ob_start();
include('header.php');

// include('admin/db.php');

if(isset($_GET['cake_id']))
{
	$cake_id = $_GET['cake_id'];
	$sel = "select * from cake_master JOIN category ON category.c_id = cake_master.c_id JOIN subcategory ON subcategory.s_id = cake_master.s_id where `cake_id` = '$cake_id'";
	$qu = mysqli_query($con,$sel);
	$product = mysqli_fetch_array($qu);
}
else
{
	header("location:javascript://history.go(-1)");
}

if(isset($_POST['submit']))
{
	$cake_id = $_POST['cake_id'];
	$user_id = $_POST['user_id'];
	$price = $_POST['price'];
	$total_price = $_POST['total_price'];
	$s_weight = $_POST['s_weight'];
	$qty = $_POST['qty'];
	$suggestion = $_POST['suggestion'];
	@$photo = $_FILES['photo']['name'];
	@move_uploaded_file($_FILES['photo']['tmp_name'], "order_pic/".$photo);

	if($suggestion=="")
	{
		echo "<script>alert('Suggestion must be required');</script>";
	}
	else if($s_weight=="")
	{
		echo "<script>alert('Weight must be required');</script>";
	}
	else
	{
		 if(isset($_SESSION['user']['user_id'])!="")
        {
            $user_id = $_SESSION['user']['user_id'];
            $sel1 = "select * from cart where `cake_id` = '$cake_id' AND `user_id` = '$user_id' AND `status` != 'Completed'";
            $que2 = mysqli_query($con,$sel1);
            $num = mysqli_num_rows($que2);

            if($num==0)
            {
				$insert = "insert into cart (`cake_id`,`user_id`,`price`,`total_price`,`s_weight`,`qty`,`suggestion`,`photo`,`status`) values ('$cake_id','$user_id','$price','$total_price','$s_weight','$qty','$suggestion','$photo','Pending')";

				$que1 = mysqli_query($con,$insert);
				header('location:cart.php');
            }
            else
            {
				echo "<script>alert('Item already added in cart');</script>";
            }
        }
        else
        {
        	header('location:login.php');
        }

	}

}


	if(isset($_GET['cake_id']))
	{
		$cake_id = $_GET['cake_id'];
		$sel = "select * from cake_master where `cake_id` = '$cake_id'";
		$que = mysqli_query($con,$sel);
		$fetch = mysqli_fetch_array($que);
		$category = $fetch['c_id'];

		$sel1 = "select * from cake_master JOIN category ON category.c_id = cake_master.c_id JOIN subcategory ON subcategory.s_id = cake_master.s_id where cake_master.`c_id` = '$category'";
		$que1 = mysqli_query($con,$sel1);
	}


?>




<div class="breadcrumb-option">
	<div class="container">
		<div class="row">
			<div class="col-lg-6 col-md-6 col-sm-6">
				<div class="breadcrumb__text">
					<h2>Product detail</h2>
				</div>
			</div>
			<div class="col-lg-6 col-md-6 col-sm-6">
				<div class="breadcrumb__links">
					<a href="index.php">Home</a>
					<a href="shop.php">Shop</a>
					<span><?php echo $product['name']; ?> with <?php echo $product['flavour']; ?></span>
				</div>
			</div>
		</div>
	</div>
</div>


	<section class="product-details spad">
		<div class="container">
			<div class="row">
				<div class="col-lg-6">
					<div class="product__details__img">
						<div class="product__details__big__img">
							<img class="big_img" src="admin/image/<?php echo $product['image']; ?>" alt="">
						</div>
						<div class="product__details__thumb">
							<div class="pt__item active">
								<img data-imgbigurl="admin/image/<?php echo $product['image']; ?>" src="admin/image/<?php echo $product['image']; ?>" alt="">
							</div>

							<?php $mimg = explode(',',$product['mimage']);
							for($i=0;$i<count($mimg);$i++) { ?>
								<div class="pt__item">
									<img data-imgbigurl="admin/image/<?php echo $mimg[$i]; ?>" src="admin/image/<?php echo $mimg[$i]; ?>" alt="">
								</div>
							<?php } ?>

						</div>
					</div>
				</div>


				<div class="col-lg-6">
				<form method="post" enctype="multipart/form-data"> 

					<input type="hidden" name="cake_id" value="<?php echo $product['cake_id']; ?>">
					<input type="hidden" name="user_id" value="<?php if(isset($_SESSION['user']['name'])) { echo $_SESSION['user']['name']; } ?>">




					<div class="product__details__text">
						<div class="product__label"><?php echo $product['category_name']; ?></div>
						<h4><?php echo $product['name']; ?></h4>
						<h5><i class="fa fa-rupee"></i> <?php echo $product['price']; ?></h5>
						<input type="hidden" name="price" value="<?php echo $product['price']; ?>" id="price">
						<p><?php echo $product['description']; ?></p>
						<ul>
							<li>Category: <span><?php echo $product['subcategory_name']; ?></span></li>
							<li>Flavour: <span><?php echo $product['flavour']; ?></span></li>
							<!-- <li>Weight: <span><?php echo $product['weight']; ?></span></li> -->
						</ul>
						<div class="product__details__option">
							<div class="quantity"  onclick="return getprice()">
								<div class="pro-qty">
									<input type="text" name="qty" value="1" id="qty">
								</div>
							</div>
						</div><br>
						<div class="product__details__option">
							<h5 id="total_price"><?php echo $product['price']; ?></h5>
							<input type="hidden" id="total_price1" name="total_price" value="<?php echo $product['price']; ?>">

							<?php if($product['s_id']==2) { ?>
								<div class="d-flex flex-wrap">
									<p class="col-lg-3">Select Pieces:</p>
									<label id="form" class="col-lg-3"><button type="button" name="weight" onclick="return cakeweight('6')" value="6" id="weight" style="width: 112px !important;" class="btn  btn-warning hover-btn addItemBtn">6 Piece</button></label>
									<label id="form" class="col-lg-3"><button type="button" name="weight" onclick="return cakeweight('12')" value="12" id="weight" style="width: 112px !important;" class="btn  btn-warning hover-btn addItemBtn">12 Piece</button></label>

								</div>
								<div class="mt-3 ml-4">
									<label style="margin-left: -8px;">Selected Weight :</label>
									<input style="border: none" readonly type="text" name="s_weight" value="1" class="flavour-select" id="cake_weight1">
								</div>

							<?php  } else if($product['s_id']==3) { ?>

								<div class="d-flex flex-wrap">
									<p class="col-lg-3">Select Pieces:</p>
									<label id="form" class="col-lg-3"><button type="button" name="weight" onclick="return cakeweight('2')" value="2" id="weight" style="width: 112px !important;" class="btn  btn-warning hover-btn addItemBtn">2 Piece</button></label>
									<label id="form" class="col-lg-3"><button type="button" name="weight" onclick="return cakeweight('4')" value="4" id="weight" style="width: 112px !important;" class="btn  btn-warning hover-btn addItemBtn">4 Piece</button></label>

								</div>

								<div class="mt-3 ml-4">
									<label style="margin-left: -8px;">Selected Weight :</label>
									<input style="border: none" readonly type="text" name="s_weight" value="1" class="flavour-select" id="cake_weight1">
								</div>

							<?php } else { ?>
								<div class="d-flex flex-wrap">
									<p class="col-lg-3">Weight :</p>
									<label id="form" class="col-lg-3"><button type="button" name="weight" onclick="return cakeweight('0.5')" value="0.5" id="weight" style="width: 112px !important;" class="btn  btn-warning hover-btn addItemBtn">500 GM</button></label>
									<label id="form" class="col-lg-3"><button type="button" name="weight" onclick="return cakeweight('1')" value="1" id="weight" style="width: 112px !important;" class="btn  btn-warning hover-btn addItemBtn">1.0 KG</button></label>
									<label id="form" class="col-lg-3"><button type="button" name="weight" onclick="return cakeweight('1.5')" value="1.5" id="weight" style="width: 112px !important;" class="btn  btn-warning hover-btn addItemBtn">1.5 KG</button></label>
									<label id="form" class="col-lg-3"><button type="button" name="weight" onclick="return cakeweight('2')" value="2" id="weight" style="width: 112px !important;" class="btn  btn-warning hover-btn addItemBtn">2.0 KG</button></label>
									<label id="form" class="col-lg-3"><button type="button" name="weight" onclick="return cakeweight('2.5')" value="2.5" id="weight" style="width: 112px !important;" class="btn  btn-warning hover-btn addItemBtn">2.5 KG</button></label>
									<label id="form" class="col-lg-3"><button type="button" name="weight" onclick="return cakeweight('3')" value="3" id="weight" style="width: 112px !important;" class="btn  btn-warning hover-btn addItemBtn">3.0 KG</button></label>
									<label id="form" class="col-lg-3"><button type="button" name="weight" onclick="return cakeweight('3.5')" value="3.5" id="weight" style="width: 112px !important;" class="btn  btn-warning hover-btn addItemBtn">3.5 KG</button></label>
								</div>
								<div class="mt-3 ml-4">
									<label style="margin-left: -8px;">Selected Weight :</label>
									<input style="border: none"  readonly type="text" name="s_weight" value="1" class="flavour-select" id="cake_weight1">
								</div>
								<?php } ?><br>

								<label>Suggestion :</label><br>
								<textarea name="suggestion" style="width: 100%" placeholder="Give the name which design on cake"></textarea>

								<?php if($product['s_id']==4) { ?>
									<br><br><label>Photo on cake :</label>
									<input type="file" name="photo">
								<?php } ?>
							</div>
							<br>
							<div>
								<button type="submit" name="submit" class="primary-btn">Add to cart</button>
							</div>
						</div>
					</div>
				</form>
				</div>
			</div>
		</section>

		<section class="related-products spad">
			<div class="container">
				<div class="row">
					<div class="col-lg-12 text-center">
						<div class="section-title">
							<h2>Related Products</h2>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="related__products__slider owl-carousel">
						<?php while($record = mysqli_fetch_array($que1)) { ?>
						<div class="col-lg-3">
							<div class="product__item">
								<div class="product__item__pic set-bg" data-setbg="admin/image/<?php echo $record['image']; ?>">
									<div class="product__label">
										<span><?php echo $record['subcategory_name']; ?></span>
									</div>
								</div>
								<div class="product__item__text">
									<h6><a href="product.php?cake_id=<?php echo $record['cake_id']; ?>"><?php echo $record['name'] ?></a></h6>
									<div class="product__item__price"><i class="fa fa-rupee"></i> <?php echo $record['price']; ?></div>
									<div class="cart_add">
										<a href="product.php?cake_id=<?php echo $record['cake_id']; ?>">View Product</a>
									</div>
								</div>
							</div>
						</div>
						<?php } ?>
					</div>
				</div>
			</div>
		</section>


		<?php include('footer.php'); ?>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

		<script>

			function getprice()
			{
				var qty = $('#qty').val();
				var price = $('#price').val();
				var cake_weight = $('#cake_weight1').val();

				if(qty>=1)
				{
					var total_price = (qty * price) * cake_weight;

					$('#total_price1').val(total_price);
					$('#total_price').html(total_price);
				}
				else
				{
					$('#qty').val(1);
					$('#total_price1').val(price);
					$('#total_price').html(price);
				}

			}

			function cakeweight(w)
			{
				var qty = $('#qty').val();
				var price = $('#price').val();

				var total_price = (price * w) * qty;
				$('#total_price1').val(total_price);
				$('#total_price').html(total_price);
				$('#cake_weight').val(w);
				$('#cake_weight1').val(w);
				document.getElementById('cake_weight1').type = "text";

			}



		</script>