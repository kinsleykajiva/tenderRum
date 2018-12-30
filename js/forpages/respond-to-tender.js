let  editor = new Quill('#quillEditor', {
	modules: {
		toolbar: [
			[{ header: [1, 2, false] }],
			['bold', 'italic', 'underline']
		]
	},
	placeholder: 'description ....',
	theme: 'snow'  // or 'bubble'
});
const user_id = $("#loggedUserId").text();
// 

// Numeric values only allowed (With Decimal Point)
$("#tenderprice , #warrantee_period").on("keypress keyup blur",event=> {
	//this.value = this.value.replace(/[^0-9\.]/g,'');
	//
	/*$(this).val($(this).val().replace(/[^0-9\.]/g,''));
	if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
		event.preventDefault();
	}*/
});


const  ur_i = "app/ajax_slave/submit_proposal_slave.php";

// Numeric values only allowed (Without Decimal Point)
$("#tendertimespan").on("keypress keyup blur", event=> {
	/*$(this).val($(this).val().replace(/[^\d].+/, ""));
	if ((event.which < 48 || event.which > 57)) {
		event.preventDefault();
	}*/
});



$("#btnSaveTender").click(()=>{
	let tendertimespan = $("#tendertimespan").val().trim();
	let warrantee_period = $("#warrantee_period").val().trim();
	let  tenderprice= $("#tenderprice").val().trim();
	let  supplierBrand= $("#supplierBrand").val();
	let  in_tender_id= $("#in_tender_id").text();
	let editor2 = editor.container.firstChild.innerHTML ;

	if(tenderprice === ""){
		$("#tenderpriceReq").slideDown("slow");
		error_perInput("#tenderprice", "Price Required !");
		return;
	}
	error_perInput("#tenderprice", "");
	$("#tenderpriceReq").slideUp("slow");

	if(tendertimespan === ""){
		$("#tendertimespanReq").slideDown("slow");
		error_perInput("#tendertimespan", "Title Required !");
		return;
	}
	$("#tendertimespanReq").slideUp("slow");
	error_perInput("#tendertimespan", "");
	if(warrantee_period === ""){
		$("#warrantee_periodReq").slideDown("slow");
		error_perInput("#warrantee_period", "warrantee_period Required !");
		return;
	}
	$("#warrantee_periodReq").slideUp("slow");
	error_perInput("#warrantee_period", "");
	let inputs = $("#compSelection").find(":checked");
	let compJsonSelect = [];

	if(supplierBrand === 'known_brands'){

		inputs.each((i, obj)=> {
			compJsonSelect.push($(obj).attr("data-id"));
		});
		
		if(compJsonSelect.length == 0 ){
			
			error_perInput("#brandsHeader", "Please Make a Brand Selection ");
			showErrorMessage("Please Make a Brand Selection ", 4 );
			return;
		}
		error_perInput("#brandsHeader", "");
	}
	
	loadingOverlay(true , "Saving ...");
	$.post(ur_i , {
		data_tender_red : 1 ,
		tendertimespan : tendertimespan ,
		warrantee_period : warrantee_period ,
		tenderprice : tenderprice ,
		description : editor2 ,
		compJsonSelect:compJsonSelect.length ? compJsonSelect+'' : '' , 
		in_tender_id : in_tender_id ,
		ux: user_id
	}).done(response =>{
		loadingOverlay(false , "Saving ...");
		if(response == 'saved'){
			showSuccessMessage("Saved" , 5);
			$("#tendertimespan").val('');
			$("#warrantee_period").val('');
			$("#tenderprice").val('');
			editor.setText("");
		}else {
			showErrorMessage(" Failed to save , try again !" , 4);

		}
	}).fail((jqxhr, textStatus, error) =>{
		loadingOverlay(false , "Saving ...");
		showErrorMessage("Connection Failed !" , 4);
		BootstrapDialog.alert({
			title      : 'DB-Access failed ',
			message    : "Connection Error occurred !Please try again though .",
			type       : BootstrapDialog.TYPE_DANGER  ,
			closable   : true,
			draggable  : true,
			buttonLabel: 'Close'
		});
	});
});




function showBrandsDiv(){
	let divBrands = $("#divBrands");
	let supplierBrand = $("#supplierBrand").val();

	if( supplierBrand !== 'null' && supplierBrand === "known_brands"){
		divBrands.slideDown('slow');
	}else{
		divBrands.slideUp("slow");
	}
}































