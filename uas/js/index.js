$(document).ready(function() {
  $('#category').on('change', function() {
    var category = $(this).val();
    $.ajax({
      type: "POST",
      url: "filtercatalogue.php",
      data: {
        category: category
      },
      dataType: 'json', 
      success: function(data) {
        var productsHtml = '';
        // $.each(data, function(index, product)
        for(let i = 0; i < data.length; i++) {
          var url = data[i].image;
          productsHtml += '<div class="products-list">';
          productsHtml += '<h2>'+data[i].products_name.toUpperCase()+'</h2>';
          productsHtml += '<div>';
          productsHtml += '<img src="' + url.slice(3) + '" width="100%">';
          productsHtml += '</div>';
          productsHtml += '<form method="post" action="cart/cart.php">';
          productsHtml += '<input type="text" name="products" value="' + data[i].products_name + '" hidden>';
          productsHtml += '<button type="submit" name="submitproducts">BUY<br><b>Rp. '+ data[i].price +'</b></button>';
          productsHtml += '</form>';
          productsHtml += '</div>';
        };
        $('.products-row').html(productsHtml);
      },
      error: function(xhr, status, error) {
        console.error(xhr.responseText);
      }
    });
  });
});