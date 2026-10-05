<?php
  $page_title = 'All Photos';
  require_once('includes/load.php');
  page_require_level(2);
?>

<?php
  $media_files = find_all('media');

  if(isset($_POST['submit'])) {

    $photo = new Media();
    $photo->upload($_FILES['file_upload']);

    if($photo->process_media()) {

      $session->msg('s', 'Photo has been uploaded.');
      redirect('media.php');

    } else {

      $session->msg('d', join($photo->errors));
      redirect('media.php');

    }
  }
?>

<?php include_once('layouts/header.php'); ?>

<div class="row">

  <div class="col-md-12">

    <?php echo display_msg($msg); ?>

    <div class="panel panel-default">

      <div class="panel-heading clearfix">

        <div class="pull-left">
          <strong>
            <span class="glyphicon glyphicon-camera"></span>
            All Photos
          </strong>
        </div>

        <div class="pull-right">

          <form
            class="form-inline"
            action="media.php"
            method="POST"
            enctype="multipart/form-data">

            <div class="form-group">

              <input
                type="file"
                name="file_upload"
                class="btn btn-default"
                required>

            </div>

            <button
              type="submit"
              name="submit"
              class="btn btn-primary">

              <span class="glyphicon glyphicon-upload"></span>
              Upload

            </button>

          </form>

        </div>

      </div>


      <div class="panel-body">

        <div class="clearfix" style="margin-bottom: 10px;">

          <strong>
            <span class="glyphicon glyphicon-picture"></span>
            Uploaded Photos
          </strong>

          <span class="label label-info pull-right">
            <?php echo count($media_files); ?> Photos
          </span>

        </div>


        <div class="table-responsive">

          <table class="table table-bordered table-striped table-hover">

            <thead>

              <tr>

                <th class="text-center" style="width: 50px;">
                  #
                </th>

                <th class="text-center">
                  Photo
                </th>

                <th>
                  Photo Name
                </th>

                <th class="text-center">
                  Photo Type
                </th>

                <th class="text-center" style="width: 80px;">
                  Actions
                </th>

              </tr>

            </thead>


            <tbody>

              <?php if(!empty($media_files)): ?>

                <?php foreach ($media_files as $media_file): ?>

                  <tr>

                    <td class="text-center">
                      <?php echo count_id(); ?>
                    </td>

                    <td class="text-center">

                      <img
                        src="uploads/products/<?php echo $media_file['file_name']; ?>"
                        class="img-thumbnail"
                        style="max-width: 100px; max-height: 100px;">

                    </td>

                    <td>
                      <?php echo $media_file['file_name']; ?>
                    </td>

                    <td class="text-center">
                      <?php echo $media_file['file_type']; ?>
                    </td>

                    <td class="text-center">

                      <a
                        href="delete_media.php?id=<?php echo (int)$media_file['id']; ?>"
                        class="btn btn-danger btn-xs"
                        title="Delete"
                        onclick="return confirm('Are you sure you want to delete this photo?');">

                        <span class="glyphicon glyphicon-trash"></span>

                      </a>

                    </td>

                  </tr>

                <?php endforeach; ?>

              <?php else: ?>

                <tr>

                  <td colspan="5" class="text-center">

                    <span class="glyphicon glyphicon-info-sign"></span>
                    No photos uploaded yet.

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