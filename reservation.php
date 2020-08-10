<?php
session_start();
if (!isset($_SESSION["cart"])) {
  $_SESSION["cart"] = array();
}
?>

<?php include "header.php"; ?>


<div class="container-fluid">
  <h4 class="text-center">Car Reservation</h4>
  <br>
  <br>
  <div id="reservation"></div>

  <div class="text-right">
    <a class="btn btn-primary" id="checkout-btn" tabIndex="1">Preceed to checkout</a></a>
  </div>
</div>

<script id="empty-template" type="text/x-handlebars-template">
  <h4 class="text-center text-warning">You don't have anything in the shopping cart</h4>
</script>

<script id="table-template" type="text/x-handlebars-template">
  <table class="table table-bordered">
  <tr>
    <th class="text-center" width="20%">Thumbnail</th>
    <th class="text-center" width="20%">Vehicle</th>
    <th class="text-center" width="20%">Price per day</th>
    <th class="text-center" width="30%">Rental Days</th>
    <th class="text-center" width="10%"></th>
  </tr>
  {{#cars}}
  <tr>
     <td class="text-center">
       <img class="img-fluid" src="images/{{model}}.jpg">
     </td>
     <td class="text-center">
       {{brand}} {{model}}
      </td>
      <td class="text-center">
       ${{price}}
      </td>
      <td class="text-center">
       <input class="form-control" type="number" min="1" value="1" car-id="{{id}}">
     </td>
     <td class="text-center">
       <a class="btn btn-primary" href="cancel.php?id={{id}}">Delete</a>
     </td>
    </tr>
  {{/cars}}
</table>
</script>

<script id="email-tempalte" type="text/x-handlebars-template">
Order detail is as follow:<br>

{{#cart}}
Fuel type: {{car.fuelType}}
<br>
Mileage: {{car.mileage}}
<br>
Price per day: $ {{car.price}}
<br>
Seats:{{car.seats}}
<br>
Description: {{car.description}}
<br>
Rent days: {{days}}
<br>
<br>
{{/cart}}
Total price is ${{totalPrice}}

</script>

<script>
  window.reservedCars = [];

  $('#checkout-btn').click(function(e) {
    if (reservedCars.length == 0) {
      e.preventDefault();
      alert('No car has been reserved.');
      window.location.href = "index.html";
      return;
    }

    // validate
    var inputs = $('input[type=number]');
    for (var i = 0; i < inputs.length; i++) {
      var val = $(inputs[i]).val();
      if (isNaN(val) || val <= 0) {
        e.preventDefault();
        alert('Please enter positive number.');
        return;
      }
    }

    // redirect to checkout page
    var emailContent = 'Order detail\n\n';
    var totalPrice = 0;
    var cart = [];
    $.each(inputs, function(index, input) {
      var car = findCar($(input).attr('car-id'));
      var days = $(input).val();
      cart.push({
        car: car,
        days: days,
      })
      totalPrice += car.price * days;
    });


    var source = document.getElementById('email-tempalte').innerHTML;
    var template = Handlebars.compile(source);
    var emailContent = template({
      cart: cart,
      totalPrice: totalPrice
    });

    console.log(emailContent);

    postForm('checkout.php', {
      totalPrice: totalPrice,
      emailContent: emailContent,
    });
  });

  ajaxXML().done(function() {
    var cars = [];
    var car;
    <?php foreach ($_SESSION['cart'] as $id => $v) { ?>
      car = findCar(<?php echo $id ?>);
      if (car) {
        cars.push(car);
      }
    <?php } ?>
    window.reservedCars = cars;

    var tempalteId = cars.length ? 'table-template' : 'empty-template';
    var source = document.getElementById(tempalteId).innerHTML;
    var template = Handlebars.compile(source);
    var html = template({
      cars: cars
    });
    $('#reservation').html(html);
  });
</script>

</html>