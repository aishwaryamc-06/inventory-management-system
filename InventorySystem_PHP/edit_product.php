<?php
  $page_title = 'Edit Product';
  require_once('includes/load.php');

  // Check user permission
  page_require_level(2);
?>

<?php
  $product = find_by_id('products', (int)$_GET['id']);
  $all_categories = find_all('categories');
  $all_photo = find_all('media');

  if(!$product){
    $session->msg("d", "Missing product id.");
    redirect('product.php');
  }
?>

<?php
  if(isset($_POST['product'])){

    $req_fields = array(
      'product-title',
      'product-categorie',
      'product-quantity',
      'buying-price',
      'saleing-price'
    );

    validate_fields($req_fields);

    if(empty($errors)){

      $p_name = remove_junk($db->escape($_POST['product-title']));
      $p_cat  = (int)$_POST['product-categorie'];
      $p_qty  = remove_junk($db->escape($_POST['product-quantity']));
      $p_buy  = remove_junk($db->escape($_POST['buying-price']));
      $p_sale = remove_junk($db->escape($_POST['saleing-price']));

      if(is_null($_POST['product-photo']) || $_POST['product-photo'] === ""){
        $media_id = '0';
      } else {
        $media_id = remove_junk($db->escape($_POST['product-photo']));
      }

      $query  = "UPDATE products SET";
      $query .= " name ='{$p_name}', quantity ='{$p_qty}',";
      $query .= " buy_price ='{$p_buy}', sale_price ='{$p_sale}',";
      $query .= " categorie_id ='{$p_cat}', media_id='{$media_id}'";
      $query .= " WHERE id ='{$product['id']}'";

      $result = $db->query($query);

      if($result && $db->affected_rows() === 1){

        $session->msg('s', "Product updated ");
        redirect('product.php', false);

      } else {

        $session->msg('d', ' Sorry failed to updated!');
        redirect(
          'edit_product.php?id='.$product['id'],
          false
        );
      }

    } else {

      $session->msg("d", $errors);

      redirect(
        'edit_product.php?id='.$product['id'],
        false
      );
    }
  }
?>

<?php include_once('layouts/header.php'); ?>

<div class="row">

  <div class="col-md-12">

    <?php echo display_msg($msg); ?>

    <div class="panel panel-default">

      <!-- Page Header -->
      <div class="panel-heading clearfix">

        <div class="pull-left">
          <strong>
            <span class="glyphicon glyphicon-shopping-cart"></span>
            Edit Product
          </strong>
        </div>

        <div class="pull-right">
          <a href="product.php" class="btn btn-default btn-sm">
            <span class="glyphicon glyphicon-arrow-left"></span>
            Back to Products
          </a>
        </div>

      </div>

      <!-- Form -->
      <div class="panel-body">

        <form method="post"
              action="edit_product.php?id=<?php echo (int)$product['id']; ?>">

          <!-- Product Name -->
          <div class="row">

            <div class="col-md-12">

              <div class="form-group">

                <label for="product-title">
                  Product Name
                </label>

                <div class="input-group">

                  <span class="input-group-addon">
                    <span class="glyphicon glyphicon-th-large"></span>
                  </span>

                  <input type="text"
                         id="product-title"
                         class="form-control"
                         name="product-title"
                         value="<?php echo remove_junk($product['name']); ?>"
                         required>

                </div>

              </div>

            </div>

          </div>


          <!-- Category and Photo -->
          <div class="row">

            <div class="col-md-6">

              <div class="form-group">

                <label for="product-categorie">
                  Category
                </label>

                <select id="product-categorie"
                        class="form-control"
                        name="product-categorie"
                        required>

                  <option value="">
                    Select a category
                  </option>

                  <?php foreach ($all_categories as $cat): ?>

                    <option
                      value="<?php echo (int)$cat['id']; ?>"
                      <?php if($product['categorie_id'] === $cat['id']): echo "selected"; endif; ?>>

                      <?php echo remove_junk($cat['name']); ?>

                    </option>

                  <?php endforeach; ?>

                </select>

              </div>

            </div>


            <div class="col-md-6">

              <div class="form-group">

                <label for="product-photo">
                  Product Photo
                </label>

                <select id="product-photo"
                        class="form-control"
                        name="product-photo">

                  <option value="">
                    No image
                  </option>

                  <?php foreach ($all_photo as $photo): ?>

                    <option
                      value="<?php echo (int)$photo['id']; ?>"
                      <?php if($product['media_id'] === $photo['id']): echo "selected"; endif; ?>>

                      <?php echo $photo['file_name']; ?>

                    </option>

                  <?php endforeach; ?>

                </select>

              </div>

            </div>

          </div>


          <!-- Quantity and Prices -->
          <div class="row">

            <div class="col-md-4">

              <div class="form-group">

                <label for="product-quantity">
                  Quantity
                </label>

                <div class="input-group">

                  <span class="input-group-addon">
                    <span class="glyphicon glyphicon-shopping-cart"></span>
                  </span>

                  <input type="number"
                         id="product-quantity"
                         class="form-control"
                         name="product-quantity"
                         value="<?php echo remove_junk($product['quantity']); ?>"
                         min="0"
                         required>

                </div>

              </div>

            </div>


            <div class="col-md-4">

              <div class="form-group">

                <label for="buying-price">
                  Buying Price
                </label>

                <div class="input-group">

                  <span class="input-group-addon">
                    ₹
                  </span>

                  <input type="number"
                         id="buying-price"
                         class="form-control"
                         name="buying-price"
                         value="<?php echo remove_junk($product['buy_price']); ?>"
                         min="0"
                         step="0.01"
                         required>

                </div>

              </div>

            </div>


            <div class="col-md-4">

              <div class="form-group">

                <label for="saleing-price">
                  Selling Price
                </label>

                <div class="input-group">

                  <span class="input-group-addon">
                    ₹
                  </span>

                  <input type="number"
                         id="saleing-price"
                         class="form-control"
                         name="saleing-price"
                         value="<?php echo remove_junk($product['sale_price']); ?>"
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

              <span class="glyphicon glyphicon-remove"></span>
              Cancel

            </a>

            <button type="submit"
                    name="product"
                    class="btn btn-primary">

              <span class="glyphicon glyphicon-ok"></span>
              Update Product

            </button>

          </div>

        </form>

      </div>

    </div>

  </div>

</div>

<?php include_once('layouts/footer.php'); ?>