<!-- MindKraft CMS v0.3
Copyright (c) 2017 Z-Coders  -->

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>MindKraft CMS</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/cms-master.css">
  </head>
  <body>
    <div class="container">
        <div class="jumbotron">
          <div class="container">
            <h1 class="display-3">CMS - Login</h1>
            <br>
            <form class="form-inline" action="cms/authenticate.php" id="login-form" method="post">
              <div class="form-group">
                <label for="email" id="user">Username :</label>
                <input type="text" class="form-control" id="email" name="user" placeholder="Your ID here." required>
                </div>
                <p></p>
                <div class="form-group">
                <label for="password" id="pass">Password :</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Your password here." required>
              </div>
            </form>
            <hr class="m-y-md">
            <input type="submit" form="login-form" name="" value="Login" class="btn btn-primary btn-lg">
        </div>
      </div>
      </div>
  </body>
</html>
