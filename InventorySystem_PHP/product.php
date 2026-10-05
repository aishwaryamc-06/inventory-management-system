<?php
  $page_title = 'All Products';
  require_once('includes/load.php');

  // Check user permission
  page_require_level(2);

  // Search and filter values
  $search = isset($_GET['search']) ? trim($_GET['search']) : '';
  $category_filter = isset($_GET['category']) ? (int)$_GET['category'] : 0;
  $stock_filter = isset($_GET['stock']) ? $_GET['stock'] : 'all';

  // Fetch products and categories
  $all_products = join_product_table();
  $all_categories = find_all('categories');

  // Apply search and filters
  $products = array_filter($all_products, function ($product) use ($search, $category_filter, $stock_filter) {

      // Search by product name
      if ($search !== '' && stripos($product['name'], $search) === false) {
          return false;
      }

      // Filter by category
      if ($category_filter > 0 && (int)$product['categorie_id'] !== $category_filter) {
          return false;
      }

      // Filter by stock
      $quantity = (int)$product['quantity'];

      if ($stock_filter === 'low' && ($quantity <= 0 || $quantity > 10)) {
          return false;
      }

      if ($stock_filter === 'out' && $quantity > 0) {
          return false;
      }

      if ($stock_filter === 'available' && $quantity <= 10) {
          return false;
      }

      return true;
  });

  // Re-index filtered products
  $products = array_values($products);
?>

<?php include_once('layouts/header.php'); ?>

<div class="row">

  <div class="col-md-12">

    <?php echo display_msg($msg); ?>

    <!-- Page Header -->
    <div class="panel panel-default">

      <div class="panel-heading clearfix">

        <div class="pull-left">
          <strong>
            <span class="glyphicon glyphicon-shopping-cart"></span>
            Products
          </strong>
        </div>

        <div class="pull-right">

          <a href="add_product.php" class="btn btn-primary btn-sm">

            <span class="glyphicon glyphicon-plus"></span>
            Add New Product

          </a>

        </div>

      </div>

      <!-- Search and Filters -->
      <div class="panel-body">

        <form method="GET"
              action="product.php"
              class="form-inline"
              style="margin-bottom: 20px;">

          <!-- Search -->
          <div class="form-group">

            <label for="search">
              Search:
            </label>

            <input
              type="text"
              id="search"
              name="search"
              class="form-control"
              placeholder="Product name..."
              value="<?php echo htmlspecialchars($search, ENT_QUOTES, 'UTF-8'); ?>">

          </div>

          <!-- Category -->
          <div class="form-group">

            <label for="category">
              Category:
            </label>

            <select name="category"
                    id="category"
                    class="form-control">

              <option value="0">
                All Categories
              </option>

              <?php foreach ($all_categories as $category): ?>

                <option
                  value="<?php echo (int)$category['id']; ?>"
                  <?php echo $category_filter === (int)$category['id'] ? 'selected' : ''; ?>>

                  <?php echo remove_junk($category['name']); ?>

                </option>

              <?php endforeach; ?>

            </select>

          </div>

          <!-- Stock -->
          <div class="form-group">

            <label for="stock">
              Stock:
            </label>

            <select name="stock"
                    id="stock"
                    class="form-control">

              <option value="all"
                <?php echo $stock_filter === 'all' ? 'selected' : ''; ?>>
                All Stock
              </option>

              <option value="low"
                <?php echo $stock_filter === 'low' ? 'selected' : ''; ?>>
                Low Stock (1-10)
              </option>

              <option value="available"
                <?php echo $stock_filter === 'available' ? 'selected' : ''; ?>>
                Available (Above 10)
              </option>

              <option value="out"
                <?php echo $stock_filter === 'out' ? 'selected' : ''; ?>>
                Out of Stock
              </option>

            </select>

          </div>

          <!-- Filter Button -->
          <button type="submit"
                  class="btn btn-primary">

            <span class="glyphicon glyphicon-filter"></span>
            Apply

          </button>

          <!-- Reset -->
          <a href="product.php"
             class="btn btn-default">

            Reset

          </a>

        </form>


        <!-- Product Count -->
        <div class="clearfix" style="margin-bottom: 10px;">

          <strong>
            <span class="glyphicon glyphicon-list"></span>
            All Products
          </strong>

          <span class="label label-info pull-right">
            <?php echo count($products); ?> Products
          </span>

        </div>


        <!-- Products Table -->
        <div class="table-responsive">

          <table class="table table-bordered table-striped table-hover">

            <thead>

              <tr>

                <th class="text-center" style="width: 50px;">
                  #
                </th>

                <th class="text-center">
                  Photo
                </th>

                <th>
                  Product Title
                </th>

                <th>
                  Category
                </th>

                <th class="text-center">
                  In Stock
                </th>

                <th>
                  Buying Price
                </th>

                <th>
                  Selling Price
                </th>

                <th>
                  Date Added
                </th>

                <th class="text-center" style="width: 90px;">
                  Actions
                </th>

              </tr>

            </thead>


            <tbody>

            <?php if (!empty($products)): ?>

              <?php foreach ($products as $product): ?>

                <?php
                  $stock = (int)$product['quantity'];
                ?>

                <tr>

                  <!-- Number -->
                  <td class="text-center">
                    <?php echo count_id(); ?>
                  </td>


                  <!-- Photo -->
                  <td class="text-center">

                    <?php if ($product['media_id'] === '0'): ?>

                      <img
                        src="uploads/products/no_image.png"
                        alt="No product image"
                        style="width: 45px; height: 45px; object-fit: cover;">

                    <?php else: ?>

                      <img
                        src="uploads/products/<?php echo $product['image']; ?>"
                        alt="Product image"
                        style="width: 45px; height: 45px; object-fit: cover;">

                    <?php endif; ?>

                  </td>


                  <!-- Product Name -->
                  <td>

                    <strong>
                      <?php echo remove_junk($product['name']); ?>
                    </strong>

                  </td>


                  <!-- Category -->
                  <td>
                    <?php echo remove_junk($product['categorie']); ?>
                  </td>


                  <!-- Stock -->
                  <td class="text-center">

                    <?php if ($stock <= 10): ?>

                      <span class="label label-warning">
                        <?php echo $stock; ?> left
                      </span>

                    <?php else: ?>

                      <span class="label label-success">
                        <?php echo $stock; ?> available
                      </span>

                    <?php endif; ?>

                  </td>


                  <!-- Buying Price -->
                  <td>
                    <?php echo remove_junk($product['buy_price']); ?>
                  </td>


                  <!-- Selling Price -->
                  <td>
                    <?php echo remove_junk($product['sale_price']); ?>
                  </td>


                  <!-- Date -->
                  <td>
                    <?php echo read_date($product['date']); ?>
                  </td>


                  <!-- Actions -->
                  <td class="text-center">

                    <div class="btn-group">

                      <!-- Edit -->
                      <a
                        href="edit_product.php?id=<?php echo (int)$product['id']; ?>"
                        class="btn btn-xs btn-info"
                        title="Edit Product">

                        <span class="glyphicon glyphicon-pencil"></span>

                      </a>


                      <!-- Delete -->
                      <a
                        href="delete_product.php?id=<?php echo (int)$product['id']; ?>"
                        class="btn btn-xs btn-danger"
                        title="Delete Product"
                        onclick="return confirm('Are you sure you want to delete this product?');">

                        <span class="glyphicon glyphicon-trash"></span>

                      </a>

                    </div>

                  </td>

                </tr>

              <?php endforeach; ?>


            <?php else: ?>

              <tr>

                <td colspan="9" class="text-center">

                  <span class="glyphicon glyphicon-info-sign"></span>

                  No products found.

                  <a href="add_product.php">
                    Add New Product
                  </a>

                </td>

              </tr>

            <?php endif; ?>

            </tbody>

          </table>

        </div>

      </div>

    </div>

  </div>

</div>

<?php include_once('layouts/footer.php'); ?>