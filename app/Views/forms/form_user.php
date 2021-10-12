<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <title><?php echo $title ?></title>
</head>

<body>

  <?php
    $validation = \Config\Services::validation();
    helper('form');
  ?>

  <!-- Body -->
  <div class="row" style="padding-top:10vh">
    <div class="col l4 push-l4">
      <div class="card white">
        <!-- Card title -->
        <div class="card-content black-text">
          <span class="card-title light"><?php echo $title; ?>
            <i class="material-icons small right">account_circle</i>
          </span>
        </div>
        <!-- Card content -->
        <div class="card-action">
          <?php echo form_open('save-user') ?>
          <input type="hidden" name="id" value="<?php echo isset($dataUser) ? $dataUser['id'] : set_value('id'); ?>">
          <?php echo csrf_field() ?>
          <!-- fullname -->
          <div class="row">
            <div class="input-field col l12">
              <i class="material-icons prefix">person</i>
              <label for="fullname">Fullname</label>
              <input type="text" name="fullname" id="fullname" class="validate
            <?php echo $validation->getError('fullname') ? 'invalid' : '' ?>" value="<?php echo isset($dataUser['fullname']) ? $dataUser['fullname'] : set_value('fullname') ?>">
              <span class="helper-text" data-error="The field is required."></span>
            </div>
          </div>
          <!-- username -->
          <div class="row">
            <div class="input-field col l12">
              <i class="material-icons prefix">person</i>
              <label for="username">Username</label>
              <input type="text" name="username" id="username" class="validate
            <?php echo $validation->getError('username') ? 'invalid' : '' ?>" value="<?php echo isset($dataUser['full_name']) ? $dataUser['full_name'] : set_value('username') ?>">
              <span class="helper-text" data-error="The field is required."></span>
            </div>
          </div>
          <!-- password -->
          <div class="row">
            <div class="input-field col l12">
              <i class="material-icons prefix">password</i>
              <label for="password">Password</label>
              <input type="password" name="password" id="password" class="validate
            <?php echo $validation->getError('password') ? 'invalid' : '' ?>" value="<?php echo isset($dataUser['full_name']) ? $dataUser['full_name'] : set_value('password') ?>">
              <span class="helper-text" data-error="The field is required."></span>
            </div>
          </div>
          <!-- rolw -->
          <div class="row">
            <div class="input-field col l12">
              <i class="material-icons prefix">manege_account</i>
              <select name="role" id="role">
                <option value="" selected>Choose a Role</option>
                <option value="0">Admin</option>
                <option value="1">User</option>
              </select>
              <label for="role">Role</label>
              <span class="helper-text" data-error="The field is required."></span>
            </div>
          </div>
          <div class="card-action">
            <!-- Btn send -->
            <div class="row center">
              <button type="submit" class="btn waves-effect-waves-light green">save</button>
              <a href="<?php echo base_url() ?>" class="btn waves-effect-waves-light red">back</a>
            </div>
          </div>
          <?php echo form_close(); ?>
        </div>
      </div>
    </div>
  </div>