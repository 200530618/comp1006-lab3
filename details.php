<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deatails</title>
    <script src="js/script.js" defer></script>
</head>

<body>
    <main>
        <h1>Details</h1>
        <?php
        //connect to database
        $db = new PDO('mysql:host=172.31.22.43;dbname=Sourabh200530618', 'Sourabh200530618', 'g63Y7ckiXQ');

        //set up the SQL SELECT command
        $sql = "SELECT * FROM clubs ORDER BY clubId ";

        //execute the select query
        $cmd = $db->prepare($sql);
        $cmd->execute();

        //store the query results in an array. Use fetchall for multiple records, fetch for 1.
        $clubs = $cmd->fetchAll();

       

        //display the post data in a loop. $posts = all data, $post = the current item in the loop
        foreach ($clubs as $club) {
            echo '<article>

            <h2>' . $club['clubId'] . '</h2>

            <p>' . $club['clubName'] . '</p>

            <p>' . $club['ground'] . '</p>
        
            <a href="edit-detail.php?clubId=' . $club['clubId'] .'">Edit</a>
            <a onclick="return confirmDelete();" href="delete-detail.php?clubId=' . $club['clubId'] .'">Delete</a>



        </article>';
            
        }

       
        

        //disconnect
        $db = null;

        ?>
    </main>

</body>

</html>