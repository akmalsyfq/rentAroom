<?php

if (isset($_POST["submit"])) {
include_once("../php/dbconnect.php");
    $contact = $_POST['contact'];
    $title = $_POST['title'];
    $desc = $_POST['desc'];
    $price = $_POST['price'];
    $depo = $_POST['depo'];
    $state = $_POST['state'];
    $area = $_POST['area'];
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];
    
      
 $sqladd = "INSERT INTO `room`(`roomContact`, `roomTitle`, `roomDesc`, `roomPrice`, `roomDepo`, `roomState`, `roomArea`, `roomLatitude`, `roomLongitude`)  VALUES('$contact','$title','$desc','$price','$depo','$state','$area','$latitude','$longitude')";
    try {
        $conn->exec($sqladd);
        if (file_exists($_FILES["fileToUpload"]["tmp_name"]) || is_uploaded_file($_FILES["fileToUpload"]["tmp_name"])) {
            $titleR = str_replace(' ','',$title); 
            uploadImage($titleR);
        }
        echo "<script>alert('Registration successful')</script>";
        echo "<script>window.location.replace('mainpage.php')</script>";
       
    } catch (PDOException $e) {
        echo "<script>alert('Registration failed')</script>";
        
    }
}

function uploadImage($title)
{
    $target_dir = "../images/";
  //  $titleR = $title;
    $titleR = str_replace(' ','',$title); 
    $target_file = $target_dir . $titleR . ".png";
    move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="../style/style.css">
    <script src="../javascript/script.js"></script>
    <title>RENTAROOM</title>
</head>

<body>
    <div class="w3-header w3-container w3-yellow w3-padding-32 w3-center">
        <h1 style="font-size:calc(8px + 4vw);">RentARoom.com</h1>
        <p style="font-size:calc(8px + 1vw);;">Enjoy a pleasent stay with us.</p>
    </div>

    <div class="w3-bar w3-blue-gray">
        
        <a href="mainpage.php" class="w3-bar-item w3-button w3-left">Home</a>
    </div>

    <div class="w3-container w3-padding-64 form-container">
        <div class="w3-card">
            <div class="w3-container w3-blue">
                <p>Add New Room<p>
            </div>
            <form class="w3-container w3-padding" name="registerForm" action="registerRoom.php" method="post" enctype="multipart/form-data"  >
            
            <div class="w3-container w3-border w3-center w3-padding">
                    <img class="w3-image w3-round w3-margin" src="../images/room.png" style="width:100%; max-width:450px"><br>
                    <input type="file" onchange="previewFile()" name="fileToUpload" id="fileToUpload"><br>
                </div>

                <p>
                    <label>Room Contact Number</label>
                    <input class="w3-input w3-border w3-round" name="contact"  type="number" required>
                </p>
                <p>
                    <label>Room Title</label>
                    <input class="w3-input w3-border w3-round" name="title"  type="text" required>
                </p>
                <p>
                    <label>Room Description</label>
                    <textarea class="w3-input w3-border"  name="desc" rows="4" cols="50" width="100%" placeholder="Enter room description" required></textarea>
                </p>
                <p>
                    <label>Room Price</label>
                    <input class="w3-input w3-border w3-round" name="price" type="number" step="any" required>
                </p> <p>
                    <label>Room Deposit</label>
                    <input class="w3-input w3-border w3-round" name="depo" type="number" step="any" required>
                </p>
                <p>
                    <label>State Location</label>
                    <input class="w3-input w3-border w3-round" name="state"  type="text" required>
                </p>
                <p>
                    <label>Area Location</label>
                    <input class="w3-input w3-border w3-round" name="area" type="text" required>
                </p>
                <p>
                    <label>Room Longitude</label>
                    <input class="w3-input w3-border w3-round" name="longitude"  type="number" step="any" required>
                </p> <p>
                    <label>Room Latitude</label>
                    <input class="w3-input w3-border w3-round" name="latitude" type="number" step="any" required>
                </p>
                <div class="row">
                    <input class="w3-input w3-border w3-block w3-blue w3-round" type="submit" name="submit" value="Add Room">
                </div>

            </form>



        </div>
    </div>
    <div class="w3-container w3-border w3-center  w3-round-large">
    <button onclick="getLocation()">Get Your Current Latitude and Longitude</button>
<p id="coordinate"></p>
<script>
var map = document.getElementById("coordinate");
function getLocation() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showPosition);
  } else { 
    x.innerHTML = "Geolocation is not supported by this browser.";
  }
}
function showPosition(position) {
  map.innerHTML = "Latitude: " + position.coords.latitude + 
  "<br>Longitude: " + position.coords.longitude;
}
</script>
</div>

    <footer class="w3-footer w3-center w3-blue-grey">
        <p>RENTAROOM</p>
    </footer>

</body>

</html>