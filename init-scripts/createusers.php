<?php
  // CMS Initializer
  // Copyright (c) Z-Coders

  $root_sql = parse_ini_file('sqlconf.ini', true)['sqlconf-root'];
  $prefixes = parse_ini_file('sqlconf.ini', true)['sqlconf-prefixes'];
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
        <h1 id="heading">Create User Group</h1>
      </div>
      <form class="" action="create_users.php" method="post">
        <fieldset name="DatabaseSettings">
        	<legend>Database Connection Settings</legend>
        	<table border="0" width="580px">
        		<tr>
        			<td width="210px"><label for="MySQLServerHost">mysql Server Host:</label></td>
        			<td><input type="text" value="<?php echo $root_sql['sql_hostname']?>" disabled></td>
        		</tr>
        		<tr>
        			<td><label for="MySQLDatabase">Database:</label></td>
        			<td><input type="text" autocomplete="off" value="<?php echo $root_sql['sql_database']?>" disabled></td>
        		</tr>
        		<tr>
        			<td><label for="MySQLTablePrefix">Table Prefix:</label></td>
        			<td><input type="text" value="<?php echo $prefixes['sql_table_prefix']?>" disabled></td>
        		</tr>
            <tr>
              <td><label for="MySQLViewPrefix">View Prefix:</label></td>
              <td><input type="text" value="<?php echo $prefixes['sql_view_prefix']?>" disabled></td>
            </tr>
        	</table>
        </fieldset>
        <br><br><br>
        <fieldset name="DatabaseSettings">
        	<legend>Database Settings For CMS administrator</legend>
        	<table border="0" width="580px">
        		<tr>
        			<td><label for="MySQLUsername">Username:</label></td>
        			<td><input type="text" name="adminUsername" value="" autocomplete="off" required></td>
        		</tr>
        		<tr>
        			<td><label for="MySQLPassword">Password:</label></td>
        			<td><input type="password" name="adminPassword" id="MySQLPassword" autocomplete="off" value="" required></td>
        		</tr>
        	</table>
        </fieldset>
        <br><br><br>
        <fieldset name="DatabaseSettings">
        	<legend>Database Settings For Enduser</legend>
        	<table border="0" width="580px">
        		<tr>
        			<td><label for="MySQLUsername">Username:</label></td>
        			<td><input type="text" name="enduserUsername" value="" autocomplete="off" required></td>
        		</tr>
        		<tr>
        			<td><label for="MySQLPassword">Password:</label></td>
        			<td><input type="password" name="enduserPassword" autocomplete="off" value="" required></td>
        		</tr>
        	</table>
        </fieldset>
        <br><br><br>
        <input type="submit" name="" value="Continue">
      </form>
    </div>

  </body>
</html>
