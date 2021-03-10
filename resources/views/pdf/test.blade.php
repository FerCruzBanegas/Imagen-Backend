<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Factura</title>
  <style>
    .invoice-box {
      max-width: 100%;
      margin: auto;
      padding: 30px;
      /*border: 1px solid #eee;
      box-shadow: 0 0 10px rgba(0, 0, 0, .15);*/
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
      height: 200mm;
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

    .wrap {
      padding: 3%;
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
            <span style="font-size: 18px; font-weight: bold;">SUCURSAL 1</span>
            <span>Calle Nº 27</span>
            <span>Zona / Barrio Cordecruz</span>
            <span>Telf.: 3494677 - 76722731</span>
            <span>Santa Cruz - Bolivia</span>
          </p>
        </div>
        <div class="leftdiv" style="border: 2px solid #9e0207; border-radius: 7px;">
          <div style="text-align: left; margin-left: 15px; margin-bottom: 5px; margin-top: 5px;">
            <div style="color: #474747; font-weight: bold;">
              NIT: <span style="float: right; margin-right: 15px;">164692025</span>
            </div>
            <div style="color: #474747; font-weight: bold;">
              Nº: <span style="float: right; margin-right: 15px;">000001</span>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div style="width: 500px; margin: 50px auto; margin-bottom: 0; text-align: center;">
      <span style="font-size: 45px; font-weight: bold;">NOTA DE REMISION</span>
    </div>
    <div id="light-table" style="margin-top: 20px; color: #000000;">
      <div style="border: 2px solid #9e0207; border-radius: 7px;">
        <div style="float: right; margin: 15px;"><b>NIT/CI: 8914345</b></div>
        <div style="margin: 15px;">Santa Cruz de la Sierra, 01 diciembre de 2020</div>
        <div style="margin: 15px;">Señor(es): Fernando Banegas</div>
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
          <tr class="invoice_line" style="text-align: center;">
            <td style="color: #000000; font-size: 15px;">
              1
            </td>
            <td style="color: #000000; text-align: justify; font-size: 15px;">
              Alquiler de valla publicitaria
            </td>
            <td style="color: #000000; font-size: 15px;">
              1,000.00
            </td>
            <td style="color: #000000; font-size: 15px;">
              1,000.00
            </td>
          </tr>
          <tr>
          <td>&nbsp;</td>
          <td style="color: #000000; text-align: justify; font-size: 15px;">&nbsp;
          </td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr class="invoice_line">
          <td colspan="3" style="text-align: right; border-top: 2px solid #9e0207; color: #474747; font-size: 20px; font-weight: bold; padding:16px;">TOTAL Bs.</td>
          <td style="text-align: center; border-top: 2px solid #9e0207; font-size: 16px; color: #000000; font-weight: bold; padding:16px; background: #FFDBDC;">1,000.00</td>
        </tr>
      </table>
    </div>
    <div id="light-table">
      <div style="border: 2px solid #9e0207; border-radius: 7px; color: black;">
        <div style="margin: 12px;"><b>Son:</b> Un Mil 00/100 Bolivianos</div>
      </div>
    </div>
    <div class="wrap">
        <div class="left">AUTORIZADO POR</div>
        <div class="right">CLIENTE</div>
    </div>
  </div>
</body>
</html>
