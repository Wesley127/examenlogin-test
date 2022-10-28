<?php

    session_start();
    $user_id = $_SESSION["id"];
    if(isset($_POST["submit"])) {
        $email = $_POST["email"];


        $voornaam = $_POST["voornaam"];
        $tussenvoegsel = $_POST["tussenvoegsel"];
        $achternaam = $_POST["achternaam"];


        // Instantiate EditProfile class
        include "../classes/edit-profile.php";

        if (!empty($_POST["nieuwWachtwoord"])){
            $wachtwoord = $_POST["nieuwWachtwoord"];
            $wachtwoord = password_hash($wachtwoord, PASSWORD_DEFAULT);

            $editProfile = new EditProfile($email, $wachtwoord, $voornaam, $tussenvoegsel, $achternaam);
            $editProfile->getProfileById($user_id);
            $editProfile->updateProfileWachtwoord($user_id, $email, $wachtwoord, $voornaam, $tussenvoegsel, $achternaam);
    
            }else{
                $editProfile = new EditProfile($email, $voornaam, $tussenvoegsel, $achternaam);
                $editProfile->getProfileById($user_id);
                $editProfile->updateProfile($user_id, $email, $voornaam, $tussenvoegsel, $achternaam);
            }
            



// Going to back to front page
        header("location: ../profile.php");
    }
?>