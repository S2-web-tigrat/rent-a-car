<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Rent A Car</title>
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
  <link rel="stylesheet" href="style.css" />
</head>
<body>
  <nav>
    <h1>
      <i class="fas fa-car"></i>
      Rent A Car
      <i class="fas fa-car"></i>
    </h1>
    <ul>
      <li><a style="cursor: pointer;" data-value="avaliable" class="active">Veturat</a></li>
      <li><a style="cursor: pointer;" data-value="unavaliable">Rezervimet</a></li>
      <li><a style="cursor: pointer;" data-value="clients">Klientët</a></li>
      <li><a style="cursor: pointer;" data-value="admin">Admin</a></li>
    </ul>
  </nav>
  <div id="content">
    <?php include 'pages/avaliable.php'; ?>
  </div>
  <script src="jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script src="script.js"></script>
</body>
</html>