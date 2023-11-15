<?php
    session_start();

    if(!empty($_SESSION['cart'])){

    }else{
        header('location: index.php');

    }
?>

<?php include('layouts/header.php')?>

    <!-- Register -->
    <section class="my-5 py-5">
        <div class="container text-center mt-3 pt-5">
            <h2 class="form-wight-bolde">Check Out</h2>
        </div>
        <div class="mx-auto container">
            <form id="checkout-form" method="POST" action="server/place_order.php">
                <p class="text-center" style="color: red">
                    <?php if(isset($_GET['message'])){ echo $_GET['message'];} ?>
                    <?php if(isset($_GET['message'])){ ?>
                        <a href="login.php" class="btn-primary">Login</a>; 
                     <?php } ?>
                </p>
                <div class="form-group checkout-small-element">
                    <label>Nome</label>
                    <input type="text" class="form-control" id="checkout-name" name="name"placeholder="Nome" required></input>
                </div>
                <div class="form-group checkout-small-element">
                    <label>Email</label>
                    <input type="text" class="form-control" id="checkout-email" name="email"placeholder="Email" required></input>
                </div>
                <div class="form-group checkout-small-element">
                    <label>Telefone</label>
                    <input type="tel" class="form-control" id="checkout-phone" name="phone"placeholder="Telefone" required></input>
                </div>
                <div class="form-group checkout-small-element">
                    <label>Cidade</label>
                    <input type="text" class="form-control" id="checkout-city" name="city"placeholder="Cidade" required></input>
                </div>
                <div class="form-group checkout-large-element">
                    <label>Endereço</label>
                    <input type="text" class="form-control" id="checkout-address" name="address"placeholder="Endereço" required></input>
                </div>
                <div class="form-group checkout-btn-container">
                    <p>Total da Compra: R$ <?php echo $_SESSION['total']; ?>.00</p>
                    <input type="submit" class="btn" id="checkout-btn" name="place_order" value="Fazer Pedido"></input>
                </div>
            </form>
        </div>
    </section>

    <?php include('layouts/footer.php')?>