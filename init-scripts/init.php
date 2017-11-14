<?php
  // CMS Initializer
  // Copyright (c) Z-Coders
  require 'Lite.php';
  $config = new Config_Lite('sqlconf.ini');
  $sqlconf_admin = $config->get('sqlconf-admin');
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>MindKraft CMS Init</title>
    <link rel="stylesheet" href="css/init-master.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
  </head>
  <body>
    <div class="box" id="main">

      <div id="header">
        <h1 id="heading">MindKraft CMS Initializer</h1>
      </div>
      <form class="" action="final.php" method="post">
        <fieldset name="DatabaseSettings">
        	<legend>Database Settings (Create New User) </legend>
        	<table border="0" width="580px">
        		<tr>
        			<td width="210px"><label for="MySQLServerHost">mysql Server Host:</label></td>
        			<td><input type="text" name="MySQLServerHost" id="MySQLServerHost" value="localhost"></td>
        		</tr>
        		<tr>
        			<td width="210px"><label for="MySQLServerPort">mysql Server Port:<br/>(Leave blank if not sure) </label></td>
        			<td><input type="text" name="MySQLServerPort" id="MySQLServerPort" value=""></td>
        		</tr>
        		<tr>
        			<td><label for="MySQLUsername">Username:</label></td>
        			<td><input type="text" name="MySQLUsername" id="MySQLUsername" value="" autocomplete="off"></td>
        		</tr>
        		<tr>
        			<td><label for="MySQLPassword">Password:</label></td>
        			<td><input type="password" name="MySQLPassword" id="MySQLPassword" autocomplete="off" value=""></td>
        		</tr>
        		<tr>
        			<td><label for="MySQLDatabase">Database:</label></td>
        			<td><input type="text" name="MySQLDatabase" id="MySQLDatabase" autocomplete="off" value="mindkraft18_site_db"></td>
        		</tr>
        		<tr>
        			<td><label for="MySQLTablePrefix">Table Prefix:</label></td>
        			<td><input type="text" name="MySQLTablePrefix" id="MySQLTablePrefix" value="mindkraft18_"></td>
        		</tr>
        	</table>
        </fieldset>
        <br><br>
        <input type="submit" name="" value="Continue">
      </form>
    </div>

  </body>
</html>
