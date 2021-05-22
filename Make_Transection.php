<?php
    include 'connection.php';

    


    if(isset($_POST['submit'])) {
        $Sender = $_POST['Sender'];
        $Reciever = $_POST['Reciever'];
        $Amount_Sent = $_POST['Amount_Sent'];

        $from = "SELECT * FROM `view_customer` WHERE `Sender` = '$Sender'";
        $query = mysqli_query($conn, $from);
        $sql1 = mysqli_fetch_array($query);

        $to = "SELECT * FROM `transfer` WHERE `Reciever` = '$Reciever'";
        $query = mysqli_query($conn, $to);
        $sql2 = mysqli_fetch_array($query);
        
        if ($Amount_Sent == "" OR $Amount_Sent <= 0) {
            echo '<script type="text/javascript">;
                    alert("Please enter valid Amount");
                </script>';

        } else if ($Amount_Sent > $sql1['Balance']) {
            echo '<script type="text/javascript">;
                    alert("Transection Successful");
                </script>';

        } else {
            $new_bal = $sql1['Balance'] - $Amount_Sent;
            $inc_bal = "UPDATE `view_customers` SET `Balance` = '$new_bal' WHERE `C_ID` = '$Sender'";
            mysqli_query($conn, $inc_bal);

            $new_bal = $sql2['Balance'] + $Amount_Sent;
            $dec_bal = "UPDATE `customers` SET `Balance` = '$new_bal' WHERE `NAME`='$Reciever'";
            mysqli_query($conn, $dec_bal);

            $Sender = $sql1['NAME'];
            //$Reciever = $sql2['NAME'];
            $insert = "INSERT INTO `transfer`(`Sender`, `Receiver`, `Amount_Sent`, `Timestamp`) VALUES ('$Sender','$Reciever','$Amount_Sent','$currentDateTime')";
            $query = mysqli_query($conn, $insert);

            if($query) {
                echo '<script type="text/javascript">;
                alert("Transaction Successful");
                window.location.href = "transaction_history.php";
                </script>';
            }
        }

    }
?>



    


<html>
<head>
    <title>Make a Transaction</title>
    <?php 
        include 'links.php';
        include 'Connection.php';

    

    ?>
    <link rel="stylesheet" type="text/css" href="style1.css">
</head>
<style>
	h2{
		color: white;
  text-shadow: 2px 2px 4px black, 0 0 35px red, 0 0 15px red;
  cursor: pointer;
	}
</style>

<body style="background-color: rgb(230, 230, 230);">
	<img class="d-block mx-auto mb-4" src="logo.png" alt="" width="85" height="85" float="left">
	<h2>THE SPARK BANK</h2>

<div class="page-container">

<div class="content-wrap">
   
 

    <div class="container text-center">
        <h2 style="text-align: center;font-size: 30px; "><b>Transfer Money</b></h2>
        <br>

       


        <form method="POST" class="dropdown"> 

        <div class="container table-responsive">
            <table class="container table table-bordered text-center table-sm table-hover shadow-lg p-3 mb-5 rounded" style="width: 80%;">

                <thead>
                    <th style="width: 50%; background-color: rgb(51, 110, 146); color: white;">SENDER</th>

                    <th style="width: 50%; background-color: rgb(51, 110, 146); color: white;">RECEIVER</th>
                </thead>

                <tr>
                    <td name="Sender" style="vertical-align: middle;">
                    	<b><p>Pavan Raval (balance Rs:8000)</p></b>

                    </td>
                     



                    <td class="select" style="padding-top: 15px; padding-bottom: 17px;" >



                    <select name="Reciever" style="width: 85%; color: black;" class="custom-select" data-live-search="true">

                   


                            <div class="form-group">
                            	<?php
                            	$Connection = mysqli_connect("localhost","root", "","The_Spark_Bank");

                            	$query="SELECT * FROM `view_customer`";
					$result= mysqli_query($Connection,$query);
					$row = mysqli_num_rows($result);

                            	?>
                            	

                            		
                            	

                                <option selected disabled>-Select reciever-</option>
                                	<?php 
									if($row>0)
									{
										while($res = mysqli_fetch_assoc($result))
										{
											echo '<option value="'.$res['C_ID'].'">'.$res['NAME'].'</option>';
										}
									}
									else
									{
										echo '<option value="">reciever not found</option>';
									}
								?>	
                                	

                                    

                                
                            

                            </div>

                        

                        </select>

                    </td>

                </tr>
                   

                <tr>
                	
                	
                </tr>

                <tr>
                    <th colspan=4 style="background-color: rgb(51, 110, 146); color: white; ">AMOUNT</th>
                </tr>

                <tr>
                    <td colspan=3>
                        
                            <div class="input-group form-group container" style="width: 430px !important; padding: 0px;margin: 0px; padding-bottom: 0px;">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Rs.</span>
                                </div> 

                                <input type="text" name="Amount_Sent" class="form-control" placeholder="Enter Amount" style="align-items: center;">
                                

	
	


                            </div>
                        
                    </td>
                </tr>

            </table>
            
            
            <input type="submit" name="submit" value="Send" class="btn" style="width: 200px;height: 50px; background-color: rgb(51, 110, 146); color: white; align-self: center; ">


        </div>

        </form>
    </div>

    <br>

    

</div>
<a href="Transection_History.php",button type="button" class="btn btn-primary">Transection History</button>
</a>

</body>
</html>