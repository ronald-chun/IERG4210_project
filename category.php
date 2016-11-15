<?php
    include_once("lib/db.inc.php")
?>

<!DOCTYPE html>
<html lang="en">
    <?php
        global $db;
        $db = ierg4210_DB();
        $q = $db->prepare("SELECT * FROM categories WHERE catid = ?;");
        $q->execute(array($_GET['catid']));
        $result = $q->fetchAll();
        foreach ($result as $r) {
            $catId = $r['catid'];
            $catName = $r['name'];
        }
    ?>
    <head>
        <meta charset="UTF-8">
        <title><?php echo $catName ?></title>
        <script src="http://code.jquery.com/jquery-3.1.1.js" type="text/javascript"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

        <link rel="stylesheet" href="css/style.css">
        <script src="script/script.js" type="text/javascript"></script>

    </head>

    <body>
        <?php
            include("parts/header.php")
        ?>
        <!-- <header class="row">
            <div class="col-md-12">
                <h1>IERG4210 WEB PROGRAMMING AND SECURITY (2016 FALL)</h1>
                <h1>ASSIGNMENT PHASE 1: LOOK AND FEEL</h1>
            </div>
        </header> -->

        <div class="row">

            <!-- Category menu -->
            <nav class="menu col-md-2 col-sm-2">

                <h3>Category</h3>
                <ul>
                    <?php
                        include("parts/menu.php")
                    ?>
                </ul>


            </nav>

            <div class="content col-md-10 col-sm-10">

                <div class="row">
                    <nav class="nav-bar col-md-9 col-sm-9"><a href="..">Home</a> > <?php echo "<a href='category.php?catid=" . $catId ."'>"?> <?php echo $catName ?> </a></nav>
                    <div class="shopping-list shopping-list__summary col-md-3 col-sm-3">Shopping List $<span id="total">14.20</span></div>
                    <div class="shopping-list shopping-list__detail hidden col-md-3 col-sm-3">Shopping List (Total: $<span id="total--detail"></span>)
                        <div class="shopping-list__item row"></div>
                        <button  type="button" class="checkout btn btn-default">Check Out</button>
                    </div>
                </div>

                <!-- Products -->
                <div class="products row">
                    <h3><?php echo $catName ?></h3>

                    <?php
                        global $db;
                        $db = ierg4210_DB();
                        $q = $db->prepare("SELECT * FROM products WHERE catid = ?;");
                        $q->execute(array($catId));
                        $result = $q->fetchAll();
                        foreach ($result as $r) {
                            echo "<div class='products__item col-md-4 col-sm-4'>" .
                            "<img class='products__item--img' src='incl/img/" . $r['pid'] . ".jpg'> " .
                            "<br>" .
                            "<a href='product.php?catid=" . $catId . "&pid=" . $r['pid'] . "' class='products__item--link'>" . $r['name'] . "</a>" .
                            "<p>" . $r['price'] . "</p>" .
                            "<button  type='button' class='add btn btn-default' data-name='" . $r['name'] . "' data-price='" . $r['price'] . "'>Add</button>" .
                            "</div>";
                        }

                    ?>
                    <!-- <div class="products__item col-md-4 col-sm-6 ">
                        <a href="product/b-01.html" class="products__item--link">
                            <img src="../image/b01_thumbnail.jpg">
                            <br>
                            Bread
                        </a>
                        <p>
                            $14.20
                        </p>
                        <button  type="button" class="add btn btn-default" data-name="Bread" data-price="14.20">Add</button>
                    </div>
                    <div class="products__item col-md-4 col-sm-6 ">
                        <a href="product/b-02.html" class="products__item--link">
                            <img src="../image/b02_thumbnail.jpg">
                            <br>
                            Milk Bun
                        </a>
                        <p>
                            $9.90
                        </p>
                        <button  type="button" class="add btn btn-default" data-name="Milk Bun" data-price="9.90">Add</button>
                    </div>
                    <div class="products__item col-md-4 col-sm-6 ">
                        <a href="product/b-01.html" class="products__item--link">
                            <img src="../image/b01_thumbnail.jpg">
                            <br>
                            Bread
                        </a>
                        <p>
                            $14.20
                        </p>
                        <button  type="button" class="add btn btn-default" data-name="Bread" data-price="14.20">Add</button>
                    </div>
                    <div class="products__item col-md-4 col-sm-6 ">
                        <a href="product/b-02.html" class="products__item--link">
                            <img src="../image/b02_thumbnail.jpg">
                            <br>
                            Milk Bun
                        </a>
                        <p>
                            $9.90
                        </p>
                        <button  type="button" class="add btn btn-default" data-name="Milk Bun" data-price="9.90">Add</button>
                    </div>
                    <div class="products__item col-md-4 col-sm-6 ">
                        <a href="product/b-01.html" class="products__item--link">
                            <img src="../image/b01_thumbnail.jpg">
                            <br>
                            Bread
                        </a>
                        <p>
                            $14.20
                        </p>
                        <button  type="button" class="add btn btn-default" data-name="Bread" data-price="14.20">Add</button>
                    </div>
                    <div class="products__item col-md-4 col-sm-6 ">
                        <a href="product/b-02.html" class="products__item--link">
                            <img src="../image/b02_thumbnail.jpg">
                            <br>
                            Milk Bun
                        </a>
                        <p>
                            $9.90
                        </p>
                        <button  type="button" class="add btn btn-default" data-name="Milk Bun" data-price="9.90">Add</button>
                    </div>
                    <div class="products__item col-md-4 col-sm-6 ">
                        <a href="product/b-01.html" class="products__item--link">
                            <img src="../image/b01_thumbnail.jpg">
                            <br>
                            Bread
                        </a>
                        <p>
                            $14.20
                        </p>
                        <button  type="button" class="add btn btn-default" data-name="Bread" data-price="14.20">Add</button>
                    </div>
                    <div class="products__item col-md-4 col-sm-6 ">
                        <a href="product/b-02.html" class="products__item--link">
                            <img src="../image/b02_thumbnail.jpg">
                            <br>
                            Milk Bun
                        </a>
                        <p>
                            $9.90
                        </p>
                        <button  type="button" class="add btn btn-default" data-name="Milk Bun" data-price="9.90">Add</button>
                    </div>
                    <div class="products__item col-md-4 col-sm-6 ">
                        <a href="product/b-01.html" class="products__item--link">
                            <img src="../image/b01_thumbnail.jpg">
                            <br>
                            Bread
                        </a>
                        <p>
                            $14.20
                        </p>
                        <button  type="button" class="add btn btn-default" data-name="Bread" data-price="14.20">Add</button>
                    </div>
                    <div class="products__item col-md-4 col-sm-6 ">
                        <a href="product/b-02.html" class="products__item--link">
                            <img src="../image/b02_thumbnail.jpg">
                            <br>
                            Milk Bun
                        </a>
                        <p>
                            $9.90
                        </p>
                        <button  type="button" class="add btn btn-default" data-name="Milk Bun" data-price="9.90">Add</button>
                    </div>
                    <div class="products__item col-md-4 col-sm-6 ">
                        <a href="product/b-01.html" class="products__item--link">
                            <img src="../image/b01_thumbnail.jpg">
                            <br>
                            Bread
                        </a>
                        <p>
                            $14.20
                        </p>
                        <button  type="button" class="add btn btn-default" data-name="Bread" data-price="14.20">Add</button>
                    </div>
                    <div class="products__item col-md-4 col-sm-6 ">
                        <a href="product/b-02.html" class="products__item--link">
                            <img src="../image/b02_thumbnail.jpg">
                            <br>
                            Milk Bun
                        </a>
                        <p>
                            $9.90
                        </p>
                        <button  type="button" class="add btn btn-default" data-name="Milk Bun" data-price="9.90">Add</button>
                    </div> -->
                </div>

            </div>

        </div>

        <!-- <footer>
            <h3>Wong Chun Yin 1155061009</h3>
        </footer> -->

    </body>

</html>
