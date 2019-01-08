function editOption(){
	let id = (arguments[0])
	iddLast= id ;
	iddLast = iddLast.split('_')[0] ;
	let row_id = $("#" + (arguments[0]) );
	   let  first= row_id.find("td:nth-child(1)"); // Finds the 2nd <td> element
	   let  sec= row_id.find("td:nth-child(2)"); // Finds the 2nd <td> element
	  // let  third= row_id.find("td:nth-child(3)"); // Finds the 2nd <td> element
	  // let  fourth= row_id.find("td:nth-child(4)"); // Finds the 2nd <td> element
	  /* console.log(first)
	   console.log()*/
	    viewAdd();
	  $("#brandName").val(first.text());
	  // $("#brandTag").val();
	   $("#brandDescription").val(sec.text());
	  
	   $("#editAddTitle").text("Edit Brand");
	   $("#editid").text(id.split('_')[0]);
	    $("#btnUpdateSave").text('Update');

}
let iddLast  ;
function updateBrandData() {
let brandName = $("#brandName").val();
  let brandTag = $("#brandTag").val();
  let  brandDescription = $("#brandDescription").val();
  let id = iddLast;

	$.post("app/ajax_slave/brands_slave.php",{
		update:id ,
  		ubrandName:brandName , 
  		ubrandTag:brandTag+"" , 
  		ubrandDescription:brandDescription

  	}).done(response =>{
  		loadingOverlay(false , "Saving ...");
  		if(response == "done"){
  			showSuccessMessage("Update Brand" , 5);
  			 backView();
  			
  		}else{
  			showErrorMessage(" Failed to save , try again !" , 4);
  		}
  	}).fail((xhr , status , error) =>{
  		loadingOverlay(false , "Saving ...");
  		showErrorMessage("Connection Failed !" , 4);
  	});

}







function viewAdd(){
	$("#editid").text('');
	$("#divAddBrand").slideDown("slow");
	$("#backBtn").slideDown("slow");
	$("#addBtn").slideUp("slow");
	$("#divViewData").slideUp("slow");
	$("#editAddTitle").text("Add Brand");
	 $("#brandName").val('');
  		 $("#brandTag").val('null');
  		 $("#brandDescription").val('');
  		 $("#btnUpdateSave").text('Save');

}

function backView(){
$("#divAddBrand").slideUp("slow");
$("#addBtn").slideDown("slow");
$("#backBtn").slideUp("slow");
	$("#divViewData").slideDown("slow");
}


function saveBrand(){
  let brandName = $("#brandName").val();
  let brandTag = $("#brandTag").val();
  let  brandDescription = $("#brandDescription").val();

  if(brandName === ''){
  	$("#brandNameRequired").slideDown('slow');
  	return;
  } $("#brandNameRequired").slideUp('slow');
  if( brandTag == 'null'){
  	$("#brandTagRequired").slideDown('slow');
  	return;
  } $("#brandTagRequired").slideUp('slow');

  loadingOverlay(true , "Saving ...");

  if($("#editid").text() != ''){
  	// update
  	 updateBrandData() ;

  } else{


  	$.post("app/ajax_slave/brands_slave.php",{
  		brandName:brandName , 
  		brandTag:brandTag+"" , 
  		brandDescription:brandDescription

  	}).done(response =>{
  		loadingOverlay(false , "Saving ...");
  		if(response == "done"){
  			showSuccessMessage("Saved" , 5);
  			$("#brandName").val('');
  			$("#brandTag").val('null');
  			$("#brandDescription").val('');
  		}else{
  			showErrorMessage(" Failed to save , try again !" , 4);
  		}
  	}).fail((xhr , status , error) =>{
  		loadingOverlay(false , "Saving ...");
  		showErrorMessage("Connection Failed !" , 4);
  	});
}
  
}
