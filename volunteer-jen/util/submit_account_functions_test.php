<?php
   require_once("database_connect.php");
   require_once("submit_account_functions_new.php");
   
?>
<head>
<title>Membership functions test</title>
</head>
<body>
<h1>Membership functions test</h1> 
<h3>Members in membership table</h3>
 <p>Dan Everett, drdan@uga.edu <?php print search_for_member_by_email("drdan@uga.edu","Dan","Everett"); ?></p>
<p>Kate Everett, drdan@uga.edu <?php print search_for_member_by_email("drdan@uga.edu","Kate","Everett"); ?></p>
<p>Dan Flintstone,  drdan@uga.edu <?php print search_for_member_by_email("drdan@uga.edu","Fred","Flintstone"); ?></p>
<p>Dan Everett,  fred@flintstone.org <?php print search_for_member_by_email("fred@flintstone.org","Dan","Everett")?></p>
<h3>Email in Security table</h3>
<table border="1">
<tr><th>Email<th>Id
<tr><td>drdan@uga.edu <td><?php print search_for_member_by_email_in_security("drdan@uga.edu");?>
<tr><td>fred@gotrox.com</td> <td><?php print search_for_member_by_email_in_security("fred@gotrox.com");?>
</table>
<h3>Number of matches in Member table</h3>
<table border="1">
<tr><th>First name<th>Last name<th>Zip<th>Number of entries</tr>
<tr><td>Dan<td>Everett<td>30607
<td><?php print how_many_by_name("Dan", "Everett",30607);?>
<tr><td>Dan<td>Devine<td>30607
<td><?php print how_many_by_name("Dan", "Devine",30607);?>
<tr><td>Dan<td>Everett<td>99999
<td><?php print how_many_by_name("Dan", "Everett",99999);?>
</table>
</body>
</html>
