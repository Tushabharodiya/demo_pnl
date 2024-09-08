<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DataModel extends CI_Model {
    function __construct(){
		parent::__construct();
		$this->load->model('DataModel');
	}
	
	// Extra Functions
	function checkEncrypt($encryptID, $table){
		$this->db->select('*');
        $this->db->where('enc_encrypt', $encryptID);
		$this->db->from($table);
		$query = $this->db->get();
		$result = $query->row();
		return $result;
	}
	function countData($where, $table){
		$this->db->select('*');
		$this->db->where($where);
		$this->db->from($table);
		$query = $this->db->get();
		$result = $query->num_rows();
		return $result;
	}
	
	// Common Functions
	function insertData($table,$data){
		$result = $this->db->insert($table,$data);
		if($result)
			return $this->db->insert_id();
		else
			return false;
	}
	function getData($where, $table){
		$this->db->select('*');
		$this->db->where($where);
		$this->db->from($table);
		$query = $this->db->get();
		$result = $query->row();
		return $result;
	}
	function viewData($order, $where, $table){
	    $this->db->select('*');
		$this->db->order_by($order);
		$this->db->from($table);
		if($where){
		   $this->db->where($where); 
		}
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}
	function infoData($where, $table){
        $this->db->select('*');
        $this->db->from($table);
        if($where){
           $this->db->where($where); 
        }
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }
	function editData($where, $table, $editData){
		$this->db->where($where);
        $result = $this->db->update($table, $editData);
		if($result)
			return  true;
		else
			return false;
	}
	function deleteData($where, $table){
		$this->db->where($where);
		$result = $this->db->delete($table);
		if($result)
			return true;
		else
			return false;
	}
	
	// Android Apps Functions
	function viewAndroidApp($params, $table){
        $this->db->select('*');
		$this->db->order_by('app_id','DESC');
        $this->db->from($table);
        if(!empty($params['search'])){
            $search = $params['search'];
            $likeArr = array('app_name' => $search,'app_developer' => $search,'app_code' => $search);
            $this->db->or_like($likeArr);
    	}
    	$this->db->where_not_in('app_status', 'unpublish');
        if(array_key_exists("app_id",$params)){
            $this->db->where('app_id',$params['app_id']);
            $query = $this->db->get();
            $result = $query->row_array();
        }else{
            if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
                $this->db->limit($params['limit'],$params['start']);
            }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
                $this->db->limit($params['limit']);
            }
            if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){
                $result = $this->db->count_all_results();
            }else{
                $query = $this->db->get();
                $result = ($query->num_rows() > 0)?$query->result_array():FALSE;
            }
        }
        return $result;
    }
	function checkAndroidApp($appCode, $table){
		$this->db->select('*');
		$this->db->where('app_code', $appCode);
		$this->db->from($table);
		$query = $this->db->get();
		$result = $query->row();
		return $result;
	}
	function viewAndroidAppData($appID, $table){
		$this->db->select('*');
		$this->db->where('app_id', $appID);
		$this->db->from($table);
		$query = $this->db->get();
		$result = $query->row();
		return $result;
	}
	
	// Android Version Functions
	function viewVersionData($table, $appID, $params = array()){
        $this->db->select('*');
        $this->db->order_by('version_id ','DESC');
        $this->db->from($table);
        $this->db->where('app_id', $appID);
        if(array_key_exists("version_id ",$params)){
            $this->db->where('version_id ',$params['version_id ']);
            $query = $this->db->get();
            $result = $query->row_array();
        }else{
            if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
                $this->db->limit($params['limit'],$params['start']);
            }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
                $this->db->limit($params['limit']);
            }
            if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){
                $result = $this->db->count_all_results();
            }else{
                $query = $this->db->get();
                $result = ($query->num_rows() > 0)?$query->result_array():FALSE;
            }
        }
        return $result;
    }
	function checkAndroidVersionByName($appID, $versionName, $table){
		$this->db->select('*');
		$this->db->where('app_id', $appID);
		$this->db->where('version_name', $versionName);
		$this->db->from($table);
		$query = $this->db->get();
		$result = $query->row();
		return $result;
	}
	function checkAndroidVersionByCode($appID, $versionCode, $table){
		$this->db->select('*');
		$this->db->where('app_id', $appID);
		$this->db->where('version_code', $versionCode);
		$this->db->from($table);
		$query = $this->db->get();
		$result = $query->row();
		return $result;
	}
	
	// Android Json Functions
	function checkJson($table){
		$this->db->select('*');
		$this->db->from($table);
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}
	
	// Android Common Json Functions
	function checkCommonJson($table){
		$this->db->select('*');
		$this->db->from($table);
		$query = $this->db->get();
		$result = $query->row();
		return $result;
	}

	// Android XData Functions
	function viewAndroidXData($table){
		$this->db->select('*');
		$this->db->order_by('data_id', 'DESC');
		$this->db->from($table);
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}
	
	// Android ZData Functions
	function viewAndroidBlockedZData($table){
		$this->db->select('*');
		$this->db->order_by('blocked_id', 'DESC');
		$this->db->from($table);
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}
	
	//Android Subscription Functions
	function viewSubscriptionData($table, $appID, $params = array()){
        $this->db->select('*');
        $this->db->order_by('subscription_id ','DESC');
        $this->db->from($table);
        $this->db->where('app_id', $appID);
        if(array_key_exists("subscription_id ",$params)){
            $this->db->where('subscription_id ',$params['subscription_id ']);
            $query = $this->db->get();
            $result = $query->row_array();
        }else{
            if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
                $this->db->limit($params['limit'],$params['start']);
            }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
                $this->db->limit($params['limit']);
            }
            if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){
                $result = $this->db->count_all_results();
            }else{
                $query = $this->db->get();
                $result = ($query->num_rows() > 0)?$query->result_array():FALSE;
            }
        }
        return $result;
    }

	//Category Mods Functions
    function viewCategoryModsData($params, $table){
        $this->db->select('*');
        $this->db->order_by('category_id','DESC');
        $this->db->from($table);
        if(array_key_exists("category_id",$params)){
            $this->db->where('category_id',$params['category_id']);
            $query = $this->db->get();
            $result = $query->row_array();
        }else{
            if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
                $this->db->limit($params['limit'],$params['start']);
            }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
                $this->db->limit($params['limit']);
            }
            if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){
                $result = $this->db->count_all_results();
            }else{
                $query = $this->db->get();
                $result = ($query->num_rows() > 0)?$query->result_array():FALSE;
            }
        }
        return $result;
    }

    //Category Addons Functions
    function viewCategoryAddonsData($params, $table){
        $this->db->select('*');
        $this->db->order_by('category_id','DESC');
        $this->db->from($table);
        if(array_key_exists("category_id",$params)){
            $this->db->where('category_id',$params['category_id']);
            $query = $this->db->get();
            $result = $query->row_array();
        }else{
            if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
                $this->db->limit($params['limit'],$params['start']);
            }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
                $this->db->limit($params['limit']);
            }
            if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){
                $result = $this->db->count_all_results();
            }else{
                $query = $this->db->get();
                $result = ($query->num_rows() > 0)?$query->result_array():FALSE;
            }
        }
        return $result;
    }

    //Category Maps Functions
    function viewCategoryMapsData($params, $table){
        $this->db->select('*');
        $this->db->order_by('category_id','DESC');
        $this->db->from($table);
        if(array_key_exists("category_id",$params)){
            $this->db->where('category_id',$params['category_id']);
            $query = $this->db->get();
            $result = $query->row_array();
        }else{
            if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
                $this->db->limit($params['limit'],$params['start']);
            }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
                $this->db->limit($params['limit']);
            }
            if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){
                $result = $this->db->count_all_results();
            }else{
                $query = $this->db->get();
                $result = ($query->num_rows() > 0)?$query->result_array():FALSE;
            }
        }
        return $result;
    }

    //Category Seeds Functions
    function viewCategorySeedsData($params, $table){
        $this->db->select('*');
        $this->db->order_by('category_id','DESC');
        $this->db->from($table);
        if(array_key_exists("category_id",$params)){
            $this->db->where('category_id',$params['category_id']);
            $query = $this->db->get();
            $result = $query->row_array();
        }else{
            if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
                $this->db->limit($params['limit'],$params['start']);
            }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
                $this->db->limit($params['limit']);
            }
            if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){
                $result = $this->db->count_all_results();
            }else{
                $query = $this->db->get();
                $result = ($query->num_rows() > 0)?$query->result_array():FALSE;
            }
        }
        return $result;
    }

    //Category Textures Functions
    function viewCategoryTexturesData($params, $table){
        $this->db->select('*');
        $this->db->order_by('category_id','DESC');
        $this->db->from($table);
        if(array_key_exists("category_id",$params)){
            $this->db->where('category_id',$params['category_id']);
            $query = $this->db->get();
            $result = $query->row_array();
        }else{
            if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
                $this->db->limit($params['limit'],$params['start']);
            }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
                $this->db->limit($params['limit']);
            }
            if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){
                $result = $this->db->count_all_results();
            }else{
                $query = $this->db->get();
                $result = ($query->num_rows() > 0)?$query->result_array():FALSE;
            }
        }
        return $result;
    }

    //Category Shaders Functions
    function viewCategoryShadersData($params, $table){
        $this->db->select('*');
        $this->db->order_by('category_id','DESC');
        $this->db->from($table);
        if(array_key_exists("category_id",$params)){
            $this->db->where('category_id',$params['category_id']);
            $query = $this->db->get();
            $result = $query->row_array();
        }else{
            if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
                $this->db->limit($params['limit'],$params['start']);
            }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
                $this->db->limit($params['limit']);
            }
            if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){
                $result = $this->db->count_all_results();
            }else{
                $query = $this->db->get();
                $result = ($query->num_rows() > 0)?$query->result_array():FALSE;
            }
        }
        return $result;
    }
    
    //Category Skin Functions
    function viewCategorySkinData($params, $table){
        $this->db->select('*');
        $this->db->order_by('category_id','DESC');
        $this->db->from($table);
        if(array_key_exists("category_id",$params)){
            $this->db->where('category_id',$params['category_id']);
            $query = $this->db->get();
            $result = $query->row_array();
        }else{
            if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
                $this->db->limit($params['limit'],$params['start']);
            }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
                $this->db->limit($params['limit']);
            }
            if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){
                $result = $this->db->count_all_results();
            }else{
                $query = $this->db->get();
                $result = ($query->num_rows() > 0)?$query->result_array():FALSE;
            }
        }
        return $result;
    }
    
    //Mods Functions
    function viewModsData($params, $table){
        $this->db->select('*');
        $this->db->order_by('unique_id','DESC');
        $this->db->from($table);
        if(!empty($params['search_mods_view'])){
            $searchModsView = $params['search_mods_view'];
            $likeArr = array('data_name' => $searchModsView);
            $this->db->or_like($likeArr);
        }
        if(array_key_exists("unique_id",$params)){
            $this->db->where('unique_id',$params['unique_id']);
            $query = $this->db->get();
            $result = $query->row_array();
        }else{
            if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
                $this->db->limit($params['limit'],$params['start']);
            }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
                $this->db->limit($params['limit']);
            }
            if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){
                $result = $this->db->count_all_results();
            }else{
                $query = $this->db->get();
                $result = ($query->num_rows() > 0)?$query->result_array():FALSE;
            }
        }
        return $result;
    }

    //Addons Functions
    function viewAddonsData($params, $table){
        $this->db->select('*');
        $this->db->order_by('unique_id','DESC');
        $this->db->from($table);
        if(!empty($params['search_addons_view'])){
            $searchAddonsView = $params['search_addons_view'];
            $likeArr = array('data_name' => $searchAddonsView);
            $this->db->or_like($likeArr);
        }
        if(array_key_exists("unique_id",$params)){
            $this->db->where('unique_id',$params['unique_id']);
            $query = $this->db->get();
            $result = $query->row_array();
        }else{
            if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
                $this->db->limit($params['limit'],$params['start']);
            }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
                $this->db->limit($params['limit']);
            }
            if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){
                $result = $this->db->count_all_results();
            }else{
                $query = $this->db->get();
                $result = ($query->num_rows() > 0)?$query->result_array():FALSE;
            }
        }
        return $result;
    }

    //Maps Functions
    function viewMapsData($params, $table){
        $this->db->select('*');
        $this->db->order_by('unique_id','DESC');
        $this->db->from($table);
        if(!empty($params['search_maps_view'])){
            $searchMapsView = $params['search_maps_view'];
            $likeArr = array('data_name' => $searchMapsView);
            $this->db->or_like($likeArr);
        }
        if(array_key_exists("unique_id",$params)){
            $this->db->where('unique_id',$params['unique_id']);
            $query = $this->db->get();
            $result = $query->row_array();
        }else{
            if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
                $this->db->limit($params['limit'],$params['start']);
            }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
                $this->db->limit($params['limit']);
            }
            if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){
                $result = $this->db->count_all_results();
            }else{
                $query = $this->db->get();
                $result = ($query->num_rows() > 0)?$query->result_array():FALSE;
            }
        }
        return $result;
    }

    //Seeds Functions
    function viewSeedsData($params, $table){
        $this->db->select('*');
        $this->db->order_by('unique_id','DESC');
        $this->db->from($table);
        if(!empty($params['search_seeds_view'])){
            $searchSeedsView = $params['search_seeds_view'];
            $likeArr = array('data_name' => $searchSeedsView);
            $this->db->or_like($likeArr);
        }
        if(array_key_exists("unique_id",$params)){
            $this->db->where('unique_id',$params['unique_id']);
            $query = $this->db->get();
            $result = $query->row_array();
        }else{
            if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
                $this->db->limit($params['limit'],$params['start']);
            }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
                $this->db->limit($params['limit']);
            }
            if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){
                $result = $this->db->count_all_results();
            }else{
                $query = $this->db->get();
                $result = ($query->num_rows() > 0)?$query->result_array():FALSE;
            }
        }
        return $result;
    }

    //Textures Functions
    function viewTexturesData($params, $table){
        $this->db->select('*');
        $this->db->order_by('unique_id','DESC');
        $this->db->from($table);
        if(!empty($params['search_textures_view'])){
            $searchTexturesView = $params['search_textures_view'];
            $likeArr = array('data_name' => $searchTexturesView);
            $this->db->or_like($likeArr);
        }
        if(array_key_exists("unique_id",$params)){
            $this->db->where('unique_id',$params['unique_id']);
            $query = $this->db->get();
            $result = $query->row_array();
        }else{
            if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
                $this->db->limit($params['limit'],$params['start']);
            }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
                $this->db->limit($params['limit']);
            }
            if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){
                $result = $this->db->count_all_results();
            }else{
                $query = $this->db->get();
                $result = ($query->num_rows() > 0)?$query->result_array():FALSE;
            }
        }
        return $result;
    }

    //Shaders Functions
    function viewShadersData($params, $table){
        $this->db->select('*');
        $this->db->order_by('unique_id','DESC');
        $this->db->from($table);
        if(!empty($params['search_shaders_view'])){
            $searchShadersView = $params['search_shaders_view'];
            $likeArr = array('data_name' => $searchShadersView);
            $this->db->or_like($likeArr);
        }
        if(array_key_exists("unique_id",$params)){
            $this->db->where('unique_id',$params['unique_id']);
            $query = $this->db->get();
            $result = $query->row_array();
        }else{
            if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
                $this->db->limit($params['limit'],$params['start']);
            }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
                $this->db->limit($params['limit']);
            }
            if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){
                $result = $this->db->count_all_results();
            }else{
                $query = $this->db->get();
                $result = ($query->num_rows() > 0)?$query->result_array():FALSE;
            }
        }
        return $result;
    }
    
    //Skin Functions
    function viewSkinData($params, $table){
        $this->db->select('*');
        $this->db->order_by('unique_id','DESC');
        $this->db->from($table);
        if(!empty($params['search_skin_view'])){
            $searchSkinView = $params['search_skin_view'];
            $likeArr = array('data_name' => $searchSkinView);
            $this->db->or_like($likeArr);
        }
        if(array_key_exists("unique_id",$params)){
            $this->db->where('unique_id',$params['unique_id']);
            $query = $this->db->get();
            $result = $query->row_array();
        }else{
            if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
                $this->db->limit($params['limit'],$params['start']);
            }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
                $this->db->limit($params['limit']);
            }
            if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){
                $result = $this->db->count_all_results();
            }else{
                $query = $this->db->get();
                $result = ($query->num_rows() > 0)?$query->result_array():FALSE;
            }
        }
        return $result;
    }
    
    //Search Functions
    function viewSearchData($params, $table){
        $this->db->select('*');
        $this->db->order_by('search_id','DESC');
        $this->db->from($table);
        $this->db->where('search_status','publish');
        if(array_key_exists("search_id",$params)){
            $this->db->where('search_id',$params['search_id']);
            $query = $this->db->get();
            $result = $query->row_array();
        }else{
            if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
                $this->db->limit($params['limit'],$params['start']);
            }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
                $this->db->limit($params['limit']);
            }
            if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){
                $result = $this->db->count_all_results();
            }else{
                $query = $this->db->get();
                $result = ($query->num_rows() > 0)?$query->result_array():FALSE;
            }
        }
        return $result;
    }
    function viewSearchAddedData($params, $table){
        $this->db->select('*');
        $this->db->order_by('search_id','DESC');
        $this->db->from($table);
        $this->db->where('search_status','added');
        if(array_key_exists("search_id",$params)){
            $this->db->where('search_id',$params['search_id']);
            $query = $this->db->get();
            $result = $query->row_array();
        }else{
            if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
                $this->db->limit($params['limit'],$params['start']);
            }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
                $this->db->limit($params['limit']);
            }
            if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){
                $result = $this->db->count_all_results();
            }else{
                $query = $this->db->get();
                $result = ($query->num_rows() > 0)?$query->result_array():FALSE;
            }
        }
        return $result;
    }
    
    // App Notification Function
    function viewAppNotificationData($params, $table){
        $this->db->select('*');
        $this->db->order_by('app_id','DESC');
        $this->db->from($table);
        if(array_key_exists("app_id",$params)){
            $this->db->where('app_id',$params['app_id']);
            $query = $this->db->get();
            $result = $query->row_array();
        }else{
            if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
                $this->db->limit($params['limit'],$params['start']);
            }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
                $this->db->limit($params['limit']);
            }
            if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){
                $result = $this->db->count_all_results();
            }else{
                $query = $this->db->get();
                $result = ($query->num_rows() > 0)?$query->result_array():FALSE;
            }
        }
        return $result;
    }

    // Notification Function
    function viewNotificationData($params, $table){
        $this->db->select('*');
        $this->db->order_by('notification_id','DESC');
        $this->db->from($table);
        if(array_key_exists("notification_id",$params)){
            $this->db->where('notification_id',$params['notification_id']);
            $query = $this->db->get();
            $result = $query->row_array();
        }else{
            if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
                $this->db->limit($params['limit'],$params['start']);
            }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
                $this->db->limit($params['limit']);
            }
            if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){
                $result = $this->db->count_all_results();
            }else{
                $query = $this->db->get();
                $result = ($query->num_rows() > 0)?$query->result_array():FALSE;
            }
        }
        return $result;
    }
    
    //User Functions
	function viewUserData($params = array(), $table=''){
        $this->db->select('*');
        $this->db->order_by('user_id','DESC');
        $this->db->from($table);
        if(array_key_exists("user_id",$params)){
            $this->db->where('user_id',$params['user_id']);
            $query = $this->db->get();
            $result = $query->row_array();
        }else{
            if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
                $this->db->limit($params['limit'],$params['start']);
            }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
                $this->db->limit($params['limit']);
            }
            if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){
                $result = $this->db->count_all_results();
            }else{
                $query = $this->db->get();
                $result = ($query->num_rows() > 0)?$query->result_array():FALSE;
            }
        }
        return $result;
    }
}	 

	
	

