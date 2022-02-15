var file_name = "avaliable";

function select_rent_client(client, car) {
  $("#content").load(`pages/${file_name}.php`,  {
    selected_rent_client: client
  }, function() {
    $(`#car_rent_${car}`).show();
  });
}

function view_car(car) {
  $(`#car_information_${car}`).toggle();
}

function view_rent_car(car) {
  $(`#car_rent_${car}`).toggle();
}

function delete_service(service, car) {
  $.ajax({
    url: "pages/run_query.inc.php",
    method: "POST",
    data: {
      command: `DELETE FROM services WHERE id=${service} `
    },
    success: function(data) {
      $("#content").load(`pages/${file_name}.php`);
      $(`#car_information_${car}`).show();
    }
  });
}

function add_service(car) {
  let service_name = $(`#car_information_${car} tr.add_service_tr input[name="service_name"]`)[0].value;
  let service_quantity = $(`#car_information_${car} tr.add_service_tr input[name="service_quantity"]`)[0].value;
  let service_price = $(`#car_information_${car} tr.add_service_tr input[name="service_price"]`)[0].value;
  let service_paid = $(`#car_information_${car} tr.add_service_tr input[name="service_paid"]`)[0].value;
  let service_date = $(`#car_information_${car} tr.add_service_tr input[name="service_date"]`)[0].value;
  $.ajax({
    url: "pages/run_query.inc.php",
    method: "POST",
    data: {
      command: `INSERT INTO services (service_name, quantity, price, paid, date, car_id) VALUES ('${service_name}', ${service_quantity}, ${service_price}, ${service_paid}, '${service_date}', ${car}) `
    },
    success: function(data) {
      $("#content").load(`pages/${file_name}.php`, function() {
        $(`#car_information_${car}`).show();
      });
    }
  });
}

function edit_service_paid(value, service, car) {
  // console.log(value);
  $.ajax({
    url: "pages/run_query.inc.php",
    method: "POST",
    data: {
      command: `UPDATE services SET paid=${value} WHERE id=${service} `
    },
    success: function(data) {
      $("#content").load(`pages/${file_name}.php`, function() {
        $(`#car_information_${car}`).show();
      });
    }
  });
}

function edit_service_month(value, car) {
  $("#content").load(`pages/${file_name}.php`, {
    service_month: value
  }, function() {
    $(`#car_information_${car}`).show();
  });
}

function select_rent_client_final(car, client) {
  // alert("dasdas");
  var current_client_id = client;
  let value = $(`#car_rent_${car} > table.add_client > tbody > tr:nth-child(2) > th:nth-child(1) > select`).find(":selected").text();
  $(`#car_rent_${car} > table.add_client`).hide();
  $(`#car_rent_${car} > table.add_rent > tbody > tr:nth-child(2) > th:nth-child(3) > input[type=text]`).val(value);
}

function add_rent(car, client) {
  let rent_date_take = $(`#car_rent_${car} > table.add_rent > tbody > tr:nth-child(2) > th > input[name="rent_date_take"]`)[0].value;
  let rent_date_return = $(`#car_rent_${car} > table.add_rent > tbody > tr:nth-child(2) > th > input[name="rent_date_return"]`)[0].value;
  let rent_price = $(`#car_rent_${car} > table.add_rent > tbody > tr:nth-child(2) > th > input[name="rent_price"]`)[0].value;
  let rent_days = $(`#car_rent_${car} > table.add_rent > tbody > tr:nth-child(2) > th > input[name="rent_days"]`)[0].value;
  let client_id = client;
  let car_id = car;
  $.ajax({
    url: "pages/run_query.inc.php",
    method: "POST",
    data: {
      command: `INSERT INTO rent (take_date, return_date, price, days, client, car, finished) VALUES ('${rent_date_take}', '${rent_date_return}', ${rent_price}, ${rent_days}, ${client_id}, ${car_id}, 0) `
    },
    success: function(data) {
      $.ajax({
        url: "pages/run_query.inc.php",
        method: "POST",
        data: {
          command: `UPDATE cars SET availability=0 WHERE id=${car} `
        },
        success:function(data) {
          $("#content").load(`pages/${file_name}.php`);
        }
      });
    }
  });
}

$("nav > ul > li").click(function() {
  let anchor_tag = $(this).find('a')[0];
  $("nav > ul > li > a").removeClass("active");
  $(anchor_tag).addClass("active");
  file_name = `${$(anchor_tag).data("value")}`;
  
  $("#content").load(`pages/${file_name}.php`);
})

function finish_rent(car) {
  $.ajax({
    url: "pages/run_query.inc.php",
    method: "POST",
    data: {
      command: `UPDATE rent SET finished=1 WHERE car=${car};`
    }
  });
  $.ajax({
    url: "pages/run_query.inc.php",
    method: "POST",
    data: {
      command: `UPDATE cars SET availability=1 WHERE id=${car}; `
    },
    success: function() {
      $("#content").load(`pages/avaliable.php`);
      $("nav > ul > li > a").removeClass("active");
      $("nav > ul > li:first-child > a").addClass("active");
    }
  });
}

function add_client() {
  let client_name = $(`#clients > table > tbody > tr:last-child > th > input[name="add_client_name"]`).val();
  let client_l_name = $(`#clients > table > tbody > tr:last-child > th > input[name="add_client_l_name"]`).val();
  let client_birth_date = $(`#clients > table > tbody > tr:last-child > th > input[name="add_client_birth_date"]`).val();
  let client_identification_id = $(`#clients > table > tbody > tr:last-child > th > input[name="add_client_identification_id"]`).val();
  $.ajax({
    url: "pages/run_query.inc.php",
    method: "POST",
    data: {
      command: `INSERT INTO clients (name, l_name, birth_date, identification_id) VALUES ('${client_name}', '${client_l_name}', '${client_birth_date}', '${client_identification_id}') `
    },
    success: function() {
      $("#content").load(`pages/clients.php`);
      $("nav > ul > li > a").removeClass("active");
      $("nav > ul > li:nth-child(3) > a").addClass("active");
    }
  });
}

function add_car() {
  let car_name = $(`#admin > table > tbody > tr:last-child > th > input[name="add_car_name"]`).val();
  let car_chassie_number = $(`#admin > table > tbody > tr:last-child > th > input[name="add_car_chassie_number"]`).val();
  let car_kilometers_passed = $(`#admin > table > tbody > tr:last-child > th > input[name="add_car_kilometers_passed"]`).val();
  let car_registration = $(`#admin > table > tbody > tr:last-child > th > input[name="add_car_registration"]`).val();
  let car_registration_date = $(`#admin > table > tbody > tr:last-child > th > input[name="add_car_registration_date"]`).val();
  let car_registration_due_date = $(`#admin > table > tbody > tr:last-child > th > input[name="add_car_registration_due_date"]`).val();
  
  $.ajax({
    url: "pages/run_query.inc.php",
    method: "POST",
    data: {
      command: `INSERT INTO cars (name, chassie_number, kilometers_passed, registration, registration_date, registration_due_date, availability, image_name) VALUES ('${car_name}', '${car_chassie_number}', '${car_kilometers_passed}', '${car_registration}', '${car_registration_date}', '${car_registration_due_date}', 1, '') `
    },
    success: function() {
      $("#content").load(`pages/admin.php`);
      $("nav > ul > li > a").removeClass("active");
      $("nav > ul > li:nth-child(4) > a").addClass("active");
    }
  });
}