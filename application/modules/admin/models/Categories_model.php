<?php

class Categories_model extends CI_Model {

	public function __construct() {
		parent::__construct();
	}

	public function categoriesCount() {
		return $this->db->count_all_results('shop_categories');
	}

	public function getShopCategories($limit = null, $start = null) {
		$limit_sql = '';
		if ($limit !== null && $start !== null) {
			$limit_sql = ' LIMIT ' . $start . ',' . $limit;
		}

		$query = $this->db->query('SELECT translations_first.*, (SELECT name FROM shop_categories_translations WHERE for_id = sub_for AND abbr = translations_first.abbr) as sub_is, shop_categories.position, shop_categories.catimg, shop_categories.websiteimg FROM shop_categories_translations as translations_first INNER JOIN shop_categories ON shop_categories.id = translations_first.for_id AND shop_categories.visibility = 1 ORDER BY position ASC ' . $limit_sql);
		$arr = array();
		foreach ($query->result() as $shop_categorie) {
			$arr[$shop_categorie->for_id]['info'][] = array(
				'abbr' => $shop_categorie->abbr,
				'name' => $shop_categorie->name,
			);
			$arr[$shop_categorie->for_id]['sub'][] = $shop_categorie->sub_is;
			$arr[$shop_categorie->for_id]['catname'] = $shop_categorie->name;
			$arr[$shop_categorie->for_id]['position'] = $shop_categorie->position;
			$arr[$shop_categorie->for_id]['catimg'] = $shop_categorie->catimg;
			$arr[$shop_categorie->for_id]['websiteimg'] = $shop_categorie->websiteimg;
		}
		return $arr;
	}

	public function deleteShopCategorie($id) {
		$this->db->trans_begin();
		// $this->db->where('for_id', $id);
		// if (!$this->db->delete('shop_categories_translations')) {
		// 	log_message('error', print_r($this->db->error(), true));
		// }

		// $this->db->where('id', $id);
		// $this->db->or_where('sub_for', $id);
		// if (!$this->db->delete('shop_categories')) {
		// 	log_message('error', print_r($this->db->error(), true));
		// }

		$data['visibility'] = 0;
		$this->db->where('id', $id);
		$this->db->update('shop_categories', $data);

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			show_error(lang('database_error'));
		} else {
			$this->db->trans_commit();
		}
	}

	public function setShopCategorie($post, $id = 0) {

		$this->db->trans_begin();
		$is_update = false;
		if ($id > 0) {

			if (!$this->db->where('id', $id)->update('shop_categories', array(
				'catimg' => $post['image'],
				'websiteimg' => $post['webimage'],
				'position' => $post['position'],
				'dateandtime' => time(),
			))) {
				log_message('error', print_r($this->db->error(), true));
			}

			if (!$this->db->where('for_id', $id)->update('shop_categories_translations', array(
				'name' => $post['categorie_name'][0],
			))) {
				log_message('error', print_r($this->db->error(), true));
			}

		} else {
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
			$i = 0;
			foreach ($post['translations'] as $abbr) {
				$arr = array();
				$arr['abbr'] = $abbr;
				$arr['name'] = $post['categorie_name'][$i];
				$arr['for_id'] = $id;
				if (!$this->db->insert('shop_categories_translations', $arr)) {
					log_message('error', print_r($this->db->error(), true));
				}
				$i++;
			}

		}
		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			show_error(lang('database_error'));
		} else {
			$this->db->trans_commit();
		}

		/* exit;

			        $this->db->trans_begin();
					$data = array(
						'catimg' => $post['image'],
			            'websiteimg' => $post['webimage'],
						'position' => $post['position'],
						'dateandtime' => time()
					);
			        if (!$this->db->insert('shop_categories', $data )) {
			            log_message('error', print_r($this->db->error(), true));
			        }
			        $id = $this->db->insert_id();

			        $i = 0;
			        foreach ($post['translations'] as $abbr) {
			            $arr = array();
			            $arr['abbr'] = $abbr;
			            $arr['name'] = $post['categorie_name'][$i];
			            $arr['for_id'] = $id;
			            if (!$this->db->insert('shop_categories_translations', $arr)) {
			                log_message('error', print_r($this->db->error(), true));
			            }
			            $i++;
			        }
			        if ($this->db->trans_status() === FALSE) {
			            $this->db->trans_rollback();
			            show_error(lang('database_error'));
			        } else {
			            $this->db->trans_commit();
		*/
	}

	public function editShopCategorieSub($post) {
		$result = true;
		if ($post['editSubId'] != $post['newSubIs']) {
			$this->db->where('id', $post['editSubId']);
			if (!$this->db->update('shop_categories', array(
				'sub_for' => $post['newSubIs'],
			))) {
				log_message('error', print_r($this->db->error(), true));
				show_error(lang('database_error'));
			}
		} else {
			$result = false;
		}
		return $result;
	}

	public function editShopCategorie($post) {
		$this->db->where('abbr', $post['abbr']);
		$this->db->where('for_id', $post['for_id']);
		if (!$this->db->update('shop_categories_translations', array(
			'name' => $post['name'],
		))) {
			log_message('error', print_r($this->db->error(), true));
			show_error(lang('database_error'));
		}
	}

	public function editShopCategoriePosition($post) {
		$this->db->where('id', $post['editid']);
		if (!$this->db->update('shop_categories', array(
			'position' => $post['new_pos'],
		))) {
			log_message('error', print_r($this->db->error(), true));
			show_error(lang('database_error'));
		}
	}

}
