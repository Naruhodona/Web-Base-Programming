$(document).ready(function() {
  $('input[name="quantity"]').on('change', function() {
    var quantity = $(this).val();
    var products_name = $(this).data('products-name');
    $.ajax({
      type: "POST",
      url: "../cart/updatecart.php",
      data: {
        quantity: quantity,
        products_name: products_name
      },
      success: function(data) {
        console.log(data);
      },
      error: function(xhr, status, error) {
        console.error(xhr.responseText);
      }
    });
  });
});

function updateSubtotal(quantity, id){
	var elementid = id;
	var total_temp = document.getElementById('total').value;
	var subtotal_temp = document.getElementById('subtotal_'+elementid).value;
	var price = document.getElementById('price_'+elementid).innerText;
	var total = parseInt(total_temp) - parseInt(subtotal_temp);
	var subtotal = parseInt(price) * parseInt(quantity);
	total += subtotal;

	document.getElementById('subtotal_'+elementid).value = subtotal;
	document.getElementById('total').value = total;

}
