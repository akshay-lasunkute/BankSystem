<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/style.css">

    <title>View Holder</title>
    <?php
        include 'connection.php';
    ?>
    <style>
    tr{
        font-weight:bold;
    }

    th{
        padding-top:1%;
        padding-bottom:1%;
    }
    </style>
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
                <a id="current" href="viewholder.php">View Holders</a>
                <a href="MakeTran.php">Make Transactions</a>
                <a href="ViewTran.php">View Transaction</a>
            </nav>
    </section>

    <section id="ViewHolder">
        <table>
            <tr>
                <th>ID</th>
                <th style="width: 30%;">Name</th>
                <th>Mobile Number</th>
                <th>Account Balance</th>
                <th>Gender</th>
            </tr>

            <?php
                           $stmt = $conn->prepare("select id,name,mobilenum,balance,gender from newholder");
                           $stmt->execute();
                    
                           $result = $stmt->fetchAll();
                    
                           foreach($result as $re)
                           {
                                echo "<tr>
                                    <td>$re[id]</td>
                                    <td>$re[name]</td>
                                    <td>$re[mobilenum]</td>
                                    <td>$re[balance]</td>
                                    <td>$re[gender]</td>
                                    </tr>";
                           }
            ?>

        </table>
    </section>

</body>
</html>