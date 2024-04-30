<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login Page</title>
<style>
  body {
    margin: 0;
    padding: 0;
    font-family: Arial, sans-serif;
    background: url('1.jpg') center/cover no-repeat;
    /* Replace 'background-image.jpg' with your image path */
    /* background-color: #FFFFFF; /* White fallback */
    color: #FFFFFF; /* White */
    background-blend-mode: overlay;
    height: 100vh;
  }

  .overlay {
    background-color: rgba(0, 0, 0, 0.5); /* Overlay color with 50% opacity */
    width: 100%;
    height: 100%;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    text-align: center;
    position: relative;
    z-index: 1; /* Ensure overlay is above the background */
  }

  .container {
    position: relative;
    z-index: 2; /* Ensure container is above the overlay */
  }

  h1 {
    font-size: 3rem;
    margin-bottom: 20px;
  }

  p {
    font-size: 1.2rem;
    margin-bottom: 30px;
  }

  .btn {
    display: inline-block;
    padding: 30px 75px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 1.2rem;
    text-decoration: none;
    color: #rosybrown; /* White */
    background-color: #FFFFFF; /* Blue */
    transition: background-color 0.3s ease;
  }

  .btn-login:hover {
    background-color: darkgreen; /* Darker Blue */
    box-shadow: 2px;

  }

  .btn-register {
    background-color: darkcyan; /* Black */
    margin-left: 20px;
  }

  .btn-register:hover {
    background-color: #666666; /* Darker Black */
  }
  @keyframes slideImages {
    0%, 33.33% {
        background-image: url('Images/1.jpg');
    }
    33.33%, 66.66% {
        background-image: url('Images/1.jpg');
    }
    66.66%, 100% {
        background-image: url('Images/1.jpg');
    }
}

        /* Animation */
        @keyframes move {
            0% { transform: translateY(-50%); opacity: 0; }
            100% { transform: translateY(0); opacity: 1; }
        }

        .moving-text {
            animation: move 10s infinite alternate;
        }
</style>
</head>
<body style="background-image: url('./Images/Images/1.jpg');background-repeat: no-repeat;background-size: cover;">

<div class="overlay">
  <div class="container">
    <h1 style="color: darkcyan;">handcraft_business_consulting_system</h1>

    <a href="login.html" class="btn btn-login">Login</a>
    <a href="register.html" class="btn btn-register">Register</a>
  </div>
</div>

</body>
</html>