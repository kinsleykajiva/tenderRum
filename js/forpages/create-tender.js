

$('input').iCheck({
	checkboxClass: 'icheckbox_flat-red',
	radioClass: 'iradio_flat-red'
});


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


function btnSaveTender () {
	alert();
}











































