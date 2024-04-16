<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script>
        function redirectTo(url) {
            window.location.href = url;
        }
        </script>
    
    <!-- Include jQuery from a CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin ="anonymous"></script>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">


</head>



<?php
// Check if the 'userid' cookie is set
if (isset($_COOKIE['selectedClass'])) {
  unset($_COOKIE['selectedClass']);
  unset($_COOKIE['selectedCoach']);
}
if (isset($_COOKIE['userid'])) {
    $userid = $_COOKIE['userid'];
    $train_id = $_COOKIE['train_id'];
    $selectedDate = date('Y-m-d', strtotime($_COOKIE['date']));
    $destination = $_COOKIE['destination'];
    $sources = $_COOKIE['source'];

} else {
    // Handle the case where 'userid' cookie is not set
    echo "User ID not found in the cookie.";
}
?>



<?php
session_start();


$host = 'localhost'; // Host name
$username = 'root'; // Mysql username
$password = ''; // Mysql password
$db_name = 'dbmsproject'; // Database name

// Connect to server and select database.
$mysqli = new mysqli($host, $username, $password, $db_name);

if ($mysqli->connect_error) {
   die("Connection failed: " . $mysqli->connect_error);
}
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
        <img src="https://e1.pxfuel.com/desktop-wallpaper/101/88/desktop-wallpaper-indian-railways-logo-indian-government.jpg" class="irctc-logo rounded-circle mr-5" alt="IRCTC Logo" style="height: 100px;">

            <a class="navbar-brand mr-auto" href="#">IRCTC</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#" onclick="redirectTo('profile.php')">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" onclick="redirectTo('station_info.php')">Station Info</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" onclick="redirectTo('train_info.php')">Train Info</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" onclick="redirectTo('cancelpage.php')">History</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" onclick="redirectTo('bookingpage.php')">Book Tickets</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" onclick="redirectTo('homepage.php')">Home</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    


<script>
    function redirectTo(url) {
        window.location.href = url;
    }
</script>


<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" >
    <div class="form-group">


  <select class="form-control" id="Class"
            style="width: 10%; height: 5%; left: 12%; top: 30%; position: absolute; background: white;"
            name="Class"
            >
            <?php
            $sql = "SELECT DISTINCT COACH_TYPE FROM coach NATURAL JOIN assigned_to_train WHERE train_id =".$train_id;
            $result=$mysqli->query($sql);
            echo "<option value='' disabled selected hidden>Please Choose...</option>";
            while($row = mysqli_fetch_array($result))
            {
                ?>
                <option value="<?php echo $row['COACH_TYPE'];?>"><?php echo $row['COACH_TYPE'];?></option>

                
                <?php
            }

            ?>
</select>

        </div>
            <div class="form-group">
            <style>
      select:invalid { color: gray; }
  </style>
        <select class='form-control'
            style="width: 10%; height: 5%; left: 32%; top: 30%; position: absolute; background: white;"
            name="Coach"
            id="Coach">
            
</select>

</div>

<script type="text/javascript">
    $(document).ready(function() {
    // Function to set a cookie
    function setCookie(name, value) {
        document.cookie = name + '=' + value;
    }

    // Function to get the value of a cookie
    function getCookie(name) {
        var cookieName = name + '=';
        var cookies = document.cookie.split(';');
        for (var i = 0; i < cookies.length; i++) {
            var cookie = cookies[i].trim();
            if (cookie.indexOf(cookieName) === 0) {
                return cookie.substring(cookieName.length, cookie.length);
            }
        }
        return '';
    }

    $('#Class').on('change', function() {
        var selectedClass = this.value;
        var train_id = '<?php echo $train_id; ?>';

        // Set selectedClass as a cookie
        setCookie('selectedClass', selectedClass);

        $.ajax({
            url: 'getCoach.php',
            type: 'POST',
            data: {
                'selectedClass': selectedClass,
                'train_id': train_id
            },
            cache: false,
            success: function(data) {
                $('#Coach').html(data);

                // Display the selected class immediately
            }
        });
    });

    $('#Coach').on('change', function() {
        var selectedCoach = this.value;

        // Display the selected Coach
        

        // Set selectedCoach as a cookie
        setCookie('selectedCoach', selectedCoach);

        $.ajax({
          type: 'POST', // or 'GET' depending on your server-side script
          url: 'process.php', // Replace with the path to your PHP script
          data: { selectedCoach: selectedCoach },
          success: function(response) {
            // Display the response (a number) directly
            $('#selectedValues').html('Available Seats: ' + response);          }
        });



    });

    // Retrieve and display cookies when the page loads
    
});



</script>



        
          <style>
          select:invalid { color: gray; }
          </style>
          
  
 </form>

 <form action="success_page.php" method="post" id="inputForm">
  <div id="inputContainer"></div>
  <button class="btn btn-primary" style="width: 10%; height: 6%; left: 45%; top: 30%; position: absolute;" type="button" id="addInput">Add Input</button>
  <input class="btn btn-primary" style="width: 10%; height: 6%; left: 60%; top: 30%; position: absolute;" type="submit" name="submit" value="Submit">
  <input type="hidden" id="inputCount" name="inputCount" value="0">
</form>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const maxInputs = 5;
        const inputContainer = document.getElementById("inputContainer");
        const addInputButton = document.getElementById("addInput");
        const inputCountField = document.getElementById("inputCount");
        let inputCount = 0;

        addInputButton.addEventListener("click", function() {
            if (inputCount < maxInputs) {
                inputCount++;
                const inputRow = createInputRow(inputCount);
                inputContainer.appendChild(inputRow);
                inputRow.scrollIntoView({ behavior: "smooth" });
            } else {
                alert("You've reached the maximum limit of input fields.");
            }
        });

        function createInputRow(count) {
            const inputRow = document.createElement("div");
            inputRow.className = "form-group row";

            const labelCol = document.createElement("div");
            labelCol.className = "col-sm-2";

            const label = document.createElement("label");
            label.textContent = `Passenger ${count}:`;
            labelCol.appendChild(label);
            inputRow.appendChild(labelCol);

            const inputCol = document.createElement("div");
            inputCol.className = "col-sm-10";

            const nameInput = createInputElement("text", `name_${count}`, "Name", "form-control");
            const genderSelect = createSelectElement(`gender_${count}`, ["Male", "Female", "Other"], "form-control");
            const ageInput = createInputElement("text", `age_${count}`, "Age", "form-control");

            inputCol.appendChild(nameInput);
            inputCol.appendChild(genderSelect);
            inputCol.appendChild(ageInput);

            inputRow.appendChild(inputCol);

            if (inputCount > 0) {
                const deleteButtonCol = document.createElement("div");
                deleteButtonCol.className = "col-sm-2";

                const deleteButton = createDeleteButton();
                deleteButtonCol.appendChild(deleteButton);

                inputRow.appendChild(deleteButtonCol);
            }

            return inputRow;
        }

        function createInputElement(type, name, placeholder, classes) {
            const input = document.createElement("input");
            input.type = type;
            input.name = name;
            input.placeholder = placeholder;
            input.className = classes;
            return input;
        }

        function createSelectElement(name, options, classes) {
            const select = document.createElement("select");
            select.name = name;
            select.className = classes;

            for (const option of options) {
                const optionElement = document.createElement("option");
                optionElement.value = option;
                optionElement.textContent = option;
                select.appendChild(optionElement);
            }
            return select;
        }

        function createDeleteButton() {
            const deleteButton = document.createElement("button");
            deleteButton.type = "button";
            deleteButton.className = "btn btn-danger";
            deleteButton.textContent = "Delete";
            deleteButton.addEventListener("click", function() {
                const inputRow = this.parentNode.parentNode;
                inputContainer.removeChild(inputRow);
                inputCount--;
                updatePassengerLabels();
            });
            return deleteButton;
        }

        function updatePassengerLabels() {
            const inputRows = inputContainer.querySelectorAll(".form-group.row");
            inputRows.forEach((row, index) => {
                const label = row.querySelector("label");
                label.textContent = `Passenger ${index + 1}:`;
            });
        }

        document.getElementById("inputForm").addEventListener("submit", function() {
            inputCountField.value = inputCount;

            if (inputCount === 0) {
                alert("Please add at least one passenger.");
                event.preventDefault(); // Prevent form submission
            }
        });
    });
</script>



<?php
echo $train_id;
?>


 
<div id="selectedValues" style="width: 50%; height: 3%; left: 40%; top: 40%; position: absolute; color: black; font-size: medium;"></div>


<?php

?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

<?php
$mysqli->close();
?>

</html>