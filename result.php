<?php
    session_start();
    include ('db_connect.php');

    
    if(isset($_POST['submit'])){
        if(!empty($_POST['quiz'])){
            $selected = $_POST['quiz'];
            $result=0;
            $i=1;
            $query = mysqli_query($connect,"SELECT * FROM question");
            
            while($rows = mysqli_fetch_array($query)){
                $checked = $rows['ans_id'] == $selected[$i];
                if($checked){
                    $result++;
                }
                $i++;
            }
        }
    }
?>

<h3>Result</h3>
Score: <?php echo $result; ?>
<br>
<a href="logout.php"> LOGOUT </a>