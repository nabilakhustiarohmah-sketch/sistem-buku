<!DOCTYPE html>
<html>
<head>
    <title>Edit Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">

    <h2>Edit Buku</h2>

    <form action="{{ route('books.update',$book->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Judul Buku</label>
            <input type="text"
                   name="judul"
                   class="form-control"
                   value="{{ $book->judul }}"
                   required>
        </div>

        <div class="mb-3">
            <label>Penulis</label>
            <input type="text"
                   name="penulis"
                   class="form-control"
                   value="{{ $book->penulis }}"
                   required>
        </div>

        <div class="mb-3">
            <label>Tahun Terbit</label>
            <input type="number"
                   name="tahun_terbit"
                   class="form-control"
                   value="{{ $book->tahun_terbit }}"
                   required>
        </div>

        <button class="btn btn-primary">
            Update
        </button>

        <a href="{{ route('books.index') }}" class="btn btn-secondary">
            Kembali
        </a>

    </form>

</div>

</body>
</html>