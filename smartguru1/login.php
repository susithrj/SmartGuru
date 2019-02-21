<?php
   ob_start();
   session_start();
?>


<html lang = "en">
   
   <head>
      <title>Smart Guru | Login</title>
      <link href = "css/bootstrap.min.css" rel = "stylesheet">
      
     
   </head>
	
   <body>
      
      <h2>Smart Guru</h2> 
      <div class = "container form-signin">
         
         
      </div> <!-- /container -->
      
      <div class = "container">
      
         <form class = "form-signin" role = "form" 
            action = "user.php" method = "post">
            <h4 class = "form-signin-heading"></h4>
            <input type = "text" class = "form-control" 
               name = "username" placeholder = "username" 
               required autofocus></br>
            <input type = "password" class = "form-control"
               name = "password" placeholder = "password" required><br>
            <button class = "btn btn-lg btn-primary btn-block" type = "submit" 
               name = "login">Login</button>
         </form>
		     
      </div> 
      
   </body>
</html>