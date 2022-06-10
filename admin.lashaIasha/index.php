<?php
session_start();
if(isset($_SESSION["id"]) && isset($_SESSION["username"]) &&  isset($_SESSION["status"])){
  if($_SESSION["status"] === true){
    header("location: ./admin_page.php");
  }
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Lands bot website</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link href="./css/login.css" rel="stylesheet" id="bootstrap-css">
  </head>

  <body>
      <!-- Include the above in your HEAD tag -->

      <div class="wrapper fadeInDown">
        <div id="formContent">
          <!-- Tabs Titles -->

          <!-- Icon -->
          <div class="fadeIn first">
            <img src="./images/avatar.png" id="icon" alt="User Icon" />
          </div>

          <!-- Login Form -->
          <form >
            <input type="text" id="username" class="fadeIn second" name="username" autocomplete="off" placeholder="Username">
            <input type="password" id="password" class="fadeIn third" name="password" autocomplete="off" placeholder="Password">
            <input type="submit" class="fadeIn fourth" id="submit" value="login">
            <p id="message" class="fadeIn"><strong>This line rendered as bold text.</strong></p>
          </form>

          <!-- Remind Passowrd -->
          <div id="formFooter">
            <a class="underlineHover" href="#">Welcome</a>
          </div>

        </div>
      </div>

</body>
<script type="text/javascript">
  const submit = document.getElementById("submit");

  submit.addEventListener("click", (e)=>{
      e.preventDefault();

      submit.setAttribute("disabled",true);

      const username = document.getElementById("username");
      const password = document.getElementById("password");
      const message = document.getElementById("message");
      message.style.visibility = "visible";
      message.firstChild.textContent = "";
      if(username.value.length == 0){
        message.firstChild.textContent = "Enter username";
        submit.disabled = false;
      }else if (username.value.length < 3){
        message.firstChild.textContent = "Too short username";
        submit.disabled = false;
      }else if (password.value.length == 0){
        message.firstChild.textContent = "Enter password";
        submit.disabled = false;
      }else if(password.value.length<8 ){
        message.firstChild.textContent = "Too short password";
        submit.disabled = false;
      }else{
        const data = new FormData();
        data.append("username",username.value);
        data.append("password",password.value);
        fetch('./templates/login.php', {
          method: 'POST',
          headers: {

          },
          body: data
        })
        .then((response) => {
          return response.text();
        })
        .then(data => {
          const response = JSON.parse(data);
          console.log(response,"asdasd");
          if (response["status"] === false){
            message.firstChild.textContent = response["message"];
            submit.disabled = false;
          }else{
            location.reload();
          }
        })
        .catch((error) => {
          message.firstChild.textContent = "Something went wrong";
          submit.disabled = false;
        });
      }

  });

</script>


</html>
