<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Aplikasi Peramalan Stok Barang Minimarket Malayanda</title>
        <link href="<?php echo base_url(); ?>assets/css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body>
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <h5 style="color:blue; text-align:center;" class="rounded-lg mt-5">LOGIN</h5>
									<p style="color:red; text-align:center;"><?php echo $hasillogin;?></p>
									
                                    <div class="card-body">
                                        <form action="<?php echo base_url('login/aksi_login'); ?>" method="post">
                                            <div class="form-group"><label class="mb-1" for="inputEmailAddress">Username</label><input class="form-control py-4" id="inputEmailAddress" type="text" name="username" placeholder="Masukkan Username" /></div>
                                            <div class="form-group"><label class="mb-1" for="inputPassword">Password</label><input class="form-control py-4" id="inputPassword" name="password" type="password" placeholder="Masukkan password" /></div><button class="btn btn-info" type="submit">Masuk</button></div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </body>
</html>
