<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Home Page</title>
  <link rel="stylesheet" type="text/css" href="style.css" title="style 1" media="screen, tv, projection, handheld, print">
  <style>
    /* General styles */
    body {
      background-image: url('./Images/1.jpg');
      background-repeat: no-repeat;
      background-size: cover;
    }
    a {
      padding: 10px;
      color: white;
      background-color: pink;
      text-decoration: none;
      margin-right: 15px;
    }
    a:visited {
      color: purple;
    }
    a:link {
      color: brown; 
    }
    a:hover {
      background-color: white;
    }
    a:active {
      background-color: red;
    }
    button.btn {
      margin-left: 15px;
      margin-top: 4px;
    }
    input.form-control {
      margin-left: 15px;
      padding: 8px;
    }
    /* Dropdown */
    .dropdown a {
      padding: 10px;
      color: darkgreen;
      background-color: darkblue;
      text-decoration: none;
      margin-right: 15px;
    }
    .dropdown-contents {
      display: none;
      position: absolute;
      background-color: #f9f9f9;
      min-width: 160px;
      box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
      z-index: 1;
    }
    .dropdown:hover .dropdown-contents {
      display: block;
    }
  </style>
  <!-- JavaScript validation and content load for insert data-->
        <script>
            function confirmInsert() {
                return confirm('Are you sure you want to insert this record?');
            }
        </script>
</head>
<body>
  <header>
    <form class="d-flex" role="search" action="search.php">
      <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search"name="query">
      <button class="btn btn-outline-success" type="submit">Search</button>
    </form>
    <ul style="list-style-type: none; padding: 0;">
      <li style="display: inline; margin-right: 10px;">
        <img src="./Images/2.png" width="90" height="60" alt="Logo">
      </li>
      <li style="display: inline; margin-right: 10px;"><a href="./HOME.html">HOME</a></li>
      <li style="display: inline; margin-right: 10px;"><a href="./ABOUT US.html">ABOUT US</a></li>
      <li style="display: inline; margin-right: 10px;"><a href="./CONTACT US.html">CONTACT US</a></li>
      <li style="display: inline; margin-right: 10px;"><a href="./client.php">CLIENT</a></li>
      <li style="display: inline; margin-right: 10px;"><a href="./consultant.php">CONSULTANT</a></li>
      <li style="display: inline; margin-right: 10px;"><a href="./consultationsession.php">CONSULTANT-SESSION</a></li>
      <li style="display: inline; margin-right: 10px;"><a href="./businessexperts.php">BUSINESS-EXPERTS</a></li>
      <li style="display: inline; margin-right: 10px;"><a href="./communicationlogs.php">COMMUNICATION-LOGS</a></li>
      <li style="display: inline; margin-right: 10px;"><a href="./feedbackandreviews.php">FEEDBACK&amp;REVIEWS</a></li>
      <li class="dropdown" style="display: inline; margin-right: 10px;">
        <a href="#">Settings</a>
        <div class="dropdown-contents">
          <a href="login.html">Change Account</a>
          <a href="logout.php">Logout</a>
        </div>
      </li>
    </ul>
  </header>

  <section>
    <h1>feedbackandreviews</h1>
    <form method="post"onsubmit="return confirmInsert();">
      <label for="FeedbackID">FeedbackID:</label>
      <input type="number" id="FeedbackID" name="FeedbackID" required><br><br>

      <label for="SessionID">Session ID:</label>
      <input type="number" id="SessionID" name="SessionID" required><br><br>

      <label for="Participant">Participant:</label>
      <input type="text" id="Participant" name="Participant" required><br><br>

      <label for="Rating">Rating:</label>
      <input type="text" id="Rating" name="Rating" required><br><br>

      <label for="Comments">Comments:</label>
      <input type="text" id="Comments" name="Comments" required><br><br>

      <label for="Time">Time:</label>
      <input type="time" id="Time" name="Time" required><br><br>

      <input type="submit" name="Add" value="Insert"><br><br>
    </form>

    <?php
      include('connection.php');

      if ($_SERVER["REQUEST_METHOD"] == "POST") {
          $stmt = $connection->prepare("INSERT INTO feedbackandreviews (FeedbackID, SessionID, Participant, Rating, Comments, Time) VALUES (?, ?, ?, ?, ?, ?)");
          $stmt->bind_param("ssssss", $FeedbackID, $SessionID, $Participant, $Rating, $Comments,$Time);

          $FeedbackID = intval($_POST['FeedbackID']); 
          $SessionID = $_POST['SessionID']; 
          $Participant = $_POST['Participant']; 
          $Rating = $_POST['Rating']; 
          $Comments= $_POST['Comments']; 
          $Time = $_POST['Time'];

          if ($stmt->execute()) {
              echo "New record has been added successfully!";
          } else {
              echo "Error: " . $stmt->error;
          }

          $stmt->close();
      }

      $connection->close();
    ?>

    <h2 style="text-align: center;">feedbackandreviews</h2>
    <table border="1">
      <tr>
        <th>FeedbackID</th>
        <th>SessionID</th>
        <th>Participant</th>
        <th>Rating</th>
        <th>Comments</th>
        <th>Time</th>
        <th>Delete</th>
        <th>Update</th>
      </tr>
      <?php
        $connection = new mysqli($host, $user, $pass, $database);

        if ($connection->connect_error) {
            die("Connection failed: " . $connection->connect_error);
        }

        $sql = "SELECT * FROM feedbackandreviews";
        $result = $connection->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $FeedbackID = $row['FeedbackID']; 
                echo "<tr>
                        <td>" . $row['FeedbackID'] . "</td>
                        <td>" . $row['SessionID'] . "</td>
                        <td>" . $row['Participant'] . "</td>
                        <td>" . $row['Rating'] . "</td>
                        <td>" . $row['Comments'] . "</td>
                        <td>" . $row['Time'] . "</td>
                        <td><a style='padding: 4px;' href='delete_feedbackandreviews.php?FeedbackID=$FeedbackID'>Delete</a></td> 
                        <td><a style='padding: 4px;' href='update_feedbackandreviews.php?FeedbackID=$FeedbackID'>Update</a></td> 
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='7'>No data found</td></tr>";
        }

        $connection->close();
      ?>
    </table>
  </section>

  <footer>
    <center> 
      <b><h2>UR CBE BIT &copy; 2024 &reg;, Designed by: K Noelline</h2></b>
    </center>
  </footer>
</body>
</html>
