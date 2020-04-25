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
function check_cookie(){
  if (isset($_COOKIE['username']) and isset($_COOKIE['token']) and isset($_SESSION[$_COOKIE['username']])){

        if ($_COOKIE["token"] == $_SESSION[$_COOKIE['username']][0]) {
          return true;
        }
  }
  return false;
}

function unset_cookies(){
  unset($_SESSION[$_COOKIE['username']]) ;
  setcookie('username', '', time() -3600);
  setcookie('token','', time() - 3600);

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