<?php
/**
 * Menu Items
 * All Project Menu
 * @category  Menu List
 */

class Menu{
	
	
			public static $navbartopleft = array(
		array(
			'path' => 'home', 
			'label' => 'HOME', 
			'icon' => '<i class="material-icons ">dashboard</i>'
		),
		
		array(
			'path' => 'layanan', 
			'label' => 'LAYANAN', 
			'icon' => '<i class="material-icons ">view_list</i>'
		),
		
		array(
			'path' => 'pesanan', 
			'label' => 'PESANAN', 
			'icon' => '<i class="material-icons ">shopping_basket</i>'
		),
		
		array(
			'path' => 'layanansc', 
			'label' => 'LAYANANSC', 
			'icon' => '<i class="material-icons ">view_list</i>'
		),
		
		array(
			'path' => 'pesanansc', 
			'label' => 'PESANANSC', 
			'icon' => '<i class="material-icons ">shopping_basket</i>'
		),
		
		array(
			'path' => 'layanan/cuslistlayanan', 
			'label' => 'CUSLIST LAYANAN', 
			'icon' => '<i class="material-icons ">view_list</i>'
		),
		
		array(
			'path' => 'layanansc/cuslistlayanansc', 
			'label' => 'CUSLIST LAYANANSC', 
			'icon' => '<i class="material-icons ">view_list</i>'
		),
		
		array(
			'path' => 'user', 
			'label' => 'User', 
			'icon' => ''
		)
	);
		
	
	
			public static $durasi_pesanan = array(
		array(
			"value" => "1", 
			"label" => "1 Bulan", 
		),
		array(
			"value" => "12", 
			"label" => "12 Bulan", 
		),
		array(
			"value" => "24", 
			"label" => "24 Bulan", 
		),);
		
			public static $status_pembayaran = array(
		array(
			"value" => "LUNAS", 
			"label" => "LUNAS", 
		),
		array(
			"value" => "BELUM LUNAS", 
			"label" => "BELUM LUNAS", 
		),);
		
}