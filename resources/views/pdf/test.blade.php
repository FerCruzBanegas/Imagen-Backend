<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Factura</title>
  <style>
    .container {
      max-width: 100%;
      margin: auto;
      font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
    }

    .light-table {
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

    .leftdivcontainer {
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

    table {
      border-collapse: collapse;
      width: 100%;
      font-family: 'Ubuntu', sans-serif;
    }

    table th,
    table td {
      border: 1px solid #807979;
      padding: 0.625em;
      text-align: center;
      font-weight: bold;
    }

    table tbody tr {
      border: 1px solid #ddd;
      padding: 0.35em;
      font-size: 0.70em;
    }

    table thead th {
      padding-top: 6px;
      padding-bottom: 6px;
      background-color: #9e0207;
      color: white;
      text-transform: uppercase;
      font-size: 0.85em;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="light-table">
      <div class="leftdivcontainer clearfix">
        <div class="leftdiv">
          <div style="border: 2px solid #9e0207; border-radius: 7px; text-align: left; width: 65%; padding: 10px;">
            <span style="color: #000; font-weight: bold; font-size: 13px; letter-spacing: 1px;">PUBLICIDAD VIAL IMAGEN</span>
            <span style="color: #000; font-weight: bold; font-size: 13px; letter-spacing: 3px;">PVI Santa Cruz</span>
          </div>
        </div>
        <div class="leftdiv" style="margin-top: 0;">
          <div style="color: #000; font-size: 19px; font-weight: bold; text-decoration: underline;">ESTADO DE CUENTAS</div>
          <div style="font-weight: bold;">CLIENTE: AGENCIAS GENERALES S.A.</div>
          <div style="font-weight: bold;">(Expresado en Bolivianos)</div>
          <div style="font-weight: bold;">Desde: 01/01/2021 al 31/01/2021</div>
        </div>
        <div class="leftdiv">
          <div style="text-align: right;"><img src="{{url('/img/favicon.png')}}" style="width:40px; height: 40px;"></div>
          <div style="text-align: right;"><span style="font-weight: bold;">Fecha: </span>30/03/2021</div>
        </div>
      </div>
    </div>
    <table>
      <thead>
        <tr>
          <th width="50px">Fecha</th>
          <th width="40px">Compr</th>
          <th width="50px">Num</th>
          <th width="350px">Detalle</th>
          <th width="100px">Debe</th>
          <th width="80px">Haber</th>
          <th width="80px">Saldo</th>
        </tr>
      </thead>
      <tbody>
        @php
          $totalPayments = 0;
        @endphp
        @foreach($data['customer']['invoices'] as $item)  
          <tr style="background-color: #f7d9d9;">
            <td>{{ date('d/m/Y', strtotime($item['date'])) }}</td>
            <td>{{ $item['type'] }}</td>
            <td>{{ $item['number'] }}</td>
            <td>{{ $item['summary'] }}</td>
            <td>{{ number_format($item['total'], 2, '.', ',') }}</td>
            <td></td>
            <td>{{ number_format($item['total'], 2, '.', ',') }}</td>
          </tr>
          @foreach($item['payments'] as $payment)  
            <tr style="background-color: #f9f3f3;">
              <td>{{ date('d/m/Y', strtotime($payment['date'])) }}</td>
              <td>{{ $payment['type'] }}</td>
              <td>01</td>
              <td>asas</td>
              <td></td>
              <td>{{ number_format($payment['amount'], 2, '.', ',')  }}</td>
              <td></td>
            </tr>
            @php
              $totalPayments += $payment['amount'];
            @endphp 
          @endforeach
          <tr style="background-color: #dddddd;">
            <td colspan="4" style="text-align: right;">
              TOTAL
            </td>
            <td></td>
            <td>{{ number_format($item['payments']->sum('amount'), 2, '.', ',') }}</td>
            <td></td>
          </tr>
        @endforeach
        <tr>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td>{{ number_format($data['customer']['invoices']->sum('total'), 2, '.', ',') }}</td>
          <td>{{ number_format($totalPayments, 2, '.', ',') }}</td>
          <td>{{ number_format($data['customer']['invoices']->sum('total') - $totalPayments, 2, '.', ',') }}</td>
        </tr>
        <!-- <tr style="background-color: #fff1d1;">
          <td>13/02/2021</td>
          <td>
            Factura
          </td>
          <td>
            12
          </td>
          <td>
            Alq. Publi Av. Cristo Redentor Cara A-B del 01/02/2020 al 01/03/2021
          </td>
          <td>
            8,120.00
          </td>
          <td></td>
          <td>8,120.00</td>
        </tr>
        <tr style="background-color: #efefef;">
          <td>15/02/2021</td>
          <td>
            Cheque
          </td>
          <td>
            001
          </td>
          <td>
            Pagado en deposito
          </td>
          <td></td>
          <td>8,000.00</td>
          <td></td>
        </tr>
        <tr style="background-color: #efefef;">
          <td>15/02/2021</td>
          <td>
            Cheque
          </td>
          <td>
            001
          </td>
          <td>
            Pagado en deposito
          </td>
          <td></td>
          <td>120.00</td>
          <td></td>
        </tr>
        <tr style="background-color: #c5d7ff;">
          <td colspan="4" style="text-align: right;">
            TOTAL
          </td>
          <td></td>
          <td>8,120.00</td>
          <td>0.00</td>
        </tr>
        <tr style="background-color: #fff1d1;">
          <td>13/02/2021</td>
          <td>
            Factura
          </td>
          <td>
            12
          </td>
          <td>
            Alq. Publi Av. Cristo Redentor Cara A-B del 01/02/2020 al 01/03/2021
          </td>
          <td>
            8,120.00
          </td>
          <td></td>
          <td>8,120.00</td>
        </tr>
        <tr style="background-color: #efefef;">
          <td>15/02/2021</td>
          <td>
            Cheque
          </td>
          <td>
            001
          </td>
          <td>
            Pagado en deposito
          </td>
          <td></td>
          <td>8,000.00</td>
          <td></td>
        </tr>
        <tr style="background-color: #efefef;">
          <td>15/02/2021</td>
          <td>
            Cheque
          </td>
          <td>
            001
          </td>
          <td>
          </td>
          <td></td>
          <td>120.00</td>
          <td></td>
        </tr>
        <tr style="background-color: #c5d7ff;">
          <td colspan="4" style="text-align: right;">
            TOTAL
          </td>
          <td></td>
          <td>8,120.00</td>
          <td>0.00</td>
        </tr> -->
      </tbody>
    </table>
  </div>
</body>
</html>
