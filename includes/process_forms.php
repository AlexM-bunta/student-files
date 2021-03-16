<?php

  function validate_username($username){
    if (strlen($username) > 30){
      return false;
    }

    return true;
  }

  function validate_password($password){
    if (strlen($password) > 50){
      return false;
    }

    return true;
  }

  function validate_email($email){
    if (strlen($email) > 30 || !strpos($email, '@') || !strpos($email, '.com')){
      return false;
    }

    return true;
  }

  function validate_title($title){
    if (strlen($title) > 50){
      return false;
    }

    return true;
  }

  function validate_create_post($arr){
    // Errors as strings
    $errors = array();

    foreach($arr as $prop => $key){

      // Check if key does not exist
      if (!$key){
        array_push($errors, $prop . ' field is empty');
      }
      else {
        $result = true;

        // Validating key
        switch($prop){

            case 'title':
              $result = validate_title($key);
              break;

            // case 'body':
            //   $result = validate_body($key);
            //   break;
        }

        if (!$result){
          array_push($errors, $prop . ' field could not be validated');
        }
      }

    }

    return $errors;
  }

  function validating_login($arr){
    // Errors as strings
    $errors = array();

    foreach($arr as $prop => $key){

      // Check if key does not exist
      if (!$key){
        array_push($errors, $prop . ' field is empty');
      }
      else {
        $result = true;

        // Validating key
        switch($prop){

            case 'username':
              $result = validate_username($key);
              break;

            case 'password':
              $result = validate_password($key);
              break;
        }

        if (!$result){
          array_push($errors, $prop);
        }
      }

    }

    return $errors;
  }


  function validating_signup($arr){
    // Errors as strings
    $errors = array();

    // If passwords do not match
    if ($arr['password'] !== $arr['repassword']){
      array_push($errors, 'Passwords do not match');
    }

    foreach($arr as $prop => $key){

      // Check if the key does not exist
      if (!$key){
        array_push($errors, $prop . ' field is empty');
      }
      else {
        $result = true;

        // Validating key
        switch ($prop){

          case 'username':
            $result = validate_username($key);
            break;

          case 'password':
            $result = validate_password($key);
            break;

          case 'email':
            $result = validate_email($key);
            break;
        }

        if (!$result){
          array_push($errors, $prop . ' field could not be validated');
        }
      }
    }

    return $errors;
  }
