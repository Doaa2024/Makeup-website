<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="assets/images/favicon.svg" type="image/x-icon" />
    <title>Products | Admin</title>

    <!-- ========== All CSS files linkup ========= -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/css/lineicons.css" />
    <link rel="stylesheet" href="assets/css/materialdesignicons.min.css" />
    <link rel="stylesheet" href="assets/css/fullcalendar.css" />
    <link rel="stylesheet" href="assets/css/main.css" />
</head>

<body>
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

        <!-- ========== section start ========== -->

        <section>
            <?php
            require_once('db.php'); ?>
            <div class="container mt-5">
                <h2 class="mb-4">Products Table</h2>
                <button data-toggle='modal' data-target='#addModal' class="btn btn-primary mb-4">Add Product</button>
                <table class="table table-bordered table-striped table-hover custom-table">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Price</th>
                            <th>Image</th>
                            <th>Category</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- edit modal -->
                        <div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Update Products</h5>
                                        <button type="button" class="btn close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="updateForm" action="actions/update_categories.php" method="POST" enctype="multipart/form-data">
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1" style="width: 150px;">Name</span>
                                                </div>
                                                <input type="text" class="form-control" placeholder="Name" aria-label="id" name="name" id="name" aria-describedby="basic-addon1" size="20" required>
                                            </div>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1" style="width: 150px;">Description</span>
                                                </div>
                                                <input type="text" class="form-control" placeholder="Description" aria-label="description" id="description" name="description" aria-describedby="basic-addon1" size="20" required>
                                            </div>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1" style="width: 150px;">Price</span>
                                                </div>
                                                <input type="text" class="form-control" placeholder="Price" aria-label="price" id="price" name="price" aria-describedby="basic-addon1" size="20" required>
                                            </div>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1" style="width: 150px;">Image SRC</span>
                                                </div>
                                                <input type="text" class="form-control" placeholder="Image SRC" aria-label="image" id="image" name="image" aria-describedby="basic-addon1" size="20" required>
                                            </div>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1" style="width: 150px;">Category</span>
                                                </div>
                                                 
                                                <select id="category" name="category">
                                                 <?php
                                                $sql = "SELECT Category FROM category";
                                                $result = $conn->query($sql);

                                                // Generate options dynamically
                                                if ($result->num_rows > 0) {
                                                while($row = $result->fetch_assoc()) {
                                               
                                                 echo '<option name="category" value="' . $row['Category'] . '">' . $row['Category'] . '</option>';
                                                
                                                }
                                                } else {
                                                echo '<option value="">No categories found</option>';
                                                }
                                                ?>
                                                 </select>
                                                <!-- <input type="text" class="form-control" placeholder="Category" aria-label="category" id="category" name="category" aria-describedby="basic-addon1" size="20" required> -->
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
                                        <h5 class="modal-title" id="exampleModalLabel">Add Products</h5>
                                        <button type="button" class="btn close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="updateForm" action="actions/add_products.php" method="POST" enctype="multipart/form-data">
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1" style="width: 150px;">Name</span>
                                                </div>
                                                <input type="text" class="form-control" placeholder="Name" aria-label="id" name="name" id="name" aria-describedby="basic-addon1" size="20" required>
                                            </div>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1" style="width: 150px;">Description</span>
                                                </div>
                                                <input type="text" class="form-control" placeholder="Description" aria-label="description" id="description" name="description" aria-describedby="basic-addon1" size="20" required>
                                            </div>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1" style="width: 150px;">Price</span>
                                                </div>
                                                <input type="text" class="form-control" placeholder="Price" aria-label="price" id="price" name="price" aria-describedby="basic-addon1" size="20" required>
                                            </div>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1" style="width: 150px;">Image SRC</span>
                                                </div>
                                                <input type="text" class="form-control" placeholder="Image SRC" aria-label="image" id="image" name="image" aria-describedby="basic-addon1" size="20" required>
                                            </div>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1" style="width: 150px;">Category</span>
                                                </div>
                                                <!-- <input type="text" class="form-control" placeholder="Category" aria-label="category" id="category" name="category" aria-describedby="basic-addon1" size="20" required> -->
                                                
                                                <select id="category" name="category">
                                                 <?php
                                                $sql = "SELECT Category FROM category";
                                                $result = $conn->query($sql);

                                                // Generate options dynamically
                                                if ($result->num_rows > 0) {
                                                while($row = $result->fetch_assoc()) {
                                               
                                                 echo '<option name="category" value="' . $row['Category'] . '">' . $row['Category'] . '</option>';
                                                
                                                }
                                                } else {
                                                echo '<option value="">No categories found</option>';
                                                }
                                                ?>
                                                 </select>
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" name="submit" class="btn btn-primary" value="upload-image">Submit</button>
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
                                        <strong> Are you sure you want to delete this Product?</strong>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                        <button type="button" class="btn btn-danger" id="confirmDeleteCategoryButton">Delete</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php
                        $sql = "SELECT ID, Name, Description, Price, Image, Category FROM products";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td style='padding:8px'>" . $row['ID'] . "</td>";
                                echo "<td style='padding:8px'>" . $row['Name'] . "</td>";
                                echo "<td style='padding:8px'>" . $row['Description'] . "</td>";
                                echo "<td style='padding:8px'>" . $row['Price'] . "</td>";
                                echo "<td style='padding:8px'><a style='width:100px;height:auto;'>" . $row['Image'] . "</a></td>";
                                echo "<td style='padding:8px'>" . $row['Category'] . "</td>";
                                echo "<td >
                                <div style='display:flex; gap:8px'>
                                <button  class='btn btn-primary btn-sm edit' id='" . $row['ID'] . "'  data-toggle='modal' data-target='#updateModal' data-name='" . $row['Name'] . "' data-description='" . $row['Description'] . "' data-price='" . $row['Price'] . "' data-category='" . $row['Category'] . "' data-image='" . $row['Image'] . "'>Edit</button>
                                <button  class='btn btn-danger btn-sm delete-product-btn' name='product_id' id='" . $row['ID'] . "' data-toggle='modal' data-target='#deleteModal'>Delete</button>
                                </div
                                 </td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='7'>No products found</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>

        </section>
        <!-- ========== section end ========== -->
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
    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Bootstrap CSS (Optional, if not already included) -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- Bootstrap JS Bundle (includes Popper.js) -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

</body>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Include SweetAlert CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

<!-- Include SweetAlert JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>

<script>
    $(document).ready(function() {
        var productIdToDelete; // Variable to store the product ID to be deleted

        // When a delete button is clicked, capture the product ID
        $('.delete-product-btn').click(function(event) {
            productIdToDelete = event.target.id;
            console.log(productIdToDelete);
        });

        // When the confirm delete button is clicked
        $('#confirmDeleteCategoryButton').click(function() {
            // AJAX request to delete product
            $.ajax({
                url: 'actions/delete_product.php',
                type: 'POST',
                data: { product_id: productIdToDelete },
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
                            window.location.href = 'products.php';
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
                    }}
            });
            // Close the modal after deletion
            $('#deleteModal').modal('hide');
        });
    });
    
  $(document).ready(function() {
    var id;
    // Open the modal and set the category name
    $('.edit').click(function(event) {
      id = event.target.id;
      name = $(this).data('name');
      description = $(this).data('description');
      price = $(this).data('price');
      image = $(this).data('image');
      category = $(this).data('category');
     

      // Set the category ID and name in the modal
      $('#name').val(name);
      $('#description').val(description);
      $('#price').val(price);
      $('#image').val(image);
      $('#category').val(category);

    });
    $('#updateModal').submit(function(event) {
      event.preventDefault(); // Prevent the default form submission

      // Capture form data
      var formData = {
        id: id,
        nametbu: $('#name').val(),
        descriptiontbu: $('#description').val(),
        pricetbu: $('#price').val(),
        imagetbu: $('#image').val(),
        categorytbu: $('#category').val(),
      };
      console.log(formData);

      // AJAX request to update general component
      $.ajax({
        url: 'actions/edit_products.php',
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