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
        padding: 30px;
        border: 2px solid #000;
        box-shadow: 0 0 10px rgba(0, 0, 0, .15);
        font-size: 16px;
        line-height: 24px;
        font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        color: #555;
    }

    .car-items .rentals {
        border-collapse: collapse;
        width: 100%;
    }

    .car-items .rentals td, th {
        border: 1px solid #000;
        padding: 3px;
    }

    .car-items .rentals .thead-rentals tr {
        background: #9e0207;
        color: #fff;
        font-weight: bold;
    }

    .car-items .rentals .tbody-rentals .row-rentals {
        background: #fff1f1;
    }

    .renewals {
        border-collapse: collapse;
        width: 100%;
    }

    .renewals,
    .renewals {
        border: 1px solid #807979;
        text-align: center;
        font-weight: bold;
    }

    .renewals tbody tr {
        background-color: rgb(212, 212, 212);
        border: 1px solid #ddd;
        padding: 0.35em;
        font-size: 0.70em;
    }

    .renewals .thead-renewals tr {
        padding-top: 2px;
        padding-bottom: 2px;
        background-color: #6d6d6d;
        color: white;
        text-transform: uppercase;
        font-weight: bold; padding: 3px;
        font-size: 0.85em;
    }
    </style>
</head>

<body>
  <div class="invoice-box">
    <div class="car-items">
      <div style="border: 1px solid black; border-bottom: none; text-align: center; font-size: 30px; padding: 20px; font-weight: bold;">
        LISTA DE ALQUILERES (120-SCZ)
      </div>
      <table class="rentals">
        <thead class="text-center thead-rentals">
          <tr>
            <td width="70px">FECHA INICIO</td>
            <td width="70px">FECHA FIN</td>
            <td width="80px">M. MENSUAL</td>
            <td width="80px">M. TOTAL</td>
            <td width="100px">CLIENTE</td>
            <td width="80px">CONDICIÓN</td>
          </tr>
        </thead>
        <tbody class="tbody-rentals">
            <tr class="row-rentals" style="page-break-inside: avoid;">
              <td class="text-content">assad</td>
              <td class="text-content">fdgdfg</td>
              <td class="text-content">hhghgh</td>
              <td class="text-content">mghhg</td>
              <td class="text-content">nvbnvb</td>
              <td class="text-content">ilolo</td>
            </tr>
            <tr style="background-color: #e4e4e4;">
              <td colspan="8" style="padding: 1rem;">
                <table class="renewals">
                <caption style="text-align: left; color: #000;">Lista de Renovaciones</caption>
                    <thead class="text-center thead-renewals">
                        <tr>
                        <td width="70px">FECHA INICIO</td>
                        <td width="70px">FECHA FIN</td>
                        <td width="80px">M. MENSUAL</td>
                        <td width="80px">M. TOTAL</td>
                        <td width="80px">CONDICIÓN</td>
                        </tr>
                    </thead>
                        <tbody>
                            <tr style="page-break-inside: avoid;">
                                <td class="text-content">assad</td>
                                <td class="text-content">fdgdfg</td>
                                <td class="text-content">hhghgh</td>
                                <td class="text-content">mghhg</td>
                                <td class="text-content">nvbnvb</td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
      </table>
    </div>
  </div>
</body>