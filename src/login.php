<?php

if (is_user_logged_in()) {
    redirect_to('index.php');
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
    redirect_to('index.php');
    $is_admin = check_user_role($inputs['username'], $inputs['password']);
    if ($is_admin === true) {
        // Display admin dashboard
        redirect_to('dashboard_admin.php');
        // ... Admin functionalities ...
    } elseif ($is_admin === false) {
        // Display user dashboard
        redirect_to('dashboard_user.php');
        // ... User functionalities ...
    } else {
        // Invalid credentials
        echo "Invalid username or password.";
    }

} else if (is_get_request()) {
    [$errors, $inputs] = session_flash('errors', 'inputs');
}
