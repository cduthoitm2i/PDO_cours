<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>VillesDeleteIHMWithList</title>
    </head>
    <body>
        <h3>DELETE</h3>
        <p>VillesDeleteIHMWithList.php</p>
        <form action="../controllers/VillesDeleteCTRLWithList.php" method="post">
            <label>CP ? </label>
            <select name="cp">
                <?php
                echo $options;
                ?>
            </select>
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