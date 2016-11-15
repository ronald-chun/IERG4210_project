$(document).ready(function(){


    $('.shopping-list__summary, .shopping-list__detail').mouseover(function(){
        $(".shopping-list__detail").removeClass('hidden');
        $(".shopping-list__summary").addClass('hidden');
    });

    $('.shopping-list__detail').mouseout(function(){
        $(".shopping-list__summary").removeClass('hidden');
        $(".shopping-list__detail").addClass('hidden');
    });


    $("#total--detail").text($("#total").text());



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

});
