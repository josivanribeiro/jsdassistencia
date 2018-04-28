<!DOCTYPE html>
<html lang="en">

<?php include 'include/incHead.php';?>

<body>
    <!-- PRELOADER -->
    <div class="spn_hol">
        <div class="spinner">
            <div class="bounce1"></div>
            <div class="bounce2"></div>
            <div class="bounce3"></div>
        </div>
    </div>
 	<!-- END PRELOADER -->

 	<!--=========================
     START HEADER SECTION
 	============================== -->
    <section class="header parallax home-parallax page" id="HOME">
        <h2></h2>
        <div>            
            
			<?php include 'include/incMenu.php';?>

            <div class="container home-container">
                <div class="row">
                    <div class="col-md-8 col-sm-8" style="width:100%;">
                        <div class="home_text">
                            <h1>Oferecendo serviços de conserto e manutenção nas principais marcas de condicionadores de ar.</h1>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </section>

    <!-- END HEADER SECTION -->


	<!-- =========================
	     START ABOUT US SECTION
	============================== -->

    <section class="about page" id="ABOUT">
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div class="section_title">
                        <h2 id="section-about-title">Sobre</h2>
                    </div>                    
                    <div id="section-about-content" class="section_content">
                    	<p>
                    	   Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et 
                    	   dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    	   ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore
                    	   eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia
                    	   deserunt mollit anim id est laborum.
                    	</p>
                    </div>					                    
                </div>
            </div>
        </div>
        
    </section>
    <!-- End About Us -->
    
    <!-- =========================
	     START SERVICES SECTION
	============================== -->

    <section class="services page" id="SERVICES">
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div class="section_title">
                        <h2 id="section-services-title">Serviços</h2>
                    </div>
                    <div id="section-services-content" class="section_content">
                    	<p>
                    	   Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et 
                    	   dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    	   ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore
                    	   eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia
                    	   deserunt mollit anim id est laborum.
                    	</p>
                    </div>
                </div>
            </div>
        </div>
        
    </section>
    <!-- End Services -->
	
	<!-- =========================
	     START TESTIMONIAL SECTION
	============================== -->

    <section class="testimonial page" id="TESTIMONIAL">
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div class="section_title">
                    	<h2 id="section-testimonial-title">Depoimentos</h2>
                    </div>
                    <div id="section-testimonial-content" class="section_content">
                    	<p>
                    	   Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et 
                    	   dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    	   ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore
                    	   eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia
                    	   deserunt mollit anim id est laborum.
                    	</p>
                    </div>
                </div>
            </div>
        </div>        
    </section>
    <!-- End Testimonial -->
	         
	<!-- =========================
	     START BUDGET FORM AREA
	============================== -->
    <section class="budget page" id="BUDGET">
        <div class="section_overlay">
            <div class="container">
                <div class="col-md-10 col-md-offset-1 wow bounceIn">
                    <div class="section_title">
                        <h2>Orçamento</h2>
                    </div>
                </div>
            </div>

            <div id="budgetContainer" class="budget_form wow bounceIn">
                <div class="container">
                	<!-- message container -->
					<div id="budget-message-container" class="message-container" style="background-color:#f5f5f5;border-color:#f5f5f5;display:none;">
						<p id="budget-message-paragraph" class="error-message"></p>
					</div>
                	<!-- BUDGET FORM -->
                	<form id="budgetForm" name="budgetForm" enctype="multipart/form-data" action="classes/controller/FrontController.php" method="post" onSubmit="return isValidBudgetForm();">
						<input type="hidden" name="controller" id="controller" value="EmailController" />
						<input type="hidden" name="action" id="action" value="sendBudgetEmail" />
					    <div class="row">
                            <div class="col-md-4">
                                <input type="text" class="form-control" id="budgetName" name="budgetName" placeholder="Nome" maxlength="100">
                                <input type="email" class="form-control" id="budgetEmail" name="budgetEmail" placeholder="Email" maxlength="100">
                                <input type="text" class="form-control" id="budgetPhone" name="budgetPhone" placeholder="Telefone" maxlength="15">
                            </div>
                            <div class="col-md-8">
                            	<div class="fileUpload">
									<input type="button" class="btn btn-default submit-btn form_submit" id="btnBudgetFileUpload" name="btnBudgetFileUpload" value="Upload" style="width: 28%;" />
									<input id="budgetFileUploadReadOnly" name="budgetFileUploadReadOnly" disabled="disabled" class="form-control" placeholder="Selecione um arquivo doc, docx, ppt, pptx, xls, xlsx, pdf, png, jpg, jpeg ou gif." type="text" style="width:68%; float: right;">
									<input id="budgetFileUpload" name="budgetFileUpload" type="file" class="upload" />
								</div>
                                <select id="budgetService" name="budgetService" class="form-control">
								  <option value="">Serviço</option>
								  <option value="Instalação de Condicionadores de Ar">Instalação de Condicionadores de Ar</option>
								  <option value="Manutenção de Condicionadores de Ar">Manutenção de Condicionadores de Ar</option>
								  <option value="Infraestrutura (Pré-instalação)">Infraestrutura (Pré-instalação)</option>
								  <option value="Elétricos em Geral">Elétricos em Geral</option>
								</select>
                                <textarea class="form-control" id="budgetMessage" name="budgetMessage" rows="25" cols="10" placeholder="Mensagem"></textarea>
                                <button type="submit" id="btnBudgetSend" name="btnBudgetSend" class="submit-btn form_submit">ENVIAR</button>
                            </div>
                        </div>
                    </form>
                	<!-- END BUDGET FORM --> 
                </div>
            </div>
                        
        </div>
    </section>
    <!-- END BUDGET -->

	<!-- =========================
	     START CONTACT FORM AREA
	============================== -->
    <section class="contact page" id="CONTACT">
        <div class="section_overlay">
            <div class="container">
                <div class="col-md-10 col-md-offset-1 wow bounceIn">
                    <!-- Start Contact Section Title-->
                    <div class="section_title">
                        <h2>Contato</h2>                        
                    </div>
                </div>
            </div>

            <div class="contact_form wow bounceIn">
                <div class="container">                
                	<!-- message container -->
					<div id="contact-message-container" class="message-container" style="display: none;">
						<p id="contact-message-paragraph" class="error-message"></p>
					</div>                
	                <!-- CONTACT FORM -->    
	                    <!-- form id="contactForm" role="form" -->
	                    	<input type="hidden" name="contactController" id="contactController" value="EmailController" />
							<input type="hidden" name="contactAction" id="contactAction" value="sendContactEmail" />
	                        <div class="row">
	                            <div class="col-md-4">
	                                <input type="text" class="form-control" id="contactName" placeholder="Nome" maxlength="100">
	                                <input type="email" class="form-control" id="contactEmail" placeholder="Email" maxlength="100">
	                                <input type="text" class="form-control" id="contactSubject" placeholder="Assunto" maxlength="100">
	                            </div>
	                            <div class="col-md-8">
	                                <textarea class="form-control" id="contactMessage" rows="25" cols="10" placeholder="Mensagem"></textarea>
	                                <button id="btnContactSend" type="button" class="btn btn-default submit-btn form_submit">ENVIAR</button>
	                            </div>
	                        </div>
	                    <!--/form-->
	                <!-- END CONTACT FORM -->
                </div>
            </div>            
        </div>
    </section>
    <!-- END CONTACT -->

	<?php include 'include/incFooter.php';?>	

</body>

</html>