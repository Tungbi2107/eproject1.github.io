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
			if(mysqli_num_rows($query)==1){
				$_SESSION['username'] = $username;
				$row=fetch_array($query);
				if ($row['level']==1){
					redirect('../public/admin/index.php');
			}
				if($row['level']==0) {
						redirect('../public/index.php');
			}
			}
			else{
				redirect('login.php');
			}
		}
			}

	function signup_user(){
		if(isset($_POST['submit'])){

			$username = escape_string($_POST['username']);
			$password = escape_string($_POST['password']);
			$email = escape_string($_POST['email']);
			$phonenumber = escape_string($_POST['phonenumber']);
			$confirmpassword = escape_string($_POST['confirmpassword']);
		if($confirmpassword==$password)
		{
		$query = query("INSERT INTO `users`(`username`, `password`, `email`, `phonenumber`) VALUES ('$username','$password','$email','$phonenumber'");
		confirm($query);
	}
	}
	}
	
    function get_products(){
        $query = query("SELECT * FROM products");
        confirm($query);

        while( $row = fetch_array($query)){
				$product = <<<DELIMETER
				<div class="product">
					<div class="product_image"><a href="product.php?id={$row['product_id']}&cat_id={$row['cat_id']}"><img src="../resources/uploads/{$row['product_image']}" alt=""></a></div>
						<div class="product_extra product_new"><a href="product.php?id={$row['product_id']}&cat_id={$row['cat_id']}">New</a></div>
							<div class="product_content">
								<div class="product_title"><a href="product.php?id={$row['product_id']}&cat_id={$row['cat_id']}">{$row['product_title']}</a></div>
								<div class="product_price">&#36;{$row['product_price']}</div>
							</div>
				</div>
				DELIMETER;

            echo $product;
        }
	}
	function get_products_4(){
        $query = query("SELECT * FROM products limit 4");
        confirm($query);

        while( $row = fetch_array($query)){
				$product = <<<DELIMETER
				<div class="product">
					<div class="product_image"><a href="product.php?id={$row['product_id']}&cat_id={$row['cat_id']}"><img src="../resources/uploads/{$row['product_image']}" alt=""></a></div>
						<div class="product_extra product_new"><a href="product.php?id={$row['product_id']}&cat_id={$row['cat_id']}">New</a></div>
							<div class="product_content">
								<div class="product_title"><a href="product.php?id={$row['product_id']}&cat_id={$row['cat_id']}">{$row['product_title']}</a></div>
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

		function get_all_products_in_cat_page(){
			$query = query("SELECT * FROM products");
			confirm($query);
	
			while( $row = fetch_array($query)){
				$product = <<<DELIMETER
				<div class="product">
					<div class="product_image"><a href="product.php?id={$row['product_id']}&cat_id={$row['cat_id']}"><img src="../resources/uploads/{$row['product_image']}" alt=""></a></div>
						<div class="product_extra product_new"><a href="product.php?id={$row['product_id']}&cat_id={$row['cat_id']}">New</a></div>
							<div class="product_content">
								<div class="product_title"><a href="product.php?id={$row['product_id']}&cat_id={$row['cat_id']}">{$row['product_title']}</a></div>
								<div class="product_price">&#36;{$row['product_price']}</div>
							</div>
				</div>
				DELIMETER;
			echo $product;
			}
		}
    function get_products_in_cat_page(){
        $query = query("SELECT * FROM products WHERE cat_id = ". escape_string($_GET['id']) . "");
        confirm($query);
        while( $row = fetch_array($query)){
			$product = <<<DELIMETER
			<div class="product">
				<div class="product_image"><a href="product.php?id={$row['product_id']}&cat_id={$row['cat_id']}"><img src="../resources/uploads/{$row['product_image']}" alt=""></a></div>
					<div class="product_extra product_new"><a href="product.php?id={$row['product_id']}&cat_id={$row['cat_id']}">New</a></div>
						<div class="product_content">
							<div class="product_title"><a href="product.php?id={$row['product_id']}&cat_id={$row['cat_id']}">{$row['product_title']}</a></div>
							<div class="product_price">&#36;{$row['product_price']}</div>
						</div>
			</div>
			DELIMETER;
        echo $product;
        }
	}
	function get_products_in_cat_page1(){
        $query = query("SELECT * FROM products");
        confirm($query);
        while( $row = fetch_array($query)){
			$product = <<<DELIMETER
			<div class="product">
				<div class="product_image"><a href="product.php?id={$row['product_id']}&cat_id={$row['cat_id']}"><img src="../resources/uploads/{$row['product_image']}" alt=""></a></div>
					<div class="product_extra product_new"><a href="product.php?id={$row['product_id']}&cat_id={$row['cat_id']}">New</a></div>
						<div class="product_content">
							<div class="product_title"><a href="product.php?id={$row['product_id']}&cat_id={$row['cat_id']}">{$row['product_title']}</a></div>
							<div class="product_price">&#36;{$row['product_price']}</div>
						</div>
			</div>
			DELIMETER;
        echo $product;
        }
	}
	function relate_product(){
        $query = query("SELECT * FROM products WHERE cat_id = ". escape_string($_GET['cat_id']) .  " limit 4 ");
        confirm($query);

        while( $row = fetch_array($query)){
			$product = <<<DELIMETER
			<div class="product">
				<div class="product_image"><a href="product.php?id={$row['product_id']}&cat_id={$row['cat_id']}"><img src="../resources/uploads/{$row['product_image']}" alt=""></a></div>
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
        $query = query("SELECT COUNT(product_id) FROM products WHERE cat_id = ". escape_string($_GET['id']) . "");
        confirm($query);

        while( $row = fetch_array($query)){
			$total = <<<DELIMETER
			<div class="results">Showing <span>{$row['COUNT(product_id)']}</span> results</div>
			DELIMETER;

						echo $total;
					}
				}
    function show_total_product1(){
        $query = query("SELECT COUNT(product_id) FROM products");
        confirm($query);

        while( $row = fetch_array($query)){
			$total = <<<DELIMETER
			<div class="results">Showing <span>{$row['COUNT(product_id)']}</span> results</div>
			DELIMETER;

						echo $total;
					}
				}
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
								<a class="btn btn-info" href="../../public/admin/update_category.php?id={$row['cat_id']}">Update</a>
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
					echo '<script type="text/javascript">toastr.success("Have Fun")</script>';
				}
				else{
					$insert_cat = query("INSERT INTO `categories`(`cat_title`) VALUES ('{$cat_title}') ");
					echo'<script type="text/javascript">
					Command: toastr["success"]("My name is Inigo Montoya. You killed my father. Prepare to die!")
					toastr.options = {
					"closeButton": false,
					"debug": false,
					"newestOnTop": false,
					"progressBar": false,
					"positionClass": "toast-top-right",
					"preventDuplicates": false,
					"onclick": null,
					"showDuration": "300",
					"hideDuration": "1000",
					"timeOut": "5000",
					"extendedTimeOut": "1000",
					"showEasing": "swing",
					"hideEasing": "linear",
					"showMethod": "fadeIn",
					"hideMethod": "fadeOut",
					}</script>';	
					
					confirm($insert_cat);
									
				}
				
			}
		}			
		function update_category(){
			if(isset($_POST['update_category'])){

				$cat_title = escape_string($_POST['cat_title']);
				if(empty($cat_title) || $cat_title == ""){
					echo "Category is not empty";
				}
				else{
					$insert_cat = query("UPDATE `categories` SET `cat_title`= '{$cat_title}' WHERE cat_id = ". escape_string($_GET['id']) . "");
					confirm($insert_cat);
					redirect("categories.php");
				}
				
			}
		}			
		function show_categories_in_add_product(){
			$query = query("SELECT DISTINCT cat_id FROM `categories`");
			confirm($query);

			while($row = fetch_array($query)){
				$product = <<<DELIMETER
				<option value="{$row['cat_id']}">{$row['cat_id']}</option>
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
						<td>{$row['cat_id']}</td>
						<td>{$row['product_title']}</td>
						<td>{$row['product_price']}</td>
						<td>{$row['product_quantity']}</td>	
						<!-- <td>{$row['product_description']}</td> -->
						<td> 
							<a class="btn btn-danger" href="../../resources/templates/back/delete_product.php?id={$row['product_id']}">Delete</a>
							 <a class="btn btn-info" href="../admin/update_product.php?id={$row['product_id']}">Update</a>
							 </td>
					</tr>
					DELIMETER;
	
				echo $product;
			}
		}
		function add_product(){
			if(isset($_POST['add_product'])){

				$product_title = escape_string($_POST['product_title']);
				$cat_id = escape_string($_POST['cat_id']);
				$product_price = escape_string($_POST['product_price']);
				$product_quantity = escape_string($_POST['product_quantity']);
				$product_description = escape_string($_POST['product_description']);
				$product_image = escape_string($_FILES['file']['name']);
				$image_temp_location = escape_string($_FILES['file']['tmp_name']);

				$product_word = escape_string($_FILES['file1']['name']);
				$word_temp_location = escape_string($_FILES['file1']['tmp_name']);
				

				move_uploaded_file($image_temp_location,UPLOAD_DIRECTORY . DS .$product_image);
				move_uploaded_file($word_temp_location,UPLOAD_DIRECTORY . DS .$product_word);
				$insert_product = query("INSERT INTO `products`(`product_title`, `cat_id`, `product_price`, `product_quantity`, `product_description`, `product_image`,`product_word`) VALUES ('{$product_title}','{$cat_id}','{$product_price}','{$product_quantity}','{$product_description}','{$product_image}','{$product_word}') ");
					confirm($insert_product);
					redirect("add_product.php");
				}
				
			}
			function update_product(){
				if(isset($_POST['update_product'])){
	
					$product_title = escape_string($_POST['product_title']);
					$cat_id = escape_string($_POST['cat_id']);
					$product_price = escape_string($_POST['product_price']);
					$product_quantity = escape_string($_POST['product_quantity']);
					$product_description = escape_string($_POST['product_description']);
					$product_image = escape_string($_FILES['file']['name']);
					$image_temp_location = escape_string($_FILES['file']['tmp_name']);
	
					move_uploaded_file($image_temp_location,UPLOAD_DIRECTORY . DS .$product_image);
					$insert_product = query("UPDATE `products` SET `product_title`='{$product_title}',`cat_id`='{$cat_id}',`product_price`='{$product_price}',`product_quantity`='{$product_quantity}',`product_description`='{$product_description}',`product_image`='{$product_image}' WHERE product_id = ". escape_string($_GET['id']) . " ");
						confirm($insert_product);
						redirect("view_product.php");
					}
					
				}	
				function get_users_in_admin(){
					$query = query("SELECT * FROM users");
					confirm($query);
			
					while( $row = fetch_array($query)){
							$product = <<<DELIMETER
							<tr>
								<td>{$row['user_id']}</td>
								<td>{$row['username']}</td>
								<td>{$row['email']}</td>
								<td>{$row['phonenumber']}</td>
								<td>{$row['level']}</td>
								<td> 
									<a class="btn btn-danger" href="../../resources/templates/back/delete_product.php?id={$row['user_id']}">Delete</a>
									<a class="btn btn-info" href="../admin/update_product.php?id={$row['user_id']}">Update</a>
									 </td>
							</tr>
							DELIMETER;
			
						echo $product;
					}
				}

?>