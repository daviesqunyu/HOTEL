<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>register and log-in</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.0/css/all.min.css">


<style>
  *{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;

  }
  body{
    background-color: rgb(16, 3, 65);
    background: -moz-repeating-linear-gradient();

  }
  .container{
    background: #ceeade;
    width: 450px;
    padding: 1.5rem;
    margin: 50px auto;
    border-radius: 10px;
    box-shadow: 0 20px 35px rgba(0,0,1,0,9,6,2);
  }
  form{
    margin: 0 2rem;
  }
  .form-title{
    font-size: 1.5rem;
    font-weight: bold;
    text-align: center ;
    padding: 1.3rem;
    margin-bottom: 0.4rem;
  }
  input{
    color: inherit;
    width: 100%;
    background-color: transparent;
    border: none;
    border-bottom: 1px solid #757575;
   padding-left: 1.5rem;
   font-size: 15px;
   

  }

  .input-group{
    padding: 1%;
    position: relative;
  }

  .input-group i{

    position: absolute;
    color: black;
  }
  .input:focus{
    background-color: transparent;
    outline: transparent;
    border-bottom: 2px solid hsl(from color h s l);
  }
  .input::placeholder{
    color: transparent;
      }
 
 label{
  color: black;
  position: relative;
  left: 1.2rem;
  top: 1.3rem;
  cursor: auto;
  transition: 0.3s ease all;
  
 }
 input:focus~label,input:not(:placeholder-shown)~label{
  top: -3em;
  color: hsl(327, 905, 28%);
  font-size: 15px;
 }
.recover{
  text-decoration-line: underline;
  text-align: right;
  font-size: 1.3rem;
  margin-bottom: 1rem;

}
.recover a{
text-decoration:none;
color: rgb(11, 11, 224) ;

}
.recover a:hover{
  color: blue;
  text-decoration: underline;
}
.btn{
  font-size: 1.1rem;
  padding: 8px 0;
  border-radius: 5px;
  outline: none;
  border: none;
  width: 100%;
  background: rgb(12, 12, 220) ;
  color: white;
  cursor: pointer;
  transition: 0.9s;

}
.btn:hover{
  color: rgba(3, 3, 3, 0.715);
}
.or{
  font-size: 1.1rem;
  margin-top: 0.5rem;
  text-align: center;
  
}
.icons{
  text-align: center;
}
.icons i{
  color:rgb(119, 31, 178);
  padding: 0.8rem;
  border-radius: 10px;
  font-size: 1.5rem;
  cursor: pointer;
  border: 2px solid #090c0e;
  margin: 0 15px;
  transition: 1s;
}
.icons i:hover{
  background: #07001f;
  font-size:1.6rem;
  border: 2px solid rgb(125, 125, 235) ;
}
.link{
  display: flex;
  justify-content: space-around;
  padding: 0 4rem;
  margin-top: 0.9rem;
  font-weight: bold;

}
button{
  color: rgb(6, 12, 8) ;  
  border-top-right-radius: 0.5px;
  border-block-end-style: double;
  background-color: rgb(73, 147, 73);
  font-size: 1rem;
  font-weight: bold;
}
button:hover{
  text-decoration: underline;
  color: rgb(30, 30, 167);
}

</style>

</head>
<body>
<!-- sign up form -->
  <div class="container" id="signup" style="display:none;">

  <h1 class="form-title">Register</h1>
  <form method="post" action="register.php">

<div class="input-group">
  <i class="fas fa-user"></i>
  <input type="text" name="fName" id="fName">
  <label for="FName">First Name</label>
</div>

<div class="input-group">
  <i class="fas fa-user"></i>
  <input type="text" name="lName" id="lName">
  <label for="FName">Last Name</label>
</div>

<div class="input-group">  
  <i class="fas fa-envelope"></i>
  <input type="email" name="email" id="email">
  <label for="email">E-Mail</label>
</div>

<div class="input-group">  
  <i class="fas fa-lock"></i>
  <input type="password" name="password" id="password" placeholder="password">
  <label for="password"></label>
</div>

<br>

<input type="submit" class="btn" value="Sign Up" name="Sign Up">
</form>


<p class="or">
--------------or--------------
</p>

<div class="icons">
<i class="fab fa-google"></i>
<i class="fab fa-facebook"></i>
<i class="fab fa-instagram"></i>
<i class="fab fa-x"></i>

</div>

<div class="links">
  <p class="account-text">Already have an account?</p>
  <button id="signInButton" class="sign-in-button" aria-label="Sign In to Your Account">
    Sign In
  </button>
</div>
</div>

<!--SIGN UP DUPLICATE-->

<div class="container" id="signIn">
  <h1 class="form-title">Sign In</h1>
  <form method="post" action="register.php">


<div class="input-group">  
  <i class="fas fa-envelope"></i>
  <input type="email" name="email" id="email">
  <label for="email">E-Mail</label>
</div>

<div class="input-group">
  <i class="fas fa-lock"></i>
  <input type="password" name="password" id="password" placeholder="password">
  <label for="password"></label>
</div>

<p class="recover">
  <a href="#">Recover Password</a>
</p>

<input type="submit" class="btn" value="Sign In" name="Sign In">
</form>

<p class="or">
--------------or--------------
</p>

<div class="icons">
<i class="fab fa-google"></i>
<i class="fab fa-facebook"></i>
<i class="fab fa-instagram"></i>
<i class="fab fa-x"></i>
</div>

<div class="links">
  <p>Don't Have Account Yet?</p>
  <button id="signUpButton">Sign Up</button>
</div>

</div>


<script>
const signUpButton = document.getElementById('signUpButton');
const signInButton = document.getElementById('signInButton');
const signInForm = document.getElementById('signIn'); 
const signUpForm = document.getElementById('signup'); 

signUpButton.addEventListener('click', function () {
    signInForm.style.display = "none"; 
    signUpForm.style.display = "block"; 
});

signInButton.addEventListener('click', function () {
    signInForm.style.display = "block"; 
    signUpForm.style.display = "none"; 
});

   
</script>



</body>
</html> 