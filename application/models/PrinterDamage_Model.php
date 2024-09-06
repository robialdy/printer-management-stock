<?php

class PrinterDamage_Model extends CI_Model
{
 public function readData()
 { 
	// array{0} tidak mengembalikan apapun ADA BUG
    $this->db->select('printer_damage.*, printer_backup.origin, printer_backup.date_in, printer_backup.type_printer, printer_backup.printer_sn, customers.cust_id, customers.cust_name, customers.type_cust');
    $this->db->from('printer_damage');
    $this->db->join('printer_backup', 'printer_damage.id_printer = printer_backup.id_printer');
    $this->db->join('customers', 'printer_damage.id_cust = customers.id_cust');
    $this->db->order_by('printer_backup.date_in', 'DESC');
	$query = $this->db->get();

    return $query->result();
 }

	
	public function jumlahData()
	{
		
		return $this->db->count_all_results('printer_damage');
	}

	public function updateData()
    {
		$data = [
			'biaya_perbaikan' => $this->input->post('biayaper', true),
			'status_pembayaran' => $this->input->post('status_pembayaran', true),
		];
		$id = $this->input->post('id');

        $this->db->where('id_damage', $id);
        $this->db->update('printer_damage', $data);
    }


	public function editData()
	{
		$data =[
              'pic_it'=> $this->input->post('picit',true),
             'note'=> $this->input->post('note',true),
             'biaya_perbaikan'=> $this->input->post('biayaper',true),
             'status_pembayaran'=> $this->input->post('status_pembayaran',true),
		];

		$id = $this->input->post('id_damage');
    
        
		$this->db->where('id_damage', $id);
		$this->db->update('printer_damage', $data);
	}

	
	public function dateTime()
{
    $this->db->order_by('created_at', 'DESC');
    $this->db->limit(1);
    $query = $this->db->get('printer_damage');
    return $query->row();
}

    
	
}
