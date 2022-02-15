<?php include 'conn.php'; ?>
<div id="cars">
  <h1 style="color: white;text-align:center;">Lista e Veturave Të Rezervuara</h1>
  <?php 
    $cars_sql = "SELECT * FROM cars WHERE availability=0;";
    $cars_result = mysqli_query($conn, $cars_sql);
    if (mysqli_num_rows($cars_result) > 0) {
      while ($car = mysqli_fetch_assoc($cars_result)) {
        echo '
          <div class="car">
            <div class="car_image">
              <img src="cars/'.$car['image_name'].'" alt="'.$car['image_name'].'" />
            </div>
            <div class="car_content">
              <h2>'.$car['name'].'</h2>
              <span class="car_chassis_number">
                <strong>Numri i Shasisë:</strong>
                <span>'.$car['chassie_number'].'</span>
              </span> <br />
              <span class="car_kilometers">
                <strong>Kilometrazha:</strong>
                <span>'.$car['kilometers_passed'].'</span>
              </span> <br />
              <span class="car_registration">
                <strong>Regjistrimi:</strong>
                <span>'.$car['registration'].'</span>
              </span> <br />
              <span class="car_registration_date">
                <strong>Data e regjistrimit:</strong>
                <span>'.$car['registration_date'].'</span>
              </span> <br />
              <span class="car_registration_due_date">
                <strong>Data e skadimit të regjistrimit:</strong>
                <span>'.$car['registration_due_date'].'</span>
              </span> <br />
        ';
              $rent_sql = "SELECT * FROM rent WHERE car=".$car['id']." AND finished = 0;";
              $rent_result = mysqli_query($conn, $rent_sql);
              if (mysqli_num_rows($rent_result) > 0) {
                while ($rent = mysqli_fetch_assoc($rent_result)) {
                  $client = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM clients WHERE id=" . $rent['client']));
                  echo '
                    <span class="car_renter">
                      <strong>Klienti:</strong>
                      <span style="text-decoration: underline;cursor: pointer;">'. $client['name'] . " " . $client['l_name'] .'</span>
                    </span> <br />
                    <span class="car_renter">
                      <strong>Data Marrjes:</strong>
                      <span style="text-decoration: underline;cursor: pointer;">'. $rent['take_date'] .'</span>
                    </span> <br />
                    <span class="car_renter">
                      <strong>Data Kthimit:</strong>
                      <span style="text-decoration: underline;cursor: pointer;">'. $rent['return_date'] .'</span>
                    </span> <br />
                    <span class="car_renter">
                      <strong>Cmimi:</strong>
                      <span>'. $rent['price'] .'€</span>
                    </span> <br />
                    <span class="car_renter">
                      <strong>Ditet:</strong>
                      <span>'. $rent['days'] .'</span>
                    </span> <br />
                    <span class="car_renter">
                      <strong>Total:</strong>
                      <span>'. $rent['days'] * $rent['price'] .'€</span>
                    </span> <br />
                  ';
                }
              }
        echo '
              <a style="text-decoration: underline;color: red;cursor: pointer;" onclick="finish_rent('.$car['id'].');">Përfundo Terminin</a>
            </div> <!-- car_content -->
          </div> <!-- car -->
        ';
      }
    }
  ?>
</div> <!-- #cars -->