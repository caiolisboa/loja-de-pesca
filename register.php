<?php
    session_start();
    include('server/connection.php');

    // se usuario ja tiver regstrado nao acessa pagina de registro
    if(isset($_SESSION['logged_in'])){
        header('location: account.php');
        exit;
    }

    if(isset($_POST['register'])){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirmPassword = $_POST['confirmPassword'];

        if($password !== $confirmPassword){
            header('location: register.php?error=Senhas não são iguais.');
        }

        else if(strlen($password) < 6){
            header('location: register.php?error=Senha precisa de, no mínimo, 6 caracteres.'); 
        }

        else{
            $stmt1 = $conn->prepare("SELECT count(*) FROM users WHERE user_email=?");
            $stmt1->bind_param('s', $email);
            $stmt1->execute();
            $stmt1->bind_result($num_rows);
            $stmt1->store_result();
            $stmt1->fetch();

            if($num_rows != 0){
                header('location: register.php?error=Email já registrado!'); 
            }else{

                $stmt = $conn->prepare("INSERT INTO users (user_name, user_email, user_password) VALUES (?, ?, ?)");
                $stmt -> bind_param('sss', $name, $email, md5($password));
                
                if($stmt->execute()){
                    $user_id = $stmt->insert_id;
                    $_SESSION['user_id'] = $user_id;
                    $_SESSION['user_email'] = $email;
                    $_SESSION['user_name'] = $name;
                    $_SESSION['logged_in'] = true;
                    header('location: account.php?register_success=Registro bem-sucedido.');

                }else{
                    header('location: account.php?error=Registro falhou.');
                }
            }
        }
    }
?>

<?php include('layouts/header.php')?>

    <!-- Register -->
    <section class="my-5 py-5">
        <div class="container text-center mt-3 pt-5">
            <h2 class="form-wight-bolde">Sign-in</h2>
        </div>
        <div class="mx-auto container">
            <form id="register-form" method="POST" action="register.php">
            <p style="color: red"><?php if(isset($_GET['error'])){ echo $_GET['error'];}?></p>
            <div class="form-group">
                    <label>Nome</label>
                    <input type="text" class="form-control" id="register-name" name="name"placeholder="Nome" required></input>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="text" class="form-control" id="register-email" name="email"placeholder="Email" required></input>
                </div>
                <div class="form-group">
                    <label>Senha</label>
                    <input type="password" class="form-control" id="register-password" name="password" placeholder="Senha" required></input>
                </div>
                <div class="form-group">
                    <label>Coonfirmar Senha</label>
                    <input type="password" class="form-control" id="register-confirm-password" name="confirmPassword"placeholder="Confirmar Senha" required></input>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn" id="register-btn" name="register" value="Registrar"></input>
                </div>
                <div class="form-group">
                    <a id="login-url" class="btn" href="login.php">Tem uma conta? Entre!</a>
                </div>
            </form>
        </div>
    </section>

<?php include('layouts/footer.php')?>