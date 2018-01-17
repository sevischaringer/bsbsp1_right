<!DOCTYPE HTML>
<!-- Severin Scharinger, 10.01.2018
        Übung zu ERM, MYSQL, PHP Teil3
-->
<html>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <title>Teil 3 - PHP</title>
</head>
<body>
<div class="container">
<nav>
    <?php
    include 'nav.html';
    ?>
</nav>
<main>
    <?php
    if(isset($_GET['seite']))
    {
        switch ($_GET['seite'])
        {
            case 'Startseite':
                include 'Startseite.php';
                break;
            case 'Kundensuche':
                include 'Kundensuche.php';
                break;
            default:
                include 'Startseite.php';
        }

    }
    else
    {
        include 'Startseite.php';
    }
    ?>
</main>
</div>
</body>
</html>