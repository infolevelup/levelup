    <link rel="stylesheet" href="{{ asset('jqueryautocomlete.css')}}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <div class="row">
        <form class="navbar-form text-center " form method="GET" action=" ">
            <input id="search_text" placeholder=" Search products" name="search_text" type="text" value=""
                   style="width: 400px; height: 35px; border-radius: 5px ; padding-left: 12px;"><br><br>
            <input class="btn btn-default " type="submit" value="  Search">
        </form>
    </div>

    <script>
        $(document).ready(function () {
            src = "{{ route('searchajax') }}";
       $("#search_text").autocomplete({
    source: function (request, response) {
        $.ajax({
            url: src,
            dataType: "json",
            data: {
                term: request.term
            },
            success: function (data) {
                response(data);

            }
        });
    },
    minLength: 3,
    select: function( event, ui ) {
        // Your autoComplete response returns the ID in the 'value' field
        window.location = '{{url('/')}}/search/' + ui.item.value
    }
});
        });
    </script>
<!---<!DOCTYPE html>--->
<html>
<head>
    <title>Typehead</title>
        <link rel="stylesheet" href="{{asset('bootstrap.min.css')}}">

</head>
    <style type="text/css">
        img{
            border-radius: 3px;
        }
        p{
            color: #a1a1a1;
        }
        ul{
            width: 96%;
        }
    </style>
<body>
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <input type="text" class="form-control typeahead">
        </div>
    </div>

</body>

  <script src="{{asset('jquery.js')}}"></script>
  <script src="{{asset('typeahead.min.js')}}"></script>
  
<script type="text/javascript">
    var path = "{{ route('autocomplete') }}";
    $('input.typeahead').typeahead({
        source:  function (query, process) {
            return $.get(path, { query: query }, function (data) {
                return process(data);
            });
        },
        
        
        highlighter: function (item, data) {
            var parts = item.split('#'),
                html = '<div class="row">';
                html += '<div class="col-md-2">';
                html += '<img src="/image/'+data.img+'"/ height="44px;" width="65px;">';
                html += '</div>';
                html += '<div class="col-md-10 pl-0">';
                html += '<span>'+data.name+'</span>';
                html += '<p class="m-0">'+data.desc+'</p>';
                html += '</div>';
                html += '</div>';

            return html;
        }
    });
</script>
</html>