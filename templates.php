<?php
include_once "database.php";
use firebird\schema as db;
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
  public static function clean($post){
    if(!isset($post['login']))
      return '';
    $login = $post['username'];
    $password = $post['password'];

    return db\Users::email." = '$login' AND ".db\Users::password." ='$password' ";
  }

  public static function cleanLogOut($post, &$session){
    if(!isset($post['logOut']))
      return;
    $session->logOut();
  }
  
  public static function getHtml($action, $method, $sessionFlag){
    $html = "<div class='loginForm'>";
    if(!$sessionFlag){
      $html = $html."<span class='loginHeader'>
    				<button class='link' onclick='toggleLoginForm()'><b>Login</b></button> or
    				<button class='link' onclick='toggleSubmitForm()'><b>Sign up</b></button>
            </span>
    			<form id = 'loginForm' class='hidden' action = '{$action}' method = '{$method}'>
    				<label for='email'>E-mail</label>
    				<input type = 'email' name = 'username'/>
    				<label for = 'password'>Password</label>
    				<input type = 'password' name = 'password'/>
    				<button type='submit' name = 'login'>Log in</button>
    			</form>
    		</div>";
        return $html;
    }

  $html = $html."<span class = 'loginHeader'>
          <form id = 'loginForm' action = '{$action}' method = '{$method}'>
            <button class = 'link' type = 'submit' name = 'logOut'> <b>Log out</b></button>
          </form>
          </span>
          </div>";
        return $html;
  }
}

class StudentsTable{
  public static function getDeleteValues($post){
    if(!isset($post['deleteStudents']))
      return '';
    return db\Students::id." IN ({$post['deleteList']})";
  }

  public static function getHtml($students, $action, $method, $sessionFlag){
    $html = "<table class = 'collapsed'>
    				<tr>
              <th>Lp</th>
    					<th>Name</th>
    					<th>Surname</th>
              <th>Faculty</th>
              <th>Birth Date</th>
              <th>Students Number</th>
              <th>Date Added</th>";
              if($sessionFlag){
              $html = $html."<th>
                <form onsubmit = 'return cleanDeleteForm()' action = '{$action}' method = '{$method}'>
                <input type = 'text' name = 'deleteList' hidden/>
                <button type = 'submit' name = 'deleteStudents'>RM</button>
                </form>
              </th>";
            }
    				$html = $html."</tr>";
    $tableData = "";

    foreach ($students as $idx => $student) {
      $id = $student->{db\Students::id};
      $tableData = $tableData."<tr>
        <td>{$idx}</td>
        <td>{$student->{db\Students::name}}</td>
        <td>{$student->{db\Students::surname}}</td>
        <td>{$student->{db\Students::faculty}}</td>
        <td>{$student->{db\Students::birthDate}}</td>
        <td>{$student->{db\Students::index}}</td>
        <td>{$student->{db\Students::dateAdded}}</td>";
        if($sessionFlag){
          $tableData = $tableData."<td><input type = 'checkbox' name = '{$id}'/></td>";
      }
      $tableData = $tableData."</tr>";
    }
    $html = $html.$tableData."\n</table>";
    return $html;
  }
}

class NewStudentForm{
  public static function getInsertValues($post){
    	if(!isset($post['addStudent']))
        return '';

    $name = "'{$post['firstname']}'";
    $surname = "'{$post['lastname']}'";
    $bDate = "'{$post['bdate']}'";
    $faculty = "'{$post['faculty']}'";
    $index = "'{$post['index']}'";

    return $name.','.$surname.','.$bDate.','.$faculty.','.$index;
  }

  public static function getInsertColumns(){
     return db\Students::name.','.db\Students::surname.','.db\Students::birthDate.','.db\Students::faculty.','.db\Students::index;
  }
  public static function getHtml($action, $method){
    $html = "<div class = 'newUserForm'>
    <div class='subHeader backgroundPrimary'>
    		<h2 class='colorText'>Add new student</h2>
    </div>
    	<form class='user-form' action = '{$action}' method = '{$method}'>
    	    <div class='field'>
    	        <label for='firstname'>First Name:</label>
    	        <input name='firstname' type='text' size='50' autofocus required  />
    	    </div>
    	    <div class='field'>
    	        <label for='lastname'>Last Name:</label>
    	        <input type='text' name='lastname' size='50' required />
    	    </div>
    	    <div class='field'>
    	        <label for='bdate'>Birth Date:</label>
    	        <input type='date' name='bdate' size='50' required />
    	    </div>
          <div class='field'>
              <label for='faculty'>Faculty:</label>
              <input name='faculty' type='text' size='50' autofocus required  />
          </div>
          <div class='field'>
              <label for='index'>Student number:</label>
              <input name='index' type='number' min = '0' size='50' autofocus required />
          </div>
          <div class = 'field'>
              <input type = 'submit' name = 'addStudent'/>
          </div>
    	</form>
      </div>";
      return $html;
  }
}
class PageHeader{
  public static function getHtml($title, $sessionFlag){
    $loginform = LoginForm::getHtml('index.php', 'Post', $sessionFlag);
    $html = "<div class='header'>
              <h2 class='title'>{$title}</h2>
              {$loginform}
              </div>";
		return $html;
  }
}
 ?>
