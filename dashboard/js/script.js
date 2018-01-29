function account(){
	window.location.href="../account";
}
function redirect(location){
	window.location.href=`../complaint?on=id&id=${location}&token=${token}`;
}
var options = {

  url: function(phrase) {
    return "ajax.php";
  },

  getValue: function(element) {
    return element.name;
  },

  ajaxSettings: {
    dataType: "json",
    method: "POST",
    data: {
      dataType: "json"
    }
  },

  preparePostData: function(data) {
    data.phrase = $("#example-ajax-post").val();
    return data;
  },
	list: {
		showAnimation: {
			type: "fade", //normal|slide|fade
			time: 40,
			callback: function() {}
		},

		hideAnimation: {
			type: "slide", //normal|slide|fade
			time: 400,
			callback: function() {}
		}
	}


};

$("#example-ajax-post").easyAutocomplete(options);
