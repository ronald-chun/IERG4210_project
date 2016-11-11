<?php
    global $db;
    $db = ierg4210_DB();
    $q = $db->prepare("SELECT * FROM categories LIMIT 100;");
    $q->execute();
    $result = $q->fetchAll();
?>
