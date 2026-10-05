<?php
  $page_title = 'Dashboard';
  require_once('includes/load.php');

  if (!$session->isUserLoggedIn(true)) {
    redirect('index.php', false);
  }

  // Dashboard summary
  $product_result = $db->query(
    "SELECT COUNT(*) AS total FROM products"
  );
  $product_data = $db->fetch_assoc($product_result);
  $total_products = $product_data['total'];

  $category_result = $db->query(
    "SELECT COUNT(*) AS total FROM categories"
  );
  $category_data = $db->fetch_assoc($category_result);
  $total_categories = $category_data['total'];

  $low_stock_result = $db->query(
    "SELECT COUNT(*) AS total FROM products WHERE quantity <= 10"
  );
  $low_stock_data = $db->fetch_assoc($low_stock_result);
  $low_stock_count = $low_stock_data['total'];

  $sales_result = $db->query(
    "SELECT COALESCE(SUM(price), 0) AS total FROM sales"
  );
  $sales_data = $db->fetch_assoc($sales_result);
  $total_sales = $sales_data['total'];

  // Products that need restocking
  $low_stock_products = find_by_sql(
    "SELECT name, quantity FROM products
     WHERE quantity <= 10
     ORDER BY quantity ASC
     LIMIT 10"
  );

  if (!is_array($low_stock_products)) {
    $low_stock_products = array();
  }

  include_once('layouts/header.php');
?>

<!-- Dashboard CSS -->
<link rel="stylesheet" href="libs/css/dashboard.css">

<div class="dashboard-page">

  <?php echo display_msg($msg); ?>

  <!-- Dashboard heading -->
  <div class="dashboard-heading">

    <h2>
      <span class="glyphicon glyphicon-dashboard"></span>
      Dashboard
    </h2>

    <p>
      Welcome back! Here's your inventory overview.
    </p>

  </div>


  <!-- Welcome banner -->
  <div class="dashboard-banner">

    <div>

      <span class="banner-label">
        INVENTORY OVERVIEW
      </span>

      <h1>
        Manage Your Business Smarter
      </h1>

      <p>
        Track products, monitor stock levels, and keep your inventory organized.
      </p>

    </div>

    <span class="glyphicon glyphicon-stats banner-icon"></span>

  </div>


  <!-- Summary cards -->
  <div class="row dashboard-cards">

    <!-- Total Products -->
    <div class="col-md-3 col-sm-6">

      <div class="summary-card products-card">

        <div class="card-top">

          <span>
            Total Products
          </span>

          <span class="glyphicon glyphicon-th-large card-icon"></span>

        </div>

        <h2>
          <?php echo (int)$total_products; ?>
        </h2>

        <p>
          Products in inventory
        </p>

      </div>

    </div>


    <!-- Categories -->
    <div class="col-md-3 col-sm-6">

      <div class="summary-card categories-card">

        <div class="card-top">

          <span>
            Categories
          </span>

          <span class="glyphicon glyphicon-list card-icon"></span>

        </div>

        <h2>
          <?php echo (int)$total_categories; ?>
        </h2>

        <p>
          Product categories
        </p>

      </div>

    </div>


    <!-- Low Stock -->
    <div class="col-md-3 col-sm-6">

      <div class="summary-card lowstock-card">

        <div class="card-top">

          <span>
            Low Stock Items
          </span>

          <span class="glyphicon glyphicon-warning-sign card-icon"></span>

        </div>

        <h2>
          <?php echo (int)$low_stock_count; ?>
        </h2>

        <p>
          Products with 10 or fewer items
        </p>

      </div>

    </div>


    <!-- Total Sales -->
    <div class="col-md-3 col-sm-6">

      <div class="summary-card sales-card">

        <div class="card-top">

          <span>
            Total Sales
          </span>

          <span class="glyphicon glyphicon-shopping-cart card-icon"></span>

        </div>

        <h2>
          ₹<?php echo number_format((float)$total_sales, 2); ?>
        </h2>

        <p>
          Total recorded sales value
        </p>

      </div>

    </div>

  </div>


 <!-- Low Stock Alerts -->
<div class="dashboard-section low-stock-alert-box">
  <div class="section-heading">
    <h3>
      <span class="glyphicon glyphicon-warning-sign"></span>
      Low Stock Alerts
    </h3>

    <p>
      Products that may need restocking.
    </p>
  </div>

  <?php if (empty($low_stock_products)): ?>

    <div class="alert alert-success">
      <span class="glyphicon glyphicon-ok-circle"></span>
      <strong>All good!</strong>
      No products currently have 10 or fewer items.
    </div>

  <?php else: ?>

    <div class="panel panel-warning">

      <div class="panel-heading clearfix">

        <strong>
          <span class="glyphicon glyphicon-warning-sign"></span>
          Products Requiring Attention
        </strong>

        <span class="badge pull-right">
          <?php echo count($low_stock_products); ?>
        </span>

      </div>

      <div class="panel-body">

        <div class="table-responsive">

          <table class="table table-bordered table-striped table-hover">

            <thead>

              <tr>
                <th>Product Name</th>
                <th class="text-center">Available Quantity</th>
                <th class="text-center">Status</th>
              </tr>

            </thead>

            <tbody>

              <?php foreach ($low_stock_products as $product): ?>

                <tr>

                  <td>
                    <span class="glyphicon glyphicon-tag"></span>
                    <strong>
                      <?php echo remove_junk($product['name']); ?>
                    </strong>
                  </td>

                  <td class="text-center">

                    <?php if ((int)$product['quantity'] == 0): ?>

                      <span class="label label-danger">
                        Out of Stock
                      </span>

                    <?php else: ?>

                      <span class="label label-warning">
                        <?php echo (int)$product['quantity']; ?> left
                      </span>

                    <?php endif; ?>

                  </td>

                  <td class="text-center">

                    <?php if ((int)$product['quantity'] == 0): ?>

                      <span class="label label-danger">
                        Out of Stock
                      </span>

                    <?php else: ?>

                      <span class="label label-warning">
                        Low Stock
                      </span>

                    <?php endif; ?>

                  </td>

                </tr>

              <?php endforeach; ?>

            </tbody>

          </table>

        </div>

      </div>

    </div>

  <?php endif; ?>

</div>

</div>

<?php include_once('layouts/footer.php'); ?>