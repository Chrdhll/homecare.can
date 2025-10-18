<!DOCTYPE html>
<html lang="id">
<head>
    <title>Pesan Formulir Kontak Baru</title>
</head>
<body style="font-family: Arial, sans-serif;">
    <p>Anda menerima pesan baru dari formulir kontak website.</p>
    <hr>
    <p><strong>Nama:</strong> {{ $data['name'] }}</p>
    <p><strong>Email:</strong> {{ $data['email'] }}</p>
    <p><strong>Subjek:</strong> {{ $data['subject'] }}</p>
    <hr>
    <p><strong>Pesan:</strong></p>
    {{-- Ini untuk menjaga format 'enter' dari textarea --}}
    <p>{!! nl2br(e($data['message'])) !!}</p>
</body>
</html>