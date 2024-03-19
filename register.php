<?php include "commun/head.php";
include "commun/header.php" ?>

<div class="container-fluid ">
    <div class="row ">
        <div class="col-6 mx-auto">
            <form method="post" action="#">
            <div class=" mb-3">
                <label for="username" class="form-label">username</label>
                 <input type="text" class="form-control" placeholder="Username" id="username" name="username" aria-label="Username" aria-describedby="basic-addon1">
            </div>

            <div class="mb-3">
                <label for="mail" class="form-label">Email address</label>
                <input type="email" class="form-control" id="mail" name="email">
            </div>
            <div class="row g-3 align-items-center">
                <div class="col-auto">
                    <label for="password" class="col-form-label">Password</label>
                </div>
                <div class="col-auto">
                    <input type="password" id="password" class="form-control" name="password" aria-describedby="passwordHelpInline">
                </div>
                <div class="col-auto">
                    <span id="passwordHelpInline" class="form-text ">
                        Must be 8-20 characters long.
                    </span>
                </div>
            </div>
            <div class="pt-3">
            <input type="submit" class="btn btn-primary " value="submit" name="submit">
            </div>
            </form>
        </div>
    </div>
</div>


<?php



if (isset($_POST['submit'])) {
    if (!empty($_POST['username']) && !empty($_POST['email']) && !empty($_POST['password'])) {
        $username = $_POST['username'];
        if (preg_match('/^[a-zA-Z0-9]{4,16}$/', $username)) {
            echo "<p>Mon nom : $username</p> <br>";
        } else {
            echo "<alert>Merci de respecter le format chiffre lettre majuscule minuscule</alert> <br>";
        }
        $email = $_POST['email'];
        if ($email) {
            $emailSanitize = filter_var($email, FILTER_SANITIZE_EMAIL);
            echo "<p>Mon email : $emailSanitize</p> <br>";
        } else {
            echo "<alert>Merci de respecter le format email</alert> <br>";
        }
        $password = $_POST['password'];
                     // /^(?=.[a-z])(?=.[A-Z])(?=.\d)(?=.[@$!%?&])[A-Za-z\d@$!%?&]{8,20}$/
        if (preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%?&])[A-Za-z\d@$!%*?&]{8,20}$/', $password)) {
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);
            echo "<p>Mon mot de passe : $password</p> <br>";
        } else {
            echo "<alert>Le mot de passe ne conviens pas</alert> <br>";
        }
        $sql = "INSERT INTO utilisateur (username, email, password, role_idrole) VALUES (:username, :email, :password, :role_idrole)";
        require "db.php";
        $role = 2;
        $envoie = $pdo->prepare($sql);
        $envoie->bindParam(':username', $username);
        $envoie->bindParam(':email', $email);
        $envoie->bindParam(':password', $passwordHash);
        $envoie->bindParam(':role_idrole', $role);

        $envoie->execute();
        echo "Tout est ok";
        
    } else {
        echo "<p>Merci de remplir tout les champs du formulaire.</p>";
    }
} else {
    echo "<p>Merci de remplir le formulaire.</p>";
}

include "commun/footer.php" ?>