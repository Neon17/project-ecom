<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redirecting to eSewa...</title>
</head>
<body>
    <form id="esewaForm" action="{{ $esewa_url }}" method="POST">
        @foreach($postData as $key => $value)
            <input type="hidden" name="{{ $key }}" value="{{ $value }}">
        @endforeach
    </form>

    <script type="text/javascript">
        document.getElementById('esewaForm').submit();
    </script>

    <div style="text-align: center; margin-top: 50px;">
        <p>Redirecting to eSewa payment gateway...</p>
        <p>If you are not redirected automatically, <a href="javascript:void(0)" onclick="document.getElementById('esewaForm').submit()">click here</a>.</p>
    </div>
</body>
</html>