<div class="row">
  <div class="row">
    <?php if (count($albumsList) === 0) : ?>
      <div class="col l4 push-l4 center" style="margin-top: 25vh;">
        <h3 class="light">You haven't registered any Album yet. How about starting now!</h1>
        <a href="<?php echo base_url('/dashboard/new-album')?>" class="btn waves-effect-waves-light green" style="margin-top:5vh">Add album</a>
      </div>
    <?php else : ?>
      <div class="col l10 push-l1">
        <table class="striped">
          <thead>
            <tr>
              <th style="text-align:center;width:80px"></th>
              <th style="text-align:center;width:80px"></th>
              <th style="text-align:center;">Artist</th>
              <th style="text-align:center;">Album</th>
              <th style="text-align:center;">Released At</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($albumsList as $album) : ?>
              <tr>
                <td><a href="<?php echo base_url('dashboard/edit-album/' . $album['id']) ?>" class="waves-effect waves-light btn blue"><i class="material-icons">edit</i></a></td>
                <td><a href="<?php echo base_url('dashboard/delete-album/' . $album['id']) ?>" class="waves-effect waves-light btn red"><i class="material-icons">delete</i></a></td>
                <td><?php echo $album['artist_name']; ?></td>
                <td><?php echo $album['album_title']; ?></td>
                <td style="text-align:center;"><?php echo $album['album_year']; ?></td>
              </tr>
            <?php endforeach ?>
          </tbody>
        </table>
      <?php endif; ?>
      </div>
  </div>
</div>