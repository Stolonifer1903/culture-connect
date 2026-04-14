
    <!-- Main content -->
    <section class="text-left py-3">
        <div style="margin-left: 100px; margin-right: 30px;">
            <table class="table" width=80% id="offerings">
                <thead style="border-bottom-width: 3px; border-bottom-color: white;">
                    <tr>
                    <th>ID</th>
                    <th>Business name</th>
                    <th>Name</th>
                    <th>Interest area</th>
                    <th>Location</th>
                    <th>Description</th>
                    <th>Details</th>
                    <th>Cultural benefit</th>
                    <th>Price range</th>
                    <th>Actions</th>
                    </tr>
                </thead>
                <tbody style="color: white; background-color: #527558;">
                    <!-- TODO: UPDATE PHP -->
                    <?php
                    include 'include/config.php';
                    if (isset($_GET['businessIdPk'])) {
                        $sql = "SELECT vo.*, o.businessIdPk FROM view_offerings vo, offering o WHERE vo.offeringIdPk=o.offeringIdPk AND o.businessIdPk=".$_GET['businessIdPk'];
                    } else {
                        $sql = "SELECT * FROM view_offerings";
                    }
                    $result = $connection->query($sql);
                    if (!$result) {
                        throw new Exception("Invalid query: " . $connection->error);
                    } else if ($result->num_rows == 0) {
                        echo "<tr><td colspan=10>No offerings available</td></tr>";
                    } else {
                        while ($row = $result->fetch_assoc()) {
                            echo 
                            "<tr id=" . $row["offeringIdPk"] . ">
                                <td>" . $row["offeringIdPk"] . "</td>
                                <td id=
                                >" . $row["businessName"] . "</td>
                                <td>" . $row["offeringName"] . "</td>
                                <td>" . $row["interestAreaName"] . "</td>
                                <td>" . $row["locationName"] . "</td>
                                <td>" . $row["offeringDescription"] . "</td>
                                <td>" . $row["offeringDetails"] . "</td>
                                <td>" . $row["offeringCulturalBenefits"] . "</td>
                                <td>" . $row["offeringPriceRangeDescription"] . "</td>
                                <td>
                                    <a class='btn btn-primary btn-sm' href='05EditOffering.php?offeringIdPk=$row[offeringIdPk]'>Update</a>
                                    <a class='btn btn-danger btn-sm' href='include/deleteOffering.php?offeringIdPk=$row[offeringIdPk]'>Delete</a>
                                </td>
                            </tr>";
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </section>
    <!-- Success Modal -->
    <div class="modal fade" id="offeringSuccessModal" tabindex="-1" aria-labelledby="offeringSuccessModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="offeringSuccessModalLabel">Success</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ✓ Offering updated successfully!
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.has('offeringUpdateSuccess')) {
                const modalEl = document.getElementById('offeringSuccessModal');
                const successModal = new bootstrap.Modal(modalEl);
                successModal.show();
                
                // Clean up the URL to prevent re-shows on refresh
                const newUrl = window.location.pathname;
                window.history.replaceState({}, document.title, newUrl);
            }
        });
    </script>