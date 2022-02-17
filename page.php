<?php

    session_start();

    if(array_key_exists("id", $_COOKIE)){
        $_SESSION['id'] = $_COOKIE['id'];
    }

    if (array_key_exists("id", $_SESSION)) {
        echo '<div class="alert alert-info" role="alert">Du bist angemeldet. <a href="index.php?logout=1">Abmelden</a></p></div>';

        include("connection.php");


    }else{
        header("Location: index.php");
    }

?>

<?php include("header.php")?>

    <div id="container_page" class="container-fluid">
        
        <div id="error"><?php echo $error;?></div>

        <form method="post">
            <div class="form-group">
                <label for="subject">Fach</label>
                <input type="subject" class="form-control" id="subject" name="subject" placeholder="Fach">
            </div>
            <textarea id="question" class="form-control">Frage</textarea>
            <textarea id="answer" class="form-control">Antwort</textarea>
            <input id="save" type="submit" name="submit" value="Speichern">
        </form>

        <form method="post">

            <div  class="panel panel-default"> 
                    <p id="showSubject">FACH</p>
                    <div class="panel-body">
                        <p id="showQuestion">FRAGE</p>
                    </div>
                <div class="panel-footer"><p id="showAnswer">ANTWORT</p></div>
            </div>

            <div class="btn-group">
                <button id="delete" type="button" class="btn btn-danger">Löschen(dauerhaft)</button>
                <button id="openAnswer" type="button" class="btn btn-success">Antwort aufdecken</button>
                <button id="nextQ" type="button" class="btn btn-primary">Nächste Frage(zufall)</button>
            </div>
        </form>

        <div id="space"></div>

    </div>

 <?php include("footer.php")?>