<?php include('layouts/header.php')?>

    <!-- Products -->
    <section id="product1" class="container">
        <div class="pro-container">  

            <?php include('server/get_featured_products.php'); ?>
            <?php while($row=$featured_products->fetch_assoc()){ ?>

            <div class="pro">
                <img src="assets/img/products/<?php echo $row['product_image'] ?>" alt="">
                <div class="des">
                    <span><?php echo $row['product_category'] ?></span>
                    <h5><?php echo $row['product_name'] ?></h5>
                    <div class="star">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <h4>R$ <?php echo $row['product_price'] ?></h4>
                </div>
                <a href="<?php echo "single_product.php?product_id=". $row['product_id'];?>"><button class="normal">Comprar</button></a>
            </div>

            <?php } ?>

            
        </div>
    </section>

<?php include('layouts/footer.php')?>