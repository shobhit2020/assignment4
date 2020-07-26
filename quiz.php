<?php
    session_start();
    include ('db_connect.php');
?>
<!DOCTYPE html>
<html>
        <div class="container">
            
            <h2 class="center"> Welcome <?php echo $_SESSION['username']; ?> </h2>
            <?php
                
                $stm  = mysqli_query($connect,"SELECT * FROM question");

            ?>
            
            <h3 class="center">QUIZ</h3>
            
            <form method="POST" action="result.php">
                <ol type="1">
                    <?php while($question = mysqli_fetch_array($stm)) { ?>
                        <li>
                            <?php echo $question["content_ques"]; ?>
                            <input type="hidden" name="questionNo" value="<?php echo $question["question_no"]; ?>">
                            <ol type="a">
                                <?php
                                    $questionNo=$question["question_no"];
                                    $stm2 = mysqli_query($connect,"SELECT * FROM answer where question_id = '$questionNo'");
                                ?>
                                <?php while($answer = mysqli_fetch_array($stm2)) { ?>
                                    <li>
                                        <input type="radio" name="quiz[<?php echo $answer["question_id"] ?>]" value="<?php echo $answer["id"]; ?>" >
                                        <?php echo $answer["content_ans"]; ?>
                                    </li>
                                <?php } ?>
                            </ol>
                        </li>
                    <?php } ?>
                </ol>
                <br>
                <div class="center">
                    <input type="submit" name="submit" value="Submit" class="btn brand z-depth-0">
                </div>
            </form>

            
            
            
        </div>
        
    
</html>










