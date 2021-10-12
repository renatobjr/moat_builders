<!-- Validation service -->
<?php $validation = \Config\Services::validation(); ?>

</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<script>
  M.AutoInit();
  <?php if(session()->getFlashdata('success')) : ?>
    M.toast({html: '<?php echo session()->getFlashdata('success') ?>' ,displayLength: 4000,classes:'green darken-4'});
  <?php elseif (session()->getFlashdata('error')) : ?>
    M.toast({html: '<?php echo session()->getFlashdata('error') ?>' ,displayLength: 4000,classes:'red darken-4'});
  <?php endif; ?>
  $('select[name="artist_id"]').formSelect({
      classes: 'validate <?php echo $validation->getError('album_title') ? 'invalid' : ''; ?>'
  });
  $('select[name="role"]').formSelect({
      classes: 'validate <?php echo $validation->getError('album_title') ? 'invalid' : ''; ?>'
  });
</script>
</html>