<?php
    include_once("lib/db.inc.php");
<<<<<<< HEAD
    include_once("lib/include.php");
=======
>>>>>>> 5a0f1165b1aac57b35c2bab2eebbec5f5d691df9
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Home</title>
<<<<<<< HEAD
=======

        <script src="http://code.jquery.com/jquery-3.1.1.js" type="text/javascript"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

        <link rel="stylesheet" href="css/style.css">
        <script src="script/script.js" type="text/javascript"></script>
        <script src="incl/myLib.js" type="text/javascript"></script>
        <link rel="stylesheet" href="css/lib/font-awesome-4.7.0/css/font-awesome.min.css">


>>>>>>> 5a0f1165b1aac57b35c2bab2eebbec5f5d691df9
    </head>

    <body>
        <?php
            include("parts/header.php")
        ?>
<<<<<<< HEAD
=======
        <!-- <header>
            <div>
                <h1>IERG4210 WEB PROGRAMMING AND SECURITY (2016 FALL)</h1>
                <h1>ASSIGNMENT</h1>
            </div>
        </header> -->
>>>>>>> 5a0f1165b1aac57b35c2bab2eebbec5f5d691df9

        <div class="menu row">

            <!-- Category menu -->
            <nav class="col-md-2 col-sm-2">
                <h3>Category</h3>
                <ul>
                    <?php
                        include("parts/menu.php")
                    ?>
<<<<<<< HEAD
=======
                    <!-- <li><a href="category/breakfast.html">Breakfast & Bakery</a></li>
                    <li><a href="#">Frozen Food</a></li> -->
>>>>>>> 5a0f1165b1aac57b35c2bab2eebbec5f5d691df9
                </ul>
            </nav>

            <div class="content col-md-10 col-sm-10">

                <div class="row">
                    <nav class="nav-bar col-md-9 col-sm-9"><a href="index.php">Home</a></nav>
                    <div class="shopping-list shopping-list__summary col-md-3 col-sm-3"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Shopping List $<span id="total">0</span></div>
<<<<<<< HEAD
                    <div class="shopping-list shopping-list__detail hidden col-md-3 col-sm-3">
                        <i class="fa fa-shopping-cart" aria-hidden="true"></i> Shopping List (Total: $<span id="total--detail"></span>)
                        <div id="shoppingCart"></div>

=======
                    <div id="shoppingCart" class="shopping-list shopping-list__detail hidden col-md-3 col-sm-3"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Shopping List (Total: $<span id="total--detail"></span>)
                        <!-- <div class="shopping-list__item row"></div>
                        <div class="shopping-list__item row">
                            <span class="shopping-list__item--name col-md-4">2</span>
                            <input class="shopping-list__item--quantity col-md-4" type="number" name="" min="1" value="1">
                            <span class="shopping-list__item--price col-md-4"> $1</span>
                        </div> -->
>>>>>>> 5a0f1165b1aac57b35c2bab2eebbec5f5d691df9
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
<<<<<<< HEAD
                    ?>

                </div>
            </div>
    </body>
=======

                    ?>
                    <!-- <div class="products__item col-md-4 col-sm-4 ">
                        <img src="image/b02_thumbnail.jpg">
                        <br>
                        <a href="category/product/b-02.html" class="products__item--link">Milk Bun</a>
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


>>>>>>> 5a0f1165b1aac57b35c2bab2eebbec5f5d691df9
</html>
