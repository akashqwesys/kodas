<?php
class Coupan_model extends CI_Model
{
    var $table = 'coupan';
    var $column_order = array(null,'name', 'code','codelimit','enddate','discount','discounttype','isactive'); //set column field database for datatable orderable
    var $column_search = array('name', 'code','codelimit','enddate','discount','discounttype','isactive'); //set column field database for datatable searchable 
    var $order = array('id' => 'desc'); // default order 

    public function __construct()
    {
        parent::__construct();
    }
    private function _get_datatables_query()
    {

        $this->db->from($this->table);

        $i = 0;

        foreach ($this->column_search as $item) // loop column 
        {
            if ($_POST['search']['value']) // if datatable send POST for search
            {

                if ($i === 0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if (count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }

        if (isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_datatables()
    {
        // $this->db->select('attributesgroup.*,attributesgroup_group.title as ag_title');        
        $this->_get_datatables_query();
        // $this->db->join('attributesgroup_group', 'attributesgroup_group.attributesgroup_group_id = attributesgroup.refAttributesgroup_group_id', 'left'); 
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered()
    {
        // $this->db->select('attributesgroup.*,attributesgroup_group.title as ag_title');        
        $this->_get_datatables_query();
        // $this->db->join('attributesgroup_group', 'attributesgroup_group.attributesgroup_group_id = attributesgroup.refAttributesgroup_group_id', 'left'); 
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all()
    {
        // $this->db->select('attributesgroup.*,attributesgroup_group.title as ag_title');        
        $this->db->from($this->table);
        // $this->db->join('attributesgroup_group', 'attributesgroup_group.attributesgroup_group_id = attributesgroup.refAttributesgroup_group_id', 'left'); 
        return $this->db->count_all_results();
    }

    public function addCoupan($post)
    {
        $dateTime = new DateTime($post['enddate']); 
        $date=$dateTime->format('U');        
        $this->db->insert('coupan', array(
            'name' => $post['name'],
            'code' => $post['code'],                               
            'enddate' =>  $date,   			
            'isactive' => $post['isactive'],
			'discount' => $post['discount'],
			'discounttype' => $post['discounttype']            
        ));
        $id = $this->db->insert_id();
        if ($id) {
            return true;
        } else {
            log_message('error', print_r($this->db->error(), true));
        }
    }
    public function editCoupan($post)
    {
        $dateTime = new DateTime($post['enddate']); 
        $date=$dateTime->format('U');    
        $this->db->where('id', $post['id']);
        $res = $this->db->update('coupan', array(
			'name' => $post['name'],
            'code' => $post['code'],                               
			'enddate' =>  $date, 
            'isactive' => $post['isactive'],
			'discount' => $post['discount'],
			'discounttype' => $post['discounttype'] 
        ));
        if ($res) {
            return true;
        } else {
            return false;
        }
    }

    public function approve_status($params)
    {
        $table = $params['table'];
        $table_update_field = $params['updatefield'];
        $table_where_field = $params['wherefield'];
        $status = $params['status'];
        $table_id = $params['table_id'];
        $query_res = $this->db->query("UPDATE  $table SET $table_update_field = '$status' WHERE $table_where_field=$table_id");
        if ($query_res) {
            return true;
        }
    }

    public function get_coupan_details($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('coupan');
        return $query->row_array();
    }
    public function get_coupan()
    {        
        $query = $this->db->get('coupan');
        return $query->result_array();
    }
	public function deleteCoupan($id) {
		$this->db->trans_begin();
		$this->db->where('id', $id);
		if (!$this->db->delete('coupan')) {
			log_message('error', print_r($this->db->error(), true));
		}
		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			show_error(lang('database_error'));
		} else {
			$this->db->trans_commit();
		}
	}
}

