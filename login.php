<?php
// Validation du formulaire
if (isset($_POST['login']) &&  isset($_POST['password'])) {
    foreach ($users as $user) {
        if (
            $user['login'] === $_POST['login'] &&
            $user['password'] === $_POST['password']
        ) {
            $_SESSION['LOGGED_USER']=$_POST['login'] ;
            
        } else {
            $errorMessage = sprintf('Les informations envoyées ne permettent pas de vous identifier : (%s/%s)',
                $_POST['login'],
                $_POST['password']
            );
        }
    }
}
?>

<!--
   Si utilisateur/trice est non identifié(e), on affiche le formulaire
-->
<?php if(!isset($_SESSION['LOGGED_USER'])): ?>
<form action="home.php" method="post">
    <!-- si message d'erreur on l'affiche -->
    <?php if(isset($errorMessage)) : ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $errorMessage; ?>
        </div>
    <?php endif; ?>
    <div class="mb-3">
        <label for="login" class="form-label">Login</label>
        <input type="login" class="form-control" id="login" name="login">
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Mot de passe</label>
        <input type="password" class="form-control" id="password" name="password">
    </div>
    <button type="submit" class="btn btn-primary">Envoyer</button>
</form>
<!-- 
    Si utilisateur/trice bien connectée on affiche un message de succès
-->
<?php else: 
       if($_SESSION['LOGGED_USER']=="etudiant")
            include_once("page2.php");
            else
            include_once("page1.php");
     endif; 
?>

