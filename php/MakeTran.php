<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/style.css">

    <title>Make Transaction</title>

    <style>
        
        #subbut1,#subbut2{
    padding: 2% 2% 2% 2%;
    color: blue;
        }

        span{
            margin-left:1%;
        }

        #subbut2{
            display:none;
        }

    </style>

    <?php
        include 'connection.php';
        session_start();
        $var1=0;
        $_SESSION['sender']="";
        $_SESSION['receiver']="";
        $_SESSION['val1']="";
        $_SESSION['val2']="";
        $_SESSION['val3']="";
        if(isset($_POST['submit']))
        {
            if($_POST['sendid']==$_POST['recid'])
            {
                echo "<h3 style='padding-top:1%;padding-bottom:1%;text-align:center;background-color:orange;color:blue;'>Sender ID and Receiver ID should not be same!</h3>";
            }
            else if($_POST['balance']<=0)
            {
                echo "<h3 style='padding-top:1%;padding-bottom:1%;text-align:center;background-color:orange;color:blue;'>Transaction amount should be greater than 0</h3>";
            }
            else{
            $query="select count(id),name from newholder where id='$_POST[sendid]'";
            $query1="select count(id),name from newholder where id='$_POST[recid]'";

            $stmt = $conn->prepare($query);
            $stmt->execute();
                    
            $result1 = $stmt->fetch();

            $stmt1 = $conn->prepare($query1);
            $stmt1->execute();
                    
            $result2 = $stmt1->fetch();

            if($result1['count(id)'] ==1 and $result2['count(id)']==1)
            {
                $_SESSION['sender']=$result1['name'];
                $_SESSION['receiver']=$result2['name'];
                $_SESSION['val1']=$_POST['sendid'];
                $_SESSION['val2']=$_POST['recid'];
                $_SESSION['val3']=$_POST['balance'];

                    echo "
                        <style>
                            #subbut1{
                                display:none;
                            }
                            #subbut2{
                                display:block;
                            }
                        </style>
                    ";

            }
            else if($result1['count(id)'] ==0)
            {
                echo "<h3 style='padding-top:1%;padding-bottom:1%;text-align:center;background-color:orange;color:blue;'>Please Cross Sender  Verify ID.</h3>";
            }
            else if($result2['count(id)'] ==0)
            {
                echo "<h3 style='padding-top:1%;padding-bottom:1%;text-align:center;background-color:orange;color:blue;'>Please Cross Verify Receiver ID.</h3>";    
            }
            }
        }

        if(isset($_POST['submit2']))
        {
            $query="select balance from newholder where id='$_POST[sendid]'";

            $stmt = $conn->prepare($query);
            $stmt->execute();
                    
            $result1 = $stmt->fetch();

            if($_POST['balance']>$result1['balance'])
            {
                echo "<h3 style='padding-top:1%;padding-bottom:1%;text-align:center;background-color:orange;color:blue;'>Don't Have Sufficient Balance In Sender's Account!</h3>";    
            }
            else
            {
                $query="update newholder set balance = balance-'$_POST[balance]' where id='$_POST[sendid]'";

                $stmt = $conn->prepare($query);
                $stmt->execute();
                
                $query1="update newholder set balance = balance+'$_POST[balance]' where id='$_POST[recid]'";

                $stmt1 = $conn->prepare($query1);
                $stmt1->execute();

                echo "<h3 style='padding-top:1%;padding-bottom:1%;text-align:center;background-color:orange;color:blue;'>Transaction Successfull!</h3>";    

                $date=date("y-m-d");
                $query="insert into transaction values($_POST[sendid],$_POST[recid],$_POST[balance],'$date')";

                $stmt = $conn->prepare($query);
                $stmt->execute();
            }
            
        }
    ?>
</head>
<body>
    <header>
        <section class="upperhead">
           
        <img id="logoimg" src="../img/bank.jpeg" alt="Bank Image">
           <div id="bankname">
               <h1>TOD BANK</h1>
           </div>
            <img id="logoimg1" src="../img/bank.jpeg" alt="Bank Image">
           
        </section>

        <nav class="uppernav">
            <a href="../index.php">HOME</a>
            <a href="aboutus.php">ABOUT US</a>
        </nav>

    </header>

    <section>
            <nav class="sidenav">
                <a href="createacc.php">Create Account</a>
                <a href="viewholder.php">View Holders</a>
                <a id="current" href="MakeTran.php">Make Transactions</a>
                <a href="ViewTran.php">View Transaction</a>
            </nav>
    </section>

    

    <section id="CreateAccount">
        <div>
        <form method="POST">
            <h2 style="text-align: center;">Enter the Details : </h2>
            <table>
                <tr>
            <td><label for="Name">Enter the Sender ID: </label></td>
            <td><input name="sendid" type="number" value=<?php echo $_SESSION['val1']; ?> required></td>
            <td><?php echo "$_SESSION[sender]";?></td>
                 </tr>

                 <tr>
            <td><label for="Mobile">Enter the Receiver ID : </label></td>
            <td><input name="recid" type="number" value=<?php echo $_SESSION['val2']; ?> required></td>
            <td><?php echo "$_SESSION[receiver]";?></td>
                 </tr>

                 <tr>
            <td><label for="Balance">Enter the Transaction Balance : </label></td>
            <td><input name="balance" type="number" value=<?php echo $_SESSION['val3']; ?> required></td>
                 </tr>

                <tr><td><input style="margin-left: 80%;" id="subbut1" name="submit" type="submit" value="Verify The Details">
                </td></tr>

                <tr><td>
                <input style="margin-left: 80%;margin-bottom:5%;margin-top:5%" id="subbut2" name="submit2" type="submit" value="Make The Transaction">
                </td></tr>
        </table>
        </form>
    </div>
    </section>

    <footer>
    
    <script>
        if(window.history.replaceState)
        {
            <?php session_unset(); ?>
            window.history.replaceState(null,null,window.location.href);
        }
    </script>
    </footer>

</body>
</html>