<?php
include('connection.php');
// Check if LogID is set
if (isset($_REQUEST['LogID'])) {
    $LogID = $_REQUEST['LogID'];
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
    $stmt = $connection->prepare("DELETE FROM communicationlogs WHERE LogID=?");
    $stmt->bind_param("i", $LogID);
    
    if ($stmt->execute()) {
        echo "Record deleted successfully.<br><br>";
        echo "<a href='communicationlogs.php'>OK</a>"; // Corrected the echo statement
    } else {
        echo "Error deleting data: " . $stmt->error;
    }
    ?>
</body>
</html>
<?php

    $stmt->close();
} else {
    echo "LogID is not set.";
}

$connection->close();
?>
