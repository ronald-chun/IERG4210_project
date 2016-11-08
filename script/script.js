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

    $(".add").click(function(){
        var product = '<div class="shopping-list__item row"><span class="shopping-list__item--name col-md-4">- ' + $(this).data('name') + '</span><input class="shopping-list__item--quantity col-md-4" type="number" name="" min="1" value="1"><span class="shopping-list__item--price col-md-4">' + $(this).data('price') + '</span></div>'
        $(".shopping-list__item:last").after(product);

    });

    $(".checkout").click(function(){
        alert("Implement in Phase 5");

    });

});
