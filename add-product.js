// Product type switcher
$(document).ready(function() {
    $('.item_extra').hide();
    $("#productType").on('change', function() {
        var inputValue = $(this).val();
        $('.item_extra').hide();
        $("#"+inputValue).show()
    });
});

function checkInput(val) {
    return false;
}

// Save new product
$('#save-product-btn').click(function() {
    let type = $('#productType').val();
    let sku_val = $('#sku').val();
    let name_val = $('#name').val();
    let price_val = $('#price').val();
    let special_val = null;

    if (type == 'DVD') {
        special_val = $('#Size').val();
        special_val = 'Size: ' + special_val + ' MB';
    } else if (type == 'Book') {
        special_val = $('#Weight').val();
        special_val = 'Weight: ' + special_val + ' KG'
    } else if (type == 'Furniture') {
        special_val = $('#Height').val() + 'x' + $('#Width').val() + 'x' + $('#Length').val(); 
        special_val = 'Dimensions: ' + special_val + ' CM'
    }

    if (type == null || sku_val == null || name_val == null || price_val == null || special_val == null) {
        alert('Please fill in all fields (including type)');
        return false;
    }

    let new_item = {
        'SKU': sku_val,
        'Name': name_val,
        'Price': price_val,
        'Special_attribute': special_val,
    };

    $.ajax({
        type: "POST",
        url: "api/post/create.php",
        data: { 'new': new_item, 'type': type }
    }).done(function( msg ) {
        window.location.href = '/sandbox/testwebsite/';
    });
});
