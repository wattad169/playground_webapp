<?php include 'application/config.php';
global $EM_Event, $post;
session_start();

if(isset($_GET['uname'])){
    $userid = $_GET['uname'];
}
else{
    $userid = 'asdasdasdasdasd';
}

if(isset($_GET['event_name'])){
    $sname = $_GET['event_name'];
}
if(isset($_GET['event_category'])){
    $category = $_GET['event_category'];
}
if(isset($_GET['event_date'])){
    $date = $_GET['event_date'];
}
if(isset($_GET['from_time'])){
    $from_time = $_GET['from_time'];
}
if(isset($_GET['end_time'])){
    $end_time = $_GET['end_time'];
}
if(isset($_GET['minatt'])){
    $minatt = $_GET['minatt'];
}
if(isset($_GET['maxatt'])){
    $maxatt = $_GET['maxatt'];
}
if(isset($_GET['formatted_loc'])){
    $formatted_loc = $_GET['formatted_loc'];
}
if(isset($_GET['description'])){
    $description = $_GET['description'];
}



?>
<?php

if(isset($_POST['addevent'])) {
    $dateEr         = " ";
    $timeEr         = " ";
    $minmaxEr       = " ";
    $sname          = addslashes($_POST['sname']);
    $category       = $_POST['category'];
    $lat            = $_POST['lat'];
    $long           = $_POST['long'];
    $description    = $_POST['desc'];
    $date           = stripcslashes($_POST['testget']);
    $from_time      = stripcslashes($_POST['fromTime']);
    $end_time       = stripcslashes($_POST['endTime']);
    $formatted_loc  = stripcslashes($_POST['formattedLocation']);
    $minatt         = $_POST['minattend'];
    $maxatt         = $_POST['maxattend'];
    date_default_timezone_set("Israel");
    $usr_date       = new DateTime($date);
    $today_date     = new DateTime();
    $valid_inputs   = true;
    $pieces         = explode("-", $date);
    $day            = $pieces[0];
    $month          = $pieces[1];
    $year           = $pieces[2];
    $from_time_int  = (int)str_replace(":", "", $from_time);
    $end_time_int   = (int)str_replace(":", "", $end_time);
    $current_hour   = (int)str_replace(":", "", date('H:i'));
    $now_date       = date("Ymd");
    $choosen_date = $year . $month . $day ;
    if ($now_date !== $choosen_date and $today_date > $usr_date){
        $dateEr         = "Time must be in the future";
        $valid_inputs   = false;
    }
    if($now_date == $choosen_date and $current_hour > $from_time_int) {
        $timeEr         = "Time must be in the future";
       $valid_inputs   = false;
    }
    elseif ($now_date == $choosen_date and $from_time_int - $current_hour  < 60) {
        $timeEr         = "Event must start at least after 1 hour from now";
        $valid_inputs   = false;
    }
    elseif ($from_time_int > $end_time_int) {
        $timeEr         = "End time must be after the start time";
        $valid_inputs   = false;
    }
    if ($end_time_int - $from_time_int  < 30) {
        $timeEr         = "Event duration must be at least 30 minutes";
        $valid_inputs   = false;
    }
    if ((int)$minatt > (int)$maxatt) {
        $minmaxEr         = "Maximum attendance must be at least equals minimum attendance";
        $valid_inputs   = false;
    }
    if ($valid_inputs) {
        $url = 'https://sportbuddy-1261.appspot.com/create_event/';
        if(isset($_GET['update_event'])){

            $url = 'https://sportbuddy-1261.appspot.com/update_event/';
        }

        $data = array(
            'token'     => $userid,
            'name'      => $sname,
            'location' => array('lat' => $lat , 'lon' => $long),
            'type' => strtolower($category),
            'date' => $date,
            'from_time' => $from_time,
            'end_time' =>$end_time,
            'formatted_location' => $formatted_loc,
            'description' => $description,
            'minatt' => $minatt,
            'maxatt' => $maxatt
        );
        $options = array(
            'http' => array(
                'header'  => "Content-type: application/json\r\n",
                'method'  => 'POST',
                'content' => json_encode($data)
            )
        );
        $context  = stream_context_create($options);
        $result   = file_get_contents($url, false, $context);
        echo "<script type='text/javascript'>Android.showToast('$result');</script>";
        ?>
        <script>
            window.location='addevent.php';
        </script>
        <?php
    }
}

?>
<style>
    .error {color: #FF0000;}
</style>
<script type="text/javascript" src="lib/site.js"></script>
<link rel="stylesheet" type="text/css" href="lib/site.css" />
<link rel="stylesheet" href="//code.jquery.com/mobile/1.1.0-rc.1/jquery.mobile-1.1.0-rc.1.min.css" />
<script src="//code.jquery.com/jquery-1.7.1.min.js"></script>
<!--<script src="//code.jquery.com/mobile/1.1.0-rc.1/jquery.mobile-1.1.0-rc.1.min.js"></script>-->
<script src="https://maps.google.com/maps/api/js?libraries=places&region=uk&language=en&sensor=true"></script>

<script src="mobiscroll/mobiscroll.js" type="text/javascript"></script>

<link href="mobiscroll/mobiscroll.css" rel="stylesheet" type="text/css" />

<script type="text/javascript">
    $(document).ready(function () {
        // Date mobiscroll-picker - use common functions
        init_datepicker('#pdate');
        // Time
        init_timepicker('#ptime');
        // Datetime
        init_datetimepicker('#pdatetime');

        // Date with external button
        $('#date1').scroller();
        // Time
        $('#date2').scroller({ preset: 'time' });
        // Datetime
        $('#date3').scroller({ preset: 'datetime' });

        var group = {};
        var wheels = [group];
        for (var i = 1; i < 4; i++) {
            var wheel = {};
            for (var j = 0; j < 100; j++) {
                wheel[j] = '<img src="img/fruit-' + (j % 5 + 1) + '.png" />'
            }
            group['Fruit ' + i] = wheel;
        }

        $('#custom').scroller({
            wheels: wheels
        });

        $('#theme, #mode').change(function() {
            var t = $('#theme').val();
            var m = $('#mode').val();
            $('#date1').scroller('destroy').scroller({ theme: t, mode: m });
            $('#date2').scroller('destroy').scroller({ preset: 'time', theme: t, mode: m });
            $('#date3').scroller('destroy').scroller({ preset: 'datetime', theme: t, mode: m });
            $('#custom').scroller('destroy').scroller({ wheels: wheels, theme: t, mode: m });
        });
    });

    /* common functions: */

    //function show_picker(id, d) {
    //  $(id).scroller('show');
    //}

    function init_datepicker(id) {
        $(id).scroller({ dateFormat: "dd-mm-yy", dateOrder: "ddmmyy" });
    }

    function init_timepicker(id) {
        $(id).scroller({ preset: 'time', timeFormat: 'H:ii', ampm: false });
    }

    function init_datetimepicker(id) {
        $(id).scroller({ preset: 'datetime', dateFormat: "dd-mm-yy", timeFormat: 'H:ii', ampm: false, dateOrder: "ddmmyy" });
    }

    function show_datepicker(id, d, cb) {
        var mycb = function() {
            var d2 = $(id).scroller('getDate');
            $(id).unbind('change', mycb);
            if (!!cb) cb(d2);
        };

        $(id).bind('change', mycb);

        var yr = d.getFullYear();
        var mo = d.getMonth() + 1;
        var da = d.getDate();
        $(id).attr("value", (da < 10 ? "0" : "") + da + (mo < 10 ? "-0" : "-") + mo  + '-' + yr)
        $(id).scroller('show');
    }

    function show_timepicker(id, d, cb) {
        var mycb = function() {
            var d2 = $(id).scroller('getDate');
            $(id).unbind('change', mycb);
            if (!!cb) cb(d2);
        };

        $(id).bind('change', mycb);

        var hr = d.getHours();
        var min = d.getMinutes();
        $(id).attr("value", "" + hr + ":" +  (min < 10 ? "0" : "") + min);
        $(id).scroller('show');
    }

    function show_datetimepicker(id, d, cb) {
        var mycb = function() {
            var d2 = $(id).scroller('getDate');
            $(id).unbind('change', mycb);
            if (!!cb) cb(d2);
        };

        $(id).bind('change', mycb);

        var yr = d.getFullYear();
        var mo = d.getMonth() + 1;
        var da = d.getDate();
        var hr = d.getHours();
        var min = d.getMinutes();
        $(id).attr("value", (da < 10 ? "0" : "") + da + (mo < 10 ? "-0" : "-") + mo  + '-' + yr +
            " " + hr + ":" +  (min < 10 ? "0" : "") + min);
        $(id).scroller('show');
    }

    /* window functions: */

    var mydate = new Date(2012, 4-1, 9);

    var mytime = new Date();
    mytime.setHours(9);
    mytime.setMinutes(5);

    var mydatetime = new Date(2012, 4 - 1, 9);
    mydatetime.setHours(9);
    mydatetime.setMinutes(5);

    function mydatepicker() {
        show_datepicker('#pdate', mydate, function(d) {
            mydate = d;
            var yr = d.getFullYear();
            var mo = d.getMonth() + 1;
            var da = d.getDate();
            $("#adate").html( (da < 10 ? "0" : "") + da + (mo < 10 ? "-0" : "-") + mo  + '-' + yr);
        });
    }

    function mytimepicker() {
        show_timepicker('#ptime', mytime, function(d) {
            mytime = d;
            var hr = d.getHours();
            var min = d.getMinutes();
            $("#atime").html("" + hr + ":" +  (min < 10 ? "0" : "") + min);
        });
        show_timepicker('#ptime2', mytime, function(d) {
            mytime = d;
            var hr = d.getHours();
            var min = d.getMinutes();
            $("#atime").html("" + hr + ":" +  (min < 10 ? "0" : "") + min);
        });
    }

    function mydatetimepicker() {
        show_datetimepicker('#pdatetime', mydatetime, function(d) {
            mydatetime = d;
            var yr = d.getFullYear();
            var mo = d.getMonth() + 1;
            var da = d.getDate();
            var hr = d.getHours();
            var min = d.getMinutes();
            $("#adatetime").html( (da < 10 ? "0" : "") + da + (mo < 10 ? "-0" : "-") + mo  + '-' + yr + " " + hr + ":" +  (min < 10 ? "0" : "") + min);
        });
    }

</script>

<div id="form-main" style="margin-top: -25px;">
    <div id="form-div">
        <h3 style="color: mediumseagreen" id="msg"></h3>
       <!-- <h2 align="center" style="color: white;">Add Event Detail</h2>-->
        <form class="form" id="Form Image" method="post" enctype="multipart/form-data" style="margin-top: -25px;">

            <p class="name">
                <input name="sname" type="text" class="feedback-input" placeholder="Event Name" id="name"
                       value="<?php echo (isset($sname))?$sname:'';?>" required/>
            </p>
            <div class="demo">

                <p id="datepairExample">
                    <img class="fa fa-calendar inline" src="css/icon/time.svg" width="30" height="30" style="vertical-align:-10px" ></img>
                    <input value="<?php echo (isset($date))?$date:'';?>" id="pdate" type="text" class="mobiscroll" placeholder="Event date" readonly="readonly" name="testget" required/>
                    <span class="error"><?php echo $dateEr;?></span>
                </p>
                <p id="timepariExample">
                    <img class="fa fa-calendar inline" src="css/icon/clock.svg" width="30" height="30" style="vertical-align:-10px" ></img>
                    <input value="<?php echo (isset($from_time))?$from_time:'';?>" id="ptime" class="mobiscroll" type="text" placeholder="Start time" name="fromTime" required style="width: 80px;"/> to
                    <input value="<?php echo (isset($end_time))?$end_time:'';?>" id="ptime2" class="mobiscroll" type="text"  placeholder="End time" name="endTime" required style="width: 80px;"/>
                    <span class="error"><?php echo $timeEr;?></span>
                </p>

            </div>

            <p class="name">
                <input value="<?php echo (isset($minatt))?$minatt:'';?>" name="minattend" type="number" class="feedback-input" placeholder="Minimum Attendance" id="name" required/>
                <span class="error"><?php echo $minmaxEr;?></span>
            </p>
            <p class="name">
                <input value="<?php echo (isset($maxatt))?$maxatt:'';?>"  name="maxattend" type="number" class="feedback-input" placeholder="Maximum Attendance" id="name" required/>
                <span class="error"><?php echo $minmaxEr;?></span>
            </p>

            <p class="name">
                <select id="category" name="category" class="feedback-input" required>
                    <option value="">Select Category</option>

                    <option <?php if($category == 'Football'){echo("selected");}?> value="Football" style="background-image:url(css/icon/sports.svg);">Football</option>
                    <option <?php if($category == 'Basketball'){echo("selected");}?> value="Basketball" style="background-image:url(css/icon/sports.svg);">Basketball</option>
                    <option <?php if($category == 'Running'){echo("selected");}?> value="Running" style="background-image:url(css/icon/sports.svg);">Running</option>
                    <option <?php if($category == 'Gym'){echo("selected");}?> value="Gym" style="background-image:url(css/icon/sports.svg);">Gym</option>
                    <option <?php if($category == 'Tennis'){echo("selected");}?> value="Tennis" style="background-image:url(css/icon/sports.svg);">Tennis</option>
                    <?php

                    ?>
                </select>
            </p>
            <p class="name">
                <textarea rows="5" name="desc" class="feedback-input" placeholder="Write Event Description" id="comment"><?php echo (isset($description))?$description:'';?></textarea>
            </p>
            <p class="name" id="latlong">
                <input value="<?php echo (isset($formatted_loc))?$formatted_loc:'';?>" id="searchTextField" type="text" size="50" placeholder="Search Location " class="feedback-input lngbox" name="formattedLocation" required>
            </p>

            <p class="name">
                <div  id="map_canvas" style="width:100%; height:250px"></div>
            </p>

            <div class="submit">
                <input type="submit" value="<?php echo (isset($_GET['update_event']))?'Update Event Detail':'Add event Detail';?>"name="addevent" id="button-blue"/>
                <div class="ease"></div>
            </div>
            <p class="name" id="latlong" style="visibility:collapse">
                <input type="text" id="latbox" name="lat"  class="feedback-input MapLat" placeholder="Latitude"/>
            </p>
            <p class="name" id="latlong" style="visibility:collapse">

                <input type="text" id="lngbox" name="long" class="feedback-input MapLon" placeholder="Longitude"/>
            </p>


        </form>
    </div>
    <div style="height: 1870px;"></div>
</div>


<?php
if(!isset($lat)){
    $lat=25.403584973186703;
    $long=79.453125;
}
?>
<script type="text/javascript">
    $(document).ready(function () {
        // Date mobiscroll-picker - use common functions
        init_datepicker('#pdate');
        // Time
        init_timepicker('#ptime');
        init_timepicker('#ptime2');
        // Datetime
        init_datetimepicker('#pdatetime');

        // Date with external button
        $('#date1').scroller();
        // Time
        $('#date2').scroller({ preset: 'time' });
        // Datetime
        $('#date3').scroller({ preset: 'datetime' });

        var group = {};
        var wheels = [group];
        for (var i = 1; i < 4; i++) {
            var wheel = {};
            for (var j = 0; j < 100; j++) {
                wheel[j] = '<img src="img/fruit-' + (j % 5 + 1) + '.png" />'
            }
            group['Fruit ' + i] = wheel;
        }

        $('#custom').scroller({
            wheels: wheels
        });

        $('#theme, #mode').change(function() {
            var t = $('#theme').val();
            var m = $('#mode').val();
            $('#date1').scroller('destroy').scroller({ theme: t, mode: m });
            $('#date2').scroller('destroy').scroller({ preset: 'time', theme: t, mode: m });
            $('#date3').scroller('destroy').scroller({ preset: 'datetime', theme: t, mode: m });
            $('#custom').scroller('destroy').scroller({ wheels: wheels, theme: t, mode: m });
        });
    });

    /* common functions: */

    //function show_picker(id, d) {
    //  $(id).scroller('show');
    //}

    function init_datepicker(id) {
        $(id).scroller({ dateFormat: "dd-mm-yy", dateOrder: "ddmmyy" });
    }

    function init_timepicker(id) {
        $(id).scroller({ preset: 'time', timeFormat: 'H:ii', ampm: false });
    }

    function init_datetimepicker(id) {
        $(id).scroller({ preset: 'datetime', dateFormat: "dd-mm-yy", timeFormat: 'H:ii', ampm: false, dateOrder: "ddmmyy" });
    }

    function show_datepicker(id, d, cb) {
        var mycb = function() {
            var d2 = $(id).scroller('getDate');
            $(id).unbind('change', mycb);
            if (!!cb) cb(d2);
        };

        $(id).bind('change', mycb);

        var yr = d.getFullYear();
        var mo = d.getMonth() + 1;
        var da = d.getDate();
        $(id).attr("value", (da < 10 ? "0" : "") + da + (mo < 10 ? "-0" : "-") + mo  + '-' + yr)
        $(id).scroller('show');
    }

    function show_timepicker(id, d, cb) {
        var mycb = function() {
            var d2 = $(id).scroller('getDate');
            $(id).unbind('change', mycb);
            if (!!cb) cb(d2);
        };

        $(id).bind('change', mycb);

        var hr = d.getHours();
        var min = d.getMinutes();
        $(id).attr("value", "" + hr + ":" +  (min < 10 ? "0" : "") + min);
        $(id).scroller('show');
    }

    function show_datetimepicker(id, d, cb) {
        var mycb = function() {
            var d2 = $(id).scroller('getDate');
            $(id).unbind('change', mycb);
            if (!!cb) cb(d2);
        };

        $(id).bind('change', mycb);

        var yr = d.getFullYear();
        var mo = d.getMonth() + 1;
        var da = d.getDate();
        var hr = d.getHours();
        var min = d.getMinutes();
        $(id).attr("value", (da < 10 ? "0" : "") + da + (mo < 10 ? "-0" : "-") + mo  + '-' + yr +
            " " + hr + ":" +  (min < 10 ? "0" : "") + min);
        $(id).scroller('show');
    }

    /* window functions: */

    var mydate = new Date(2012, 4-1, 9);

    var mytime = new Date();
    mytime.setHours(9);
    mytime.setMinutes(5);

    var mydatetime = new Date(2012, 4 - 1, 9);
    mydatetime.setHours(9);
    mydatetime.setMinutes(5);

    function mydatepicker() {
        show_datepicker('#pdate', mydate, function(d) {
            mydate = d;
            var yr = d.getFullYear();
            var mo = d.getMonth() + 1;
            var da = d.getDate();
            $("#adate").html( (da < 10 ? "0" : "") + da + (mo < 10 ? "-0" : "-") + mo  + '-' + yr);
        });
    }

    function mytimepicker() {
        show_timepicker('#ptime', mytime, function(d) {
            mytime = d;
            var hr = d.getHours();
            var min = d.getMinutes();
            $("#atime").html("" + hr + ":" +  (min < 10 ? "0" : "") + min);
        });
        show_timepicker('#ptime2', mytime, function(d) {
            mytime = d;
            var hr = d.getHours();
            var min = d.getMinutes();
            $("#atime").html("" + hr + ":" +  (min < 10 ? "0" : "") + min);
        });
    }

    function mydatetimepicker() {
        show_datetimepicker('#pdatetime', mydatetime, function(d) {
            mydatetime = d;
            var yr = d.getFullYear();
            var mo = d.getMonth() + 1;
            var da = d.getDate();
            var hr = d.getHours();
            var min = d.getMinutes();
            $("#adatetime").html( (da < 10 ? "0" : "") + da + (mo < 10 ? "-0" : "-") + mo  + '-' + yr + " " + hr + ":" +  (min < 10 ? "0" : "") + min);
        });
    }

</script>
<script>
    $(function () {
        var lat = <?php echo $lat; ?>,
            lng = <?php echo $long; ?>,
            latlng = new google.maps.LatLng(lat, lng),
            image = 'https://www.google.com/intl/en_us/mapfiles/ms/micons/blue-dot.png';
        //zoomControl: true,
        //zoomControlOptions: google.maps.ZoomControlStyle.LARGE,
        var mapOptions = {
                center: new google.maps.LatLng(lat, lng),
                zoom: 13,
                mapTypeId: google.maps.MapTypeId.ROADMAP,
                panControl: true,
                panControlOptions: {
                    position: google.maps.ControlPosition.TOP_RIGHT
                },
                zoomControl: true,
                zoomControlOptions: {
                    style: google.maps.ZoomControlStyle.LARGE,
                    position: google.maps.ControlPosition.TOP_left
                }
            },
            map = new google.maps.Map(document.getElementById('map_canvas'), mapOptions),
            marker = new google.maps.Marker({
                position: latlng,
                map: map,
                icon: image
            });
        var input = document.getElementById('searchTextField');
        var autocomplete = new google.maps.places.Autocomplete(input, {
            types: ["geocode"]
        });
        autocomplete.bindTo('bounds', map);
        var infowindow = new google.maps.InfoWindow();
        google.maps.event.addListener(autocomplete, 'place_changed', function (event) {
            infowindow.close();
            var place = autocomplete.getPlace();
            if (place.geometry.viewport) {
                map.fitBounds(place.geometry.viewport);
            } else {
                map.setCenter(place.geometry.location);
                map.setZoom(17);
            }
            moveMarker(place.name, place.geometry.location);
            $('.MapLat').val(place.geometry.location.lat());
            $('.MapLon').val(place.geometry.location.lng());
        });
        google.maps.event.addListener(map, 'click', function (event) {
            $('.MapLat').val(event.latLng.lat());
            $('.MapLon').val(event.latLng.lng());
            infowindow.close();
            var geocoder = new google.maps.Geocoder();
            geocoder.geocode({
                "latLng":event.latLng
            }, function (results, status) {
                console.log(results, status);
                if (status == google.maps.GeocoderStatus.OK) {
                    console.log(results);
                    var lat = results[0].geometry.location.lat(),
                        lng = results[0].geometry.location.lng(),
                        placeName = results[0].address_components[0].long_name,
                        latlng = new google.maps.LatLng(lat, lng);
                    moveMarker(placeName, latlng);
                    $("#searchTextField").val(results[0].formatted_address);
                }
            });
        });

        function moveMarker(placeName, latlng) {
            marker.setIcon(image);
            marker.setPosition(latlng);
            infowindow.setContent(placeName);
            //infowindow.open(map, marker);
        }
    });
</script>
<style>
    @import url(https://fonts.googleapis.com/css?family=Montserrat:400,700);

    html{

        background: white no-repeat; /* For browsers that do not support gradients */
        background-size: cover;
        height:100%;
    }

    #feedback-page{
        text-align:center;
    }

    #form-main{
        width:100%;
        float:left;
        padding-top:0px;
    }

    #form-div {
        background-color:#7092BE;
        padding-left:35px;
        padding-right:35px;
        padding-top:35px;
        padding-bottom:20px;
        width: 450px;
        float: left;
        left: 50%;
        position: absolute;
        margin-top:30px;
        margin-left: -260px;
        -moz-border-radius: 7px;
        -webkit-border-radius: 7px;
    }

    .feedback-input {
        color:#3c3c3c;
        font-family: Helvetica, Arial, sans-serif;
        font-weight:500;
        font-size: 18px;
        border-radius: 0;
        line-height: 22px;
        background-color: #fbfbfb;
        padding: 13px 13px 13px 54px;
        margin-bottom: 10px;
        width:100%;
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        -ms-box-sizing: border-box;
        box-sizing: border-box;
        border: 3px solid rgba(0,0,0,0);
    }

    .feedback-input:focus{
        background: #fff;
        box-shadow: 0;
        border: 3px solid #216d49;
        color: #216d49;
        outline: none;
        padding: 13px 13px 13px 54px;
    }

    .focused{
        color:#216d49;
        border:#216d49 solid 3px;
    }

    /* Icons ---------------------------------- */
    #name{
        background-image: url(css/icon/draw-a-picture.svg);
        background-size: 30px 30px;
        background-position: 11px 8px;
        background-repeat: no-repeat;
    }

    #name:focus{
        background-image: url(css/icon/draw-a-picture.svg);
        background-size: 30px 30px;
        background-position: 8px 5px;
        background-position: 11px 8px;
        background-repeat: no-repeat;
    }

    #email{
        background-image: url(css/icon/mail.svg);
        background-size: 30px 30px;
        background-position: 11px 8px;
        background-repeat: no-repeat;
    }

    #datepairExamples{
        background-image: url(css/icon/time.svg);
        background-size: 30px 30px;
        background-position: 11px 8px;
        background-repeat: no-repeat;
    }

    #email:focus{
        background-image: url(css/icon/mail.svg);
        background-size: 30px 30px;
        background-position: 11px 8px;
        background-repeat: no-repeat;
    }

    #comment{
        background-image: url(css/icon/writing.svg);
        background-size: 30px 30px;
        background-position: 11px 8px;
        background-repeat: no-repeat;
    }


    #phone{
        background-image: url(css/icon/mobile-phone.svg);
        background-size: 30px 30px;
        background-position: 11px 8px;
        background-repeat: no-repeat;
    }

    #phone:focus{
        background-image: url(css/icon/mobile-phone.svg);
        background-size: 30px 30px;
        background-position: 11px 8px;
        background-repeat: no-repeat;
    }

    #sms{
        background-image: url(css/icon/redo-arrow.svg);
        background-size: 30px 30px;
        background-position: 11px 8px;
        background-repeat: no-repeat;
    }

    #sms:focus{
        background-image: url(css/icon/redo-arrow.svg);
        background-size: 30px 30px;
        background-position: 11px 8px;
        background-repeat: no-repeat;
    }
    #featured{
        background-image: url(css/icon/globe-grid.svg);
        background-size: 30px 30px;
        background-position: 11px 8px;
        background-repeat: no-repeat;
    }

    #featured:focus{
        background-image: url(css/icon/globe-grid.svg);
        background-size: 30px 30px;
        background-position: 11px 8px;
        background-repeat: no-repeat;
    }

    #url{
        background-image: url(css/icon/stumbleupon.svg);
        background-size: 30px 30px;
        background-position: 11px 8px;
        background-repeat: no-repeat;
    }

    #url:focus{
        background-image: url(css/icon/stumbleupon.svg);
        background-size: 30px 30px;
        background-position: 11px 8px;
        background-repeat: no-repeat;
    }

    #latbox{
        background-image: url(css/icon/placeholder.svg);
        background-size: 30px 30px;
        background-position: 11px 8px;
        background-repeat: no-repeat;
    }

    #latbox:focus{
        background-image: url(css/icon/placeholder.svg);
        background-size: 30px 30px;
        background-position: 11px 8px;
        background-repeat: no-repeat;
    }

    #lngbox{
          background-image: url(css/icon/placeholder.svg);
          background-size: 30px 30px;
          background-position: 11px 8px;
          background-repeat: no-repeat;
      }

    #lngbox:focus{
        background-image: url(css/icon/placeholder.svg);
        background-size: 30px 30px;
        background-position: 11px 8px;
        background-repeat: no-repeat;
    }
    .lngbox{
        background-image: url(css/icon/placeholder.svg);
        background-size: 30px 30px;
        background-position: 11px 8px;
        background-repeat: no-repeat;
    }

    .lngbox:focus{
        background-image: url(css/icon/placeholder.svg);
        background-size: 30px 30px;
        background-position: 11px 8px;
        background-repeat: no-repeat;
    }

    #category{
        background-image: url(css/icon/menu.svg);
        background-size: 30px 30px;
        background-position: 11px 8px;
        background-repeat: no-repeat;
    }
    #clock{
        background-image: url(css/icon/clock.svg);
        background-size: 30px 30px;
        background-position: 11px 8px;
        background-repeat: no-repeat;
    }
    #caltime{
        background-image: url(css/icon/time.svg);
        background-size: 30px 30px;
        background-position: 11px 8px;
        background-repeat: no-repeat;
    }

    #category:focus{
        background-image: url(css/icon/menu.svg);
        background-size: 30px 30px;
        background-position: 11px 8px;
        background-repeat: no-repeat;
    }
    #gallery{
        background-image: url(css/icon/gallery.svg);
        background-size: 30px 30px;
        background-position: 11px 8px;
        background-repeat: no-repeat;
    }

    #gallery:focus{
        background-image: url(css/icon/gallery.svg);
        background-size: 30px 30px;
        background-position: 11px 8px;
        background-repeat: no-repeat;
    }
    textarea {
        width: 100%;
        height: 150px;
        line-height: 150%;
        resize:vertical;
    }

    input:hover, textarea:hover,
    input:focus, textarea:focus {
        background-color:white;
    }

    #button-blue{
        font-family: 'Montserrat', Arial, Helvetica, sans-serif;
        float:left;
        width: 100%;
        border: #fbfbfb solid 4px;
        cursor:pointer;
        background-color: #216d49;
        color:white;
        font-size:22px;
        padding-top:10px;
        padding-bottom:10px;
        -webkit-transition: all 0.3s;
        -moz-transition: all 0.3s;
        transition: all 0.3s;
        margin-top:-4px;
        font-weight:700;
    }

    #button-blue:hover{
        background-color: rgba(0,0,0,0);
        color: #216d49;
    }

    .submit:hover {
        color: #216d49;
    }

    .ease {
        width: 0px;
        height: 50px;
        background-color: #fbfbfb;
        -webkit-transition: .3s ease;
        -moz-transition: .3s ease;
        -o-transition: .3s ease;
        -ms-transition: .3s ease;
        transition: .3s ease;
    }

    .submit:hover .ease{
        width:100%;
        background-color:white;
    }

    @media only screen and (max-width: 580px) {
        #form-div{
            left: 3%;
            margin-right: 3%;
            width: 88%;
            margin-left: 0;
            padding-left: 3%;
            padding-right: 3%;
        }
    }
</style>