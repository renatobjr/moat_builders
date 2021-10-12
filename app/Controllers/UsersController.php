<?php

namespace App\Controllers;

use App\Models\UserModel;

class UsersController extends BaseController
{
  /**
   * Render the form to new users
   * @param void
   * @return view return form view
   */
  public function newUser()
  {
    // Set title
    $dataHeader['title'] = 'New User';

    // render page to save new users
    echo view('forms/form_user', $dataHeader);
    echo view('templates/footer');
  }

  /**
   * Validate the form and persist data in DB
   * @param void
   * @return view dashboard view if validate is TRUE or the forms with erros case FALSE
   */
  public function saveUser()
  {
    helper(['form', 'url']);

    // Set title
    $dataHeader['title'] = 'New User';

    if ($this->request->getMethod() === 'post' && $this->validate([
      'fullname'    => 'required',
      'username'    => 'required',
      'password'    => 'required',
      'role'        => 'required'
    ])) {

      // Set the model
      $user = new UserModel();

      $data = [
        'fullname'    => $this->request->getPost('fullname'),
        'username'    => $this->request->getPost('username'),
        'password'    => password_hash($this->request->getPost('password'),PASSWORD_DEFAULT),
        'role'        => $this->request->getPost('role')
      ];

      if (!$this->request->getPost('id')) {
        // Verify if the username is unique
        $notUnique = $user->where('username',$this->request->getPost('username'))->first();
        if ($notUnique) {
          session()->setFlashdata('error', 'Ops! Choice other Username');
          return redirect()->to(base_url('new-user'));
        } else {
          $user->save($data);
          $flashResponse = 'Great! Now you can login.';
        }
      } else {
        $user->update($this->request->getPost('id'), $data);
        $flashResponse = 'User info updated!';
      }

      // Set flashdata and redirect
      session()->setFlashdata('success', $flashResponse);
      return redirect()->to(base_url());
    } else {
      // render page to save new users
      echo view('forms/form_user', $dataHeader, [
        'validation' => $this->validator
      ]);
      echo view('templates/footer');
    }
  }
  /**
   * Do the login
   * @param void
   * @return view Redirect to dashboard case validate is TRUE or the form with erros case FALSE
   */
  public function login()
  {
    helper(['form', 'url']);

    // Set session and model
    $session = session();
    $user = new UserModel();

    // Set title
    $dataHeader['title'] = 'Login';

    if ($this->request->getMethod() === 'post' && $this->validate([
      'username'    => 'required',
      'password'    => 'required',
    ])) {
      // Retrive username and password
      $username = $this->request->getPost('username');
      $pwdInput = $this->request->getPost('password');

      // Check data on DB
      $dataUser = $user->where('username', $username)->first();

      if ($dataUser) {
        $password = $dataUser['password'];
        $isAuth = password_verify($pwdInput, $password);

        // Verify the password
        if ($isAuth) {

          $sesssion_user = [
            'id'        => $dataUser['id'],
            'fullname'  => $dataUser['fullname'],
            'role'      => $dataUser['role'],
            'isLogged'  => true
          ];

          $session->set($sesssion_user);
          return redirect()->to('dashboard');
        } else {
          // If the password wrong!
          $flashResponse = 'Please, verify your password.';
        }
      } else {
        // If username wrong!
        $flashResponse = 'Please verify your username.';
      }
      // Return to login page
      session()->setFlashdata('error', $flashResponse);
      return redirect()->to(base_url());
    } else {
      echo view('index', $dataHeader, [
        'validation' => $this->validator
      ]);
      echo view('templates/footer');
    }
  }
  /**
   * Do the logout and destroy the session setting in @login
   * @param void
   * @return view redirect to login page
   */
  public function logout()
  {
    // Set session and destroy
    $session = session();
    $session->destroy();

    // Redirect
    return redirect()->to(base_url());
  }
}
