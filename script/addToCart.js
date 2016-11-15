$(document).ready(function(){
    shoppingCart__update();

    $(".add").click(function(){
        // var product = '<div class="shopping-list__item row"><span class="shopping-list__item--name col-md-4">- ' + $(this).data('name') + '</span><input class="shopping-list__item--quantity col-md-4" type="number" name="" min="1" value="1"><span class="shopping-list__item--price col-md-4">' + $(this).data('price') + '</span></div>'
        // $(".shopping-list__item:last").after(product);
        shoppingCart__add();
    });

    // $(".shopping-list__item--delete").click(function(){
    //     shoppingCart__delete();
    // });
    $("#shoppingCart").on("click", ".shopping-list__item--delete", function(){
        shoppingCart__delete();
    });



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
        $("#shoppingCart").html("");
        var storage = JSON.parse(window.localStorage.getItem('cart_storage'));
        // console.log(JSON.stringify(storage));
        // var listItems = [];
        // listItems.push('<i class="fa fa-shopping-cart" aria-hidden="true"></i> Shopping List (Total: $<span id="total--detail"></span>)<div class="shopping-list__item row"></div>');
        if(storage.length == 0) {
            $("#shoppingCart").html('<span>No item</span>');
            return 0;
        }
        for(i = 0; i < storage.length; i++) {
            myLib.post({action:'prod_fetch', pid: storage[i].pid, async:false}, function(json){
                // console.log(json[0].name);
                // console.log(JSON.stringify(json));
                var quantity;
                for(i = 0; i < storage.length; i++) {
                    if(json[0].pid == storage[i].pid) {
                        quantity = storage[i].quantity;
                    }
                }
                var item = [];
                item.push(
                    '<div class="shopping-list__item row">',
                        '<span class="shopping-list__item--name col-md-4"><i class="fa fa-check-circle-o" aria-hidden="true"></i> ', json[0].name.escapeHTML(), '</span>',
                        '<input class="shopping-list__item--quantity col-md-3" type="number" name="" min="1" value="', quantity, '">',
                        '<span class="shopping-list__item--price col-md-3">@ ', json[0].price, '</span>',
                        '<button class="shopping-list__item--delete col-md-1" data-pid="', json[0].pid, '"><i class="fa fa-trash-o" aria-hidden="true" data-pid="', json[0].pid, '"></i></button>',
                    '</div>'
                );
                $("#shoppingCart").append(item.join(''));
            });
        }

    };

    function shoppingCart__delete(e) {
        var storage = JSON.parse(window.localStorage.getItem('cart_storage'));
        var pid = $(event.target).data("pid");
        for(i = 0; i < storage.length; i++) {
            if(storage[i].pid == pid) {
                storage.splice(i,1);
            }
        }
        // console.log(JSON.stringify(storage));
        window.localStorage.setItem('cart_storage', JSON.stringify(storage));
        shoppingCart__update();
    }

});
