<?php

    session_start();

    $error = "";

    if (array_key_exists("logout",$_GET)) {
        unset($_SESSION);
        setcookie("id","",time() -60*60);
        $_COOKIE["id"] = "";
    }else if ((array_key_exists("id",$_SESSION) AND $_SESSION['id']) OR array_key_exists("id", $_COOKIE)) {

        header("Location: page.php");

    }

    if (array_key_exists("submit",$_POST)) {

        include("connection.php");

        if(!$_POST['email']){
            $error .= "Bitte trage eine Emailadresse ein.<br>";

        }
        if(!$_POST['password']){

            $error .= "Bitte trage ein Passwort ein<br>";

        }
        if($error != ""){

            $error = "<p>Es gab einen Fehler bei der Anmeldung</p>";

        }else{
           
            if ($_POST['signUp']=='1') {

                $query = "SELECT id FROM users WHERE email = '".mysqli_real_escape_string($link, $_POST['email'])."' LIMIT 1";
        
                $result = mysqli_query($link,$query);
        
                if (mysqli_num_rows($result) > 0) {
        
                    $error = "Diese Email ist bereits Registriert.";
                        
                }else {
                
                    $query = "INSERT INTO users (email, password) VALUES ('".mysqli_real_escape_string($link,$_POST['email'])."','".mysqli_real_escape_string($link, $_POST['password'])."')";
    
                    if (!mysqli_query($link,$query)) {
                        
                        $error = "<p> Registrierung fehlgeschlagen. </p>";
                        
                    }else{
    
                        $query = "UPDATE users SET password = '".md5(md5(mysqli_insert_id($link)).$_POST['password'])."' WHERE id = ".mysqli_insert_id($link)." LIMIT 1";
    
                        mysqli_query($link,$query);
    
                        $_SESSION['id'] = mysqli_insert_id($link);
    
                        if($_POST['stayLoggedIn'] == '1'){
                            
                            setcookie("id",mysqli_insert_id($link),time()+60*60*24*100);
    
    
                        }
                        
                        header("Location: page.php");
                        
                    }
                }

            }else if($_POST['signUp'] == '0'){

                $query = "SELECT * FROM users WHERE email = '".mysqli_real_escape_string($link, $_POST['email'])."'";

                $result = mysqli_query($link,$query);

                $row = mysqli_fetch_array($result);
        
                if (isset($row)) {
        
                    $passwordHash = md5(md5($row['id']).$_POST['password']);

                    if ($passwordHash == $row['password']) {

                        $_SESSION['id'] = $row['id'];

                        if ($POST['stayLoggedIn'] == '1') {
                            setcookie("id",mysqli_insert_id($link),time()+60*60*24*100);
                        }

                        header("Location: page.php");

                    }else{

                        $error = "Entweder die Emailadresse ist nicht registriert, oder das Passwort war Falsch.";

                    }                       
                }else {

                    $error = "Entweder die Emailadresse ist nicht registriert, oder das Passwort war Falsch.";

                }
            }
        }
    }

?>

<?php include("header.php")?>

    <div id="container" class="container-fluid">

        <h1>Deine Lernkartenverwaltung</h1>
        <a href="https://github.com/mbmhelloworld/flashcards">GitHub repository</a>
        
        <div id="error"><?php echo $error;?></div>

        
        <form method="post" id="signUpForm">
            <h2>Registrieren</h2>
            <div class="form-group">
                <label for="email">Email-Adresse</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Email-Adresse">
            </div>
            <div class="form-group">
                <label for="password">Passwort</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Passwort">
            </div>
            <div class="checkbox">
                <label>
                <input type="checkbox" name="stayLoggedIn" value = 1> Angemeldet bleiben
                </label>
            </div>
            <input type="hidden" name = "signUp" value = "1">
            <input type="submit" class="btn btn-primary" name="submit" value="Registrieren">

            <p><a class="toggleForms">Anmelden</a></p>

        </form>

        
        <form method="post" id="logInForm">
            <h2>Anmelden</h2>
            <div class="form-group">
                <label for="email">Email-Adresse</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Email-Adresse">
            </div>
            <div class="form-group">
                <label for="password">Passwort</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Passwort">
            </div>
            <div class="checkbox">
                <label>
                <input type="checkbox" name="stayLoggedIn" value = 1> Angemeldet bleiben
                </label>
            </div>
            <input type="hidden" name = "signUp" value = "0">
            <input type="submit" class="btn btn-success" name="submit" value="Login">

            <p><a class="toggleForms">Registrieren</a></p>

        </form>

        <div id="space"></div>

    </div>

 <?php include("footer.php")?>
