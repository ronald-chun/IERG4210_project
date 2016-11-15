<?php
    include_once("lib/db.inc.php");
    include_once("lib/include.php");
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Home</title>
    </head>

    <body>
        <?php
            include("parts/header.php")
        ?>

        <div class="menu row">

            <!-- Category menu -->
            <nav class="col-md-2 col-sm-2">
                <h3>Category</h3>
                <ul>
                    <?php
                        include("parts/menu.php")
                    ?>
                </ul>
            </nav>

            <div class="content col-md-10 col-sm-10">

                <div class="row">
                    <nav class="nav-bar col-md-9 col-sm-9"><a href="index.php">Home</a></nav>
                    <div class="shopping-list shopping-list__summary col-md-3 col-sm-3"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Shopping List $<span id="total">0</span></div>
                    <div class="shopping-list shopping-list__detail hidden col-md-3 col-sm-3">
                        <i class="fa fa-shopping-cart" aria-hidden="true"></i> Shopping List (Total: $<span id="total--detail"></span>)
                        <div id="shoppingCart"></div>

                        <button type="button" class="checkout btn btn-default">Check Out</button>
                    </div>
                </div>

                <!-- Products -->
                <div class="products row">
                    <h3>Hot Products</h3>

                    <?php
                        global $db;
                        $db = ierg4210_DB();
                        $q = $db->prepare("SELECT * FROM products LIMIT 100;");
                        $q->execute();
                        $result = $q->fetchAll();
                        foreach ($result as $r) {
                            echo "<div class='products__item col-md-4 col-sm-4'>" .
                            "<img class='products__item--img' src='incl/img/" . $r['pid'] . ".jpg'> " .
                            "<br>" .
                            "<a href='product.php?catid=" . $r['catid'] . "&pid=" . $r['pid'] . "' class='products__item--link'>" . $r['name'] . "</a>" .
                            "<p>" . $r['price'] . "</p>" .
                            "<button  type='button' class='add btn btn-default' data-pid='". $r['pid'] . "'>Add</button>" .
                            "</div>";
                        }
                    ?>

                </div>
            </div>
    </body>
</html>
