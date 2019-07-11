if (document.getElementById('public_toggle') !== null) {
	document.getElementById('public_toggle').addEventListener('change', function() {
    	$file = document.getElementById('public').action;
    	$.ajax({
		    type: "GET",
		    url: $file,
		    data: {},
		    success: function(e) {
		    	
		    }
		});
	});
}

// ONLY DONE ON USER EDIT PAGE
try {
	//code that causes an error
	document.getElementById("upload_pic").onchange = function () {
	    var reader = new FileReader();

	    reader.onload = function (e) {
	        // get loaded data and render thumbnail.
	        document.getElementById("profile_pic_preview").src = e.target.result;
	    };

	    // read the image file as a data URL.
	    reader.readAsDataURL(this.files[0]);
	};
} catch(e){
	//id doesn't exist
}

//ONLY DONE ON USERS(SOCIAL) PAGE
try {
	document.getElementById('user_search').addEventListener('keyup', function() {
		// Declare variables
	    var input, filter, ul, li, a, i;
	    input = document.getElementById('user_search');
	    filter = input.value.toUpperCase();
	    tbody = document.getElementById("users");
	    names = tbody.getElementsByClassName('name');

	    // Loop through all list items, and hide those who don't match the search query
	    for (i = 0; i < names.length; i++) {
	        if (names[i].innerHTML.toUpperCase().indexOf(filter) > -1) {
	            names[i].style.display = "";
	        } else {
	            names[i].parentElement.style.display = "none";
	        }
	    }

	    if (input.value === '') {
	    	for (i = 0; i < names.length; i++) {
	            names[i].parentElement.style.display = "";
	    	}
	    }
	});
	jQuery(document).ready(function($) {
	    $(".clickable-row").click(function() {
	        window.location = $(this).data("href");
	    });
	});
} catch(e) {
	//skip script
}

$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});

