<!--MYSQLI_ASSOC mean associative array (object passing) -->
<?php

session_start();
include ('connect.php');

$votes=$_POST['groupvotes'];
$totalvotes=$votes+1;

$groupid=$_POST['groupid'];
$userid=$_SESSION['id'];

$sql="UPDATE `userdata` SET votes='$totalvotes' WHERE id='$groupid'";

$updatevotes=mysqli_query($con,$sql);

$sql1="UPDATE `userdata` SET status=1 WHERE id='$userid'";

$updatestatus=mysqli_query($con,$sql1);

if($updatevotes && $updatestatus){
    $getgroups=mysqli_query($con,"SELECT username,photo,votes,id FROM `userdata` WHERE standard='group'");
  
    $groups=mysqli_fetch_all($getgroups,MYSQLI_ASSOC);
    $_SESSION['groups']=$groups;
    $_SESSION['status']=1;

     echo '<script>
    alert("Voting successful");
    window.location="../partials/dashboard.php";
    </script>';

}else{
    echo '<script>
    alert("Technical error !! vote after some time");
    window.location="../partials/dashboard.php";
    </script>';
}



?>