    <!-- Designchanging Session control -->
    <?php
if ($_SESSION){
    echo "<div class='container'>";
}
else{
    echo"<div>";
}
    ?>
    <h2>Zugangsbereich</h2>

<!-- login form box -->
    <h3>Einloggen</h3>
<form method="post" action="index.php" name="loginform">

    <label for="login_input_username">Email</label>
    <input id="login_input_username" class="login_input" type="text" name="user_email" required />

    <label for="login_input_password">Passwort</label>
    <input id="login_input_password" class="login_input" type="password" name="user_password" autocomplete="off" required />

    <input type="submit"  name="login" value="Log in" />
<p>
admin@admin.at 123456 //user@user.at 123456
</p>
</form>

<!-- register form -->
<form action="<?php echo URL; ?>users/adduser" method="POST">

    <!-- Vorname -->
    <input id="login_input_username" class="login_input" type="text" pattern="[a-zA-Z0-9]{2,64}" name="user_fname" required />
    <label for="login_input_userfname">Vorname</label><br>
    <!-- Nachname -->
    <input id="login_input_userlname" class="login_input" type="text" pattern="[a-zA-Z0-9]{2,64}" name="user_lname" required />  <label for="login_input_userlname">Nachname</label><br>
    <!-- Email-Adresse-->
    <input id="login_input_email" class="login_input" type="email" name="user_email" required />   <label for="login_input_email">Email</label><br>
<!-- Passwort -->
    <input id="login_input_password_new" class="login_input" type="password" name="user_password_new" pattern=".{6,}" required autocomplete="off" /><label for="login_input_password_new">Passwort (mindestens sechsstellig)</label><br>
    <input id="login_input_password_repeat" class="login_input" type="password" name="user_password_repeat" pattern=".{6,}" required autocomplete="off" />
    <label for="login_input_password_repeat">Wiederholen Sie Ihr Passwort</label><br><input type="submit"  name="register" value="Register" />
</form>

    </div>
</div>
