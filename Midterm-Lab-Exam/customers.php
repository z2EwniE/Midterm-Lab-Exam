<?php
include 'db_connect.php';

$sql = "SELECT customerID, customername, contactname, city, country FROM customers";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Customers</title>
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <!-- Bootstrap CSS for styling -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  
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

        .form-control {
            border-radius: 4px;
            padding: 10px;
            font-size: 14px;
        }

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
            select[name="customerTable_length"] {
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

       
        select[name="customerTable_length"]::after {
            content: '▼'; 
            position: absolute;
            right: 10px;
            pointer-events: none;
            color: #0F0F0F; 
        }

        
        select[name="customerTable_length"]:hover {
            border-color: #FE8040; 
        }

       
        select[name="customerTable_length"]:focus {
            border-color: #C4FE76; 
            background-color: #0F0F0F;
            outline: none; 
        }

       
        .select-container {
            margin-bottom: 15px; 
            position: relative; 
        }

        /* Styling for the Total Quantity and Total Price section */
        .mt-3 {
            margin-top: 1rem; 
            color: #FE8040;
            background-color: #1F1F1F;
            padding: 10px; 
            border-radius: 8px;
        }

        /* Styling for the labels (Total Quantity and Total Price) */
        .mt-3 p {
            margin: 0;
            font-size: 16px; 
        }

        /* Styling for the strong tags */
        .mt-3 p strong {
            color: #FE8040;
        }

        
        .mt-3 p span {
            
            color: #C4FE76; 
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


                #orderTable {
            width: 100%;
            border-collapse: collapse; 
            background-color: #1F1F1F; 
            color: #FE8040; 
            border-radius: 8px; 
            overflow: hidden; 
        }

        /* Table header styling */
        #orderTable thead {
            background-color: #2B2B2B; 
            color: #FF9240;
        }

        #orderTable thead th {
            padding: 12px; 
            border: 1px solid #444; 
            text-align: left; 
            font-size: 16px; 
        }

       
        #orderTable tbody tr {
            border-bottom: 1px solid #444; 
        }

        #orderTable tbody tr:nth-child(even) {
            background-color: #2B2B2B; 
        }

        /* Hover effect for table rows */
        #orderTable tbody tr:hover {
            background-color: #0F0F0F; 
        }

        /* Table cell styling */
        #orderTable tbody td {
            padding: 10px; 
            border: 1px solid #444; 
            text-align: left;
        }

       
        .table-bordered {
            border: 1px solid #1A1A1A; 
        }
    </style>
  

  </head>

  <body>
  <div class="container mt-5">
  <div class="d-flex justify-content-between align-items-center mb-4">
      <h2 class="mb-4">Customer List</h2>
      <a href="products.php" class="btn btn-secondary back-button">Product Table</a>
  </div>
      <table id="customerTable" class="display table table-striped">
      <thead>
            <tr>
                <th>Customer ID</th>
                <th>Customer Name</th>
                <th>Contact Name</th>
                <th>City</th>
                <th>Country</th>
                <th>Actions</th> 
            </tr>
        </thead>

        <tbody>
    <?php while($row = $result->fetch_assoc()) { ?>
    <tr>
        <td><?php echo $row['customerID']; ?></td>
        <td><?php echo $row['customername']; ?></td>
        <td><?php echo $row['contactname']; ?></td>
        <td><?php echo $row['city']; ?></td>
        <td><?php echo $row['country']; ?></td>
        <td>
            <button class="btn btn-primary btn-sm view-orders-btn" data-id="<?php echo $row['customerID']; ?>" data-name="<?php echo htmlspecialchars($row['customername']); ?>">View Orders</button>
        </td> 
    </tr>
    <?php } ?>
</tbody>

    </table>
</div>

<!-- Order Modal -->
<div class="modal fade" id="orderModal" tabindex="-1" role="dialog" aria-labelledby="orderModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><span id="customerName"></span>'s Orders</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span>&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Orders Table -->
        <table id="orderTable" class="table table-bordered">
          <thead>
            <tr>
              <th>Order ID</th>
              <th>Order Date</th>
              <th>Product Name</th>
              <th>Quantity</th>
              <th>Unit Price</th>
              <th>Total Price</th>
            </tr>
          </thead>
          <tbody>
            <!-- Dynamic Content -->
          </tbody>
        </table>
        <!-- Totals -->
        <div class="mt-3">
          <p><strong>Total Quantity:</strong> <span id="totalQuantity">0</span></p>
          <p><strong>Total Price:</strong> $<span id="totalPrice">0.00</span></p>
        </div>
      </div>
    </div>
  </div>
</div>


<!-- jQuery and DataTables JS -->
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<!-- Bootstrap JS for modals -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script>
$(document).ready(function() {
    var table = $('#customerTable').DataTable();

    // Handle "View Orders" button click
    $('#customerTable tbody').on('click', '.view-orders-btn', function() {
        var customerId = $(this).data('id');
        var customerName = $(this).data('name');
        $('#customerName').text(customerName);

        // Fetch and display orders in the modal
        fetchCustomerOrders(customerId);
    });

    // Function to fetch customer orders
    function fetchCustomerOrders(customerId) {
        $.ajax({
            url: 'fetch_orders.php',
            type: 'POST',
            data: { customerID: customerId },
            dataType: 'json',
            success: function(response) {
                if (response.length > 0) {
                    var totalQuantity = 0;
                    var totalPrice = 0;
                    var tbody = $('#orderTable tbody');
                    tbody.empty(); // Clear previous data

                    response.forEach(function(order) {
                        var quantity = parseInt(order.quantity);
                        var price = parseFloat(order.price);
                        var total = quantity * price;

                        totalQuantity += quantity;
                        totalPrice += total;

                        var row = `<tr>
                            <td>${order.orderID}</td>
                            <td>${order.orderdate}</td>
                            <td>${order.productname}</td>
                            <td>${quantity}</td>
                            <td>$${price.toFixed(2)}</td>
                            <td>$${total.toFixed(2)}</td>
                        </tr>`;
                        tbody.append(row);
                    });

                    // Update totals
                    $('#totalQuantity').text(totalQuantity);
                    $('#totalPrice').text(totalPrice.toFixed(2));

                    // Show the modal
                    $('#orderModal').modal('show');
                } else {
                    // No orders found; display an alert
                    alert('No orders found for ' + $('#customerName').text() + '.');
                }
            },
            error: function(xhr, status, error) {
                console.error('Error fetching orders:', error);
                alert('An error occurred while fetching orders. Please try again.');
            }
        });
    }
});

</script>

</body>
</html>
