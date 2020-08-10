<title>Hertz-UTS Ass2</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootswatch/4.3.1/cerulean/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.3.1.min.js" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/4.1.2/handlebars.min.js"></script>

<script>
  window.cars = [];

  function findCar(id) {
    var car = null;
    $.each(window.cars, function(index, c) {
      if (c.id == id) {
        car = c;
      }
    });
    return car;
  }

  function convertXmlToCar(xml) {
    $(xml).find('car').each(function(index, car) {
      var car = {
        id: $(car).find('id').text(),
        model: $(car).find('model').text(),
        brand: $(car).find('brand').text(),
        availability: $(car).find('availability').text(),
        category: $(car).find('category').text(),
        fuelType: $(car).find('fuelType').text(),
        description: $(car).find('description').text(),
        year: $(car).find('year').text(),
        mileage: $(car).find('mileage').text(),
        seats: $(car).find('seats').text(),
        price: $(car).find('price').text(),
      };
      window.cars.push(car);
    });
  }

  function ajaxXML() {
    return $.ajax('data/cars.xml').done(convertXmlToCar);
  }

  function postForm(url, data) {
    var form = document.createElement('form');
    document.body.appendChild(form);
    form.method = 'post';
    form.action = url;
    for (var name in data) {
      var input = document.createElement('input');
      input.type = 'hidden';
      input.name = name;
      input.value = data[name];
      form.appendChild(input);
    }
    form.submit();
  }
</script>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="index.php">Hertz-UTS</a>
  <div class="collapse navbar-collapse">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" href="reservation.php">My Reservaton</a>
      </li>
    </ul>
  </div>
</nav>
<br>