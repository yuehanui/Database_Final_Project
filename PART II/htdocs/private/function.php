<?php

function h($string="") {
	return htmlspecialchars($string);
}
function request_is_post() {
	return $_SERVER['REQUEST_METHOD'] == 'POST';
}
function redirect_to($location){
	header("Location: " . $location);
	exit;
}
function redirect_in_time($location, $second){
  header( "Refresh:" . $second . "; url=" . $location, true, 303);
}

// Login to the database using the admin account;
function admin_login($database){
	return mysqli_connect('localhost', 'admin', 'answer22', $database);
}

// Login to the database using the staff account
function staff_login($username, $pswd, $database){
  return mysqli_connect('localhost', $username,  $pswd, $database);
}

//take username and password hash to generate token
//then store username and token in set cookies
//returns token
//cookies expires in one hour
function set_cookies($username, $pswdhash, $type) {
  setcookie('username', $username, time() + 3600);
  $token = password_hash($pswdhash, PASSWORD_DEFAULT);
  setcookie('token',$token, time() + 3600);
  setcookie('type',$type, time() + 3600);
  $_SESSION[$username] = [$token, $type];
}

//return true if cookie is set and token matches
//if cookie exist but token doesn't match(could be a potential attack),unset_cookies();
function check_cookie(){
  if (isset($_COOKIE['username']) and isset($_COOKIE['token']) and isset($_SESSION[$_COOKIE['username']])){

        if ($_COOKIE["token"] == $_SESSION[$_COOKIE['username']][0]) {
          return true;
        } else {
          unset_cookies();
        }
  }
  return false;
}

function unset_cookies(){
  setcookie('username', '', time() -3600);
  setcookie('token','', time() - 3600);
}

function unset_cookies_n_session(){
  unset($_SESSION[$_COOKIE['username']]) ;
  setcookie('username', '', time() -3600);
  setcookie('token','', time() - 3600);
}

//convert items in an array to a single string.
function select_list_to_str($select_list){
  $select_str = "";
  foreach ($select_list as $item){
    $select_str .=  $item . ", ";
  }
  return substr($select_str, 0, -2);
}

// Convert string to items array
function select_str_to_list($select_list_str){
  $select_list1 = explode(",", $select_list_str);
  $select_list2 = [];
  foreach ($select_list1 as $item){
    $new_item = str_replace(' ', '',$item);
    array_push($select_list2,$new_item);
  }
  return $select_list2;

}


// Convert data from abbreviation to readable information

function parse_data($data){
    $parsed_data = [];
  foreach ($data as $key => $value){
    switch ($key){
      case 'c_id':
        $parsed_data['Customer ID'] = $value;
        break;
      case 'c_fname':
        $parsed_data['First Name'] = $value;
        break;
      case 'c_lname':
        $parsed_data['Last Name'] = $value;
        break;
      case 'gender':
        switch ($value){
          case 'M':
            $parsed_data['Gender'] = 'Male';
            break;
          case 'F':
            $parsed_data['Gender'] = 'Female';
            break;
          case 'N':
            $parsed_data['Gender']='Didn\'t reveal';
            break;
          default:
            $parsed_data['Gender']='Data Error 01';
            break;
        }
      break;
      case 'martial_sta':
        switch ($value){
          case 'M':
            $parsed_data['Martial Status']='Married';
            break;
          case 'S':
            $parsed_data['Martial Status']='Single';
            break;
          case 'W':
            $parsed_data['Martial Status']='Widow/Widower';
            break;
          default:
            $parsed_data['Martial Status']='Data Error 03';
            break;
        }
        break;
      case 'c_type':
        switch ($value){
          case 'A':
            $parsed_data['Subscriptions']='Auto';
            break;
          case 'H':
            $parsed_data['Subscriptions']='Home';
            break;
          case 'AH':
            $parsed_data['Subscriptions']='Auto & Home';
            break;
          default:
            $parsed_data['Subscriptions']='None';
            break;
        }
        break;
      case 'c_street_ad':
        $parsed_data["Street Address"] =$value;
        break;
      case 'c_city':
        $parsed_data["City"]=$value;
        break;
      case 'c_state':
        $parsed_data["State"]=$value;
        break;
      case 'c_zipcode':
        $parsed_data["Zip Code"]=$value;
        break;
    
      case 'h_start_date':
      case 'a_start_date':
        $parsed_data["Start Date"]=$value;
        break;
      
      case 'h_end_date':
      case 'a_end_date':
        $parsed_data["End Date"]=$value;
        break;
      
      case 'h_premium':
      case 'a_premium':
        $parsed_data["Premium"]=$value;
        break;
      case 'h_status':
      case 'a_status':
        switch ($value){
          case 'C':
            $parsed_data['Status']='Current';
            break;
          case 'P':
            $parsed_data['Status']='Expired';
            break;
          default:
            $parsed_data['Status']='Data Error 04';
            break;
        }
        break;
      }
    }
    return $parsed_data;
}
function select_list_to_print($select_list){
  $print_list = [];
  foreach ($select_list as $item){
    switch ($item){
      case 'c_id':
        array_push($print_list, "Customer ID");
        break;
      case 'c_fname':
      array_push($print_list, "First Name");
        break;
      case 'c_lname':
        array_push($print_list, "Last Name");
        break;
      case 'gender':
        array_push($print_list, "Gender");
        break;
      case 'martial_sta':
        array_push($print_list, "Martial Status");
        break;
      case 'c_type':
        array_push($print_list, "Subcriptions");
        break;
      case 'c_street_ad':
        array_push($print_list, "Street Address");
        break;
      case 'c_city':
        array_push($print_list, "City");
        break;
      case 'c_state':
        array_push($print_list, "State");
        break;
      case 'c_zipcode':
        array_push($print_list, "Zip Code");
        break;
      case 'h_start_date':
      case 'a_start_date':
        array_push($print_list, "Start Date");
        break;
      case 'h_end_date':
      case 'a_end_date':
        array_push($print_list, "End Date");
        break;
      case 'h_premium':
      case 'a_premium':
        array_push($print_list, "Premium");
        break;
      case 'h_status':
      case 'a_status':
        array_push($print_list, "Status");
        break;

    }
  }
  return $print_list;
}

function print_table($head_list, $data_list){
 

  // Print head
  echo ('<div><table class="table table-striped"><thead><tr>');
  foreach ($head_list as $item){
    echo ('<th>' . $item . '</th>');
  }
  echo('</tr></thead>');
  echo ('<tbody>');
  // Print data
  foreach ($data_list as $data){
    //variable pass to subscription.php
    if (is_array($data) || is_object($data)) {
      foreach ($data as $key => $value){
        if ($key == "Subscriptions" and $value != 'None'){
              print_clickable($value);        
        } else {
          echo ('<td>' . $value . '</td>');
        }
      }
    }
    echo ('</tr>');
  }
  echo ('</tbody></table></div>');
}
// print a clickable output
// $type  S for Suscription
function print_clickable($value){
  switch ($value){
    case 'Home':
      $type = "H";
      break;
    case 'Auto':
      $type = "A";
      break;
    case "Auto & Home":
      $type = 'AH';
      break;
    default:
      $type = 'Error';
      break;
    }
      echo ('<td><form action="subscriptions.php" method="post">
        <input type="hidden" name="c_type" value="'.$type.'">
    <button type="submit" class="btn-link">'.$value.'</button>
</form></td>');

}



?>


<script>
// Disable form submissions if there are invalid fields
(function() {
  'use strict';
  window.addEventListener('load', function() {
    // Get the forms we want to add validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
})();
</script>