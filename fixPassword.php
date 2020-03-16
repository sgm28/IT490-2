<?php



function login($user,$pass){
        //TODO validate user credentials

$servername = "localhost";
$username = "root";
$password = "VeryLongPassword1!";

try {

    $conn = new PDO("mysql:host=$servername;dbname=members", $username, $password);

    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "Connected successfully";
    $hashPassword = password_hash($pass, PASSWORD_BCRYPT);


$stmt = $conn->prepare("UPDATE Users SET Password=:hashPassword  WHERE Password= :password");



$params = array('hashPassword'=>$hashPassword, 'password' => $pass);
$stmt->execute($params);
$count = $stmt->rowCount();
if($count > 0)
{
        echo "Updated table";
}
else
{
        echo "Did not update table";
}
}
catch(PDOException $e)
{
        echo "Connection failed " . $e->getMessage();
}

//$sql = "SELECT FirstName, LastName, Email FROM Users WHERE Password='$passwor$
//$result = $conn->query($sql);

        return true;
}

login("abc",123);




?>
