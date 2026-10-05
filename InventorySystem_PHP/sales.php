<?php
  $page_title = 'All Sales';
  require_once('includes/load.php');

  // Check user permission
  page_require_level(3);

  $sales = find_all_sale();
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
            All Sales
          </strong>
        </div>

        <div class="pull-right">
          <a href="add_sale.php" class="btn btn-primary btn-sm">
            <span class="glyphicon glyphicon-plus"></span>
            Add New Sale
          </a>
        </div>

      </div>

      <!-- Sales Table -->
      <div class="panel-body">

        <div class="clearfix" style="margin-bottom: 10px;">

          <strong>
            <span class="glyphicon glyphicon-list"></span>
            Sales Records
          </strong>

          <span class="label label-info pull-right">
            <?php echo count($sales); ?> Sales
          </span>

        </div>

        <div class="table-responsive">

          <table class="table table-bordered table-striped table-hover">

            <thead>
              <tr>

                <th class="text-center" style="width: 50px;">
                  #
                </th>

                <th>
                  Product Name
                </th>

                <th class="text-center">
                  Quantity
                </th>

                <th class="text-center">
                  Total
                </th>

                <th class="text-center">
                  Date
                </th>

                <th class="text-center" style="width: 100px;">
                  Actions
                </th>

              </tr>
            </thead>

            <tbody>

              <?php if (!empty($sales)): ?>

                <?php foreach ($sales as $sale): ?>

                  <tr>

                    <td class="text-center">
                      <?php echo count_id(); ?>
                    </td>

                    <td>
                      <strong>
                        <?php echo remove_junk($sale['name']); ?>
                      </strong>
                    </td>

                    <td class="text-center">
                      <span class="label label-info">
                        <?php echo (int)$sale['qty']; ?>
                      </span>
                    </td>

                    <td class="text-center">
                      <?php echo remove_junk($sale['price']); ?>
                    </td>

                    <td class="text-center">
                      <?php echo $sale['date']; ?>
                    </td>

                    <td class="text-center">

                      <div class="btn-group">

                        <a href="edit_sale.php?id=<?php echo (int)$sale['id']; ?>"
                           class="btn btn-xs btn-warning"
                           title="Edit Sale"
                           data-toggle="tooltip">

                          <span class="glyphicon glyphicon-pencil"></span>

                        </a>

                        <a href="delete_sale.php?id=<?php echo (int)$sale['id']; ?>"
                           class="btn btn-xs btn-danger"
                           title="Delete Sale"
                           data-toggle="tooltip"
                           onclick="return confirm('Are you sure you want to delete this sale?');">

                          <span class="glyphicon glyphicon-trash"></span>

                        </a>

                      </div>

                    </td>

                  </tr>

                <?php endforeach; ?>

              <?php else: ?>

                <tr>

                  <td colspan="6" class="text-center">

                    <span class="glyphicon glyphicon-info-sign"></span>
                    No sales records found.

                    <a href="add_sale.php">
                      Add New Sale
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