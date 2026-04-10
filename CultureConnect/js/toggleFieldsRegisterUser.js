
function toggleFieldsRegisterUser(register_as) {
    console.log("toggleFieldsRegisterUser called with: " + register_as);
    var gender = document.getElementById("gender")
    var yob = document.getElementById("birth_year")
    var interests = document.getElementById("interests")
    var location = document.getElementById("location")
    var business = document.getElementById("business_name")
    var user_type = document.getElementById("user_type")
    var council = document.getElementById("council")
    var council_msg = document.getElementById("council_msg")

    if (register_as === "resident") {
        gender.style.display = "";
        yob.style.display = "";
        interests.style.display = "";
        user_type.value = 1;
        council.style.display = "none"
        location.style.display = "";
    } else {
        gender.style.display = "none";
        yob.style.display = "none";
        interests.style.display = "none";
        location.style.display = "none";
    }
    if (register_as === "business") {
        business.style.display = "";
        user_type.value = 2;
        council.style.display = ""
    } else {
        business.style.display = "none";
    }
    if (register_as === "council") {
        location.style.display = "none";
        user_type.value = 3;
        council.style.display = ""
        council_msg.style.display = ""
    } else {
        council_msg.style.display = "none"
    }
}


