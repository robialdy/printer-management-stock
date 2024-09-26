<?php
defined('BASEPATH') or exit('No direct script access allowed');


use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class PrinterDamage extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('data_user')) {
			redirect('auth');
		};
		$this->load->model('PrinterDamage_Model');
		$this->data_user = $this->db->get_where('users', ['username' => $this->session->userdata('data_user')])->row_array();
	}

	public function index()
	{

		$data = [
			'title' => 'Printer Damage',
			'data_user'	=> $this->data_user,
			'damage'	=> $this->PrinterDamage_Model->read_data(),
			'sum_damage'=> $this->PrinterDamage_Model->sum_damage(),
			'date_time'	=> $this->PrinterDamage_Model->date_time(),
			'damage_perbaikan' => $this->PrinterDamage_Model->read_data_add_perbaikan(),
			'no_dummy'	=> $this->PrinterDamage_Model->read_data_nodummy(),
		];
		$this->load->view('printerDamage/printer_damage', $data);
	}

	public function add_perbaikan()
	{
		$this->form_validation->set_rules('printersn', 'PRINTER SN', 'required|trim');
		$this->form_validation->set_rules('biaya', 'BIAYA', 'required|trim');
		$this->form_validation->set_rules('status_pembayaran', 'STATUS', 'required|trim');

		if ($this->form_validation->run() == FALSE) {
			redirect('damage');
		} else {
			$this->PrinterDamage_Model->add_perbaikan();
			$this->session->set_flashdata('notifSuccess', 'Printer berhasil di perbaiki');
			redirect('damage');
		}
	}

	public function add_nodummy()
	{
		// $this->form_validation->set_rules('idprinter', 'PRINTER SN', 'required|trim');
		$this->form_validation->set_rules('nodummy', 'NO dummy', 'required|trim');

		if ($this->form_validation->run() == FALSE) {
			redirect('damage');
		} else {
			$nodummy = $this->input->post('nodummy');
			$idprinter = $this->input->post('idprinter'); //array

			$this->PrinterDamage_Model->add_nodummy($idprinter, $nodummy);
			$this->session->set_flashdata('notifSuccess', 'Printer berhasil di perbaiki');
			redirect('damage');
		}
	}

	public function edit()
	{
		$this->form_validation->set_rules('no_dummy', 'NO DUMMY', 'trim');
		$this->form_validation->set_rules('biaya', 'BIAYA', 'required|trim');
		$this->form_validation->set_rules('status_pembayaran', 'STATUS', 'required|trim');

		if ($this->form_validation->run() == FALSE) {
			redirect('damage');
		} else {
			$this->PrinterDamage_Model->edit();
			$this->session->set_flashdata('notifSuccess', 'Printer berhasil di edit');
			redirect('damage');
		}
	}

	public function upload_file()
	{
		if ($this->input->post('name_file_indb')) {
			$path = FCPATH . 'public/file_damage/' . $this->input->post('name_file_indb');
			unlink($path);
		}

		$config['upload_path'] = FCPATH . 'public/file_damage/';
		$config['allowed_types'] = 'pdf|jpg|jpeg|png';
		$config['max_size'] = 30000; // Batas ukuran file (da lam KB)
		$this->load->library('upload', $config);

		// Proses upload
		if ($this->upload->do_upload('file')) {
			$new_file = $this->upload->data('file_name');
		} else {
			redirect('damage');
		}

		$id = $this->input->post('id_damage');
		$this->db->where('id_damage', $id);
		$this->db->update('printer_damage', ['file' => $new_file]);

		$this->session->set_flashdata('notifSuccess', 'Lampiran File Transaksi Berhasil Diupload!');
		redirect('damage');
	}

	public function export_excel()
	{
		$data = $this->PrinterDamage_Model->read_data();

		// Membuat objek spreadsheet baru
		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();

		// Mengisi header kolom
		$headers = ['NO.', 'NO. DUMMY', 'TANGGAL', 'ORIGIN', 'CUST.ID', 'CUST.NAME', 'TYPE PRINTER', 'SN', 'DESCRIPTION', 'KELENGKAPAN'];
		$columnNames = range('A', 'J');

		// Mengatur panjang sesuai keinginan
		$sheet->getColumnDimension('A')->setWidth(5);
		$sheet->getColumnDimension('B')->setWidth(25);
		$sheet->getColumnDimension('C')->setWidth(20);
		$sheet->getColumnDimension('D')->setWidth(20);
		$sheet->getColumnDimension('E')->setWidth(20);
		$sheet->getColumnDimension('F')->setWidth(50);
		$sheet->getColumnDimension('G')->setWidth(15);
		$sheet->getColumnDimension('H')->setWidth(15);
		$sheet->getColumnDimension('I')->setWidth(40);
		$sheet->getColumnDimension('J')->setWidth(90);


		// mengatur desain header
		foreach ($columnNames as $index => $column) {
			// mengisi data header praktis di loop
			$sheet->setCellValue($column . '1', $headers[$index]);
			// Menambahkan border ke header
			$sheet->getStyle($column . '1')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
			// Mengatur gaya bold pada header
			$sheet->getStyle($column . '1')->getFont()->setBold(true);
			// Menambah padding
			$sheet->getRowDimension(1)->setRowHeight(45);
			// warna header
			$sheet->getStyle($column . '1')->getFill()->setFillType(Fill::FILL_SOLID);
			$sheet->getStyle($column . '1')->getFill()->getStartColor()->setARGB('C6E0B4'); // Mengubah warna latar belakang menjadi hijau
			// Mengatur posisi text header ke tengah
			$sheet->getStyle($column . '1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
			$sheet->getStyle($column . '1')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
		}

		// Mengisi data dari database ke dalam Excel
		$i = 1;
		$row = 2;
		foreach ($data as $dm) {
			// mengisi data
			$sheet->setCellValue('A' . $row, $i++);   
			$sheet->setCellValue('B' . $row, $dm->no_dummy);    
			$sheet->setCellValue('C' . $row, '');   
			$sheet->setCellValue('D' . $row, $dm->origin);  
			$sheet->setCellValue('E' . $row, $dm->cust_id);   
			$sheet->setCellValue('F' . $row, $dm->cust_name);
			$sheet->setCellValue('G' . $row, $dm->name_type); 
			$sheet->setCellValue('H' . $row, $dm->printer_sn);
			$sheet->setCellValue('I' . $row, '-');
			$sheet->setCellValue('J' . $row, $dm->kelengkapan);  
			foreach ($columnNames as $column) {
				// Mengeedit desain data nya excel
				$sheet->getStyle($column . $row)->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
				$sheet->getStyle($column . $row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
				$sheet->getStyle($column . $row)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
			}
			$row++;
		}


		// Set nama file
		$filename = 'printer_damage_data.xlsx';

		// Hapus buffer output
		ob_end_clean();

		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="' . $filename . '"');
		header('Cache-Control: max-age=0');

		// meload isi konten untuk di terapkan di dalam excel
		$writer = new Xlsx($spreadsheet);
		$writer->save('php://output');
		exit; // Hentikan eksekusi skrip
	}
}
