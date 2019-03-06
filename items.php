<?php
session_start();
$PageTitle = 'Show Items';
include "init.php";
//Check if Get Request itemid Is Numeric & Get The integar Value Of It
    $itemid = isset($_GET['itemid']) && is_numeric($_GET['itemid']) ? intval($_GET['itemid']) : 0;

    $stmt = $con->prepare("SELECT * FROM `items` WHERE `item_ID` = ? ");
    $stmt->execute(array($itemid));
    $item = $stmt->fetch();

?>
	<h1 class="text-center"><?php echo $_SESSION['user'] . $item['Name']; ?></h1>

<?php

 include $tpl . "footer.php";
 ?>
