<!DOCTYPE html>
<html>
<head>
    <title>QR Generator</title>
</head>
<body>

<h2>QR Code Generator</h2>

<div id="qrcode"></div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>

<script>
    new QRCode(document.getElementById("qrcode"), {
        text: "http://192.168.120.189/SmartTourism_LiveBusTrackingSystem/",
        width: 200,
        height: 200
    });
</script>

</body>
</html>