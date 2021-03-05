<?php
defined('BASEPATH') or exit('No direct script access allowed');

class c_api extends CI_Controller
{

	public function index()
	{
		$this->session->sess_destroy();
		$this->load->view('pages/halaman');
	}

	public function sortByDate($a, $b)
	{
		return strtotime($a['date']) - strtotime($b['date']);
	}

	public function getApi()
	{
		$kurir = $this->input->post('rd_tx');
		$noresi = $this->input->post('tx_resi');
		$url = 'https://api.binderbyte.com/v1/track?api_key=a44920cfbe88410edc4a2c9aada8cff5617607ac73a9f9a2043fd6712aeb5833&courier=' . $kurir . '&awb=' . $noresi;
		// jne - 8825112045716759;
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

		$output = curl_exec($ch);
		$http = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		// tutup curl 
		curl_close($ch);
		// echo $output;
		if ($http == 200) {
			$data_array = json_decode($output, true);
			$history = $data_array['data']['history'];
			$detail = $data_array['data']['detail'];
			$summary = $data_array['data']['summary'];
			usort($history, array($this, 'sortByDate'));
			$this->session->set_userdata('all_data', $data_array);
			$this->session->set_userdata('history', $history);
			$this->session->set_userdata('detail', $detail);
			$this->session->set_userdata('summary', $summary);
		
		} else {
			$data_array = 'kosong';
			$this->session->set_userdata('all_data', $data_array);
			$this->session->set_userdata('history', $data_array);
			$this->session->set_userdata('detail', $data_array);
			$this->session->set_userdata('summary', $data_array);
		}
		$this->load->view('pages/halaman');
		// echo $data_array['data']['summary']['awb'];



	}

	
}
