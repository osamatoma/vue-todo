<?php 
header('Access-Control-Allow-Origin: *'); 
header("Content-Type: application/json");
require 'conn.php';
function getTodos() {
    global $conn;
    $getList = $conn->prepare("SELECT * FROM list ORDER BY id");
    $getList->execute();
   return $getList->fetchAll();
}
function addTodo($value) {
	global $conn;
    $addToList = $conn->prepare("INSERT INTO list (todo) VALUES (?)");
    $addToList->execute(array($value));

   return $addToList->rowCount();
}
function deleteTodo($id) {
	global $conn;
    $deleteFromList = $conn->prepare("DELETE FROM list WHERE list.id = ? ");
    $deleteFromList->execute(array($id));
   return $deleteFromList->rowCount();
}

function completeTodo($id) {
	global $conn;
    $completeTodo = $conn->prepare("UPDATE list set done = 1 WHERE list.id = ?");
    $completeTodo->execute(array($id));
   return $completeTodo->rowCount();
}
function undoTodo($id) {
	global $conn;
    $undoTodo = $conn->prepare("UPDATE list set done = 0 WHERE list.id = ?");
    $undoTodo->execute(array($id));
   return $undoTodo->rowCount();
}
function clearAllDone() {
    global $conn;
    $clearAllDone = $conn->prepare("DELETE FROM list WHERE done = 1");
    $clearAllDone->execute();
   return $clearAllDone->rowCount();
}
function doneAll() {
    global $conn;
    $doneAll = $conn->prepare("UPDATE list set done = 1");
    $doneAll->execute();
   return $doneAll->rowCount();
}
 
if(isset($_GET['getTodos'])) {
    echo json_encode( getTodos() );   
}

if(isset($_POST['todo'])) {
	if(addTodo($_POST['todo']) > 0) {
		$res = [
        	'response' => "the task has been added",
        	'todos' => getTodos()
    	];
	} else {
		$res = ["response" =>  "ERROR"];
	}
    
    echo json_encode($res);
}

if(isset($_POST['deleteId'])) {
	if(deleteTodo($_POST['deleteId']) > 0) {
		$res = [
        	'response' => "the task has been deleted",
        	'todos' => getTodos()
    	];
	} else {
		$res = ["response" =>  "ERROR"];
	}
    
    echo json_encode($res);
}

if(isset($_POST['completeId'])) {
    if(completeTodo($_POST['completeId']) > 0) {
        $res = [
            'response' => "the task has been completed",
            'todos' => getTodos()
        ];
    } else {
        $res = ["response" =>  "ERROR"];
    }
    
    echo json_encode($res);
}
if(isset($_POST['undoId'])) {
    if(undoTodo($_POST['undoId']) > 0) {
        $res = [
            'response' => "the task has been returned",
            'todos' => getTodos()
        ];
    } else {
        $res = ["response" =>  "ERROR"];
    }
    
    echo json_encode($res);
}
if(isset($_POST['clearAllDone'])) {
    if($_POST['clearAllDone'] == true && clearAllDone() > 0) {
        $res = [
            'response' => "the completed tasks has been deleted",
            'todos' => getTodos()
        ];
    } else {
        $res = [
            'response' => "",
            'todos' => getTodos()
        ];
    }
    
    echo json_encode($res);
}

if(isset($_POST['doneAll'])) {
    if($_POST['doneAll'] == true && doneAll() > 0) {
        $res = [
            'response' => "the tasks has been completed",
            'todos' => getTodos()
        ];
    } else {
        $res = [
            'response' => "",
            'todos' => getTodos()
        ];
    }
    
    echo json_encode($res);
}