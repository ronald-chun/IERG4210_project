<?php
	include_once('action/db_conn.php');


?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>IERG4210 Shop - Admin Panel</title>
	<link href="../css/admin.css" rel="stylesheet" type="text/css"/>

</head>

<body>
	<h1>IERG4210 Shop - Admin Panel</h1>
	<article id="main">

	<section id="categoryPanel">
		<fieldset>
			<legend>New Category</legend>
			<form id="cat_insert" method="POST" action="admin-process.php?action=cat_insert" onsubmit="return false;">
				<label for="cat_insert_name">Name</label>
				<div><input id="cat_insert_name" type="text" name="name" required="true" pattern="^[\w\- ]+$" /></div>

				<input type="submit" value="Submit" />
			</form>
		</fieldset>

		<!-- Generate the existing categories here -->
		<ul id="categoryList">
			<?php
				$sql = "SELECT * FROM categories";
				$result = $conn->query($sql);

				if ($result->num_rows > 0) {
					while($row = $result->fetch_assoc()) {
						echo "<li id=" . $row["catid"] . "><span class='name'>" . $row["name"] ."</span><span class='delete'>[Delete]</span><span class='edit'>[Edit]</span></li>";
					}
				}
			?>
		</ul>
	</section>

	<section id="categoryEditPanel" class="hide">
		<fieldset>
			<legend>Editing Category</legend>
			<form id="cat_edit" method="POST" action="admin-process.php?action=cat_edit" onsubmit="return false;">
				<label for="cat_edit_name">Name</label>
				<div><input id="cat_edit_name" type="text" name="name" required="true" pattern="^[\w\- ]+$" /></div>
				<input type="hidden" id="cat_edit_catid" name="catid" />
				<input type="submit" value="Submit" /> <input type="button" id="cat_edit_cancel" value="Cancel" />
			</form>
		</fieldset>
	</section>

	<section id="productPanel">
		<fieldset>
			<legend>New Product</legend>
			<form id="prod_insert" method="POST" action="admin-process.php?action=prod_insert" enctype="multipart/form-data">
				<label for="prod_insert_catid">Category *</label>
				<div><select id="prod_insert_catid" name="catid"></select></div>

				<label for="prod_insert_name">Name *</label>
				<div><input id="prod_insert_name" type="text" name="name" required="true" pattern="^[\w\- ]+$" /></div>

				<label for="prod_insert_price">Price *</label>
				<div><input id="prod_insert_price" type="number" name="price" required="true" pattern="^[\d\.]+$" /></div>

				<label for="prod_insert_description">Description</label>
				<div><textarea id="prod_insert_description" name="description" pattern="^[\w\-, ]$"></textarea></div>

				<label for="prod_insert_name">Image *</label>
				<div><input type="file" name="file" required="true" accept="image/jpeg" /></div>

				<input type="submit" value="Submit" />
			</form>
		</fieldset>

		<section id="productEditPanel" class="">
			<!--
				Design your form for editing a product's catid, name, price, description and image
				- the original values/image should be prefilled in the relevant elements (i.e. <input>, <select>, <textarea>, <img>)
				- prompt for input errors if any, then submit the form to admin-process.php (AJAX is not required)
			-->
		</section>

		<!-- Generate the corresponding products here -->
		<ul id="productList"></ul>

	</section>

	<section id="productEditPanel" class="">
	</section>

	<div class="clear"></div>
	</article>

</body>
</html>
