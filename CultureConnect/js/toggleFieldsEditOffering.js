
function toggleFieldsEditOffering(offering_type) {
    var size_qty = document.getElementById("size_qty_row")
    var event_details = document.getElementById("event_details_row")
    if (offering_type === "product") {
        size_qty.style.display = "";
        event_details.style.display = "none";
    } else {
        size_qty.style.display = "none";
        event_details.style.display = "";
    }

}
