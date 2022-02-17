<?PHP

session_start();

include("connection.php");

$request = $_REQUEST;
$id = $request['id'];

$query = "DELETE FROM flashcards WHERE id = '".$id."' LIMIT 1";

mysqli_query($link,$query);

echo $query;


?>