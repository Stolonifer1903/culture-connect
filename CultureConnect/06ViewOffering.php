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
        echo "
            <table>
                <tr>
                    <td><img src='images/placeholder.jpg' width=600 height=600><br><br></td>    
                    <td>
                        <h1>". $of_name . "</h1><br>
                        <h5 style='display: inline-block;'>". $int_name . "</h5> <a href=''><span >See more of this type</span></a><br>
                        <h5 style='display: inline-block;'>". $bus_name . "</h5> <a href=''><span>See more from this business</span></a><br>
                        <h5 style='display: inline-block;'>". $loc_name . "</h5> <a href=''><span>See more in this location</span></a><br><br>
                        <h5>Description</h5>
                        <p>". $of_description . "</p>
                        <h5>Votes</h5>
                        <a href='images/upvote.svg'><img src='images/upvote.svg'></a>
                        <a href='images/downvote.svg'><img src='images/downvote.svg'></a>
                        <a href='images/clearvote.svg'><img src='images/clearvote.svg'></a>
                        
                    <td>
                </tr>
                <tr>
                    <td colspan=2><h5 style='display: inline-block;'>Price:</h5><span>   ". $of_price_range_description . "</span></td>
                </tr>
                <tr>
                    <td colspan=2>
                        <h5>Details:</h5>
                        <p>". $of_details . "</p>
                    </td>
                </tr>
                <tr>
                    <td colspan=2>
                        <h5>Cultural benefit:</h5>
                        <p>". $of_cultural_benefits . "</p>
                    </td>
                </tr>
                <tr>
                    <td colspan=2>
                        <h5>Awards, memberships and exhibitions:</h5>
                        <p>jdhafkjhflsflashlfadsfahsfdsfklafhskdfjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjj
                            jjjjjjjjjjjjjjjjjjjjjffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffff</p>
                    </td>
                </tr>
            </table>";
    ?>
</body>
</html>