<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require 'vendor/autoload.php';
use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;

class Android extends CI_Controller {
    function __construct(){
		parent::__construct();
		$this->load->model('DataModel');
		$this->load->library('pagination');
		$this->perPage = 20;

		if ($this->session->userdata('auth_key') != AUTH_KEY){ 
            redirect('login');
        }
	}
	
	//S3Bucket Config
    public function getconfig() {
        $s3Client = new S3Client([
            'version' => 'latest',
            'region'  => S3_REGION,
            'credentials' => [
                'key'    => S3_KEY,
                'secret' => S3_SECRET
            ]            
        ]);
        return $s3Client;
    }
    
    public function uniqueKey(){
        date_default_timezone_set("Asia/Kolkata");
        $characters = '0123456789';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < 4; $i++) 
        {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        $uniqueKey =  $randomString.''.strtolower(date('dmYhis'));
        return $uniqueKey;
    }
    
    public function newBucketObject($objectName, $objectCode, $objectTemp, $objectPath){
        $isLogin = $this->checkAuth();
        if(!empty($this->session->userdata['user_role'])) { 
            date_default_timezone_set("Asia/Kolkata");
            $s3Client = $this->getconfig();
            $extObject = explode(".", $objectName);
            $newObject = end($extObject);
            $objectName = $objectCode.'.'.$newObject;
            $result = $s3Client->putObject([
                'Bucket' => BUCKET_NAME,
                'Key'    => $objectPath.$objectName,
                'SourceFile' => $objectTemp,
                'ACL'    => 'public-read', 
            ]);
            return $result->get('ObjectURL');
        } else {
            redirect('logout');
        }
    }
    
	public function index(){
	    $this->load->view('header');
		$this->load->view('error');
		$this->load->view('footer');
	}

	public function checkAuth(){
        if(!empty($this->session->userdata['user_key'])) { 
            if($this->session->userdata['auth_key'] == AUTH_KEY){
                $userKey = $this->session->userdata['user_key'];
                $data['userData'] = $this->DataModel->getData('user_key = '.$userKey, USER_TABLE);
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
	
	// Android Application Functions
	public function appNew(){
		$isLogin = $this->checkAuth();
        if($isLogin == "True"){
            if(!empty($this->session->userdata['user_role'])) { 
                if($this->session->userdata['user_role'] == "Administrator") { 
				    $this->form_validation->set_rules('app_code', 'Text', 'required');
					$this->form_validation->set_rules('app_name', 'Text', 'required');
					$this->form_validation->set_rules('app_package', 'Text', 'required');
					$this->form_validation->set_rules('app_developer', 'Text', 'required');
					$this->form_validation->set_rules('app_website', 'Text', 'required');
					$this->form_validation->set_rules('app_release', 'Date', 'required');
					$this->form_validation->set_rules('app_store', 'Text', 'required');
					$this->form_validation->set_rules('version_name', 'Text', 'required');
					$this->form_validation->set_rules('version_code', 'Text', 'required');
					$this->form_validation->set_rules('ads_count_one', 'Text', 'required');
					$this->form_validation->set_rules('ads_count_two', 'Text', 'required');
					$this->form_validation->set_rules('ads_count_three', 'Text', 'required');
					$this->form_validation->set_rules('ads_count_four', 'Text', 'required');
					$this->form_validation->set_rules('review_count', 'Text', 'required');
					if (empty($_FILES['app_logo']['name'])){
			            $this->form_validation->set_rules('app_logo', 'Document', 'required');
			        }
					
					$this->form_validation->set_error_delimiters('','');
					
					if ($this->form_validation->run() == FALSE){
						$data['error'] = "";
						$this->load->view('header');
						$this->load->view('android/app_new',$data);  
						$this->load->view('footer');
					} else {
					    $jsonData = $this->DataModel->checkCommonJson(ANDROID_COMMON_JSON_TABLE);
			    	    if($jsonData != null){
			    	        $appCode = $this->input->post('app_code');
			    	        $appCodeData = $this->DataModel->checkAndroidApp($appCode, ANDROID_APPS_TABLE);
			    	        if($appCodeData == null){
			    	        	date_default_timezone_set("Asia/Kolkata");
			    	            if(!empty($_FILES['app_logo']['name'])){
			                        $config['upload_path'] = 'uploads/logos/';
			                        $config['allowed_types'] = 'jpg|jpeg|png|gif|webp';
									$config['file_name'] = date('Ymdhis');
			                        $this->load->library('upload',$config);
			                        $this->upload->initialize($config);
			                        if($this->upload->do_upload('app_logo')){
			                            $uploadData = $this->upload->data();
			                            $appLogo = $uploadData['file_name'];
			                        } else {
			                            $appLogo = '';
			                        }
			                    } else {
			                        $appLogo = '';
			                    }
			            		$appData = array(
			                		'app_code'=>$this->input->post('app_code'),
			                	    'app_name'=>$this->input->post('app_name'),
			                		'app_package'=>$this->input->post('app_package'),
			                		'app_logo'=>$appLogo,
			                		'app_developer'=>$this->input->post('app_developer'),
			                		'app_website'=>$this->input->post('app_website'),
			                		'app_email'=>$this->input->post('app_email'),
			                		'app_store'=>$this->input->post('app_store'),
			                		'app_privacy'=>$this->input->post('app_privacy'),
			                		'app_terms'=>$this->input->post('app_terms'),
			                		'app_support'=>$this->input->post('app_support'),
			                		'app_download'=> 0,
			                		'app_release'=>$this->input->post('app_release'),
			                		'app_status'=>$this->input->post('app_status')
			            		);
			            		$appDataEntry = $this->DataModel->insertData(ANDROID_APPS_TABLE, $appData);
			            		$data['androidAppData'] = $this->DataModel->viewAndroidAppData($appDataEntry, ANDROID_APPS_TABLE);
			            		$appID = $data['androidAppData']->app_id;
			            		$updateUrl = $data['androidAppData']->app_package;
			            	    if($appDataEntry){
			            	    	$bannerOne = implode("#",$this->input->post('banner_ads_one'));
                                    $bannerAdsOne = str_replace("#@#","@",$bannerOne);
                                    $bannerTwo = implode("#",$this->input->post('banner_ads_two'));
                                    $bannerAdsTwo = str_replace("#@#","@",$bannerTwo);
                                    $bannerThree = implode("#",$this->input->post('banner_ads_three'));
                                    $bannerAdsThree = str_replace("#@#","@",$bannerThree);
                                    $bannerFour = implode("#",$this->input->post('banner_ads_four'));
                                    $bannerAdsFour = str_replace("#@#","@",$bannerFour);
                                    $bannerFive = implode("#",$this->input->post('banner_ads_five'));
                                    $bannerAdsFive = str_replace("#@#","@",$bannerFive);
                                    $nativeOne = implode("#",$this->input->post('native_ads_one'));
                                    $nativeAdsOne = str_replace("#@#","@",$nativeOne);
                                    $nativeTwo = implode("#",$this->input->post('native_ads_two'));
                                    $nativeAdsTwo = str_replace("#@#","@",$nativeTwo);
                                    $nativeThree = implode("#",$this->input->post('native_ads_three'));
                                    $nativeAdsThree = str_replace("#@#","@",$nativeThree);
                                    $nativeFour = implode("#",$this->input->post('native_ads_four'));
                                    $nativeAdsFour = str_replace("#@#","@",$nativeFour);
                                    $nativeFive = implode("#",$this->input->post('native_ads_five'));
                                    $nativeAdsFive = str_replace("#@#","@",$nativeFive);
                                    $nativeSix = implode("#",$this->input->post('native_ads_six'));
                                    $nativeAdsSix = str_replace("#@#","@",$nativeSix);
                                    $nativeSeven = implode("#",$this->input->post('native_ads_seven'));
                                    $nativeAdsSeven = str_replace("#@#","@",$nativeSeven);
                                    $nativeEight = implode("#",$this->input->post('native_ads_eight'));
                                    $nativeAdsEight = str_replace("#@#","@",$nativeEight);
                                    $nativeNine = implode("#",$this->input->post('native_ads_nine'));
                                    $nativeAdsNine = str_replace("#@#","@",$nativeNine);
                                    $nativeTen = implode("#",$this->input->post('native_ads_ten'));
                                    $nativeAdsTen = str_replace("#@#","@",$nativeTen);
                                    $interstitialOne = implode("#",$this->input->post('interstitial_ads_one'));
                                    $interstitialAdsOne = str_replace("#@#","@",$interstitialOne);
                                    $interstitialTwo = implode("#",$this->input->post('interstitial_ads_two'));
                                    $interstitialAdsTwo = str_replace("#@#","@",$interstitialTwo);
                                    $interstitialThree = implode("#",$this->input->post('interstitial_ads_three'));
                                    $interstitialAdsThree = str_replace("#@#","@",$interstitialThree);
                                    $interstitialFour = implode("#",$this->input->post('interstitial_ads_four'));
                                    $interstitialAdsFour = str_replace("#@#","@",$interstitialFour);
                                    $interstitialFive = implode("#",$this->input->post('interstitial_ads_five'));
                                    $interstitialAdsFive = str_replace("#@#","@",$interstitialFive);
                                    $interstitialSix = implode("#",$this->input->post('interstitial_ads_six'));
                                    $interstitialAdsSix = str_replace("#@#","@",$interstitialSix);
                                    $interstitialSeven = implode("#",$this->input->post('interstitial_ads_seven'));
                                    $interstitialAdsSeven = str_replace("#@#","@",$interstitialSeven);
                                    $interstitialEight = implode("#",$this->input->post('interstitial_ads_eight'));
                                    $interstitialAdsEight = str_replace("#@#","@",$interstitialEight);
                                    $interstitialNine = implode("#",$this->input->post('interstitial_ads_nine'));
                                    $interstitialAdsNine = str_replace("#@#","@",$interstitialNine);
                                    $interstitialTen = implode("#",$this->input->post('interstitial_ads_ten'));
                                    $interstitialAdsTen = str_replace("#@#","@",$interstitialTen);
                                    $openOne = implode("#",$this->input->post('open_ads_one'));
                                    $openAdsOne = str_replace("#@#","@",$openOne);
                                    $rewardsOne = implode("#",$this->input->post('rewards_ads_one'));
                                    $rewardsAdsOne = str_replace("#@#","@",$rewardsOne);

			            	        $adsData = array(
			                    		'app_id'=>$appID,
			                    		'banner_ads_one'=>$bannerAdsOne,
			                    		'banner_ads_two'=>$bannerAdsTwo,
			                    		'banner_ads_three'=>$bannerAdsThree,
			                    		'banner_ads_four'=>$bannerAdsFour,
			                    		'banner_ads_five'=>$bannerAdsFive,
			                    		'native_ads_one'=>$nativeAdsOne,
			                    		'native_ads_two'=>$nativeAdsTwo,
			                    		'native_ads_three'=>$nativeAdsThree,
			                    		'native_ads_four'=>$nativeAdsFour,
			                    		'native_ads_five'=>$nativeAdsFive,
			                    		'native_ads_six'=>$nativeAdsSix,
			                    		'native_ads_seven'=>$nativeAdsSeven,
			                    		'native_ads_eight'=>$nativeAdsEight,
			                    		'native_ads_nine'=>$nativeAdsNine,
			                    		'native_ads_ten'=>$nativeAdsTen,
			                    		'interstitial_ads_one'=>$interstitialAdsOne,
			                    		'interstitial_ads_two'=>$interstitialAdsTwo,
			                    		'interstitial_ads_three'=>$interstitialAdsThree,
			                    		'interstitial_ads_four'=>$interstitialAdsFour,
			                    		'interstitial_ads_five'=>$interstitialAdsFive,
			                    		'interstitial_ads_six'=>$interstitialAdsSix,
			                    		'interstitial_ads_seven'=>$interstitialAdsSeven,
			                    		'interstitial_ads_eight'=>$interstitialAdsEight,
			                    		'interstitial_ads_nine'=>$interstitialAdsNine,
			                    		'interstitial_ads_ten'=>$interstitialAdsTen,
			                    		'open_ads_one'=>$openAdsOne,
			                    		'rewards_ads_one'=>$rewardsAdsOne,
			                		);
			            	        $versionData = array(
			                    		'app_id'=>$appID,
			                    	    'version_name'=>$this->input->post('version_name'),
			                    		'version_code'=>$this->input->post('version_code'),
			                    		'main_api'=>$this->input->post('main_api'),
			                    		'data_api'=>$this->input->post('data_api'),
			                    		'app_ads'=>$this->input->post('app_ads'),
			                    		'splash_ads'=>$this->input->post('splash_ads'),
			                    		'screen_ads'=>$this->input->post('screen_ads'),
			                    		'ads_count_one'=>$this->input->post('ads_count_one'),
			                    		'ads_count_two'=>$this->input->post('ads_count_two'),
			                    		'ads_count_three'=>$this->input->post('ads_count_three'),
			                    		'ads_count_four'=>$this->input->post('ads_count_four'),
			                    		'review_count'=>$this->input->post('review_count'),
			                    		'app_banner'=>$this->input->post('app_banner'),
			                    		'app_review'=>$this->input->post('app_review'),
			                    		'app_update'=>$this->input->post('app_update'),
			                    		'update_title'=>"Update our app",
			                    		'update_description'=>"Please update our app for better response!",
			                    		'update_button'=>"Update",
			                    		'update_url'=>$updateUrl,
			                    		'app_open'=>$this->input->post('app_open'),
			                    		'app_subscription'=>$this->input->post('app_subscription'),
			                    		'is_rewarded'=>$this->input->post('is_rewarded'),
			                    		'version_status'=>$this->input->post('version_status')
			                		);
			                		$jsonData = array(
			                    		'app_id'=>$appID,
			                    	    'json_data'=>$jsonData->json_data,
			                    		'json_status'=>"true"
			                		);
			                		
			                		$adsDataEntry = $this->DataModel->insertData(ANDROID_AD_TABLE, $adsData);
			                		$versionDataEntry = $this->DataModel->insertData(ANDROID_VERSION_TABLE, $versionData);
			                		$jsonDataEntry = $this->DataModel->insertData(ANDROID_JSON_TABLE, $jsonData);
			                		if($jsonDataEntry){
			                		  redirect('view-app');  
			                		}
			            	    }  
			    	        } else {
			    	            $data['msg'] = array(
			                		'data_title'=>"You can't insert application",
			                	    'data_description'=>"App Code is already exits in database. Please check app code!",
			                	    'button_link'=>"new-app",
			                	    'button_text'=>"New App"
			            		);
			        	        $this->load->view('header');
			            		$this->load->view('nodata', $data);
			            		$this->load->view('footer');
			    	        }
			    	        
			    	    } else {
			    	        $data['msg'] = array(
			            		'data_title'=>"You can't insert application in database.",
			            	    'data_description'=>"Please add common json data before submit new app.",
			            	    'button_link'=>"new-common-json",
			            	    'button_text'=>"New Common Json"
			        		);
			    	        $this->load->view('header');
			        		$this->load->view('nodata', $data);
			        		$this->load->view('footer');
			    	    }
					}
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
	
	public function appView(){
		$isLogin = $this->checkAuth();
        if($isLogin == "True"){
            if(!empty($this->session->userdata['user_role'])) { 
                if($this->session->userdata['user_role'] == "Administrator") {
                    date_default_timezone_set("Asia/Kolkata");
                    
                	if(isset($_POST['reset_search'])){
               			$this->session->unset_userdata('session_search');
            		}
            		
		            if(isset($_POST['submit'])){
		            	$search = $this->input->post('search');
		                $this->session->set_userdata('session_search',$search);
		            }
		            $sessionSearch =  $this->session->userdata('session_search');

				    $data = array();
			        //get rows count
			        $conditions['search'] = $sessionSearch;
			        $conditions['returnType'] = 'count';
			        $totalRec = $this->DataModel->viewAndroidApp($conditions, ANDROID_APPS_TABLE);
			        
			        //pagination config
			        $config['base_url']    = site_url('app-view');
			        $config['uri_segment'] = 2;
			        $config['total_rows']  = $totalRec;
			        $config['per_page']    = $this->perPage;
			        
			        //styling
			        $config['num_tag_open'] = '<li class="page-item page-link">';
			        $config['num_tag_close'] = '</li>';
			        $config['cur_tag_open'] = '<li class="active page-item"><a href="javascript:void(0);" class="page-link" >';
			        $config['cur_tag_close'] = '</a></li>';
			        $config['next_link'] = '&raquo';
			        $config['prev_link'] = '&laquo';
			        $config['next_tag_open'] = '<li class="pg-next page-item page-link">';
			        $config['next_tag_close'] = '</li>';
			        $config['prev_tag_open'] = '<li class="pg-prev page-item page-link">';
			        $config['prev_tag_close'] = '</li>';
			        $config['first_tag_open'] = '<li class="page-item page-link">';
			        $config['first_tag_close'] = '</li>';
			        $config['last_tag_open'] = '<li class="page-item page-link">';
			        $config['last_tag_close'] = '</li>';
			        
			        //initialize pagination library
			        $this->pagination->initialize($config);
			        
			        //define offset
			        $page = $this->uri->segment(2);
			        $offset = !$page?0:$page;
			        
			        //get rows
			        $conditions['returnType'] = '';
			        $conditions['start'] = $offset;
			        $conditions['limit'] = $this->perPage;
			        $viewAndroidApp = $this->DataModel->viewAndroidApp($conditions, ANDROID_APPS_TABLE);
			        $data['viewAndroidApp'] = array();

			        if($viewAndroidApp != null){
                        foreach ($viewAndroidApp as $appRow) {
                            $appData = array();
            			    $appData['app_id'] = $appRow['app_id'];
            			    $appData['app_code'] = $appRow['app_code'];
            			    $appData['app_name'] = $appRow['app_name'];
            			    $appData['app_package'] = $appRow['app_package'];
            			    $appData['app_logo'] = $appRow['app_logo'];
            			    $appData['app_developer'] = $appRow['app_developer'];
            			    $appData['app_website'] = $appRow['app_website'];
            			    $appData['app_email'] = $appRow['app_email'];
            			    $appData['app_store'] = $appRow['app_store'];
            			    $appData['app_privacy'] = $appRow['app_privacy'];
            			    $appData['app_terms'] = $appRow['app_terms'];
            			    $appData['app_support'] = $appRow['app_support'];
            			    $appData['app_download'] = $appRow['app_download'];
            			    $appData['app_release'] = $appRow['app_release'];
            			    $appData['app_status'] = $appRow['app_status'];
                	        array_push($data['viewAndroidApp'], $appData);
                	    }
                    }
                    
				    if($data['viewAndroidApp'] != null){
				        $this->load->view('header');
			    		$this->load->view('android/app_view',$data);
			    		$this->load->view('footer');
				    } else {
				    	$this->session->unset_userdata('session_search');	
				        $data['msg'] = array(
    			    		'data_title'=>"No application data found",
    			    	    'data_description'=>"Please add application & redirect application from below button.",
    			    	    'button_link'=>"new-app",
    			    	    'button_text'=>"New Application",
    			    	    'button_link1'=>'view-app',
                            'button_text1'=>"View Apps",
			    		);
				        $this->load->view('header');
			    		$this->load->view('nodata', $data);
			    		$this->load->view('footer');
				    }
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
	public function appDescription($appID = 0){
		$isLogin = $this->checkAuth();
        if($isLogin == "True"){
            if(!empty($this->session->userdata['user_role'])){ 
                if($this->session->userdata['user_role'] == "Administrator"){
				    $checkEncryption = $this->DataModel->checkEncrypt($appID,ENCRYPT_TABLE);
				    if($checkEncryption){
				        $appID = $checkEncryption->enc_number;
				    }
				    if(ctype_digit($appID)){
			    	    $data['getAndroidApp'] = $this->DataModel->getData('app_id = '.$appID, ANDROID_APPS_TABLE);
			    	    $data['getAndroidVersion'] = $this->DataModel->viewData(null, 'app_id = '.$appID, ANDROID_VERSION_TABLE);
			    	    $data['getAndroidSubscription'] = $this->DataModel->viewData(null, 'app_id = '.$appID, ANDROID_SUBSCRIPTION_TABLE);
			    	    $data['getAndroidAds'] = $this->DataModel->getData('app_id = '.$appID, ANDROID_AD_TABLE);
				    	$data['getAndroidJson'] = $this->DataModel->getData('app_id = '.$appID, ANDROID_JSON_TABLE);
			    	    if( $data['getAndroidApp'] != null){
			    	    	$getJson = $this->DataModel->getData('app_id = '.$appID, ANDROID_JSON_TABLE);
			    	        $data['getAndroidJsonData'] = array();
			    	        $bannerIDs = $getJson->json_data;
			        		$bannerArray = explode(",",$bannerIDs);
			        		foreach ($bannerArray as $row) {
			        	        $bannerID = $row;
			        	        $getJson = $this->DataModel->getData('banner_id = '.$bannerID, ANDROID_BANNER_TABLE);
			        	        array_push($data['getAndroidJsonData'], $getJson);
			        	    }
			        	    $this->load->view('header');
			        		$this->load->view('android/app_description', $data);
			        		$this->load->view('footer');
			    	    } else {
			    	        redirect('error');
			    	    }
				    } else {
						redirect('error');
					}
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

	public function appEdit($appID = 0){
		$isLogin = $this->checkAuth();
        if($isLogin == "True"){
            if(!empty($this->session->userdata['user_role'])){ 
                if($this->session->userdata['user_role'] == "Administrator"){
				    $checkEncryption = $this->DataModel->checkEncrypt($appID,ENCRYPT_TABLE);
				    if($checkEncryption){
				        $appID = $checkEncryption->enc_number;
				    }
				    if(ctype_digit($appID)){
			    		$data['androidAppData'] = $this->DataModel->getData('app_id = '.$appID, ANDROID_APPS_TABLE);
						if($data['androidAppData'] != null){
						    $this->load->view('header');
			        		$this->load->view('android/app_edit',$data);
			        		$this->load->view('footer');
						} else {
							redirect('error');
						}
			    		if($this->input->post('submit')){
			    			date_default_timezone_set("Asia/Kolkata");
			    		    if(!empty($_FILES['app_logo']['name'])){
			                    $config['upload_path'] = 'uploads/logos/';
			                    $config['allowed_types'] = 'jpg|jpeg|png|gif';
			                    $config['file_name'] = date('Ymdhis');
			                    $this->load->library('upload',$config);
			                    $this->upload->initialize($config);
			                    if($this->upload->do_upload('app_logo')){
			                        $uploadData = $this->upload->data();
			                        $appLogo = $uploadData['file_name'];
			                    } else {
			                        $appLogo = $data['androidAppData']->app_logo;
			                    }
			                } else {
			                    $appLogo = $data['androidAppData']->app_logo;
			                }
			                if(!empty($_FILES['app_logo']['name'])){
			                    if(!empty($data['androidAppData']->app_logo)){
			                        unlink("uploads/logos/".$data['androidAppData']->app_logo);
			                    }
			                }
			                
			    			$editData = array(
			            		'app_code'=>$this->input->post('app_code'),
			            	    'app_name'=>$this->input->post('app_name'),
			            		'app_package'=>$this->input->post('app_package'),
			            		'app_logo'=>$appLogo,
			            		'app_developer'=>$this->input->post('app_developer'),
			            		'app_website'=>$this->input->post('app_website'),
			            		'app_email'=>$this->input->post('app_email'),
			            		'app_store'=>$this->input->post('app_store'),
			            		'app_privacy'=>$this->input->post('app_privacy'),
			            		'app_terms'=>$this->input->post('app_terms'),
			            		'app_support'=>$this->input->post('app_support'),
			            		'app_release'=>$this->input->post('app_release'),
			            		'app_status'=>$this->input->post('app_status')
			    			);
			    			$editDataEntry = $this->DataModel->editData('app_id = '.$appID, ANDROID_APPS_TABLE, $editData);
							if($editDataEntry){
								redirect('description-app/'.md5($appID));
							}
			    		}
				    } else {
						redirect('error');
					}
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
 	
 	public function adsEdit($appID = 0){
		$isLogin = $this->checkAuth();
        if($isLogin == "True"){
            if(!empty($this->session->userdata['user_role'])){ 
                if($this->session->userdata['user_role'] == "Administrator"){
				    $checkEncryption = $this->DataModel->checkEncrypt($appID,ENCRYPT_TABLE);
				    if($checkEncryption){
				        $appID = $checkEncryption->enc_number;
				    }
				    if(ctype_digit($appID)){
			    		$data['androidAdsData'] = $this->DataModel->getData('app_id = '.$appID, ANDROID_AD_TABLE);
						if($data['androidAdsData'] != null){
						    $this->load->view('header');
			        		$this->load->view('android/ads_edit',$data);
			        		$this->load->view('footer');
						} else {
							redirect('error');
						}
			    		if($this->input->post('submit')){
			    		    $bannerOne = implode("#",$this->input->post('banner_ads_one'));
                            $bannerAdsOne = str_replace("#@#","@",$bannerOne);
                            $bannerTwo = implode("#",$this->input->post('banner_ads_two'));
                            $bannerAdsTwo = str_replace("#@#","@",$bannerTwo);
                            $bannerThree = implode("#",$this->input->post('banner_ads_three'));
                            $bannerAdsThree = str_replace("#@#","@",$bannerThree);
                            $bannerFour = implode("#",$this->input->post('banner_ads_four'));
                            $bannerAdsFour = str_replace("#@#","@",$bannerFour);
                            $bannerFive = implode("#",$this->input->post('banner_ads_five'));
                            $bannerAdsFive = str_replace("#@#","@",$bannerFive);
                            $nativeOne = implode("#",$this->input->post('native_ads_one'));
                            $nativeAdsOne = str_replace("#@#","@",$nativeOne);
                            $nativeTwo = implode("#",$this->input->post('native_ads_two'));
                            $nativeAdsTwo = str_replace("#@#","@",$nativeTwo);
                            $nativeThree = implode("#",$this->input->post('native_ads_three'));
                            $nativeAdsThree = str_replace("#@#","@",$nativeThree);
                            $nativeFour = implode("#",$this->input->post('native_ads_four'));
                            $nativeAdsFour = str_replace("#@#","@",$nativeFour);
                            $nativeFive = implode("#",$this->input->post('native_ads_five'));
                            $nativeAdsFive = str_replace("#@#","@",$nativeFive);
                            $nativeSix = implode("#",$this->input->post('native_ads_six'));
                            $nativeAdsSix = str_replace("#@#","@",$nativeSix);
                            $nativeSeven = implode("#",$this->input->post('native_ads_seven'));
                            $nativeAdsSeven = str_replace("#@#","@",$nativeSeven);
                            $nativeEight = implode("#",$this->input->post('native_ads_eight'));
                            $nativeAdsEight = str_replace("#@#","@",$nativeEight);
                            $nativeNine = implode("#",$this->input->post('native_ads_nine'));
                            $nativeAdsNine = str_replace("#@#","@",$nativeNine);
                            $nativeTen = implode("#",$this->input->post('native_ads_ten'));
                            $nativeAdsTen = str_replace("#@#","@",$nativeTen);
                            $interstitialOne = implode("#",$this->input->post('interstitial_ads_one'));
                            $interstitialAdsOne = str_replace("#@#","@",$interstitialOne);
                            $interstitialTwo = implode("#",$this->input->post('interstitial_ads_two'));
                            $interstitialAdsTwo = str_replace("#@#","@",$interstitialTwo);
                            $interstitialThree = implode("#",$this->input->post('interstitial_ads_three'));
                            $interstitialAdsThree = str_replace("#@#","@",$interstitialThree);
                            $interstitialFour = implode("#",$this->input->post('interstitial_ads_four'));
                            $interstitialAdsFour = str_replace("#@#","@",$interstitialFour);
                            $interstitialFive = implode("#",$this->input->post('interstitial_ads_five'));
                            $interstitialAdsFive = str_replace("#@#","@",$interstitialFive);
                            $interstitialSix = implode("#",$this->input->post('interstitial_ads_six'));
                            $interstitialAdsSix = str_replace("#@#","@",$interstitialSix);
                            $interstitialSeven = implode("#",$this->input->post('interstitial_ads_seven'));
                            $interstitialAdsSeven = str_replace("#@#","@",$interstitialSeven);
                            $interstitialEight = implode("#",$this->input->post('interstitial_ads_eight'));
                            $interstitialAdsEight = str_replace("#@#","@",$interstitialEight);
                            $interstitialNine = implode("#",$this->input->post('interstitial_ads_nine'));
                            $interstitialAdsNine = str_replace("#@#","@",$interstitialNine);
                            $interstitialTen = implode("#",$this->input->post('interstitial_ads_ten'));
                            $interstitialAdsTen = str_replace("#@#","@",$interstitialTen);
                            $openOne = implode("#",$this->input->post('open_ads_one'));
                            $openAdsOne = str_replace("#@#","@",$openOne);
                            $rewardsOne = implode("#",$this->input->post('rewards_ads_one'));
                            $rewardsAdsOne = str_replace("#@#","@",$rewardsOne);

			    			$editData = array(
			            		'app_id'=>$appID,
	                    		'banner_ads_one'=>$bannerAdsOne,
	                    		'banner_ads_two'=>$bannerAdsTwo,
	                    		'banner_ads_three'=>$bannerAdsThree,
	                    		'banner_ads_four'=>$bannerAdsFour,
	                    		'banner_ads_five'=>$bannerAdsFive,
	                    		'native_ads_one'=>$nativeAdsOne,
	                    		'native_ads_two'=>$nativeAdsTwo,
	                    		'native_ads_three'=>$nativeAdsThree,
	                    		'native_ads_four'=>$nativeAdsFour,
	                    		'native_ads_five'=>$nativeAdsFive,
	                    		'native_ads_six'=>$nativeAdsSix,
	                    		'native_ads_seven'=>$nativeAdsSeven,
	                    		'native_ads_eight'=>$nativeAdsEight,
	                    		'native_ads_nine'=>$nativeAdsNine,
	                    		'native_ads_ten'=>$nativeAdsTen,
	                    		'interstitial_ads_one'=>$interstitialAdsOne,
	                    		'interstitial_ads_two'=>$interstitialAdsTwo,
	                    		'interstitial_ads_three'=>$interstitialAdsThree,
	                    		'interstitial_ads_four'=>$interstitialAdsFour,
	                    		'interstitial_ads_five'=>$interstitialAdsFive,
	                    		'interstitial_ads_six'=>$interstitialAdsSix,
	                    		'interstitial_ads_seven'=>$interstitialAdsSeven,
	                    		'interstitial_ads_eight'=>$interstitialAdsEight,
	                    		'interstitial_ads_nine'=>$interstitialAdsNine,
	                    		'interstitial_ads_ten'=>$interstitialAdsTen,
	                    		'open_ads_one'=>$openAdsOne,
	                    		'rewards_ads_one'=>$rewardsAdsOne,
			    			);
			    			$editDataEntry = $this->DataModel->editData('app_id = '.$appID, ANDROID_AD_TABLE, $editData);
							if($editDataEntry){
								redirect('description-app/'.md5($appID));
							}
			    		}
				    } else {
						redirect('error');
					}
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
	
	// Android Application Version Functions
	public function versionNew($appID = 0){
		$isLogin = $this->checkAuth();
        if($isLogin == "True"){
            if(!empty($this->session->userdata['user_role'])){ 
                if($this->session->userdata['user_role'] == "Administrator"){
				    $checkEncryption = $this->DataModel->checkEncrypt($appID,ENCRYPT_TABLE);
				    if($checkEncryption){
				        $appID = $checkEncryption->enc_number;
				    }
					$this->form_validation->set_rules('version_name', 'Text', 'trim|required|max_length[16]');
					$this->form_validation->set_rules('version_code', 'Text', 'trim|required|max_length[16]');
					$this->form_validation->set_rules('ads_count_one', 'Text', 'trim|required|max_length[16]');
					$this->form_validation->set_rules('ads_count_two', 'Text', 'trim|required|max_length[16]');
					$this->form_validation->set_rules('ads_count_three', 'Text', 'trim|required|max_length[16]');
					$this->form_validation->set_rules('ads_count_four', 'Text', 'trim|required|max_length[16]');
					$this->form_validation->set_rules('review_count', 'Text', 'trim|required|max_length[16]');
					$this->form_validation->set_error_delimiters('','');
					if ($this->form_validation->run() == FALSE){
						$data['error'] = "";
						if(ctype_digit($appID)){
			    	        $appData['data'] = array('app_id'=>$appID);
			    	        if($appData['data'] != null){
			    	            $this->load->view('header');
			            		$this->load->view('android/version_new',$appData);
			            		$this->load->view('footer');
			    	        } else {
			    	            redirect('error');
			    	        }
			    	    } else {
			    			redirect('error');
			    		}
					} else {
					    $appID = $this->input->post('app_id');
			    	    $data['androidAppData'] = $this->DataModel->getData('app_id = '.$appID, ANDROID_APPS_TABLE);
			    		$updateUrl = $data['androidAppData']->app_package;
			    		
			    		$versionName = $this->input->post('version_name');
			    		$versionCode = $this->input->post('version_code');
			    		$checkVersionByName = $this->DataModel->checkAndroidVersionByName($appID, $versionName, ANDROID_VERSION_TABLE);
			    		$checkVersionByCode = $this->DataModel->checkAndroidVersionByCode($appID, $versionCode, ANDROID_VERSION_TABLE);
			    	    
			    	    if($checkVersionByName == null and $checkVersionByCode == null) {
			    	        $versionData = array(
			        	    'app_id'=>$this->input->post('app_id'),
			        		'version_name'=>$this->input->post('version_name'),
			        		'version_code'=>$this->input->post('version_code'),
			        		'main_api'=>$this->input->post('main_api'),
			        		'data_api'=>$this->input->post('data_api'),
			        		'app_ads'=>$this->input->post('app_ads'),
			        		'splash_ads'=>$this->input->post('splash_ads'),
			        		'screen_ads'=>$this->input->post('screen_ads'),
			        		'ads_count_one'=>$this->input->post('ads_count_one'),
			        		'ads_count_two'=>$this->input->post('ads_count_two'),
			        		'ads_count_three'=>$this->input->post('ads_count_three'),
			        		'ads_count_four'=>$this->input->post('ads_count_four'),
			        		'review_count'=>$this->input->post('review_count'),
			        		'app_banner'=>$this->input->post('app_banner'),
			        		'app_review'=>$this->input->post('app_review'),
			        		'app_update'=>$this->input->post('app_update'),
			        		'update_title'=>$this->input->post('update_title'),
			        		'update_description'=>$this->input->post('update_description'),
			        		'update_button'=>$this->input->post('update_button'),
			        		'update_url'=>$updateUrl,
			        		'app_open'=>$this->input->post('app_open'),
			                'app_subscription'=>$this->input->post('app_subscription'),
			                'is_rewarded'=>$this->input->post('is_rewarded'),
			        		'version_status'=>$this->input->post('version_status'),
			        		);
			        		$versionDataEntry = $this->DataModel->insertData(ANDROID_VERSION_TABLE, $versionData);
			        	    if($versionDataEntry){
			        		    redirect('view-version/'.md5($appID));
			        	    }
			    	    } else {
			    	        $data['msg'] = array(
			        		'data_title'=>"You can't insert version in database.",
			        	    'data_description'=>"version name and version code are already exits in database!",
			        	    'button_link'=>"description-app/".md5($appID),
			        	    'button_text'=>"App Description"
			        		);
			    	        $this->load->view('header');
			        		$this->load->view('nodata', $data);
			        		$this->load->view('footer');
			    	    }
					}
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
    
    public function versionView($appID = 0){
		$isLogin = $this->checkAuth();
        if($isLogin == "True"){
        	if(!empty($this->session->userdata['user_role'])) { 
                if($this->session->userdata['user_role'] == "Administrator"){
                	$checkEncryption = $this->DataModel->checkEncrypt($appID,ENCRYPT_TABLE);
				    if($checkEncryption){
				        $appID = $checkEncryption->enc_number;
				    }
		            $data = array();
		            //get rows count
		            $conditions['returnType'] = 'count';
		            $totalRec = $this->DataModel->viewVersionData(ANDROID_VERSION_TABLE, $appID, $conditions);
		            
		            //pagination config
		            $config['base_url']    = site_url('view-version/'.md5($appID));
		            $config['uri_segment'] = 3;
		            $config['total_rows']  = $totalRec;
		            $config['per_page']    = 10;
		            
		            //styling
		            $config['num_tag_open'] = '<li class="page-item page-link">';
		            $config['num_tag_close'] = '</li>';
		            $config['cur_tag_open'] = '<li class="active page-item"><a href="javascript:void(0);" class="page-link" >';
		            $config['cur_tag_close'] = '</a></li>';
		            $config['next_link'] = '&raquo';
		            $config['prev_link'] = '&laquo';
		            $config['next_tag_open'] = '<li class="pg-next page-item page-link">';
		            $config['next_tag_close'] = '</li>';
		            $config['prev_tag_open'] = '<li class="pg-prev page-item page-link">';
		            $config['prev_tag_close'] = '</li>';
		            $config['first_tag_open'] = '<li class="page-item page-link">';
		            $config['first_tag_close'] = '</li>';
		            $config['last_tag_open'] = '<li class="page-item page-link">';
		            $config['last_tag_close'] = '</li>';
		            
		            //initialize pagination library
		            $this->pagination->initialize($config);
		            
		            //define offset
		            $page = $this->uri->segment(3);
		            $offset = !$page?0:$page;
		            
		            //get rows
		            $conditions['returnType'] = '';
		            $conditions['start'] = $offset;
		            $conditions['limit'] = 10;
		            
		            $version = $this->DataModel->viewVersionData(ANDROID_VERSION_TABLE, $appID, $conditions);
		            $data['viewVersion'] = array();
		            
		            if (is_array($version) || is_object($version)){
		                foreach($version as $row){
		                    $dataArray = array();
		                    $dataArray['version_id'] = $row['version_id'];
		                    $dataArray['app_id'] = $row['app_id'];
		                    $dataArray['version_name'] = $row['version_name'];
		                    $dataArray['version_code'] = $row['version_code'];
		                    $dataArray['main_api'] = $row['main_api'];
		                    $dataArray['data_api'] = $row['data_api'];
		                    $dataArray['app_ads'] = $row['app_ads'];
		                    $dataArray['app_banner'] = $row['app_banner'];
		                    $dataArray['splash_ads'] = $row['splash_ads'];
		                    $dataArray['screen_ads'] = $row['screen_ads'];
		                    $dataArray['ads_count_one'] = $row['ads_count_one'];
		                    $dataArray['ads_count_two'] = $row['ads_count_two'];
		                    $dataArray['ads_count_three'] = $row['ads_count_three'];
		                    $dataArray['ads_count_four'] = $row['ads_count_four'];
		                    $dataArray['app_review'] = $row['app_review'];
		                    $dataArray['review_count'] = $row['review_count'];
		                    $dataArray['update_title'] = $row['update_title'];
		                    $dataArray['update_description'] = $row['update_description'];
		                    $dataArray['update_url'] = $row['update_url'];
		                    $dataArray['update_button'] = $row['update_button'];
		                    $dataArray['app_update'] = $row['app_update'];
		                    $dataArray['app_open'] = $row['app_open'];
		                    $dataArray['app_subscription'] = $row['app_subscription'];
		                    $dataArray['is_rewarded'] = $row['is_rewarded'];
		                    $dataArray['version_status'] = $row['version_status'];

		                    array_push($data['viewVersion'], $dataArray);
		                }
		            }
		            
		            if($data['viewVersion'] != null){
		                $this->load->view('header');
		                $this->load->view('android/version_view', $data); 
		                $this->load->view('footer');
		            } else {
                        $data['msg'] = array(
							'data_title'=>"Version Database is Empty",
							'data_description'=>"Please add version from the below button.",
							'button_link'=>'new-version/'.md5($appID),
							'button_text'=>"New Version",
                        );
                        $this->load->view('header');
                        $this->load->view('nodata', $data);
                        $this->load->view('footer');
		            }
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
    
	public function versionDescription($versionID = 0){
		$isLogin = $this->checkAuth();
        if($isLogin == "True"){
            if(!empty($this->session->userdata['user_role'])){ 
                if($this->session->userdata['user_role'] == "Administrator"){
				    $checkEncryption = $this->DataModel->checkEncrypt($versionID,ENCRYPT_TABLE);
				    if($checkEncryption){
				        $versionID = $checkEncryption->enc_number;
				    }
				    if(ctype_digit($versionID)){
				        $data['androidVersionData'] = $this->DataModel->getData('version_id = '.$versionID, ANDROID_VERSION_TABLE);
				        $appID = $data['androidVersionData']->app_id;
				        $data['androidAppData'] = $this->DataModel->getData('app_id = '.$appID, ANDROID_APPS_TABLE);
			    	    if($data['androidVersionData'] != null and $data['androidAppData'] != null){
			        	    $this->load->view('header');
			        		$this->load->view('android/version_description', $data);
			        		$this->load->view('footer');
			    	    } else {
			    	        $data['msg'] = array(
			        		'data_title'=>"You can't show version's description!",
			        	    'data_description'=>"Please check version data in database.",
			        	    'button_link'=>null,
			        	    'button_text'=>null
			        		);
			    	        $this->load->view('header');
			        		$this->load->view('nodata', $data);
			        		$this->load->view('footer');
			    	    }
				    } else {
						redirect('error');
					}
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
	
	public function versionEdit($versionID = 0){
		$isLogin = $this->checkAuth();
        if($isLogin == "True"){
            if(!empty($this->session->userdata['user_role'])){ 
                if($this->session->userdata['user_role'] == "Administrator"){
				    $checkEncryption = $this->DataModel->checkEncrypt($versionID,ENCRYPT_TABLE);
				    if($checkEncryption){
				        $versionID = $checkEncryption->enc_number;
				    }
				    if(ctype_digit($versionID)){
			    		$data['androidVersionData'] = $this->DataModel->getData('version_id = '.$versionID, ANDROID_VERSION_TABLE);
						if(!empty($data['androidVersionData'])){
						    $appID = $data['androidVersionData']->app_id;
						    $this->load->view('header');
			        		$this->load->view('android/version_edit',$data);
			        		$this->load->view('footer');
						} else {
							redirect('error');
						}
			    		if($this->input->post('submit')){
			    		    $editData = array(
			        			'version_name'=>$this->input->post('version_name'),
			            		'version_code'=>$this->input->post('version_code'),
			            		'main_api'=>$this->input->post('main_api'),
			        		    'data_api'=>$this->input->post('data_api'),
			            		'app_ads'=>$this->input->post('app_ads'),
			            		'splash_ads'=>$this->input->post('splash_ads'),
			    		        'screen_ads'=>$this->input->post('screen_ads'),
			    		        'ads_count_one'=>$this->input->post('ads_count_one'),
			    		        'ads_count_two'=>$this->input->post('ads_count_two'),
			    		        'ads_count_three'=>$this->input->post('ads_count_three'),
			    		        'ads_count_four'=>$this->input->post('ads_count_four'),
			    		        'review_count'=>$this->input->post('review_count'),
			            		'app_banner'=>$this->input->post('app_banner'),
			            		'app_review'=>$this->input->post('app_review'),
			            		'app_update'=>$this->input->post('app_update'),
			            		'update_title'=>$this->input->post('update_title'),
			            		'update_description'=>$this->input->post('update_description'),
			            		'update_button'=>$this->input->post('update_button'),
			            		'update_url'=>$this->input->post('update_url'),
			            		'app_open'=>$this->input->post('app_open'),
			            		'app_subscription'=>$this->input->post('app_subscription'),
			            		'is_rewarded'=>$this->input->post('is_rewarded'),
			            		'version_status'=>$this->input->post('version_status')
			    			);
			    			$result = $this->DataModel->editData('version_id = '.$versionID, ANDROID_VERSION_TABLE, $editData);
							if($result){
								redirect('view-version/'.md5($appID));
							}
			    		}
				    } else {
						redirect('error');
					}
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
	
	// Android Applications Banners Functions
	public function bannerNew(){
		$isLogin = $this->checkAuth();
        if($isLogin == "True"){
            if(!empty($this->session->userdata['user_role'])){ 
                if($this->session->userdata['user_role'] == "Administrator"){
				    $this->load->view('header');
					$this->load->view('android/banner_new');
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

	public function bannerView(){
		$isLogin = $this->checkAuth();
        if($isLogin == "True"){
            if(!empty($this->session->userdata['user_role'])){ 
                if($this->session->userdata['user_role'] == "Administrator"){
				    $data['viewBanner'] = $this->DataModel->viewData('banner_id '.'DESC', null, ANDROID_BANNER_TABLE);
				    $this->load->view('header');
					$this->load->view('android/banner_view', $data);
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

	public function bannerAdd(){
		$isLogin = $this->checkAuth();
        if($isLogin == "True"){
            if(!empty($this->session->userdata['user_role'])){ 
                if($this->session->userdata['user_role'] == "Administrator"){
					if(!empty($_FILES['banner_image']['name'])){
                        $config['upload_path'] = 'uploads/banners/';
                        $config['allowed_types'] = 'jpg|jpeg|png|gif|webp';
						$config['file_name'] = date('Ymdhis');
                        $this->load->library('upload',$config);
                        $this->upload->initialize($config);
                        if($this->upload->do_upload('banner_image')){
                            $uploadData = $this->upload->data();
                            $bannerImage = $uploadData['file_name'];
                        } else {
                            $bannerImage = '';
                        }
                    } else {
                        $bannerImage = '';
                    }
			            
					$bannerData = array(
					    'banner_title'=>$this->input->post('banner_title'),
			    		'banner_description'=>$this->input->post('banner_description'),
			    	    'banner_image'=>$bannerImage,
			    		'banner_url'=>$this->input->post('banner_url'),
			    		'banner_button'=>$this->input->post('banner_button'),
			    		'banner_status'=>$this->input->post('banner_status')
					);
					$addBannerResult = $this->DataModel->insertData(ANDROID_BANNER_TABLE, $bannerData);
				    if($addBannerResult){
					  redirect('view-banner');  
					}
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

	public function bannerEdit($bannerID = 0){
		$isLogin = $this->checkAuth();
        if($isLogin == "True"){
            if(!empty($this->session->userdata['user_role'])){ 
                if($this->session->userdata['user_role'] == "Administrator"){
				    $checkEncryption = $this->DataModel->checkEncrypt($bannerID,ENCRYPT_TABLE);
				    if($checkEncryption){
				        $bannerID = $checkEncryption->enc_number;
				    }
				    if(ctype_digit($bannerID)){
			    		$data['androidBannerData'] = $this->DataModel->getData('banner_id = '.$bannerID, ANDROID_BANNER_TABLE);
						if(!empty($data['androidBannerData'])){
						    $this->load->view('header');
			        		$this->load->view('android/banner_edit',$data);
			        		$this->load->view('footer');
						} else {
							redirect('error');
						}
			    		if($this->input->post('submit')){
			    		    if(!empty($_FILES['banner_image']['name'])){
			                    $config['upload_path'] = 'uploads/banners/';
			                    $config['allowed_types'] = 'jpg|jpeg|png|gif';
			                    $config['file_name'] = date('Ymdhis');
			                    $this->load->library('upload',$config);
			                    $this->upload->initialize($config);
			                    if($this->upload->do_upload('banner_image')){
			                        $uploadData = $this->upload->data();
			                        $bannerImage = $uploadData['file_name'];
			                    } else {
			                        $bannerImage = $data['androidBannerData']->banner_image;
			                    }
			                } else {
			                    $bannerImage = $data['androidBannerData']->banner_image;
			                }
			                if(!empty($_FILES['banner_image']['name'])){
			                    if(!empty($data['androidBannerData']->banner_image)){
			                        unlink("uploads/banners/".$data['androidBannerData']->banner_image);
			                    }
			                }
		        			$editBannerData = array(
		            			'banner_title'=>$this->input->post('banner_title'),
		                		'banner_description'=>$this->input->post('banner_description'),
		                	    'banner_image'=>$bannerImage,
		                		'banner_url'=>$this->input->post('banner_url'),
		                		'banner_button'=>$this->input->post('banner_button'),
		                		'banner_status'=>$this->input->post('banner_status')
		        			);
			    			$editBannerResult = $this->DataModel->editData('banner_id = '.$bannerID, ANDROID_BANNER_TABLE, $editBannerData);
							if($editBannerResult){
								redirect('view-banner');
							}
			    		}
				    } else {
						redirect('error');
					}
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

 	public function bannerDelete($bannerID = 0){
 	    $isLogin = $this->checkAuth();
        if($isLogin == "True"){
            if(!empty($this->session->userdata['user_role'])){ 
                if($this->session->userdata['user_role'] == "Administrator"){
             	    $checkEncryption = $this->DataModel->checkEncrypt($bannerID,ENCRYPT_TABLE);
            	    if($checkEncryption){
            	        $bannerID = $checkEncryption->enc_number;
            	    }
            	    if(ctype_digit($bannerID)){
            	        $commonJsonData = $this->DataModel->checkCommonJson(ANDROID_COMMON_JSON_TABLE);
            	        $allJsonData = $this->DataModel->checkJson(ANDROID_JSON_TABLE);
                        $allJsonDataFound = null;
                        $commonJsonDataFound = null;
                        if($commonJsonData){
                            $commonJsonBannerIDs = $commonJsonData->json_data;
                    		$commonJsonBannerArray = explode(",",$commonJsonBannerIDs);
                    		foreach ($commonJsonBannerArray as $row) {
                    	        $commonJsonBannerID = $row;
                    	        for ($x = $commonJsonBannerID; $x == $bannerID; $x++) {
                    	            $commonJsonDataFound = true;
                                } 
                    	    }
                        }
                        if($allJsonData){
                            foreach ($allJsonData as $allJsonRow) {
                    	        $allJsonBannerIDs = $allJsonRow->json_data;
                        		$allJsonBannerArray = explode(",",$allJsonBannerIDs);
                        		foreach ($allJsonBannerArray as $row) {
                        	        $allJsonBannerID = $row;
                        	        for ($x = $allJsonBannerID; $x == $bannerID; $x++) {
                        	            $allJsonDataFound = true;
                                    } 
                        	    }
                    	    }
                        }
                        if($commonJsonDataFound == true){
                            $data['msg'] = array(
                    		'data_title'=>"You can't delete the banner!",
                    	    'data_description'=>"Please update common json",
                    	    'button_link'=>"view-common-json",
                    	    'button_text'=>"Delete Common Json"
                    		);
                	        $this->load->view('header');
                    		$this->load->view('nodata', $data);
                    		$this->load->view('footer');
                        } else {
                            if($allJsonDataFound == true){
                                $data['msg'] = array(
                        		'data_title'=>"You can't delete the banner!",
                        	    'data_description'=>"Please update apps json",
                        	    'button_link'=>"description-app/".md5($appID),
                        	    'button_text'=>"App Description"
                        		);
                    	        $this->load->view('header');
                        		$this->load->view('nodata', $data);
                        		$this->load->view('footer');
                            } else {
                        		$deleteBannerResult = $this->DataModel->deleteData('banner_id = '.$bannerID, ANDROID_BANNER_TABLE);
                        		if($deleteBannerResult){
                        			redirect('view-banner');
                        		}
                            }
                        }
            	    } else {
            			redirect('error');
            		}
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
	
	// Android Applications Json Functions
	public function jsonEdit($jsonID = 0){
		$isLogin = $this->checkAuth();
        if($isLogin == "True"){
            if(!empty($this->session->userdata['user_role'])){ 
                if($this->session->userdata['user_role'] == "Administrator"){
				    $checkEncryption = $this->DataModel->checkEncrypt($jsonID,ENCRYPT_TABLE);
				    if($checkEncryption){
				        $jsonID = $checkEncryption->enc_number;
				    }
				    if(ctype_digit($jsonID)){
			    		$data['androidJsonData'] = $this->DataModel->getData('json_id = '.$jsonID, ANDROID_JSON_TABLE);
			    		$data['androidBannerData'] = $this->DataModel->viewData('banner_id '.'DESC', null, ANDROID_BANNER_TABLE);
						if(!empty($data['androidJsonData'])){
						    $appID = $data['androidJsonData']->app_id;
						    $this->load->view('header');
			        		$this->load->view('android/json_edit',$data);
			        		$this->load->view('footer');
						} else {
							redirect('error');
						}
			    		if($this->input->post('submit')){
			    		    $jsonArray = array();
			        	    if(!empty($_POST['data_json'])){
			                    foreach($_POST['data_json'] as $jsonIDs){
			                        array_push($jsonArray,$jsonIDs);
			                    }
			                }
			                $jsonString = implode(',', $jsonArray);
			    			$editJsonData = array(
			            		'json_data'=>$jsonString,
			    			);
			    			$editJsonResult = $this->DataModel->editData('json_id = '.$jsonID, ANDROID_JSON_TABLE, $editJsonData);
							if($editJsonResult){
								redirect('description-app/'.md5($appID));
							}
			    		}
				    } else {
						redirect('error');
					}
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
 	
	// Android Applications Common Json Functions
	public function commonJsonNew(){
		$isLogin = $this->checkAuth();
        if($isLogin == "True"){
            if(!empty($this->session->userdata['user_role'])){ 
                if($this->session->userdata['user_role'] == "Administrator"){
					$appData['viewBanner'] = $this->DataModel->viewData('banner_id '.'DESC', null, ANDROID_BANNER_TABLE);
			        if(!empty($appData['viewBanner'])){
			    	    $this->load->view('header');
			    		$this->load->view('android/common_json_new',$appData);
			    		$this->load->view('footer');
			        } else {
			            $data['msg'] = array(
			        		'data_title'=>"Banner not found in database",
			        	    'data_description'=>"Please add some banner before create common json data.",
			        	    'button_link'=>"new-banner",
			        	    'button_text'=>"New Banner"
			    		);
				        $this->load->view('header');
			    		$this->load->view('nodata', $data);
			    		$this->load->view('footer');
			        }
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

	public function commonJsonView(){
		$isLogin = $this->checkAuth();
        if($isLogin == "True"){
            if(!empty($this->session->userdata['user_role'])){ 
                if($this->session->userdata['user_role'] == "Administrator"){
				    $data['viewJsonBanner'] = array();
				    $data['jsonData'] = $this->DataModel->checkCommonJson(ANDROID_COMMON_JSON_TABLE);
				    if($data['jsonData']){
				        $bannerIDs = $data['jsonData']->json_data;
			    		$bannerArray = explode(",",$bannerIDs);
			    		foreach ($bannerArray as $row) {
			    	        $bannerID = $row;
			    	        $getJsonBanner = $this->DataModel->getData('banner_id = '.$bannerID, ANDROID_BANNER_TABLE);
			    	        array_push($data['viewJsonBanner'],$getJsonBanner);
			    	    }
			    	    $this->load->view('header');
			    		$this->load->view('android/common_json_view', $data);
			    		$this->load->view('footer'); 
				    } else {
				        $this->load->view('header');
			    		$this->load->view('android/common_json_view');
			    		$this->load->view('footer'); 
				    }
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

	public function commonJsonAdd(){
		$isLogin = $this->checkAuth();
        if($isLogin == "True"){
            if(!empty($this->session->userdata['user_role'])){ 
                if($this->session->userdata['user_role'] == "Administrator"){
				    $jsonArray = array();
				    if(!empty($_POST['data_json'])){
			            foreach($_POST['data_json'] as $jsonIDs){
			                array_push($jsonArray,$jsonIDs);
			            }
			        }
			        $appID = $this->input->post('app_id');
			        $jsonString = implode(',', $jsonArray);
					$jsonData = array(
			    		'json_data'=>$jsonString,
			    	    'json_status'=>"true"
					);
					$dJsonData = $this->DataModel->checkCommonJson(ANDROID_COMMON_JSON_TABLE);
					if(empty($dJsonData)){
					    if(!empty($jsonString)) {
			    		    $addJsonResult = $this->DataModel->insertData(ANDROID_COMMON_JSON_TABLE, $jsonData);
			        		    if($addJsonResult){
			        		    redirect('view-common-json');  
			    		    }
			    		} else {
			    			redirect('error');
			    		}
					} else {
					    $data['msg'] = array(
			        		'data_title'=>"Common Json already exits",
			        	    'data_description'=>"Please check common json before add common json data.",
			        	    'button_link'=>"new-banner",
			        	    'button_text'=>""
			    		);
				        $this->load->view('header');
			    		$this->load->view('nodata', $data);
			    		$this->load->view('footer');
					}
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

	public function commonJsonEdit($jsonID = 0){
		$isLogin = $this->checkAuth();
        if($isLogin == "True"){
            if(!empty($this->session->userdata['user_role'])){ 
                if($this->session->userdata['user_role'] == "Administrator"){
				    $checkEncryption = $this->DataModel->checkEncrypt($jsonID,ENCRYPT_TABLE);
				    if($checkEncryption){
				        $jsonID = $checkEncryption->enc_number;
				    }
				    if(ctype_digit($jsonID)){
			    		$data['androidJsonData'] = $this->DataModel->getData('json_id = '.$jsonID,ANDROID_COMMON_JSON_TABLE);
			    		$data['androidBannerData'] = $this->DataModel->viewData('banner_id '.'DESC', null, ANDROID_BANNER_TABLE);
						if(!empty($data['androidJsonData'])){
						    $this->load->view('header');
			        		$this->load->view('android/common_json_edit',$data);
			        		$this->load->view('footer');
						} else {
							redirect('error');
						}
			    		if($this->input->post('submit')){
			    		    $jsonArray = array();
			        	    if(!empty($_POST['data_json'])){
			                    foreach($_POST['data_json'] as $jsonIDs){
			                        array_push($jsonArray,$jsonIDs);
			                    }
			                }
			                $jsonString = implode(',', $jsonArray);
			    			$editJsonData = array(
			            		'json_data'=>$jsonString,
			    			);
			    			if($editJsonData['json_data'] != null){
			                    $editJsonResult = $this->DataModel->editData('json_id = '.$jsonID, ANDROID_COMMON_JSON_TABLE, $editJsonData);
			    				if($editJsonResult){
			    					redirect('view-common-json');
			    				}
			    			} 
			    		}
				    } else {
						redirect('error');
					}
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
    
    //  Android Applications Subscription Functions
    public function subscriptionNew($appID = 0){
		$isLogin = $this->checkAuth();
        if($isLogin == "True"){
            if(!empty($this->session->userdata['user_role'])){ 
                if($this->session->userdata['user_role'] == "Administrator"){
				    $checkEncryption = $this->DataModel->checkEncrypt($appID,ENCRYPT_TABLE);
				    if($checkEncryption){
				        $appID = $checkEncryption->enc_number;
				    }
					$this->form_validation->set_rules('subscription_code', 'Text', 'required');
					$this->form_validation->set_rules('subscription_title_one', 'Text', 'required');
					$this->form_validation->set_rules('subscription_title_two', 'Text', 'required');
					$this->form_validation->set_rules('subscription_title_three', 'Text', 'required');
					$this->form_validation->set_rules('subscription_title_four', 'Text', 'required');
					$this->form_validation->set_error_delimiters('','');
					if ($this->form_validation->run() == FALSE){
						$data['error'] = "";
						$data['appData'] = $this->DataModel->viewData('app_id '.'DESC', null, ANDROID_APPS_TABLE);
						if(ctype_digit($appID)){
			    	        $appData['data'] = array('app_id'=>$appID);
			    	        if($appData['data'] != null){
			    	            $this->load->view('header');
			            		$this->load->view('android/subscription_new',$appData);
			            		$this->load->view('footer');
			    	        } else {
			    	            redirect('error');
			    	        }
			    	    } else {
			    			redirect('error');
			    		}
					} else {
						$newData = array(
							'app_id'=>$this->input->post('app_id'),
							'subscription_code'=>$this->input->post('subscription_code'),
							'subscription_title_one'=>$this->input->post('subscription_title_one'),
							'subscription_title_two'=>$this->input->post('subscription_title_two'),
							'subscription_title_three'=>$this->input->post('subscription_title_three'),
							'subscription_title_four'=>$this->input->post('subscription_title_four'),
							'subscription_primary'=>$this->input->post('subscription_primary'),
							'subscription_status'=>$this->input->post('subscription_status'),
						);
						$newDataEntry = $this->DataModel->insertData(ANDROID_SUBSCRIPTION_TABLE, $newData);
						if($newDataEntry){
							redirect('view-subscription/'.md5($appID));
						}
					}
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

	public function subscriptionView($appID = 0){
		$isLogin = $this->checkAuth();
        if($isLogin == "True"){
        	if(!empty($this->session->userdata['user_role'])) { 
                if($this->session->userdata['user_role'] == "Administrator"){
                	$checkEncryption = $this->DataModel->checkEncrypt($appID,ENCRYPT_TABLE);
				    if($checkEncryption){
				        $appID = $checkEncryption->enc_number;
				    }
		            $data = array();
		            //get rows count
		            $conditions['returnType'] = 'count';
		            $totalRec = $this->DataModel->viewSubscriptionData(ANDROID_SUBSCRIPTION_TABLE, $appID, $conditions);
		            
		            //pagination config
		            $config['base_url']    = site_url('view-subscription/'.md5($appID));
		            $config['uri_segment'] = 3;
		            $config['total_rows']  = $totalRec;
		            $config['per_page']    = 10;
		            
		            //styling
		            $config['num_tag_open'] = '<li class="page-item page-link">';
		            $config['num_tag_close'] = '</li>';
		            $config['cur_tag_open'] = '<li class="active page-item"><a href="javascript:void(0);" class="page-link" >';
		            $config['cur_tag_close'] = '</a></li>';
		            $config['next_link'] = '&raquo';
		            $config['prev_link'] = '&laquo';
		            $config['next_tag_open'] = '<li class="pg-next page-item page-link">';
		            $config['next_tag_close'] = '</li>';
		            $config['prev_tag_open'] = '<li class="pg-prev page-item page-link">';
		            $config['prev_tag_close'] = '</li>';
		            $config['first_tag_open'] = '<li class="page-item page-link">';
		            $config['first_tag_close'] = '</li>';
		            $config['last_tag_open'] = '<li class="page-item page-link">';
		            $config['last_tag_close'] = '</li>';
		            
		            //initialize pagination library
		            $this->pagination->initialize($config);
		            
		            //define offset
		            $page = $this->uri->segment(3);
		            $offset = !$page?0:$page;
		            
		            //get rows
		            $conditions['returnType'] = '';
		            $conditions['start'] = $offset;
		            $conditions['limit'] = 10;
		            
		            $subscription = $this->DataModel->viewSubscriptionData(ANDROID_SUBSCRIPTION_TABLE, $appID, $conditions);
		            $data['viewSubscription'] = array();
		            
		            if (is_array($subscription) || is_object($subscription)){
		                foreach($subscription as $row){
		                    $dataArray = array();
		                    $dataArray['subscription_id'] = $row['subscription_id'];
		                    $dataArray['app_id'] = $row['app_id'];
		                    $dataArray['subscription_code'] = $row['subscription_code'];
		                    $dataArray['subscription_title_one'] = $row['subscription_title_one'];
		                    $dataArray['subscription_title_two'] = $row['subscription_title_two'];
		                    $dataArray['subscription_title_three'] = $row['subscription_title_three'];
		                    $dataArray['subscription_title_four'] = $row['subscription_title_four'];
		                    $dataArray['subscription_primary'] = $row['subscription_primary'];
		                    $dataArray['subscription_status'] = $row['subscription_status'];

		                    array_push($data['viewSubscription'], $dataArray);
		                }
		            }
		            
		            if($data['viewSubscription'] != null){
		                $this->load->view('header');
		                $this->load->view('android/subscription_view', $data); 
		                $this->load->view('footer');
		            } else {
                        $data['msg'] = array(
							'data_title'=>"Subscription Database is Empty",
							'data_description'=>"Please add subscription from the below button.",
							'button_link'=>'new-subscription/'.md5($appID),
							'button_text'=>"New Subscription",
                        );
                        $this->load->view('header');
                        $this->load->view('nodata', $data);
                        $this->load->view('footer');
		            }
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

	public function subscriptionEdit($subscriptionID = 0){
		$isLogin = $this->checkAuth();
        if($isLogin == "True"){
            if(!empty($this->session->userdata['user_role'])){ 
                if($this->session->userdata['user_role'] == "Administrator"){
				    $checkEncryption = $this->DataModel->checkEncrypt($subscriptionID,ENCRYPT_TABLE);
				    if($checkEncryption){
				        $subscriptionID = $checkEncryption->enc_number;
				    }
				    if(ctype_digit($subscriptionID)){
			    		$data['androidSubscriptionData'] = $this->DataModel->getData('subscription_id = '.$subscriptionID, ANDROID_SUBSCRIPTION_TABLE);
						if(!empty($data['androidSubscriptionData'])){
						    $appID = $data['androidSubscriptionData']->app_id;
						    $this->load->view('header');
			        		$this->load->view('android/subscription_edit',$data);
			        		$this->load->view('footer');
						} else {
							redirect('error');
						}
			    		if($this->input->post('submit')){
			    		    $editData = array(
			        			'subscription_code'=>$this->input->post('subscription_code'),
			            		'subscription_title_one'=>$this->input->post('subscription_title_one'),
			            		'subscription_title_two'=>$this->input->post('subscription_title_two'),
			            		'subscription_title_three'=>$this->input->post('subscription_title_three'),
			            		'subscription_title_four'=>$this->input->post('subscription_title_four'),
			            		'subscription_primary'=>$this->input->post('subscription_primary'),
			            		'subscription_status'=>$this->input->post('subscription_status'),
			    			);
			    			$editDataEntry = $this->DataModel->editData('subscription_id = '.$subscriptionID, ANDROID_SUBSCRIPTION_TABLE, $editData);
							if($editDataEntry){
								redirect('view-subscription/'.md5($appID));
							}
			    		}
				    } else {
						redirect('error');
					}
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
 	
 	// Category Mods Functions
    public function categoryModsNew(){
        $isLogin = $this->checkAuth();
        if($isLogin == "True"){
            if(!empty($this->session->userdata['user_role'])) { 
                if($this->session->userdata['user_role'] == "Administrator" or $this->session->userdata['user_role'] == "Editor") {
                    $this->form_validation->set_rules('category_name', 'Text', 'required');
                    
                    if ($this->form_validation->run() == FALSE){
                        $data['error'] = "";
                        $this->load->view('header');
                        $this->load->view('android/category_mods_new',$data);
                        $this->load->view('footer');
                    } else {
                        $newData = array(
                            'category_name'=>$this->input->post('category_name'),
                            'category_status'=>$this->input->post('category_status'),
                        );
                        $newDataEntry = $this->DataModel->insertData(MCPE_CATEGORY_MODS, $newData);
                        if($newDataEntry){
                          redirect('view-category-mods');  
                        }
                    }
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

    public function categoryModsView(){
        $isLogin = $this->checkAuth();
        if($isLogin == "True"){
            if(!empty($this->session->userdata['user_role'])) { 
                if($this->session->userdata['user_role'] == "Administrator" or $this->session->userdata['user_role'] == "Editor") {
                   
                    $data = array();
                    //get rows count
                    $conditions['returnType'] = 'count';
                    $totalRec = $this->DataModel->viewCategoryModsData($conditions, MCPE_CATEGORY_MODS);
                    
                    //pagination config
                    $config['base_url']    = site_url('view-category-mods');
                    $config['uri_segment'] = 2;
                    $config['total_rows']  = $totalRec;
                    $config['per_page']    = 10;
                    
                    //styling
                    $config['num_tag_open'] = '<li class="page-item page-link">';
                    $config['num_tag_close'] = '</li>';
                    $config['cur_tag_open'] = '<li class="active page-item"><a href="javascript:void(0);" class="page-link" >';
                    $config['cur_tag_close'] = '</a></li>';
                    $config['next_link'] = '&raquo';
                    $config['prev_link'] = '&laquo';
                    $config['next_tag_open'] = '<li class="pg-next page-item page-link">';
                    $config['next_tag_close'] = '</li>';
                    $config['prev_tag_open'] = '<li class="pg-prev page-item page-link">';
                    $config['prev_tag_close'] = '</li>';
                    $config['first_tag_open'] = '<li class="page-item page-link">';
                    $config['first_tag_close'] = '</li>';
                    $config['last_tag_open'] = '<li class="page-item page-link">';
                    $config['last_tag_close'] = '</li>';
                    
                    //initialize pagination library
                    $this->pagination->initialize($config);
                    
                    //define offset
                    $page = $this->uri->segment(2);
                    $offset = !$page?0:$page;
                    
                    //get rows
                    $conditions['returnType'] = '';
                    $conditions['start'] = $offset;
                    $conditions['limit'] = 10;

                    $categoryMods = $this->DataModel->viewCategoryModsData($conditions, MCPE_CATEGORY_MODS);
                    $data['viewCategoryMods'] = array();
                    
                    if (is_array($categoryMods) || is_object($categoryMods)){
                        foreach($categoryMods as $Row){
                            $dataArray = array();
                            $dataArray['category_id'] = $Row['category_id'];
                            $dataArray['category_name'] = $Row['category_name'];
                            $dataArray['category_status'] = $Row['category_status'];
                            
                            array_push($data['viewCategoryMods'], $dataArray);
                        }
                    }

                    if($data['viewCategoryMods'] != null){
                        $this->load->view('header');
                        $this->load->view('android/category_mods_view',$data);
                        $this->load->view('footer');
                    } else {
                        $data['msg'] = array(
                            'data_title'=>"Category Mods Database is Empty",
                            'data_description'=>"Please add category mods from the below button.",
                            'button_link'=>"new-category-mods",
                            'button_text'=>"New Category Mods",
                        );
                        $this->load->view('header');
                        $this->load->view('nodata', $data);
                        $this->load->view('footer');
                    }
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

    public function categoryModsEdit($categoryID = 0){
        $isLogin = $this->checkAuth();
        if($isLogin == "True"){
            if(!empty($this->session->userdata['user_role'])) { 
                if($this->session->userdata['user_role'] == "Administrator" or $this->session->userdata['user_role'] == "Editor") {
                    $checkEncryption = $this->DataModel->checkEncrypt($categoryID,ENCRYPT_TABLE);
                    if($checkEncryption){
                        $categoryID = $checkEncryption->enc_number;
                    }
                   
                    if(ctype_digit($categoryID)){
                        $data['categoryModsData'] = $this->DataModel->getData('category_id = '.$categoryID, MCPE_CATEGORY_MODS);
                        if(!empty($data['categoryModsData'])){
                            $this->load->view('header');
                            $this->load->view('android/category_mods_edit',$data);
                            $this->load->view('footer');
                        } else {
                            redirect('error');
                        }
                        if($this->input->post('submit')){
                            $editData = array(
                                'category_name'=>$this->input->post('category_name'),
                                'category_status'=>$this->input->post('category_status'),
                            );
                            $editDataEntry = $this->DataModel->editData('category_id = '.$categoryID, MCPE_CATEGORY_MODS, $editData);
                            if($editDataEntry){
                                redirect('view-category-mods');
                            }
                        }
                    } else {
                        redirect('error');
                    }
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

    // Category Addons Functions
    public function categoryAddonsNew(){
        $isLogin = $this->checkAuth();
        if($isLogin == "True"){
            if(!empty($this->session->userdata['user_role'])) { 
                if($this->session->userdata['user_role'] == "Administrator" or $this->session->userdata['user_role'] == "Editor") {
                    $this->form_validation->set_rules('category_name', 'Text', 'required');
                    
                    if ($this->form_validation->run() == FALSE){
                        $data['error'] = "";
                        $this->load->view('header');
                        $this->load->view('android/category_addons_new',$data);
                        $this->load->view('footer');
                    }else{
                        $newData = array(
                            'category_name'=>$this->input->post('category_name'),
                            'category_status'=>$this->input->post('category_status'),
                        );
                        $newDataEntry = $this->DataModel->insertData(MCPE_CATEGORY_ADDONS, $newData);
                        if($newDataEntry){
                          redirect('view-category-addons');  
                        }
                    }
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

    public function categoryAddonsView(){
        $isLogin = $this->checkAuth();
        if($isLogin == "True"){
            if(!empty($this->session->userdata['user_role'])) { 
                if($this->session->userdata['user_role'] == "Administrator" or $this->session->userdata['user_role'] == "Editor") {
                   
                    $data = array();
                    //get rows count
                    $conditions['returnType'] = 'count';
                    $totalRec = $this->DataModel->viewCategoryAddonsData($conditions, MCPE_CATEGORY_ADDONS);
                    
                    //pagination config
                    $config['base_url']    = site_url('view-category-addons');
                    $config['uri_segment'] = 2;
                    $config['total_rows']  = $totalRec;
                    $config['per_page']    = 10;
                    
                    //styling
                    $config['num_tag_open'] = '<li class="page-item page-link">';
                    $config['num_tag_close'] = '</li>';
                    $config['cur_tag_open'] = '<li class="active page-item"><a href="javascript:void(0);" class="page-link" >';
                    $config['cur_tag_close'] = '</a></li>';
                    $config['next_link'] = '&raquo';
                    $config['prev_link'] = '&laquo';
                    $config['next_tag_open'] = '<li class="pg-next page-item page-link">';
                    $config['next_tag_close'] = '</li>';
                    $config['prev_tag_open'] = '<li class="pg-prev page-item page-link">';
                    $config['prev_tag_close'] = '</li>';
                    $config['first_tag_open'] = '<li class="page-item page-link">';
                    $config['first_tag_close'] = '</li>';
                    $config['last_tag_open'] = '<li class="page-item page-link">';
                    $config['last_tag_close'] = '</li>';
                    
                    //initialize pagination library
                    $this->pagination->initialize($config);
                    
                    //define offset
                    $page = $this->uri->segment(2);
                    $offset = !$page?0:$page;
                    
                    //get rows
                    $conditions['returnType'] = '';
                    $conditions['start'] = $offset;
                    $conditions['limit'] = 10;

                    $categoryAddons = $this->DataModel->viewCategoryAddonsData($conditions, MCPE_CATEGORY_ADDONS);
                    $data['viewCategoryAddons'] = array();
                    
                    if (is_array($categoryAddons) || is_object($categoryAddons)){
                        foreach($categoryAddons as $Row){
                            $dataArray = array();
                            $dataArray['category_id'] = $Row['category_id'];
                            $dataArray['category_name'] = $Row['category_name'];
                            $dataArray['category_status'] = $Row['category_status'];
                            
                            array_push($data['viewCategoryAddons'], $dataArray);
                        }
                    }

                    if($data['viewCategoryAddons'] != null){
                        $this->load->view('header');
                        $this->load->view('android/category_addons_view',$data);
                        $this->load->view('footer');
                    } else {
                        $data['msg'] = array(
                            'data_title'=>"Category Addons Database is Empty",
                            'data_description'=>"Please add category addons from the below button.",
                            'button_link'=>"new-category-addons",
                            'button_text'=>"New Category Addons",
                        );
                        $this->load->view('header');
                        $this->load->view('nodata', $data);
                        $this->load->view('footer');
                    }
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

    public function categoryAddonsEdit($categoryID = 0){
        $isLogin = $this->checkAuth();
        if($isLogin == "True"){
            if(!empty($this->session->userdata['user_role'])) { 
                if($this->session->userdata['user_role'] == "Administrator" or $this->session->userdata['user_role'] == "Editor") {
                    $checkEncryption = $this->DataModel->checkEncrypt($categoryID,ENCRYPT_TABLE);
                    if($checkEncryption){
                        $categoryID = $checkEncryption->enc_number;
                    }
                   
                    if(ctype_digit($categoryID)){
                        $data['categoryAddonsData'] = $this->DataModel->getData('category_id = '.$categoryID, MCPE_CATEGORY_ADDONS);
                        if(!empty($data['categoryAddonsData'])){
                            $this->load->view('header');
                            $this->load->view('android/category_addons_edit',$data);
                            $this->load->view('footer');
                        } else {
                            redirect('error');
                        }
                        if($this->input->post('submit')){
                            $editData = array(
                                'category_name'=>$this->input->post('category_name'),
                                'category_status'=>$this->input->post('category_status'),
                            );
                            $editDataEntry = $this->DataModel->editData('category_id = '.$categoryID, MCPE_CATEGORY_ADDONS, $editData);
                            if($editDataEntry){
                                redirect('view-category-addons');
                            }
                        }
                    } else {
                        redirect('error');
                    }
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

    // Category Maps Functions
    public function categoryMapsNew(){
        $isLogin = $this->checkAuth();
        if($isLogin == "True"){
            if(!empty($this->session->userdata['user_role'])) { 
                if($this->session->userdata['user_role'] == "Administrator" or $this->session->userdata['user_role'] == "Editor") {
                    $this->form_validation->set_rules('category_name', 'Text', 'required');
                    
                    if ($this->form_validation->run() == FALSE){
                        $data['error'] = "";
                        $this->load->view('header');
                        $this->load->view('android/category_maps_new',$data);
                        $this->load->view('footer');
                    }else{
                        $newData = array(
                            'category_name'=>$this->input->post('category_name'),
                            'category_status'=>$this->input->post('category_status'),
                        );
                        $newDataEntry = $this->DataModel->insertData(MCPE_CATEGORY_MAPS, $newData);
                        if($newDataEntry){
                          redirect('view-category-maps');  
                        }
                    }
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

    public function categoryMapsView(){
        $isLogin = $this->checkAuth();
        if($isLogin == "True"){
            if(!empty($this->session->userdata['user_role'])) { 
                if($this->session->userdata['user_role'] == "Administrator" or $this->session->userdata['user_role'] == "Editor") {
                   
                    $data = array();
                    //get rows count
                    $conditions['returnType'] = 'count';
                    $totalRec = $this->DataModel->viewCategoryMapsData($conditions, MCPE_CATEGORY_MAPS);
                    
                    //pagination config
                    $config['base_url']    = site_url('view-category-maps');
                    $config['uri_segment'] = 2;
                    $config['total_rows']  = $totalRec;
                    $config['per_page']    = 10;
                    
                    //styling
                    $config['num_tag_open'] = '<li class="page-item page-link">';
                    $config['num_tag_close'] = '</li>';
                    $config['cur_tag_open'] = '<li class="active page-item"><a href="javascript:void(0);" class="page-link" >';
                    $config['cur_tag_close'] = '</a></li>';
                    $config['next_link'] = '&raquo';
                    $config['prev_link'] = '&laquo';
                    $config['next_tag_open'] = '<li class="pg-next page-item page-link">';
                    $config['next_tag_close'] = '</li>';
                    $config['prev_tag_open'] = '<li class="pg-prev page-item page-link">';
                    $config['prev_tag_close'] = '</li>';
                    $config['first_tag_open'] = '<li class="page-item page-link">';
                    $config['first_tag_close'] = '</li>';
                    $config['last_tag_open'] = '<li class="page-item page-link">';
                    $config['last_tag_close'] = '</li>';
                    
                    //initialize pagination library
                    $this->pagination->initialize($config);
                    
                    //define offset
                    $page = $this->uri->segment(2);
                    $offset = !$page?0:$page;
                    
                    //get rows
                    $conditions['returnType'] = '';
                    $conditions['start'] = $offset;
                    $conditions['limit'] = 10;

                    $categoryMaps = $this->DataModel->viewCategoryMapsData($conditions, MCPE_CATEGORY_MAPS);
                    $data['viewCategoryMaps'] = array();
                    
                    if (is_array($categoryMaps) || is_object($categoryMaps)){
                        foreach($categoryMaps as $Row){
                            $dataArray = array();
                            $dataArray['category_id'] = $Row['category_id'];
                            $dataArray['category_name'] = $Row['category_name'];
                            $dataArray['category_status'] = $Row['category_status'];
                            
                            array_push($data['viewCategoryMaps'], $dataArray);
                        }
                    }

                    if($data['viewCategoryMaps'] != null){
                        $this->load->view('header');
                        $this->load->view('android/category_maps_view',$data);
                        $this->load->view('footer');
                    } else {
                        $data['msg'] = array(
                            'data_title'=>"Category Maps Database is Empty",
                            'data_description'=>"Please add category maps from the below button.",
                            'button_link'=>"new-category-maps",
                            'button_text'=>"New Category Maps",
                        );
                        $this->load->view('header');
                        $this->load->view('nodata', $data);
                        $this->load->view('footer');
                    }
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

    public function categoryMapsEdit($categoryID = 0){
        $isLogin = $this->checkAuth();
        if($isLogin == "True"){
            if(!empty($this->session->userdata['user_role'])) { 
                if($this->session->userdata['user_role'] == "Administrator" or $this->session->userdata['user_role'] == "Editor") {
                    $checkEncryption = $this->DataModel->checkEncrypt($categoryID,ENCRYPT_TABLE);
                    if($checkEncryption){
                        $categoryID = $checkEncryption->enc_number;
                    }
                   
                    if(ctype_digit($categoryID)){
                        $data['categoryMapsData'] = $this->DataModel->getData('category_id = '.$categoryID, MCPE_CATEGORY_MAPS);
                        if(!empty($data['categoryMapsData'])){
                            $this->load->view('header');
                            $this->load->view('android/category_maps_edit',$data);
                            $this->load->view('footer');
                        } else {
                            redirect('error');
                        }
                        if($this->input->post('submit')){
                            $editData = array(
                                'category_name'=>$this->input->post('category_name'),
                                'category_status'=>$this->input->post('category_status'),
                            );
                            $editDataEntry = $this->DataModel->editData('category_id = '.$categoryID, MCPE_CATEGORY_MAPS, $editData);
                            if($editDataEntry){
                                redirect('view-category-maps');
                            }
                        }
                    } else {
                        redirect('error');
                    }
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

    // Category Seeds Functions
    public function categorySeedsNew(){
        $isLogin = $this->checkAuth();
        if($isLogin == "True"){
            if(!empty($this->session->userdata['user_role'])) { 
                if($this->session->userdata['user_role'] == "Administrator" or $this->session->userdata['user_role'] == "Editor") {
                    $this->form_validation->set_rules('category_name', 'Text', 'required');
                    
                    if ($this->form_validation->run() == FALSE){
                        $data['error'] = "";
                        $this->load->view('header');
                        $this->load->view('android/category_seeds_new',$data);
                        $this->load->view('footer');
                    }else{
                        $newData = array(
                            'category_name'=>$this->input->post('category_name'),
                            'category_status'=>$this->input->post('category_status'),
                        );
                        $newDataEntry = $this->DataModel->insertData(MCPE_CATEGORY_SEEDS, $newData);
                        if($newDataEntry){
                          redirect('view-category-seeds');  
                        }
                    }
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

    public function categorySeedsView(){
        $isLogin = $this->checkAuth();
        if($isLogin == "True"){
            if(!empty($this->session->userdata['user_role'])) { 
                if($this->session->userdata['user_role'] == "Administrator" or $this->session->userdata['user_role'] == "Editor") {
                   
                    $data = array();
                    //get rows count
                    $conditions['returnType'] = 'count';
                    $totalRec = $this->DataModel->viewCategorySeedsData($conditions, MCPE_CATEGORY_SEEDS);
                    
                    //pagination config
                    $config['base_url']    = site_url('view-category-seeds');
                    $config['uri_segment'] = 2;
                    $config['total_rows']  = $totalRec;
                    $config['per_page']    = 10;
                    
                    //styling
                    $config['num_tag_open'] = '<li class="page-item page-link">';
                    $config['num_tag_close'] = '</li>';
                    $config['cur_tag_open'] = '<li class="active page-item"><a href="javascript:void(0);" class="page-link" >';
                    $config['cur_tag_close'] = '</a></li>';
                    $config['next_link'] = '&raquo';
                    $config['prev_link'] = '&laquo';
                    $config['next_tag_open'] = '<li class="pg-next page-item page-link">';
                    $config['next_tag_close'] = '</li>';
                    $config['prev_tag_open'] = '<li class="pg-prev page-item page-link">';
                    $config['prev_tag_close'] = '</li>';
                    $config['first_tag_open'] = '<li class="page-item page-link">';
                    $config['first_tag_close'] = '</li>';
                    $config['last_tag_open'] = '<li class="page-item page-link">';
                    $config['last_tag_close'] = '</li>';
                    
                    //initialize pagination library
                    $this->pagination->initialize($config);
                    
                    //define offset
                    $page = $this->uri->segment(2);
                    $offset = !$page?0:$page;
                    
                    //get rows
                    $conditions['returnType'] = '';
                    $conditions['start'] = $offset;
                    $conditions['limit'] = 10;

                    $categorySeeds = $this->DataModel->viewCategorySeedsData($conditions, MCPE_CATEGORY_SEEDS);
                    $data['viewCategorySeeds'] = array();
                    
                    if (is_array($categorySeeds) || is_object($categorySeeds)){
                        foreach($categorySeeds as $Row){
                            $dataArray = array();
                            $dataArray['category_id'] = $Row['category_id'];
                            $dataArray['category_name'] = $Row['category_name'];
                            $dataArray['category_status'] = $Row['category_status'];
                            
                            array_push($data['viewCategorySeeds'], $dataArray);
                        }
                    }

                    if($data['viewCategorySeeds'] != null){
                        $this->load->view('header');
                        $this->load->view('android/category_seeds_view',$data);
                        $this->load->view('footer');
                    } else {
                        $data['msg'] = array(
                            'data_title'=>"Category Seeds Database is Empty",
                            'data_description'=>"Please add category seeds from the below button.",
                            'button_link'=>"new-category-seeds",
                            'button_text'=>"New Category Seeds",
                        );
                        $this->load->view('header');
                        $this->load->view('nodata', $data);
                        $this->load->view('footer');
                    }
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

    public function categorySeedsEdit($categoryID = 0){
        $isLogin = $this->checkAuth();
        if($isLogin == "True"){
            if(!empty($this->session->userdata['user_role'])) { 
                if($this->session->userdata['user_role'] == "Administrator" or $this->session->userdata['user_role'] == "Editor") {
                    $checkEncryption = $this->DataModel->checkEncrypt($categoryID,ENCRYPT_TABLE);
                    if($checkEncryption){
                        $categoryID = $checkEncryption->enc_number;
                    }
                   
                    if(ctype_digit($categoryID)){
                        $data['categorySeedsData'] = $this->DataModel->getData('category_id = '.$categoryID, MCPE_CATEGORY_SEEDS);
                        if(!empty($data['categorySeedsData'])){
                            $this->load->view('header');
                            $this->load->view('android/category_seeds_edit',$data);
                            $this->load->view('footer');
                        } else {
                            redirect('error');
                        }
                        if($this->input->post('submit')){
                            $editData = array(
                                'category_name'=>$this->input->post('category_name'),
                                'category_status'=>$this->input->post('category_status'),
                            );
                            $editDataEntry = $this->DataModel->editData('category_id = '.$categoryID, MCPE_CATEGORY_SEEDS, $editData);
                            if($editDataEntry){
                                redirect('view-category-seeds');
                            }
                        }
                    } else {
                        redirect('error');
                    }
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

    // Category Textures Functions
    public function categoryTexturesNew(){
        $isLogin = $this->checkAuth();
        if($isLogin == "True"){
            if(!empty($this->session->userdata['user_role'])) { 
                if($this->session->userdata['user_role'] == "Administrator" or $this->session->userdata['user_role'] == "Editor") {
                    $this->form_validation->set_rules('category_name', 'Text', 'required');
                    
                    if ($this->form_validation->run() == FALSE){
                        $data['error'] = "";
                        $this->load->view('header');
                        $this->load->view('android/category_textures_new',$data);
                        $this->load->view('footer');
                    }else{
                        $newData = array(
                            'category_name'=>$this->input->post('category_name'),
                            'category_status'=>$this->input->post('category_status'),
                        );
                        $newDataEntry = $this->DataModel->insertData(MCPE_CATEGORY_TEXTURES, $newData);
                        if($newDataEntry){
                          redirect('view-category-textures');  
                        }
                    }
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

    public function categoryTexturesView(){
        $isLogin = $this->checkAuth();
        if($isLogin == "True"){
            if(!empty($this->session->userdata['user_role'])) { 
                if($this->session->userdata['user_role'] == "Administrator" or $this->session->userdata['user_role'] == "Editor") {
                   
                    $data = array();
                    //get rows count
                    $conditions['returnType'] = 'count';
                    $totalRec = $this->DataModel->viewCategoryTexturesData($conditions, MCPE_CATEGORY_TEXTURES);
                    
                    //pagination config
                    $config['base_url']    = site_url('view-category-textures');
                    $config['uri_segment'] = 2;
                    $config['total_rows']  = $totalRec;
                    $config['per_page']    = 10;
                    
                    //styling
                    $config['num_tag_open'] = '<li class="page-item page-link">';
                    $config['num_tag_close'] = '</li>';
                    $config['cur_tag_open'] = '<li class="active page-item"><a href="javascript:void(0);" class="page-link" >';
                    $config['cur_tag_close'] = '</a></li>';
                    $config['next_link'] = '&raquo';
                    $config['prev_link'] = '&laquo';
                    $config['next_tag_open'] = '<li class="pg-next page-item page-link">';
                    $config['next_tag_close'] = '</li>';
                    $config['prev_tag_open'] = '<li class="pg-prev page-item page-link">';
                    $config['prev_tag_close'] = '</li>';
                    $config['first_tag_open'] = '<li class="page-item page-link">';
                    $config['first_tag_close'] = '</li>';
                    $config['last_tag_open'] = '<li class="page-item page-link">';
                    $config['last_tag_close'] = '</li>';
                    
                    //initialize pagination library
                    $this->pagination->initialize($config);
                    
                    //define offset
                    $page = $this->uri->segment(2);
                    $offset = !$page?0:$page;
                    
                    //get rows
                    $conditions['returnType'] = '';
                    $conditions['start'] = $offset;
                    $conditions['limit'] = 10;

                    $categoryTextures = $this->DataModel->viewCategoryTexturesData($conditions, MCPE_CATEGORY_TEXTURES);
                    $data['viewCategoryTextures'] = array();
                    
                    if (is_array($categoryTextures) || is_object($categoryTextures)){
                        foreach($categoryTextures as $Row){
                            $dataArray = array();
                            $dataArray['category_id'] = $Row['category_id'];
                            $dataArray['category_name'] = $Row['category_name'];
                            $dataArray['category_status'] = $Row['category_status'];
                            
                            array_push($data['viewCategoryTextures'], $dataArray);
                        }
                    }

                    if($data['viewCategoryTextures'] != null){
                        $this->load->view('header');
                        $this->load->view('android/category_textures_view',$data);
                        $this->load->view('footer');
                    } else {
                        $data['msg'] = array(
                            'data_title'=>"Category Textures Database is Empty",
                            'data_description'=>"Please add category textures from the below button.",
                            'button_link'=>"new-category-textures",
                            'button_text'=>"New Category Textures",
                        );
                        $this->load->view('header');
                        $this->load->view('nodata', $data);
                        $this->load->view('footer');
                    }
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

    public function categoryTexturesEdit($categoryID = 0){
        $isLogin = $this->checkAuth();
        if($isLogin == "True"){
            if(!empty($this->session->userdata['user_role'])) { 
                if($this->session->userdata['user_role'] == "Administrator" or $this->session->userdata['user_role'] == "Editor") {
                    $checkEncryption = $this->DataModel->checkEncrypt($categoryID,ENCRYPT_TABLE);
                    if($checkEncryption){
                        $categoryID = $checkEncryption->enc_number;
                    }
                   
                    if(ctype_digit($categoryID)){
                        $data['categoryTexturesData'] = $this->DataModel->getData('category_id = '.$categoryID, MCPE_CATEGORY_TEXTURES);
                        if(!empty($data['categoryTexturesData'])){
                            $this->load->view('header');
                            $this->load->view('android/category_textures_edit',$data);
                            $this->load->view('footer');
                        } else {
                            redirect('error');
                        }
                        if($this->input->post('submit')){
                            $editData = array(
                                'category_name'=>$this->input->post('category_name'),
                                'category_status'=>$this->input->post('category_status'),
                            );
                            $editDataEntry = $this->DataModel->editData('category_id = '.$categoryID, MCPE_CATEGORY_TEXTURES, $editData);
                            if($editDataEntry){
                                redirect('view-category-textures');
                            }
                        }
                    } else {
                        redirect('error');
                    }
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

    // Category Shaders Functions
    public function categoryShadersNew(){
        $isLogin = $this->checkAuth();
        if($isLogin == "True"){
            if(!empty($this->session->userdata['user_role'])) { 
                if($this->session->userdata['user_role'] == "Administrator" or $this->session->userdata['user_role'] == "Editor") {
                    $this->form_validation->set_rules('category_name', 'Text', 'required');
                    
                    if ($this->form_validation->run() == FALSE){
                        $data['error'] = "";
                        $this->load->view('header');
                        $this->load->view('android/category_shaders_new',$data);
                        $this->load->view('footer');
                    }else{
                        $newData = array(
                            'category_name'=>$this->input->post('category_name'),
                            'category_status'=>$this->input->post('category_status'),
                        );
                        $newDataEntry = $this->DataModel->insertData(MCPE_CATEGORY_SHADERS, $newData);
                        if($newDataEntry){
                          redirect('view-category-shaders');  
                        }
                    }
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

    public function categoryShadersView(){
        $isLogin = $this->checkAuth();
        if($isLogin == "True"){
            if(!empty($this->session->userdata['user_role'])) { 
                if($this->session->userdata['user_role'] == "Administrator" or $this->session->userdata['user_role'] == "Editor") {
                   
                    $data = array();
                    //get rows count
                    $conditions['returnType'] = 'count';
                    $totalRec = $this->DataModel->viewCategoryShadersData($conditions, MCPE_CATEGORY_SHADERS);
                    
                    //pagination config
                    $config['base_url']    = site_url('view-category-shaders');
                    $config['uri_segment'] = 2;
                    $config['total_rows']  = $totalRec;
                    $config['per_page']    = 10;
                    
                    //styling
                    $config['num_tag_open'] = '<li class="page-item page-link">';
                    $config['num_tag_close'] = '</li>';
                    $config['cur_tag_open'] = '<li class="active page-item"><a href="javascript:void(0);" class="page-link" >';
                    $config['cur_tag_close'] = '</a></li>';
                    $config['next_link'] = '&raquo';
                    $config['prev_link'] = '&laquo';
                    $config['next_tag_open'] = '<li class="pg-next page-item page-link">';
                    $config['next_tag_close'] = '</li>';
                    $config['prev_tag_open'] = '<li class="pg-prev page-item page-link">';
                    $config['prev_tag_close'] = '</li>';
                    $config['first_tag_open'] = '<li class="page-item page-link">';
                    $config['first_tag_close'] = '</li>';
                    $config['last_tag_open'] = '<li class="page-item page-link">';
                    $config['last_tag_close'] = '</li>';
                    
                    //initialize pagination library
                    $this->pagination->initialize($config);
                    
                    //define offset
                    $page = $this->uri->segment(2);
                    $offset = !$page?0:$page;
                    
                    //get rows
                    $conditions['returnType'] = '';
                    $conditions['start'] = $offset;
                    $conditions['limit'] = 10;

                    $categoryShaders = $this->DataModel->viewCategoryShadersData($conditions, MCPE_CATEGORY_SHADERS);
                    $data['viewCategoryShaders'] = array();
                    
                    if (is_array($categoryShaders) || is_object($categoryShaders)){
                        foreach($categoryShaders as $Row){
                            $dataArray = array();
                            $dataArray['category_id'] = $Row['category_id'];
                            $dataArray['category_name'] = $Row['category_name'];
                            $dataArray['category_status'] = $Row['category_status'];
                            
                            array_push($data['viewCategoryShaders'], $dataArray);
                        }
                    }

                    if($data['viewCategoryShaders'] != null){
                        $this->load->view('header');
                        $this->load->view('android/category_shaders_view',$data);
                        $this->load->view('footer');
                    } else {
                        $data['msg'] = array(
                            'data_title'=>"Category Shaders Database is Empty",
                            'data_description'=>"Please add category shaders from the below button.",
                            'button_link'=>"new-category-shaders",
                            'button_text'=>"New Category Shaders",
                        );
                        $this->load->view('header');
                        $this->load->view('nodata', $data);
                        $this->load->view('footer');
                    }
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

    public function categoryShadersEdit($categoryID = 0){
        $isLogin = $this->checkAuth();
        if($isLogin == "True"){
            if(!empty($this->session->userdata['user_role'])) { 
                if($this->session->userdata['user_role'] == "Administrator" or $this->session->userdata['user_role'] == "Editor") {
                    $checkEncryption = $this->DataModel->checkEncrypt($categoryID,ENCRYPT_TABLE);
                    if($checkEncryption){
                        $categoryID = $checkEncryption->enc_number;
                    }
                   
                    if(ctype_digit($categoryID)){
                        $data['categoryShadersData'] = $this->DataModel->getData('category_id = '.$categoryID, MCPE_CATEGORY_SHADERS);
                        if(!empty($data['categoryShadersData'])){
                            $this->load->view('header');
                            $this->load->view('android/category_shaders_edit',$data);
                            $this->load->view('footer');
                        } else {
                            redirect('error');
                        }
                        if($this->input->post('submit')){
                            $editData = array(
                                'category_name'=>$this->input->post('category_name'),
                                'category_status'=>$this->input->post('category_status'),
                            );
                            $editDataEntry = $this->DataModel->editData('category_id = '.$categoryID, MCPE_CATEGORY_SHADERS, $editData);
                            if($editDataEntry){
                                redirect('view-category-shaders');
                            }
                        }
                    } else {
                        redirect('error');
                    }
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
    
    //Category Skin Functions
    public function categorySkinNew(){
        $isLogin = $this->checkAuth();
        if($isLogin == "True"){
            if(!empty($this->session->userdata['user_role'])) { 
                if($this->session->userdata['user_role'] == "Administrator" or $this->session->userdata['user_role'] == "Editor") {
                    $this->form_validation->set_rules('category_name', 'Text', 'required');
                    
                    if ($this->form_validation->run() == FALSE){
                        $data['error'] = "";
                        $this->load->view('header');
                        $this->load->view('android/category_skin_new',$data);
                        $this->load->view('footer');
                    }else{
                        $newData = array(
                            'category_name'=>$this->input->post('category_name'),
                            'category_status'=>$this->input->post('category_status'),
                        );
                        $newDataEntry = $this->DataModel->insertData(MCPE_CATEGORY_SKIN, $newData);
                        if($newDataEntry){
                          redirect('view-category-skin');  
                        }
                    }
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

    public function categorySkinView(){
        $isLogin = $this->checkAuth();
        if($isLogin == "True"){
            if(!empty($this->session->userdata['user_role'])) { 
                if($this->session->userdata['user_role'] == "Administrator" or $this->session->userdata['user_role'] == "Editor") {
                   
                    $data = array();
                    //get rows count
                    $conditions['returnType'] = 'count';
                    $totalRec = $this->DataModel->viewCategorySkinData($conditions, MCPE_CATEGORY_SKIN);
                    
                    //pagination config
                    $config['base_url']    = site_url('view-category-skin');
                    $config['uri_segment'] = 2;
                    $config['total_rows']  = $totalRec;
                    $config['per_page']    = 10;
                    
                    //styling
                    $config['num_tag_open'] = '<li class="page-item page-link">';
                    $config['num_tag_close'] = '</li>';
                    $config['cur_tag_open'] = '<li class="active page-item"><a href="javascript:void(0);" class="page-link" >';
                    $config['cur_tag_close'] = '</a></li>';
                    $config['next_link'] = '&raquo';
                    $config['prev_link'] = '&laquo';
                    $config['next_tag_open'] = '<li class="pg-next page-item page-link">';
                    $config['next_tag_close'] = '</li>';
                    $config['prev_tag_open'] = '<li class="pg-prev page-item page-link">';
                    $config['prev_tag_close'] = '</li>';
                    $config['first_tag_open'] = '<li class="page-item page-link">';
                    $config['first_tag_close'] = '</li>';
                    $config['last_tag_open'] = '<li class="page-item page-link">';
                    $config['last_tag_close'] = '</li>';
                    
                    //initialize pagination library
                    $this->pagination->initialize($config);
                    
                    //define offset
                    $page = $this->uri->segment(2);
                    $offset = !$page?0:$page;
                    
                    //get rows
                    $conditions['returnType'] = '';
                    $conditions['start'] = $offset;
                    $conditions['limit'] = 10;

                    $categorySkin = $this->DataModel->viewCategorySkinData($conditions, MCPE_CATEGORY_SKIN);
                    $data['viewCategorySkin'] = array();
                    
                    if (is_array($categorySkin) || is_object($categorySkin)){
                        foreach($categorySkin as $Row){
                            $dataArray = array();
                            $dataArray['category_id'] = $Row['category_id'];
                            $dataArray['category_name'] = $Row['category_name'];
                            $dataArray['category_status'] = $Row['category_status'];
                            
                            array_push($data['viewCategorySkin'], $dataArray);
                        }
                    }

                    if($data['viewCategorySkin'] != null){
                        $this->load->view('header');
                        $this->load->view('android/category_skin_view',$data);
                        $this->load->view('footer');
                    } else {
                        $data['msg'] = array(
                            'data_title'=>"Category Skin Database is Empty",
                            'data_description'=>"Please add category skin from the below button.",
                            'button_link'=>"new-category-skin",
                            'button_text'=>"New Category Skin",
                        );
                        $this->load->view('header');
                        $this->load->view('nodata', $data);
                        $this->load->view('footer');
                    }
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

    public function categorySkinEdit($categoryID = 0){
        $isLogin = $this->checkAuth();
        if($isLogin == "True"){
            if(!empty($this->session->userdata['user_role'])) { 
                if($this->session->userdata['user_role'] == "Administrator" or $this->session->userdata['user_role'] == "Editor") {
                    $checkEncryption = $this->DataModel->checkEncrypt($categoryID,ENCRYPT_TABLE);
                    if($checkEncryption){
                        $categoryID = $checkEncryption->enc_number;
                    }
                   
                    if(ctype_digit($categoryID)){
                        $data['categorySkinData'] = $this->DataModel->getData('category_id = '.$categoryID, MCPE_CATEGORY_SKIN);
                        if(!empty($data['categorySkinData'])){
                            $this->load->view('header');
                            $this->load->view('android/category_skin_edit',$data);
                            $this->load->view('footer');
                        } else {
                            redirect('error');
                        }
                        if($this->input->post('submit')){
                            $editData = array(
                                'category_name'=>$this->input->post('category_name'),
                                'category_status'=>$this->input->post('category_status'),
                            );
                            $editDataEntry = $this->DataModel->editData('category_id = '.$categoryID, MCPE_CATEGORY_SKIN, $editData);
                            if($editDataEntry){
                                redirect('view-category-skin');
                            }
                        }
                    } else {
                        redirect('error');
                    }
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
    
    // Mods Functions
    public function modsNew(){
        $isLogin = $this->checkAuth();
        if($isLogin == "True"){
            if(!empty($this->session->userdata['user_role'])) { 
                if($this->session->userdata['user_role'] == "Administrator" or $this->session->userdata['user_role'] == "Editor") {
                    date_default_timezone_set("Asia/Kolkata");
                    $s3Client = $this->getconfig();
                    $uniqueCode = $this->uniqueKey();
                    
                    $this->form_validation->set_rules('category_id', 'Text', 'required');
                    $this->form_validation->set_rules('data_name', 'Text', 'required');
                    $this->form_validation->set_rules('data_description', 'Text', 'required');
                    $this->form_validation->set_rules('data_support_version', 'Text', 'required');
                    $this->form_validation->set_rules('data_price', 'Text', 'required');
                    $this->form_validation->set_rules('data_size', 'Text', 'required');
                    $this->form_validation->set_rules('data_view', 'Text', 'required');
                    $this->form_validation->set_rules('data_download', 'Text', 'required');

                    if (empty($_FILES['data_image']['name'])){
                        $this->form_validation->set_rules('data_image', 'Data Image', 'required');
                    }
                    $this->form_validation->set_error_delimiters('','');

                    if (empty($_FILES['data_bundle']['name'])){
                        $this->form_validation->set_rules('data_bundle', 'Data Bundle', 'required');
                    }
                    $this->form_validation->set_error_delimiters('','');
                    
                    if ($this->form_validation->run() == FALSE){
                        $data['categoryModsData'] = $this->DataModel->viewData('category_id '.'DESC', null, MCPE_CATEGORY_MODS);
                        $data['error'] = "";
                        $this->load->view('header');
                        $this->load->view('android/mods_new',$data);
                        $this->load->view('footer');
                    } else {

                        $imageName = $_FILES['data_image']['name'];
                        $imageTemp = $_FILES['data_image']['tmp_name'];
                        $imagePath = DATA_IMAGE;
                        $imageResponse = $this->newBucketObject($imageName, $uniqueCode, $imageTemp, $imagePath);

                        $bundleName = $_FILES['data_bundle']['name'];
                        $bundleTemp = $_FILES['data_bundle']['tmp_name'];
                        $bundlePath = DATA_BUNDLE;
                        $bundleResponse = $this->newBucketObject($bundleName, $uniqueCode, $bundleTemp, $bundlePath);
                        
                        $newData = array(
                            'category_id'=>$this->input->post('category_id'),
                            'data_name'=>$this->input->post('data_name'),
                            'data_description'=>$this->input->post('data_description'),
                            'data_image'=>$imageResponse,
                            'data_bundle'=>$bundleResponse,
                            'data_support_version'=>$this->input->post('data_support_version'),
                            'data_price'=>$this->input->post('data_price'),
                            'data_size'=>$this->input->post('data_size'),
                            'data_view'=>$this->input->post('data_view'),
                            'data_download'=>$this->input->post('data_download'),
                            'data_status'=>$this->input->post('data_status'),
                        );
                        $newDataEntry = $this->DataModel->insertData(MCPE_MODS, $newData);
                        if($newDataEntry){
                          redirect('view-mods');  
                        }
                    }
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

    public function modsView(){
        $isLogin = $this->checkAuth();
        if($isLogin == "True"){
            if(!empty($this->session->userdata['user_role'])) { 
                if($this->session->userdata['user_role'] == "Administrator" or $this->session->userdata['user_role'] == "Editor") {

                    if(isset($_POST['reset'])){
                        $this->session->unset_userdata('session_mods_view');
                    }
                    if(isset($_POST['search'])){
                        $searchModsView = $this->input->post('search_mods_view');
                        $this->session->set_userdata('session_mods_view',$searchModsView);
                    }
                    $sessionModsView =  $this->session->userdata('session_mods_view');
                   
                    $data = array();
                    //get rows count
                    $conditions['search_mods_view'] = $sessionModsView;
                    $conditions['returnType'] = 'count';
                    $totalRec = $this->DataModel->viewModsData($conditions, MCPE_MODS);
                    
                    //pagination config
                    $config['base_url']    = site_url('view-mods');
                    $config['uri_segment'] = 2;
                    $config['total_rows']  = $totalRec;
                    $config['per_page']    = 20;
                    
                    //styling
                    $config['num_tag_open'] = '<li class="page-item page-link">';
                    $config['num_tag_close'] = '</li>';
                    $config['cur_tag_open'] = '<li class="active page-item"><a href="javascript:void(0);" class="page-link" >';
                    $config['cur_tag_close'] = '</a></li>';
                    $config['next_link'] = '&raquo';
                    $config['prev_link'] = '&laquo';
                    $config['next_tag_open'] = '<li class="pg-next page-item page-link">';
                    $config['next_tag_close'] = '</li>';
                    $config['prev_tag_open'] = '<li class="pg-prev page-item page-link">';
                    $config['prev_tag_close'] = '</li>';
                    $config['first_tag_open'] = '<li class="page-item page-link">';
                    $config['first_tag_close'] = '</li>';
                    $config['last_tag_open'] = '<li class="page-item page-link">';
                    $config['last_tag_close'] = '</li>';
                    
                    //initialize pagination library
                    $this->pagination->initialize($config);
                    
                    //define offset
                    $page = $this->uri->segment(2);
                    $offset = !$page?0:$page;
                    
                    //get rows
                    $conditions['returnType'] = '';
                    $conditions['start'] = $offset;
                    $conditions['limit'] = 20;

                    $mods = $this->DataModel->viewModsData($conditions, MCPE_MODS);
                    $data['viewMods'] = array();
                    
                    if (is_array($mods) || is_object($mods)){
                        foreach($mods as $Row){
                            $dataArray = array();
                            $dataArray['unique_id'] = $Row['unique_id'];
                            $dataArray['category_id'] = $Row['category_id'];
                            $dataArray['data_name'] = $Row['data_name'];
                            $dataArray['data_description'] = $Row['data_description'];
                            $dataArray['data_image'] = $Row['data_image'];
                            $dataArray['data_bundle'] = $Row['data_bundle'];
                            $dataArray['data_support_version'] = $Row['data_support_version'];
                            $dataArray['data_price'] = $Row['data_price'];
                            $dataArray['data_size'] = $Row['data_size'];
                            $dataArray['data_view'] = $Row['data_view'];
                            $dataArray['data_download'] = $Row['data_download'];
                            $dataArray['data_status'] = $Row['data_status'];
                            $dataArray['categoryData'] = $this->DataModel->getData('category_id = '.$dataArray['category_id'], MCPE_CATEGORY_MODS);

                            array_push($data['viewMods'], $dataArray);
                        }
                    }

                    if($data['viewMods'] != null){
                        $this->load->view('header');
                        $this->load->view('android/mods_view',$data);
                        $this->load->view('footer');
                    } else {
                        $this->session->unset_userdata('session_mods_view');   
                        $data['msg'] = array(
                            'data_title'=>"Mods Database is Empty",
                            'data_description'=>"Please add mods & redirect mods from the below button.",
                            'button_link'=>"new-mods",
                            'button_text'=>"New Mods",
                            'button_link1'=>'view-mods',
                            'button_text1'=>"View Mods",
                        );
                        $this->load->view('header');
                        $this->load->view('nodata', $data);
                        $this->load->view('footer');
                    }
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

    public function modsEdit($uniqueID = 0){
        $isLogin = $this->checkAuth();
        if($isLogin == "True"){
            if(!empty($this->session->userdata['user_role'])) { 
                if($this->session->userdata['user_role'] == "Administrator" or $this->session->userdata['user_role'] == "Editor") {
                    $checkEncryption = $this->DataModel->checkEncrypt($uniqueID, ENCRYPT_TABLE);
                    if($checkEncryption){
                        $uniqueID = $checkEncryption->enc_number;
                    }
                   
                    if(ctype_digit($uniqueID)){
                        $data['modsData'] = $this->DataModel->getData('unique_id = '.$uniqueID, MCPE_MODS);
                        $data['viewCategoryMods'] = $this->DataModel->viewData('category_id '.'DESC', null, MCPE_CATEGORY_MODS);
                        $categoryID = $data['modsData']->category_id;
                        $data['categoryModsData'] = $this->DataModel->getData('category_id = '.$categoryID, MCPE_CATEGORY_MODS);
                        if(!empty($data['modsData'])){
                            $this->load->view('header');
                            $this->load->view('android/mods_edit',$data);
                            $this->load->view('footer');
                        } else {
                            redirect('error');
                        }
                        if($this->input->post('submit')){
                            date_default_timezone_set("Asia/Kolkata");
                            $s3Client = $this->getconfig();
                            $uniqueCode = $this->uniqueKey();
                            
                            $imageKey = $data['modsData']->data_image;
                            $newImageKey = basename($imageKey);
                    
                            $bundleKey = $data['modsData']->data_bundle;
                            $newBundleKey = basename($bundleKey);
    
                            if (!empty($_FILES['data_image']['name']) and !empty($_FILES['data_bundle']['name'])){
                                $deleteImage = $s3Client->deleteObject([
                                        'Bucket' => BUCKET_NAME,
                                        'Key'    => DATA_IMAGE.$newImageKey,
                                    ]);
                                $deleteBundle = $s3Client->deleteObject([
                                        'Bucket' => BUCKET_NAME,
                                        'Key'    => DATA_BUNDLE.$newBundleKey,
                                    ]);
                                
                                $imageName = $_FILES['data_image']['name'];
                                $imageTemp = $_FILES['data_image']['tmp_name'];
                                $imagePath = DATA_IMAGE;
                                $imageResponse = $this->newBucketObject($imageName, $uniqueCode, $imageTemp, $imagePath);

                                $bundleName = $_FILES['data_bundle']['name'];
                                $bundleTemp = $_FILES['data_bundle']['tmp_name'];
                                $bundlePath = DATA_BUNDLE;
                                $bundleResponse = $this->newBucketObject($bundleName, $uniqueCode, $bundleTemp, $bundlePath);

                                $editData = array(
                                    'category_id'=>$this->input->post('category_id'),
                                    'data_name'=>$this->input->post('data_name'),
                                    'data_description'=>$this->input->post('data_description'),
                                    'data_image'=>$imageResponse,
                                    'data_bundle'=>$bundleResponse,
                                    'data_support_version'=>$this->input->post('data_support_version'),
                                    'data_price'=>$this->input->post('data_price'),
                                    'data_size'=>$this->input->post('data_size'),
                                    'data_view'=>$this->input->post('data_view'),
                                    'data_download'=>$this->input->post('data_download'),
                                    'data_status'=>$this->input->post('data_status'),
                                );
                            } else if(!empty($_FILES['data_image']['name'])) {
                                $deleteImage = $s3Client->deleteObject([
                                    'Bucket' => BUCKET_NAME,
                                    'Key'    => DATA_IMAGE.$newImageKey,
                                ]);
                    
                                $imageName = $_FILES['data_image']['name'];
                                $imageTemp = $_FILES['data_image']['tmp_name'];
                                $imagePath = DATA_IMAGE;
                                $imageResponse = $this->newBucketObject($imageName, $uniqueCode, $imageTemp, $imagePath);
                    
                                $editData = array(
                                    'category_id'=>$this->input->post('category_id'),
                                    'data_name'=>$this->input->post('data_name'),
                                    'data_description'=>$this->input->post('data_description'),
                                    'data_image'=>$imageResponse,
                                    'data_support_version'=>$this->input->post('data_support_version'),
                                    'data_price'=>$this->input->post('data_price'),
                                    'data_size'=>$this->input->post('data_size'),
                                    'data_view'=>$this->input->post('data_view'),
                                    'data_download'=>$this->input->post('data_download'),
                                    'data_status'=>$this->input->post('data_status'),
                                );
                            } else if(!empty($_FILES['data_bundle']['name'])) {
                                $deleteBundle = $s3Client->deleteObject([
                                    'Bucket' => BUCKET_NAME,
                                    'Key'    => DATA_BUNDLE.$newBundleKey,
                                ]);
                                
                                $bundleName = $_FILES['data_bundle']['name'];
                                $bundleTemp = $_FILES['data_bundle']['tmp_name'];
                                $bundlePath = DATA_BUNDLE;
                                $bundleResponse = $this->newBucketObject($bundleName, $uniqueCode, $bundleTemp, $bundlePath);
                                
                                $editData = array(
                                    'category_id'=>$this->input->post('category_id'),
                                    'data_name'=>$this->input->post('data_name'),
                                    'data_description'=>$this->input->post('data_description'),
                                    'data_bundle'=>$bundleResponse,
                                    'data_support_version'=>$this->input->post('data_support_version'),
                                    'data_price'=>$this->input->post('data_price'),
                                    'data_size'=>$this->input->post('data_size'),
                                    'data_view'=>$this->input->post('data_view'),
                                    'data_download'=>$this->input->post('data_download'),
                                    'data_status'=>$this->input->post('data_status'),
                                );
                            } else {
                                $editData = array(
                                    'category_id'=>$this->input->post('category_id'),
                                    'data_name'=>$this->input->post('data_name'),
                                    'data_description'=>$this->input->post('data_description'),
                                    'data_support_version'=>$this->input->post('data_support_version'),
                                    'data_price'=>$this->input->post('data_price'),
                                    'data_size'=>$this->input->post('data_size'),
                                    'data_view'=>$this->input->post('data_view'),
                                    'data_download'=>$this->input->post('data_download'),
                                    'data_status'=>$this->input->post('data_status'),
                                );
                            }
                            $editDataEntry = $this->DataModel->editData('unique_id = '.$uniqueID, MCPE_MODS, $editData);
                            if($editDataEntry){
                                redirect('view-mods');
                            }
                        }
                    } else {
                        redirect('error');
                    }
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

    // Addons Functions
    public function addonsNew(){
        $isLogin = $this->checkAuth();
        if($isLogin == "True"){
            if(!empty($this->session->userdata['user_role'])) { 
                if($this->session->userdata['user_role'] == "Administrator" or $this->session->userdata['user_role'] == "Editor") {
                    date_default_timezone_set("Asia/Kolkata");
                    $s3Client = $this->getconfig();
                    $uniqueCode = $this->uniqueKey();
                    $this->form_validation->set_rules('category_id', 'Text', 'required');
                    $this->form_validation->set_rules('data_name', 'Text', 'required');
                    $this->form_validation->set_rules('data_description', 'Text', 'required');
                    $this->form_validation->set_rules('data_support_version', 'Text', 'required');
                    $this->form_validation->set_rules('data_price', 'Text', 'required');
                    $this->form_validation->set_rules('data_size', 'Text', 'required');
                    $this->form_validation->set_rules('data_view', 'Text', 'required');
                    $this->form_validation->set_rules('data_download', 'Text', 'required');

                    if (empty($_FILES['data_image']['name'])){
                        $this->form_validation->set_rules('data_image', 'Data Image', 'required');
                    }
                    $this->form_validation->set_error_delimiters('','');

                    if (empty($_FILES['data_bundle']['name'])){
                        $this->form_validation->set_rules('data_bundle', 'Data Bundle', 'required');
                    }
                    $this->form_validation->set_error_delimiters('','');
                    
                    if ($this->form_validation->run() == FALSE){
                        $data['categoryAddonsData'] = $this->DataModel->viewData('category_id '.'DESC', null, MCPE_CATEGORY_ADDONS);
                        $data['error'] = "";
                        $this->load->view('header');
                        $this->load->view('android/addons_new',$data);
                        $this->load->view('footer');
                    }else{

                        $imageName = $_FILES['data_image']['name'];
                        $imageTemp = $_FILES['data_image']['tmp_name'];
                        $imagePath = DATA_IMAGE;
                        $imageResponse = $this->newBucketObject($imageName, $uniqueCode, $imageTemp, $imagePath);

                        $bundleName = $_FILES['data_bundle']['name'];
                        $bundleTemp = $_FILES['data_bundle']['tmp_name'];
                        $bundlePath = DATA_BUNDLE;
                        $bundleResponse = $this->newBucketObject($bundleName, $uniqueCode, $bundleTemp, $bundlePath);
                        
                        $newData = array(
                            'category_id'=>$this->input->post('category_id'),
                            'data_name'=>$this->input->post('data_name'),
                            'data_description'=>$this->input->post('data_description'),
                            'data_image'=>$imageResponse,
                            'data_bundle'=>$bundleResponse,
                            'data_support_version'=>$this->input->post('data_support_version'),
                            'data_price'=>$this->input->post('data_price'),
                            'data_size'=>$this->input->post('data_size'),
                            'data_view'=>$this->input->post('data_view'),
                            'data_download'=>$this->input->post('data_download'),
                            'data_status'=>$this->input->post('data_status'),
                        );
                        $newDataEntry = $this->DataModel->insertData(MCPE_ADDONS, $newData);
                        if($newDataEntry){
                          redirect('view-addons');  
                        }
                    }
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

    public function addonsView(){
        $isLogin = $this->checkAuth();
        if($isLogin == "True"){
            if(!empty($this->session->userdata['user_role'])) { 
                if($this->session->userdata['user_role'] == "Administrator" or $this->session->userdata['user_role'] == "Editor") {

                    if(isset($_POST['reset'])){
                        $this->session->unset_userdata('session_addons_view');
                    }
                    if(isset($_POST['search'])){
                        $searchAddonsView = $this->input->post('search_addons_view');
                        $this->session->set_userdata('session_addons_view',$searchAddonsView);
                    }
                    $sessionAddonsView =  $this->session->userdata('session_addons_view');
                   
                    $data = array();
                    //get rows count
                    $conditions['search_addons_view'] = $sessionAddonsView;
                    $conditions['returnType'] = 'count';
                    $totalRec = $this->DataModel->viewAddonsData($conditions, MCPE_ADDONS);
                    
                    //pagination config
                    $config['base_url']    = site_url('view-addons');
                    $config['uri_segment'] = 2;
                    $config['total_rows']  = $totalRec;
                    $config['per_page']    = 20;
                    
                    //styling
                    $config['num_tag_open'] = '<li class="page-item page-link">';
                    $config['num_tag_close'] = '</li>';
                    $config['cur_tag_open'] = '<li class="active page-item"><a href="javascript:void(0);" class="page-link" >';
                    $config['cur_tag_close'] = '</a></li>';
                    $config['next_link'] = '&raquo';
                    $config['prev_link'] = '&laquo';
                    $config['next_tag_open'] = '<li class="pg-next page-item page-link">';
                    $config['next_tag_close'] = '</li>';
                    $config['prev_tag_open'] = '<li class="pg-prev page-item page-link">';
                    $config['prev_tag_close'] = '</li>';
                    $config['first_tag_open'] = '<li class="page-item page-link">';
                    $config['first_tag_close'] = '</li>';
                    $config['last_tag_open'] = '<li class="page-item page-link">';
                    $config['last_tag_close'] = '</li>';
                    
                    //initialize pagination library
                    $this->pagination->initialize($config);
                    
                    //define offset
                    $page = $this->uri->segment(2);
                    $offset = !$page?0:$page;
                    
                    //get rows
                    $conditions['returnType'] = '';
                    $conditions['start'] = $offset;
                    $conditions['limit'] = 20;

                    $addons = $this->DataModel->viewAddonsData($conditions, MCPE_ADDONS);
                    $data['viewAddons'] = array();
                    
                    if (is_array($addons) || is_object($addons)){
                        foreach($addons as $Row){
                            $dataArray = array();
                            $dataArray['unique_id'] = $Row['unique_id'];
                            $dataArray['category_id'] = $Row['category_id'];
                            $dataArray['data_name'] = $Row['data_name'];
                            $dataArray['data_description'] = $Row['data_description'];
                            $dataArray['data_image'] = $Row['data_image'];
                            $dataArray['data_bundle'] = $Row['data_bundle'];
                            $dataArray['data_support_version'] = $Row['data_support_version'];
                            $dataArray['data_price'] = $Row['data_price'];
                            $dataArray['data_size'] = $Row['data_size'];
                            $dataArray['data_view'] = $Row['data_view'];
                            $dataArray['data_download'] = $Row['data_download'];
                            $dataArray['data_status'] = $Row['data_status'];
                            $dataArray['categoryData'] = $this->DataModel->getData('category_id = '.$dataArray['category_id'], MCPE_CATEGORY_ADDONS);

                            array_push($data['viewAddons'], $dataArray);
                        }
                    }

                    if($data['viewAddons'] != null){
                        $this->load->view('header');
                        $this->load->view('android/addons_view',$data);
                        $this->load->view('footer');
                    } else {
                        $this->session->unset_userdata('session_addons_view'); 
                        $data['msg'] = array(
                            'data_title'=>"Addons Database is Empty",
                            'data_description'=>"Please add addons & redirect addons from the below button.",
                            'button_link'=>"new-addons",
                            'button_text'=>"New Addons",
                            'button_link1'=>'view-addons',
                            'button_text1'=>"View Addons",
                        );
                        $this->load->view('header');
                        $this->load->view('nodata', $data);
                        $this->load->view('footer');
                    }
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

    public function addonsEdit($uniqueID = 0){
        $isLogin = $this->checkAuth();
        if($isLogin == "True"){
            if(!empty($this->session->userdata['user_role'])) { 
                if($this->session->userdata['user_role'] == "Administrator" or $this->session->userdata['user_role'] == "Editor") {
                    $checkEncryption = $this->DataModel->checkEncrypt($uniqueID,ENCRYPT_TABLE);
                    if($checkEncryption){
                        $uniqueID = $checkEncryption->enc_number;
                    }
                   
                    if(ctype_digit($uniqueID)){
                        $data['addonsData'] = $this->DataModel->getData('unique_id = '.$uniqueID, MCPE_ADDONS);
                        $data['viewCategoryAddons'] = $this->DataModel->viewData('category_id '.'DESC', null, MCPE_CATEGORY_ADDONS);
                        $categoryID = $data['addonsData']->category_id;
                        $data['categoryAddonsData'] = $this->DataModel->getData('category_id = '.$categoryID, MCPE_CATEGORY_ADDONS);
                        if(!empty($data['addonsData'])){
                            $this->load->view('header');
                            $this->load->view('android/addons_edit',$data);
                            $this->load->view('footer');
                        } else {
                            redirect('error');
                        }
                        if($this->input->post('submit')){
                            date_default_timezone_set("Asia/Kolkata");
                            $s3Client = $this->getconfig();
                            $uniqueCode = $this->uniqueKey();
                            
                            $imageKey = $data['addonsData']->data_image;
                            $newImageKey = basename($imageKey);
                    
                            $bundleKey = $data['addonsData']->data_bundle;
                            $newBundleKey = basename($bundleKey);

                            if (!empty($_FILES['data_image']['name']) and !empty($_FILES['data_bundle']['name'])){
                                $deleteImage = $s3Client->deleteObject([
                                        'Bucket' => BUCKET_NAME,
                                        'Key'    => DATA_IMAGE.$newImageKey,
                                    ]);
                                $deleteBundle = $s3Client->deleteObject([
                                        'Bucket' => BUCKET_NAME,
                                        'Key'    => DATA_BUNDLE.$newBundleKey,
                                    ]);
                                
                                $imageName = $_FILES['data_image']['name'];
                                $imageTemp = $_FILES['data_image']['tmp_name'];
                                $imagePath = DATA_IMAGE;
                                $imageResponse = $this->newBucketObject($imageName, $uniqueCode, $imageTemp, $imagePath);

                                $bundleName = $_FILES['data_bundle']['name'];
                                $bundleTemp = $_FILES['data_bundle']['tmp_name'];
                                $bundlePath = DATA_BUNDLE;
                                $bundleResponse = $this->newBucketObject($bundleName, $uniqueCode, $bundleTemp, $bundlePath);

                                $editData = array(
                                    'category_id'=>$this->input->post('category_id'),
                                    'data_name'=>$this->input->post('data_name'),
                                    'data_description'=>$this->input->post('data_description'),
                                    'data_image'=>$imageResponse,
                                    'data_bundle'=>$bundleResponse,
                                    'data_support_version'=>$this->input->post('data_support_version'),
                                    'data_price'=>$this->input->post('data_price'),
                                    'data_size'=>$this->input->post('data_size'),
                                    'data_view'=>$this->input->post('data_view'),
                                    'data_download'=>$this->input->post('data_download'),
                                    'data_status'=>$this->input->post('data_status'),
                                );
                            } else if(!empty($_FILES['data_image']['name'])) {
                                $deleteImage = $s3Client->deleteObject([
                                            'Bucket' => BUCKET_NAME,
                                            'Key'    => DATA_IMAGE.$newImageKey,
                                        ]);
                    
                                $imageName = $_FILES['data_image']['name'];
                                $imageTemp = $_FILES['data_image']['tmp_name'];
                                $imagePath = DATA_IMAGE;
                                $imageResponse = $this->newBucketObject($imageName, $uniqueCode, $imageTemp, $imagePath);
                    
                                $editData = array(
                                    'category_id'=>$this->input->post('category_id'),
                                    'data_name'=>$this->input->post('data_name'),
                                    'data_description'=>$this->input->post('data_description'),
                                    'data_image'=>$imageResponse,
                                    'data_support_version'=>$this->input->post('data_support_version'),
                                    'data_price'=>$this->input->post('data_price'),
                                    'data_size'=>$this->input->post('data_size'),
                                    'data_view'=>$this->input->post('data_view'),
                                    'data_download'=>$this->input->post('data_download'),
                                    'data_status'=>$this->input->post('data_status'),
                                );
                            } else if(!empty($_FILES['data_bundle']['name'])) {
                                $deleteBundle = $s3Client->deleteObject([
                                        'Bucket' => BUCKET_NAME,
                                        'Key'    => DATA_BUNDLE.$newBundleKey,
                                    ]);
                                
                                $bundleName = $_FILES['data_bundle']['name'];
                                $bundleTemp = $_FILES['data_bundle']['tmp_name'];
                                $bundlePath = DATA_BUNDLE;
                                $bundleResponse = $this->newBucketObject($bundleName, $uniqueCode, $bundleTemp, $bundlePath);
                                
                                $editData = array(
                                    'category_id'=>$this->input->post('category_id'),
                                    'data_name'=>$this->input->post('data_name'),
                                    'data_description'=>$this->input->post('data_description'),
                                    'data_bundle'=>$bundleResponse,
                                    'data_support_version'=>$this->input->post('data_support_version'),
                                    'data_price'=>$this->input->post('data_price'),
                                    'data_size'=>$this->input->post('data_size'),
                                    'data_view'=>$this->input->post('data_view'),
                                    'data_download'=>$this->input->post('data_download'),
                                    'data_status'=>$this->input->post('data_status'),
                                );
                            } else {
                                $editData = array(
                                    'category_id'=>$this->input->post('category_id'),
                                    'data_name'=>$this->input->post('data_name'),
                                    'data_description'=>$this->input->post('data_description'),
                                    'data_support_version'=>$this->input->post('data_support_version'),
                                    'data_price'=>$this->input->post('data_price'),
                                    'data_size'=>$this->input->post('data_size'),
                                    'data_view'=>$this->input->post('data_view'),
                                    'data_download'=>$this->input->post('data_download'),
                                    'data_status'=>$this->input->post('data_status'),
                                );
                            }
                            $editDataEntry = $this->DataModel->editData('unique_id = '.$uniqueID, MCPE_ADDONS, $editData);
                            if($editDataEntry){
                                redirect('view-addons');
                            }
                        }
                    } else {
                        redirect('error');
                    }
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

    // Maps Functions
    public function mapsNew(){
        $isLogin = $this->checkAuth();
        if($isLogin == "True"){
            if(!empty($this->session->userdata['user_role'])) { 
                if($this->session->userdata['user_role'] == "Administrator" or $this->session->userdata['user_role'] == "Editor") {
                    date_default_timezone_set("Asia/Kolkata");
                    $s3Client = $this->getconfig();
                    $uniqueCode = $this->uniqueKey();
                    
                    $this->form_validation->set_rules('category_id', 'Text', 'required');
                    $this->form_validation->set_rules('data_name', 'Text', 'required');
                    $this->form_validation->set_rules('data_description', 'Text', 'required');
                    $this->form_validation->set_rules('data_support_version', 'Text', 'required');
                    $this->form_validation->set_rules('data_price', 'Text', 'required');
                    $this->form_validation->set_rules('data_size', 'Text', 'required');
                    $this->form_validation->set_rules('data_view', 'Text', 'required');
                    $this->form_validation->set_rules('data_download', 'Text', 'required');

                    if (empty($_FILES['data_image']['name'])){
                        $this->form_validation->set_rules('data_image', 'Document', 'required');
                    }
                    if (empty($_FILES['data_bundle']['name'])){
                        $this->form_validation->set_rules('data_bundle', 'Document', 'required');
                    }
                    $this->form_validation->set_error_delimiters('','');
                    
                    if ($this->form_validation->run() == FALSE){
                        $data['error'] = "";
                        $data['categoryMapsData'] = $this->DataModel->viewData('category_id '.'DESC', null, MCPE_CATEGORY_MAPS);
                        $this->load->view('header');
                        $this->load->view('android/maps_new',$data);
                        $this->load->view('footer');
                    } else {
                        $imageName = $_FILES['data_image']['name'];
                        $imageTemp = $_FILES['data_image']['tmp_name'];
                        $imagePath = DATA_IMAGE;
                        $imageResponse = $this->newBucketObject($imageName, $uniqueCode, $imageTemp, $imagePath);

                        $bundleName = $_FILES['data_bundle']['name'];
                        $bundleTemp = $_FILES['data_bundle']['tmp_name'];
                        $bundlePath = DATA_BUNDLE;
                        $bundleResponse = $this->newBucketObject($bundleName, $uniqueCode, $bundleTemp, $bundlePath);
                        
                        $newData = array(
                            'category_id'=>$this->input->post('category_id'),
                            'data_name'=>$this->input->post('data_name'),
                            'data_description'=>$this->input->post('data_description'),
                            'data_image'=>$imageResponse,
                            'data_bundle'=>$bundleResponse,
                            'data_support_version'=>$this->input->post('data_support_version'),
                            'data_price'=>$this->input->post('data_price'),
                            'data_size'=>$this->input->post('data_size'),
                            'data_view'=>$this->input->post('data_view'),
                            'data_download'=>$this->input->post('data_download'),
                            'data_status'=>$this->input->post('data_status'),
                        );
                        $newDataEntry = $this->DataModel->insertData(MCPE_MAPS, $newData);
                        if($newDataEntry){
                          redirect('view-maps');  
                        }
                    }
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

    public function mapsView(){
        $isLogin = $this->checkAuth();
        if($isLogin == "True"){
            if(!empty($this->session->userdata['user_role'])) { 
                if($this->session->userdata['user_role'] == "Administrator" or $this->session->userdata['user_role'] == "Editor") {

                    if(isset($_POST['reset'])){
                        $this->session->unset_userdata('session_maps_view');
                    }
                    if(isset($_POST['search'])){
                        $searchMapsView = $this->input->post('search_maps_view');
                        $this->session->set_userdata('session_maps_view',$searchMapsView);
                    }
                    $sessionMapsView =  $this->session->userdata('session_maps_view');
                   
                    $data = array();
                    //get rows count
                    $conditions['search_maps_view'] = $sessionMapsView;
                    $conditions['returnType'] = 'count';
                    $totalRec = $this->DataModel->viewMapsData($conditions, MCPE_MAPS);
                    
                    //pagination config
                    $config['base_url']    = site_url('view-maps');
                    $config['uri_segment'] = 2;
                    $config['total_rows']  = $totalRec;
                    $config['per_page']    = 20;
                    
                    //styling
                    $config['num_tag_open'] = '<li class="page-item page-link">';
                    $config['num_tag_close'] = '</li>';
                    $config['cur_tag_open'] = '<li class="active page-item"><a href="javascript:void(0);" class="page-link" >';
                    $config['cur_tag_close'] = '</a></li>';
                    $config['next_link'] = '&raquo';
                    $config['prev_link'] = '&laquo';
                    $config['next_tag_open'] = '<li class="pg-next page-item page-link">';
                    $config['next_tag_close'] = '</li>';
                    $config['prev_tag_open'] = '<li class="pg-prev page-item page-link">';
                    $config['prev_tag_close'] = '</li>';
                    $config['first_tag_open'] = '<li class="page-item page-link">';
                    $config['first_tag_close'] = '</li>';
                    $config['last_tag_open'] = '<li class="page-item page-link">';
                    $config['last_tag_close'] = '</li>';
                    
                    //initialize pagination library
                    $this->pagination->initialize($config);
                    
                    //define offset
                    $page = $this->uri->segment(2);
                    $offset = !$page?0:$page;
                    
                    //get rows
                    $conditions['returnType'] = '';
                    $conditions['start'] = $offset;
                    $conditions['limit'] = 20;

                    $maps = $this->DataModel->viewMapsData($conditions, MCPE_MAPS);
                    $data['viewMaps'] = array();
                    
                    if (is_array($maps) || is_object($maps)){
                        foreach($maps as $Row){
                            $dataArray = array();
                            $dataArray['unique_id'] = $Row['unique_id'];
                            $dataArray['category_id'] = $Row['category_id'];
                            $dataArray['data_name'] = $Row['data_name'];
                            $dataArray['data_description'] = $Row['data_description'];
                            $dataArray['data_image'] = $Row['data_image'];
                            $dataArray['data_bundle'] = $Row['data_bundle'];
                            $dataArray['data_support_version'] = $Row['data_support_version'];
                            $dataArray['data_price'] = $Row['data_price'];
                            $dataArray['data_size'] = $Row['data_size'];
                            $dataArray['data_view'] = $Row['data_view'];
                            $dataArray['data_download'] = $Row['data_download'];
                            $dataArray['data_status'] = $Row['data_status'];
                            $dataArray['categoryData'] = $this->DataModel->getData('category_id = '.$dataArray['category_id'], MCPE_CATEGORY_MAPS);

                            array_push($data['viewMaps'], $dataArray);
                        }
                    }

                    if($data['viewMaps'] != null){
                        $this->load->view('header');
                        $this->load->view('android/maps_view',$data);
                        $this->load->view('footer');
                    } else {
                        $this->session->unset_userdata('session_maps_view');   
                        $data['msg'] = array(
                            'data_title'=>"Maps Database is Empty",
                            'data_description'=>"Please add maps & redirect maps from the below button.",
                            'button_link'=>"new-maps",
                            'button_text'=>"New Maps",
                            'button_link1'=>'view-maps',
                            'button_text1'=>"View Maps",
                        );
                        $this->load->view('header');
                        $this->load->view('nodata', $data);
                        $this->load->view('footer');
                    }
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

    public function mapsEdit($uniqueID = 0){
        $isLogin = $this->checkAuth();
        if($isLogin == "True"){
            if(!empty($this->session->userdata['user_role'])) { 
                if($this->session->userdata['user_role'] == "Administrator" or $this->session->userdata['user_role'] == "Editor") {
                    $checkEncryption = $this->DataModel->checkEncrypt($uniqueID,ENCRYPT_TABLE);
                    if($checkEncryption){
                        $uniqueID = $checkEncryption->enc_number;
                    }
                   
                    if(ctype_digit($uniqueID)){
                        $data['mapsData'] = $this->DataModel->getData('unique_id = '.$uniqueID, MCPE_MAPS);
                        $data['viewCategoryMaps'] = $this->DataModel->viewData('category_id '.'DESC', null, MCPE_CATEGORY_MAPS);
                        $categoryID = $data['mapsData']->category_id;
                        $data['categoryMapsData'] = $this->DataModel->getData('category_id = '.$categoryID, MCPE_CATEGORY_MAPS);
                        if(!empty($data['mapsData'])){
                            $this->load->view('header');
                            $this->load->view('android/maps_edit',$data);
                            $this->load->view('footer');
                        } else {
                            redirect('error');
                        }
                        if($this->input->post('submit')){
                            date_default_timezone_set("Asia/Kolkata");
                            $s3Client = $this->getconfig();
                            $uniqueCode = $this->uniqueKey();
                            
                            $imageKey = $data['mapsData']->data_image;
                            $newImageKey = basename($imageKey);
                    
                            $bundleKey = $data['mapsData']->data_bundle;
                            $newBundleKey = basename($bundleKey);

                            if (!empty($_FILES['data_image']['name']) and !empty($_FILES['data_bundle']['name'])){
                                $deleteImage = $s3Client->deleteObject([
                                        'Bucket' => BUCKET_NAME,
                                        'Key'    => DATA_IMAGE.$newImageKey,
                                    ]);
                                $deleteBundle = $s3Client->deleteObject([
                                        'Bucket' => BUCKET_NAME,
                                        'Key'    => DATA_BUNDLE.$newBundleKey,
                                    ]);
                                
                                $imageName = $_FILES['data_image']['name'];
                                $imageTemp = $_FILES['data_image']['tmp_name'];
                                $imagePath = DATA_IMAGE;
                                $imageResponse = $this->newBucketObject($imageName, $uniqueCode, $imageTemp, $imagePath);

                                $bundleName = $_FILES['data_bundle']['name'];
                                $bundleTemp = $_FILES['data_bundle']['tmp_name'];
                                $bundlePath = DATA_BUNDLE;
                                $bundleResponse = $this->newBucketObject($bundleName, $uniqueCode, $bundleTemp, $bundlePath);

                                $editData = array(
                                    'category_id'=>$this->input->post('category_id'),
                                    'data_name'=>$this->input->post('data_name'),
                                    'data_description'=>$this->input->post('data_description'),
                                    'data_image'=>$imageResponse,
                                    'data_bundle'=>$bundleResponse,
                                    'data_support_version'=>$this->input->post('data_support_version'),
                                    'data_price'=>$this->input->post('data_price'),
                                    'data_size'=>$this->input->post('data_size'),
                                    'data_view'=>$this->input->post('data_view'),
                                    'data_download'=>$this->input->post('data_download'),
                                    'data_status'=>$this->input->post('data_status'),
                                );
                            } else if(!empty($_FILES['data_image']['name'])) {
                                $deleteImage = $s3Client->deleteObject([
                                            'Bucket' => BUCKET_NAME,
                                            'Key'    => DATA_IMAGE.$newImageKey,
                                        ]);
                    
                                $imageName = $_FILES['data_image']['name'];
                                $imageTemp = $_FILES['data_image']['tmp_name'];
                                $imagePath = DATA_IMAGE;
                                $imageResponse = $this->newBucketObject($imageName, $uniqueCode, $imageTemp, $imagePath);
                    
                                $editData = array(
                                    'category_id'=>$this->input->post('category_id'),
                                    'data_name'=>$this->input->post('data_name'),
                                    'data_description'=>$this->input->post('data_description'),
                                    'data_image'=>$imageResponse,
                                    'data_support_version'=>$this->input->post('data_support_version'),
                                    'data_price'=>$this->input->post('data_price'),
                                    'data_size'=>$this->input->post('data_size'),
                                    'data_view'=>$this->input->post('data_view'),
                                    'data_download'=>$this->input->post('data_download'),
                                    'data_status'=>$this->input->post('data_status'),
                                );
                            } else if(!empty($_FILES['data_bundle']['name'])) {
                                $deleteBundle = $s3Client->deleteObject([
                                        'Bucket' => BUCKET_NAME,
                                        'Key'    => DATA_BUNDLE.$newBundleKey,
                                    ]);
                                
                                $bundleName = $_FILES['data_bundle']['name'];
                                $bundleTemp = $_FILES['data_bundle']['tmp_name'];
                                $bundlePath = DATA_BUNDLE;
                                $bundleResponse = $this->newBucketObject($bundleName, $uniqueCode, $bundleTemp, $bundlePath);
                                
                                $editData = array(
                                    'category_id'=>$this->input->post('category_id'),
                                    'data_name'=>$this->input->post('data_name'),
                                    'data_description'=>$this->input->post('data_description'),
                                    'data_bundle'=>$bundleResponse,
                                    'data_support_version'=>$this->input->post('data_support_version'),
                                    'data_price'=>$this->input->post('data_price'),
                                    'data_size'=>$this->input->post('data_size'),
                                    'data_view'=>$this->input->post('data_view'),
                                    'data_download'=>$this->input->post('data_download'),
                                    'data_status'=>$this->input->post('data_status'),
                                );
                            } else {
                                $editData = array(
                                    'category_id'=>$this->input->post('category_id'),
                                    'data_name'=>$this->input->post('data_name'),
                                    'data_description'=>$this->input->post('data_description'),
                                    'data_support_version'=>$this->input->post('data_support_version'),
                                    'data_price'=>$this->input->post('data_price'),
                                    'data_size'=>$this->input->post('data_size'),
                                    'data_view'=>$this->input->post('data_view'),
                                    'data_download'=>$this->input->post('data_download'),
                                    'data_status'=>$this->input->post('data_status'),
                                );
                            }
                            $editDataEntry = $this->DataModel->editData('unique_id = '.$uniqueID, MCPE_MAPS, $editData);
                            if($editDataEntry){
                                redirect('view-maps');
                            }
                        }
                    } else {
                        redirect('error');
                    }
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

    // Seeds Functions
    public function seedsNew(){
        $isLogin = $this->checkAuth();
        if($isLogin == "True"){
            if(!empty($this->session->userdata['user_role'])) { 
                if($this->session->userdata['user_role'] == "Administrator" or $this->session->userdata['user_role'] == "Editor") {
                    date_default_timezone_set("Asia/Kolkata");
                    $s3Client = $this->getconfig();
                    $uniqueCode = $this->uniqueKey();
                    $this->form_validation->set_rules('category_id', 'Text', 'required');
                    $this->form_validation->set_rules('data_name', 'Text', 'required');
                    $this->form_validation->set_rules('data_description', 'Text', 'required');
                    $this->form_validation->set_rules('data_support_version', 'Text', 'required');
                    $this->form_validation->set_rules('data_price', 'Text', 'required');
                    $this->form_validation->set_rules('data_size', 'Text', 'required');
                    $this->form_validation->set_rules('data_view', 'Text', 'required');
                    $this->form_validation->set_rules('data_download', 'Text', 'required');

                    if (empty($_FILES['data_image']['name'])){
                        $this->form_validation->set_rules('data_image', 'Data Image', 'required');
                    }
                    $this->form_validation->set_error_delimiters('','');

                    if (empty($_FILES['data_bundle']['name'])){
                        $this->form_validation->set_rules('data_bundle', 'Data Bundle', 'required');
                    }
                    $this->form_validation->set_error_delimiters('','');
                    
                    if ($this->form_validation->run() == FALSE){
                        $data['categorySeedsData'] = $this->DataModel->viewData('category_id '.'DESC', null, MCPE_CATEGORY_SEEDS);
                        $data['error'] = "";
                        $this->load->view('header');
                        $this->load->view('android/seeds_new',$data);
                        $this->load->view('footer');
                    }else{

                        $imageName = $_FILES['data_image']['name'];
                        $imageTemp = $_FILES['data_image']['tmp_name'];
                        $imagePath = DATA_IMAGE;
                        $imageResponse = $this->newBucketObject($imageName, $uniqueCode, $imageTemp, $imagePath);

                        $bundleName = $_FILES['data_bundle']['name'];
                        $bundleTemp = $_FILES['data_bundle']['tmp_name'];
                        $bundlePath = DATA_BUNDLE;
                        $bundleResponse = $this->newBucketObject($bundleName, $uniqueCode, $bundleTemp, $bundlePath);
                        
                        $newData = array(
                            'category_id'=>$this->input->post('category_id'),
                            'data_name'=>$this->input->post('data_name'),
                            'data_description'=>$this->input->post('data_description'),
                            'data_image'=>$imageResponse,
                            'data_bundle'=>$bundleResponse,
                            'data_support_version'=>$this->input->post('data_support_version'),
                            'data_price'=>$this->input->post('data_price'),
                            'data_size'=>$this->input->post('data_size'),
                            'data_view'=>$this->input->post('data_view'),
                            'data_download'=>$this->input->post('data_download'),
                            'data_status'=>$this->input->post('data_status'),
                        );
                        $newDataEntry = $this->DataModel->insertData(MCPE_SEEDS, $newData);
                        if($newDataEntry){
                          redirect('view-seeds');  
                        }
                    }
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

    public function seedsView(){
        $isLogin = $this->checkAuth();
        if($isLogin == "True"){
            if(!empty($this->session->userdata['user_role'])) { 
                if($this->session->userdata['user_role'] == "Administrator" or $this->session->userdata['user_role'] == "Editor") {

                    if(isset($_POST['reset'])){
                        $this->session->unset_userdata('session_seeds_view');
                    }
                    if(isset($_POST['search'])){
                        $searchSeedsView = $this->input->post('search_seeds_view');
                        $this->session->set_userdata('session_seeds_view',$searchSeedsView);
                    }
                    $sessionSeedsView =  $this->session->userdata('session_seeds_view');
                   
                    $data = array();
                    //get rows count
                    $conditions['search_seeds_view'] = $sessionSeedsView;
                    $conditions['returnType'] = 'count';
                    $totalRec = $this->DataModel->viewSeedsData($conditions, MCPE_SEEDS);
                    
                    //pagination config
                    $config['base_url']    = site_url('view-seeds');
                    $config['uri_segment'] = 2;
                    $config['total_rows']  = $totalRec;
                    $config['per_page']    = 20;
                    
                    //styling
                    $config['num_tag_open'] = '<li class="page-item page-link">';
                    $config['num_tag_close'] = '</li>';
                    $config['cur_tag_open'] = '<li class="active page-item"><a href="javascript:void(0);" class="page-link" >';
                    $config['cur_tag_close'] = '</a></li>';
                    $config['next_link'] = '&raquo';
                    $config['prev_link'] = '&laquo';
                    $config['next_tag_open'] = '<li class="pg-next page-item page-link">';
                    $config['next_tag_close'] = '</li>';
                    $config['prev_tag_open'] = '<li class="pg-prev page-item page-link">';
                    $config['prev_tag_close'] = '</li>';
                    $config['first_tag_open'] = '<li class="page-item page-link">';
                    $config['first_tag_close'] = '</li>';
                    $config['last_tag_open'] = '<li class="page-item page-link">';
                    $config['last_tag_close'] = '</li>';
                    
                    //initialize pagination library
                    $this->pagination->initialize($config);
                    
                    //define offset
                    $page = $this->uri->segment(2);
                    $offset = !$page?0:$page;
                    
                    //get rows
                    $conditions['returnType'] = '';
                    $conditions['start'] = $offset;
                    $conditions['limit'] = 20;

                    $seeds = $this->DataModel->viewSeedsData($conditions, MCPE_SEEDS);
                    $data['viewSeeds'] = array();
                    
                    if (is_array($seeds) || is_object($seeds)){
                        foreach($seeds as $Row){
                            $dataArray = array();
                            $dataArray['unique_id'] = $Row['unique_id'];
                            $dataArray['category_id'] = $Row['category_id'];
                            $dataArray['data_name'] = $Row['data_name'];
                            $dataArray['data_description'] = $Row['data_description'];
                            $dataArray['data_image'] = $Row['data_image'];
                            $dataArray['data_bundle'] = $Row['data_bundle'];
                            $dataArray['data_support_version'] = $Row['data_support_version'];
                            $dataArray['data_price'] = $Row['data_price'];
                            $dataArray['data_size'] = $Row['data_size'];
                            $dataArray['data_view'] = $Row['data_view'];
                            $dataArray['data_download'] = $Row['data_download'];
                            $dataArray['data_status'] = $Row['data_status'];
                            $dataArray['categoryData'] = $this->DataModel->getData('category_id = '.$dataArray['category_id'], MCPE_CATEGORY_SEEDS);

                            array_push($data['viewSeeds'], $dataArray);
                        }
                    }

                    if($data['viewSeeds'] != null){
                        $this->load->view('header');
                        $this->load->view('android/seeds_view',$data);
                        $this->load->view('footer');
                    } else {
                        $this->session->unset_userdata('session_seeds_view');   
                        $data['msg'] = array(
                            'data_title'=>"Seeds Database is Empty",
                            'data_description'=>"Please add seeds & redirect seeds from the below button.",
                            'button_link'=>"new-seeds",
                            'button_text'=>"New Seeds",
                            'button_link1'=>'view-seeds',
                            'button_text1'=>"View Seeds",
                        );
                        $this->load->view('header');
                        $this->load->view('nodata', $data);
                        $this->load->view('footer');
                    }
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

    public function seedsEdit($uniqueID = 0){
        $isLogin = $this->checkAuth();
        if($isLogin == "True"){
            if(!empty($this->session->userdata['user_role'])) { 
                if($this->session->userdata['user_role'] == "Administrator" or $this->session->userdata['user_role'] == "Editor") {
                    $checkEncryption = $this->DataModel->checkEncrypt($uniqueID,ENCRYPT_TABLE);
                    if($checkEncryption){
                        $uniqueID = $checkEncryption->enc_number;
                    }
                   
                    if(ctype_digit($uniqueID)){
                        $data['seedsData'] = $this->DataModel->getData('unique_id = '.$uniqueID, MCPE_SEEDS);
                        $data['viewCategorySeeds'] = $this->DataModel->viewData('category_id '.'DESC', null, MCPE_CATEGORY_SEEDS);
                        $categoryID = $data['seedsData']->category_id;
                        $data['categorySeedsData'] = $this->DataModel->getData('category_id = '.$categoryID, MCPE_CATEGORY_SEEDS);
                        if(!empty($data['seedsData'])){
                            $this->load->view('header');
                            $this->load->view('android/seeds_edit',$data);
                            $this->load->view('footer');
                        } else {
                            redirect('error');
                        }
                        if($this->input->post('submit')){
                            date_default_timezone_set("Asia/Kolkata");
                            $s3Client = $this->getconfig();
                            $uniqueCode = $this->uniqueKey();
                            
                            $imageKey = $data['seedsData']->data_image;
                            $newImageKey = basename($imageKey);
                    
                            $bundleKey = $data['seedsData']->data_bundle;
                            $newBundleKey = basename($bundleKey);

                            if (!empty($_FILES['data_image']['name']) and !empty($_FILES['data_bundle']['name'])){
                                $deleteImage = $s3Client->deleteObject([
                                        'Bucket' => BUCKET_NAME,
                                        'Key'    => DATA_IMAGE.$newImageKey,
                                    ]);
                                $deleteBundle = $s3Client->deleteObject([
                                        'Bucket' => BUCKET_NAME,
                                        'Key'    => DATA_BUNDLE.$newBundleKey,
                                    ]);
                                
                                $imageName = $_FILES['data_image']['name'];
                                $imageTemp = $_FILES['data_image']['tmp_name'];
                                $imagePath = DATA_IMAGE;
                                $imageResponse = $this->newBucketObject($imageName, $uniqueCode, $imageTemp, $imagePath);

                                $bundleName = $_FILES['data_bundle']['name'];
                                $bundleTemp = $_FILES['data_bundle']['tmp_name'];
                                $bundlePath = DATA_BUNDLE;
                                $bundleResponse = $this->newBucketObject($bundleName, $uniqueCode, $bundleTemp, $bundlePath);

                                $editData = array(
                                    'category_id'=>$this->input->post('category_id'),
                                    'data_name'=>$this->input->post('data_name'),
                                    'data_description'=>$this->input->post('data_description'),
                                    'data_image'=>$imageResponse,
                                    'data_bundle'=>$bundleResponse,
                                    'data_support_version'=>$this->input->post('data_support_version'),
                                    'data_price'=>$this->input->post('data_price'),
                                    'data_size'=>$this->input->post('data_size'),
                                    'data_view'=>$this->input->post('data_view'),
                                    'data_download'=>$this->input->post('data_download'),
                                    'data_status'=>$this->input->post('data_status'),
                                );
                            } else if(!empty($_FILES['data_image']['name'])) {
                                $deleteImage = $s3Client->deleteObject([
                                            'Bucket' => BUCKET_NAME,
                                            'Key'    => DATA_IMAGE.$newImageKey,
                                        ]);
                    
                                $imageName = $_FILES['data_image']['name'];
                                $imageTemp = $_FILES['data_image']['tmp_name'];
                                $imagePath = DATA_IMAGE;
                                $imageResponse = $this->newBucketObject($imageName, $uniqueCode, $imageTemp, $imagePath);
                    
                                $editData = array(
                                    'category_id'=>$this->input->post('category_id'),
                                    'data_name'=>$this->input->post('data_name'),
                                    'data_description'=>$this->input->post('data_description'),
                                    'data_image'=>$imageResponse,
                                    'data_support_version'=>$this->input->post('data_support_version'),
                                    'data_price'=>$this->input->post('data_price'),
                                    'data_size'=>$this->input->post('data_size'),
                                    'data_view'=>$this->input->post('data_view'),
                                    'data_download'=>$this->input->post('data_download'),
                                    'data_status'=>$this->input->post('data_status'),
                                );
                            } else if(!empty($_FILES['data_bundle']['name'])) {
                                $deleteBundle = $s3Client->deleteObject([
                                        'Bucket' => BUCKET_NAME,
                                        'Key'    => DATA_BUNDLE.$newBundleKey,
                                    ]);
                                
                                $bundleName = $_FILES['data_bundle']['name'];
                                $bundleTemp = $_FILES['data_bundle']['tmp_name'];
                                $bundlePath = DATA_BUNDLE;
                                $bundleResponse = $this->newBucketObject($bundleName, $uniqueCode, $bundleTemp, $bundlePath);
                                
                                $editData = array(
                                    'category_id'=>$this->input->post('category_id'),
                                    'data_name'=>$this->input->post('data_name'),
                                    'data_description'=>$this->input->post('data_description'),
                                    'data_bundle'=>$bundleResponse,
                                    'data_support_version'=>$this->input->post('data_support_version'),
                                    'data_price'=>$this->input->post('data_price'),
                                    'data_size'=>$this->input->post('data_size'),
                                    'data_view'=>$this->input->post('data_view'),
                                    'data_download'=>$this->input->post('data_download'),
                                    'data_status'=>$this->input->post('data_status'),
                                );
                            } else {
                                $editData = array(
                                    'category_id'=>$this->input->post('category_id'),
                                    'data_name'=>$this->input->post('data_name'),
                                    'data_description'=>$this->input->post('data_description'),
                                    'data_support_version'=>$this->input->post('data_support_version'),
                                    'data_price'=>$this->input->post('data_price'),
                                    'data_size'=>$this->input->post('data_size'),
                                    'data_view'=>$this->input->post('data_view'),
                                    'data_download'=>$this->input->post('data_download'),
                                    'data_status'=>$this->input->post('data_status'),
                                );
                            }
                            $editDataEntry = $this->DataModel->editData('unique_id = '.$uniqueID, MCPE_SEEDS, $editData);
                            if($editDataEntry){
                                redirect('view-seeds');
                            }
                        }
                    } else {
                        redirect('error');
                    }
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

    // Textures Functions
    public function texturesNew(){
        $isLogin = $this->checkAuth();
        if($isLogin == "True"){
            if(!empty($this->session->userdata['user_role'])) { 
                if($this->session->userdata['user_role'] == "Administrator" or $this->session->userdata['user_role'] == "Editor") {
                    date_default_timezone_set("Asia/Kolkata");
                    $s3Client = $this->getconfig();
                    $uniqueCode = $this->uniqueKey();
                    $this->form_validation->set_rules('category_id', 'Text', 'required');
                    $this->form_validation->set_rules('data_name', 'Text', 'required');
                    $this->form_validation->set_rules('data_description', 'Text', 'required');
                    $this->form_validation->set_rules('data_support_version', 'Text', 'required');
                    $this->form_validation->set_rules('data_price', 'Text', 'required');
                    $this->form_validation->set_rules('data_size', 'Text', 'required');
                    $this->form_validation->set_rules('data_view', 'Text', 'required');
                    $this->form_validation->set_rules('data_download', 'Text', 'required');

                    if (empty($_FILES['data_image']['name'])){
                        $this->form_validation->set_rules('data_image', 'Data Image', 'required');
                    }
                    $this->form_validation->set_error_delimiters('','');

                    if (empty($_FILES['data_bundle']['name'])){
                        $this->form_validation->set_rules('data_bundle', 'Data Bundle', 'required');
                    }
                    $this->form_validation->set_error_delimiters('','');
                    
                    if ($this->form_validation->run() == FALSE){
                        $data['categoryTexturesData'] = $this->DataModel->viewData('category_id '.'DESC', null, MCPE_CATEGORY_TEXTURES);
                        $data['error'] = "";
                        $this->load->view('header');
                        $this->load->view('android/textures_new',$data);
                        $this->load->view('footer');
                    }else{

                        $imageName = $_FILES['data_image']['name'];
                        $imageTemp = $_FILES['data_image']['tmp_name'];
                        $imagePath = DATA_IMAGE;
                        $imageResponse = $this->newBucketObject($imageName, $uniqueCode, $imageTemp, $imagePath);

                        $bundleName = $_FILES['data_bundle']['name'];
                        $bundleTemp = $_FILES['data_bundle']['tmp_name'];
                        $bundlePath = DATA_BUNDLE;
                        $bundleResponse = $this->newBucketObject($bundleName, $uniqueCode, $bundleTemp, $bundlePath);
                        
                        $newData = array(
                            'category_id'=>$this->input->post('category_id'),
                            'data_name'=>$this->input->post('data_name'),
                            'data_description'=>$this->input->post('data_description'),
                            'data_image'=>$imageResponse,
                            'data_bundle'=>$bundleResponse,
                            'data_support_version'=>$this->input->post('data_support_version'),
                            'data_price'=>$this->input->post('data_price'),
                            'data_size'=>$this->input->post('data_size'),
                            'data_view'=>$this->input->post('data_view'),
                            'data_download'=>$this->input->post('data_download'),
                            'data_status'=>$this->input->post('data_status'),
                        );
                        $newDataEntry = $this->DataModel->insertData(MCPE_TEXTURES, $newData);
                        if($newDataEntry){
                          redirect('view-textures');  
                        }
                    }
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

    public function texturesView(){
        $isLogin = $this->checkAuth();
        if($isLogin == "True"){
            if(!empty($this->session->userdata['user_role'])) { 
                if($this->session->userdata['user_role'] == "Administrator" or $this->session->userdata['user_role'] == "Editor") {

                    if(isset($_POST['reset'])){
                        $this->session->unset_userdata('session_textures_view');
                    }
                    if(isset($_POST['search'])){
                        $searchTexturesView = $this->input->post('search_textures_view');
                        $this->session->set_userdata('session_textures_view',$searchTexturesView);
                    }
                    $sessionTexturesView =  $this->session->userdata('session_textures_view');
                   
                    $data = array();
                    //get rows count
                    $conditions['search_textures_view'] = $sessionTexturesView;
                    $conditions['returnType'] = 'count';
                    $totalRec = $this->DataModel->viewTexturesData($conditions, MCPE_TEXTURES);
                    
                    //pagination config
                    $config['base_url']    = site_url('view-textures');
                    $config['uri_segment'] = 2;
                    $config['total_rows']  = $totalRec;
                    $config['per_page']    = 20;
                    
                    //styling
                    $config['num_tag_open'] = '<li class="page-item page-link">';
                    $config['num_tag_close'] = '</li>';
                    $config['cur_tag_open'] = '<li class="active page-item"><a href="javascript:void(0);" class="page-link" >';
                    $config['cur_tag_close'] = '</a></li>';
                    $config['next_link'] = '&raquo';
                    $config['prev_link'] = '&laquo';
                    $config['next_tag_open'] = '<li class="pg-next page-item page-link">';
                    $config['next_tag_close'] = '</li>';
                    $config['prev_tag_open'] = '<li class="pg-prev page-item page-link">';
                    $config['prev_tag_close'] = '</li>';
                    $config['first_tag_open'] = '<li class="page-item page-link">';
                    $config['first_tag_close'] = '</li>';
                    $config['last_tag_open'] = '<li class="page-item page-link">';
                    $config['last_tag_close'] = '</li>';
                    
                    //initialize pagination library
                    $this->pagination->initialize($config);
                    
                    //define offset
                    $page = $this->uri->segment(2);
                    $offset = !$page?0:$page;
                    
                    //get rows
                    $conditions['returnType'] = '';
                    $conditions['start'] = $offset;
                    $conditions['limit'] = 20;

                    $textures = $this->DataModel->viewTexturesData($conditions, MCPE_TEXTURES);
                    $data['viewTextures'] = array();
                    
                    if (is_array($textures) || is_object($textures)){
                        foreach($textures as $Row){
                            $dataArray = array();
                            $dataArray['unique_id'] = $Row['unique_id'];
                            $dataArray['category_id'] = $Row['category_id'];
                            $dataArray['data_name'] = $Row['data_name'];
                            $dataArray['data_description'] = $Row['data_description'];
                            $dataArray['data_image'] = $Row['data_image'];
                            $dataArray['data_bundle'] = $Row['data_bundle'];
                            $dataArray['data_support_version'] = $Row['data_support_version'];
                            $dataArray['data_price'] = $Row['data_price'];
                            $dataArray['data_size'] = $Row['data_size'];
                            $dataArray['data_view'] = $Row['data_view'];
                            $dataArray['data_download'] = $Row['data_download'];
                            $dataArray['data_status'] = $Row['data_status'];
                            $dataArray['categoryData'] = $this->DataModel->getData('category_id = '.$dataArray['category_id'], MCPE_CATEGORY_TEXTURES);

                            array_push($data['viewTextures'], $dataArray);
                        }
                    }

                    if($data['viewTextures'] != null){
                        $this->load->view('header');
                        $this->load->view('android/textures_view',$data);
                        $this->load->view('footer');
                    } else {
                        $this->session->unset_userdata('session_textures_view');  
                        $data['msg'] = array(
                            'data_title'=>"Textures Database is Empty",
                            'data_description'=>"Please add textures & redirect textures from the below button.",
                            'button_link'=>"new-textures",
                            'button_text'=>"New Textures",
                            'button_link1'=>'view-textures',
                            'button_text1'=>"View Textures",
                        );
                        $this->load->view('header');
                        $this->load->view('nodata', $data);
                        $this->load->view('footer');
                    }
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

    public function texturesEdit($uniqueID = 0){
        $isLogin = $this->checkAuth();
        if($isLogin == "True"){
            if(!empty($this->session->userdata['user_role'])) { 
                if($this->session->userdata['user_role'] == "Administrator" or $this->session->userdata['user_role'] == "Editor") {
                    $checkEncryption = $this->DataModel->checkEncrypt($uniqueID,ENCRYPT_TABLE);
                    if($checkEncryption){
                        $uniqueID = $checkEncryption->enc_number;
                    }
                   
                    if(ctype_digit($uniqueID)){
                        $data['texturesData'] = $this->DataModel->getData('unique_id = '.$uniqueID, MCPE_TEXTURES);
                        $data['viewCategoryTextures'] = $this->DataModel->viewData('category_id '.'DESC', null, MCPE_CATEGORY_TEXTURES);
                        $categoryID = $data['texturesData']->category_id;
                        $data['categoryTexturesData'] = $this->DataModel->getData('category_id = '.$categoryID, MCPE_CATEGORY_TEXTURES);
                        if(!empty($data['texturesData'])){
                            $this->load->view('header');
                            $this->load->view('android/textures_edit',$data);
                            $this->load->view('footer');
                        } else {
                            redirect('error');
                        }
                        if($this->input->post('submit')){
                            date_default_timezone_set("Asia/Kolkata");
                            $s3Client = $this->getconfig();
                            $uniqueCode = $this->uniqueKey();
                            
                            $imageKey = $data['texturesData']->data_image;
                            $newImageKey = basename($imageKey);
                    
                            $bundleKey = $data['texturesData']->data_bundle;
                            $newBundleKey = basename($bundleKey);

                            if (!empty($_FILES['data_image']['name']) and !empty($_FILES['data_bundle']['name'])){
                                $deleteImage = $s3Client->deleteObject([
                                        'Bucket' => BUCKET_NAME,
                                        'Key'    => DATA_IMAGE.$newImageKey,
                                    ]);
                                $deleteBundle = $s3Client->deleteObject([
                                        'Bucket' => BUCKET_NAME,
                                        'Key'    => DATA_BUNDLE.$newBundleKey,
                                    ]);
                                
                                $imageName = $_FILES['data_image']['name'];
                                $imageTemp = $_FILES['data_image']['tmp_name'];
                                $imagePath = DATA_IMAGE;
                                $imageResponse = $this->newBucketObject($imageName, $uniqueCode, $imageTemp, $imagePath);

                                $bundleName = $_FILES['data_bundle']['name'];
                                $bundleTemp = $_FILES['data_bundle']['tmp_name'];
                                $bundlePath = DATA_BUNDLE;
                                $bundleResponse = $this->newBucketObject($bundleName, $uniqueCode, $bundleTemp, $bundlePath);

                                $editData = array(
                                    'category_id'=>$this->input->post('category_id'),
                                    'data_name'=>$this->input->post('data_name'),
                                    'data_description'=>$this->input->post('data_description'),
                                    'data_image'=>$imageResponse,
                                    'data_bundle'=>$bundleResponse,
                                    'data_support_version'=>$this->input->post('data_support_version'),
                                    'data_price'=>$this->input->post('data_price'),
                                    'data_size'=>$this->input->post('data_size'),
                                    'data_view'=>$this->input->post('data_view'),
                                    'data_download'=>$this->input->post('data_download'),
                                    'data_status'=>$this->input->post('data_status'),
                                );
                            } else if(!empty($_FILES['data_image']['name'])) {
                                $deleteImage = $s3Client->deleteObject([
                                            'Bucket' => BUCKET_NAME,
                                            'Key'    => DATA_IMAGE.$newImageKey,
                                        ]);
                    
                                $imageName = $_FILES['data_image']['name'];
                                $imageTemp = $_FILES['data_image']['tmp_name'];
                                $imagePath = DATA_IMAGE;
                                $imageResponse = $this->newBucketObject($imageName, $uniqueCode, $imageTemp, $imagePath);
                    
                                $editData = array(
                                    'category_id'=>$this->input->post('category_id'),
                                    'data_name'=>$this->input->post('data_name'),
                                    'data_description'=>$this->input->post('data_description'),
                                    'data_image'=>$imageResponse,
                                    'data_support_version'=>$this->input->post('data_support_version'),
                                    'data_price'=>$this->input->post('data_price'),
                                    'data_size'=>$this->input->post('data_size'),
                                    'data_view'=>$this->input->post('data_view'),
                                    'data_download'=>$this->input->post('data_download'),
                                    'data_status'=>$this->input->post('data_status'),
                                );
                            } else if(!empty($_FILES['data_bundle']['name'])) {
                                $deleteBundle = $s3Client->deleteObject([
                                        'Bucket' => BUCKET_NAME,
                                        'Key'    => DATA_BUNDLE.$newBundleKey,
                                    ]);
                                
                                $bundleName = $_FILES['data_bundle']['name'];
                                $bundleTemp = $_FILES['data_bundle']['tmp_name'];
                                $bundlePath = DATA_BUNDLE;
                                $bundleResponse = $this->newBucketObject($bundleName, $uniqueCode, $bundleTemp, $bundlePath);
                                
                                $editData = array(
                                    'category_id'=>$this->input->post('category_id'),
                                    'data_name'=>$this->input->post('data_name'),
                                    'data_description'=>$this->input->post('data_description'),
                                    'data_bundle'=>$bundleResponse,
                                    'data_support_version'=>$this->input->post('data_support_version'),
                                    'data_price'=>$this->input->post('data_price'),
                                    'data_size'=>$this->input->post('data_size'),
                                    'data_view'=>$this->input->post('data_view'),
                                    'data_download'=>$this->input->post('data_download'),
                                    'data_status'=>$this->input->post('data_status'),
                                );
                            } else {
                                $editData = array(
                                    'category_id'=>$this->input->post('category_id'),
                                    'data_name'=>$this->input->post('data_name'),
                                    'data_description'=>$this->input->post('data_description'),
                                    'data_support_version'=>$this->input->post('data_support_version'),
                                    'data_price'=>$this->input->post('data_price'),
                                    'data_size'=>$this->input->post('data_size'),
                                    'data_view'=>$this->input->post('data_view'),
                                    'data_download'=>$this->input->post('data_download'),
                                    'data_status'=>$this->input->post('data_status'),
                                );
                            }
                            $editDataEntry = $this->DataModel->editData('unique_id = '.$uniqueID, MCPE_TEXTURES, $editData);
                            if($editDataEntry){
                                redirect('view-textures');
                            }
                        }
                    } else {
                        redirect('error');
                    }
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

    // Shaders Functions
    public function shadersNew(){
        $isLogin = $this->checkAuth();
        if($isLogin == "True"){
            if(!empty($this->session->userdata['user_role'])) { 
                if($this->session->userdata['user_role'] == "Administrator" or $this->session->userdata['user_role'] == "Editor") {
                    date_default_timezone_set("Asia/Kolkata");
                    $s3Client = $this->getconfig();
                    $uniqueCode = $this->uniqueKey();
                    $this->form_validation->set_rules('category_id', 'Text', 'required');
                    $this->form_validation->set_rules('data_name', 'Text', 'required');
                    $this->form_validation->set_rules('data_description', 'Text', 'required');
                    $this->form_validation->set_rules('data_support_version', 'Text', 'required');
                    $this->form_validation->set_rules('data_price', 'Text', 'required');
                    $this->form_validation->set_rules('data_size', 'Text', 'required');
                    $this->form_validation->set_rules('data_view', 'Text', 'required');
                    $this->form_validation->set_rules('data_download', 'Text', 'required');

                    if (empty($_FILES['data_image']['name'])){
                        $this->form_validation->set_rules('data_image', 'Data Image', 'required');
                    }
                    $this->form_validation->set_error_delimiters('','');

                    if (empty($_FILES['data_bundle']['name'])){
                        $this->form_validation->set_rules('data_bundle', 'Data Bundle', 'required');
                    }
                    $this->form_validation->set_error_delimiters('','');
                    
                    if ($this->form_validation->run() == FALSE){
                        $data['categoryShadersData'] = $this->DataModel->viewData('category_id '.'DESC', null, MCPE_CATEGORY_SHADERS);
                        $data['error'] = "";
                        $this->load->view('header');
                        $this->load->view('android/shaders_new',$data);
                        $this->load->view('footer');
                    }else{

                        $imageName = $_FILES['data_image']['name'];
                        $imageTemp = $_FILES['data_image']['tmp_name'];
                        $imagePath = DATA_IMAGE;
                        $imageResponse = $this->newBucketObject($imageName, $uniqueCode, $imageTemp, $imagePath);

                        $bundleName = $_FILES['data_bundle']['name'];
                        $bundleTemp = $_FILES['data_bundle']['tmp_name'];
                        $bundlePath = DATA_BUNDLE;
                        $bundleResponse = $this->newBucketObject($bundleName, $uniqueCode, $bundleTemp, $bundlePath);
                        
                        $newData = array(
                            'category_id'=>$this->input->post('category_id'),
                            'data_name'=>$this->input->post('data_name'),
                            'data_description'=>$this->input->post('data_description'),
                            'data_image'=>$imageResponse,
                            'data_bundle'=>$bundleResponse,
                            'data_support_version'=>$this->input->post('data_support_version'),
                            'data_price'=>$this->input->post('data_price'),
                            'data_size'=>$this->input->post('data_size'),
                            'data_view'=>$this->input->post('data_view'),
                            'data_download'=>$this->input->post('data_download'),
                            'data_status'=>$this->input->post('data_status'),
                        );
                        $newDataEntry = $this->DataModel->insertData(MCPE_SHADERS, $newData);
                        if($newDataEntry){
                          redirect('view-shaders');  
                        }
                    }
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

    public function shadersView(){
        $isLogin = $this->checkAuth();
        if($isLogin == "True"){
            if(!empty($this->session->userdata['user_role'])) { 
                if($this->session->userdata['user_role'] == "Administrator" or $this->session->userdata['user_role'] == "Editor") {

                    if(isset($_POST['reset'])){
                        $this->session->unset_userdata('session_shaders_view');
                    }
                    if(isset($_POST['search'])){
                        $searchShadersView = $this->input->post('search_shaders_view');
                        $this->session->set_userdata('session_shaders_view',$searchShadersView);
                    }
                    $sessionShadersView =  $this->session->userdata('session_shaders_view');

                   
                    $data = array();
                    //get rows count
                    $conditions['search_shaders_view'] = $sessionShadersView;
                    $conditions['returnType'] = 'count';
                    $totalRec = $this->DataModel->viewShadersData($conditions, MCPE_SHADERS);
                    
                    //pagination config
                    $config['base_url']    = site_url('view-shaders');
                    $config['uri_segment'] = 2;
                    $config['total_rows']  = $totalRec;
                    $config['per_page']    = 20;
                    
                    //styling
                    $config['num_tag_open'] = '<li class="page-item page-link">';
                    $config['num_tag_close'] = '</li>';
                    $config['cur_tag_open'] = '<li class="active page-item"><a href="javascript:void(0);" class="page-link" >';
                    $config['cur_tag_close'] = '</a></li>';
                    $config['next_link'] = '&raquo';
                    $config['prev_link'] = '&laquo';
                    $config['next_tag_open'] = '<li class="pg-next page-item page-link">';
                    $config['next_tag_close'] = '</li>';
                    $config['prev_tag_open'] = '<li class="pg-prev page-item page-link">';
                    $config['prev_tag_close'] = '</li>';
                    $config['first_tag_open'] = '<li class="page-item page-link">';
                    $config['first_tag_close'] = '</li>';
                    $config['last_tag_open'] = '<li class="page-item page-link">';
                    $config['last_tag_close'] = '</li>';
                    
                    //initialize pagination library
                    $this->pagination->initialize($config);
                    
                    //define offset
                    $page = $this->uri->segment(2);
                    $offset = !$page?0:$page;
                    
                    //get rows
                    $conditions['returnType'] = '';
                    $conditions['start'] = $offset;
                    $conditions['limit'] = 20;

                    $shaders = $this->DataModel->viewShadersData($conditions, MCPE_SHADERS);
                    $data['viewShaders'] = array();
                    
                    if (is_array($shaders) || is_object($shaders)){
                        foreach($shaders as $Row){
                            $dataArray = array();
                            $dataArray['unique_id'] = $Row['unique_id'];
                            $dataArray['category_id'] = $Row['category_id'];
                            $dataArray['data_name'] = $Row['data_name'];
                            $dataArray['data_description'] = $Row['data_description'];
                            $dataArray['data_image'] = $Row['data_image'];
                            $dataArray['data_bundle'] = $Row['data_bundle'];
                            $dataArray['data_support_version'] = $Row['data_support_version'];
                            $dataArray['data_price'] = $Row['data_price'];
                            $dataArray['data_size'] = $Row['data_size'];
                            $dataArray['data_view'] = $Row['data_view'];
                            $dataArray['data_download'] = $Row['data_download'];
                            $dataArray['data_status'] = $Row['data_status'];
                            $dataArray['categoryData'] = $this->DataModel->getData('category_id = '.$dataArray['category_id'], MCPE_CATEGORY_SHADERS);

                            array_push($data['viewShaders'], $dataArray);
                        }
                    }

                    if($data['viewShaders'] != null){
                        $this->load->view('header');
                        $this->load->view('android/shaders_view',$data);
                        $this->load->view('footer');
                    } else {
                        $this->session->unset_userdata('session_shaders_view');
                        $data['msg'] = array(
                            'data_title'=>"Shaders Database is Empty",
                            'data_description'=>"Please add shaders & redirect shaders from the below button.",
                            'button_link'=>"new-shaders",
                            'button_text'=>"New Shaders",
                            'button_link1'=>'view-shaders',
                            'button_text1'=>"View Shaders",
                        );
                        $this->load->view('header');
                        $this->load->view('nodata', $data);
                        $this->load->view('footer');
                    }
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

    public function shadersEdit($uniqueID = 0){
        $isLogin = $this->checkAuth();
        if($isLogin == "True"){
            if(!empty($this->session->userdata['user_role'])) { 
                if($this->session->userdata['user_role'] == "Administrator" or $this->session->userdata['user_role'] == "Editor") {
                    $checkEncryption = $this->DataModel->checkEncrypt($uniqueID,ENCRYPT_TABLE);
                    if($checkEncryption){
                        $uniqueID = $checkEncryption->enc_number;
                    }
                   
                    if(ctype_digit($uniqueID)){
                        $data['shadersData'] = $this->DataModel->getData('unique_id = '.$uniqueID, MCPE_SHADERS);
                        $data['viewCategoryShaders'] = $this->DataModel->viewData('category_id '.'DESC', null, MCPE_CATEGORY_SHADERS);
                        $categoryID = $data['shadersData']->category_id;
                        $data['categoryShadersData'] = $this->DataModel->getData('category_id = '.$categoryID, MCPE_CATEGORY_SHADERS);
                        if(!empty($data['shadersData'])){
                            $this->load->view('header');
                            $this->load->view('android/shaders_edit',$data);
                            $this->load->view('footer');
                        } else {
                            redirect('error');
                        }
                        if($this->input->post('submit')){
                            date_default_timezone_set("Asia/Kolkata");
                            $s3Client = $this->getconfig();
                            $uniqueCode = $this->uniqueKey();
                            
                            $imageKey = $data['shadersData']->data_image;
                            $newImageKey = basename($imageKey);
                    
                            $bundleKey = $data['shadersData']->data_bundle;
                            $newBundleKey = basename($bundleKey);

                            if (!empty($_FILES['data_image']['name']) and !empty($_FILES['data_bundle']['name'])){
                                $deleteImage = $s3Client->deleteObject([
                                        'Bucket' => BUCKET_NAME,
                                        'Key'    => DATA_IMAGE.$newImageKey,
                                    ]);
                                $deleteBundle = $s3Client->deleteObject([
                                        'Bucket' => BUCKET_NAME,
                                        'Key'    => DATA_BUNDLE.$newBundleKey,
                                    ]);
                                
                                $imageName = $_FILES['data_image']['name'];
                                $imageTemp = $_FILES['data_image']['tmp_name'];
                                $imagePath = DATA_IMAGE;
                                $imageResponse = $this->newBucketObject($imageName, $uniqueCode, $imageTemp, $imagePath);

                                $bundleName = $_FILES['data_bundle']['name'];
                                $bundleTemp = $_FILES['data_bundle']['tmp_name'];
                                $bundlePath = DATA_BUNDLE;
                                $bundleResponse = $this->newBucketObject($bundleName, $uniqueCode, $bundleTemp, $bundlePath);

                                $editData = array(
                                    'category_id'=>$this->input->post('category_id'),
                                    'data_name'=>$this->input->post('data_name'),
                                    'data_description'=>$this->input->post('data_description'),
                                    'data_image'=>$imageResponse,
                                    'data_bundle'=>$bundleResponse,
                                    'data_support_version'=>$this->input->post('data_support_version'),
                                    'data_price'=>$this->input->post('data_price'),
                                    'data_size'=>$this->input->post('data_size'),
                                    'data_view'=>$this->input->post('data_view'),
                                    'data_download'=>$this->input->post('data_download'),
                                    'data_status'=>$this->input->post('data_status'),
                                );
                            } else if(!empty($_FILES['data_image']['name'])) {
                                $deleteImage = $s3Client->deleteObject([
                                            'Bucket' => BUCKET_NAME,
                                            'Key'    => DATA_IMAGE.$newImageKey,
                                        ]);
                    
                                $imageName = $_FILES['data_image']['name'];
                                $imageTemp = $_FILES['data_image']['tmp_name'];
                                $imagePath = DATA_IMAGE;
                                $imageResponse = $this->newBucketObject($imageName, $uniqueCode, $imageTemp, $imagePath);
                    
                                $editData = array(
                                    'category_id'=>$this->input->post('category_id'),
                                    'data_name'=>$this->input->post('data_name'),
                                    'data_description'=>$this->input->post('data_description'),
                                    'data_image'=>$imageResponse,
                                    'data_support_version'=>$this->input->post('data_support_version'),
                                    'data_price'=>$this->input->post('data_price'),
                                    'data_size'=>$this->input->post('data_size'),
                                    'data_view'=>$this->input->post('data_view'),
                                    'data_download'=>$this->input->post('data_download'),
                                    'data_status'=>$this->input->post('data_status'),
                                );
                            } else if(!empty($_FILES['data_bundle']['name'])) {
                                $deleteBundle = $s3Client->deleteObject([
                                        'Bucket' => BUCKET_NAME,
                                        'Key'    => DATA_BUNDLE.$newBundleKey,
                                    ]);
                                
                                $bundleName = $_FILES['data_bundle']['name'];
                                $bundleTemp = $_FILES['data_bundle']['tmp_name'];
                                $bundlePath = DATA_BUNDLE;
                                $bundleResponse = $this->newBucketObject($bundleName, $uniqueCode, $bundleTemp, $bundlePath);
                                
                                $editData = array(
                                    'category_id'=>$this->input->post('category_id'),
                                    'data_name'=>$this->input->post('data_name'),
                                    'data_description'=>$this->input->post('data_description'),
                                    'data_bundle'=>$bundleResponse,
                                    'data_support_version'=>$this->input->post('data_support_version'),
                                    'data_price'=>$this->input->post('data_price'),
                                    'data_size'=>$this->input->post('data_size'),
                                    'data_view'=>$this->input->post('data_view'),
                                    'data_download'=>$this->input->post('data_download'),
                                    'data_status'=>$this->input->post('data_status'),
                                );
                            } else {
                                $editData = array(
                                    'category_id'=>$this->input->post('category_id'),
                                    'data_name'=>$this->input->post('data_name'),
                                    'data_description'=>$this->input->post('data_description'),
                                    'data_support_version'=>$this->input->post('data_support_version'),
                                    'data_price'=>$this->input->post('data_price'),
                                    'data_size'=>$this->input->post('data_size'),
                                    'data_view'=>$this->input->post('data_view'),
                                    'data_download'=>$this->input->post('data_download'),
                                    'data_status'=>$this->input->post('data_status'),
                                );
                            }
                            $editDataEntry = $this->DataModel->editData('unique_id = '.$uniqueID, MCPE_SHADERS, $editData);
                            if($editDataEntry){
                                redirect('view-shaders');
                            }
                        }
                    } else {
                        redirect('error');
                    }
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
    
    // Skin Functions
    public function skinNew(){
        $isLogin = $this->checkAuth();
        if($isLogin == "True"){
            if(!empty($this->session->userdata['user_role'])) { 
                if($this->session->userdata['user_role'] == "Administrator" or $this->session->userdata['user_role'] == "Editor") {
                    date_default_timezone_set("Asia/Kolkata");
                    $s3Client = $this->getconfig();
                    $uniqueCode = $this->uniqueKey();
                    $this->form_validation->set_rules('category_id', 'Text', 'required');
                    $this->form_validation->set_rules('data_name', 'Text', 'required');
                    $this->form_validation->set_rules('data_description', 'Text', 'required');
                    $this->form_validation->set_rules('data_support_version', 'Text', 'required');
                    $this->form_validation->set_rules('data_price', 'Text', 'required');
                    $this->form_validation->set_rules('data_size', 'Text', 'required');
                    $this->form_validation->set_rules('data_view', 'Text', 'required');
                    $this->form_validation->set_rules('data_download', 'Text', 'required');

                    if (empty($_FILES['data_image']['name'])){
                        $this->form_validation->set_rules('data_image', 'Data Image', 'required');
                    }
                    $this->form_validation->set_error_delimiters('','');

                    if (empty($_FILES['data_bundle']['name'])){
                        $this->form_validation->set_rules('data_bundle', 'Data Bundle', 'required');
                    }
                    $this->form_validation->set_error_delimiters('','');
                    
                    if ($this->form_validation->run() == FALSE){
                        $data['categorySkinData'] = $this->DataModel->viewData('category_id '.'DESC', null, MCPE_CATEGORY_SKIN);
                        $data['error'] = "";
                        $this->load->view('header');
                        $this->load->view('android/skin_new',$data);
                        $this->load->view('footer');
                    }else{

                        $imageName = $_FILES['data_image']['name'];
                        $imageTemp = $_FILES['data_image']['tmp_name'];
                        $imagePath = DATA_IMAGE;
                        $imageResponse = $this->newBucketObject($imageName, $uniqueCode, $imageTemp, $imagePath);

                        $bundleName = $_FILES['data_bundle']['name'];
                        $bundleTemp = $_FILES['data_bundle']['tmp_name'];
                        $bundlePath = DATA_BUNDLE;
                        $bundleResponse = $this->newBucketObject($bundleName, $uniqueCode, $bundleTemp, $bundlePath);
                        
                        $newData = array(
                            'category_id'=>$this->input->post('category_id'),
                            'data_name'=>$this->input->post('data_name'),
                            'data_description'=>$this->input->post('data_description'),
                            'data_image'=>$imageResponse,
                            'data_bundle'=>$bundleResponse,
                            'data_support_version'=>$this->input->post('data_support_version'),
                            'data_price'=>$this->input->post('data_price'),
                            'data_size'=>$this->input->post('data_size'),
                            'data_view'=>$this->input->post('data_view'),
                            'data_download'=>$this->input->post('data_download'),
                            'data_status'=>$this->input->post('data_status'),
                        );
                        $newDataEntry = $this->DataModel->insertData(MCPE_SKIN, $newData);
                        if($newDataEntry){
                          redirect('view-skin');  
                        }
                    }
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

    public function skinView(){
        $isLogin = $this->checkAuth();
        if($isLogin == "True"){
            if(!empty($this->session->userdata['user_role'])) { 
                if($this->session->userdata['user_role'] == "Administrator" or $this->session->userdata['user_role'] == "Editor") {

                    if(isset($_POST['reset'])){
                        $this->session->unset_userdata('session_skin_view');
                    }
                    if(isset($_POST['search'])){
                        $searchSkinView = $this->input->post('search_skin_view');
                        $this->session->set_userdata('session_skin_view',$searchSkinView);
                    }
                    $sessionSkinView =  $this->session->userdata('session_skin_view');

                   
                    $data = array();
                    //get rows count
                    $conditions['search_skin_view'] = $sessionSkinView;
                    $conditions['returnType'] = 'count';
                    $totalRec = $this->DataModel->viewSkinData($conditions, MCPE_SKIN);
                    
                    //pagination config
                    $config['base_url']    = site_url('view-skin');
                    $config['uri_segment'] = 2;
                    $config['total_rows']  = $totalRec;
                    $config['per_page']    = 20;
                    
                    //styling
                    $config['num_tag_open'] = '<li class="page-item page-link">';
                    $config['num_tag_close'] = '</li>';
                    $config['cur_tag_open'] = '<li class="active page-item"><a href="javascript:void(0);" class="page-link" >';
                    $config['cur_tag_close'] = '</a></li>';
                    $config['next_link'] = '&raquo';
                    $config['prev_link'] = '&laquo';
                    $config['next_tag_open'] = '<li class="pg-next page-item page-link">';
                    $config['next_tag_close'] = '</li>';
                    $config['prev_tag_open'] = '<li class="pg-prev page-item page-link">';
                    $config['prev_tag_close'] = '</li>';
                    $config['first_tag_open'] = '<li class="page-item page-link">';
                    $config['first_tag_close'] = '</li>';
                    $config['last_tag_open'] = '<li class="page-item page-link">';
                    $config['last_tag_close'] = '</li>';
                    
                    //initialize pagination library
                    $this->pagination->initialize($config);
                    
                    //define offset
                    $page = $this->uri->segment(2);
                    $offset = !$page?0:$page;
                    
                    //get rows
                    $conditions['returnType'] = '';
                    $conditions['start'] = $offset;
                    $conditions['limit'] = 20;

                    $skin = $this->DataModel->viewSkinData($conditions, MCPE_SKIN);
                    $data['viewSkin'] = array();
                    
                    if (is_array($skin) || is_object($skin)){
                        foreach($skin as $Row){
                            $dataArray = array();
                            $dataArray['unique_id'] = $Row['unique_id'];
                            $dataArray['category_id'] = $Row['category_id'];
                            $dataArray['data_name'] = $Row['data_name'];
                            $dataArray['data_description'] = $Row['data_description'];
                            $dataArray['data_image'] = $Row['data_image'];
                            $dataArray['data_bundle'] = $Row['data_bundle'];
                            $dataArray['data_support_version'] = $Row['data_support_version'];
                            $dataArray['data_price'] = $Row['data_price'];
                            $dataArray['data_size'] = $Row['data_size'];
                            $dataArray['data_view'] = $Row['data_view'];
                            $dataArray['data_download'] = $Row['data_download'];
                            $dataArray['data_status'] = $Row['data_status'];
                            $dataArray['categoryData'] = $this->DataModel->getData('category_id = '.$dataArray['category_id'], MCPE_CATEGORY_SKIN);

                            array_push($data['viewSkin'], $dataArray);
                        }
                    }

                    if($data['viewSkin'] != null){
                        $this->load->view('header');
                        $this->load->view('android/skin_view',$data);
                        $this->load->view('footer');
                    } else {
                        $this->session->unset_userdata('session_skin_view');
                        $data['msg'] = array(
                            'data_title'=>"Skin Database is Empty",
                            'data_description'=>"Please add skin & redirect skin from the below button.",
                            'button_link'=>"new-skin",
                            'button_text'=>"New Skin",
                            'button_link1'=>'view-skin',
                            'button_text1'=>"View Skin",
                        );
                        $this->load->view('header');
                        $this->load->view('nodata', $data);
                        $this->load->view('footer');
                    }
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

    public function skinEdit($uniqueID = 0){
        $isLogin = $this->checkAuth();
        if($isLogin == "True"){
            if(!empty($this->session->userdata['user_role'])) { 
                if($this->session->userdata['user_role'] == "Administrator" or $this->session->userdata['user_role'] == "Editor") {
                    $checkEncryption = $this->DataModel->checkEncrypt($uniqueID,ENCRYPT_TABLE);
                    if($checkEncryption){
                        $uniqueID = $checkEncryption->enc_number;
                    }
                   
                    if(ctype_digit($uniqueID)){
                        $data['skinData'] = $this->DataModel->getData('unique_id = '.$uniqueID, MCPE_SKIN);
                        $data['viewCategorySkin'] = $this->DataModel->viewData('category_id '.'DESC', null, MCPE_CATEGORY_SKIN);
                        $categoryID = $data['skinData']->category_id;
                        $data['categorySkinData'] = $this->DataModel->getData('category_id = '.$categoryID, MCPE_CATEGORY_SKIN);
                        if(!empty($data['skinData'])){
                            $this->load->view('header');
                            $this->load->view('android/skin_edit',$data);
                            $this->load->view('footer');
                        } else {
                            redirect('error');
                        }
                        if($this->input->post('submit')){
                            date_default_timezone_set("Asia/Kolkata");
                            $s3Client = $this->getconfig();
                            $uniqueCode = $this->uniqueKey();
                            
                            $imageKey = $data['skinData']->data_image;
                            $newImageKey = basename($imageKey);
                    
                            $bundleKey = $data['skinData']->data_bundle;
                            $newBundleKey = basename($bundleKey);

                            if (!empty($_FILES['data_image']['name']) and !empty($_FILES['data_bundle']['name'])){
                                $deleteImage = $s3Client->deleteObject([
                                        'Bucket' => BUCKET_NAME,
                                        'Key'    => DATA_IMAGE.$newImageKey,
                                    ]);
                                $deleteBundle = $s3Client->deleteObject([
                                        'Bucket' => BUCKET_NAME,
                                        'Key'    => DATA_BUNDLE.$newBundleKey,
                                    ]);
                                
                                $imageName = $_FILES['data_image']['name'];
                                $imageTemp = $_FILES['data_image']['tmp_name'];
                                $imagePath = DATA_IMAGE;
                                $imageResponse = $this->newBucketObject($imageName, $uniqueCode, $imageTemp, $imagePath);

                                $bundleName = $_FILES['data_bundle']['name'];
                                $bundleTemp = $_FILES['data_bundle']['tmp_name'];
                                $bundlePath = DATA_BUNDLE;
                                $bundleResponse = $this->newBucketObject($bundleName, $uniqueCode, $bundleTemp, $bundlePath);

                                $editData = array(
                                    'category_id'=>$this->input->post('category_id'),
                                    'data_name'=>$this->input->post('data_name'),
                                    'data_description'=>$this->input->post('data_description'),
                                    'data_image'=>$imageResponse,
                                    'data_bundle'=>$bundleResponse,
                                    'data_support_version'=>$this->input->post('data_support_version'),
                                    'data_price'=>$this->input->post('data_price'),
                                    'data_size'=>$this->input->post('data_size'),
                                    'data_view'=>$this->input->post('data_view'),
                                    'data_download'=>$this->input->post('data_download'),
                                    'data_status'=>$this->input->post('data_status'),
                                );
                            } else if(!empty($_FILES['data_image']['name'])) {
                                $deleteImage = $s3Client->deleteObject([
                                            'Bucket' => BUCKET_NAME,
                                            'Key'    => DATA_IMAGE.$newImageKey,
                                        ]);
                    
                                $imageName = $_FILES['data_image']['name'];
                                $imageTemp = $_FILES['data_image']['tmp_name'];
                                $imagePath = DATA_IMAGE;
                                $imageResponse = $this->newBucketObject($imageName, $uniqueCode, $imageTemp, $imagePath);
                    
                                $editData = array(
                                    'category_id'=>$this->input->post('category_id'),
                                    'data_name'=>$this->input->post('data_name'),
                                    'data_description'=>$this->input->post('data_description'),
                                    'data_image'=>$imageResponse,
                                    'data_support_version'=>$this->input->post('data_support_version'),
                                    'data_price'=>$this->input->post('data_price'),
                                    'data_size'=>$this->input->post('data_size'),
                                    'data_view'=>$this->input->post('data_view'),
                                    'data_download'=>$this->input->post('data_download'),
                                    'data_status'=>$this->input->post('data_status'),
                                );
                            } else if(!empty($_FILES['data_bundle']['name'])) {
                                $deleteBundle = $s3Client->deleteObject([
                                        'Bucket' => BUCKET_NAME,
                                        'Key'    => DATA_BUNDLE.$newBundleKey,
                                    ]);
                                
                                $bundleName = $_FILES['data_bundle']['name'];
                                $bundleTemp = $_FILES['data_bundle']['tmp_name'];
                                $bundlePath = DATA_BUNDLE;
                                $bundleResponse = $this->newBucketObject($bundleName, $uniqueCode, $bundleTemp, $bundlePath);
                                
                                $editData = array(
                                    'category_id'=>$this->input->post('category_id'),
                                    'data_name'=>$this->input->post('data_name'),
                                    'data_description'=>$this->input->post('data_description'),
                                    'data_bundle'=>$bundleResponse,
                                    'data_support_version'=>$this->input->post('data_support_version'),
                                    'data_price'=>$this->input->post('data_price'),
                                    'data_size'=>$this->input->post('data_size'),
                                    'data_view'=>$this->input->post('data_view'),
                                    'data_download'=>$this->input->post('data_download'),
                                    'data_status'=>$this->input->post('data_status'),
                                );
                            } else {
                                $editData = array(
                                    'category_id'=>$this->input->post('category_id'),
                                    'data_name'=>$this->input->post('data_name'),
                                    'data_description'=>$this->input->post('data_description'),
                                    'data_support_version'=>$this->input->post('data_support_version'),
                                    'data_price'=>$this->input->post('data_price'),
                                    'data_size'=>$this->input->post('data_size'),
                                    'data_view'=>$this->input->post('data_view'),
                                    'data_download'=>$this->input->post('data_download'),
                                    'data_status'=>$this->input->post('data_status'),
                                );
                            }
                            $editDataEntry = $this->DataModel->editData('unique_id = '.$uniqueID, MCPE_SKIN, $editData);
                            if($editDataEntry){
                                redirect('view-skin');
                            }
                        }
                    } else {
                        redirect('error');
                    }
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
    
    // Search Functions
    public function searchView(){
        $isLogin = $this->checkAuth();
        if($isLogin == "True"){
            if(!empty($this->session->userdata['user_role'])) { 
                if($this->session->userdata['user_role'] == "Administrator" or $this->session->userdata['user_role'] == "Editor") {
                   
                    $data = array();
                    //get rows count
                    $conditions['returnType'] = 'count';
                    $totalRec = $this->DataModel->viewSearchData($conditions, MCPE_SEARCH_DATA);
                    
                    //pagination config
                    $config['base_url']    = site_url('view-search');
                    $config['uri_segment'] = 2;
                    $config['total_rows']  = $totalRec;
                    $config['per_page']    = 50;
                    
                    //styling
                    $config['num_tag_open'] = '<li class="page-item page-link">';
                    $config['num_tag_close'] = '</li>';
                    $config['cur_tag_open'] = '<li class="active page-item"><a href="javascript:void(0);" class="page-link" >';
                    $config['cur_tag_close'] = '</a></li>';
                    $config['next_link'] = '&raquo';
                    $config['prev_link'] = '&laquo';
                    $config['next_tag_open'] = '<li class="pg-next page-item page-link">';
                    $config['next_tag_close'] = '</li>';
                    $config['prev_tag_open'] = '<li class="pg-prev page-item page-link">';
                    $config['prev_tag_close'] = '</li>';
                    $config['first_tag_open'] = '<li class="page-item page-link">';
                    $config['first_tag_close'] = '</li>';
                    $config['last_tag_open'] = '<li class="page-item page-link">';
                    $config['last_tag_close'] = '</li>';
                    
                    //initialize pagination library
                    $this->pagination->initialize($config);
                    
                    //define offset
                    $page = $this->uri->segment(2);
                    $offset = !$page?0:$page;
                    
                    //get rows
                    $conditions['returnType'] = '';
                    $conditions['start'] = $offset;
                    $conditions['limit'] = 50;

                    $search = $this->DataModel->viewSearchData($conditions, MCPE_SEARCH_DATA);
                    $data['viewSearch'] = array();
                    
                    if (is_array($search) || is_object($search)){
                        foreach($search as $Row){
                            $dataArray = array();
                            $dataArray['search_id'] = $Row['search_id'];
                            $dataArray['search_category'] = $Row['search_category'];
                            $dataArray['search_query'] = $Row['search_query'];
                            $dataArray['search_time'] = $Row['search_time'];
                            $dataArray['search_status'] = $Row['search_status'];
                            $dataArray['searchPublishCount'] = $this->DataModel->countData('(search_status="publish")', MCPE_SEARCH_DATA);
                            $dataArray['searchAddedCount'] = $this->DataModel->countData('(search_status="added")', MCPE_SEARCH_DATA);
                            
                            array_push($data['viewSearch'], $dataArray);
                        }
                    }

                    if($data['viewSearch'] != null){
                        $this->load->view('header');
                        $this->load->view('android/search_view',$data);
                        $this->load->view('footer');
                    } else {
                        $data['msg'] = array(
                            'data_title'=>"Search Database is Empty",
                            'data_description'=>"Please search added data from the below button.",
                            'button_link'=>"view-search-added",
                            'button_text'=>"View Search Added",
                        );
                        $this->load->view('header');
                        $this->load->view('nodata', $data);
                        $this->load->view('footer');
                    }
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

    public function searchAddedView(){
        $isLogin = $this->checkAuth();
        if($isLogin == "True"){
            if(!empty($this->session->userdata['user_role'])) { 
                if($this->session->userdata['user_role'] == "Administrator" or $this->session->userdata['user_role'] == "Editor") {
                   
                    $data = array();
                    //get rows count
                    $conditions['returnType'] = 'count';
                    $totalRec = $this->DataModel->viewSearchAddedData($conditions, MCPE_SEARCH_DATA);
                    
                    //pagination config
                    $config['base_url']    = site_url('view-search-added');
                    $config['uri_segment'] = 2;
                    $config['total_rows']  = $totalRec;
                    $config['per_page']    = 20;
                    
                    //styling
                    $config['num_tag_open'] = '<li class="page-item page-link">';
                    $config['num_tag_close'] = '</li>';
                    $config['cur_tag_open'] = '<li class="active page-item"><a href="javascript:void(0);" class="page-link" >';
                    $config['cur_tag_close'] = '</a></li>';
                    $config['next_link'] = '&raquo';
                    $config['prev_link'] = '&laquo';
                    $config['next_tag_open'] = '<li class="pg-next page-item page-link">';
                    $config['next_tag_close'] = '</li>';
                    $config['prev_tag_open'] = '<li class="pg-prev page-item page-link">';
                    $config['prev_tag_close'] = '</li>';
                    $config['first_tag_open'] = '<li class="page-item page-link">';
                    $config['first_tag_close'] = '</li>';
                    $config['last_tag_open'] = '<li class="page-item page-link">';
                    $config['last_tag_close'] = '</li>';
                    
                    //initialize pagination library
                    $this->pagination->initialize($config);
                    
                    //define offset
                    $page = $this->uri->segment(2);
                    $offset = !$page?0:$page;
                    
                    //get rows
                    $conditions['returnType'] = '';
                    $conditions['start'] = $offset;
                    $conditions['limit'] = 20;

                    $searchAdded = $this->DataModel->viewSearchAddedData($conditions, MCPE_SEARCH_DATA);
                    $data['viewSearchAdded'] = array();
                    
                    if (is_array($searchAdded) || is_object($searchAdded)){
                        foreach($searchAdded as $Row){
                            $dataArray = array();
                            $dataArray['search_id'] = $Row['search_id'];
                            $dataArray['search_category'] = $Row['search_category'];
                            $dataArray['search_query'] = $Row['search_query'];
                            $dataArray['search_time'] = $Row['search_time'];
                            $dataArray['search_status'] = $Row['search_status'];
                            
                            array_push($data['viewSearchAdded'], $dataArray);
                        }
                    }

                    if($data['viewSearchAdded'] != null){
                        $this->load->view('header');
                        $this->load->view('android/search_added_view',$data);
                        $this->load->view('footer');
                    } else {
                        $data['msg'] = array(
                            'data_title'=>"Search Added Database is Empty",
                            'data_description'=>"Please search data from the below button.",
                            'button_link'=>"view-search",
                            'button_text'=>"View Search",
                        );
                        $this->load->view('header');
                        $this->load->view('nodata', $data);
                        $this->load->view('footer');
                    }
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

    public function searchEdit($searchID = 0){
        $isLogin = $this->checkAuth();
        if($isLogin == "True"){
            if(!empty($this->session->userdata['user_role'])) { 
                if($this->session->userdata['user_role'] == "Administrator" or $this->session->userdata['user_role'] == "Editor") {
                    $checkEncryption = $this->DataModel->checkEncrypt($searchID,ENCRYPT_TABLE);
                    if($checkEncryption){
                        $searchID = $checkEncryption->enc_number;
                    }
                   
                    if(ctype_digit($searchID)){
                        $editData = array(
                            'search_status'=>"added",
                        );
                        $editDataEntry = $this->DataModel->editData('search_id = '.$searchID, MCPE_SEARCH_DATA, $editData);
                        if($editDataEntry){
                            redirect('view-search');
                        }
                    }
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
    
    public function searchDelete($searchID = 0){
        $isLogin = $this->checkAuth();
        if($isLogin == "True"){
            if(!empty($this->session->userdata['user_role'])) { 
                if($this->session->userdata['user_role'] == "Administrator" or $this->session->userdata['user_role'] == "Editor") {
                    $checkEncryption = $this->DataModel->checkEncrypt($searchID,ENCRYPT_TABLE);
                    if($checkEncryption){
                        $searchID = $checkEncryption->enc_number;
                    }
                   
                    if(ctype_digit($searchID)){
                        $deleteData = $this->DataModel->deleteData('search_id = '.$searchID, MCPE_SEARCH_DATA);
                        if($deleteData){
                            redirect('view-search');
                        }
                    }
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
	
	// App Data Functions
    public function appDataView(){
        $isLogin = $this->checkAuth();
        if($isLogin == "True"){
            if(!empty($this->session->userdata['user_role'])) { 
                if($this->session->userdata['user_role'] == "Administrator" or $this->session->userdata['user_role'] == "Editor") {
                    $data = array();
                    //get rows count
                    $conditions['returnType'] = 'count';
                    $totalRec = $this->DataModel->viewAppNotificationData($conditions, APP_DATA_TABLE);
                    
                    //pagination config
                    $config['base_url']    = site_url('view-app-data');
                    $config['uri_segment'] = 2;
                    $config['total_rows']  = $totalRec;
                    $config['per_page']    = 10;
                    
                    //styling
                    $config['num_tag_open'] = '<li class="page-item page-link">';
                    $config['num_tag_close'] = '</li>';
                    $config['cur_tag_open'] = '<li class="active page-item"><a href="javascript:void(0);" class="page-link" >';
                    $config['cur_tag_close'] = '</a></li>';
                    $config['next_link'] = '&raquo';
                    $config['prev_link'] = '&laquo';
                    $config['next_tag_open'] = '<li class="pg-next page-item page-link">';
                    $config['next_tag_close'] = '</li>';
                    $config['prev_tag_open'] = '<li class="pg-prev page-item page-link">';
                    $config['prev_tag_close'] = '</li>';
                    $config['first_tag_open'] = '<li class="page-item page-link">';
                    $config['first_tag_close'] = '</li>';
                    $config['last_tag_open'] = '<li class="page-item page-link">';
                    $config['last_tag_close'] = '</li>';
                    
                    //initialize pagination library
                    $this->pagination->initialize($config);
                    
                    //define offset
                    $page = $this->uri->segment(2);
                    $offset = !$page?0:$page;
                    
                    //get rows
                    $conditions['returnType'] = '';
                    $conditions['start'] = $offset;
                    $conditions['limit'] = 10;
        
                    $viewAppData = $this->DataModel->viewAppNotificationData($conditions, APP_DATA_TABLE);
                    $data['viewAppData'] = array();
                            
                    if (is_array($viewAppData) || is_object($viewAppData)){
                        foreach($viewAppData as $appRow){
                            $dataArray = array();
                            $dataArray['app_id'] = $appRow['app_id'];
                            $dataArray['app_name'] = $appRow['app_name'];
                            $dataArray['app_code'] = $appRow['app_code'];
                            $dataArray['app_table'] = $appRow['app_table'];
                            $dataArray['app_rsa'] = $appRow['app_rsa'];
                            $dataArray['app_user'] = $this->DataModel->countData('token_status = "active"', $appRow['app_table']);
        
                            array_push($data['viewAppData'], $dataArray);
                        }
                    }
                            
                    if($data['viewAppData'] != null){
                        $this->load->view('header');
                        $this->load->view('android/app_data_view',$data);
                        $this->load->view('footer');
                    } else {
                        $data['msg'] = array(
                            'data_title'=>"App Database is Empty",
                            'data_description'=>"Please add app from the below button.",
                            'button_link'=>"app-data-new",
                            'button_text'=>"New App Data",
                        );
                        $this->load->view('header');
                        $this->load->view('nodata', $data);
                        $this->load->view('footer');
                    }
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

    public function appDataEdit($appID = 0){
        $isLogin = $this->checkAuth();
        if($isLogin == "True"){
            if(!empty($this->session->userdata['user_role'])) { 
                if($this->session->userdata['user_role'] == "Administrator" or $this->session->userdata['user_role'] == "Editor") {
                    $checkEncryption = $this->DataModel->checkEncrypt($appID,ENCRYPT_TABLE);
                    if($checkEncryption){
                        $appID = $checkEncryption->enc_number;
                    }
                   
                    if(ctype_digit($appID)){
                        $data['appData'] = $this->DataModel->getData('app_id = '.$appID, APP_DATA_TABLE);
                        if(!empty($data['appData'])){
                            $this->load->view('header');
                            $this->load->view('android/app_data_edit',$data);
                            $this->load->view('footer');
                        } else {
                            redirect('error');
                        }
                        if($this->input->post('submit')){
                            $editData = array(
                                'app_name'=>$this->input->post('app_name'),
                                'app_code'=>$this->input->post('app_code'),
                                'app_table'=>$this->input->post('app_table'),
                                'app_rsa'=>$this->input->post('app_rsa'),
                            );
                            $editDataEntry = $this->DataModel->editData('app_id = '.$appID, APP_DATA_TABLE, $editData);
                            if($editDataEntry){
                                redirect('view-app-data');
                            }
                        }
                    } else {
                        redirect('error');
                    }
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

    // Notification Data Functions
    public function notificationNew(){
        $isLogin = $this->checkAuth();
        if($isLogin == "True"){
            if(!empty($this->session->userdata['user_role'])) { 
                if($this->session->userdata['user_role'] == "Administrator" or $this->session->userdata['user_role'] == "Editor") {
                    $this->form_validation->set_rules('notification_title', 'Text', 'required');
                    $this->form_validation->set_rules('notification_message', 'Text', 'required');
                    $this->form_validation->set_rules('notification_url', 'Text', 'required');
                    $this->form_validation->set_rules('notification_image', 'Text', 'required');
                    
                    if ($this->form_validation->run() == FALSE){
                        $data['appData'] = $this->DataModel->viewData('app_id '.'DESC', null, APP_DATA_TABLE);
                        $data['error'] = "";
                        $this->load->view('header');
                        $this->load->view('android/notification_new',$data);
                        $this->load->view('footer');
                    } else {
                        $appData = $this->DataModel->getData('app_id = '.$_POST['app_id'], APP_DATA_TABLE);
                        if(!empty($_FILES['notification_image']['name'])){
                            $config['upload_path'] = 'uploads/notification/';
                            $config['allowed_types'] = 'jpg|jpeg|png|gif|webp';
    						$config['file_name'] = date('Ymdhis');
                            $this->load->library('upload',$config);
                            $this->upload->initialize($config);
                            if($this->upload->do_upload('notification_image')){
                                $uploadData = $this->upload->data();
                                $notificationImage = $uploadData['file_name'];
                            } else {
                                $notificationImage = '';
                            }
                        } else {
                            $notificationImage = '';
                        }
                        $newData = array(
                            'app_id'=>$this->input->post('app_id'),
                            'notification_title'=>$this->input->post('notification_title'),
                            'notification_message'=>$this->input->post('notification_message'),
                            'notification_url'=>$this->input->post('notification_url'),
                            'notification_image'=>$notificationImage,
                            'app_code'=>$appData->app_code,
                            'app_table'=>$appData->app_table,
                            'app_rsa'=>$appData->app_rsa,
                            'notification_status'=>$this->input->post('notification_status')
                        );
                        $newDataEntry = $this->DataModel->insertData(APP_NOTIFICATION_TABLE, $newData);
                        if($newDataEntry){
                          redirect('view-notification');  
                        }
                    }
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

    public function notificationView(){
        $isLogin = $this->checkAuth();
        if($isLogin == "True"){
            if(!empty($this->session->userdata['user_role'])) { 
                if($this->session->userdata['user_role'] == "Administrator" or $this->session->userdata['user_role'] == "Editor") {
                    $data = array();
                    //get rows count
                    $conditions['returnType'] = 'count';
                    $totalRec = $this->DataModel->viewNotificationData($conditions, APP_NOTIFICATION_TABLE);
                    
                    //pagination config
                    $config['base_url']    = site_url('view-notification');
                    $config['uri_segment'] = 2;
                    $config['total_rows']  = $totalRec;
                    $config['per_page']    = 10;
                    
                    //styling
                    $config['num_tag_open'] = '<li class="page-item page-link">';
                    $config['num_tag_close'] = '</li>';
                    $config['cur_tag_open'] = '<li class="active page-item"><a href="javascript:void(0);" class="page-link" >';
                    $config['cur_tag_close'] = '</a></li>';
                    $config['next_link'] = '&raquo';
                    $config['prev_link'] = '&laquo';
                    $config['next_tag_open'] = '<li class="pg-next page-item page-link">';
                    $config['next_tag_close'] = '</li>';
                    $config['prev_tag_open'] = '<li class="pg-prev page-item page-link">';
                    $config['prev_tag_close'] = '</li>';
                    $config['first_tag_open'] = '<li class="page-item page-link">';
                    $config['first_tag_close'] = '</li>';
                    $config['last_tag_open'] = '<li class="page-item page-link">';
                    $config['last_tag_close'] = '</li>';
                    
                    //initialize pagination library
                    $this->pagination->initialize($config);
                    
                    //define offset
                    $page = $this->uri->segment(2);
                    $offset = !$page?0:$page;
                    
                    //get rows
                    $conditions['returnType'] = '';
                    $conditions['start'] = $offset;
                    $conditions['limit'] = 10;
        
                    $notification = $this->DataModel->viewNotificationData($conditions, APP_NOTIFICATION_TABLE);
                    $data['viewNotification'] = array();
                    
                    if (is_array($notification) || is_object($notification)){
                        foreach($notification as $Row){
                            $dataArray = array();
                            $dataArray['notification_id'] = $Row['notification_id'];
                            $dataArray['app_id'] = $Row['app_id'];
                            $dataArray['notification_title'] = $Row['notification_title'];
                            $dataArray['notification_message'] = $Row['notification_message'];
                            $dataArray['notification_url'] = $Row['notification_url'];
                            $dataArray['notification_image'] = $Row['notification_image'];
                            $dataArray['notification_status'] = $Row['notification_status'];
                            $dataArray['appData'] = $this->DataModel->getData('app_id = '.$dataArray['app_id'], APP_DATA_TABLE);
                            
                            array_push($data['viewNotification'], $dataArray);
                        }
                    }
        
                    if($data['viewNotification'] != null){
                        $this->load->view('header');
                        $this->load->view('android/notification_view',$data);
                        $this->load->view('footer');
                    } else {
                        $data['msg'] = array(
                            'data_title'=>"Notification Database is Empty",
                            'data_description'=>"Please add notification from the below button.",
                            'button_link'=>"new-notification",
                            'button_text'=>"New Notification",
                        );
                        $this->load->view('header');
                        $this->load->view('nodata', $data);
                        $this->load->view('footer');
                    }
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

    public function NotificationEdit($notificationID = 0){
        $isLogin = $this->checkAuth();
        if($isLogin == "True"){
            if(!empty($this->session->userdata['user_role'])) { 
                if($this->session->userdata['user_role'] == "Administrator" or $this->session->userdata['user_role'] == "Editor") {
                    $checkEncryption = $this->DataModel->checkEncrypt($notificationID,ENCRYPT_TABLE);
                    if($checkEncryption){
                        $notificationID = $checkEncryption->enc_number;
                    }
                   
                    if(ctype_digit($notificationID)){
                        $data['notificationData'] = $this->DataModel->getData('notification_id = '.$notificationID, APP_NOTIFICATION_TABLE);
                        $data['viewApp'] = $this->DataModel->viewData('app_id '.'DESC', null, APP_DATA_TABLE);
                        $appID = $data['notificationData']->app_id;
                        $data['appData'] = $this->DataModel->getData('app_id = '.$appID, APP_DATA_TABLE);
        
                        if(!empty($data['notificationData'])){
                            $this->load->view('header');
                            $this->load->view('android/notification_edit',$data);
                            $this->load->view('footer');
                        } else {
                            redirect('error');
                        }
                        if($this->input->post('submit')){
                            $appNotificationData = $this->DataModel->getData('app_id = '.$_POST['app_id'], APP_DATA_TABLE);
                            date_default_timezone_set("Asia/Kolkata");
			    		    if(!empty($_FILES['notification_image']['name'])){
			                    $config['upload_path'] = 'uploads/notification/';
			                    $config['allowed_types'] = 'jpg|jpeg|png|gif';
			                    $config['file_name'] = date('Ymdhis');
			                    $this->load->library('upload',$config);
			                    $this->upload->initialize($config);
			                    if($this->upload->do_upload('notification_image')){
			                        $uploadData = $this->upload->data();
			                        $notificationImage = $uploadData['file_name'];
			                    } else {
			                        $notificationImage = $data['notificationData']->notification_image;
			                    }
			                } else {
			                    $notificationImage = $data['notificationData']->notification_image;
			                }
			                if(!empty($_FILES['notification_image']['name'])){
			                    if(!empty($data['notificationData']->notification_image)){
			                        unlink("uploads/notification/".$data['notificationData']->notification_image);
			                    }
			                }
                            $editData = array(
                                'app_id'=>$this->input->post('app_id'),
                                'notification_title'=>$this->input->post('notification_title'),
                                'notification_message'=>$this->input->post('notification_message'),
                                'notification_url'=>$this->input->post('notification_url'),
                                'notification_image'=>$notificationImage,
                                'app_code'=>$appNotificationData->app_code,
                                'app_table'=>$appNotificationData->app_table,
                                'app_rsa'=>$appNotificationData->app_rsa,
                                'notification_status'=>$this->input->post('notification_status')
                            );
                            $editDataEntry = $this->DataModel->editData('notification_id = '.$notificationID, APP_NOTIFICATION_TABLE, $editData);
                            if($editDataEntry){
                                redirect('view-notification');
                            }
                        }
                    } else {
                        redirect('error');
                    }
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
    
    //User Functions
	public function userNew(){
	    $isLogin = $this->checkAuth();
	    if($isLogin == "True"){
    	    if(!empty($this->session->userdata['user_role'])){ 
                if($this->session->userdata['user_role'] == "Administrator"){ 
            	    $this->form_validation->set_rules('user_name', 'Text', 'required');
            	    $this->form_validation->set_rules('user_email', 'Email', 'required');
            	    $this->form_validation->set_rules('user_password', 'Text', 'required');
            	    $this->form_validation->set_rules('user_role', 'Text', 'required');
            		$this->form_validation->set_error_delimiters('','');
            		if ($this->form_validation->run() == FALSE){
            			$data['error'] = "";
            			$this->load->view('header');
            			$this->load->view('android/user_new',$data);  
            			$this->load->view('footer');
            		} else {
            		    $numbers = '0123456789';
                        $numbersLength = strlen($numbers);
                        $userKey = '';
                        for ($i = 0; $i < 8; $i++) {
                            $userKey .= $numbers[rand(0, $numbersLength - 1)];
                        }
                		$newData = array(
                    		'user_name'=>$this->input->post('user_name'),
                    		'user_email'=>$this->input->post('user_email'),
                    	    'user_password'=>md5($this->input->post('user_password')),
                    	    'user_role'=>$this->input->post('user_role'),
                    	    'user_key'=>$userKey,
                    	    'user_status'=>$this->input->post('user_status'),
                    	    'is_login'=>'-',
                		);
	                	$newDataEntry = $this->DataModel->insertData(USER_TABLE, $newData);
                		if($newDataEntry){
            				redirect('view-user');
            			}
            		}
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
	
	public function userView(){
        $isLogin = $this->checkAuth();
        if($isLogin == "True"){
            if(!empty($this->session->userdata['user_role'])){ 
                if($this->session->userdata['user_role'] == "Administrator"){
                
                    $data = array();
                    //get rows count
                    $conditions['returnType'] = 'count';
                    $totalRec = $this->DataModel->viewUserData($conditions, USER_TABLE);
                    
                    //pagination config
                    $config['base_url']    = site_url('view-user');
                    $config['uri_segment'] = 2;
                    $config['total_rows']  = $totalRec;
                    $config['per_page']    = $this->perPage;
                    
                    //styling
                    $config['num_tag_open'] = '<li class="page-item page-link">';
                    $config['num_tag_close'] = '</li>';
                    $config['cur_tag_open'] = '<li class="active page-item"><a href="javascript:void(0);" class="page-link" >';
                    $config['cur_tag_close'] = '</a></li>';
                    $config['next_link'] = '&raquo';
                    $config['prev_link'] = '&laquo';
                    $config['next_tag_open'] = '<li class="pg-next page-item page-link">';
                    $config['next_tag_close'] = '</li>';
                    $config['prev_tag_open'] = '<li class="pg-prev page-item page-link">';
                    $config['prev_tag_close'] = '</li>';
                    $config['first_tag_open'] = '<li class="page-item page-link">';
                    $config['first_tag_close'] = '</li>';
                    $config['last_tag_open'] = '<li class="page-item page-link">';
                    $config['last_tag_close'] = '</li>';
                    
                    //initialize pagination library
                    $this->pagination->initialize($config);
                    
                    //define offset
                    $page = $this->uri->segment(2);
                    $offset = !$page?0:$page;
                    
                    //get rows
                    $conditions['returnType'] = '';
                    $conditions['start'] = $offset;
                    $conditions['limit'] = $this->perPage;
                    $user = $this->DataModel->viewUserData($conditions, USER_TABLE);
                    $data['viewUser'] = array();
                    
                    if (is_array($user) || is_object($user)){
                        foreach($user as $Row){
                            $dataArray = array();
                            $dataArray['user_id'] = $Row['user_id'];
                            $dataArray['user_name'] = $Row['user_name'];
                            $dataArray['user_email'] = $Row['user_email'];
                            $dataArray['user_password'] = $Row['user_password'];
                            $dataArray['user_role'] = $Row['user_role'];
                            $dataArray['user_key'] = $Row['user_key'];
                            $dataArray['user_login'] = $Row['user_login'];
                            $dataArray['is_login'] = $Row['is_login'];
                            $dataArray['user_status'] = $Row['user_status'];
                            array_push($data['viewUser'], $dataArray);
                        }
                    }

                    if($data['viewUser'] != null){
                        $this->load->view('header');
                        $this->load->view('android/user_view',$data);
                        $this->load->view('footer');
                    } else {
                        $data['msg'] = array(
                            'data_title'=>"No user data found",
                            'data_description'=>"Please add user & redirect user from the below button.",
                            'button_link'=>"new-user",
                            'button_text'=>"New User",
                            'button_link1'=>'view-user',
		                    'button_text1'=>"View User"
                        );
                        $this->load->view('header');
                        $this->load->view('nodata', $data);
                        $this->load->view('footer');
                    }
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

	public function userEdit($userID = 0){
	    $isLogin = $this->checkAuth();
	    if($isLogin == "True"){
    	    if(!empty($this->session->userdata['user_role'])){ 
                if($this->session->userdata['user_role'] == "Administrator"){ 
            	    $checkEncryption = $this->DataModel->checkEncrypt($userID,ENCRYPT_TABLE);
            	    if($checkEncryption){
            	        $userID = $checkEncryption->enc_number;
            	    }
            	    if(ctype_digit($userID)){
                		$data['userData'] = $this->DataModel->getData('user_id = '.$userID, USER_TABLE);
            			if($data['userData'] != null){
            			    $this->load->view('header');
                    		$this->load->view('android/user_edit',$data);
                    		$this->load->view('footer');
            			} else {
            				redirect('error');
            			}
                		if($this->input->post('submit')){
                			if($this->input->post('user_password') == ""){
                		        $userPassword = $data['userData']->user_password;
                		    } else {
                		        $userPassword = md5($this->input->post('user_password'));
                		    }
                		    $editData = array(
                        		'user_name'=>$this->input->post('user_name'),
                        		'user_email'=>$this->input->post('user_email'),
                        		'user_password'=>$userPassword,
                        	    'user_role'=>$this->input->post('user_role'),
                        	    'user_status'=>$this->input->post('user_status')
                			);
                			$editDataEntry = $this->DataModel->editData('user_id = '.$userID, USER_TABLE, $editData);
            				if($editDataEntry){
            					redirect('view-user');
            				}
                		}
            	    } else {
            			redirect('error');
            		}
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

 	public function userDelete($userID = 0){
 	    $isLogin = $this->checkAuth();
	    if($isLogin == "True"){
    	    if(!empty($this->session->userdata['user_role'])){ 
                if($this->session->userdata['user_role'] == "Administrator"){ 
                    $checkEncryption = $this->DataModel->checkEncrypt($userID,ENCRYPT_TABLE);
            	    if($checkEncryption){
            	        $userID = $checkEncryption->enc_number;
            	    }
            	    if(ctype_digit($userID)){
                        $resultDataEntry = $this->DataModel->deleteData('user_id = '.$userID, USER_TABLE);
                		if($resultDataEntry){
                			redirect('view-user');
                		}
            	    } else {
            			redirect('error');
            		}
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
