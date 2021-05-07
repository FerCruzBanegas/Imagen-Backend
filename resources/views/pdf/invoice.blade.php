<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Factura</title>
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
  <style>
    .invoice-box {
      max-width: 100%;
      margin: auto;
      padding: 30px;
      /*border: 1px solid #eee;
      box-shadow: 0 0 10px rgba(0, 0, 0, .15);*/
      font-size: 14px;
      line-height: 24px;
      font-family: 'Roboto', sans-serif;
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

    #light-table-paragraph {
      font-family: 'Droid Serif';
      font-size: 20px;
      color: #2e2e2e;
      text-align: center;
      line-height: 40px;
    }

    h3 {
      padding: 0 40px;
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

    .test2 span {
      display: block;
      font-size:   10pt;
      line-height: 23pt;
    }

    #invoice-table {
      border: 2px solid #9e0207;
      border-radius: 7px;
      border-spacing: 0;
      box-sizing: border-box;
      clear: both;
      margin: 2mm 0mm;
      height: 190mm;
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

    .anulado {
      background: url("{{ asset('/img/anulado.png') }}");
      background-size: 600px;
      background-repeat: no-repeat;
      background-position: center;
      background-attachment: fixed; 
    }
  </style>
</head>
<body>
  <div class="invoice-box {{ ($data['invoice']['state']['title'] == 'ANULADO') ? 'anulado' : 'watermark' }}">
    <div id="light-table">
      <div id="leftdivcontainer" class="clearfix">
        <div class="leftdiv">
          <img src="{{url('/img/logo.png')}}" style="width:280px; height: 70px;">
        </div>
        <div class="leftdiv" style="margin-top: 0;">
          <p class="test" style="color: #656565;">
            <span style="font-size: 18px; font-weight: bold;">{{ $data['invoice']['license']['office']['address'][0] }}</span>
            <span>{{ $data['invoice']['license']['office']['address'][1] }}</span>
            <span>{{ $data['invoice']['license']['office']['address'][2] }}</span>
            <span>{{ $data['invoice']['license']['office']['address'][3] }}</span>
            <span>{{ $data['invoice']['license']['office']['address'][4] }}</span>
          </p>
        </div>
        <div class="leftdiv" style="border: 2px solid #9e0207; border-radius: 7px;">
          <div style="text-align: left; margin-left: 15px; margin-bottom: 5px; margin-top: 5px;">
            <div style="color: #474747; font-weight: bold;">
              NIT: <span style="float: right; margin-right: 15px;">{{ $data['invoice']['license']['nit'] }}</span>
            </div>
            <div style="color: #474747; font-weight: bold;">
              FACTURA Nº: <span style="float: right; margin-right: 15px;">{{ str_pad($data['invoice']['number'], 8, '0', STR_PAD_LEFT) }}</span>
            </div>
            <div style="color: #474747; font-weight: bold;">
              Autorización Nº: <span style="float: right; margin-right: 15px; color: #000000; font-weight: bold;">{{ $data['invoice']['license']['authorization'] }}</span>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div id="light-table" style="margin-top: 30px;">
      <div id="leftdivcontainer" class="clearfix">
        <div class="leftdiv">
          &nbsp;
        </div>
        <div class="leftdiv" style="margin-top: 20px;">
          <span style="font-size: 55px; font-weight: bold;">FACTURA</span>
        </div>
        <div class="leftdiv">
          <p class="test2">
            <span style="color: #000000;">Actividad - {{ $data['invoice']['license']['activity'] }}</span>
            <span style="font-size: 18px; font-weight: bold; color: #474747; letter-spacing: 0.3em;">{{ $data['type'] }}</span>
          </p>
        </div>
      </div>
    </div>
    <div id="light-table" style="margin-top: 20px; color: #000000; font-size: 16px;">
      <div style="border: 2px solid #9e0207; border-radius: 7px;">
        <div style="float: right; margin: 15px;"><b>NIT/CI: {{ $data['invoice']['customer']['nit'] }}</b></div>
        <div style="margin: 15px;">{{ $data['invoice']['license']['office']['name'] }}, {{ $data['spanish_date'] }}</div>
        <div style="margin: 15px;">Señor(es): {{ $data['invoice']['customer']['name'] }}</div>
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
        @foreach($data['invoice']['products'] as $key => $product)  
          <tr class="invoice_line" style="text-align: center;">
            <td style="color: #000000; font-size: 14px;">
              @if ($key === 0 && $data['invoice']['title'])
               <div style="margin-bottom: 8px;">&nbsp;</div>
              @endif
              {{ $product['quantity'] }}
            </td>
            <td style="color: #000000; text-align: justify; font-size: 14px;">
              @if ($key === 0 && $data['invoice']['title'])
               <div style="color: #000000; margin-bottom: 8px;">{{ $data['invoice']['title'] }}:</div> 
              @endif
              {{ $product['description'] }}
            </td>
            <td style="color: #000000; font-size: 14px;">
              @if ($key === 0 && $data['invoice']['title'])
               <div style="margin-bottom: 8px;">&nbsp;</div>
              @endif
              {{ number_format($product['price'], 2, '.', ',') }}
            </td>
            <td style="color: #000000; font-size: 14px;">
              @if ($key === 0 && $data['invoice']['title'])
               <div style="margin-bottom: 8px;">&nbsp;</div>
              @endif
              {{ number_format($product['subtotal'], 2, '.', ',') }}
            </td>
          </tr>
        @endforeach
        <tr>
          <td>&nbsp;</td>
          <td style="color: #000000; font-size: 0.90rem;">&nbsp;
            @if (!is_null($data['invoice']['footer']))
             <div style="margin-left: 2px;">{{ $data['invoice']['footer'] }}</div>
            @endif
            @if (!is_null($data['invoice']['details']))
              <div style="margin-left: 2px;">
              @foreach($data['invoice']['details'] as $key => $detail)
                <div style="margin-left: 2px; margin-right: 12px; display: inline-block; padding: 2px;">
                  {{ $detail['description'] }}
                </div>
              @endforeach
              </div>
            @endif
          </td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr class="invoice_line">
          <td colspan="3" style="text-align: right; border-top: 2px solid #9e0207; color: #474747; font-size: 20px; font-weight: bold; padding:16px;">TOTAL Bs.</td>
          <td style="text-align: center; border-top: 2px solid #9e0207; font-size: 16px; color: #000000; font-weight: bold; padding:16px; background: #FFDBDC;">{{ number_format($data['invoice']['total'], 2, '.', ',') }}</td>
        </tr>
      </table>
    </div>
    <div id="light-table">
      <div style="border: 2px solid #9e0207; border-radius: 7px; color: black;">
        <div style="margin: 12px;"><b>Son:</b> {{ $data['literal_amount'] }}</div>
      </div>
    </div>
    <div id="light-table" style="margin-top: 5px; margin-left: 10px; color: black;">
      <div style="margin-top: 0; float: right;">{!! QrCode::size(150)->generate($data['qr']); !!}</div>
      <div><b>Código de Control: &nbsp;&nbsp; {{ $data['invoice']['control_code'] }}</b></div>
      <div><b>Fecha Límite de Emisión: &nbsp;</b>{{ $data['invoice']['license']['deadline'] }}</div>
      <div style="margin-top: 2px; font-size: 11px; letter-spacing: 0.1em;">"ESTA FACTURA CONTRIBUYE AL DESARROLLO DEL PA&Iacute;S, EL USO IL&Iacute;CITO DE &Eacute;STA SER&Aacute; SANCIONADO DE ACUERDO A LEY."</div>
      <div style="font-size: 10px; color: black;">
        <strong>{{ $data['invoice']['license']['legend'] }}</strong>
      </div>
    </div>
  </div>
</body>
</html>
