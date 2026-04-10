
function toggleFieldsManageUser(user_type) {
    console.log("toggleFieldsManageUser called with: " + user_type);
    var gender = document.getElementById("gender")
    var yob = document.getElementById("birth_year")
    var interests = document.getElementById("interests")
    var location = document.getElementById("location")

    if (user_type === "resident") {
        gender.style.display = "";
        yob.style.display = "";
        interests.style.display = "";
        location.style.display = "";
    } else {
        gender.style.display = "none";
        yob.style.display = "none";
        interests.style.display = "none";
        location.style.display = "none";
    }
}


