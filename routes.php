<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//=== ROTAS DE AUTENTICACAO DE USUARIO  ===============================
// Authentication routes...
Route::get('login', ['as'=>'auth.login', 'uses'=>'AuthController@index']);

Route::get('logout', ['as'=>'auth', 'uses'=>'AuthController@getLogout']);

Route::post('auth', ['as'=>'auth.store', 'uses'=>'AuthController@store']);

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');


Route::controllers([
   'password' => 'Auth\PasswordController',
]);
//=====================================================================


Route::group(['middleware'=>'auth'], function (){
		Route::get('/', function () {
		    return view('home');
		});



		Route::get('users/adicionar', ['uses' => 'UsersController@inserir', 'as' => 'users.adicionar']);
		Route::post('users/store', ['uses' => 'UsersController@store', 'as' => 'users.store']);

		Route::get('users/index', ['uses' => 'UsersController@index', 'as' => 'users.index']);
		//PAGINAR USERS AJAX
		    Route::get('users/pagination', function(){
		            return \Datatables::eloquent(
		            		//App\User::query('users')
		            		App\User::selectRaw('users.name, users.email,users.company_id, users.password_view,users.admin, companies.company_name as company_name, companies.id')->leftJoin('companies','users.company_id','=','companies.id')
		            	)->make(true);
		    });
		 //editar usuario
		Route::get('users/edit/{id}', ['as'=>'edit', 'uses'=>'UsersController@edit']);
		Route::put('users/update/{id}', ['as' => 'users.update', 'uses'=>'UsersController@update']);

		Route::get('users/ver', function () {
		    return "Ver isso aqui...";
		});

		//rotas de company ==================================
		Route::get('company/add', ['uses' => 'CompaniesController@create', 'as' => 'company.add']);
		Route::post('company/store', ['uses' => 'CompaniesController@store', 'as' => 'company.store']);

		Route::get('company/index', ['uses' => 'CompaniesController@index', 'as' => 'company.index']);
		//filtro paginado de company
		Route::get('company/pagination', function(){
		            return \Datatables::eloquent(App\Company::query('companies'))->make(true);
		    });
		 //editar Company
		Route::get('company/edit/{id?}', ['as'=>'edit', 'uses'=>'CompaniesController@edit']);
		Route::put('company/update/{id}', ['as'=> 'company.update', 'uses'=>'CompaniesController@update']);
		Route::get('company/destroy/{id}', ['as' => 'company.destroy', 'uses'=>'CompaniesController@destroy']);
		Route::get('company/getcompany/{id?}', ['as'=>'get', 'uses'=>'CompaniesController@getNameByIDCompany']);
		Route::get('sponsorship/del/{id?}', ['as'=>'sponsorship.del', 'uses'=>'CompaniesController@apagarQuotaSponsorship']);

		//rotas de Categories ==================================
		Route::get('categories/add', ['uses' => 'CategoriesController@create', 'as' => 'categories.add']);
		Route::post('categories/store', ['uses' => 'CategoriesController@store', 'as' => 'categories.store']);

		Route::get('categories/index', ['uses' => 'CategoriesController@index', 'as' => 'categories.index']);
		//filtro paginado de categories
		Route::get('categories/pagination', function(){
		            return \Datatables::eloquent(App\Category::query('categories'))->make(true);
		    });
		 //editar categories
		Route::get('categories/edit/{id?}', ['as'=>'edit', 'uses'=>'CategoriesController@edit']);
		Route::put('categories/update/{id}', ['as'=> 'categories.update', 'uses'=>'CategoriesController@update']);
		Route::get('categories/destroy/{id}', ['as' => 'categories.destroy', 'uses'=>'CategoriesController@destroy']);

		//rotas de Eventos ==================================
		Route::get('event/add', ['uses' => 'EventsController@create', 'as' => 'event.add']);
		Route::post('event/store', ['uses' => 'EventsController@store', 'as' => 'event.store']);

		Route::get('event/index', ['uses' => 'EventsController@index', 'as' => 'event.index']);
		//filtro paginado de categories
		Route::get('event/pagination', function(){
		            return \Datatables::eloquent(App\Event::query('events'))->make(true);
		    });
		 //editar categories
		Route::get('event/edit/{id?}', ['as'=>'edit', 'uses'=>'EventsController@edit']);
		Route::put('event/update/{id}', ['as'=> 'event.update', 'uses'=>'EventsController@update']);
		Route::get('event/destroy/{id}', ['as' => 'event.destroy', 'uses'=>'EventsController@destroy']);

		//rotas de Quotas ==================================
		Route::get('quotas/add', ['uses' => 'QuotasController@create', 'as' => 'quotas.add']);
		Route::post('quotas/store', ['uses' => 'QuotasController@store', 'as' => 'quotas.store']);

		Route::get('quotas/index', ['uses' => 'QuotasController@index', 'as' => 'quotas.index']);
		//filtro paginado de categories
		Route::get('quotas/pagination', function(){
		            return \Datatables::eloquent(App\Quota::query('quotas'))->make(true);
		    });
		 //editar categories
		Route::get('quotas/edit/{id?}', ['as'=>'edit', 'uses'=>'QuotasController@edit']);
		Route::put('quotas/update/{id}', ['as'=> 'quotas.update', 'uses'=>'QuotasController@update']);
		Route::get('quotas/destroy/{id}', ['as' => 'quotas.destroy', 'uses'=>'QuotasController@destroy']);

		//rotas de People responsaveis ==================================
		Route::get('people/add', ['uses' => 'PeopleController@create', 'as' => 'people.add']);
		Route::post('people/store', ['uses' => 'PeopleController@store', 'as' => 'people.store']);

		Route::get('people/index', ['uses' => 'PeopleController@index', 'as' => 'people.index']);
		//filtro paginado de categories
		Route::get('people/pagination', function(){
		            return \Datatables::eloquent(App\Person::query('people'))->make(true);
		    });
		 //editar categories
		Route::get('people/edit/{id?}', ['as'=>'edit', 'uses'=>'PeopleController@edit']);
		Route::put('people/update/{id}', ['as'=> 'people.update', 'uses'=>'PeopleController@update']);
		Route::get('people/destroy/{id}', ['as' => 'people.destroy', 'uses'=>'PeopleController@destroy']);
		//visao dos expositores particular
		Route::get('people/list', ['uses' => 'PeopleController@lista', 'as' => 'people.list']);
		Route::get('people/listpage', function(){
			return \Datatables::eloquent(App\Person::selectRaw('people.*')->where('user_id', Auth::user()->id ))->make(true);
		});
		//verificar cota de uma categoria de expositores
		Route::get('people/getstatus/{id?}', ['uses' => 'PeopleController@varrendoCadastrados']);

		//rotas para exportar / importar excel de Responsaveis
		Route::get('importExport', 'MaatwebsiteDemoController@importExport');
		Route::get('downloadExcel/{type}', 'MaatwebsiteDemoController@downloadExcel');
		Route::post('importExcel', ['uses' => 'MaatwebsiteDemoController@importExcel', 'as' => 'importExcel']);

		//cadastro de materials
		Route::get('materials/add', ['as'=>'materials.add', 'uses'=>'MaterialsController@create']);
		Route::post('materials/store', ['as'=>'materials.store', 'uses'=>'MaterialsController@store']);
		Route::get('materials/index', ['uses' => 'MaterialsController@index', 'as' => 'materials.index']);
		Route::get('materials/', ['uses' => 'MaterialsController@index', 'as' => 'materials']);
		Route::get('materials/pagination', function(){
			return \Datatables::eloquent(App\Material::selectRaw('materials.*')->where('company_id', Auth::user()->company_id ))->make(true);
		});
		Route::get('materials/edit/{id?}', ['uses' => 'MaterialsController@edit', 'as' => 'materials.edit']);
		Route::put('materials/update/{id}', ['uses'=>'MaterialsController@update', 'as'=>'materials.update']);

		/*
			Controle da Language
		*/
		Route::post('/language', ['Middleware'=> 'LanguageSwitcher', 'uses'=>'LanguageController@index']);
		/*
			UPLOADS DE ARQUIVOS PARA O MENU
		*/
		Route::get('/upload', function() {
		  return view('menu.index');
		});
		Route::post('apply/upload', ['uses'=>'ApplyController@upload', 'as'=>'apply.upload']);

});

//Route::get('users/add',['as'=>'users.add', 'uses'=> 'UsersController@create']);