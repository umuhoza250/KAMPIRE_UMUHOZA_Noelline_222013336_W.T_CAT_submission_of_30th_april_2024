<?php
    include('connection.php');

    // Check if SessionID is set
    if(isset($_REQUEST['deleteSessionID'])) {
        $SessionID = $_REQUEST['deleteSessionID'];
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
        $stmt = $connection->prepare("DELETE FROM consultationsession WHERE SessionID=?");
        $stmt->bind_param("i", $SessionID);
        if ($stmt->execute()) {
            echo "Record deleted successfully.<br><br>";
            echo "<a href='consultationsession.php'>OK</a>";
        } else {
            echo "Error deleting data: " . $stmt->error;
        }
        ?>
    </body>
    </html>
    <?php

        $stmt->close();
    } else {
        echo "SessionID is not set.";
    }

    $connection->close();
?>
