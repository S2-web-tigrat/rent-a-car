<?php include 'conn.php'; ?>
<div id="cars">
  <h1 style="color: white;text-align:center;">Lista e Veturave Të Lira</h1>
  <?php 
    $months_albanian = [
      "01" => "Janar",
      "02" => "Shkurt",
      "03" => "Mars",
      "04" => "Prill",
      "05" => "Maj",
      "06" => "Qershor",
      "07" => "Korrik",
      "08" => "Gusht",
      "09" => "Shtator",
      "10" => "Tetor",
      "11" => "Nentor",
      "12" => "Dhjetor",
    ];
    if (isset($_POST['service_month'])) {
      $month = $_POST['service_month'];
    } else {
      $month = date('m');
    }
    $albanian_month = $months_albanian[$month];
    $cars_sql = "SELECT * FROM cars WHERE availability=1;";
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
              <!-- <span class="car_kilometers">
                <strong>Disponueshmëria:</strong>
                <span>I Disponueshëm</span>
              </span> <br /> -->
              <button class="car_services" onclick="view_car('.$car['id'].')">Të dhënat</button> <br />
              <button class="car_rent" onclick="view_rent_car('.$car['id'].')">Rent</button>
            </div> <!-- car_content -->
            <div class="all_car_information" id="car_information_'.$car['id'].'" style="display: none;">
              <table>
                <caption style="padding: 7px;font-size: 22px;color: #2D3142;">
                  <strong>Serviset per muajin 
                    <select style="background: #2D3142;padding: 5px;font-size: 18px;color: white;" onchange="edit_service_month(this.value, '.$car['id'].')">
                      ';
                        echo "<option value='$month=>'>$albanian_month</option>";
                        foreach ($months_albanian as $key=>$month_albanian) {
                          if ($key == $month) { continue; }
                          echo "<option value='$key'>$month_albanian</option>";
                        }
                      echo '
                    </select>
                  </strong>
                </caption>
                <tr>
                  <th>Servisimi</th>
                  <th>Sasia</th>
                  <th>Cmimi</th>
                  <th>Total</th>
                  <th>E Paguar</th>
                  <th>E Papaguar</th>
                  <th>Data</th>
                  <th>Vepro</th>
                </tr>
        ';
            $all_total = $all_total_paid = $all_total_unpaid = 0;
            $services_sql = "SELECT * FROM services WHERE car_id='".$car['id']."'; ";
            $services_result = mysqli_query($conn, $services_sql);
            if (mysqli_num_rows($services_result) > 0) {
              while ($service = mysqli_fetch_assoc($services_result)) {
                if (date("m",strtotime($service['date'])) == $month) {
                  echo '<tr>';
                    $total = $service['price'] * $service['quantity'];
                    echo '<th>'.$service['service_name'].'</th>';
                    echo '<th>'.$service['quantity'].'</th>';
                    echo '<th>'.$service['price'].'€</th>';
                    echo '<th>'.$total.'€</th>';
                    echo '<th><input type="number" style="padding: 5px;width: 90%;box-sizing: border-box;" step="0.01" value="'.$service['paid'].'" onchange="edit_service_paid(this.value, '.$service['id'].', '.$car['id'].')" /> €</th>';
                    echo '<th>'. ($total - $service['paid']) .'€</th>';
                    echo '<th>'.$service['date'].'</th>';
                    echo '<th>';
                      // echo '<button class="service_action service_edit"><i class="fa fa-edit"></i></button>';
                      echo '<button class="service_action service_delete" onclick="delete_service('.$service['id'].', '.$car['id'].')"><i class="fa fa-trash-alt"></i></button>';
                    echo '</th>';
                  echo '</tr>';
                  $all_total += $total;
                  $all_total_paid += $service['paid'];
                  $all_total_unpaid += ($total - $service['paid']);
                }
              }
            }
        echo '
                  <tr style="max-width: 100%;" class="add_service_tr">
                    <th><input name="service_name"     type="text"   style="padding: 5px;width: 100%;box-sizing: border-box;" /></th>
                    <th><input name="service_quantity" type="number" style="padding: 5px;width: 100%;box-sizing: border-box;" /></th>
                    <th><input name="service_price"    type="text" step="0.01" style="padding: 5px;width: 90%;box-sizing: border-box;" /> €</th>
                    <th><input name="service_total"    type="text" step="0.01" style="padding: 5px;width: 90%;box-sizing: border-box;" disabled /> €</th>
                    <th><input name="service_paid"     type="text" step="0.01" style="padding: 5px;width: 90%;box-sizing: border-box;" /> €</th>
                    <th><input name="service_unpaid"   type="text" step="0.01" style="padding: 5px;width: 90%;box-sizing: border-box;" disabled /> €</th>
                    <th><input name="service_date"     type="date" style="width: 100%;box-sizing: border-box;" /></th>
                    <th>
                      <button onclick="add_service('.$car['id'].')" class="service_action service_add"><i class="fa fa-plus-square"></i></button>
                    </th>
                  </tr>
                  <tr style="background: green;color: white;letter-spacing: 5px;">
                    <th>Totali</th><th>për</th><th>Shkurt</th>
                    <th>'.$all_total.'€</th>
                    <th>'.$all_total_paid.'€</th>
                    <th>'.$all_total_unpaid.'€</th>
                    <th></th><th></th>
                  </tr>
              ';
          echo '
              </table>
            </div> <!-- all_car_information -->
            <div class="rentcar" id="car_rent_'.$car['id'].'" style="display: none;">
              <table style="min-width: 100%;" class="add_client">
                <caption style="padding: 7px;font-size: 22px;color: #2D3142;">Rent Veturen</caption>
                <tr>
                  <th>Klienti</th>
                  <th>Emri</th>
                  <th>Mbiemri</th>
                  <th>Datëlindja</th>
                  <th>Numri i letërnjoftimit</th>
                  <th>Veprim</th>
                </tr>
                <tr>
                  <th>
                    <select style="padding: 5px;" onchange="select_rent_client(this.value, '.$car['id'].')">
                    ';
                      if (isset($_POST['selected_rent_client'])) {
                        $selected_client = $_POST['selected_rent_client'];
                      } else {
                        $selected_client;
                      }
                      $selected_client;
                      $clients_sql = "SELECT * FROM clients; ";
                      $clients_result = mysqli_query($conn, $clients_sql);
                      $current_client_result = mysqli_query($conn, "SELECT * FROM clients WHERE id=$selected_client; ");
                      while ($current_client_row = mysqli_fetch_assoc($current_client_result))  {
                        echo "<option value='".$current_client_row['id']."'>". $current_client_row['name'] . " " . $current_client_row['l_name'] ."</option>";
                        $selected_client = $current_client_row;
                      }
                      $counter = 0;
                      if (mysqli_num_rows($clients_result) > 0) {
                        while ($client = mysqli_fetch_assoc($clients_result)) {
                          if (isset($_POST['selected_rent_client'])) {
                            if ($client['id'] == $_POST['selected_rent_client']) {
                              continue;
                            }
                          }
                          if ($counter == 0 && !isset($_POST['selected_rent_client'])) {
                            $selected_client = $client;
                          }
                          echo "<option value='".$client['id']."'>". $client['name'] . " " . $client['l_name'] ."</option>";
                          $counter++;
                        }
                      }
                      $global_client = $selected_client['id'];
                    echo '
                    </select>
                  </th>
                  <th><input value="'.$selected_client['name'].'" disabled name="rent_client_name"    type="text" style="padding: 5px;width: 90%;box-sizing: border-box;" /></th>
                  <th><input value="'.$selected_client['l_name'].'" disabled name="rent_client_l_name"    type="text" style="padding: 5px;width: 90%;box-sizing: border-box;" /></th>
                  <th><input value="'.$selected_client['birth_date'].'" disabled name="rent_client_birthdate"    type="date" style="padding: 5px;width: 90%;box-sizing: border-box;" /></th>
                  <th><input value="'.$selected_client['identification_id'].'" disabled name="rent_client_identification_id"    type="text" style="padding: 5px;width: 90%;box-sizing: border-box;" /></th>
                  <th><button style="background: green;color: white;padding: 5px;border: none;cursor: pointer;" onclick="select_rent_client_final('.$car['id'].', '.$client['id'].')">Zgjedh Klientin</button></th>
                </tr>
              </table>
              <table style="min-width: 100%;" class="add_rent">
                <caption style="padding: 7px;font-size: 22px;color: #2D3142;">Rent Veturen</caption>
                <tr>
                  <th>Data e Marrjes</th>
                  <th>Data e Kthimit</th>
                  <th>Klienti</th>
                  <th>Çmimi</th>
                  <th>Ditet</th>
                  <th>Vepro</th>
                </tr>
                <tr>
                  <th><input name="rent_date_take"     type="date"   style="padding: 5px;width: 100%;box-sizing: border-box;" /></th>
                  <th><input name="rent_date_return" type="date" style="padding: 5px;width: 100%;box-sizing: border-box;" /></th>
                  <th><input name="rent_date_client" type="text" style="padding: 5px;width: 100%;box-sizing: border-box;" disabled /></th>
                  <th><input name="rent_price" type="number" step="0.01" style="padding: 5px;width: 65%;box-sizing: border-box;" /> €</th>
                  <th><input name="rent_days" type="number" style="padding: 5px;width: 50%;box-sizing: border-box;" /></th>
                  <th>
                    <button onclick="add_rent('.$car['id'].', '.$global_client.')" class="rent_add"><i class="fa fa-plus-square"></i></button>
                  </th>
                </tr>
              </table>
            </div>
          </div> <!-- car -->
        ';
      }
    }
  ?>
</div> <!-- #cars -->