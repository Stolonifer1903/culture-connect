<?php
include 'config.php';

$location = $_GET['location'] ?? '';
$offering_id = intval($_GET['offeringId'] ?? 0);

$stmt = $connection->prepare("SELECT interestAreaName FROM interestarea 
    WHERE interestAreaIdPk NOT IN (
        SELECT offeringCategory FROM offering 
        WHERE locationIdPk = (SELECT locationIdPk FROM location WHERE locationName = ?)
        AND offeringIdPk != ?
    )");
$stmt->bind_param("si", $location, $offering_id);
$stmt->execute();
$result = $stmt->get_result();

echo "<option value=''>Select category</option>";
while ($row = $result->fetch_assoc()) {
    echo "<option value='" . $row['interestAreaName'] . "'>" . $row['interestAreaName'] . "</option>";
}
?>