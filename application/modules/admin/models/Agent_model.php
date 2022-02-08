<?php
class Agent_model extends CI_Model
{

    var $table = 'agent';
    var $column_order = array(null, 'name', 'phone', 'address', 'email','status'); //set column field database for datatable orderable
    var $column_search = array('name', 'phone', 'address', 'email','status'); //set column field database for datatable searchable 
    var $order = array('agent_id' => 'asc'); // default order 

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
        $this->_get_datatables_query();
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    public function addAgent($post)
    {
        $this->db->insert('agent', array(
            'name' => $post['name'],
            'phone' => $post['phone'],
            'address' => $post['address'],
            'email' => $post['email'],
            'status' => $post['status']
        ));
        $id = $this->db->insert_id();
        if ($id) {
            return true;
        } else {
            log_message('error', print_r($this->db->error(), true));
        }
    }
    public function editAgent($post)
    {
        $this->db->where('agent_id', $post['agent_id']);
        $res = $this->db->update('agent', array(
            'name' => $post['name'],
            'phone' => $post['phone'],
            'address' => $post['address'],
            'email' => $post['email'],
            'status' => $post['status']
        ));
        if ($res) {
            return true;
        } else {
            return false;
        }
    }

    public function add_allocation($post)
    {
        $user_ids=$_POST['id'];
        $agent_id=$_POST['agent_id'];
        $this->db->where_in('id', $user_ids);
        $res = $this->db->update('user_app', array(
            'alocation_agent_id' => $agent_id
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

    public function customer_allocation_change($params)
    {
       
        $status = $params['status'];
        if($params['ar']==0){
            $status=0;
        }
        $table = $params['table'];
        $table_update_field = $params['updatefield'];
        $table_where_field = $params['wherefield'];
        
        $table_id = $params['table_id'];
        $query_res = $this->db->query("UPDATE  $table SET $table_update_field = '$status' WHERE $table_where_field=$table_id");
        if ($query_res) {
            return true;
        }
    }

    public function get_agent_details($id)
    {
        $this->db->where('agent_id', $id);
        $query = $this->db->get('agent');
        return $query->row_array();
    }
}
