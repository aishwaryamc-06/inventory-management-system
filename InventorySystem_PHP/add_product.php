<?php
  $page_title = 'Add Product';
  require_once('includes/load.php');

  // Check user permission
  page_require_level(2);

  // Get categories and media
  $all_categories = find_all('categories');
  $all_photo = find_all('media');

  // Add Product
  if (isset($_POST['add_product'])) {

    $req_fields = array(
      'product-title',
      'product-categorie',
      'product-quantity',
      'buying-price',
      'saleing-price'
    );

    validate_fields($req_fields);

    if (empty($errors)) {

      $p_name = remove_junk($db->escape($_POST['product-title']));
      $p_cat  = remove_junk($db->escape($_POST['product-categorie']));
      $p_qty  = remove_junk($db->escape($_POST['product-quantity']));
      $p_buy  = remove_junk($db->escape($_POST['buying-price']));
      $p_sale = remove_junk($db->escape($_POST['saleing-price']));

      if (is_null($_POST['product-photo']) ||
          $_POST['product-photo'] === '') {

        $media_id = '0';

      } else {

        $media_id = remove_junk(
          $db->escape($_POST['product-photo'])
        );

      }

      $date = make_date();

      $query  = "INSERT INTO products (";
      $query .= "name, quantity, buy_price, sale_price, ";
      $query .= "categorie_id, media_id, date";
      $query .= ") VALUES (";
      $query .= "'{$p_name}', '{$p_qty}', '{$p_buy}', ";
      $query .= "'{$p_sale}', '{$p_cat}', '{$media_id}', '{$date}'";
      $query .= ")";
      $query .= " ON DUPLICATE KEY UPDATE name='{$p_name}'";

      if ($db->query($query)) {

        $session->msg('s', 'Product added successfully.');
        redirect('add_product.php', false);

      } else {

        $session->msg('d', 'Sorry, failed to add product.');
        redirect('product.php', false);

      }

    } else {

      $session->msg('d', $errors);
      redirect('add_product.php', false);

    }
  }
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
            Add New Product
          </strong>
        </div>

        <div class="pull-right">

          <a href="product.php" class="btn btn-default btn-sm">

            <span class="glyphicon glyphicon-arrow-left"></span>
            Back to Products

          </a>

        </div>

      </div>


      <!-- Product Form -->
      <div class="panel-body">

        <form method="post"
              action="add_product.php">

          <div class="row">

            <!-- Product Name -->
            <div class="col-md-12">

              <div class="form-group">

                <label for="product-title">
                  Product Name
                </label>

                <input
                  type="text"
                  id="product-title"
                  class="form-control"
                  name="product-title"
                  placeholder="Enter product name"
                  maxlength="255"
                  required>

              </div>

            </div>


            <!-- Category -->
            <div class="col-md-6">

              <div class="form-group">

                <label for="product-categorie">
                  Category
                </label>

                <select
                  id="product-categorie"
                  class="form-control"
                  name="product-categorie"
                  required>

                  <option value="">
                    Select a category
                  </option>

                  <?php foreach ($all_categories as $cat): ?>

                    <option value="<?php echo (int)$cat['id']; ?>">

                      <?php echo remove_junk($cat['name']); ?>

                    </option>

                  <?php endforeach; ?>

                </select>

              </div>

            </div>


            <!-- Product Photo -->
            <div class="col-md-6">

              <div class="form-group">

                <label for="product-photo">
                  Product Photo
                </label>

                <select
                  id="product-photo"
                  class="form-control"
                  name="product-photo">

                  <option value="">
                    No photo
                  </option>

                  <?php foreach ($all_photo as $photo): ?>

                    <option value="<?php echo (int)$photo['id']; ?>">

                      <?php echo remove_junk($photo['file_name']); ?>

                    </option>

                  <?php endforeach; ?>

                </select>

                <p class="help-block">
                  Choose an existing image from your media library.
                </p>

              </div>

            </div>


            <!-- Quantity -->
            <div class="col-md-4">

              <div class="form-group">

                <label for="product-quantity">
                  Initial Stock
                </label>

                <div class="input-group">

                  <span class="input-group-addon">
                    <span class="glyphicon glyphicon-inbox"></span>
                  </span>

                  <input
                    type="number"
                    id="product-quantity"
                    class="form-control"
                    name="product-quantity"
                    placeholder="Enter quantity"
                    min="0"
                    step="1"
                    required>

                </div>

              </div>

            </div>


            <!-- Buying Price -->
            <div class="col-md-4">

              <div class="form-group">

                <label for="buying-price">
                  Buying Price
                </label>

                <div class="input-group">

                  <span class="input-group-addon">
                    ₹
                  </span>

                  <input
                    type="number"
                    id="buying-price"
                    class="form-control"
                    name="buying-price"
                    placeholder="0.00"
                    min="0"
                    step="0.01"
                    required>

                </div>

              </div>

            </div>


            <!-- Selling Price -->
            <div class="col-md-4">

              <div class="form-group">

                <label for="saleing-price">
                  Selling Price
                </label>

                <div class="input-group">

                  <span class="input-group-addon">
                    ₹
                  </span>

                  <input
                    type="number"
                    id="saleing-price"
                    class="form-control"
                    name="saleing-price"
                    placeholder="0.00"
                    min="0"
                    step="0.01"
                    required>

                </div>

              </div>

            </div>

          </div>


          <!-- Buttons -->
          <div class="form-group">

            <a href="product.php"
               class="btn btn-default">

              Cancel

            </a>

            <button
              type="submit"
              name="add_product"
              class="btn btn-primary">

              <span class="glyphicon glyphicon-plus"></span>
              Add Product

            </button>

          </div>

        </form>

      </div>

    </div>

  </div>

</div>

<?php include_once('layouts/footer.php'); ?>