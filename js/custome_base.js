/**
 * Global functions used in several pages
 * Do not just delete this page and its functions
 * */
const notificationsShowwTime = 7500;
const loggedUserID = $("#LoogedUserID").text();
/*********************************************************************************************/
function exit( status ) {
	// http://kevin.vanzonneveld.net
	// +   original by: Brett Zamir (http://brettz9.blogspot.com)
	// +      input by: Paul
	// +   bugfixed by: Hyam Singer (http://www.impact-computing.com/)
	// +   improved by: Philip Peterson
	// +   bugfixed by: Brett Zamir (http://brettz9.blogspot.com)
	// %        note 1: Should be considered expirimental. Please comment on this function.
	// *     example 1: exit();
	// *     returns 1: null

	let i;

	if (typeof status === 'string') {
		alert(status);
	}

	window.addEventListener('error', function (e) {e.preventDefault();e.stopPropagation();}, false);

	let handlers = [
		'copy', 'cut', 'paste',
		'beforeunload', 'blur', 'change', 'click', 'contextmenu', 'dblclick', 'focus', 'keydown', 'keypress', 'keyup', 'mousedown', 'mousemove', 'mouseout', 'mouseover', 'mouseup', 'resize', 'scroll',
		'DOMNodeInserted', 'DOMNodeRemoved', 'DOMNodeRemovedFromDocument', 'DOMNodeInsertedIntoDocument', 'DOMAttrModified',
            'DOMCharacterDataModified', 'DOMElementNameChanged', 'DOMAttributeNameChanged', 'DOMActivate', 'DOMFocusIn', 'DOMFocusOut', 'online', 'offline', 'textInput',
		'abort', 'close', 'dragdrop', 'load', 'paint', 'reset', 'select', 'submit', 'unload'
	];

	function stopPropagation (e) {
		e.stopPropagation();
		// e.preventDefault(); // Stop for the form controls, etc., too?
	}
	for (i=0; i < handlers.length; i++) {
		window.addEventListener(handlers[i], function (e) {
		    stopPropagation(e);
		    }, true);
	}

	if (window.stop) {
		window.stop();
	}

	throw '';
}
/*********************************************************************************************/
function error_perInput(inputElement, errorMessage) {
    if (errorMessage === '') {
        $(inputElement).css("color", "black");
        $(inputElement).text("");
    } else {
        $(inputElement).text(errorMessage);
        $(inputElement).css("color", "red");
        showErrorMessage(errorMessage, 5.5);
    }
}
/*********************************************************************************************/
function error_input_element(isTrue , elementId) {
    if(isTrue){
        $('#'+elementId).css({
            "border": "1px solid red",
            "background": "#ff4e44"
        });

    }else{
        $('#'+elementId).css({
            "border": "",
            "background": ""
        });
    }

}
/*********************************************************************************************/
function logInAccessError(responseFromServer ){
    if(responseFromServer === 'unf_1'){        
        window.location.href = "sign-in.php?lerror=err_login";
    }
}
/*********************************************************************************************/
function getcurrentDate() {
    let today = new Date();
    let dd = today.getDate();
    let mm = today.getMonth() + 1; //January is 0!
    let yyyy = today.getFullYear();
    if (dd < 10) {
        dd = '0' + dd
    }
    if (mm < 10) {
        mm = '0' + mm
    }
    return mm + '/' + dd + '/' + yyyy;
}
/*********************************************************************************************/
function isEmail(email) {
    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email);
}
/*********************************************************************************************/
function loadingOverlay ( isToShowBool , message ) {
	if ( isToShowBool ) {
		$.LoadingOverlay ( 'show' , {
			background : 'rgba(165, 190, 100, 0.5)' ,
			textAutoResize : true ,
			text : message === '' ? 'Loading ... ' : message
		} );
	}
	else {
		$.LoadingOverlay ( 'hide' );
	}

}
/*********************************************************************************************/
function showGeneralMessage(message, time) {
    $.toast({
        heading: '',
        text: message == '' ? "Hi." : message,
        hideAfter: time == 0 ? notificationsShowwTime : time * 1000,
        position: 'mid-center',
        stack: false
    });
}
/*********************************************************************************************/
function showSuccessMessage(message, time) {
    $.toast({
        heading: 'Success',
        text: message == '' ? "Hi." : message,
        hideAfter: time == 0 ? notificationsShowwTime : time * 1000,
        position: 'top-right',
        icon: 'success'
    });
}
/*********************************************************************************************/
function showWarningMessage(message, time) {
    $.toast({
        heading: 'Warning',
        text: message == '' ? "Hi." : message,
        hideAfter: time == 0 ? notificationsShowwTime : time * 1000,
        position: 'top-right',
        icon: 'warning'
    });
}
/*********************************************************************************************/
function objectsMerge(firstObject, secondObject) {
    for (let key in secondObject) {
        if (secondObject.hasOwnProperty(key)) firstObject[key] = secondObject[key];
    }
    return firstObject;
}
/*********************************************************************************************/
function showErrorMessage(message) {
    $.toast({
        heading: 'Error',
        text: message == '' ? "Hi." : message,
        hideAfter: notificationsShowwTime,
        position: 'top-right',
        icon: 'error'
    });
}
/*********************************************************************************************/
function showSimpleToast() {
    $.toast({
        heading: 'Information',
        text: 'Now you can add icons to generate different kinds of toasts',
        showHideTransition: 'slide',
        hideAfter: notificationsShowwTime,
        position: 'top-right',
        icon: 'info'
    });
}
/*********************************************************************************************/
/*********************************************************************************************/
function showErrorMessage(message, time) {
    $.toast({
        heading: 'Error',
        text: message == '' ? "Hi." : message,
        hideAfter: time === 0 ? notificationsShowwTime : time * 1000,
        position: 'top-right',
        icon: 'error'
    });
}
/*********************************************************************************************/
function loadingScreenElement(elementID, show, message) {
    if (show) {
        $('#' + elementID).block({
            message: message == '' ? "<h1>Processing</h1>" : "<h1> " + message + " </h1>",
            css: {
                border: 'none',
                padding: '15px',
                backgroundColor: '#000',
                '-webkit-border-radius': '10px',
                '-moz-border-radius': '10px',
                opacity: .5,
                color: '#fff'
            }
        });
    } else {
        $('#' + elementID).unblock();
    }
}
/**
 * This will show a UI blocking loading Screen*/
function loadingScreen(sho, message) {
    if (sho) {
        $.blockUI({
            message: message == '' ? "<h3> Processing.Please Wait...</h3>" : "<h3> " + message + "</h3>",
            css: {
                border: 'none',
                padding: '15px',
                backgroundColor: '#000',
                '-webkit-border-radius': '10px',
                '-moz-border-radius': '10px',
                opacity: .5,
                color: '#fff'
            }
        });
    } else {
        $.unblockUI({
            fadeOut: 100
        });
    }
}
/*********************************************************************************************/
/**
 * This shows a pop up dialog box that ask and returns decisions
 * @return     {Boolean}  true or false.
 */
function makeSureOfExit() {
    $(document).unload(function() {
        // if(confirm('Are you sure you want to exit?')){
        //      return true;
        // }
        // return false;
        return confirm("Are you sure you want to exit?");
    });
}
/*********************************************************************************************/
/**
 * This creates an array of numbers with in a given range
 * @param      {Number} start   start from
 * @param      {Number} end     stop at
 * @return     {Integer Array}  .
 */
function rangeArray(start, end) {
    let myArray = [];
    for (let i = start; i <= end; i += 1) {
        myArray.push(i);
    }
    return myArray;
}
/*********************************************************************************************/
function isPasswordValid(str)
{
	// at least one number, one lowercase and one uppercase letter
	// at least six characters that are letters, numbers or the underscore
	var re = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])\w{6,}$/;
	return re.test(str);
}
/*********************************************************************************************/
/*********************************************************************************************/

/*********************************************************************************************/
/**
 * This is a method override of the default JS replaceAll method to replace
 * {search} occurrences
 * @param      {String} search  The date to be converted
 * @param      {String} replace The date to be converted
 * @return     {String}  String.
 */
String.prototype.replaceAll2 = function(search, replacement) {
    var target = this;
    return target.split(search).join(replacement);
};
/*********************************************************************************************/
/*********************************************************************************************/
function randString(x) {
    var s = "";
    while (s.length < x && x > 0) {
        var r = Math.random();
        s += (r < 0.1 ? Math.floor(r * 100) : String.fromCharCode(Math.floor(r * 26) + (r > 0.5 ? 97 : 65)));
    }
    return s;
}
/*********************************************************************************************/
/**
 * Gets the random integer between min and max (both included)
 *
 * @param      {number}  min     The minimum
 * @param      {number}  max     The maximum
 * @return     {<type>}  The random integer.
 */
function getRndInteger(min, max) {
    return Math.floor(Math.random() * (max - min + 1)) + min;
}
/*********************************************************************************************/
/**
 * Creates a random receipt Number between min and max (both included)
 * @return     {<String>}  random receipt Number.
 */
function receiptNumber() {
    let ret = "";
    ret = getcurrentDate(); //  dd + '/' + mm + '/' + yyyy;
    let dd = ret.split('/')[0];
    let mm = ret.split('/')[1];
    let yyyy = ret.split('/')[2];
    let ranS = randString(getRndInteger(5, 8)).toUpperCase();
    ret = dd + ranS.substring(2, 4) + ranS.charAt(getRndInteger(1, 2)) + '-' + mm + '-' + ranS.charAt(getRndInteger(1, 4)) + yyyy;
    return ret;
}
/*********************************************************************************************/
/**
 * Converts a Turkish Z-Date format to  date form MM/DD/YYYY
 * @param      {String} zDate   The date to be converted
 * @return     {String}  Date String.
 */
function dateConvertor(zDate) {
    return new Date(zDate).toDateString();
}
/*********************************************************************************************/
/**
 * Converts a Turkish Z-Date format to  date form MM/DD/YYYY
 * @param      {String} zDate   The date to be converted
 * @return     {String}  Date String.
 */
function getDateConvertion(zdate) {
    let date = new Date(zdate);
    return ((date.getMonth() + 1) + '/' + date.getDate() + '/' + date.getFullYear());
}
/*********************************************************************************************/
function getCurrentTimeLong(){
   return new Date().getTime();
}
/*********************************************************************************************/
/**
 * Creates a random String based on the chars input <br>
 * example of usage: randomString(5); or randomString(5,
 * 'PICKCHARSFROMTHISSET');
 * <br>
 * @param {integer} length - size of the output .
 * @param {string} chars - can be ignored ,but the the characters to use in
 *         creating the output.
 * @returns {String} Random string of size @param lenSize
 */
function randomIDString(lenSize, chars) {
    let charSet = chars || 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    let randomString = "";
    for (let i = 0; i < lenSize; i++) {
        let position = Math.floor(Math.random() * charSet.length);
        randomString += charSet.substring(position, position + 1);
    }
    return randomString;
}
/*********************************************************************************************/
/**
 * Create a random String of alphabet and numbers
 * @returns {string} Random String
 */
function randomStringID() {
    var text = "";
    var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
    for (var i = 0; i < 5; i++) {
        text += possible.charAt(Math.floor(Math.random() * possible.length));
    }
    return text;
}
/*********************************************************************************************/
/**This will reset the form*/
function resteForm(formIdObject) {
    formIdObject[0].reset();
}
/*********************************************************************************************/
function idleTimer() {
    let t;
    //window.onload = resetTimer;
    window.onmousemove = resetTimer; // catches mouse movements
    window.onmousedown = resetTimer; // catches mouse movements
    window.onclick = resetTimer; // catches mouse clicks
    window.onscroll = resetTimer; // catches scrolling
    window.onkeypress = resetTimer; //catches keyboard actions
    function logout() {
        window.location.href = '/action/logout'; //Adapt to actual logout script
    }

    function reload() {
        window.location = self.location.href; //Reloads the current page
    }

    function resetTimer() {
        clearTimeout(t);
        t = setTimeout(logout, 1800000); // time is in milliseconds (1000 is 1 second)
        t = setTimeout(reload, 300000); // time is in milliseconds (1000 is 1 second)
    }
}
/*********************************************************************************************/
function __(elementId) {
    return document.getElementById(elementId);
}
/*********************************************************************************************/
function isNumeric(num){
    return !isNaN(num);
}
/*********************************************************************************************/
function getSiblings(el, filter) {
    var siblings = [];
    el = el.parentNode.firstChild;
    do { if (!filter || filter(el)) siblings.push(el); } while (el = el.nextSibling);
    return siblings;
}

// example filter function
function exampleFilter(el) {
    return elem.nodeName.toLowerCase() == 'a';
}

// usage
//el = document.querySelector('div');
// get all siblings of el
//var sibs = getSiblings(el);
// get only anchor element siblings of el
//var sibs_a = getSiblings(el, exampleFilter);
/*********************************************************************************************/
/**
 * This will convert a M/D/Y date format to dddd MMMM D YYYY
 * */
function convertDateToReadable(date_M_slash_D_slash_Y){
    // 02/12/2013
    let longDateStr = moment(date_M_slash_D_slash_Y, 'M/D/Y').format('dddd MMMM D YYYY');
    return (longDateStr);
}

/*********************************************************************************************/
/**
 * This will convert a M/D/Y date format to dddd MMMM D YYYY
 * */
function convertDateToReadableFormat(date_yyy_mm_dd){
    let longDateStr = moment(date_yyy_mm_dd, 'YYYY-MM-DD').format('dddd MMMM D YYYY');
    // alert(new Date("2018-07-27").toUTCString().split(" "))
    return (longDateStr);
}
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/
/*********************************************************************************************/