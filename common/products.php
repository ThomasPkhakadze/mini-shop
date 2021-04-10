<?php
    require_once ("Classes/Product.php");
    $products = [];
    $product1 = new Product(1, "iPhone 11", 2500,'Pictures/IMG_1.jpg');
    $product2 = new Product(2, "M2 SSD", 400,'Pictures/IMG_2.jpg');
    $product3 = new Product(3, "Samsung Galaxy S20", 3200,'Pictures/IMG_3.jpg');
    $product4 = new Product(4, "Samsung Galaxy S20", 200,'Pictures/IMG_4.jpg');
    $product5 = new Product(5, "Shapatava yuna: I am yuna", 1200,'Pictures/IMG_5.jpg');
    $product6 = new Product(6, "Alla Pugachova Discography", 100,'Pictures/IMG_6.jpg');
    $product7 = new Product(7, "Apple Iphone X", 300,'Pictures/IMG_7.jpg');
    $product8 = new Product(8, "xy 20", 3200,'Pictures/IMG_8.jpg');
    array_push($products, $product1, $product2, $product3,$product4, $product5,$product6,$product7, $product8);


?>