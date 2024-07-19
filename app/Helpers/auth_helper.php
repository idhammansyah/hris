<?php

if (! function_exists('check_sessions')) {
  function check_sessions()
  {
    if(empty(session()->get('user_data'))) {
      return redirect()->route('/')->with('error', 'You must login first!');
    }
  }
}

if (!function_exists('session_notif'))
{
  function session_notif()
  {
    if(session()->getFlashdata('message')) {
      echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check2-circle"></i>&nbsp;
       '.session()->getFlashdata("message").'
      </div>';
     } else if(session()->getFlashdata('error')) {
      echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="bi bi-exclamation-circle"></i>&nbsp;
        '. session()->getFlashdata("error") .'
      </div>';
     }
  }
}

if (!function_exists('generateBreadcrumb')) {
  function generateBreadcrumb($menuId)
  {
    $ci = \Config\Services::request();
    $menuModel = new \App\Models\Authentication\Menu_Model();
    $breadcrumb = [];

    while ($menuId != null) {
      $menu = $menuModel->find($menuId);
      if ($menu) {
        array_unshift($breadcrumb, [
          'menu_name' => $menu['menu_name'],
          'url_link' => site_url($menu['url_link'])
        ]);
          $menuId = $menu['parent_id'];
        } else {
          $menuId = null;
        }
    }

    return $breadcrumb;
  }
}

if(! function_exists('cek_extension_file'))
{
  function cek_extension_file($namaFile)
  {
    // Mendapatkan informasi path file
    $info = pathinfo($namaFile);
    
    // Mendapatkan ekstensi file
    $ekstensi = $info['extension'];
    
    // Memeriksa jenis file berdasarkan ekstensi
    // switch ($ekstensi) {
    //   case 'pdf':
    //     // echo "File adalah PDF";
    //     break;
    //   case 'xls':
    //     // echo "File adalah Excel";
    //     break;
    //   case 'xlsx':
    //     // echo "File adalah Excel";
    //     break;
    //   case 'doc':
    //     // echo "File adalah Word";
    //     break;
    //   case 'docx':
    //     // echo "File adalah Word";
    //     break;
    //   default:
    //     // echo "File tidak didukung atau tidak valid";
    //     break;
    // }
    return $ekstensi;
  }
}

if(! function_exists('potongKalimat'))
{
  function potongKalimat($kalimat, $panjangMax) {
    // Memeriksa panjang kalimat
    if(strlen($kalimat) > $panjangMax) {
        // Memotong kalimat jika terlalu panjang
        $kalimat = substr($kalimat, 0, $panjangMax) . "...";
    }
    return $kalimat;
  }
}

if(!function_exists('send_email_activation'))
{
  function send_email_activation($email ="", $tokenpertama="", $tokenkedua="")
  { 

    $sources = 
    '
    <!DOCTYPE html>
      <html>
        <head>
          <meta charset="UTF-8">
          <title>Aktivasi Akun Kamu</title>
          <style>
            /* Ganti warna latar belakang dan warna teks sesuai keinginan Anda */
            body {
              background-color: #f8f8f8;
              color: #333;
              font-family: Arial, sans-serif;
              font-size: 16px;
              line-height: 1.5;
              text-align:justify;
            }
            /* Ganti warna latar belakang dan warna teks tombol sesuai keinginan Anda */
            button {
              background-color: #4CAF50;
              border: none;
              color: white;
              padding: 12px 24px;
              text-align: center;
              text-decoration: none;
              display: inline-block;
              font-size: 16px;
              margin: 4px 2px;
              cursor: pointer;
              border-radius: 4px;
            }
            p, a, b {
              font-size:14pt;
              text-align: justify;
              text-decoration:none;
            }
          </style>
        </head>
        <body>
          <h3>Halo, {EMAIL}. <br>Aktifkan akun kamu disini.</h3>
          <p>Email ini dikirim karena anda sudah melakukan pendaftaran di Learning Management System Abhati Group. Silahkan klik tombol aktifkan dibawah ini untuk mengaktifkan akun kamu.</p><br>
          
          <a href=" '.base_url('aktifkan-akun/'.$tokenpertama.'/'.$tokenkedua.'').'">
            Klik disini untuk aktifkan akun
          </a>
          <br><br>

          <p>Jika Kamu merasa tidak mendaftarkan diri di website kami, silahkan hapus email ini. </p><br><br>

          <p>Semooga harimu menyenangkan!</p><br><br>
          <b>ABHATI GROUP</b>
        </body>
      </html>
    ';
    
    $hasil = str_replace("{EMAIL}", $email, $sources);
    // $hasil = str_replace("{TOKEN_KESATU}", $tokenpertama, $hasil);
    // $hasil = str_replace("{TOKEN_KEDUA}", $tokenkedua, $hasil);
    
    return $hasil;
  }
}