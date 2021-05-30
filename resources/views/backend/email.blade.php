<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>This email just for check</title>
</head>
<body>
    <h4>Dear {{$fullName}},</h4>
    <p>Your account is successfully created.Please click the following link to active your account.</p>
    <a href="{{route('verify-email',$email_varification_token)}}">Click Here...</a>
    <p>Thanks from the Trickbd Team.</p>
</body>
</html>
