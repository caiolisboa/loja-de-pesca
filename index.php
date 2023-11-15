<?php include('layouts/header.php')?>

    <!-- Home -->
    <section id="home">
        <div class="container">
            <h5>Oferta e Demanda</h5>
            <h1> <span>Super Descontos </span> </h1>
            <h2>Em todos os produtos</h2>
            <p>Economize ate 70% em descontos!</p>
            <button class="go_to_shop">Comprar Agora</button>
        </div>
    </section>   
    
    <!-- Features -->
    <section id="feature" class="container">
        <div class="fe-box">
            <img src="assets/img/features/f1.png" alt="">
            <h6>Frete Grátis</h6>
        </div>
        <div class="fe-box">
            <img src="assets/img/features/f2.png" alt="">
            <h6>Pedidos Online</h6>
        </div>
        <div class="fe-box">
            <img src="assets/img/features/f3.png" alt="">
            <h6>Economize Dinheiro</h6>
        </div>
        <div class="fe-box">
            <img src="assets/img/features/f4.png" alt="">
            <h6>Promoções</h6>
        </div>
        <div class="fe-box">
            <img src="assets/img/features/f5.png" alt="">
            <h6>Ótimo Ambiente</h6>
        </div>
        <div class="fe-box">
            <img src="assets/img/features/f6.png" alt="">
            <h6>Suporte 24 horas</h6>
        </div>
    </section>

    <!-- New Items -->
    <section id="product1" class="container">
        <h2>Novos Itens</h2>
        <p>Nova Coleção de Pesca</p>
        <div class="pro-container">

            <?php include('server/get_featured_products.php'); ?>
            <?php 
            for ($i = 0; $i < 4 && $row = $featured_products->fetch_assoc(); $i++) { 
             ?>
            <div class="pro">
                <img src="assets/img/products/<?php echo $row['product_image'] ?>" alt="">
                <div class="des">
                    <span>Anzol de Pesca</span>
                    <h5><?php echo $row['product_name']; ?></h5>
                    <div class="star">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <h4><?php echo $row['product_price']; ?></h4>
                </div>
                <button class="normal">Comprar</button>
            </div>
            <?php } ?>

        </div>       
    </section>
    
    <!-- Banner -->
    <section id="banner">
        <h4>Serviços de Reparo</h4>
        <h2>Até <span>70% Off</span> - Todos os itens</h2>
        <button class="normal go_to_shop">Explorar Mais</button>
    </section>

    <script src="assets/js/script.js"></script>

<?php include('layouts/footer.php')?>