<?PHP

session_start();

include("connection.php");

$query = "SELECT * FROM flashcards WHERE userid= ".mysqli_real_escape_string($link,$_SESSION['id']).";";

$result = mysqli_query($link,$query);

if(mysqli_num_rows($result) > 0) {
    $data   =   mysqli_fetch_all($result,MYSQLI_ASSOC);
    echo json_encode($data);
}

?>