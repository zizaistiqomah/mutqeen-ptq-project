<form method="POST" action="/santri/setoran">
    @csrf

    <input type="date" name="tanggal">

    <input type="number" name="juz" placeholder="Juz">

    <input type="text" name="surat_mulai" placeholder="Surat Mulai">
    <input type="text" name="ayat_mulai" placeholder="Ayat Mulai">

    <input type="text" name="surat_selesai" placeholder="Surat Selesai">
    <input type="text" name="ayat_selesai" placeholder="Ayat Selesai">

    <label>
        <input type="checkbox" name="is_tasmi">
        Tasmi'
    </label>

    <button type="submit">Simpan</button>
</form>