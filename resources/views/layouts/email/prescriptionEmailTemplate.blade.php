<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>email template</title>
</head>

<body>
    <div
        style="background-image:url('{{asset('images/prescriptionSlip.jpeg')}}'); width:600px; margin:0 auto;height: 842px;background-size: cover;">
        <div style="width:98%; float:left;padding-top: 35px;text-align: right;padding-right: 0;font-size: 23px;">
            {{ $data['docName']}} <br> {{ $data['specialization']}}
        </div>
        <div
            style="width:100%; float:left; padding-top: 165px;text-align: left;font-size: 12px;min-height: 300px;white-space: pre-line; white-space: pre-wrap; margin-left:30px">
            {{ $data['prescription']}} </div>
        <div style="width:95%; float:left;text-align: right;font-size: 23px;    margin-top: 154px; "><img
                src="{{ asset('storage/doctor/profile/'.$data['sign']) }}" width="100" height="75"></div>
    </div>
</body>

</html>