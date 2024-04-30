<?php
include('connection.php'); 

if(isset($_REQUEST['SessionID'])) {
    $SessionID = $_REQUEST['SessionID'];
    
    $stmt = $connection->prepare("SELECT * FROM consultationsession WHERE SessionID=?");
    $stmt->bind_param("i",$SessionID);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $X = $row['SessionID'];
        $Y = $row['ConsultantID'];
        $Z = $row['ClientID'];
        $W = $row['DateAndTime'];
        $N = $row['Duration'];
        $D = $row['Agenda'];
        $S = $row['Outcome'];
       
    } else {
        echo "Consultation session not found.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Update consultationsession</title>
 <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>

<html>
<body>
    <form method="POST"onsubmit="return confirmUpdate();">
        <label for="SessionID">SessionID:</label>
        <input type="number" id="SessionID" name="SessionID" value="<?php echo isset($X) ? $X : ''; ?>">
        <br><br>

        <label for="ConsultantID">ConsultantID:</label>
        <input type="number" id="ConsultantID" name="ConsultantID" value="<?php echo isset($Y) ? $Y : ''; ?>">
        <br><br>

        <label for="ClientID">ClientID:</label>
        <input type="number" id="ClientID" name="ClientID" value="<?php echo isset($Z) ? $Z : ''; ?>">
        <br><br>
       
        <label for="DateAndTime">DateAndTime:</label>
        <input type="datetime-local" id="DateAndTime" name="DateAndTime" value="<?php echo isset($W) ? $W : ''; ?>">
        <br><br>

        <label for="Duration">Duration:</label>
        <input type="text" id="Duration" name="Duration" value="<?php echo isset($N) ? $N : ''; ?>">
        <br><br>

        <label for="Agenda">Agenda:</label>
        <input type="text" id="Agenda" name="Agenda" value="<?php echo isset($D) ? $D : ''; ?>">
        <br><br>

        <label for="Outcome">Outcome:</label>
        <input type="text" id="Outcome" name="Outcome" value="<?php echo isset($S) ? $S : ''; ?>">
        <br><br>

        <input type="submit" name="submit" value="Update">
    </form>
</body>
</html>

<?php
if(isset($_POST['submit'])) {
    // Retrieve updated values from form
    $SessionID = $_POST['SessionID'];
    $ConsultantID = $_POST['ConsultantID'];
    $ClientID = $_POST['ClientID'];
    $DateAndTime = $_POST['DateAndTime'];
    $Duration = $_POST['Duration'];
    $Agenda = $_POST['Agenda'];
    $Outcome = $_POST['Outcome'];
 
    
    // Update the consultationsession in the database
    $stmt = $connection->prepare("UPDATE consultationsession SET ConsultantID=?, ClientID=?, DateAndTime=?, Duration=?, Agenda=?, Outcome=? WHERE SessionID=?");
    $stmt->bind_param("iissssi", $ConsultantID, $ClientID, $DateAndTime, $Duration, $Agenda, $Outcome, $SessionID);
    $stmt->execute();
    
    // Redirect to consultationsession.php
    header('Location: consultationsession.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
