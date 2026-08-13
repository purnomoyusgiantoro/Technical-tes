<!DOCTYPE html>
<html>
<head>
    <title>Import CSV</title>
</head>
<body>
    <h1>Upload Data Order (CSV)</h1>

    @if(session('success') !== null)
        <div style="color: green;">
            <p>Berhasil disimpan: {{ session('success') }} baris</p>
            <p>Gagal disimpan: {{ session('failed') }} baris</p>
        </div>
    @endif

    @if(session('pesan_gagal') && is_array(session('pesan_gagal')))
        <div style="color: red;">
            <ul>
                @foreach(session('pesan_gagal') as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    @if($errors->any())
        <div style="color: red;">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('technical_test_orders.import') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label>Pilih File CSV:</label><br><br>
        <input type="file" name="file" accept=".csv" required>
        <br><br>
        <button type="submit">Import Data</button>
    </form>

    <br><br>
    <a href="{{ route('technical_test_orders.index') }}">Daftar Order</a>
</body>
</html>
