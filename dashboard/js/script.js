function account(){
	window.location.href="../account";
}
function redirect(location){
	window.location.href=`../complaint?on=id&id=${location}&token=${token}`;
}

$('#how').click(function(){
	$('.popup').show();
});
function hide(){
	$('.popup').hide();
}
var optiond = {
	data:["purola ","yamunotri","gangotri","badrinath","tharali ","karnaprayag","kedarnath","rudraprayag","ghansali ","devprayag","narendranagar","pratapnagar","tehri","dhanaulti","chakrata","vikasnagar","sahaspur","dharampur","raipur","rajpur road","dehradun cantt","mussoorie","doiwala","rishikesh","haridwar","bhel ranipur","jwalapur","bhagwanpur","jhabrera ","piran kaliyar","roorkee","khanpur","manglaur","laksar","haridwar rural","yamkeshwar","pauri ","didihat","pithoragarh","gangolihat ","Srinagar","Chaubattakhal","Lansdowne","Kotdwar","Dharchula","Kapkot","Bageshwar ","Dwarahat","Salt","Ranikhet","Someshwar","Almora","Jageshwar","Lohaghat","Champawat","Lalkuan","Bhimtal","Nainital","Haldwani","Kaladhungi","Ramnagar","Jaspur","Kashipur","Bajpur ","Gadarpur","Rudrapur","Kichha","Sitarganj","Nanakmatta","Khatima"],
	list: {
		match: {
			enabled: true
		},

		 showAnimation: {
			 type: "fade", //normal|slide|fade
			 time: 400,
			 callback: function() {}
		 },

		 hideAnimation: {
			 type: "slide", //normal|slide|fade
			 time: 400,
			 callback: function() {}
		 }
	}
};
$("#area").easyAutocomplete(optiond);
var options = {
	data: ["raj kumar","kedar singh rawat","gopal singh rawat","mahendra bhatt","magan lal shah","surendra singh negi","manoj rawat","bharat singh rawat","shakti lal shah","vinod kandari","subodh uniyal ","vijay singh panwar","dhan singh negi","pritam singh panwar","pritam singh","munna singh chauhan","sahdev singh pundir","vinod chamoli","umesh sharma 'kau'","khajan das","harbans kapoor","ganesh joshi","trivendra singh rawat","premchand aggarwal","madan kaushik ","adesh chauhan","suresh rathor","mamta rakesh","deshraj karnwal","furqan ahmad","pradip batra","kunwar pranav singh ","qazi muhammad ","sanjay gupta","yatishwaranand","ritu khanduri bhushan","mukesh singh koli","bishan singh chuphal","prakash pant ","mina gangola","Dr. Dhan Singh Rawat","Satpal Maharaj","Dilip Singh Rawat","Dr. Harak Singh Rawat","Harish Singh Dhami","Balwant Singh Bhauryal","Chandan Ram Das","Mahesh Singh Negi","Surendra Singh Jeena","Karan Singh Mahra","Rekha Arya","Raghunath Singh Chauhan","Govind Singh Kunjwal","Puran Singh Phartyal","Kailash Chandra Gahtori","Navin Chandra Dumka","Ram Singh Kaira","Sanjiv Arya","Dr. Indira Hridayesh","Banshidhar Bhagat","Diwan Singh Bisht","Adesh Singh Chauhan","Harbhajan Singh Cheema","Yashpal Arya","Arvind Pandey ","Rajkumar Thukral","Rajesh Shukla","Saurabh Bahuguna","Dr. Prem Singh Rana","Pushkar Singh Dhami"],
	list: {
		match: {
			enabled: true
		},

		 showAnimation: {
			 type: "fade", //normal|slide|fade
			 time: 400,
			 callback: function() {}
		 },

		 hideAnimation: {
			 type: "slide", //normal|slide|fade
			 time: 400,
			 callback: function() {}
		 }
	}
};

$("#report").easyAutocomplete(options);
