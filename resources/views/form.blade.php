<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kullanıcı Formu</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
    <div class="form-container">
        <h2>Kullanıcı Bilgileri</h2>
        <form action="{{ route('saveData') }}" method="POST">
            @csrf
            <label for="name">İsim:</label>
            <input type="text" name="name" id="name" required>

            <label for="surname">Soyisim:</label>
            <input type="text" name="surname" id="surname" required>

            <label for="email">E-posta:</label>
            <input type="email" name="email" id="email" required>

            <label for="country">Ülke:</label>
            <select id="country" name="country_id" required>
                <option value="">Ülke Seçin</option>
                @foreach($countries as $country)
                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                @endforeach
            </select>

            <label for="province">İl:</label>
            <select id="province" name="province_id" required>
                <option value="">İl Seçin</option>
            </select>

            <label for="district">İlçe:</label>
            <select id="district" name="district_id" required>
                <option value="">İlçe Seçin</option>
            </select>

            <button type="submit">Kaydet</button>
        </form>
    </div>

    <script>
        document.getElementById('country').addEventListener('change', function() {
            let countryId = this.value;
            if(countryId) {
                fetch(`/getProvinces/${countryId}`)
                .then(response => response.json())
                .then(data => {
                    let provinceSelect = document.getElementById('province');
                    provinceSelect.innerHTML = '<option value="">İl Seçin</option>';
                    data.forEach(function(province) {
                        let option = document.createElement('option');
                        option.value = province.id;
                        option.text = province.name;
                        provinceSelect.add(option);
                    });
                });
            }
        });

        document.getElementById('province').addEventListener('change', function() {
            let provinceId = this.value;
            if(provinceId) {
                fetch(`/getDistricts/${provinceId}`)
                .then(response => response.json())
                .then(data => {
                    let districtSelect = document.getElementById('district');
                    districtSelect.innerHTML = '<option value="">İlçe Seçin</option>';
                    data.forEach(function(district) {
                        let option = document.createElement('option');
                        option.value = district.id;
                        option.text = district.name;
                        districtSelect.add(option);
                    });
                });
            }
        });
    </script>
</body>
</html>
