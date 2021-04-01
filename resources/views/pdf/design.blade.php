<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Arte guía</title>
    <style>
      .text-center {
        text-align: center;
      }

      .invoice-box {
        max-width: 100%;
        margin: auto;
        padding: 10px;
        font-size: 16px;
        line-height: 24px;
        font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        color: #555;
      }
    
      .car-data table {
        width: 100%;
        line-height: inherit;
        text-align: left;
      }
    
      .car-data table td {
        padding: 18px;
      }

      table.data {
        border-collapse: collapse;
      }

      table.data td {
        padding: 10px;
        border: 2px solid #797979;
      }
      
      .type-font {
        font-family: 'Josefin Sans', serif;
      }

      .title-big {
        padding-top: 12px; 
        font-size: 60px; 
        color: #000; 
        font-weight: bold;
      }

      .title-small {
        margin:25px; 
        font-size: 35px; 
        color: #000; 
        font-weight: bold; 
      }

      .text-color {
        color: #000;
      }

      .text-bold {
        font-weight: bold;
      }

      .text-big {
        font-size: 23px;
      }

      .text-small {
        font-size: 18px;
      }

      .thumbnail {
        margin-left: auto;
        margin-right: auto;
        display: block;
        width:350px; 
        height: 420px;
      }

      .wrap {
        height: auto;
        float: left;
        margin-left: 40px;
        margin-right: 15px;
      }

      .column {
        width: 400px;
        background-color: orange;
        display: block;
        vertical-align: text-top;
        margin-bottom: 15px;
      }
      
      .column:nth-child(odd) {
        height: 400px;  
      }

      .column:nth-child(even) {
        height: 400px;
      }

      .column img {
        margin-left: auto;
        margin-right: auto;
        display: block;
        max-width: 400px;
        max-height: 400px;
      }
    </style>
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@700&display=swap" rel="stylesheet">
  </head>
  <body>
    <div class="invoice-box">
      <div class="car-data">
        <table cellpadding="0" cellspacing="0">
          <tr>
            <td>
              <img src="{{url('/img/logo.png')}}" style="width:350px;">
            </td>
            <td class="text-center">
              <div class="title-big type-font">DISEÑO</div>
              <div class="title-small type-font">ARTE GUÍA</div>
            </td>
          </tr>
        </table>
      </div>
      <div class="car-data">
        <table class="data">
          <tr>
            <td colspan="2">
              <span class="text-big text-color">Nombre de Archivo:</span>
              <span class="text-small text-bold text-color">{{ $design['filename'] }}</span>
            </td>
          </tr>
          <tr>
            <td colspan="2">
              <span class="text-big text-color">Maquina(s): </span>
              <span class="text-big text-bold text-color">{{ $design['machine'] }}</span>  
            </td>
          </tr>
          <tr>
            <td>
              <span class="text-big text-color">Calidad:</span>
              <span class="text-big text-bold text-color">{{ $design['quality'] }}</span>
            </td>
            <td>
              <span class="text-big text-color">Cantidad:</span>
              <span class="text-big text-bold text-color">{{ $design['quantity'] }}</span>
            </td>
          </tr>
          <tr>
            <td colspan="2">
              <span class="text-big text-color">Material:</span> 
              <span class="text-big text-bold text-color">{{ $design['material'] }}</span>
            </td>
          </tr>
          <tr>
            <td colspan="2">
              <span class="text-big text-color">Dimensiones Corte:</span> 
              <span class="text-small text-color">{{ $design['cutting_dimension'] }}</span>
            </td>
          </tr>
          <tr>
            <td colspan="2">
              <span class="text-big text-color">Dimensiones Impresión:</span> 
              <span class="text-small text-color">{{ $design['print_dimension'] }}</span>
            </td>
          </tr>
          <tr>
            <td colspan="2">
              <span class="text-big text-color">Acabado:</span>
              <span class="text-big text-color">{{ $design['finished'] }}</span>
            </td>
          </tr>
          <tr>
            <td colspan="2">
              <span class="text-big text-color">Prueba de Impresión:</span>
              <span class="text-big text-bold text-color">{{ $design['test_print'] }}</span>
            </td>
          </tr>
          <tr>
            <td colspan="2">
              <span class="text-big text-color">Cotización:</span>
              <span class="text-big text-bold text-color">{{ $design['cite'] }}</span>
            </td>
          </tr>
          <tr>
            <td colspan="2">
              <span class="text-big text-color">Fecha APROBADA COTIZACIÓN:</span>
              <span class="text-big text-bold text-color">{{ date('d/m/Y', strtotime($design['quote_approved_date'])) }}</span>
            </td>
          </tr>
          <tr>
            <td colspan="2">
              <span class="text-big text-color">Fecha de APROBACIÓN DE DISEÑO:</span>
              <span class="text-big text-bold text-color">{{ $design['design_approved_date'] }}</span>
            </td>
          </tr>
          <tr>
            <td colspan="2">
              <span class="text-big text-color">Observaciones:</span>
              <span class="text-small text-color">{{ $design['note'] }}</span>
            </td>
          </tr>
        </table>
        <br>
        @if (is_null($design['support_path']['url'])) 
          <img src="{{ $design['path']['url'] }}" class="thumbnail">
        @else 
          <div class="wrap">
            <div class="column">
              <img src="{{ $design['path']['url'] }}">
            </div>
          </div>
          <div class="wrap">
            <div class="column">
            <img src="{{ $design['support_path']['url'] }}">
            </div>
          </div>
        @endif 
      </div>
    </div>
  </body>
</html>