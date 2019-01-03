

$('input').iCheck({
	checkboxClass: 'icheckbox_flat-red',
	radioClass: 'iradio_flat-red' ,
	checkedClass: 'checked'
});

const ur_i = "app/ajax_slave/create_tender_slave.php";

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
	let due_date = $("#due_date").val().trim();
	let isViewedAfterSaving = $("#isViewedAfterSaving").is(":checked");
	let editor2 = editor.container.firstChild.innerHTML ;
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

	if(due_date === ""){
		$("#tenderDueDateReq").show("slow");
		error_perInput("#due_date", "Due Date Required !");
		return;
	}
	error_perInput("#tenderDueDateReq", "");
	$("#tenderDueDateReq").hide("slow");


	let inputCartegories= $("#inputCartegories");
	let inputs = inputCartegories.find("input");
	let selects = inputCartegories.find("select");
	let compJson = [];
	let compJsonSelect = [];
	inputs.each((i, obj)=> {
		compJson.push($(obj).attr("data-id"));
	});
	selects.each((i, obj)=> {
		compJsonSelect.push(obj.value);
	});

	loadingOverlay(true , "Saving ...");
	$.post(ur_i , {
		data_tender_c : 1 ,
		tenderNumber : tenderNumber ,
		tendertitle : tendertitle ,
		tenderCategory : tenderCategory ,
		editor2 : editor2 ,
		compJson : compJson + '' ,
		compJsonSelect : compJsonSelect + '',
		ux:1 , 
		due_date :due_date
	}).done(response =>{
		loadingOverlay(false , "Saving ...");
		if(response == 'done'){
			showSuccessMessage("Saved" , 5);
			/*$("#tenderCategory").val('null');
			$("#tenderNumber").val('');
			$("#tendertitle").val('');*/
			location.reload();
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


	/*error_perInput("#tenderNumber", "Attorney selection required !");
	loadingOverlay(true , "Saving ...") ;*/
}
function showBrands () {
	let tenderCategory = $("#tenderCategory").val();
	let cardBrands = $("#cardBrands");
	if(tenderCategory !== 'null'){
		cardBrands.slideDown('slow');
	}else{
		cardBrands.slideUp('slow');
	}


}








































