<?php

if($_SERVER["REQUEST_METHOD"] == "GET"){
    switch ($url){
        // Public Routes
        case $baseURL.'/':
            require_once "controller/homeController.php";
            $homeCtrl = new HomeController();
            echo $homeCtrl->index();
            break;
        case $baseURL.'/daftar':
            require_once "controller/pendaftaranController.php";
            $daftarCtrl = new PendaftaranController();
            echo $daftarCtrl->view_daftarAwal();
            break;
        case $baseURL.'/daftar/tahap':
            require_once "controller/pendaftaranController.php";
            $daftarCtrl = new PendaftaranController();
            echo $daftarCtrl->view_daftar();
            break;
        case $baseURL.'/daftar/hasil':
            require_once "controller/pendaftaranController.php";
            $daftarCtrl = new PendaftaranController();
            echo $daftarCtrl->view_hasil();
            break;

        // Auth Related
        case $baseURL.'/register':
            require_once "controller/homeController.php";
            $adminCtrl = new HomeController();
            echo $adminCtrl->register();
            break;
        case $baseURL.'/login':
            require_once "controller/homeController.php";
            $adminCtrl = new HomeController();
            echo $adminCtrl->login();
            break;
        case $baseURL.'/logout':
            require_once "controller/homeController.php";
            $adminCtrl = new HomeController();
            echo $adminCtrl->logout();
            break;

        // Admin
        case $baseURL.'/admin':
            require_once "controller/adminController.php";
            $adminCtrl = new AdminController();
            echo $adminCtrl->view_admin();
            break;
        case $baseURL.'/admin/buat-pendaftaran':
            require_once "controller/pendaftaranController.php";
            $daftarCtrl = new PendaftaranController();
            echo $daftarCtrl->view_buatPendaftaran();
            break;
        case $baseURL.'/admin/list-hasil-pendaftaran':
            require_once "controller/pendaftaranController.php";
            $daftarCtrl = new PendaftaranController();
            echo $daftarCtrl->view_listHasilPendaftaran();
            break;

        // Petugas
        case $baseURL.'/petugas':
            require_once "controller/petugasController.php";
            $pageContoller = new PetugasController();
            echo $pageContoller->view_vaksin();				
            break;	
            case $baseURL.'/petugas/cari-orang-vaksin':
                require_once "controller/petugasController.php";
                $pageContoller = new PetugasController();
                echo $pageContoller->view_vaksinS($_GET['filter']);
                break;
            case $baseURL.'/petugas/input-data-kesehatan':
                require_once "controller/petugasController.php";
                $pageContoller = new PetugasController();
                echo $pageContoller->view_dataKesehatan($_GET['vaksin']);
                break;
        // Pimpinan
        case $baseURL.'/pimpinan':
            require_once "controller/pimpinanController.php";
            $pimpinanCtrl = new PimpinanController();
            echo $pimpinanCtrl->index();
            break;
        case $baseURL.'/pimpinan/laporan-pendaftaran':
            require_once "controller/pimpinanController.php";
            $pimpinanCtrl = new PimpinanController();
            echo $pimpinanCtrl->laporanPendaftaran();
            break;
        case $baseURL.'/pimpinan/laporan-vaksinasi':
            require_once "controller/pimpinanController.php";
            $pimpinanCtrl = new PimpinanController();
            echo $pimpinanCtrl->laporanVaksinasi();
            break;
        
        // Ceritanya Inbox (Simulasi)
        case $baseURL.'/email':
            require_once "controller/emailController.php";
            $emailCtrl = new EmailController();
            echo $emailCtrl->view_email();
            break;

        default:
            echo '404 Not Found';
            break;
    }
}else if($_SERVER["REQUEST_METHOD"] == "POST"){
    switch ($url){
        // Public Routes
        case $baseURL.'/daftar':
            require_once "controller/pendaftaranController.php";
            $daftarCtrl = new pendaftaranController();
            echo $daftarCtrl->submitPendaftaran();
            break;

        // Auth Related
        case $baseURL.'/login':
            require_once "controller/homeController.php";
            $homeCtrl = new HomeController();
            echo $homeCtrl->submitLogin();
            break;
        case $baseURL.'/register':
            require_once "controller/homeController.php";
            $homeCtrl = new HomeController();
            echo $homeCtrl->submitRegister();
            break;

        // Admin
        case $baseURL.'/admin/buat-pendaftaran':
            require_once "controller/pendaftaranController.php";
            $daftarCtrl = new PendaftaranController();
            echo $daftarCtrl->buatPendaftaran();
            redirect(route("/admin"));
            break;
        case $baseURL.'/admin/tolak-pendaftaran':
            require_once "controller/pendaftaranController.php";
            $daftarCtrl = new PendaftaranController();
            echo $daftarCtrl->tolakPendaftaran();
            $idDaftar = $_POST['idDaftar'];
            redirect(route("/admin/list-hasil-pendaftaran?idDaftar=$idDaftar"));
            break;
        case $baseURL.'/admin/tentukan-tanggal':
            require_once "controller/pendaftaranController.php";
            $daftarCtrl = new PendaftaranController();
            echo $daftarCtrl->tentukanTanggal();
            break;
        case $baseURL.'/set-tanggal-vaksinasi':
            require_once "controller/pendaftaranController.php";
            $daftarCtrl = new PendaftaranController();
            echo $daftarCtrl->setTanggalVaksinasi();
            $idDaftar = $_POST['idDaftar'];
            redirect(route("/admin/list-hasil-pendaftaran?idDaftar=$idDaftar"));
            break;

        // Petugas
        
        case $baseURL.'/petugas/submit-data-kesehatan':
            require_once "controller/petugasController.php";
            $pageContoller = new PetugasController();
            echo $pageContoller->input_dataKesehatan($_POST['idPenduduk'],$_POST['suhu'],$_POST['mm'],$_POST['Hg'],$_POST['vaksin']);
            redirect(route("/petugas"));
            break;

        // Pimpinan
        case $baseURL.'/pimpinan/laporan-vaksinasi':
            require_once "controller/pimpinanController.php";
            $pimpinanCtrl = new PimpinanController();
            echo $pimpinanCtrl->laporanVaksinasiSc($_POST['awalVaksinasi'],$_POST['akhirVaksinasi']);               
            break;
        case $baseURL.'/pimpinan/laporan-vaksinasi-detail':
            require_once "controller/pimpinanController.php";
            $pimpinanCtrl = new PimpinanController();
            echo $pimpinanCtrl->laporanVaksinasidetail($_POST['awalVaksinasi'],$_POST['akhirVaksinasi']);               
            break;
         case $baseURL.'/pimpinan/laporan-pendaftaran':
                require_once "controller/pimpinanController.php";
                $pimpinanCtrl = new PimpinanController();
                echo $pimpinanCtrl->laporanPendaftaranSc($_POST['awalpendaftaran'],$_POST['akhirpendaftaran']);               
                break;
        case $baseURL.'/pimpinan/laporan-pendaftaran-detail':
                require_once "controller/pimpinanController.php";
                $pimpinanCtrl = new PimpinanController();
                echo $pimpinanCtrl->laporanPendaftarandetail($_POST['awalpendaftaran'],$_POST['akhirpendaftaran']);               
                break;

        default:
            echo '404 Not Found';
            break;
    }
}
