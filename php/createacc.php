<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/style.css">

    <title>Create Account</title>

    <style>
    #moberror,#balerror
    {
        display:none;
    }
    </style>

    <?php
        include 'connection.php';
        if(isset($_POST["submit"]))
        {

            $name= $_POST['name'];
            $mobnum=$_POST['mobnum'];
            $balance= $_POST['balance'];
            $gender=$_POST['gender'];
            if(strlen($mobnum)<10 or strlen($mobnum)>10)
            {
                echo "
                <style>
                #moberror
                {
                    display:block;
                }
                </style>
                ";
              echo "<h3 style='padding-top:1%;padding-bottom:1%;text-align:center;background-color:orange;color:blue;'>Please Recheck the Data!</h3>";

            }
            else if($balance<=500)
            {
                echo "
                <style>
                #balerror
                {
                    display:block;
                }
                </style>
                ";
              echo "<h3 style='padding-top:1%;padding-bottom:1%;text-align:center;background-color:orange;color:blue;'>Please Recheck the Data!</h3>";

            }
            else{
             $que="insert into newholder(name,mobilenum,balance,gender) values('$name',$mobnum,$balance,'$gender')";
              
               $conn->exec($que);
              echo "<h3 style='padding-top:1%;padding-bottom:1%;text-align:center;background-color:orange;color:blue;'>Data Inserted Successfully!</h3>";
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
                <a id="current" href="createacc.php">Create Account</a>
                <a href="viewholder.php">View Holders</a>
                <a href="MakeTran.php">Make Transactions</a>
                <a href="ViewTran.php">View Transaction</a>
            </nav>
    </section>

    

    <section id="CreateAccount">
        <div>
        <form method="POST">
            <h3 style="text-align: center;">Create The New Account</h3>
            <table>
                <tr>
            <td><label for="Name">Enter the Name : </label></td>
            <td><input name="name" type="text" required></td>
                 </tr>

                 <tr>
            <td><label for="Mobile">Enter the Mobile Number : </label></td>
            <td><input name="mobnum" type="number" required></td>
            <td>
                <span id="moberror" style="color:red;">Mobile number should be of 10 digits</span>
                </td>
                 </tr>

                 <tr>
            <td><label for="Balance">Enter the Initial Balance : </label></td>
            <td><input name="balance" type="number" required></td>
            <td>
                <span id="balerror" style="color:red;">Balace amount should be greater than 500</span>
                </td>
                 </tr>
                 
                   <tr>
            <td><label for="gender">Select the Gender : </label></td>
            <td><label for="Mgen">Male</label><input type="radio" name="gender" value="male" required>
                <label for="Fgen" style="margin-left: 10%;">Female</label> 
                <input  type="radio" name="gender" value="female" required></td>
                 </tr>

                <tr><td><input style="margin-left: 80%;" id="subbut" name="submit" type="submit" value="CREATE ACCOUNT"></td></tr>
        </table>
        </form>
    </div>
    </section>

    <footer>
    
    <script>
        if(window.history.replaceState)
        {
            window.history.replaceState(null,null,window.location.href);
        }
    </script>
    </footer>
</body>
</html>