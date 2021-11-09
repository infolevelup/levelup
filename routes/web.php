<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PDFController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/confirmorder', function () {
    return view('cart/confirmorder');
});
Route::get('/corporate-training', function () {
    return view('/corporate-training');
});
/*
Route::get('/search', function () {
    return view('/search');
});
*/
/*Route::get('/userquizz', function () {
    return view('/userquizz');
});
*/

/*Route::get('/usercoursepage', function () {
    return view('/usercourse');
});*/

Route::post('search', 'WelcomeController@search')->name('search');
Route::get('autocomplete', 'WelcomeController@autocomplete')->name('autocomplete');

Route::get('testing11','WelcomeController@searchindex');
Route::get('testautocomplete','WelcomeController@testautocomplete')->name('testautocomplete');

Route::post('courseenquiry','CartController@courseenquiry');


Route::get('send-email-pdff/{order_id}', 'PDFController@generateinvoicePDF');

Route::post('subscribe','WelcomeController@subscribe');


Route::get('zoom/{id}','PDFController@zoom');
Route::get('generate-pdf/{orderid}','PDFController@generatePDF');
Route::get('cause_category', 'CartController@category');
Route::get('get_causes_against_category/{id}', 'CartController@get_causes_against_category');
//--------------------
Route::get('category/{slug}', ['uses' => 'CartController@category_wise_course', 'as' => 'course.category_wise_course']);

//Route::get('category/{slug}','WelcomeController@category_wise_course');
Route::get('quizz_result/{test_id}','LessonsController@quizz_result');
Route::get('general_pages','WelcomeController@show_general_pages');
Route::get('labs','WelcomeController@show_labs');

Route::get('quizz/{id}','LessonsController@quizz_result');
Route::get('/orders','OrderController@index');
Route::get('/invoice/{id}','OrderController@generateinvoice');
Route::get('/course_learning/{course_slug}','SelflearningController@displaycourse');
Route::get('/classroom/assignment/{course_id}/{lesson_id}','SelflearningController@displayassignment');
Route::get('/live_lesson/{id}/{slug}','SelflearningController@liveclass');
Route::get('/classroom/project/{course_id}','SelflearningController@displayproject');
Route::get('certificate/{id}','SelflearningController@showcertificate');
Route::post('assignmentfile-upload', 'SelflearningController@fileUploadPost')->name('assignmentfile.upload.post');
Route::post('projectfile-upload', 'SelflearningController@projectUploadPost')->name('projectfile.upload.post');

Route::get('sendemailinvoice/{id}','CartController@emailinvoice');
//---------------------------------tickets------------------------------------
Route::get('new_ticket', 'TicketsController@create');
Route::post('new_ticket', 'TicketsController@store');
Route::get('my_tickets', 'TicketsController@userTickets');
Route::post('comment', 'CommentsController@postComment');
Route::get('tickets/{ticket_id}', 'TicketsController@show');
Route::get('notification','DashboardController@shownotification');
Route::get('certificate','DashboardController@showcertificate');
Route::get('userquizz','CourseController@userquizz');
Route::get('usercoursepage','CourseController@usercoursepage');
Route::get('tickets', 'TicketsController@index');
Route::post('close_ticket/{ticket_id}', 'TicketsController@close');
//---------------------------------------------------------------------------
Route::get('/testimonial','WelcomeController@testimonial');
Route::get('/about-us','WelcomeController@about');
Route::post('/wishlist','CartController@wishlist');
Route::get('/wishlist','CartController@wishlistdetails');
Route::get('deleteItemWishlist/{id}','CartController@destroy');
Route::get('/contact-us','CartController@contact');
Route::post('corporate','CartController@corporate');
Route::post('corporate-training','CartController@corporateindex');

Route::post('generalform','CartController@generalform');
Route::post('feedback','CartController@feedback');
Route::post('enquiry','CartController@enquiry');
Route::get('blog','WelcomeController@blog');
Route::get('blog-details/{slug}','WelcomeController@blogdetails');
Route::post('/loadmore/load_data', 'WelcomeController@load_data')->name('loadmore.load_data');

//Route::get('/course','CartController@courseindex');
Route::get('course', ['uses' => 'CartController@courseindex', 'as' => 'course.courseindex']);

Route::get('/course/{slug}','CourseController@show');
//Route::get('course/{slug}', ['uses' => 'CourseController@show', 'as' => 'course.show']);
Route::get('/','WelcomeController@index');
//Auth::routes();
Auth::routes(['verify' => true]);
Route::get('/home', 'HomeController@index')->name('home');
//Route::get('/home', 'DashboardController@index');

//Route::get('/login','LoginController@showLoginForm');
Route::post('/login/custom',[
	'uses' =>'LoginController@login',
	 'as' =>'login.custom'
	]);
//---admin login
Route::get('admin/login','Admin\LoginController@showLoginForm');
Route::post('admin/login','Admin\LoginController@login');
Route::get('teacher/register','TeacherregisterController@index');
Route::post('add-to-cart','CartController@addToCart');
Route::get('cart','CartController@index');

//Route::get('/del/{id}/session_id/{session_id}','CartController@deleteCartQuantity');

Route::post('/add-wishlist', 'CartController@addtowishlist');





Route::post('teacherreg','TeacherregisterController@register');
Route::get('changeStatus', 'TeacherregisterController@changeStatus');
//--------------------------admin-----------------------------------------------------
Route::group(['as'=>'admin.','prefix' => 'admin','namespace'=>'Admin','middleware'=>['auth','admin']], function () {
	
		Route::get('dashboard', 'DashboardController@index')->name('dashboard');
		 Route::post('logout','Admin\LoginController@logout')->name('adminLogout');
		   Route::resources([  
           'corporate_logo_section'=>'CorporateController',
            'teachers' => 'TeachersController',
            'students' => 'StudentsController',
            'projects'=>'ProjectsController',
            'blog'=>'BlogController',
            'courses_starting_soon'=>'CourseStartingSoonController',
            'categories' => 'CategoriesController',
            'courses' => 'CoursesController',
            'lessons' => 'LessonsController',
            'livelessons' => 'LiveLessonsController',
            'assignment'=>'AssignmentController',
            'batch' => 'BatchController',
            'assignbatch' => 'AssignBatchController',
            'class' => 'ClassController',
            'grade'=>'GradeController',
            'banners' => 'BannerController',
            'testimonial'=>'TestimonialController',
             'test'=>'TestController',
             'faq'=>'FaqController',
               'labs'=>'LabsController',
             'coursefaq'=>'CourseFAQController',
             'questions'=>'QuestionController',
             'patners'=>'PatnerController',
               'counter'=>'CounterController',
               'sect'=>'SectionController',
                'bundle'=>'BundleController',
                'pages'=>'PageController',
                 'contacts'=>'ContactController',
                'studentplaced'=>'StudentplacedController',
                'aboutus'=>'AboutusController',
                'purchased_course'=>'PurchasedCourseController',
                'future'=>'FutureController',
                'edge'=>'EdgeController',
                
            ]);
		   Route::post('lessons/delete-multiple-image','LessonsController@deleteMultipleImages');
		   Route::post('delete-multiple-image','StudentplacedController@deleteMultipleImages');

		   Route::post('edge/addMoreEdge','EdgeController@addMoreEdge');
		   Route::post('edge/deleteMoreEdge/{id}','EdgeController@deleteMoreEdge');

		    Route::get('tickets','DashboardController@tickets');
		 Route::get('tickets/{ticket_id}', 'DashboardController@show');
		 Route::get('reviews', 'DashboardController@review');
		 		 Route::get('orders', 'DashboardController@orders');
            Route::post('livesessons/addMoreVideo','LiveLessonsController@addMoreVideo');

            Route::post('livelessons/delete-multiple-video','LiveLessonsController@deleteMultipleVideos');
Route::post('livelessons/delete-multiple-addpdf','LiveLessonsController@deleteMultiplePdf');
Route::post('livelessons/delete-multiple-downloadable_files','LiveLessonsController@deleteMultipleDownload');

Route::post('lessons/delete-multiple-video','LessonsController@deleteMultipleVideo');
Route::post('lessons/multiple_downloadable_files','LessonsController@deleteMultipleDownload');

		 Route::post('changereviewStatus','DashboardController@changereviewStatus');
		  Route::post('changeGradeStatus','DashboardController@changeGradeStatus');
		  		  Route::get('cerificate/{id}','DashboardController@showcertificate');
		  		  Route::get('notification','DashboardController@shownotification');
		  		  Route::get('assignment/{courseid}/{userid}','DashboardController@showassignment');
		  		  		  		  Route::get('project/{courseid}/{userid}','DashboardController@showproject');

Route::get('invoice/{id}','DashboardController@generateinvoice');

Route::get('/subscribers', function () {
    return view('admin/subscribers');
});

Route::get('courselist/{id}','TeachersController@CourseList');
 Route::get('studentlist/{id}','TeachersController@studentlist');
 Route::get('batchlist/{id}','TeachersController@batchlist');
 Route::post('teacherattendance','TeachersController@storelist');
});
//--------------------------teacher-----------------------------------------------------
Route::get('/markAsRead', function(){

	auth()->user()->unreadNotifications->markAsRead();

	return redirect()->back();

})->name('mark');
Route::group(['as'=>'user.','prefix' => 'user','namespace'=>'User','middleware'=>['auth','user']], function () {
		Route::get('dashboard', 'DashboardController@index')->name('dashboard');
		 Route::resources([  
           
            'categories' => 'CategoriesController',
            'courses' => 'CoursesController',
            'lessons' => 'LessonsController',
             'test'=>'TestController',
             'questions'=>'QuestionController',
             'bundle'=>'BundleController',
             'review'=>'ReviewController',


            ]);
            		   Route::get('lessons_details/{id}','LessonsController@getlessons');
                   /* Route::get('profile', function () {
                        return view('user/profile');
                    });*/
            Route::post('updateprofile','DashboardController@updateprofile');
        Route::post('changepassword','DashboardController@changepassword');
            Route::post('deleteSkills','DashboardController@deleteskills');

 Route::get('courselist','DashboardController@CourseList');
 Route::get('studentlist/{id}','DashboardController@studentlist');
 Route::get('batch/{id}','DashboardController@batchlist');
Route::get('/batch', function () {
    return view('user/batch');
});
});

//--------------------------student-----------------------------------------------------
Route::get('user', function () {
    
    // Only verified users may enter...
})->middleware('verified');

Route::post('ajaxcourselist','DashboardController@coursebox');
Route::get('dashboard', 'DashboardController@index');
Route::get('profile','DashboardController@profile');

Route::post('updateprofiles','DashboardController@updatestudprofile');
    Route::post('/changepassword','DashboardController@changepassword');
//-------------------------------------------------------------------------------------------

Route::group(['middleware' => 'auth'], function () {
    Route::post('cart/checkout', ['uses' => 'CartController@checkout', 'as' => 'cart.checkout']);
  Route::get('cart/checkout','CartController@showCheckout');
   
    Route::get('del/{id}/{session_id}/{course_id}','CartController@deleteCartitem');
    //Route::post('del','CartController@deleteCartitem');

    Route::post('cart/offline-payment', ['uses' => 'CartController@offlinePayment', 'as' => 'cart.offline.payment']);
    Route::get('lesson/{course_id}/{mediaid}/{slug}/', ['uses' => 'LessonsController@show', 'as' => 'lessons.show']);
    Route::get('showquizz/{id}','LessonsController@showquizz');
    Route::post('lesson/{slug}/test', ['uses' => 'LessonsController@test', 'as' => 'lessons.test']);
    Route::get('user_ajax_action','LessonsController@user_ajax_action');
        Route::view('confirmorder','cart/confirmorder');

    
});
   // Route::get('user_ajax_action','LessonsController@user_ajax_action');

  Route::get('user_quizz_answer','LessonsController@storeanswer');
   
  Route::post('/coursereview','DashboardController@ratingreview');
 
