<!-- Validation service -->
<?php 
  $validation = \Config\Services::validation(); 
  helper('form');  
?>

<div class="row" style="padding-top:15vh">
  <div class="col l4 push-l4">
    <div class="card white">
      <!-- Card title -->
      <div class="card-content black-text">
        <span class="card-title light"><?php echo $title; ?>
          <i class="material-icons small right">album</i>
        </span>
      </div>
      <!-- Card content -->
      <div class="card-action">
        <?php echo form_open('/dashboard/save-album')?>
          <input type="hidden" name="id" value="<?php echo isset($dataAlbum) ? $dataAlbum['id'] : set_value('id'); ?>">
          <?php echo csrf_field() ?>
          <!-- Select from artist -->
          <div class="row">
            <div class="input-field col l12">
              <i class="material-icons prefix">person</i>
              <select name="artist_id" id="artist_id">
                <option value="" disabled selected>Choose an Artist</option>
                <?php foreach ($artistList as $artist) : ?>
                  <option value="<?php echo $artist['id'] ?>" <?php if (isset($dataAlbum['id']) && $artist['id'] == $dataAlbum['id']) : ?> selected="selected" <?php endif; ?>>
                    <?php echo $artist['name'] ?>
                  </option>
                <?php endforeach ?>
              </select>
              <label for="artist_id"></label>
              <span class="helper-text" data-error="This field is required."></span>
            </div>
          </div>
          <!-- Album name -->
          <div class="row">
            <div class="input-field col l12">
              <i class="material-icons prefix">album</i>
              <label for="album_title" data-error="testes">Album</label>
              <input type="text" name="album_title" id="album_title" class="validate
                  <?php echo $validation->getError('album_title') ? 'invalid' : ''; ?>" value="<?php echo isset($dataAlbum) ? $dataAlbum['album_title'] : set_value('album_title'); ?>">
              <span class="helper-text invalid" data-error="The field is required."></span>
            </div>
          </div>
          <!-- Album year -->
          <div class="row">
            <div class="input-field col l12">
              <i class="material-icons prefix">event</i>
              <label for="album_year">Year</label>
              <input type="number" min="1900" max="<?php date("Y") ?>" name="album_year" id="album_year" class="validate 
                <?php echo $validation->getError('album_year') ? 'invalid' : ''; ?>" value="<?php echo isset($dataAlbum) ? $dataAlbum['album_year'] : set_value('album_year'); ?>">
              <span class="helper-text invalid" data-error="The field is required."></span>
            </div>
          </div>
      </div>
      <div class="card-action">
        <!-- Btn send -->
        <div class="row center">
          <button type="submit" class="btn waves-effect-waves-light green">save</button>
        </div>
      </div>
      <?php echo form_close()?>
    </div>
  </div>
</div>