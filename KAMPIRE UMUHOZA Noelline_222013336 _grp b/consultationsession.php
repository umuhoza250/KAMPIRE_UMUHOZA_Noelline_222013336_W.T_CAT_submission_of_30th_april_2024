<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Home Page</title>
  <link rel="stylesheet" type="text/css" href="style.css" title="style 1" media="screen, tv, projection, handheld, print"/>
  <style>
    /* Normal link */
    a {
      padding: 5px;
      color: white;
      background-color: pink;
      text-decoration: none;
      margin-right: 15px;
    }

    /* Visited link */
    a:visited {
      color: purple;
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
  <h1>consultationsession form</h1>
  <form method="post"onsubmit="return confirmInsert();">
    <label for="SessionID">SessionID:</label>
    <input type="number" id="SessionID" name="SessionID"><br><br>

    <label for="ClientID">ClientID:</label>
    <input type="number" id="ClientID" name="ClientID" required><br><br>

    <label for="ConsultantID">ConsultantID:</label>
    <input type="number" id="ConsultantID" name="ConsultantID" required><br><br>

    <label for="DateAndTime">DateAndTime:</label>
    <input type="date" id="DateAndTime" name="DateAndTime" required><br><br>

    <label for="Duration">Duration:</label>
    <input type="time" id="Duration" name="Duration" required><br><br>
    
    <label for="Agenda">Agenda:</label>
    <input type="text" id="Agenda" name="Agenda" required><br><br>

    <label for="Outcome">Outcome:</label>
    <input type="text" id="Outcome" name="Outcome" required><br><br>

    <input type="submit" value="Insert">
  </form>

  <?php
include('connection.php');

  // Check if the form is submitted
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
      // Prepare and bind parameters with appropriate data types
      $stmt = $connection->prepare("INSERT INTO consultationsession (SessionID, ConsultantID, ClientID, DateAndTime, Duration, Agenda, Outcome) VALUES (?, ?, ?, ?, ?, ?, ?)");
      $stmt->bind_param("iiisiss", $SessionID, $ConsultantID, $ClientID, $DateAndTime, $Duration, $Agenda, $Outcome);

      // Set parameters from POST data with validation (optional)
      $SessionID = intval($_POST['SessionID']); // Ensure integer for ID
      $ConsultantID = intval($_POST['ConsultantID']); 
      $ClientID = intval($_POST['ClientID']);
      $DateAndTime = $_POST['DateAndTime'];
      $Duration = intval($_POST['Duration']);
      $Agenda = $_POST['Agenda'];
      $Outcome = $_POST['Outcome'];

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

  <center><h2>consultationsession</h2></center>
  <table border="1">
    <tr>
      <th>SessionID</th>
      <th>ConsultantID</th>
      <th>ClientID</th>
      <th>DateAndTime</th>
      <th>Duration</th>
      <th>Agenda</th>
      <th>Outcome</th>
      <th>update</th>
      <th>delete</th>
    </tr>
    <?php
    // Establish a new connection
    $connection = new mysqli($host, $user, $pass, $database);

    // Check if connection was successful
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }

    // Prepare SQL query to retrieve all products
    $sql = "SELECT * FROM consultationsession";
    $result = $connection->query($sql);

    // Check if there are any products
    if ($result->num_rows > 0) {
        // Output data for each row
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                  <td>" . $row['SessionID'] . "</td>
                  <td>" . $row['ConsultantID'] . "</td>
                  <td>" . $row['ClientID'] . "</td>
                  <td>" . $row['DateAndTime'] . "</td>
                  <td>" . $row['Duration'] . "</td>
                  <td>" . $row['Agenda'] . "</td>
                  <td>" . $row['Outcome'] . "</td>
                  <td><a href='update_consultationsession.php?updateSessionID=". $row['SessionID']."'>UPDATE</a></td><td><a href='delete_consultationsession.php?deleteSessionID=". $row['SessionID']."'>DELETE</a></td>
                </tr>";
        }
    } else {
        echo "<tr><td colspan='9'>No data found</td></tr>";
    }
    // Close the database connection
    $connection->close();
    ?>
  </table>
</section>

<footer>
  <center> 
    <b><h2>UR CBE BIT &copy, 2024 & reg, Designed by: K Noelline</h2></b>
  </center>
</footer>
</body>
</html>
