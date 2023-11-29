<?php
    include 'php/connection.php';
    session_start();
    @$user = $_POST['name'];
    @$id = $_POST['id'];
    @$admin_id = $_POST['admin_id'];
    @$admin_name = $_POST['admin_name'];
    $shopping_cart_button = "
    <form action=\"http://www.cyfer.com/shoppingKart.php\" class=\"p-1\">
        <button class=\"btn btn-outline-dark\" type=\"submit\">
            <i class=\"bi-cart-fill me-1\"> Cart</i>
        </button>
    </form>";
    $login_button = "
    <form action=\"http://www.cyfer.com/login.php\" class=\"p-1\">
        <button class=\"btn btn-outline-dark\" type=\"submit\">
            <i class=\"bi-door-open me-1\"> Login</i>
        </button>
    </form>";
    $logout_button = "
    <form action=\"http://www.cyfer.com/php/logout.php\" class=\"p-1\">
        <button class=\"btn btn-outline-dark\" type=\"submit\">
            <i class=\"bi-door-open me-1\"> Logout</i>
        </button>
    </form>";
    $add_product_button = "
    <form action=\"http://www.cyfer.com/admin/addProduct.php\" class=\"p-1\">
        <button class=\"btn btn-outline-dark\" type=\"submit\">
            <i class=\"bi bi-plus-circle me-1\"> Add product</i>
        </button>
    </form>";

    $result = scandir('/var/www/webdav/');
    if(isset($id)) {
        $sql = "SELECT * FROM USER_PURCHASES WHERE USER_ID = '$id'";
        $purchases = $conn->query($sql);
        $conn->close();
    }
?>
<!DOCTYPE html>
<html lang="en" class="h-100">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Shop Homepage - Start Bootstrap Template</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
    </head>
    <body class="d-flex flex-column h-100">
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" href="#!">Start Bootstrap</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                        <li class="nav-item"><a class="nav-link" href="http://www.cyfer.com/index.php">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="http://www.cyfer.com/about.php">About</a></li>
                        <li class="nav-item"><a class="nav-link" href="http://www.cyfer.com/products.php">Products</a></li>
                    </ul>
                    <?php
                        if(isset($id)) {
                            echo $shopping_cart_button;
                            echo $logout_button;
                        }
                    ?>
                </div>
            </div>
        </nav>

        <!-- Section-->
        <div class="d-flex align-items-center justify-content-center m-5">
        </div>
        <section class="py-5">
            <div class="container px-4 px-lg-5 mt-5">
                <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                    <?php
                    if(!isset($id)) {
                        foreach($result as $file) {
                            if(substr($file, -3) == "pdf") {
                                echo "
                                <div class=\"col mb-5\">
                                    <div class=\"card h-100\">
                                        <!-- Product image-->
                                        <img class=\"card-img-top p-5 \" src=\"icon.png\" alt=\"...\" />
                                        <!-- Product details-->
                                        <div class=\"card-body p-4\">
                                            <div class=\"text-center\">
                                                <!-- Product name-->
                                                <a href=\"" . $file . " \" class=\"link-dark text-decoration-none\">
                                                    <h5 class=\"fw-bolder\">" . $file . "</h5>
                                                </a>
                                            </div>
                                        </div>";
                                        echo " 
                                    </div>
                                </div>
                                ";
                            }
                        }
                    }
                    else {
                        while($rows = $purchases->fetch_assoc()) {
                            echo "
                            <div class=\"col mb-5\">
                                <div class=\"card h-100\">
                                    <!-- Product image-->
                                    <img class=\"card-img-top p-5 \" src=\"icon.png\" alt=\"...\" />
                                    <!-- Product details-->
                                    <div class=\"card-body p-4\">
                                        <div class=\"text-center\">
                                            <!-- Product name-->
                                            <a href=\"" . $rows['FILENAME'] . " \" class=\"link-dark text-decoration-none\">
                                                <h5 class=\"fw-bolder\">" . $rows['FILENAME'] . "</h5>
                                            </a>
                                        </div>
                                    </div>";
                                    echo " 
                                </div>
                            </div>
                            ";
                        }
                    }
                    ?>
                </div>
            </div>
        </section>
        <!-- Footer-->
        <footer class="footer mt-auto py-5 bg-dark">
            <div class="container"><p class="m-0 text-center text-white">Copyright &copy; Your Website 2023</p></div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>
