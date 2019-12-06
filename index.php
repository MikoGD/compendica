<!DOCTYPE html>
<html lang="en">
<head>
<?php
session_start();
unset($_SESSION['account']);
require('header.phtml');
require('functions.php');
require('db.php');

$username_error = $password_error = $account_error = "";
$username = $password = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["username"]))
    {
        $username_error = '<span class="form__error">Username required</span>';
    }
    else
    {
        $username = test_input($_POST["username"]);
        // check if username only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z ]*$/",$username))
        {
            $username_error = '<span class="form__error">Only letters and white space allowed</span>';
        }// END INNER INNER IF
    }// END INNER IF

    if (empty($_POST["password"]))
    {
        $password_error = '<span class="form__error">Password is required</span>';
    }
    else
    {
        $password = test_input($_POST["password"]);
        if (strlen($password) < 7)
        {
            $password_error = '<span class="form__error">Password must be at least 6 characters</span>';
        }// END INNER INNER IF
    }// END INNER IF

    if ($username_error == '' || $password_error == '')
    {
        $result = mysqli_query(
            $db,
            "SELECT user_name, user_password FROM Users WHERE user_name = '$username' AND user_password = '$password'");
        if (mysqli_num_rows($result) > 0)
        {
            header("Location: home.php");
            $_SESSION['account'] = $username;
            return;
        }
        else
        {
            $account_error = '<span class="form__error">Invalid username or password</span>';
            $password_error = '';
            $username_error = '';
        }// END IF
    }
    }// END IF
?>

</head>
<body>
    <header class="header">
        <h2 class="heading-secondary">Welcome to</h2>
        <h1 class="heading-primary u-margin-top-n-m">Compendica</h1>

        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" class="form">
            <?php if ($account_error != '') echo $account_error;?>
            <label for="username" class="form__label">username</label>
            <?php if ($username_error != '') echo $username_error;?>
            <input type="text" class="form__input" name="username" id="username" value="<?php echo $username?>">

            <label for="password" class="form__label">password</label>
            <?php if ($password_error != '') echo $password_error;?>
            <input type="password" class="form__input" name="password" id="password">

            <div class="form__btn u-margin-top-xs">
                <button type="submit" class="btn btn--submit">Log In</button>
                <button class="btn btn--sign-up"><a href="sign_up.php" class="btn__link">Register</a></button>
            </div>
        </form>
    </header>
</body>
</html>
