<?php
    global $db;
    $db = ierg4210_DB();
    $q = $db->prepare("SELECT * FROM categories LIMIT 100;");
    $q->execute();
    $result = $q->fetchAll();
    foreach ($result as $r) {
        echo "<li><a href=category.php?catid=" .$r['catid'] . ">" . $r['name'] . "</a></li>";
    }
?>
