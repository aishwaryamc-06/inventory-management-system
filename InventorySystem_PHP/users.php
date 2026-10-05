<?php
  $page_title = 'User Management';
  require_once('includes/load.php');

  // Check user permission
  page_require_level(1);

  // Get all users from database
  $all_users = find_all_user();
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
            <span class="glyphicon glyphicon-user"></span>
            User Management
          </strong>
        </div>

        <div class="pull-right">
          <a href="add_user.php" class="btn btn-info btn-sm">
            <span class="glyphicon glyphicon-plus"></span>
            Add New User
          </a>
        </div>

      </div>

      <!-- User Table -->
      <div class="panel-body">

        <div class="table-responsive">

          <table class="table table-bordered table-striped">

            <thead>
              <tr>
                <th class="text-center" style="width: 50px;">#</th>
                <th>Name</th>
                <th>Username</th>
                <th class="text-center">User Role</th>
                <th class="text-center">Status</th>
                <th>Last Login</th>
                <th class="text-center" style="width: 100px;">Actions</th>
              </tr>
            </thead>

            <tbody>

            <?php foreach($all_users as $a_user): ?>

              <tr>

                <!-- Number -->
                <td class="text-center">
                  <?php echo count_id(); ?>
                </td>

                <!-- Name -->
                <td>
                  <?php echo remove_junk(ucwords($a_user['name'])); ?>
                </td>

                <!-- Username -->
                <td>
                  <?php echo remove_junk(ucwords($a_user['username'])); ?>
                </td>

                <!-- User Role -->
                <td class="text-center">
                  <?php echo remove_junk(ucwords($a_user['group_name'])); ?>
                </td>

                <!-- Status -->
                <td class="text-center">

                  <?php if($a_user['status'] === '1'): ?>

                    <span class="label label-success">
                      Active
                    </span>

                  <?php else: ?>

                    <span class="label label-danger">
                      Deactive
                    </span>

                  <?php endif; ?>

                </td>

                <!-- Last Login -->
                <td>
                  <?php echo read_date($a_user['last_login']); ?>
                </td>

                <!-- Actions -->
                <td class="text-center">

                  <div class="btn-group">

                    <!-- Edit -->
                    <a href="edit_user.php?id=<?php echo (int)$a_user['id']; ?>"
                       class="btn btn-xs btn-warning"
                       data-toggle="tooltip"
                       title="Edit User">

                      <i class="glyphicon glyphicon-pencil"></i>

                    </a>

                    <!-- Delete -->
                    <a href="delete_user.php?id=<?php echo (int)$a_user['id']; ?>"
                       class="btn btn-xs btn-danger"
                       data-toggle="tooltip"
                       title="Delete User">

                      <i class="glyphicon glyphicon-trash"></i>

                    </a>

                  </div>

                </td>

              </tr>

            <?php endforeach; ?>

            </tbody>

          </table>

        </div>

      </div>

    </div>

  </div>

</div>

<?php include_once('layouts/footer.php'); ?>