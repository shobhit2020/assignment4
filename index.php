<?php
   
   session_start();

   include('db_connect.php');
   
   
   
   
   $email = $pass = '';
   $errors = array('email'=>'', 'pass'=>'');
   
   if(isset($_POST['Login'])){
       
        $flag_email=0;
        $flag_pass=0;
        
        if(empty($_POST['email'])){
           $errors['email'] = 'An email is required. <br />';
        } 

        if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
            $errors['email'] = 'Email is invalid.';
        }

        if(empty($_POST['pass'])){
            $errors['pass'] = 'Password can not be empty <br />';
        }

        $email = $_POST['email'];
        $pass  = $_POST['pass'];

        $check  = "SELECT * FROM users WHERE email = '$email' AND pass = '$pass' limit 1 ";

        $result = mysqli_query($connect, $check);

        if(mysqli_num_rows($result)==1)
        {
            $_SESSION['username'] = $email;
            header('Location: quiz.php');
        }
        else
        {
            $errors['email'] = 'Email and password did not match, tried signing up ?.';
            $errors['pass']  = 'Wrong match';
        }

        if(array_filter($errors)){
           echo 'errors';
        }
    
   }
 
?>

<!doctype html>
<html>
    
    <?php include('head.php'); ?>
    <section class="container black-text">    
        <h2 class="center">Login</h2>
        <form class="white" action="index.php" method="POST">
            <label>User name: </label>
            <input type="text" name="email" value="<?php echo htmlspecialchars($email); ?>" >
            <div class="red-text"><?php echo $errors['email']; ?></div>
            <label>Password: </label>
            <input type="text" name="pass" value="<?php echo htmlspecialchars($pass); ?>">
            <div class="red-text"><?php echo $errors['pass']; ?></div>
            <div class="center">
                <input type="submit" name="Login" value="Log in" class="btn brand z-depth-0">
            </div>
            <br />
        </form>
    </section>
    <?php include('foot.php'); ?>

</html>