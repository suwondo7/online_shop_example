<?php
	session_start();
	require "../includes/config.php";
	require "../includes/functions.php";
	$db = new Database();
	$func = new Functions();

	require "../includes/fpdf/fpdf.php";
	
	$pdf = new FPDF("L", "mm", "A5");
	$pdf->AddPage();
	
	$pdf->SetFont('Arial', 'B', 16);
	$pdf->Text(10, 10, "Data Pemesanan");
	
	$idPemesanan = @$_GET['id'];
	list($tanggal, $tujuanPengiriman, $alamatPengiriman, $status) = $db->result_row("SELECT tanggal, tujuan_pengiriman, alamat_pengiriman, status FROM _pemesanan WHERE id_pemesanan = '$idPemesanan'");
	
	$pdf->SetFont('Arial', '', 12);
	$pdf->Text(10, 20, "Kode Pemesanan");
	$pdf->Text(50, 20, " : ".$idPemesanan);
	
	$pdf->Text(10, 25, "Hari, Tanggal");
	$pdf->Text(50, 25, " : ".$func->SearchDay($tanggal).", ".$func->ReportDate($tanggal));
	
	$pdf->Text(10, 30, "Nama Customer");
	$pdf->Text(50, 30, " : ".@$_SESSION['s_namaCust']);
	
	$pdf->Text(10, 35, "Tujuan");
	if($tujuanPengiriman == '0') $pdf->Text(50, 35, " : Dalam kota Surabaya");
	else $pdf->Text(50, 35, " : Luar kota Surabaya");
	
	$pdf->Text(10, 40, "Alamat Pengiriman");
	$pdf->Text(50, 40, " : ".$alamatPengiriman);
	
	$pdf->Text(10, 45, "Status Pemesanan");
	if($status == '0'){ $st = "Proses Pembayaran"; $pdf->SetTextColor(255, 0, 0); }
	if($status == '1'){ $st = "Barang Sudah Dikirim"; $pdf->SetTextColor(0, 255, 0); }
	$pdf->Text(50, 45, " : ".$st);
		
	$pdf->SetXY(10, 50);
	
	$pdf->SetFillColor(50, 50, 50);
	$pdf->SetTextColor(255,255,255);
	$pdf->Cell(10, 5, "No.", 1, 0, 'C', true);
	$pdf->Cell(50, 5, "Nama Baju", 1, 0, 'C', true);
	$pdf->Cell(30, 5, "Harga", 1, 0, 'C', true);
	$pdf->Cell(20, 5, "Jumlah", 1, 0, 'C', true);
	$pdf->Cell(30, 5, "Subtotal", 1, 1, 'C', true);
	
	$pdf->SetFillColor(255, 255, 255);
	$pdf->SetTextColor(0,0,0);
	$no=1; $x=0; $grandtotal = 0;
	$qData = "SELECT id_baju, jumlah, subtotal FROM _pemesanan_detail WHERE id_pemesanan = '$idPemesanan'";
	$hqData = $db->sql($qData);
	while(list($idBaju, $jumlahBaju, $subtotal) = $db->fetch_row($hqData)){
		list($namaBaju, $hargaBaju) = $db->result_row("SELECT nama, harga FROM _baju WHERE id_baju = '$idBaju'");
		$pdf->Cell(10, 5, $no.".", 1, 0, 'C');
		$pdf->Cell(50, 5, $namaBaju, 1, 0, 'L');
		$pdf->Cell(30, 5, "Rp. ".number_format($hargaBaju, 0, ',', '.'), 1, 0, 'R');
		$pdf->Cell(20, 5, $jumlahBaju, 1, 0, 'C');
		$pdf->Cell(30, 5, "Rp. ".number_format($subtotal, 0, ',', '.'), 1, 1, 'R');
		
		$grandtotal += $subtotal;
		$no++;
		$x++;
	}
	$db->close($hqData);
	$pdf->Cell(110, 5, "Grand Total", 1, 0, 'C');
	$pdf->Cell(30, 5, "Rp. ".number_format($grandtotal, 0, ',', '.'), 1, 1, 'R');
		
	$pdf->Output();
?>