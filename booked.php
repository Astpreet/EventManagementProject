<?php
// Include the configuration file and start the session
@include 'config.php';
session_start();

// Redirect users to the login page if they're not logged in
if (!isset($_SESSION['user_name'])) {
    header('location:login.php');
    exit();
}

// Fetch booked events for the current user from the database
$userId = $_SESSION['user_id'];
$sql = "SELECT events.event_name, events.price, events_booking.event_date, events_booking.services
        FROM events_booking
        INNER JOIN events ON events_booking.event_id = events.id
        WHERE events_booking.user_id = $userId";
$result = mysqli_query($conn, $sql);
$bookedEvents = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booked Events</title>
    <!-- Add any CSS stylesheets here -->
</head>
<body>
    <h1>Booked Events</h1>
    <?php if (!empty($bookedEvents)) : ?>
        <table>
            <thead>
                <tr>
                    <th>Event Name</th>
                    <th>Price</th>
                    <th>Event Date</th>
                    <th>Services</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($bookedEvents as $event) : ?>
                    <tr>
                        <td><?php echo $event['event_name']; ?></td>
                        <td>$<?php echo $event['price']; ?></td>
                        <td><?php echo $event['event_date']; ?></td>
                        <td><?php echo $event['services']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else : ?>
        <p>No events booked yet.</p>
    <?php endif; ?>
    <!-- Add any HTML content or scripts here -->
</body>
</html>
