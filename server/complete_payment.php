<?php
    session_start();
    include('connection.php');

    if(isset($_GET['transaction_id']) && isset($_GET['order_id'])){
        $order_id = $_GET['order_id'];
        $order_status = "pago";
        $transaction_id = $_GET['transaction_id'];
        $user_id = $_SESSION['user_id'];

        //mudar order_status para 'pago'
        $stmt = $conn->prepare("UPDATE orders SET order_status=? WHERE order_id=?");
        $stmt->bind_param("si",$order_status, $order_id);
        $stmt->execute();

        //guardar pagamento
        $stmt1 = $conn->prepare("INSERT INTO payments (order_id, user_id, transaction_id) VALUES (?, ?, ?);");
        $stmt1->bind_param("iii",$order_id, $order_status, $transaction_id);
        $stmt1->execute();

        //ir para pagina de usuario
        header('location: ../account.php?paid_message=Pagamento completo');

    }else{
        header('location: ../index.php');
        exit;
    }
?>