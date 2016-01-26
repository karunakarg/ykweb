<script type="text/javascript">
function add_file_field(){
var container=document.getElementById('file_container');
var file_field=document.createElement('input');
file_field.name='images[]';
file_field.type='file';
container.appendChild(file_field);
var br_field=document.createElement('br');
container.appendChild(br_field);
}
</script>
<?
if (isset($_POST['Submit'])) {
    $number_of_file_fields = 0;
    $number_of_uploaded_files = 0;
    $number_of_moved_files = 0;
    $uploaded_files = array();
    $upload_directory = dirname(__file__) . '/uploaded/'; //set upload directory
    /**
     * we get a $_FILES['images'] array ,
     * we procee this array while iterating with simple for loop
     * you can check this array by print_r($_FILES['images']);
     */
    for ($i = 0; $i < count($_FILES['images']['name']); $i++) {
        $number_of_file_fields++;
        if ($_FILES['images']['name'][$i] != '') { //check if file field empty or not
            $number_of_uploaded_files++;
            $uploaded_files[] = $_FILES['images']['name'][$i];
            if (move_uploaded_file($_FILES['images']['tmp_name'][$i], $upload_directory . $_FILES['images']['name'][$i])) {
                $number_of_moved_files++;
            }
 
        }
 
    }
    echo "Number of File fields created $number_of_file_fields.<br/> ";
    echo "Number of files submitted $number_of_uploaded_files . <br/>";
    echo "Number of successfully moved files $number_of_moved_files . <br/>";
    echo "File Names are <br/>" . implode(',', $uploaded_files);
}
?>
<form action="up.php" method="post" enctype="multipart/form-data" name="mutiple_file_upload_form" id="mutiple_file_upload_form">
  <h1>Advanced Multiple File Upload Script Example</h1><div id="file_container">
    <input name="images[]" type="file"  />
    <br />
  </div>
  <a href="javascript:void(0);" onClick="add_file_field();">Add another</a><br />
  <input type="submit" name="Submit" value="Submit" />
</form>