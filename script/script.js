$(document).ready(function(){
<<<<<<< HEAD

=======
    shoppingCart__update();
>>>>>>> 5a0f1165b1aac57b35c2bab2eebbec5f5d691df9

    $('.shopping-list__summary, .shopping-list__detail').mouseover(function(){
        $(".shopping-list__detail").removeClass('hidden');
        $(".shopping-list__summary").addClass('hidden');
    });

    $('.shopping-list__detail').mouseout(function(){
        $(".shopping-list__summary").removeClass('hidden');
        $(".shopping-list__detail").addClass('hidden');
    });


    $("#total--detail").text($("#total").text());

<<<<<<< HEAD

=======
    $(".add").click(function(){
        // var product = '<div class="shopping-list__item row"><span class="shopping-list__item--name col-md-4">- ' + $(this).data('name') + '</span><input class="shopping-list__item--quantity col-md-4" type="number" name="" min="1" value="1"><span class="shopping-list__item--price col-md-4">' + $(this).data('price') + '</span></div>'
        // $(".shopping-list__item:last").after(product);
        shoppingCart__add();
    });
>>>>>>> 5a0f1165b1aac57b35c2bab2eebbec5f5d691df9

    $(".checkout").click(function(){
        alert("Implement in Phase 5");


            // var xhr = (window.XMLHttpRequest)
            //         ? new XMLHttpRequest()
            //         : new ActiveXObject("Microsoft.XMLHTTP"), async = true;
            //
            //
            // //register a callback function
            // xhr.onreadystatechange = function(){
            //     if(xhr.readyState == 4 && xhr.status == 200){
            //         // do something like upgrading the UI
            //         // console.log(this.responseText);
            //         alert();
            //     }
            // }
            // // open the connection
            // xhr.open("GET", "./shoppingCart.php" , async);
            //
            // //send a request
            // xhr.send();
    });

<<<<<<< HEAD
=======
    function shoppingCart__add() {
        var pid = $(event.target).data('pid');

        var obj = new Object();
        obj.pid = pid;
        obj.quantity = 1;


        var storage = JSON.parse(window.localStorage.getItem('cart_storage')) || [];
        // console.log("pid: " + obj.pid);
        // console.log("length:" + storage.length);
        if(!storage.length) {
            storage.push(obj);
        } else {
            for(var i = 0; i < storage.length; i++) {

                if(storage[i].pid == pid) {
                    // console.log(storage[i].quantity);
                    storage[i].quantity++;
                    break;
                } else {
                    if(i == storage.length - 1) {
                        storage.push(obj);
                        break;
                    }
                }
            }
        }
        // console.log(storage[0].pid);
        window.localStorage.setItem('cart_storage', JSON.stringify(storage));
        // console.log(JSON.stringify(storage));

        // myLib.post({action:'prod_fetch', pid: pid, async:false}, function(json){
        //     // console.log(json[0].pid);
        //     // console.log(json[0].name);
        //     console.log(JSON.stringify(json));
        //
        //     shoppingCart__update(storage);
        // });
        shoppingCart__update();
    }

    function shoppingCart__update() {
        // var product = '<div class="shopping-list__item row"><span class="shopping-list__item--name col-md-4">- ' + $(this).data('name') + '</span><input class="shopping-list__item--quantity col-md-4" type="number" name="" min="1" value="1"><span class="shopping-list__item--price col-md-4">' + $(this).data('price') + '</span></div>'
        // (".shopping-list__item:last").after(product);
        // console.log(JSON.stringify(JSON.parse(window.localStorage.getItem('cart_storage'))));

        var storage = JSON.parse(window.localStorage.getItem('cart_storage'));
        var listItems = [];

        // listItems.push('<i class="fa fa-shopping-cart" aria-hidden="true"></i> Shopping List (Total: $<span id="total--detail"></span>)<div class="shopping-list__item row"></div>');

        for(i = 0, listItems = []; i < storage.length; i++) {
            myLib.post({action:'prod_fetch', pid: storage[i].pid, async:false}, function(json){
                // console.log(json[0].name);
                // console.log(JSON.stringify(json));
                // listItems.push('<li id="pid' , parseInt(json[0].pid) , '"></li>');
                listItems.push(
                    '<div class="shopping-list__item row">',
                        '<i class="fa fa-check-circle-o" aria-hidden="true"></i><span class="shopping-list__item--name col-md-4"> ', json[0].name.escapeHTML(), '</span>',
                        '<input class="shopping-list__item--quantity col-md-4" type="number" name="" min="1" value="1">',
                        '<span class="shopping-list__item--price col-md-4">', json[0].price, '</span>',
                    '</div>'
                );
            });
        }
        
        // listItems.push('aa', 'bb');
        // listItems.push('<button type="button" class="checkout btn btn-default">Check Out</button>');
        // console.log(listItems);
        var tmp = listItems.join('');
        console.log(tmp);
        // $(".shopping-list__detail").html(listItems);
        // for (var options = [], listItems = [], i = 0, prod; prod = storage[i]; i++) {
        //     listItems.push('<li id="pid' , parseInt(prod.pid) , '"></li>');
        // }
        // el('shoppingCart').innerHTML = listItems.join('');
    };

>>>>>>> 5a0f1165b1aac57b35c2bab2eebbec5f5d691df9
});
