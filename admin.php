<?php
@include 'config.php';

session_start();

if (!isset($_SESSION['admin_name'])) {
    header('location:login.php');
    exit();
}

$message = array(); // Initialize message array

// Handling form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $event_name = mysqli_real_escape_string($conn, $_POST['event_name']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    $services = implode(", ", $_POST['services']);

    // Insert the event into the database
    $sql = "INSERT INTO events (event_name, price, services) VALUES ('$event_name', '$price', '$services')";
    if (mysqli_query($conn, $sql)) {
        $message['success'] = "Event created successfully.";
    } else {
        $message['error'] = "Error: " . mysqli_error($conn);
    }
}
$sql = "SELECT * FROM reviews";
$result = mysqli_query($conn, $sql);
$reviews = mysqli_fetch_all($result, MYSQLI_ASSOC);
$currentURL = $_SERVER['REQUEST_URI'];
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <link rel="stylesheet" href="style1.css">
    <link rel="stylesheet" href="admin.css">
    <!-- Add Font Awesome CDN link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        /* Calendar styles */
        #calendar {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 300px;
            height: 300px;
            background-color: #fff;
            border: 1px solid #ccc;
            z-index: 9999;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        #calendar h2 {
            margin-top: 0;
        }
        /* Reviews table styles */
        #reviews-table {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #fff;
            border: 1px solid #ccc;
            z-index: 9999;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        #reviews-table th,
        #reviews-table td {
            padding: 5px 10px;
            border: 1px solid #ccc;
        }
    </style>

</head>

<body>
    <header class="header">
        <div class="flex">
            <a href="admin_page.php" class="logo">Admin<span>Panel</span></a>
            <nav class="navbar">
                <a href="http://localhost/Event_Management_Project/admin.php">Home</a>
                <a href="#" onclick="openCalendar()">Booked Events</a>
                <a href="#" onclick="openCreateEventForm()">Create New Events</a>
                <a href="#" onclick="openSeeReviews()">See Reviews</a>

               
                <a href="index.html" class="btn">Logout</a>
            </nav>
            <div class="icons">
                <div id="menu-btn" class="fas fa-bars"></div>
                <div id="user-btn" class="fas fa-user" onmouseover="showUserAccountBox()" onmouseout="hideUserAccountBox()"></div>
                <!-- User account box -->
                <div class="user-account-box" id="user-account-box">
                    <p>Admin name: <span><?php echo $_SESSION['admin_name']; ?></span></p>
                </div>
            </div>
            <div class="account-box">
                <p>Adminname: <span><?php echo $_SESSION['admin_name']; ?></span></p>
                <!-- Assuming you have 'admin_email' in the session -->
                <p>Email: <span><?php echo $_SESSION['admin_email']; ?></span></p>
                <a href="logout.php" class="delete-btn">Logout</a>
                <div>New <a href="login.php">Login</a> | <a href="register.php">Register</a></div>
            </div>
        </div>
        <div class="container">
            <div class="content">
                <h3>Hi, <span>Admin</span></h3>
                <h1>Welcome <span><?php echo $_SESSION['admin_name']; ?></span></h1>
                <p>This is an admin page</p>
            </div>
        </div>
    </header>
    <div id="calendar">
    <h2>Booked Events Calendar</h2>
    <div class="calendar-container">
        <div class="month">
            <div class="month-name">March 2024</div>
            <div class="days">
                <div class="day">Sun</div>
                <div class="day">Mon</div>
                <div class="day">Tue</div>
                <div class="day">Wed</div>
                <div class="day">Thu</div>
                <div class="day">Fri</div>
                <div class="day">Sat</div>
            </div>
            <div class="dates">
                <!-- Days of the month will be populated here -->
            </div>
        </div>
    </div>
</div>

    
    <!-- Create Event Form Box -->
    <div id="create-event-box" class="create-event-box">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <h2>Create Event</h2>
            <?php if (isset($message['error'])) { ?>
                <div class="error"><?php echo $message['error']; ?></div>
            <?php } ?>
            <?php if (isset($message['success'])) { ?>
                <div class="success"><?php echo $message['success']; ?></div>
            <?php } ?>
            <label for="event_name">Event Name:</label>
            <input type="text" id="event_name" name="event_name"><br><br>
            <label for="price">Price:</label>
            <input type="text" id="price" name="price"><br><br>
            <label for="services">Services:</label><br>
            <input type="checkbox" id="full_services" name="services[]" value="Full Services">
            <label for="full_services">Full Services</label><br>
            <input type="checkbox" id="decorations" name="services[]" value="Decorations">
            <label for="decorations">Decorations</label><br>
            <input type="checkbox" id="music_photos" name="services[]" value="Music And Photos">
            <label for="music_photos">Music And Photos</label><br>
            <input type="checkbox" id="food_drinks" name="services[]" value="Food And Drinks">
            <label for="food_drinks">Food And Drinks</label><br>
            <input type="checkbox" id="invitation_card" name="services[]" value="Invitation Card">
            <label for="invitation_card">Invitation Card</label><br><br>
            <input type="submit" value="Create Event">
        </form>
    </div>
    <!-- Inside your HTML where you want to display reviews -->
    <div id="reviews-table">
        <h2>User Reviews</h2>
        <table>
            <thead>
                <tr>
                    <th>User Name</th>
                    <th>Review</th>
                    <th>Submitted At</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($reviews as $review) { ?>
                    <tr>
                        <td><?php echo $review['user_id']; ?></td>
                        <td><?php echo $review['review']; ?></td>
                        <td><?php echo $review['created_at']; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    


    <script>
        // JavaScript to show/hide user account box
        function showUserAccountBox() {
            document.getElementById("user-account-box").style.display = "block";
        }

        function hideUserAccountBox() {
            document.getElementById("user-account-box").style.display = "none";
        }

        function openCreateEventForm() {
            var createEventBox = document.getElementById("create-event-box");
            createEventBox.style.display = "block";
            // Hide the container with admin welcome message
            document.querySelector('.container').style.display = 'none';
        }

        function openCalendar() {
            var calendar = document.getElementById("calendar");
            calendar.style.display = "block";
            // Hide the container with admin welcome message
            document.querySelector('.container').style.display = 'none';
        }
        function openSeeReviews() {
            var reviewsTable = document.getElementById("reviews-table");
            reviewsTable.style.display = "block";
            // Hide the container with admin welcome message
            document.querySelector('.container').style.display = 'none';
        }

        function populateDates() {
            var datesContainer = document.querySelector('.dates');
            datesContainer.innerHTML = '';

            var currentDate = new Date();
            var currentMonth = currentDate.getMonth();
            var currentYear = currentDate.getFullYear();

            var daysInMonth = new Date(currentYear, currentMonth + 1, 0).getDate();

            for (var i = 1; i <= daysInMonth; i++) {
                var dateElement = document.createElement('div');
                dateElement.classList.add('date');
                dateElement.textContent = i;
                datesContainer.appendChild(dateElement);
            }
        }
        function openCalendar() {
    var calendar = document.getElementById("calendar");
    calendar.style.display = "block";
    document.getElementById("create-event-box").style.display = "none"; // Hide create event form if open
    document.getElementById("reviews-table").style.display = "none"; // Hide reviews table if open
    document.querySelector('.container').style.display = 'none';
}

function openCreateEventForm() {
    var createEventBox = document.getElementById("create-event-box");
    createEventBox.style.display = "block";
    document.getElementById("calendar").style.display = "none"; // Hide calendar if open
    document.getElementById("reviews-table").style.display = "none"; // Hide reviews table if open
    document.querySelector('.container').style.display = 'none';
}

function openSeeReviews() {
    var reviewsTable = document.getElementById("reviews-table");
    reviewsTable.style.display = "block";
    document.getElementById("create-event-box").style.display = "none"; // Hide create event form if open
    document.getElementById("calendar").style.display = "none"; // Hide calendar if open
    document.querySelector('.container').style.display = 'none';
}


        



    </script>
</body>

</html>
