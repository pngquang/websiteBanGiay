<header class="header_area sticky-header">
    <div class="main_menu">
        <nav class="navbar navbar-expand-lg navbar-light main_box">
            <div class="container">

                <a class="navbar-brand logo_h" href="index.php"><img src="https://preview.colorlib.com/theme/karma/img/logo.png" alt=""></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
                    <ul class="nav navbar-nav menu_nav ml-auto">
                        <li class="nav-item active"><a class="nav-link" href="index.php">Trang chủ</a></li>
                        <li class="nav-item submenu dropdown">
                            <a href="list_product.php" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Danh mục</a>
                            <ul class="dropdown-menu">
                                <?php 
                                    $sql = "select * from category";
                                    $list_cate = executeResult($sql);
                                    foreach($list_cate as $item){
                                            ?>
                                <li class="nav-item">
                                    <a class="nav-link" href="list_product.php?id_cate=<?=$item['id']?>">
                                        <?=$item['name']?>
                                    </a>
                                </li>

                                <?php
                                    }
                                ?>

                            </ul>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="list_product.php">Sản Phẩm</a></li>


                        <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li class="nav-item">
                            <a href="#" class="cart">
                                <span class="ti-bag"></span></a>
                        </li>
                        <li class="nav-item">
                            <a href="cart.php">
                                <button class="search"><i class="fa-solid fa-cart-shopping"></i></button>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="user.php">
                                <button class="search"><i class="fa-solid fa-user"></i></button>
                            </a>
                        </li>



                    </ul>
                </div>
            </div>
        </nav>
    </div>
    <div class="search_input" id="search_input_box">
        <div class="container">
            <form class="d-flex justify-content-between">
                <input type="text" class="form-control" id="search_input" placeholder="Search Here">
                <button type="submit" class="btn"></button>
                <span class="lnr lnr-cross" id="close_search" title="Close Search"></span>
            </form>
        </div>
    </div>
</header>
