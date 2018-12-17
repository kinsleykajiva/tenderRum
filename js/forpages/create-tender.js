

$('input').iCheck({
	checkboxClass: 'icheckbox_flat-red',
	radioClass: 'iradio_flat-red' ,
	checkedClass: 'checked'
});

const ur_i = "";

let  editor = new Quill('#quillEditor', {
	modules: {
		toolbar: [
			[{ header: [1, 2, false] }],
			['bold', 'italic', 'underline']
		]
	},
	placeholder: 'Put in notes....',
	theme: 'snow'  // or 'bubble'
});


$("#btnSaveTender").click(()=>{
	btnSaveTender () ;
});

function btnSaveTender () {
	let tenderNumber = $("#tenderNumber").val().trim();
	let tendertitle = $("#tendertitle").val().trim();
	let tenderCategory = $("#tenderCategory").val();
	let isViewedAfterSaving = $("#isViewedAfterSaving").is(":checked");

	if(tenderNumber === ""){
		$("#tenderNumberReq").show("slow");
		error_perInput("#tenderNumber", "Reload Page !");
		return;
	}
	error_perInput("#tenderNumber", "");
	$("#tenderNumberReq").hide("slow");

	if(tendertitle === ""){
		$("#tendertitleReq").slideDown("slow");
		error_perInput("#tendertitle", "Title Required !");
		return;
	}
	error_perInput("#tendertitle", "");
	$("#tendertitleReq").hide("slow");

	if(tenderCategory === "null"){
		$("#tenderCategoryReq").show("slow");
		error_perInput("#tenderCategory", "Category Selection Required !");
		return;
	}
	error_perInput("#tenderCategory", "");
	$("#tenderCategoryReq").hide("slow");

	loadingOverlay(true , "Saving ...");
	$.post(ur_i , {
		data:1
	}).done(response =>{
		loadingOverlay(false , "Saving ...");
	}).fail((jqxhr, textStatus, error) =>{
		loadingOverlay(false , "Saving ...");
		BootstrapDialog.alert({
			title      : 'DB-Access failed ',
			message    : "Connection Error occurred !Please try again though .",
			type       : BootstrapDialog.TYPE_DANGER  ,
			closable   : true,
			draggable  : true,
			buttonLabel: 'Close'
		});
	});


	/*error_perInput("#tenderNumber", "Attorney selection required !");
	loadingOverlay(true , "Saving ...") ;*/
}









































