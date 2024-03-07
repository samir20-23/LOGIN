<?php
$login=$loginFailed= $fill="";
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  if (!empty($_POST["email"]) && !empty($_POST["password"])) {

    if (filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {

      $email = $_POST["email"];
      $password = $_POST["password"];

      try {
        $connect = new PDO("mysql:host=localhost;dbname=myproject", "SAMIR", "samir123");
        $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $statement = $connect->query("SELECT email, password FROM log_up");
        $select = $statement->fetchAll(PDO::FETCH_COLUMN);

        foreach ($select as $k) {
          if ($email == $k) {
            $login= "login successfull";
          }
        }
      } catch (Exception $e) {
        $loginFailed="login failed!" . $e->getMessage();
      }
    } else {
      $fill="please enter a valid email";
    }
  } else {
    echo "don't leave empty inputs";
  }
}
