<!DOCTYPE html>
<!--
VillesDeleteIHM.php
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>VillesDeleteIHM</title>
    </head>
    <body>
        <h3>DELETE</h3>
        <p>VillesDeleteIHM.php</p>
        <form action="../exemples/controllers/VillesDeleteCTRL.php" method="POST">
            <label>CP </label>
            <input type="text" name="cp" value="75021" />
            <input type="submit" name="btValider"/>
        </form>
        <p>
            <label>
                <?php
                if (isSet($message)) {
                    echo $message;
                }
                ?>
            </label>
        </p>
    </body>
</html>