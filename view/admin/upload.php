<?php 
if(isset($_FILES['upload']['name'])){
    $file_name = rand().$_FILES['upload']['name'];
    $file_tmp = $_FILES['upload']['tmp_name'];
    $target = '../upload/';
    $array = array(1=>'../upload/',2=>'upload/');
    $i =1;
    foreach($array as $k => $v){
        move_uploaded_file($file_tmp,$v.$file_name);
        $function_number = $_GET['CKEditorFuncNum'];
        $url = '../upload/'.$file_name;
        $message = '';
        echo '<script>';
        echo 'window.parent.CKEDITOR.tools.callFunction("'.$function_number.'","'.$url.'","'.$message.'")';
        echo '</script>';
    }
    // if(move_uploaded_file($file_tmp,$target.$file_name)){
    //     $function_number = $_GET['CKEditorFuncNum'];
    //     $url = '../upload/'.$file_name;
    //     $message = '';
    //     echo '<script>';
    //     echo 'window.parent.CKEDITOR.tools.callFunction("'.$function_number.'","'.$url.'","'.$message.'")';
    //     echo '</script>';
    // }else{
    //     echo '<script>alert("error")</script>';
    // }
        
}
?>