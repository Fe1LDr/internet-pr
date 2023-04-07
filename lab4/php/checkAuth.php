<?php
  $login = $_POST['login'];
  $password = $_POST['password'];
  $isAuthorized = false;
  $Fail = 0;
  $i = 0;

  if (file_exists('usersDb.txt'))
  {
    $users = file('usersDb.txt', FILE_IGNORE_NEW_LINES);

    for ($i = 0; $i < count($users); $i += 2)
    {
      if ($users[$i] == $login && $users[$i+1] == $password)
      {
        $isAuthorized = true;
        break;
      }
    }

    $body = [
        "authorized" => $isAuthorized
    ];

    setcookie('login', $login, 0, '/');
    setcookie('password', $password, 0, '/');
    ob_start();

    echo json_encode($body);

    $log = date('Y-m-d H:i:s') . PHP_EOL . ob_get_clean() . PHP_EOL;
    file_put_contents(__DIR__ . '/log.txt', $log, FILE_APPEND);

    echo json_encode($body);
  }
  else
  {
    $body = [
        "authorized" => $isAuthorized
    ];

    ob_start();

    echo json_encode($body);

    $log = date('Y-m-d H:i:s') . PHP_EOL . ob_get_clean() . PHP_EOL;
    file_put_contents(__DIR__ . '/log.txt', $log, FILE_APPEND);

    echo json_encode($body);
  }
?>