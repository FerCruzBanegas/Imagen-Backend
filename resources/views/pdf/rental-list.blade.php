<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Alquileres</title>
    
    <style>
    .text-right {
        text-align: right;
    }

    .text-center {
        text-align: center;
    }

    .text-content {
        text-align: center;
        font-weight: bold;
        font-size: 11pt;
    }

    .text-title {
        text-align: center;
        font-weight: bold;
        font-size: 12pt;
        color: #000;
    }
    
    .invoice-box {
        max-width: 100%;
        margin: auto;
        /* padding: 30px;
        border: 2px solid #000;
        box-shadow: 0 0 10px rgba(0, 0, 0, .15); */
        font-size: 16px;
        line-height: 24px;
        font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        color: #555;
    }

    .car-items table {
        border-collapse: collapse;
        width: 100%;
    }

    .car-items table td, th {
        border: 1px solid #000;
        padding: 3px;
    }

    .car-items table thead tr {
        background: #ca0000;
        color: #fff;
    }
    </style>
</head>

<body>
    <div class="invoice-box">
        <div class="car-items">
        	<div style="border: 1px solid black; border-bottom: none; text-align: center; font-size: 30px; padding: 20px; font-weight: bold;">LISTA DE ALQUILERES</div>
            <table>
                <thead class="text-center" style="font-weight: bold;">
                    <tr>
                        <td width="60px">F.INICIO</td>
                        <td width="60px">F.FIN</td>
                        <td width="30px">ILUM.</td>
                        <td width="30px">IMPR.</td>
                        <td width="40px">ESPACIO</td>
                        <td width="120px">UBICACIÓN</td>
                        <td width="70px">M.MENSUAL</td>
                        <td width="70px">M.TOTAL</td>
                        <td width="50px">CONDICIÓN</td>
                        <td width="120px">CLIENTE</td>
                    </tr>
                </thead>
                <tbody>
	                @foreach($rentals as $rental)   
	                    <tr style="page-break-inside: avoid;">
	                        <td class="text-content">{{ $rental['date_start'] }}</td>
	                        <td class="text-content">{{ $rental['date_end'] }}</td>
	                        <td class="text-content">{{ $rental['illumination'] }}</td>
	                        <td class="text-content">{{ $rental['print'] }}</td>
                            <td class="text-content">{{ $rental['billboard_code'] }}</td>
                            <td class="text-content">{{ $rental['billboard_location'] }}</td>
	                        <td class="text-content">{{ $rental['amount_monthly'] }}</td>
                            <td class="text-content">{{ $rental['amount_total'] }}</td>
                            <td class="text-content">{{ $rental['condition'] }}</td>
                            <td class="text-content">{{ $rental['customer_name'] }}</td>
	                    </tr>
	                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>