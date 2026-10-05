<?php
  include_once('includes/load.php');

  $req_fields = array('username', 'password');
  validate_fields($req_fields);

  $username = remove_junk($_POST['username']);
  $password = remove_junk($_POST['password']);

  if(empty($errors)){

    $user = authenticate_v2($username, $password);

    if($user){

      // Create login session
      $session->login($user['id']);

      // Update last login time
      updateLastLogIn($user['id']);

      // Redirect all users to the new dashboard
      $session->msg(
        "s",
        "Hello ".$user['username'].", Welcome to OSWA-INV."
      );

      redirect('home.php', false);

    }else{

      $session->msg(
        "d",
        "Sorry Username/Password incorrect."
      );

      redirect('index.php', false);
    }

  }else{

    $session->msg("d", $errors);
    redirect('index.php', false);
  }
?>