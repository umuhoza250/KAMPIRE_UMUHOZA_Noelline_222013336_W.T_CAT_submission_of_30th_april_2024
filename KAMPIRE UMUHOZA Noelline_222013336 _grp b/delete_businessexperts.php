<?php
    include('connection.php');

    // Check if ExpertID is set
    if(isset($_REQUEST['deleteExpertID'])) {
        $ExpertID = $_REQUEST['deleteExpertID'];
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
        $stmt = $connection->prepare("DELETE FROM businessexperts WHERE ExpertID=?");
        $stmt->bind_param("i", $ExpertID);
        if ($stmt->execute()) {
            echo "Record deleted successfully.<br><br>";
            echo "<a href='businessexperts.php'>OK</a>";
        } else {
            echo "Error deleting data: " . $stmt->error;
        }
        ?>
    </body>
    </html>
    <?php


        $stmt->close();
    } else {
        echo "ExpertID is not set.";
    }

    $connection->close();
?>
