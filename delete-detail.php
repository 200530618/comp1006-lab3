<?php
// no html required as this is an invisible page
// it deletes the post then redirects to the updated feed

// identify which post to remove. use $_GET to read the url param called "postId"
$clubId = $_GET['clubId'];

// connect to db
$db = new PDO('mysql:host=172.31.22.43;dbname=Sourabh200530618', 'Sourabh200530618', 'g63Y7ckiXQ');

// create SQL delete statement
$sql = "DELETE FROM clubs WHERE clubId = :clubId";
$cmd = $db->prepare($sql);

// populate the SQL delete with the selected postId
$cmd->bindParam(':clubId', $clubId, PDO::PARAM_INT);

// execute delete in the database
$cmd->execute();

// disconnect 
$db = null;

// redirect to updated feed
//echo 'Deleted';
header('location:details.php');
?>