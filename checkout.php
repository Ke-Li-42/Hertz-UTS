<?php
session_start();
$_SESSION['emailContent'] = $_POST['emailContent'];
$total = $_POST['totalPrice'];
?>

<?php include "header.php"; ?>

<style>
  span {
    color: red;
  }
</style>

<script>
  function validateSubmit() {
    var inputs = $('input[required]');
    for (var i = 0; i < inputs.length; i++) {
      if (!$(inputs[i]).val()) {
        alert('please fill in all required fields');
        return false;
      }
    };
    return true;
  };
</script>

<div class="container-fluid">
  <h4 class="text-center">Checkout</h4>
  <br>

  <div class="row">
    <div class="col-6 offset-3">
      <form action="email.php" method="post" onsubmit="return validateSubmit()">
        <table class="table table-bordered">
          <tr>
            <td>First Name<span>*</span></td>
            <td>
              <input class="form-control" name="firstName" required></td>
          </tr>
          <tr>
            <td>Last Name<span>*</span></td>
            <td>
              <input class="form-control" name="lastName" required></td>
          </tr>
          <tr>
            <td>Email Address<span>*</span></td>
            <td>
              <input name="email" class="form-control" r type="email" equired></td>
          </tr>
          <tr>
            <td>Address line 1<span>*</span></td>
            <td>
              <input class="form-control" name="address1" required></td>
          </tr>
          <tr>
            <td>Address line 2</td>
            <td>
              <input class="form-control" name="address2"></td>
          </tr>
          <tr>
            <td>City<span>*</span></td>
            <td>
              <input class="form-control" name="city" required></td>
          </tr>
          <tr>
            <td>State<span>*</span></td>
            <td>
              <select class="form-control" name="state">
                <option value="SA">SA</option>
                <option value="QLD">QLD</option>
                <option value="NT">NT</option>
                <option value="ACT">ACT</option>
                <option value="TAS">TAS</option>
                <option value="NSW">NSW</option>
                <option value="WA">WA</option>
              </select>
            </td>
          </tr>
          <tr>
            <td>Post Code<span>*</span></td>
            <td>
              <input class="form-control" name="postcode" required></td>
          </tr>
          <tr>
            <td>Payment type<span>*</span></td>
            <td>
              <select name="payment" class="form-control">
                <option>MasterCard</option>
                <option>Visa</option>
              </select>
            </td>
          </tr>
        </table>
        <p>You are require to pay $<?php echo $total ?></p>
        <div class="text-right">
          <a class="btn btn-warning" href="index.php">Continue selection</a>
          <button class="btn btn-primary" type="submit">Booking</button>
        </div>
      </form>
    </div>
  </div>
</div>
</div>