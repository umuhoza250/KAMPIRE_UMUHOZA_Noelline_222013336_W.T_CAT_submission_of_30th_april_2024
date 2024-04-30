<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Linking to external stylesheet -->
  <link rel="stylesheet" type="text/css" href="style.css" title="style 1" media="screen, tv, projection, handheld, print"/>
  <!-- Defining character encoding -->
  <meta charset="utf-8">
  <!-- Setting viewport for responsive design -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Home Page</title>
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
      color: brown; /* Changed to lowercase */
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
      margin-left: 15px; /* Adjust this value as needed */
      margin-top: 4px;
    }

    /* Extend margin left for search button */
    input.form-control {
      margin-left: 15px; /* Adjust this value as needed */
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
  <h1>Communication Logs</h1>
  <form method="post" onsubmit="return confirmInsert();">
    <label for="LogID">LogID:</label>
    <input type="number" id="LogID" name="LogID" required><br><br>

    <label for="SessionID">SessionID:</label>
    <input type="number" id="SessionID" name="SessionID" required><br><br>

    <label for="Participant">Participant:</label>
    <input type="text" id="Participant" name="Participant" required><br><br>

    <label for="InteractionDetails">InteractionDetails:</label>
    <input type="text" id="InteractionDetails" name="InteractionDetails" required><br><br>

    <label for="Time">Time:</label>
    <input type="time" id="Time" name="Time" required><br><br>

    <input type="submit" name="Add" value="Insert"><br><br>
  </form>

  <?php
   include('connection.php');

    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Prepare and bind parameters with appropriate data types
        $stmt = $connection->prepare("INSERT INTO communicationlogs (LogID, SessionID, Participant, InteractionDetails, Time) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("issss", $LogID, $SessionID, $Participant, $InteractionDetails, $Time);

        // Set parameters from POST data with validation (optional)
        $LogID = intval($_POST['LogID']); // Ensure integer for ID
        $SessionID = $_POST['SessionID']; 
        $Participant = $_POST['Participant']; 
        $InteractionDetails = $_POST['InteractionDetails']; 
        $Time = $_POST['Time']; 

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

  <h2 style="text-align: center;">Communication Logs</h2>
  <table border="1">
    <tr>
      <th>LogID</th>
      <th>SessionID</th>
      <th>Participant</th>
      <th>InteractionDetails</th>
      <th>Time</th>
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

    // Prepare SQL query to retrieve all communication logs
    $sql = "SELECT * FROM communicationlogs";
    $result = $connection->query($sql);

    // Check if there are any communication logs
    if ($result->num_rows > 0) {
        // Output data for each row
        while ($row = $result->fetch_assoc()) {
            $LogID = $row['LogID']; 
            echo "<tr>
                <td>" . $row['LogID'] . "</td>
                <td>" . $row['SessionID'] . "</td>
                <td>" . $row['Participant'] . "</td>
                <td>" . $row['InteractionDetails'] . "</td>
                <td>" . $row['Time'] . "</td>
                <td><a style='padding: 4px;' href='delete_communicationlogs.php?LogID=$LogID'>Delete</a></td> 
                <td><a style='padding: 4px;' href='update_communicationlogs.php?LogID=$LogID'>Update</a></td> 
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
