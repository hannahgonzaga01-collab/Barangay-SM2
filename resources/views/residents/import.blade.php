<div style="padding: 50px; font-family: sans-serif;">
    <h2>Resident Bulk Import (CSV)</h2>
    <p>Queen, dito mo i-upload ang listahan para pumasok ang 1k-2k residents!</p>

    <form action="{{ route('residents.import') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="csv_file" required style="border: 1px solid #ccc; padding: 10px;">
        <br><br>
        <button type="submit" style="background: blue; color: white; padding: 10px 20px; cursor: pointer;">
            START BULK IMPORT
        </button>
    </form>
</div>
