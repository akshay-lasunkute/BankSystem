<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/style.css">

    <title>View Transaction</title>
    <?php
        include 'connection.php';
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
                <a href="MakeTran.php">Make Transactions</a>
                <a id="current" href="ViewTran.php">View Transaction</a>
            </nav>
    </section>

    <section id="ViewHolder">
        <table>
            <tr>
                <th>Sender ID</th>
                <th>Receiver ID</th>
                <th>Transaction Amount</th>
                <th>Time</th>
            </tr>

            
            <?php
                           $stmt = $conn->prepare("select send,receiver,balance,date1 from transaction");
                           $stmt->execute();
                    
                           $result = $stmt->fetchAll();
                    
                           foreach($result as $re)
                           {
                                echo "<tr>
                                    <td>$re[send]</td>
                                    <td>$re[receiver]</td>
                                    <td>$re[balance]</td>
                                    <td>$re[date1]</td>
                                    </tr>";
                           }
            ?>

        </table>
    </section>

</body>
</html>