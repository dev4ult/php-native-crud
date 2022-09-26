<?php
require 'functions.php';
$data_mhs = query_select("SELECT * FROM mahasiswa");

if (isset($_POST['tambah-data'])) {
    if (catch_post_and($_POST, "INSERT", 0) > 0) {
        echo "<script>alert('New Data Has Been Inserted')</script>";
        echo "<script>window.location.href='index.php'</script>";
    } else {
        echo "<script>alert('Error Occured When trying to insert a new row of data')</script>";
    }
}

if (isset($_GET['search'])) {
    $key = $_GET['search'];
    $data_mhs = query_select("SELECT * FROM mahasiswa WHERE nama LIKE '%" . $key . "%' OR nim LIKE '%" . $key . "%' OR email LIKE '%" . $key . "%' OR jurusan LIKE '%" . $key . "%'");
}

?>

<!DOCTYPE html>
<html lang="en" data-theme="corporate">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="./css/styles.css" />
    <title>Tabel Mahasiswa</title>
</head>

<body class='font-poppins'>
    <main class="container max-w-6xl mx-auto px-3">
        <div class="flex gap-4 my-5">
            <!-- add data button -->
            <label for="add-button" class="btn modal-button btn-sm  text-white">Tambah
                Mahasiswa</label>

            <div class="form-control">
                <div class="input-group">
                    <input type="text" id="search-key" placeholder="Search…" class="input input-sm input-bordered" />
                    <button id="search-btn" class="btn btn-sm btn-square">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </button>
                </div>
            </div>

            <script>
            const searchBtn = document.querySelector('#search-btn');
            const searchKey = document.querySelector('#search-key');
            searchBtn.addEventListener('click', _ => {
                const key = searchKey.value;
                window.location.href = 'index.php?search=' + key;
            })

            searchKey.addEventListener('keypress', event => {
                if (event.key == 'Enter') {
                    const key = searchKey.value;
                    window.location.href = 'index.php?search=' + key;
                }
            })
            </script>

        </div>


        <!-- add data modal -->
        <input type="checkbox" id="add-button" class="modal-toggle" />
        <div class="modal modal-bottom sm:modal-middle">
            <div class="modal-box">
                <h3 class="font-bold text-lg mb-4">Form Tambah Mahasiswa</h3>
                <form class="flex flex-col gap-2 " action="" method="post" enctype="multipart/form-data">
                    <div class="form-control ">
                        <label class="input-group input-group-sm">
                            <span>Nama</span>
                            <input type="text" placeholder="Nama" class="input input-bordered input-md w-full"
                                name="nama" />
                        </label>
                    </div>
                    <div class="form-control ">
                        <label class="input-group input-group-sm">
                            <span>Email</span>
                            <input type="email" placeholder="Email" class="input input-bordered input-md w-full"
                                name="email" />
                        </label>
                    </div>
                    <div class="form-control ">
                        <label class="input-group input-group-sm">
                            <span>NIM</span>
                            <input type="number" placeholder="NIM" class="input input-bordered input-md w-full"
                                name="nim" />
                        </label>
                    </div>
                    <div class="form-control ">
                        <label class="input-group input-group-sm">
                            <span>Jurusan</span>
                            <input type="text" placeholder="Jurusan" class="input input-bordered input-md w-full"
                                name="jurusan" />
                        </label>
                    </div>
                    <div class="form-control ">
                        <label class="input-group input-group-sm">
                            <span>Gambar</span>
                            <input type="file" placeholder="Gambar" class="input input-bordered input-md w-full"
                                name="gambar" />
                        </label>
                    </div>
                    <div class="modal-action">
                        <input type="submit" value="Tambah" class="btn btn-sm btn-success text-white"
                            name="tambah-data">
                    </div>
                </form>
                <div class="modal-action absolute top-0 right-0 m-6">
                    <label for="add-button" class="btn p-0 btn-square btn-sm">
                        <img src="./img/logo/close.svg" alt="close button" class="w-6">
                    </label>
                </div>
            </div>
        </div>


        <div class="overflow-x-auto">
            <table class="table table-compact w-full">
                <thead>
                    <tr>
                        <th></th>
                        <th></th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>NIM</th>
                        <th>Jurusan</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $id = 1;foreach ($data_mhs as $mhs): ?>
                    <tr>
                        <th><?=$id?></th>
                        <td><img src="./img/pfp/<?=$mhs['gambar']?>" alt="<?=$mhs['nama']?> profile pic"
                                class="w-20 object-cover">
                        </td>
                        <td><?=$mhs['nama']?></td>
                        <td><?=$mhs['email']?></td>
                        <td><?=$mhs['nim']?></td>
                        <td><?=$mhs['jurusan']?></td>
                        <td>
                            <a href="detail.php?data-id=<?=$id?>" class="btn btn-info btn-sm text-white">Edit</a>
                        </td>
                    </tr>
                    <?php $id++;endforeach?>
                </tbody>
                <tfoot>
                    <tr>
                        <th></th>
                        <th></th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>NIM</th>
                        <th>Jurusan</th>
                        <th></th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </main>
</body>

</html>