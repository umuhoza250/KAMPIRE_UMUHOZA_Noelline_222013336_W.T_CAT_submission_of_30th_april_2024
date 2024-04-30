<?php
include('connection.php'); 

if(isset($_REQUEST['ConsultantID'])) {
    $ConsultantID = $_REQUEST['ConsultantID'];
    
    $stmt = $connection->prepare("SELECT * FROM consultant WHERE ConsultantID=?");
    $stmt->bind_param("i", $ConsultantID);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $X = $row['ConsultantID'];
        $Y = $row['Name'];
        $Z = $row['ContactInformation'];
        $W = $row['Expertise'];
        $N = $row['ConsultingHistory'];
       
    } else {
        echo "Consultant not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update consultant</title>
 <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
    <form method="POST" onsubmit="return confirmUpdate();">
         <label for="ConsultantID">ID:</label>
         <input type="number" id="ConsultantID" name="ConsultantID" value="<?php echo isset($X) ? $X : ''; ?>">
        <br><br>

        <label for="Name">Name:</label>
        <input type="text" id="Name" name="Name" value="<?php echo isset($Y) ? $Y : ''; ?>">
        <br><br>
       
        <label for="ContactInformation">Contact Information:</label>
        <input type="text" id="ContactInformation" name="ContactInformation" value="<?php echo isset($Z) ? $Z : ''; ?>">
        <br><br>

        <label for="Expertise">Expertise:</label>
        <input type="text" id="Expertise" name="Expertise" value="<?php echo isset($W) ? $W : ''; ?>">
        <br><br>

        <label for="ConsultingHistory">Consulting History:</label>
        <input type="text" id="ConsultingHistory" name="ConsultingHistory" value="<?php echo isset($N) ? $N : ''; ?>">
        <br><br>

        <input type="submit" name="up" value="Update">
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $ConsultantID = $_POST['ConsultantID'];
    $Name = $_POST['Name'];
    $ContactInformation = $_POST['ContactInformation'];
    $Expertise = $_POST['Expertise'];
    $ConsultingHistory = $_POST['ConsultingHistory'];
 
    
    // Update the consultant_info in the database
    $stmt = $connection->prepare("UPDATE consultant SET Name=?, ContactInformation=?, Expertise=?, ConsultingHistory=? WHERE ConsultantID=?");
    $stmt->bind_param("ssssi", $Name, $ContactInformation, $Expertise, $ConsultingHistory, $ConsultantID);
    $stmt->execute();
    
    // Redirect to consultant.php
    header('Location: consultant.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
