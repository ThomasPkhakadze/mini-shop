<?php 
  session_start();
  require_once "common/products.php";
  
$cartCount = 0 ;

if(isset($_SESSION['cart']) && count($_SESSION['cart'])> 0 ){
    $cartCount = count($_SESSION['cart']);
}

  
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Cart</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <!-- STYLES -->
  <!-- link href="style.css"  Was giving me an error-->
  <style>
body {
  background-color: rgb(252, 251, 245);
}
.stickyNav {
  background-color: #b9b9b9;
}
.sticky {
  flex-wrap: wrap;
  display: ruby;
  overflow-y: auto;
  height: 54vh;
  width: fit-content;
  position: fixed;

  background-color: #ece0cd;
  box-shadow: 0.25px 0.25px 3px rgb(0, 12, 78);
}
.cards {
  background-color: #ece0cd !important;
}
  </style>
</head>
<body>

<?php require('common/navbar.php') ?>
<!-- BODY -->
<div class="container-fluid pt-5 pb-5">
<div class="row">
<?php 
    if(!empty($_SESSION['cart'])){
        foreach($_SESSION['cart'] as $product){ 
        ?>
    <div class="col-md-3 col-6 product mb-3" id="element_<?= $product['id']?>">
            <div class="card cards" >
                <img class="card-img-top" src="<?= $product['img'] ?>" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title"><?= $product['title'] ?></h5>
                    <p class="card-text" id="price_<?=$product['id']?>"><?= $product['price']?>$</p>
                    <p class="card-text " id="quantity_<?= $product['id']?>"><b>Quantity: </b><?= $product['quantity'] ?></p>
                    <a href="javascript:void(0)" class=" btn btn-success button" method="add" id="<?= $product['id']?>">Add One More</a>
                    <a href="javascript:void(0)" class="btn btn-danger button" method="remove" id="<?= $product['id']?>">Remove</a>
                </div>
            </div>
    </div>
    
    <?php 
        }
    } 
    else{ ?>
        <div class="jumbotron col-12  ">
        <h1>0 Items</h1>
        <p>No Items in The Cart</p>
        </div>
<?php }?>
    <div class="jumbo-surprise col-12" >
    </div>
</div>
</div>

<!-- SCRIPTS -->
<?php require('common/scripts.php') ?>
<script>

$('.button').click(function(){
    let id = $(this).attr('id');
    let data = {
        'product_id': id,
        'method' : $(this).attr('method')
    };

    if($(this).attr('method') == "remove"){
        $('#element_' + $(this).attr('id')).hide();
    }
    
    // Ajax Flow 
    $.ajax({
        type: "POST",
        url: "add_remove_cart.php",
        data: data,
        dataType:'json',
        success:function(result)
        {
            $('#cartCounter').text(result[1]);
            var pair = result[2];
            if(pair === undefined){
                $('#cartCounter').text(result[1]);
                $('.jumbo-surprise').html('<div class="jumbotron col-12 ">'+'<h1>0 Items</h1>'+'<p>No Items in The Cart</p>'+'</div>');
            }else{
                for(var i = 0; i< pair.length; i++){
                    let id = pair[i].id;
                    let quantity = pair[i].quantity;
                    console.log(id);
                    $('#quantity_'+id).html('<b>Quantity: </b>' +quantity);
                }
            }      
        },
    
    });
}); 


</script>



</body>
</html>