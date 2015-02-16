 <!DOCTYPE HTML>
<html>
    <head>
        <style>
            .error {color: #FF0000;}
        </style>
    </head>
    <body>

    <?php
    
    include './db_functions.php';
    include './vote_functions.php';
    
    // define variables and set to empty values
    $nameErr = $startErr = $endErr = "";
    $name = $start = $end = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {    
        
       if (empty($_POST["name"])) {
         $nameErr = "Name is required";
       } else {
         $name = test_input($_POST["name"]);
         // check if name only contains letters and whitespace
         if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
           $nameErr = "Only letters and white space allowed";
         }
       }      
       
       if (empty($_POST["start"])){
           $startErr = "Start date is required";
       } else {
           $start = $_POST["start"];
           $startErr = isValidDate($_POST["start"]);
       }
       
       if (empty($_POST["end"])){
           $endErr = "End date is required";
       } else {
           $end = $_POST["end"];
           $endErr = isValidDate($_POST["end"]);
       }
       
       $connection = connect_to_db();       
       set_new_vote($connection);       
       close_db_connection($connection);
       
       
    }
    
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
     }
    
    function isValidDate($date){
        $matches = $err = "";
        if (preg_match("/([0-9]{2})\.([0-9]{2})\.([0-9]{4})/", $date, $matches)) {
            if (!checkdate($matches[2], $matches[1], $matches[3])) {
                $err = "Ung&uuml;ltiges Datum";
                //echo '<error elementid="cnt_birthday" message="BIRTHDAY - Please enter a valid date in the format - dd/mm/yyyy"/>';
            }
        } else {
            $err = "Falsches Datumformat";
            //echo '<error elementid="cnt_birthday" message="BIRTHDAY - Only this birthday format - dd/mm/yyyy - is accepted."/>';
        }
        return $err;
    }
    
    ?>
        
        
        
        
        
        
        
        <div class="mainForm">
            <h2>Start your voting!</h2> 
           
            <!-- <form method="post" action="<?php echo "/voting/setVote.php" ;?>"> -->
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                Name: <input type="text" name="name" value="<?php echo $name;?>">
                <span class="error">* <?php echo $nameErr;?></span>
                <br><br>
                Start: <input type="text" name="start" value="<?php echo $start;?>">
                <span class="error">* <?php echo $startErr;?></span>
                <br><br>
                End: <input type="text" name="end" value="<?php echo $end;?>">
                <span class="error">* <?php echo $endErr;?></span>
                <br><br>
                  
                <input type="submit" name="submit" value="Submit">
            </form>
            
        </div>

 

    <?php
    echo "<h2>Your Input:</h2>";
    echo $name;
    echo "<br>";
    echo $start;
    echo "<br>";
    echo $end;
    ?>

    </body>
</html>
