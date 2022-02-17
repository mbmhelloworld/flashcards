<?PHP

    session_start();

    if (array_key_exists("subject",$_POST) && array_key_exists("question",$_POST) && array_key_exists("answer",$_POST)) {

        include("connection.php");

        $query = "INSERT INTO flashcards (userid, subject, question, answer) VALUES ('".mysqli_real_escape_string($link,$_SESSION['id'])."','".mysqli_real_escape_string($link,$_POST['subject'])."','".mysqli_real_escape_string($link, $_POST['question'])."','".mysqli_real_escape_string($link, $_POST['answer'])."')";

        mysqli_query($link,$query);

    }else{
        echo '<div class="alert alert-danger" role="alert">Es werden alle Felder benötigt.</div>';
    }

?>