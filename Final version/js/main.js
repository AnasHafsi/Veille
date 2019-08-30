tinymce.init({
    selector: 'textarea',
    height : 480,
    menubar: false
});
function aji() {
    var data = tinymce.get("mytextarea").getContent();
    document.getElementById("anas").innerHTML = data;
    console.log("print");
    alert("<?php echo 1; ?>");
}
