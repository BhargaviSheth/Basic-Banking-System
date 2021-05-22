<title>Transaction History</title>
    <?php 
        include 'links.php'; 
    ?>
     <link rel="stylesheet" type="text/css" href="Style1.css">
     <style>
         .footer {
    position: absolute;
    vertical-align: middle;
    bottom: 0;
    width: 100%;
    height: 70px;
    padding: 25px;
    background-color: rgba(255, 255, 255, 0.5);
}
     </style>

</head>

<body style="background-color: rgb(230, 230, 230);">
    <img class="d-block mx-auto mb-4" src="logo.png" alt="" width="85" height="85" float="left">
    <h2>THE SPARK BANK</h2>

<div class="page-container">

<div class="content-wrap">
    
    


    <div class="container text-center">
        <h2 style="color: info;"><b>Transaction History</b></h2>

        <br>

        <div class="table-responsive">
            <table class="my-table container table table-bordered text-center table-sm table-hover shadow-lg p-3 mb-5 rounded">

                <thead style="background-color: rgb(51, 110, 146); color: white;">
                    <th>Sr.No </th>
                    <th>Sender</th>
                    <th>Reciever</th>
                    <th>Amout_Sent</th>
                    <th>Timestamp</th>
                </thead>

                <?php

                    include 'connection.php';

                    $j = 1;
                    $select = " SELECT * FROM `transfer` ";
                    $query = mysqli_query($conn, $select);
                    $nums = mysqli_num_rows($query);

                    while($res = mysqli_fetch_array($query)) {
                ?>
                    <tr>
                        <td><?php echo $j++ ;?></td>
                        <td><?php echo $res['Sender'] ;?></td>
                        <td><?php echo $res['Reciever'];?></td>
                        <td><?php echo "Rs. " . $res['Amount_Sent'] ;?></td>
                        <td><?php echo $res['Timestamp'] ;?></td>
                    </tr>  
                <?php
                    }
                ?>

            </table>

            <a href="view_customers.php" class="btn" style="background-color: rgb(51, 110, 146); color: white; width: 300px; height: 300px;">View all customers</a>
            <br>
            




        </div>
    </div>
    
    

  



</div>
</div>

</body>

</html>