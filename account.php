<?php
    session_start();
    include('server/connection.php');

    if(!isset($_SESSION['logged_in'])){
        header('location: login.php');
        exit;
    }

    if(isset($_GET['logout'])){
        if(isset($_SESSION['logged_in'])){
            unset($_SESSION['logged_in']);
            unset($_SESSION['user_name']);
            unset($_SESSION['user_email']);
            header('location: login.php');
            exit;
        } 
    }

    if(isset($_POST['change_password'])){
        $password = $_POST['password'];
        $confirmPassword = $_POST['confirmPassword'];
        $user_email = $_SESSION['user_email'];

        if($password !== $confirmPassword){
            header('location: account.php?error=Senhas não são iguais.');
        }

        else if(strlen($password) < 6){
            header('location: account.php?error=Senha precisa de, no mínimo, 6 caracteres.'); 

        }else{
            $stmt = $conn->prepare("UPDATE users SET user_password=? WHERE user_email=?");
            $stmt -> bind_param('ss', md5($password), $user_email);

            if($stmt -> execute()){
                header('location: account.php?message=Senha atualizada!');
            }else{
                header('location: account.php?error=Um erro ocorre, nada mudou');
            }

        }
    }

    //pegar pedidos
    if(isset($_SESSION['logged_in'])){
        $user_id = $_SESSION['user_id'];
        $stmt = $conn->prepare("SELECT * FROM orders WHERE user_id=?");
        $stmt->bind_param("i", $user_id);
        $stmt -> execute();

        $orders = $stmt->get_result();
    }
?>

<?php include('layouts/header.php')?>

    <!-- Account -->
    <section class="my-5 py5">
        <div class="row cointainer mx-auto">
            
            <?php if(isset($_GET['payment_message'])){ ?>
                <p class="mt-5 text-center" style="color:green"><?php echo $_GET['payment_message']; ?></p>
            <?php } ?>

            <div class="text-center mt-3 pt-3 pt-5 col-lg-6 col-md-12 col-sm-12">
                <h3 class="font-weight-bold">Informações da Conta</h3>
                <p style="color: green"><?php if(isset($_GET['register_success'])){ echo $_GET['register_success'];}?></p>
                <p style="color: green"><?php if(isset($_GET['login_success'])){ echo $_GET['login_success'];}?></p>
                <div class="account-info">
                    <p>Nome: <span><?php if(isset($_SESSION['user_name'])){ echo $_SESSION['user_name'];}?></span></p>
                    <p>Email: <span><?php if(isset($_SESSION['user_email'])){ echo $_SESSION['user_email'];}?></span></p>
                    <p><a href="#orders" id="orders-btn">Seus Pedidos</a></p>
                    <p><a href="account.php?logout=1" id="logout-btn">Logout</a></p>
                </div>
            </div>
            <div class="col-lg-6 col-md-12 col-sm-12">
                <form id="account-form" method="POST" action="account.php">
                    <h3>Alterar Senha</h3>
                    <p class="text-center" style="color:red"><?php if(isset($_GET['error'])){ echo $_GET['error'];}?></p>
                    <p class="text-center" style="color:green"><?php if(isset($_GET['message'])){ echo $_GET['message'];}?></p>
                    <div class="form-group">
                        <label>Senha</label>
                        <input type="password" class="form-control" id="account-password" name="password" placeholder="Senha" required>
                    </div>
                    <div class="form-group">
                        <label>Confirmar Senha</label>
                        <input type="password" class="form-control" id="account-password-confirm" name="confirmPassword" placeholder="Confirmar senha" required>
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Confirmar Senha" class="btn" name="change_password" id="change-pass-btn">
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!--  Orders -->
    <section id="orders" class="orders container my-5 py-3">
        <div class="conteiner mt-2">
            <h2 class="font-wight-bold text-center">Seus Pedidos</h2>
            <hr class="mx-auto">    
        </div>
        <table class="mt-5 pt-5 container">
            <tr>
                <th>ID do Pedido</th>
                <th>Preço do Pedido</th>
                <th>Status do Pedido</th>
                <th>Data do Pedido</th>
                <th>Detalhes do Pedido</th>
            </tr>

            <?php while($row = $orders->fetch_assoc()){ ?>

                <tr>
                    <td>
                        
                        <span><?php echo $row['order_id']; ?></span>
                    </td>
                    <td>
                        <span>R$ <?php echo $row['order_cost']; ?></span>
                    </td>
                    <td>
                        <span><?php echo $row['order_status']; ?></span>
                    </td>
                    <td>
                        <span><?php echo $row['order_date']; ?></span>
                    </td>
                    <td>
                        <form method="POST" action="order_details.php">
                            <input type="hidden" value="<?php echo $row['order_status'];?>" name="order_status">
                            <input type="hidden" value="<?php echo $row['order_id'];?>" name="order_id">
                            <input type="submit" name="order_details_btn" class="btn order-detail-btn" value="Detalhes">
                        </form>
                    </td>
                </tr>

             <?php } ?>

        </table>
    </section>

    <?php include('layouts/footer.php')?>