<?php
session_start();
if(!isset($_SESSION["email"])){
    header("Location: index.php");
    exit();
}
?>




<!DOCTYPE html>
<html xmlns:th="http://www.thymeleaf.org" lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | Luxury Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #7367f0;
            --primary-light: #e9e7fd;
            --secondary-color: #82868b;
            --success-color: #28c76f;
            --danger-color: #ea5455;
            --warning-color: #ff9f43;
            --info-color: #00cfe8;
            --dark-color: #4b4b4b;
            --light-color: #f8f8f8;
            --sidebar-width: 260px;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f5f7fa;
            color: #6e6b7b;
        }

        /* Sidebar */
        .sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            background: white;
            box-shadow: 0 4px 24px 0 rgba(34, 41, 47, 0.1);
            z-index: 10;
            transition: all 0.3s ease;
        }

        .sidebar-brand {
            height: 70px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1.5rem 1rem;
            border-bottom: 1px solid #ebe9f1;
        }

        .sidebar-brand h4 {
            font-weight: 600;
            color: var(--primary-color);
            margin-bottom: 0;
        }

        .sidebar-user {
            padding: 1.5rem 1rem;
            border-bottom: 1px solid #ebe9f1;
        }

        .sidebar-user .avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: var(--primary-light);
            color: var(--primary-color);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            margin-right: 12px;
        }

        .sidebar-menu {
            padding: 1rem 0;
        }

        .sidebar-menu .menu-item {
            margin-bottom: 5px;
        }

        .sidebar-menu .menu-link {
            display: flex;
            align-items: center;
            padding: 0.75rem 1.5rem;
            color: #6e6b7b;
            text-decoration: none;
            transition: all 0.3s ease;
            border-radius: 0 100px 100px 0;
            margin-right: 1rem;
        }

        .sidebar-menu .menu-link:hover,
        .sidebar-menu .menu-link.active {
            background-color: var(--primary-light);
            color: var(--primary-color);
        }

        .sidebar-menu .menu-link i {
            margin-right: 12px;
            font-size: 1.2rem;
        }

        /* Main Content */
        .main-content {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            padding: 1.5rem;
            transition: all 0.3s ease;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .header h2 {
            color: #5e5873;
            font-weight: 600;
            margin-bottom: 0;
        }

        .card {
            border: none;
            border-radius: 0.5rem;
            box-shadow: 0 4px 24px 0 rgba(34, 41, 47, 0.1);
            margin-bottom: 1.5rem;
            transition: all 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px 0 rgba(34, 41, 47, 0.15);
        }

        .card-header {
            background-color: white;
            border-bottom: 1px solid #ebe9f1;
            padding: 1rem 1.5rem;
            border-radius: 0.5rem 0.5rem 0 0 !important;
        }

        .card-title {
            font-weight: 600;
            color: #5e5873;
            margin-bottom: 0;
        }

        .table th {
            border-top: none;
            color: #5e5873;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.5px;
        }

        .badge {
            font-weight: 500;
            padding: 0.35em 0.6em;
            font-size: 0.75rem;
        }

        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .btn-primary:hover {
            background-color: #5d52d8;
            border-color: #5d52d8;
        }

        .btn-outline-primary {
            color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .btn-outline-primary:hover {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .action-btn {
            width: 30px;
            height: 30px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            margin: 0 3px;
        }

        /* Stats Cards */
        .stats-card {
            text-align: center;
            padding: 1.5rem;
        }

        .stats-card .icon {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            font-size: 1.5rem;
        }

        .stats-card .icon.primary {
            background-color: rgba(115, 103, 240, 0.12);
            color: var(--primary-color);
        }

        .stats-card .icon.success {
            background-color: rgba(40, 199, 111, 0.12);
            color: var(--success-color);
        }

        .stats-card .icon.warning {
            background-color: rgba(255, 159, 67, 0.12);
            color: var(--warning-color);
        }

        .stats-card .icon.danger {
            background-color: rgba(234, 84, 85, 0.12);
            color: var(--danger-color);
        }

        .stats-card .count {
            font-size: 1.5rem;
            font-weight: 600;
            color: #5e5873;
            margin-bottom: 0.25rem;
        }

        .stats-card .title {
            font-size: 0.875rem;
            color: var(--secondary-color);
        }

        /* Form Styles */
        .form-control, .form-select {
            border: 1px solid #d8d6de;
            border-radius: 0.357rem;
            padding: 0.75rem 1rem;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 3px 10px 0 rgba(115, 103, 240, 0.1);
        }

        /* Responsive */
        @media (max-width: 992px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.active {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
            }

            .menu-toggle {
                display: block !important;
            }
        }

        /* Animation */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .fade-in {
            animation: fadeIn 0.5s ease forwards;
        }
    </style>
</head>
<body>
<!-- Sidebar -->
<div class="sidebar">
    <div class="sidebar-brand">
        <h4>LUXURY ADMIN</h4>
    </div>

    <div class="sidebar-user d-flex align-items-center">
        <div class="avatar">
            <span th:text="${#authentication.name.substring(0, 1).toUpperCase()}">A</span>
        </div>
        <div>
            <div class="fw-500" th:text="${#authentication.name}">Admin</div>
            <small class="text-muted">Administrator</small>
        </div>
    </div>

    <div class="sidebar-menu">
        <div class="menu-item">
            <a href="#" class="menu-link active" id="dashboardLink">
                <i class="bi bi-speedometer2"></i>
                <span>Dashboard</span>
            </a>
        </div>
        <div class="menu-item">
            <a href="#" class="menu-link" id="usersLink">
                <i class="bi bi-people-fill"></i>
                <span>Users</span>
            </a>
        </div>
        <div class="menu-item">
            <a href="#" class="menu-link" id="productsLink">
                <i class="bi bi-box-seam"></i>
                <span>Products</span>
            </a>
        </div>
        <div class="menu-item">
            <a href="#" class="menu-link" id="addProductLink">
                <i class="bi bi-plus-circle"></i>
                <span>Add Product</span>
            </a>
        </div>
        <div class="menu-item mt-4">
            <a href="/logout" class="menu-link">
                <i class="bi bi-box-arrow-right"></i>
                <span>Logout</span>
            </a>
        </div>
    </div>
</div>

<!-- Main Content -->
<div class="main-content">
    <div class="header">
        <h2 id="pageTitle">Dashboard</h2>
        <button class="btn btn-outline-primary d-none menu-toggle" id="menuToggle">
            <i class="bi bi-list"></i>
        </button>
    </div>

    <!-- Dashboard Section -->
    <div id="dashboardSection">
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card stats-card fade-in">
                    <div class="icon primary">
                        <i class="bi bi-people"></i>
                    </div>
                    <h3 class="count" id="usersCount">0</h3>
                    <p class="title">Total Users</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card stats-card fade-in" style="animation-delay: 0.1s">
                    <div class="icon success">
                        <i class="bi bi-box-seam"></i>
                    </div>
                    <h3 class="count" id="productsCount">0</h3>
                    <p class="title">Total Products</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card stats-card fade-in" style="animation-delay: 0.2s">
                    <div class="icon warning">
                        <i class="bi bi-star-fill"></i>
                    </div>
                    <h3 class="count" id="featuredCount">0</h3>
                    <p class="title">Featured Items</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card stats-card fade-in" style="animation-delay: 0.3s">
                    <div class="icon danger">
                        <i class="bi bi-exclamation-triangle"></i>
                    </div>
                    <h3 class="count" id="lowStockCount">0</h3>
                    <p class="title">Low Stock</p>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Recent Activities</h5>
                    </div>
                    <div class="card-body">
                        <div class="activity-timeline">
                            <div class="activity-item d-flex">
                                <div class="activity-badge bg-primary me-3">
                                    <i class="bi bi-person-plus"></i>
                                </div>
                                <div class="activity-content">
                                    <h6 class="mb-0">New user registered</h6>
                                    <small class="text-muted">2 minutes ago</small>
                                </div>
                            </div>
                            <div class="activity-item d-flex mt-3">
                                <div class="activity-badge bg-success me-3">
                                    <i class="bi bi-box-seam"></i>
                                </div>
                                <div class="activity-content">
                                    <h6 class="mb-0">New product added</h6>
                                    <small class="text-muted">1 hour ago</small>
                                </div>
                            </div>
                            <div class="activity-item d-flex mt-3">
                                <div class="activity-badge bg-warning me-3">
                                    <i class="bi bi-pencil-square"></i>
                                </div>
                                <div class="activity-content">
                                    <h6 class="mb-0">Product updated</h6>
                                    <small class="text-muted">3 hours ago</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Quick Actions</h5>
                    </div>
                    <div class="card-body">
                        <button class="btn btn-outline-primary w-100 mb-2" id="quickUsersBtn">
                            <i class="bi bi-people-fill me-2"></i> Manage Users
                        </button>
                        <button class="btn btn-outline-primary w-100 mb-2" id="quickProductsBtn">
                            <i class="bi bi-box-seam me-2"></i> Manage Products
                        </button>
                        <button class="btn btn-outline-primary w-100" id="quickAddProductBtn">
                            <i class="bi bi-plus-circle me-2"></i> Add Product
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Users Section -->
    <div id="usersSection" style="display: none;">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">User Management</h5>
                <button class="btn btn-sm btn-primary" id="fetchUsersBtn">
                    <i class="bi bi-arrow-clockwise me-1"></i> Refresh
                </button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover" id="usersTable">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Email</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <!-- Users will be populated here via JavaScript -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Products Section -->
    <div id="productsSection" style="display: none;">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">Product Management</h5>
                <button class="btn btn-sm btn-primary" id="fetchProductsBtn">
                    <i class="bi bi-arrow-clockwise me-1"></i> Refresh
                </button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover" id="productsTable">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Stock</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <!-- Products will be populated here via JavaScript -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Product Section -->
    <div id="addProductSection" style="display: none;">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Add New Product</h5>
            </div>
            <div class="card-body">
                <form id="productForm" th:action="@{/admin/products/add}" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="productName" class="form-label">Product Name</label>
                                <input type="text" class="form-control" id="productName" name="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="productPrice" class="form-label">Price</label>
                                <div class="input-group">
                                    <span class="input-group-text">$</span>
                                    <input type="number" step="0.01" class="form-control" id="productPrice" name="price" required>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="productStock" class="form-label">Stock Quantity</label>
                                <input type="number" class="form-control" id="productStock" name="stock" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="productCategory" class="form-label">Category</label>
                                <select class="form-select" id="productCategory" name="category">
                                    <option value="electronics">Electronics</option>
                                    <option value="clothing">Clothing</option>
                                    <option value="home">Home & Garden</option>
                                    <option value="books">Books</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="productImage" class="form-label">Product Image</label>
                                <input class="form-control" type="file" id="productImage" name="image">
                            </div>
                            <div class="form-check form-switch mb-3">
                                <input class="form-check-input" type="checkbox" id="productFeatured" name="featured">
                                <label class="form-check-label" for="productFeatured">Featured Product</label>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="productDescription" class="form-label">Description</label>
                        <textarea class="form-control" id="productDescription" name="description" rows="3"></textarea>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save me-1"></i> Save Product
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <div class="mb-3">
                    <i class="bi bi-exclamation-triangle-fill text-danger" style="font-size: 3rem;"></i>
                </div>
                <h5>Are you sure?</h5>
                <p>You won't be able to revert this!</p>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Yes, delete it!</button>
            </div>
        </div>
    </div>
</div>

<!-- Success Toast -->
<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
    <div id="successToast" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header bg-success text-white">
            <strong class="me-auto">Success</strong>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            Operation completed successfully!
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    $(document).ready(function() {
        // Initialize toast
        const successToast = new bootstrap.Toast(document.getElementById('successToast'));

        // Toggle sidebar on mobile
        $('#menuToggle').click(function() {
            $('.sidebar').toggleClass('active');
        });

        // Navigation controls
        function showSection(sectionId, title) {
            $('#dashboardSection, #usersSection, #productsSection, #addProductSection').hide();
            $(`#${sectionId}`).show();
            $('#pageTitle').text(title);

            // Update active menu item
            $('.menu-link').removeClass('active');
            $(`#${sectionId.replace('Section', 'Link')}`).addClass('active');

            // Close sidebar on mobile
            if ($(window).width() < 992) {
                $('.sidebar').removeClass('active');
            }
        }

        $('#dashboardLink').click(function(e) {
            e.preventDefault();
            showSection('dashboardSection', 'Dashboard');
        });

        $('#usersLink, #quickUsersBtn').click(function(e) {
            e.preventDefault();
            showSection('usersSection', 'User Management');
            fetchUsers();
        });

        $('#productsLink, #quickProductsBtn').click(function(e) {
            e.preventDefault();
            showSection('productsSection', 'Product Management');
            fetchProducts();
        });

        $('#addProductLink, #quickAddProductBtn').click(function(e) {
            e.preventDefault();
            showSection('addProductSection', 'Add Product');
        });

        // Fetch dashboard stats
        function fetchDashboardStats() {
            $.get('/admin/dashboard/stats', function(stats) {
                $('#usersCount').text(stats.totalUsers);
                $('#productsCount').text(stats.totalProducts);
                $('#featuredCount').text(stats.featuredProducts);
                $('#lowStockCount').text(stats.lowStockProducts);
            });
        }

        // Fetch users
        function fetchUsers() {
            $.get('/admin/users', function(users) {
                const tableBody = $('#usersTable tbody');
                tableBody.empty();

                users.forEach(user => {
                    const statusClass = user.active ? 'bg-success' : 'bg-secondary';
                    const statusText = user.active ? 'Active' : 'Inactive';

                    tableBody.append(`
                        <tr>
                            <td>${user.id}</td>
                            <td>${user.email}</td>
                            <td>${user.firstName}</td>
                            <td>${user.lastName}</td>
                            <td><span class="badge ${statusClass}">${statusText}</span></td>
                            <td>
                                <button class="btn btn-sm btn-outline-primary action-btn" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-danger action-btn delete-user" data-id="${user.id}" title="Delete">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </td>
                        </tr>
                    `);
                });
            }).fail(function() {
                alert('Error fetching users');
            });
        }

        // Fetch products
        function fetchProducts() {
            $.get('/admin/products', function(products) {
                const tableBody = $('#productsTable tbody');
                tableBody.empty();

                products.forEach(product => {
                    const statusClass = product.stock > 0 ? 'bg-success' : 'bg-danger';
                    const statusText = product.stock > 0 ? 'In Stock' : 'Out of Stock';

                    tableBody.append(`
                        <tr>
                            <td>${product.id}</td>
                            <td>
                                <img src="${product.imageUrl || 'https://via.placeholder.com/50'}"
                                     alt="${product.name}"
                                     style="width: 50px; height: 50px; object-fit: cover; border-radius: 4px;">
                            </td>
                            <td>${product.name}</td>
                            <td>$${product.price.toFixed(2)}</td>
                            <td>${product.stock}</td>
                            <td><span class="badge ${statusClass}">${statusText}</span></td>
                            <td>
                                <button class="btn btn-sm btn-outline-primary action-btn" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-danger action-btn delete-product" data-id="${product.id}" title="Delete">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </td>
                        </tr>
                    `);
                });
            }).fail(function() {
                alert('Error fetching products');
            });
        }

        // Delete handlers
        let currentDeleteId = null;
        let currentDeleteType = null;

        $(document).on('click', '.delete-user', function() {
            currentDeleteId = $(this).data('id');
            currentDeleteType = 'user';
            $('#deleteModal').modal('show');
        });

        $(document).on('click', '.delete-product', function() {
            currentDeleteId = $(this).data('id');
            currentDeleteType = 'product';
            $('#deleteModal').modal('show');
        });

        $('#confirmDeleteBtn').click(function() {
            $('#deleteModal').modal('hide');

            if (currentDeleteType === 'user') {
                $.ajax({
                    url: '/admin/users/' + currentDeleteId,
                    type: 'DELETE',
                    success: function() {
                        fetchUsers();
                        fetchDashboardStats();
                        showSuccessToast('User deleted successfully');
                    },
                    error: function() {
                        alert('Error deleting user');
                    }
                });
            } else if (currentDeleteType === 'product') {
                $.ajax({
                    url: '/admin/products/' + currentDeleteId,
                    type: 'DELETE',
                    success: function() {
                        fetchProducts();
                        fetchDashboardStats();
                        showSuccessToast('Product deleted successfully');
                    },
                    error: function() {
                        alert('Error deleting product');
                    }
                });
            }
        });

        // Form submission
        $('#productForm').submit(function(e) {
            e.preventDefault();

            const formData = new FormData(this);

            $.ajax({
                url: '/admin/products/add',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function() {
                    showSuccessToast('Product added successfully');
                    $('#productForm')[0].reset();
                    fetchProducts();
                    fetchDashboardStats();
                    showSection('productsSection', 'Product Management');
                },
                error: function() {
                    alert('Error adding product');
                }
            });
        });

        // Refresh buttons
        $('#fetchUsersBtn').click(fetchUsers);
        $('#fetchProductsBtn').click(fetchProducts);

        // Show success toast
        function showSuccessToast(message) {
            $('#successToast .toast-body').text(message);
            successToast.show();
        }

        // Initialize dashboard
        fetchDashboardStats();
    });
</script>
</body>
</html>