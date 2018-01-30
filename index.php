<?php
include_once "templates.php";
include_once "database.php";
include_once "display.php";
include_once "session.php";

$db = new firebird\Database;
$dp = new Display;
$error = '';
$session = new Session();

function handleLogin(&$db, &$error){
  global $session;
  LoginForm::cleanLogOut($_POST, $session);
  $condition = LoginForm::clean($_POST);
  if(empty($condition))
    return;
  $result = $db->querySelect("USERS", "*", $condition);
  if(empty($result->data)){
    $error = $error."Invalid login or password";
    return;
  }
  else{
    $session->saveUserData($result->data[0]);
  }
}

function handleNewStudent(&$db, &$error){
  $values = NewStudentForm::getInsertValues($_POST);
  if(empty($values))
    return;
  $result = $db->queryInsert("STUDENTS", NewStudentForm::getInsertColumns(), $values);
  $error = $error.$result->message;
}

function handleDeleteStudents(&$db, &$error){
    $deleteCondition = StudentsTable::getDeleteValues($_POST);
    if(empty($deleteCondition))
      return;
    $result = $db->queryDelete("STUDENTS",  $deleteCondition);
    $error = $error.$result->message;
}

function warning_handler($errno, $errstr) {
  global $error;
  $error = $error.$errstr;
}

set_error_handler("warning_handler", E_WARNING);;
handleLogin($db, $error);
handleNewStudent($db, $error);
handleDeleteStudents($db, $error);
$students = $db->querySelect("STUDENTS", "*", "");
$error = $error.$students->message;

if(!empty($error))
  $dp->addToolbar(ErrorDialog::getHtml($error));

$dp->addContent(StudentsTable::getHtml($students->data, "index.php", "Post", Session::is_session_started()));
$dp->addSideMenu(NewStudentForm::getHtml("index.php", "Post"));
$dp->run(Session::is_session_started());
?>
