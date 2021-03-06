<?php

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

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');

// Роутинг для исходящих запросов в базу UON
Route::group(['prefix' => 'api/uon/out'], function () {
    Route::get('all_clients', 'Api\uon\out\OutApiUonController@AllClients')->name('all_clients');
    Route::get('all_requests', 'Api\uon\out\OutApiUonController@AllRequests')->name('all_requests');
    Route::get('all_leads_requests', 'Api\uon\out\OutApiUonController@AllLeadsRequests')->name('all_leads_requests');
    Route::get('get_countries', 'Api\uon\out\OutApiUonController@GetCountries')->name('get_countries');
    Route::get('get_citys', 'Api\uon\out\OutApiUonController@GetCitys')->name('get_citys');
    Route::get('get_hotels', 'Api\uon\out\OutApiUonController@GetHotels')->name('get_hotels');
    Route::get('get_sourses', 'Api\uon\out\OutApiUonController@GetSourses')->name('get_sourses');
    Route::get('get_managers', 'Api\uon\out\OutApiUonController@GetManagers')->name('get_managers');
    Route::get('get_companies', 'Api\uon\out\OutApiUonController@GetCompanies')->name('get_companies');
    Route::get('get_operators', 'Api\uon\out\OutApiUonController@GetOperators')->name('get_operators');
    Route::get('get_avia', 'Api\uon\out\OutApiUonController@GetAvia')->name('get_avia');
    Route::get('get_partners', 'Api\uon\out\OutApiUonController@GetPartners')->name('get_partners');
    Route::get('get_services', 'Api\uon\out\OutApiUonController@GetServices')->name('get_services');
    Route::get('add_tour_type', 'Api\uon\out\OutApiUonController@TourTypes')->name('add_tour_type');
    Route::get('get_statuses', 'Api\uon\out\OutApiUonController@GetStatuses')->name('get_statuses');
    Route::get('get_cash', 'Api\uon\out\OutApiUonController@GetCash')->name('get_cash');
    Route::get('get_nutritions', 'Api\uon\out\OutApiUonController@GetNutritions')->name('get_nutritions');
    Route::get('get_offices', 'Api\uon\out\OutApiUonController@GetOffices')->name('get_offices');
    Route::get('get_labels', 'Api\uon\out\OutApiUonController@GetLabels')->name('get_labels');
});
// Роутинг для входящих хуков из базы UON
Route::group(['prefix' => 'api/uon/in'], function () {
    Route::get('new_client', 'Api\uon\in\InApiUonController@NewClient');
    Route::get('change_client', 'Api\uon\in\InApiUonController@ChangeClient');
    Route::get('delete_client', 'Api\uon\in\InApiUonController@DeleteClient');
    Route::get('new_zayavka', 'Api\uon\in\InApiUonController@NewZayavka');
    Route::get('status_zayavka', 'Api\uon\in\InApiUonController@StatusZayavka');
    Route::get('new_tourist', 'Api\uon\in\InApiUonController@NewTourist');
    Route::get('delete_tourist', 'Api\uon\in\InApiUonController@DeleteTourist');
    Route::get('new_service', 'Api\uon\in\InApiUonController@NewService');
    Route::get('change_service', 'Api\uon\in\InApiUonController@ChangeService');
    Route::get('new_payment', 'Api\uon\in\InApiUonController@NewPayment');
    Route::get('new_lead', 'Api\uon\in\InApiUonController@NewLead');
    Route::get('price_changed', 'Api\uon\in\InApiUonController@PriceChanged');
});
// Роутинг для админки
Route::group(['prefix' => 'admin', 'middleware' => ['role:developer']], function () {
    Route::get('/', 'Admin\AdminController@index')->name('admin');
    Route::get('/add_role', 'Admin\AdminController@add_role')->name('add_role');
    Route::get('/insert_questions', 'Admin\AdminController@add_cc_birthdays_q')->name('insert_questions');
    Route::get('parse_bids', 'Admin\AdminController@ParseBids')->name('ParseBids');
    Route::get('ParseBidsByDate', 'Admin\AdminController@ParseBidsByDate')->name('ParseBidsByDate');
});
// Роутинг для Тестовых
Route::group(['prefix' => 'test', 'middleware' => ['role:developer']], function () {
    Route::get('test', 'TestController@index')->name('test');
});

// Роутинг для работы с клиентами
Route::group(['prefix' => 'client'], function () {
    Route::get('client_list', 'ClientController@ClientList')->name('client_list');
    Route::post('client_list', 'ClientController@ClientList')->name('client_list');
    Route::get('client_add', 'ClientController@ClientAdd')->name('client_add');
    Route::post('client_create', 'ClientController@ClientCreate')->name('client_create');
    Route::get('client_edit/{id}', 'ClientController@ClientEdit')->name('client_edit');
    Route::get('client_change/{id}', 'ClientController@ClientChangeData')->name('client_change');
});
Route::group(['prefix' => 'leads'], function () {
    Route::get('leads_list', 'LeadsController@LeadsList')->name('leads_list');
    Route::get('lead_edit/{id}', 'LeadsController@LeadEdit')->name('lead_edit');
});
Route::group(['prefix' => 'bids'], function () {
    Route::get('bids_list', 'BidsController@BidsList')->name('bids_list');
    Route::get('bid_edit/{id}', 'BidsController@BidEdit')->name('bid_edit');
    Route::get('bid_change/{id}', 'BidsController@BidChange')->name('bid_change');
});
Route::group(['prefix' => 'catalog'], function () {
    Route::get('country_list', 'CountryController@CountryList')->name('country_list');
    Route::get('city_list', 'CityController@CityList')->name('city_list');
    Route::get('hotel_list', 'HotelController@HotelList')->name('hotel_list');
    Route::post('hotel_list', 'HotelController@HotelList')->name('hotel_list');
    Route::get('sourses_list', 'SourseController@SoursesList')->name('sourses_list');
    Route::get('managers_list', 'ManagersController@ManagersList')->name('managers_list');
});
Route::group(['prefix' => 'services'], function () {
    Route::get('service_edit/{id}', 'ServicesController@ServiceEdit')->name('service_edit');
});
Route::group(['prefix' => 'call-center'], function () {
    Route::get('index', 'CCController@Index')->name('cc');
    Route::get('birthday_call/{id}/{opros_id}/{user_id}', 'CCController@Birthday_call')->name('birthday_call');
    Route::get('birthday_call/add_pool_data', 'CCController@Birthday_pool_data')->name('birthday_pool_data');
    Route::get('birthday_call/add_pool_data_delete', 'CCController@Birthday_pool_data_delete')->name('birthday_pool_data_delete');
    Route::get('birthday_call/birthday_pool_status', 'CCController@Birthday_pool_status')->name('birthday_pool_status');
    Route::post('birthday_call/add_reminder', 'CCController@Add_reminder')->name('add_reminder');
    Route::get('ppo_call/{id}/{opros_id}/{r_id}', 'CCController@Ppo_call')->name('ppo_call');
    Route::get('ppo_call/ppo_call_data_delete', 'CCController@Ppo_call_data_delete')->name('ppo_call_data_delete');
    Route::get('ppo_call/ppo_pool_data', 'CCController@Ppo_pool_data')->name('ppo_pool_data');
});


