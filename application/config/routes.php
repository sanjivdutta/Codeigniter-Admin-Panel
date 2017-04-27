<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'AdminController';
$route['404_override'] = 'ErrorController';
$route['translate_uri_dashes'] = FALSE;


/* Admin Section */
$route['admin'] = 'AdminController';
$route['adminLogin'] = 'AuthController/admin_login';
$route['admin/resetPassword'] = 'AuthController/resetPassword';
$route['admin/forget_password'] = 'AdminController/forget_password';
$route['admin/dashboard'] = 'AdminController/dashboard';
$route['admin/logout'] = 'AuthController/admin_logout';
$route['admin/user/own/reset_password/(:any)'] = 'AuthController/password_reset_form/$1';
$route['submitPassword'] = 'AuthController/password_submit';

/**
 * Post Section
 **/
$route['admin/add_post'] = 'PostController/addPost';
$route['admin/view_post'] = 'PostController/viewPost';
$route['admin/submitPost'] = 'PostController/submit_post';
$route['admin/updatePost'] = 'PostController/update_post';
$route['admin/post/edit/(:any)'] = 'PostController/editPost/$1';
$route['admin/post/image_delete/(:any)'] = 'PostController/deleteImage/$1';
$route['admin/post/delete/(:any)'] = 'PostController/deletePost/$1';

$route['admin/categories'] = 'PostController/viewCategories';
$route['admin/submitCategory'] = 'PostController/submit_category';
$route['admin/updateCategory'] = 'PostController/update_category';
$route['admin/category/edit/(:any)'] = 'PostController/editCategory/$1';
$route['admin/category/delete/(:any)'] = 'PostController/deleteCategory/$1';

/**
 *  General Setting Section
 */
$route['admin/setting'] = 'SettingController';
$route['admin/submitSetting'] = 'SettingController/setting_submit';
$route['admin/setting/image_delete/(:any)'] = 'SettingController/deleteImage/$1';

/**
 * User Section
 */
$route['admin/add_user'] = 'UserController/addUser';
$route['admin/submitUser'] = 'UserController/submit_user';
$route['admin/view_user'] = 'UserController/viewUser';
$route['admin/user/edit/(:any)'] = 'UserController/editUser/$1';
$route['admin/user/image_delete/(:any)'] = 'UserController/deleteImage/$1';
$route['admin/updateUser'] = 'UserController/update_user';
$route['admin/user/delete/(:any)'] = 'UserController/deleteUser/$1';

/**
 * Gallery Section
 */
$route['admin/add_gallery'] = 'GalleryController/addGallery';
$route['admin/submitGallery'] = 'GalleryController/submit_gallery';
$route['admin/view_gallery'] = 'GalleryController/viewGallery';
$route['admin/gallery/edit/(:any)'] = 'GalleryController/editGallery/$1';
$route['admin/gallery/image_delete/(:any)'] = 'GalleryController/deleteImage/$1';
$route['admin/updateGallery'] = 'GalleryController/update_gallery';
$route['admin/gallery/delete/(:any)'] = 'GalleryController/deleteGallery/$1';


/**
 * Testimonial Section
 **/
$route['admin/add_testimonial'] = 'TestimonialController/addTestimonial';
$route['admin/view_testimonial'] = 'TestimonialController/viewTestimonial';
$route['admin/submitTestimonial'] = 'TestimonialController/submit_testimonial';
$route['admin/updateTestimonial'] = 'TestimonialController/update_testimonial';
$route['admin/testimonial/edit/(:any)'] = 'TestimonialController/editTestimonial/$1';
$route['admin/testimonial/image_delete/(:any)'] = 'TestimonialController/deleteImage/$1';
$route['admin/testimonial/delete/(:any)'] = 'TestimonialController/deleteTestimonial/$1';

/**
 * Product Section
 **/
$route['admin/add_product'] = 'ProductController/addProduct';
$route['admin/view_product'] = 'ProductController/viewProduct';
$route['admin/submitProduct'] = 'ProductController/submit_product';
$route['admin/updateProduct'] = 'ProductController/update_product';
$route['admin/product/edit/(:any)'] = 'ProductController/editProduct/$1';
$route['admin/product/image_delete/(:any)'] = 'ProductController/deleteImage/$1';
$route['admin/product/delete/(:any)'] = 'ProductController/deleteProduct/$1';

$route['admin/product_categories'] = 'ProductController/viewCategories';
$route['admin/submitProductCategory'] = 'ProductController/submit_category';
$route['admin/updateProductCategory'] = 'ProductController/update_category';
$route['admin/product/category/edit/(:any)'] = 'ProductController/editCategory/$1';
$route['admin/product/category/delete/(:any)'] = 'ProductController/deleteCategory/$1';
$route['admin/product/category/image_delete/(:any)'] = 'ProductController/deleteCategoryImage/$1';

/**
 * Event Section
 **/
$route['admin/events'] = 'EventController/events';
$route['admin/events/add'] = 'EventController/addEvents';
$route['admin/submitEvent'] = 'EventController/submit_event';
$route['admin/viewEvent/(:num)'] = 'EventController/view_event/$1';

/**
 * Classified Section
 **/
$route['admin/add_classified'] = 'ClassifiedController/addClassified';
$route['admin/submitClassified'] = 'ClassifiedController/submit_classified';
$route['admin/view_classified'] = 'ClassifiedController/viewClassified';
$route['admin/classified/edit/(:any)'] = 'ClassifiedController/editClassified/$1';
$route['admin/updateClassified'] = 'ClassifiedController/update_classified';
$route['admin/classified/delete/(:any)'] = 'ClassifiedController/deleteClassified/$1';
$route['admin/classified/image_delete/(:any)'] = 'ClassifiedController/deleteImage/$1';

$route['admin/classified_categories'] = 'ClassifiedController/viewCategories';
$route['admin/submitClassifiedCategory'] = 'ClassifiedController/submit_category';
$route['admin/updateClassifiedCategory'] = 'ClassifiedController/update_category';
$route['admin/classified/category/edit/(:any)'] = 'ClassifiedController/editCategory/$1';
$route['admin/classified/category/delete/(:any)'] = 'ClassifiedController/deleteCategory/$1';

/* App Controller */

$route['userLogin'] = 'MobileAppController/user_login';

