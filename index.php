<?php 
  session_start();
  require_once "common/products.php";
  
$cartCount = 0 ;

if(isset($_SESSION['cart']) && count($_SESSION['cart'])> 0 ){
    $cartCount = count($_SESSION['cart']);
}
$ids = [];
 foreach($_SESSION['cart'] as $cartItem){
    array_push($ids,$cartItem['id']);
     
 } 

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Home</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <!-- STYLES -->
  <link rel="stylesheet" href="style.css">
</head>
<body>

<?php require('common/navbar.php') ?>
<!-- BODY -->
<div class="container-fluid pt-5 pb-5">
    <div class="row">
        <div class="col-md-6  " >
            <table class="table sticky">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Title</th>
                        <th scope="col">Price</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody class="target">
                    <?php if(isset($_POST)){
                        $number = 1;
                        foreach($_SESSION['cart'] as $cartItem){?> 
                            <tr>
                                <th scope="row" ><?=$number?></th>
                                <td ><?=$cartItem['title']?></td>
                                <td ><?=$cartItem['price']?></td>
                                <td><?=$cartItem['quantity']?></td>
                                <td >
                                <a href="javascript:void(0)" class="dynamic btn btn-success" method="add" id="<?=$cartItem['id']?>">Add One More</a>
                                <a href="javascript:void(0)" class="dynamic btn btn-danger" method="remove" id="<?=$cartItem['id']?>">Remove</a>
                                </td>
                            </tr>

                    <?php $number++;}}?>
                
                </tbody>
            </table>
        </div>
        <div class="col-6">
            <?php foreach($products as $product){ ?>
                <div class="col-xl-12 col-md-6 col-sm-6  product mb-3 mx-auto">
                        <div class="card cards" >
                            <img class="card-img-top" src="<?= $product->getImg() ?>" alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title" id="title_<?= $product->getId()?>"><?= $product->getTitle() ?></h5>
                                <p class="card-text" id="price_<?=$product->getId()?>"><?= $product->getPrice() ?></p>
                                <a href="javascript:void(0)" class="btn btn-warning button" method="add" id="<?= $product->getId()?>">Add To Cart</a>
                                <a href="javascript:void(0)" class="btn btn-danger button" method="remove" id="<?= $product->getId()?>" style="display:none;">Remove</a>
                            </div>
                        </div>
                </div>
                <?php 
                } 
                
            ?>
        </div>
    </div>
</div>


<!-- SCRIPTS -->
<?php require('common/scripts.php') ?>


   
<script>
  
// Access ids array elements
var ids = 
    <?php echo json_encode($ids); ?>;
       
// input ids array elements into js Array and make particular remove buttons appear
for(var i = 0; i < ids.length; i++){
    document.write(ids[i]);
    var id = ids[i];
    $('a#' + id +'.btn-danger').show();
}

</script>

<script>
$(document).ready(function () {
    
$(document).on('click', '.button',function(){
    
    $(this).removeClass('button');
    $(this).attr('data-clicked',1);
    $(this).addClass('btn-info clicked').removeClass('btn-warning');
    $(this).text('Added');
    // $(this).attr('method', 'added');

    
    let data = {
        'product_id': $(this).attr('id'),
        'method' : $(this).attr('method')
    };
    $('a#' + $(this).attr('id')+'.btn-danger').show();
    // Add/remove to cart    
    $.ajax({
        type: "POST",
        url: "add_remove_cart.php",
        data: data,
        dataType: 'json',
        success:function(result)
        {
            $('#cartCounter').html(result[1]);
            $('.target').html(result[0]);
            
        },
    });

    //redirect on cart data when removing content
        if($(this).attr('method') == 'remove'){
                $(this).text('Done');

            window.location.replace("http://localhost:80/cart.php");
        }    
    
}); 
// this due an error with dynamicly coded anchor tags
$(document).on('click','.dynamic',function(){
    let data = {
        'product_id': $(this).attr('id'),
        'method' : $(this).attr('method')
    };
    $.ajax({
        type: "POST",
        url: "add_remove_cart.php",
        data: data,
        dataType: 'json',
        success:function(result)
        {
            $('#cartCounter').html(result[1]);
            $('.target').html(result[0]);

        },
    });
     
     window.location.replace("http://localhost:80/cart.php");
      
});
});

</script>



</body>
</html>