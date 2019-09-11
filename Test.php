<?php
function validate_post(){
  global $link;

  if (isset($_POST['submit'])) {
      $cat_err = "";
      if (!isset($_POST['cat_title']) || empty($_POST['cat_title']) || $_POST['cat_title']=="") {
          $cat_err = "field cannot be empty";
      } else {
          //check if a name only contains letters and whitespace
          if (!preg_match("/^[a-zA-Z]*$/", $_POST['cat_title'])) {

              $cat_err = "Only letters and whitespace allowed";
          }
      }
      //if no errors found
      if ($cat_err=="") {
          $cat_title = htmlentities($_POST['cat_title']);
            $sql = "INSERT INTO categories(cat_title)VALUES('$cat_title')";
            $insert = mysqli_query($link, $sql);
            confirm_query($insert);
            if (mysqli_affected_rows($link) == 1) {
                $cat_err = "Category has been added";
                redirect("categories.php");
            } else {
                $cat_err = "Adding category failed";
            }
      } else {
          $cat_err = "Field cannot be empty";
      }
      return $cat_err;
  }
}
?>
<?php $data=validate_post();echo $data;?><!-- call validate_post function-->
<!-- ADD CATEGORY FORM -->
<form action="" method="post">

    <div class="form-group">
        <label for="cat_tile">Categories</label>
        <input type="text" class="form-control" name="cat_title" id="cat_tile"/>
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-primary" value="+ Add Category" name="submit" >
    </div>

</form>



<?php
function validate_post($link, $data=[]) {        
    $error = array();

    if (!isset($data['cat_title']) || empty($data['cat_title'])) {
        $error[] = "field cannot be empty";
    } else {
        //check if a name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z]*$/", $data['cat_title'])) {
            $cat_err = "Only letters and whitespace allowed";
        }
    }
    //if no errors found
    if (empty($error) && empty($cat_err)) {
        $cat_title = htmlentities($data['cat_title']);
        $sql = "INSERT INTO categories(cat_title)VALUES('$cat_title')";
        $insert = mysqli_query($link, $sql);
        confirm_query($insert); //This is another function you created???
        if (mysqli_affected_rows($link) == 1) {
            $post_info = "Category has been added";
            redirect("categories.php");
        } else {
            $post_info = "Adding category failed";
        }
    } else {
        $post_info = "Field cannot be empty";
    }   
}

if (isset($_POST['submit'])) {
    include 'dbfile.php'; // Containing your db link variable if that is how you've done it
    validate_post($link, $_POST); // Usually you need to pass your database link by reference also rather than by global.
}

//===========================================================================================

<?php 
if (isset($_REQUEST['submitted'])) {
// Initialize error array.
  $errors = array();
  // Check for a proper First name
  if (!empty($_REQUEST['firstname'])) {
  $firstname = $_REQUEST['firstname'];
  $pattern = "/^[a-zA-Z0-9\_]{2,20}/";// This is a regular expression that checks if the name is valid characters
  if (preg_match($pattern,$firstname)){ $firstname = $_REQUEST['firstname'];}
  else{ $errors[] = 'Your Name can only contain _, 1-9, A-Z or a-z 2-20 long.';}
  } else {$errors[] = 'You forgot to enter your First Name.';}
  
  // Check for a proper Last name
  if (!empty($_REQUEST['lastname'])) {
  $lastname = $_REQUEST['lastname'];
  $pattern = "/^[a-zA-Z0-9\_]{2,20}/";// This is a regular expression that checks if the name is valid characters
  if (preg_match($pattern,$lastname)){ $lastname = $_REQUEST['lastname'];}
  else{ $errors[] = 'Your Name can only contain _, 1-9, A-Z or a-z 2-20 long.';}
  } else {$errors[] = 'You forgot to enter your Last Name.';}
  
  //Check for a valid phone number
  if (!empty($_REQUEST['phone'])) {
  $phone = $_REQUEST['phone'];
  $pattern = "/^[0-9\_]{7,20}/";
  if (preg_match($pattern,$phone)){ $phone = $_REQUEST['phone'];}
  else{ $errors[] = 'Your Phone number can only be numbers.';}
  } else {$errors[] = 'You forgot to enter your Phone number.';}
  
  if (!empty($_REQUEST['redmapleacer']) || !empty($_REQUEST['chinesepistache']) || !empty($_REQUEST['raywoodash'])) {
  $check1 = $_REQUEST['redmapleacer'];
  if (empty($check1)){$check1 = 'Unchecked';}else{$check1 = 'Checked';}
  $check2 = $_REQUEST['chinesepistache'];
  if (empty($check2)){$check2 = 'Unchecked';}else{$check2 = 'Checked';}
  $check3 = $_REQUEST['raywoodash'];
  if (empty($check3)){$check3 = 'Unchecked';}else{$check3 = 'Checked';}
  } else {$errors[] = 'You forgot to enter your Phone number.';}
  }
  //End of validation 

?>