




function getAllTenders(){
	
	$("#loadingConner").slideDown("fast");
	$.getJSON('app/ajax_slave/tenders_data.php', {
		getData: 'value1'
	}). done(json => {
		let view_tenders_div = $("#view_tenders_div");
       
        if(json.length){
            view_tenders_div.html(rowView(json));          
        }
         $("#loadingConner").slideUp("fast");        
			
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
                                                 <td>${element.due_date}</td>
                                                <td>${element.username.toUpperCase()}</td>
                                                 <td>
                                                     <div class='btn-group'>
                                                  <button type='button' class='btn btn-default dropdown-toggle' data-toggle='dropdown'>
                                                     <i class='fa fa-newspaper-o fa-lg text-success '></i>  Action 
                                                                                                          <span class='caret'></span>
                                                 </button>
                                                 <ul class='dropdown-menu' role='menu'>
                                                    <li onclick='respondToTender("${element.id}")' class='dropdown-item'><a href='#'>Respond</a></li>
                                                    <li onclick='goToResponse("${element.id}")' class='dropdown-item'><a href='#'>View Responses</a></li>
                                                    <li  onclick='viewDescription("${descript_id_div}")' class='dropdown-item'><a href='#'>View </a></li>

                                                </ul>
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

function goToResponse(id_){
    location.href = "view-tenders-response.php?tender=" + id_ ;
}







































