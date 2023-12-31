<?php
    session_start();

    if(isset($_POST['add_to_cart'])){
        if(isset($_SESSION['cart'])){
            $products_array_ids = array_column($_SESSION['cart'], "product_id");
            if(!in_array($_POST['product_id'], $products_array_ids)){
                $product_id = $_POST['product_id'];

                    $product_array = array(
                        'product_id' => $_POST['product_id'],
                        'product_name' => $_POST['product_name'],
                        'product_price' => $_POST['product_price'],
                        'product_image' => $_POST['product_image'],
                        'product_quantity' => $_POST['product_quantity'],
                    );
    
                $_SESSION['cart'][$product_id] = $product_array;
            }else{
                echo '<script>alert("Produto já foi adicionado ao carrinho.");</script>';
            }

        }else{
            $product_id = $_POST['product_id']; 
            $product_name = $_POST['product_name']; 
            $product_price = $_POST['product_price'];
            $product_image = $_POST['product_image'];  
            $product_quantity = $_POST['product_quantity']; 

            $product_array = array(
                'product_id' => $product_id,
                'product_name' => $product_name,
                'product_price' => $product_price,
                'product_image' => $product_image,
                'product_quantity' => $product_quantity,
            );

            $_SESSION['cart'][$product_id] = $product_array;
        }

        calculateTotalCart();

    }else if(isset($_POST['remove_product'])){
        $product_id = $_POST['product_id'];
        unset($_SESSION['cart'][$product_id]);

        calculateTotalCart();
    
    }else if(isset($_POST['edit_quantity'])){
        $product_id = $_POST['product_id'];
        $product_quantity = $_POST['product_quantity'];

        $product_array = $_SESSION['cart'][$product_id];

        $product_array['product_quantity'] = $product_quantity;

        $_SESSION['cart'][$product_id] = $product_array;

        calculateTotalCart();

    }else{
       // header('location:index.php');
    }

    function calculateTotalCart(){
        $total = 0;

        foreach($_SESSION['cart'] as $key => $value){
            $product = $_SESSION['cart'][$key];
            $price = $product['product_price'];
            $quantity = $product['product_quantity'];

            $total = $total + ($price * $quantity); 
        }

        $_SESSION['total'] = $total;
    }
?>

<?php include('layouts/header.php')?>

    <!-- Cart -->
    <section class="cart container my-5 py-5">
        <div class="container mt-5">
            <h2 class="font-weight-bold">Seu Carrinho</h2>
            <hr>
        </div>
        <table class="mt-5 pt-5">
            <tr>
                <th>Produtos</th>
                <th>Quantidade</th>
                <th>Subtotal</th>
            </tr>

            <?php foreach($_SESSION['cart'] as $key =>  $value){ ?>

            <tr>
                <td>
                    <div class="product-info">
                        <img src="assets/img/products/<?php echo $value['product_image']?>">
                        <div>
                            <p><?php echo $value['product_name']?></p>
                            <small><span>R$ </span><?php echo $value['product_price']?></small>
                            <br>
                            <form method="POST" action="cart.php">
                                <input type="hidden" name="product_id" value="<?php echo $value['product_id']?>">
                                <input type="submit" name="remove_product" class="remove-btn" value="Remover">
                            </form>
                        </div>
                    </div>
                </td>
                <td>
                    <form method="POST" action="cart.php">
                        <input type="hidden" name="product_id" value="<?php echo $value['product_id']?>">
                        <input class="quantity_cart" type="number" name="product_quantity" value="<?php echo $value['product_quantity']?>">
                        <input type="submit" name="edit_quantity" class="edit-btn" value="Editar">
                    </form>
                </td>
                <td>
                    <span>R$ </span>
                    <span class="product-price"><?php echo $value['product_quantity'] * $value['product_price']; ?>.00</span>
                </td></span>
                </td>
            </tr>

            <?php } ?>

        </table>
        <div class="cart-total">
            <table>
               <!-- <tr>
                    <td>Subtotal</td>
                    <td>$111</td>
                </tr> -->
                <tr>
                    <td>Total</td>
                    <td>R$ <?php echo $_SESSION['total'];?>.00</td>
                </tr>
            </table>
        </div>
        <div class="checkout-container">
            <form method="POST" action="checkout.php">
                <input type="submit" class="btn checkout-btn" value="Checkout" name="checkout">
            </form>
        </div>
    </section>

<?php include('layouts/footer.php')?>