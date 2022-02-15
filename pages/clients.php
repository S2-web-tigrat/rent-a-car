<?php include 'conn.php'; ?>
<div id="clients">
  <h1 style="color: white;text-align:center;">Klientët</h1>
  <table>
    <tr>
      <th>Emri</th>
      <th>Mbiemri</th>
      <th>Datlindja</th>
      <th>Leternjoftimi</th>
      <th>Historiku</th>
      <th>Vepro</th>
    </tr>
    <?php 
      $clients_sql = "SELECT * FROM clients; ";
      $clients_result = mysqli_query($conn, $clients_sql);
      if (mysqli_num_rows($clients_result) > 0) {
        while ($client = mysqli_fetch_assoc($clients_result)) {
          echo "<tr>";
            echo "<th>".$client['name']."</th>";
            echo "<th>".$client['l_name']."</th>";
            echo "<th>".$client['birth_date']."</th>";
            echo "<th>".$client['identification_id']."</th>";
            echo "<th>".mysqli_num_rows(mysqli_query($conn, "SELECT * FROM rent WHERE client=".$client['id']))." Vetura</th>";
            echo "<th></th>";
          echo "</tr>";
        }
      }
    ?>
    <tr>
      <th>
        <input name="add_client_name" type="text"   style="padding: 5px;width: 100%;box-sizing: border-box;" />
      </th>
      <th>
        <input name="add_client_l_name" type="text" style="padding: 5px;width: 100%;box-sizing: border-box;" />
      </th>
      <th>
        <input name="add_client_birth_date" type="date" style="padding: 5px;width: 100%;box-sizing: border-box" />
      </th>
      <th>
        <input name="add_client_identification_id" type="text" style="padding: 5px;width: 65%;box-sizing: border-box;" /> 
      </th>
      <th></th>
      <th>
        <button class="add_client_button" onclick="add_client()"><i class="fa fa-user-plus"></i></buton>
      </th>
    </tr>
  </table>
</div> <!-- #clients -->