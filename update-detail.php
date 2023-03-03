<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Updating your Detail...</title>
</head>
<body>
    <header>
       
    <main>
        <?php
        // capture the form body input using the $_POST array & store in a var
        $clubName = $_POST['clubName'];
        $ground = $_POST['ground'];
        $clubId = $_POST['clubId']; // hidden input w/PK

      
     
        

        // lesson 4 - add validation before saving. Check 1 at a time for descriptive errors.
        $ok = true;  // start with no validation errors

        if (empty($clubName)) {
            echo '<p class="error">Club Name is required.</p>';
            $ok = false; // error happened - bad data
        }

        if (empty($ground)) {
            echo '<p class="error">Ground is required.</p>';
            $ok = false; // error happened - bad data
        }

        // only save to db if $ok has never been changed to false
        if ($ok == true) {
            // connect to the db using the PDO library
            $db = new PDO('mysql:host=172.31.22.43;dbname=Sourabh200530618', 'Sourabh200530618', 'g63Y7ckiXQ');
            /*if ($db) {
            echo 'Connected';
        }
        else {
            echo 'Connection Failed';
        }*/

            // set up an SQL UPDATE.  We MUST HAVE A WHERE CLAUSE
            $sql = "UPDATE clubs SET clubName = :clubName, ground = :ground
            WHERE clubId = :clubId";

            // map each input to the corresponding db column
            $cmd = $db->prepare($sql);
            $cmd->bindParam(':clubName', $clubName, PDO::PARAM_STR, 50);
            $cmd->bindParam(':ground', $ground, PDO::PARAM_STR, 50);

            $cmd->bindParam(':clubId', $clubId, PDO::PARAM_INT);

            // execute the insert
            $cmd->execute();

            // disconnect
            $db = null;

            // show the user a message
            echo '<h1>Club Updated</h1>
                <p><a href="details.php">See the updated feed</a></p>';
        }
        ?>
    </main>
</body>
</html>