<?php
  $page_title = 'My Profile';
  require_once('includes/load.php');
  page_require_level(3);
?>

<?php
  $user_id = (int)$_GET['id'];

  if(empty($user_id)) {
    redirect('home.php', false);
  } else {
    $user_p = find_by_id('users', $user_id);
  }
?>

<?php include_once('layouts/header.php'); ?>

<div class="row">

  <div class="col-md-8 col-md-offset-2">

    <?php echo display_msg($msg); ?>

    <div class="panel panel-default">

      <div class="panel-heading clearfix">

        <div class="pull-left">
          <strong>
            <span class="glyphicon glyphicon-user"></span>
            My Profile
          </strong>
        </div>

        <?php if($user_p['id'] === $user['id']): ?>

          <div class="pull-right">
            <a href="edit_account.php" class="btn btn-primary btn-sm">
              <span class="glyphicon glyphicon-edit"></span>
              Edit Profile
            </a>
          </div>

        <?php endif; ?>

      </div>


      <div class="panel-body">

        <div class="row">

          <div class="col-md-4 text-center">

            <img
              src="uploads/users/<?php echo $user_p['image']; ?>"
              class="img-circle img-thumbnail"
              alt="Profile Photo"
              style="max-width: 150px; max-height: 150px;">

          </div>


          <div class="col-md-8">

            <h3>
              <?php echo first_character($user_p['name']); ?>
            </h3>

            <hr>

            <p>
              <strong>
                <span class="glyphicon glyphicon-user"></span>
                Name:
              </strong>

              <?php echo first_character($user_p['name']); ?>
            </p>

            <p>
              <strong>
                <span class="glyphicon glyphicon-log-in"></span>
                Username:
              </strong>

              <?php echo $user_p['username']; ?>
            </p>

          </div>

        </div>

      </div>

    </div>

  </div>

</div>

<?php include_once('layouts/footer.php'); ?>