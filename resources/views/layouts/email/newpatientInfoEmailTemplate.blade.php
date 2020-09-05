<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>New Patient Registration information Mail</title>
</head>

<body>
    <h4>A New Patient registration details mentioned below</h4>
    <div style=" width:600px; margin:0 auto;height: 842px;background-size: cover;">
        <table>
            <tr>
                <td> <b>Patient Name </b></td>
                <td> <b>{{ $data->name }} </b></td>
            </tr>
            <td> <b>Patient Email</b></td>
            <td>{{$data->email }}</b></td>
            </tr>
            <td> <b>Patient Mobile</b></td>
            <td>{{$data->number }}</b></td>
            </tr>
            <td> <b>Patient Alternate No.</b></td>
            <td>{{$data->altnumber }}</b></td>
            </tr>
            <td> <b>Patient Address</b></td>
            <td>{{$data->address }}</b></td>
            </tr>
            <td> <b>Patient Pin</b></td>
            <td>{{$data->pin }}</b></td>
            </tr>
            <td> <b>Patient DOB</b></td>
            <td>{{$data->dob }}</b></td>
            </tr>
            <td> <b>Patient Gender</b></td>
            <td>{{$data->gender }}</b></td>
            </tr>
            <td> <b>Patient Language</b></td>
            <td>{{$data->language }}</b></td>
            </tr>
            <td> <b>Patient Religion</b></td>
            <td>{{$data->religion }}</b></td>
            </tr>
            <td> <b>Patient Occupation</b></td>
            <td>{{$data->occupaton }}</b></td>
            </tr>
            <td> <b>Patient Maritial Status</b></td>
            <td><b>{{$data->marital }}</b></td>
            </tr>
            </tr>
        </table>
</body>

</html>