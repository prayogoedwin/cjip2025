<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        body {
            width: 100%;
            height: 100%;
            margin: 0;
            padding: 0;
            background-color: #FAFAFA;
            font: 12pt "Tahoma";
        }

        * {
            box-sizing: border-box;
            -moz-box-sizing: border-box;
        }

        .page {
            width: 210mm;
            min-height: fit-content;
            padding: 10mm;
            margin: 10mm auto;
            border: 1px #D3D3D3 solid;
            border-radius: 5px;
            background: white;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            position: relative;
        }

        .header,
        .content,
        .footer {
            text-align: center;
        }

        .content {
            text-align: left;
            padding-left: 30px;
            padding-right: 30px;
        }

        .content table {
            width: 100%;
            margin-bottom: 20px;
        }

        .content table td {
            padding: 5px;
        }

        .footer {
            margin-top: 50px;
        }

        .signature {
            width: 45%;
            display: inline-block;
            text-align: center;
        }

        .logo {
            width: 144px;
            height: 150px;
            /* max-width: 100px; */
            margin-right: 0px;
        }

        .subpage {
            padding: 1cm;
            border: 5px red solid;
            height: 257mm;
            outline: 2cm #FFEAEA solid;
        }

        td {
            padding-top: 5px;
        }

        .text {
            /* flex-grow: 1; */
            text-align: center;
        }

        .flex-row {
            display: flex;
            flex-direction: row;
            align-items: center;
        }

        .desc {
            flex: 1;
            /* Membuat konten mengambil sisa ruang yang tersedia */
        }

        @page {
            size: A4;
            margin: 0;
        }

        @media print {

            html,
            body {
                width: 210mm;
                height: 297mm;
            }

            .page {
                margin: 0;
                border: initial;
                border-radius: initial;
                width: initial;
                min-height: initial;
                box-shadow: initial;
                background: initial;
                page-break-after: always;
            }

            .print-margin-top {
                margin-top: 50px !important;
                /* Atur margin atas sesuai kebutuhan Anda */
            }

            /*
            .page+.page {
                margin-top: 10mm;
                Ensure margin top for pages after the first
            } */
        }
    </style>
</head>

<body>
    {{ $slot }}
    <script>
        window.onload = function() {
            window.print();
        };
    </script>
</body>

</html>
