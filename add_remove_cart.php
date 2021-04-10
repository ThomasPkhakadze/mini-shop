<?php 
// Both Adding and deleting is handled with this controller

require_once "common/products.php";
session_start();
$cartArray = $_SESSION['cart'];

if($_POST['method'] == "add"){


    $newCart = [];
    //checking if  array is empty
    if(empty($cartArray)){
        //if true searching for a new cart item in obj array and incrementing its quantity
        $result = search($products, $_POST['product_id'], "object");
        $result['quantity'] = 1;
        $newCart[] = $result;
        
    }
    //if array is not empty loop through and find existing cart item
    else{
        $checkIfExists = search($cartArray, $_POST['product_id'], "array");
        //if request item is not in cart then search for it in object array and add a new one
        if(empty($checkIfExists)){
            $newCart = $cartArray;
            $result = search($products, $_POST['product_id'], "object");
            $result['quantity'] = 1;
            $newCart[] = $result;
            
        }// if there is such product loop thru an array and find item with the same id and increment its' quantity
        else{ 
            foreach($cartArray as $item){

                if($item['id'] == $_POST['product_id']){
                    $quantity = intval($item['quantity'] + 1);
                }// for others make quantity the same
                else{
                    $quantity = $item['quantity'];
                }// populate items data
                $element = [
                        'id' => $item['id'],
                            'title' => $item['title'],
                            'price' => $item['price'],
                            'img' => $item['img'],
                            'quantity' => $quantity
                ];
                $newCart[] = $element;
            }
        }


    
    
    }



    }
    //if method is remove find all elements except request one and give them same values
    else{
    
            foreach($cartArray as $item){

                if($item['id'] != $_POST['product_id']){
                    
                $element = [
                        'id' => $item['id'],
                            'title' => $item['title'],
                            'price' => $item['price'],
                            'img' => $item['img'],
                            'quantity' =>  $item['quantity']
                ];
                $newCart[] = $element;
                
                }
            }
            
    }
    if(!empty($newCart)){
        $_SESSION['cart'] = $newCart;
        $count = count($newCart);
        $output = [$count, $newCart];
        $cartItems = '';
        $itemNumber = 1;
        $allQuantities = [];
        foreach($newCart as $cart){
            $productQuantity = [
                                'id' => $cart['id'],
                                'quantity' =>  $cart['quantity']
            ];

            $allQuantities[$itemNumber - 1] = $productQuantity;
            $cartItems.='
                <tr>
                      <th scope="row" >'.$itemNumber.'</th>
                      <td >'.$cart['title'].'</td>
                      <td >'.$cart['price'].'</td>
                      <td>'.$cart['quantity'].'</td>
                      <td >
                        <a href="javascript:void(0)" class="button btn btn-success dynamic" method="add" id="'.$cart['id'].'">Add One More</a>
                        <a href="javascript:void(0)" class="button btn btn-danger dynamic" method="remove" id="'.$cart['id'].'">Remove</a>
                      </td>
                </tr>
            ';
            $itemNumber++;
            
        }
        // var_dump($cartItem);
        $output = [$cartItems, $count,$allQuantities];
        print(json_encode($output));
    }
    else{
        $_SESSION['cart'] = [];
        print(0);
    }


function search($products, $value, $type)
{
    if($type == "array"){
         foreach($products as $key => $product)
        {
            if ( $product['id'] == $value ){
                return $product;
            }
                
        }

    }
    else{

         foreach($products as $product)
        {
            if ( $product->getId() == $value ){
                $productArray = [
                    'id' =>$product->getId(),
                    'title' => $product->getTitle(), 
                    'img'=> $product->getImg(), 
                    'price' => $product->getPrice()
                ];
                return $productArray;
            }
                
        }

    }
  
   return false;
}

?>