<?php
    session_start();

    if(isset($_POST['order_pay_btn'])){
        $order_status = $_POST['order_status'];
        $order_total_price = $_POST['order_total_price'];
    }
?>

<?php include('layouts/header.php')?>

    <!-- Payment -->
    <section class="my-5 py-5">
        <div class="container text-center mt-3 pt-5">
            <h2 class="form-wight-bolde">Pagamento</h2>
        </div>
        <div class="mx-auto container text-center"> 

            <?php if(isset($_POST['order_status']) && $_POST['order_status'] == "não pago"){?>
                <?php $amount = strval($_POST['order_total_price']);?>
                <?php $order_id = $_POST['order_id'];?>
                <p>Total da Compra: R$ <?php echo $_POST['order_total_price'];?>.00</p>
                <input id="pagamento-button-container" class="btn btn-primary" type="submit" value="Pagar Agora"/>

            <?php } else if(isset($_SESSION['total']) && $_SESSION['total'] != 0) {?>
                <?php $amount = strval($_SESSION['total']);?>
                <?php $order_id = $_SESSION['order_id'];?>
                <p>Total da Compra: R$ <?php echo $_SESSION['total'];?>.00</p>
                <input id="pagamento-button-container" class="btn btn-primary" type="submit" value="Pagar Agora"/>

            <?php }else{ ?>
                <p>Você não tem pedidos</p>
            <?php } ?>

        </div>
    </section>

    <script>
        document.getElementById('pagamento-button-container').addEventListener('click', function() {
            var mockOrderData = {
                purchase_units: [{
                    payments: {
                        captures: [{
                            status: 'completa' // Simula um pagamento aprovado
                        }]
                    }
                }]
            };

            onApprove(mockOrderData);
        });

        function onApprove(data) {
            console.log('Capture result', data, JSON.stringify(data, null, 2));
            var transaction = data.purchase_units[0].payments.captures[0];
            var transaction_id = Math.floor(Math.random() * (90) + 10);
            alert('Transação ' + transaction.status + ': ID:' + transaction_id + '\n\nObrigado Pela Compra');   
            window.location.href = "server/complete_payment.php?transaction_id="+transaction_id+"&order_id="+<?php echo $order_id; ?>;
        }
    </script>

<?php include('layouts/footer.php')?>