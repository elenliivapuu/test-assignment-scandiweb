// Load items
$(document).ready(function() {
    $.ajax({
        type: "GET",
        url: "https://test-assignment-scandiweb.herokuapp.com/api/products.php",
    }).done(function( res ) {
        console.log(res)
        if (!res) { return false; }

        const results_obj = JSON.parse(res)['data'];
        // create blocks for items
        for (res of results_obj) {
            const newElem = `
            <div class="grid-item">
                <input class="delete-checkbox" type="checkbox" value=${res.id}></input>
                <p class="item-sku">${res.SKU}</p>
                <h4 class="item-name">${res.Name}</h4>
                <small class="item-attr">${res.Special_attribute}</small>
                <br>
                <p class="item-price">${parseFloat(res.Price).toFixed(2)}$</p>
            </div>`;

            $('#main-grid').append(newElem);
        }
    });
});

// Mass Delete
$('#delete-product-btn').click(function() {
    let item_ids = [];
    for (box of $('.delete-checkbox')){
        if (box.checked) {
            item_ids.push(box.value);
        }
    }
    $.ajax({
        type: "POST",
        url: "https://test-assignment-scandiweb.herokuapp.com/api/products.php",
        data: { ids: item_ids }
    }).done(function( msg ) {
        location.reload();
    });
});