<?php
  $page_title = 'Daily Sales';
  require_once('includes/load.php');
  page_require_level(3);
?>

<?php
  $year  = date('Y');
  $month = date('n');

  if(isset($_POST['submit'])){
    $year  = (int)$_POST['year'];
    $month = (int)$_POST['month'];
  }

  $daily_sales = dailySales($year, $month);

  $total_sales_amount = 0;
  $total_profit = 0;

  if(!empty($daily_sales)){
    foreach($daily_sales as $sale){
      $sale_total = (float)$sale['total_saleing_price'];
      $buy_total  = (float)$sale['total_buying_price'];

      $profit = $sale_total - $buy_total;

      $total_sales_amount += $sale_total;
      $total_profit += $profit;
    }
  }
?>

<?php include_once('layouts/header.php'); ?>

<div class="row">
  <div class="col-md-12">

    <?php echo display_msg($msg); ?>

    <!-- FILTER -->
    <div class="panel panel-default">
      <div class="panel-heading clearfix">
        <strong>
          <span class="glyphicon glyphicon-calendar"></span>
          Daily Sales Report
        </strong>
      </div>

      <div class="panel-body">
        <form method="post" action="daily_sales.php">

          <div class="row">

            <!-- YEAR -->
            <div class="col-md-4">
              <div class="form-group">
                <label for="year">Year</label>

                <select name="year" id="year" class="form-control">

                  <?php
                    for($y = date('Y'); $y >= date('Y') - 5; $y--){
                  ?>

                    <option value="<?php echo $y; ?>"
                      <?php if($y == $year) echo 'selected'; ?>>
                      <?php echo $y; ?>
                    </option>

                  <?php
                    }
                  ?>

                </select>
              </div>
            </div>

            <!-- MONTH -->
            <div class="col-md-4">
              <div class="form-group">
                <label for="month">Month</label>

                <select name="month" id="month" class="form-control">

                  <?php
                    for($m = 1; $m <= 12; $m++){
                  ?>

                    <option value="<?php echo $m; ?>"
                      <?php if($m == $month) echo 'selected'; ?>>
                      <?php echo date('F', mktime(0, 0, 0, $m, 1)); ?>
                    </option>

                  <?php
                    }
                  ?>

                </select>
              </div>
            </div>

            <!-- BUTTON -->
            <div class="col-md-4">
              <div class="form-group">
                <label>&nbsp;</label>

                <button type="submit"
                        name="submit"
                        class="btn btn-primary btn-block">

                  <span class="glyphicon glyphicon-search"></span>
                  View Daily Sales

                </button>

              </div>
            </div>

          </div>

        </form>
      </div>
    </div>


    <!-- DAILY SALES TABLE -->
    <div class="panel panel-default">

      <div class="panel-heading clearfix">

        <div class="pull-left">
          <strong>
            <span class="glyphicon glyphicon-list"></span>
            Daily Sales
          </strong>
        </div>

        <div class="pull-right">
          <span class="label label-info">
            <?php echo count($daily_sales); ?> Records
          </span>
        </div>

      </div>


      <div class="panel-body">

        <div class="table-responsive">

          <table class="table table-bordered table-striped table-hover">

            <thead>
              <tr>

                <th class="text-center">#</th>
                <th class="text-center">Date</th>
                <th>Product Name</th>
                <th class="text-center">Quantity</th>
                <th class="text-right">Selling Price</th>
                <th class="text-right">Buying Price</th>
                <th class="text-right">Total Sale</th>
                <th class="text-right">Profit</th>

              </tr>
            </thead>


            <tbody>

              <?php if(!empty($daily_sales)): ?>

                <?php $i = 1; ?>

                <?php foreach($daily_sales as $sale): ?>

                  <?php

                    $sale_total = (float)$sale['total_saleing_price'];
                    $buy_total  = (float)$sale['total_buying_price'];

                    $profit = $sale_total - $buy_total;

                  ?>

                  <tr>

                    <td class="text-center">
                      <?php echo $i++; ?>
                    </td>

                    <td class="text-center">
                      <?php echo remove_junk($sale['date']); ?>
                    </td>

                    <td>
                      <strong>
                        <?php echo remove_junk($sale['name']); ?>
                      </strong>
                    </td>

                    <td class="text-center">
                      <span class="label label-info">
                        <?php echo (int)$sale['total_sales']; ?>
                      </span>
                    </td>

                    <td class="text-right">
                      ₹<?php echo number_format((float)$sale['sale_price'], 2); ?>
                    </td>

                    <td class="text-right">
                      ₹<?php echo number_format((float)$sale['buy_price'], 2); ?>
                    </td>

                    <td class="text-right">
                      <strong>
                        ₹<?php echo number_format($sale_total, 2); ?>
                      </strong>
                    </td>

                    <td class="text-right">
                      <strong>
                        ₹<?php echo number_format($profit, 2); ?>
                      </strong>
                    </td>

                  </tr>

                <?php endforeach; ?>

              <?php else: ?>

                <tr>

                  <td colspan="8" class="text-center">

                    <span class="glyphicon glyphicon-info-sign"></span>

                    No sales found for the selected month.

                  </td>

                </tr>

              <?php endif; ?>

            </tbody>


            <!-- TOTAL -->
            <?php if(!empty($daily_sales)): ?>

              <tfoot>

                <tr>

                  <td colspan="6" class="text-right">
                    <strong>Total</strong>
                  </td>

                  <td class="text-right">
                    <strong>
                      ₹<?php echo number_format($total_sales_amount, 2); ?>
                    </strong>
                  </td>

                  <td class="text-right">
                    <strong>
                      ₹<?php echo number_format($total_profit, 2); ?>
                    </strong>
                  </td>

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