<?php

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
// sanitize the user input to prevent cross-site scripting attack
function h($string=""){
  return htmlspecialchars($string);
}
// Login to the database using the admin account;
function admin_login($database){
	return mysqli_connect('localhost', 'admin', 'answer22', $database);
}

// Login to the database using the staff account
function staff_login($username, $pswd, $database){
  return mysqli_connect('localhost', $username,  $pswd, $database);
}

function get_c_id($username, $connection){
  $query = "SELECT c_id FROM customer WHERE username ="."'$username'";
  $c_id_result = mysqli_query($connection, $query);
  $c_id = mysqli_fetch_row($c_id_result)[0];
  mysqli_free_result($c_id_result);
  return $c_id;
}

// Find the next availbe primay key number
function find_next_PK($primary_key, $table,$connection){
      $largest_c_id_query = "SELECT max(".$primary_key.") FROM ".$table;
      $c_id_result = mysqli_query($connection, $largest_c_id_query);
      $largest_c_id = mysqli_fetch_row($c_id_result)[0];
      if ($largest_c_id != 0){
        $c_id = $largest_c_id +1;
      } else {
        $c_id = NULL;
      }
      mysqli_free_result($c_id_result);
      return $c_id;
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
  $_SESSION[$username] = [$token, $type, $pswdhash];
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
        $parsed_data['Customer ID'] = h($value);
        break;
      case 'c_fname':
      case 'driver_fname':
        $parsed_data['First Name'] = h($value);
        break;
      case 'c_lname':
      case 'driver_lname':
        $parsed_data['Last Name'] = h($value);
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
        $parsed_data["Street Address"] =h($value);
        break;
      case 'c_city':
        $parsed_data["City"]=h($value);
        break;
      case 'c_state':
        $parsed_data["State"]=h($value);
        break;
      case 'c_zipcode':
        $parsed_data["Zip Code"]=h($value);
        break;
    
      case 'h_start_date':
      case 'a_start_date':
        $parsed_data["Start Date"]=h($value);
        break;
      
      case 'h_end_date':
      case 'a_end_date':
        $parsed_data["End Date"]=h($value);
        break;
      
      case 'h_premium':
      case 'a_premium':
        $parsed_data["Premium"]=h($value);
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
        case 'vehicle_id':
          $parsed_data['Vehicle ID']=h($value);
          break;
        case 'vin':
          $parsed_data['VIN']=h($value);
          break;
        case 'make':
          $parsed_data['Make']=h($value);
          break;
        case 'model':
          $parsed_data['Model']=h($value);
          break;
        case 'year':
          $parsed_data['Year']=h($value);
          break;
        case 'v_status':
          switch ($value){
            case 'L':
              $parsed_data['Vehice Status']='Leased';
              break;
            case 'F':
              $parsed_data['Vehice Status']='Financed';
              break;
            case 'O':
              $parsed_data['Vehice Status']='Owned';
              break;
            default:
              $parsed_data['Vehice Status']='Error 16';
              break;
          }
        break;
        case 'pur_date':
          $parsed_data['Purchase Date']=h($value);
          break;
        case 'pur_value':
          $parsed_data['Purchase Value']=h($value);
          break;
        case 'homearea':
          $parsed_data['Area']=h($value);
          break;
        case 'hometype':
          switch ($value){
            case 'S':
              $parsed_data['Home Type']='Single Family';
              break;
            case 'M':
              $parsed_data['Home Type']='Multi Family';
              break;
            case 'C':
              $parsed_data['Home Type']='Condominium';
              break;
            case 'T':
              $parsed_data['Home Type']='Town House';
              break;
            default:
              $parsed_data['Home Type']='Error 17';
              break;
          }
          break;
        case 'auto_fire':
          switch ($value){
            case '1':
              $parsed_data['auto_fire']='Yes';
              break;
            case '0':
              $parsed_data['auto_fire']='No';
              break;
            default:
              $parsed_data['auto_fire']='Error 20';
              break;
          }
          break;
        case 'sec_sys':
          switch ($value){
            case '1':
              $parsed_data['sec_sys']='Yes';
              break;
            case '0':
              $parsed_data['sec_sys']='No';
              break;
            default:
              $parsed_data['sec_sys']='Error 21';
              break;
          }
          break;
        case 'swim_pool':
          switch ($value){
            case 'U':
              $parsed_data['swim_pool']='Underground';
              break;
            case 'O':
              $parsed_data['swim_pool']='Overground';
              break;
            case 'I':
              $parsed_data['swim_pool']='Indoor';
              break;
            case 'M':
              $parsed_data['swim_pool']='Muitiple';
              break;
            case NULL:
              $parsed_data['swim_pool']='None';
              break;
            default:
              $parsed_data['swim_pool']='Error 18';
              break;
          }
          break;
        case 'basement':
          switch ($value){
            case '1':
              $parsed_data['basement']='Yes';
              break;
            case '0':
              $parsed_data['basement']='No';
              break;
            default:
              $parsed_data['basement']='Error 19';
              break;
          }
          break;
        case 'license_no':
          $parsed_data['License No.']=h($value);
          break;
        case 'driver_bdate':
          $parsed_data['Birthdate']=h($value);
          break;
        case 'a_inv_id':
        case 'h_inv_id':
          $parsed_data['Invoice ID']=h($value);
          break;
        case 'a_inv_date':
        case 'h_inv_date':
          $parsed_data['Invoice Date']=h($value);
          break;
        case 'a_inv_due_date':
        case 'h_inv_due_date':
          $parsed_data['Invoice Due Date']=h($value);
          break;
        case 'a_inv_amount':
        case 'h_inv_amount':
          $parsed_data['Invoice Amoumt']=h($value);
          break;

        case 'a_payment_id':
        case 'h_payment_id':
          $parsed_data['Payment ID']=h($value);
          break;
        case 'a_pay_date':
        case 'h_pay_date':
          $parsed_data['Pay Date']=h($value);
          break;
        case 'a_pay_method':
        case 'h_pay_method':
          $parsed_data['Pay Method']=h($value);
          break;
        case 'a_pay_amount':
        case 'h_pay_amount':
          $parsed_data['Pay Amount']=h($value);
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
    echo ('<th>' . h($item) . '</th>');
  }
  echo('</tr></thead>');
  echo ('<tbody>');
  // Print data
  foreach ($data_list as $data){
    //variable pass to subscription.php
    if (is_array($data) || is_object($data)) {
      foreach ($data as $key => $value){
        if ($key == "Customer ID"){
              $c_id = $value;  
              } 
        if ($key == "Subscriptions" and $value != 'None'){
              print_clickable($value,$c_id);        
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
function print_clickable($value,$c_id){
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
        <input type="hidden" name="c_type" value="'.h($type).'">
        <input type="hidden" name="c_id" value="'.h($c_id).'">
    <button type="submit" class="btn-link">'.h($value).'</button>
</form></td>');
}


function print_auto_form($_post){
  $start_date = h($_post["start_date"]);
  $end_date = h($_post["end_date"]);
  $no_of_vehicles = h($_post["no_of_pro"]);
  $no_of_dri = h($_post["no_of_dri"]);
  echo ('<form action="quote.php" method="POST" class="needs-validation" novalidate>
        <input type="hidden" name="insu_type" value="A">
        <input type="hidden" name="start_date" value="'.$start_date.'">
        <input type = "hidden" name="end_date" value="'.$end_date.'">
        <input type = "hidden" name="no_of_pro" value="'.$no_of_vehicles.'">
        <input type = "hidden" name="no_of_dri" value="'.$no_of_dri.'">');

  echo ('<h2>Vehicles Information</h2>');
  for($i =1; $i<=$no_of_vehicles;$i++){
    echo '
    <h4>Vehicle '.$i.'</h4>
    <!-- Vehicle Identification Number -->
          <div class="form-group">
          <label for="VIN'.$i.'">Vehicle Identification Number:</label>
            <input class="form-control" type="text" id="VIN'.$i.'" name="VIN'.$i.'" placeholder="17 characters Vehicle Identification Number" minlength="17" maxlength="17" required>
            <div class="invalid-feedback">
                Contains only letters and numbers<br>
              Length should be 17 
            </div>
        </div>

        <!-- Make -->
          <div class="form-group">
          <label for="make'.$i.'">Make:</label>
            <input class="form-control"  type="text"  id="make'.$i.'" name="make'.$i.'" placeholder="Toyota" required>
        </div>
        <!-- Model -->
          <div class="form-group">
          <label for="model'.$i.'">Model:</label>
            <input class="form-control" type="text"  id="model'.$i.'" name="model'.$i.'" placeholder="Camry" pattern="^[a-zA-Z0-9]*$" required>
            <div class="invalid-feedback">
                Contains only letters and number
            </div>
        </div>
        <!-- Year -->
        <div class="form-group">
        <label for="year'.$i.'">Year:</label>
          <input class="form-control" type="number"  id="year'.$i.'" name="year'.$i.'" min="1900" max="2099" step="1" placeholder="2019" required>
        </div>
        <!-- status -->
        <div class="form-group">
         <label for="status'.$i.'">Status:</label>
          <select class="form-control" id="status'.$i.'" name="status'.$i.'" required>
            <option value = "L">Leased</option>
        <option value = "F">Financed</option>
        <option value = "O">Owned</option>
          </select>
        </div>';
    }

    echo ('<br><h2>Drivers Information</h2>');
    for ($i = 1; $i <= $no_of_dri;$i++){
      echo ('<h4>Driver '.$i.'</h4>');
      echo('<div class="form-group">
             <label for="license_no'.$i.'">License No.:</label>
            <input class="form-control" type="text" id="license_no'.$i.'" name="license_no'.$i.'" required>
            </div>
            <div class="form-group">
             <label for="d_fname'.$i.'">First Name:</label>
            <input class="form-control" type="text" id="d_fname'.$i.'" name="d_fname'.$i.'" required>
            </div>
            <div class="form-group">
             <label for="d_lname'.$i.'">Last Name:</label>
            <input class="form-control" type="text" id="d_lname'.$i.'" name="d_lname'.$i.'" required>
            </div>
            <div class="form-group">
             <label for="d_bdate'.$i.'">BirthDate:</label>
            <input class="form-control" type="date" id="d_bdate'.$i.'" name="d_bdate'.$i.'" required>
            </div>
            ');
            echo ("<div>Vehicles that this driver will drive</div>");
        for ($j = 1; $j <= $no_of_vehicles;$j++) {
          echo ('<div class="form-check-inline">
                <label class="form-check-label" for="d'.$i.'v'.$j.'">
                <input type="checkbox" class="form-check-input" id="d'.$i.'v'.$j.'" name="d'.$i.'v'.$j.'" value="true">Vehicle '.$j.'
                </label>
                </div>');
        }
        echo ('<br><br>');
      }
    echo'<div class="text-center">
          <button type="submit" class="btn btn-primary">Submit</button>
        </div></form>';
}


function print_home_form($_post){
  $start_date = h($_post["start_date"]);
  $end_date = h($_post["end_date"]);
  $no_of_houses = h($_post["no_of_pro"]);
  echo ('<form action="quote.php" method="POST" class="needs-validation" novalidate>
        <input type="hidden" name="insu_type" value="H">
        <input type="hidden" name="start_date" value="'.$start_date.'">
        <input type = "hidden" name="end_date" value="'.$end_date.'">
        <input type = "hidden" name="no_of_pro" value="'.$no_of_houses.'">');

  for($i =1; $i<=$no_of_houses;$i++){
    echo '
    <h3>Home '.$i.'</h3>

    <!-- Purchase Date -->
          <div class="form-group">
          <label for="pur_date'.$i.'">Purchase Date:</label>
            <input class="form-control" type="date" id="pur_date'.$i.'" name="pur_date'.$i.'" value="2019-01-01" required>
            <div class="invalid-feedback">
                Purchase date is required<br>
              Length should 17 
            </div>
        </div>

        <!-- Purchase Value -->
          <div class="form-group">
          <label for="pur_value'.$i.'">Purchase Value ($):</label>
            <input class="form-control"  type="number"  id="pur_value'.$i.'" name="pur_value'.$i.'" required>
        </div>

        <!-- Home Area -->
          <div class="form-group">
          <label for="area'.$i.'">Home Area (Sq.Ft.):</label>
            <input class="form-control" type="number"  id="area'.$i.'" name="area'.$i.'" required>
            <div class="invalid-feedback">
                Contains only letters
            </div>
        </div>

        <!-- Home Type -->
        <div class="form-group">
         <label for="h_type'.$i.'">Home Type:</label>
          <select class="form-control" id="h_type'.$i.'" name="h_type'.$i.'">
            <option value = "S">Single Family</option>
        <option value = "M">Multi Family</option>
        <option value = "C">Condominium</option>
        <option value = "T">Town House</option>
          </select>
        </div>

        <!-- Swimming Pool -->
        <div class="form-group">
         <label for="pool'.$i.'">Swimming Pool:</label>
          <select class="form-control" id="pool'.$i.'" name="pool'.$i.'">
            <option value = "">None</option>
            <option value = "U">Underground</option>
            <option value = "O">Overground</option>
            <option value = "I">Indoor</option>
            <option value = "M">Multiple</option>
          </select>
        </div>

        <!-- Auto fire notification -->
        <div class="form-group">
          <label class="form-check-label" for="fire'.$i.'">Auto Fire Notification:</label>
          <select class="form-control" id="fire'.$i.'" name="fire'.$i.'">
            <option value = "0">No</option>
            <option value = "1">Yes</option>
          </select>
          </div>
        <!-- Basement -->
        <div class="form-group">
          <label class="form-check-label" for="basement'.$i.'">Basement:</label>
          <select class="form-control" id="basement'.$i.'" name="basement'.$i.'">
            <option value = "0">No</option>
            <option value = "1">Yes</option>
          </select>
          </div>

        <!-- Home Security System -->
        <div class="form-group">
          <label class="form-check-label" for="sec_sys'.$i.'">Home Security System</label>
          <select class="form-control" id="sec_sys'.$i.'" name="sec_sys'.$i.'">
            <option value = "0">No</option>
            <option value = "1">Yes</option>
          </select>
          </div>
';
    }
    echo'<div class="text-center">
          <button type="submit" class="btn btn-primary">Submit</button>
        </div></form>';
}

function check_customer_type($c_id, $connection){
  $query = "SELECT c_type FROM customer WHERE c_id = $c_id";
  $result = mysqli_query($connection, $query);
  $c_type = mysqli_fetch_row($result)[0];
  mysqli_free_result($result);
  return $c_type;
}
function insert_auto_insurance($_post, $c_id, $preimum, $connection){
  $start_date = h($_post["start_date"]);
  $end_date = h($_post["end_date"]);
  $no_of_vehicles = h($_post["no_of_pro"]);

  $c_type = check_customer_type($c_id, $connection);
  if ($c_type == NULL){
    $update_type = "UPDATE customer SET c_type='A' WHERE c_id = $c_id";
  }else if ($c_type == 'H'){
    $update_type = "UPDATE customer SET c_type='AH' WHERE c_id = $c_id";
  } else {
    //exit("You already purchased auto insurance");
  }
  mysqli_query($connection, $update_type);

  $insert_insurance = "INSERT INTO auto_insurance (c_id, a_start_date, a_end_date, a_premium, a_status) VALUES (".$c_id.",'$start_date', '$end_date', $preimum, 'C')";
  $result = mysqli_query($connection, $insert_insurance) or exit("error 13");
}

function insert_home_insurance($_post, $c_id, $preimum, $connection){
  $start_date = h($_post["start_date"]);
  $end_date = h($_post["end_date"]);
  $no_of_vehicles = h($_post["no_of_pro"]);

  $c_type = check_customer_type($c_id, $connection);
  if ($c_type == NULL){
    $update_type = "UPDATE customer SET c_type='H' WHERE c_id = $c_id";
  }else if ($c_type == 'A'){
    $update_type = "UPDATE customer SET c_type='AH' WHERE c_id = $c_id";
  } else {
    exit("You already purchased home insurance");
  }
  mysqli_query($connection, $update_type);

  $insert_insurance = "INSERT INTO home_insurance (c_id, h_start_date, h_end_date, h_premium, h_status) VALUES (".$c_id.",'$start_date', '$end_date', $preimum, 'C')";
  $result = mysqli_query($connection, $insert_insurance) or exit("error 8");
}

function insert_vehicles_n_drivers($_post, $c_id, $connection){
  $no_of_vehicles = h($_post["no_of_pro"]);
  $no_of_dri = h($_post["no_of_dri"]);
  $vehicle_ids = [];
  $driver_ids = [];
  // Insert Vehicles
  for($i =1; $i<=$no_of_vehicles; $i ++){

    $VIN = h($_post["VIN".$i]);
    $make = h($_post["make".$i]);
    $model = h($_post["model".$i]);
    $year = h($_post["year".$i]);
    $status = h($_post["status".$i]);
    $vehicle_ids[$i] = find_next_PK('vehicle_id', 'vehicle',$connection) or $vehicle_ids[$i] = 1000000000;
    $insert_vehicle = "INSERT INTO vehicle (c_id, vehicle_id, vin, make, model, year, v_status) VALUES ($c_id,$vehicle_ids[$i], '$VIN', '$make', '$model', '$year', '$status')";
    mysqli_query($connection, $insert_vehicle);
  }
  // Insert Drivers
  for($i =1; $i<=$no_of_dri; $i ++){
    $license_no = h($_post["license_no".$i]);
    $d_fname = h($_post["d_fname".$i]);
    $d_lname = h($_post["d_lname".$i]);
    $d_bdate = h($_post["d_bdate".$i]);
    $driver_ids[$i] = find_next_PK('driver_id', 'driver',$connection) or $driver_ids[$i] = 1000000000;
    $insert_driver = "INSERT INTO driver(driver_id,license_no,driver_fname,driver_lname,driver_bdate) VALUES ($driver_ids[$i], '$license_no', '$d_fname', '$d_lname','$d_bdate')";
    mysqli_query($connection, $insert_driver);
  }
  for($i =1; $i<=$no_of_dri; $i++){
    for($j =1; $j<=$no_of_vehicles; $j++){
      if(isset($_post['d'.$i.'v'.$j]) and $_post['d'.$i.'v'.$j]=='true'){
        $insert_v_d = 'INSERT INTO vehicle_driver(driver_id,vehicle_id) VALUES ('.$driver_ids[$i].','.$vehicle_ids[$j].')';
        mysqli_query($connection, $insert_v_d);
      }
    }
  }


}

function insert_homes($_post, $c_id, $connection){
  $no_of_houses = h($_post["no_of_pro"]);
  
  for($i =1; $i<=$no_of_houses; $i ++){

    $pur_date = h($_post["pur_date".$i]);
    $pur_value = h($_post["pur_value".$i]);
    $area = h($_post["area".$i]);
    $h_type = h($_post["h_type".$i]);
    $fire = h($_post["fire".$i]);
    $sec_sys = h($_post["sec_sys".$i]);
    $pool = h($_post["pool".$i]);
    $basement = h($_post["basement".$i]);
    $home_id = find_next_PK('home_id', 'home',$connection) or $home_id = 1000000;
    $insert_home = "INSERT INTO home (c_id, home_id, pur_date, pur_value, homearea, hometype, auto_fire,sec_sys,swim_pool,basement) VALUES ($c_id,$home_id, '$pur_date', $pur_value, $area, '$h_type', $fire,$sec_sys, '$pool', $basement)";
    mysqli_query($connection, $insert_home) or exit("Error 10"); 
  }

}
function insert_auto_invoice($_post, $c_id, $connection, $preimum){
  $a_inv_id = find_next_PK('a_inv_id', 'a_invoice',$connection) or $a_inv_id = 1000000;
  $start_date = h($_post["start_date"]);
  $insert_invoice= "INSERT INTO a_invoice(c_id,a_inv_id,a_inv_date,a_inv_due_date,a_inv_amount) VALUES ($c_id,$a_inv_id, '$start_date',ADDDATE('$start_date', INTERVAL 6 month),$preimum)" ;
  mysqli_query($connection, $insert_invoice) or exit("Error 11");
}

function insert_home_invoice($_post, $c_id, $connection, $preimum){
  $h_inv_id = find_next_PK('h_inv_id', 'h_invoice',$connection) or $h_inv_id = 1000000;
  $start_date = h($_post["start_date"]);
  $insert_invoice= "INSERT INTO h_invoice(c_id,h_inv_id,h_inv_date,h_inv_due_date,h_inv_amount) VALUES ($c_id,$h_inv_id, '$start_date',ADDDATE('$start_date', INTERVAL 6 month),$preimum)" ;
  mysqli_query($connection, $insert_invoice) or exit("Error 12");
}

//return the html button that direct to assets.php with asset query
function print_assets($c_id, $type){
  switch ($type){
    case 'H':
      $assets = "Houses";
      break;
    case 'A':
      $assets = "Vehicles";
      break;
    default:
      $assets = 'Error 14';
      break;
    }
    
    $value= '<form action="assets.php" method="post">
      <input type="hidden" name="c_type" value="'.h($type).'">
      <input type="hidden" name="c_id" value="'.h($c_id).'">
  <button type="submit" class="btn-link">'.h($assets).'</button>
</form> ';
    return $value;
}

//return the html button that direct to invoice.php with invoice query
function print_invoice($c_id,$type){
  $value= '<form action="invoice.php" method="post">
          <input type="hidden" name="c_type" value="'.h($type).'">
          <input type="hidden" name="c_id" value="'.h($c_id).'">
      <button type="submit" class="btn-link">Invoice</button>
    </form> ';
  return $value;
}

function driver_button($vehicle_id){
  $value= '<form action="drivers.php" method="post">
      <input type="hidden" name="v_id" value="'.h($vehicle_id).'">
  <button type="submit" class="btn-link">Driver(s)</button>
</form> ';
  return array("Drivers" => $value);
}

function payment_button($c_id, $c_type){
  $value= '<form action="payment.php" method="post">
      <input type="hidden" name="c_id" value="'.h($c_id).'">
      <input type="hidden" name="c_type" value="'.h($c_type).'">
  <button type="submit" class="btn-link">Payment(s)</button>
</form> ';
  return array("Payment" => $value);
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