<?php
class Stock_model extends CI_Model
{
    var $table = 'stock';
    var $column_order = array(null,'qty', 'timeanddate'); //set column field database for datatable orderable
    var $column_search = array('qty', 'timeanddate'); //set column field database for datatable searchable 
    var $order = array('stock_id' => 'desc'); // default order 

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

    function get_datatables($productid)
    {
        // $this->db->select('attributesgroup.*,attributesgroup_group.title as ag_title');        
        $this->_get_datatables_query();
        // $this->db->join('attributesgroup_group', 'attributesgroup_group.attributesgroup_group_id = attributesgroup.refAttributesgroup_group_id', 'left'); 
        $this->db->where('stock.refProduct_id',$productid);
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered($productid)
    {
        // $this->db->select('attributesgroup.*,attributesgroup_group.title as ag_title');        
        $this->_get_datatables_query();
        // $this->db->join('attributesgroup_group', 'attributesgroup_group.attributesgroup_group_id = attributesgroup.refAttributesgroup_group_id', 'left'); 
        $this->db->where('stock.refProduct_id',$productid);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all($productid)
    {
        // $this->db->select('attributesgroup.*,attributesgroup_group.title as ag_title');        
        $this->db->from($this->table);
        $this->db->where('stock.refProduct_id',$productid);
        // $this->db->join('attributesgroup_group', 'attributesgroup_group.attributesgroup_group_id = attributesgroup.refAttributesgroup_group_id', 'left'); 
        return $this->db->count_all_results();
    }
}
