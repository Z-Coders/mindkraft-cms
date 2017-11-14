<?php
  if ($_POST['opt'] == 'games') {
    games();
  }
  elseif ($_POST['opt'] == 'events') {
    events();
  }
  elseif ($_POST['opt'] == 'workshops') {
    workshops();
  }
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>MindKraft CMS</title>
  </head>
  <body>
    <?php function games(){ ?>
      <form class="" action="game.php" method="post">
        <p>Game Name : <input type="text" name="name" value=""></p>
        <p>Co-ordinator <input type="text" name="incharge" value=""></p>
        <p>Co-ordinator Contact : <input type="text" name="mobile" value=""></p>
        <p>Fee : <input type="text" name="fee" value=""> (Enter 0 if free) </p>
        <p>Prize : <input type="text" name="prize" value=""> (Leave empty if none) </p>
        Description | Rules : <br>
        <textarea name="description" rows="8" cols="80"></textarea>
        <br>
        <input type="submit" name="" value="Submit">
      </form>
    <?php } ?>
    <?php function events(){ ?>
      <form class="" action="event.php" method="post">
        <p>Event Name : <input type="text" name="name" value=""></p>
        <p>
          Department :
          <select class="" name="department">
            <option value="ae" selected>AE</option>
            <option value="bt">BT</option>
            <option value="ce">CE</option>
            <option value="cse">CSE</option>
            <option value="ece">ECE</option>
            <option value="eee">EEE</option>
            <option value="eie">EIE</option>
            <option value="fp">Food Pro</option>
            <option value="nano">Nano</option>
            <option value="me">MECH</option>
            <option value="mt">EMT</option>
          </select>
        </p>
        <p>Co-ordinator <input type="text" name="incharge" value=""></p>
        <p>Co-ordinator Contact : <input type="text" name="mobile" value=""></p>
        <p>Fee : <input type="text" name="fee" value=""> (Enter 0 if free) </p>
        <p>Prize : <input type="text" name="prize" value=""> (Leave empty if none) </p>
        Description | Rules : <br>
        <textarea name="description" rows="8" cols="80"></textarea>
        <br>
        <input type="submit" name="" value="Submit">
      </form>
    <?php } ?>
    <?php function workshops(){ ?>
      <form class="" action="workshop.php" method="post">
        <p>Workshop Name : <input type="text" name="name" value=""></p>
        <p>Co-ordinator <input type="text" name="incharge" value=""></p>
        <p>Co-ordinator Contact : <input type="text" name="mobile" value=""></p>
        <p>Fee : <input type="text" name="fee" value=""> (Enter 0 if free) </p>
        Description | Rules : <br>
        <textarea name="description" rows="8" cols="80"></textarea>
        <br>
        <input type="submit" name="" value="Submit">
      </form>
    <?php } ?>
  </body>
</html>
