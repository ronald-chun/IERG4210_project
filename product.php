<?php
    include_once("lib/db.inc.php")
?>

<!DOCTYPE html>
<html lang="en">
    <?php
        global $db;
        $db = ierg4210_DB();
        $q = $db->prepare("SELECT * FROM products WHERE pid = ?;");
        $q->execute(array($_GET['pid']));
        $result = $q->fetchAll();
        $prodId = $result[0]['pid'];
        $prodName = $result[0]['name'];
        $prodPrice = $result[0]['price'];
        $prodDescription = $result[0]['description'];

        $r = $db->prepare("SELECT * FROM categories WHERE catid = ?;");
        $r->execute(array($result[0]['catid']));
        $cat = $r->fetchAll();
        $catId = $cat[0]['catid'];
        $catName = $cat[0]['name'];
    ?>
    <head>
        <meta charset="UTF-8">
        <title><?php echo $result[0]['name'] ?> </title>

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
                    <!-- <li><a href="../breakfast.html">Breakfast & Bakery</a></li>
                    <li><a href="#">Frozen Food</a></li> -->
                </ul>


            </nav>

            <div class="content col-md-10 col-sm-10">
                <div class="row">
                    <nav class="nav-bar col-md-9 col-sm-9"><a href="..">Home</a> > <?php echo "<a href='category.php?catid=" . $catId ."'>"; echo $catName ?> </a> > <?php echo "<a href='product.php?catid=" . $catId . "&pid=" . $prodId . "'>"; echo $prodName ?> </a></nav>
                    <div class="shopping-list shopping-list__summary col-md-3 col-sm-3">Shopping List $<span id="total">14.20</span></div>
                    <div class="shopping-list shopping-list__detail hidden col-md-3 col-sm-3">Shopping List (Total: $<span id="total--detail"></span>)
                        <div class="shopping-list__item row"></div>
                        <button  type="button" class="checkout btn btn-default">Check Out</button>
                    </div>
                </div>

                <!-- Product detail -->
                <div class="products row">
                    <h3 class="col-md-12"><?php echo $prodName?></h3>
                    <div class="col-md-6 col-sm-6">
                        <?php echo "<img src='incl/img/". $prodId . ".jpg'>" ?>
                    </div>
                    <div class="col-md-3 col-sm-3">
                        <article>
                            <section>
                                <p>Name: <?php echo $prodName?> </p>
                                <p>Price: $<span><?php echo $prodPrice?></span></p>
                                <!-- <button  type="button" class="add btn btn-default" data-name="Bread" data-price="14.20">Add</button> -->
                                <?php echo "<button  type='button' class='add btn btn-default' data-name='" . $prodName . "' data-price='" . $prodPrice . "'>Add</button>"; ?>
                            </section>

                            <hr>

                            <section>
                                <h5>Description</h5>
                                <span>
                                    <?php echo $prodDescription ?>
                                </span>
                            </section>

                        </article>
                    </div>
                </div>

            </div>

        </div>

        <footer>
            <h3>Wong Chun Yin 1155061009</h3>
        </footer>

    </body>

</html>
