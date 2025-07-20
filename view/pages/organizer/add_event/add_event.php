<!DOCTYPE html>
<html lang="en">

<head>
    <?PHP
    require '../../../includes/head.php';
    ?>

    <link rel="stylesheet" href="style.css">
    <title>Add Event</title>
</head>

<body>
    <style>

    </style>
    <div class="container">
        <?PHP
        include '../../../includes/app_header/header.php';
        ?>
        <ul class="nav nav-tabs">
            <li class="form-tab active">
                <a data-toggle="tab" href="#phase-1">1</a>
            </li>
            <li class="form-tab ">
                <a data-toggle="tab" href="#phase-2">2</a>
            </li>
            <li class="form-tab ">
                <a data-toggle="tab" href="#phase-3">3</a>
            </li>
            <li class="form-tab ">
                <a data-toggle="tab" href="#phase-4">4</a>
            </li>
        </ul>

        <div class="tab-content">
            <div id="phase-1" class="tab-pane fade in active">
                <div class="form-group my-2">
                    <label for="title">Event Title</label>
                    <input type="text" name="title" class="form-control" id="title" placeholder="Enter Event Title">
                </div>
                <!-- Description -->
                <div class="form-group my-2">
                    <label for="description">Description</label>
                    <textarea name="description" class="form-control" id="description" rows="3" placeholder="Enter Event Description"></textarea>
                </div>
                <!-- Details -->
                <div class="form-group my-2">
                    <label for="details">Details</label>
                    <textarea name="details" class="form-control" id="details" rows="3" placeholder="Enter Event Details and Rules"></textarea>
                </div>
                <div class="d-flex flex-row justify-content-between">
                    <div class="form-group my-2 col-5">
                        <label for="date">Event Start At</label>
                        <input type="datetime-local" name="start_at" class="form-control" id="start_at">
                        <div class="invalid-feedback">Sorry, that username's taken. Try another?</div>
                    </div>
                    <div class="form-group my-2 col-5 has-danger">
                        <label for="end_at">Event End At</label>
                        <input type="datetime-local" name="end_at" class="form-control" id="end_at">
                        <div class="invalid-feedback">Sorry, that username's taken. Try another?</div>
                    </div>
                </div>
                <div class="d-flex flex-row justify-content-between">
                    <div class="form-group my-2">
                        <label for="event_state">Event Current State</label>
                        <select name="event_state" class="form-control" id="event_state">
                            <option value="upcoming">Upcoming</option>
                            <option value="continous">Continous</option>
                            <option value="paused">Paused</option>
                        </select>
                    </div>
                    <div class="form-group my-2">
                        <label for="ticket_quantity">Ticket Quantity</label>
                        <input name="ticket_quantity" type="number" class="form-control" id="ticket_quantity" placeholder="Enter Ticket Quantity">
                    </div>
                </div>
                <input type="text" name="org_email" hidden class="d-none" value="<?PHP echo $_COOKIE['org_email'] ?>">
            </div>
            <div id="phase-2" class="tab-pane fade">
                <!-- Categories -->
                <div class=" form-group my-2">
                    <label for="event_category">Select Your Event Categories:</label>
                    <select class="form-control col-4" name="categories[]" class="d-none" id="event_category">
                        <option class="category-option" value="">Select Event Category</option>
                    </select>
                    <div class=" d-flex flex-row form-group my-2" id="select-categories">

                    </div>
                </div>
                <h5 class="text-center"> Event Location/s </h5>
                <div class="form-group my-2 event-locations">
                    <label for="location">Location</label>
                    <input type="text" class="form-control ev-loc-input" name="location" id="location" placeholder="Enter Event Location">
                </div>
                <button class="btn btn-dark d-none" id="insert_location_input"> add more locations </button>
            </div>
            <div id="phase-3" class="tab-pane fade">
                <h5 class="text-center"> Ticket Details </h5>
                <div class="d-flex flex-row justify-content-between">
                    <div class="form-group my-2 col-5">
                        <label for="ticket-expire">Ticket Expiry</label>
                        <input type="datetime-local" class="form-control" name="ticket-expiry" id="ticket-expire">
                    </div>
                    <div class="form-group my-2 col-5">
                        <label for="ticket_price">Ticket Price</label>
                        <input type="number" class="form-control" id="ticket_price" placeholder="Enter Ticket Price">
                    </div>
                </div>
            </div>
            <div id="phase-4" class="tab-pane fade">
                <div id="images-input-list">
                    <input hidden type="file" name="images[]" id="images" multiple>
                    <label for="images">
                        <i class="fa-solid fa-square-plus"></i>
                    </label>
                    <div class="selected-images-view"></div>
                </div>
                <button type="submit" name="addEvent" class="btn btn-primary col-4">Submit</button>
            </div>

        </div>
    </div>



    <script src="../../../js/jquery-3.7.1.min.js"></script>
    <script src="../../../js/bootstrap.bundle.js"></script>
    <script src="../../../../lib/encoding.js-master/encoding.js"></script>
    <script src="script.js"></script>
    <script>
        $.get('http://localhost/eventx_website/business_logic/api/categories.php',
            (categories) => {
                categories.forEach(category => {
                    $('#event_category').append(' <option value="' + category.name + '">' + category.name + '</option> ')
                });
                $('#event_category').removeClass('d-none')
            }
        )

        $('#event-insert-form').on('submit', function(ev) {
            $('#event_category').val(categories.toString())
        })

        // $(function() {
        //     $(".nav-tabs a").click(function(ev) {
        //         $('.nav-tabs li').each( (index,element)=>{
        //             element.classList.remove('active')
        //         } )
        //         ev.target.parentElement.classList.add('active')
        //     });
        // })

        function insertEvent() {
            try {
                let form_data = new FormData(document.getElementById('event-insert-form'));

                let json = {}

                form_data.forEach(function(val, key) {
                    json[key] = val
                })

                console.log(json)

                $.ajax({
                    type: "POST",
                    url: 'http://localhost/eventx_website/business_logic/api/events.php',
                    data: json,
                    success: function(data, status, jqXHr) {
                        console.log(status)
                        console.log(data)
                    },
                    error: function(jqxhr, status, error) {
                        console.log(error)
                    },
                    dataType: "json"
                });
            } catch (e) {
                console.log(e)
            }

            return false
        }
    </script>
</body>

</html>