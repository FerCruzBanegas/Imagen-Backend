<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Reporte</title>
    
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
        	<div style="border: 1px solid black; border-bottom: none; text-align: center; font-size: 30px; padding: 20px; font-weight: bold;">{{ strtoupper($title) }}</div>
            <table>
                @php
                    $total = 0;
                    $totalCancelado = 0;
                    $totalSaldo = 0;
                    $size = count($columns) - 1;
                @endphp
                <thead class="text-center" style="font-weight: bold;">
                    <tr>
                        @foreach($columns as $column)
                            <td>{{ strtoupper($column) }}</td>
                        @endforeach  
                    </tr>
                </thead>
                <tbody>
                    @foreach($items as $item)  
                        @php
                            $total += $item['monto'];
                        @endphp 
                        @isset($item['cancelado'])
                          @php
                            $totalCancelado += $item['cancelado'];
                          @endphp 
                        @endisset
                        @isset($item['saldo'])
                          @php
                            $totalSaldo += $item['saldo'];
                          @endphp 
                        @endisset
                        <tr style="page-break-inside: avoid;">
                            @foreach($columns as $column)
                                @if (is_numeric($item[$column]))
                                    <td class="text-content">{{ number_format($item[$column], 2, '.', ',') }}</td>
                                @else
                                    <td class="text-content">{{ $item[$column] }}</td>
                                @endif
                            @endforeach
                        </tr>
                    @endforeach
                    <tr>
                        <td style="font-weight: bold; font-size: 20px; text-align: right; padding-right: 20px;" colspan="{{ ($title == 'Total Importe Cotizaciones') ? $size - 2 : $size }}">TOTAL (BS):</td>
                        <td style="font-weight: bold; font-size: 20px; text-align: center;">{{ number_format($total, 2, '.', ',') }}</td>
                        @if (isset($item['cancelado']))
                            <td style="font-weight: bold; font-size: 20px; text-align: center;">{{ number_format($totalCancelado, 2, '.', ',') }}</td>
                        @endif
                        @if (isset($item['saldo']))
                            <td style="font-weight: bold; font-size: 20px; text-align: center;">{{ number_format($totalSaldo, 2, '.', ',') }}</td>
                        @endif
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>