<?php
  include 'conn.php';

  $command = mysqli_real_escape_string($conn, $_POST['command']);
  $full_command = str_replace("\\", '', $command);
  $result = mysqli_query($conn, $full_command);
  
  $data = [];
  
  while ($material = mysqli_fetch_assoc($result)) {
    array_push($data, $material);
  }

  // echo "<pre>";
  //   print_r($query);
  // echo "</pre>";
  // while ($entry = mysqli_fetch_assoc($query)) {
  // //   // array_push($data, $entry);
  // } 
  echo json_encode($data);
