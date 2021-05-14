<?php
include "connection.php";
?>

<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from zenix.dexignzone.com/xhtml/form-wizard.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 09 May 2021 04:59:48 GMT -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Zenix -  Crypto Admin Dashboard </title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
    <!-- Form step -->
    <link href="http://localhost/form/vendor/jquery-smartwizard/dist/css/smart_wizard.min.css" rel="stylesheet">
    <!-- Custom Stylesheet -->
	<link href="http://localhost/form/vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
    <link href="http://localhost/form/css/style.css" rel="stylesheet">

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
												<p></p>
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
											<label for="country">Country</label>
											<select onChange="change_country()" name="country" id="country_id" class="form-control default-select">
												<option selected>Choose...</option> 
												<?php
													$res = mysqli_query($c, "SELECT * FROM countries");
													while($row=mysqli_fetch_array($res)){
                                                    $countryId = $row['id'];
                                                    $countryName = $row['name'];
												?>
												<option value="<?= $countryId; ?>"><?= $countryName; ?></option>

													<?php } ?>
											</select>
										</div>

										<div class="form-group col-md-4">
											<label for="state">State</label>
											<div id="state">
												<select name="state" id="state_id" class="form-control default-select">
													<option selected>Choose...</option>
												</select>
											</div>
										</div>

										<div class="form-group col-md-4">
											<label for="city">City</label>
											<div id="city">
											<select name="city" id="city_id" class="form-control default-select">
												<option selected>Choose...</option>
											</select>
											</div>
										</div>

									</div>
									
									<div class="form-row">
										<div class="form-group col-md-12">
                                            <label for="bsc_address">BSC Address</label>
                                            <input type="text" name="bsc_address" id="bsc_address" class="form-control" placeholder="Enter your fullname">
                                        </div>
									</div>
                                   
                                        <button type="submit" class="btn btn-primary">Sign in</button>
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
	
	<script>
		function change_country(){
			var xmlhttp = new XMLHttpRequest();
			xmlhttp.open("GET", "ajax.php?country="+document.getElementById("country_id").value, false);
			xmlhttp.send(null);
			document.getElementById("state").innerHTML=xmlhttp.responseText;
		}

		function change_state(){
			var xmlhttp = new XMLHttpRequest();
			xmlhttp.open("GET", "ajax.php?state="+document.getElementById("state_id").value, false);
			xmlhttp.send(null);
			document.getElementById("city").innerHTML=xmlhttp.responseText;
		}
	</script>
	<script src="http://localhost/pf/vendor/global/global.min.js"></script>
	<script src="http://localhost/pf/vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>


    <script src="http://localhost/pf/vendor/jquery-steps/build/jquery.steps.min.js"></script>
    <script src="http://localhost/pf/vendor/jquery-validation/jquery.validate.min.js"></script>
    <script src="http://localhost/pf/js/validation.js"></script>
    <!-- Form validate init -->
    <script src="http://localhost/pf/js/plugins-init/jquery.validate-init.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>

   <!-- form Steps -->
	<script src="http://localhost/pf/vendor/jquery-smartwizard/dist/js/jquery.smartWizard.js"></script>
    <script src="http://localhost/pf/js/custom.min.js"></script>
	<script src="http://localhost/pf/js/deznav-init.js"></script>
    <script src="http://localhost/pf/js/demo.js"></script>
    <script src="http://localhost/pf/js/styleSwitcher.js"></script>
</body>


<!-- Mirrored from zenix.dexignzone.com/xhtml/form-wizard.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 09 May 2021 04:59:49 GMT -->
</html>