<?php
  ob_start();
  require_once('includes/load.php');

  // If user is already logged in, go directly to dashboard
  if($session->isUserLoggedIn(true)) {
    redirect('home.php', false);
  }
?>

<?php include_once('layouts/header.php'); ?>

<div class="row">

  <div class="col-md-4 col-md-offset-4">

    <div class="panel panel-default">

      <div class="panel-heading text-center">

        <strong>
          <span class="glyphicon glyphicon-lock"></span>
          Inventory Management System
        </strong>

        <p class="help-block">
          Sign in to access your dashboard
        </p>

      </div>

      <div class="panel-body">

        <?php echo display_msg($msg); ?>

        <form method="post" action="auth_v2.php">

          <div class="form-group">

            <label for="username">Username</label>

            <div class="input-group">

              <span class="input-group-addon">
                <span class="glyphicon glyphicon-user"></span>
              </span>

              <input
                type="text"
                class="form-control"
                id="username"
                name="username"
                placeholder="Enter username"
                required
                autofocus>

            </div>

          </div>

          <div class="form-group">

            <label for="password">Password</label>

            <div class="input-group">

              <span class="input-group-addon">
                <span class="glyphicon glyphicon-lock"></span>
              </span>

              <input
                type="password"
                class="form-control"
                id="password"
                name="password"
                placeholder="Enter password"
                required>

            </div>

          </div>

          <div class="form-group">

            <button
              type="submit"
              class="btn btn-primary btn-block">

              <span class="glyphicon glyphicon-log-in"></span>
              Login

            </button>

          </div>

        </form>

      </div>

    </div>

  </div>

</div>

<?php include_once('layouts/footer.php'); ?>