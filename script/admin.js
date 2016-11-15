$(document).ready(function(){
	(function(){
		function updateUI() {
			myLib.get({action:'cat_fetchall'}, function(json){
				// console.log(JSON.stringify(json));
				// loop over the server response json
				//   the expected format (as shown in Firebug):
				for (var options = [], listItems = [], i = 0, cat; cat = json[i]; i++) {
					options.push('<option value="' , parseInt(cat.catid) , '">' , cat.name.escapeHTML() , '</option>');
					listItems.push('<li id="cat' , parseInt(cat.catid) , '"><span class="name">' , cat.name.escapeHTML() , '</span> <span class="delete">[Delete]</span> <span class="edit">[Edit]</span></li>');
				}
				el('prod_insert_catid').innerHTML = '<option disabled></option>' + options.join('');
				el('prod_edit_catid').innerHTML = '<option disabled></option>' + options.join('');
				el('categoryList').innerHTML = listItems.join('');
			});
			el('productList').innerHTML = '';
		}
		updateUI();

		el('categoryList').onclick = function(e) {
			if (e.target.tagName != 'SPAN')
				return false;

			var target = e.target,
				parent = target.parentNode,
				id = target.parentNode.id.replace(/^cat/, ''),
				name = target.parentNode.querySelector('.name').innerHTML;

			// handle the delete click
			if ('delete' === target.className) {
				confirm('Sure?') && myLib.post({action: 'cat_delete', catid: id}, function(json){
					alert('"' + name + '" is deleted successfully!');
					updateUI();
				});

			// handle the edit click
			} else if ('edit' === target.className) {
				// toggle the edit/view display
				el('categoryEditPanel').show();
				el('categoryPanel').hide();

				// fill in the editing form with existing values
				el('cat_edit_name').value = name;
				el('cat_edit_catid').value = id;

			//handle the click on the category name
			} else {
				el('productEditPanel').hide();
				el('productPanel').show();
				el('prod_insert_catid').value = id;
				// populate the product list or navigate to admin.php?catid=<id>
				myLib.post({action: 'prod_fetch_a_cat', catid: id}, function(json){
					for (var listItems = [], i = 0; i < Object.keys(json).length; i++) {
						listItems.push('<li id="p' , json[i].pid , '"><label class="name">' , json[i].name.escapeHTML() , '</label> <span class="delete">[Delete]</span> <span class="edit">[Edit]</span></li>');
					}
					el('productList').innerHTML = listItems.join('');
				});
			}
		}

		el('productList').onclick = function(e) {
			if (e.target.tagName != 'SPAN')
				return false;

			var target = e.target,
				parent = target.parentNode,
				id = target.parentNode.id.replace(/^p/, ''),
				name = target.parentNode.querySelector('.name').innerHTML;

			if ('delete' === target.className) {
				confirm('Sure?') && myLib.post({action: 'prod_delete', pid: id}, function(json){
					alert('"' + name + '" is deleted successfully!');
					updateUI();
				});

			// handle the edit click
			} else if ('edit' === target.className) {
				el('prod_edit_img').setAttribute('src', "");
				el('productEditPanel').show();
				el('productPanel').hide();
				myLib.post({action: 'prod_fetch', pid: id}, function(json){
					console.log(JSON.stringify(json));
					el('prod_edit_catid').value = json[0].catid;
					el('prod_edit_pid').value = json[0].pid;
					el('prod_edit_name').value = json[0].name;
					el('prod_edit_price').value = json[0].price;
					el('prod_edit_description').value = json[0].description;
					el('prod_edit_img').setAttribute('src', '/incl/img/' + json[0].pid + ".jpg");
				});
			}

		}

		el('cat_insert').onsubmit = function() {
			return myLib.submit(this, updateUI);
		}
		el('cat_edit').onsubmit = function() {
			return myLib.submit(this, function() {
				// toggle the edit/view display
				el('categoryEditPanel').hide();
				el('categoryPanel').show();
				updateUI();
			});
		}
		el('cat_edit_cancel').onclick = function() {
			// toggle the edit/view display
			el('categoryEditPanel').hide();
			el('categoryPanel').show();
		}

		el('prod_edit_cancel').onclick = function() {
			// toggle the edit/view display
			el('productEditPanel').hide();
			el('productPanel').show();
		}

	})();

});
