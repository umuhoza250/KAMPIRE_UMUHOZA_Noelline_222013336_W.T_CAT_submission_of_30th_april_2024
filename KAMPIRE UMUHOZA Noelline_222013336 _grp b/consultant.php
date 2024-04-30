<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Linking to external stylesheet -->
  <link rel="stylesheet" type="text/css" href="style.css" title="style 1" media="screen, tv, projection, handheld, print">
  <!-- Defining character encoding -->
  <meta charset="utf-8">
  <!-- Setting viewport for responsive design -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Consultant Page</title>
  <style>
    /* Normal link */
    a {
      padding: 10px;
      color: white;
      background-color: pink;
      text-decoration: none;
      margin-right: 15px;
    }

    /* Visited link */
    a:visited {
      color: purple;
    }

    /* Unvisited link */
    a:link {
      color: brown;
    }

    /* Hover effect */
    a:hover {
      background-color: white;
    }

    /* Active link */
    a:active {
      background-color: red;
    }

    /* Extend margin left for search button */
    button.btn {
      margin-left: 15px;
      margin-top: 4px;
    }

    /* Extend margin left for search button */
    input.form-control {
      margin-left: 15px;
      padding: 8px;
    }
  </style>
  <!-- JavaScript validation and content load for insert data-->
        <script>
            function confirmInsert() {
                return confirm('Are you sure you want to insert this record?');
            }
        </script>
</head>
<body style="background-image: url('./Images/1.jpg');background-repeat: no-repeat;background-size:cover;">
  <form class="d-flex" role="search" action="search.php">
      <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search"name="query">
      <button class="btn btn-outline-success" type="submit">Search</button>
    </form>
  <ul style="list-style-type: none; padding: 0;">
    <li style="display: inline; margin-right: 10px;">
    <img src="./Images/2.png" width="90" height="60" alt="Logo">
  </li>
  <li style="display: inline; margin-right: 10px;"><a href="./home.html">HOME</a>
    <li style="display: inline; margin-right: 10px;"><a href="./ABOUT US.html">ABOUT US</a>
      <li style="display: inline; margin-right: 10px;"><a href="./CONTACT US.html">CONTACT US</a>
    <li style="display: inline; margin-right: 10px;"><a href="./client.php">CLIENT</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./consultant.php">CONSULTANT</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./consultationsession.php">CONSULTANT-SESSION</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./businessexperts.php">BUSINESS-EXPERTS</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./communicationlogs.php">COMMUNICATION-LOGS</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./feedbackandreviews.php">FEEDBACK&REVIEWS</a>
  </li>
    <li class="dropdown" style="display: inline; margin-right: 10px;">
      <a href="#" style="padding: 10px; color:darkgreen; background-color: darkblue; text-decoration: none; margin-right: 15px;">Settings</a>
      <div class="dropdown-contents">
        <!-- Links inside the dropdown menu -->
        <a href="login.html">Change Acount</a>
        <a href="logout.php">Logout</a>
      </div>
    </li><br><br>
    
    
</header>

<section>
  <h1>Consultant Page</h1>
  <form method="post" onsubmit="return confirmInsert();">
    <label for="ConsultantID">ID:</label>
    <input type="number" id="ConsultantID" name="ConsultantID" required><br><br>

    <label for="Name">Name:</label>
    <input type="text" id="Name" name="Name" required><br><br>

    <label for="ContactInformation">Contact Information:</label>
    <input type="text" id="ContactInformation" name="ContactInformation" required><br><br>

    <label for="Expertise">Expertise:</label>
    <input type="text" id="Expertise" name="Expertise" required><br><br>

    <label for="ConsultingHistory">Consulting History:</label>
    <input type="text" id="ConsultingHistory" name="ConsultingHistory" required><br><br>

    <input type="submit" name="Add" value="Insert"><br><br>
  </form>
<a href="home.html">go to home</a>
  <?php
  include('connection.php');

    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Prepare and bind parameters with appropriate data types
        $stmt = $connection->prepare("INSERT INTO consultant (ConsultantID, Name, ContactInformation, Expertise, ConsultingHistory) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("issss", $ConsultantID, $Name, $ContactInformation, $Expertise, $ConsultingHistory);

        // Set parameters from POST data with validation (optional)
        $ConsultantID = intval($_POST['ConsultantID']); // Ensure integer for ID
        $Name = $_POST['Name']; 
        $ContactInformation = $_POST['ContactInformation']; 
        $Expertise = $_POST['Expertise']; 
        $ConsultingHistory = $_POST['ConsultingHistory']; 

        // Execute prepared statement with error handling
        if ($stmt->execute()) {
            echo "New record has been added successfully!";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    }

    $connection->close();
  ?>

  <h2 style="text-align: center;"> consultant </h2>
  <table border="1">
    <tr>
      <th>ConsultantID</th>
      <th>Name</th>
      <th>Contact Information</th>
      <th>Expertise</th>
      <th>Consulting History</th>
      <th>Delete</th>
      <th>Update</th>
    </tr>
    <?php
    // Establish a new connection
    $connection = new mysqli($host, $user, $pass, $database);

    // Check if connection was successful
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }

    // Prepare SQL query to retrieve all consultants
    $sql = "SELECT * FROM consultant";
    $result = $connection->query($sql);

    // Check if there are any consultants
    if ($result->num_rows > 0) {
        // Output data for each row
        while ($row = $result->fetch_assoc()) {
            $ConsultantID = $row['ConsultantID']; 
            echo "<tr>
                <td>" . $row['ConsultantID'] . "</td>
                <td>" . $row['Name'] . "</td>
                <td>" . $row['ContactInformation'] . "</td>
                <td>" . $row['Expertise'] . "</td>
                <td>" . $row['ConsultingHistory'] . "</td>
                <td><a style='padding: 4px;' href='delete_consultant.php?ConsultantID=$ConsultantID'>Delete</a></td> 
                <td><a style='padding: 4px;' href='update_consultant.php?ConsultantID=$ConsultantID'>Update</a></td> 
              </tr>";
        }
    } else {
        echo "<tr><td colspan='7'>No data found</td></tr>";
    }
    // Close the database connection
    $connection->close();
    ?>
  </table>
</section>

<footer>
  <center> 
    <b><h2>UR CBE BIT &copy; 2024 &reg; Designed by: K Noelline</h2></b>
  </center>
</footer>
</body>
</html>
