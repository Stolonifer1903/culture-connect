<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enter your details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body style="margin: 100px; justify-items: center; justify-content: center;">
    <h1>Enter your details</h1>
    <br>
    <form id="AddUser" name="AddUser" action="include/addUser.php" method="post">
        <table class="table" style="border-color: white;" >
            <tr>
                <td><label for="fullName">Full Name:</label></td>
                <td><input type="text" id="fullName" name="fullName" required size="65%"></td>
            </tr>
            <tr>
                <td><label for="email">Email:</label></td>
                <td><input type="email" id="email" name="email" required size="65%"></td>
            </tr>
            <tr>
                <td><label for="password">Password:</label></td>
                <td><input type="password" id="password" name="password" required size="65%"></td>
            </tr>
            <tr>
                <td><label for="YOB">Year of birth:</label></td>
                <td><input type="number" id="yob" name="yob" min="1925" max="2020"></td>
            </tr>
            <tr>
                <td><label>Gender:</label></td>
                <td>
                    <input type="radio" id="male" name="gender" value="Male">
                    <label for="male"style="margin-right:25px">Male </label>
                    <input type="radio" id="female" name="gender" value="Female">
                    <label for="female" style="margin-right:25px">Female </label>
                    <input type="radio" id="preferNotToSay" name="gender" value="preferNotToSay">
                    <label for="preferNotToSay" style="margin-right:25px">Prefer not to say </label>
                </td>
            </tr>
            <tr>
                <td><label>Interests:</label></td>
                <td>
                    <table>
                        <tr>
                            <td>
                                <input type="checkbox" id="artClasses" name="services" value="ArtClasses">
                                <label for="artClasses">Art classes</label>
                            </td>
                            <td>
                                <input type="checkbox" id="music" name="services" value="musicLessons">
                                <label for="music">Music lessons</label>
                            </td>
                            <td>
                                <input type="checkbox" id="liveTheatre" name="services" value="liveTheatre">
                                <label for="liveTheatre">Live theatre performances</label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="checkbox" id="concerts" name="services" value="concerts">
                                <label for="concerts">Concerts</label>
                            </td>
                            <td>
                                <input type="checkbox" id="openMic" name="services" value="openMic">
                                <label for="openMic">Open mic nights</label>
                            </td>
                                                        
                            <td>
                                <input type="checkbox" id="tours" name="services" value="tours">
                                <label for="tours">Guided cultural tours</label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="checkbox" id="museums" name="services" value="museums">
                                <label for="museums">Museum visits</label>
                            </td>
                            <td>                                        
                                <input type="checkbox" id="gallerys" name="services" value="gallerys">
                                <label for="gallerys">Gallery visits</label>
                            </td>
                            <td>
                                <input type="checkbox" id="photography" name="services" value="photography">
                                <label for="photography">Photography services</label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="checkbox" id="videography" name="services" value="videography">
                                <label for="videography">Videography services</label>
                            </td>
                            <td>
                                <input type="checkbox" id="graphicDesign" name="services" value="graphicDesign">
                                <label for="graphicDesign">Graphic design</label>
                            </td>
                            <td>
                                <input type="checkbox" id="digitalDesign" name="services" value="digitalDesign">
                                <label for="digitalDesign">Digital design</label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="checkbox" id="artwork" name="products" value="artwork">
                                <label for="artwork">Original artwork</label>
                            </td>
                            <td>
                                <input type="checkbox" id="ceramics" name="products" value="ceramics">
                                <label for="ceramics">Handmade ceramics</label>
                            </td>
                            <td>
                                <input type="checkbox" id="books" name="products" value="books">
                                <label for="books">Independent books</label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="checkbox" id="zines" name="products" value="zines">
                                <label for="zines">Local zines and magazines</label>
                            </td>
                            <td>
                                <input type="checkbox" id="posters" name="products" value="posters">
                                <label for="posters">Limited edition posters</label>
                            </td>
                            <td>
                                <input type="checkbox" id="stationery" name="products" value="stationery">
                                <label for="stationery">Artisan stationery</label>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td><label for="Council">Council:</label></td>
                <td>
                    <select id="council" name="council">
                        <option value="selectCouncil">Select council&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</option>
                        <option value="welwynAndHatfield">Welwyn and Hatfield</option>
                        <option value="watford">Watford</option>
                        <option value="stAlbans">St Albans</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td><label for="Location">Location:</label></td>
                <td>
                    <select id="location" name="location" width = 50%>
                        <option value="selectCouncil">Select location</option>
                        <option value="Welwyn Garden City">Welwyn Garden City</option>
                        <option value="Hatfield">Hatfield</option>
                        <option value="St Albans">St Albans</option>
                        <option value="Harpenden">Harpenden</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td><label for=""></label></td>
                <td><table>
                    <tr>
                        <input class='btn btn-primary btn-sm' style="margin-right:25px;" type="submit" value="Register">
                        <input class='btn btn-secondary btn-sm' style="margin-right:25px"action="action" type="button" value="Cancel" 
                                onclick="window.history.go(-1); return false;" />
                    </tr>
                </td></table>
            </tr>
        </table>
    </form>
</body>
</html>
        