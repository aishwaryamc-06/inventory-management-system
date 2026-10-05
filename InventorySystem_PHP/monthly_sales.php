<?php
  $page_title = 'Monthly Sales';
  require_once('includes/load.php');
  page_require_level(3);
?>

<?php
  $year = date('Y');

  if(isset($_POST['submit'])){
    $year = (int)$_POST['year'];
  }

  $monthly_sales = monthlySales($year);

  $total_sales_amount = 0;
  $total_profit = 0;

  if(!empty($monthly_sales)){
    foreach($monthly_sales as $sale){

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

    <!-- YEAR FILTER -->
    <div class="panel panel-default">

      <div class="panel-heading clearfix">

        <strong>
          <span class="glyphicon glyphicon-calendar"></span>
          Monthly Sales Report
        </strong>

      </div>

      <div class="panel-body">

        <form method="post" action="monthly_sales.php">

          <div class="row">

            <!-- YEAR -->
            <div class="col-md-8">

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

            <!-- BUTTON -->
            <div class="col-md-4">

              <div class="form-group">

                <label>&nbsp;</label>

                <button type="submit"
                        name="submit"
                        class="btn btn-primary btn-block">

                  <span class="glyphicon glyphicon-search"></span>
                  View Monthly Sales

                </button>

              </div>

            </div>

          </div>

        </form>

      </div>

    </div>


    <!-- MONTHLY SALES TABLE -->
    <div class="panel panel-default">

      <div class="panel-heading clearfix">

        <div class="pull-left">

          <strong>
            <span class="glyphicon glyphicon-list"></span>
            Monthly Sales
          </strong>

        </div>

        <div class="pull-right">

          <span class="label label-info">
            <?php echo count($monthly_sales); ?> Records
          </span>

        </div>

      </div>


      <div class="panel-body">

        <div class="table-responsive">

          <table class="table table-bordered table-striped table-hover">

            <thead>

              <tr>

                <th class="text-center">#</th>
                <th>Month</th>
                <th>Product Name</th>
                <th class="text-center">Quantity</th>
                <th class="text-right">Selling Price</th>
                <th class="text-right">Buying Price</th>
                <th class="text-right">Total Sale</th>
                <th class="text-right">Profit</th>

              </tr>

            </thead>


            <tbody>

              <?php if(!empty($monthly_sales)): ?>

                <?php $i = 1; ?>

                <?php foreach($monthly_sales as $sale): ?>

                  <?php

                    $sale_total = (float)$sale['total_saleing_price'];
                    $buy_total  = (float)$sale['total_buying_price'];

                    $profit = $sale_total - $buy_total;

                  ?>

                  <tr>

                    <!-- NUMBER -->
                    <td class="text-center">
                      <?php echo $i++; ?>
                    </td>

                    <!-- MONTH -->
                    <td>
                      <strong>
                        <?php echo remove_junk($sale['month_name']); ?>
                      </strong>
                    </td>

                    <!-- PRODUCT -->
                    <td>
                      <?php echo remove_junk($sale['name']); ?>
                    </td>

                    <!-- QUANTITY -->
                    <td class="text-center">

                      <span class="label label-info">
                        <?php echo (int)$sale['total_sales']; ?>
                      </span>

                    </td>

                    <!-- SELLING PRICE -->
                    <td class="text-right">

                      ₹<?php
                        echo number_format(
                          (float)$sale['sale_price'],
                          2
                        );
                      ?>

                    </td>

                    <!-- BUYING PRICE -->
                    <td class="text-right">

                      ₹<?php
                        echo number_format(
                          (float)$sale['buy_price'],
                          2
                        );
                      ?>

                    </td>

                    <!-- TOTAL SALE -->
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

                    <!-- PROFIT -->
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

                  </tr>

                <?php endforeach; ?>

              <?php else: ?>

                <tr>

                  <td colspan="8" class="text-center">

                    <span class="glyphicon glyphicon-info-sign"></span>

                    No sales found for the selected year.

                  </td>

                </tr>

              <?php endif; ?>

            </tbody>


            <!-- TOTAL -->
            <?php if(!empty($monthly_sales)): ?>

              <tfoot>

                <tr>

                  <td colspan="6" class="text-right">

                    <strong>
                      Total
                    </strong>

                  </td>

                  <td class="text-right">

                    <strong>
                      ₹<?php
                        echo number_format(
                          $total_sales_amount,
                          2
                        );
                      ?>
                    </strong>

                  </td>

                  <td class="text-right">

                    <strong>
                      ₹<?php
                        echo number_format(
                          $total_profit,
                          2
                        );
                      ?>
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