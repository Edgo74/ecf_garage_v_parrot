var baseUrl = "https://lit-caverns-26875-c710f85b7145.herokuapp.com/ecf_garage_v_parrot/";
$(document).ready(function(){
    filter_data();
    function filter_data()
    {
        $('.filter_data').html('<div id="loading" style="" ></div>');
        var action = 'filtre_voiture';
        var minimum_price = $('#hidden_minimum_price').val();
        var maximum_price = $('#hidden_maximum_price').val();
        var minimum_kilometre = $('#hidden_minimum_kilometre').val();
        var maximum_kilometre = $('#hidden_maximum_kilometre').val();
        var minimum_year = $('#hidden_minimum_year').val();
        var maximum_year = $('#hidden_maximum_year').val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
         });
      

        $.ajax({
            url: baseUrl + "Voitures/filtre_voiture",
            method:"POST",
            data:{csrf_token: $('meta[name="csrf-token"]').attr('content'),action:action, minimum_price:minimum_price,
             maximum_price:maximum_price, minimum_kilometre:minimum_kilometre,
                 maximum_kilometre:maximum_kilometre, minimum_year:minimum_year, maximum_year:maximum_year},
            success:function(data){
                $('.filter_data').html(data);
            }
        });
    }
    $('#price_range').slider({
        range:true,
        min:50,
        max:50000,
        values:[50, 50000],
        step:50,
        stop:function(event, ui)
        {
            $('#price_show').html(ui.values[0] + ' - ' + ui.values[1]);
            $('#hidden_minimum_price').val(ui.values[0]);
            $('#hidden_maximum_price').val(ui.values[1]);
            filter_data();
        }
    });

        $('#kilometre_range').slider({
        range:true,
        min:50,
        max:500000,
        values:[50, 500000],
        step:50,
        stop:function(event, ui)
        {
            $('#kilometre_show').html(ui.values[0] + ' - ' + ui.values[1]);
            $('#hidden_minimum_kilometre').val(ui.values[0]);
            $('#hidden_maximum_kilometre').val(ui.values[1]);
            filter_data();
        }
    });
    $('#year_range').slider({
        range:true,
        min:1980,
        max:2023,
        values:[1980, 2023],
        step:1,
        stop:function(event, ui)
        {
            $('#year_show').html(ui.values[0] + ' - ' + ui.values[1]);
            $('#hidden_minimum_year').val(ui.values[0]);
            $('#hidden_maximum_year').val(ui.values[1]);
            filter_data();
        }
    });
});

