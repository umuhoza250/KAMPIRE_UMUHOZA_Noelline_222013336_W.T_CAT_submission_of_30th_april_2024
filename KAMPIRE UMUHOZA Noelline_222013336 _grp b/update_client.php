<?php
include('connection.php'); 

if(isset($_REQUEST['ClientID'])) {
    $applid = $_REQUEST['ClientID'];
    
    $stmt = $connection->prepare("SELECT * FROM client WHERE ClientID=?");
    $stmt->bind_param("i", $applid);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $X = $row['ClientID'];
        $Y = $row['Name'];
        $Z = $row['ContactInformation'];
        $W = $row['BusinessName'];
        $N = $row['Location'];
        $D = $row['BusinessSize'];
        $R = $row['Goals'];
        $S = $row['Challenges'];
    } else {
        echo "client not found.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Update clients</title>
 <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>

<html>
<body>
    <form method="POST"onsubmit="return confirmUpdate();">
        <label for="cld">ClientID:</label>
        <input type="text" id="cld" name="cld" value="<?php echo isset($X) ? $X : ''; ?>">
        <br><br>

        <label for="clname">Name:</label>
        <input type="text" id="clname" name="Name" value="<?php echo isset($Y) ? $Y : ''; ?>">
        <br><br>
       
        <label for="phone">ContactInformation:</label>
        <input type="text" id="phone" name="phone" value="<?php echo isset($Z) ? $Z : ''; ?>">
        <br><br>

        <label for="BName">BusinessName:</label>
        <input type="text" id="BName" name="BName" value="<?php echo isset($W) ? $W : ''; ?>">
        <br><br>

        <label for="Loc">Location:</label>
        <input type="text" id="Loc" name="Loc" value="<?php echo isset($N) ? $N : ''; ?>">
        <br><br>

        <label for="BSize">BusinessSize:</label>
        <input type="text" id="BSize" name="BSize" value="<?php echo isset($D) ? $D : ''; ?>">
        <br><br>
        
        <label for="Goals">Goals:</label>
        <input type="text" id="Goals" name="Goals" value="<?php echo isset($R) ? $R : ''; ?>">
        <br><br>

        <label for="Challenges">Challenges:</label>
        <input type="text" id="Challenges" name="Challenges" value="<?php echo isset($S) ? $S : ''; ?>">
        <br><br>

        <input type="submit" name="up" value="Update">
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $ClientID= $_POST['cld'];
    $Name = $_POST['Name'];
    $ContactInformation = $_POST['phone'];
    $BusinessName = $_POST['BName'];
    $Location = $_POST['Loc'];
    $BusinessSize = $_POST['BSize'];
    $Goals = $_POST['Goals'];
    $Challenges = $_POST['Challenges'];
    
    // Update the applicant_info in the database
    $stmt = $connection->prepare("UPDATE client SET Name=?, ContactInformation=?, BusinessName=?, Location=?, BusinessSize=?, Goals=?, Challenges=? WHERE ClientID=?");
    $stmt->bind_param("sssssssi", $Name, $ContactInformation, $BusinessName, $Location, $BusinessSize, $Goals, $Challenges, $ClientID);
    $stmt->execute();
    
    // Redirect to client.php
    header('Location: client.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
