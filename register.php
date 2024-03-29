<?php
// Include config file
require_once 'config.php';
 
// Define variables and initialize with empty values
$username = $password = $confirm_password = $Email ="";
$username_err = $password_err = $confirm_password_err= $Email_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = trim($_POST["username"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "This username is already taken.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Validate password
    if(empty(trim($_POST['password']))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST['password'])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST['password']);
    }
    //Validate Email
    
    if(empty(trim($_POST['Email']))){
        $Email_err = "Please enter an Email.";     
    }  else{
        $Email = trim($_POST['Email']);
    }
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = 'Please confirm password.';     
    } else{
        $confirm_password = trim($_POST['confirm_password']);
        if($password != $confirm_password){
            $confirm_password_err = 'Password did not match.';
        }
    }
    
    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($Email_err) && empty($confirm_password_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO users (Username, Password) VALUES (?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);
            
            // Set parameters
            $param_username = $username;
            $param_Email = $Email;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: login.php");
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html lang="en">
	<div class="register-page">
		<head>
		    
		    <meta charset="UTF-8">
		    <title>Sign Up</title>
		    
            <link rel="stylesheet" href="css/bootstrap.css">
            <link rel="stylesheet" href="css/style.css">
		</head>
		<body>
		    <div class="form">
		        <h2>Sign Up</h2>
		        <p>Please fill this form to create an account.</p>
		        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

		            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
		                <input type="text" name="username" class="form-control" placeholder="Username" value="<?php echo $username; ?>">
		                <span class="help-block"><?php echo $username_err; ?></span>
		            </div>

		            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
		                <input type="password" name="password" class="form-control" value="<?php echo $password; ?>" placeholder="Password">
		                <span class="help-block"><?php echo $password_err; ?></span>
		            
		            </div>

		            <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
		                <input type="password" placeholder="Confirm Password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>">
		                <span class="help-block"><?php echo $confirm_password_err; ?></span>
		            </div>

		            <div class="form-group <?php echo (!empty($Email_err)) ? 'has-error' : ''; ?>">
		                <input type="Email" name="Email" class="form-control" id="Email" value="<?php echo $Email; ?>" placeholder="Email">
		                <span class="help-block"><?php echo $Email_err; ?></span>
		            
		            </div>

		            <div class="form-group">
		                <button type="submit" value="Register">Register</button><br>
		                <input type="reset" class="btn btn-default" value="Reset">
		            </div>

		            <p class="message">Already have an account? <a href="login.php">Login here</a>.</p>
		        </form>
		    </div>    
		</body>
	</div>
</html>