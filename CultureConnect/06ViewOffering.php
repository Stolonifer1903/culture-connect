<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit products and services</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link href="css/style.css" rel="stylesheet">
</head>
<body>
    <!--Session start-->
    <?php
        session_start();
        include ('include/getOfferingInfo.php');
        $role = $_SESSION['role'];
    ?>
    <table>
        <tr>
            <td><img src='images/placeholder.jpg' width=600 height=600><br><br></td>    
            <td>
                <h1><?php echo $of_name ?></h1><br>
                <h5 style='display: inline-block;'><?php echo $int_name ?></h5> <a href=''><span >See more of this type</span></a><br>
                <h5 style='display: inline-block;'><?php echo $bus_name ?></h5> <a href=''><span>See more from this business</span></a><br>
                <h5 style='display: inline-block;'><?php echo $loc_name ?></h5> <a href=''><span>See more in this location</span></a><br><br>
                <h5>Description</h5>
                <p><?php echo $of_description ?></p>
                <h5>Votes</h5>
                <a <?php echo $role == 1 ? "style=\"cursor: pointer;\" onclick=\"setVote('yes')\"" : "" ?>><img src='images/upvote.svg'></a><span> (<?php echo $of_yes_votes ? $of_yes_votes : 0 ?>) </span>
                <a <?php echo $role == 1 ? " style=\"cursor: pointer;\" onclick=\"setVote('no')\"" : "" ?>><img src='images/downvote.svg'></a><span> (<?php echo $of_no_votes ? $of_no_votes : 0 ?>) </span>
                <a <?php echo $role == 1 ? " style=\"cursor: pointer;\" onclick=\"setVote('clear')\"" : "" ?>><img src='images/clearvote.svg'></a>
            <td>
        </tr>
        <tr>
            <td colspan=2><h5 style='display: inline-block;'>Price:</h5><span>&nbsp&nbsp&nbsp&nbsp<?php echo $of_price_range_description ?></span></td>
        </tr>
        <tr>
            <td colspan=2>
                <h5>Details:</h5>
                <p><?php echo $of_details ?></p>
            </td>
        </tr>
        <tr>
            <td colspan=2>
                <h5>Cultural benefit:</h5>
                <p><?php echo $of_cultural_benefits ?></p>
            </td>
        </tr>
        <tr>
            <td colspan=2>
                <h5>Awards, memberships and exhibitions:</h5>
                <p><?php echo $of_awards ?></p>
            </td>
        </tr>
    </table>
    <form id="of_vote" name="of_vote" action="include/voteOffering.php" method="post">
        <input type="hidden" id="vote_type" name="vote_type" value="">
        <input type="hidden" id="of_id" name="of_id" value=<?php echo $_GET["offeringIdPk"] ?>>
    </form>


    <script>
        function setVote(input){
            document.getElementById('vote_type').value = input;
            document.getElementById('of_vote').submit();
        }
    </script>
</body>
</html>