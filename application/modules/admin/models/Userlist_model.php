<?php
class Userlist_model extends CI_Model
{

    var $table = 'user_app';
    var $column_order = array(null, 'user_app.name', 'user_app.whatsapp', 'user_app.emailid', 'user_app.compnay','user_app.isverified','agent.name'); //set column field database for datatable orderable
    var $column_search = array('user_app.name', 'user_app.whatsapp', 'user_app.emailid', 'user_app.compnay','user_app.isverified','agent.name'); //set column field database for datatable searchable 
    var $order = array('user_app.id' => 'asc'); // default order 

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
        $this->db->select('user_app.*,agent.name as a_name');        
        $this->_get_datatables_query();
        $this->db->join('agent', 'agent.agent_id = user_app.alocation_agent_id', 'left');
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered()
    {
        $this->db->select('user_app.*,agent.name as a_name');        
        $this->_get_datatables_query();
        $this->db->join('agent', 'agent.agent_id = user_app.alocation_agent_id', 'left');
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all()
    {
        $this->db->select('user_app.*,agent.name as a_name');    
        $this->db->from($this->table);
        $this->db->join('agent', 'agent.agent_id = user_app.alocation_agent_id', 'left');
        return $this->db->count_all_results();
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
}
