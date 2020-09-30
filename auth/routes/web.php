<?php
Auth::routes();

Route::get('/', 'HomeController@index')->middleware('auth','general')->name('home');

/* AlertRF CRUD Routes for simple user */
Route::group([
    'as' => 'alertRF.',
    'prefix' => 'alertRF', 
    'namespace'=>'Simple', 
    'middleware' => ['auth','general', 'can:edit fournisseur']],
    function(){
        Route::get('create', 'AlertController@createRF')->name('create');
        Route::post('create', 'AlertController@storeRF')->name('store');
        Route::get('edit/{alert}', 'AlertController@editRF')->name('edit');
        Route::get('view/{alert}', 'AlertController@viewRF')->name('view');
        Route::post('update/{alert}', 'AlertController@updateRF')->name('update');
        Route::delete('delete/{alert}', 'AlertController@deleteRF')->name('delete');
        Route::get('fiche/{alert}', 'AlertController@generate_pdf_RF')->name('pdf');
    });   

/* AlertRP CRUD Routes for simple user */
Route::group([
    'as' => 'alertRP.',
    'prefix' => 'alertRP', 
    'namespace'=>'Simple', 
    'middleware' => ['auth','general', 'can:edit atelier']],
    function(){
        Route::get('create', 'AlertController@createRP')->name('create');
        Route::post('create', 'AlertController@storeRP')->name('store');
        Route::get('edit/{alert}', 'AlertController@editRP')->name('edit');
        Route::get('view/{alert}', 'AlertController@viewRP')->name('view');
        Route::post('update/{alert}', 'AlertController@updateRP')->name('update');
        Route::delete('delete/{alert}', 'AlertController@deleteRP')->name('delete');
        Route::get('fiche/{alert}', 'AlertController@generate_pdf_RP')->name('pdf');
    });

/* AlertRC CRUD Routes for simple user */
Route::group([
    'as' => 'alertRC.',
    'prefix' => 'alertRC', 
    'namespace'=>'Simple', 
    'middleware' => ['auth','general', 'can:edit client']],
    function(){
        Route::get('create', 'AlertController@createRC')->name('create');
        Route::post('create', 'AlertController@storeRC')->name('store');
        Route::get('edit/{alert}', 'AlertController@editRC')->name('edit');
        Route::get('view/{alert}', 'AlertController@viewRC')->name('view');
        Route::post('update/{alert}', 'AlertController@updateRC')->name('update');
        Route::delete('delete/{alert}', 'AlertController@deleteRC')->name('delete');
        Route::get('fiche/{alert}', 'AlertController@generate_pdf_RC')->name('pdf');
    });

    /* To make both gestionnaire & simple users view list alerts */
    Route::get('alertRF/list', 'Simple\AlertController@showRF')
    ->middleware('auth', 'general','role_or_permission:edit fournisseur|gestionnaire')
    ->name('alertRF.list'); 

    Route::get('alertRC/list', 'Simple\AlertController@showRC')
    ->middleware('auth','general', 'role_or_permission:edit client|gestionnaire')
    ->name('alertRC.list'); 

    Route::get('alertRP/list', 'Simple\AlertController@showRP')
    ->middleware('auth','general', 'role_or_permission:edit atelier|gestionnaire')
    ->name('alertRP.list'); 

    Route::get('alert/update/{alert}', 'Simple\AlertController@updateRead')
    ->middleware('auth','general')
    ->name('alert.updateRead'); 
    
    
                                /********** ADMIN USER Routes ***********/

/* Admin authentication accueil route */
Route::get('admin/accueil',function () { return view('admin.accueil');})
->middleware('auth','general', 'role:admin')
->name('admin.accueil');

/* User CRUD Routes for admin user only */
Route::group([
    'as' => 'user.',
    'prefix' => 'user', 
    'namespace'=>'Admin', 
    'middleware' => ['auth','general', 'role:admin', 'can:edit user']],
    function(){
        Route::get('dashbord', 'UserController@index')->name('dashbord');
        Route::get('create', 'UserController@create')->name('create');
        Route::post('create', 'UserController@store')->name('store');
        Route::get('edit/{user}', 'UserController@edit')->name('edit');
        Route::post('update/{user}', 'UserController@update')->name('update');
        Route::delete('delete/{user}', 'UserController@delete')->name('delete');
    });

/* Role CRUD Routes for admin user only */
Route::group([
    'as' => 'role.',
    'prefix' => 'role', 
    'namespace'=>'Admin', 
    'middleware' => ['auth', 'general','role:admin', 'can:edit user']],
    function(){
        Route::get('dashbord', 'RoleController@index')->name('dashbord');
        Route::get('create', 'RoleController@create')->name('create');
        Route::post('create', 'RoleController@store')->name('store');
        Route::get('edit/{role}', 'RoleController@edit')->name('edit');
        Route::post('update/{role}', 'RoleController@update')->name('update');
        Route::delete('delete/{role}', 'RoleController@delete')->name('delete');
    });

/* Permision CRUD Routes for admin user only */
Route::group([
    'as' => 'permission.',
    'prefix' => 'permission', 
    'namespace'=>'Admin', 
    'middleware' => ['auth', 'general','role:admin' , 'can:edit user']],
    function(){
        Route::get('dashbord', 'PermissionController@index')->name('dashbord');
        Route::get('create', 'PermissionController@create')->name('create');
        Route::post('create', 'PermissionController@store')->name('store');
        Route::get('edit/{permission}', 'PermissionController@edit')->name('edit');
        Route::post('update/{permission}', 'PermissionController@update')->name('update');
        Route::delete('delete/{permission}', 'PermissionController@delete')->name('delete');
    });


                            /********** Gestionnaire USER Routes ***********/
/* Gestionnaire authentication accueil route */
Route::get('gestionnaire/accueil',function () { return view('gestionnaire.accueil');})
->middleware('auth','general', 'role:gestionnaire')
->name('gestionnaire.accueil');

/* Action CRUD Routes for gestionnaire user */
Route::group([
    'as' => 'action.',
    'prefix' => 'action', 
    'namespace'=>'Gestionnaire', 
    'middleware' => ['auth','general', 'role:gestionnaire']],
    function(){
        Route::get('list', 'ActionController@index')->name('list');
        Route::get('create', 'ActionController@create')->name('create');
        Route::post('create', 'ActionController@store')->name('store');
        Route::get('edit/{action}', 'ActionController@edit')->name('edit');
        Route::post('update/{action}', 'ActionController@update')->name('update');
        Route::delete('delete/{action}', 'ActionController@delete')->name('delete');
    });
    
/* Anomalie CRUD Routes for gestionnaire user */
Route::group([
    'as' => 'anomalie.',
    'prefix' => 'anomalie', 
    'namespace'=>'Gestionnaire', 
    'middleware' => ['auth','general', 'role:gestionnaire']],
    function(){
        Route::get('dashbord', 'AnomalieController@index')->name('dashbord');
        Route::get('create', 'AnomalieController@createFromScratch')->name('createFromScratch');
        Route::get('create/{id}', 'AnomalieController@createFrom')->name('createFrom');
        Route::post('create-step1', 'AnomalieController@postCreateStep1')->name('create-step1');
        Route::post('create-step2', 'AnomalieController@postCreateStep2')->name('create-step2');
        Route::post('create-step3', 'AnomalieController@postCreateStep3')->name('create-step3');
        Route::post('store', 'AnomalieController@store')->name('create-step4');
        Route::delete('delete/{anomalie}', 'AnomalieController@delete')->name('delete');
        Route::get('previous/{anomalie}', 'AnomalieController@previous')->name('previous');
        Route::get('pdf/{anomalie}', 'AnomalieController@generate_pdf')->name('pdf'); 
        Route::get('view/{anomalie}', 'AnomalieController@view')->name('view');
        Route::get('export', 'AnomalieController@export')->name('export');
    });

/* Inspection CRUD Routes for gestionnaire user */
Route::group([
    'as' => 'inspection.',
    'prefix' => 'inspection', 
    'namespace'=>'Gestionnaire', 
    'middleware' => ['auth', 'general','role:gestionnaire']],
    function(){
        Route::get('dashbord', 'InspectionController@index')->name('dashbord');
        Route::get('create', 'InspectionController@create')->name('create');
        Route::get('create/{id}', 'InspectionController@createFrom')->name('createFrom');
        Route::post('create-step1', 'InspectionController@postCreateStep1')->name('create-step1');
        Route::post('create-step2', 'InspectionController@postCreateStep2')->name('create-step2');
        Route::post('store', 'InspectionController@store')->name('create-step3');
        Route::delete('delete/{inspection}', 'InspectionController@delete')->name('delete');
        Route::get('previous/{inspection}', 'InspectionController@previous')->name('previous');
        Route::get('edit/{inspection}', 'InspectionController@edit')->name('edit');
        Route::get('pdf/{inspection}', 'InspectionController@generate_pdf')->name('pdf'); 
        Route::get('view/{inspection}', 'InspectionController@view')->name('view');
        Route::get('export', 'InspectionController@export')->name('export');
    });

/* Audit CRUD Routes for gestionnaire user */
Route::group([
    'as' => 'audit.',
    'prefix' => 'audit', 
    'namespace'=>'Gestionnaire', 
    'middleware' => ['auth','general', 'role:gestionnaire']],
    function(){
        Route::get('dashbord', 'AuditController@index')->name('dashbord');
        Route::get('create', 'AuditController@create')->name('create');
        Route::get('create/{id}', 'AuditController@createFrom')->name('createFrom');
        Route::post('create-step1', 'AuditController@postCreateStep1')->name('create-step1');
        Route::post('create-step2', 'AuditController@postCreateStep2')->name('create-step2');
        Route::post('store', 'AuditController@store')->name('create-step3');
        Route::delete('delete/{audit}', 'AuditController@delete')->name('delete');
        Route::delete('deleteQ/{questionnaire}', 'AuditController@deleteQ')->name('deleteQ');
        Route::get('previous/{audit}', 'AuditController@previous')->name('previous');
        Route::get('edit/{audit}', 'AuditController@edit')->name('edit');
        Route::get('pdf/{audit}', 'AuditController@generate_pdf')->name('pdf'); 
        Route::get('view/{audit}', 'AuditController@view')->name('view');
        Route::get('export', 'AuditController@export')->name('export');
    });


/* Calendrier CRUD Routes for gestionnaire user */
Route::group([
    'as' => 'calendrier.',
    'prefix' => 'calendrier', 
    'namespace'=>'Gestionnaire', 
    'middleware' => ['auth','general', 'role:gestionnaire']],
    function(){
        Route::get('/', 'CalendrierController@index')->name('dashbord');
        Route::post('/create','CalendrierController@create');
        Route::post('/update','CalendrierController@update');
        Route::post('/delete','CalendrierController@destroy');
    });

/* Test CRUD Routes for gestionnaire user */
Route::group([
    'as' => 'test.',
    'prefix' => 'test', 
    'namespace'=>'Gestionnaire', 
    'middleware' => ['auth','general', 'role:gestionnaire']],
    function(){
        Route::get('list', 'TestController@show')->name('list');
        Route::get('create', 'TestController@create')->name('create');
        Route::post('create', 'TestController@store')->name('store');
        Route::get('edit/{test}', 'TestController@edit')->name('edit');
        Route::post('update/{test}', 'TestController@update')->name('update');
        Route::delete('delete/{test}', 'TestController@delete')->name('delete');
        Route::get('createExamen', 'TestController@createExamen')->name('createExamen');
        Route::post('createExamen','TestController@storeExamen')->name('storeExamen');
    });


/* Régle qualité CRUD Routes for gestionnaire user */
Route::group([
    'as' => 'regle.',
    'prefix' => 'regle', 
    'namespace'=>'Gestionnaire', 
    'middleware' => ['auth','general', 'role:gestionnaire']],
    function(){
        Route::get('list', 'RegleController@show')->name('list');
        Route::get('create', 'RegleController@create')->name('create');
        Route::post('create', 'RegleController@store')->name('store');
        Route::get('edit/{regle}', 'RegleController@edit')->name('edit');
        Route::post('update/{regle}', 'RegleController@update')->name('update');
        Route::delete('delete/{regle}', 'RegleController@delete')->name('delete');
    });

    Route::group([ 
        'namespace'=>'Front', 
        'middleware' => ['auth'] ],
        function(){
            Route::get('index123', 'UserController@Getindex');  
        });

/* Statistiques routes */
Route::group([
    'as' => 'statistiques.',
    'namespace'=>'Gestionnaire', 
    'prefix' => 'statistiques', 
    'middleware' => ['auth', 'general','role:gestionnaire|admin']],
    function(){     
        Route::get('retour/{year}', 'StatistiquesController@indexRetour')->name('retour');
        Route::get('article/{year}', 'StatistiquesController@indexArticle')->name('article');
        Route::get('audit/{year}', 'StatistiquesController@indexAudit')->name('audit');
        Route::get('inspection/{year}', 'StatistiquesController@indexInspection')->name('inspection');
        Route::get('retourClient/{year}', 'StatistiquesController@indexRetourClient')->name('retourClient');
        Route::get('retourFournisseur/{year}', 'StatistiquesController@indexRetourFournisseur')->name('retourFournisseur');
        Route::get('retourProduction/{year}', 'StatistiquesController@indexRetourProduction')->name('retourProduction');
    });

                            /********** SIMPLE USER ***********/
/* Simple user authentication accueil route */
Route::get('simple/accueil',function () { return view('simple.accueil');})
->middleware('auth','general', 'role:simple')
->name('simple.accueil');

/* Produit CRUD Routes for simple user */
Route::group([
    'as' => 'produit.',
    'prefix' => 'produit', 
    'namespace'=>'Simple', 
    'middleware' => ['auth','general', 'role:simple']],
    function(){
        Route::get('list', 'ProduitController@index')->name('list');
        Route::get('create', 'ProduitController@create')->name('create');
        Route::post('create', 'ProduitController@store')->name('store');
        Route::get('edit/{produit}', 'ProduitController@edit')->name('edit');
        Route::post('update/{produit}', 'ProduitController@update')->name('update');
        Route::delete('delete/{produit}', 'ProduitController@delete')->name('delete');
        Route::get('export', 'ProduitController@export')->name('export');
        Route::post('import', 'ProduitController@import')->name('import');
    });
/* Client CRUD Routes for simple user */
Route::group([
    'as' => 'client.',
    'prefix' => 'client', 
    'namespace'=>'Simple', 
    'middleware' => ['auth', 'general','permission:edit client']],
    function(){
        Route::get('list', 'ClientController@index')->name('list');
        Route::get('create', 'ClientController@create')->name('create');
        Route::post('create', 'ClientController@store')->name('store');
        Route::get('edit/{client}', 'ClientController@edit')->name('edit');
        Route::post('update/{client}', 'ClientController@update')->name('update');
        Route::delete('delete/{client}', 'ClientController@delete')->name('delete');
        Route::get('export', 'ClientController@export')->name('export');
        Route::post('import', 'ClientController@import')->name('import');
    });
/* Fournisseur CRUD Routes for simple user */
Route::group([
    'as' => 'fournisseur.',
    'prefix' => 'fournisseur', 
    'namespace'=>'Simple', 
    'middleware' => ['auth','general', 'permission:edit fournisseur']],
    function(){
        Route::get('list', 'FournisseurController@index')->name('list');
        Route::get('create', 'FournisseurController@create')->name('create');
        Route::post('create', 'FournisseurController@store')->name('store');
        Route::get('edit/{fournisseur}', 'FournisseurController@edit')->name('edit');
        Route::post('update/{fournisseur}', 'FournisseurController@update')->name('update');
        Route::delete('delete/{fournisseur}', 'FournisseurController@delete')->name('delete');
        Route::get('export', 'FournisseurController@export')->name('export');
        Route::post('import', 'FournisseurController@import')->name('import');
    });




    
/* Atelier CRUD Routes for simple user */
Route::group([
    'as' => 'atelier.',
    'prefix' => 'atelier', 
    'namespace'=>'Simple', 
    'middleware' => ['auth','general', 'permission:edit atelier']],
    function(){
        Route::get('list', 'AtelierController@index')->name('list');
        Route::get('create', 'AtelierController@create')->name('create');
        Route::post('create', 'AtelierController@store')->name('store');
        Route::get('edit/{atelier}', 'AtelierController@edit')->name('edit');
        Route::post('update/{atelier}', 'AtelierController@update')->name('update');
        Route::delete('delete/{atelier}', 'AtelierController@delete')->name('delete');
        Route::get('export', 'AtelierController@export')->name('export');
        Route::post('import', 'AtelierController@import')->name('import');
    });


