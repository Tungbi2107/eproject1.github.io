<?php

    function redirect($location){
        header("Location: $location");
    }

    function query($sql){

        global $connection;
        return mysqli_query($connection,$sql);
    }

    function confirm($result){
        global $connection;
        if(!$result){
            die("QUERY FAILED" . mysqli_error($connection));
        }
    }

    function escape_string($string){
        global $connection;
        return mysqli_real_escape_string($connection,$string);
    }

    function fetch_array($result){
        return mysqli_fetch_array($result);
    }



/*--------------------------------------------FRONT END -----------------------------------------------------*/
/*--------------------------------------------FRONT END -----------------------------------------------------*/
/*--------------------------------------------FRONT END -----------------------------------------------------*/

	function login_user(){
		if(isset($_POST['submit'])){

			$username = escape_string($_POST['username']);
			$password = escape_string($_POST['pass']);

			$query = query("SELECT * FROM users WHERE username = '{$username}' and password = '{$password}'");
			confirm($query);
			if(mysqli_num_rows($query)==0){
				redirect('login.php');
			}
			else{
				redirect('../public/admin/index.php');
			}
			}

		}
	
    function get_products(){
        $query = query("SELECT * FROM products");
        confirm($query);

        while( $row = fetch_array($query)){
				$product = <<<DELIMETER
				<div class="product">
					<div class="product_image"><a href="product.php?id={$row['product_id']}"><img src="{$row['product_image']}"></a></div>
						<div class="product_extra product_new"><a href="product.php?id={$row['product_id']}">New</a></div>
							<div class="product_content">
								<div class="product_title"><a href="product.php?id={$row['product_id']}">{$row['product_title']}</a></div>
								<div class="product_price">&#36;{$row['product_price']}</div>
							</div>
				</div>
				DELIMETER;

            echo $product;
        }
    }

    function get_categories(){
        $query = query("SELECT * FROM categories");
        confirm($query);
        
        while($row = fetch_array($query)){
		$category_links = <<<DELIMETER
			<li><a href='categories.php?id={$row['cat_id']}'>{$row['cat_title']}</a></li>
			DELIMETER;

						echo $category_links;
					}
		}


    function get_products_in_cat_page(){
        $query = query("SELECT * FROM products WHERE product_category_id = ". escape_string($_GET['id']) . "");
        confirm($query);

        while( $row = fetch_array($query)){
			$product = <<<DELIMETER
			<div class="product">
				<div class="product_image"><a href="product.php?id={$row['product_id']}"><img src="{$row['product_image']}" alt=""></a></div>
					<div class="product_extra product_new"><a href="product.php?id={$row['product_id']}">New</a></div>
						<div class="product_content">
							<div class="product_title"><a href="product.php?id={$row['product_id']}">{$row['product_title']}</a></div>
							<div class="product_price">&#36;{$row['product_price']}</div>
						</div>
			</div>
			DELIMETER;
        echo $product;
        }
    }

    function show_total_product(){
        $query = query("SELECT COUNT(product_id) FROM products WHERE product_category_id = ". escape_string($_GET['id']) . "");
        confirm($query);

        while( $row = fetch_array($query)){
			$total = <<<DELIMETER
			<div class="results">Showing <span>{$row['COUNT(product_id)']}</span> results</div>
			DELIMETER;

						echo $total;
					}
				}
    	//     function cart(){
	// 		$query = query("SELECT * FROM products");
	// 		confirm($query);
	
	// 		while($row = fetch_array($query)){
	// $product = <<<DELIMETER
	// <div class="cart_item d-flex flex-lg-row flex-column align-items-lg-center align-items-start justify-content-start">
	// 	<!-- Name -->
	// 	<div class="cart_item_product d-flex flex-row align-items-center justify-content-start">
	// 		<div class="cart_item_image">
	// 			<div><img src="images/cart_1.jpg" alt=""></div>
	// 		</div>
	// 		<div class="cart_item_name_container">
	// 			<div class="cart_item_name"><a href="#">Smart Phone Deluxe Edition</a></div>
	// 			<div class="cart_item_edit"><a href="#">Edit Product</a></div>
	// 		</div>
	// 	</div>
	// 	<!-- Price -->
	// 	<div class="cart_item_price">$790.90</div>
	// 	<!-- Quantity -->
	// 	<div class="cart_item_quantity">
	// 		<div class="product_quantity_container">
	// 			<div class="product_quantity clearfix">
	// 				<span>Qty</span>
	// 				<input id="quantity_input" type="text" pattern="[0-9]*" value="1">
	// 				<div class="quantity_buttons">
	// 					<div id="quantity_inc_button" class="quantity_inc quantity_control"><i class="fa fa-chevron-up" aria-hidden="true"></i></div>
	// 					<div id="quantity_dec_button" class="quantity_dec quantity_control"><i class="fa fa-chevron-down" aria-hidden="true"></i></div>
	// 				</div>
	// 			</div>
	// 		</div>
	// 	</div>
	// 	<!-- Total -->
	// 	<div class="cart_item_total">$790.90</div>
	// </div>
	// DELIMETER;
	// echo $product;
	// 		}
	// 	}
/*---------------------------------------------------BACK END -----------------------------------------------------*/
/*---------------------------------------------------BACK END -----------------------------------------------------*/
/*---------------------------------------------------BACK END -----------------------------------------------------*/

		function show_categories_in_admin(){
			$query = "SELECT * FROM `categories`";
			$category_query = query($query);
			confirm($query);

			while($row = fetch_array($category_query)){
				$cat_id = $row['cat_id'];
				$cat_title = $row['cat_title'];

					$categories = <<<DELIMETER
						<tr>
							<td>{$cat_id}</td>
							<td>{$cat_title}</td>
							<td>
								<a class="btn btn-danger" href="../../resources/templates/back/delete_category.php?id={$row['cat_id']}">Delete</a>
								<a class="btn btn-info" href="#">Update</a>
							</td>
						</tr>
					DELIMETER;
									echo $categories;
								}
							}

		function add_category(){
			if(isset($_POST['add_category'])){

				$cat_title = escape_string($_POST['cat_title']);
				if(empty($cat_title) || $cat_title == ""){
					echo "Category is not empty";
				}
				else{
					$insert_cat = query("INSERT INTO `categories`(`cat_title`) VALUES ('{$cat_title}') ");
					confirm($insert_cat);
					redirect("categories.php");
				}
				
			}
		}			
		function show_categories_in_add_product(){
			$query = query("SELECT DISTINCT product_category_id FROM `products`");
			confirm($query);

			while($row = fetch_array($query)){
				$product = <<<DELIMETER
				<option value="{$row['product_category_id']}">{$row['product_category_id']}</option>
			DELIMETER;
							echo $product;
						}
					}



		function get_products_in_admin(){
			$query = query("SELECT * FROM products");
			confirm($query);
	
			while( $row = fetch_array($query)){
					$product = <<<DELIMETER
					<tr>
						<td>{$row['product_id']}</td>
						<td>{$row['product_category_id']}</td>
						<td>{$row['product_title']}</td>
						<td>{$row['product_price']}</td>
						<td>{$row['product_quantity']}</td>	
						<!-- <td>{$row['product_description']}</td> -->
						<td> 
							<a class="btn btn-danger" href="../../resources/templates/back/delete_product.php?id={$row['product_id']}">Delete</a>
							 <a class="btn btn-info" href="#">Update</a>
							 </td>
					</tr>
					DELIMETER;
	
				echo $product;
			}
		}
		function add_product(){
			if(isset($_POST['add_product'])){

				$product_title = escape_string($_POST['product_title']);
				$product_category_id = escape_string($_POST['product_category_id']);
				$product_price = escape_string($_POST['product_price']);
				$product_quantity = escape_string($_POST['product_quantity']);
				$product_description = escape_string($_POST['product_description']);
				$product_image = escape_string($_FILES['file']['name']);
				$image_temp_location = escape_string($_FILES['file']['tmp_name']);

				move_uploaded_file($image_temp_location,UPLOAD_DIRECTORY . DS .$product_image);
				$insert_product = query("INSERT INTO `products`(`product_title`, `product_category_id`, `product_price`, `product_quantity`, `product_description`, `product_image`) VALUES ('{$product_title}','{$product_category_id}','{$product_price}','{$product_quantity}','{$product_description}','{$product_image}') ");
					confirm($insert_product);
					redirect("add_product.php");
				}
				
			}

?>