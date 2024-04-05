<?php  
// Start the session  
session_start();  
  
// Function to logout the user  
function logout() {  
    // Unset all session variables  
    $_SESSION = array();  
  
    // Destroy the session  
    session_destroy();  
  
    // Redirect to the login page or any other desired page  
    header("Location: login.php");  
    exit;  
}  
  
// Call the logout function to log the user out  
logout();  
?> 