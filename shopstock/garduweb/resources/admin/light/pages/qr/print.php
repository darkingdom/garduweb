<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PRINT QR</title>
    <script src="<?= HOST ?>/vendor/qr/1.0.0/qrcode.min.js"></script>
    <style>
        .qr-wrapper {
            border: 2px solid #000;
            float: left;
            margin: 5px;
            width: 120px;
        }

        .qr-body {
            padding: 5px;
        }

        .qr-body img {
            display: block;
            margin-left: auto;
            margin-right: auto;
        }

        .qr-footer {
            font-size: 11px;
            padding: 5px;
            padding-top: 0;
            word-wrap: break-word;
        }
    </style>
</head>

<body onload="window.print()">

    <!-- <body> -->
    <div>
        <?php foreach ($data->qr as $qr) : ?>
            <div class="qr-wrapper">
                <div class="qr-body">
                    <div id="qrcode<?= $qr->id ?>"></div>
                </div>
                <div class="qr-footer">
                    uuid:<?= $qr->qr_code ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>



    <script>
        function qrc(et, codeqr) {
            var qrcode = new QRCode(et, {
                text: codeqr,
                width: 100,
                height: 100,
                colorDark: "#000000",
                colorLight: "#ffffff",
                correctLevel: QRCode.CorrectLevel.H,
            });
        }

        <?php
        foreach ($data->qr as $qr) :
            echo "qrc('qrcode{$qr->id}', '{$qr->qr_code}');";
        endforeach;
        ?>
    </script>
</body>

</html>