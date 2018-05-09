<?php 
	include("../includes/header.php");


	$subjects = sanitizeFile(removeDots('../material/diploma'));

?>
	
	<!-- Home -->

	<div class="home">
		<div class="home_background_container prlx_parent">
			<div class="home_background prlx" style="
				background-image: 
				-webkit-linear-gradient(105deg,rgba(0, 0, 0,.5) 0%, rgba(189, 195, 199,.8) 50%, transparent 50%), url(../images/pageHeader/diploma.jpg);
				background-image:
				linear-gradient(105deg,rgba(0, 0, 0,.5) 0%, rgba(189, 195, 199, .8) 50%, transparent 50%), url(../images/pageHeader/diploma.jpg);
				background-image: 
			    -o-linear-gradient(105deg,rgba(0, 0, 0,.5) 0%, rgba(189, 195, 199, .8) 50%, transparent 50%), url(../images/pageHeader/diploma.jpg);
			    background-image: 
			    -ms-linear-gradient(105deg,rgba(0, 0, 0,.5) 0%, rgba(189, 195, 199, .8) 50%, transparent 50%), url(../images/pageHeader/diploma.jpg);
			    background-position: center top;">
			</div>
		</div>
		<div class="home_content">
			<h1>Дипломное проектирование</h1>
		</div>
	</div>

	<!-- Popular -->
	<div class="popular page_section">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="section_title text-center">
						<h1>Учебно-методические материалы</h1>
					</div>
				</div>
			</div>

			<div class="row course_boxes">
				
				<?php

				for ($i = 0; $i < count($subjects); $i++) {
					echo 
					"<div class='col-lg-4 col-md-6 col-sm-12 course_box'>
						<div class='card'>
							<div class='my-2 mx-auto p-relative bg-white shadow-1 blue-hover' style='width: 100%; overflow: hidden; border-radius: 1px;'>
								<div class='px-2 py-2'>
								    <h1 class='ff-serif font-weight-normal text-black card-heading mt-0 mb-1' style='line-height: 1.25;'>
								    	<div class='headercustum' id='headercustum'>"
								  		. $diplomas[$i] .								    
										"</div>
								    </h1>
									<div class='card-body' style='text-align: center;'>
									    <h4 class='card-title'>Учебно-методические материалы</h4>
									    <a href='download.php?fileName=".$subjects[$i]."&id=2' class='btn btn-primary'>Скачать пакет</a>
									</div>
								</div>
							</div>
						</div>
					</div>";
				}
				?>
			</div>
		</div>		
	</div>

	
<?php 
	include("../includes/footer.php");
?>
	