<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Detail</title>
</head>
<body>
   
    <main>
        <?php 
        // get the postId from the url parameter using $_GET
        $clubId = $_GET['clubId'];
        if (empty($clubId)) {
            header('location:404.php');
            exit();
        }

        // connect - we can re-use for the 2nd query later
        $db = new PDO('mysql:host=172.31.22.43;dbname=Sourabh200530618', 'Sourabh200530618', 'g63Y7ckiXQ');

        // set up & run SQL query to fetch the selected post record.  fetch for 1 record only
        $sql = "SELECT * FROM clubs WHERE clubId = :clubId";
        $cmd = $db->prepare($sql);
        $cmd->bindParam(':clubId', $clubId, PDO::PARAM_INT);
        $cmd->execute();
        $club = $cmd->fetch();

        // check query returned a valid post record
        if (empty($club)) {
            header('location:404.php');
            exit();
        }

        ?>
        <h1>Post Details</h1>
        <form action="update-detail.php" method="post">
            <fieldset>
                <label for="clubName">Club Name:</label>
                <input name="clubName" id="clubName" required maxlength="50" value="<?php echo $club['clubName']; ?>">

            </fieldset>
            <fieldset>
                <label for="ground">Ground:</label>
                <input name="ground" id="ground" value="<?php echo $club['ground']; ?>">
                    <?php
                    // use SELECT to fetch the users
                    $sql = "SELECT * FROM clubs";

                    // run the query
                    $cmd = $db->prepare($sql);
                    $cmd->execute();
                    $clubs = $cmd->fetchAll();

                  

                    // disconnect
                    $db = null;
                    ?>
                </input>
            </fieldset>
           
            <button class="btnOffset">Update</button>
            <input name="clubId" id="clubId" value="<?php echo $clubId; ?>" type="hidden" />
        </form>
    </main>
</body>
</html>