<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Create Event</title>
<style>
    body {
        font-family: Arial, sans-serif;
    }
    .container {
        text-align: center;
    }
    #eventForm {
        display: none;
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background: #fff;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
</style>
</head>
<body>


<div id="eventForm">
    <h2>Create Event</h2>
    <form action="submit_event.php" method="post">
        <label for="eventName">Event Name:</label><br>
        <input type="text" id="eventName" name="eventName"><br><br>
        <label for="price">Price:</label><br>
        <input type="text" id="price" name="price"><br><br>
        <label for="services">Services:</label><br>
        <input type="checkbox" id="fullServices" name="services" value="Full Services">
        <label for="fullServices">Full Services</label><br>
        <input type="checkbox" id="decorations" name="services" value="Decorations">
        <label for="decorations">Decorations</label><br>
        <input type="checkbox" id="musicPhotos" name="services" value="Music And Photos">
        <label for="musicPhotos">Music And Photos</label><br>
        <input type="checkbox" id="foodDrinks" name="services" value="Food And Drinks">
        <label for="foodDrinks">Food And Drinks</label><br>
        <input type="checkbox" id="invitationCard" name="services" value="Invitation Card">
        <label for="invitationCard">Invitation Card</label><br><br>
        <input type="submit" value="Create Event">
    </form>
</div>

<script>
    function toggleEventForm() {
        var eventForm = document.getElementById('eventForm');
        if (eventForm.style.display === 'none') {
            eventForm.style.display = 'block';
        } else {
            eventForm.style.display = 'none';
        }
    }
</script>

</body>
</html>
