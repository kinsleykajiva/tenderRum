




function getAllTenders(){
	
	$("#loadingConner").slideDown("fast");
	$.getJSON('app/ajax_slave/tenders_data.php', {
		getData: 'value1'
	}). done(json => {
		let view_tenders_div = $("#view_tenders_div");
		view_tenders_div.html(rowView(json));
		$("#loadingConner").slideUp("fast");
			//console.log((json))
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
	});;
}


function rowView(jsonData){

	let tr = "";

	jsonData.forEach( (element, index) => {
		let descript_id_div = element.id+'_desc';
		tr += `
		 <tr>
                                                 <td>
                                                    <label class='au-checkbox'>
                                                        <input type='checkbox'>
                                                        <span class='au-checkmark'></span>
                                                    </label>
                                                </td>
                                                <td>${element.tender_number}</td>
                                                <td>${element.title}</td>
                                                <td>${element.date_created}</td>
                                                 <td>${element.created_by}</td>
                                                <td>${element.created_by}</td>
                                                 <td>
                                                    <div class='table-data-feature'>
                                                        <button onclick='respondToTender("${element.id}")' class='item' data-toggle='tooltip' data-placement='top' title='Respond'>
                                                            <i class='zmdi zmdi-mail-send'></i>
                                                        </button>
                                                        <button class='item' data-toggle='tooltip' data-placement='top' title='Edit'>
                                                            <i class='zmdi zmdi-edit'></i>
                                                        </button>
                                                        <button class='item' data-toggle='tooltip' onclick='viewDescription("${descript_id_div}")' data-placement='top' title='View'>
                                                            <i class='zmdi zmdi-plus'></i>
                                                        </button>
                                                         <button class='item' data-toggle='tooltip' data-placement='top' title='Delete'>
                                                            <i class='zmdi zmdi-delete'></i>
                                                        </button>
                                                       
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr  style='display:none;' class='${descript_id_div}'>
                                                <td colspan='7'>
                                                    <hr/>
                                                </td>
                                            </tr>
                                            <tr style='display:none;'  class='${descript_id_div}'>
                                                <td colspan='7'>
                                                    <div>
                                                        ${element.description}
                                                    </div>
                                                </td>
                                                
                                            </tr>
                                            <tr  style='display:none;' class='${descript_id_div}' >
                                                <td colspan='7'>
                                                    <hr/>
                                                </td>
                                            </tr>
		`;
	});
	return tr;
}



function viewDescription(id_){
	$("."+id_).toggle("slow");
	
}

function respondToTender(id_){
	location.href = "respond-to-tender.php?artile=" + id_ ;
}










































