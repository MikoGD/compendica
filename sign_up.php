<!DOCTYPE html>
<html lang="en">
<head>
<?php
require('header.phtml');
require('functions.php');
require('db.php');

$username_error = $first_name_error = $surname_error = $address1_error = $address2_error = $city_error =  $password_error = $password_confirm_error = $telephone_error = $phone_error = $account_error= "";
$username = $first_name = $surname = $address1 = $address2 = $city = $telephone = $phone = $password = $password_confirm =  "";

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

    if (empty($_POST["first_name"]))
    {
        $first_name_error = '<span class="form__error">First name required</span>';
    }
    else
    {
        $first_name = test_input($_POST["first_name"]);
        // check if first_name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z ]*$/",$first_name))
        {
            $first_name_error = '<span class="form__error">Only letters and white space allowed</span>';
        }// END INNER INNER IF
    }// END INNER IF

    if (empty($_POST["surname"]))
    {
        $surname_error = '<span class="form__error">Surname required</span>';
    }
    else
    {
        $surname = test_input($_POST["surname"]);
        // check if surname only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z ]*$/",$surname))
        {
            $surname_error = '<span class="form__error">Only letters and white space allowed</span>';
        }// END INNER INNER IF
    }// END INNER IF

    if (empty($_POST["address1"]))
    {
        $address1_error = '<span class="form__error">Address1 required</span>';
    }
    else
    {
        $address1 = test_input($_POST["address1"]);
        // check if address1 only contains letters and whitespace
        if (!preg_match("/^[1-9a-zA-Z ]*$/",$address1))
        {
            $address1_error = '<span class="form__error">Only letters and white space allowed</span>';
        }// END INNER INNER IF
    }// END INNER IF

    if (!empty($_POST["address2"]))
    {
        $address2 = test_input($_POST["address2"]);
        // check if address2 only contains letters and whitespace
        if (!preg_match("/^[1-9a-zA-Z ]*$/", $address2))
        {
            $address2_error = '<span class="form__error">Only letters and white space allowed</span>';
        }// END INNER INNER IF
    }// END IF

    if (empty($_POST["city"]))
    {
        $city_error = '<span class="form__error">City required</span>';
    }
    else
    {
        $city = test_input($_POST["city"]);
        // check if city only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z ]*$/",$city))
        {
            $city_error = '<span class="form__error">Only letters and white space allowed</span>';
        }// END INNER INNER IF
    }// END INNER IF

    if (empty($_POST["telephone"]))
    {
        $telephone_error = '<span class="form__error">Telephone required</span>';
    }
    else
    {
        $telephone = $_POST["telephone"];
    }// END INNER IF

    if (empty($_POST["phone"]))
    {
        $phone_error = '<span class="form__error">Phone required</span>';
    }
    else
    {
        $phone = $_POST["phone"];
    }// END INNER IF

    if (empty($_POST["city"]))
    {
        $city_error = '<span class="form__error">City required</span>';
    }
    else
    {
        $city = test_input($_POST["city"]);
        // check if city only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z ]*$/",$city))
        {
            $city_error = '<span class="form__error">Only letters and white space allowed</span>';
        }// END INNER INNER IF
    }// END INNER IF

    if (empty($_POST["password"]))
    {
        $password_error = '<span class="form__error">Password required</span>';
    }
    else
    {
        $password = test_input($_POST["password"]);
        if (strlen($password) < 7)
        {
            $password_error = '<span class="form__error">Password must be at least 6 characters</span>';
        }// END INNER INNER IF
    }// END INNER IF

    if (empty($_POST["password_confirm"]))
    {
        $password_confirm_error = '<span class="form__error">Password confirmation required</span>';
    }
    else
    {
        $password_confirm = test_input($_POST["password_confirm"]);
        if (strlen($password_confirm) < 7)
        {
            $password_confirm_error = '<span class="form__error">Password must be at least 6 characters</span>';
        }// END INNER INNER IF

        if ($password != $password_confirm)
        {
            $password_confirm_error = '<span class="form__error">Password does not match</span>';
        }
    }// END INNER IF

    if ($username_error == ''
        || $first_name_error == ''
        || $surname_error == ''
        || $address1_error == ''
        || $address2_error == ''
        || $telephone_error == ''
        || $phone_error == ''
        || $city_error == ''
        || $password_error == ''
        || $password_confirm_error == '')
        {
            echo "VALID";
            $result = mysqli_query(
                $db,
                "SELECT * FROM Address
                 WHERE address_line_1 = '$address1' AND address_line_2 = '$address2' AND address_city = '$city';"
            );

            if (mysqli_num_rows($result) < 1)
            {
                mysqli_query(
                    $db,
                    "INSERT INTO Address (address_line_1, address_line_2, address_city)
                     VALUES ('$address1', '$address2', '$city');"
                );
            }// END IF

            $result = mysqli_query(
                $db,
                "SELECT address_id FROM Address
                 WHERE address_line_1 = '$address1' AND address_line_2 = '$address2' AND address_city = '$city';"
            );

            $row = mysqli_fetch_row($result);
            $address_id = $row[0];

            mysqli_query(
                $db,
                "INSERT INTO Users (
                    user_name,
                    user_password,
                    user_first_name,
                    user_surname,
                    user_address_id,
                    user_telephone,
                    user_phone)
                 VALUES (
                    '$username',
                    '$password',
                    '$first_name',
                    '$surname',
                    '$address_id',
                    '$telephone',
                    '$phone');"
            );

            header("Location: index.php");
            return;
        }// END INNER IF
}// END IF
?>
</head>
<body>
    <header class="header">
        <div class="sign-up">
            <h2 class="heading-secondary u-margin-top-n-s">Compendica</h2>
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" class="form sign-up__form">
                <div class="form__input-wrapper">
                    <div class="form__left">
                        <label for="username" class="form__label">username</label>
                        <?php if ($username_error != '') echo $username_error;?>
                        <input type="text" class="form__input" id="username" name="username" value="<?php echo $username?>">

                        <label for="first_name" class="form__label">First name</label>
                        <?php if ($first_name_error != '') echo $first_name_error;?>
                        <input type="text" class="form__input" id="first_name" name="first_name" value="<?php echo $first_name?>">

                        <label for="surname" class="form__label">surname</label>
                        <?php if ($surname_error != '') echo $surname_error;?>
                        <input type="text" class="form__input" id="surname" name="surname" value="<?php echo $surname?>">

                        <label for="password" class="form__label">password</label>
                        <?php if ($password_error != '') echo $password_error;?>
                        <input type="password" class="form__input" id="password" name="password" value="<?php echo $password?>">

                        <label for="password-confirm" class="form__label">confirm password</label>
                        <?php if ($password_confirm_error != '') echo $password_confirm_error;?>
                        <input type="password" class="form__input" id="password-confirm" name="password_confirm" value="<?php echo $password_confirm?>">
                    </div>
                    <div class="form__right">
                        <label for="adress_l1" class="form__label">adress line 1</label>
                        <?php if ($address1_error != '') echo $address1_error;?>
                        <input type="text" class="form__input" id="adress_l1" name="address1" value="<?php echo $address1?>">

                        <label for="adress_l2" class="form__label">adress line 2</label>
                        <?php if ($address2_error != '') echo $address1_error;?>
                        <input type="text" class="form__input" id="adress_l2" name="address2" value="<?php echo $address2?>">

                        <label for="city" class="form__label">city</label>
                        <?php if ($city_error != '') echo $city_error;?>
                        <input type="text" class="form__input" id="city" name="city" value="<?php echo $city?>">

                        <label for="telephone" class="form__label">telephone</label>
                        <?php if ($telephone_error != '') echo $telephone_error;?>
                        <input type="text" class="form__input" id="telephone" name="telephone" value="<?php echo $telephone?>">

                        <label for="phone" class="form__label">phone</label>
                        <?php if ($phone_error != '') echo $phone_error;?>
                        <input type="text" class="form__input" id="phone" name="phone" value="<?php echo $phone?>">
                    </div>
                </div>
                <div class="form__btn u-margin-top-xs">
                    <button type="submit" class="btn btn--sign-up">sign up</button>
                    <button class="btn btn--back"><a href="index.php" class="btn__link">back</a></button>
                </div>
            </form>
        </div>
    </header>
</body>
