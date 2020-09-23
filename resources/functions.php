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


    function get_products(){
        $query = query("SELECT * FROM products");
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
    
/*---------------------------------------------------BACK END -----------------------------------------------------*/
/*---------------------------------------------------BACK END -----------------------------------------------------*/
/*---------------------------------------------------BACK END -----------------------------------------------------*/


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


?>