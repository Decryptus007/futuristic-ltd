<?php 

ob_start();

session_start();
include_once('../includes/config.php');
if (strlen($_SESSION['adminid']==0)) {
  header('location:logout.php');
  ob_end_flush();

  } else{
// for deleting user
if(isset($_GET['id']))
{
$adminid=$_GET['id'];
$msg=mysqli_query($con,"DELETE FROM users WHERE id='$adminid'");
if($msg)
{
echo "<script>alert('Data deleted');</script>";
}
}
   ?>

        <?php 
    $adminid=$_SESSION['adminid'];
    $query=mysqli_query($con,"SELECT * FROM admin WHERE id='$adminid'");
    while($result=mysqli_fetch_array($query))
    {           
        $_SESSION['id']= $result['id'];
        $_SESSION['username']= $result['username'];
        $_SESSION['password']= $result['password'];

             } 
      ?>

                   <table class="table">
                        <thead>

                                        <tr>
                                             <th>Sno.</th>
                                  <th>First Name</th>
                                  <th> Last Name</th>
                                  <th> Email Id</th>
                                  <th>Contact no.</th>
                                  <th>Reg. Date</th>
                                  <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                             <th>Sno.</th>
                                  <th>First Name</th>
                                  <th> Last Name</th>
                                  <th> Email Id</th>
                                  <th>Contact no.</th>
                                  <th>Reg. Date</th>
                                  <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>

                                    <?php $ret=mysqli_query($con,"SELECT * FROM users");
                              $cnt=1;
                              while($row=mysqli_fetch_array($ret))
                              {?>
                              <tr class="table-active">
                              <td><?php echo $cnt;?></td>
                                  <td><?php echo $row['fname'];?></td>
                                  <td><?php echo $row['lname'];?></td>
                                  <td><?php echo $row['email'];?></td>
                                  <td><?php echo $row['contactno'];?></td> 
                                 <td><?php echo $row['posting_date'];?></td>
                                  <td>
                                     
                                     <a href="user-profile.php?uid=<?php echo $row['id'];  ?>">Edit </a>  <br><br>
                                     <a href="total-users.php?id=<?php echo $row['id'];    ?>" onClick="return confirm('Do you really want to delete');">Delete</a>
                                  </td>
                              </tr>
                              <?php $cnt=$cnt+1; }?>

                            
                        </tbody>
                    </table>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Contextual classes table ends -->
                                    


                                </div>
                                <!-- Page-body end -->
                            </div>
                        </div>
                        <!-- Main-body end -->
                                      
  <?php  } ?>