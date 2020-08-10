<?php include "header.php"; ?>

<div class="container-fluid" id="cars"></div>

<script id="entry-template" type="text/x-handlebars-template">
  <div class="row">
  {{#cars}}
    <div class="col-md-3">
      <div class="card p-2 m-1">
        <img src="images/{{model}}.jpg" class="img-fluid" >
        <h4 class="text-center">{{brand}} {{model}}</h4>
        <p>
          Fuel type: {{fuelType}}
          <br>
          Mileage: {{mileage}}
          <br>
          Price per day: $ {{price}}
          <br>
          Availability: {{availability}}
          <br>
          Seats:{{seats}}
          <br>
          Description: {{description}}
        </p>
        <a class="btn btn-primary add-btn" car-id="{{id}}" tabIndex="1">Add to cart</a>
      </div>
    </div>
  {{/cars}}
  </div>
</script>
<script>
  ajaxXML().then(function() {
    var source = document.getElementById("entry-template").innerHTML;
    var template = Handlebars.compile(source);
    var html = template({
      cars: window.cars
    });
    $('#cars').html(html);

    $('.add-btn').click(function(e) {
      var car = findCar($(e.target).attr('car-id'));
      if (car.availability == 'true') {
        $.ajax({
          url: 'reserve.php',
          data: {
            id: car.id
          },
          success: function() {
            alert('Add to the cart successfully.');
          }
        });
      } else {
        alert('Sorry, the car is not available now. Please try other cars.');
      }
    });
  });
</script>