<!DOCTYPE html>
<html>
    <body>
        <table id="main" border="0">
            <tr>
                <td>
                    <h2>Auto-complete Search</h2>
                </td>
            </tr>
            <tr>
                <td id="table-form">
                    <form id="search-form">
                        <div id="autocomplete">
                            <input type="text" id="city-box" placeholder="Type your search query..."  autocomplete="off">
                            <div id="cityList"></div>
                            <input type="submit" id="search-btn" >
                        </div>
                    </form>
                </td>
            </tr>
            <tr>
                <td id="table-data">
                </td>
            </tr>
        </table>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script>
            $(document).ready(function () {
                $("#city-box").keyup(function () {
                    var city = $(this).val();
                    if (city != '') {
                        $.ajax({
                            url: "load_city.php",
                            method: "POST",
                            data: {city: city},
                            success: function (data) {
                                $("#cityList").fadeIn("fast").html(data);
                            }
                        });
                    } else {
                        $("#cityList").fadeOut();
                    }
                });
                $(document).on('click','#cityList li',function(){
                    $('#city-box').val($(this).text());
                    $("#cityList").fadeOut();
                });
                $(document).on('click',function(e){
                    e.preventDefault();
                      var city = $('#city-box').val();
                    if(city == ""){
                    }else{
                         $.ajax({
                            url: "load_table.php",
                            method: "POST",
                            data: {city: city},
                            success: function (data) {
                                $("#table-data").html(data);
                            }
                        }); 
                    } 
                });
            });
        </script>
    </body>
</html>
