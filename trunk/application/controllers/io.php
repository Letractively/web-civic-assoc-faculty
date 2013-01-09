<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Io extends MY_Controller
{
    
    /*
     * Constructor
     * 
     * @return      void
     * 
     */
    function __construct() 
    {
        parent::__construct();
        if( !$this->userdata->is_admin() )
                redirect(base_url());
        $data = array(
            'title' 		=> 'Export'   //Title na aktualnej stranke
        );
            
        $this->data = array_merge($this->data, $data);
    }
    
    public function import()
    {
        
    }
	
	private function array_to_csv($source, $filename, $header = null, $remove_from_export = array())
	{
		$export_text = '';
		
		if ($header)
		{
			foreach($header as $cell)
				$export_text .= $cell.';';
			$export_text .= "\n";
		}
		foreach($source as $row)
		{
			if (is_object($row)) $row = get_object_vars($row);
			foreach($row as $index => $cell)
			{
				if (!in_array($index, $remove_from_export))
					$export_text .= $cell.';';
			}
			$export_text .= "\n";
		}
		
		header('Content-Type: application/octet-stream');
		header('Content-Disposition: attachment; filename='.$filename);
		print $export_text;
	}
    
    public function export()
    {
		if( !$this->userdata->is_admin() )
			redirect(base_url());
			
		$this->load->model('selecter');
		
		if ( $this->input->post('submit') )
		{
			switch ($this->input->post('datasource'))
			{
			case 'users':
				$export = $this->selecter->get_users(0);
				$header = array('meno', 'priezvisko', 'email', 'telefón', 'rok ukončenia štúdia', 'študijný program', 'stupeň vzdelania', 'PSČ');
				$removed_cols = array('user_id');
				break;
			case 'payments':
				$export = $this->selecter->get_payments(0);
				$header = array('meno', 'VS', 'suma k úhrade', 'uhradená suma', 'čas úhrady');
				$removed_cols = array('user_id', 'payment_id');
				break;
			case 'events':
				$export = $this->selecter->get_events_newest(0);
				$header = array('popis', 'názov', 'vytvorené', 'od', 'do', 'kategória', 'priorita');
				$removed_cols = array('event_id');
				break;
			case 'projects':
				$export = $this->selecter->get_projects(0);
				$header = array('názov', 'kategória', 'rozpočet', 'od', 'do', 'utratené');
				$removed_cols = array('project_id', 'project_item_id');
				break;
			}
			$this->array_to_csv($export, 'export.csv', $header, $removed_cols);
		}
		else
		{
			$data = array(
				'view'              => "{$this->router->class}_{$this->router->method}_view",
			);
			
			$this->load->view('container', array_merge($this->data, $data));
		}
    }
}

/* End of file io.php */
/* Location: ./application/controllers/io.php */