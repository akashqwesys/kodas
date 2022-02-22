<?php
class Attributes_model extends CI_Model
{
    var $table = 'attributes';
    var $column_order = array(null,'attributes.title', 'attributes.sort_order','attributes_group.title','attributes.status',); //set column field database for datatable orderable
    var $column_search = array('attributes.title', 'attributes.sort_order','attributes_group.title','attributes.status',); //set column field database for datatable searchable 
    var $order = array('attributes.attributes_id' => 'desc'); // default order 

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
        $this->db->select('attributes.*,attributes_group.title as ag_title');        
        $this->_get_datatables_query();
        $this->db->join('attributes_group', 'attributes_group.attributesgroup_id = attributes.refAttributes_group_id', 'left'); 
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered()
    {
        $this->db->select('attributes.*,attributes_group.title as ag_title');        
        $this->_get_datatables_query();
        $this->db->join('attributes_group', 'attributes_group.attributesgroup_id = attributes.refAttributes_group_id', 'left'); 
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all()
    {
        $this->db->select('attributes.*,attributes_group.title as ag_title');        
        $this->db->from($this->table);
        $this->db->join('attributes_group', 'attributes_group.attributesgroup_id = attributes.refAttributes_group_id', 'left'); 
        return $this->db->count_all_results();
    }

    public function addAttributes($post)
    {
        $this->db->insert('attributes', array(
            'title' => $post['title'],
            'sort_order' => $post['sort_order'],
            'refAttributes_group_id' => $post['refAttributes_group_id'],            
            'status' => $post['status']
        ));
        $id = $this->db->insert_id();
        if ($id) {
            return true;
        } else {
            log_message('error', print_r($this->db->error(), true));
        }
    }
    public function editAttributes($post)
    {
        $this->db->where('attributes_id', $post['attributes_id']);
        $res = $this->db->update('attributes', array(
            'title' => $post['title'],
            'sort_order' => $post['sort_order'],
            'refAttributes_group_id' => $post['refAttributes_group_id'],            
            'status' => $post['status']
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

    public function get_attributes_details($id)
    {
        $this->db->where('attributes_id', $id);
        $query = $this->db->get('attributes');
        return $query->row_array();
    }
    public function get_attributes_group()
    {        
        $query = $this->db->get('attributes_group');
        return $query->result_array();
    }
}
