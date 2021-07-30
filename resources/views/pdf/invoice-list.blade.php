<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Facturas</title>
    
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
      <div style="border: 1px solid black; border-bottom: none; text-align: center; font-size: 30px; padding: 20px; font-weight: bold;">
        LISTA DE FACTURAS
      </div>
      <table>
        @php
          $total = 0;
        @endphp
        <thead class="text-center" style="font-weight: bold;">
          <tr>
            <td width="100px">NÚMERO</td>
            <td width="70px">FECHA</td>
            <td width="100px">RAZÓN S.</td>
            <td width="70px">ESTADO</td>
            <td width="130px">CLIENTE</td>
            <td width="100px">COTIZACIÓN</td>
            <td width="130px">TOTAL</td>
          </tr>
        </thead>
        <tbody>
          @foreach($invoices as $invoice)
            @php
              $total += $invoice['total'];
            @endphp  
            <tr style="page-break-inside: avoid;">
              <td class="text-content">{{ $invoice['number'] }}</td>
              <td class="text-content">{{ $invoice['date'] }}</td>
              <td class="text-content">{{ $invoice['nit_name'] }}</td>
              <td class="text-content">{{ $invoice['state'] }}</td>
              <td class="text-content">{{ $invoice['customer'] }}</td>
              <td class="text-content">{{ $invoice['cite'] }}</td>
              <td class="text-content">{{ number_format($invoice['total'], 2, '.', ',') }}</td>
            </tr>
          @endforeach
          <tr>
            <td style="font-weight: bold; font-size: 20px; text-align: right; padding-right: 20px;" colspan="6">TOTAL (BS):</td>
            <td style="font-weight: bold; font-size: 20px; text-align: center;">{{ number_format($total, 2, '.', ',') }}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</body>