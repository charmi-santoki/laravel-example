<!DOCTYPE html>
<html>
<head>
    <title>ItsolutionStuff.com</title>
</head>
<body>
    <h1>{{$mailData->name}}</h1>
    <p>Welcome</p>
    <td>
        <img src="{{ Storage::url($mailData->image) }}" alt="{{ $mailData->image }}" class="w-25 p-3">
    </td>
    <p>Thank you</p>
</body>
</html>