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

    function get_products(){
        $query = query("SELECT * FROM products");
        confirm($query);

        while( $row = fetch_array($query)){
$product = <<<DELIMETER
<div class="product">
	<div class="product_image"><img src="{$row['product_image']}" alt=""></div>
		<div class="product_extra product_new"><a href="categories.html">New</a></div>
			<div class="product_content">
				<div class="product_title"><a href="product.html">{$row['product_title']}</a></div>
				<div class="product_price">&#36;{$row['product_price']}</div>
			</div>
</div>
DELIMETER;

            echo $product;
        }
    }



















?>