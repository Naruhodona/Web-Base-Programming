$(document).ready(function() {
    var products = 'all';
    $.ajax({
      type: "POST",
      url: "requestproducts.php",
      data: {
        products: products
      },
      dataType: 'json', 
      success: function(data) {
        var productsHtml = '<option value="" selected disabled hidden>-- Select Products --</option>';
        // $.each(data, function(index, product)
        for(let i = 0; i < data.length; i++) {
          productsHtml += '<option value="'+data[i].products_id+'">'+data[i].products_name.toUpperCase()+'</option>';
        };
        $('#products-option').html(productsHtml);
      },
      error: function(xhr, status, error) {
        console.error(xhr.responseText);
      }
    });
});