<?php

namespace App\Controllers;


class Menu extends BaseController
{
	/* 
		Check if the login form is submitted, and validates the user credential
		If not submitted it redirects to the login page
	*/

	public function __construct()
	{
		$this->not_logged_in();
		if (!session('id')) {
			return redirect()->to('/auth/logout');
		}
	}

	public function index()
	{
		echo view('atur/filemanager');
	}

	public function hapus()
	{
		$file = $_POST['url'];
		if($file){
		if (!unlink($file))
			{
				echo ("Error deleting ");
			}
		else
			{
			    
            	$folder = "assets/pages/"; //Sesuaikan Folder nya
				if (!($buka_folder = opendir($folder))) die("eRorr... Tidak bisa membuka Folder");

				$file_array = array();
				while ($baca_folder = readdir($buka_folder)) {
					$file_array[] = array('nama' => $baca_folder);
				}
				
                $posts = array();

				$jumlah_array = count($file_array);
				for ($i = 2; $i < $jumlah_array; $i++) {
					$nama_file = $file_array[$i]['nama'];
                    $posts[] = array('nama_file'=> "$nama_file");
					
						
				}
				
				$json_data =  json_encode($posts);
                file_put_contents('datagambar.json', $json_data);
				return redirect()->to('menu'); 
			}
		}
	}
	public function rename()
	{
		$folder = $_POST['folder'];
		$nama_file = $_POST['nama_file'];

		
		$nama_file_ubah = $_POST['nama_file_ubah'];

		$fileAwal = $folder.$nama_file;
		$fileBaru = $folder.$nama_file_ubah;


		if($fileAwal && $fileBaru){
		if (!rename($fileAwal , $fileBaru))
			{
				echo ("Error deleting ");
			}
		else
			{
			    
            	$folder = "assets/pages/"; //Sesuaikan Folder nya
				if (!($buka_folder = opendir($folder))) die("eRorr... Tidak bisa membuka Folder");

				$file_array = array();
				while ($baca_folder = readdir($buka_folder)) {
					$file_array[] = array('nama' => $baca_folder);
				}
				
                $posts = array();

				$jumlah_array = count($file_array);
				for ($i = 2; $i < $jumlah_array; $i++) {
					$nama_file = $file_array[$i]['nama'];
                    $posts[] = array('nama_file'=> "$nama_file");
					
						
				}
				
				$json_data =  json_encode($posts);
                file_put_contents('datagambar.json', $json_data);
                
				return redirect()->to('menu'); 
			}
		}
	}


	
	public function upload()
	{
		$upload = $this->request->getFile('upload');
		if($upload){
            $upload->move('assets/pages/');
            
            
            	$folder = "assets/pages/"; //Sesuaikan Folder nya
				if (!($buka_folder = opendir($folder))) die("eRorr... Tidak bisa membuka Folder");

				$file_array = array();
				while ($baca_folder = readdir($buka_folder)) {
					$file_array[] = array('nama' => $baca_folder);
				}
				
                $posts = array();

				$jumlah_array = count($file_array);
				for ($i = 2; $i < $jumlah_array; $i++) {
					$nama_file = $file_array[$i]['nama'];
                    $posts[] = array('nama_file'=> "$nama_file");
					
						
				}
				
				$json_data =  json_encode($posts);
                file_put_contents('datagambar.json', $json_data);
                
			return redirect()->to('menu');
		}else{
			echo 'Gagal';
		}
	}
}
