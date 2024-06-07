<?php
/**
 * Register a user
 *
 * @param string $email
 * @param string $username
 * @param string $password
 * @param bool $is_admin
 * @return bool
 */
function register_user(string $email, string $username, string $password, bool $is_admin = false): bool
{
    $sql = 'INSERT INTO users(username, email, password, is_admin)
            VALUES(:username, :email, :password, :is_admin)';

    $statement = db()->prepare($sql);

    $statement->bindValue(':username', $username, PDO::PARAM_STR);
    $statement->bindValue(':email', $email, PDO::PARAM_STR);
    $statement->bindValue(':password', password_hash($password, PASSWORD_BCRYPT), PDO::PARAM_STR);
    $statement->bindValue(':is_admin', (int) $is_admin, PDO::PARAM_INT);


    return $statement->execute();
}

function find_user_by_username(string $username)
{
    $sql = 'SELECT *
            FROM users
            WHERE username=:username';
    $statement = db()->prepare($sql);
    $statement->bindValue(':username', $username, PDO::PARAM_STR);
    $statement->execute();

    return $statement->fetch(PDO::FETCH_ASSOC);
}

function login(string $username, string $password): bool
{
    $user = find_user_by_username($username);

    // if user found, check the password
    if ($user && password_verify($password, $user['password'])) {

        // prevent session fixation attack
        session_regenerate_id();

        // set username in the session
        $_SESSION['username'] = $user['username'];
        $_SESSION['user_id'] = $user['id'];


        return true;
    }

    return false;
}

function is_user_logged_in(): bool
{
    return isset($_SESSION['username']);
}

function require_login(): void
{
    if (!is_user_logged_in()) {
        redirect_to('login.php');
    }
}

function logout(): void
{
    if (is_user_logged_in()) {
        unset($_SESSION['username'], $_SESSION['user_id']);
        session_destroy();
        redirect_to('login.php');
    }
}

function current_user()
{
    if (is_user_logged_in()) {
        return $_SESSION['username'];
    }
    return null;
}

function find_role_by_username(string $username): ?bool
{
    $sql = "SELECT is_admin FROM users WHERE username = :username";
    $statement = db()->prepare($sql);
    $statement->bindValue(':username', $username, PDO::PARAM_STR);
    $statement->execute();
    $result = $statement->fetch(PDO::FETCH_ASSOC);
    if ($result !== false) {
        return $_SESSION['is_admin'] == $result; // Mengasumsikan is_admin adalah flag boolean
    } else {
        return null; // User tidak ditemukan
    }
}

function find_id_by_username(string $username)
{
    $sql = 'SELECT id
            FROM users
            WHERE username=:username';
    $statement = db()->prepare($sql);
    $statement->bindValue(':username', $username, PDO::PARAM_STR);
    $statement->execute();

    return $statement->fetch(PDO::FETCH_ASSOC);
}

function createArticle(int $id_users, string $nama_penulis, string $email, string $gender, string $alamat_penulis, string $judul_artikel, string $gambar, string $tema_artikel, string $isi){
    $sql = 'INSERT INTO artikel (id_users, nama_penulis, email, gender, alamat_penulis, judul_artikel, gambar, tema_artikel, isi) 
    VALUES (:id_users, :nama_penulis, :email, :gender, :alamat_penulis, :judul_artikel, :gambar, :tema_artikel, :isi)';

    $statement = db()->prepare($sql);

    $statement->bindValue(':nama_penulis', $nama_penulis, PDO::PARAM_STR);
    $statement->bindValue(':email', $email, PDO::PARAM_STR);
    $statement->bindValue(':gender', $gender, PDO::PARAM_STR);
    $statement->bindValue(':alamat_penulis', $alamat_penulis, PDO::PARAM_STR);
    $statement->bindValue(':judul_artikel', (int) $judul_artikel, PDO::PARAM_INT);
    $statement->bindValue(':gambar', (int) $gambar, PDO::PARAM_INT);
    $statement->bindValue(':tema_artikel', (int) $tema_artikel, PDO::PARAM_INT);
    $statement->bindValue(':isi', (int) $isi, PDO::PARAM_INT);


    return $statement->execute();
}