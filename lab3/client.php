<!doctype html>
<head>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <script
        src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
        crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            $('#country').change(function() {
                var countryId = $(this).val();
                if(countryId) {
                    $.ajax({
                        url: 'get_cities.php',
                        type: 'POST',
                        data: {country_id: countryId},
                        dataType: 'JSON',
                        success:function(response) {
                            $('#city').empty();
                            $.each(response, function(key, value) {
                                $('#city').append('<option value="'+ key +'">'+ value +'</option>');
                            });
                        }
                    });
                } else {
                    $('#city').empty();
                    $('#city').append('<option value="">-- Выберите город --</option>');
                }
            });
        });
    </script>
    <title></title>
</head>
<body>
<label for="country">Выберите страну:</label>
<select id="country" name="country">
    <option value="">-- Выберите страну --</option>
    <option value="1">Россия</option>
    <option value="2">США</option>
    <option value="3">Китай</option>
    <option value="4">Германия</option>
    <option value="5">Франция</option>
</select>

<label for="city">Выберите город:</label>
<select id="city" name="city">
    <option value="">-- Выберите город --</option>
</select>
</body>
</html>
