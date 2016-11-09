<?php
include_once('lib/db.inc.php');

function ierg4210_cat_fetchall() {
	// DB manipulation
	global $db;
	$db = ierg4210_DB();
	$q = $db->prepare("SELECT * FROM categories LIMIT 100;");
	if ($q->execute())
		return $q->fetchAll();
}

function ierg4210_cat_insert() {
	// input validation or sanitization
	if (!preg_match('/^[\w\-, ]+$/', $_POST['name']))
		throw new Exception("invalid-name");

	// DB manipulation
	global $db;
	$db = ierg4210_DB();
	$q = $db->prepare("INSERT INTO categories (name) VALUES (?)");
	return $q->execute(array($_POST['name']));
}

function ierg4210_cat_edit() {
	// TODO: complete the rest of this function; it's now always says "successful" without doing anything
	if (!preg_match('/^[\w\-, ]+$/', $_POST['name']))
		throw new Exception("invalid-name");

	// DB manipulation
	global $db;
	$db = ierg4210_DB();
	$q = $db->prepare("UPDATE categories SET name = :name WHERE catid = :catid");
	return $q->execute(array(":name"=>$_POST['name'], ":catid"=>$_POST['catid']));
}

function ierg4210_cat_delete() {

	// input validation or sanitization
	$_POST['catid'] = (int) $_POST['catid'];

	// DB manipulation
	global $db;
	$db = ierg4210_DB();
	$q = $db->prepare("DELETE FROM categories WHERE catid = ?");
	return $q->execute(array($_POST['catid']));
}

// Since this form will take file upload, we use the tranditional (simpler) rather than AJAX form submission.
// Therefore, after handling the request (DB insert and file copy), this function then redirects back to admin.html

function ierg4210_prod_fetch_a_cat() {
	$_POST['catid'] = (int) $_POST['catid'];

	// DB manipulation
	global $db;
	$db = ierg4210_DB();
	$q = $db->prepare("SELECT * FROM products WHERE catid = ?");
	if ($q->execute(array($_POST['catid'])))
		return $q->fetchAll();
}

function ierg4210_prod_fetch() {
	// input validation or sanitization
	$_POST['catid'] = (int) $_POST['catid'];
	$_POST['pid'] = (int) $_POST['pid'];

	// DB manipulation
	global $db;
	$db = ierg4210_DB();
	$q = $db->prepare("SELECT * FROM products WHERE pid = ?");
	if ($q->execute(array($_POST['pid'])))
		return $q->fetchAll();
}

function ierg4210_prod_insert() {
	// input validation or sanitization
	$_POST['catid'] = (int) $_POST['catid'];
	$_POST['pid'] = (int) $_POST['pid'];
	// if (!preg_match('/^[\w\-, ]+$/', $_POST['name']))
	// 	throw new Exception("invalid-name");
	// if (!preg_match('/^[\d\.]+$/', $_POST['price']))
	// 	throw new Exception("invalid-price");
	// if (!preg_match('/^[\w\-, ]+$/', $_POST['description']))
	// 	throw new Exception("invalid-description");

	// DB manipulation
	global $db;
	$db = ierg4210_DB();
	// TODO: complete the rest of the INSERT command
	$q = $db->prepare("INSERT INTO products (catid, name, price, description) VALUES (:catid, :name, :price, :description)");
	$q->execute(array(":catid"=>$_POST['catid'], ":name"=>$_POST['name'], ":price"=>$_POST['price'], ":description"=>$_POST['description']));

	// The lastInsertId() function returns the pid (primary key) resulted by the last INSERT command
	$lastId = $db->lastInsertId();

	// Copy the uploaded file to a folder which can be publicly accessible at incl/img/[pid].jpg
	if ($_FILES["file"]["error"] == 0
		&& $_FILES["file"]["type"] == "image/jpeg"
		&& $_FILES["file"]["size"] < 5000000) {

		// Note: Take care of the permission of destination folder (hints: current user is apache)
		if (move_uploaded_file($_FILES["file"]["tmp_name"], "incl/img/" . $lastId . ".jpg")) {
			// redirect back to original page; you may comment it during debug
			header('Location: admin.html');
			exit();
		}

	}

	// Only an invalid file will result in the execution below

	// TODO: remove the SQL record that was just inserted
	$q = $db->prepare("DELETE FROM products WHERE pid = :pid");
	$q->execute(array(":pid"=> $lastId));

	// To replace the content-type header which was json and output an error message
	header('Content-Type: text/html; charset=utf-8');
	echo 'Invalid file detected. <br/><a href="javascript:history.back();">Back to admin panel.</a>';
	exit();
}

// TODO: add other functions here to make the whole application complete
function ierg4210_prod_edit() {

	// input validation or sanitization
	$_POST['catid'] = (int) $_POST['catid'];
	$_POST['pid'] = (int) $_POST['pid'];
	// if (!preg_match('/^[\w\-, ]+$/', $_POST['name']))
	// 	throw new Exception("invalid-name");
	// if (!preg_match('/^[\d\.]+$/', $_POST['price']))
	// 	throw new Exception("invalid-price");
	// if (!preg_match('/^[\w\-, ]$/', $_POST['description']))
	// 	throw new Exception("invalid-description");

	// DB manipulation
	global $db;
	$db = ierg4210_DB();
	$q = $db->prepare("UPDATE products SET catid = :catid, name = :name, price = :price, description = :description WHERE pid = :pid");
	$q->execute(array(":catid"=>$_POST['catid'], ":name"=>$_POST['name'], ":price"=>$_POST['price'], ":description"=>$_POST['description'], ":pid"=>$_POST['pid']));

	$pid = $_POST['pid'];

	if ($_FILES["file"]["size"] == 0) {
		header('Location: admin.html');
		exit();
	} else if ($_FILES["file"]["error"] == 0
		&& $_FILES["file"]["type"] == "image/jpeg"
		&& $_FILES["file"]["size"] < 5000000) {

		if (move_uploaded_file($_FILES["file"]["tmp_name"], "incl/img/" . $pid . ".jpg")) {
			header('Location: admin.html');
			exit();
		}
	} else {
		header('Content-Type: text/html; charset=utf-8');
		echo 'Invalid file detected. <br/><a href="javascript:history.back();">Back to admin panel.</a>';
		exit();
	}

}


function ierg4210_prod_delete() {

	// input validation or sanitization
	$_POST['catid'] = (int) $_POST['catid'];
	$_POST['pid'] = (int) $_POST['pid'];

	// DB manipulation
	global $db;
	$db = ierg4210_DB();
	$q = $db->prepare("DELETE FROM products WHERE pid = ?");
 	return $q->execute(array($_POST['pid']));
}
















header('Content-Type: application/json');

// input validation
if (empty($_REQUEST['action']) || !preg_match('/^\w+$/', $_REQUEST['action'])) {
	echo json_encode(array('failed'=>'undefined'));
	exit();
}

// The following calls the appropriate function based to the request parameter $_REQUEST['action'],
//   (e.g. When $_REQUEST['action'] is 'cat_insert', the function ierg4210_cat_insert() is called)
// the return values of the functions are then encoded in JSON format and used as output
try {
	if (($returnVal = call_user_func('ierg4210_' . $_REQUEST['action'])) === false) {
		if ($db && $db->errorCode())
			error_log(print_r($db->errorInfo(), true));
		echo json_encode(array('failed'=>'1'));
	}
	echo 'while(1);' . json_encode(array('success' => $returnVal));
} catch(PDOException $e) {
	error_log($e->getMessage());
	echo json_encode(array('failed'=>'error-db'));
} catch(Exception $e) {
	echo 'while(1);' . json_encode(array('failed' => $e->getMessage()));
}
?>
