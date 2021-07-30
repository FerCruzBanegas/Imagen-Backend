<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Nota de Remision</title>
  <style>
    .invoice-box {
      max-width: 100%;
      margin: auto;
      padding: 25px;
      font-size: 16px;
      line-height: 24px;
      font-family: 'Ubuntu', sans-serif;
      color: #555;
    }

    #light-table {
      width: 100%;  
      padding-top: 0;
      padding-bottom: 0;
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
      margin: 0 auto !important;
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

    .test span {
      display: block;
      white-space: pre;
      font-size:   10pt;
      line-height: 12pt;
    }

    #invoice-table {
      border: 2px solid #9e0207;
      border-radius: 7px;
      border-spacing: 0;
      box-sizing: border-box;
      clear: both;
      margin: 2mm 0mm;
      height: 195mm;
      width: 100%;
    }
  
    #invoice-table th, td { border-left: 2px solid #9e0207; }
    #invoice-table th:first-child, td:first-child { border-left: none; }
    #invoice-table th { border-bottom: 2px solid #9e0207; }
    #invoice-table td { vertical-align: top; font-size: 8pt; }
    th { text-align: center; font-weight: normal; }
    .amount { text-align: center; }
    .invoice_line { height: 6mm; }
    .invoice_line td, .invoice_line th { padding: 1mm; }

    .watermark {
      background: url("{{ asset('/img/watermark.png') }}");
      background-size: 600px;
      background-repeat: no-repeat;
      background-position: center;
      background-attachment: fixed; 
    }

    .wrap {
      margin-top: 30px;
      text-align: center;
      width: auto;
    }

    .left, .right {
      display: inline-block;
      margin: 40px;
      margin-bottom: 0;
      border-top: 1px solid #000; 
      text-align: center;
      font-weight: bold;
      width: 300px;
    }
  </style>
</head>
<body>
  <div class="invoice-box watermark">
    <div id="light-table">
      <div id="leftdivcontainer" class="clearfix">
        <div class="leftdiv">
          <img src="{{url('/img/logo.png')}}" style="width:280px; height: 70px;">
        </div>
        <div class="leftdiv" style="margin-top: 0;">
          <p class="test" style="color: #656565;">
            <span style="font-size: 18px; font-weight: bold;">{{ $data['note']['voucher']['office']['address'][0] }}</span>
            <span>{{ $data['note']['voucher']['office']['address'][1] }}</span>
            <span>{{ $data['note']['voucher']['office']['address'][2] }}</span>
            <span>{{ $data['note']['voucher']['office']['address'][3] }}</span>
            <span>{{ $data['note']['voucher']['office']['address'][4] }}</span>
          </p>
        </div>
        <div class="leftdiv" style="border: 2px solid #9e0207; border-radius: 7px;">
          <div style="text-align: left; margin-left: 15px; margin-bottom: 5px; margin-top: 5px;">
            <div style="color: #474747; font-weight: bold;">
              NIT: <span style="float: right; margin-right: 15px;">164692025</span>
            </div>
            <div style="color: #474747; font-weight: bold;">
              Nº: <span style="float: right; margin-right: 15px;">{{ str_pad($data['note']['number'], 8, '0', STR_PAD_LEFT) }}</span>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div style="width: 500px; margin: 50px auto; margin-bottom: 0; text-align: center;">
      <span style="font-size: 45px; font-weight: bold;">NOTA DE REMISION</span>
    </div>
    @if (!$data['note']['accounts']) 
      <div style="color: #000;"><b>(NO CONTABILIZADO)</b></div>
    @endif 
    <div id="light-table" style="color: #000000;">
      <div style="border: 2px solid #9e0207; border-radius: 7px;">
        <div style="float: right; margin: 15px;"><b>NIT/CI: {{ $data['note']['customer']['nit'] }}</b></div>
        <div style="margin: 15px;">{{ $data['note']['voucher']['office']['name'] }}, {{ $data['spanish_date'] }}</div>
        <div style="margin: 15px;">Señor(es): {{ $data['note']['customer']['name'] }}</div>
      </div>
    </div>
    <div id="light-table" style="margin-top: 5px;">
      <table id="invoice-table">
        <tr class="invoice_line" style="background-color: #FFDBDC;">
          <th style="color: #9e0207; padding:10px; width: 100px; font-weight: bold; font-size: 20px;">CANTIDAD</th>
          <th style="color: #9e0207; letter-spacing: 0.5em; padding:10px; width: 340px; font-weight: bold; font-size: 20px;">DETALLE</th>
          <th style="color: #9e0207; padding:10px; width: 100px; font-weight: bold; font-size: 20px;">P. UNIT.</th>
          <th style="color: #9e0207; padding:10px; width: 120px; font-weight: bold; font-size: 20px;">SUB TOTAL</th>
        </tr>
        @foreach($data['note']['products'] as $key => $product)  
          <tr class="invoice_line" style="text-align: center;">
            <td style="color: #000000; font-size: 15px;">
              {{ $product['quantity'] }}
            </td>
            <td style="color: #000000; text-align: justify; font-size: 15px;">
              {{ $product['description'] }}
            </td>
            <td style="color: #000000; font-size: 15px;">
              {{ number_format($product['price'], 2, '.', ',') }}
            </td>
            <td style="color: #000000; font-size: 15px;">
              {{ number_format($product['subtotal'], 2, '.', ',') }}
            </td>
          </tr>
        @endforeach
        <tr>
          <td>&nbsp;</td>
          <td style="color: #000000; text-align: justify; font-size: 15px;">&nbsp;
          </td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr class="invoice_line">
          <td colspan="3" style="text-align: right; border-top: 2px solid #9e0207; color: #474747; font-size: 17px; font-weight: bold; padding:8px;">SUBTOTAL</td>
          <td style="text-align: center; border-top: 2px solid #9e0207; font-size: 16px; color: #000000; font-weight: bold; padding:8px; background: #FFDBDC;">{{ number_format($data['note']['products']->sum('subtotal'), 2, '.', ',') }}</td>
        </tr>
        <tr class="invoice_line">
          <td colspan="3" style="text-align: right; border-top: 2px solid #9e0207; color: #474747; font-size: 17px; font-weight: bold; padding:8px;">DESCUENTO</td>
          <td style="text-align: center; border-top: 2px solid #9e0207; font-size: 16px; color: #000000; font-weight: bold; padding:8px;">{{ number_format($data['note']['discount'], 2, '.', ',') }}</td>
        </tr>
        <tr class="invoice_line">
          <td colspan="3" style="text-align: right; border-top: 2px solid #9e0207; color: #474747; font-size: 20px; font-weight: bold; padding:16px;">TOTAL Bs.</td>
          <td style="text-align: center; border-top: 2px solid #9e0207; font-size: 16px; color: #000000; font-weight: bold; padding:16px; background: #FFDBDC;">{{ number_format($data['note']['total'], 2, '.', ',') }}</td>
        </tr>
      </table>
    </div>
    <div id="light-table">
      <div style="border: 2px solid #9e0207; border-radius: 7px; color: black;">
        <div style="margin: 12px;"><b>Son:</b> {{ $data['literal_amount'] }}</div>
      </div>
      <div style="color: black; font-size: 12px;"><b>Nota:</b> Este documento no es válido para crédito fiscal.</div>
    </div>
    <div class="wrap">
      <div class="left">AUTORIZADO POR</div>
      <div class="right">CLIENTE</div>
    </div>
  </div>
</body>
</html>
