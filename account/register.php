<script>
var xhr = new XMLHttpRequest();
xhr.open("GET", "https://platform.clickatell.com/messages/http/send?apiKey=quap0_ZSQeqlaXjyYYaO6A==&to=918979836671&content=Test+message+text", true);
xhr.onreadystatechange = function(){
    if (xhr.readyState == 4 && xhr.status == 200) {
        console.log('success');
    }
};
xhr.send();

</script>
