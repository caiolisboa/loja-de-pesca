<?php
    session_start();
    include('connection.php');


    if(!isset($_SESSION['logged_in'])){
        header('location: ../checkout.php?message= Por favor, cadastre-se ou entre para fazer um pedido');
        exit;
    }else{

        if(isset($_POST['place_order'])){
            // 1. pegar info do usuário e guardar no banco
            $name = $_POST['name'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $city = $_POST['city'];
            $address = $_POST['address'];
            $order_cost = $_SESSION['total'];
            $order_status = "não pago";
            $user_id = $_SESSION['user_id'];
            $order_date = date('Y-m-d H:i:s');

            $stmt = $conn->prepare("INSERT INTO orders (order_cost, order_status, user_id,user_phone, user_city, user_address, order_date) VALUES (?,?,?,?,?,?,?); ");

            $stmt->bind_param('isiisss', $order_cost, $order_status, $user_id, $phone, $city, $address, $order_date);
            
            $stmt_status = $stmt->execute();

            if(!$stmt_status){
                header('location index.php');
                exit;
            }

            // 2. fazer novo pedido e guardar info no banco
            $order_id = $stmt->insert_id;

            // 3. pegar produtos do carrinho (sessão)
            foreach($_SESSION['cart'] as $key => $value){
                $product = $_SESSION['cart'][$key];
                $product_id = $product['product_id'];
                $product_name = $product['product_name'];
                $product_image = $product['product_image'];
                $product_price = $product['product_price'];
                $product_quantity = $product['product_quantity'];

                // 4. guardar cada itemm em order_items datbase
                $stmt1 = $conn->prepare("INSERT INTO order_items (order_id, product_id, product_name, product_image, product_price, product_quantity, user_id, order_date) VALUES (?,?,?,?,?,?,?,?); ");

                $stmt1->bind_param('iissiiis', $order_id, $product_id, $product_name, $product_image, $product_price, $product_quantity, $user_id, $order_date);
                $stmt1->execute();

            }

            // 5. remover tudo do carrinho 
            $_SESSION['order_id'] = $order_id;

            // 6. informar usuário se está tudo certo ou se há um problema 
            header('location: ../payment.php?order_status=order placed successfully');

        }else{

        }
    }
?>