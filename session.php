<?php
class Session{

  function __construct(){
    session_start();
  }

  function saveUserData($user){
    $_SESSION['user'] = $user;
  }

	function logout(){
		unset($_SESSION['user']);
		session_destroy();
	}

  function getUserData(){
    return $_SESSION['user'];
  }

  static function is_session_started()
  {
    return isset($_SESSION['user']);
  }
}

 ?>
