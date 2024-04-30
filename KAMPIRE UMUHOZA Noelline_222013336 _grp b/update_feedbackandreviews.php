<?php
include('connection.php'); 

if(isset($_REQUEST['FeedbackID'])) {
    $FeedbackID = $_REQUEST['FeedbackID'];
    
    $stmt = $connection->prepare("SELECT * FROM feedbackandreviews WHERE FeedbackID=?");
    $stmt->bind_param("i", $FeedbackID);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $FeedbackID = $row['FeedbackID'];
        $SessionID = $row['SessionID'];
        $Participant = $row['Participant'];
        $Rating = $row['Rating'];
        $Comments = $row['Comments'];
        $Time = $row['Time'];
       
    } else {
        echo "FeedbackID not found.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Update feedbackandreviews</title>
 <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>

<html>
<body>
    <form method="POST"onsubmit="return confirmUpdate();">
       <label for="FeedbackID">FeedbackID:</label>
       <input type="number" id="FeedbackID" name="FeedbackID" value="<?php echo isset($FeedbackID) ? $FeedbackID : ''; ?>">
        <br><br>

        <label for="SessionID">Session ID:</label>
        <input type="number" id="SessionID" name="SessionID" value="<?php echo isset($SessionID) ? $SessionID : ''; ?>">
        <br><br>
       
        <label for="Participant">Participant:</label>
        <input type="text" id="Participant" name="Participant" value="<?php echo isset($Participant) ? $Participant : ''; ?>">
        <br><br>

        <label for="Rating">Rating:</label>
        <input type="text" id="Rating" name="Rating" value="<?php echo isset($Rating) ? $Rating : ''; ?>">
        <br><br>

        <label for="Comments">Comments:</label>
        <input type="text" id="Comments" name="Comments" value="<?php echo isset($Comments) ? $Comments : ''; ?>">
        <br><br>

        <label for="Time">Time:</label>
        <input type="time" id="Time" name="Time" value="<?php echo isset($Time) ? $Time : ''; ?>">
        <br><br>
        

        <input type="submit" name="up" value="Update">
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $FeedbackID = $_POST['FeedbackID'];
    $SessionID = $_POST['SessionID'];
    $Participant = $_POST['Participant'];
    $Rating = $_POST['Rating'];
    $Comments = $_POST['Comments'];
    $Time = $_POST['Time'];

 
    
    // Update the feedbackandreviews in the database
    $stmt = $connection->prepare("UPDATE feedbackandreviews SET SessionID=?, Participant=?, Rating=?, Comments=?, Time=? WHERE FeedbackID=?");
    $stmt->bind_param("issssi", $SessionID, $Participant, $Rating, $Comments, $Time, $FeedbackID);
    $stmt->execute();
    
    // Redirect to feedbackandreviews.php
    header('Location: feedbackandreviews.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
