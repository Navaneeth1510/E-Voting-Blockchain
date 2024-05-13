<?php
    include('InsertIntoResult.php');
    $con = mysqli_connect('localhost', 'root', '', 'e-voting') or die("Connection failed: " . mysqli_connect_error()); 

    //for pie chart
    $sql = "SELECT c.FullName AS name, COUNT(v.candidate_id) AS count FROM candidate_list c 
    LEFT JOIN votes v ON c.candidate_id = v.candidate_id GROUP BY c.Candidate_ID";
    $result = mysqli_query($con, $sql);

    //the table
    $sql1="SELECT c.FullName, p.Party_Name, r.Vote_Count FROM result r,candidate_list c, party_list p 
    WHERE r.Candidate_ID=c.Candidate_ID AND c.Party_ID=p.Party_ID GROUP BY c.Candidate_ID";
    $result1 = mysqli_query($con, $sql1);

    //the winner
    $sql2="SELECT t.Candidate_ID, c.FullName, p.Party_Name from (SELECT Candidate_ID, Vote_Count FROM result 
    ORDER BY Vote_Count DESC LIMIT 1) as t,candidate_list c, party_list p WHERE t.Candidate_ID=c.Candidate_ID AND c.Party_ID=p.Party_ID";
    $result2 = mysqli_query($con, $sql2);
    $row3 = mysqli_fetch_array($result2);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Result</title>
    <script src="Disable.js"></script>
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
    <script type="text/javascript">
        window.onload = function () {
            var chart = new CanvasJS.Chart("chartContainer", {
                title: {
                    text: "Votes per Candidate"
                },
                legend: {
                    maxWidth: 350,
                    itemWidth: 120
                },
                data: [
                    {
                        type: "pie",
                        showInLegend: true,
                        legendText: "{indexLabel}",
                        dataPoints: [
                            <?php 
                                while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                                { y: <?php echo $row['count']; ?>, indexLabel: "<?php echo $row['name']; ?>" },
                            <?php 
                                }
                            ?>
                        ]
                    }
                ]
            });
            chart.render();
        }
    </script>
    <style>
        body{
            background-color: #DEFBF9 ;
            background-blend-mode: darken;
            background-attachment: fixed;
        }
        .header{
            background-color:black;
            border:4px solid black;
            height:0.8rem;
            padding:8px 0 35px 0;
        }
        #c1{
            font-size:35px;
            color:#DEFBF9;
            font-family: "Times New Roman", Times, serif; 
        }
        .table{
            border-collapse: collapse;
            box-shadow: 0 0 20px rgba(0,0,0,0.15);
            width: 50%;
            border: 1px solid #E2DBDA;
            padding: 4px 0px 4px 0px;
            border-radius:4px 4px 0 0;
            margin:4% 25% 0% 15%;
            background-color: black;
            color:white;
            overflow: hidden ;
            align-items: center;
            text-align: center;
        }
        .table thead tr{
            font-weight: bold;
            font-size:1.4rem;
            color:white;
            background-color:black;
            border-bottom: 4px solid black;
            padding:1%;
            text-align:center;
        }
        .table tbody tr{
            font-size: 1.1rem;
        }
        .table tbody th,.table tbody td{
            padding:5px 5px;
            color:black;
        }
        .table tbody tr{
            border-bottom: 1px solid #E2DBDA ;
        }
        .table tbody tr:nth-of-type(even){
            background-color:#C3C2C0;
        }
        .table tbody tr:nth-of-type(odd){
            background-color:#DAD9D7;
        }
        .table tbody tr:last-of-type{
            border-bottom: 4px solid black;
        }
        .body{
            display: flex;
            /* border:1px solid black; */
            height:100%;
            margin:1%;
            height: 100%;
            width:80%;
            margin:2% 10% 0 10%;
        }
        .result{
            width:60%;
            height:100%;
            /* border:1px solid black; */
        }
        .heading2{
            font-size:25px;
            font-weight:bold;
            text-decoration:underline;
            padding-top:5%;
            margin:0 0 5% 0%;
            text-decoration: underline;
        }
        .heading3{
            font-size:22px;
            font-weight:bold;
            text-decoration:underline;
        }
        h4, .subheading3{
            font-size:20px;
            font-weight:bold;
            margin-left:5%;
            margin-top:-1%;
        }
        .outside{
            /* border:1px solid black; */
            width:30%;
            height:60vh;
            /* margin:0 0 0 0%; */
        }
        .chart{
            width:100%;
            height:90%;
            margin:6% 4% 0% 4%;
            padding-top:2%;
        }
        .footer{
            background-color:black;
            border:3px solid black;
            height:1rem;            
            margin:0 0.5% 0.5% 0;
            width:98.65%;
            position: absolute; 
            bottom: 0;
        }
        #c2{
            color:#DEFBF9;
            font-size:15px;
            font-family: "Times New Roman", Times, serif; 
        }
        .body{
            /* width:30%; */
            align-items:center;
            margin-bottom:-3%;
        }
        .back{
            margin-top:3.5%;
            margin-bottom:1.5%;
        }
        .back-button{
            font-weight: bold;
            width:9%;
            border-radius: 10px;
            background-color: red;
            padding:0.5% 0 0.5% 0;
            margin:-10% 0 0 85%;
        }
    </style>
</head>
<body oncontextmenu="return false;">
    <div class="header">
        <center id="c1">GENERAL ELECTIONS - 2024</center>
    </div>
    <div class="body">
        <div class="result">
            <h3 class="heading2">GENERAL ELECTION RESULTS</h3>
            <table class="table">
                <thead>
                    <tr>
                        <th>Candidate</th>
                        <th>Party</th>
                        <th>Votes</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    <?php
                        while($row1 = mysqli_fetch_assoc($result1)){
                            ?>
                            <td><?php echo $row1['FullName']; ?></td>
                            <td><?php echo $row1['Party_Name']; ?></td>
                            <td><?php echo $row1['Vote_Count']; ?></td>
                    </tr>
                            <?php
                        }
                    ?>
                </tbody>
            </table> 
            <br>
            <h3  class="heading3">ELECTION WINNER</h3>
            <h4 class="subheading3">Candidate ID: <?php echo $row3['Candidate_ID']; ?>
            <h4 class="subheading3">Full Name: <?php echo $row3['FullName']; ?>
            <h4 class="subheading3">Party Name: <?php echo $row3['Party_Name']; ?>
        </div>
        <div class="outside">
            <div id="chartContainer" class="chart" style="">
             
            </div>
        </div> 
    </div> 
    <div class="back">
        <a href="EVotingMain1.php"><input type="button" class="back-button" value="Back"></input></a>
    </div>  
    <div class="footer">
        <center id="c2">ELECTION COMMISION OF INDIA</center>
    </div>
</body>
</html>

<?php
    // Close the database connection
    mysqli_close($con);
?>
