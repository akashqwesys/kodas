<?php
class Categoriesdt_model extends CI_Model
{
    var $table = 'shop_categories';
    var $column_order = array(null,'shop_categories_translations.name','shop_categories.position'); //set column field database for datatable orderable
    var $column_search = array('shop_categories_translations.name','shop_categories.position'); //set column field database for datatable searchable 
    var $order = array('shop_categories.id' => 'desc'); // default order 

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
        $this->db->select('shop_categories.*,shop_categories_translations.*');        
        $this->_get_datatables_query();
        $this->db->join('shop_categories_translations', 'shop_categories_translations.for_id = shop_categories.id', 'left'); 
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered()
    {
        $this->db->select('shop_categories.*,shop_categories_translations.*');       
        $this->_get_datatables_query();
        $this->db->join('shop_categories_translations', 'shop_categories_translations.for_id = shop_categories.id', 'left');
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all()
    {
        $this->db->select('shop_categories.*,shop_categories_translations.*');       
        $this->db->from($this->table);
        $this->db->join('shop_categories_translations', 'shop_categories_translations.for_id = shop_categories.id', 'left');
        return $this->db->count_all_results();
    }

    public function addCategories($post)
    {

        $data = array(
            'catimg' => $post['image'],
            'websiteimg' => $post['webimage'],
            'position' => $post['position'],
            'visibility' => 1,
            'dateandtime' => time(),
        );
        if (!$this->db->insert('shop_categories', $data)) {
            log_message('error', print_r($this->db->error(), true));
        }
        $id = $this->db->insert_id();


        $arr = array();
        $arr['abbr'] = 'en';
        $arr['name'] = $post['name'];
        $arr['for_id'] = $id;
        if (!$this->db->insert('shop_categories_translations', $arr)) {
            log_message('error', print_r($this->db->error(), true));
        }
        $id = $this->db->insert_id();
        if ($id) {
            return true;
        } else {
            log_message('error', print_r($this->db->error(), true));
        }
    }
    public function editCategories($post)
    {
        $data=array();
        if($post['image']!=''){
            $data['catimg'] = $post['image'];           
        }
        if($post['webimage']!=''){
            $data['websiteimg'] = $post['webimage'];           
        }     
        $data['position']=$post['position'];        
        $data['dateandtime']=time();
        $this->db->where('id', $post['id']);
        $res = $this->db->update('shop_categories',$data);


        $this->db->where('for_id', $post['id']);
        $res = $this->db->update('shop_categories_translations', array(
            'name' => $post['name']
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

    public function get_categories_details($id)
    {
       

        $this->db->select('shop_categories.*,shop_categories_translations.name');               
        $this->db->join('shop_categories_translations', 'shop_categories_translations.for_id = shop_categories.id', 'left');
        $this->db->where('shop_categories.id', $id);
        $query = $this->db->get('shop_categories');
        return $query->row_array();
    }
    public function get_categories()
    {        
        $query = $this->db->get('categories');
        return $query->result_array();
    }

    public function deleteCategories($id)
    {            
        $this->db->where('id', $id);
		if (!$this->db->delete('shop_categories')) {
			log_message('error', print_r($this->db->error(), true));
		}
        $this->db->where('for_id', $id);
		if (!$this->db->delete('shop_categories_translations')) {
			log_message('error', print_r($this->db->error(), true));
		}
    }
}
