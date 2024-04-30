<?php
include('connection.php');

// Check if financial_info_id is set and is a valid integer
if (isset($_REQUEST['FeedbackID']) && is_numeric($_REQUEST['FeedbackID'])) {
    $pid = $_REQUEST['FeedbackID'];
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
    $stmt = $connection->prepare("DELETE FROM feedbackandreviews WHERE FeedbackID=?");
    $stmt->bind_param("i", $pid);
    if ($stmt->execute()) {
        echo "Record deleted successfully.<br><br>";
        echo "<a href='feedbackandreviews.php'>OK</a>";
    } else {
        echo "Error deleting data: " . $stmt->error;
    }
    ?>
</body>
</html>
<?php

    $stmt->close();
} else {
    echo "Invalid or missing ConsultantID.";
}

$connection->close();
?>
