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

function admin_login($database){
	return mysqli_connect('localhost', 'admin', 'answer22', $database);
}

//take username and password hash to generate token
//then store username and token in set cookies
//returns token
//cookies expires in one hour
function set_cookies($username, $pswdhash) {
  setcookie('username', $username, time() + 3600);
  $token = password_hash($pswdhash, PASSWORD_DEFAULT);
  setcookie('token',$token, time() + 3600);
  $_SESSION[$username] = $token;
}

//return true if cookie is set and token matches
function check_cookie(){
  if (isset($_COOKIE['username']) and isset($_COOKIE['token']) and isset($_SESSION[$_COOKIE['username']])){

        if ($_COOKIE["token"] == $_SESSION[$_COOKIE['username']]) {
          return true;
        }
  }
  return false;
}

function unset_cookies(){
  setcookie('username', $username, time() -3600);
  setcookie('token',$token, time() - 3600);
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