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
 //    }

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

	// $invoices = \App\Invoice::where('cancelled', 0)->get();
    // $notes = \App\Note::where('cancelled', 0)->get();

	// $data = collect($invoices)->merge($notes)->paginate(10);
	
	// return round(134.5466445,2);
	// $invoice = \App\Invoice::find(28);

	// $invoices = DB::table('quotations AS q')
 //          ->select('q.cite', 'q.date as fecha', 'c.business_name as cliente', DB::raw('q.amount - q.discount as monto'))
 //          ->join('customers AS c', 'c.id', '=', 'q.customer_id')
 //          ->where('state_id', 3)
 //          ->where('office_id', $request->office)
 //          ->where(function($query) use ($request) {
 //            $query->where('q.date', '>=', $request->initial_date)
 //                  ->where('q.date', '<=', $request->final_date)
 //                  ->whereNull('q.deleted_at');
 //            })
 //          ->get(); 

	$invoices = DB::table('invoices AS i')
            ->select('q.cite', 'i.date', 'c.business_name', 'i.total', DB::raw('COALESCE(SUM(p.amount), 0) AS cancelled'), DB::raw('FORMAT(i.total - COALESCE(SUM(p.amount), 0), 2) AS balance'))
            ->leftjoin('payments AS p', function($join) {
                $join->on('p.paymentable_id', 'i.id')
                  ->where('p.paymentable_type', 'App\Invoice');
            })
            ->join('customers AS c', 'c.id', '=', 'i.customer_id')
            ->join('quotations AS q', 'q.id', '=', 'i.quotation_id')
            ->join('licenses AS l', 'l.id', '=', 'i.license_id')
            ->join('offices AS o', 'o.id', '=', 'l.office_id')
            ->where('o.id', 2)
            ->where(function($query) {
                $query->whereDate('i.date', '>=', '2020-12-01')
                  ->whereDate('i.date', '<=', '2020-12-31')
                  ->whereNull('i.deleted_at');
            })
            ->groupBy('i.id')
            ->get();

    $notes = DB::table('notes AS n')
            ->select('q.cite', 'n.date', 'c.business_name', 'n.total', DB::raw('COALESCE(SUM(p.amount), 0) AS cancelled'), DB::raw('FORMAT(n.total - COALESCE(SUM(p.amount), 0), 2) AS balance'))
            ->leftjoin('payments AS p', function($join) {
                $join->on('p.paymentable_id', 'n.id')
                  ->where('p.paymentable_type', 'App\Note');
            })
            ->join('customers AS c', 'c.id', '=', 'n.customer_id')
            ->join('quotations AS q', 'q.id', '=', 'n.quotation_id')
            ->join('vouchers AS v', 'v.id', '=', 'n.voucher_id')
            ->join('offices AS o', 'o.id', '=', 'v.office_id')
            ->where('o.id', 1)
            ->where(function($query) {
                $query->whereDate('n.date', '>=', '2020-12-01')
                  ->whereDate('n.date', '<=', '2020-12-31')
                  ->whereNull('n.deleted_at');
            })
            ->groupBy('n.id')
            ->get();
    
	// $data = collect($invoices)->merge($notes);
	// $dt = round(disk_total_space("C:") / 1024 / 1024 / 1024);
	// $df = round(disk_free_space("C:") / 1024 / 1024 / 1024);
	// $du = $dt - $df;

	// $data = [
	// 	'total' => $dt,
	// 	'free' => $df,
	// 	'used' => $du
	// ];
 //    $data = \App\Quotation::where('id', 47)->first();
	// return $data->invoices->count();
    // $reservedSymbols = ['-', '+', '<', '>', '@', '(', ')', '~'];
    // $term = str_replace($reservedSymbols, '', '');

    // // $words = explode(' ', $term);

    // // foreach($words as $key => $word) {
    // //     if(strlen($word) >= 4) {
    // //         $words[$key] = '+' . $word . '*';
    // //     }
    // // }
    // // $searchTerm = implode( ' ', $words);
    // // $searchTerm = '+' . $term . '*';
    // if(strlen($term) >= 4) {
    //     $searchTerm = '"+' . $term . '*"';
    // } else if(strlen($term) === 0) {
    // 	$searchTerm = '';
    // } else {
    // 	$searchTerm = '+' . $term . '*';
    // }

    // return $searchTerm;
	// $license = \App\License::dosage(1);
	// $d = new DateTime('now');
	// // $d->setTimezone(new DateTimeZone('UTC'));
	// // return $d->format('Y-m-d H:i:s');
	// if($d->format('Y-m-d H:i:s') > $license->deadline)
	//   return 'vencido';
	// else
	//   return 'vigente';
	//$string_number = '1,512,523.55';
    // NOTE: You don't really have to use floatval() here, it's just to prove that it's a legitimate float value.
    //$number = floatval(str_replace(',', '.', str_replace(',', '', $string_number)));
    // At this point, $number is a "natural" float.
    //return response()->json($number);
	// $data = \App\WorkOrder::where('id', 107)->first();

	// $filtered = collect($data->tasks)->filter(function ($value, $key) {
	// 	return $value->completed === 1;
	// });
	// $data = \App\Customer::with('invoices', 'notes')->whereIn('id', [21])->get();
	$customer = \App\Quotation::where('office_id', 1)->get();

	// return json_decode('[[0,1,2,3,4,5,6,7,8,9],[1,2,3,4,0,6,7,8,9,5],[2,3,4,0,1,7,8,9,5,6],[3,4,0,1,2,8,9,5,6,7],[4,0,1,2,3,9,5,6,7,8],[5,9,8,7,6,0,4,3,2,1],[6,5,9,8,7,1,0,4,3,2],[7,6,5,9,8,2,1,0,4,3],[8,7,6,5,9,3,2,1,0,4],[9,8,7,6,5,4,3,2,1,0]]');
	
	

	function CalcVerhoeff($number, $iterations = 1) 
    {
		$d = [[0,1,2,3,4,5,6,7,8,9],[1,2,3,4,0,6,7,8,9,5],[2,3,4,0,1,7,8,9,5,6],[3,4,0,1,2,8,9,5,6,7],[4,0,1,2,3,9,5,6,7,8],[5,9,8,7,6,0,4,3,2,1],[6,5,9,8,7,1,0,4,3,2],[7,6,5,9,8,2,1,0,4,3],[8,7,6,5,9,3,2,1,0,4],[9,8,7,6,5,4,3,2,1,0]];
        $inv = [0,4,3,2,1,5,6,7,8,9];
        $p = [[0,1,2,3,4,5,6,7,8,9],[1,5,7,6,2,8,3,0,9,4],[5,8,0,3,7,9,6,1,4,2],[8,9,1,6,0,4,3,5,2,7],[9,4,5,3,1,2,6,8,7,0],[4,2,8,6,5,7,3,9,0,1],[2,7,9,3,8,0,6,4,1,5],[7,0,4,6,9,1,3,2,5,8]];

        $result = 0;
        $number = str_split(strrev($number), 1);
        foreach ($number as $key => $value) {
            $result = $d[$result][$p[($key + 1) % 8][$value]];
        }
        $result = strrev(implode('', $number)) . $inv[$result];
        if ($iterations > 1) {
            return CalcVerhoeff($result, --$iterations);
        }
        return $result;
    }

	// return CalcVerhoeff(bcadd(bcadd(bcadd(80, "148406028"), "2021/04/19"), 5000), 5);
	// return round(str_replace(",", ".", 5000),0);
	// return [
	// 	'price' => number_format((float)2000.56, 2, '.', ','),
	// 	'subtotal' => 2000.56,
	// ];
	
	// $string = ':asdfsfs:df|';
	// return \Uuid::generate();
// 	$data = \App\WorkOrder::where(function($query) {
// 		$query->whereHas('quotation', function ($query) {
// 		  return $query->where('office_id', 1);
// 	  });    
//   })
//   ->whereNull('closing_date')
//   ->orderBy('created_at', 'desc')
//   ->paginate(6);
// 	return $data;
    return \App\Notification::all();
	// return \App\Employee::where('office_id', 1)->pluck('id');
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
Route::get('machines/listing', 'MachineController@listing');
Route::get('categories/listing', 'CategoryController@listing');
Route::get('profiles/listing', 'ProfileController@listing');
Route::get('users/listing', 'UserController@listing');
Route::get('users/seller/listing', 'UserController@listSeller');
Route::get('actions/listing', 'ActionController@listing');
Route::get('billboard_types/listing', 'BillboardTypeController@listing');
Route::get('billboards/listing', 'BillboardController@listing');

Route::group(['middleware' => ['auth:api', 'acl:api']], function() {
	Route::post('logout', 'AuthController@logout');
	
	//billboards
	Route::get('billboards', 'BillboardController@index');
	Route::post('billboards', 'BillboardController@store');
	Route::get('billboards/{billboard}/edit', 'BillboardController@show');
	Route::get('billboards/{billboard}/detail', 'BillboardController@detail');
	Route::put('billboards/{billboard}', 'BillboardController@update');
    Route::delete('billboards/{billboard}', 'BillboardController@destroy');
    Route::get('billboards/search', 'BillboardController@search');//sin usar
    Route::get('billboards/last-billboard', 'BillboardController@getLastBillboard');
    Route::get('billboards/record', 'BillboardController@getRecordBillboard');
    Route::post('billboards/save-customer-img/{billboard}', 'BillboardController@saveCustomerImage');
    Route::post('billboards/save-user-img/{billboard}', 'BillboardController@saveUserImage');
    Route::post('billboards/presentation-pdf', 'BillboardController@presentationPdf');
	Route::post('billboards/list-pdf', 'BillboardController@listPdf');
	Route::post('billboards/detail-pdf', 'BillboardController@detailPdf');
	Route::post('billboards/list-excel', 'BillboardController@listExcel');
	Route::post('billboards/rentals-pdf', 'BillboardController@rentalsPdf');
	Route::post('billboards/rentals-excel', 'BillboardController@rentalsExcel');

	//rentals
	Route::get('rentals', 'RentalController@index');
	Route::post('rentals', 'RentalController@store');
	Route::get('rentals/{rental}/edit', 'RentalController@show');
	Route::get('rentals/{rental}/detail', 'RentalController@detail');
	Route::put('rentals/{rental}', 'RentalController@update');
    Route::delete('rentals', 'RentalController@destroy');
    Route::get('rentals/last-rental', 'RentalController@getLastRental');
	Route::get('rentals/renovations', 'RentalController@getRenovations');
    Route::post('rentals/list-pdf', 'RentalController@listPdf');
	Route::post('rentals/detail-pdf', 'RentalController@detailPdf');
	Route::post('rentals/list-excel', 'RentalController@listExcel');
	Route::post('rentals/renovations-pdf', 'RentalController@pdfListRenovations');
	Route::post('rentals/renovations-excel', 'RentalController@excelListRenovations');

	//accounts
	Route::get('accounts/receivable', 'AccountController@receivable')->name('accounts.index');//agregar y ver permisos
    Route::get('accounts/cancelled', 'AccountController@cancelled')->name('accounts.index');
    Route::post('accounts/receivable/list-pdf', 'AccountController@listReceivablePdf');
	Route::post('accounts/receivable/list-excel', 'AccountController@listReceivableExcel');
	Route::post('accounts/cancelled/list-pdf', 'AccountController@listCancelledPdf');
	Route::post('accounts/cancelled/list-excel', 'AccountController@listCancelledExcel');
    Route::post('accounts/close', 'AccountController@closeAccount')->name('accounts.close');

	//machines
	Route::get('machines', 'MachineController@index');
	Route::get('machines/search', 'MachineController@search');
	Route::post('machines', 'MachineController@store')->name('designs.create');
	Route::get('machines/{machine}/edit', 'MachineController@show');
	Route::put('machines/{machine}', 'MachineController@update')->name('designs.update');
	Route::delete('machines', 'MachineController@destroy')->name('designs.update');

	//tasks
	Route::post('tasks', 'TaskController@store')->name('tasks.create');
	Route::post('tasks/close', 'TaskController@closeTasks')->name('tasks.close');

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
	Route::put('invoices/{invoice}', 'InvoiceController@update')->name('invoices.update');
	Route::put('invoices/canceled/{invoice}', 'InvoiceController@cancelInvoice')->name('invoices.cancel');
	Route::get('invoices/download/{invoice}', 'InvoiceController@invoicePdf');
	Route::post('invoices/list-pdf', 'InvoiceController@listPdf');
	Route::post('invoices/list-excel', 'InvoiceController@listExcel');

	//notes
	Route::get('notes', 'NoteController@index')->name('notes.index');
    Route::post('notes', 'NoteController@store')->name('notes.create');
	Route::put('notes/{note}', 'NoteController@update')->name('notes.update');
	Route::get('notes/products/{note}', 'NoteController@getProductsNote');
	Route::get('notes/download/{note}', 'NoteController@notePdf');
	Route::post('notes/list-pdf', 'NoteController@listPdf');
	Route::post('notes/list-excel', 'NoteController@listExcel');
	Route::delete('notes/{note}', 'NoteController@destroy')->name('notes.destroy');

	//materials
	Route::get('materials', 'MaterialController@index');
	Route::get('materials/search', 'MaterialController@search');
	Route::post('materials', 'MaterialController@store');
	Route::put('materials/{material}', 'MaterialController@update');
    Route::delete('materials', 'MaterialController@destroy');

    //cities
    Route::get('cities/status', 'CityController@statesByCity');
    Route::get('cities/quotes', 'CityController@quotesPerMonth');
    Route::post('cities', 'CityController@store');

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
	Route::get('download/quotation/{quotation}/summary', 'QuotationController@quotationSummaryPdf');
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
        Route::get('workorders/pending', 'WorkOrderController@pending'); //agregar permisos
	Route::post('workorders', 'WorkOrderController@store')->name('workorders.create');
	Route::post('workorders/download', 'WorkOrderController@workOrderPdf');
	Route::post('workorders/list-pdf', 'WorkOrderController@listPdf');
	Route::post('workorders/list-pending-pdf', 'WorkOrderController@listPendingPdf');
	Route::post('workorders/list-excel', 'WorkOrderController@listExcel');
	Route::post('workorders/list-pending-excel', 'WorkOrderController@listPendingExcel');
	Route::put('workorders/{workOrder}', 'WorkOrderController@update')->name('workorders.update');
	//todo protejer com mdw
	//controlar que no se puedan editar los datos una vez aprovada y ejecutada la cotizacion
	Route::put('workorders/finish/{workOrder}', 'WorkOrderController@finishWorkOrder')->name('workorders.create');

	//Employees
	Route::get('employees', 'EmployeeController@index')->name('employees.index');
	Route::get('employees/search', 'EmployeeController@search');
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
	Route::post('reports/invoice_report', 'ReportController@invoiceReport')->name('reports.index');
	Route::post('reports/get_accounts', 'ReportController@getAccounts')->name('reports.index');
	Route::post('reports/quotation_general', 'ReportController@listQuotationGeneral')->name('reports.index');
	Route::post('reports/quotation_pending', 'ReportController@listQuotationPending')->name('reports.index');
	Route::post('reports/quotation_approved', 'ReportController@listQuotationApproved')->name('reports.index');
	Route::post('reports/quotation_executed', 'ReportController@listQuotationExecuted')->name('reports.index');
    Route::post('reports/pdf_download', 'ReportController@pdfDownload')->name('reports.index');
    Route::post('reports/excel_download', 'ReportController@excelDownload')->name('reports.index');
});
