<?php
   include('connection.php');
// Check if Product_Id is set
if(isset($_REQUEST['ClientID'])) {
    $cid = $_REQUEST['ClientID'];
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Delete Record</title>
        <script>
            function confirmDelete() {
                return confirm("Are you sure you want to delete this record?");
            }
        </script>
    </head>
    <body>
        <form method="post" onsubmit="return confirmDelete();">
            <input type="hidden" name="pid" value="<?php echo $pid; ?>">
            <input type="submit" value="Delete">
        </form>
    <?php  
    
    // Prepare and execute the DELETE statement
    $stmt = $connection->prepare("DELETE FROM client WHERE ClientID=?");
    $stmt->bind_param("i",$cid);
    if ($stmt->execute()) {
        echo "Record deleted successfully.<br><br>echo 
             <a href='client.php'>OK</a>";
    } else {
        echo "Error deleting data: " . $stmt->error;
    }
?>
</body>
</html>
<?php  
    $stmt->close();
} else {
    echo "ClientID is not set.";
}

$connection->close();
?>
