<?php
  $page_title = 'Add Sale';
  require_once('includes/load.php');
  page_require_level(3);
?>

<?php
  if(isset($_POST['add_sale'])){

    $req_fields = array('s_id','quantity','price','total','date');
    validate_fields($req_fields);

    if(empty($errors)){

      $p_id = $db->escape((int)$_POST['s_id']);
      $s_qty = $db->escape((int)$_POST['quantity']);
      $s_total = $db->escape($_POST['total']);
      $date = $db->escape($_POST['date']);
      $s_date = make_date();

      // Check product
      $product = find_by_id('products', $p_id);

      if(!$product){

        $session->msg('d', 'Product not found.');
        redirect('add_sale.php', false);

      }

      // Check quantity
      if($s_qty <= 0){

        $session->msg('d', 'Quantity must be greater than zero.');
        redirect('add_sale.php', false);

      }

      // Check available stock
      if($s_qty > (int)$product['quantity']){

        $session->msg(
          'd',
          'Insufficient stock! Available quantity: ' . $product['quantity']
        );

        redirect('add_sale.php', false);

      }

      // Insert sale
      $sql  = "INSERT INTO sales (";
      $sql .= " product_id,qty,price,date";
      $sql .= ") VALUES (";
      $sql .= "'{$p_id}','{$s_qty}','{$s_total}','{$s_date}'";
      $sql .= ")";

      if($db->query($sql)){

        // Reduce product stock
        update_product_qty($s_qty, $p_id);

        $session->msg('s', 'Sale added successfully.');

        redirect('add_sale.php', false);

      } else {

        $session->msg('d', 'Failed to add sale.');

        redirect('add_sale.php', false);

      }

    } else {

      $session->msg('d', $errors);

      redirect('add_sale.php', false);

    }
  }
?>

<?php include_once('layouts/header.php'); ?>

<div class="row">

  <div class="col-md-12">

    <?php echo display_msg($msg); ?>


    <!-- Search Product -->

    <div class="panel panel-default">

      <div class="panel-heading">

        <strong>
          <span class="glyphicon glyphicon-search"></span>
          Find Product
        </strong>

      </div>

      <div class="panel-body">

        <form
          method="post"
          action="ajax.php"
          autocomplete="off"
          id="sug-form">

          <div class="form-group">

            <label for="sug_input">
              Search Product Name
            </label>

            <div class="input-group">

              <input
                type="text"
                id="sug_input"
                class="form-control"
                name="title"
                placeholder="Search for product name">

              <span class="input-group-btn">

                <button
                  type="submit"
                  class="btn btn-primary">

                  <span class="glyphicon glyphicon-search"></span>
                  Find Product

                </button>

              </span>

            </div>

            <div id="result" class="list-group"></div>

          </div>

        </form>

      </div>

    </div>


    <!-- Add Sale -->

    <div class="panel panel-default">

      <div class="panel-heading clearfix">

        <div class="pull-left">

          <strong>
            <span class="glyphicon glyphicon-shopping-cart"></span>
            Add New Sale
          </strong>

        </div>

        <div class="pull-right">

          <a
            href="sales.php"
            class="btn btn-default btn-sm">

            <span class="glyphicon glyphicon-arrow-left"></span>
            Back to Sales

          </a>

        </div>

      </div>


      <div class="panel-body">

        <!-- IMPORTANT:
             This form surrounds the AJAX generated sale row -->

        <form
          method="post"
          action="add_sale.php"
          id="sale-form">

          <div class="table-responsive">

            <table class="table table-bordered table-striped">

              <thead>

                <tr>

                  <th>Product</th>

                  <th>Price</th>

                  <th class="text-center">
                    Quantity
                  </th>

                  <th>Total</th>

                  <th>Date</th>

                  <th class="text-center">
                    Action
                  </th>

                </tr>

              </thead>

              <tbody id="product_info">

                <tr>

                  <td
                    colspan="6"
                    class="text-center text-muted">

                    <span class="glyphicon glyphicon-search"></span>

                    Search for a product above to add a sale.

                  </td>

                </tr>

              </tbody>

            </table>

          </div>

        </form>

      </div>

    </div>

  </div>

</div>

<?php include_once('layouts/footer.php'); ?>