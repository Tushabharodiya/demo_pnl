<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Android Application Functions
$route['new-app'] = 'android/appNew';
$route['view-app'] = 'android/appView';
$route['view-app'.'/(:num)'] = 'android/appView/$1';
$route['description-app'.'/(:any)'] = 'android/appDescription/$1';
$route['edit-app'.'/(:any)'] = 'android/appEdit/$1';
$route['edit-ads'.'/(:any)'] = 'android/adsEdit/$1';

// Android Version Functions
$route['new-version'.'/(:any)'] = 'android/versionNew/$1';
$route['view-version'.'/(:any)'] = 'android/versionView/$1';
$route['view-version'.'/(:any)'.'/(:any)'] = 'android/versionView/$1/$2';
$route['description-version'.'/(:any)'] = 'android/versionDescription/$1';
$route['edit-version'.'/(:any)'] = 'android/versionEdit/$1';
$route['delete-version'.'/(:any)'] = 'android/versionDelete/$1';

// Android Banner Functions
$route['new-banner'] = 'android/bannerNew';
$route['view-banner'] = 'android/bannerView';
$route['edit-banner'.'/(:any)'] = 'android/bannerEdit/$1';
$route['delete-banner'.'/(:any)'] = 'android/bannerDelete/$1';

// Android Json Functions
$route['edit-json'.'/(:any)'] = 'android/jsonEdit/$1';

//Android Common Json Functions
$route['new-common-json'] = 'android/commonJsonNew';
$route['view-common-json'] = 'android/commonJsonView';
$route['edit-common-json'.'/(:any)'] = 'android/commonJsonEdit/$1';

// Android Subscription Functions
$route['new-subscription'.'/(:any)'] = 'android/subscriptionNew/$1';
$route['view-subscription'.'/(:any)'] = 'android/subscriptionView/$1';
$route['view-subscription'.'/(:any)'.'/(:any)'] = 'android/subscriptionView/$1/$2';
$route['edit-subscription'.'/(:any)'] = 'android/subscriptionEdit/$1';

// Mods Functions
$route['new-category-mods'] = 'android/categoryModsNew';
$route['view-category-mods'] = 'android/categoryModsView';
$route['view-category-mods'.'/(:num)'] = 'android/categoryModsView/$1';
$route['edit-category-mods'.'/(:any)'] = 'android/categoryModsEdit/$1';

$route['new-mods'] = 'android/modsNew';
$route['view-mods'] = 'android/modsView';
$route['view-mods'.'/(:num)'] = 'android/modsView/$1';
$route['edit-mods'.'/(:any)'] = 'android/modsEdit/$1';

// Addons Functions
$route['new-category-addons'] = 'android/categoryAddonsNew';
$route['view-category-addons'] = 'android/categoryAddonsView';
$route['view-category-addons'.'/(:num)'] = 'android/categoryAddonsView/$1';
$route['edit-category-addons'.'/(:any)'] = 'android/categoryAddonsEdit/$1';

$route['new-addons'] = 'android/addonsNew';
$route['view-addons'] = 'android/addonsView';
$route['view-addons'.'/(:num)'] = 'android/addonsView/$1';
$route['edit-addons'.'/(:any)'] = 'android/addonsEdit/$1';

// Maps Functions
$route['new-category-maps'] = 'android/categoryMapsNew';
$route['view-category-maps'] = 'android/categoryMapsView';
$route['view-category-maps'.'/(:num)'] = 'android/categoryMapsView/$1';
$route['edit-category-maps'.'/(:any)'] = 'android/categoryMapsEdit/$1';

$route['new-maps'] = 'android/mapsNew';
$route['view-maps'] = 'android/mapsView';
$route['view-maps'.'/(:num)'] = 'android/mapsView/$1';
$route['edit-maps'.'/(:any)'] = 'android/mapsEdit/$1';

// Seeds Functions
$route['new-category-seeds'] = 'android/categorySeedsNew';
$route['view-category-seeds'] = 'android/categorySeedsView';
$route['view-category-seeds'.'/(:num)'] = 'android/categorySeedsView/$1';
$route['edit-category-seeds'.'/(:any)'] = 'android/categorySeedsEdit/$1';

$route['new-seeds'] = 'android/seedsNew';
$route['view-seeds'] = 'android/seedsView';
$route['view-seeds'.'/(:num)'] = 'android/seedsView/$1';
$route['edit-seeds'.'/(:any)'] = 'android/seedsEdit/$1';

// Textures Functions
$route['new-category-textures'] = 'android/categoryTexturesNew';
$route['view-category-textures'] = 'android/categoryTexturesView';
$route['view-category-textures'.'/(:num)'] = 'android/categoryTexturesView/$1';
$route['edit-category-textures'.'/(:any)'] = 'android/categoryTexturesEdit/$1';

$route['new-textures'] = 'android/texturesNew';
$route['view-textures'] = 'android/texturesView';
$route['view-textures'.'/(:num)'] = 'android/texturesView/$1';
$route['edit-textures'.'/(:any)'] = 'android/texturesEdit/$1';

// Shaders Functions
$route['new-category-shaders'] = 'android/categoryShadersNew';
$route['view-category-shaders'] = 'android/categoryShadersView';
$route['view-category-shaders'.'/(:num)'] = 'android/categoryShadersView/$1';
$route['edit-category-shaders'.'/(:any)'] = 'android/categoryShadersEdit/$1';

$route['new-shaders'] = 'android/shadersNew';
$route['view-shaders'] = 'android/shadersView';
$route['view-shaders'.'/(:num)'] = 'android/shadersView/$1';
$route['edit-shaders'.'/(:any)'] = 'android/shadersEdit/$1';

//Skin Functions
$route['new-category-skin'] = 'android/categorySkinNew';
$route['view-category-skin'] = 'android/categorySkinView';
$route['view-category-skin'.'/(:num)'] = 'android/categorySkinView/$1';
$route['edit-category-skin'.'/(:any)'] = 'android/categorySkinEdit/$1';

$route['new-skin'] = 'android/skinNew';
$route['view-skin'] = 'android/skinView';
$route['view-skin'.'/(:num)'] = 'android/skinView/$1';
$route['edit-skin'.'/(:any)'] = 'android/skinEdit/$1';

//Search Functions
$route['view-search'] = 'android/searchView';
$route['view-search'.'/(:num)'] = 'android/searchView/$1';
$route['view-search-added'] = 'android/searchAddedView';
$route['view-search-added'.'/(:num)'] = 'android/searchAddedView/$1';
$route['edit-search'.'/(:any)'] = 'android/searchEdit/$1';
$route['delete-search'.'/(:any)'] = 'android/searchDelete/$1';

//App Data Functions
$route['view-app-data'] = 'android/appDataView';
$route['view-app-data'.'/(:num)'] = 'android/appDataView/$1';
$route['edit-app-data'.'/(:any)'] = 'android/appDataEdit/$1';

//Notification Data Functions
$route['new-notification'] = 'android/notificationNew';
$route['view-notification'] = 'android/notificationView';
$route['view-notification'.'/(:num)'] = 'android/notificationView/$1';
$route['edit-notification'.'/(:any)'] = 'android/notificationEdit/$1';

//User Functions
$route['new-user'] = 'android/userNew';
$route['view-user'] = 'android/userView';
$route['view-user'.'/(:num)'] = 'android/userView/$1';
$route['edit-user'.'/(:any)'] = 'android/userEdit/$1';
$route['delete-user'.'/(:any)'] = 'android/userDelete/$1';

//Common Settings
$route['default_controller'] = 'dashboard';
$route['404_override'] = 'error404';
$route['translate_uri_dashes'] = FALSE;
