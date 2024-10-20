<?php
include 'db_connect.php';

$sql = "SELECT productID, productname, unit, price FROM products";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Products</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <!-- Bootstrap CSS for styling -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"> <!-- Font Awesome -->
    <style>
        /* General Body Styling */

                @font-face {
                font-family: 'Ubuntu';
            src: url('fonts/Ubuntu-Regular.ttf') format('truetype');
            font-weight: 400;
            font-style: normal;
                 }

        body {
            font-family: 'Ubuntu', sans-serif;
            background-color: #0F0F0F;
            color: #FE8040;
        }

        /* Container and Heading */
        .container {
            background-color: #1A1A1A;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            font-size: 24px;
            font-weight: bold;
            color: #FE8040; /* Maroon */
            margin-bottom: 20px;
        }

        /* Back Button Styling */
        .back-button {
            font-size: 14px;
            background-color: #1A1A1A;
            color: #C4FE76;
            border: none;
            padding: 8px 16px;
            border-radius: 4px;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        .back-button:hover {
            background-color: #FE8040;
            color: #0F0F0F;
        }


        /* Table Styling */
        .table-striped {
            width: 100%;
            border-collapse: collapse;
        }

        .table-striped thead th {
            background-color: #1A1A1A; /* Maroon */
            color: #C4FE76;
            padding: 10px;
            text-align: left;
            font-size: 14px;
        }

        .table-striped tbody td {
            padding: 8px;
            border-bottom: 1px solid #CCCCCC;
            background-color: #0F0F0F;
        }

         .table-striped td.sorting_1 {
            background-color: #2B2B2B; /* Slightly darker background for sorted column */
            color: #0F0F0F; /* Text color to match the theme */
            font-style: italic;
            padding: 10px; 
            border: 1px solid #444; 
        }

        .table-striped tbody tr:hover {
            background-color: #f2f2f2;
        }

        /* Button Styling */
        .btn-primary, .btn-warning, .btn-danger {
            border-radius: 4px;
            font-size: 12px;
        }

        .btn-primary {
            background-color: #1A1A1A; /* Maroon */
            border-color: #C4FE76;
            color: #C4FE76;
        }

        .btn-primary:hover {
            background-color: #1A1A1A;
            border-color: #FE8040 ;
            color: #FE8040 ;
        }

            .btn-secondary {
            background-color: #1A1A1A;
            border-color: #CCCCCC;
            color: #FE8040;
        }

        .btn-secondary:hover {
            background-color: #0F0F0F;
            color: #C4FE76;
        }

        .btn-warning {
            background-color: #ffc107;
            border-color: #ffc107;
            color: #333;
        }

        .btn-warning:hover {
            background-color: #e0a800;
            border-color: #e0a800;
        }

        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
        }

        .btn-danger:hover {
            background-color: #c82333;
            border-color: #c82333;
        }

        /* Modal Styling */
        .modal-content {
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
            background-color: #0F0F0F;
        }

        .modal-header {
            background-color: #1A1A1A; /* Maroon */
            color: #FE8040;
            border-bottom: none;
            padding: 15px;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
        }

        .modal-title {
            font-size: 18px;
        }

        .close {
            color: #1A1A1A;
            opacity: 0.8;
        }

        .close:hover {
            color: #1A1A1A  ;
            opacity: 1;
        }

        .modal-footer button {
            border-radius: 4px;
        }
        
        .form-group label {
            color: #FE8040;
        }

        .form-control {
            border-radius: 4px;
            padding: 10px;
            font-size: 14px;
            background-color: #0F0F0F;
            border-color: #CCCCCC;
            color: #C4FE76;
        }

            .form-control::placeholder {
            color: #FE8040;
            background-color: #0F0F0F;
        }

        /* Hover effect for form inputs */
        .form-control:hover {
            border-color: #FE8040; 
            background-color: #0F0F0F;
        }

        /* Focus effect for form inputs */
        .form-control:focus {
            border-color: #FF9240; 
            background-color: #0F0F0F; 
            outline: none; 
            color: #FE8040;
        }

        /* Styling for required input fields */
        .form-control:required {
            border-left: 3px solid #C4FE76; /* Indicate that the field is required */
        }

        /* Add Product Button */
        button[data-target="#addProductModal"] {
            background-color: #1A1A1A;
            border-color: #1A1A1A;
            font-size: 14px;
            transition: background-color 0.3s;
        }

        button[data-target="#addProductModal"]:hover {
            background-color: #FE8040;
            border-color: #FE8040;
            color: #0F0F0F;
        }

        /* Styling for the search input */
        input[type="search"] {
            width: 100%; 
            max-width: 300px; 
            padding: 8px 12px; 
            border: 1px solid #444; 
            border-radius: 4px;
            background-color: #1A1A1A;
            color: #FE8040; 
            font-size: 14px; 
            transition: border-color 0.3s, background-color 0.3s; 
        }

       
        input[type="search"]::placeholder {
            color: #C4FE76; /* Lighter color for placeholder text */
        }

       
        input[type="search"]:hover {
            border-color: #C4FE76; /* Change border color on hover */
        }

        /* Focus effect for the search input */
        input[type="search"]:focus {
            border-color: #C4FE76;
            background-color: #0F0F0F; 
            outline: none; /* Remove default outline */
        }

        /* Optional styling for input container */
        .search-container {
            margin-bottom: 15px; /* Space below the search input */
        }

        /* Styling for the select dropdown */
        select[name="productTable_length"] {
            width: 100%; 
            max-width: 200px; 
            padding: 8px 12px; 
            border: 1px solid #0F0F0F; 
            border-radius: 4px; 
            background-color: #0F0F0F; 
            color: #C4FE76; 
            font-size: 14px; 
            appearance: none; 
            transition: border-color 0.3s, background-color 0.3s; 
        }

       
        select[name="productTable_length"]::after {
            content: '▼'; 
            position: absolute;
            right: 10px;
            pointer-events: none;
            color: #0F0F0F; 
        }

        
        select[name="productTable_length"]:hover {
            border-color: #FE8040; 
        }

       
        select[name="productTable_length"]:focus {
            border-color: #C4FE76; 
            background-color: #0F0F0F;
            outline: none; 
        }

       
        .select-container {
            margin-bottom: 15px; 
            position: relative; 
        }

        
    </style>
</head>
<body>
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Product List</h2>
        <a href="customers.php" class="btn btn-secondary back-button">Customer Table</a>
    </div>
    <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#addProductModal">Add New Product</button>
    <table id="productTable" class="display table table-striped">
        <thead>
            <tr>
                <th>Product ID</th>
                <th>Product Name</th>
                <th>Unit</th>
                <th>Price</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $row['productID']; ?></td>
                <td><?php echo $row['productname']; ?></td>
                <td><?php echo $row['unit']; ?></td>
                <td>$<?php echo number_format($row['price'], 2); ?></td>
                <td>
                    <button class="btn btn-warning btn-sm editBtn" data-id="<?php echo $row['productID']; ?>">
                    <i class="fas fa-pen-square"></i>
                    </button>
                    <button class="btn btn-danger btn-sm deleteBtn" data-id="<?php echo $row['productID']; ?>">
                        <i class="fas fa-ban"></i> <!-- Trash Icon -->
                    </button>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<!-- Add Product Modal -->
<div class="modal fade" id="addProductModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <form id="addProductForm" action="add_product.php" method="post">
      <div class="modal-content">
        <div class="modal-header">
          <h5>Add New Product</h5>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <!-- Form Fields -->
          <div class="form-group">
            <label>Product Name</label>
            <input type="text" class="form-control" name="productname" required>
          </div>
          <div class="form-group">
            <label>Unit</label>
            <input type="text" class="form-control" name="unit" required>
          </div>
          <div class="form-group">
            <label>Price</label>
            <input type="number" class="form-control" name="price" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Add Product</button>
        </div>
      </div>    
    </form>
  </div>
</div>

<!-- Edit Product Modal -->
<div class="modal fade" id="editProductModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <form id="editProductForm" action="edit_product.php" method="post">
      <input type="hidden" name="productID" id="editProductID">
      <div class="modal-content">
        <div class="modal-header">
          <h5>Edit Product</h5>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <!-- Form Fields -->
          <div class="form-group">
            <label>Product Name</label>
            <input type="text" class="form-control" name="productname" required>
          </div>
          <div class="form-group">
            <label>Unit</label>
            <input type="text" class="form-control" name="unit" required>
          </div>
          <div class="form-group">
            <label>Price</label>
            <input type="number" class="form-control" name="price" step="0.01" required>
          </div>
          <!-- Additional fields as needed -->
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Update Product</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </form>
  </div>
</div>

<!-- jQuery, Popper.js, Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<!-- Bootstrap JS for modals -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script><script>
$(document).ready(function() {
    $('#productTable').DataTable();

    $(document).on('click', '.editBtn', function() {
    var productID = $(this).data('id');

    // Fetch and populate the edit form
    $.ajax({
        url: 'get_product.php',
        type: 'post',
        data: { productID: productID },
        dataType: 'json',
        success: function(response) {
            $('#editProductID').val(response.productID);
            $('#editProductForm [name="productname"]').val(response.productname);
            $('#editProductForm [name="unit"]').val(response.unit);
            $('#editProductForm [name="price"]').val(response.price);
            $('#editProductModal').modal('show');
        }
    });
});

$(document).on('click', '.deleteBtn', function() {
    var productID = $(this).data('id');
    if(confirm('Are you sure you want to delete this product?')) {
        window.location.href = 'delete_product.php?productID=' + productID;
    }
});

});
</script>

</body>
</html>
