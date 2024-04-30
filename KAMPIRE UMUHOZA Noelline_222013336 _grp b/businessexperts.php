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
      padding: px;
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
      <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="query">
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
  <h1>Business Expert Form</h1>
  <form method="post"onsubmit="return confirmInsert();">
    <label for="expert_id">Expert ID:</label>
    <input type="number" id="expert_id" name="ExpertID"><br><br>

    <label for="Name">Name:</label>
    <input type="text" id="Name" name="Name" required><br><br>

    <label for="contact_information">Contact Information:</label>
    <input type="text" id="contact_information" name="ContactInformation" required><br><br>

    <label for="area_of_expertise">Area of Expertise:</label>
    <input type="text" id="area_of_expertise" name="AreaOfExpertise" required><br><br>

    <label for="consulting_history">Consulting History:</label>
    <input type="text" id="consulting_history" name="ConsultingHistory" required><br><br>

    <input type="submit" value="Insert">
  </form>

  <?php
 include('connection.php');

  // Check if the form is submitted
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
      // Prepare and bind parameters with appropriate data types
      $stmt = $connection->prepare("INSERT INTO businessexperts (ExpertID, Name, ContactInformation, AreaOfExpertise, ConsultingHistory) VALUES (?, ?, ?, ?, ?)");
      $stmt->bind_param("sssss", $ExpertID, $Name, $ContactInformation, $AreaOfExpertise, $ConsultingHistory);

      // Set parameters from POST data with validation (optional)
      $ExpertID = intval($_POST['ExpertID']); // Ensure integer for ID
      $Name = htmlspecialchars($_POST['Name']); // Prevent XSS
      $ContactInformation = htmlspecialchars($_POST['ContactInformation']); // Sanitize phone number
      $AreaOfExpertise = htmlspecialchars($_POST['AreaOfExpertise']); // Sanitize area of expertise
      $ConsultingHistory = htmlspecialchars($_POST['ConsultingHistory']); // Sanitize consulting history

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

  <center><h2>Table of BUSINESS_EXPERT</h2></center>
  <table border="5">
    <tr>
      <th>ExpertID</th>
      <th>Name</th>
      <th>ContactInformation</th>
      <th>AreaOfExpertise</th>
      <th>ConsultingHistory</th>
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
    $sql = "SELECT * FROM businessexperts";
    $result = $connection->query($sql);

    // Check if there are any products
    if ($result->num_rows > 0) {
        // Output data for each row
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                  <td>" . $row['ExpertID'] . "</td>
                  <td>" . $row['Name'] . "</td>
                  <td>" . $row['ContactInformation'] . "</td>
                  <td>" . $row['AreaOfExpertise'] . "</td>
                  <td>" . $row['ConsultingHistory'] . "</td>
                  <td><a href='update_businessexperts.php?updateExpertID=". $row['ExpertID']."'>UPDATE</a></td><td><a href='delete_businessexperts.php?deleteExpertID=". $row['ExpertID']."'>DELETE
                </tr>";
        }
    } else {
        echo "<tr><td colspan='5'>No data found</td></tr>";
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
