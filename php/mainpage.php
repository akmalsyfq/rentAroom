<?php



include_once("../php/dbconnect.php");


if (isset($_GET['button'])) {
    $op = $_GET['button'];
    $option = $_GET['option'];
    $search = $_GET['search'];
    if ($op == 'search') {
        if ($option == "name") {
            $sqlroom = "SELECT * FROM room ORDER BY roomDate WHERE name LIKE '%$search%'";
        }
        if ($option == "ic") {
            $sqlroom = "SELECT * FROM room ORDER BY roomDate id LIKE '%$search%'";
        }
        if ($option == "ic") {
            $sqlroom = "SELECT * FROM room ORDER BY roomDate id LIKE '%$search%'";
          }
    }
} else {
    $sqlroom = "SELECT * FROM room ORDER BY roomDate DESC";
}

$stmt = $conn->prepare($sqlroom);
$stmt->execute();
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
$rows = $stmt->fetchAll();

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
    <script src="https://kit.fontawesome.com/e0cd0fba9e.js" crossorigin="anonymous"></script>
    <script src="../javascript/script.js"></script>
    <title>RENTAROOM</title>
    <style>h1 {text-align: center;} </style>
</head>

<body>
<div class="w3-header w3-container w3-pale-yellow w3-padding-32 w3-center">
        <h1 style="font-size:calc(8px + 4vw);">RentARoom.com</h1>
        <p style="font-size:calc(8px + 1vw);;">Enjoy a pleasent stay with us.</p>
    </div>

    <div class="w3-bar w3-blue-gray">
        
        <a href="registerroom.php" class="w3-bar-item w3-button w3-
         left">Add Room</a>
    </div>

    
    <h1> Rooms Available </h1>

    <div class="w3-grid-template w3-khaki">
        
        <?php
        foreach ($rows as $showroom) {
            $id = $showroom['roomid'];
            $title = $showroom['roomTitle'];
            $contact = $showroom['roomContact'];
            $price = $showroom['roomPrice'];
            $desc = $showroom['roomDesc'];
            $state = $showroom['roomState'];
            $area = $showroom['roomArea'];
            $depo = $showroom['roomDepo'];
            
            echo "<div class='w3-center w3-padding'>";
            echo "<div class='w3-card-4 w3-light-grey'>";
            echo "<header class='w3-container w3-gray'";
            echo "<h5>$title</h5>";
            echo "</header>";
            $titleR = str_replace(' ','',$title);  
            echo "<div class='w3-padding'><img class='w3-image' src=../images/$titleR.png"." onerror=this.onerror=null;this.src='../images/room.png'". " '></div> ";
            echo "<div class='w3-container w3-left-align'><hr>";
            echo "<p>
            
            <i class='fa fa-address-book' style='font-size:16px'></i>&nbsp&nbspContact Number: $contact<br>
            <i class='fa fa-info' style='font-size:16px'></i>&nbsp&nbsp&nbsp&nbspRoom Details: $desc<br>
            <i class='fa fa-money' style='font-size:16px'></i>&nbspRoom Price: RM$price<br>
            <i class='fa fa-money' style='font-size:16px'></i>&nbspDeposit: RM$depo<br>
            <i class='fa fa-map-pin' style='font-size:16px'></i>&nbsp&nbsp&nbsp&nbspLocation: $area,$state<br>
            </p>
            <hr>";echo "<table class='w3-table'><tr>
            
            </tr></table>";


            echo "</div>";
            echo "</div>";
            echo "</div>";
        }
        ?>
    </div>
 

<footer class="w3-footer w3-center w3-amber">
        <p>RENTAROOM</p>
    </footer>

</body>

</html>