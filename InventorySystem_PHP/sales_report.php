<?php
  $page_title = 'Sales Report';
  require_once('includes/load.php');
  page_require_level(3);
?>

<?php
  $results = array();

  if(isset($_POST['submit'])){

    $req_dates = array('start-date', 'end-date');
    validate_fields($req_dates);

    if(empty($errors)){

      $start_date = $db->escape($_POST['start-date']);
      $end_date   = $db->escape($_POST['end-date']);

      $results = find_sale_by_dates($start_date, $end_date);

    } else {

      $session->msg("d", $errors);
      redirect('sales_report.php', false);
    }

  } else {

    $start_date = date('Y-m-d');
    $end_date   = date('Y-m-d');

    $results = find_sale_by_dates($start_date, $end_date);
  }


  /* Calculate total sales and total profit */

  $grand_total_sales = 0;
  $grand_total_profit = 0;

  if(!empty($results)){

    foreach($results as $result){

      $sale_total = (float)$result['total_saleing_price'];
      $buy_total  = (float)$result['total_buying_price'];

      $profit = $sale_total - $buy_total;

      $grand_total_sales += $sale_total;
      $grand_total_profit += $profit;
    }
  }
?>

<?php include_once('layouts/header.php'); ?>

<div class="row">
  <div class="col-md-12">

    <?php echo display_msg($msg); ?>

    <!-- DATE FILTER -->

    <div class="panel panel-default">

      <div class="panel-heading clearfix">

        <div class="pull-left">
          <strong>
            <span class="glyphicon glyphicon-calendar"></span>
            Sales Report
          </strong>
        </div>

      </div>

      <div class="panel-body">

        <form method="post" action="sales_report.php">

          <div class="row">

            <div class="col-md-5">

              <div class="form-group">

                <label for="start-date">Start Date</label>

                <div class="input-group">

                  <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                  </span>

                  <input
                    type="date"
                    class="form-control"
                    id="start-date"
                    name="start-date"
                    value="<?php echo $start_date; ?>"
                    required
                  >

                </div>

              </div>

            </div>


            <div class="col-md-5">

              <div class="form-group">

                <label for="end-date">End Date</label>

                <div class="input-group">

                  <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                  </span>

                  <input
                    type="date"
                    class="form-control"
                    id="end-date"
                    name="end-date"
                    value="<?php echo $end_date; ?>"
                    required
                  >

                </div>

              </div>

            </div>


            <div class="col-md-2">

              <div class="form-group">

                <label>&nbsp;</label>

                <button
                  type="submit"
                  name="submit"
                  class="btn btn-primary btn-block"
                >
                  <span class="glyphicon glyphicon-search"></span>
                  Search
                </button>

              </div>

            </div>

          </div>

        </form>

      </div>

    </div>


    <!-- SUMMARY -->

    <div class="row">

      <div class="col-md-6">

        <div class="panel panel-success">

          <div class="panel-heading">
            <strong>
              <span class="glyphicon glyphicon-shopping-cart"></span>
              Total Sales
            </strong>
          </div>

          <div class="panel-body text-center">

            <h2>
              ₹<?php echo number_format($grand_total_sales, 2); ?>
            </h2>

            <p class="text-muted">
              Total selling amount
            </p>

          </div>

        </div>

      </div>


      <div class="col-md-6">

        <div class="panel panel-info">

          <div class="panel-heading">
            <strong>
              <span class="glyphicon glyphicon-stats"></span>
              Total Profit
            </strong>
          </div>

          <div class="panel-body text-center">

            <h2>
              ₹<?php echo number_format($grand_total_profit, 2); ?>
            </h2>

            <p class="text-muted">
              Total profit from sales
            </p>

          </div>

        </div>

      </div>

    </div>


    <!-- SALES RECORDS -->

    <div class="panel panel-default">

      <div class="panel-heading clearfix">

        <div class="pull-left">

          <strong>
            <span class="glyphicon glyphicon-list"></span>
            Sales Records
          </strong>

        </div>

        <div class="pull-right">

          <span class="label label-info">
            <?php echo count($results); ?> Records
          </span>

        </div>

      </div>


      <div class="panel-body">

        <div class="table-responsive">

          <table class="table table-bordered table-striped table-hover">

            <thead>

              <tr>

                <th class="text-center">#</th>

                <th>Product Name</th>

                <th class="text-center">
                  Quantity
                </th>

                <th class="text-right">
                  Selling Price
                </th>

                <th class="text-right">
                  Buying Cost
                </th>

                <th class="text-right">
                  Total Sale
                </th>

                <th class="text-right">
                  Profit
                </th>

                <th class="text-center">
                  Date
                </th>

              </tr>

            </thead>


            <tbody>

              <?php if(!empty($results)): ?>

                <?php $i = 1; ?>

                <?php foreach($results as $result): ?>

                  <?php

                    $sale_total = (float)$result['total_saleing_price'];

                    $buy_total = (float)$result['total_buying_price'];

                    $profit = $sale_total - $buy_total;

                  ?>

                  <tr>

                    <td class="text-center">
                      <?php echo $i++; ?>
                    </td>


                    <td>
                      <strong>
                        <?php echo remove_junk($result['name']); ?>
                      </strong>
                    </td>


                    <td class="text-center">

                      <span class="label label-info">

                        <?php
                          echo (int)$result['total_sales'];
                        ?>

                      </span>

                    </td>


                    <td class="text-right">

                      ₹<?php
                        echo number_format(
                          (float)$result['sale_price'],
                          2
                        );
                      ?>

                    </td>


                    <td class="text-right">

                      ₹<?php
                        echo number_format(
                          (float)$result['buy_price'],
                          2
                        );
                      ?>

                    </td>


                    <td class="text-right">

                      <strong>

                        ₹<?php
                          echo number_format(
                            $sale_total,
                            2
                          );
                        ?>

                      </strong>

                    </td>


                    <td class="text-right">

                      <strong>

                        ₹<?php
                          echo number_format(
                            $profit,
                            2
                          );
                        ?>

                      </strong>

                    </td>


                    <td class="text-center">

                      <?php
                        echo remove_junk($result['date']);
                      ?>

                    </td>

                  </tr>

                <?php endforeach; ?>

              <?php else: ?>

                <tr>

                  <td colspan="8" class="text-center">

                    <span class="glyphicon glyphicon-info-sign"></span>

                    No sales records found for the selected dates.

                  </td>

                </tr>

              <?php endif; ?>

            </tbody>


            <?php if(!empty($results)): ?>

              <tfoot>

                <tr>

                  <td colspan="5" class="text-right">

                    <strong>Grand Total</strong>

                  </td>

                  <td class="text-right">

                    <strong>

                      ₹<?php
                        echo number_format(
                          $grand_total_sales,
                          2
                        );
                      ?>

                    </strong>

                  </td>

                  <td class="text-right">

                    <strong>

                      ₹<?php
                        echo number_format(
                          $grand_total_profit,
                          2
                        );
                      ?>

                    </strong>

                  </td>

                  <td></td>

                </tr>

              </tfoot>

            <?php endif; ?>

          </table>

        </div>

      </div>

    </div>

  </div>
</div>

<?php include_once('layouts/footer.php'); ?>