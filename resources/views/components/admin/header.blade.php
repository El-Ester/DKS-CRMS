<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$title ?? "CRMS"}}</title>
    <link rel="icon" type="image/png" href="{{ asset('images/DKS_Logo_no.bg.png') }}">
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('css/header.css') }}" rel="stylesheet">
    <link rel="icon" href="https://png.pngtree.com/png-vector/20220724/ourmid/pngtree-profile-icon-profile-account-employee-vector-png-image_38122508.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <div class="header">
        <div class="name-job">
            <a href="{{ route('profileAdmin.show') }}" title="View Profile">
                <i class="fa-regular fa-user" style="font-size: 1.5rem; color: white; cursor: pointer;"></i>
            </a>
        </div>
    </div>
</body>
</html>
