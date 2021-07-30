<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Orden de Trabajo</title>
    
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
        padding: 30px;
        border: 2px solid #000;
        box-shadow: 0 0 10px rgba(0, 0, 0, .15);
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
        	<div style="border: 1px solid black; border-bottom: none; text-align: center; font-size: 30px; padding: 20px; font-weight: bold;">LISTA TRABAJOS PENDIENTES</div>
            <table>
                <thead class="text-center" style="font-weight: bold;">
                    <tr>
                        <td width="70px">NÚMERO</td>
                        <td width="70px">CITE</td>
                        <td width="100px">FECHA INICIO</td>
                        <td width="100px">FECHA ESTIMADA</td>
                        <td width="100px">FECHA ENTREGA</td>
                        <td width="120px">TIPO TRABAJO</td>
                        <td width="130px">ENCARGADO</td>
                    </tr>
                </thead>
                <tbody>
	                @foreach($workOrders as $workOrder)   
	                    <tr style="page-break-inside: avoid;">
	                        <td class="text-content">{{ $workOrder['number'] }}</td>
                            <td class="text-content">{{ $workOrder['cite'] }}</td>
	                        <td class="text-content">{{ $workOrder['opening_date'] }}</td>
	                        <td class="text-content">{{ $workOrder['estimated_date'] }}</td>
	                        <td class="text-content">{{ $workOrder['closing_date'] }}</td>
                            <td class="text-content">{{ $workOrder['type_work'] }}</td>
                            <td class="text-content">
                            @foreach($workOrder['employees'] as $index => $employee)
                                @php($total = $index + 1) 
                                <span>{{ $employee['name'] }} {{ $total < count($workOrder['employees']) ? ',' : '' }}</span>
                            @endforeach
                            </td>
	                    </tr>
	                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>