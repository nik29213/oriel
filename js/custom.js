
$(document).ready(function(){	

				$(window).scroll(function(){
					if ($(this).scrollTop()> 100) {
						
						$('.scrollToTop').show();
					} 
					
					else {
						$('.scrollToTop').hide();
					}
				});

				//Click event to scroll to top
				$('.scrollToTop').click(function(){
					$('html, body').animate({scrollTop : 0},800);
					return false;
				});

	$(".fold-next").click( function(){
		var id = $(this).attr("value");
		$(".hid").addClass("disp-none");
		$( 'div[nextid="'+id+'"]' ).removeClass("disp-none");
	});
	
	$(".back").click( function(){
		var id = $(this).attr("prev");
		//alert(id);
		$(".hid").addClass("disp-none");
		$( 'div[nextid="'+id+'"]' ).removeClass("disp-none");
		$.post(
				"/logsign/btnback.php",
				{floc:id}
					).done(function(data){
						//alert(data);
					if(data=="success"){						
					//alert("done");
					return;
					}
					
				}).error(function(data,msg){
				alert("server error");						
			});
	});
	$("#img-bk").click( function(){
		alert("vvh");
	});
	
	$("#files").change(function(){	
		$( ".upcontainer").removeClass("disp-none");
		var k = $(this).get(0).files.length ;
		var floc=$(this).attr("floc");
		//alert(floc);
		var t=0;
		for (i = 0; i < k; i++) {
			var n = i+1;
			var j=$(this).get(0).files[i].name;
			var s=$(this).get(0).files[i].size;
			s1=s/1024;
			s1 = s1.toFixed(2);
			t += s;
			var ext=j.slice(-4);
			//alert(ext);
			
			$('#uploadshow').append('<tr class="child" data-loc="">\
					<td>'+j+'</td>\
					<td>'+s1+'</td>\
					<td>'+ "<label><input type='radio' name='"+n+"' value='no' class='cmprsn1' checked />upload</label><br/>"+(( ext =='.jpg' || ext =='jpeg'||ext =='.png' )?"\
					<label><input type='radio' name='"+n+"' value='yes' class='cmprsn2' />upload after compression</label>&nbsp":"")+"<select class='form-control disp-none' name='cmprsn_val"+n+"' cmprsn_no='"+n+"'>\
											<option selected='true' disabled>select the compression percentage</option>\
											<option value='25'>25</option>\
											<option value='50'>50</option>\
											<option value='75'>75</option>\
											<option value='90'>90</option>\
											<option value='95'>95</option></select>"+'</td>\
					</tr>');
		}
		//$("body").append("<input type='radio' id='hidden-inputbox' class='com' />fhgvh");
		return;
	});
	$(".com").change( function(){
		alert("hgfvhg");
	});

	$("#file-up-sub").change( function(){
		$("#upload_file_submit").submit();
	});
	
	$(".select_folder").change( function(){
		var flink = $(this).attr("select_link");
		var val = $(this).val().trim();
		if(val=="download"){
			alert("working on it");
		}
		if(val=="rename"){
					var fname = $(this).attr("floc");
					$("div.modal button#btn_ren_folder").attr("url",fname);
					$("div#renModal").modal("show");
					//alert(fname);
		}
		if(val=="create_link"){
			alert("working on it");
		}
		if(val=="fdelete"){
			$.post(
				"/folders/delete_folder.php",
				{folder_loc:flink}
					).done(function(data){
					if(data=="absent"){						
					alert("folder not found");
					return;
					}
					else
					alert("folder deleted");
					location.reload();
				}).error(function(data,msg){
				alert("server error");						
			});
		}
		if(val=="clear"){
			//alert("Clearing folder ....");
			$.post(
				"/folders/clear_folder.php",
				{folder_loc:flink}
					).done(function(data){
					//alert(data);
					if(data=="absent"){						
					alert("folder not found");
					return;
					}
					else
					alert("folder cleared");
					location.reload();
				}).error(function(data,msg){
				alert("server error");						
			});
		}
	});
	$(".select_file").change( function(){
		var flink = $(this).attr("select_link");
		var val = $(this).val().trim();
		//alert(flink);
		if(val=="download"){
			//alert("working on it");
			var a = $("<a/>");
			var fnm = "/"+flink;		
			var parts = fnm.split("/");
			var fnm = parts[parts.length-1];
			$(".select_file").val(null);
			var a = $("<a/>");
			$(a).attr({
				"href" : "files/viewonline.php?flink="+encodeURI(flink),
				"target" : "_blank",
				"download" : fnm
			});
			$(a)[0].click();
			//window.open( "files/viewonline.php?flink="+encodeURI(flink), "_blank" ) ;
			
		}
		if(val=="rename"){
					var fname = $(this).attr("floc");
					$("div.modal button#btn_ren_file").attr("url",fname);
					$("div#renfileModal").modal("show");
					//alert(fname);
		}
		if(val=="create_link"){
				$.post(
				"/files/createlink.php",
				{folder_loc:flink}
					).done(function(data){
					if(data=="present"){						
					alert("link for this file is already created");
					return;
					}
					else
					alert("link created");
					//alert(data);
					location.reload();
				}).error(function(data,msg){
				alert("server error");						
			});
		}
		if(val=="fdelete"){
			$.post(
				"/files/delete_files.php",
				{folder_loc:flink}
					).done(function(data){
					if(data=="absent"){						
					alert("file not found");
					return;
					}
					else
					alert("file deleted");
					location.reload();
				}).error(function(data,msg){
				alert("server error");						
			});
		}
		if(val=="viewon"){
					$type=$(this).attr("type");
			var a = $("<a/>");
			var fnm = "/"+flink;		
			var parts = fnm.split("/");
			var fnm = parts[parts.length-1];
			$(".select_file").val(null);
			window.open( "files/viewonline.php?flink="+encodeURI(flink), "_blank" ) ;
			
		
		}
	});
	$(".folders").click( function(){
		var id = $(this).attr("value");
		//$(id).show();
		//alert(id);
		//$(id).removeClass("disp-none");
		$(".hid").addClass("disp-none");
		$( 'div[nextid="'+id+'"]' ).removeClass("disp-none");
	});
	
	$(".root_menu").click(function(){	
		var id = $(this).attr("root_menu_value");
 		$(".root_menu").removeClass("bg-blk");
		$(".root_menu").addClass("bg-blu-lt");
		$(this).addClass("bg-blk");
		$(".hid").addClass("disp-none");
		$( 'div[nextid="'+id+'"]' ).removeClass("disp-none");
		
	});

	$("#btn-login").click( function(){
		var id = $("#uid").val().trim();
		var ps = $("#pwd").val().trim();
		
		if ( id.length == 0){
			$("#uid").focus();
			err("Enter your email	");
			$("#btn-login").button("reset");
			return;	
		}
		if ( ps.length == 0){
			$("#pwd").focus();
			err("Enter your password	");
			$("#btn-login").button("reset");
			return;
		}
		$.post(
			"/logsign/log.php",
			{uid:id,password:ps}
		).done(function(data){
			//alert(data);
			if(data=="success"){
				window.location="home.php";
				return;
			}else if(data=="fail"){
				//$("#btn-login").button("reset");
				$("#uid").focus();
				err("Invalid User Id or Password");
				$("#pwd").val('');	
			}else if(data=="deactive"){
				//$("#btn-login").button("reset");
				$("#uid").focus();
				err("your account is deleted.Signup for new account");
				$("#pwd").val('');	
			}else{
				err("Server failure");
				$("#btn-login").button("reset");
			}	
		}).error(function(data,msg){
			err("Server failure");
			$("#btn-login").button("reset");
		});
	});
	//------------------------signup form--------------------
	$("#btn_sign").click(function(){
		var slink = $(this).attr("slink");
		var name=$("#unm").val() || false;
		var email=$("#email").val() || false;
		var passwrd=$("#pass").val() || false;
		var cnf=$("#cnfrm_pass").val() || false;
		var country=$("#country").val() || false;
		var mobile=$("#mobile").val() || false;
		if(!name){
		//if(name.length==0)
			errs("enter username");
			return;
		}
		if(!email){
		//if(email.length== 0){
			errs("enter email id for next step");
			return;
		}	
		if(!passwrd){
		//if(passwrd.length== 0){
			errs("enter password");
			return;
		}
		
		if(passwrd.length<8){
			errs("password should be atleast 8 characters long");
			return;
		}
		if(!cnf){
		//if(cnf.length== 0){
			errs("confirm ur password");
			return;
		}
		if(cnf !== passwrd){
			errs("confirm password should be similar to password entered");
			return;
		}
		if(!country){
		//if(country.length== 0){
			errs("please enter your address");
			return;
		}
		if(!mobile){
		//if(mobile.length== 0){
			errs("enter your mobile number");
			return;
		}
		if(mobile.length< 10){
			errs("mobile number should be 10 digit");
			return;
		}
		if(!isNum(mobile)){
			errs("mobile number should be numeric");
			return;
		}
		$.post(
				"/logsign/unmsearch.php",
				{
				email:email,
				name:name
				}).done(function( data ){
					if(data=="success"){
						//----------------on success that unm is not there
							$.post(
									"/logsign/signup_script.php",
									{uid:name,email:email,password:passwrd,country:country,mob:mobile,slink:slink}
										).done(function(data){
										//alert(data);
										if(data.startsWith("success")){
											var otp = data.split("-")[1];
											//----------------
											/*	$.post(
													"http://oriel.heliohost.org/sendotp.php",
													{
														email:email,
														otp:otp
													}).done(function(data){
														alert(data);
                                                        errs("redirecting you to otp verification page");
														//if(data=="success"){
                                                         if(data.endsWith("success")){   
															alert("signup completed");
															window.location="/logsign/otp.php";
															return;
														}
													}).error(function(data,msg){
														errs(" otp Server failure<br />".data);
													});*/
											alert("signup completed");
											
											var a1 = $("<a/>");
											$(a1).attr({
												"href" : "/logsign/otptrue.php"
											});
											$(a1)[0].click();
											//window.location="/logsign/otptrue.php";
											return;
										}	
									}).error(function(data,msg){
								errs("Server failure");
													
								});	
						
					}
					else if(data=="unm_error"){
						errs("This username is already taken.Enter another username");
						//$("#unm").focus();
						return;
					}
					else if(data=="email_error"){
						errs("The entered email id is already registered with oriel.Enter another email id");
						//$("#email").focus();
						return;
					}
					else{
						alert("error in unm email check"+data);
						return;
					}
					
			});
			
	});
	$("#verify").click(function(){
		var otp = $(this).attr("send_otp");
		var enter_otp = $("#otpp").val().trim();
		if(otp==enter_otp){
			window.location="/logsign/otptrue.php";
		}
		else
			//write something like wrng otp
			return;

	});
});
function err(msg){
	$("#err").text(msg);
}
function errs(msg){
	$("#error_msg").text(msg);
}
function isNum(num) {
	return ((num%1)==0);
}	
$(document).on("change", ".cmprsn2", function(){
		var n = $(this).attr("name");
		//alert("n");
		$('select[cmprsn_no="'+n+'"]').removeClass("disp-none");
		$('select[name="'+n+'"]').removeClass("disp-none");
});
$(document).on("change", ".cmprsn1", function(){
		var n = $(this).attr("name");
		$('select[cmprsn_no="'+n+'"]' ).addClass("disp-none");
		$('select[name="'+n+'"]' ).addClass("disp-none");
});
