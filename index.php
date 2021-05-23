<?php
include "connection.php";

if(isset($_POST['countrySearch'])){
    $response = "<div class='list-group'><a class='list-group-item list-group-item-action disabled>No Data Found</a></div>";
    $q = $c->real_escape_string($_POST['country']);

    $sql = mysqli_query($c, "SELECT * FROM countries WHERE name LIKE '%$q%'");
    if($sql->num_rows > 0){
        $response = "<div class='list-group'>";

        while($data = $sql->fetch_array())
            $response .= "<a class='list-group-item list-group-item-action' id='country-list'>".$data['name']."</a>";

        $response .= "<div>";

    }
    exit($response);
}

if(isset($_POST['stateSearch'])){
    $response = "<div class='list-group'><a class='list-group-item list-group-item-action disabled>No Data Found</a></div>";
    $q = $c->real_escape_string($_POST['state']);

    $sql = mysqli_query($c, "SELECT * FROM states WHERE name LIKE '%$q%'");
    if($sql->num_rows > 0){
        $response = "<div class='list-group'>";

        while($data = $sql->fetch_array())
            $response .= "<a class='list-group-item list-group-item-action' id='state-list'>".$data['name']."</a>";

        $response .= "<div>";

    }
    exit($response);
}

if(isset($_POST['citySearch'])){
    $response = "<div class='list-group'><a class='list-group-item list-group-item-action disabled>No Data Found</a></div>";
    $q = $c->real_escape_string($_POST['city']);

    $sql = mysqli_query($c, "SELECT * FROM cities WHERE name LIKE '%$q%'");
    if($sql->num_rows > 0){
        $response = "<div class='list-group'>";

        while($data = $sql->fetch_array())
            $response .= "<a class='list-group-item list-group-item-action' id='city-list'>".$data['name']."</a>";

        $response .= "<div>";

    }
    exit($response);
}


?>

<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from zenix.dexignzone.com/xhtml/form-wizard.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 09 May 2021 04:59:48 GMT -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Form</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
    <!-- Form step -->
    <link href="./vendor/jquery-smartwizard/dist/css/smart_wizard.min.css" rel="stylesheet">
    <!-- Custom Stylesheet -->
	<link href="./vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
    <link href="./css/style.css" rel="stylesheet">

</head>

<body>
    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-boda">
			<div class="container">
                <div class="row page-titles my-auto">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            <h4>Page Title</h4>
                            <p class="mb-0">Fill your application</p>
                        </div>
                    </div>
                </div>
                <!-- row -->
                <div class="row">
                    <div class="col-xl-12 col-xxl-12">
                        <div class="card">

                            <div class="card-header">
                                <h4 class="card-title">Form</h4>
                            </div>

                            <div class="card-body">
								<div class="basic-form">

                                    <form method="POST" action="register_process.php" id="pf-form" enctype="multipart/form-data">

									<div class="form-row">
											<div class="form-group col-lg-4 mt-3">
                                            <label class="pt-0">File Type</label> <br>
                                            	<label class="radio-inline mr-3"><input type="radio" id="doc_type" name="doc_type" value="Passport"> Passport</label>
												<label class="radio-inline mr-3"><input type="radio" id="doc_type" name="doc_type" value="ID"> National ID</label>
												<div id="error-doctype"></div>
											</div>

											<div class="form-group col-lg-8">
												<label class="text-label">Your Passport/ID</label>
                                            	<div class="custom-file">
                                                <input type="file" name="doc_name" id="doc_name" class="custom-file-input">
												<label class="custom-file-label">Choose file</label>
                                            	</div>
                                        </div>
									</div>

									<div class="form-row">
										<div class="form-group col-lg-4 mt-3">
											<label class="pt-0">Gender</label> <br>
											<label class="radio-inline mr-3"><input type="radio" name="gender" value="male"> Mr.</label>
                                            <label class="radio-inline mr-1"><input type="radio" name="gender" value="female"> Mrs.</label>
                                            <div id="error-gender"></div>
										</div>

										<div class="form-group col-md-8">
                                            <label>Fullname</label>
                                            <input type="text" id="fullname" name="fullname" class="form-control" placeholder="Enter your fullname">
                                        </div>
									</div>

                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label>Email</label>
                                            <input type="email" name="email" class="form-control" placeholder="Enter your email address">
                                        </div>
                                    	<div class="form-group col-md-6">
                                            <label>Full Address</label>
                                            <input type="text" name="address" class="form-control" placeholder="Enter your full address">

                                        </div>
									</div>

                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label>Country</label>
                                            <input type="text" name="country" id="country" class="form-control" placeholder="Enter your country name">
                                            <div id="countryResponse"></div>
                                        </div>

                                        <div class="form-group col-md-4">
                                            <label>State</label>
                                            <input type="text" name="state" id="state" class="form-control" placeholder="Enter your state name">
                                            <div id="stateResponse"></div>
                                        </div>

                                        <div class="form-group col-md-4">
                                            <label>City</label>
                                            <input type="text" name="city" id="city" class="form-control" placeholder="Enter your city name">
                                            <div id="cityResponse"></div>
                                        </div>

									</div>

									<div class="form-row">
										<div class="form-group col-md-12">
                                            <label for="bsc_address">BSC Address</label>
                                            <input type="text" name="bsc_address" id="bsc_address" class="form-control" placeholder="Enter a BSC Address">
                                        </div>
									</div>

                                        <div id="cta">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--**********************************
            Content body end
        ***********************************-->


        <!--**********************************
           Support ticket button start
        ***********************************-->

        <!--**********************************
           Support ticket button end
        ***********************************-->


    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
	<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function (){
            $("#country").keyup(function(){
                var country = $("#country").val()

                if(country.length > 1){
                    $.ajax(
                        {
                            url: 'index.php',
                            method: 'POST',
                            data: {
                                countrySearch: 1,
                                country: country
                            },
                            success: function(data){
                                $("#countryResponse").html(data);
                            },
                            dataType: 'text'
                        }
                    );
                }
            });

            $("#state").keyup(function(){
                var state = $("#state").val()

                if(state.length > 2){
                    $.ajax(
                        {
                            url: 'index.php',
                            method: 'POST',
                            data: {
                                stateSearch: 1,
                                state: state
                            },
                            success: function(data){
                                $("#stateResponse").html(data);
                            },
                            dataType: 'text'
                        }
                    );
                }
            });

            $("#city").keyup(function(){
                var city = $("#city").val()

                if(city.length > 4){
                    $.ajax(
                        {
                            url: 'index.php',
                            method: 'POST',
                            data: {
                                citySearch: 1,
                                city: city
                            },
                            success: function(data){
                                $("#cityResponse").html(data);
                            },
                            dataType: 'text'
                        }
                    );
                }
            });

            $(document).on('click', '#country-list', async function(){
                var c = $(this).text();
                var banned = await fetch('banned.json');
                banned = await banned.json();

                var contactBtn = document.createElement('a');
                var cta = document.getElementById('cta');
                var submitBtn = cta.querySelector('button[type=submit]');

                // button modifier
                contactBtn.className = 'btn btn-primary';
                contactBtn.href = 'https://t.me/Gana_11';
                contactBtn.id = 'contact-btn';
                contactBtn.innerHTML = 'Chat Me';

                if (banned.countries.includes(c)) {
                    !cta.contains(cta.querySelector('#contact-btn')) && cta.prepend(contactBtn);
                    !submitBtn.hasAttribute('disabled') && submitBtn.setAttribute('disabled', true);
                } else {
                    cta.contains(cta.querySelector('#contact-btn')) && cta.removeChild(cta.querySelector('#contact-btn'));
                    submitBtn.hasAttribute('disabled') && submitBtn.removeAttribute('disabled');
                }

                $("#country").val(c);
                $("#countryResponse").html("");
            });

            $(document).on('click', '#state-list', function(){
                var c = $(this).text();
                $("#state").val(c);
                $("#stateResponse").html("");
            });

            $(document).on('click', '#city-list', function(){
                var c = $(this).text();
                $("#city").val(c);
                $("#cityResponse").html("");
            });
        });
    </script>
	<script src="./vendor/global/global.min.js"></script>
	<script src="./vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
    <script src="./vendor/jquery-validation/jquery.validate.min.js"></script>
    <script src="./js/validation.js"></script>
	<script src="./js/my.js"></script>
    <!-- Form validate init -->
    <script src="./js/plugins-init/jquery.validate-init.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
    <script src="./js/custom.min.js"></script>
	<script src="./js/deznav-init.js"></script>
</body>


<!-- Mirrored from zenix.dexignzone.com/xhtml/form-wizard.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 09 May 2021 04:59:49 GMT -->
</html>
