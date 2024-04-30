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
        </script
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
  <h1>client</h1>
  <form method="post"onsubmit="return confirmInsert();">

    <label for="cld">ClientID:</label>
    <input type="text" id="cld" name="cld" required><br><br>

    <label for="clname">Name:</label>
    <input type="text" name="clname" required><br><br>

    <label for="phone">ContactInformation:</label>
    <input type="text" id="phone" name="phone" required><br><br>

    <label for="BName">BusinessName:</label>
    <input type="text" id="BName" name="BName" required><br><br>

    <label for="Loc">Location:</label>
    <input type="text" id="Loc" name="Loc" required><br><br>

    <label for="BSize">BusinessSize:</label>
    <input type="text" id="BSize" name="BSize" required><br><br>

    <label for="Goals">Goals:</label>
    <input type="text" id="Goals" name="Goals" required><br><br>

    <label for="Challenges">Challenges:</label>
    <input type="text" id="Challenges" name="Challenges" required><br><br>

    <input type="submit" name="Add" value="Insert"><br><br>

  </form>

  <?php
   include('connection.php');

    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Prepare and bind parameters with appropriate data types
        $stmt = $connection->prepare("INSERT INTO client (ClientID, Name, ContactInformation, BusinessName, Location, BusinessSize, Goals, Challenges) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("isssssss", $ClientID, $Name, $ContactInformation, $BusinessName, $Location, $BusinessSize, $Goals, $Challenges);

        // Set parameters from POST data with validation (optional)
        $ClientID = intval($_POST['cld']); 
        $Name = $_POST['clname']; 
        $ContactInformation = $_POST['phone']; 
        $BusinessName = $_POST['BName']; 
        $Location = $_POST['Loc']; 
        $BusinessSize = $_POST['BSize'];
        $Goals = $_POST['Goals']; 
        $Challenges = $_POST['Challenges']; 

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

  <h2 style="text-align: center;">Client Table</h2>
  <table border="1">
    <tr>
      <th>ClientID</th>
      <th>Name</th>
      <th>ContactInformation</th>
      <th>BusinessName</th>
      <th>Location</th>
      <th>BusinessSize</th>
      <th>Goals</th>
      <th>Challenges</th>
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

    // Prepare SQL query to retrieve all clients
    $sql = "SELECT * FROM client";
    $result = $connection->query($sql);

    // Check if there are any clients
    if ($result->num_rows > 0) {
        // Output data for each row
        while ($row = $result->fetch_assoc()) {
            $Cid = $row['ClientID']; 
            echo "<tr>
                  <td>" . $row['ClientID'] . "</td>
                  <td>" . $row['Name'] . "</td>
                  <td>" . $row['ContactInformation'] . "</td>
                  <td>" . $row['BusinessName'] . "</td>
                  <td>" . $row['Location'] . "</td>
                  <td>" . $row['BusinessSize'] . "</td>
                  <td>" . $row['Goals'] . "</td>
                  <td>" . $row['Challenges'] . "</td>
                  <td><a style='padding: 4px;' href='delete_client.php?ClientID=$Cid'>Delete</a></td> 
                  <td><a style='padding: 4px;' href='update_client.php?ClientID=$Cid'>Update</a></td> 
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
    <b><h2>UR CBE BIT &copy, 2024 & reg, Designer by: K Noelline</h2></b>
  </center>
</footer>
</body>
</html>
