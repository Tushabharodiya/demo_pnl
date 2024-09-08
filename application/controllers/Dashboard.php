<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('DataModel');
	}

	public function checkAuth(){
        if(!empty($this->session->userdata['user_key'])) { 
            if($this->session->userdata['auth_key'] == AUTH_KEY){
                $userKey = $this->session->userdata['user_key'];
                $data['userData'] = $this->DataModel->getData('user_key = '.$userKey, 'user');
                if($data['userData']){
                    $isLogin = $data['userData']->is_login;
                } else {
                     redirect('error');
                }
            } else {
                redirect('error');
            }
        } else {
            redirect('error');
        }
        return $isLogin;
    }
    
	public function index(){
		$isLogin = $this->checkAuth();
        if($isLogin == "True"){
            if(!empty($this->session->userdata['user_role'])) { 
                if($this->session->userdata['user_role'] == "Administrator" or $this->session->userdata['user_role'] == "Editor") {
				    $data['publishAppCount'] = $this->DataModel->countData('(app_status="publish")', ANDROID_APPS_TABLE);
				    $data['developmentAppCount'] = $this->DataModel->countData('(app_status="development")', ANDROID_APPS_TABLE);
				    $data['versionCount'] = $this->DataModel->countData('(version_status="true")', ANDROID_VERSION_TABLE);
                    $data['bannerCount'] = $this->DataModel->countData('(banner_status="true")', ANDROID_BANNER_TABLE);
				
                    $data['categoryModsPublishCount'] = $this->DataModel->countData('(category_status="publish")', MCPE_CATEGORY_MODS);
                    $data['categoryModsUnpublishCount'] = $this->DataModel->countData('(category_status="unpublish")', MCPE_CATEGORY_MODS);
                    $data['categoryAddonsPublishCount'] = $this->DataModel->countData('(category_status="publish")', MCPE_CATEGORY_ADDONS);
                    $data['categoryAddonsUnpublishCount'] = $this->DataModel->countData('(category_status="unpublish")', MCPE_CATEGORY_ADDONS);
                    $data['categoryMapsPublishCount'] = $this->DataModel->countData('(category_status="publish")', MCPE_CATEGORY_MAPS);
                    $data['categoryMapsUnpublishCount'] = $this->DataModel->countData('(category_status="unpublish")', MCPE_CATEGORY_MAPS);
                    $data['categorySeedsPublishCount'] = $this->DataModel->countData('(category_status="publish")', MCPE_CATEGORY_SEEDS);
                    $data['categorySeedsUnpublishCount'] = $this->DataModel->countData('(category_status="unpublish")', MCPE_CATEGORY_SEEDS);
                    $data['categoryTexturesPublishCount'] = $this->DataModel->countData('(category_status="publish")', MCPE_CATEGORY_TEXTURES);
                    $data['categoryTexturesUnpublishCount'] = $this->DataModel->countData('(category_status="unpublish")', MCPE_CATEGORY_TEXTURES);
                    $data['categoryShadersPublishCount'] = $this->DataModel->countData('(category_status="publish")', MCPE_CATEGORY_SHADERS);
                    $data['categoryShadersUnpublishCount'] = $this->DataModel->countData('(category_status="unpublish")', MCPE_CATEGORY_SHADERS);
                    $data['categorySkinPublishCount'] = $this->DataModel->countData('(category_status="publish")', MCPE_CATEGORY_SKIN);
                    $data['categorySkinUnpublishCount'] = $this->DataModel->countData('(category_status="unpublish")', MCPE_CATEGORY_SKIN);
                    $data['modsPublishCount'] = $this->DataModel->countData('(data_status="publish")', MCPE_MODS);
                    $data['modsUnpublishCount'] = $this->DataModel->countData('(data_status="unpublish")', MCPE_MODS);
                    $data['addonsPublishCount'] = $this->DataModel->countData('(data_status="publish")', MCPE_ADDONS);
                    $data['addonsUnpublishCount'] = $this->DataModel->countData('(data_status="unpublish")', MCPE_ADDONS);
                    $data['mapsPublishCount'] = $this->DataModel->countData('(data_status="publish")', MCPE_MAPS);
                    $data['mapsUnpublishCount'] = $this->DataModel->countData('(data_status="unpublish")', MCPE_MAPS);
                    $data['seedsPublishCount'] = $this->DataModel->countData('(data_status="publish")', MCPE_SEEDS);
                    $data['seedsUnpublishCount'] = $this->DataModel->countData('(data_status="unpublish")', MCPE_SEEDS);
                    $data['texturesPublishCount'] = $this->DataModel->countData('(data_status="publish")', MCPE_TEXTURES);
                    $data['texturesUnpublishCount'] = $this->DataModel->countData('(data_status="unpublish")', MCPE_TEXTURES);
                    $data['shadersPublishCount'] = $this->DataModel->countData('(data_status="publish")', MCPE_SHADERS);
                    $data['shadersUnpublishCount'] = $this->DataModel->countData('(data_status="unpublish")', MCPE_SHADERS);
                    $data['skinPublishCount'] = $this->DataModel->countData('(data_status="publish")', MCPE_SKIN);
                    $data['skinUnpublishCount'] = $this->DataModel->countData('(data_status="unpublish")', MCPE_SKIN);
                    
                    $this->load->view('header');
					$this->load->view('index', $data);
					$this->load->view('footer');
				} else {
                    redirect('error');
                }
            } else {
                redirect('error');
            }
        } else {
            redirect('logout');
        }
	}
}
