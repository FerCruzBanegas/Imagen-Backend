<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Espacios</title>
    
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
        	<div style="border: 1px solid black; border-bottom: none; text-align: center; font-size: 30px; padding: 20px; font-weight: bold;">LISTA DE ESPACIOS</div>
            <table>
                <thead class="text-center" style="font-weight: bold;">
                    <tr>
                        <td width="60px">CÓDIGO</td>
                        <td width="80px">ZONA</td>
                        <td width="200px">DIRECCIÓN</td>
                        <td width="50px">DIMENSIÓN</td>
                        <td width="60px">PRECIO</td>
                        <td width="50px">ILUMINACIÓN</td>
                        <td width="80px">ESTADO</td>
                        <td width="100px">CIUDAD</td>
                        <td width="70px">TIPO</td>
                    </tr>
                </thead>
                <tbody>
	                @foreach($billboards as $billboard)   
	                    <tr style="page-break-inside: avoid;">
	                        <td class="text-content">{{ $billboard['code'] }}</td>
	                        <td class="text-content">{{ $billboard['zone'] }}</td>
	                        <td class="text-content">{{ $billboard['location'] }}</td>
	                        <td class="text-content">{{ $billboard['dimension'] }}</td>
	                        <td class="text-content">{{ $billboard['price'] }}</td>
                            <td class="text-content">{{ $billboard['illumination'] }}</td>
                            <td class="text-content">{{ $billboard['state'] }}</td>
                            <td class="text-content">{{ $billboard['city'] }}</td>
                            <td class="text-content">{{ $billboard['type'] }}</td>
	                    </tr>
	                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>