<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Str;
use App\Http\Resources\Product\ProductSearchCollection;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::get('test', function() {
	
	// $design = \App\Design::find(9);
	// $product_quotation = $design->quotation;
	// $product_quotation->update(['state' => 1]);
	// $path = app_path();
// 	$path = 'http://imagen-erp.test/img/quotations/BuHcE61h9H3DKuA.jpeg';
// $type = pathinfo($path, PATHINFO_EXTENSION);
// $data = file_get_contents($path);
// $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
	

	// $data = \App\ImagesProduct::where('product_quotation_id', 538)->get();
    // if ($data) {
    // 	return 'si';
    // } else {
    // 	return 'no';
    // }
    // $a = empty($data);


    // $product_quotation = \App\ProductQuotation::find(541);

    // $children = $product_quotation->images;
    // $contact_items = collect([
    // 	['id' => 309, 'path' => 'ss.png', 'product_quotation_id' => 541],
    // 	['id' => 312, 'path' => 'nano.jpeg', 'product_quotation_id' => 542]
    // ]);

    // $deleted_ids = $children->filter(function ($child) use ($contact_items) {
    //     return empty($contact_items->where('id', $child->id)->first());
    // })->map(function ($child) {
    //     $id = $child->id;
    //     $child->delete();
    //     return $id;
    // });

    // $children = $product_quotation->refresh();
    // $updates = $contact_items->filter(function ($contact) {
    //     return isset($contact['id']);
    // })->map(function ($contact) use ($children) {
    //     $children->images->map(function ($c) use ($contact) {
    //         $c->updateOrCreate([
    //             'id' => $contact['id']
    //         ],[
    //             'path' => $contact['path'],
    //             'product_quotation_id' => $contact['product_quotation_id'],
    //         ]);
    //     });
    // });

    // $attachments = $contact_items->filter(function ($contact) {
    //     return ! isset($contact['id']);
    // })->map(function ($contact) use ($deleted_ids) {
    //     $contact['id'] = $deleted_ids->pop();
    //     return $contact;
    // })->toArray();

    // $product_quotation->images()->createMany($attachments);

 //    $quotation = \App\Quotation::find(307);

 //    $data = [
	//     [
	// 	    "id" => 16,
	// 	    "name" => "McGlynn-Pollich",
	// 	    "quantity" => 1,
	// 	    "dimension" => "10 x 5",
	// 	    "description" => "test 1",
	// 	    "price" => "150.00",
	// 	    "subtotal" => 7500,
	// 	    "state" => 0,
	// 	    "showImage" => true,
	// 	    "images" => [
	// 	        [ "id" => 309, "path" => "15853220415e7e1839994fd.jpeg" ],
	// 		],
	// 	],
	// 	[
	// 	    "id" => 16,
	// 	    "name" => "McGlynn-Pollich",
	// 	    "quantity" => 1,
	// 	    "dimension" => "10 x 5",
	// 	    "description" => "test 2",
	// 	    "price" => "150.00",
	// 	    "subtotal" => 7500,
	// 	    "state" => 0,
	// 	    "showImage" => true,
	// 	    "images" => [
	// 	        [ "path" => "15853220415e7e1839994bd.jpeg" ],
	// 		],
	// 	],
	//     [
	// 	    "id" => 8,
 //            "name" => "Lemke-Johns",
 //            "quantity" => 1,
 //            "dimension" => "7 x 5",
 //            "description" => "test 2",
 //            "price" => "230.00",
 //            "subtotal" => 8050,
 //            "state" => 0,
 //            "showImage" => true,
	// 	    "images" => [
	// 	        [ "id" => 376, "path" => "30081992.jpeg" ],
	// 		],
	//     ]
	// ];
 
    //comparar product_id con id del array request
 //    $multiplied = $quotation->products->map(function ($item) {
	//     return $item->pivot;
	// });

	// $da = null;

 //    if (isset($data[0]['id'])) {
 //    	$da ='si';
 //    } else {
 //        $da ='no';
r //    }

 //    $ProductQuotation = collect([]);
	// foreach ($data as $value) {
	// 	foreach ($multiplied as $pivot) {
	// 		if ($value['id'] === $pivot['product_id']) {
	// 			$pivot['files'] = $value['images']; 
	// 	        $ProductQuotation[] = $pivot;
	// 		}
	// 	}
	// }

	// $ProductQuotation->each(function ($item) {
	// 	$children = $item->images;
 //        $files_request = collect($item->files);

 //        $deleted_ids = $children->filter(function ($child) use ($files_request) {
	//         return empty($files_request->where('id', $child->id)->first());
	//     })->map(function ($child) {
	//         $id = $child->id;
	//         $child->delete();
	//         return $id;
	//     });

	//     $attachments = $files_request->filter(function ($file) {
	//         return ! isset($file['id']);
	//     })->map(function ($val) use ($item) {
	//         $val['product_quotation_id'] = $item->id;
	//         return $val;
	//     })->toArray();

	//     $item->images()->createMany($attachments);
	// });

    // $children = collect([
	// 	[
	// 		"id" => 309,
	// 		"path" => "15853220415e7e1839994fd.jpeg",
	// 		"product_quotation_id" => 543,
	// 		"created_at" => "2020-03-31 18:16:17",
	// 		"updated_at" => "2020-04-01 05:20:16"
	// 	]
	// ]);

    //no lo mando tengo q eliminar
	// $files_request = collect([
 //    	['path' => 'image1.png'],
 //    ]);

    //recibir un modelo que es el q tengo que instanciar
	// $data = \App\Product::whereRaw("MATCH (name) AGAINST (? IN BOOLEAN MODE)" , fullTextWildcardsInitEnd('vamke'))->join('costs as c', 'products.id', '=', 'c.product_id')
 //          ->where(function($query) {
 //            $query->where('c.active', 1)
 //                  ->where('c.office_id', 1);
 //        })->select('products.id', 'products.name', 'c.price_with_tax AS price')->get();
	// $office = 1;
	// $product = 21;
	// $field = 'price_with_tax';
	// $data = \App\Cost::where(function($query) use ($office, $product) {
 //            $query->where('active', 1)
 //                  ->where('office_id', $office)
 //                  ->where('product_id', $product);
 //        })->select($field)->first();

	// $a = collect($data);

	// if ($data instanceof Illuminate\Support\Collection) {
 //      return response()->json('si');
 //    } else {
 //      return response()->json('no');
 //    }
	// $id = \App\Design::whereNull('product_quotation_id')->get();
	// return $id;
	// $invID = str_pad(1, 6, '0', STR_PAD_LEFT);
    // return view('pdf.workorder');

    // $string = ltrim('12', '0');
    // $data = \App\City::select('name', DB::raw('
    // 	    count(if(month(date) = 1, q.office_id, null))  AS Ene,
		  //   count(if(month(date) = 2, q.office_id, null))  AS Feb,
		  //   count(if(month(date) = 3, q.office_id, null))  AS Mar,
		  //   count(if(month(date) = 4, q.office_id, null))  AS Abr,
		  //   count(if(month(date) = 5, q.office_id, null))  AS May,
		  //   count(if(month(date) = 6, q.office_id, null))  AS Jun,
		  //   count(if(month(date) = 7, q.office_id, null))  AS Jul,
		  //   count(if(month(date) = 8, q.office_id, null))  AS Ago,
		  //   count(if(month(date) = 9, q.office_id, null))  AS Sep,
		  //   count(if(month(date) = 10, q.office_id, null)) AS Oct,
		  //   count(if(month(date) = 11, q.office_id, null)) AS Nov,
		  //   count(if(month(date) = 12, q.office_id, null)) AS Dic'))
    //         ->join('offices AS o', 'o.city_id', '=', 'cities.id')
    //         ->leftjoin('quotations AS q', function ($join) {
	   //          $join->on('q.office_id', '=', 'o.id')
	   //              ->where('q.date', '>=', DB::raw("DATE_FORMAT(NOW() ,'%Y-01-01')"))
    //                 ->where('q.date', '<=', DB::raw("DATE_FORMAT(NOW(), '%Y-12-31')"));
	   //      })
    //         ->groupBy('cities.name')
    //         ->get();

    // $data2 = \App\City::select('name', DB::raw('COUNT(*) AS total'))
    //         ->join('offices AS o', 'o.city_id', '=', 'cities.id')
    //         ->join('quotations AS q', 'q.office_id', '=', 'o.id')
    //         ->where('q.state_id', 2)
    //         ->where(function($query) {
    //         $query->where('q.date', '>=', DB::raw("DATE_FORMAT(NOW() ,'%Y-01-01')"))
    //               ->where('q.date', '<=', DB::raw("DATE_FORMAT(NOW(), '%Y-12-31')"));
    //         })
    //         ->groupBy('cities.name')
    //         ->get();
    // $json = ['pending' => $data];
    // $data = \App\quotation::find(3)->office->id;

    $data = [
    	["cite"=>"SCZ-9-20","fecha"=>"2020-09-25","cliente"=>"Stokes-Cassin","monto"=>347.86],
    	["cite"=>"SCZ-9-20","fecha"=>"2020-09-25","cliente"=>"Stokes-Cassin","monto"=>347.86]
    ];



	setlocale(LC_ALL, "es_ES");
    date_default_timezone_set('America/Caracas');
    $fecha = date("Y-m-d H:i:s");

    $ano = date('Y',strtotime($fecha));
	$mes = date('n',strtotime($fecha));
	$dia = date('d',strtotime($fecha));
	$diasemana = date('w',strtotime($fecha));
	$diassemanaN= array("Domingo","Lunes","Martes","Miércoles",
	                  "Jueves","Viernes","Sábado");
	$mesesN=array(1=>"Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio",
	             "Agosto","Septiembre","Octubre","Noviembre","Diciembre");
	// return "$dia ". $mesesN[$mes] ." de $ano";

	$myString = "SUCURSAL 1,Calle 6 Nº 27,Zona / Barrio Cordecruz,Telf.: 3494677 - 76722731,Santa Cruz - Bolivia";
	$myArray = explode(',', $myString);

	$fecha = date('Y-m-d H:i:s', strtotime('2020-11-14'));
	// $fecha_inv = implode("", array_reverse(explode("/", $fecha)));

	// $codcontrol_fecha = str_replace("/", "", date('Y/m/d'));
	$date = DateTime::createFromFormat('Y-m-d', '2020-11-14');
	$data = \App\Quotation::find(49);

	// return number_format((float)"18000", 2, '.', ',');

	$invoices = \App\Invoice::where('cancelled', 0)->get();
    $notes = \App\Note::where('cancelled', 0)->get();

	$data = collect($invoices)->merge($notes)->paginate(10);
	
	return $data;
});

Route::get('invoice', 'TestController@index');
Route::get('invoice-download', 'TestController@download');
Route::get('invoice-code', 'TestController@generateCodeControl');

// \DB::listen(function($query) {
//     var_dump($query->sql);
// });

// DELIMITER $$
 
// CREATE TRIGGER before_quotations_insert
// BEFORE INSERT
// ON quotations FOR EACH ROW
// BEGIN
//     DECLARE code_city VARCHAR;
//     DECLARE id_city INT;
//     DECLARE number_quo INT;
//     DECLARE year_quo INT DEFAULT YEAR(CURDATE());
//     DECLARE cite varchar;
    
//     SELECT c.code INTO code_city, c.id INTO id_city
// 	 FROM cities AS c
// 	 INNER JOIN offices AS o
// 	 ON c.id = o.city_id
// 	 INNER JOIN users AS u
// 	 ON u.office_id = o.id
// 	 WHERE u.id = NEW.user_id
	 
// 	 SELECT number_quotation INTO number_quo FROM code_cities WHERE city_id = id_city
    
//     IF number_quo > 0 THEN
//         UPDATE code_cities SET number_quotation = number_quotation + 1;
//         SET @cite := CONCAT(code_city, '-', number_quotation + 1, '-', year_quo);
//         SET NEW.cite = cite;
//     ELSE
//         INSERT INTO code_cities(number_quotation, city_id) VALUES (1, id_city);
//         SET @cite := CONCAT(code_city, '-', 1, '-', year_quo);
//         SET NEW.cite = cite;
//     END IF; 
 
// END $$
 
// DELIMITER ;

Route::post('/login', 'AuthController@login');

//listas
Route::get('cities/listing', 'CityController@listing');
Route::get('offices/listing', 'OfficeController@listing');
Route::get('employees/listing', 'EmployeeController@listing');
Route::get('customers/listing', 'CustomerController@listing');
Route::get('categories/listing', 'CategoryController@listing');
Route::get('profiles/listing', 'ProfileController@listing');
Route::get('users/listing', 'UserController@listing');
Route::get('actions/listing', 'ActionController@listing');

Route::group(['middleware' => ['auth:api', 'acl:api']], function() {
	Route::post('logout', 'AuthController@logout');
	
	
	//accounts
	Route::get('accounts/receivable', 'AccountController@receivable')->name('accounts.index');//agregar y ver permisos
    Route::get('accounts/cancelled', 'AccountController@cancelled')->name('accounts.index');
    Route::post('accounts/receivable/list-pdf', 'AccountController@listReceivablePdf');
	Route::post('accounts/receivable/list-excel', 'AccountController@listReceivableExcel');
	Route::post('accounts/cancelled/list-pdf', 'AccountController@listCancelledPdf');
	Route::post('accounts/cancelled/list-excel', 'AccountController@listCancelledExcel');
    Route::post('accounts/close', 'AccountController@closeAccount')->name('accounts.close');

    //licenses
	Route::post('licenses/dosage', 'LicenseController@getLicense');
	
	//vouchers
	Route::post('vouchers', 'VoucherController@getVoucher');
	
	//Payments
	Route::post('payments', 'PaymentController@store');//agregar permisos
	Route::put('payments/{payment}', 'PaymentController@update');
	Route::delete('payments/{payment}', 'PaymentController@destroy');
	
	//invoices
	Route::get('invoices', 'InvoiceController@index')->name('invoices.index');
    Route::post('invoices', 'InvoiceController@store')->name('invoices.create');
	Route::put('invoices/canceled/{invoice}', 'InvoiceController@cancelInvoice');
	Route::get('invoices/download/{invoice}', 'InvoiceController@invoicePdf');
	Route::post('invoices/list-pdf', 'InvoiceController@listPdf');
	Route::post('invoices/list-excel', 'InvoiceController@listExcel');

	//notes
	Route::get('notes', 'NoteController@index')->name('notes.index');
    Route::post('notes', 'NoteController@store')->name('notes.create');
	Route::get('notes/download/{note}', 'NoteController@notePdf');
	Route::post('notes/list-pdf', 'NoteController@listPdf');
	Route::post('notes/list-excel', 'NoteController@listExcel');

	//materials
	Route::get('materials', 'MaterialController@index');
	Route::get('materials/search', 'MaterialController@search');
	Route::post('materials', 'MaterialController@store');
	Route::put('materials/{material}', 'MaterialController@update');
    Route::delete('materials', 'MaterialController@destroy');

    //cities
    Route::get('cities/status', 'CityController@statesByCity');
    Route::get('cities/quotes', 'CityController@quotesPerMonth');

	//customers
	Route::get('customers', 'CustomerController@index')->name('customers.index');
	Route::get('customers/search', 'CustomerController@search');
	Route::post('customers', 'CustomerController@store')->name('customers.create');
	Route::post('customers/list-pdf', 'CustomerController@listPdf');
	Route::post('customers/list-excel', 'CustomerController@listExcel');
	Route::get('customers/quotes', 'CustomerController@getCustomerQuotes');
	Route::get('customers/{customer}/edit', 'CustomerController@show');
	Route::get('customers/{customer}/detail', 'CustomerController@detail')->name('customers.show');
	Route::put('customers/{customer}', 'CustomerController@update')->name('customers.update');
	Route::delete('customers', 'CustomerController@destroy')->name('customers.destroy');

	//products
	Route::get('products', 'ProductController@index')->name('products.index');
	Route::get('products/search', 'ProductController@search');
	Route::post('products', 'ProductController@store')->name('products.create');
	Route::post('products/list-pdf', 'ProductController@listPdf');
	Route::post('products/list-excel', 'ProductController@listExcel');
	Route::get('products/{product}/edit', 'ProductController@show');
	Route::get('products/{product}/detail', 'ProductController@detail')->name('products.show');
	Route::put('products/{product}', 'ProductController@update')->name('products.update');
	Route::delete('products', 'ProductController@destroy')->name('products.destroy');

	//costs
	Route::post('costs', 'CostController@store')->name('products.create');
	Route::put('costs/{cost}', 'CostController@update')->name('products.update');
	Route::put('costs/active/{cost}', 'CostController@active')->name('products.update');

	//quotations
	Route::get('quotations', 'QuotationController@index')->name('quotations.index');
	Route::get('quotations/search', 'QuotationController@search');
	Route::get('quotations/pending', 'QuotationController@pending')->name('quotations.pending');
	Route::get('quotations/approved', 'QuotationController@approved')->name('quotations.approved');
	Route::get('quotations/executed', 'QuotationController@executed')->name('quotations.executed');
	Route::post('quotations', 'QuotationController@store')->name('quotations.create');
	Route::post('quotations/list-pdf', 'QuotationController@listPdf');
	Route::post('quotations/list-excel', 'QuotationController@listExcel');
	Route::get('quotations/{quotation}/edit', 'QuotationController@show');
	Route::get('quotations/products/{quotation}', 'QuotationController@getProductsQuotation');//aqui
	Route::get('quotations/{quotation}', 'QuotationController@show')->name('quotations.show');
	Route::get('download/quotation/{quotation}', 'QuotationController@quotationPdf');
	Route::put('quotations/{quotation}', 'QuotationController@update')->name('quotations.update');
	//todo protejer com mdw
	//controlar que no se puedan editar los datos una vez aprovada y ejecutada la cotizacion
	Route::put('quotations/approved/{quotation}', 'QuotationController@approvedQuotation')->name('designs.create');
	Route::delete('quotations', 'QuotationController@destroy')->name('quotations.destroy');

	//designs
	Route::post('designs', 'DesignController@store')->name('designs.create');
	Route::post('designs/download', 'DesignController@designPdf');
	Route::put('designs/{id}', 'DesignController@update')->name('designs.update');

	//workorders
	Route::get('workorders', 'WorkOrderController@index')->name('workorders.index');
	Route::post('workorders', 'WorkOrderController@store')->name('workorders.create');
	Route::post('workorders/download', 'WorkOrderController@workOrderPdf');
	Route::post('workorders/list-pdf', 'WorkOrderController@listPdf');
	Route::post('workorders/list-excel', 'WorkOrderController@listExcel');
	Route::put('workorders/{workOrder}', 'WorkOrderController@update')->name('workorders.update');
	//todo protejer com mdw
	//controlar que no se puedan editar los datos una vez aprovada y ejecutada la cotizacion
	Route::put('workorders/finish/{workOrder}', 'WorkOrderController@finishWorkOrder')->name('workorders.create');

	//Employees
	Route::get('employees', 'EmployeeController@index')->name('employees.index');
	Route::post('employees', 'EmployeeController@store')->name('employees.create');
	Route::post('employees/list-pdf', 'EmployeeController@listPdf');
	Route::post('employees/list-excel', 'EmployeeController@listExcel');
	Route::get('employees/{employee}/edit', 'EmployeeController@show')->name('employees.show');
	Route::put('employees/{employee}', 'EmployeeController@update')->name('employees.update');
	Route::delete('employees', 'EmployeeController@destroy')->name('employees.destroy');

	//Profiles
    Route::get('profiles', 'ProfileController@index')->name('profiles.index');
    Route::post('profiles', 'ProfileController@store')->name('profiles.create');
    Route::get('profiles/{profile}/edit', 'ProfileController@show')->name('profiles.show');
    Route::put('profiles/{profile}', 'ProfileController@update')->name('profiles.update');
    Route::delete('profiles', 'ProfileController@destroy')->name('profiles.destroy');

    //User
    Route::get('users', 'UserController@index')->name('users.index');
    Route::post('users', 'UserController@store')->name('users.create');
    Route::put('users/state/{user}', 'UserController@changeState')->name('users.update');
    Route::get('users/{user}/edit', 'UserController@show')->name('users.show');
    Route::put('users/{user}', 'UserController@update')->name('users.update');
    Route::put('users/{user}/password', 'UserController@password');
    Route::delete('users', 'UserController@destroy')->name('users.destroy');

    //Reportes
    Route::post('reports/total_quotations', 'ReportController@totalQuotation')->name('reports.index');
    Route::post('reports/pdf_download', 'ReportController@pdfDownload')->name('reports.index');
    Route::post('reports/excel_download', 'ReportController@excelDownload')->name('reports.index');
});


