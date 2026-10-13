<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include "config/style.php"; ?>
    <title>Main Menu</title>
</head>
<body>
    <!-- navbar -->
     <nav class="navbar navbar-expand-lg bg-primary fixed-top w-100" data-bs-theme="dark">

        <div class="container-fluid">
            <a href="index.php" class="navbar-brand" >Alexandria</a>
            <div class="d-flex" id="navbarSuportedContent" >
                <ul class="navbar-nav me-auto mb-2 mb-lg-0" >
                    <li class="nav-item" >
                        <a href="index.php" class="nav-link active">HOME</a>
                    </li>
                    <li class="nav-item"  >
                        <a href="/perpustakaan/anggota" class="btn btn-success ms-5" >LOGIN</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- hero -->
     <div class="container mw-100 min-vh-100 d-flex justify-content-center align-items-center" >
        <div class="d-flex flex-column" >
            <h1>Welcome to Alexandria</h1>
            <div class="w-100 d-flex justify-content-end gap-5" >
                <a href="" class="btn  btn-success" >About Us</a>
                <a href="" class="btn  btn-success" >Explore</a>
            </div>
        </div>
     </div>
</body>
</html>