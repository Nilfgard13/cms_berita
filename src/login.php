<?php

if (is_user_logged_in()) {
    //redirect_to('dashboard_user.php');
}

$inputs = [];
$errors = [];

if (is_post_request()) {

    [$inputs, $errors] = filter($_POST, [
        'username' => 'string | required',
        'password' => 'string | required'
    ]);

    if ($errors) {
        redirect_with('login.php', ['errors' => $errors, 'inputs' => $inputs]);
    }

    // if login fails
    if (!login($inputs['username'], $inputs['password'])) {

        $errors['login'] = 'Invalid username or password';

        redirect_with('login.php', [
            'errors' => $errors,
            'inputs' => $inputs
        ]);
    }
    // login successfully
    $isAdmin = find_role_by_username($inputs['username']);
    $username = find_user_by_username($inputs['username']);

    
    // redirect_to('index.php');
    
    if ($isAdmin === null) {
        echo "User not found.";
    } elseif ($username['is_admin'] == 1) {
        $_SESSION['username'] = $username['username'];
        redirect_to('dashboard_admin.php');
    } else {
        $_SESSION['username'] = $username['username'];
        redirect_to('dashboard_user.php');
    }

} else if (is_get_request()) {
    [$errors, $inputs] = session_flash('errors', 'inputs');
}
