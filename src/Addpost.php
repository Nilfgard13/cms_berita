<?php

if (!isset($_SESSION['username'])) {
    redirect_to('login.php');
}

$errors = [];
$inputs = [];

if (is_post_request()) {

    // Tentukan aturan validasi untuk bidang input
    $fields = [
        'nama_penulis' => 'string | required | between: 3, 100',
        'email' => 'email | required',
        'gender' => 'string | required | in: pria, wanita',
        'alamat_penulis' => 'string | required',
        'judul_artikel' => 'string | required | between: 3, 255',
        'gambar' => 'string | required',
        'tema_artikel' => 'string | required | in: Sosial, Ekonomi, Politik, Pendidikan, Teknologi, Olah raga, Kesehatan',
        'isi' => 'string | required'
    ];

    // Pesan kustom untuk validasi
    $messages = [
        'gender' => [
            'in' => 'Gender harus berupa "pria" atau "wanita"'
        ],
        'tema_artikel' => [
            'in' => 'Tema artikel harus salah satu dari "Sosial", "Ekonomi", "Politik", "Pendidikan", "Teknologi", "Olah raga", "Kesehatan"'
        ]
    ];

    // Filter input dan validasi
    [$inputs, $errors] = filter($_POST, $fields, $messages);

    if ($errors) {
        redirect_with('addPost.php', [
            'inputs' => $inputs,
            'errors' => $errors
        ]);
    }

    // Mendapatkan id_users dari username
    $username = $_SESSION['username'];
    $user = find_id_by_username($username);

    if (!$user) {
        $errors['user'] = 'Pengguna tidak ditemukan';
        redirect_with('addPost.php', [
            'inputs' => $inputs,
            'errors' => $errors
        ]);
    }

    $id_users = $user['id'];

    // Menambahkan artikel ke database
    if (createArticle($id_users, $inputs['nama_penulis'], $inputs['email'], $inputs['gender'], $inputs['alamat_penulis'], $inputs['judul_artikel'], $inputs['gambar'], $inputs['tema_artikel'], $inputs['isi'])) {
        
        redirect_with_message(
            'index.php',
            'Artikel Anda telah berhasil dibuat.'
        );
    } else {
        $errors['database'] = 'Terjadi kesalahan saat menyimpan artikel. Silakan coba lagi.';
        redirect_with('addPost.php', [
            'inputs' => $inputs,
            'errors' => $errors
        ]);
    }

} else if (is_get_request()) {
    [$inputs, $errors] = session_flash('inputs', 'errors');
}