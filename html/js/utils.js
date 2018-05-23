// to include checkboxes as boolean when calling .serialize()
$( document ).ready(function() {
	(function ($) {
	     $.fn.serialize = function (options) {
	         return $.param(this.serializeArray(options));
	     };
	 
	     $.fn.serializeArray = function (options) {
	         var o = $.extend({
	         checkboxesAsBools: false
	     }, options || {});
	 
	     var rselectTextarea = /select|textarea/i;
	     var rinput = /text|hidden|password|search/i;
	 
	     return this.map(function () {
	         return this.elements ? $.makeArray(this.elements) : this;
	     })
	     .filter(function () {
	         return this.name && !this.disabled &&
	             (this.checked
	             || (o.checkboxesAsBools && this.type === 'checkbox')
	             || rselectTextarea.test(this.nodeName)
	             || rinput.test(this.type));
	         })
	         .map(function (i, elem) {
	             var val = $(this).val();
	             return val == null ?
	             null :
	             $.isArray(val) ?
	             $.map(val, function (val, i) {
	                 return { name: elem.name, value: val };
	             }) :
	             {
	                 name: elem.name,
	                 value: (o.checkboxesAsBools && this.type === 'checkbox') ? //moar ternaries!
	                        (this.checked ? 'TRUE' : 'FALSE') :
	                        val
	             };
	         }).get();
	     };
	 
	})(jQuery);
    //alert('unchecked checkboxes will be included');
});

function getQueryParams (query = window.location.search) {
  return query.replace(/^\?/, '').split('&').reduce((json, item) => {
    if (item) {
      item = item.split('=').map((value) => decodeURIComponent(value))
      json[item[0]] = item[1]
    }
    return json
  }, {})
}


function formDataToJSON(form_id){
	var form1 = document.getElementById(form_id);
	var form_data = $(form1).serialize({ checkboxesAsBools: true });
	var json_str = getQueryParams(form_data);
	return json_str;
}

