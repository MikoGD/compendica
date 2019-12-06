<!DOCTYPE html>
<html lang="en">
<head>
<?php
session_start();
require('header.phtml');
require('functions.php');
require('db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    if (isset($_POST['search']))
    {
        $search = htmlentities($_POST['search']);        

        $result = mysqli_query(
            $db,
            "SELECT book_title, book_author, book_reserved, book_isbn 
             FROM Books
             WHERE book_title LIKE '%$search%' OR book_author LIKE '%$search%';"
        );
    }
    else
    {
        $result = mysqli_query(
            $db,
            "SELECT book_title, book_author, book_reserved, book_isbn FROM Books;"
        );
    }// END IF
}
else
{
    $result = mysqli_query(
        $db,
        "SELECT book_title, book_author, book_reserved, book_isbn FROM Books;"
    );
}

$row1 = mysqli_fetch_row($result);
$row2 = mysqli_fetch_row($result);
$row3 = mysqli_fetch_row($result);
$row4 = mysqli_fetch_row($result);
$row5 = mysqli_fetch_row($result);

$books = ['book1' => '', 'book1' => '', 'book1' => '', 'book1' => '', 'book1' => ''];

if ($row1[2] == 'N')
{
    $books['book1'] = "<button type=\"submit\" name=\"book1\" value=\"btn\" class=\"btn btn--reserve\">reserve</button>";
}
else
{
    $books['book1'] = '<div class="book__reserved">reserved</div>';
}// END IF

if ($row2[2] == 'N')
{
    $books['book2'] = "<button type=\"submit\" name=\"book2\" value=\"btn\" class=\"btn btn--reserve\">reserve</button>";
}
else
{
    $books['book2'] = '<div class="book__reserved">reserved</div>';
}// END IF

if ($row3[2] == 'N')
{
    $books['book3'] = "<button type=\"submit\" name=\"book3\" value=\"btn\" class=\"btn btn--reserve\">reserve</button>";
}
else
{
    $books['book3'] = '<div class="book__reserved">reserved</div>';
}// END IF

if ($row4[2] == 'N')
{
    $books['book4'] = "<button type=\"submit\" name=\"book4\" value=\"btn\" class=\"btn btn--reserve\">reserve</button>";
}
else
{
    $books['book4'] = '<div class="book__reserved">reserved</div>';
}// END IF

if ($row5[2] == 'N')
{
    $books['book5'] = "<button type=\"submit\" name=\"book5\" value=\"btn\" class=\"btn btn--reserve\">reserve</button>";
}
else
{
    $books['book5'] = '<div class="book__reserved">reserved</div>';
}// END IF

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    $account = $_SESSION['account'];
    $cur_date = date("Y/m/d");
        
    if (!empty($_POST["book1"]))
    {
        $sql_1 = mysqli_query(
            $db,
            "INSERT INTO Reservations (book_ISBN, user_name, reserved_date)
             VALUES ('$row1[3]', '$account', '$cur_date')"
        );

        $sql_2 = mysqli_query(
            $db,
            "UPDATE Books
             SET book_reserved='Y'
             WHERE book_isbn='$row1[3]';"
        );

        $books['book1'] = '<div class="book__reserved">reserved</div>';
    }// END INNER IF

    if (!empty($_POST["book2"]))
    {
        $sql_1 = mysqli_query(
            $db,
            "INSERT INTO Reservations (book_ISBN, user_name, reserved_date)
             VALUES ('$row2[3]', '$account', '$cur_date')"
        );

        $sql_2 = mysqli_query(
            $db,
            "UPDATE Books
             SET book_reserved='Y'
             WHERE book_isbn='$row2[3]';"
        );

        $books['book2'] = '<div class="book__reserved">reserved</div>';
    }// END INNER IF

    if (!empty($_POST["book3"]))
    {
        $sql_1 = mysqli_query(
            $db,
            "INSERT INTO Reservations (book_ISBN, user_name, reserved_date)
             VALUES ('$row3[3]', '$account', '$cur_date')"
        );

        $sql_2 = mysqli_query(
            $db,
            "UPDATE Books
             SET book_reserved='Y'
             WHERE book_isbn='$row3[3]';"
        );

        $books['book3'] = '<div class="book__reserved">reserved</div>';
    }// END INNER IF

    if (!empty($_POST["book4"]))
    {
        $sql_1 = mysqli_query(
            $db,
            "INSERT INTO Reservations (book_ISBN, user_name, reserved_date)
             VALUES ('$row4[3]', '$account', '$cur_date')"
        );

        $sql_2 = mysqli_query(
            $db,
            "UPDATE Books
             SET book_reserved='Y'
             WHERE book_isbn='$row4[3]';"
        );

        $books['book4'] = '<div class="book__reserved">reserved</div>';
    }// END INNER IF

    if (!empty($_POST["book5"]))
    {
        $sql_1 = mysqli_query(
            $db,
            "INSERT INTO Reservations (book_ISBN, user_name, reserved_date)
             VALUES ('$row5[3]', '$account', '$cur_date')"
        );

        $sql_2 = mysqli_query(
            $db,
            "UPDATE Books
             SET book_reserved='Y'
             WHERE book_isbn='$row5[3]';"
        );

        $books['book5'] = '<div class="book__reserved">reserved</div>';
        header("Location: home.php");
        return;
    }// END INNER IF
}// END IF
?>
</head>
<body>
    <?php 
    $active = 'home';
    require('nav.php');
    ?>
    <main class="main">
        <div class="main__content">
            <?php
            $action = htmlspecialchars($_SERVER["PHP_SELF"]);

            $i = 0;

            $search = htmlentities($_POST['search']);        

            $result = mysqli_query(
                $db,
                "SELECT book_title, book_author, book_reserved, book_isbn 
                 FROM Books
                 WHERE book_title LIKE '%$search%' OR book_author LIKE '%$search%';"
            );

            while ($row = mysqli_fetch_row($result))
            {
                $name = 'book' . ($i + 1);

                echo "<div class=\"book\">";
                echo "<h3 class=\"book__title\">$row[0]</h4>";
                echo "<h4 class=\"book__author\">By $row[1]</h4>";
                echo "<form method=\"POST\" action=\"$action\" class=\"book__reserve\">";
                echo $books[$name];
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
