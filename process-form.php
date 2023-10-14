<?php 
$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message']; 

var_dump($name,$email,$message);

$host = "localhost";
$dbname = "test_db";
$username= "root";
$password="";

$conn = mysqli_connect  ($host, $username, $password, $dbname); 

if (mysqli_connect_errno()) {
	die("Connection error: " . mysqli_connect_error());
}
echo "Соединение успешно." . "<br>";

$sql = "INSERT INTO test (username,email,message)
        VALUES (?,?,?)";

        $stmt = mysqli_stmt_init($conn);

        if (! mysqli_stmt_prepare($stmt , $sql)) {
        	die(mysqli_error($conn));
        }
        mysqli_stmt_bind_param($stmt, "sss",
$username,
$email,
$message);
mysqli_stmt_execute($stmt);
echo "Запись сохранена." . "<br>";

function validateInput($userInput, $pattern, $error) {
    if (preg_match($pattern, $userInput)) {
        echo $error . "<br>";
    } else {
        echo "NICE." . "<br>";
    }
}

$userInputName = $_POST['name'];
$numbersPattern = '/[0-9]/';
$prohibitedPattern = '/[@#$%^&*()+=\[\]{}|~<>?\\\\]';
validateInput($userInputName, $numbersPattern, "Ошибка: числа не допускаются во входных данных.");

$userInputEmail = $_POST['email'];
$prohibitedEmailPattern = '/[^a-zA-Z0-9@. ]/';
validateInput($userInputEmail, $prohibitedEmailPattern, "Ошибка: Запрещенные символы (кроме @ и точка) не допускаются во вводе.");

$userInputMessage = $_POST['message'];
$prohibitedPattern = '/[#$%^&*()\[\]{}|~<>\\\\]/';
validateInput($userInputMessage, $numbersPattern, "Ошибка: числа не допускаются во входных данных.");
validateInput($userInputMessage, $prohibitedPattern, "Ошибка: во входных данных нельзя использовать запрещенные символы.");

$allowedCharactersPattern = '/[@?!"+=:$\-\. ]/';
validateInput($userInputMessage, $allowedCharactersPattern, "Error.");
?>



