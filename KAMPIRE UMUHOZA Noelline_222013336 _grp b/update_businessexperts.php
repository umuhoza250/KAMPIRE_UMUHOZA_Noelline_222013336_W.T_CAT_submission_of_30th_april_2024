<?php
include('connection.php'); 

if(isset($_REQUEST['ExpertID'])) {
    $applid = $_REQUEST['ExpertID'];
    
    $stmt = $connection->prepare("SELECT * FROM businessexperts WHERE ExpertID=?");
    $stmt->bind_param("i", $applid);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $X = $row['ExpertID'];
        $Y = $row['Name'];
        $Z = $row['ContactInformation'];
        $W = $row['AreaOfExpertise'];
        $N = $row['ConsultingHistory'];
       
    } else {
        echo "Expert not found.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Update businessexperts</title>
 <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
    <form method="POST"onsubmit="return confirmUpdate();">
        <label for="ExpertID">Expert ID:</label>
        <input type="number" id="ExpertID" name="ExpertID" value="<?php echo isset($X) ? $X : ''; ?>">
        <br><br>

        <label for="Name">Name:</label>
        <input type="text" id="Name" name="Name" value="<?php echo isset($Y) ? $Y : ''; ?>">
        <br><br>
       
        <label for="ContactInformation">Contact Information:</label>
        <input type="text" id="ContactInformation" name="ContactInformation" value="<?php echo isset($Z) ? $Z : ''; ?>">
        <br><br>

        <label for="AreaOfExpertise">Area of Expertise:</label>
        <input type="text" id="AreaOfExpertise" name="AreaOfExpertise" value="<?php echo isset($W) ? $W : ''; ?>">
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
    $ExpertID = $_POST['ExpertID'];
    $Name = $_POST['Name'];
    $ContactInformation = $_POST['ContactInformation'];
    $AreaOfExpertise = $_POST['AreaOfExpertise'];
    $ConsultingHistory = $_POST['ConsultingHistory'];
 
    // Update the expert information in the database
    $stmt = $connection->prepare("UPDATE businessexperts SET Name=?, ContactInformation=?, AreaOfExpertise=?, ConsultingHistory=? WHERE ExpertID=?");
    $stmt->bind_param("ssssi", $Name, $ContactInformation, $AreaOfExpertise, $ConsultingHistory, $ExpertID);
    $stmt->execute();
    
    // Redirect to businessexperts.php
    header('Location: businessexperts.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
