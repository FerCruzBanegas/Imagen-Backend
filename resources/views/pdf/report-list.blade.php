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
      font-size: 8pt;
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
      /* padding: 30px; */
      /* border: 2px solid #000; */
      /* box-shadow: 0 0 10px rgba(0, 0, 0, .15); */
      font-size: 12px;
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

    #light-table {
      width: 100%;  
      padding-top: 0;
      padding-bottom: 0;
      margin-bottom: 5px;
      text-align: left;
    }

    .leftdiv {
      float: left;
      position: relative;
      width: 33%; 
    }

    .leftdiv p {
      display: block;
      width: 75%;
      /* margin: 0 auto !important; */
    }

    #leftdivcontainer {
      vertical-align: middle;
      width: 100%;
      text-align: center;
    }

    .clearfix:after {
      clear: both;
    }

    .clearfix:before,
    .clearfix:after {
      content: " ";
      display: table;
    }

    .title span {
      display: block;
      white-space: pre;
      line-height: 18pt;
      margin-left: 5px;
    }
  </style>
</head>
<body>
  <div class="invoice-box">
    <div class="car-items">
      <div id="light-table">
        <div id="leftdivcontainer" class="clearfix">
          <div class="leftdiv">
            <div style="border: 2px solid #9e0207; border-radius: 7px; text-align: left; width: 60%; padding: 10px;">
              <span style="color: #000; font-weight: bold; font-size: 15px; letter-spacing: 1px;">PUBLICIDAD VIAL IMAGEN</span>
              <span style="color: #000; font-weight: bold; font-size: 15px; letter-spacing: 3px;">{{ $office  }}</span>
            </div>
          </div>
          <div class="leftdiv" style="margin-top: 0;">
            <div style="color: #000; font-size: 19px; font-weight: bold; text-decoration: underline;">{{ mb_strtoupper($title, 'UTF-8') }}</div>
            @isset($customer)
              <div style="font-weight: bold;">CLIENTE: {{ $customer['business_name'] }}</div>
            @endisset
            <div style="font-weight: bold;">(Expresado en Bolivianos)</div>
            <div style="font-weight: bold;">Desde: {{ date("d/m/Y", strtotime($date['initial_date'])) }} al {{ date("d/m/Y", strtotime($date['final_date'])) }}</div>
          </div>
          <div class="leftdiv">
            <div style="text-align: right;"><img src="{{url('/img/favicon.png')}}" style="width:40px; height: 40px;"></div>
            <div style="text-align: right;"><span style="font-weight: bold;">Fecha: </span>{{ $now }}</div>
          </div>
        </div>
      </div>
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
              <td>{{ mb_strtoupper($column, 'UTF-8') }}</td>
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
            <tr style="page-break-inside: avoid; letter-spacing: 0.1em;">
              @foreach($columns as $column)
                @if (is_numeric($item[$column]) && !is_string($item[$column]))
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