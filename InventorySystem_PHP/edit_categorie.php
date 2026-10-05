<?php
  $page_title = 'Edit Category';
  require_once('includes/load.php');

  // Check user permission
  page_require_level(1);
?>

<?php
  // Get category
  $categorie = find_by_id('categories', (int)$_GET['id']);

  if(!$categorie){

    $session->msg("d", "Missing categorie id.");
    redirect('categorie.php');
  }
?>

<?php
  if(isset($_POST['edit_cat'])){

    $req_field = array('categorie-name');

    validate_fields($req_field);

    $cat_name = remove_junk($db->escape($_POST['categorie-name']));

    if(empty($errors)){

      $sql  = "UPDATE categories SET name='{$cat_name}'";
$sql .= " WHERE id='{$categorie['id']}'";
      
      $result = $db->query($sql);

      if($result && $db->affected_rows() === 1){

        $session->msg("s", "Successfully updated Categorie");
        redirect('categorie.php', false);

      } else {

        $session->msg("d", "Sorry! Failed to Update");
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
            Edit Category
          </strong>

        </div>

        <div class="pull-right">

          <a href="categorie.php"
             class="btn btn-default btn-sm">

            <span class="glyphicon glyphicon-arrow-left"></span>
            Back to Categories

          </a>

        </div>

      </div>


      <!-- Form -->
      <div class="panel-body">

        <div class="row">

          <div class="col-md-6">

            <form method="post"
                  action="edit_categorie.php?id=<?php echo (int)$categorie['id']; ?>">

              <div class="form-group">

                <label for="categorie-name">
                  Category Name
                </label>

                <div class="input-group">

                  <span class="input-group-addon">
                    <span class="glyphicon glyphicon-th"></span>
                  </span>

                  <input type="text"
                         id="categorie-name"
                         class="form-control"
                         name="categorie-name"
                         value="<?php echo remove_junk(ucfirst($categorie['name'])); ?>"
                         required>

                </div>

              </div>


              <div class="form-group">

                <a href="categorie.php"
                   class="btn btn-default">

                  <span class="glyphicon glyphicon-remove"></span>
                  Cancel

                </a>

                <button type="submit"
                        name="edit_cat"
                        class="btn btn-primary">

                  <span class="glyphicon glyphicon-ok"></span>
                  Update Category

                </button>

              </div>

            </form>

          </div>

        </div>

      </div>

    </div>

  </div>

</div>

<?php include_once('layouts/footer.php'); ?>