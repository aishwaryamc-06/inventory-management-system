<?php
  $page_title = 'Categories';
  require_once('includes/load.php');

  // Check user permission
  page_require_level(1);

  $all_categories = find_all('categories');
?>

<?php
  if(isset($_POST['add_cat'])){

    $req_field = array('categorie-name');

    validate_fields($req_field);

    $cat_name = remove_junk($db->escape($_POST['categorie-name']));

    if(empty($errors)){

      $sql  = "INSERT INTO categories (name)";
      $sql .= " VALUES ('{$cat_name}')";

      if($db->query($sql)){

        $session->msg("s", "Successfully Added New Category");
        redirect('categorie.php', false);

      } else {

        $session->msg("d", "Sorry Failed to insert.");
        redirect('categorie.php', false);
      }

    } else {

      $session->msg("d", $errors);
      redirect('categorie.php', false);
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
            <span class="glyphicon glyphicon-th"></span>
            Categories
          </strong>
        </div>

      </div>

      <div class="panel-body">

        <div class="row">

          <!-- Add Category -->
          <div class="col-md-4">

            <div class="panel panel-info">

              <div class="panel-heading">
                <strong>
                  <span class="glyphicon glyphicon-plus"></span>
                  Add New Category
                </strong>
              </div>

              <div class="panel-body">

                <form method="post" action="categorie.php">

                  <div class="form-group">

                    <label for="categorie-name">
                      Category Name
                    </label>

                    <input type="text"
                           id="categorie-name"
                           class="form-control"
                           name="categorie-name"
                           placeholder="Enter category name"
                           required>

                  </div>

                  <button type="submit"
                          name="add_cat"
                          class="btn btn-primary">

                    <span class="glyphicon glyphicon-plus"></span>
                    Add Category

                  </button>

                </form>

              </div>

            </div>

          </div>


          <!-- Categories List -->
          <div class="col-md-8">

            <div class="panel panel-default">

              <div class="panel-heading clearfix">

                <div class="pull-left">
                  <strong>
                    <span class="glyphicon glyphicon-list"></span>
                    All Categories
                  </strong>
                </div>

                <div class="pull-right">
                  <span class="label label-info">
                    <?php echo count($all_categories); ?> Categories
                  </span>
                </div>

              </div>

              <div class="panel-body">

                <div class="table-responsive">

                  <table class="table table-bordered table-striped table-hover">

                    <thead>

                      <tr>

                        <th class="text-center" style="width: 50px;">
                          #
                        </th>

                        <th>
                          Category Name
                        </th>

                        <th class="text-center" style="width: 100px;">
                          Actions
                        </th>

                      </tr>

                    </thead>

                    <tbody>

                      <?php foreach ($all_categories as $cat): ?>

                        <tr>

                          <td class="text-center">
                            <?php echo count_id(); ?>
                          </td>

                          <td>
                            <strong>
                              <?php echo remove_junk(ucfirst($cat['name'])); ?>
                            </strong>
                          </td>

                          <td class="text-center">

                            <div class="btn-group">

                              <a href="edit_categorie.php?id=<?php echo (int)$cat['id']; ?>"
                                 class="btn btn-xs btn-warning"
                                 data-toggle="tooltip"
                                 title="Edit Category">

                                <span class="glyphicon glyphicon-pencil"></span>

                              </a>

                              <a href="delete_categorie.php?id=<?php echo (int)$cat['id']; ?>"
                                 class="btn btn-xs btn-danger"
                                 data-toggle="tooltip"
                                 title="Delete Category"
                                 onclick="return confirm('Are you sure you want to delete this category?');">

                                <span class="glyphicon glyphicon-trash"></span>

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

      </div>

    </div>

  </div>

</div>

<?php include_once('layouts/footer.php'); ?>