// Product type switcher
$(document).ready(function() {
    $('.item_extra').hide();
    $('.message-box').hide();

    $("#productType").on('change', function() {
        var inputValue = $(this).val();
        $('.item_extra').hide();
        $("#"+inputValue).show()
    });
});

function isValidString(val) {
    return val && val.length <= 255;
}

function isValidNum(val) {
    return val && !isNaN(val) && parseFloat(val) < 1000000;
}

// Save new product
$('#save-product-btn').click(function() {
    let type = $('#productType').val();
    let sku_val = $('#sku').val();
    let name_val = $('#name').val();
    let price_val = $('#price').val();
    let special_val = null;

    // Check for input correctness for special attribute fields
    if (type == 'DVD') {
        special_val = $('#size').val();
        special_val = isValidNum(special_val) ? 'Size: ' + special_val + ' MB' : null;
    } else if (type == 'Book') {
        special_val = $('#weight').val();
        special_val = isValidNum(special_val) ? 'Weight: ' + special_val + ' KG' : null;
    } else if (type == 'Furniture') {
        const h = $('#height').val();
        const w = $('#width').val();
        const l = $('#length').val();
        if (isValidNum(h) && isValidNum(w) && isValidNum(l)) {
            special_val = h + 'x' + w + 'x' + l;
            special_val = 'Dimensions: ' + special_val + ' CM'
        } else {
            special_val = null;
        }
    }

    // Check for input correctness for all fields
    if (!(isValidString(type) && isValidString(special_val) && isValidString(sku_val) && isValidString(name_val) && isValidNum(price_val))) {
        $('.message-box').show();
        $('.message-box').text('Please, submit required data of indicated type');
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
        url: "https://test-assignment-scandiweb.herokuapp.com/api/post/create.php",
        data: { 'new': new_item, 'type': type }
    }).done(function( msg ) {
        window.location.href = '/';
    });
});
