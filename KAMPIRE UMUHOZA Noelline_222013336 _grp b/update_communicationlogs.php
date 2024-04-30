<?php
include('connection.php'); 

if(isset($_REQUEST['LogID'])) {
    $LogID = $_REQUEST['LogID'];
    
    $stmt = $connection->prepare("SELECT * FROM communicationlogs WHERE LogID=?");
    $stmt->bind_param("i", $LogID);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $X = $row['LogID'];
        $Y = $row['SessionID'];
        $Z = $row['Participant'];
        $W = $row['InteractionDetails'];
        $N = $row['Time'];
    } else {
        echo "communicationlogs not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update communicationlogs</title>
 <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>

<html>
<body>
    <form method="POST"onsubmit="return confirmUpdate();">
        <label for="LogID">LogID:</label>
        <input type="number" id="LogID" name="LogID" value="<?php echo isset($X) ? $X : ''; ?>">
        <br><br>

        <label for="SessionID">SessionID:</label>
        <input type="number" id="SessionID" name="SessionID" value="<?php echo isset($Y) ? $Y : ''; ?>">
        <br><br>
       
        <label for="Participant">Participant:</label>
        <input type="text" id="Participant" name="Participant" value="<?php echo isset($Z) ? $Z : ''; ?>">
        <br><br>

        <label for="InteractionDetails">InteractionDetails:</label>
        <input type="text" id="InteractionDetails" name="InteractionDetails" value="<?php echo isset($W) ? $W : ''; ?>">
        <br><br>

        <label for="Time">Time:</label>
        <input type="time" id="Time" name="Time" value="<?php echo isset($N) ? $N : ''; ?>">
        <br><br>

        <input type="submit" name="up" value="Update">
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $LogID = $_POST['LogID'];
    $SessionID = $_POST['SessionID'];
    $Participant = $_POST['Participant'];
    $InteractionDetails = $_POST['InteractionDetails'];
    $Time = $_POST['Time'];
 
    // Update the communicationlogs in the database
    $stmt = $connection->prepare("UPDATE communicationlogs SET LogID=?, SessionID=?, Participant=?, InteractionDetails=?, Time=? WHERE LogID=?");
    $stmt->bind_param("ssssis", $LogID, $SessionID, $Participant, $InteractionDetails, $Time, $LogID);
    $stmt->execute();
    
    // Redirect to communicationlogs.php
    header('Location: communicationlogs.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
