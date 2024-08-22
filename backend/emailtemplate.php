<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            background-color: #fff;
            margin: 0 auto;
            max-width: 600px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .header, .footer {
            background-color: #A96BAC;
            color: #fff;    
            padding: 10px;
            text-align: center;
        }
        .content {
            padding: 10px;
        }
        .section {
            background-color: #A96BAC;
            color: #fff;
            padding: 15px;
            margin: 10px 0;
        }
        .section-inner {
            background-color: #7F4E84;
            padding: 10px;
            color: white;
        }
        table {
            width: 80%;
            color: white;
            border-collapse: collapse;
        }
        table th, table td {
            padding: 5px;
            text-align: left;
        }
        table th {
            width: 50%;
        }
        table td {
            width: 50%;
        }
        h1, h2, h3, h4 {
            margin: 0;
        }
        hr {
            border: 1px solid #000;
        }
        @media only screen and (max-width: 600px) {
            .container {
                width: 100%;
            }
            .section, .section-inner {
                padding: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>PENGESAHAN PEMBELIAN TIKET {{name}}</h2>
        </div>
        <div class="content">
            <center>
                <h3 style="color: #342338;">TIKET ANDA TELAH DISAHKAN</h3>
                <p>Terima kasih atas pembelian anda di ITket KVKS</p>
            </center>
        </div>
        <div class="section">
            <center><p>Berikut adalah maklumat untuk rujukan anda</p></center>
            <div class="section-inner">
                <center><strong><h4>BUTIRAN PEMBELIAN</h4></strong></center>
                <center>
                    <p>ID Tiket</p>
                    <h1>ITKT{{id_tkt}}</h1>
                    <hr style="border: 1px solid black">
                    <table>
                        <tr>
                            <th style="text-align: left;">Nama Pembeli</th>
                            <td style="text-align: right;">{{name}}</td>
                        </tr>
                    </table>
                    <hr>
                    <table>
                        <tr>
                            <th style="text-align: left;">No. Telefon</th>
                            <td style="text-align: right;">{{nrtel}}</td>
                        </tr>
                    </table>
                    <hr>
                    <table>
                        <tr>
                            <th style="text-align: left;">Tarikh Pembelian</th>
                            <td style="text-align: right;">{{date}}</td>
                        </tr>
                    </table>
                    <hr>
                    <table>
                        <tr>
                            <th style="text-align: left;">Kaedah Pembelian</th>
                            <td style="text-align: right;">{{method}}</td>
                        </tr>
                    </table>
                </center>
            </div>
        </div>
        <div class="footer">
            © Hak Terpelihara Unit Hal Ehwal Pelajar & Majlis Perwakilan Pelajar Kolej Vokasional Kuala Selangor {{currentdate}}
        </div>
    </div>
</body>
</html>
