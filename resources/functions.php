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
	<div class="product_image"><<a href="product.php?id={$row['product_id']}"><img src="{$row['product_image']}" alt=""></a></div>
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

/*---------------------------------------------------BACK END -----------------------------------------------------*/
/*---------------------------------------------------BACK END -----------------------------------------------------*/
/*---------------------------------------------------BACK END -----------------------------------------------------*/



?>