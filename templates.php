<?php
class ErrorDialog{
  public static function getHtml($message){
    $html = "<div class = 'alert'>
  		<span class = 'closeButton' onclick = 'this.parentElement.style.display = \"none\";'>&times;</span>
  		<i><strong>{$message}</strong></i>
  	  </div>";
	  return $html;
  }
}


class LoginForm{
  public static function getHtml($action, $method){
    $html = "<div class='loginForm'>
			<span class='loginHeader'>
				<button class='link' onclick='toggleLoginForm()'><b>Login</b></button> or
				<button class='link' onclick='toggleSubmitForm()'><b>Sign up</b></button>
        </span>
			<form id = 'loginForm' class='hidden' action = '{$action}' method = '{$method}'>
				<label for='email'>E-mail</label>
				<input type = 'email' name = 'login'/>
				<label for = 'password'>Password</label>
				<input type = 'password' name = 'password'/>
				<button type='submit'>Log in</button>
			</form>
		</div>";
		return $html;
  }
}

class PageHeader{
  public static function getHtml($title){
    $loginform = LoginForm::getHtml('index.php', 'Post');
    $html = "<div class='header'>
              <h2 class='title'>{$title}</h2>
              {$loginform}
              </div>";
		return $html;
  }
}
 ?>
