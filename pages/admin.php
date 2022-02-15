<?php include 'conn.php'; ?>
<div id="admin">
  <h1 style="color: white;text-align:center;">Admin</h1>
  <table>
    <tr>
      <th>Foto</th>
      <th>Emri</th>
      <th>Nr. i Shasisë</th>
      <th>Kilometra të kaluara</th>
      <th>Regjistrimi</th>
      <th>Data e Regjistrimit</th>
      <th>Data e Skadimit te Regjistrimit</th>
      <th>Disponueshëm</th>
      <th>Vepro</th>
    </tr>
    <?php 
      $cars_sql = "SELECT * FROM cars; ";
      $cars_result = mysqli_query($conn, $cars_sql);
      if (mysqli_num_rows($cars_result) > 0) {
        while ($car = mysqli_fetch_assoc($cars_result)) {
          echo "<tr>";
            echo "<th><img width='150' src='cars/".$car['image_name']."' alt='".$car['image_name']."' /></th>";
            echo "<th>".$car['name']."</th>";
            echo "<th>".$car['chassie_number']."</th>";
            echo "<th>".$car['kilometers_passed']." km</th>";
            echo "<th>".$car['registration']."</th>";
            echo "<th><input type='date' value='".$car['registration_date']."'/></th>";
            echo "<th><input type='date' value='".$car['registration_due_date']."'/></th>";
            if ($car['availability'] == 1) {
              echo "<th style='text-align: center;'>Jo</th>";
            } else {
              echo "<th style='text-align: center;'>Po</th>";
            }
            echo "<th></th>";
          echo "</tr>";
        }
      }
    ?>
    <tr>
      <th></th>
      <th>
        <input name="add_car_name" type="text"   style="padding: 5px;width: 100%;box-sizing: border-box;" />
      </th>
      <th>
        <input name="add_car_chassie_number" type="text" style="padding: 5px;width: 100%;box-sizing: border-box;" />
      </th>
      <th>
        <input name="add_car_kilometers_passed" type="text" style="padding: 5px;width: 100%;box-sizing: border-box" />
      </th>
      <th>
        <input name="add_car_registration" type="text" style="padding: 5px;width: 100%;box-sizing: border-box;" /> 
      </th>
      <th>
        <input name="add_car_registration_date" type="date" style="padding: 5px;width: 100%;box-sizing: border-box;" /> 
      </th>
      <th>
        <input name="add_car_registration_due_date" type="date" style="padding: 5px;width: 100%;box-sizing: border-box;" /> 
      </th>
      <th></th>
      <th>
        <button class="add_car_button" onclick="add_car()"><i class="fa fa-plus"></i></buton>
      </th>
    </tr>
  </table>
</div>