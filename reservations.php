<!DOCTYPE html>
<html lang="en">
<head>
<?php
session_start();
require('header.phtml');
require('functions.php');
require('db.php');

$account = $_SESSION['account'];

$result = mysqli_query(
    $db,
    "SELECT book_title, book_author, book_isbn
     FROM Reservations
     JOIN Books
     USING (book_isbn)
     WHERE user_name='$account';"
);

$i = 0;

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    if (!empty($_POST["book1"])) {
        $value = $_POST["book1"];
        $sql = mysqli_query(
            $db,
            "DELETE FROM Reservations WHERE book_isbn='$value';"
        );

        $update = mysqli_query(
            $db,
            "UPDATE Books
             SET book_reserved='N'
             WHERE book_isbn='$value';"
        );
    }// END INNER IF

    if (!empty($_POST["book2"])) {
        $value = $_POST["book2"];
        $sql = mysqli_query(
            $db,
            "DELETE FROM Reservations WHERE book_isbn='$value';"
        );

        $update = mysqli_query(
            $db,
            "UPDATE Books
             SET book_reserved='N'
             WHERE book_isbn='$value';"
        );
    }// END INNER IF

    if (!empty($_POST["book3"])) {
        $value = $_POST["book3"];
        $sql = mysqli_query(
            $db,
            "DELETE FROM Reservations WHERE book_isbn='$value';"
        );

        $update = mysqli_query(
            $db,
            "UPDATE Books
             SET book_reserved='N'
             WHERE book_isbn='$value';"
        );
    }// END INNER IF

    if (!empty($_POST["book4"])) {
        $value = $_POST["book4"];
        $sql = mysqli_query(
            $db,
            "DELETE FROM Reservations WHERE book_isbn='$value';"
        );

        $update = mysqli_query(
            $db,
            "UPDATE Books
             SET book_reserved='N'
             WHERE book_isbn='$value';"
        );
    }// END INNER IF

    if (!empty($_POST["book5"])) {
        $value = $_POST["book5"];
        $sql = mysqli_query(
            $db,
            "DELETE FROM Reservations WHERE book_isbn='$value';"
        );

        $update = mysqli_query(
            $db,
            "UPDATE Books
             SET book_reserved='N'
             WHERE book_isbn='$value';"
        );
    }// END INNER IF

    header("Location: reservations.php");
    return;
}// END IF
?>
</head>
<body>
    <?php 
    $active = 'reservations';
    require('nav.php');
    ?>
    <main class="main">
        <div class="main__content">
            <?php
            $action = htmlspecialchars($_SERVER["PHP_SELF"]);

            $i = 0;

            while ($row = mysqli_fetch_row($result))
            {
                $name = 'book' . ($i + 1);

                $action = htmlspecialchars($_SERVER["PHP_SELF"]);
                echo "<div class=\"book\">";
                echo "<h3 class=\"book__title\">$row[0]</h4>";
                echo "<h4 class=\"book__author\">By $row[1]</h4>";
                echo "<form method=\"POST\" action=\"$action\" class=\"book__reserve\">";
                echo "<button type=\"submit\" name=\"$name\" value=\"$row[2]\" class=\"btn btn--reserve\">unreserve</button>;";
                echo "</form>";
                echo "</div>";

                $i += 1;

                if ($i == 5) break;
            }//END WHILE
            ?>
        </div>
    </main>
    <?php require('footer.php');?>
</body>
</html>
