<?php
    
    session_start();

    include('db_connect.php');
    
    

    $email = $pass = '';
    $errors = array('email'=>'', 'pass'=>'');
    
    if(isset($_POST['submit'])){
        
        if(empty($_POST['email'])){
            $errors['email'] = 'An email is required <br />';
        } else{
            $email=$_POST['email'];
            if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
                $errors['email'] = 'Email is invalid, please try again.';
            } else{
                $check_duplicate_email = "SELECT email FROM users WHERE email = '$email' ";
                
                $result = mysqli_query($connect, $check_duplicate_email);

                $count = mysqli_num_rows($result);

                if($count>0){
                    $errors['email'] = 'Email already taken, try again.';
                }
            }
        }

        if(empty($_POST['pass'])){
            $errors['pass'] = 'Password can not be empty <br />';
        } else{
            $pass=$_POST['pass'];
            $upper   = preg_match('@[A-Z]@',$pass);
            $lower   = preg_match('@[a-z]@',$pass);
            $number  = preg_match('@[0-9]@',$pass);
            $special = preg_match('@[^\w]@',$pass);
            if( !$upper || !$lower || !$number || !$special || strlen($pass)< 8 )
                $errors['pass'] = 'Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.';
        }

        if(array_filter($errors)){
            echo 'erros';
        }
        else{
            $email = mysqli_real_escape_string($connect,$_POST['email']);
            $pass  = mysqli_real_escape_string($connect,$_POST['pass']);
            
            $sql = "INSERT INTO users(email,pass) VALUES('$email','$pass')";
            
            if(mysqli_query($connect,$sql)){
                header('Location: index.php');
            } else{
                echo 'query error: ' . mysqli_error($connect);
            }
        }

    }

?>

<!doctype html>
<html>
    <?php include('head.php'); ?>
    <section class="container grey-text">    
        <h2 class="center">Add account</h2>
        <form class="white" action="register.php" method="POST">
            <label>Email address: </label>
            <input type="text" name="email" value="<?php echo htmlspecialchars($email); ?>" >
            <div class="red-text"><?php echo $errors['email']; ?></div>
            <label>Password: </label>
            <input type="text" name="pass" value="<?php echo htmlspecialchars($pass); ?>">
            <div class="red-text"><?php echo $errors['pass']; ?></div>
            <div class="center">
                <input type="submit" name="submit" value="submit" class="btn brand z-depth-0">
            </div>
        </form>
    </section>
    <?php include('foot.php'); ?>
</html>
           

