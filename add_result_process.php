<!--Start Incolode Head  -->
<?session_start();
$PageTitle = 'Register Process';
include "init.php";
//<!--End Incolode Head  -->

//<!--Start content-->
$users = $_POST['name'];
$passw = $_POST['qw'];
$email = $_POST['er'];
$Address = $_POST['ty'];
$asd = $_POST['as'];
$ddasd = $_POST['df'];
$fvved = $passw + $email +  $Address + $asd +$ddasd ;

$sql_Register = " insert into `Three_Year` (`SNum`,`DataBB`,`DataStructure`,`Compiler`,`SoftwareEnginering`,`OperateSystem`,`Total`)
VALUES
('$users','$passw','$email','$Address','$asd','$ddasd' , '$fvved') " ;

  //  $sql_Register = " insert into `Two_Year` (`SNum`,`Behavior_based_robotics`,`Fuzzy_logic`,`Cognitive_science`,`Genetic algorithm`,`Bionics`,`Total`)
  //                     VALUES
  //                   ('$users','$passw','$email','$Address','$asd','$ddasd' , '$fvved') " ;
    $query_Neme = mysqli_query($con,$sql_Register) or die(error()); 
    
    echo "The scores were successfully recorded";
      // $_SESSION['Name_student'] = $_POST['name'];
      // header('location:home.php');

?>
  <!--END content-->

<!-- Start Include Footer  -->
<? include $tpl . "footer.php";?>
<!-- End Include Footer  -->