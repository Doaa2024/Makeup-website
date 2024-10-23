<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="assets/images/favicon.svg" type="image/x-icon" />
    <title>General | Admin</title>

    <!-- ========== All CSS files linkup ========= -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/css/lineicons.css" />
    <link rel="stylesheet" href="assets/css/materialdesignicons.min.css" />
    <link rel="stylesheet" href="assets/css/fullcalendar.css" />
    <link rel="stylesheet" href="assets/css/main.css" />
</head>

<body>
    <!-- edit modal -->
    <div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update General Component</h5>
                    <button type="button" class="btn close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="updateForm" action="actions/update_categories.php" method="POST" enctype="multipart/form-data">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1" style="width: 150px;">Title</span>
                            </div>
                            <input type="text" class="form-control" placeholder="Title" aria-label="title" name="title" id="title" aria-describedby="basic-addon1" size="20" required>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1" style="width: 150px;">Description</span>
                            </div>
                            <input type="text" class="form-control" placeholder="Description" aria-label="description" id="description" name="description" aria-describedby="basic-addon1" size="20" required>
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1" style="width: 150px;">Image SRC</span>
                            </div>
                            <input type="text" class="form-control" placeholder="Image SRC" aria-label="image" id="image" name="image" aria-describedby="basic-addon1" size="20" required>
                        </div>


                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" value="upload-image">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Add modal -->
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add General Component</h5>
                    <button type="button" class="btn close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="updateForm" action="actions/add_general.php" method="POST" enctype="multipart/form-data">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1" style="width: 150px;">Title</span>
                            </div>
                            <input type="text" class="form-control" placeholder="Title" aria-label="title" name="title" id="title" aria-describedby="basic-addon1" size="20" required>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1" style="width: 150px;">Description</span>
                            </div>
                            <input type="text" class="form-control" placeholder="Description" aria-label="description" id="description" name="description" aria-describedby="basic-addon1" size="20" required>
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1" style="width: 150px;">Image SRC</span>
                            </div>
                            <input type="text" class="form-control" placeholder="Image SRC" aria-label="image" id="image" name="image" aria-describedby="basic-addon1" size="20" required>
                        </div>


                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" value="upload-image">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteCategoryModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteCategoryModalLabel">Confirm Deletion</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <strong> Are you sure you want to delete this General Component?</strong>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteCategoryButton">Delete</button>
                </div>
            </div>
        </div>
    </div>
    <!-- ======== Preloader =========== -->
    <div id="preloader">
        <div class="spinner"></div>
    </div>
    <!-- ======== Preloader =========== -->
    <?php require_once('components/sidenavbar.php'); ?>

    <!-- ======== main-wrapper start =========== -->
    <main class="main-wrapper">
        <!-- ========== header start ========== -->
        <?php require_once('components/header.php'); ?>
        <!-- ========== header end ========== -->


        <section>
            <?php
            require_once('db.php');
            $sql = "SELECT Title, Description, Image,ID FROM general";
            $result = $conn->query($sql);
            ?> <div class="container mt-5">
                <h2 class="mb-4">General Table</h2>
                <button class="btn btn-primary mb-4" data-toggle='modal' data-target='#addModal'>Add General</button>
                <table class="table table-bordered table-striped table-hover custom-table">
                    <thead class="thead-dark">
                        <tr>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Image</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $row['Title'] . "</td>";
                                echo "<td>" . $row['Description'] . "</td>";
                                echo "<td><a style='width:100px;height:auto;'>" . $row['Image'] . "</a></td>";
                                echo "<td>
                                <input id='idediting' type='hidden' value='" . $row['ID'] . "'/>
                                   <div style='display:flex; gap:8px'>
                                <button  class='btn btn-primary btn-sm edit' data-toggle='modal' data-target='#updateModal' id='" . $row['Title'] . "' data-description='" . $row['Description'] . "' data-image='" . $row['Image'] . "' data-idd='" . $row['ID'] . "'>Edit</button>
                                <button  class='btn btn-danger btn-sm delete-product-btn' name='general' id='" . $row['Title'] . "' data-toggle='modal' data-target='#deleteModal'>Delete</button>
                                </div
                                </td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='4'>No data found</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </section>
        <?php require_once('components/footer.php'); ?>
        <!-- ========== footer end =========== -->
    </main>
    <!-- ======== main-wrapper end =========== -->

    <!-- ========= All Javascript files linkup ======== -->
    <script src="assets/js/bootstrap.bundle.min.js"></script>

    <script src="assets/js/moment.min.js"></script>

    <script src="assets/js/jvectormap.min.js"></script>
    <script src="assets/js/world-merc.js"></script>
    <script src="assets/js/polyfill.js"></script>
    <script src="assets/js/main.js"></script>
</body>
<!-- jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- Bootstrap CSS (Optional, if not already included) -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<!-- Bootstrap JS Bundle (includes Popper.js) -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Include SweetAlert CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

<!-- Include SweetAlert JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>

<script>
    $(document).ready(function() {
        var titleToDelete; // Variable to store the product ID to be deleted

        // When a delete button is clicked, capture the product ID
        $('.delete-product-btn').click(function(event) {
            titleToDelete = event.target.id;
            console.log(titleToDelete);
        });

        // When the confirm delete button is clicked
        $('#confirmDeleteCategoryButton').click(function() {
            // AJAX request to delete product
            $.ajax({
                url: 'actions/delete_general.php',
                type: 'POST',
                data: {
                    titleToDelete: titleToDelete
                },
                success: function(response) {
                    console.log(response);
                    // exit;
                    if (response.status === 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: response.message,
                            showConfirmButton: true,
                            customClass: {
                                confirmButton: 'button btn btn-primary app_style'
                            }
                        }).then(function() {
                            window.location.href = 'general.php';
                        });
                    } else {
                        Swal.fire({
                            icon: 'warning',
                            title: response.message,
                            showConfirmButton: true,
                            customClass: {
                                confirmButton: 'button btn btn-primary app_style'
                            }
                        });
                    }
                }
            });
            // Close the modal after deletion
            $('#deleteModal').modal('hide');
        });
    });


    $(document).ready(function() {
        var titleToUpdate;
        var description;
        var image;
        var id;
        // Open the modal and set the category name
        $('.edit').click(function(event) {
            titleToUpdate = event.target.id;
            description = $(this).data('description');
            image = $(this).data('image');
            id = $(this).data('idd');
            // Set the category ID and name in the modal
            $('#title').val(titleToUpdate);
            $('#description').val(description);
            $('#image').val(image);
            console.log(id);
        });
        $('#updateModal').submit(function(event) {
            event.preventDefault(); // Prevent the default form submission

            // Capture form data
            var formData = {
                title: $('#title').val(),
                description: $('#description').val(),
                image: $('#image').val(),
                id: id
            };
            console.log(formData);

            // AJAX request to update general component
            $.ajax({
                url: 'actions/edit_general.php',
                type: 'POST',
                data: formData,
                success: function(response) {
                    if (response.status === 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: response.message
                        }).then(() => {
                            // Reload the page or update the table dynamically
                            window.location.reload();
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: response.message
                        });
                    }
                },
                error: function(xhr, status, error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Error updating component. Please try again.'
                    });
                }
            });
        });
    });
</script>

</html>