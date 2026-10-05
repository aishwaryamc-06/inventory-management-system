<?php
  $page_title = 'Edit Sale';
  require_once('includes/load.php');

  // Check user permission
  page_require_level(3);
?>

<?php
  $sale = find_by_id('sales', (int)$_GET['id']);

  if(!$sale){

    $session->msg("d", "Missing product id.");
    redirect('sales.php');
  }
?>

<?php
  $product = find_by_id('products', $sale['product_id']);
?>

<?php

  if(isset($_POST['update_sale'])){

    $req_fields = array(
      'title',
      'quantity',
      'price',
      'total',
      'date'
    );

    validate_fields($req_fields);

    if(empty($errors)){

      $p_id    = $db->escape((int)$product['id']);
      $s_qty   = $db->escape((int)$_POST['quantity']);
      $s_total = $db->escape($_POST['total']);
      $date    = $db->escape($_POST['date']);
      $s_date  = date("Y-m-d", strtotime($date));

      $sql  = "UPDATE sales SET";
      $sql .= " product_id= '{$p_id}',qty={$s_qty},price='{$s_total}',date='{$s_date}'";
      $sql .= " WHERE id ='{$sale['id']}'";

      $result = $db->query($sql);

      if($result && $db->affected_rows() === 1){

        update_product_qty($s_qty, $p_id);

        $session->msg('s', "Sale updated.");

        redirect(
          'edit_sale.php?id='.$sale['id'],
          false
        );

      } else {

        $session->msg(
          'd',
          ' Sorry failed to updated!'
        );

        redirect('sales.php', false);
      }

    } else {

      $session->msg("d", $errors);

      redirect(
        'edit_sale.php?id='.(int)$sale['id'],
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
            Edit Sale
          </strong>

        </div>

        <div class="pull-right">

          <a href="sales.php"
             class="btn btn-default btn-sm">

            <span class="glyphicon glyphicon-arrow-left"></span>
            Back to Sales

          </a>

        </div>

      </div>


      <!-- Sale Form -->
      <div class="panel-body">

        <form method="post"
              action="edit_sale.php?id=<?php echo (int)$sale['id']; ?>">

          <div class="row">

            <!-- Product -->
            <div class="col-md-12">

              <div class="form-group">

                <label for="title">
                  Product
                </label>

                <input type="text"
                       class="form-control"
                       id="title"
                       name="title"
                       value="<?php echo remove_junk($product['name']); ?>"
                       readonly>

              </div>

            </div>


            <!-- Quantity -->
            <div class="col-md-4">

              <div class="form-group">

                <label for="quantity">
                  Quantity
                </label>

                <div class="input-group">

                  <span class="input-group-addon">
                    <span class="glyphicon glyphicon-shopping-cart"></span>
                  </span>

                  <input type="number"
                         class="form-control"
                         id="quantity"
                         name="quantity"
                         value="<?php echo (int)$sale['qty']; ?>"
                         min="1"
                         required>

                </div>

              </div>

            </div>


            <!-- Price -->
            <div class="col-md-4">

              <div class="form-group">

                <label for="price">
                  Selling Price
                </label>

                <div class="input-group">

                  <span class="input-group-addon">
                    ₹
                  </span>

                  <input type="number"
                         class="form-control"
                         id="price"
                         name="price"
                         value="<?php echo remove_junk($product['sale_price']); ?>"
                         step="0.01"
                         min="0"
                         required>

                </div>

              </div>

            </div>


            <!-- Total -->
            <div class="col-md-4">

              <div class="form-group">

                <label for="total">
                  Total
                </label>

                <div class="input-group">

                  <span class="input-group-addon">
                    ₹
                  </span>

                  <input type="number"
                         class="form-control"
                         id="total"
                         name="total"
                         value="<?php echo remove_junk($sale['price']); ?>"
                         step="0.01"
                         min="0"
                         required>

                </div>

              </div>

            </div>


            <!-- Date -->
            <div class="col-md-4">

              <div class="form-group">

                <label for="date">
                  Sale Date
                </label>

                <input type="date"
                       class="form-control datepicker"
                       id="date"
                       name="date"
                       value="<?php echo remove_junk($sale['date']); ?>"
                       required>

              </div>

            </div>

          </div>


          <!-- Buttons -->
          <div class="form-group">

            <a href="sales.php"
               class="btn btn-default">

              <span class="glyphicon glyphicon-remove"></span>
              Cancel

            </a>

            <button type="submit"
                    name="update_sale"
                    class="btn btn-primary">

              <span class="glyphicon glyphicon-ok"></span>
              Update Sale

            </button>

          </div>

        </form>

      </div>

    </div>

  </div>

</div>

<?php include_once('layouts/footer.php'); ?>